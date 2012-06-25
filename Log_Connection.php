<?php
# This logs a connection success/failure in the database defined using the credentials defined.
# If that doesn't work, it will log the error in the defined Error Log.
$Server = '';
$Database = '';
$Username = '';
$Password = '';
$Error_Log = '';
$Table = '';
$Columns = '';

if(is_null($argv[5]))
  {
    echo "Usage: $argv[0] Asset Connection Success Time IP-Address\n";
      //echo "argv[5] = ".$argv[5]."\n";
    return;
  }else{
    //echo "argv[5] = ".$argv[5]."\n";

    if(!mysql_connect($Server,$Username,$Password))
      {
        $tmp = "MySQL".',9,'.date("m/d/y,H:i:s").",Error connecting to mysql.\n";
        error_log($tmp,3,$Error_Log);
        return;
      }else{
        mysql_select_db($Database);
        $Connection_sql = "INSERT INTO $Table($Columns) VALUES('".$argv[1]."',$argv[2],$argv[3],'".$argv[4]."','".$argv[5]."');";
          //echo $Connection_sql."\n";
        mysql_query($Connection_sql);
        mysql_close();
      }
  }
?>
