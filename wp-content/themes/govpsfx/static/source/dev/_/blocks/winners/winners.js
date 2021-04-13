
document.addEventListener('DOMContentLoaded', ()=>{
	var winners = {
		content: document.querySelector('.winners__content-wrap'),
		persons: document.querySelector('.winners__persons')
	} 

	if (winners.content && winners.persons) {
		var content = new Swiper(winners.content, {
			slidesPerView: 1,
			loop: true,
			effect: 'fade',
			loopAdditionalSlides: 5,
			autoHeight: true,
			watchSlidesVisibility: true,
      watchSlidesProgress: true,
		});
		var persons = new Swiper(winners.persons, {
			slidesPerView: 'auto',
			spaceBetween: 70,
			centeredSlides: true,
			loop: true,
			loopAdditionalSlides: 5,
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			thumbs: {
        swiper: content
      }
		}); 
	}
		
});