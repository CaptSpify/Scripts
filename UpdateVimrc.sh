#!/bin/bash
/bin/cp $HOME/.vimrc $HOME/.zzz.vimrc.old.$(date +%Y_%m_%d_%H:%M:%S)
/usr/bin/wget -O $HOME/.vimrc http://www.thekyel.com/code/vimrc
/bin/chmod 750 $HOME/.vimrc
