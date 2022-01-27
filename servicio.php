<html>
    <head>
    <title>Tarea 9 DWES - Aplicaciones Híbridas </title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        body{
            text-align:center;
            font-size: larger;
            font-family: Verdana;
            background-color: Gainsboro;
        }
        p{
            text-align:left;
            margin-left:10%;
            font-size:smaller;
            
        }
    </style>
    <script>
    // Acceso a la api con Jquery
        /*$(document).ready(function(){
                $("#texto").keyup(function(evento){
                    evento.preventDefault();
                    $("#resultado").load("https://pokeapi.co/api/v2/pokemon/"+document.getElementById('texto').value, 
                    function(responseText, statusTxt, xhr){
                       console.log(JSON.parse(responseText)) ;
                    });
                });
                
            });*/
        </script>
        <script>
        /*Acceso a la API con JavaScript
        *
        * Llama a la api externa y pone los datos en el elemento del DOM elegido.
       *
        /*/
        function parseJsonData(){
        var xmlhttp = new XMLHttpRequest();
        var url = "https://pokeapi.co/api/v2/pokemon/"+document.getElementById('texto').value;
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               var myJson = JSON.parse(this.responseText);
               //esta variable nos muestra los parámetros principales del pokemon
               var str = JSON.stringify(myJson, ["name", "weight", "id","order"], "<br>"); // spacing level = 2
               //esta variable muestra todo el json del pokemon (es un archivo muy grande)
              // var str = JSON.stringify(myJson, null, "<br>"); 
               if(myJson === null){
                   alert("no hay datos");
               }else{
                   //alert("Recibidos los datos");
                   document.getElementById("json").innerHTML = str;

                   // Esta parte del código coge cada uno de los niveles del Json y permite interactuar con ellos.

                   /*document.getElementById("json").innerHTML = 
                   "'ID': '"+myJson["id"]+"'<br>"+
                   "'Nombre': '" +myJson["forms"][0]["name"]+"'<br>"+
                   "'Habilidad': '"+myJson["abilities"][0]["ability"]["name"]+"<br>"+
                   "'URL': '"+myJson["abilities"][0]["ability"]["url"]+"'<br>"+
                   "'Experiencia base':"+"'" +myJson["base_experience"]+"'"+"<br>"+
                   
                   "'Información': '" +myJson["forms"][0]["url"]+"'<br>"+
                   "'Altura' : '"+myJson["height"]+"<br>"+
                   "'Objetos que porta' : '"+ myJson["held_items"][0]["item"]["name"]+"'<br>"+
                   "'Movimientos':{ <br>"+listadoHabilidades+"}"; //myJson["moves"][0]["move"]["name"];
                   ;

                   // este método recorre todos los movimientos del pokemon y los añade a la variable habilidades, que devuelve.
                   function everyMove(obj){
                    for (var i=0; i<= obj["moves"].length;i++){
                     var habilidades=document.getElementById("json").innerHTML += "'Habilidad "+ i + "': "+"'"+myJson["moves"][i]["move"]["name"]+"'<br>";
                    }
                    return habilidades;
                   }    
                   var listadoHabilidades =everyMove(myJson);
                   /*for(var ability in myJson["abilities"]){
                    document.getElementById("json").innerHTML = ability["name"];
                   }*/
               }
               
               
               
               
            }
        };
        xmlhttp.open("GET", url, true);
        
        xmlhttp.send(null);
    }

    

       
</script>
        
</head>
 <body>
        <header>
            <h1>Tarea 9 - API de POKEMON (1º Generación)</h1>
        </header>
            <form id="formulario" action="#"method="get">
                <label for="input">Introduzca el pokemon a buscar</label><br>
                <input id="texto" type="text" onkeyup="parseJsonData()" placeholder="ej: Mew">
                <button type="submit" id="boton">Enviar</button>
                <p id="json"></p>
            </form>
 </body>
</html>