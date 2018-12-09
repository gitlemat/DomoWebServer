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

// select * from temps ORDER BY fecha DESC LIMIT 1;

$sqlquery="select * from temps ORDER BY fecha DESC LIMIT 1;";

$mysqli = new mysqli("192.168.2.129", "sergio", "licaoasi", "domotica17");
$resultado = $mysqli->query("$sqlquery");
$fila = $resultado->fetch_assoc();

$TempSalon=number_format((float)$fila["t_Salon"], 1, '.', '');
$TempDespacho=number_format((float)$fila["t_Despacho"], 1, '.', '');
$TempCocina=number_format((float)$fila["t_Cocina"], 1, '.', '');
$TempPrincipal=number_format((float)$fila["t_Principal"], 1, '.', '');
$TempSofia=number_format((float)$fila["t_Sofia"], 1, '.', '');
$TempAlvaro=number_format((float)$fila["t_Alvaro"], 1, '.', '');
$CalderaOnOffSalon=$fila["cal_Salon"];
$CalderaOnOffDespacho=$fila["cal_Despacho"];
$CalderaOnOffCocina=$fila["cal_Cocina"];
$CalderaOnOffPrincipal=$fila["cal_Principal"];
$CalderaOnOffSofia=$fila["cal_Sofia"];
$CalderaOnOffAlvaro=$fila["cal_Alvaro"];
$CieloTemp=$fila["aemet_Temp"];
$CieloState=$fila["aemet_Cielo"];

$cieloicon="uniE640";

if (strcmp($CieloState, "11")==0){
  $cieloicon="uniE63F";
}

if (strcmp($CieloState, "12")==0 || strcmp($CieloState, "13")==0 || strcmp($CieloState, "14")==0 || strcmp($CieloState, "17")==0){
  $cieloicon="uniE640";
}

if (strcmp($CieloState, "12n")==0 || strcmp($CieloState, "13n")==0 || strcmp($CieloState, "14n")==0 || strcmp($CieloState, "17n")==0){
  $cieloicon="uniE640";
}

if (strcmp($CieloState, "15")==0 || strcmp($CieloState, "16")==0){
  $cieloicon="uniE641";
}

if (strcmp($CieloState, "45")==0 || strcmp($CieloState, "46")==0){
  $cieloicon="uniE642";
}

if (strcmp($CieloState, "25")==0 || strcmp($CieloState, "26")==0){
  $cieloicon="uniE643";
}

if (strcmp($CieloState, "35")==0 || strcmp($CieloState, "36")==0){
  $cieloicon="uniE644";
}

if (strcmp($CieloState, "73")==0 || strcmp($CieloState, "74")==0){
  $cieloicon="uniE645";
}

if (strcmp($CieloState, "43")==0 || strcmp($CieloState, "44")==0 || strcmp($CieloState, "43n")==0 || strcmp($CieloState, "44n")==0){
  $cieloicon="uniE647";
}

if (strcmp($CieloState, "23")==0 || strcmp($CieloState, "24")==0 || strcmp($CieloState, "23n")==0 || strcmp($CieloState, "24n")==0){
  $cieloicon="uniE648";
}

if (strcmp($CieloState, "33")==0 || strcmp($CieloState, "34")==0 || strcmp($CieloState, "33n")==0 || strcmp($CieloState, "34n")==0){
  $cieloicon="uniE649";
}

if (strcmp($CieloState, "71")==0 || strcmp($CieloState, "72")==0 || strcmp($CieloState, "71n")==0 || strcmp($CieloState, "72n")==0){
  $cieloicon="uniE64A";
}

if (strcmp($CieloState, "51")==0 || strcmp($CieloState, "52")==0 || strcmp($CieloState, "61")==0 || strcmp($CieloState, "61")==0){
  $cieloicon="uniE650";
}

if (strcmp($CieloState, "51n")==0 || strcmp($CieloState, "52n")==0 || strcmp($CieloState, "61n")==0 || strcmp($CieloState, "61n")==0){
  $cieloicon="uniE650";
}

if (strcmp($CieloState, "53")==0 || strcmp($CieloState, "54")==0 || strcmp($CieloState, "63")==0 || strcmp($CieloState, "64")==0){
  $cieloicon="uniE651";
}

