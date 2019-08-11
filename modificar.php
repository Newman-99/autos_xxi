<?php include('header.php'); ?>

<h2>Modificar:</h2>

<form action='modificar.php' method='get'>

<p>Matricula: <input type='text' name='matricula_a'>
</p>

<input type='submit' value='Enviar' name='enviar'>

</form>

<?php
if (isset($_GET['enviar'])){
    $matricula_act = $_GET['matricula_a'];

    include('validacion.php');
    if(val_date($matricula_act)){
        echo 'Evite los espacios y campos vacios';
} else {

    require('connect_bd.php'); 


    $result = mysqli_query($conexion,"SELECT * FROM autos WHERE Matricula =  '$matricula_act' ");

    if(mysqli_num_rows($result)==0){
        echo 'Auto No Registrado';
    }else {

        while($fila=mysqli_fetch_array($result)){
            
echo "<hr>Elegir Datos a Modigicar";

echo "<form action='modificar.php' method='GET'>";

echo "<p>Matricula Original: <input type='text' name='matricula_orig' value ='".$fila['Matricula']."'>
</p>";

echo "<p>Matricula a Modificar: <input type='text' name='matricula_m' value ='".$fila['Matricula']."'>
</p>";


echo "<p>
Marcas: <select name='marcas_m' value ='".$fila['Marca'].">
    <option value='Nissan'> Nisaan</option>
    <option value='Chevrolet'> Chevrolet</option>
    <option value='Toyota'> Toyota</option>
    <option value='KIA'> KIA</option>
    <option value='Volkswagen'> Volkswagen</option>

</select>    
</p>";

echo "<p>Modelo: <input type='text' name='modelo_m' value ='".$fila['Modelo']."'>
</p>";

echo "<p>Color: <input type='text' name='color_m' value ='".$fila['Color']."'>
</p>";

echo "<p>Fecha: <input type='date' name='fecha_m' value ='".$fila['Fecha']."'>
</p>";

echo "<p>Precio: <input type='number' name='precio_m' value ='".$fila['Precio']."'>
</p>";

echo "<p>Combustible: <input type='text' name='combustible_m' value ='".$fila['Combustible']."'>
</p>";

echo "<input type='submit' value='Actualizar' name='enviar2'>
</form>";

echo "</form>";
        }
    
    }
}
}

if (isset($_GET["enviar2"])) {

    $matricula = $_GET["matricula_m"];
    $matricula_orig = $_GET["matricula_orig"];

    $marca = $_GET["marcas_m"];
    $modelo = $_GET["modelo_m"];
    $color = $_GET["color_m"];
    $fecha = $_GET["fecha_m"];
    $precio = $_GET["precio_m"];
    $combustible = $_GET["combustible_m"];


    include("validacion.php");

    if(val_date($matricula) || val_date($marca) || val_date($modelo) || val_date($color) || 
    val_date($fecha) || val_date($precio) || val_date($combustible)){
        
        echo "<br>Evite los espacios y campos vacios";
    
    } else{ 
        

require('connect_bd.php'); 

$consulta = "UPDATE autos SET Matricula='$matricula',Marca ='$marca',Modelo ='$modelo',
Color ='$color',Fecha ='$fecha',Precio='$precio',Combustible ='$combustible' WHERE Matricula = '$matricula_orig' ";
 
mysqli_query($conexion,$consulta);

    
        echo "Datos Actualizados<br>";

        $resultado = mysqli_query($conexion,"SELECT * FROM `autos` WHERE Matricula = '$matricula' ");

while($fila=mysqli_fetch_array($resultado)){
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
    <td>".$fila['Matricula']. "</td>
    <td>".$fila['Marca']."</td>
    <td>".$fila['Modelo']."</td>
    <td>".$fila['Color']."</td>
    <td>".$fila['Fecha']."</td>
    <td>".$fila['Precio']."</td>
    <td>".$fila['Combustible']."</td>

    </tr>
    </table>";

}
} 
    }

?>

<?php include('footer.php');?>