<!DOCTYPE html>
<html lang="en">
<head>
  <title>DOMOTICA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Resources Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com//bootstrap/3.3.7/js/bootstrap.js"></script>
  
  <!-- Resources jQuery para datepicker-->
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  <!-- Resources highcharts -->
  <script src="http://code.highcharts.com/highcharts.js"></script>
  
  <!-- Resources Internas -->
  <link rel="shortcut icon" type="image/png" href="favicon.png"/>
  <link rel="stylesheet" type="text/css" href="resources/airzone.css"> 
  <link rel="stylesheet" type="text/css" href="resources/domotica.css"> 
  

</head>
<body>

<?php
  
  $url='http://192.168.2.129:9000/Rooms/GetRoomList';
    
  $ch=curl_init();
  $timeout=1;

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);

  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

  $resultjson = curl_exec($ch);
  $result = json_decode ($resultjson);  
  
  curl_close($ch);
  
  
?>
<div class="container-fluid">
  <div class="panel panel-consigna col-xs-12 col-sm-6">
    <div class="row">
      <div class="col-xs-12">
         <span class="text-planta">Graficos de Temperaturas</span>
      </div>
    </div>
    <div class="row row-int-nomargin">
        <span>Fecha Datos: </span>
        <span><input class="inputCalendar" type="text" id="datepicker"></span>
    </div>
  </div>
  
<?php
$nRooms=count($result);
$nRoom=0;

while ($nRoom < $nRooms){

  $idRoom=$result[$nRoom]->{'roomID'};
  $numRoom=$result[$nRoom]->{'roomNumber'};
  $idPlanta=$result[$nRoom]->{'plantaID'};
  
?>
  
  <div class="panel panel-normal col-xs-12 col-sm-6">
    <div class="row">
      <div class="col-xs-12">
         <span class="text-planta">Temperaturas <?php echo $idRoom?> </span>
      </div>
    </div>
    
    <div class="row">
      <div class="col-xs-12">
         <span>Tiempo con calefaccion: </span>
         <span id="idTimeHeatOn<?php echo "_".$idRoom?>"> 0 min</span>
      </div>
    </div>
    
    <div class="row">
      <div class="col-xs-12">
        <div id="chart<?php echo "_".$idRoom?>"></div>
      </div>
    </div>
  </div>

<?php
  $nRoom+=1;
}
?>  
  
</div>

    <script type="text/javascript">
      
      function triggerCharts(){
      
<?php
$nRooms=count($result);
$nRoom=0;

while ($nRoom < $nRooms){

  $idRoom=$result[$nRoom]->{'roomID'};
  $numRoom=$result[$nRoom]->{'roomNumber'};
  $idPlanta=$result[$nRoom]->{'plantaID'};
  
?>

          updateChartData('<?php echo $idRoom?>')
<?php
  $nRoom+=1;
}
?>  
      }

      function updateChartData(room) {
        var ajax_url = "dataMariaDB.php?room="+room+"&day="+dd+"&month="+mm+"&year="+yyyy;
        var ajax_request = new XMLHttpRequest();
        ajax_request.open( "GET", ajax_url, true);
        ajax_request.send();
        ajax_request.onreadystatechange = function() {
        
        // readyState es 4
          if (ajax_request.readyState == 4 ) {
          
            // Analizamos el responseText que contendra el JSON enviado desde el servidor
            var jsonObj = JSON.parse( ajax_request.responseText );
            
            // La variable jsonObj ahora contiene un objeto con los datos recibido

            drawChart (jsonObj, room);
          }
        }
      }
 
      function drawChart(jsonObj, room) {
      
         var dataTime = []
         var dataTemp = []
         var dataConsigna = []
         var dataCaldera = []
         
         var nMinHeaterOn = 0;
         var nHourHeaterOn = 0;
         var nTotalMin = 0;
         
         var calOnOff = 0;
         var consOnOff = 0;
      
         for(var i = 0; i < jsonObj.length; i++){
            dataTime[i] = jsonObj[i][0];
            dataTemp[i] = Number(jsonObj[i][1]);
            dataConsigna[i] = Number(jsonObj[i][2]);
            dataCaldera[i] = Number(jsonObj[i][3]);
            if (dataConsigna[i] > 5){
                consOnOff = 1;
            }
            if (dataCaldera[i] > 5){
                calOnOff = 1;
            }
            
            nTotalMin += 15;
            if (Number(jsonObj[i][3]) == 100){
                nMinHeaterOn += 15;
                if ( (nMinHeaterOn - 60) >= 0) {
                    nMinHeaterOn -= 60;
                    nHourHeaterOn += 1;
                }
            }
         }
         
         var charthabitacion = 'chart_' + room;
         
         var myChart = Highcharts.chart(charthabitacion, {
         
            chart: {
               backgroundColor: '#373e44',

            },
            credits: {
                enabled: false,
            },
   
            title: {
                text: ''
            },
            
            legend: {
                itemHiddenStyle: {
                    color: '#666666'
                },
                itemStyle: {
                    color: '#b7c0c7'
                }
            },
            
            xAxis: {
                categories: dataTime,
                labels: {
                    style: {
                        color: '#b7c0c7',
                    }
                }
            },

            yAxis: [{ // Primary yAxis
                labels: {
                    format: '{value}°C',
                    style: {
                        color: '#b7c0c7',
                    }
                },
                title: {
                    text: '',
                    style: {
                        color: '#b7c0c7',
                    }
                },
        
            }, { // Secondary yAxis
                min: 0,
                max: 100,
                maxPadding: 0,
                labels: {
                    enabled: false
                },
                title: {
                    text: '',
                    style: {
                    }
                },

                opposite: true
        
            }],
            
            series: [{
                name: 'Temp',
                type: 'spline',
                marker: {
                    enabled: false
                },
                yAxis: 0,
                data: dataTemp,
                lineWidth: 4,
                zones: [{
                    value: 21.5,
                    color: '#f7a35c'
                }, {
                    value: 23,
                    color: '#7cb5ec'
                }, {
                    color: '#ca3e3e'
                }]
            }, {
                name: 'Consigna',
                marker: {
                    enabled: false
                },
                yAxis: 0,
                data: dataConsigna
            }, {
                name: 'Caldera',
                type: 'area',
                step: 'left',
                marker: {
                    enabled: false
                },
                yAxis: 1,
                data: dataCaldera
            }]
         });
      
         if (consOnOff == 0){
           myChart.series[1].hide();
         }
         
         if (calOnOff == 0){
           myChart.series[2].hide();
         }
      }
      
      
      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth()+1; //January is 0!
      var yyyy = today.getFullYear();
      
      //window.onresize=triggerCharts;
      
      
      $(function () {
      
         
         
         triggerCharts();
         
         $( "#datepicker" ).datepicker({
          showOn: "button",
          buttonImageOnly: true,
          buttonImage: "resources/calendar.svg",
          dateFormat: "dd/mm/yy",
          onSelect: function(date) {
            dd = date.substr(0,2);
            mm = date.substr(3,2);
            yyyy = date.substr(6,10);
            triggerCharts();

          },
        });
        
        $("#datepicker").val(dd+"/"+mm+"/"+yyyy);
        
        
      });
       
    </script>



</body>
</html>
