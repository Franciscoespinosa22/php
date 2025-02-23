<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Registros";

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

// Recibir los datos desde la petición AJAX
$data = json_decode(file_get_contents("php://input"), true);

$idProducto = $data['idProducto'];
$Nombre     = $data['Nombre'];
$Precio     = $data['Precio'];
$Existencia = $data['Existencia'];

// Validar que los datos no estén vacíos
if (empty($idProducto) || empty($Nombre) || empty($Precio) || empty($Existencia)) {
    die("❌ Error: Todos los campos son obligatorios.");
}

// Usamos prepared statements y los tipos correctos ("ssdi": string, string, double, integer)
$stmt = $conn->prepare("INSERT INTO Productos (idProducto, Nombre, Precio, Existencia) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssdi", $idProducto, $Nombre, $Precio, $Existencia);

if ($stmt->execute()) {
    echo "✅ Producto registrado correctamente";
} else {
    echo "❌ Error al insertar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
