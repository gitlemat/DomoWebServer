<?php
  header('Content-Type: application/json');
  $wemos=$_GET["wemos"];
  $respuesta=[];


  $sqlquery="select * from temps ORDER BY fecha DESC LIMIT 1;";
  
  $mysqli = new mysqli("192.168.2.129", "sergio", "licaoasi", "domotica17");
  $resultado = $mysqli->query("$sqlquery");
  $fila = $resultado->fetch_assoc();
  
  $CalderaOnOffSalon=$fila["cal_Salon"];
  $CalderaOnOffDespacho=$fila["cal_Despacho"];
  $CalderaOnOffCocina=$fila["cal_Cocina"];
  $CalderaOnOffPrincipal=$fila["cal_Principal"];
  $CalderaOnOffSofia=$fila["cal_Sofia"];
  $CalderaOnOffAlvaro=$fila["cal_Alvaro"];

  if ($CalderaOnOffSalon == "on"){
    $nCalderaOnOffSalon=1;
  } else {
    $nCalderaOnOffSalon=0;
  }
  if ($CalderaOnOffDespacho == "on"){
    $nCalderaOnOffDespacho=1;
  } else {
    $nCalderaOnOffDespacho=0;
  }
  if ($CalderaOnOffCocina == "on"){
    $nCalderaOnOffCocina=1;
  } else {
    $nCalderaOnOffCocina=0;
  }
  if ($CalderaOnOffPrincipal == "on"){
    $nCalderaOnOffPrincipal=1;
  } else {
    $nCalderaOnOffPrincipal=0;
  }
  if ($CalderaOnOffSofia == "on"){
    $nCalderaOnOffSofia=1;
  } else {
    $nCalderaOnOffSofia=0;
  }
  if ($CalderaOnOffAlvaro == "on"){
    $nCalderaOnOffAlvaro=1;
  } else {
    $nCalderaOnOffAlvaro=0;
  }
  
  $respuesta[0]=$nCalderaOnOffSalon;
  $respuesta[1]=$nCalderaOnOffDespacho;
  $respuesta[2]=$nCalderaOnOffCocina;
  
  if ($wemos == "baja"){
    $respuesta[0]=$nCalderaOnOffSalon;
    $respuesta[1]=$nCalderaOnOffDespacho;
    $respuesta[2]=$nCalderaOnOffCocina;

  }
  if ($wemos == "habitaciones"){
    $respuesta[0]=$nCalderaOnOffPrincipal;
    $respuesta[1]=$nCalderaOnOffAlvaro;
    $respuesta[2]=$nCalderaOnOffSofia;

  }

  echo json_encode($respuesta);

?>

