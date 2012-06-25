<?php
### This is the master script that will run all of the connection tests and pass the results to the logger
# Vars
$dir = '/srv/http/utils'
$phpbin = '/uisr/bin/php'

if(is_null($argv[3]))
  {
    echo "Usage: $argv[0] Tests('p'=Ping,'t Username Password Command'=Telnet,'F Username Password'=FTP,'P #'=Port Number) Asset Server\n";
    return;
  }else{
      //echo "Port_Arg = ".$Port_Arg."\n";
    $Connection_Type = $argv[1];
        echo "Connection_Type = ".$Connection_Type."\n";

    # Ping Test
    if (strstr($Connection_Type,"p"))
      {
        $Server = $argv[3];
        $Asset = $argv[2];
        $Date = date("Y-m-d-H-i");
          //echo "Ping Called\n";
        $Ping_CMD = "$phpbin $dir/Ping_Test.php ".$Server." 5";
          //echo "Ping_CMD = ".$Ping_CMD."\n";
        $Ping_Result = shell_exec($Ping_CMD);
        if(strstr($Ping_Result,'Success'))
          {
              echo "Ping Success. Logging\n";
            $Ping_Log = "$phpbin $dir/Log_Connection.php '".$Asset."' 0 0 '".$Date."' '".$Server."'";
              echo "Ping_Log = ".$Ping_Log."\n";
            $Ping_Log_Results = shell_exec($Ping_Log);
          }else{
              echo "Ping Failure. Logging\n";
            $Ping_Log = "$phpbin $dir/Log_Connection.php '".$Asset."' 0 1 '".$Date."' '".$Server."'";
              echo "Ping_Log = ".$Ping_Log."\n";
            $Ping_Log_Results = shell_exec($Ping_Log);
          }
      }

    # Port Test
    $Date = date("Y-m-d-H-i");
    if (strstr($Connection_Type,"P"))
      {
        if(is_numeric($argv[2]))
          {
            $Port = $argv[2];
            $Server = $argv[4];
            $Asset = $argv[3];
            $Port_Result = '';
          }else{
            echo "Usage: $argv[0] P Port-Number Asset Server\n";
            return;
          }
            #echo "Port Test Called\n";
          $Port_CMD = "$phpbin $dir/Port_Test.php '".$Server."' ".$Port;
            #echo "Port_CMD = ".$Port_CMD."\n";
          $Port_Result = shell_exec($Port_CMD);
            #echo "Port_Result = ".$Port_Result."\n";
          if (strstr($Port_Result,'Port '.$Port.' open'))
            {
                #echo "Port open. Logging\n";
              $Port_Log = "$phpbin $dir/Log_Connection.php '".$Asset."' 1 0 '".$Date."' '".$Server."'";
                #echo "Port_Log = ".$Port_Log."\n";
              $Port_Log_Results = shell_exec($Port_Log);
            }else
            {
                #echo "Port closed. Logging\n";
              $Port_Log = "$phpbin $dir/Log_Connection.php '".$Asset."' 1 1 '".$Date."' '".$Server."'";
                #echo "Port_Log = ".$Port_Log."\n";
              $Port_Log_Results = shell_exec($Port_Log);
            }
        }

    # Telnet Test
    if (strstr($Connection_Type,"t"))
      {
        $Date = date("Y-m-d-H-i");
          echo "Telnet Test Called\n";
        if(is_null($argv[6]))
          {
            echo "Usage: $argv[0] t Username Password Command Asset Server\n";
            return;
          }else{
            $Username = $argv[2];
            $Password = $argv[3];
            $Command = $argv[4];
            $Asset = $argv[5];
            $Server = $argv[6];
          }
        $Telnet_CMD = "$phpbin $dir/Telnet_Test.php '".$Server."' '".$Username."' '".$Password."' '".$Command."'";
          echo "Telnet_CMD = ".$Telnet_CMD."\n";
        $Telnet_Result = shell_exec($Telnet_CMD);
        if(strstr($Telnet_Result,$Username."@"))
            {
              $Telnet_Log = "$phpbin $dir/Log_Connection.php '".$Asset."' 2 0 '".$Date."' '".$Server."'";
              $Telnet_Log_Results = shell_exec($Telnet_Log);
            }else
            {
              $Telnet_Log = "$phpbin $dir/Log_Connection.php '".$Asset."' 2 1 '".$Date."' '".$Server."'";
              $Telnet_Log_Results = shell_exec($Telnet_Log);
            }
      }

    # FTP Test
    if (strstr($Connection_Type,"F"))
      {
          echo "FTP Test Called\n";
        if (is_null($argv[5]))
          {
            echo "Usage: $argv[0] F Username Password Asset Server\n";
            return;
          }else{
            $Username = $argv[2];
            $Password = $argv[3];
            $Asset = $argv[4];
            $Server = $argv[5];
            $FTP_CMD = "$phpbin $dir/FTP_Test.php '".$Server."' '".$Username."' '".$Password."'";
              echo "FTP_CMD = ".$FTP_CMD."\n";
            $FTP_Result = shell_exec($FTP_CMD);
            if (strstr($FTP_Result,'Success'))
              {
                  echo "FTP Success. Logging\n";
                $FTP_Log = "$phpbin $dir/Log_Connection.php '".$Asset."' 3 0 '".$Date."' '".$Server."'";
                  echo "FTP_Log = ".$FTP_Log."\n";
                $FTP_Log_Results = shell_exec($FTP_Log);
              }else{
                  echo "FTP Failure. Logging\n";
                $FTP_Log = "$phpbin $dir/Log_Connection.php '".$Asset."' 3 1 '".$Date."' '".$Server."'";
                  echo "FTP_Log = ".$FTP_Log."\n";
                $FTP_Log_Results = shell_exec($FTP_Log);
              }
          }
      }
  }
?>
