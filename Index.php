<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="IndexStyle.Css">
    <title>Veterinaria</title>
  </head>
  <h1> Veterinaria Zimba</h1> 

  <a href="formAM.php"><input type="button" value="Agregar"></a>

    
    <body class= "fondo_img">
        <table>
            <thead>
            <tr>
            <th>ID</th>
            <th >Nombre Animal</th>
            <th >Especie</th>
            <th >Raza</th>
            <th >Sexo</th>
            <th >Pelaje</th>
            <th >Fecha Nacimiento</th>
            <th >Dueño</th>
            <th >Editar</th>
            <th >Borrar</th>
            
            
            </tr>
            </thead>
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
                    else{
                        echo "Conexion exitosa a la base ", $database;
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
                    $cantidadMaximaElementosPagina = 5;
                    
                    //############## CALCULO VALORES PARA LA PAGINACION ##############
                    $offset = ($paginaNro - 1) * $cantidadMaximaElementosPagina;
                    $paginaAnterior = $paginaNro - 1;
                    $paginaSiguiente = $paginaNro + 1;
                
                    //############## REALIZO LA CONSULTA PARA SABER CUANTOS ELEMENTOS HAY EN TOTAL ##############
                    $sentencia = $mysqli->prepare("SELECT COUNT(*) as cantidad FROM animal");
                    $sentencia->execute();
                    $resultado = $sentencia->get_result();
                    $fila = $resultado->fetch_assoc();
                    //############## GUARDO LA CANTIDAD TOTAL DE ELEMENTOS EN UNA VARIABLE ##############
                    $cantidadTotalElementos = $fila["cantidad"];

                    //############## CALCULO LA CANTIDAD DE PAGINAS QUE NECESITO ##############
                    $totalPaginas = ceil($cantidadTotalElementos / $cantidadMaximaElementosPagina);

                    //############## REALIZO LA CONSULTA PARA OBTENER SOLO LOS ELEMENTOS DE LA PAGINA ACTUAL ##############
                    $sentencia = $mysqli->prepare("SELECT a.ID_animal, a.Nombre as NombreAnimal, a.Especie, a.Raza, a.Sexo, a.Pelaje, a.Fecha_nacimiento, d.Nombre as NombreDueño FROM animal a Left Join dueño d ON a.id_dueño = d.ID_dueño
                    where a.estado = 1 LIMIT $offset, $cantidadMaximaElementosPagina");
                    $sentencia->execute();
                    $resultado = $sentencia->get_result();
                    $fila = $resultado->fetch_assoc();

                    while($fila)
                    {
                        echo "  <tr>
                                    <td>".$fila['ID_animal']."</td>
                                    <td>".$fila['NombreAnimal']."</td>
                                    <td>".$fila['Especie']."</td>
                                    <td>".$fila['Raza']."</td>
                                    <td>".$fila['Sexo']."</td>
                                    <td>".$fila['Pelaje']."</td>
                                    <td>".$fila['Fecha_nacimiento']."</td>
                                    <td>".$fila['NombreDueño']."</td>
                                    <TD><INPUT class=boton type=submit value=Editar name=Submit></TD>
                                    <TD><INPUT class=boton type=submit value=Borrar name=Submit></TD>
                                  </tr>";
                        
                        $fila = $resultado->fetch_assoc();
                    }

                    mysqli_close($mysqli);
                ?>
            </tbody>
        </table>
        <div>
            <strong>Pagina <?php echo $paginaNro." de ".$totalPaginas; ?></strong>
        </div>
        <ul class="pagination">
            <?php 
                if($paginaNro > 1)
                {
                    echo "<li><a href='?pagina_nro=1'>Primera Pagina</a></li>";
                } 
            ?>
            
            <li>
                <a <?php if($paginaNro > 1){ echo "href='?pagina_nro=$paginaAnterior'"; } ?>>Anterior</a>
            </li>
            
            <li>
                <a <?php if($paginaNro < $totalPaginas) { echo "href='?pagina_nro=$paginaSiguiente'";} ?>>Siguiente</a>
            </li>
        
            <?php 
                if($paginaNro < $totalPaginas)
                {
                    echo "<li><a href='?pagina_nro=$totalPaginas'>Ultima Pagina &rsaquo;&rsaquo;</a></li>";
                } 
            ?>
        </ul>
    </body>
</html>