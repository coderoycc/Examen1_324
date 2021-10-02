<?php
//Conectamos a la base de datos
$conn = mysqli_connect("localhost","root","");
if ($conn == false){
    echo "Ocurrio un error";
    die();
}
mysqli_select_db($conn, "FCPN");

$query='select * from usuario where tipo="D";';
$resultado = $conn->query($query);







?>
<html>
<head>
    <title>Docentes</title>
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
    table {
        width: 800px;
        border-collapse: collapse;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    th,td {
        padding: 15px;
        background-color: rgba(255,255,255,0.2);
        color: #fff;
    }
    th {
        text-align: left;
    }
    thead {
        th {
            background-color: #55608f;
        }
    }
    tbody {
        tr {
            &:hover {
                background-color: rgba(255,255,255,0.3);
            }
        }
        td {
            position: relative;
            &:hover {
                &:before {
                    content: "";
                    position: absolute;
                    left: 0;
                    right: 0;
                    top: -9999px;
                    bottom: -9999px;
                    background-color: rgba(255,255,255,0.2);
                    z-index: -1;
                }
            }
        }
    }
    a{
        text-decoration: none;
        color: blue;
    }
    a.boton{
        color: #0099cc;
        background: transparent;
        border: 2px solid #0099cc;
        border-radius: 6px;
        text-decoration: none;
        text-transform:uppercase;
        padding: 10px 32px;
        font-size: 25px;
    }
</style>
<div class="container">
<h1 align="center">TABLA DE DOCENTES</h1>
<center>
    <a href="http://localhost/codeig/docentes/agrega" class="boton">AÑADIR NUEVO</a></b>
<center>
<br>
	<table>
		<thead>
			<tr>
				<th>NOMBRE</th>
				<th>CI</th>
				<th>USUARIO</th>
				<th>DEPARTAMENTO</th>
				<th>OPCIONES</th>
			</tr>
		</thead>
		<tbody>
        <?php
        while($fila=mysqli_fetch_array($resultado)){
            echo "<tr>";
                echo "<td>".$fila['nombre']."</td>";
                echo "<td>".$fila['ci']."</td>";
                echo "<td>".$fila['usuario']."</td>";
                echo "<td>".$fila['departamento']."</td>";
                echo '<td><a href="http://localhost/codeig/docentes/elimina/'.$fila['ci'].'">ELIMINAR</a> - 
                <a href="http://localhost/codeig/docentes/editar/'.$fila['ci'].'">EDITAR</a></td>';
            echo "</tr>";
        }
        ?>
		</tbody>
    </table>
    <br>

</div>
</body>
</html>