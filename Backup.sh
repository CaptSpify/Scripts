#!/bin/bash
###Script to backup files. Adds datestamp to the end
###Variables
datestamp=$(date +%Y_%m_%d_%H_%M_%S)
newfile=.zzz.$1_BK_$datestamp
###Functions
function quit {
        exit
}
function backup {
        cp -rv $1 $newfile
}
###Running the script
backup $1
quit
