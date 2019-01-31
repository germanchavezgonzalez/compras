<?php
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "pedidos";
 session_start();

function error($error_level, $error_message){
	echo "Error ".$error_level.": ".$error_message."<br>";
}

function volver(){
	echo"<a href='welcome.php'>Volver</a>";
}

// Crea conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Comprobamos conexión
if (!$conn) {
	die("Conexión fallida: " . mysqli_connect_error());
}/* crear una sentencia preparada */
//Establecemos variable obtenido del html



if($_SESSION['idCliente']==""){
	error(401,"El id esta vacio");
		volver();
		
	}else{
	
$Aux_IDCliente=$_SESSION['idCliente'];

	/*N.Pedido-Fecha pedido-Estado pedido*/
	//,orders.status,products.productName,orderdetails.quantityOrdered, orderdetails.priceEach , products, orderdetails  .',orders.orderNumber=orderdetails.orderNumber,orderdetails.productCode=products.productCode';
	$contador=0;
	$sql ="select orderNumber,orderDate,status from orders where customerNumber=".$Aux_IDCliente;
	$resultado = mysqli_query($conn, $sql);
	/*"SELECT orders.orderNumber, orders.orderDate,orders.status,products.productName,orderdetails.quantityOrdered, orderdetails.priceEach 
			FROM orders,orderdetails,products 
			WHERE orders.customerNumber=".$Aux_IDCliente." and orders.orderNumber=orderdetails.orderNumber 
			and orderdetails.productCode=products.productCode and group by productCode";
			*/
	
if (mysqli_query($conn, $sql)) {
		
 if (mysqli_num_rows($resultado) > 0) {
		
		// output data of each row
		while($fila = mysqli_fetch_assoc($resultado)) {
		
			echo $fila["orderNumber"]." ".$fila["orderDate"]." ".$fila["status"]./*." ".$fila["productName"]." ".$fila["quantityOrdered"]." ".$fila["priceEach"].*/"<br>";
		}  
}

}else{
error(301,"No hay coincidencias con el id introducido");
			volver();
}
	
		/* cerrar la sentencia */
		//mysqli_stmt_close($sentencia);
}

/* cerrar la conexión */
mysqli_close($conn);
?>