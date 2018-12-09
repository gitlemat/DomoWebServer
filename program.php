<!DOCTYPE html>
<html lang="en">
<head>
  <title>DOMOTICA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="resources/airzone.css"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style>
    body {
      color: #b7c0c7;
      background: #222729;

    }
    a:link {
      color: #b7c0c7;
    }

    a:visited {
      color: #b7c0c7;
    }
    a:hover {
      color: #b7d0d7;
    }
    a:active {
      color: #c7c0c7;
    }
    @font-face {
      font-family: "airzone";
      src: url("./resources/airzone.eot");
      src: url("./resources/airzone.eot?#iefix") format("embedded-opentype"),
      url("./resources/airzone.woff") format("woff"),
      url("./resources/airzone.ttf") format("truetype"),
      url("./resources/airzone.svg#airzone") format("svg");
      font-weight: normal;
      font-style: normal;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    @font-face {
      font-family: DomoHelvFont;
      src: url(resources/HelveticaNeueLTStd-LtCn.otf);
    }

    @font-face {
      font-family: DomoHelvFontSlim;
      src: url(resources/HelveticaNeueLTStd-UltLtCn.otf);
    }

    @font-face {
      font-family: DomoHelvFont;
      src: url(resources/HelveticaNeueLTStd-Cn.otf);
      font-weight: bold;
    }

    [class^="flaticon-"]:before, [class*=" flaticon-"]:before, [class^="flaticon-"]:after, [class*=" flaticon-"]:after {
      font-family: "airzone";
      font-style: normal;
      //margin-left: 20px;
      //color: #b7c0c7;
    }
    .icon-deafult-size {
      font-size: 12px;
    }
 
    .icon-size-24 {
      font-size: 24px;
    }   
    
    div {
      font-family: DomoHelvFont;
    }
    .text-consigna {
      font-family: DomoHelvFontSlim;
      font-size: 54px;
      text-align: center;
      max-width: 150px;
    }
    .text-planta {
      font-family: DomoHelvFontSlim;
      font-size: 32px;
    }
    .text-left {
      text-align:left;
      float:left;
    }

    .text-right {
      text-align:right;
      float:right;
    }
    .text-center {
      text-align:center;
    }

    .text-mini1 {
      font-size: 14px;
      margin-right: 4px;
      margin-top: 10px;
    }

    .row-eq-height {
      display: -webkit-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
    }
    .fixed-el {
      max-width: 21px;
      max-height: 21px;
      margin-right: 10px;
      margin-top: 5px;
    }

    .obj-oculto {
      visibility: hidden;
    }
    .apagado {
      color: #555;
    }

    .encendido{
      color: #b7c0c7;
    } 

    .panel-normal {
      padding-left: 20px;
      padding-right: 20px;
      padding-top: 20px;
      background: #373e45;
    }
    .panel-consigna {
      padding-left: 20px;
      padding-right: 20px;
      padding-top: 20px;
      margin-top: 20px;
      background: #373e45;
    }
    .well-program{
      border: 0px;
      padding-top: 5px;
      padding-bottom: 5px;
      padding-left: 0px;
      padding-right: 0px;
      margin-left: -5px;
      #font-size: 25px;
    }
    .well-grad-temp-ok{
      background: linear-gradient(to right, #222729 , #222729 70%, #008000); /* Standard syntax (must be last) */
    }
    .well-grad-temp-cold{
      background: linear-gradient(to right, #222729 , #222729 70%, #0041d8); /* Standard syntax (must be last) */
    }
    .well-grad-temp-hot{
      background: linear-gradient(to right, #222729 , #222729 70%, #800000); /* Standard syntax (must be last) */
    }
    .well-color-gen{
      background: #222729;
    }
    .button-consigna {
      background-color: #373e45;
      border: none;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 54px;
      cursor: pointer;
    }
    .button{
      cursor: pointer;
      padding-left: 0px;
      padding-right: 0px;
      padding-top: 0px;
      padding-bottom: 0px;
      margin-top: 0px;
      border-width: 0px;
      background-color: inherit;
    }
    
    .button-letras{
      cursor: pointer;
      padding-left: 7px;
      padding-right: 0px;
      padding-top: 0px;
      padding-bottom: 0px;
      margin-top: 0px;
      border-width: 0px;
      background-color: inherit;
    }

    .consigna-center {
    width: 100%;
    text-align: center;
    }
    .no-padding{
      padding-left: 0px;
      padding-right: 0px;
      padding-top: 0px;
      margin-top: 0px;
    }
    .rango{
      margin-bottom: 19.556px;
    }
    
    .boxspace{
      padding-right: 5px;
      padding-top: 0px;
      padding-bottom: 0px;
    }      

    .fechacheckbox > [type="checkbox"]:not(:checked) + label:before,
    .fechacheckbox > [type="checkbox"]:checked + label:before{
      background-color: #173e45;
    }
  </style>

</head>
<body>


<?php
  $fileRoot="/home/sergio/Domotica/CONFIG/";
  $filename=$fileRoot."Temp_Consigna";
  $fileTemp= file($filename);

  $nProgram=0; #Distinto a nLine por si hay comments o lo que sea

  $line= $fileTemp[2];
  $wordsLine=explode(' ', $line);
  $progDateInit[$nProgram]=strtotime("----/--/--");
  $progDateFin[$nProgram]=strtotime("----/--/--");
  $progDateWeekDays[$nProgram]="LMXJVSD";
  $progHourInit[$nProgram][0]="00";
  $progHourFin[$nProgram][0]="23";
  $progTempConsigna[$nProgram][0]=number_format((float)$wordsLine[0], 1, '.', '');
  $progNrango[$nProgram]=1;

  #Ahora los de dia de semana
  $nLine=3;
  $line=$fileTemp[$nLine];

  while ($fileTemp[$nLine]) {
    $nProgram=$nProgram+1;
    $wordsLine=explode(' ', $line);
    $dateDays=$wordsLine[0];
    if (substr($dateDays,0,1)=="X"){
      $dateInit="----/--/--";
    } else {
      $dateInit=substr($dateDays,0,4)."/".substr($dateDays,4,2)."/".substr($dateDays,6,2);
    }
    if (substr($dateDays,2,1)=="X"){
      $dateEnd="----/--/--";
    } else {
      $dateEnd=substr($dateDays,9,4)."/".substr($dateDays,13,2)."/".substr($dateDays,15,2);
    }
    $progDateInit[$nProgram]=$dateInit;
    $progDateFin[$nProgram]=$dateEnd;
    $wordsLine=explode(' ', $line);
    $weekdays=$wordsLine[1];
    $progDateWeekDays[$nProgram]=$weekdays;
    $nWord=2;
    $nIter=0;
    while ($wordsLine[$nWord]){
      $hoursInit=(int)substr($wordsLine[$nWord],0,2);
      $hoursEnd=(int)substr($wordsLine[$nWord],3,2);
      $progHourInit[$nProgram][$nIter]=sprintf("%02d",$hoursInit);
      $progHourFin[$nProgram][$nIter]=sprintf("%02d",$hoursEnd);
      $progTempConsigna[$nProgram][$nIter]=number_format((float)$wordsLine[$nWord+1], 1, '.', '');
      $nWord=$nWord+2;
      $nIter=$nIter+1;
    }
    $progNrango[$nProgram]=$nIter;
    $nLine=$nLine+1;
    $line=$fileTemp[$nLine];
  }

?>
<script type="text/javascript">
  // hay que pàsar las variables a JS
  
  function GrabarTodo(){
  
    var data=[];
    var ajax_url = "writeConsigna.php";
    var ajax_request = new XMLHttpRequest();
    var xdata ="";
    //Recorrer todos los programas
    
    data[0]=progTempConsigna[0][0];
    
    for (orden=1;orden<=nProgramValid;orden++){
      for (n=0;n<=nProgram;n++){
        if (progOrden[n]==orden){
        
          if (progDateInit[n]=="----/--/--"){
             xdata="X-X"
          } else {
             xdata=progDateInit[n].slice(0,4)+progDateInit[n].slice(5,7)+progDateInit[n].slice(8,10);
             xdata+="-"+progDateFin[n].slice(0,4)+progDateFin[n].slice(5,7)+progDateFin[n].slice(8,10);
          }
          
          data[orden]=xdata;
          
          data[orden]+=" "+progDateWeekDays[n];
          
          // Ahora todos los rangos de cada programa
          
          for (ordenR=0;ordenR<=progNrangoValid[n];ordenR++){
            for (n2=0;n2<=progNrango[n];n2++){
              if (progRangoOrden[n][n2]==ordenR){
                 //Añadimos los strings
                 xdata=progHourInit[n][n2]+"-"+progHourFin[n][n2]+" "+progTempConsigna[n][n2];
                 data[orden]+=" "+xdata;
                 
              }
            }
          }
        }
      }
    }


    ajax_request.open( "POST", ajax_url, true);
    ajax_request.setRequestHeader("Content-type", "application/json");
    
    dataJSON = JSON.stringify(data);
    ajax_request.send(dataJSON);

    return;
  };
  
  
  function ConsignaDown(){
    var targetel=document.getElementById('TempConsignaId');
    var newTemp=Number(progTempConsigna[0][0])-0.5;
    progTempConsigna[0][0]=newTemp.toString();
    targetel.innerHTML=progTempConsigna[0][0]+"º";
  };

  function ConsignaUp(){
    var targetel=document.getElementById('TempConsignaId');
    var newTemp=Number(progTempConsigna[0][0])+0.5;
    progTempConsigna[0][0]=newTemp.toString();
    targetel.innerHTML=progTempConsigna[0][0]+"º";
  };
  
  function changeDate(programa, signo, ymd, initEnd){
    if (initEnd==0){
       targetidroot="idFechaInit";
    } else {
       targetidroot="idFechaFin";
    }
    if (ymd == "y"){
      topvalue=2970;
      minvalue=1970;
      targetidroot+="Year";
    }else if (ymd == "m"){
      topvalue=12;
      minvalue=1;
      targetidroot+="Month"; 
    } else {
      topvalue=31;
      minvalue=1;
      targetidroot+="Day";
    }
    targetidroot+=programa.toString();
    var targetel=document.getElementById(targetidroot);
    var value=Number(targetel.innerHTML);
    if (signo==0 && value>minvalue) {
      value-=1;
    }
    if (signo==1 && value<topvalue) {
      value+=1;
    }

    if (initEnd==0){
      if (ymd == "y"){
         targetstr=value.toString();
         progDateInit[programa]=targetstr+progDateInit[programa].slice(4,10);
      } else if (ymd == "m"){
         targetstr="0"+value.toString();
         targetstr=targetstr.substring(targetstr.length-2);
         progDateInit[programa]=progDateInit[programa].slice(0,5)+targetstr+progDateInit[programa].slice(7,10);
      } else {
         targetstr="0"+value.toString();
         targetstr=targetstr.substring(targetstr.length-2);
         progDateInit[programa]=progDateInit[programa].slice(0,8)+targetstr;
      }
    } else { 
      if (ymd == "y"){
         targetstr=value.toString();
         progDateFin[programa]=targetstr.toString()+progDateFin[programa].slice(4,10);
      } else if (ymd == "m"){
         targetstr="0"+value.toString();
         targetstr=targetstr.substring(targetstr.length-2);
         progDateFin[programa]=progDateFin[programa].slice(0,5)+targetstr+progDateFin[programa].slice(7,10);
      } else {
         targetstr="0"+value.toString();
         targetstr=targetstr.substring(targetstr.length-2);
         progDateFin[programa]=progDateFin[programa].slice(0,8)+targetstr;
      }
    }
    targetel.innerHTML=targetstr;
  }; 

  function switchWeekDay(programa, day){
    var dias=[0,0,0,0,0,0,0];
    var diasfinal="";
    var dia_valor;
    
    if (progDateWeekDays[programa].indexOf("L")>-1){
        dias[0]=1;
    } 
    if (progDateWeekDays[programa].indexOf("M")>-1){
        dias[1]=1;
    } 
    if (progDateWeekDays[programa].indexOf("X")>-1){
        dias[2]=1;
    } 
    if (progDateWeekDays[programa].indexOf("J")>-1){
        dias[3]=1;
    } 
    if (progDateWeekDays[programa].indexOf("V")>-1){
        dias[4]=1;
    } 
    if (progDateWeekDays[programa].indexOf("S")>-1){
        dias[5]=1;
    } 
    if (progDateWeekDays[programa].indexOf("D")>-1){
        dias[6]=1;
    } 
    
    if (day=="L"){
        dias[0]+=1;
        dia_valor=dias[0];
        idDia="idMonday"+programa.toString();
    } 
    if (day=="M"){
        dias[1]+=1;
        dia_valor=dias[1];
        idDia="idTuesday"+programa.toString();
    } 
    if (day=="X"){
        dias[2]+=1;
        dia_valor=dias[2];
        idDia="idWednesday"+programa.toString();
    } 
    if (day=="J"){
        dias[3]+=1;
        dia_valor=dias[3];
        idDia="idThursday"+programa.toString();
    } 
    if (day=="V"){
        dias[4]+=1;
        dia_valor=dias[4];
        idDia="idFriday"+programa.toString();
    } 
    if (day=="S"){
        dias[5]+=1;
        dia_valor=dias[5];
        idDia="idSaturday"+programa.toString();
    } 
    if (day=="D"){
        dias[6]+=1;
        dia_valor=dias[6];
        idDia="idSunday"+programa.toString();
    } 
    
    if (dias[0]==1){
    diasfinal+="L";
    }
    
    if (dias[1]==1){
    diasfinal+="M";
    }
    
    if (dias[2]==1){
    diasfinal+="X";
    }
    
    if (dias[3]==1){
    diasfinal+="J";
    }
    
    if (dias[4]==1){
    diasfinal+="V";
    }
    
    if (dias[5]==1){
    diasfinal+="S";
    }
    
    if (dias[6]==1){
    diasfinal+="D";
    }
    
    progDateWeekDays[programa]=diasfinal;
    targetel=document.getElementById(idDia);
    
    if (dia_valor==1){
		targetel.className="button";
	} else {
		targetel.className="button apagado";
	} 

    
  };
  function changeDateCheck(programa){
    var today = new Date();
    var dd = today.getDate();
    dd="0"+dd.toString();
    dd=dd.substring(dd.length-2);
    var mm = today.getMonth()+1; //January is 0!
    mm="0"+mm.toString();
    mm=mm.substring(mm.length-2);
    var yyyy = today.getFullYear();

    idCheck="FechaInitCheck"+programa;
    idYearInit="idFechaInitYear"+programa;
    idMonthInit="idFechaInitMonth"+programa;
    idDayInit="idFechaInitDay"+programa;
    idYearUpInit="idFechaInitYearUp"+programa;
    idYearDownInit="idFechaInitYearDown"+programa;
    idMonthUpInit="idFechaInitMonthUp"+programa;
    idMonthDownInit="idFechaInitMonthDown"+programa;
    idDayUpInit="idFechaInitDayUp"+programa;
    idDayDownInit="idFechaInitDayDown"+programa;

    idYearFin="idFechaFinYear"+programa;
    idMonthFin="idFechaFinMonth"+programa;
    idDayFin="idFechaFinDay"+programa;
    idYearUpFin="idFechaFinYearUp"+programa;
    idYearDownFin="idFechaFinYearDown"+programa;
    idMonthUpFin="idFechaFinMonthUp"+programa;
    idMonthDownFin="idFechaFinMonthDown"+programa;
    idDayUpFin="idFechaFinDayUp"+programa;
    idDayDownFin="idFechaFinDayDown"+programa;


    var elemCheck=document.getElementById(idCheck);
    var elemYearInit=document.getElementById(idYearInit);
    var elemMonthInit=document.getElementById(idMonthInit);
    var elemDayInit=document.getElementById(idDayInit);
    var elemYearUpInit=document.getElementById(idYearUpInit);
    var elemYearDownInit=document.getElementById(idYearDownInit);
    var elemMonthUpInit=document.getElementById(idMonthUpInit);
    var elemMonthDownInit=document.getElementById(idMonthDownInit);
    var elemDayUpInit=document.getElementById(idDayUpInit);
    var elemDayDownInit=document.getElementById(idDayDownInit);
    
    var elemYearFin=document.getElementById(idYearFin);
    var elemMonthFin=document.getElementById(idMonthFin);
    var elemDayFin=document.getElementById(idDayFin);
    var elemYearUpFin=document.getElementById(idYearUpFin);
    var elemYearDownFin=document.getElementById(idYearDownFin);
    var elemMonthUpFin=document.getElementById(idMonthUpFin);
    var elemMonthDownFin=document.getElementById(idMonthDownFin);
    var elemDayUpFin=document.getElementById(idDayUpFin);
    var elemDayDownFin=document.getElementById(idDayDownFin);



    if (elemCheck.checked == true){
      elemYearInit.innerHTML=yyyy;
      elemMonthInit.innerHTML=mm;
      elemDayInit.innerHTML=dd;
      elemYearInit.className="";
      elemMonthInit.className="";
      elemDayInit.className="";
      elemYearUpInit.className="button flaticon-uniE653";
      elemYearUpInit.disabled=false;
      elemYearDownInit.className="button flaticon-uniE654";
      elemYearDownInit.disabled=false;
      elemMonthUpInit.className="button flaticon-uniE653";
      elemMonthUpInit.disabled=false;
      elemMonthDownInit.className="button flaticon-uniE654";
      elemMonthDownInit.disabled=false;
      elemDayUpInit.className="button flaticon-uniE653";
      elemDayUpInit.disabled=false;
      elemDayDownInit.className="button flaticon-uniE654";
      elemDayDownInit.disabled=false;
      elemYearFin.innerHTML=yyyy;
      elemMonthFin.innerHTML=mm;
      elemDayFin.innerHTML=dd;
      elemYearFin.className="";
      elemMonthFin.className="";
      elemDayFin.className="";
      elemYearUpFin.className="button flaticon-uniE653";
      elemYearUpFin.disabled=false;
      elemYearDownFin.className="button flaticon-uniE654";
      elemYearDownFin.disabled=false;
      elemMonthUpFin.className="button flaticon-uniE653";
      elemMonthUpFin.disabled=false;
      elemMonthDownFin.className="button flaticon-uniE654";
      elemMonthDownFin.disabled=false;
      elemDayUpFin.className="button flaticon-uniE653";
      elemDayUpFin.disabled=false;
      elemDayDownFin.className="button flaticon-uniE654";
      elemDayDownFin.disabled=false;
      progDateInit[programa]=yyyy.toString()+"/"+mm.toString()+"/"+dd.toString();
      progDateFin[programa]=yyyy.toString()+"/"+mm.toString()+"/"+dd.toString();
    } else {
      elemYearInit.innerHTML="----"
      elemMonthInit.innerHTML="--";
      elemDayInit.innerHTML="--";
      elemYearInit.className="apagado";
      elemMonthInit.className="apagado";
      elemDayInit.className="apagado";
      elemYearUpInit.className="button flaticon-uniE653 apagado";
      elemYearUpInit.disabled=true;
      elemYearDownInit.className="button flaticon-uniE654 apagado";
      elemYearDownInit.disabled=true;
      elemMonthUpInit.className="button flaticon-uniE653 apagado";
      elemMonthUpInit.disabled=true;
      elemMonthDownInit.className="button flaticon-uniE654 apagado";
      elemMonthDownInit.disabled=true;
      elemDayUpInit.className="button flaticon-uniE653 apagado";
      elemDayUpInit.disabled=true;
      elemDayDownInit.className="button flaticon-uniE654 apagado";
      elemDayDownInit.disabled=true;
      elemYearFin.innerHTML="----"
      elemMonthFin.innerHTML="--";
      elemDayFin.innerHTML="--";
      elemYearFin.className="apagado";
      elemMonthFin.className="apagado";
      elemDayFin.className="apagado";
      elemYearUpFin.className="button flaticon-uniE653 apagado";
      elemYearUpFin.disabled=true;
      elemYearDownFin.className="button flaticon-uniE654 apagado";
      elemYearDownFin.disabled=true;
      elemMonthUpFin.className="button flaticon-uniE653 apagado";
      elemMonthUpFin.disabled=true;
      elemMonthDownFin.className="button flaticon-uniE654 apagado";
      elemMonthDownFin.disabled=true;
      elemDayUpFin.className="button flaticon-uniE653 apagado";
      elemDayUpFin.disabled=true;
      elemDayDownFin.className="button flaticon-uniE654 apagado";
      elemDayDownFin.disabled=true;
      progDateInit[programa]="----/--/--";
      progDateFin[programa]="----/--/--";
    }
  };

  function changeRango(programa,rango,signo,initFinTemp){
    if (initFinTemp == 0){
      targetidroot="idHoraInit";
      valLimit=23;
      delta=1;
      unit="H";
    } else if (initFinTemp == 1) {
      targetidroot="idHoraFin";
      valLimit=23;
      delta=1;
      unit="H";
    } else {
      targetidroot="idTempConsigna"; 
      valLimit=40;
      delta=0.5;
      unit="º";
    } 

    targetid=targetidroot+programa+"-"+rango;
    targetel=document.getElementById(targetid);
    targetvalueHTML=targetel.innerHTML;
    targetvalueStr=targetvalueHTML.substring(0,targetvalueHTML.length-1);
    targetvalue=Number(targetvalueStr);

    if (signo == 0){
       if (targetvalue>0){
         targetvalue=targetvalue-delta;
       }
    } else {
       if (targetvalue<valLimit){
         targetvalue=targetvalue+delta;
      }
    }
    targetstr=targetvalue.toString();

    if (initFinTemp==0){
      targetstr=targetvalue.toString();
      targetstr="0"+targetstr;
      targetstr=targetstr.substring(targetstr.length-2);
      progHourInit[programa][rango]=targetstr;
    } else if (initFinTemp==1){
      targetstr=targetvalue.toString();
      targetstr="0"+targetstr;
      targetstr=targetstr.substring(targetstr.length-2);
      progHourFin[programa][rango]=targetstr;
    } else {
      targetvalue=targetvalue.toFixed(1);
      targetstr=targetvalue.toString();
      progTempConsigna[programa][rango]=targetstr;
    }
    targetstr=targetstr+unit;
    targetel.innerHTML=targetstr;
    //alert (targetstr);return false;
  };

  function addRango(programa){
    progNrango[programa]+=1;
    var nextRango=progNrango[programa];
    var idParent="idPanel"+programa;
    var idLastRango="idLastRango"+programa;
    progNrangoValid[programa]+=1;
    progRangoOrden[programa][nextRango]=progNrangoValid[programa];
    progHourInit[programa][nextRango]="09";
    progHourFin[programa][nextRango]="13";
    progTempConsigna[programa][nextRango]="20.0";

    var iDivWell = document.createElement('div');

    iDivWell.id = 'idRango'+programa+"-"+nextRango.toString();
    iDivWell.className = 'row well well-program well-color-gen';

    var elLastRango = document.getElementById(idLastRango);
    document.getElementById(idParent).insertBefore(iDivWell, elLastRango);
   
    // Columna izda para etiqueta y X
    var columnIzda = document.createElement('div');
    columnIzda.className = 'col-xs-4';
    iDivWell.appendChild(columnIzda);

    var textRango = document.createElement('div');
    textRango.className = 'rango';
    textRango.id = "idRangoText"+programa.toString()+"-"+nextRango.toString();
    columnIzda.appendChild(textRango);
    textRango.innerHTML="Rango "+(progNrangoValid[programa]+1).toString();

    var delRango = document.createElement('div');
    delRango.className = 'button flaticon-uniE60C';
    delRango.id = "idRangoText"+programa.toString()+"-"+nextRango.toString();
    delRango.onclick = function(){removeRango(programa, nextRango)};  
    columnIzda.appendChild(delRango);
    delRango.innerHTML="";

    // Columna dcha para horas y temps 
    var columnDcha = document.createElement('div');
    columnDcha.className = 'col-xs-8';
    iDivWell.appendChild(columnDcha);

    var fila1 = document.createElement('div');
    fila1.className = 'row';
    columnDcha.appendChild(fila1);

    var fila1col1 = document.createElement('div');
    fila1col1.className = 'col-xs-6';
    fila1.appendChild(fila1col1);

    var fila1col1div = document.createElement('div');
    fila1col1.appendChild(fila1col1div);
    fila1col1div.innerHTML="Hora Inicio:";

    var fila1col2 = document.createElement('div');
    fila1col2.className = 'col-xs-2';
    fila1.appendChild(fila1col2);

    var fila1col2div = document.createElement('div');
    fila1col2div.className="button text-right";
    fila1col2div.onclick = function(){changeRango(programa, nextRango,0,0)}; 
    fila1col2.appendChild(fila1col2div);
    fila1col2div.innerHTML="-";

    var fila1col3 = document.createElement('div');
    fila1col3.className = 'col-xs-2 no-padding';
    fila1.appendChild(fila1col3);

    var fila1col3div = document.createElement('div');
    fila1col3div.className="text-center";
    fila1col3div.id="idHoraInit"+programa.toString()+"-"+nextRango.toString();
    fila1col3.appendChild(fila1col3div);
    fila1col3div.innerHTML="09H";

    var fila1col4 = document.createElement('div');
    fila1col4.className = 'col-xs-2';
    fila1.appendChild(fila1col4);

    var fila1col4div = document.createElement('div');
    fila1col4div.className="button text-left";
    fila1col4div.onclick = function(){changeRango(programa, nextRango,1,0)};
    fila1col4.appendChild(fila1col4div);
    fila1col4div.innerHTML="+";

    var fila2 = document.createElement('div');
    fila2.className = 'row';
    columnDcha.appendChild(fila2);

    var fila2col1 = document.createElement('div');
    fila2col1.className = 'col-xs-6';
    fila2.appendChild(fila2col1);

    var fila2col1div = document.createElement('div');
    fila2col1.appendChild(fila2col1div);
    fila2col1div.innerHTML="Hora Fin:";

    var fila2col2 = document.createElement('div');
    fila2col2.className = 'col-xs-2';
    fila2.appendChild(fila2col2);
    
    var fila2col2div = document.createElement('div');
    fila2col2div.className="button text-right";
    fila2col2div.onclick = function(){changeRango(programa, nextRango,0,1)};
    fila2col2.appendChild(fila2col2div);
    fila2col2div.innerHTML="-";

    var fila2col3 = document.createElement('div');
    fila2col3.className = 'col-xs-2 no-padding';
    fila2.appendChild(fila2col3);
    
    var fila2col3div = document.createElement('div');
    fila2col3div.className="text-center";
    fila2col3div.id="idHoraFin"+programa.toString()+"-"+nextRango.toString();
    fila2col3.appendChild(fila2col3div);
    fila2col3div.innerHTML="13H";

    var fila2col4 = document.createElement('div');
    fila2col4.className = 'col-xs-2';
    fila2.appendChild(fila2col4);

    var fila2col4div = document.createElement('div');
    fila2col4div.className="button text-left";
    fila2col4div.onclick = function(){changeRango(programa, nextRango,1,1)};
    fila2col4.appendChild(fila2col4div);
    fila2col4div.innerHTML="+";

    var fila3 = document.createElement('div');
    fila3.className = 'row';
    columnDcha.appendChild(fila3); 

    var fila3col1 = document.createElement('div');
    fila3col1.className = 'col-xs-6';
    fila3.appendChild(fila3col1);

    var fila3col1div = document.createElement('div');
    fila3col1.appendChild(fila3col1div);
    fila3col1div.innerHTML="Temp:";

    var fila3col2 = document.createElement('div');
    fila3col2.className = 'col-xs-2';
    fila3.appendChild(fila3col2);
    
    var fila3col2div = document.createElement('div');
    fila3col2div.className="button text-right";
    fila3col2div.onclick = function(){changeRango(programa, nextRango,0,2)};
    fila3col2.appendChild(fila3col2div);
    fila3col2div.innerHTML="-";

    var fila3col3 = document.createElement('div');
    fila3col3.className = 'col-xs-2 no-padding';
    fila3.appendChild(fila3col3);
    
    var fila3col3div = document.createElement('div');
    fila3col3div.className="text-center";
    fila3col3div.id="idTempConsigna"+programa.toString()+"-"+nextRango.toString();
    fila3col3.appendChild(fila3col3div);
    fila3col3div.innerHTML="22º";

    var fila3col4 = document.createElement('div');
    fila3col4.className = 'col-xs-2';
    fila3.appendChild(fila3col4);

    var fila3col4div = document.createElement('div');
    fila3col4div.className="button text-left";
    fila3col4div.onclick = function(){changeRango(programa, nextRango,1,2)};
    fila3col4.appendChild(fila3col4div);
    fila3col4div.innerHTML="+";
  };

  function removeRango(programa, rango){
    var maxRangoValid=Number(progNrangoValid[programa]);
    var orden=progRangoOrden[programa][rango];
    
    if (maxRangoValid==0){
      return;
    }
    progRangoOrden[programa][rango]=-5;
    progNrangoValid[programa]-=1;

    for (i=orden+1;i<=maxRangoValid;i++){
      for (n=0;n<=progNrango[programa];n++){
        if (progRangoOrden[programa][n]==i){
          progRangoOrden[programa][n]-=1; 
          targetId="idRangoText"+programa+"-"+n;
          targetel=document.getElementById(targetId);
          targetel.innerHTML="Rango "+Number(progRangoOrden[programa][n]+1).toString();
        }
      }
    }

    targetid="idRango"+programa+"-"+rango;
    targetel=document.getElementById(targetid);
    targetel.parentNode.removeChild(targetel);
  };
 
  function MoveProgDown(programa){
    var targetid="idPanel"+programa;
    var targetel=document.getElementById(targetid);
    var orden1=progOrden[programa];
     
    if (orden1==nProgramValid){
      return;
    }
    ordenbefore=orden1+2;
    ordenswap=orden1+1;
    
    // Hay que buscar el id del panel que tenga orden el ordenbefore y orden swap
    
    progbefore='Last';
    for (n=0;n<=nProgram;n++){
      if (progOrden[n]==ordenbefore){
        progbefore=n;        
      }
      if (progOrden[n]==ordenswap){
        progswap=n;        
      }
    }
    
    // Movemos
    
    targetbeforePanelId="idPanel"+progbefore;
    targetbeforePanelel=document.getElementById(targetbeforePanelId);
    targetel.parentNode.insertBefore(targetel, targetbeforePanelel);
    
    // ajustamos orden
    
    progOrden[programa]=ordenswap;
    progOrden[progswap]=orden1;
    
    
    // Reescribimos etiquetas
    
    targetbeforeProgId="idProg"+progswap;
    targetbeforeProgel=document.getElementById(targetbeforeProgId);
    targetbeforeProgel.innerHTML="Programa "+orden1;
    
    targetswapProgId="idProg"+programa;
    targetswapProgel=document.getElementById(targetswapProgId);
    targetswapProgel.innerHTML="Programa "+ordenswap;


  };
  
  function MoveProgUp(programa){
    var targetid="idPanel"+programa;
    var targetel=document.getElementById(targetid);
    var orden1=progOrden[programa];
    
   if (orden1==1){
      return;
    }
    ordenbefore=orden1-1;
    
    // Hay que buscar el id del panel que tenga orden el ordenbefore
    
    for (n=0;n<=nProgram;n++){
      if (progOrden[n]==ordenbefore){
        prog2=n;        
      }
    }
    
    // Movemos
    
    targetbeforePanelId="idPanel"+prog2;
    targetbeforePanelel=document.getElementById(targetbeforePanelId);
    targetel.parentNode.insertBefore(targetel, targetbeforePanelel);
    
    // ajustamos orden
    
    progOrden[programa]=ordenbefore;
    progOrden[prog2]=orden1;
    
    // Reescribimos etiquetas
    
    targetbeforeProgId="idProg"+prog2;
    targetbeforeProgel=document.getElementById(targetbeforeProgId);
    targetbeforeProgel.innerHTML="Programa "+orden1;
    
    targetswapProgId="idProg"+programa;
    targetswapProgel=document.getElementById(targetswapProgId);
    targetswapProgel.innerHTML="Programa "+ordenbefore;

  };

  function removeProgram(programa){
    var orden=progOrden[programa];
    var maxProgramValid=nProgramValid;
    progOrden[programa]=-5;
    nProgramValid-=1;
    
    for (i=orden+1;i<=maxProgramValid;i++){
      for (n=0;n<=nProgram;n++){
        if (progOrden[n]==i){
          progOrden[n]-=1; 
          targetId="idProg"+n;
          targetel=document.getElementById(targetId);
          targetel.innerHTML="Programa "+Number(progOrden[n]).toString();
        }
      }
    }
    targetid="idPanel"+programa;
    targetel=document.getElementById(targetid);
    targetel.parentNode.removeChild(targetel);

  };

  function addPrograma(){
    nProgram+=1;
    nProgramValid+=1;
    progOrden[nProgram]=nProgramValid;
    progDateInit[nProgram]="----/--/--";
    progDateFin[nProgram]="----/--/--";
    progDateWeekDays[nProgram]="LMXJVSD";
    progNrango[nProgram]=-1;
    progNrangoValid[nProgram]=-1;
    
    var programa = nProgram;
    var programavalid = nProgramValid;

    var iDiv = document.createElement('div');
    iDiv.id = 'idPanel'+nProgram.toString();
    iDiv.className = 'panel panel-normal';

    var elLastPanel = document.getElementById("idPanelLast");
    document.getElementById('idRoot').insertBefore(iDiv, elLastPanel);
    
    // Primera fila
    var innerRow = document.createElement('div');
    innerRow.className = 'row';
    iDiv.appendChild(innerRow);
    
    //////////////////////////////
    // Primera fila Etiqueta y botones
    var innerColumn = document.createElement('div');
    innerColumn.className = 'col-xs-9';
    innerRow.appendChild(innerColumn);
    
    var innerSpan = document.createElement('span');
    innerSpan.className = 'text-planta';
    innerSpan.id = 'idProg'+nProgram.toString();
    innerColumn.appendChild(innerSpan);
    
    var text = document.createTextNode("Programa "+nProgramValid.toString());
    innerSpan.appendChild(text);
    
    var innerColumn2 = document.createElement('div');
    innerColumn2.className = 'col-xs-3';
    innerRow.appendChild(innerColumn2);
    
    var innerwrapCol2 = document.createElement('div');
    innerwrapCol2.className = 'wrap';
    innerColumn2.appendChild(innerwrapCol2);
    
    var innerTrash = document.createElement('button');
    innerTrash.className = 'button flaticon-uniE60C';
    innerTrash.onclick = function(){removeProgram(programa)};
    innerwrapCol2.appendChild(innerTrash);
    
    var innerbuttonup = document.createElement('button');
    innerbuttonup.className = 'button flaticon-uniE653 text-right';
    innerbuttonup.onclick = function(){MoveProgUp(programa)};
    innerwrapCol2.appendChild(innerbuttonup);

    var innerbuttondown = document.createElement('button');
    innerbuttondown.className = 'button flaticon-uniE654 text-right';
    innerbuttondown.onclick = function(){MoveProgDown(programa)};
    innerColumn2.appendChild(innerbuttondown);


    //////////////////////////////
    // Segunda Linea
    var innerRow2 = document.createElement('div');
    innerRow2.className = 'row';
    iDiv.appendChild(innerRow2);
    
    //Columna 1
    var row2Column1 = document.createElement('div');
    row2Column1.className = 'col-xs-1 fechacheckbox boxspace';
    innerRow2.appendChild(row2Column1);
    
    var row2Col1Input = document.createElement('input');
    row2Col1Input.type = "checkbox";
    row2Col1Input.id = "FechaInitCheck"+nProgram.toString();
    row2Col1Input.onclick = function(){changeDateCheck(programa)};
    row2Column1.appendChild(row2Col1Input);
    
    //Columna 2

    var row2Column2 = document.createElement('div');
    row2Column2.className = 'col-xs-4';
    innerRow2.appendChild(row2Column2);
    
    var row2Col2Div1 = document.createElement('div');
    row2Column2.appendChild(row2Col2Div1);
    
    var row2Col2Div1text = document.createTextNode("Fecha Inicio:");
    row2Column2.appendChild(row2Col2Div1text);
    
    // Columna 2
    var row2Column3 = document.createElement('div');
    row2Column3.className = 'col-xs-3 text-center';
    innerRow2.appendChild(row2Column3);
    
    var row2Column3row1 = document.createElement('div');
    row2Column3row1.className = 'row';
    row2Column3.appendChild(row2Column3row1);
    
    var row2Column3row1button = document.createElement('button');
    row2Column3row1button.className = 'button flaticon-uniE653 apagado';
    row2Column3row1button.disabled=true;
    row2Column3row1button.id = 'idFechaInitYearUp'+nProgram.toString();
    row2Column3row1button.onclick = function(){changeDate(programa,1,'y',0)};
    row2Column3row1.appendChild(row2Column3row1button);
    
    var row2Column3row2 = document.createElement('div');
    row2Column3row2.className = 'row';
    row2Column3.appendChild(row2Column3row2);
    
    var row2Column3row2div = document.createElement('div');
    row2Column3row2div.id = 'idFechaInitYear'+nProgram.toString();
    row2Column3row2div.className = 'apagado';
    row2Column3row2.appendChild(row2Column3row2div);
    row2Column3row2div.innerHTML="----";
    
    var row2Column3row3 = document.createElement('div');
    row2Column3row3.className = 'row';
    row2Column3.appendChild(row2Column3row3);
    
    var row2Column3row3button = document.createElement('button');
    row2Column3row3button.className = 'button flaticon-uniE654 apagado';
    row2Column3row3button.disabled=true;
    row2Column3row3button.id = 'idFechaInitYearDown'+nProgram.toString();
    row2Column3row3button.onclick = function(){changeDate(programa,0,'y',0)};
    row2Column3row3.appendChild(row2Column3row3button);

    // Columna 3
    var row2Column4 = document.createElement('div');
    row2Column4.className = 'col-xs-2 text-center';
    innerRow2.appendChild(row2Column4);
    
    var row2Column4row1 = document.createElement('div');
    row2Column4row1.className = 'row';
    row2Column4.appendChild(row2Column4row1);
    
    var row2Column4row1button = document.createElement('button');
    row2Column4row1button.className = 'button flaticon-uniE653 apagado';
    row2Column4row1button.disabled=true;
    row2Column4row1button.id = 'idFechaInitMonthUp'+nProgram.toString();
    row2Column4row1button.onclick = function(){changeDate(programa,1,'m',0)};
    row2Column4row1.appendChild(row2Column4row1button);
    
    var row2Column4row2 = document.createElement('div');
    row2Column4row2.className = 'row';
    row2Column4.appendChild(row2Column4row2);
    
    var row2Column4row2div = document.createElement('div');
    row2Column4row2div.id = 'idFechaInitMonth'+nProgram.toString();
    row2Column4row2div.className = 'apagado';
    row2Column4row2.appendChild(row2Column4row2div);
    row2Column4row2div.innerHTML="--";
    
    var row2Column4row3 = document.createElement('div');
    row2Column4row3.className = 'row';
    row2Column4.appendChild(row2Column4row3);
    
    var row2Column4row3button = document.createElement('button');
    row2Column4row3button.className = 'button flaticon-uniE654 apagado';
    row2Column4row3button.disabled=true;
    row2Column4row3button.id = 'idFechaInitMonthDown'+nProgram.toString();
    row2Column4row3button.onclick = function(){changeDate(programa,0,'m',0)};
    row2Column4row3.appendChild(row2Column4row3button);
    
    // Columna 4
    var row2Column5 = document.createElement('div');
    row2Column5.className = 'col-xs-2 text-center';
    innerRow2.appendChild(row2Column5);
    
    var row2Column5row1 = document.createElement('div');
    row2Column5row1.className = 'row';
    row2Column5.appendChild(row2Column5row1);
    
    var row2Column5row1button = document.createElement('button');
    row2Column5row1button.className = 'button flaticon-uniE653 apagado';
    row2Column5row1button.disabled=true;
    row2Column5row1button.id = 'idFechaInitDayUp'+nProgram.toString();
    row2Column5row1button.onclick = function(){changeDate(programa,1,'d',0)};
    row2Column5row1.appendChild(row2Column5row1button);
    
    var row2Column5row2 = document.createElement('div');
    row2Column5row2.className = 'row';
    row2Column5.appendChild(row2Column5row2);
    
    var row2Column5row2div = document.createElement('div');
    row2Column5row2div.id = 'idFechaInitDay'+nProgram.toString();
    row2Column5row2div.className = 'apagado';
    row2Column5row2.appendChild(row2Column5row2div);
    row2Column5row2div.innerHTML="--";
    
    var row2Column5row3 = document.createElement('div');
    row2Column5row3.className = 'row';
    row2Column5.appendChild(row2Column5row3);
    
    var row2Column5row3button = document.createElement('button');
    row2Column5row3button.className = 'button flaticon-uniE654 apagado';
    row2Column5row3button.disabled=true;
    row2Column5row3button.id = 'idFechaInitDayDown'+nProgram.toString();
    row2Column5row3button.onclick = function(){changeDate(programa,0,'d',0)};
    row2Column5row3.appendChild(row2Column5row3button);
    
    
    //////////////////////////////
    // Tercera Linea (Fecha Fin)
    
    var innerRow3 = document.createElement('div');
    innerRow3.className = 'row';
    iDiv.appendChild(innerRow3);
    
    //Columna 1
    var row3Column1 = document.createElement('div');
    row3Column1.className = 'col-xs-1 boxspace';
    innerRow3.appendChild(row3Column1);
    
    var row3Col1Div = document.createElement('div');
    row3Column1.appendChild(row3Col1Div);

    //Columna 2
    var row3Column2 = document.createElement('div');
    row3Column2.className = 'col-xs-4';
    innerRow3.appendChild(row3Column2);
    
    var row3Col2Div1 = document.createElement('div');
    row3Column2.appendChild(row3Col2Div1);
    
    var row3Col2Div1text = document.createTextNode("Fecha Inicio:");
    row3Column2.appendChild(row3Col2Div1text);
    
    // Columna 2
    var row3Column3 = document.createElement('div');
    row3Column3.className = 'col-xs-3 text-center';
    innerRow3.appendChild(row3Column3);
    
    var row3Column3row1 = document.createElement('div');
    row3Column3row1.className = 'row';
    row3Column3.appendChild(row3Column3row1);
    
    var row3Column3row1button = document.createElement('button');
    row3Column3row1button.className = 'button flaticon-uniE653 apagado';
    row3Column3row1button.disabled=true;
    row3Column3row1button.id = 'idFechaFinYearUp'+nProgram.toString();
    row3Column3row1button.onclick = function(){changeDate(programa,1,'y',1)};
    row3Column3row1.appendChild(row3Column3row1button);
    
    var row3Column3row2 = document.createElement('div');
    row3Column3row2.className = 'row';
    row3Column3.appendChild(row3Column3row2);
    
    var row3Column3row2div = document.createElement('div');
    row3Column3row2div.id = 'idFechaFinYear'+nProgram.toString();
    row3Column3row2div.className = 'apagado';
    row3Column3row2.appendChild(row3Column3row2div);
    row3Column3row2div.innerHTML="----";
    
    var row3Column3row3 = document.createElement('div');
    row3Column3row3.className = 'row';
    row3Column3.appendChild(row3Column3row3);
    
    var row3Column3row3button = document.createElement('button');
    row3Column3row3button.className = 'button flaticon-uniE654 apagado';
    row3Column3row3button.disabled=true;
    row3Column3row3button.id = 'idFechaFinYearDown'+nProgram.toString();
    row3Column3row3button.onclick = function(){changeDate(programa,0,'y',1)};
    row3Column3row3.appendChild(row3Column3row3button);

    // Columna 3
    var row3Column4 = document.createElement('div');
    row3Column4.className = 'col-xs-2 text-center';
    innerRow3.appendChild(row3Column4);
    
    var row3Column4row1 = document.createElement('div');
    row3Column4row1.className = 'row';
    row3Column4.appendChild(row3Column4row1);
    
    var row3Column4row1button = document.createElement('button');
    row3Column4row1button.className = 'button flaticon-uniE653 apagado';
    row3Column4row1button.disabled=true;
    row3Column4row1button.id = 'idFechaFinMonthUp'+nProgram.toString();
    row3Column4row1button.onclick = function(){changeDate(programa,1,'m',1)};
    row3Column4row1.appendChild(row3Column4row1button);
    
    var row3Column4row2 = document.createElement('div');
    row3Column4row2.className = 'row';
    row3Column4.appendChild(row3Column4row2);
    
    var row3Column4row2div = document.createElement('div');
    row3Column4row2div.id = 'idFechaFinMonth'+nProgram.toString();
    row3Column4row2div.className = 'apagado';
    row3Column4row2.appendChild(row3Column4row2div);
    row3Column4row2div.innerHTML="--";
    
    var row3Column4row3 = document.createElement('div');
    row3Column4row3.className = 'row';
    row3Column4.appendChild(row3Column4row3);
    
    var row3Column4row3button = document.createElement('button');
    row3Column4row3button.className = 'button flaticon-uniE654 apagado';
    row3Column4row3button.disabled=true;
    row3Column4row3button.id = 'idFechaFinMonthDown'+nProgram.toString();
    row3Column4row3button.onclick = function(){changeDate(programa,0,'m',1)};
    row3Column4row3.appendChild(row3Column4row3button);
    
    // Columna 4
    var row3Column5 = document.createElement('div');
    row3Column5.className = 'col-xs-2 text-center';
    innerRow3.appendChild(row3Column5);
    
    var row3Column5row1 = document.createElement('div');
    row3Column5row1.className = 'row';
    row3Column5.appendChild(row3Column5row1);
    
    var row3Column5row1button = document.createElement('button');
    row3Column5row1button.className = 'button flaticon-uniE653 apagado';
    row3Column5row1button.disabled=true;
    row3Column5row1button.id = 'idFechaFinDayUp'+nProgram.toString();
    row3Column5row1button.onclick = function(){changeDate(programa,1,'d',1)};
    row3Column5row1.appendChild(row3Column5row1button);
    
    var row3Column5row2 = document.createElement('div');
    row3Column5row2.className = 'row';
    row3Column5.appendChild(row3Column5row2);
    
    var row3Column5row2div = document.createElement('div');
    row3Column5row2div.id = 'idFechaFinDay'+nProgram.toString();
    row3Column5row2div.className = 'apagado';
    row3Column5row2.appendChild(row3Column5row2div);
    row3Column5row2div.innerHTML="--";
    
    var row3Column5row3 = document.createElement('div');
    row3Column5row3.className = 'row';
    row3Column5.appendChild(row3Column5row3);
    
    var row3Column5row3button = document.createElement('button');
    row3Column5row3button.className = 'button flaticon-uniE654 apagado';
    row3Column5row3button.disabled=true;
    row3Column5row3button.id = 'idFechaFinDayDown'+nProgram.toString();
    row3Column5row3button.onclick = function(){changeDate(programa,0,'d',1)};
    row3Column5row3.appendChild(row3Column5row3button);
    
    //////////////////////////////
    // Cuarta Linea (Dias semana)
    
    var innerRow4 = document.createElement('div');
    innerRow4.className = 'row';
    iDiv.appendChild(innerRow4);
    
    //Columna 1
    var row4Column1 = document.createElement('div');
    row4Column1.className = 'col-xs-5';
    innerRow4.appendChild(row4Column1);
    row4Column1.innerHTML="Dias Semana";
    
    //Columna 2
    var row4Column2 = document.createElement('div');
    row4Column2.className = 'col-xs-7 text-planta';
    innerRow4.appendChild(row4Column2);
    
    var row4Column2span1 = document.createElement('span');
    row4Column2span1.className = 'button-letras';
    row4Column2span1.id = 'idMonday'+nProgram.toString();
    row4Column2span1.onclick = function(){switchWeekDay(programa,'L')};
    row4Column2.appendChild(row4Column2span1);
    row4Column2span1.innerHTML="L";
    
    var row4Column2span2 = document.createElement('span');
    row4Column2span2.className = 'button-letras';
    row4Column2span2.id = 'idTuesday'+nProgram.toString();
    row4Column2span2.onclick = function(){switchWeekDay(programa,'M')};
    row4Column2.appendChild(row4Column2span2);
    row4Column2span2.innerHTML="M";

    var row4Column2span3 = document.createElement('span');
    row4Column2span3.className = 'button-letras';
    row4Column2span3.id = 'idWednesday'+nProgram.toString();
    row4Column2span3.onclick = function(){switchWeekDay(programa,'X')};
    row4Column2.appendChild(row4Column2span3);
    row4Column2span3.innerHTML="X";

    var row4Column2span4 = document.createElement('span');
    row4Column2span4.className = 'button-letras';
    row4Column2span4.id = 'idThursday'+nProgram.toString();
    row4Column2span4.onclick = function(){switchWeekDay(programa,'J')};
    row4Column2.appendChild(row4Column2span4);
    row4Column2span4.innerHTML="J";
    
    var row4Column2span5 = document.createElement('span');
    row4Column2span5.className = 'button-letras';
    row4Column2span5.id = 'idFriday'+nProgram.toString();
    row4Column2span5.onclick = function(){switchWeekDay(programa,'V')};
    row4Column2.appendChild(row4Column2span5);
    row4Column2span5.innerHTML="V";
    
    var row4Column2span6 = document.createElement('span');
    row4Column2span6.className = 'button-letras';
    row4Column2span6.id = 'idSaturday'+nProgram.toString();
    row4Column2span6.onclick = function(){switchWeekDay(programa,'S')};
    row4Column2.appendChild(row4Column2span6);
    row4Column2span6.innerHTML="S";

    var row4Column2span7 = document.createElement('span');
    row4Column2span7.className = 'button-letras';
    row4Column2span7.id = 'idSunday'+nProgram.toString();
    row4Column2span7.onclick = function(){switchWeekDay(programa,'D')};
    row4Column2.appendChild(row4Column2span7);
    row4Column2span7.innerHTML="D";
    
    //////////////////////////////
    // Last rango
    
    var innerLast = document.createElement('div');
    innerLast.className = 'button';
    innerLast.id = 'idLastRango'+nProgram.toString();
    innerLast.addEventListener ("click", function(){addRango(programa);});
    iDiv.appendChild(innerLast);
    innerLast.innerHTML="+";
    
    addRango(programa);
  }
  
  var nProgram=<?php echo $nProgram?>;
  var nProgramValid=<?php echo $nProgram?>;
  var progOrden=new Array();
  var progDateInit=new Array();
  var progDateFin=new Array();
  var progDateWeekDays=new Array();
  var progNrango=new Array();
  var progNrangoValid=new Array();
  var progRangoOrden=new Array();
  var progHourInit=new Array();
  var progHourFin=new Array();
  var progTempConsigna=new Array();
  for (i=0; i<25; i++) {
    progRangoOrden[i]=new Array();
    progHourInit[i]=new Array();
    progHourFin[i]=new Array();
    progTempConsigna[i]=new Array();  
  } 


<?php
for ($x = 0; $x <= $nProgram; $x++) {
?>
   progOrden[<?php echo $x?>]=<?php echo $x?>;
   progDateInit[<?php echo $x?>]="<?php echo $progDateInit[$x]?>";
   progDateFin[<?php echo $x?>]="<?php echo $progDateFin[$x]?>";
   progDateWeekDays[<?php echo $x?>]="<?php echo $progDateWeekDays[$x]?>";
   progNrango[<?php echo $x?>]=<?php echo $progNrango[$x]-1?>;
   progNrangoValid[<?php echo $x?>]=<?php echo $progNrango[$x]-1?>;
   <?php
   $iter=0;
   while ($progTempConsigna[$x][$iter]) {
   ?>
     progRangoOrden[<?php echo $x?>][<?php echo $iter?>]=<?php echo $iter?>;
     progHourInit[<?php echo $x?>][<?php echo $iter?>]="<?php echo $progHourInit[$x][$iter]?>";
     progHourFin[<?php echo $x?>][<?php echo $iter?>]="<?php echo $progHourFin[$x][$iter]?>";
     progTempConsigna[<?php echo $x?>][<?php echo $iter?>]="<?php echo $progTempConsigna[$x][$iter]?>";
<?php
   $iter=$iter+1;
   }
   ?>
<?php
}
?> 
  
</script>


<div id="idRoot" class="container-fluid">
  <div id ="idPanel0" class="panel panel-consigna">
    <div class="row">
      <div class="col-xs-12">
        <button class="button flaticon-uniE612 icon-size-24 text-right" onclick="GrabarTodo()"></button>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6">
        <span class="text-planta">Consigna</span>
      </div>
      <div class="col-xs-6">
        <div class="wrap text-center">
          <button class="button flaticon-uniE654 icon-size-24 text-left" onclick="ConsignaDown()"></button>
          <span id="TempConsignaId" class="text-planta"><?php echo $progTempConsigna[0][0]?>º</span>
          <button class="button flaticon-uniE653 icon-size-24 text-right" onclick="ConsignaUp()"></button>
        </div>
      </div>
    </div>
  </div>
<?php
for ($x = 1; $x <= $nProgram; $x++) {
?>

  <div id="idPanel<?php echo $x?>" class="panel panel-normal">
    <div class="row">
      <div class="col-xs-9">
         <span id="idProg<?php echo $x?>" class="text-planta">Programa <?php echo $x?></span>
      </div>
      <div class="col-xs-3">
         <div class="wrap">
           <button class="button flaticon-uniE60C" onclick="removeProgram(<?php echo $x?>)"></button>
           <button id="idMoveProgUp<?php echo $x?>" class="button flaticon-uniE653 text-right" onclick="MoveProgUp(<?php echo $x?>)"></button>
         </div>
         <button id="idMoveProgDown<?php echo $x?>" class="button flaticon-uniE654 text-right" onclick="MoveProgDown(<?php echo $x?>)"></button>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-1 fechacheckbox boxspace">
          <input type="checkbox" onclick="changeDateCheck(<?php echo $x?>)" id="FechaInitCheck<?php echo $x?>" <?php if (strpos($progDateInit[$x],"----")===false){echo "checked=\"\"";}?>/>
      </div>
      <div class="col-xs-4">
        <div>Fecha Inicio:</div>
      </div>
      <div class="col-xs-3 text-center">
        <div class="row">
          <button id="idFechaInitYearUp<?php echo $x?>" class="button flaticon-uniE653 <?php if (strpos($progDateInit[$x],"----")!==false){echo "apagado\" disabled";}else{echo "\"";}?> onclick="changeDate(<?php echo $x?>, 1, 'y', 0)"></button>
        </div>
        <div class="row">
          <div id="idFechaInitYear<?php echo $x?>" <?php if (strpos($progDateInit[$x],"----")!==false){echo "class=\"apagado\"";}?>><?php echo substr($progDateInit[$x],0,4)?></div>
        </div>
        <div class="row">
          <button id="idFechaInitYearDown<?php echo $x?>" class="button flaticon-uniE654 <?php if (strpos($progDateInit[$x],"----")!==false){echo "apagado\" disabled";}else{echo "\"";}?> onclick="changeDate(<?php echo $x?>, 0, 'y', 0)"></button>
        </div>
      </div>
      <div class="col-xs-2 text-center">
        <div class="row">
          <button id="idFechaInitMonthUp<?php echo $x?>"  class="button flaticon-uniE653 <?php if (strpos($progDateInit[$x],"----")!==false){echo "apagado\" disabled";}else{echo "\"";}?> onclick="changeDate(<?php echo $x?>, 1, 'm', 0)"></button>
        </div>
        <div class="row">
          <div id="idFechaInitMonth<?php echo $x?>" <?php if (strpos($progDateInit[$x],"----")!==false){echo "class=\"apagado\"";}?>><?php echo substr($progDateInit[$x],5,2)?></div>
        </div>
        <div class="row">
          <button id="idFechaInitMonthDown<?php echo $x?>"  class="button flaticon-uniE654 <?php if (strpos($progDateInit[$x],"----")!==false){echo "apagado\" disabled";}else{echo "\"";}?> onclick="changeDate(<?php echo $x?>, 0, 'm', 0)"></button>
        </div>
      </div>
      <div class="col-xs-2 text-center">
        <div class="row">
          <button id="idFechaInitDayUp<?php echo $x?>" class="button flaticon-uniE653 <?php if (strpos($progDateInit[$x],"----")!==false){echo "apagado\" disabled";}else{echo "\"";}?> onclick="changeDate(<?php echo $x?>, 1, 'd', 0)"></button>
        </div>
        <div class="row">
          <div id="idFechaInitDay<?php echo $x?>" <?php if (strpos($progDateInit[$x],"----")!==false){echo "class=\"apagado\"";}?>><?php echo substr($progDateInit[$x],8,2)?></div>
        </div>
        <div class="row">
          <button id="idFechaInitDayDown<?php echo $x?>" class="button flaticon-uniE654 <?php if (strpos($progDateInit[$x],"----")!==false){echo "apagado\" disabled";}else{echo "\"";}?> onclick="changeDate(<?php echo $x?>, 0, 'd', 0)"></button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-1 boxspace">
        <div></div>
      </div>
      <div class="col-xs-4">
        <div>Fecha Fin:</div>
      </div>
      <div class="col-xs-3 text-center">
        <div class="row">
          <button id="idFechaFinYearUp<?php echo $x?>" class="button flaticon-uniE653 <?php if (strpos($progDateFin[$x],"----")!==false){echo "apagado\" disabled";}else{echo "\"";}?> onclick="changeDate(<?php echo $x?>, 1, 'y', 1)"></button>
        </div>
        <div class="row">
          <div id="idFechaFinYear<?php echo $x?>" <?php if (strpos($progDateFin[$x],"----")!==false){echo "class=\"apagado\"";}?>><?php echo substr($progDateFin[$x],0,4)?></div>
        </div>
        <div class="row">
          <button id="idFechaFinYearDown<?php echo $x?>" class="button flaticon-uniE654 <?php if (strpos($progDateFin[$x],"----")!==false){echo "apagado\" disabled";}else{echo "\"";}?> onclick="changeDate(<?php echo $x?>, 0, 'y', 1)"></button>
        </div>
      </div>
      <div class="col-xs-2 text-center">
        <div class="row">
          <button id="idFechaFinMonthUp<?php echo $x?>" class="button flaticon-uniE653 <?php if (strpos($progDateFin[$x],"----")!==false){echo "apagado\" disabled";}else{echo "\"";}?> onclick="changeDate(<?php echo $x?>, 1, 'm', 1)"></button>
        </div>
        <div class="row">
          <div id="idFechaFinMonth<?php echo $x?>" <?php if (strpos($progDateFin[$x],"----")!==false){echo "class=\"apagado\"";}?>><?php echo substr($progDateFin[$x],5,2)?></div>
        </div>
        <div class="row">
          <button id="idFechaFinMonthDown<?php echo $x?>" class="button flaticon-uniE654 <?php if (strpos($progDateFin[$x],"----")!==false){echo "apagado\" disabled";}else{echo "\"";}?> onclick="changeDate(<?php echo $x?>, 0, 'm', 1)"></button>
        </div>
      </div>
      <div class="col-xs-2 text-center">
        <div class="row">
          <button id="idFechaFinDayUp<?php echo $x?>" class="button flaticon-uniE653 <?php if (strpos($progDateFin[$x],"----")!==false){echo "apagado\" disabled";}else{echo "\"";}?> onclick="changeDate(<?php echo $x?>, 1, 'd', 1)"></button>
        </div>
        <div class="row">
          <div id="idFechaFinDay<?php echo $x?>" <?php if (strpos($progDateFin[$x],"----")!==false){echo "class=\"apagado\"";}?>><?php echo substr($progDateFin[$x],8,2)?></div>
        </div>
        <div class="row">
          <button id="idFechaFinDayDown<?php echo $x?>" class="button flaticon-uniE654 <?php if (strpos($progDateFin[$x],"----")!==false){echo "apagado\" disabled";}else{echo "\"";}?> onclick="changeDate(<?php echo $x?>, 0, 'd', 1)"></button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-5">Dias Semana</div>
      <div class="col-xs-7 text-planta">
        <span id="idMonday<?php echo $x?>" class="button <?php if (strpos($progDateWeekDays[$x],"L")===false){echo "apagado";}?>" onclick="switchWeekDay(<?php echo $x?>,'L')">L</span>
        <span id="idTuesday<?php echo $x?>" class="button <?php if (strpos($progDateWeekDays[$x],"M")===false){echo "apagado";}?>" onclick="switchWeekDay(<?php echo $x?>,'M')">M</span> 
        <span id="idWednesday<?php echo $x?>" class="button <?php if (strpos($progDateWeekDays[$x],"X")===false){echo "apagado";}?>" onclick="switchWeekDay(<?php echo $x?>,'X')">X</span>
        <span id="idThursday<?php echo $x?>" class="button <?php if (strpos($progDateWeekDays[$x],"J")===false){echo "apagado";}?>" onclick="switchWeekDay(<?php echo $x?>,'J')">J</span>
        <span id="idFriday<?php echo $x?>" class="button <?php if (strpos($progDateWeekDays[$x],"V")===false){echo "apagado";}?>" onclick="switchWeekDay(<?php echo $x?>,'V')">V</span>
        <span id="idSaturday<?php echo $x?>" class="button <?php if (strpos($progDateWeekDays[$x],"S")===false){echo "apagado";}?>" onclick="switchWeekDay(<?php echo $x?>,'S')">S</span>
        <span id="idSunday<?php echo $x?>" class="button <?php if (strpos($progDateWeekDays[$x],"D")===false){echo "apagado";}?>" onclick="switchWeekDay(<?php echo $x?>,'D')">D</span>
     </div>
   </div>
   <div class="row">
      <div class="col-xs-5">Habitaciones</div>
      <div class="col-xs-4">
        <div class="row">
          <div class="col-xs-1 fechacheckbox boxspace">
            <input type="checkbox" onclick="" id=""/>
          </div>
          <div class="col-xs-3">
            <div>Salon</div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-1 fechacheckbox boxspace">
            <input type="checkbox" onclick="" id=""/>
          </div>
          <div class="col-xs-3">
            <div>Despacho</div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-1 fechacheckbox boxspace">
            <input type="checkbox" onclick="" id=""/>
          </div>
          <div class="col-xs-3">
            <div>Cocina</div>
          </div>
        </div>
      </div>
      <div class="col-xs-3">
        <div class="row">
          <div class="col-xs-1 fechacheckbox boxspace">
            <input type="checkbox" onclick="" id=""/>
          </div>
          <div class="col-xs-3">
            <div>Principal</div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-1 fechacheckbox boxspace">
            <input type="checkbox" onclick="" id=""/>
          </div>
          <div class="col-xs-3">
            <div>Sofia</div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-1 fechacheckbox boxspace">
            <input type="checkbox" onclick="" id=""/>
          </div>
          <div class="col-xs-3">
            <div>Alvaro</div>
          </div>
        </div>
      </div>
   </div>
