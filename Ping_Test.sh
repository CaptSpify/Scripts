#!/bin/bash
count=$(ping -c 5 $1 | grep 'received' | awk -F',' '{ print $2 }' | awk '{ print $1 }')
if [ $count = 5 ]
  then
    echo "Connection good. Pinged $1 5 times"
  else
    echo "Connection not good. Pinged $count times"
fi
