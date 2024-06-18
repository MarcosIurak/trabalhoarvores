<?php
include __DIR__ . '/db.php';

if (isset($_GET['id'])) {
    $id_categoria = $_GET['id'];

   
    if (!$conn) {
        die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
    }

    
    $sql_delete_categoria = "DELETE FROM categorias WHERE id = $id_categoria";

    if (mysqli_query($conn, $sql_delete_categoria)) {
        header("Location: categorias.php"); 
        exit();
    } else {
        echo "Erro ao excluir categoria: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "ID da categoria não especificado para exclusão.";
}
?>
