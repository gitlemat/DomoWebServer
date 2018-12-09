<?php
  header('Content-Type: application/json');
  $room=$_GET["room"];
  $day=$_GET["day"];
  $month=$_GET["month"];
  $year=$_GET["year"];

  $arr=array();
  $arrTotal=array();
  $columna1="t_".$room;
  $columna2="tc_".$room;
  $columna3="cal_".$room;

  $qfecha=$year."-".$month."-".$day;

  $room_query=$columna1.", ".$columna2.", ".$columna3;
  $sqlquery="select DATE_FORMAT(fecha, '%H:%i') fecha, ".$room_query." from temps WHERE DATE(fecha) = '".$qfecha."';";

  $mysqli = new mysqli("192.168.2.129", "sergio", "licaoasi", "domotica17");
  $resultado = $mysqli->query("$sqlquery");
  while ($fila = $resultado->fetch_assoc()) {
        $arr[0]=$fila["fecha"];
        $arr[1]=$fila[$columna1];
        $arr[2]=$fila[$columna2];
        if ($fila[$columna3] == "on"){
        	$arr[3]=100;
        } else {
        	$arr[3]=0;
        }
        $arrTotal[]=$arr;
  }

    /* liberar el conjunto de resultados */ 
  $resultado->free();

  echo json_encode($arrTotal);
?>
