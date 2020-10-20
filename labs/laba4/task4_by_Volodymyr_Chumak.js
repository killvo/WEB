// Функція швидкого сортуванна
function quickSort(arr) {
    if (arr.length < 2) return arr;
    let pivot = arr[0];
    const left = [];
    const right = [];

    for (let i = 1; i < arr.length; i++) {
        if (pivot > arr[i]) {
            left.push(arr[i]);
        } else {
            right.push(arr[i]);
        }
    }
    return quickSort(left).concat(pivot, quickSort(right));
}

function printSum(array) {
    let indexOfMin = array.indexOf(Math.min(...array));
    let indexOfMax = array.indexOf(Math.max(...array));
    let sum = 0;
    if (indexOfMax === indexOfMin) {
        console.log("У масиві лише один елемент");
        return;
    }
    if (indexOfMin < indexOfMax) {
        for (let i = indexOfMin+1; i < indexOfMax; i++) {
            sum += array[i];
        }
    } else {
        for (let i = indexOfMax+1; i < indexOfMin; i++) {
            sum += array[i];
        }
    }
    return sum;
}

function printSorted(array) {
    let sortedArr = quickSort(array);
    console.log("Вхідний масив: " + array);
    console.log("Відсортований масив: " + sortedArr);
}

function test1() {
    let arr1 = [3, 1, 3, 10, 2, 4, 5, 15, 4];
    let arr2 = [20, 2, 4, 5, 1];
    console.log("Масиви:")
    console.log("arr1: " + arr1);
    console.log("arr2: " + arr2);
    console.log("Знайти суму елементів між найменшим та найбільшим елементом масиву: ")
    console.log("Сума для arr1: " + printSum(arr1))
    console.log("Сума для arr2: " + printSum(arr2))
    console.log("Сортування методом швидкого сортування: ")
    printSorted(arr1);
    printSorted(arr2);
}
