<?php
include __DIR__ . '/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];

    $id = mysqli_real_escape_string($conn, $id);
    $nome = mysqli_real_escape_string($conn, $nome);

    $sql = "UPDATE categorias SET nome='$nome' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: categorias.php");
        exit;
    } else {
        echo "Erro ao atualizar categoria: " . $conn->error;
    }
}

$conn->close();
?>
