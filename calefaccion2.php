<!DOCTYPE html>
<html lang="en">
<head>
  <title>DOMOTICA17</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="resources/airzone.css"> 
  <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="resources/domotica.css"> 

</head>
<body>

	  
<?php

// Pillar Rooms

  $url='http://192.168.2.129:9000/Calefaccion/GetRoomListTreeTemps';
    
  $ch=curl_init();
  $timeout=1;

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);

  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

  $resultjson = curl_exec($ch);
  $resultPlantas = json_decode ($resultjson);  
  
  curl_close($ch);
  // [{"plantaID": "Baja", "rooms": [{"Temp2": 27.96, "Temp1": 27.7, "roomID": "Salon", "Caldera": "off", "Consigna": 0.0, "roomNumber": 1}, 
  //                                 {"Temp2": 28.11, "Temp1": 29.3, "roomID": "Cocina", "Caldera": "off", "Consigna": 0.0, "roomNumber": 3}, 
  //                                 {"Temp2": 28.2, "Temp1": 28.2, "roomID": "Despacho", "Caldera": "off", "Consigna": 0.0, "roomNumber": 2}]}, 
  //  {"plantaID": "Primera", "rooms": [{"Temp2": 29.4, "Temp1": 29.4, "roomID": "Sofia", "Caldera": "off", "Consigna": 0.0, "roomNumber": 5}, 
  //                                    {"Temp2": 29.3, "Temp1": 29.3, "roomID": "Principal", "Caldera": "off", "Consigna": 0.0, "roomNumber": 4}, 
  //                                    {"Temp2": 29.3, "Temp1": 29.3, "roomID": "Alvaro", "Caldera": "off", "Consigna": 0.0, "roomNumber": 6}]}]





?>

