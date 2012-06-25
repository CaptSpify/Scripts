<?php
#This test will go out and see if the defined port is open.

if(is_null($argv[2]))
  {
    echo "Usage: $argv[0] Server Port\n";
      //echo "argv[2] = ".$argv[2]."\n";
    return;
  }else{
    $Server = $argv[1];
    $Port = $argv[2];
    $Hit = fsockopen($Server,$Port);
    if(!$Hit)
      {
        echo "Port $Port closed\n";
        exit();
      }else{
        echo "Port $Port open\n";
        exit();
      }
  }
?>
