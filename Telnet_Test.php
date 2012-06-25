<?php
# This will telnet to the provided server and the provided command
if(is_null($argv[4]))
  {
    echo "Usage: $argv[0] IP Username Password Command\n";
    return;
  }

$Telnet_Header = chr(0xFF).chr(0xFB).chr(0x1F).chr(0xFF).chr(0xFB).chr(0x20).chr(0xFF).chr(0xFB).chr(0x18).chr(0xFF).chr(0xFB).chr(0x27).chr(0xFF).chr(0xFD).chr(0x01).chr(0xFF).chr(0xFB).chr(0x03).chr(0xFF).chr(0xFD).chr(0x03).chr(0xFF).chr(0xFC).chr(0x23).chr(0xFF).chr(0xFC).chr(0x24).chr(0xFF).chr(0xFA).chr(0x1F).chr(0x00).chr(0x50).chr(0x00).chr(0x18).chr(0xFF).chr(0xF0).chr(0xFF).chr(0xFA).chr(0x20).chr(0x00).chr(0x33).chr(0x38).chr(0x34).chr(0x30).chr(0x30).chr(0x2C).chr(0x33).chr(0x38).chr(0x34).chr(0x30).chr(0x30).chr(0xFF).chr(0xF0).chr(0xFF).chr(0xFA).chr(0x27).chr(0x00).chr(0xFF).chr(0xF0).chr(0xFF).chr(0xFA).chr(0x18).chr(0x00).chr(0x58).chr(0x54).chr(0x45).chr(0x52).chr(0x4D).chr(0xFF).chr(0xF0);

$Telnet_Header2 = chr(0xFF).chr(0xFC).chr(0x01).chr(0xFF).chr(0xFC).chr(0x22).chr(0xFF).chr(0xFE).chr(0x05).chr(0xFF).chr(0xFC).chr(0x21);

$Port = 23;

$Conn = fsockopen($argv[1], $Port);

echo "Connected\n";

echo "Sending the Header\n";
fputs($Conn,$Telnet_Header);
sleep(1);
echo "Sending the Header2\n";
fputs($Conn,$Telnet_Header2);
sleep(1);

echo "Sending the Username\n";
fputs($Conn,$argv[2]."\r");
sleep(5);
echo "Sending the Password\n";
fputs($Conn,$argv[3]."\r");
sleep(5);

fputs($Conn,$argv[4]."\r");
sleep(5);

do
{
    $output.=fread($Conn, 1000);    // read line by line, or at least small chunks
    $stat=socket_get_status($Conn);
}
while($stat["unread_bytes"]);

#$output = str_replace("\n", "<br>", $output);
$output=preg_replace("/^.*?\n(.*)\n[^\n]*$/","$1",$output);
echo $output;
?>
