<?php
require_once 'lib.php';

if (!isCLI()) {
  throw new ErrorException('This script can only be run from the command line interface.');
}

if ($argc < 2) {
  throw new ErrorException('This script requires an argument of type integer.');
}

if (!is_numeric($argv[1])) {
  throw new ErrorException('The argument must be a number.');
}

foreach (fibo((int)$argv[1]) as $fiboResults) {
  echo implode("\n", $fiboResults) . "\n";
}
