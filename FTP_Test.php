<?php
# This script will try to log into a server with the supplied FTP credentials.
# If Up/Down & filename are supplied, then it will attempt to Upload/Download the file.

if(is_null($argv[3]))
  {
    echo "Usage: $argv[0] Server Username Password [Up/Down Filename]\n";
    return;
  }else{
if(strtoupper($argv[4]) == 'UP' || strtoupper($argv[4]) == 'DOWN')
  {
    if(is_null($argv[5]))
      {
        echo "Missing Filename\n";
        echo "Usage: $argv[0] IP Username Password [Up/Down Filename]\n";
        return;
      }else{
        $Move = $argv[4];
        $File = $argv[5];
      }
  }
  $IP = $argv[1];
  $Username = $argv[2];
  $Password = $argv[3];

  $FTP = ftp_connect($IP);
  if($FTP)
    {
      echo "Connected to the Server\n";
    }else{
      echo "Could not connect to the Server\n";
    }
  $Login = ftp_login($FTP,$Username,$Password);
  if(!$Login)
    {
      echo "Login Failed!\n";
    }else{
      echo "Login Success!\n";
    }

  if(!is_null($File))
  {
    if(!is_null($Move))
      {
        echo "We're going to move ".$File."\n";
        if (strtoupper($Move) == 'UP')
          {
            echo "Attempting to upload ".$File."\n";
            if(!$Move = FTP_Put($FTP,$File,$File,FTP_BINARY))
              {
                echo "Can't Push ".$File."\n";
              }
          }elseif(strtoupper($Move) == 'DOWN')
          {
            echo "Attempting to download ".$File."\n";
            if(!$Move = FTP_Get($FTP,$File,$File,FTP_BINARY))
              {
                echo "Can't Pull ".$File."\n";
              }
          }else{
            echo "Couldn't find which direction we're going to move\n";
            echo "Move = ".$Move."\n";
            echo "strtoupper(Move) = ".strtoupper($Move)."\n";
            echo "File = ".$File."\n";
          }
      }else{
        echo "Not Moving any Files\n";
      }
  }
}
?>
