<?php
session_start();
$nombre="";
$ci=0;
$notasdocente[0]='redes-sociales';
$notasdocente[1]="NOTAS";
$notasdocente[2]="avatar_Docente.jpg";
$arrayDocente=array('Materia', 'Sigla');
$arrayEstudiante=array('Materia', 'Sigla', 'Nota 1', 'Nota 2', 'Nota 3', 'Nota Final');
$titulos=array();
$departamentos=array('02'=>'LA PAZ', '03'=>'COCHABAMBA', '04'=>'ORURO', '05'=>'POTOSÍ');
//echo $departamentos['02'];
if($_SESSION['autorizado']==true){
    $ci = $_SESSION['ci'];
    $cargo="";
    include "conexion.inc.php";
    $query="SELECT * FROM usuario WHERE ci=".$ci.";";
    $resultado = $conn->query($query);
    $usuario = $resultado->fetch_all(MYSQLI_ASSOC);
    if($_SESSION['tipo']){
        //ESTUDIANTE
        $notasdocente[0]="";
        $notasdocente[1]="";
        $notasdocente[2]="avatar.jpg";
        $query="select xm.descripcion_m, xm.sigla, xi.nota1, xi.nota2, xi.nota3, xi.notafinal   
        from usuario xu, inscrito xi, materia xm
        where xu.ci = xi.ci
        and xi.sigla = xm.sigla
        and xi.ci =".$ci.";";
        $resultado= $conn->query($query);
        $titulos=$arrayEstudiante;
        $cargo="Estudiante";
    }else{
        //DOCENTE
        $titulos=$arrayDocente;
        $query="select xm.descripcion_m, xm.sigla
        from dicta xd, materia xm, usuario xu
        where xd.ci = xu.ci
        and xd.sigla = xm.sigla
        and xd.ci =".$ci.";";
        $resultado=$conn->query($query);
        $cargo="Docente";
    }

}else{
    echo '<h1 align="center">Ingresa con tu usuario y contraseña</h1>';
    echo '<meta http-equiv="refresh" content="2; url=login.php">';
    die();
}

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
        font-size: 0.95em;
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
                    <img src="<?php echo $notasdocente[2]; ?>" alt="img-avatar">
                </div>
            </div>
        </div>
        <div class="perfil-usuario-body">
            <div class="perfil-usuario-bio">
                <h3 class="titulo"><?php echo $usuario[0]['nombre']?></h3>
                <p class="texto">Formar profesionales altamente calificados, con compromiso y responsabilidad social, 
                    con reflexión y pensamiento crítico, emprendedor y constructor de una sociedad justa e inclusiva.</p>
            </div>
            <div class="perfil-usuario-footer">
                <ul class="lista-datos">
                    <li><i class="icono fas fa-map-signs"></i> Carrera: FCPN - Informática</li>
                    <li><i class="icono fas fa-phone-alt"></i> Contacto: <?php echo $usuario[0]['usuario']; ?>@mail.com</li>
                </ul>
                <ul class="lista-datos">
                    <li><i class="icono fas fa-map-marker-alt"></i> Departamento: <?php echo $departamentos[$usuario[0]['departamento']]; ?> - BOLIVIA</li>
                    <li><i class="icono fas fa-user-check"></i>Cargo: <?php echo $cargo; ?></li>
                </ul>
            </div>
            <!--                          Materias                          -->
            <?php
            
            ?>
            <div class="perfil-usuario-footer">
                <table style="margin: 0 auto;">
                    <tr><!--titulos-->
                    <?php
                        for($i=0; $i<count($titulos); $i++){
                            echo "<td>".$titulos[$i]."</td>";
                        }
                    ?>    
                    </tr>
                    <?php
                    while($fila=mysqli_fetch_array($resultado)){
                        echo "<tr>";
                        for ($j=0; $j<count($titulos); $j++) {
                            echo "<td>".$fila[$j]."</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="<?php echo $notasdocente[0]; ?>">
                <a href="notas.php" class="boton-redes media-notas"><?php echo $notasdocente[1] ?></a>
            </div>
        </div>
    </section>
    <!--====  End of html  ====-->
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