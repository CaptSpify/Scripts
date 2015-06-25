#!/bin/bash
# Allows you to permanantly save up to 10 buffers, without overwriting your normal yank buffers
# To use: You can either run this from the command-line directly, or bind it. I bind it with:
# bind-key -n "M-B" run-shell -b "/usr/bin/tmux-permabuffer.sh"
# You'll need to make sure you have something in all of your current buffers, and something in your permanant buffers (${HOME}/.tmux.permabuffer1, ${HOME}/.${user}.tmux.permabuffer2, etc et)

user=$(whoami)
oldbuffer="${HOME}/.tmux.old.buffer"
permabuffer="${HOME}/.tmux.permabuffer"
lockfile="${HOME}/.tmux.lock"

for buffer in $(seq 0 9); 
do
  # Make sure everything is in place
  tmux list-buffers | grep -E "^${buffer}:" >/dev/null 2>&1
  if [ ! $? -eq 0 ] 
  then
    echo "need moar buffer: ${buffer}"
    exit 1
  fi

  touch "${oldbuffer}.${buffer}"
  touch "${permabuffer}.${buffer}"
  
  # Now take it all apart
  echo -n > "${oldbuffer}.${buffer}"
  tmux save-buffer -b "${buffer}" "${oldbuffer}.${buffer}"
  tmux load-buffer -b "${buffer}" "${permabuffer}.${buffer}"
done

# Lock everything, otherwise it just goes right on past this part while your choosing a buffer
touch "${lockfile}"
# Paste the buffer and unlock
tmux choose-buffer "paste-buffer -b '%%' ; run-shell \"rm ${lockfile}\""

# wait for the buffer to be chosen
while [ -f "${lockfile}" ];
do
    sleep 1
done

# and put everything back
for buffer in $(seq 0 9); 
do
  tmux load-buffer -b "${buffer}" "${oldbuffer}.${buffer}"
done
