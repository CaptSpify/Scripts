#!/bin/bash
TMPFILE=/tmp/tmp.$$

for f in *.ini; do
  sed "s/old text/new text/" $f > $TMPFILE
  #exit 1     # DEBUG
  mv $TMPFILE $f
done

