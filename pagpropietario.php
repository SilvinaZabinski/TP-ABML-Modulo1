<html>
<head>
<style>
th
    {color: white;
     background-color: tomato;
    }
</style>
<link href="index.css" rel="stylesheet" type="text/css" />
</head>
    <body>
    <h1>Alta, Baja y Modificaciones de Propietarios</h1>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
            <th style='width:50px;'>ID</th>
            <th style='width:150px;'>Nombre</th>
            <th style='width:150px;'>Dirección</th>
            <th style='width:150px;'>Localidad</th>
            <th style='width:150px;'>Teléfono</th>
            <th style='width:150px;'>Email</th>
            <th style='width:50px;'>Estado</th>
            <th style='width:150px;'>Acciones</th>
            </tr>
            </thead>
            <div class=boton>
            <a href="agregarpropietario.php">Agregar</a>
            </div>
            <br>
            <tbody>

                <?php
                    //############## CONEXION A LA BASE ##############
                    $servername = "localhost";  
                    $username = "root";
                    $password = "";
                    $database = "veterinaria";
                    $mysqli = new mysqli($servername, $username, $password, $database);
                    if ($mysqli->connect_errno) {
                        echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
                    }

                    //############## SI HUBO UN METODO GET Y ME TRAJO EL NUMERO DE PAGINA, LO USO. SI NO, ESTABLEZCO UNO POR DEFECTO (EMPEZANDO DEL PRINCIPIO) ##############
                    if (isset($_GET['pagina_nro']) && $_GET['pagina_nro'] != "") 
                    {
                        $paginaNro = $_GET['pagina_nro'];
                    } 
                    else 
                    {
                        $paginaNro = 1;
                    }

                    //############## DEFINO UN MAXIMO DE ELEMENTOS POR PAGINA ##############
                    $cantidadMaximaElementosPagina = 2;
                    
                    //############## CALCULO VALORES PARA LA PAGINACION ##############
                    $offset = ($paginaNro - 1) * $cantidadMaximaElementosPagina;
                    $paginaAnterior = $paginaNro - 1;
                    $paginaSiguiente = $paginaNro + 1;
                
                    //############## REALIZO LA CONSULTA PARA SABER CUANTOS ELEMENTOS HAY EN TOTAL ##############
                    $sentencia = $mysqli->prepare("SELECT COUNT(*) as cantidad FROM propietarios");
                    $sentencia->execute();
                    $resultado = $sentencia->get_result();
                    $fila = $resultado->fetch_assoc();

                    //############## GUARDO LA CANTIDAD TOTAL DE ELEMENTOS EN UNA VARIABLE ##############
                    $cantidadTotalElementos = $fila["cantidad"];

                    //############## CALCULO LA CANTIDAD DE PAGINAS QUE NECESITO ##############
                    $totalPaginas = ceil($cantidadTotalElementos / $cantidadMaximaElementosPagina);

                    //############## REALIZO LA CONSULTA PARA OBTENER SOLO LOS ELEMENTOS DE LA PAGINA ACTUAL ##############
                    $sentencia = $mysqli->prepare("SELECT * FROM propietarios LIMIT $offset, $cantidadMaximaElementosPagina");
                    $sentencia->execute();
                    $resultado = $sentencia->get_result();
                    $fila = $resultado->fetch_assoc();

                    while($fila)
                    {
                        echo "<tr>
                                <td>".$fila['idpropietario']."</td>
                                <td>".$fila['nombre']."</td>
                                <td>".$fila['direccion']."</td>
                                <td>".$fila['localidad']."</td>
                                <td>".$fila['telefono']."</td>
                                <td>".$fila['email']."</td>
                                <td>".$fila['estado']."</td>
                                <td><type="submit" name="botonenvio" value="presionado">Enviar></td>
                                <td>Eliminar</td>
                            </tr>";        
                                
                        
                        $fila = $resultado->fetch_assoc();
                    }

                    mysqli_close($mysqli);
                ?>
            </tbody>
        </table>
        <div style='padding: 10px 20px 0px; border-top: dotted 1px #CC ;'>
            <strong>Pagina <?php echo $paginaNro." de ".$totalPaginas; ?></strong>
        </div>
        <tr class="pagination">
            <?php 
                if($paginaNro > 1)
                {
                    echo "<th><a href='?pagina_nro=1'>Primera Pagina</a></th>";
                } 
            ?>
            
            <th>
                <a <?php if($paginaNro > 1){ echo "href='?pagina_nro=$paginaAnterior'"; } ?>>Anterior</a>
            </th>
            
            <th>
                <a <?php if($paginaNro < $totalPaginas) { echo "href='?pagina_nro=$paginaSiguiente'";} ?>>Siguiente</a>
            </th>
        
            <?php 
                if($paginaNro < $totalPaginas)
                {
                    echo "<th><a href='?pagina_nro=$totalPaginas'>Ultima Pagina &rsaquo;&rsaquo;</a></li>";
                } 
            ?>
        </tr>
    </body>
</html>