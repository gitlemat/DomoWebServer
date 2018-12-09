<!DOCTYPE html>
<html lang="en">
<head>
  <title>DOMOTICA17</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="resources/airzone.css"> 
  <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
  <link rel="shortcut icon" type="image/png" href="http://192.168.2.129/favicon.png"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="resources/domotica.css"> 

</head>
<body>

<?php
  $fileRoot="/home/sergio/Domotica/";
  
  $filename=$fileRoot."MonitorSistema";
  $fileTemp = file($filename);
  $statePi='GREEN';
  $stateWemos1=$fileTemp[0];
  $stateWemos2=$fileTemp[1];
  
  $iconPi="resources/orangepi_".$statePi.".svg";
  $iconWemos1="resources/wemos_".$stateWemos1.".svg";
  $iconWemos2="resources/wemos_".$stateWemos2.".svg";
  
  $iconWemosGreen="resources/wemos_green.svg";
  $iconWemosRed="resources/wemos_red.svg";
  
  $url_host='http://192.168.2.129:9000';
  $url=$url_host."/Alarms/GetAlarms";
  $ch=curl_init();
  $timeout=5;
  
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

  $resultjson=curl_exec($ch);
  $resultAlarms= json_decode ($resultjson);
  curl_close($ch);
    
  $bAlarm = False;
  $classbk = "alarma-sevNo-color";
  $nAlarms = 0;

  foreach ($resultAlarms as $alarm ) {
    $nAlarms +=1;
    if ($alarm->{'Severity'} == 3){
      $bAlarm = True;  
      $classbk = "alarma-sev3-color";
    } 
    if ($alarm->{'Severity'} == 2){
      $bAlarm = True;  
      $classbk = "alarma-sev2-color";
    } 
    if ($alarm->{'Severity'} == 1){
      $bAlarm = True;  
      $classbk = "alarma-sev1-color";
    } 
    
  }

?>


<div class="container-fluid">
  <div class="panel panel-consigna <?php print $classbk?>">
    <div class="row">  
      <div class="col-xs-12">
        <div class="row text-consigna-2">
          DOMOTICA
        </div>
      </div>
    </div>
  </div>
  
  <div class="panel panel-normal">
    <div class="row">
      <a href="calefaccion2.php">
      <div class="col-xs-6">
        <div class="panel panel-icono">
          <div class="row text-consigna-2">
            Climatizacion
          </div>
          <div class="row">
            <div><img class="fixed-el-icon" src="resources/heater2.svg" align="middle"></img></div>
          </div>
        </div>
      </div>
      </a>
      <a href="persianas.php">      
      <div class="col-xs-6">
        <div class="panel panel-icono">
          <div class="row text-consigna-2">
            Persianas
          </div>
          <div class="row">
            <div><img class="fixed-el-icon" src="resources/blinds.svg" align="middle"></img></div>
          </div>
        </div>
      </div>
      </a>
    </div>
    <div class="row">
      <a href="luces.php">
      <div class="col-xs-6">
        <div class="panel panel-icono">
          <div class="row text-consigna-2">
            Luces
          </div>
          <div class="row">
            <div><img class="fixed-el-icon" src="resources/bulb.svg" align="middle"></img></div>
          </div>
        </div>
      </div>
      </a>
      <a href="alarma.php">
      <div class="col-xs-6">
        <div class="panel panel-icono">
          <div class="row text-consigna-2">
            Alarma
          </div>
          <div class="row">
            <div><img class="fixed-el-icon" src="resources/camera.svg" align="middle"></img></div>
          </div>
        </div>
      </div>
      </a>
    </div>
  </div>
  
  <div class="panel panel-normal">
    <div class="row">  
      <div class="col-xs-12">
        <div class="text-planta_24">
          Gestion Alarmas
        </div>
        <div class="panel panel-icono">
          <?php 
          foreach ($resultAlarms as $alarm ) {
          ?>
          <div class="row row_interna">
            <div><img class="fixed-el-icon_monitor" src="<?php echo $iconWemosRed?>" align="left"></img></div>
            <div class="text-mini1"><?php echo $alarm->{'Description'}?></div>
          </div>
          <?php
          }
          ?>
          <?php 
          if ($nAlarms == 0) {
          ?>
          <div class="row row_interna">
            <div><img class="fixed-el-icon_monitor" src="<?php echo $iconWemosGreen?>" align="left"></img></div>
            <div class="text-mini1">Ninguna Alarma</div>
          </div>
          <?php
          }
          ?>
          
          
        </div>
      </div>
    </div>
  </div>
  
  <div class="panel panel-normal">
    <div class="row">  
      <div class="col-xs-12">
        <div class="text-planta_24">
          Gestion Dispositivos
        </div>        
        <div class="panel panel-icono">
          <a href="deviceControl.php">
          <div class="row row_interna">
            <div><img class="fixed-el-icon_monitor" src="<?php echo $iconPi?>" align="left"></img></div>
            <div class="text-mini1">Control Devices</div>
          </div>
          </a>
        </div>
        
      </div>
    </div>
  </div>
  
</div>

</body>
</html>
