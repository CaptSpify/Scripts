#!/bin/bash
#### Download Update Files
echo -e "Downloading UpdateFiles!\n"
/bin/su -c "/usr/bin/wget -T 10 -O /usr/bin/UpdateVim http://thekyel.com/code/UpdateVimrc.sh  && /bin/chmod +x /usr/bin/UpdateVim && /usr/bin/wget -T 10 -O /usr/bin/UpdateBash http://thekyel.com/code/UpdateBashrc.sh && /bin/chmod +x /usr/bin/UpdateBash" root
echo -e "Downloaded UpdateFiles----Success!\n\n\n"

#### Vim
echo -e "Downloading Vim Config!\n"
/bin/cp $HOME/.vimrc $HOME/.vimrc.old.$(date +%Y_%m_%d_%H:%M:%S)
/usr/bin/wget -T 10 -O $HOME/.vimrc 'http://thekyel.com/code/vimrc'
/bin/chmod 750 $HOME/.vimrc
echo -e "Downloaded Vim Config----Success!\n\n\n"

#### Bash
echo -e "Downloading UpdateBash!\n"
/bin/cp $HOME/.bashrc $HOME/.bashrc.old.$(date +%Y_%m_%d_%H:%M:%S)
/usr/bin/wget -T 10 -O $HOME/.bashrc 'http://thekyel.com/code/bashrc'
/bin/chmod +x $HOME/.bashrc
echo -e "Downloaded UpdateBash----Success!\n\n\n"
source $HOME/.bashrc
