document.addEventListener('DOMContentLoaded', ()=>{
	var priceList = new Swiper('.price__slider', {
		slidesPerView: 2,
		spaceBetween: 30,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		pagination: {
			el: '.swiper-pagination',
			type: 'bullets',
			clickable: true,
		},
		breakpoints: {
			320: {
				slidesPerView: 1,
			}, 
			993: {
				slidesPerView: 2,
			}
			
		}
	}); 
});