<script type="text/javascript">

  function initAirzoneState (){
    var ajax_url = "controlAirzone.php?mode=getstatedata";
    var ajax_request = new XMLHttpRequest();
    ajax_request.open( "GET", ajax_url, true);
    ajax_request.send();
    ajax_request.onreadystatechange = function() {
    
      // readyState es 4
      if (ajax_request.readyState == 4 ) {
      
        // Analizamos el responseText que contendra el JSON enviado desde el servidor
        AirzoneJsonObj = JSON.parse( ajax_request.responseText );
              
        updateAirzoneIcons();
      }
     }
        
  }
  
  function updateAirzoneIcons(){
  
    // Asumimos que están en orden y identificamos en AirzoneJsonObj por posicion en el array que me ha dado domo
    // EN ROOM_CONF las plantas baja y primera tienen que ser 0 y 1
    
    var idSystemEl;
    var idZoneEl;
    
    for (var i = 0; i < AirzoneJsonObj.Systems.length; i++){
      idSystemEl = 'idSystemMode' + (i).toString();
      if (AirzoneJsonObj.Systems[i].Mode == "1") {
        document.getElementById(idSystemEl).className="text-right fixed-el-icon_maquina icon-size-20 flaticon-uniE61A";
      } else {
        document.getElementById(idSystemEl).className="text-right fixed-el-icon_maquina icon-size-20 flaticon-uniE633";
      }
    
      systemObj = AirzoneJsonObj.Systems[i];
      plantaObj = resultPlantas[i + nPlanta0];  // Asumimos que las plantas tienen el mismo indice en airzone y domo (mas nPlanta0)
      
      for (var j = 0; j < systemObj.Zones.length; j++){
        
        roomObj = plantaObj.rooms[j];
        idZoneEl = 'idAire' + roomObj.roomID;

        if (systemObj.Zones[j].State == "1"){
          document.getElementById(idZoneEl).className="text-right icon-init-size fixed-el flaticon-uniE618";
        } else {
          document.getElementById(idZoneEl).className="text-right icon-init-size fixed-el obj-oculto flaticon-uniE618";
        }
  

      }
      
    }  
  
  }
  
  function UpdateAirzonSystemState(nSystem,nMode)
  {
    
    AirzoneJsonObj.Systems[nSystem].Mode = nMode;
    
    updateAirzoneIcons();
    
    var ajax_url = "controlAirzone.php?mode=setsystemmode&nSystemNum="+nSystem+"&szOption=mode&nValue="+nMode;
    var ajax_request = new XMLHttpRequest();
    ajax_request.open( "GET", ajax_url, true);
    ajax_request.send();
    ajax_request.onreadystatechange = function() {
    
    // readyState es 4
      if (ajax_request.readyState == 4 ) {
      
        // Analizamos el responseText que contendra el JSON enviado desde el servidor
        // La variable jsonObj ahora contiene un objeto con los datos recibido

      }
    }
        
  }
  
  function consignaUp(){
     var nTemp=Number(nTempConsigna);
     nTemp+=0.5;
     nTempConsigna=nTemp.toFixed(1);
     document.getElementById('tempConsigna').innerHTML=nTempConsigna+"º";
     saveConsigna();
  }
  
  function consignaDown(){
     var nTemp=Number(nTempConsigna);
     nTemp-=0.5;
     nTempConsigna=nTemp.toFixed(1);
     document.getElementById('tempConsigna').innerHTML=nTempConsigna+"º";
     saveConsigna();
  }

  function saveConsigna (){
    var ajax_url = "writeConsignaMode.php?mode=consignamanual&temp="+nTempConsigna.toString();
    var ajax_request = new XMLHttpRequest();
    ajax_request.open( "GET", ajax_url, true);
    ajax_request.send();
    ajax_request.onreadystatechange = function() {
        if (ajax_request.readyState == 4 ) {
          readConsignas();
        }
    }
  }

  function switch_mode(mode, write_mode){
      var buttonm=document.getElementById("buttonManual");
      var buttonp=document.getElementById("buttonProgram");
      var buttono=document.getElementById("buttonOff");
      //var linkp=document.getElementById("programlink");
      //var iconp=document.getElementById("programicon");
      var buttonup=document.getElementById("consignaupId");
      var buttondown=document.getElementById("consignadownId");
      var opmode="Prog";

      
      if (mode==0){
        buttonm.className="button button-gen flaticon-uniE601 encendido";
        buttonp.className="button button-gen flaticon-uniE610 apagado";
        buttono.className="button button-gen flaticon-uniE633 apagado";
        buttonup.className="button icon-init-size button-gen icon-format flaticon-uniE653";
        buttondown.className="button button-gen icon-init-size icon-format flaticon-uniE654";
        opmode="Man";
      }
      if (mode==1){
        buttonm.className="button button-gen flaticon-uniE601 apagado";
        buttonp.className="button button-gen flaticon-uniE610 encendido";
        buttono.className="button button-gen flaticon-uniE633 apagado";
        buttonup.className="button button-gen icon-format icon-init-size flaticon-uniE653 apagado not-active-link";
        buttondown.className="button button-gen icon-format icon-init-size flaticon-uniE654 apagado not-active-link";
        opmode="Prog";
      }
      
      if (mode==2){
        buttonm.className="button button-gen flaticon-uniE601 apagado";
        buttonp.className="button button-gen flaticon-uniE610 apagado";
        buttono.className="button button-gen flaticon-uniE633 encendido";
        buttonup.className="button button-gen icon-format icon-init-size flaticon-uniE653 apagado not-active-link";
        buttondown.className="button button-gen icon-format icon-init-size flaticon-uniE654 apagado not-active-link";
        opmode="Off";
      }
      
      if (write_mode == 1){
      
        var ajax_url = "writeConsignaMode.php?mode="+opmode;
        var ajax_request = new XMLHttpRequest();
        ajax_request.open( "GET", ajax_url, true);
        ajax_request.send();
        ajax_request.onreadystatechange = function() {
          if (ajax_request.readyState == 4 ) {
            readRoomData();
          }
        }
      }

  }
  
  
    
  function readRoomData (nAirzone){
    var ajax_url = "readConsigna.php?fulldata";
    var ajax_request = new XMLHttpRequest();
    ajax_request.open( "GET", ajax_url, true);
    ajax_request.send();
    ajax_request.onreadystatechange = function() {
    
      // readyState es 4
      if (ajax_request.readyState == 4 ) {
      
        // Analizamos el responseText que contendra el JSON enviado desde el servidor
        resultPlantas = JSON.parse( ajax_request.responseText );
        // La variable jsonObj ahora contiene un objeto con los datos recibido
        updateConsignas();
        
        if (nAirzone == 1){
          initAirzoneState();
        }
      
      }
    }
  }  
  
  

  function updateConsignas (){
  
    var plantaObj;
    var roomObj;
    var ElWellId;
    var ElConsignaId;
        
    for (var i = 0; i < resultPlantas.length; i++){
    
      plantaObj = resultPlantas[i];
      
      if (plantaObj.plantaNumber == 0){
        nPlanta0 = i;  // Esta es obviamente global
      }
      
      for (var j = 0; j < plantaObj.rooms.length; j++){
      
        roomObj = plantaObj.rooms[j];
        ElWellId = "well"+roomObj.roomID;  
        ElConsignaId = "Consigna"+roomObj.roomID;  
                
        if ((roomObj.Temp2-roomObj.Consigna)>0.5) {
            document.getElementById(ElWellId).className = "well well-domotica well-grad-temp-hot";
        } else if ((roomObj.Consigna-roomObj.Temp2)>0.5) {
            document.getElementById(ElWellId).className = "well well-domotica well-grad-temp-cold";
        } else {
            document.getElementById(ElWellId).className = "well well-domotica well-grad-temp-ok";
        }
  
           
        document.getElementById(ElConsignaId).innerHTML=roomObj.Consigna.toFixed(1);
        
        if (roomObj.roomID == "Salon"){
  
          nTempConsigna=roomObj.Consigna.toFixed(1);
          document.getElementById('tempConsigna').innerHTML=nTempConsigna+"º";
        }
      }
      
    }  
  }  


  function initOpMode (){
    var ajax_url = "readConsigna.php?mode";
    var ajax_request = new XMLHttpRequest();
    ajax_request.open( "GET", ajax_url, true);
    ajax_request.send();
    ajax_request.onreadystatechange = function() {
    
      // readyState es 4
      if (ajax_request.readyState == 4 ) {
      
        // Analizamos el responseText que contendra el JSON enviado desde el servidor
        var opmode = JSON.parse(ajax_request.responseText);
        // La variable jsonObj ahora contiene un objeto con los datos recibido
              
        if (opmode=="Man") {
            switch_mode(0,0);
        }
        if (opmode=="Prog") {
            switch_mode(1,0);
        }
        if (opmode=="Off") {
            switch_mode(2,0);
        }   
        
      }
    }
  }
  
  var resultPlantas;
  var AirzoneJsonObj;
  var nPlanta0 = 0; // Este me indica el indice de la planta 0. Sirve para alinear con Airzone
  var nTempConsigna = "22";

  initOpMode(); 
  readRoomData(1);
  
