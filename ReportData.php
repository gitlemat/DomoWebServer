<?php
  header('Content-Type: application/json');
  $room=$_GET["room"];
    
  // SELECT DATE_FORMAT(fecha, '%H') hora, t_salon temp FROM (SELECT fecha, t_salon FROM temps WHERE fecha >= DATE_SUB(NOW(), INTERVAL 30 HOUR) GROUP BY date (fecha), Hour(fecha) ORDER BY fecha DESC LIMIT 24) sub ORDER BY fecha ASC;
  $sqlquery="SELECT DATE_FORMAT(fecha, '%H') hora, t_".$room." temp FROM (SELECT fecha, t_".$room." FROM temps WHERE fecha >= DATE_SUB(NOW(), INTERVAL 30 HOUR) GROUP BY date (fecha), Hour(fecha) ORDER BY fecha DESC LIMIT 24) sub ORDER BY fecha ASC;";

  $mysqli = new mysqli("192.168.2.129", "sergio", "licaoasi", "domotica17");
  $resultado = $mysqli->query("$sqlquery");
  while ($fila = $resultado->fetch_assoc()) {
        $arr[0]=$fila["hora"]."H";
        $arr[1]=$fila["temp"];
        $arrTotal[]=$arr;
  }

    /* liberar el conjunto de resultados */ 
  $resultado->free();  

  echo json_encode($arrTotal);
?>
