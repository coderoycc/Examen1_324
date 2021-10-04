<?php
session_start();
$ci=$_SESSION['ci'];
include "conexion.inc.php";
$query="SELECT * FROM usuario WHERE ci=".$ci.";";
$resultado = $conn->query($query);
$usuario = $resultado->fetch_all(MYSQLI_ASSOC);
$departamentos=array('02'=>'LA PAZ', '03'=>'COCHABAMBA', '04'=>'ORURO', '05'=>'POTOSÍ');

//Consulta para ver las notas de los estudiantes de todas las materias 
$querymaterias="select xd.sigla, xi.ci ,xi.nota1, xi.nota2, xi.nota3, xi.notafinal
from dicta xd, inscrito xi
where xd.ci =".$ci."
and xd.sigla = xi.sigla
order by xd.sigla;
";

//consulta para ver la media de las notas
$querymedia="select xtemp.departamento, AVG(xtemp.notafinal) as media
from (select xu.departamento, (xi.notafinal)
from usuario xu, inscrito xi
where xi.ci = xu.ci
order by xu.departamento) xtemp 
group by xtemp.departamento;";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USUARIO</title>
    <link rel="stylesheet" type="text/css" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
<style type="text/css">

    html {
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
        text-size-adjust: 100%;
        line-height: 1.4;
    }

    * {
        margin: 0;
        padding: 0;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    body {
        color: #404040;
        font-family: "Arial", Segoe UI, Tahoma, sans-serifl, Helvetica Neue, Helvetica;
    }
    table{
        border: 2px solid #5f716b;
        border-spacing: 0px;
    }
    td.nota{
        text-align: center;
    }
    td, tr{
        border: 1px solid #5f716b;
        padding: 3px;
    }
    td.colorea{
        background-color: #f0f0f0;
    }
    /*=====================================
    estilos de la utilidad
    Copiar esto
    =====================================*/
    .seccion-perfil-usuario .perfil-usuario-body,
    .seccion-perfil-usuario {
        display: flex;
        flex-wrap: wrap;
        flex-direction: column;
        align-items: center;
    }

    .seccion-perfil-usuario .perfil-usuario-header {
        width: 100%;
        display: flex;
        justify-content: center;
        background: linear-gradient(#B873FF, transparent);
        margin-bottom: 1.25rem;
    }

    .seccion-perfil-usuario .perfil-usuario-portada {
        display: block;
        position: relative;
        width: 90%;
        height: 17rem;
        background: linear-gradient(45deg, #BC3CFF, #317FFF);
        border-radius: 0 0 20px 20px;
    }

    .seccion-perfil-usuario .perfil-usuario-portada .boton-portada {
        position: absolute;
        top: 1rem;
        right: 1rem;
        border: 0;
        border-radius: 8px;
        padding: 12px 25px;
        background-color: rgba(0, 0, 0, .5);
        color: #fff;
        cursor: pointer;
    }

    .seccion-perfil-usuario .perfil-usuario-portada .boton-portada i {
        margin-right: 1rem;
    }

    .seccion-perfil-usuario .perfil-usuario-avatar {
        display: flex;
        width: 180px;
        height: 180px;
        align-items: center;
        justify-content: center;
        border: 7px solid #FFFFFF;
        background-color: #DFE5F2;
        border-radius: 50%;
        box-shadow: 0 0 12px rgba(0, 0, 0, .2);
        position: absolute;
        bottom: -40px;
        left: calc(50% - 90px);
        z-index: 1;
    }

    .seccion-perfil-usuario .perfil-usuario-avatar img {
        width: 100%;
        position: relative;
        border-radius: 50%;
    }

    .seccion-perfil-usuario .perfil-usuario-avatar .boton-avatar {
        position: absolute;
        left: -2px;
        top: -2px;
        border: 0;
        background-color: #fff;
        box-shadow: 0 0 12px rgba(0, 0, 0, .2);
        width: 45px;
        height: 45px;
        border-radius: 50%;
        cursor: pointer;
    }

    .seccion-perfil-usuario .perfil-usuario-body {
        width: 70%;
        position: relative;
        max-width: 750px;
    }

    .seccion-perfil-usuario .perfil-usuario-body .titulo {
        display: block;
        width: 100%;
        font-size: 1.75em;
        margin-bottom: 0.5rem;
    }

    .seccion-perfil-usuario .perfil-usuario-body .texto {
        color: #848484;
        font-size: 1.15em;
    }

    .seccion-perfil-usuario .perfil-usuario-footer,
    .seccion-perfil-usuario .perfil-usuario-bio {
        display: flex;
        flex-wrap: wrap;
        padding: 1.5rem 2rem;
        box-shadow: 0 0 12px rgba(0, 0, 0, .2);
        background-color: #fff;
        border-radius: 15px;
        width: 100%;
    }

    .seccion-perfil-usuario .perfil-usuario-bio {
        margin-bottom: 1.25rem;
        text-align: center;
    }

    .seccion-perfil-usuario .lista-datos {
        width: 50%;
        list-style: none;
    }

    .seccion-perfil-usuario .lista-datos li {
        padding: 5px 0;
    }

    .seccion-perfil-usuario .lista-datos li>.icono {
        margin-right: 1rem;
        font-size: 1.2rem;
        vertical-align: middle;
    }

    .seccion-perfil-usuario .redes-sociales {
        position: absolute;
        right: calc(0px - 50px - 1rem);
        top: 0;
        display: flex;
        flex-direction: column;
    }

    .seccion-perfil-usuario .redes-sociales .boton-redes {
        border: 0;
        background-color: #fff;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 90px;
        height: 50px;
        border-radius: 10%;
        color: #fff;
        box-shadow: 0 0 12px rgba(0, 0, 0, .2);
        font-size: 1.3rem;
    }

    .seccion-perfil-usuario .redes-sociales .boton-redes+.boton-redes {
        margin-top: .5rem;
    }

    .seccion-perfil-usuario .boton-redes.media-notas {
        background-color: #5c6aff;
        font-size: 1rem;
        color:#001010;
        font-weight: bold;
    }

    .seccion-perfil-usuario .boton-redes.twitter {
        background-color: #35E1BF;
    }

    .seccion-perfil-usuario .boton-redes.instagram {
        background: linear-gradient(45deg, #FF2DFD, #40A7FF);
    }

    /* adactacion a dispositivos */
    @media (max-width: 750px) {
        .seccion-perfil-usuario .lista-datos {
            width: 100%;
        }

        .seccion-perfil-usuario .perfil-usuario-portada,
        .seccion-perfil-usuario .perfil-usuario-body {
            width: 95%;
        }

        .seccion-perfil-usuario .redes-sociales {
            position: relative;
            flex-direction: row;
            width: 100%;
            left: 0;
            text-align: center;
            margin-top: 1rem;
            margin-bottom: 1rem;
            align-items: center;
            justify-content: center
        }

        .seccion-perfil-usuario .redes-sociales .boton-redes+.boton-redes {
            margin-left: 1rem;
            margin-top: 0;
        }
    }
</style>
    <section class="seccion-perfil-usuario">
        <div class="perfil-usuario-header">
            <div class="perfil-usuario-portada">
                <div class="perfil-usuario-avatar">
                    <img src="avatar_Docente.jpg" alt="img-avatar">
                </div>
            </div>
        </div>
        <div class="perfil-usuario-body">
            <div class="perfil-usuario-bio">
                <h3 class="titulo"><?php echo $usuario[0]['nombre']?></h3>
                <br>
                <br/>
                <h3>Docente de la Facultad "Ciencias Puras y Naturales"</h4>
            </div>

            <!--                   NOTAS MEDIA                      -->
            <p>
                <h4 class="texto">Media de las Notas por departamento</h4>
            </p>
            <div class="perfil-usuario-footer">
                
                <table style="margin: 0 auto;">
                    <tr>
                        <td class="colorea"><b>Departamento</b></td>
                        <?php
                        $resultado = $conn->query($querymedia);
                        $nota=array();
                        $ind=0;
                            while ($fila=mysqli_fetch_array($resultado)) {
                                echo '<td class="nota colorea">'.$departamentos[$fila['departamento']].'</td>';
                                $nota[$ind]=$fila['media'];
                                $ind++;
                            }
                        ?>    
                    </tr>
                    <tr>
                        <td class="colorea"><b>Nota Media<b></td>
                        <?php
                            for ($f=0; $f<$ind; $f++) {
                                echo '<td class="nota">'.$nota[$f].'</td>';
                            }
                        ?>
                    </tr>
                </table>
            </div>
            <!--                NOTAS MIS ESTUDIANTES                -->
            <p>
                <h4 class="texto">Notas de mis materias</h4>
            </p>
            <div class="perfil-usuario-footer">
                <table border="1px" style="margin: 0 auto;">
                    <tr>
                        <td class="colorea">Sigla</td>
                        <td class="colorea">ID Estudiante</td>
                        <td class="colorea">Nota 1</td>
                        <td class="colorea">Nota 2</td>
                        <td class="colorea">Nota 3</td>
                        <td class="colorea">Nota final</td>    
                    </tr>
                    <?php
                    $resultado = $conn->query($querymaterias);
                    while ($fila=mysqli_fetch_array($resultado)) {
                    echo "<tr>";
                        echo '<td>'.$fila['sigla'].'</td>';
                        echo '<td>'.$fila['ci'].'</td>';
                        echo '<td class="nota">'.$fila['nota1'].'</td>';
                        echo '<td class="nota">'.$fila['nota2'].'</td>';
                        echo '<td class="nota">'.$fila['nota3'].'</td>';
                        echo '<td class="nota">'.$fila['notafinal'].'</td>';
                    echo "</tr>";
                    }
                    ?>
                    
                </table>
            </div>
            <div class="redes-sociales">
                <a href="perfil.php" class="boton-redes media-notas">VOLVER</a>
            </div>
        </div>
    </section>
    <!--====  End of html  ====-->

<!--=============================
redes sociales fijadas en pantalla
No es necesario que copies esto!
==============================-->
<style>
.mensaje a {
    color: inherit;
    margin-right: .5rem;
    display: inline-block;
}
.mensaje a:hover {
    color: #309B76;
    transform: scale(1.4)
}
</style>
</body>

</html>