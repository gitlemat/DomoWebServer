<!DOCTYPE html>
<html lang="en">
<head>
  <title>DOMOTICA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="resources/airzone.css"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" type="text/css" href="resources/domotica.css"> 

</head>
<body>
<div class="container-fluid">
  <div class="panel panel-consigna">
    <div class="row">
      <div class="col-sm-12">
         <span class="text-planta">Graficos de Temperaturas</span>
      </div>
    </div>
    <div class="row row-int-nomargin">
        <span>Fecha Datos: </span>
        <span><input class="inputCalendar" type="text" id="datepicker"></span>
    </div>
  </div>
  
  <div class="panel panel-normal">
    <div class="row">
      <div class="col-sm-12">
         <span class="text-planta">Temperaturas Salon</span>
      </div>
    </div>
    
    <div class="row">
      <div class="col-sm-12">
         <span>Tiempo con calefaccion: </span>
         <span id="idTimeHeatOn_salon"> 0 min</span>
      </div>
    </div>
    
    <div class="row">
      <div class="col-sm-12">
        <div id="chart_salon"></div>
      </div>
    </div>
  </div>

  <div class="panel panel-normal">
    <div class="row">
      <div class="col-sm-12">
         <span class="text-planta">Temperaturas Despacho</span>
      </div>
    </div>
    
    <div class="row">
      <div class="col-sm-12">
         <span>Tiempo con calefaccion: </span>
         <span id="idTimeHeatOn_despacho"> 0 min</span>
      </div>
    </div>
    
    <div class="row">
      <div class="col-sm-12">
        <div id="chart_despacho"></div>
      </div>
    </div>
  </div>
  
  <div class="panel panel-normal">
    <div class="row">
      <div class="col-sm-12">
         <span class="text-planta">Temperaturas Cocina</span>
      </div>
    </div>
    
    <div class="row">
      <div class="col-sm-12">
         <span>Tiempo con calefaccion: </span>
         <span id="idTimeHeatOn_cocina"> 0 min</span>
      </div>
    </div>
    
    <div class="row">
      <div class="col-sm-12">
        <div id="chart_cocina"></div>
      </div>
    </div>
  </div>
  
  <div class="panel panel-normal">
    <div class="row">
      <div class="col-sm-12">
         <span class="text-planta">Temperaturas Habitacion Principal</span>
      </div>
    </div>
    
    <div class="row">
      <div class="col-sm-12">
         <span>Tiempo con calefaccion: </span>
         <span id="idTimeHeatOn_principal"> 0 min</span>
      </div>
    </div>
    
    <div class="row">
      <div class="col-sm-12">
        <div id="chart_principal"></div>
      </div>
    </div>
  </div>
  
  <div class="panel panel-normal">
    <div class="row">
      <div class="col-sm-12">
         <span class="text-planta">Temperaturas Habitacion Sofia</span>
      </div>
    </div>
    
    <div class="row">
      <div class="col-sm-12">
         <span>Tiempo con calefaccion: </span>
         <span id="idTimeHeatOn_sofia"> 0 min</span>
      </div>
    </div>
    
    <div class="row">
      <div class="col-sm-12">
        <div id="chart_sofia"></div>
      </div>
    </div>
  </div>
  
  <div class="panel panel-normal">
    <div class="row">
      <div class="col-sm-12">
         <span class="text-planta">Temperaturas Habitacion Alvaro</span>
      </div>
    </div>
    
    <div class="row">
      <div class="col-sm-12">
         <span>Tiempo con calefaccion: </span>
         <span id="idTimeHeatOn_alvaro"> 0 min</span>
      </div>
    </div>
    
    <div class="row">
      <div class="col-sm-12">
        <div id="chart_alvaro"></div>
      </div>
    </div>
  </div>
  
</div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      
      
      function triggerCharts(){
          updateChartData('salon')
          updateChartData('despacho')
          updateChartData('cocina')
          updateChartData('principal')
          updateChartData('sofia')
          updateChartData('alvaro')

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
      
        var dataTable = new google.visualization.DataTable();
        var nMinHeaterOn = 0;
        var nHourHeaterOn = 0;
        var nTotalMin = 0;
        
        dataTable.addColumn('string', 'Hours');
        dataTable.addColumn('number', 'Temps');
        dataTable.addColumn('number', 'Consigna');
        dataTable.addColumn('number', 'Caldera');
        // consideramos que si el primero tiene consigna a 0 es que esta apagada
        var calOnOff = 0;
        if (jsonObj.length > 0 && Number(jsonObj[0][2]) > 5){
            calOnOff = 1;
        }
        for(var i = 0; i < jsonObj.length; i++){
            if (calOnOff == 0){
                dataTable.addRows([[jsonObj[i][0], Number(jsonObj[i][1]), Number(jsonObj[i][1]), Number(jsonObj[i][3])]]);
            } else {
                dataTable.addRows([[jsonObj[i][0], Number(jsonObj[i][1]), Number(jsonObj[i][2]), Number(jsonObj[i][3])]]);
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
        
        // Normalizamos horas minutos de nMinHeaterOn
        // Usamos misma variable para convertir a %
        
        nTotalMin = 100*((nHourHeaterOn * 60) + nMinHeaterOn) / nTotalMin;
        
        

        // A column for custom tooltip content
        //dataTable.addColumn({type: 'string', role: 'tooltip'});
      
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
              color: '#b7c0c7',
              fontSize: 8
            },
            //textPosition: 'none',
            //title: '',
          },
          vAxes: {
            // Adds titles to each axis.
            0: {format: '##.#º'},
            1: {maxValue: 100, minValue: 0, textPosition: 'none'}
          },
          vAxis: { 
            gridlines: { 
	          color: '#b7c0c7' 
	        },
            textStyle: { 
            color: '#b7c0c7' 
            },
          },
          series: {0: {targetAxisIndex:0, type: 'line', curveType: 'function', color: 'yellow', lineWidth: 3},
                   1:{targetAxisIndex:0, type: 'line', color: 'limegreen', lineWidth: 3},
                   2:{targetAxisIndex:1, type: 'steppedArea'},
                  },
        };
        var roomid="chart_"+room;
        var chart = new google.visualization.ComboChart(document.getElementById(roomid));

        chart.draw(dataTable, options);
        
        var idHeaterTime="idTimeHeatOn_"+room;
        var szHourHeaterOn = "0" + nHourHeaterOn.toString();
        szHourHeaterOn = szHourHeaterOn.substr(-2, 2);
        var szMinHeaterOn = "0" + nMinHeaterOn.toString();
        szMinHeaterOn = szMinHeaterOn.substr(-2, 2);
        
        document.getElementById(idHeaterTime).innerHTML = szHourHeaterOn + ":" + szMinHeaterOn + "h (" + nTotalMin.toFixed(0) + "%)";
      }

      google.charts.load('current', {packages: ['corechart']});
      google.charts.setOnLoadCallback(triggerCharts);
      
      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth()+1; //January is 0!
      var yyyy = today.getFullYear();
      window.onresize=triggerCharts;
      
      $(function () {
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
