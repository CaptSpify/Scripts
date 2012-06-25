#!/bin/bash
### Script Name: TelAndRun.sh
### This script telnet's into an IP, runs a command, and then exits. 
### It uses nc (NetCat). 
### It does NOT allow for Usernames/Passwords. I plan on implementing that later.
if [ $# -ne 2 ]; then
    echo 1>&2 "Usage: $0 IP-Address Command"
    exit 127
fi

(sleep 1;echo "$2";echo "exit") | /usr/bin/nc -q 0 -t $1 23
echo "\n"
