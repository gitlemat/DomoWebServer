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

$url_host='http://192.168.2.129:9000';
$url=$url_host.'/Device/GetList?type=tLuz';
$ch=curl_init();
$timeout=5;

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

$resultjson=curl_exec($ch);
$result= json_decode ($resultjson);
curl_close($ch);


?>
<div class="container-fluid">

  <div class="panel panel-consigna">
    <div class="row">  
      <div class="col-xs-12">
        <div class="row text-consigna">
          CONTROL LUCES
        </div>
      </div>
    </div>
  </div>
  
  <div class="panel panel-normal">
<?php
$nLineas=count($result);
$nLinea=0;

while ($nLinea < $nLineas){

  $idIzda=$result[$nLinea]->{'devId'};
  $nameIzda=$result[$nLinea]->{'Description'};
?>
    <div class="row">
      <div class="col-xs-6">
        <div class="panel panel-icono button-panel">
          <div class="row text-consigna">
            <?php echo $nameIzda ?>
          </div>
          <div class="row" onclick="switchLuz('<?php echo $idIzda ?>')">
            <div><img id="idLuz<?php echo $idIzda?>" class="fixed-el-icon" src="resources/bulb.svg" align="middle"></img></div>
          </div>
          <div class="row text-consigna text-align-right padding-right-20">
            <span id="programIcon<?php echo $idIzda?>" class="button button-gen icon-init-size flaticon-uniE610 apagado" onclick="switchLuzMode('<?php echo $idIzda?>','Prog')"></span>
            <span id="manualIcon<?php echo $idIzda ?>" class="button button-gen  icon-init-size flaticon-uniE601 apagado" onclick="switchLuzMode('<?php echo $idIzda?>','Man')"></span>
          </div>
        </div>
      </div> 
<?php
  $nLinea+=1;
  if ($nLinea >= $nLineas){
    break;
  }
  $idDcha=$result[$nLinea]->{'devId'};
  $nameDcha=$result[$nLinea]->{'Description'};
?>
      <div class="col-xs-6">
        <div class="panel panel-icono button-panel">
          <div class="row text-consigna">
            <?php echo $nameDcha ?>
          </div>
          <div class="row" onclick="switchLuz('<?php echo $idDcha ?>')">
            <div><img id="idLuz<?php echo $idDcha ?>" class="fixed-el-icon" src="resources/bulb.svg" align="middle"></img></div>
          </div>
          <div class="row text-consigna text-align-right padding-right-20">
            <span id="programIcon<?php echo $idDcha ?>" class="button button-gen icon-init-size flaticon-uniE610 apagado" onclick="switchLuzMode('<?php echo $idDcha ?>','Prog')"></span>
            <span id="manualIcon<?php echo $idDcha ?>" class="button button-gen  icon-init-size flaticon-uniE601 apagado" onclick="switchLuzMode('<?php echo $idDcha ?>','Man')"></span>
          </div>
        </div>
      </div> 
    </div>
<?php
  $nLinea+=1;
}
?>    

  </div>
</div>

<script type="text/javascript">

  function switchLuz (idLuz){
    var ajax_url = "controlLucesweb.php?luz="+idLuz+"&state=2";
    var ajax_request = new XMLHttpRequest();
    ajax_request.open( "GET", ajax_url, true);
    ajax_request.send();
    ajax_request.onreadystatechange = function() {
        if (ajax_request.readyState == 4 ) {
            response=ajax_request.responseText;
            updateLuzIcon (idLuz,response);
        }
    }
  }
  
  function switchLuzMode (idLuz, szMode){
    var ajax_url = "controlLucesweb.php?luz="+idLuz+"&state=switchMode"+szMode;
    var ajax_request = new XMLHttpRequest();
    ajax_request.open( "GET", ajax_url, true);
    ajax_request.send();
    ajax_request.onreadystatechange = function() {
        if (ajax_request.readyState == 4 ) {
            response=ajax_request.responseText;
            updateLuzModeIcons (idLuz,response);
        }
    }
  }
  
  function readLuz (idLuz){
    var ajax_url = "controlLucesweb.php?luz="+idLuz+"&state=read";
    var ajax_request = new XMLHttpRequest();
    ajax_request.open( "GET", ajax_url, true);
    ajax_request.send();
    ajax_request.onreadystatechange = function() {
        if (ajax_request.readyState == 4 ) {
            response=ajax_request.responseText;
            updateLuzIcon (idLuz,response);
        }
    }
  }
  
  function readLuzMode (idLuz){
    var ajax_url = "controlLucesweb.php?luz="+idLuz+"&state=readMode";
    var ajax_request = new XMLHttpRequest();
    ajax_request.open( "GET", ajax_url, true);
    ajax_request.send();
    ajax_request.onreadystatechange = function() {
        if (ajax_request.readyState == 4 ) {
            response=ajax_request.responseText;
            updateLuzModeIcons (idLuz,response);
        }
    }
  }
  
  function updateLuzIcon(nLuz, response){
    var stateJSON = JSON.parse(response);
    var obj = stateJSON[0];  // Asumo que me llega solo 1 device
    var state = obj.State;
    idLuz='idLuz'+nLuz;
    if (state == '0'){
        document.getElementById(idLuz).src="resources/bulb_off.svg";
    } else if (state == '1'){
        document.getElementById(idLuz).src="resources/bulb_on.svg";
    } else {
        document.getElementById(idLuz).src="resources/bulb.svg";
    }
  }
  
  function updateLuzModeIcons(nLuz, state){
    idLuzMan = 'manualIcon'+nLuz;
    idLuzProg = 'programIcon'+nLuz;
    
    elluzMan = document.getElementById(idLuzMan);
    elluzProg = document.getElementById(idLuzProg);
    
    if (state < 0){
      elluzMan.className = "button button-gen icon-init-size flaticon-uniE601 ";
      elluzProg.className = "button button-gen icon-init-size flaticon-uniE610 apagado";
    } else {
      elluzMan.className = "button button-gen icon-init-size flaticon-uniE601 apagado";
      elluzProg.className = "button button-gen icon-init-size flaticon-uniE610";
    }

  }
  
<?php
  $nLinea=0;
  while ($nLinea < $nLineas){
  ?>
  readLuz ('<?php echo $result[$nLinea]->{'devId'} ?>'); // Esto falta añadir automaticamente el resto!!
  readLuzMode ('<?php echo $result[$nLinea]->{'devId'} ?>');
  
<?php
  $nLinea+=1;
  }
  ?>  
</script>

</body>
</html>
