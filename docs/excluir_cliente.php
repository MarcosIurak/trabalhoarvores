<?php
include __DIR__ . '/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID inválido.";
    exit;
}

$id = $_GET['id'];

$id = mysqli_real_escape_string($conn, $id);

$sql = "DELETE FROM clientes WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: clientes.php");
    exit;
} else {
    echo "Erro ao excluir: " . $conn->error;
}

$conn->close();
?>
