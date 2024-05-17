window.onload = () => {
	document.querySelectorAll(".page-numbers").forEach((elem) => {
		elem.onclick = (e) => {
			e.preventDefault(); // annule le comportement par défaut

			const current = Number(
				document.querySelector(".page-numbers.current").innerHTML
			);
			var target;
			if (elem.classList.contains("next")) {
				target = current + 1;
			} else if (elem.classList.contains("prev")) {
				target = current - 1;
			} else {
				target = Number(elem.innerHTML);
			}
			fetchPage(target);
		};
	});
};

function fetchPage(page) {
	// fetch vers l'url admin-ajax...// avec des param GET action et page
	fetch(esgi.ajaxURL + "?action=load_posts&page=" + page).then((response) => {
		response.text().then((text) => {
			console.log(text);
		});
	});
}
