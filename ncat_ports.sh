#!/bin/bash
#### This script allows you to Specify a range of ports for ncat to listen to 
if [ $# -ne 2 ]; then
    echo 1>&2 "Usage: $0 Start-Port End-Port Interface"
    exit 127
fi

if [ $2 -lt $1 ]; then
    echo 1>&2 "The Start-Port must be less than the End-Port!"
    exit 127
fi

Start=$1
  #echo "Start = $Start"
End=$2
  #echo "End = $End"

while [ "$Start" -le "$End" ]; do
  `ncat -kl -vvv -p $Start >> /var/log/ncat.log & `
  (( Start++ ))
done 
   
echo "\n"
exit
