<?php include("header.php"); ?>

<h2>Registrar:</h2>

<?php

?>

<form action="registrar.php" method="post">

<p>Matricula: <input type="text" name="matricula_r">
</p>

<p>
Marcas: <select name="marcas_r">
    <option value="Nissan"> Nisaan</option>
    <option value="Chevrolet"> Chevrolet</option>
    <option value="Toyota"> Toyota</option>
    <option value="KIA"> KIA</option>
    <option value="Volkswagen"> Volkswagen</option>

</select>    
</p>

<p>Modelo: <input type="text" name="modelo_r">
</p>

<p>Color: <input type="text" name="color_r">
</p>

<p>Fecha: <input type="date" name="fecha_r">
</p>

<p>Precio: <input type="number" name="precio_r">
</p>

<p>Combustible: <input type="text" name="combustible_r">
</p>

<input type="submit" value="Enviar" name="enviar">
</form>

<hr>

<?php

if (isset($_POST["enviar"])) {

    $matricula = $_POST["matricula_r"];
    $marca = $_POST["marcas_r"];
    $modelo = $_POST["modelo_r"];
    $color = $_POST["color_r"];
    $fecha = $_POST["fecha_r"];
    $precio = $_POST["precio_r"];
    $combustible = $_POST["combustible_r"];

    include("validacion.php");

    if(val_date($matricula) || val_date($marca) || val_date($modelo) || val_date($color) || 
    val_date($fecha) || val_date($precio) || val_date($combustible)){
        echo "Evite los espacios y campos vacios";
} else {
  
    require("connect_bd.php");
    $insert = "INSERT INTO autos(Matricula,Marca,Modelo,Color,Fecha,Precio,Combustible)
    VALUES('$matricula','$marca','$modelo','$color','$fecha','$precio','$combustible')";

    $ver_mat= mysqli_query($conexion,"SELECT * FROM autos WHERE Matricula =  '$matricula'");
    if(mysqli_num_rows($ver_mat)>0){
        echo "Auto ya Registrado";

    }else {
        
    $result = mysqli_query($conexion,$insert);    
    if ($result) {
        echo "Datos Insertados Correctamente<br>";
        
        $result = mysqli_query($conexion, "SELECT * FROM autos WHERE Matricula =  '$matricula'");
        
        while($fila=mysqli_fetch_array($result,MYSQLI_BOTH)){
        echo "
        <table>
          <tr>
            <th>Matricula</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Color</th>
            <th>Fecha</th>
            <th>Precio</th>
            <th>Combustible</th>
            </tr>
             
            <tr>
            <td>".$fila["Matricula"]."</td>
            <td>".$fila["Marca"]."</td>
            <td>".$fila["Modelo"]."</td>
            <td>".$fila["Color"]."</td>
            <td>".$fila["Fecha"]."</td>
            <td>".$fila["Precio"]."</td>
            <td>".$fila["Combustible"]."</td>

            </tr>
            </table>
            ";
        }         
        mysqli_close($conexion);

   }else {
    echo "Error Verifique sus Datos";
}
   
}

}

}

?>

<?php include("footer.php"); ?>
