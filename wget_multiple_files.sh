#!/bin/bash
if [ $# -ne 1 ]; then
    echo 1>&2 "Usage: $0 parent-directory"
    exit 127
fi

for FILE in "$@" ; do
wget "$FILE"
done
