#!/bin/bash
while getopts ":f:p:h" opt
do
  case "$opt" in
    h)
      echo "Description: Runs a JavaScript or PHP file inside a Docker container."
      echo "-h         Shows this help."
      echo "-f         Specifies the script filename to run."
      echo "-p         Specifies the parameters to pass to the script. Use quotes to send several parameters."\
        "Each parameter must be separated by a space."\
        "Using several -p options will cause to disregard all but the last one."
      exit 0;;
    p)
      scriptParams="$OPTARG";;
    f)
      scriptFilepath="$OPTARG";;
    ?)
      echo "Invalid option: -$OPTARG"
      exit 1;;
  esac
done

if [ -z "$scriptFilepath" ]; then
  echo "Script file required. Use -f to specify the file."
  exit 1
fi

if [ ! -f "$scriptFilepath" ]; then
  echo "File not found: $scriptFilepath"
  exit 1
fi

scriptFilename=$(basename -- "$scriptFilepath")
scriptExtension="${scriptFilename##*.}"

if [ "$scriptExtension" = "js" ]; then
  dockerimage="node:20-alpine"
  command="node"
elif [ "$scriptExtension" = "php" ]; then
  dockerimage="php:8.2-cli"
  command="php"
else
  echo "Unsupported file extension: $scriptExtension"
  exit 1
fi

docker run -it --rm --name myscript -v "$PWD":/usr/code -w /usr/code --pull missing $dockerimage $command $scriptFilename $scriptParams
