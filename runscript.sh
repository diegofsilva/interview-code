#!/bin/bash
while getopts "f:" opt
do
  case "$opt" in
    h)
      echo "-h         show this help"
      echo "-f         file name to run"
      exit 0;;
    f)
      filepath="$OPTARG";;
    ?)
      exit 1;;
    *)
      exit 1;;
  esac
done

filename=$(basename -- "$filepath")
extension="${filename##*.}"

if [ "$extension" = "js" ]; then
  dockerimage="node:20-alpine"
  command="node"
elif [ "$extension" = "php" ]; then
  dockerimage="php:8.2-cli"
  command="php"
else
  echo "Unsupported file extension: $extension"
  exit 1
fi

docker run -it --rm --name myscript -v "$PWD":/usr/code -w /usr/code --pull missing "$dockerimage" "$command" "$filename"
