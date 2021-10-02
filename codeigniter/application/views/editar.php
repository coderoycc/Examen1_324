<?php
$ci = $_POST['var'];
$conn = mysqli_connect("localhost", "root", "");
    if($conn == false){ 
        echo "ocurrio error BD";
        die();
    }
    mysqli_select_db($conn, "FCPN");
    $query="select * from usuario where ci =".$ci.";";
    $resultado = $conn->query($query);
    $usuario = $resultado->fetch_all(MYSQLI_ASSOC);
?>
<html>
<head>
    <title>EDITAR DOCENTE</title>
</head>
<body>
<style>
    html, body {
        height: 100%;
    }
    body {
        margin: 0;
        background: linear-gradient(45deg, #49a09d, #5f2c82);
        font-family: sans-serif;
        font-weight: 100;
    }
    .container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    #msform {
    width: 400px;
    margin: 50px auto;
    text-align: center;
    position: relative;
    }
    #msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 3px;
    box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
    padding: 20px 30px;
    box-sizing: border-box;
    width: 80%;
    margin: 0 10%;
    
    /*stacking fieldsets above each other*/
    position: relative;
    }
    /*Hide all except first fieldset*/
    #msform fieldset:not(:first-of-type) {
    display: none;
    }
    /*inputs*/
    #msform input, #msform textarea {
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
    margin-bottom: 10px;
    width: 100%;
    box-sizing: border-box;
    font-family: montserrat;
    color: #2C3E50;
    font-size: 13px;
    }
    /*buttons*/
    #msform .action-button {
    width: 100px;
    background: #27AE60;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 1px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
    }
    #msform .action-button:hover, #msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #27AE60;
    }
    /*headings*/
    .fs-title {
    font-size: 15px;
    text-transform: uppercase;
    color: #2C3E50;
    margin-bottom: 10px;
    }
    .fs-subtitle {
    font-weight: normal;
    font-size: 13px;
    color: #666;
    margin-bottom: 20px;
    }
</style>
<div class="container">
<form id="msform" method="POST" action="http://localhost/codeig/docentes/editado">
<fieldset>
    <h2 class="fs-title">EDITAR</h2>
    <input type="text" name="nombre" placeholder="Nombre" value=<?php echo '"'.$usuario[0]['nombre'].'"'; ?>/>
    <input type="text" name="ci" placeholder="CI" value=<?php echo '"'.$usuario[0]['ci'].'"'; ?>/>
    <input type="text" name="fecha" placeholder="12-12-1899" value=<?php echo '"'.$usuario[0]['fecha_nac'].'"'; ?>/>
    <input type="text" name="depa" placeholder="Departamento" value=<?php echo '"'.$usuario[0]['departamento'].'"'; ?>/>
    <input type="text" name="usuario" placeholder="Usuario" value=<?php echo '"'.$usuario[0]['usuario'].'"'; ?>/>
    <input type="password" name="pass" placeholder="Contraseña" />
    <input type="submit" name="next" class="next action-button" value="Terminar" />
</fieldset>
</form>
</div>
</body>
</html>