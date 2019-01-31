<?php
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "pedidos";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 
$Aux_fechaInicio=$_POST['fechDesde'];
$Aux_fechaHasta=$_POST['fechHasta'];
$sql ="SELECT productCode,quantityOrdered,orderDate FROM orders,orderdetails 
WHERE  orderdetails.orderNumber=orders.orderNumber and CAST(orderDate AS DATE) between '".$Aux_fechaInicio."' AND '".$Aux_fechaHasta."'";
	$resultado = mysqli_query($conn, $sql);
	
	
	if (mysqli_query($conn, $sql)) {
		if (mysqli_num_rows($resultado) > 0) {
		echo "<table border='3'>";
			// output data of each row
			echo"<tr><th>Nombre Producto</th><th>Cantidad</th><th>Fecha</th>";
			while($fila = mysqli_fetch_assoc($resultado)) {
			echo "<tr>";
				echo "<td>".$fila['productCode']."</td> <td> ".$fila['quantityOrdered']."</td> <td> ".$fila['orderDate']."</td>";
				echo"</tr>";
			}  
		echo "</table>";			
	}
}

?>


	

