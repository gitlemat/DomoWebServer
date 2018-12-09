<!DOCTYPE html>
<html lang="en">
<head>
  <title>DOMOTICA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="resources/airzone.css"> 
  <link rel="stylesheet" type="text/css" href="resources/jquery.timepicker.css"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="resources/jquery.timepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="resources/domotica.css"> 

</head>
<body>
<?php
$room=$_GET["room"];

if ($room=="Salon"){
  $roomNum=0;
  $systemNum=1;
  $zoneNum=1;
} elseif ($room=="Despacho"){
  $roomNum=1;
  $systemNum=1;
  $zoneNum=2;
} elseif ($room=="Cocina"){
  $roomNum=2;
  $systemNum=1;
  $zoneNum=3;
} elseif ($room=="Principal"){
  $roomNum=3;
  $systemNum=2;
  $zoneNum=1;
} elseif ($room=="Sofia"){
  $roomNum=4;
  $systemNum=2;
  $zoneNum=2;
} elseif ($room=="Alvaro"){
  $roomNum=5;
  $systemNum=2;
  $zoneNum=3;
}
 

?>

<div class="container-fluid">
  <div class="panel panel-consigna">
    <span class="text-consigna-48">Clima <?php echo $room?></span>
  </div>
  <div id="idAirzonePanel" class="panel panel-normal apagado not-active-link">
    <div class="row">
      <div class="col-xs-12">
         <span class="text-planta">Aire Acondicionado</span>
         <span id="idOnOffButton" class="text-right fixed-el-icon_maquina icon-size-20 flaticon-uniE60E" onclick="StartStopZone()" >
            <img id="idOnOffButtonImg" class="text-right fixed-el-svg obj-oculto" src="resources/loading.svg"></img>
         </span>

      </div>
    </div>
    
    <div class="row">
      <div class="col-xs-6  text-center">
         <span id="idAirzoneConsignUp" class="text-left icon-size-24 flaticon-uniE630" onclick="AirzoneConsignUpDown(0)"></span>
         <span id="idAirzoneConsign" class="text-planta">25.5º</span>
         <span id="idAirzoneConsignDown" class="text-right icon-size-24 flaticon-uniE631" onclick="AirzoneConsignUpDown(1)"></span>
      </div>
      <div class="col-xs-6">
         <span id="idProgButton" class="text-right icon-marginleft-5 fixed-el-icon_maquina icon-size-20 flaticon-uniE610" onclick="SaveProgram()"></span>
         <span id="idSleepButton" class="text-right fixed-el-icon_maquina icon-size-20 flaticon-uniE625" data-toggle="modal" data-target="#myModal">
            <img id="idSleepButtonImg" class="text-right fixed-el-svg obj-oculto" src="resources/loading.svg"></img>
         </span>
      </div>
    </div>
    
    <div class="row">
      <div class="col-xs-6">
        <div class="well well-room well-color-gen">
          <div class="row text-center text-size-16">
            Inicio
          </div>
          <div class="row text-center">
            <button id="idHoraInitUp" class="button button-gen text-center flaticon-uniE653 icon-size-24" onclick="HoraUpDown(0,0)"></button>
          </div>
          <div class="row">
            <div class="col-xs-5 no-padding">
              <div class="row no-padding row-int-nomargin">
                <div id="idHoraInit" class="text-right icon-size-24">20</div>
              </div>
            </div>
            <div class="col-xs-2 no-padding">
              <div class="row no-padding row-int-nomargin text-center icon-size-24">
                <div>:</div>
              </div>
            </div>
            <div class="col-xs-5 no-padding">
              <div class="row no-padding row-int-nomargin icon-size-24">
                <div id="idMinInit" class="text-left">45</div>
              </div>
            </div>
          </div>
          <div class="row text-center">
            <button id="idHoraInitDown" class="button button-gen text-center flaticon-uniE654 icon-size-24" onclick="HoraUpDown(0,1)"></button>
          </div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="well well-room well-color-gen">
          <div class="row text-center text-size-16">
            Apagado
          </div>
          <div class="row text-center">
            <button id="idHoraEndUp" class="button button-gen text-center flaticon-uniE653 icon-size-24" onclick="HoraUpDown(1,0)"></button>
          </div>
          <div class="row">
            <div class="col-xs-5 no-padding">
              <div class="row no-padding row-int-nomargin">
                <div id="idHoraEnd" class="text-right icon-size-24">20</div>
              </div>
            </div>
            <div class="col-xs-2 no-padding">
              <div class="row no-padding row-int-nomargin text-center icon-size-24">
                <div>:</div>
              </div>
            </div>
            <div class="col-xs-5 no-padding">
              <div class="row no-padding row-int-nomargin icon-size-24">
                <div id="idMinEnd" class="text-left">45</div>
              </div>
            </div>
          </div>
          <div class="row text-center">
            <button id="idHoraEndDown" class="button button-gen text-center flaticon-uniE654 icon-size-24" onclick="HoraUpDown(1,1)"></button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-normal">
    <div class="row">
      <div class="col-xs-12">
        <span class="text-planta">Calefaccion</span>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-1"></div>
      <div class="col-xs-10">    
        <div class="center-block consigna-center text-center">
          <button class="button button-icon flaticon-uniE653 icon-size-32 icon-paddingtop-5 text-left <?php if ($roomNum==0){echo "apagado not-active-link";}?>" onclick="ConsignaUp()"></button>
          <span id="tempConsignaDiff" class="text-consigna-48">00º</span>
          <span id="tempConsigna" class="text-mini2">(00º)</span>
          <button class="button button-icon flaticon-uniE654 icon-size-32 icon-paddingtop-5 text-right <?php if ($roomNum==0){echo "apagado not-active-link";}?>" onclick="ConsignaDown()"></button>
        </div>
      </div>
      <div class="col-xs-1"></div>
    </div>
  </div>
  <div class="panel panel-normal">
    <div class="row">
      <div class="col-xs-12">
         <span class="text-planta">Historico 24h</span>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div id="columnchart_material"></div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content modal-dialog-1">
        <div class="modal-body ">
          <div class="row row-int-nomargin" data-dismiss="modal" onclick="UpdateSleep(0)">
            <div id="idSeep1" class="text-left icon-size-20 icon-marginright-10 icon-marginbottom-5 fixed-el-icon_maquina flaticon-uniE625""></div>
            <span class="text-left font-modal-dialog ">Sleep Off</span>
          </div>
          <div class="row row-int-nomargin" data-dismiss="modal" onclick="UpdateSleep(1)">
            <div id="idSeep1" class="text-left icon-size-20 icon-marginright-10 icon-marginbottom-5 fixed-el-icon_maquina flaticon-uniE626"></div>
            <span class="text-left font-modal-dialog ">Sleep 30 Min</span>
          </div>
          <div class="row row-int-nomargin" data-dismiss="modal" onclick="UpdateSleep(2)">
            <div id="idSeep1" class="text-left icon-size-20 icon-marginright-10 icon-marginbottom-5 fixed-el-icon_maquina flaticon-uniE627"></div>
            <span class="text-left font-modal-dialog ">Sleep 60 Min</span>
          </div>
          <div class="row row-int-nomargin" data-dismiss="modal" onclick="UpdateSleep(3)">
            <div id="idSeep1" class="text-left icon-size-20 icon-marginright-10 icon-marginbottom-5 fixed-el-icon_maquina flaticon-uniE628"></div>
            <span class="text-left font-modal-dialog ">Sleep 90 Min</span>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {packages: ['corechart', 'bar']});
      google.charts.setOnLoadCallback(getJsonServer);
      
      
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
    
            if  (Number(maquinaNumber) == systemNum) {
                maquinaObj=jsonObj.Systems[0];
            } else {
                maquinaObj=jsonObj.Systems[1];
            }
            
            
            
            if (Number(maquinaObj.Zones[0].Zone_Number) == zoneNum){
                maquinaZoneObj = maquinaObj.Zones[0];
            }

            if (Number(maquinaObj.Zones[1].Zone_Number) == zoneNum){
                maquinaZoneObj = maquinaObj.Zones[1];
            }

            if (Number(maquinaObj.Zones[2].Zone_Number) == zoneNum){
                maquinaZoneObj = maquinaObj.Zones[2];
            }            

            AirzoneConsigna = maquinaZoneObj.Consign;
            systemMode = maquinaObj.Mode;
            zoneMode = maquinaZoneObj.State;
            zoneSleep = maquinaZoneObj.Sleep;
            
            updateAirzoneIcons();

          }
        }
      }
      
      function updateAirzoneIcons(){
        var d = new Date();
        var hourNow = ("0" + d.getHours()).slice(-2);
        var minNow = ("0" + d.getMinutes()).slice(-2);
        
        document.getElementById('idHoraInit').innerHTML=hourNow;
        document.getElementById('idHoraEnd').innerHTML=hourNow;
        document.getElementById('idMinInit').innerHTML=minNow;
        document.getElementById('idMinEnd').innerHTML=minNow;
        document.getElementById('idAirzoneConsign').innerHTML=AirzoneConsigna+"º";
        
        
        
        if (systemMode == 1 ){   // Si la máquina esta apagada ni se mira.
        
          document.getElementById('idAirzonePanel').className= "panel panel-normal";
          
          var ajax_url = "writeAirzoneTimer.php?mode=read&roomNum="+roomNumber;
          var ajax_request = new XMLHttpRequest();
          ajax_request.open( "GET", ajax_url, true);
          ajax_request.send();
          ajax_request.onreadystatechange = function() {
          
          // readyState es 4
            if (ajax_request.readyState == 4 ) {
              var jsonObj = JSON.parse( ajax_request.responseText );
              if (jsonObj[0].indexOf('on') !== -1) {
                  AirzoneProg=1;
                  document.getElementById('idProgButton').className= "text-right icon-marginleft-5 fixed-el-icon_maquina icon-size-20 flaticon-uniE610 icon-color-on";
                  document.getElementById('idHoraInit').innerHTML=jsonObj[2].substring(0, 2);
                  document.getElementById('idHoraEnd').innerHTML=jsonObj[4].substring(0, 2);
                  document.getElementById('idMinInit').innerHTML=jsonObj[2].substring(2, 4);
                  document.getElementById('idMinEnd').innerHTML=jsonObj[4].substring(2, 4);
              } else {
                  AirzoneProg=0;
                  document.getElementById('idProgButton').className= "text-right icon-marginleft-5 fixed-el-icon_maquina icon-size-20 flaticon-uniE610 icon-color-off";
  
              }
            }
          }
          
          if (zoneMode==0){
            document.getElementById('idOnOffButton').className= "text-right fixed-el-icon_maquina icon-size-20 flaticon-uniE60E icon-color-off";
          } else {
            document.getElementById('idOnOffButton').className= "text-right fixed-el-icon_maquina icon-size-20 flaticon-uniE60E icon-color-on";
          }
          
          UpdateSleepIcon(Number(zoneSleep));
          
        }
        
        
        
      }
      
      function GrabarTodo(){
        var ajax_url = "writeConsignaMode.php?mode=room&room=<?php echo $room?>&temp="+TempConsignaDiff;
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
      
      function StartStopZone(){
        
        if (zoneMode==1){
          zoneMode=0;
        } else {
          zoneMode=1;
        }
        
        document.getElementById('idOnOffButton').className= "text-right";
        document.getElementById('idOnOffButtonImg').className= "text-right fixed-el-svg";
        
        var ajax_url = "controlAirzone.php?mode=setzonestate&nSystemNum="+systemNum+"&nZoneNum="+zoneNum+"&szOption=state&nValue="+zoneMode;
        var ajax_request = new XMLHttpRequest();
        ajax_request.open( "GET", ajax_url, true);
        ajax_request.send();
        ajax_request.onreadystatechange = function() {
        
        // readyState es 4
          if (ajax_request.readyState == 4 ) {
            document.getElementById('idOnOffButtonImg').className= "text-right fixed-el-svg obj-oculto";
            if (zoneMode==0){
              document.getElementById('idOnOffButton').className= "text-right fixed-el-icon_maquina icon-size-20 flaticon-uniE60E icon-color-off";
            } else {
              document.getElementById('idOnOffButton').className= "text-right fixed-el-icon_maquina icon-size-20 flaticon-uniE60E icon-color-on";
            }
          
            // Analizamos el responseText que contendra el JSON enviado desde el servidor
            // La variable jsonObj ahora contiene un objeto con los datos recibido

          }
        }
      }

      function SaveProgram(){
      
        var timeOn = document.getElementById('idHoraInit').innerHTML + document.getElementById('idMinInit').innerHTML;
        var hourOff = document.getElementById('idHoraEnd').innerHTML
        var minOff = document.getElementById('idMinEnd').innerHTML;
        var timeOff = hourOff + minOff;
        var dOn = new Date();
        var dOff = new Date();
        
        dOff.setHours(Number(hourOff));
        dOff.setMinutes(Number(timeOff));
        
        if (dOff < dOn ){
            dOff.setDate(dOff.getDate() +1);
        }
        
        // Si timeoff o timeon es mas baja que now, hay que sumar 1 dia

        var yearOn = dOn.getFullYear();
        var yearOff = dOff.getFullYear();
        
        var monthOn = ("0" + (dOn.getMonth()+1)).slice(-2);
        var monthOff = ("0" + (dOff.getMonth()+1)).slice(-2);
        
        var dayOn = ("0" + dOn.getDate()).slice(-2);
        var dayOff = ("0" + dOff.getDate()).slice(-2);

        
        var datestrOn = yearOn+monthOn+dayOn;
        var datestrOff = yearOff+monthOff+dayOff;
        
        var szMode = "off";
        
        
        
        if (AirzoneProg==1){
          AirzoneProg=0;
          szMode = "off";
          document.getElementById('idProgButton').className= "text-right icon-marginleft-5 fixed-el-icon_maquina icon-size-20 flaticon-uniE610 icon-color-off";
          var d = new Date();
          var hourNow = ("0" + d.getHours()).slice(-2);
          var minNow = ("0" + d.getMinutes()).slice(-2);
          
          document.getElementById('idHoraInit').innerHTML=hourNow;
          document.getElementById('idMinInit').innerHTML=minNow;
        } else {
          AirzoneProg=1;
          szMode = "on";
          document.getElementById('idProgButton').className= "text-right icon-marginleft-5 fixed-el-icon_maquina icon-size-20 flaticon-uniE610 icon-color-on";
        }
        
        var ajax_url = "writeAirzoneTimer.php?roomNum="+roomNumber+"&mode="+szMode+"&dateOn="+datestrOn+"&timeOn="+timeOn+"&dateOff="+datestrOff+"&timeOff="+timeOff;
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
      
      function AirzoneConsignUpDown(updown){

	        
        if (updown==0) {
          AirzoneConsigna+=0.5;
          if (AirzoneConsigna > 31) {
            AirzoneConsigna = 31;
          }
        } else {
          AirzoneConsigna-=0.5
          if (AirzoneConsigna < 20) {
            AirzoneConsigna = 20;
          }
        }
        
        targetel=document.getElementById('idAirzoneConsign');        
        
        targetstr=AirzoneConsigna.toFixed(1)+"º";
        targetel.innerHTML=targetstr;
        
        var ajax_url = "controlAirzone.php?mode=setzonestate&nSystemNum="+systemNum+"&nZoneNum="+zoneNum+"&szOption=consign&nValue="+AirzoneConsigna;
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

     
      function HoraUpDown(initEnd, updown){
      
        if (initEnd==0) {
          targetelHour=document.getElementById('idHoraInit');
          targetelMin=document.getElementById('idMinInit');
        } else {
          targetelHour=document.getElementById('idHoraEnd');
          targetelMin=document.getElementById('idMinEnd');
        }
        
        targetvalueHTMLHour=targetelHour.innerHTML;
        targetvalueHour=Number(targetvalueHTMLHour);
        
        targetvalueHTMLMin=targetelMin.innerHTML;
        targetvalueMin=Number(targetvalueHTMLMin);
        
        if (updown==0) {
          targetvalueMin+=15;
          if (targetvalueMin > 59) {
            targetvalueMin -= 60;
            targetvalueHour+=1;
          }
          if (targetvalueHour == 24) {
            targetvalueHour = 0;
          }
        } else {
          targetvalueMin-=15
          if (targetvalueMin < 0) {
            targetvalueMin += 60;
            targetvalueHour-=1
          }
          if (targetvalueHour < 0) {
            targetvalueHour = 23;
          }
        }
        
        targetstrHour=targetvalueHour.toString();
        targetstrHour2 = ("0" + targetstrHour).slice(-2);
        targetelHour.innerHTML=targetstrHour2;
        
        targetstrMin=targetvalueMin.toString();
        targetstrMin2 = ("0" + targetstrMin).slice(-2);
        targetelMin.innerHTML=targetstrMin2;
      }
    
      
      function UpdateSleepIcon(mode){
        
        var iconref="flaticon-uniE625 icon-color-off";
        if (mode == 0){
          iconref = "flaticon-uniE625 icon-color-off";
        }
        if (mode == 1){
          iconref = "flaticon-uniE626 icon-color-on";
        }
        if (mode == 2){
          iconref = "flaticon-uniE627 icon-color-on";
        }
        if (mode == 3){
          iconref = "flaticon-uniE628 icon-color-on";
        }

        document.getElementById("idSleepButton").className = "text-right fixed-el-icon_maquina icon-size-20 " + iconref;

        
      }
      
      function UpdateSleep(mode){
        
        document.getElementById('idSleepButton').className= "text-right";
        document.getElementById('idSleepButtonImg').className= "text-right fixed-el-svg";
        
        var ajax_url = "controlAirzone.php?mode=setzonestate&nSystemNum="+systemNum+"&nZoneNum="+zoneNum+"&szOption=sleep&nValue="+mode;
        var ajax_request = new XMLHttpRequest();
        ajax_request.open( "GET", ajax_url, true);
        ajax_request.send();
        ajax_request.onreadystatechange = function() {
        
        // readyState es 4
          if (ajax_request.readyState == 4 ) {
            document.getElementById('idSleepButtonImg').className= "text-right fixed-el-svg obj-oculto";
          
            UpdateSleepIcon(mode)
          
            // Analizamos el responseText que contendra el JSON enviado desde el servidor
            // La variable jsonObj ahora contiene un objeto con los datos recibido

          }
        }
        
      }
            
      function ConsignaUp(){
        TempConsigna = Number(TempConsigna) + 0.5;
        TempConsignaDiff = TempConsignaDiff + 0.5;
        document.getElementById('tempConsigna').innerHTML="("+TempConsigna.toFixed(1)+"º)";
        document.getElementById('tempConsignaDiff').innerHTML=TempConsignaDiff.toFixed(1);
        GrabarTodo();
      }
      
      function ConsignaDown(){
        TempConsigna = Number(TempConsigna) - 0.5;
        TempConsignaDiff = TempConsignaDiff - 0.5;
        document.getElementById('tempConsigna').innerHTML="("+TempConsigna.toFixed(1)+"º)";
        document.getElementById('tempConsignaDiff').innerHTML=TempConsignaDiff.toFixed(1);
        GrabarTodo();
      }
      	  
      function updateConsignas (jsonObj){
        indexC = Number(<?php echo $roomNum?>);
        indexC += 1;
        TempConsigna = jsonObj[indexC];
        TempConsignaDiff = TempConsigna - jsonObj[1];
        document.getElementById('tempConsigna').innerHTML="("+Number(TempConsigna).toFixed(1)+"º)";
        document.getElementById('tempConsignaDiff').innerHTML=TempConsignaDiff.toFixed(1);
      }
      
      function getJsonServer() {
        var ajax_url = "ReportData.php?room=<?php echo $room?>";
        var ajax_request = new XMLHttpRequest();
        ajax_request.open( "GET", ajax_url, true);
        ajax_request.send();
        ajax_request.onreadystatechange = function() {
        
        // readyState es 4
          if (ajax_request.readyState == 4 ) {
          
            // Analizamos el responseText que contendra el JSON enviado desde el servidor
            var jsonObj = JSON.parse( ajax_request.responseText );
            // La variable jsonObj ahora contiene un objeto con los datos recibido

            drawChart (jsonObj);
          }
        }
      }
      function drawChart(jsonObj) {
      
        var dataTable = new google.visualization.DataTable();
        dataTable.addColumn('string', 'Hours');
        dataTable.addColumn('number', 'Temps');
        // A column for custom tooltip content
        dataTable.addColumn({type: 'string', role: 'tooltip'});
        for(var i = 0; i < jsonObj.length; i++){
            dataTable.addRows([[jsonObj[i][0], Number(jsonObj[i][1]), jsonObj[i][0]+": "+jsonObj[i][1]+"º"]]);
        }
        
        var options = {
          backgroundColor: '#373e45',
          colors: ['#b7c0c7'],
          chartArea: {
            backgroundColor: '#373e45',
            'width': '82%', 
            'height': '70%'
          },
          legend: 'none', 
          hAxis: {
            textStyle: {
              color: '#b7c0c7'
            },
            //textPosition: 'none',
            //title: '',
          },
          vAxis: { 
            gridlines: { 
	          color: '#b7c0c7' 
	        },
            textStyle: { 
            color: '#b7c0c7' 
            },
          } 
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_material'));

        chart.draw(dataTable, options);
      }
  
      ajax_url = "readConsigna.php";
      var ajax_request2 = new XMLHttpRequest();
      ajax_request2.open( "GET", ajax_url, true);
      ajax_request2.send();
      ajax_request2.onreadystatechange = function() {
        
        // readyState es 4
        if (ajax_request2.readyState == 4 ) {
          
          // Analizamos el responseText que contendra el JSON enviado desde el servidor
          var jsonObj = JSON.parse( ajax_request2.responseText );
          // La variable jsonObj ahora contiene un objeto con los datos recibido
          
          
          updateConsignas (jsonObj);
        }
      }
      
      var TempConsigna = 0;
      var TempConsignaDiff = 0; 
      var AirzoneProg = 0;
      var roomNumber = <?php echo $roomNum?>;
      var systemNum = <?php echo $systemNum?>;
      var zoneNum = <?php echo $zoneNum?>;
      
      var maquinaObj;
      var maquinaZoneObj;

      
      
      initAirzoneState();      
      
      
    </script>

</body>
</html>