if (strcmp($CieloState, "11n")==0){
  $cieloicon="uniE646";
}


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
        var jsonObj = JSON.parse( ajax_request.responseText );
        // La variable jsonObj ahora contiene un objeto con los datos recibido
      
        var maquinaNumber=jsonObj.Systems[0].System_Number;
  
        if  (Number(maquinaNumber) == 1) {
            maquina1Obj=jsonObj.Systems[0];
            maquina2Obj=jsonObj.Systems[1];

        } else {
            maquina1Obj=jsonObj.Systems[1];
            maquina2Obj=jsonObj.Systems[0];
        }
        
        
        
        if (Number(maquina1Obj.Zones[0].Zone_Number) == 1){
            maquina1Zone1Obj = maquina1Obj.Zones[0];
        }
  
        if (Number(maquina1Obj.Zones[1].Zone_Number) == 1){
            maquina1Zone1Obj = maquina1Obj.Zones[1];
        }
  
        if (Number(maquina1Obj.Zones[2].Zone_Number) == 1){
            maquina1Zone1Obj = maquina1Obj.Zones[2];
        }
        
        if (Number(maquina1Obj.Zones[0].Zone_Number) == 2){
            maquina1Zone2Obj = maquina1Obj.Zones[0];
        }
  
        if (Number(maquina1Obj.Zones[1].Zone_Number) == 2){
            maquina1Zone2Obj = maquina1Obj.Zones[1];
        }
  
        if (Number(maquina1Obj.Zones[2].Zone_Number) == 2){
            maquina1Zone2Obj = maquina1Obj.Zones[2];
        }     
        
        if (Number(maquina1Obj.Zones[0].Zone_Number) == 3){
            maquina1Zone3Obj = maquina1Obj.Zones[0];
        }
  
        if (Number(maquina1Obj.Zones[1].Zone_Number) == 3){
            maquina1Zone3Obj = maquina1Obj.Zones[1];
        }
  
        if (Number(maquina1Obj.Zones[2].Zone_Number) == 3){
            maquina1Zone3Obj = maquina1Obj.Zones[2];
        }      
        
        

        if (Number(maquina2Obj.Zones[0].Zone_Number) == 1){
            maquina2Zone1Obj = maquina2Obj.Zones[0];
        }
  
        if (Number(maquina2Obj.Zones[1].Zone_Number) == 1){
            maquina2Zone1Obj = maquina2Obj.Zones[1];
        }
  
        if (Number(maquina2Obj.Zones[2].Zone_Number) == 1){
            maquina2Zone1Obj = maquina2Obj.Zones[2];
        }
        
        if (Number(maquina2Obj.Zones[0].Zone_Number) == 2){
            maquina2Zone2Obj = maquina2Obj.Zones[0];
        }
  
        if (Number(maquina2Obj.Zones[1].Zone_Number) == 2){
            maquina2Zone2Obj = maquina2Obj.Zones[1];
        }
  
        if (Number(maquina2Obj.Zones[2].Zone_Number) == 2){
            maquina2Zone2Obj = maquina2Obj.Zones[2];
        }     
        
        if (Number(maquina2Obj.Zones[0].Zone_Number) == 3){
            maquina2Zone3Obj = maquina2Obj.Zones[0];
        }
  
        if (Number(maquina2Obj.Zones[1].Zone_Number) == 3){
            maquina2Zone3Obj = maquina2Obj.Zones[1];
        }
  
        if (Number(maquina2Obj.Zones[2].Zone_Number) == 3){
            maquina2Zone3Obj = maquina2Obj.Zones[2];
        }  
        
        updateAirzoneIcons();
  
      }
    }
  }
  
  function updateAirzoneIcons(){
  
    if (maquina1Obj.Mode == "1") {
        document.getElementById('idSystemMode1').className="text-right fixed-el-icon_maquina icon-size-20 flaticon-uniE61A";
    } else {
        document.getElementById('idSystemMode1').className="text-right fixed-el-icon_maquina icon-size-20 flaticon-uniE633";
    }
    
    if (maquina2Obj.Mode == "1") {
        document.getElementById('idSystemMode2').className="text-right fixed-el-icon_maquina icon-size-20 flaticon-uniE61A";
    } else {
        document.getElementById('idSystemMode2').className="text-right fixed-el-icon_maquina icon-size-20 flaticon-uniE633";
    }
    
        // text-right icon-init-size fixed-el obj-oculto flaticon-uniE618

    if (maquina1Zone1Obj.State=="1"){
        document.getElementById('idAireSalon').className="text-right icon-init-size fixed-el flaticon-uniE618";
    } else {
        document.getElementById('idAireSalon').className="text-right icon-init-size fixed-el obj-oculto flaticon-uniE618";
    }
    if (maquina1Zone2Obj.State=="1"){
        document.getElementById('idAireDespacho').className="text-right icon-init-size fixed-el flaticon-uniE618";
    } else {
        document.getElementById('idAireDespacho').className="text-right icon-init-size fixed-el obj-oculto flaticon-uniE618";
    }
    if (maquina1Zone3Obj.State=="1"){
        document.getElementById('idAireCocina').className="text-right icon-init-size fixed-el flaticon-uniE618";
    } else {
        document.getElementById('idAireCocina').className="text-right icon-init-size fixed-el obj-oculto flaticon-uniE618";
    }
    
    if (maquina2Zone1Obj.State=="1"){
        document.getElementById('idAirePrincipal').className="text-right icon-init-size fixed-el flaticon-uniE618";
    } else {
        document.getElementById('idAirePrincipal').className="text-right icon-init-size fixed-el obj-oculto flaticon-uniE618";
    }
    if (maquina2Zone2Obj.State=="1"){
        document.getElementById('idAireSofia').className="text-right icon-init-size fixed-el flaticon-uniE618";
    } else {
        document.getElementById('idAireSofia').className="text-right icon-init-size fixed-el obj-oculto flaticon-uniE618";
    }
    if (maquina2Zone3Obj.State=="1"){
        document.getElementById('idAireAlvaro').className="text-right icon-init-size fixed-el flaticon-uniE618";
    } else {
        document.getElementById('idAireAlvaro').className="text-right icon-init-size fixed-el obj-oculto flaticon-uniE618";
    }
    
  }


  function UpdateAirzonSystemState(nSystem,nMode)
  {
    
    if (nSystem == 1){
      maquina1Obj.Mode = nMode;

    } else {
      maquina2Obj.Mode = nMode;

    }
    
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

  function switch_mode(mode){
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
        //linkp.className="not-active-link";
        //iconp.className="icon-format icon-init-size flaticon-uniE60D apagado";
        buttonup.className="button icon-init-size button-gen icon-format flaticon-uniE653";
        buttondown.className="button button-gen icon-init-size icon-format flaticon-uniE654";
        opmode="Man";
      }
      if (mode==1){
        buttonm.className="button button-gen flaticon-uniE601 apagado";
        buttonp.className="button button-gen flaticon-uniE610 encendido";
        buttono.className="button button-gen flaticon-uniE633 apagado";
        //linkp.className="";
        //iconp.className="icon-format icon-init-size flaticon-uniE60D encendido";
        buttonup.className="button button-gen icon-format icon-init-size flaticon-uniE653 apagado not-active-link";
        buttondown.className="button button-gen icon-format icon-init-size flaticon-uniE654 apagado not-active-link";
        opmode="Prog";
      }
      
      if (mode==2){
        buttonm.className="button button-gen flaticon-uniE601 apagado";
        buttonp.className="button button-gen flaticon-uniE610 apagado";
        buttono.className="button button-gen flaticon-uniE633 encendido";
        //linkp.className="not-active-link";
        //iconp.className="icon-format icon-init-size flaticon-uniE60D apagado";
        buttonup.className="button button-gen icon-format icon-init-size flaticon-uniE653 apagado not-active-link";
        buttondown.className="button button-gen icon-format icon-init-size flaticon-uniE654 apagado not-active-link";
        opmode="Off";
      }
      
      var ajax_url = "writeConsignaMode.php?mode="+opmode;
      var ajax_request = new XMLHttpRequest();
      ajax_request.open( "GET", ajax_url, true);
      ajax_request.send();
      ajax_request.onreadystatechange = function() {
        if (ajax_request.readyState == 4 ) {
          readConsignas();
        }
      }

  };
    
  function updateConsignas (jsonObj){

      var TempSalon = <?php echo $TempSalon?>;
      var TempDespacho = <?php echo $TempDespacho?>;
      var TempCocina = <?php echo $TempCocina?>;
      var TempPrincipal = <?php echo $TempPrincipal?>;
      var TempSofia = <?php echo $TempSofia?>;
      var TempAlvaro = <?php echo $TempAlvaro?>;
      
      
      if ((TempSalon-Number(jsonObj[1]))>0.5) {
          document.getElementById("wellSalon").className = "well well-domotica well-grad-temp-hot";
      } else if ((Number(jsonObj[0])-TempSalon)>0.5) {
          document.getElementById("wellSalon").className = "well well-domotica well-grad-temp-cold";
      } else {
          document.getElementById("wellSalon").className = "well well-domotica well-grad-temp-ok";
      }
      if ((TempDespacho-Number(jsonObj[2]))>0.5) {
          document.getElementById("wellDespacho").className = "well well-domotica well-grad-temp-hot";
      } else if ((Number(jsonObj[1])-TempDespacho)>0.5) {
          document.getElementById("wellDespacho").className = "well well-domotica well-grad-temp-cold";
      } else {
          document.getElementById("wellDespacho").className = "well well-domotica well-grad-temp-ok";
      }
      if ((TempCocina-Number(jsonObj[3]))>0.5) {
          document.getElementById("wellCocina").className = "well well-domotica well-grad-temp-hot";
      } else if ((Number(jsonObj[2])-TempCocina)>0.5) {
          document.getElementById("wellCocina").className = "well well-domotica well-grad-temp-cold";
      } else {
          document.getElementById("wellCocina").className = "well well-domotica well-grad-temp-ok";
      }
      if ((TempPrincipal-Number(jsonObj[4]))>0.5) {
          document.getElementById("wellPrincipal").className = "well well-domotica well-grad-temp-hot";
      } else if ((Number(jsonObj[3])-TempPrincipal)>0.5) {
          document.getElementById("wellPrincipal").className = "well well-domotica well-grad-temp-cold";
      } else {
          document.getElementById("wellPrincipal").className = "well well-domotica well-grad-temp-ok";
      }
      if ((TempSofia-Number(jsonObj[5]))>0.5) {
          document.getElementById("wellSofia").className = "well well-domotica well-grad-temp-hot";
      } else if ((Number(jsonObj[4])-TempSofia)>0.5) {
          document.getElementById("wellSofia").className = "well well-domotica well-grad-temp-cold";
      } else {
          document.getElementById("wellSofia").className = "well well-domotica well-grad-temp-ok";
      }
      if ((TempAlvaro-Number(jsonObj[6]))>0.5) {
          document.getElementById("wellAlvaro").className = "well well-domotica well-grad-temp-hot";
      } else if ((Number(jsonObj[5])-TempAlvaro)>0.5) {
          document.getElementById("wellAlvaro").className = "well well-domotica well-grad-temp-cold";
      } else {
          document.getElementById("wellAlvaro").className = "well well-domotica well-grad-temp-ok";
      }
            
      //document.getElementById('ConsignaTotal').innerHTML=jsonObj[0];
      document.getElementById('ConsignaSalon').innerHTML=jsonObj[1];
      document.getElementById('ConsignaDespacho').innerHTML=jsonObj[2];
      document.getElementById('ConsignaCocina').innerHTML=jsonObj[3];
      document.getElementById('ConsignaPrincipal').innerHTML=jsonObj[4];
      document.getElementById('ConsignaSofia').innerHTML=jsonObj[5];
      document.getElementById('ConsignaAlvaro').innerHTML=jsonObj[6];
      nTempConsigna=Number(jsonObj[1]).toFixed(1);
      document.getElementById('tempConsigna').innerHTML=nTempConsigna.toString()+"º";
  }
  
  function initOpMode (){
    var ajax_url = "readConsigna.php";
    var ajax_request = new XMLHttpRequest();
    ajax_request.open( "GET", ajax_url, true);
    ajax_request.send();
    ajax_request.onreadystatechange = function() {
    
      // readyState es 4
      if (ajax_request.readyState == 4 ) {
      
        // Analizamos el responseText que contendra el JSON enviado desde el servidor
        var jsonObj = JSON.parse( ajax_request.responseText );
        // La variable jsonObj ahora contiene un objeto con los datos recibido
      
        var opmode=jsonObj[0];
        if (opmode=="Man") {
            switch_mode(0);
        }
        if (opmode=="Prog") {
            switch_mode(1);
        }
        if (opmode=="Off") {
            switch_mode(2);
        }   
        
      }
    }
  }
  
  function readConsignas (){
    var ajax_url = "readConsigna.php";
    var ajax_request = new XMLHttpRequest();
    ajax_request.open( "GET", ajax_url, true);
    ajax_request.send();
    ajax_request.onreadystatechange = function() {
    
      // readyState es 4
      if (ajax_request.readyState == 4 ) {
      
        // Analizamos el responseText que contendra el JSON enviado desde el servidor
        var jsonObj = JSON.parse( ajax_request.responseText );
        // La variable jsonObj ahora contiene un objeto con los datos recibido
      
      
        updateConsignas (jsonObj);
      }
    }
  }
  
  function UpdateCalefaccion(){
    var ajax_url = "calefaccionUpdate.php";
    var ajax_request = new XMLHttpRequest();
    ajax_request.open( "GET", ajax_url, true);
    ajax_request.send();
    ajax_request.onreadystatechange = function() {
        if (ajax_request.readyState == 4 ) {
        }
    }
  }
  
  var nTempConsigna=22;
  var maquina1Obj;
  var maquina2Obj;

  var maquina1Zone1Obj;
  var maquina1Zone2Obj;
  var maquina1Zone3Obj;

  var maquina2Zone1Obj;
  var maquina2Zone2Obj;
  var maquina2Zone3Obj;
      
  initAirzoneState();   
  initOpMode(); 
  
