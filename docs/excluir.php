<?php
include __DIR__ . '/db.php';

if (isset($_GET['id'])) {
    $id_arvore = $_GET['id'];

    $sql_disable_fk_checks = "SET FOREIGN_KEY_CHECKS=0";
    mysqli_query($conn, $sql_disable_fk_checks);

    $sql_delete_arvore = "DELETE FROM arvores WHERE id = $id_arvore";
    if (mysqli_query($conn, $sql_delete_arvore)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao excluir árvore: " . mysqli_error($conn);
    }

    $sql_enable_fk_checks = "SET FOREIGN_KEY_CHECKS=1";
    mysqli_query($conn, $sql_enable_fk_checks);

    mysqli_close($conn);
} else {
    echo "ID da árvore não especificado para exclusão.";
}
?>
