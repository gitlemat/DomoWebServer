<?php
  $mode=$_GET["mode"];

  //session_write_close(); 
  $output="";
  if ($mode=='getstatedata'){
    $executable="python3 /home/sergio/Domotica/AirzoneAPI.py ".$mode;
    $output = shell_exec($executable);
  } elseif  ($mode=='setzonestate'){
    $nSystemNum=$_GET["nSystemNum"];
    $nZoneNum=$_GET["nZoneNum"];
    $szOption=$_GET["szOption"];
    $nValue=$_GET["nValue"];
    # setzonestate nSystemNum nZoneNum szOption nValue
    $executable="python3 /home/sergio/Domotica/AirzoneAPI.py ".$mode." ".$nSystemNum." ".$nZoneNum." ".$szOption." ".$nValue;
    $output = shell_exec($executable);
  } elseif  ($mode=='setsystemmode'){
    $nSystemNum=$_GET["nSystemNum"];
    $szOption=$_GET["szOption"];
    $nValue=$_GET["nValue"];
    # python3 AirzoneAPI.py setsystemmode nSystemNum szOption nValue
    $executable="python3 /home/sergio/Domotica/AirzoneAPI.py ".$mode." ".$nSystemNum." ".$szOption." ".$nValue;
    $output = shell_exec($executable);
  }
  echo $output;
?>
