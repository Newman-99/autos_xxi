<?php include("header.php"); ?>

<h2>Consultar:</h2>

<form action="consultar.php" method="get">
<p>
    <!-- Para elegir el campo para la busqueda -->
Campo: <select name="campo_c">
    <option value="Matricula"> Matricula</option>
    <option value="Marcas"> Marcas</option>
    <option value="Modelo"> Modelo</option>
    <option value="Color"> Color</option>
    <option value="Fecha"> Fecha</option>
    <option value="Precio"> Precio</option>
    <option value="Combustible"> Combustible </option>
    <option value="Todos"> Todos </option>
</select>

    <input type="submit" name="elegir" value="Elegir">
    
    <?php
    // Segun la Opcion elegi el tipo de campo para consultar
    if (isset($_GET["elegir"])) {
    
        switch ($_GET["campo_c"]) {
           
            case 'Matricula':
            echo " <p>Matricula: <input type='text' name='valor_busc'></p>";
            echo  "Buscar <input type='submit' value='Matricula' name='enviar'>";            
            break;

            case 'Marcas':
            echo "<p> Marcas: <select name='valor_busc'>
                <option value='Nissan'> Nisaan</option>
                <option value='Chevrolet'> Chevrolet</option>
                <option value='Toyota'> Toyota</option>
                <option value='KIA'> KIA</option>
                <option value='Volkswagen'> Volkswagen</option>
            </select></p>";
            echo  "Buscar <input type='submit' value='Marca' name='enviar'>";            
            break;

            case 'Modelo':
            echo " <p>Modelo: <input type='text' name='valor_busc'></p>";
            echo  "Buscar <input type='submit' value='Modelo' name='enviar'>";            
                break;

            case 'Color':
            echo " <p>Color: <input type='text' name='valor_busc'></p>";
            echo  "Buscar <input type='submit' value='Color' name='enviar'>";            
                break;
            
            case 'Fecha':
            echo " <p>Fecha: <input type='date' name='valor_busc'></p>";
            echo  "Buscar <input type='submit' value='Fecha' name='enviar'>";            
                break;
            
            case 'Precio':
            echo "<p>Precio: <input type='number' name='valor_busc'></p>";
            echo  "Buscar <input type='submit' value='Precio' name='enviar'>";            
                break;
        
            case 'Combustible':
            echo "<p>Combustible: <input type='text' name='valor_busc'>
            </p>";
            echo  "Buscar <input type='submit' value='Combustible' name='enviar'>";            
            break;

            case 'Todos':
            echo  "<p>Buscar <input type='submit' value='Todos' name='enviar' </p>";            
            break;

        }
    }
    
        
    ?>
</p>

</form>

<hr>

<?php
 if (isset($_GET['enviar'])) {
   $campo_busc= $_GET['enviar'];

   if($campo_busc == 'Todos' ){

    require("connect_bd.php"); 

    $result = mysqli_query($conexion,"SELECT * FROM `autos` ");

    while($fila=mysqli_fetch_array($result)){
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

    }else {

   include("validacion.php");

   $valor_busc= $_GET['valor_busc'];       

   if(val_date($valor_busc)){
        echo "Evite los espacios y campos vacios";
} else {


    require("connect_bd.php"); 

    $ver_mat= mysqli_query($conexion,"SELECT * FROM `autos` WHERE `$campo_busc` = $valor_busc ");
    
    if(mysqli_num_rows($ver_mat)==0){
        echo "Auto No Registrado";

    }else {

        $result = mysqli_query($conexion,"SELECT * FROM `autos` WHERE `$campo_busc` = $valor_busc ");
            echo "Buscando: ".$campo_busc." ".$valor_busc."<br><br>";

        while($fila=mysqli_fetch_array($result)){
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
}
mysqli_close($conexion);

}

?>

<?php include("footer.php"); ?>