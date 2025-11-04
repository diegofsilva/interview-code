<?php
require_once 'lib.php';

if (!isCLI()) {
  throw new ErrorException('This script can only be run from the command line interface.');
}

if ($argc < 2) {
  throw new ErrorException('This script requires at least one numeric argument.');
}

$inputArray = [];
for ($i = 1; $i < $argc; $i++) {
  if (!is_numeric($argv[1])) {
    throw new ErrorException('The argument must be a number.');
  }
  $inputArray[] = (float)$argv[$i];
}

echo 'Array: ' . implode('; ', $inputArray) . "\n";
echo 'Unique sum: ' . sumUnique($inputArray) . "\n";