</script>


<div class="container-fluid">
  <div class="panel panel-consigna">
    <div class="row">  
      <div class="col-xs-3">
        <div class="row row-int-nomargin">
          <button id="buttonManual" class="button button-gen flaticon-uniE601 apagado" onclick="switch_mode(0)"></button>
        </div>
        <div class="row row-int-nomargin">
          <button id="buttonProgram" class="button button-gen flaticon-uniE610 encendido" onclick="switch_mode(1)"></button>
        </div>
        <div class="row row-int-nomargin">
          <button id="buttonOff" class="button button-gen flaticon-uniE633 apagado" onclick="switch_mode(2)"></button>
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
          <a href="reportes.php"><div class="icon-format flaticon-uniE611"></div></a>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-normal">
    <div class="row">
      <div class="col-sm-12">
         <span class="text-planta">Planta Baja</span>
         <span id="idSystemMode1" class="text-right fixed-el-icon_maquina icon-size-20 flaticon-uniE633 apagado" data-toggle="modal" data-target="#ModalMaquina1"></span>
      </div>
    </div>
    <div class="row">
      <a href="room.php?room=Salon">
      <div class="col-sm-4">
        <div id="wellSalon" class="well well-domotica well-grad-temp-ok">
          <span class="text-left">SALON</span>
           <div class="wrap">
            <span class="text-right"><?php echo $TempSalon?>º</span>
            <span id="ConsignaSalon" class="text-right text-mini1">22º</span>
            <img class="text-right fixed-el <?php if ($CalderaOnOffSalon=="off"){echo "obj-oculto";}?>" src="resources/Heater.svg"></img>
            <span id="idAireSalon" class="text-right icon-init-size fixed-el obj-oculto flaticon-uniE618"></span>
           </div>
        </div>
      </div>
      </a>
      <a href="room.php?room=Despacho">
      <div class="col-sm-4">
        <div id="wellDespacho" class="well well-domotica well-grad-temp-ok">
          <span class="text-left">DESPACHO</span>
           <div class="wrap">
            <span class="text-right"><?php echo $TempDespacho?>º</span>
            <span id="ConsignaDespacho" class="text-right text-mini1">22º</span>
            <img class="text-right fixed-el <?php if ($CalderaOnOffDespacho=="off"){echo "obj-oculto";}?>" src="resources/Heater.svg"></img>
            <span id="idAireDespacho" class="text-right icon-init-size fixed-el obj-oculto flaticon-uniE618"></span>
           </div>
        </div>
      </div>
      </a>
      <a href="room.php?room=Cocina">
      <div class="col-sm-4">
        <div id="wellCocina" class="well well-domotica well-grad-temp-ok">
          <span class="text-left">COCINA</span>
           <div class="wrap">
            <span class="text-right"><?php echo $TempCocina?>º</span>
            <span id="ConsignaCocina" class="text-right text-mini1">22º</span>
            <img class="text-right fixed-el <?php if ($CalderaOnOffCocina=="off"){echo "obj-oculto";}?>" src="resources/Heater.svg"></img>
            <span id="idAireCocina" class="text-right icon-init-size fixed-el obj-oculto flaticon-uniE618"></span>
           </div>
        </div>
      </div>
      </a>
    </div>
  </div>
  <div class="panel panel-normal">
    <div class="row">
      <div class="col-sm-12">
         <span class="text-planta">Planta Primera</span>
         <span id="idSystemMode2" class="text-right fixed-el-icon_maquina icon-size-20 flaticon-uniE633 apagado" data-toggle="modal" data-target="#ModalMaquina2"></span>
      </div>
    </div>
    <div class="row">
      <a href="room.php?room=Principal">
      <div class="col-sm-4">
        <div id="wellPrincipal" class="well well-domotica well-grad-temp-ok">
          <span class="text-left">PRINCIPAL</span>
           <div class="wrap">
            <span class="text-right"><?php echo $TempPrincipal?>º</span>
            <span id="ConsignaPrincipal" class="text-right text-mini1">22º</span>
            <img class="text-right fixed-el <?php if ($CalderaOnOffPrincipal=="off"){echo "obj-oculto";}?>" src="resources/Heater.svg"></img>
            <span id="idAirePrincipal" class="text-right icon-init-size fixed-el obj-oculto flaticon-uniE618"></span>
           </div>
        </div>
      </div>
      </a>
      <a href="room.php?room=Sofia">
      <div class="col-sm-4">
        <div id="wellSofia" class="well well-domotica well-grad-temp-ok">
  	      <span class="text-left">SOFIA</span>
           <div class="wrap">
            <span class="text-right"><?php echo $TempSofia?>º</span>
            <span id="ConsignaSofia" class="text-right text-mini1">22º</span>
            <img class="text-right fixed-el <?php if ($CalderaOnOffSofia=="off"){echo "obj-oculto";}?>" src="resources/Heater.svg"></img>
            <span id="idAireSofia" class="text-right icon-init-size fixed-el obj-oculto flaticon-uniE618"></span>
           </div>
        </div>
      </div>
      </a>
      <a href="room.php?room=Alvaro">
      <div class="col-sm-4">
        <div id="wellAlvaro" class="well well-domotica well-grad-temp-ok">
  	      <span class="text-left">ALVARO</span>
           <div class="wrap">
            <span class="text-right"><?php echo $TempAlvaro?>º</span>
            <span id="ConsignaAlvaro" class="text-right text-mini1">22º</span>
            <img class="text-right fixed-el <?php if ($CalderaOnOffAlvaro=="off"){echo "obj-oculto";}?>" src="resources/Heater.svg"></img>
            <span id="idAireAlvaro" class="text-right icon-init-size fixed-el obj-oculto flaticon-uniE618"></span>
           </div>
        </div>
      </div>
      </a>
    </div>
  </div>
  
  
  <div class="modal fade" id="ModalMaquina1" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content modal-dialog-0">
        <div class="modal-body ">
          <div class="row row-int-nomargin" data-dismiss="modal" onclick="UpdateAirzonSystemState(1,'0')">
            <div class="text-left icon-size-20 icon-marginright-10 icon-marginbottom-5 fixed-el-icon_maquina flaticon-uniE633""></div>
            <span class="text-left font-modal-dialog ">Maquina Off</span>
          </div>
          <div class="row row-int-nomargin" data-dismiss="modal" onclick="UpdateAirzonSystemState(1,'1')">
            <div class="text-left icon-size-20 icon-marginright-10 icon-marginbottom-5 fixed-el-icon_maquina flaticon-uniE61A"></div>
            <span class="text-left font-modal-dialog ">Maquina Frio</span>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="ModalMaquina2" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content modal-dialog-1">
        <div class="modal-body ">
          <div class="row row-int-nomargin" data-dismiss="modal" onclick="UpdateAirzonSystemState(2,'0')">
            <div class="text-left icon-size-20 icon-marginright-10 icon-marginbottom-5 fixed-el-icon_maquina flaticon-uniE633""></div>
            <span class="text-left font-modal-dialog ">Maquina Off</span>
          </div>
          <div class="row row-int-nomargin" data-dismiss="modal" onclick="UpdateAirzonSystemState(2,'1')">
            <div class="text-left icon-size-20 icon-marginright-10 icon-marginbottom-5 fixed-el-icon_maquina flaticon-uniE61A"></div>
            <span class="text-left font-modal-dialog ">Maquina Frio</span>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>

</body>
</html>
