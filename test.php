<!DOCTYPE html>
<html>
<body>

<p id="demo"></p>

<script>
var ajax_url = "http://sibanezc.ddns.net:8080/ReportData.php";
var ajax_request = new XMLHttpRequest();

ajax_request.open( "GET", ajax_url, true );
ajax_request.send();
ajax_request.onreadystatechange = function() {

    // readyState es 4..

    if (ajax_request.readyState == 4 ) {

        // Analizaos el responseText que contendrá el JSON enviado desde el servidor
        var jsonObj = JSON.parse( ajax_request.responseText );
        // La variable jsonObj ahora contiene un objeto con los datos recibidos
        document.getElementById("demo").innerHTML = jsonObj[0][0];

    }
}

</script>

</body>
</html>
