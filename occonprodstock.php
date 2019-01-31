<?php
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "pedidos";
 session_start();
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 
$Aux_ID=$_POST['articulo1'];
$sql ="SELECT quantityInStock FROM products WHERE productCode='".$Aux_ID."'";
	$resultado = mysqli_query($conn, $sql);
	if( $datos = mysqli_fetch_array($resultado)){
		$cantidadStock=$datos['quantityInStock'];
		echo "<table border='3'> <tr>";
		echo '<td>El producto seleccionado tiene:</td><td> '.$cantidadStock.' unidades </td>';
		echo "<tr></table>";
}
?>