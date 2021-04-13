var filterRanges = document.querySelectorAll('.filter__range');

if (filterRanges) {
	filterRanges.forEach((range)=>{
		var data = {
			min: Number(range.getAttribute('data-min')),
			max: Number(range.getAttribute('data-max')),
			current: Number(range.getAttribute('data-current')),
			step: Number(range.getAttribute('data-step'))
		};

		var text = {
			before: range.getAttribute('data-before'),
			after: range.getAttribute('data-after')
		}

		var percent = data.max / 100;


		var pips = {
			mode: 'range',
			density: -1,
			format: {
				to: function(value) {
					return text.before + value.toFixed(0) + text.after;
				},
				from: function(value) {
					return value;
				},
			}
		};

		noUiSlider.create(range, {
			start: data.current,
			step: data.step,
			connect: [true, false],
			tooltips: [true],
			range: {
				'min': data.min,
				'max': data.max
			},
			format: {
				to: function(value) {
					return text.before + value.toFixed(0) + text.after;
				},
				from: function(value) {
					return value;
				},
			},
			pips: pips
		})

		var pips = range.querySelectorAll('.noUi-value');

		range.noUiSlider.on('update', function(){
			var value = Number(range.noUiSlider.get(0).replace(text.before, '').replace(text.after, ''));


			if (value < 23 * percent) {
				pips[0].classList.add('--hidden');
			}
			else {
				pips[0].classList.remove('--hidden');
			}
			if (value > 77 * percent) {
				pips[1].classList.add('--hidden');
			}
			else {
				pips[1].classList.remove('--hidden');
			}

			range.setAttribute('data-value', value);
		})

	})
}

document.addEventListener('DOMContentLoaded', ()=>{
	var brokersTabs = document.querySelectorAll('.brokers__tab');

	brokersTabs.forEach((tab)=>{
		var search = tab.querySelector('.brokers__search .input__area'),
				trs    = tab.querySelectorAll('.t tr');

		if (search) {
			search.addEventListener('input', ()=>{
				trs.forEach((tr)=>{
					var name = tr.getAttribute('data-name') ? tr.getAttribute('data-name').replace('Обзор брокера ', '').toLowerCase() : null;

					if (name) {
						if (name.indexOf(search.value.toLowerCase()) < 0) {
							tr.classList.add('--hidden-for-name');
						} else {
							tr.classList.remove('--hidden-for-name');
						}
					}
				})	
			})
		}
		
	});


	var filter = {
		ranges: document.querySelectorAll('.filter__range'),
		checks: document.querySelectorAll('.filter__check'),
		checkMT5: document.querySelector('.filter__check input[value="MT5"]'),
		checkMT4: document.querySelector('.filter__check input[value="MT4"]'),
		btn:    document.querySelector('.filter__show'),
		reset:    document.querySelector('.filter__reset'),
		trs:    document.querySelectorAll('.table_filter tbody tr')
	}

	if (filter.ranges.length > 0) {

		filter.btn.addEventListener('click', ()=>{
			var data = [];
			filter.ranges.forEach((range, i)=>{
				var value = range.getAttribute('data-value') ? Number(range.getAttribute('data-value')) : null,
						min   = range.getAttribute('data-min') ? Number(range.getAttribute('data-min')) : null,
						name  = range.getAttribute('data-tr-name') ? range.getAttribute('data-tr-name') : null;

				data.push([]);
				data[i][0] = value;
				data[i][1] = min;
				data[i][2] = name;

				console.log(data)
			})


			filter.trs.forEach((tr)=>{
				let errors = 0;
				for (let i = 0; i < data.length; i++) {
					if (Number(tr.getAttribute(data[i][2])) > data[i][0] && data[i][0] != data[i][1]) {
						errors++;
					}

				}

				let terminal = tr.getAttribute('data-terminal') ? tr.getAttribute('data-terminal') : null;

				if (terminal) {
					if (filter.checkMT5.hasAttribute('checked')) {
						if (terminal.indexOf(filter.checkMT5.value) < 0) {
							errors++;
						}
					}
					if (filter.checkMT4.hasAttribute('checked')) {
						if (terminal.indexOf(filter.checkMT4.value) < 0) {
							errors++;
						}
					}
				}

				// console.log(errors);
				if (errors > 0) {
					tr.classList.add('--hidden-for-filter');
				} else {
					tr.classList.remove('--hidden-for-filter');
				}
			})

		})

		filter.reset.addEventListener('click', ()=>{
			filter.trs.forEach((tr)=>{
				tr.classList.remove('--hidden-for-filter');
			});

			filter.checks.forEach((check)=>{
				check.classList.remove('--checked');
			})
			filter.checkMT4.removeAttribute('checked');
			filter.checkMT5.removeAttribute('checked');

			filterRanges.forEach((range)=>{
				range.noUiSlider.set(0)
			});
		})
	}
})