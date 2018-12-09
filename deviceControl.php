<!DOCTYPE html>
<html lang="en">
<head>
  <title>DOMOTICA17</title>
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

<?php
$url_host='http://192.168.2.129:9000';
$url=$url_host.'/Device/GetListAllTree';
$ch=curl_init();
$timeout=5;

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

$resultjson=curl_exec($ch);
$result= json_decode ($resultjson);
curl_close($ch);


$url_host='http://192.168.2.129:9000';
$url=$url_host.'/Device/GetTypesList';
$ch=curl_init();
$timeout=5;

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

$resultTypesjson=curl_exec($ch);
$resultTypesList= json_decode ($resultTypesjson);

curl_close($ch);

$url_host='http://192.168.2.129:9000';
$url=$url_host.'/Device/GetHWTypesList';
$ch=curl_init();
$timeout=5;

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

$resultHWTypesjson=curl_exec($ch);
$resultHWTypesList= json_decode ($resultHWTypesjson);

curl_close($ch);


?>


<div class="container-fluid">
  <div class="panel panel-consigna">
    <div class="row">  
      <div class="col-xs-12">
        <div class="row text-consigna-2">
          Device Control
        </div>
      </div>
    </div>
  </div>
  

        
<?php     
  $prevAddress = "";
  $nAddress = -1;
  $maxUsages = 0;

  foreach ($result as $device ) {
    
      $nAddress += 1;
      $nUsage = 0;

      $state=$device->{'State'};
      
      if ($state == 'on'){
        $iconDevice="resources/wemos_green.svg";
      } else {
        $iconDevice="resources/wemos_red.svg";
      }
      
      if ($device->{'mbAddress'} == '' or $device->{'mbAddress'} == '-1') {
         $addmb = $device->{'Address'};
      } else {
         $addmb = $device->{'Address'}." - (".$device->{'mbAddress'}.")";
      }
 
      ?>
  <div class="panel panel-normal">
    <div class="row">  
      <div><img class="fixed-el-icon_monitor2" src="<?php echo $iconDevice?>" align="left" data-index="<?php print $nAddress?>" data-toggle="modal" data-target="#ModalHWDev"></img></div>
      <span class="text-size-16"><?php print $addmb?></span>
      <span id="idAddUsage<?php print $nAddress?>" class="glyphicon glyphicon-plus-sign text-right fixed-el-icon_monitor2 button-blind1>" onclick="addUsage(<?php print $nAddress;?>)"></span>
    </div>

    <div id="idUsages<?php print $nAddress?>" class="row">  
    
    <!-- Lo siguiente es solo para poder clonar ya que está oculto -->
    
      <div id="idUsage<?php print $nAddress."_X"?>" class="panel panel-icono" hidden>
        <div id="idUsageRow<?php print $nAddress."_X"?>" class="row row_interna button-blind1" data-index="<?php print $nAddress?>" data-usage="X" data-toggle="modal" data-target="#ModalUsage">
          <span id="idUsageText1_<?php print $nAddress."_X"?>" class="text-mini3"></span>
          <span id="idUsageText2_<?php print $nAddress."_X"?>" class="text-mini3 text-right"></span>
          <div id="idUsageText3_<?php print $nAddress."_X"?>" class="text-mini3"></div>
          <div id="idInputList_<?php print $nAddress."_X"?>" class="text-mini3"></div>
          <div id="idOutputList_<?php print $nAddress."_X"?>" class="text-mini3"></div>
        </div>
      </div>
 
      <?php
      $usagesJSON = $device->{'usage'};
      
      foreach ($usagesJSON as $usage_element ) {
        $inputsString = "";
        $outputsString = "";
        for ($x = 1; $x <= 4; $x++) {
          if ($inputsString != "" and $usage_element->{'pinInput'.$x} != ""){
            $inputsString = $inputsString." - ";
          }
          $inputsString = $inputsString.$usage_element->{'pinInput'.$x};
          
          if ($outputsString != "" and $usage_element->{'pinOutput'.$x} != ""){
            $outputsString = $outputsString." - ";
          }
          $outputsString = $outputsString.$usage_element->{'pinOutput'.$x};
        } 

      ?>
      <div id="idUsage<?php print $nAddress."_".$nUsage?>" class="panel panel-icono" >
        <div id="idUsageRow<?php print $nAddress."_".$nUsage?>" class="row row_interna button-blind1" data-index="<?php print $nAddress?>" data-usage="<?php print $nUsage?>" data-toggle="modal" data-target="#ModalUsage">
          <span id="idUsageText1_<?php print $nAddress."_".$nUsage?>" class="text-mini3"><?php print $usage_element->{'Description'}?></span>
          <span id="idUsageText2_<?php print $nAddress."_".$nUsage?>" class="text-mini3 text-right"><?php print $usage_element->{'devType'}?></span>
          <div id="idUsageText3_<?php print $nAddress."_".$nUsage?>" class="text-mini3"><?php print "Usage ID: ".$usage_element->{'devId'}?></div>
          <div id="idInputList_<?php print $nAddress."_".$nUsage?>" class="text-mini3"><?php print "Inputs: ".$inputsString?></div>
          <div id="idOutputList_<?php print $nAddress."_".$nUsage?>" class="text-mini3"><?php print "Outputs: ".$outputsString?></div>
        </div>
      </div>
      
      <?php  
       $nUsage += 1;
      }
     ?>
      
    </div>
     
  </div>
    <?php      
  }
  ?>

  
  
  <div class="modal fade" id="ModalUsage" role="dialog">
    <div class="modal-dialog modal-sm">

      <div class="modal-content modal-dialog-devices">
        <div class="modal-body ">
          <form>
            <div class="form-group has-error has-feedback" onclick="">
              <label class="text-left font-modal-dialog ">Address:</label>
              <input class="inputDevice form-control" type="text" id="idAddress" value="ID">
            </div>
          </form>
        </div>
      </div>

      <div id="idUsage0>" class="modal-content modal-dialog-devices">
        <div class="modal-body ">
          <form>

            <div class="form-group has-error has-feedback" onclick="">
              <label class="text-left font-modal-dialog ">Description:</label>
              <input class="inputDevice form-control" type="text" id="idDesc0" value="ID">
            </div>

            <div class="form-group has-error has-feedback" onclick="">
              <label class="text-left font-modal-dialog ">Device Id:</label>
              <input class="inputDevice form-control" type="text" id="idID0" value="ID">
            </div>
            
            <div class="form-group has-error has-feedback" onclick="">
              <label class="text-left font-modal-dialog ">Tipo Device:</label>
              <select class="inputDevice form-control" type="text" id="idTipo0" value="ID">
                  <?php
                  foreach ($resultTypesList as $devTypes ) {    
                  ?>
                    <option class="inputDevice form-control"><?php print $devTypes->{'devType'} ?></option>
                  <?php
                  }
                  ?>
              </select>
            </div>

            <div class="form-group row has-error has-feedback" onclick="">
              <label class="col-xs-8 text-left font-modal-dialog ">Numero Inputs:</label>
              <div class="col-xs-4">
                <input class="inputDevice form-control" type="text" id="idNumberButtons0" value="ID">
              </div>
            </div>
            
            <div class="form-group row has-error has-feedback" onclick="">
              <div class="col-xs-2"></div>
              <label class="col-xs-6 text-left font-modal-dialog ">pinInput1:</label>
              <div class="col-xs-4">
                <input class="inputDevice form-control" type="text" id="idPinInput1" value="ID">
              </div>
            </div>
            
            <div class="form-group row has-error has-feedback" onclick="">
              <div class="col-xs-2"></div>
              <label class="col-xs-6 text-left font-modal-dialog ">pinInput2:</label>
              <div class="col-xs-4">
                <input class="inputDevice form-control" type="text" id="idPinInput2" value="ID">
              </div>
            </div>
            
            <div class="form-group row has-error has-feedback" onclick="">
              <div class="col-xs-2"></div>
              <label class="col-xs-6 text-left font-modal-dialog ">pinInput3:</label>
              <div class="col-xs-4">
                <input class="inputDevice form-control" type="text" id="idPinInput3" value="ID">
              </div>
            </div>
            
            <div class="form-group row has-error has-feedback" onclick="">
              <div class="col-xs-2"></div>
              <label class="col-xs-6 text-left font-modal-dialog ">pinInput4:</label>
              <div class="col-xs-4">
                <input class="inputDevice form-control" type="text" id="idPinInput4" value="ID">
              </div>
            </div>
            
            <div class="form-group row has-error has-feedback" onclick="">
              <label class="col-xs-8 text-left font-modal-dialog ">Numero Outputs:</label>
              <div class="col-xs-4">
                <input class="inputDevice form-control" type="text" id="idNumberOutputs0" value="ID">
              </div>
            </div>
            
            <div class="form-group row has-error has-feedback" onclick="">
              <div class="col-xs-2"></div>
              <label class="col-xs-6 text-left font-modal-dialog ">pinOutput1:</label>
              <div class="col-xs-4">
                <input class="inputDevice form-control" type="text" id="idPinOutput1" value="ID">
              </div>
            </div>
            
            <div class="form-group row has-error has-feedback" onclick="">
              <div class="col-xs-2"></div>
              <label class="col-xs-6 text-left font-modal-dialog ">pinOutput2:</label>
              <div class="col-xs-4">
                <input class="inputDevice form-control" type="text" id="idPinOutput2" value="ID">
              </div>
            </div>
            
            <div class="form-group row has-error has-feedback" onclick="">
              <div class="col-xs-2"></div>
              <label class="col-xs-6 text-left font-modal-dialog ">pinOutput3:</label>
              <div class="col-xs-4">
                <input class="inputDevice form-control" type="text" id="idPinOutput3" value="ID">
              </div>
            </div>
            
            <div class="form-group row has-error has-feedback" onclick="">
              <div class="col-xs-2"></div>
              <label class="col-xs-6 text-left font-modal-dialog ">pinOutput4:</label>
              <div class="col-xs-4">
                <input class="inputDevice form-control" type="text" id="idPinOutput4" value="ID">
              </div>
            </div>
            
          </form>
        </div>
      </div>

      <div class="modal-content modal-dialog-devices">
        <div class="modal-body ">
          <div class="row row-int-nomargin">
            <span id="idExitButton" class="text-right icon-marginleft-5 fixed-el-icon_maquina icon-size-20 button-blind1 flaticon-uniE604" data-dismiss="modal" onclick="exitUsage()"></span>
            <span id="idApplyButton" class="glyphicon glyphicon-floppy-disk text-right fixed-el-icon_maquina icon-size-20 button-blind1" onclick=""></span>
            <span id="idDeleteButton" class="glyphicon glyphicon-trash text-left fixed-el-icon_maquina icon-size-20 button-blind1" data-toggle="modal" data-target="#ModalConfirmDelete" onclick=""></span>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  
  
  




  <div class="modal fade" id="ModalHWDev" role="dialog">
    <div class="modal-dialog modal-sm">

      <div class="modal-content modal-dialog-devices">
        <div class="modal-body ">
          <form>
            <div class="form-group has-error has-feedback" onclick="">
              <label class="text-left font-modal-dialog ">Address:</label>
              <input class="inputDevice form-control" type="text" id="idAddressHW" value="ID">
            </div>
          </form>
          
          <form>
            <div class="form-group has-error has-feedback" onclick="">
              <label class="text-left font-modal-dialog ">ModBUS Slave ID:</label>
              <input class="inputDevice form-control" type="text" id="idMBAddressHW" value="ID">
            </div>
          </form>
          
          <form>
            <div class="form-group has-error has-feedback" onclick="">
              <label class="text-left font-modal-dialog ">HW Type:</label>
              <select class="inputDevice form-control" type="text" id="idHWTipoHW" value="ID">
                  <?php
                  foreach ($resultHWTypesList as $HWTypes ) {    
                  ?>
                    <option class="inputDevice form-control"><?php print $HWTypes->{'HWType'} ?></option>
                  <?php
                  }
                  ?>
              </select>
            </div>
          </form>
          
        </div>
      </div>


      <div class="modal-content modal-dialog-devices">
        <div class="modal-body ">
          <div class="row row-int-nomargin">
            <span id="idExitButtonHW" class="text-right icon-marginleft-5 fixed-el-icon_maquina icon-size-20 button-blind1 flaticon-uniE604" data-dismiss="modal" onclick="exitUsage()"></span>
            <span id="idApplyButtonHW" class="glyphicon glyphicon-floppy-disk text-right fixed-el-icon_maquina icon-size-20 button-blind1" onclick=""></span>
            <span id="idDeleteButtonHW" class="glyphicon glyphicon-trash text-left fixed-el-icon_maquina icon-size-20 button-blind1" data-toggle="modal" data-target="#ModalConfirmDelete" onclick=""></span>
          </div>
        </div>
      </div>
      
    </div>
  </div>

  
  

  
  <div class="modal fade" id="ModalConfirmDelete" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content modal-dialog-devices">
        <div class="modal-body ">
          <div class="row row-int-nomargin">Seguro que borramos?
          </div>
          <div class="row row-int-nomargin">
            <span id="idDeteleExitButton" class="text-right icon-marginleft-5 fixed-el-icon_maquina icon-size-20 button-blind1 flaticon-uniE604" data-dismiss="modal" onclick=""></span>
            <span id="idDeleteConfirmedButton" class="glyphicon glyphicon-floppy-disk text-right fixed-el-icon_maquina icon-size-20 button-blind1" data-dismiss="modal" onclick=""></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>

