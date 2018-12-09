<?php
  # Este solo escribe el modo/offset/consignamanual
  
  # Modos 'Off/Man/Prog': Define el modo de operacion
  #     writeConsignaMode.php?mode=prog
  # Modo 'room': Define el offset de consigna para esa habitacion.
  #     writeConsignaMode.php?mode=room&room=1&temp=0.5
  # Modo 'consignamanual': Define la consigna manual
  #     writeConsignaMode.php?mode=consignamanual&temp=22
  
  
  
  # /Calefaccion/SetTempManual?Temp=22.5
  # /Calefaccion/SetOffsetRoom?Room=2&Temp=0.5
  # /Calefaccion/SetOpMode?Mode=Prog
  
  $opmode=$_GET["mode"];
  
  header('Content-Type: application/json');
  
  $url_host = 'http://192.168.2.129:9000';
  $url_path1 = "/Calefaccion/SetTempManual?";
  $url_path2 = "/Calefaccion/SetOffsetRoom?";
  $url_path3 = "/Calefaccion/SetOpMode?";
  
  if ($opmode=="room"){
    $room=$_GET["room"];
    $temp=$_GET["temp"];
    if ($room=="Despacho"){
      $roomNum=1;
    } elseif ($room=="Cocina"){
      $roomNum=2;
    } elseif ($room=="Principal"){
      $roomNum=3;
    } elseif ($room=="Sofia"){
      $roomNum=4;
    } elseif ($room=="Alvaro"){
      $roomNum=5;
    }
    $url_path=$url_path2;
    $url_param="Room=".$roomNum."&Temp=".$temp;

  } elseif ($opmode=="consignamanual"){
    $temp=$_GET["temp"];
    $url_path=$url_path1;
    $url_param="Temp=".$temp;
  } else {
    $url_path=$url_path3;
    $url_param="Mode=".$opmode;
  }
  
  $url = $url_host.$url_path.$url_param;
  $ch=curl_init();
  $timeout=1;

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);

  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

  $result=curl_exec($ch);
  curl_close($ch);
  
  /*

  $fileRoot="/home/sergio/Domotica/CONFIG/";
  $filename=$fileRoot."Temp_Consigna";  
  $fileTemp= file($filename);

  if ($opmode=="room"){
    $room=$_GET["room"];
    $temp=$_GET["temp"];
    $roomcosignas=explode(' ', $fileTemp[2]);
    if ($room=="Despacho"){
      $roomNum=1;
    } elseif ($room=="Cocina"){
      $roomNum=2;
    } elseif ($room=="Principal"){
      $roomNum=3;
    } elseif ($room=="Sofia"){
      $roomNum=4;
    } elseif ($room=="Alvaro"){
      $roomNum=5;
    }
    $roomcosignas[$roomNum]=$temp;
    $fileTemp[2]=implode(' ',$roomcosignas);
  } elseif ($opmode=="consignamanual"){
    $temp=$_GET["temp"];
    $fileTemp[1]=$temp." null\n";
  } else {
    $fileTemp[0]=$opmode." # Off/Man/Prog\n";
  }
  file_put_contents($filename, $fileTemp);
*/
?>
