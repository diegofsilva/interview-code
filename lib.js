function *fibo(iterations, { batchSize = 20 } = {}) {
  const results = [0, 1];
   let resultsBatch = [];
  for (let i = 0; i < iterations; i++) {
    resultsBatch.push(results[0] + results[1]);
    results[0] = results[1];
    results[1] = resultsBatch[resultsBatch.length - 1];
    if (resultsBatch.length === batchSize) {
      yield resultsBatch;
      resultsBatch.splice(0, batchSize);
    }
  }
  if (resultsBatch.length) {
    yield resultsBatch;
  }
}

function uniqueSum(numbersArray) {
  const numbersRepeated = new Map();
  for (const number of numbersArray) {
    numbersRepeated.set(number, numbersRepeated.get(number) !== undefined);
  }
  let uniqueSum = 0;
  for (const [number, repeated] of numbersRepeated.entries()) {
    if (!repeated) {
      uniqueSum += number;
    }
  }
  return uniqueSum;
}

exports.fibo = fibo;
exports.uniqueSum = uniqueSum;
