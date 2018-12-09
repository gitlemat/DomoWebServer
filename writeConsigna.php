<?php

  # NO FUNCIONA!!!!!!
  # SOLO LO LLAMA PROGRAM!!!!!!!!!!!!!
  # Este sirve para escribir toda la consigna, y respeta el de manual
  
  
  $fileRoot="/home/sergio/Domotica/CONFIG/";
  $filename=$fileRoot."Temp_Consigna";  
  $fileTemp= file($filename);
  
  $filedest=[];
  $filedest[0]= "Prog # Off/Man/Prog";
  $filedest[1]=substr($fileTemp[1],0,-1);
  $request_body = file_get_contents('php://input');
  $dataJSON = json_decode($request_body); 
  
  $pos = strpos($fileTemp[2],' ');
  $xdata=$dataJSON[0].substr($fileTemp[2],$pos,-1);
  $filedest[2]=$xdata;
  
  $nLine=3;
  $nJSON=1;

  while ($dataJSON[$nJSON]) {
    $filedest[$nLine]=$dataJSON[$nJSON];
    $nLine++;
    $nJSON++;
  }
  $filedest[$nLine-1]=$filedest[$nLine-1]."\n";
  
  file_put_contents($filename, implode("\n",$filedest));

?>
