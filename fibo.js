const { fibo } = require('./lib.js');

if (process.argv.length < 3) {
  throw new Error('This script requires an argument of type integer.');
}

if (isNaN(process.argv[2])) {
  throw new Error('The argument must be a number.');
}

for (const fiboResults of fibo(Math.trunc(Number(process.argv[2])))) {
  console.log(fiboResults.join('\n'));
}