<script type="text/javascript">

  var resultHWTypesJSON = JSON.parse('<?php echo $resultHWTypesjson ?>');

  var szAddress = new Array();
  var szMbAddress = new Array();
  var szNumUsages = new Array();
  var szMaxInputs = new Array();
  var szMaxOutputs = new Array();
  var szHWtype = new Array();
  var szState = new Array();

  var szTipo = new Array();
  var szNumberButtons = new Array();
  var szNumberOutputs = new Array();
  var szPinInput1 = new Array();
  var szPinInput2 = new Array();
  var szPinInput3 = new Array();
  var szPinInput4 = new Array();
  var szPinOutput1 = new Array();
  var szPinOutput2 = new Array();
  var szPinOutput3 = new Array();
  var szPinOutput4 = new Array();

  var szDescription = new Array();
  var szId = new Array();

  <?php
  $nAddress = 0;
  foreach ($result as $device ) {      
      $nUsage = 0;
      
      ?>
      szAddress[<?php echo $nAddress?>] = "<?php print $device->{'Address'}?>";
      szMbAddress[<?php echo $nAddress?>] = "<?php print $device->{'mbAddress'}?>";
      szNumUsages[<?php echo $nAddress?>] = "<?php print $device->{'maxUsages'}?>";
      szMaxInputs[<?php echo $nAddress?>] = "<?php print $device->{'maxInputs'}?>";
      szMaxOutputs[<?php echo $nAddress?>] = "<?php print $device->{'maxOutputs'}?>";
      szHWtype[<?php echo $nAddress?>] = "<?php print $device->{'HWType'}?>";
      szState[<?php echo $nAddress?>] = "<?php print $device->{'State'}?>";
      
      szId[<?php print $nAddress?>] = new Array();
      szTipo[<?php print $nAddress?>] = new Array();
      szNumberButtons[<?php print $nAddress?>] = new Array();
      szNumberOutputs[<?php print $nAddress?>] = new Array();
      szPinInput1[<?php print $nAddress?>] = new Array();
      szPinInput2[<?php print $nAddress?>] = new Array();
      szPinInput3[<?php print $nAddress?>] = new Array();
      szPinInput4[<?php print $nAddress?>] = new Array();
      szPinOutput1[<?php print $nAddress?>] = new Array();
      szPinOutput2[<?php print $nAddress?>] = new Array();
      szPinOutput3[<?php print $nAddress?>] = new Array();
      szPinOutput4[<?php print $nAddress?>] = new Array();
      szDescription[<?php print $nAddress?>] = new Array();
      <?php
      $usagesJSON = $device->{'usage'};
      
      foreach ($usagesJSON as $usage_element ) {
      ?>
        szId[<?php echo $nAddress?>][<?php echo $nUsage?>] = "<?php print $usage_element->{'devId'}?>";  
        szTipo[<?php echo $nAddress?>][<?php echo $nUsage?>] = "<?php print $usage_element->{'devType'}?>";
        szNumberButtons[<?php echo $nAddress?>][<?php echo $nUsage?>] = "<?php print $usage_element->{'numButton'}?>";
        szNumberOutputs[<?php echo $nAddress?>][<?php echo $nUsage?>] = "<?php print $usage_element->{'numOutputs'}?>";
        szPinInput1[<?php echo $nAddress?>][<?php echo $nUsage?>] = "<?php print $usage_element->{'pinInput1'}?>";
        szPinInput2[<?php echo $nAddress?>][<?php echo $nUsage?>] = "<?php print $usage_element->{'pinInput2'}?>";
        szPinInput3[<?php echo $nAddress?>][<?php echo $nUsage?>] = "<?php print $usage_element->{'pinInput3'}?>";
        szPinInput4[<?php echo $nAddress?>][<?php echo $nUsage?>] = "<?php print $usage_element->{'pinInput4'}?>";
        szPinOutput1[<?php echo $nAddress?>][<?php echo $nUsage?>] = "<?php print $usage_element->{'pinOutput1'}?>";
        szPinOutput2[<?php echo $nAddress?>][<?php echo $nUsage?>] = "<?php print $usage_element->{'pinOutput2'}?>";
        szPinOutput3[<?php echo $nAddress?>][<?php echo $nUsage?>] = "<?php print $usage_element->{'pinOutput3'}?>";
        szPinOutput4[<?php echo $nAddress?>][<?php echo $nUsage?>] = "<?php print $usage_element->{'pinOutput4'}?>";
        szDescription[<?php echo $nAddress?>][<?php echo $nUsage?>] = "<?php print $usage_element->{'Description'}?>";
        <?php
        $nUsage += 1;
      }
    $nAddress += 1;
  }
  ?> 

  $(document).ready(function(){
    var text = "0"; 
    initialize_buttons ();
  });
    
  $("#ModalHWDev").on('shown.bs.modal', function (e) {
    var index = $(e.relatedTarget).data('index');
    $("#idAddressHW").val(szAddress[Number(index)]);

    $("#idMBAddressHW").val(szMbAddress[Number(index)]);
    $("#idHWTipoHW").val(szHWtype[Number(index)]);
    
    $("#idApplyButtonHW").attr("onclick","saveConfigHW("+index+")");
    $("#idDeleteConfirmedButtonHW").attr("onclick","deleteHW("+index+")");
    if (szState[Number(index)] == 'off') {
      $('#idApplyButtonHW').addClass("not-active-link apagado")
    } else {
      $('#idApplyButtonHW').removeClass("not-active-link apagado") 
    }
    
    updateModbusFields (szHWtype[Number(index)])
    
  });
  
  $("#ModalUsage").on('shown.bs.modal', function (e) {
    var index = $(e.relatedTarget).data('index');
    var usage = $(e.relatedTarget).data('usage');
    $("#idAddress").val(szAddress[Number(index)]);

    $("#idID0").val(szId[Number(index)][Number(usage)]);
    $("#idTipo0").val(szTipo[Number(index)][Number(usage)]);
    $("#idNumberButtons0").val(szNumberButtons[Number(index)][Number(usage)]);
    $("#idNumberOutputs0").val(szNumberOutputs[Number(index)][Number(usage)]);
    $("#idPinInput1").val(szPinInput1[Number(index)][Number(usage)]);
    $("#idPinInput2").val(szPinInput2[Number(index)][Number(usage)]);
    $("#idPinInput3").val(szPinInput3[Number(index)][Number(usage)]);
    $("#idPinInput4").val(szPinInput4[Number(index)][Number(usage)]);
    $("#idPinOutput1").val(szPinOutput1[Number(index)][Number(usage)]);
    $("#idPinOutput2").val(szPinOutput2[Number(index)][Number(usage)]);
    $("#idPinOutput3").val(szPinOutput3[Number(index)][Number(usage)]);
    $("#idPinOutput4").val(szPinOutput4[Number(index)][Number(usage)]);
    $("#idDesc0").val(szDescription[Number(index)][Number(usage)]);
    
    $("#idApplyButton").attr("onclick","saveConfig("+index+","+usage+")");
    $("#idDeleteConfirmedButton").attr("onclick","deleteUsage("+index+","+usage+")");
    if (szState[Number(index)] == 'off') {
      $('#idApplyButton').addClass("not-active-link apagado")
    } else {
      $('#idApplyButton').removeClass("not-active-link apagado") 
    }
    
    for (xiter = 1; xiter <= 4; ++xiter) {
      if (xiter > Number(szNumberButtons[Number(index)][Number(usage)])) {
        $("#idPinInput" + xiter.toString()).attr('disabled', true)
      }
      if (xiter > Number(szNumberOutputs[Number(index)][Number(usage)])) {
        $("#idPinOutput" + xiter.toString()).attr('disabled', true)
      }
    }
    
  });
  
  $("#idHWTipoHW").on("change", function() {
    var HWTypeInput = $("#idHWTipoHW").val();
    updateModbusFields (HWTypeInput);
    
  });
  
  $("#idNumberButtons0").on("change", function() {
    var newNum = $("#idNumberButtons0").val();
    updateInputsFields (newNum);
    
  });
  
  $("#idNumberOutputs0").on("change", function() {
    var newNum = $("#idNumberOutputs0").val();
    updateOutputsFields (newNum);
    
  });
  
  function updateModbusFields (HWTypeInput){
    var newState = true;
  
    for (var i = 0; i < resultHWTypesJSON.length; i++){
      var obj = resultHWTypesJSON[i];
      if (obj.HWType == HWTypeInput && obj.modbus == 1) {
         newState = false;
      }
    }
    $("#idMBAddressHW").attr('disabled', newState)
    
  }
  
  function updateInputsFields (newNum){
    
      for (xiter = 1; xiter <= 4; ++xiter) {
          if (xiter > newNum) {
            $("#idPinInput" + xiter.toString()).attr('disabled', true)
          }
          else {
            $("#idPinInput" + xiter.toString()).attr('disabled', false)
          }

      }
  
  }
  
  function updateOutputsFields (newNum){
    
      for (xiter = 1; xiter <= 4; ++xiter) {
          if (xiter > newNum) {
            $("#idPinOutput" + xiter.toString()).attr('disabled', true)
          }
          else {
            $("#idPinOutput" + xiter.toString()).attr('disabled', false)
          }
      }
  
  }

  function initialize_buttons (){
    for (index = 0; index < szNumUsages.length; ++index){
      if (szId[index].length >= Number(szNumUsages[index])) {
        $("#idAddUsage" + index.toString()).addClass("obj-oculto")
      }
      if (szState[index] == 'off') {
        $("#idAddUsage" + index.toString()).addClass("obj-oculto") 
      }
    } 
  }
  
  function exitUsage () {
    location.reload();
  }

  function addUsage (nAddress) {

    var nUsageLocal = Number (szId[nAddress].length) - 1;
    var nUsageLocalNew = nUsageLocal + 1;
    var szRefElementId = "idUsage" + nAddress.toString() + "_X";
    var szLastElementNewId = "idUsage" + nAddress.toString() + "_" + nUsageLocalNew;
    var szParentId = "idUsages" + nAddress;

    var szRowId = "idUsageRow"+ nAddress.toString() + "_X";
    var szRowIdNew = "idUsageRow"+ nAddress.toString() + "_" + nUsageLocalNew;

    var szText1Id = "idUsageText1_" + nAddress.toString() + "_X";
    var szText2Id = "idUsageText2_" + nAddress.toString() + "_X";
    var szText3Id = "idUsageText3_" + nAddress.toString() + "_X";

    var szText1IdNew = "idUsageText1_" + nAddress.toString() + "_" + nUsageLocalNew;
    var szText2IdNew = "idUsageText2_" + nAddress.toString() + "_" + nUsageLocalNew;
    var szText3IdNew = "idUsageText3_" + nAddress.toString() + "_" + nUsageLocalNew;
    
    var szInputListId = "idInputList_" + nAddress.toString() + "_X";
    var szOutputListId = "idOutputList_" + nAddress.toString() + "_X";
    
    var szInputListIdNew = "idInputList_" + nAddress.toString() + "_" + nUsageLocalNew;
    var szOutputListIdNew = "idOutputList_" + nAddress.toString() + "_" + nUsageLocalNew;
    
    var szAddButtonId = "idAddUsage" + nAddress.toString();

    var cloneEl = $("#" + szRefElementId).clone().appendTo( "#"+szParentId );

    cloneEl.attr('id',szLastElementNewId);
    cloneEl.find("#"+szText1Id).attr("id",szText1IdNew);
    cloneEl.find("#"+szText2Id).attr("id",szText2IdNew);
    cloneEl.find("#"+szText3Id).attr("id",szText3IdNew);
    cloneEl.find("#"+szInputListId).attr("id",szInputListIdNew);
    cloneEl.find("#"+szOutputListId).attr("id",szOutputListIdNew);
    cloneEl.find("#"+szRowId).attr("data-usage",nUsageLocalNew);
    cloneEl.find("#"+szRowId).attr("id",szRowIdNew);
    cloneEl.removeAttr('hidden');;

    $("#" + szText1IdNew).html ("NULL");
    $("#" + szText2IdNew).html ("tLuz");
    $("#" + szText3IdNew).html ("Usage ID: NULL");

    szId[nAddress][nUsageLocalNew] = "NULL";
    szTipo[nAddress][nUsageLocalNew] = "tLuz";
    szNumberButtons[nAddress][nUsageLocalNew] = "0";
    szNumberOutputs[nAddress][nUsageLocalNew] = "0";
    szPinInput1[nAddress][nUsageLocalNew] = "";
    szPinInput2[nAddress][nUsageLocalNew] = "";
    szPinInput3[nAddress][nUsageLocalNew] = "";
    szPinInput4[nAddress][nUsageLocalNew] = "";
    szPinOutput1[nAddress][nUsageLocalNew] = "";
    szPinOutput2[nAddress][nUsageLocalNew] = "";
    szPinOutput3[nAddress][nUsageLocalNew] = "";
    szPinOutput4[nAddress][nUsageLocalNew] = "";
    szDescription[nAddress][nUsageLocalNew] = "NULL";

    if (szNumUsages[nAddress] <= nUsageLocalNew + 1){
      $('#' + szAddButtonId).addClass("obj-oculto") 
    }
  }
  
  function deleteUsage (nAddress, nUsage) {
  
    var ajax_url = "controlDevicesweb.php?";
    var ajax_url_vars = "mode=delete&Address="+szAddress[Number(nAddress)]+"&devId="+szId[Number(nAddress)][Number(nUsage)];
    
    var ajax_url = ajax_url + ajax_url_vars;

    var ajax_request1 = new XMLHttpRequest();

    ajax_request1.open( "GET", ajax_url, true);
    ajax_request1.send();
    ajax_request1.onreadystatechange = function() {
      if (ajax_request1.readyState == 4 ) {
        if (ajax_request1.status == 200) {
          response = ajax_request1.responseText;
        } else {
          window.alert("Error actualizando FW o DB");
        } 
        
      }
    
    }

  }

  function saveConfigHW (index){
    //http://192.168.2.129/Device/Config/ModifyHW?Address=192.168.2.167&AddressNew=192.168.2.189&mbAddress=2&HWtype=Sonoff
    //                                     
    
    var szModBusNew = document.getElementById("idMBAddressHW").value;
    var szTipoHWNew = document.getElementById("idHWTipoHW").value;
    var szAddressNew = document.getElementById("idAddressHW").value;

    var ajax_url = "controlDevicesweb.php?";
    var ajax_url_vars = "mode=modifyHW&Address="+szAddress[Number(index)]+"&AddressNew="+szAddressNew+"&mbAddress="+szModBusNew+"&HWtype="+szTipoHWNew;

    var ajax_url = ajax_url + ajax_url_vars;

    var ajax_request1 = new XMLHttpRequest();

    ajax_request1.open( "GET", ajax_url, true);
    ajax_request1.send();
    ajax_request1.onreadystatechange = function() {
      if (ajax_request1.readyState == 4 ) {
        if (ajax_request1.status == 200) {
          response = ajax_request1.responseText;
          
          // Hay que comprobar este response. Puede devolver 200, 4xx, 5xx, -1, -2
          // solo 200 es ok
        } else {
          window.alert("Error actualizando FW o DB.");
        } 
        
      }
    
    }

  }

  function saveConfig (index,usage){
    //http://192.168.2.129/Device/Config/AddModifyUsage?devId=TMP554&Address=192.168.2.167&devIdNew=SOAN1&devType=tLuz&pinInput1=4&pinInput2=5&pinOutput1=11&pinOutput2=13&Description=Teas%20Test     devID es obligatorio

    var szIdNew = document.getElementById("idID0").value;
    var szTipoNew = document.getElementById("idTipo0").value;
    var szNumberButtonsNew = document.getElementById("idNumberButtons0").value;
    var szNumberOutputsNew = document.getElementById("idNumberOutputs0").value;
    var szPinInputNew = new Array();
    szPinInputNew[1] = document.getElementById("idPinInput1").value;
    szPinInputNew[2] = document.getElementById("idPinInput2").value;
    szPinInputNew[3] = document.getElementById("idPinInput3").value;
    szPinInputNew[4] = document.getElementById("idPinInput4").value;

    var szPinOutputNew = new Array();
    szPinOutputNew[1] = document.getElementById("idPinOutput1").value;
    szPinOutputNew[2] = document.getElementById("idPinOutput2").value;
    szPinOutputNew[3] = document.getElementById("idPinOutput3").value;
    szPinOutputNew[4] = document.getElementById("idPinOutput4").value;


    var szDescriptionNew = document.getElementById("idDesc0").value;

    var ajax_url = "controlDevicesweb.php?";
    var ajax_url_vars = "mode=modify&devId="+szId[Number(index)][Number(usage)]+"&devType="+szTipoNew+"&Address="+szAddress[Number(index)]+"&Description="+szDescriptionNew;

    if (szIdNew != szId[Number(index)][Number(usage)]){
      ajax_url_vars = ajax_url_vars+"&devIdNew="+szIdNew;
    }
    
    var i;
    for (i = 1; i <= Number(szNumberButtonsNew); i++) { 
      ajax_url_vars += "&pinInput"+i.toString()+"="+szPinInputNew[i];
    }
    
    for (i = 1; i <= Number(szNumberOutputsNew); i++) { 
      ajax_url_vars += "&pinOutput"+i.toString()+"="+szPinOutputNew[i];
    }

    var ajax_url = ajax_url + ajax_url_vars;
    

    var ajax_request1 = new XMLHttpRequest();

    ajax_request1.open( "GET", ajax_url, true);
    ajax_request1.send();
    ajax_request1.onreadystatechange = function() {
      if (ajax_request1.readyState == 4 ) {
        if (ajax_request1.status == 200) {
          response = ajax_request1.responseText;
          
          // Hay que comprobar este response. Puede devolver 200, 4xx, 5xx, -1, -2
          // solo 200 es ok
        } else {
          window.alert("Error actualizando FW o DB.");
        } 
        
      }
    
    }
    

  }
</script>


</body>
</html>
