document.addEventListener('DOMContentLoaded', ()=>{
	var ping = {
		items: document.querySelectorAll('.ping__select .select__item'),
		value: {
			1: document.getElementById('ping-value-1'),
			2: document.getElementById('ping-value-2'),
			3: document.getElementById('ping-value-3'),
		},
		wrap: document.querySelector('.ping__wrap'),
		table: document.querySelector('.ping__table'),
		load: document.querySelector('.ping__load'),
	}
	if (ping.items) {
		ping.items.forEach((item)=>{
			item.addEventListener('click', ()=>{
				ping.wrap.classList.add('--show');

				ping.table.classList.remove('--show');
				ping.load.classList.add('--show');
				setTimeout(()=>{
					ping.table.classList.add('--show');
					ping.load.classList.remove('--show');
				}, 1000);
				ping.value['1'].innerText = item.getAttribute('data-ping-1');
				ping.value['2'].innerText = item.getAttribute('data-ping-2');
				ping.value['3'].innerText = item.getAttribute('data-ping-3');
			});
			
		})
	}
})