#!/bin/bash
while IFS="\n" read line
do
  rm -r "$line"
  echo "$line Removed!"
done < "$1"
echo "Done!"
