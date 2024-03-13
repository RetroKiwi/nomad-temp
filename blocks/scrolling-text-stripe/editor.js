function thisDoesntWorkCurrently() {
	debugger;
	alert("I'm being called from scrolling-text-stripe script.");
	console.log("I'm wish I was getting called...");
}

window.addEventListener('load', thisDoesntWorkCurrently);