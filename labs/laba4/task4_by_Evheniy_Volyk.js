var A = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
var B = [10, 20, 30, 40, 50, 60, 70, 80, 90, 100];
var C = [];

for (var i = 0; i < A.length; i++) {
	if(A[i] == B[i]){
		C[i] = 1;
	}
	else {
		C[i] = 1 / (A[i] - B[i]);
	}
}
alert(C);

var temp = C[0];
C[0] = C[9];
C[9] = temp;


alert(C);

function bubbleSort(C) {
	for(var i = C.length -1; i > 0; i--) {
		var counter = 0;
		for(var j = 0; j < i; j++) {
			if(C[j] > C[j+1]) {
			var tmp = C[j];
			C[j] = C[j+1];
			C[j+1] = tmp;

		}
	}
	if(counter == 0){
		break;
	}	
		
	}
}
