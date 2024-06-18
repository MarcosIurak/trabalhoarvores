<?php
include __DIR__ . '/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente_id = $_POST['cliente_id'];
    $arvore_id = $_POST['arvore_id'];
    $quantidade = $_POST['quantidade'];
    $valor_total = $_POST['valor_total'];

    $sql = "INSERT INTO vendas (cliente_id, arvore_id, quantidade, valor_total)
            VALUES ('$cliente_id', '$arvore_id', '$quantidade', '$valor_total')";

    if ($conn->query($sql) === TRUE) {
        echo "Venda registrada com sucesso.";
    } else {
        echo "Erro ao registrar a venda: " . $conn->error;
    }
}
?>
