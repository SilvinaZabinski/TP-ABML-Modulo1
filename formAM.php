<html>
<head>
    <meta charset="utf-8">
    <title>Agrega-modificar</title>
</head>
<body>
    <h2>Agregar o Modificar</h2>
</body>
<form action="agregar.php" method="POST" name = "Agregar">
 <p>Nombre Animal: <input type="text" name="Nombre" id = "Nombre" placeholder="Nombre Animal"/></p>
 <p>Especie: <input type="text" name="Especie" id = "Especie" placeholder="Especie"/></p>
 <p>Raza: <input type="text" name="Raza" id = "Raza" placeholder="Raza"/></p>
 <p>Sexo: <input type="text" name="Sexo" id = "Sexo" placeholder="Sexo"/></p>
 <p>Pelaje: <input type="text" name="Pelaje" id = "Pelaje" placeholder="Pelaje"/></p>
 <p>Fecha Nacimiento: <input type = "Date" name = "dd-mm-yyyy" id = "Fecha_nacimiento" placeholder="Fecha_Nacimiento"/></p>
 <p>Dueño: <input type="text" name="id_dueño" id = "id_dueño" placeholder="id_dueño"/></p>
 
 <input id="submit" name="submit" type="submit" value="Guardar"> <a href="agregar.php"></a>
 <input id="submit" name="submit" type="submit" value="Cancelar">
 </form> 
 </html>