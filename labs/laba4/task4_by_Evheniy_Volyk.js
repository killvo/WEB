var A = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
var B = [10, 20, 30, 40, 50, 60, 70, 80, 90, 100];
var C = [];

for (var i = 0; i < A.length; i++) {
	if(A[i] == B[i]){
		C[i] = 1;
	}
	else (A[i] != B[i]) {
		C[i] = 1 / (A[i] - B[i]);
	}
}

