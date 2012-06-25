<?php
# This script will go out and ping an IP address the defined amount of times. When it is done, it will return the results.

if(is_null($argv[2]))
  {
    echo "Usage: $argv[0] IP Count\n";
      echo "argv[2] = ".$argv[2]."\n";
    return;
  }else{
      echo "argv[2] = ".$argv[2]."\n";
  $IP = $argv[1];
  $Count = $argv[2];

  $Ping_cmd = "ping -c ".$Count." ".$IP;
    echo "Ping_cmd = ".$Ping_cmd."\n";
  $Ping_Result = shell_exec($Ping_cmd);
    echo $Ping_Result;

  if(strpos($Ping_Result,$Count." packets transmitted, ".$Count." received, 0% packet loss"))
    {
      echo "Success\n";
    }else{
      echo "Fail\n";
    }
}
?>
