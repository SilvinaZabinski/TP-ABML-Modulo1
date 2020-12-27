<html>
<head>
    <meta charset="utf-8">
    <title>Agrega-modificar</title>
</head>
<body>
    <h2>Agregar o Modificar</h2>
</body>
<form action="agregar.php" method="POST">
 <p>Nombre Animal: <input type="text" name="nombre" placeholder="Nombre Animal"/></p>
 <p>Especie: <input type="text" name="Especie" placeholder="Especie"/></p>
 <p>Raza: <input type="text" name="Raza" placeholder="Raza"/></p>
 <p>Sexo: <input type="text" name="Sexo" placeholder="Sexo"/></p>
 <p>Pelaje: <input type="text" name="Pelaje" placeholder="Pelaje"/></p>
 <p>Fecha Nacimiento: <input type = "date" name = "MM-DD-YYYY"> <br>
 <p>Dueño: <input type="text" name="Dueño" placeholder="id_dueño"/></p>
 
 <input id="submit" name="submit" type="submit" value="Guardar"> <a href="agregar.php"></a>
 <input id="submit" name="submit" type="submit" value="Cancelar">
 </form> 
 </html>