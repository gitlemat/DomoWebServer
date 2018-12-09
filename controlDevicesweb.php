<?php

# /Device/Config/AddHWDB?HWtype=Domo4ch&Address=192.168.1.165
# /Device/Config/ModifyHWDB?HWtype=Domo4ch&Address=192.168.1.135&mbAddress=9
# /Device/Config/DeleteHWDB?Address=192.168.1.165 

# /Device/Config/AddUsage?devId=TMP554&Address=192.168.1.165&devType=tPersiana&numButton=2&numOutputs=2&pinInput1=0&pinInput2=1&pinOutput1=0&pinOutput2=1&Description=Pruebassss
# /Device/Config/ModifyUsage?devId=TMP554&Address=192.168.1.166&numButton=3&pinInput1=0&pinInput2=2&pinOutput1=0&Description=Pruebassssttt
# /Device/Config/DeleteUsage?devId=TMP554&Address=192.168.1.166

# /Device/Config/AddUsageDB?devId=TMP554&Address=192.168.1.165&nUsage=3&devType=tPersiana&numButton=2&numOutputs=2&pinInput1=0&pinInput2=1&pinOutput1=0&pinOutput2=1&Description=Pruebassss
# /Device/Config/ModifyUsageDB?devId=TMP554&Address=192.168.1.166&numButton=3&pinInput1=0&pinInput2=2&pinOutput1=0&Description=Pruebassssttt
# /Device/Config/DeleteUsageDB?devId=TMP554

# /Device/Config/AddModifyUsageFirmware?Address=192.168.2.167&devId=TMP554&devIdNew=SOAN1devType=tLuz&pinInput1=4&pinInput2=5&pinOutput1=11&pinOutput2=13&Description=Teas%20Test     devID es obligatorio
# /Device/Config/DeleteUsageFirmware?devId=TMP554                                          devID es obligatorio

  $modeget = $_GET["mode"];
  $url_params = $_SERVER['QUERY_STRING'];

  $url_host = 'http://192.168.2.129:9000';
  $url_path = "/";
  
  if ($modeget == 'modifyHW'){
    $url_path='/Device/Config/ModifyHW?';
  }
  
  if ($modeget == 'deleteHW'){
    $url_path='/Device/Config/DeleteHW?';
  }

  if ($modeget == 'modify'){
    $url_path='/Device/Config/AddModifyUsage?';
  }
  
  if ($modeget == 'delete'){
    $url_path='/Device/Config/DeleteUsage?';
  }
  
  if ($modeget == 'modifyFW'){
    $url_path='/Device/Config/AddModifyUsageFirmware?';
  }

  if ($modeget == 'modifyDB'){
    $url_path='/Device/Config/AddModifyUsageDB?';
  }
  
  if ($modeget == 'deleteFW'){
    $url_path='/Device/Config/DeleteUsageFirmware?';
  }

  if ($modeget == 'deleteDB'){
    $url_path='/Device/Config/DeleteUsageDB?';
  }


  unset($_GET["mode"]);

  $new_query_string = http_build_query($_GET);

  $url = $url_host.$url_path.$new_query_string;

  $ch=curl_init();
  $timeout=1;

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);

  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

  $result=curl_exec($ch);
  curl_close($ch);

  echo $result;
?>
