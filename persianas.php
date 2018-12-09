<!DOCTYPE html>
<html lang="en">
<head>
  <title>PERSIANAS</title>
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

<script type="text/javascript">

  function persianaMove(nivel){
    var persiana=persianaSel;
    var ajax_url = "controlPersianaweb.php?persiana="+persiana.toString()+"&nivel="+nivel.toString();
    var ajax_request = new XMLHttpRequest();

    ajax_request.open( "GET", ajax_url, true);
    ajax_request.send();
    ajax_request.onreadystatechange = function() {
        if (ajax_request.readyState == 4 ) {
        }
    }
    //AJAX a persionaSel, nivel
  }

  function persianaChange(szNumPersiana){
    var idPersianaNueva='idPersianas'+szNumPersiana;
    var idPersianaVieja='idPersianas'+persianaSel.toString();
    var buttonsel=document.getElementById(idPersianaNueva);
    var buttonselOld=document.getElementById(idPersianaVieja);


    buttonselOld.className="panel panel-icono button-blind1";


    buttonsel.className="panel panel-icono-sel button-blind1";
    
    persianaSel=Number(szNumPersiana);
    
    
  }
  

  
  persianaSel=0;
  
</script>



<div class="container-fluid">
  <div class="panel panel-consigna">
    <div class="row">  
      <div class="col-xs-12">
        <div class="row text-consigna">
          CONTROL PERSIANAS
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-normal">
    <div class="row">
      <div class="col-xs-9">
        <div id="idPersianas0" class="panel panel-icono-sel button-blind1" onclick="persianaChange('0')">
          <div class="row">
            <div class="wrap">
              <img class="fixed-el-icon-left-small text-left" src="resources/blinds.svg"></img>
              <span class="text-left text-button">Todas</span>
            </div>
          </div>
        </div>
        <div id="idPersianas1" class="panel panel-icono button-blind1" onclick="persianaChange('1')">
          <div class="row">
            <div class="wrap">
              <img class="fixed-el-icon-left-small text-left" src="resources/blinds.svg"></img>
              <span class="text-left text-button">Cocina & Despacho</span>
            </div>
          </div>
        </div>
        
        <div id="idPersianas2" class="panel panel-icono button-blind1" onclick="persianaChange('2')">
          <div class="row">
            <div class="wrap">
              <img class="fixed-el-icon-left-small text-left" src="resources/blinds.svg"></img>
              <span class="text-left text-button">Planta 1 & 2</span>
            </div>
          </div>
        </div>
        <div id="idPersianas3" class="panel panel-icono button-blind1" onclick="persianaChange('3')">
          <div class="row">
            <div class="wrap">
              <img class="fixed-el-icon-left-small text-left" src="resources/blinds.svg"></img>
              <span class="text-left text-button">Salon</span>
            </div>
          </div>
        </div>
      </div>
      
      
      <div class="col-xs-3">
        <div class="panel panel-icono">
          <div class="row button-blind1" onclick="persianaMove(1)">
            <div><img class="fixed-el-icon-right-small" src="resources/blindsup.svg" align="middle"></img></div>
          </div>

          <div class="row button-blind1" onclick="persianaMove(2)">
            <div><img class="fixed-el-icon-right-small" src="resources/blindsup.svg" align="middle"></img></div>
          </div>

          <div class="row button-blind1" onclick="persianaMove(0)">
            <div id="buttonManual" class="fixed-el-icon-right-small2 flaticon-uniE633 icon-size-23 "></div>
          </div>

          <div class="row button-blind1" onclick="persianaMove(3)">
            <div><img class="fixed-el-icon-right-small" src="resources/blindsdown.svg" align="middle"></img></div>
          </div>

          <div class="row button-blind1" onclick="persianaMove(4)">
            <div><img class="fixed-el-icon-right-small" src="resources/blindsdown.svg" align="middle"></img></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  

</div>

</body>
</html>
