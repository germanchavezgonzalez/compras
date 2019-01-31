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
$sql ="SELECT productName,quantityInStock FROM products order by quantityInStock desc;";
	$resultado = mysqli_query($conn, $sql);
	
	
	if (mysqli_query($conn, $sql)) {
		if (mysqli_num_rows($resultado) > 0) {
		echo "<table border='3'>";
			// output data of each row
			echo"<tr><th>Nombre Producto</th><th>Cantidad</th></tr>";
			while($fila = mysqli_fetch_assoc($resultado)) {
			echo "<tr>";
				echo "<td>".$fila['productName']."</td> <td> ".$fila['quantityInStock']."</td>";
				echo"</tr>";
			}  
		echo "</table>";			
	}
}

?>