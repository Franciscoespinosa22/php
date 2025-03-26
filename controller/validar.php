<?php
// Incluye la conexión a la base de datos
include '../conexion.php'; // Ajusta la ruta si es necesario

// Conecta a la base de datos
$conn = conectaDB();

// Obtiene los datos del formulario de login enviados por AJAX
$username = $_POST['loginUsername'];
$password = $_POST['loginPassword'];

// Consulta para obtener el hash de la contraseña del usuario
$query = "SELECT idUser, Passwd FROM tb_usuarios WHERE NomUser = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Si el usuario existe, obtiene el hash de la contraseña
    $row = $result->fetch_assoc();
    $hashedPassword = $row['Passwd'];

    // Verifica si la contraseña ingresada coincide con el hash almacenado
    if (password_verify($password, $hashedPassword)) {
        // Si la contraseña es correcta, responde con éxito
        echo json_encode(['success' => '1']);
    } else {
        // Si la contraseña es incorrecta
        echo json_encode(['success' => '0']);
    }
} else {
    // Si el usuario no existe
    echo json_encode(['success' => '0']);
}

$stmt->close();
$conn->close();
?>
