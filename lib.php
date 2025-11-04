<?php

function fibo(int $iterations, int $batchSize = 20): Generator {
  $results = [0, 1];
  $resultsBatch = [];
  for ($i = 0; $i < $iterations; $i++) {
    $resultsBatch[] = $results[0] + $results[1];
    $results[0] = $results[1];
    $results[1] = $resultsBatch[count($resultsBatch) - 1];
    if (count($resultsBatch) === $batchSize) {
      yield $resultsBatch;
      $resultsBatch = [];
    }
  }
  if (count($resultsBatch)) {
    yield $resultsBatch;
  }
}

function flipArray(array &$inputArray): void {
  $inputArrayLength = count($inputArray);
  if ($inputArrayLength < 2) {
    return;
  }
  $aux = 0;
  $arrayHalfLength = floor($inputArrayLength / 2);
  for ($i = 0; $i <  $arrayHalfLength; $i++) {
    $aux = $inputArray[$i];
    $inputArray[$i] = $inputArray[$inputArrayLength - $i - 1];
    $inputArray[$inputArrayLength - $i - 1] = $aux;
  }
}

function sumUnique(array &$inputArray): int {
  $itemsRepeated = [];
  for ($i = 0; $i < count($inputArray); $i++) {
    $itemsRepeated[$inputArray[$i]] = isset($itemsRepeated[$inputArray[$i]]);
  }
  $uniqueSum = 0;
  foreach ($itemsRepeated as $key => $repeated) {
    if (!$repeated) {
      $uniqueSum += $key;
    }
  }
  return $uniqueSum;
}

function isCLI(): bool {
  return strpos(php_sapi_name(), 'cli') === 0;
}
