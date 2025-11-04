const assert = require('node:assert/strict');
const { uniqueSum } = require('./lib.js');

if (process.argv.length < 3) {
  throw new Error('This script requires at least one numeric argument.');
}

const inputArray = [];
for (let i = 2; i < process.argv.length; i++) {
  if (isNaN(process.argv[i])) {
    throw new Error('The argument must be a number.');
  }
  inputArray.push(Number(process.argv[i]));
}

console.log('Array: ' + inputArray.join('; '));
console.log('Unique sum: ' + uniqueSum(inputArray));
