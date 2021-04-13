class IncDec {
	static Plus(el) {
		var value = Number(el.value);
		console.log(value);
		if (value < 999) {
			el.value = value + 1;
		}
	}
	static Minus(el) {
		var value = Number(el.value);
		console.log(value);
		if (value > 1) {
			el.value = value - 1;
		}
	}
	constructor(el){
		var btn = {
			prev: el.previousSibling,
			next: el.nextSibling
		}

		if (btn.prev) {
			btn.prev.addEventListener('click', ()=>{
				IncDec.Plus(el);
			})
		}
		if (btn.next) {
			btn.next.addEventListener('click', ()=>{
				IncDec.Minus(el);
			})
		}
		el.addEventListener('input', (event)=>{
			if (el.value.length > 3) {
				return false;
			}
			el.value = el.value.replace(/[^0-9]/, '')
		})
	}
}

var incdecs = document.querySelectorAll('.incdec__input');
if (incdecs) {
	incdecs.forEach((incdec)=>{
		new IncDec(incdec);
	})
}