(function($){
	app = {};

$.fn.dataTable.ext.order['currency-exclude-disabled'] = function(settings, col) {
	var sorting = settings['aaSorting'][0][1];
	return this.api().column(col, {
		order: 'index'
	}).nodes().map(function(td, i) {
		var $td = $(td)
		  , isDisabled = $(td).parent('tr').hasClass('table-disabled')
		  , value = ($td.text() === "-") ? 0 : $td.text().replace(/[^\d\-\.]/g, "");
		if (isDisabled) {
			if (sorting == 'asc') {
				value = 1000000;
			} else {
				value = -1000000;
			}
		}
		return value;
	});
};
$.fn.dataTable.ext.order['string-exclude-disabled'] = function(settings, col) {
	var sorting = settings['aaSorting'][0][1];
	return this.api().column(col, {
		order: 'index'
	}).nodes().map(function(td, i) {
		var $td = $(td)
		  , isDisabled = $(td).parent('tr').hasClass('table-disabled')
		  , value = $td.text();
		if (isDisabled) {
			if (sorting == 'asc') {
				value = 'яяяя';
			} else {
				value = ' ';
			}
		}
		return value;
	});
}
;
app.brokerAdvantage = (function() {
	var selector = {
		item: '.add-review-feature',
		plus: '.add-review-plus',
		minus: '.add-review-minus'
	};
	function onAddClick(e) {
		e.preventDefault();
		var $parentItem = $(this).parents(selector.item);
		var $newItem = $parentItem.clone();
		var newName = getNewName($parentItem);
		$newItem.find('input').attr('name', newName).val('');
		bindEvents($newItem);
		$newItem.insertAfter($parentItem);
	}
	function onRemoveClick(e) {
		e.preventDefault();
		$(this).parents(selector.item).remove();
	}
	function bindEvents($item) {
		$item.on('click', selector.plus, onAddClick).on('click', selector.minus, onRemoveClick);
	}
	function getNewName($item) {
		var name = $item.find('input').attr('name');
		var regex = /\d{1,3}/g;
		return name.replace(regex, function(match) {
			return (+match + 1);
		});
	}
	return {
		init: function() {
			bindEvents($(selector.item));
		}
	}
}
)();
app.reviewSorting = (function() {
	var $dateSort, $ratingSort, $reviewsContainer;
	var mixer;
	var $showMore;
	var visibleCount;
	var helpMixer;
	function onShowMoreClick(e) {
		e.preventDefault();
		visibleCount += window.reviewShowCount;
		showMoreItems();
		$(this).toggleClass('hidden', visibleCount >= mixer.getState().totalTargets);
	}
	function onChangeSorting(e) {
		if ($(this).attr('id') == 'review-sort-date') {
			$ratingSort.val('null');
		} else {
			$dateSort.val('null');
		}
		var sortingAlgorithm = $(this).val();
		if (sortingAlgorithm != 'null') {
			mixer.multimix({
				filter: getFilteredItems(sortingAlgorithm),
				sort: sortingAlgorithm
			});
		}
	}
	function getFilteredItems(sortingAlgorithm) {
		helpMixer.sort(sortingAlgorithm);
		var sortedItems = helpMixer.getState().targets;
		var filtered = [];
		sortedItems.forEach(function(element, index) {
			if (index < visibleCount) {
				var filteredItem = $reviewsContainer.find('.review[data-id="' + element.dataset['id'] + '"]');
				filtered.push(filteredItem.get(0));
			}
		});
		return filtered;
	}
	function showMoreItems() {
		var collection = Array.from($('.review'));
		var filtered = collection.filter(function(target, index) {
			return index < visibleCount;
		});
		mixer.filter(filtered);
	}
	return {
		init: function() {
			$dateSort = $('#review-sort-date');
			$ratingSort = $('#review-sort-rating');
			$reviewsContainer = $('#reviews_list');
			$showMore = $('#reviews_show_more');
			visibleCount = window.reviewShowCount;
			if (!$reviewsContainer.length || !$reviewsContainer.children().length)
				return false;
			mixer = mixitup($reviewsContainer.get(0), {
				selectors: {
					target: '.review'
				}
			});
			helpMixer = mixitup(document.getElementById('reviews-sorting-helper'), {
				selectors: {
					target: '.review'
				}
			});
			showMoreItems();
			$dateSort.on('change', onChangeSorting);
			$ratingSort.on('change', onChangeSorting);
			$showMore.on('click', onShowMoreClick);
		}
	}
}
)();
app.complexCalculator = (function() {
	"use strict";
	var $currencyPair, $instrumentInput;
	var $selectedInstrument = null;
	var $bestRebate = 0;
	var accountTable;
	function refreshBestRebate() {
		var countLots = parseInt($("#count_lots").val());
		var lotsPerDay;
		if (!isNaN(countLots)) {
			var calcPeriod = $('#calc_period').val();
			var calcPeriod = 'custom';
			var periods = {
				day: {
					min: {
						workdays: 1,
						label: 'в день'
					},
					max: {
						workdays: 5,
						label:'в неделю'
					}
				},
				week: {
					min: {
						workdays: 5,
						label: 'в неделю'
					},
					max: {
						workdays: 21,
						label: 'в месяц'
					}
				},
				month: {
					min: {
						workdays: 21,
						label: 'в месяц'
					},
					max: {
						workdays: 247,
						label: 'в год'
					}
				},
				custom : {
					day: {
						workdays: 1,
						label: 'в день'
					},
					week: {
						workdays: 5,
						label: 'в неделю'
					},
					month: {
						workdays: 21,
						label: 'в месяц'
					},
					year: {
						workdays: 247,
						label: 'в год'
					}
				}
			};
			switch (calcPeriod) {
			case 'day':
				lotsPerDay = countLots;
				break;
			case 'week':
				lotsPerDay = countLots / 5;
				break;
			case 'month':
				lotsPerDay = countLots / 21;
				break;
			default:
				lotsPerDay = countLots;
				break;
			}
			var dayValue = lotsPerDay * periods[calcPeriod]['day'].workdays * $bestRebate;
			var weekValue = lotsPerDay * periods[calcPeriod]['week'].workdays * $bestRebate;
			var monthValue = lotsPerDay * periods[calcPeriod]['month'].workdays * $bestRebate;
			var yearValue = lotsPerDay * periods[calcPeriod]['year'].workdays * $bestRebate;
			$('#rebate_period_day').html(periods[calcPeriod]['day'].label);
			$('#rebate_period_week').html(periods[calcPeriod]['week'].label);
			$('#rebate_period_month').html(periods[calcPeriod]['month'].label);
			$('#rebate_period_year').html(periods[calcPeriod]['year'].label);
			$('#rebate_value_day').html(Number(dayValue).toFixed(2));
			$('#rebate_value_week').html(Number(weekValue).toFixed(2));
			$('#rebate_value_month').html(Number(monthValue).toFixed(2));
			$('#rebate_value_year').html(Number(yearValue).toFixed(2));
		}
	}
	function loadInstruments() {
		var instrumentType = $instrumentInput.filter(':checked').val();
		if (window.instruments[instrumentType] != undefined) {
			var $addedInstrument = [];
			$currencyPair.html('');
			_.each(window.instruments[instrumentType], function(instrument) {
				var selected = !$currencyPair.find('option').length ? 'selected' : '';
				if (!_.contains($addedInstrument, instrument.label)) {
					$addedInstrument.push(instrument.label);
					if (selected != '') {
						$selectedInstrument = instrument.label;
					}
					$currencyPair.append('<option value="' + instrument.label + '" ' + selected + ' >' + instrument.label + '</option>');
				}
			});
		}
		// $('select').niceSelect('update');
		var select = document.querySelector('.calc__select'),
			selectList    = select.querySelector('.select__list'),
			selectParse   = select.querySelector('select'),
			selectOptions = selectParse.querySelectorAll('option'),
			selectTitle   = select.querySelector('.select__title');
		if (selectList) {
			selectList.innerHTML = '';
			selectTitle.innerText = selectOptions[0].innerText;
			selectOptions.forEach((option)=>{
				var item = document.createElement('div'),
						text = option.innerText,
						selected = option.getAttribute('selected'),
						group = option.getAttribute('data-group');
				item.className = 'select__item';
				selectList.append(item);
				item.innerText = text;

				if (option.hasAttributes()) {
					for (let i = 0; i < option.attributes.length; i++) {
						let attr = option.attributes[i];
						item.setAttribute(attr.name, attr.value);
					}
				}

				if (selected) {
					current = option;
				}

				if (group) {
					item.setAttribute('data-group', group);
				}
			});

			var items = selectList.querySelectorAll('.select__item');
			items.forEach((item)=> {
				item.addEventListener('click', () => {
				if (!item.classList.contains('--selected')) {
						var value = item.getAttribute('value');

						selectTitle.innerText = item.innerText;

						selectOptions.forEach(option => {
							option.removeAttribute('selected');
						});
						items.forEach(itemsItem => {
							itemsItem.classList.remove('--selected');
						});
						var option = select.querySelector('option[value = "' + value + '"]');
						option.setAttribute('selected', 'selected');
						item.classList.add('--selected');
						select.classList.remove('--open');

						var event = new Event('change');

						select.querySelector('select').dispatchEvent(event);
					}
				});
			});
			
		}
		
		loadAccountTable();
	}
	function accountTableInit() {
		accountTable = $('#broker-account-table').DataTable({
			paging: false,
			searching: false,
			info: false,
			order: [[2, 'desc']],
			row: {
				className: 'article__table-body-modul'
			},
			columns: [null, null, {
				type: 'num',
				orderDataType: 'currency-exclude-disabled'
			}, {
				type: 'string',
				orderDataType: 'string-exclude-disabled'
			}],
			columnDefs: [{
				orderable: false,
				targets: [0, 1]
			}]
		});

		// $('#broker-account-table').dataTable( {
		//   "createdRow": function( row, data, dataIndex ) {
		//     if ( data[4] == "A" ) {
		//       $(row).addClass( 'important' );
		//     }
		//   }
		// } );
	}
	function loadAccountTable() {
		var accounts = [];
		_.each(window.instruments, function(instrumentOfType, indexType) {
			_.each(instrumentOfType, function(instrument, index) {
			
				var rowIndex = _.findIndex(accounts, {
					account_id: instrument.account_id
				});
			
				if (instrument.label == $selectedInstrument) {
					var value = parseFloat(instrument.value);
					var row = {
						value: value,
						enabled: true,
						index: index,
						account_id: instrument.account_id,
						type: indexType
					};
					if (rowIndex == -1) {
						accounts.push(row);
					} else if (accounts[rowIndex].enabled == false || accounts[rowIndex].value < instrument.value) {
						accounts[rowIndex] = row;
					}
				} else if (rowIndex == -1) {
					accounts.push({
						enabled: false,
						index: index,
						account_id: instrument.account_id,
						type: indexType
					});
				}
			});
		});
		var bestItem = _.max(accounts, function(item) {
			return typeof item.value != 'undefined' ? item.value : 0;
		});
		accountTable.clear().draw();
		_.each(accounts, function(element, index) {
			var values = window.instruments[element.type][element.index];
			values.value = Number(values.value).toFixed(2);
			if ((bestItem.account_id == element.account_id) && (element.enabled === true)) {
				$bestRebate = values.value;
				accountTable.row.add(getRowData(values, 'best')).draw();
			} else if (element.enabled === true) {
				accountTable.row.add(getRowData(values)).draw();
			} else if (element.enabled === false) {
				accountTable.row.add(getRowData(values)).draw().nodes().to$().addClass('table-disabled');
			}
		});
		accountTable.rows().invalidate().draw();
	}
	function getRowData(values, type) {
		var bestColumnTpl = _.template('<div class="best-choice"><span class="best-choice-account"><%= name %></span></div>');
		var name = type === 'best' ? bestColumnTpl(values) : values.name;
		return [name, values.desc, '$ ' + values.value, values.reward_period];
	}
	return {
		init: function() {
			$currencyPair = $('#сurrency_pair');
			$instrumentInput = $('#instrument_type').find('input:radio');
			accountTableInit();
			loadInstruments();
			refreshBestRebate();


			$instrumentInput.on('change', ()=>{
				loadInstruments();
				refreshBestRebate();
			});
			$currencyPair.on('change', function() {
				$selectedInstrument = $(this).val();
				loadAccountTable();
				refreshBestRebate();
			});
			//$('#recalc').on("click", refreshBestRebate);

			jQuery('.incdec__btn').on('click tap', function() {
				refreshBestRebate();
			});
		}
	}
}
)();
$(function() {
	// new GridCarousel();
	// $('#sticky_header').stickyHeader({
	//     limit: '.account-table .grid:last',
	//     target: '#account_table_header'
	// });
	// $('#sticky_footer').stickyFooter({
	//     limit: '#account_table_header'
	// });
	$('.scrollbar-outer').scrollbar();
	app.brokerAdvantage.init();
	app.reviewSorting.init();
	app.complexCalculator.init();
});

document.addEventListener('DOMContentLoaded', ()=>{
	setTimeout(()=>{
		 var select = document.querySelector('.calc__select');

		select.classList.add('select');


		new Select(select);
	}, 300)
   
})
})(jQuery);