<?php
$iter=0;
while ($progTempConsigna[$x][$iter]) {
?>
    <div id="idRango<?php echo $x."-".$iter?>" class="row well well-program well-color-gen">
      <div class="col-xs-4">
          <div id="idRangoText<?php echo $x."-".$iter?>" class="rango">Rango <?php echo $iter+1;echo "\n ";?></div>
          <div class="button flaticon-uniE60C" onclick="removeRango(<?php echo $x.",".$iter?>)"></div>
      </div>
      <div class="col-xs-8">
        <div class="row">
          <div class="col-xs-6">
            <div>Hora Inicio: </div>
          </div>
          <div class="col-xs-2">
            <div class="button text-right" onclick="changeRango(<?php echo $x.",".$iter?>,0,0)">-</div>
          </div>
          <div class="col-xs-2 no-padding">
            <div id="idHoraInit<?php echo $x."-".$iter?>" class="text-center"><?php echo $progHourInit[$x][$iter]?>H</div>
          </div>
          <div class="col-xs-2">
            <div class="button text-left" onclick="changeRango(<?php echo $x.",".$iter?>,1,0)">+</div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-6">
            <div>Hora Fin: </div>
          </div>
          <div class="col-xs-2">
            <div class="button text-right" onclick="changeRango(<?php echo $x.",".$iter?>,0,1)">-</div>
          </div>
          <div class="col-xs-2 no-padding">
            <div id="idHoraFin<?php echo $x."-".$iter?>" class="text-center"><?php echo $progHourFin[$x][$iter]?>H</div>
          </div>
          <div class="col-xs-2">
            <div class="button text-left" onclick="changeRango(<?php echo $x.",".$iter?>,1,1)">+</div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-6"> 
            <div>Temp: </div>
          </div>
          <div class="col-xs-2">
            <div class="button text-right" onclick="changeRango(<?php echo $x.",".$iter?>,0,2)">-</div>
          </div>
          <div class="col-xs-2 no-padding">
            <div id="idTempConsigna<?php echo $x."-".$iter?>" class="text-center"><?php echo $progTempConsigna[$x][$iter]?>º</div>
          </div>
          <div class="col-xs-2">
            <div class="button text-left" onclick="changeRango(<?php echo $x.",".$iter?>,1,2)">+</div>
          </div>
        </div>


      </div>
    </div>
<?php
$iter=$iter+1;
}
?>
    <div id="idLastRango<?php echo $x?>" class="button" onclick="addRango(<?php echo $x?>)">+</div>      
  </div>
<?php
}
?>
<div id ="idPanelLast" class="panel panel-consigna">
    <div class="row">
      <div class="col-sm-12">
        <div class="button button-consigna" onclick="addPrograma()">+</div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
