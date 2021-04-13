document.addEventListener('DOMContentLoaded', ()=>{
	var logosList = new Swiper('.logo-list__slider', {
		slidesPerView: 3,
		slidesPerGroup: 1,
		spaceBetween: 30,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},
		responsive: {
			320: {
				slidesPerView: 1,
			},
			767: {
				slidesPerView: 3,
			}
		}
	}); 
});