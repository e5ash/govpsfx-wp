var html = document.querySelector('html'),
		body = document.querySelector('body'),
		wrap = document.querySelector('.wrap');

var mailPattern = /^[0-9a-z_-]+@[0-9a-z_-]+.[a-z]{2,5}$/i;


document.addEventListener('DOMContentLoaded', ()=>{
	class sForm {
		constructor(elem){
			var title = elem.querySelector('.s-form__title'),
					firstItem = elem.querySelector('.s-form__item'),
					firstItemTitle = firstItem.getAttribute('data-title'),
					counter = document.createElement('div'),
					items = elem.querySelectorAll('.s-form__item'),
					countCurrent = elem.querySelector('.s-form__count-current'),
					countTotal	 = elem.querySelector('.s-form__count-total'),
					status = elem.querySelector('.s-form__status div'),
					btn = elem.querySelector('.s-form__btn');

			items.forEach((item, i)=>{
				item.setAttribute('data-index', i + 1);
			})

			if (elem.getAttribute('data-title') == 'true') {
				title = document.createElement('div');
				title.classList = 's-form__title';
				title.innerText = firstItemTitle;
				elem.prepend(title);
			}

			counter.className = 's-form__counter';
			counter.innerText = '#01';
			elem.prepend(counter);

			firstItem.classList.add('--current');

			status.style.width = 100 / items.length + '%';


			countCurrent.innerText = '01'	;
			countTotal.innerText = '0' + items.length;

			btn.addEventListener('click', (event)=>{
				event.preventDefault();
				var currentItem = elem.querySelector('.s-form__item.--current'),
						input = currentItem.querySelector('.s-form__input'),
						index = Number(currentItem.getAttribute('data-index')),
						value = input.querySelector('input').value,
						errors = 0;

				if (input.classList.contains('--name') && value.length < 3){
					errors += 1;
					input.classList.add('--error');
				} else{
					// input.classList.remove('--error');
				}

				if (input.classList.contains('--email') && !mailPattern.test(value.trim())){
					errors += 1;
					input.classList.add('--error');
				} else{
					// input.classList.remove('--error');
				}

				if (errors == 0) {
					var nextItem = jQuery(currentItem).next()[0];
					if (nextItem) {
						var itemTitle = nextItem.getAttribute('data-title');
						counter.innerText = '#0' + (index + 1);
						countCurrent.innerText = '0' + (index + 1);

						currentItem.classList.remove('--current');
						nextItem.classList.add('--current');

						if (title) {
							title.innerText = itemTitle;
						}

						status.style.left = (100 / items.length * index) + '%';
					} else {
						input.classList.remove('--error');
						var form = jQuery(this),
								box_id = form.attr('id'),
								sendobj = {},
								message_container = jQuery(elem).find('.s-form__message');

						sendobj.Box = box_id;
						sendobj.Page = document.location.href;
						sendobj.action = 'dgd_stb_form_process';
						sendobj.stbNonce = $DGD.nonce;
						sendobj.Screen_size = $DGD.screenwidth + 'px * ' + $DGD.screenheight + 'px';
						form.find('input, textarea, select').each(function () {
							sendobj[jQuery(this).attr('name')] = jQuery(this).val();
						});

						jQuery.ajax({
							url: $DGD.ajaxurl,
							data: sendobj,
							dataType: 'json',
							type: 'post',
							cache: false,
							beforeSend: function () {
								message_container.html('<img src="' + $DGD.scripthost + 'img/37-1.gif" border="0">').show();
							},
							success: function (response) {
								message_container.html(response.html).show();
							if (response.status === '200') {
											// set cookie for permanent close
											$DGD.closeAfterSubmit(box_id);
										} 
									},
									error: function (jqXHR, textStatus, errorThrown) {
										message_container.html(textStatus + ': ' + errorThrown).show();
									}
								});

						return false;

						}

					}

			});
		}
	}

	var up = {
		cls: '--show',
		btn: document.getElementById('up-btn'),
		click: function(){
			this.btn.addEventListener('click', ()=>{
				wrap.scrollIntoView({
					behavior: 'smooth',
					block: 'start'
				})
			});
		},
		toggle: function(){
			if (pageYOffset > body.clientHeight) {
				this.btn.classList.add(this.cls);
			} else{
				this.btn.classList.remove(this.cls);
			}
		},
	}
	var sForms = document.querySelectorAll('.s-form');
	if (sForms) {
		sForms.forEach((form)=>{
			new sForm(form);
		})
	}

	up.click();
	up.toggle();
	window.addEventListener('scroll', ()=>{
		up.toggle();
	});

	var search = {
		block: document.querySelector('.search'), 
		btns: document.querySelectorAll('.toggle-search'),
		cls: '--show',
		click: function(){
			this.btns.forEach((btn)=>{
				btn.addEventListener('click', ()=>{
					this.block.classList.toggle(this.cls);
				})
			})
		}
	}
	search.click();

	var nav = document.querySelector('.nav'),
			toggleNav = document.querySelectorAll('.toggle-nav');

	toggleNav.forEach((btn)=>{
		btn.addEventListener('click', ()=>{
			nav.classList.toggle('--show');
			html.classList.toggle('overflow-disable');
			body.classList.toggle('overflow-disable');
			wrap.classList.toggle('overflow-disable');
		})
	})

	var shares = document.querySelectorAll('.share');
	shares.forEach((share)=>{
		var list = share.querySelector('.share__list');
		share.addEventListener('click', ()=>{
			list.classList.toggle('--show');
		})
	})

	var anchoreLinks = document.querySelectorAll('.achore-link a');
	anchoreLinks.forEach((a)=>{
		a.addEventListener('click', (e)=>{
			e.preventDefault();

			var id = a.getAttribute('href'),
					elem = document.querySelector(id);


			console.log(elem);

			if (elem) {
				elem.scrollIntoView({
						behavior: 'smooth',
						block: 'start'
				});
			}
		 })
	});

	
	const getSort = ({ target }) => {
		const order = (target.dataset.order = -(target.dataset.order || -1));

		const th = target.closest('th');

		if (th.hasAttribute('data-sort')) {
			const index = [...th.parentNode.cells].indexOf(th);
			const collator = new Intl.Collator(['en', 'ru']);
			const comparator = (index, order) => (a, b) => {
				console.log(Number(a.children[index].innerText.replace(/[^\d.]/g, '')));
				console.log('---------')
				console.log(Number(b.children[index].innerText.replace(/[^\d.]/g, '')));
				return order * collator.compare(
					Number(a.children[index].innerText.replace(/[^\d.-]/g, '')),
					Number(b.children[index].innerText.replace(/[^\d.-]/g, ''))
				);
			}
			
			for(const tBody of th.closest('table').tBodies)
				tBody.append(...[...tBody.rows].sort(comparator(index, order)));

			for(const cell of th.parentNode.cells)
				cell.classList.toggle('sorted', cell === th);
			}
	};
	
	document.querySelectorAll('.table_sort thead').forEach(tableTH => tableTH.addEventListener('click', () => getSort(event)));


	var tables = jQuery('.t1 table').wrap("<div class='table'></div>");


	jQuery('.t1 a img').each(function(index, el) {
		var a   = jQuery(this).parents('a'),
				src = jQuery(this).attr('src') ? jQuery(this).attr('src') : null;

		if (!a[0].getAttribute('target') || a[0].classList.contains('vce-single-image-inner')) {
			a.attr('href', 'javascript:;')
			a.attr('data-src', src);
			a.attr('data-fancybox', '')
		}
	});

	var wpcf7 = jQuery('.wpcf7');

	wpcf7.each(function(index, el) {
		var form = jQuery(this);
		var btn  = form.find('button.btn');

		form.on('wpcf7mailsent', (event)=>{
			btn.attr('disabled', 'disabled');
			setTimeout(()=>{
				btn.removeAttr('disabled');
			}, 5000)
		})

	});
	
});