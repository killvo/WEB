let A = [10, 2, 3, 40, 5, 6, 7, 8, 9, 10];
let B = [10, 20, 30, 40, 50, 60, 70, 80, 90, 100];
let C = [];
function arrayC() {
	for (let i = 0; i < A.length; i++) {
		if(A[i] === B[i]){
			C[i] = 1;
		}
		else {
			C[i] = 1 / (A[i] - B[i]);
		}
	}
}
function change() {
	let temp = C[0];
	C[0] = C[9];
	C[9] = temp;
}
function bubbleSort() {
	for (let i = C.length - 1; i > 0; i--) {
		let counter = 0;
		for (let j = 0; j < i; j++) {
			if (C[j] > C[j + 1]) {
				let tmp = C[j];
				C[j] = C[j + 1];
				C[j + 1] = tmp;
			}
		}
		if (counter === 0) {
			break;
		}
	}
}
function test2() {
	console.log("Масив А: " + A);
	console.log("Масив B: " + B);
	arrayC();
	console.log("Масив C: " + C);
	change();
	console.log("Масив C із заміненими елементами: " + C);
	bubbleSort();
	console.log("Відсортований масив C: " + C);
}