</script>

<div class="container-fluid">
  <div class="panel panel-consigna">
    <div class="row">  
      <div class="col-xs-3">
        <div class="row row-int-nomargin">
          <button id="buttonManual" class="button button-gen flaticon-uniE601 apagado" onclick="switch_mode(0,1)"></button>
        </div>
        <div class="row row-int-nomargin">
          <button id="buttonProgram" class="button button-gen flaticon-uniE610 encendido" onclick="switch_mode(1,1)"></button>
        </div>
        <div class="row row-int-nomargin">
          <button id="buttonOff" class="button button-gen flaticon-uniE633 apagado" onclick="switch_mode(2,1)"></button>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="row text-consigna">
          CLIMATIZACION
        </div>
        <div class="row text-consigna">
          <span id="programicon" class="button button-gen icon-init-size flaticon-uniE65D" onclick="UpdateCalefaccion()"></span>
          <span id="consignaupId" class="button button-gen icon-format icon-init-size flaticon-uniE653" onclick="consignaUp()"></span>
          <span id="tempConsigna">22º</span>
          <span id="consignadownId" class="button button-gen icon-format icon-init-size flaticon-uniE654" onclick="consignaDown()"></span>

        </div>
      </div>
      <div class="col-xs-3 text-align-right">
        <div class="row row-int-nomargin wrap">
          <span><?php echo $CieloTemp?>º</span>
          <span class="icon-format flaticon-<?php echo $cieloicon?>"></span>
        </div>
        <div class="row row-int-nomargin">
          <div >MADRID</div>
        </div>
        <div class="row row-int-nomargin wrap">
          <a href="reportes2.php"><div class="icon-format flaticon-uniE611"></div></a>
        </div>
      </div>
    </div>
  </div>
  <?php 	
    foreach ($resultPlantas as $plantaData) {
  ?>
  <div class="panel panel-normal">
    <div class="row">
      <div class="col-sm-12">
         <span class="text-planta">Planta <?php echo $plantaData->{'plantaID'}?></span>
     <?php 	
      if ($plantaData->{'plantaID'} == "Baja" or $plantaData->{'plantaID'} == "Primera") {
     ?>
         <span id="idSystemMode<?php echo $plantaData->{'plantaNumber'}?>" class="text-right fixed-el-icon_maquina icon-size-20 flaticon-uniE633 apagado" data-toggle="modal" data-target="#ModalMaquina<?php echo $plantaData->{'plantaNumber'}?>"></span>
     <?php 	
       }
     ?> 
      </div>
    </div>
    <div class="row">
    <?php 	
      foreach ($plantaData->{'rooms'} as $roomData) {
    ?>
      <a href="room.php?room=<?php echo $roomData->{'roomID'}?>">
      <div class="col-sm-4">
        <div id="well<?php echo $roomData->{'roomID'}?>" class="well well-domotica well-grad-temp-ok">
          <span class="text-left"><?php echo $roomData->{'roomID'}?></span>
           <div class="wrap">
            <span class="text-right"><?php echo number_format($roomData->{'Temp1'}, 1, '.', '')?>º</span>
            <span id="Consigna<?php echo $roomData->{'roomID'}?>" class="text-right text-mini1">22º</span>
            <img class="text-right fixed-el <?php if ($roomData->{'Caldera'}=="off"){echo "obj-oculto";}?>" src="resources/Heater.svg"></img>
            <span id="idAire<?php echo $roomData->{'roomID'}?>" class="text-right icon-init-size fixed-el obj-oculto flaticon-uniE618"></span>
           </div>
        </div>
      </div>
      </a>
  <?php 	
  }
  ?> 
    </div>

  </div>  
  <?php 	
  }
  ?> 
  
  <?php 	
    foreach ($resultPlantas as $plantaData) {
      if ($plantaData->{'plantaID'} == "Baja" or $plantaData->{'plantaID'} == "Primera") {
  ?>

  <div class="modal fade" id="ModalMaquina<?php echo $plantaData->{'plantaNumber'}?>" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content modal-dialog-<?php echo $plantaData->{'plantaNumber'}?>">
        <div class="modal-body ">
          <div class="row row-int-nomargin" data-dismiss="modal" onclick="UpdateAirzonSystemState(<?php echo $plantaData->{'plantaNumber'}?>,'0')">
            <div class="text-left icon-size-20 icon-marginright-10 icon-marginbottom-5 fixed-el-icon_maquina flaticon-uniE633""></div>
            <span class="text-left font-modal-dialog ">Maquina Off</span>
          </div>
          <div class="row row-int-nomargin" data-dismiss="modal" onclick="UpdateAirzonSystemState(<?php echo $plantaData->{'plantaNumber'}?>,'1')">
            <div class="text-left icon-size-20 icon-marginright-10 icon-marginbottom-5 fixed-el-icon_maquina flaticon-uniE61A"></div>
            <span class="text-left font-modal-dialog ">Maquina Frio</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <?php 	
    }
  }
  ?> 
  
</div>

</body>
</html>
