<?php
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "test";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
/*creacion de los arrais*/

$productos = [
    $_POST['articulo1'] => $_POST['cantidad1'],
    $_POST['articulo2'] => $_POST['cantidad2'],
	$_POST['articulo3'] => $_POST['cantidad3'],
	$_POST['articulo4'] => $_POST['cantidad4'],
	$_POST['articulo5'] => $_POST['cantidad5']
]; 

foreach($productos as $producto => $valor) {
	
	echo "El valor del producto es: ".$valor."<br>";
	if(!hayStock($producto, $valor,$conn)){
		echo "No hay stock disponible para el producto ".$producto."<br>";
	}else{
		modificarCantidad($producto, $valor,$conn);
		echo "La cantidad de producto ha sido modificada"."<br>";
	}
}
	
function hayStock($producto, $valor,$conn){
	
	$sentencia = mysqli_stmt_init($conn);
	mysqli_stmt_prepare($sentencia, "select quantityinstock from products where productCode=?");
	mysqli_stmt_bind_param($sentencia,'s',$producto);
	
     /* ejecutar la consulta */
    mysqli_stmt_execute($sentencia);
	
    /* vincular las variables de resultados */
    mysqli_stmt_bind_result($sentencia, $resultadoSql);
	var_dump ($resultadoSql." Cantidad misteriosa");
    /* cerrar la sentencia */
    mysqli_stmt_close($sentencia);
	if(!is_null($resultadoSql) && $resultadoSql-$valor > 0){
		return true;
	}else{
		return false;
	}
}

function modificarCantidad($producto, $valor,$conn){
	$sentencia = mysqli_stmt_init($conn);
	
	mysqli_stmt_prepare($sentencia, "update products set quantityinstock=quantityinstock-? where productCode=?");
	
	mysqli_stmt_bind_param($sentencia,'is',$valor,$producto );
	/* ejecutar la consulta */
    mysqli_stmt_execute($sentencia);

    /* cerrar la sentencia */
    mysqli_stmt_close($sentencia);

	}
/*
if (mysqli_query($conn, $sql)) {
 if (mysqli_num_rows($resultado) > 0 && mysqli_num_rows($resultado) < 5) {
		// output data of each row
		while($fila = mysqli_fetch_assoc($resultado)) {
			echo $fila["title"]." ".$fila["name"]." ".$fila["rental_duration"]."<br>";
		}  
}else{
	echo "La cantidad de productos no es correcta";
}
	
} else {
    echo "Error creating table: " . mysqli_error($conn);
	
}*/
?>