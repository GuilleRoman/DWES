<html>
    <head>
    <title>Tarea 9 DWES - Aplicaciones Híbridas </title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        body{
            text-align:center;
            font-size: larger;
            font-family: Verdana;
            background-color: Gainsboro;
        }
        ul{
            padding:5px;
            list-style-type: none;
            border: 3px solid black;
            margin-left:25%;
            margin-right:25%;
        }
        #botonVolver{
            text-decoration:none;
            background-color: green;
            color:white;
            border:3px solid black;
            border-radius:10px;
            padding:10px;
        }
        #autor{
            padding:5px;
            border: 3px solid black;
            margin-left:25%;
            margin-right:25%;
        }
        a{
            text-decoration:none;
        }
        div>p:first-child{
            border:3px solid white;
            border-radius:5px;
            width:auto;
            margin-left:35%;
            margin-right:35%;
        }
        ul>p{
            border:3px solid white;
            border-radius:5px;
            margin-left:25%;
            margin-right:25%;
        }
    </style>
    <script>
    // SCRIPT JQUERY LOAD
        $(document).ready(function(){
                $("#texto").keyup(function(evento){
                    evento.preventDefault();
                    $("#resultado").load("api.php?action=get_datos_autor&nombre="+document.getElementById('texto').value);
                });
                
            });
        </script>

        
</head>
 <body>
        <header>
            <h1>Tarea 9 AJAX</h1>
        </header>
            <form id="formulario" action="#"method="post">
                <label for="input">Introduzca las letras</label><br>
                <input id="texto" type="text" pattern="[A-Za-z]" placeholder="letras a buscar">
                <button type="submit" id="boton" onkeyup="parseJsonData()">Enviar</button>
                <p id="resultado"></p>
                <p id="json"></p>
            </form>
 </body>
</html>
