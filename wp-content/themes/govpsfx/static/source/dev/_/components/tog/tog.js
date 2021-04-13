class Tog {
	constructor(){
		var togs = document.querySelectorAll('.tog');
		togs.forEach((tog)=>{
			var head = tog.querySelector('.tog-head'),
					body = jQuery(tog.querySelector('.tog-body'));

			if (tog.classList.contains('--show')) {
				body.slideDown(300)
			}

			head.addEventListener('click', ()=>{
				if (!tog.classList.contains('--show')){
					tog.classList.add('--show');
					body.slideDown(300)
				} else{
					tog.classList.remove('--show');
					body.slideUp(300)
				}
			})
		})
	}
}

new Tog();