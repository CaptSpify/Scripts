#!/bin/bash
if [ $# -ne 4 ]; then
    echo 1>&2 "Usage: $0 [start|stop] ipaddress Incoming-Port Outgoing-Port"
    exit 127
fi

function getIP()
{
	LocalIP=`/sbin/ifconfig  | grep 'inet addr:'| grep -v '127.0.0.1' |
cut -d: -f2 | awk '{print $1}'`;
}

getIP LocalIP

#echo "Local IP = $LocalIP"

case "$1" in
'stop') # Stop the redirect
    /usr/sbin/iptables -t nat -D PREROUTING -p tcp -d $LocalIP --dport $3 -j DNAT --to $2:$4
    /usr/sbin/iptables -t nat -D POSTROUTING -p tcp -d $2 --dport $4 -j SNAT --to $LocalIP
    echo Stopped $2
    ;;

'start') # Start the redirect
    /usr/sbin/iptables -t nat -A PREROUTING -p tcp -d $LocalIP --dport $3 -j DNAT --to $2:$4
    /usr/sbin/iptables -t nat -A POSTROUTING -p tcp -d $2 --dport $4 -j SNAT --to $LocalIP
    echo Started $2
    ;;

*) # default
    echo I did not understand the last command.
esac
