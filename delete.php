<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Registros";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$idProd = $_GET['id'];
$sql = "DELETE FROM Productos WHERE idProducto='$idProducto'";

if ($conn->query($sql) === TRUE) {
    echo "Producto eliminado correctamente";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
