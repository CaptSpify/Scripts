#!/bin/bash
/bin/cp $HOME/.bashrc $HOME/.zzz.bashrc.old.$(date +%Y_%m_%d_%H:%M:%S)
/usr/bin/wget -O $HOME/.bashrc http://www.thekyel.com/code/bashrc
/bin/chmod +x $HOME/.bashrc
