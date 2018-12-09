<?php
  
  header('Content-Type: application/json');
  
  $url_host = 'http://192.168.2.129:9000';
  
  if(isset($_GET["mode"])){
    $url_path = "/Calefaccion/GetConsignaMode";
  } elseif (isset($_GET["fulldata"])){
    $url_path = "/Calefaccion/GetRoomListTreeTemps";
  } else {
  
    $url_path = "/Calefaccion/GetConsignas";
  }

  $url = $url_host.$url_path;

  $ch=curl_init();
  $timeout=1;

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);

  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

  $result=curl_exec($ch);
  curl_close($ch);
  
  if(isset($_GET["mode"])){
    echo $result;
  } elseif (isset($_GET["fulldata"])){
    echo $result;
  } else {  
  
    $resultParsed=json_decode($result);

    $TempConsigna=[];
    $TempConsigna[0]=$resultParsed[0];
    $TempConsigna[1]=number_format($resultParsed[1], 1, '.', '');
    $TempConsigna[2]=number_format($resultParsed[2], 1, '.', '');
    $TempConsigna[3]=number_format($resultParsed[3], 1, '.', '');
    $TempConsigna[4]=number_format($resultParsed[4], 1, '.', '');
    $TempConsigna[5]=number_format($resultParsed[5], 1, '.', '');
    $TempConsigna[6]=number_format($resultParsed[6], 1, '.', '');

    echo json_encode($TempConsigna);
  }
  /*
  
  
  $fileRoot="/home/sergio/Domotica/CONFIG/";
  $filename=$fileRoot."Temp_Consigna";
  $fileTemp= file($filename);
  $TempConsigna=[];
  $TempConsignaDiff=[];  
  $hour=(int)date("H");
  $dayWeek=date("l");
  $currentDate = strtotime(date("Y-m-d"));
  
  if ($dayWeek=="Monday") {
    $dayLetter="L";
  } elseif ($dayWeek=="Tuesday") {
    $dayLetter="M";
  } elseif ($dayWeek=="Wednesday") {
    $dayLetter="X";
  } elseif ($dayWeek=="Thursday") {
    $dayLetter="J";
  } elseif ($dayWeek=="Friday") {
    $dayLetter="V";
  } elseif ($dayWeek=="Saturday") {
    $dayLetter="S";
  } elseif ($dayWeek=="Sunday") {
    $dayLetter="D";
  }

  # Primero el modo de operacion
  $line= $fileTemp[0];
  $wordsLine=explode(' ', $line);
  $opmode=$wordsLine[0];  
  
  # Luego los prog default
  $line= $fileTemp[2];
  $wordsLine=explode(' ', $line);
  $TempConsignaDiff[1]=number_format((float)$wordsLine[1], 1, '.', '');
  $TempConsignaDiff[2]=number_format((float)$wordsLine[2], 1, '.', '');
  $TempConsignaDiff[3]=number_format((float)$wordsLine[3], 1, '.', '');
  $TempConsignaDiff[4]=number_format((float)$wordsLine[4], 1, '.', '');
  $TempConsignaDiff[5]=number_format((float)$wordsLine[5], 1, '.', '');

  if ($opmode=="Prog") {
    $TempConsigna[0]=number_format((float)$wordsLine[0], 1, '.', '');
  } 
  if ($opmode=="Man") {
    $wordsLineMan=explode(' ', $fileTemp[1]);
    $TempConsigna[0]=$wordsLineMan[0];
  }
  if ($opmode=="Off"){
    $TempConsigna[0]="0.0";
  }
  
  #Ahora los de dia de semana
  $nLine=3;
  $line=$fileTemp[$nLine];
  $dates=substr($line,0,3);

  while ($dates=="X-X" and $opmode=="Prog") {
    $wordsLine=explode(' ', $line);
    $weekdays=$wordsLine[1];
    if (strpos ($weekdays, $dayLetter)>-1){
      $nWord=2;
      while ($wordsLine[$nWord]){
        $hoursInit=(int)substr($wordsLine[$nWord],0,2);
        $hoursEnd=(int)substr($wordsLine[$nWord],3,2);
        if ($hour>=$hoursInit and $hour<=$hoursEnd){
          $TempConsigna[0]=number_format((float)$wordsLine[$nWord+1], 1, '.', '');
        }
        $nWord=$nWord+2;
      }
    }
    $nLine=$nLine+1;
    $line=$fileTemp[$nLine];
    $dates=substr($line,0,3);  
  }
  
  while ($fileTemp[$nLine] and $opmode=="Prog") {
    $wordsLine=explode(' ', $line);
    $dateDays=$wordsLine[0];
    $dateInit=strtotime(substr($dateDays,0,4)."/".substr($dateDays,4,2)."/".substr($dateDays,6,2));
    $dateEnd=strtotime(substr($dateDays,9,4)."/".substr($dateDays,13,2)."/".substr($dateDays,15,2));
    if ($currentDate>=$dateInit and $currentDate<=$dateEnd) {
      $weekdays=$wordsLine[1];
      if (strpos ($weekdays, $dayLetter)>-1){
        $nWord=2;
        while ($wordsLine[$nWord]){
          $hoursInit=(int)substr($wordsLine[$nWord],0,2);
          $hoursEnd=(int)substr($wordsLine[$nWord],3,2);
          if ($hour>=$hoursInit and $hour<=$hoursEnd){
            $TempConsigna[0]=number_format((float)$wordsLine[$nWord+1], 1, '.', '');
          }
          $nWord=$nWord+2;
        }
      }
    }
    $nLine=$nLine+1;
    $line=$fileTemp[$nLine];
  }
  
  $TempConsigna[1]=number_format((float)$TempConsigna[0]+$TempConsignaDiff[1], 1, '.', '');
  $TempConsigna[2]=number_format((float)$TempConsigna[0]+$TempConsignaDiff[2], 1, '.', '');
  $TempConsigna[3]=number_format((float)$TempConsigna[0]+$TempConsignaDiff[3], 1, '.', '');
  $TempConsigna[4]=number_format((float)$TempConsigna[0]+$TempConsignaDiff[4], 1, '.', '');
  $TempConsigna[5]=number_format((float)$TempConsigna[0]+$TempConsignaDiff[5], 1, '.', '');
  $TempConsigna[6]=$opmode;
  

  echo json_encode($TempConsigna);
  
  */

?>
