<?php

  # Este sirve para escribir toda la consigna, y respeta el de manual
  $roomNum=$_GET["roomNum"];
  $mode=$_GET["mode"];
  $dateOn=$_GET["dateOn"];
  $dateOff=$_GET["dateOff"];
  $timeOn=$_GET["timeOn"];
  $timeOff=$_GET["timeOff"];

  $fileRoot="/home/sergio/Domotica/CONFIG/";
  $filename=$fileRoot."AirzoneTimer";  
  $fileTemp= file($filename);
  
  $line= trim($fileTemp[$roomNum]);  //El trim elimina el \n
  
  if ($mode == "read") {
  
     $wordsLine=explode(',', $line);
     echo json_encode($wordsLine);
     exit();
  }
  
  
  $fileTemp[$roomNum]=$mode.",".$dateOn.",".$timeOn.",".$dateOff.",".$timeOff."\n";
  
  $fileTemp2=implode("",$fileTemp);
    
  file_put_contents($filename, $fileTemp2);

?>
