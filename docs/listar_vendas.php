<?php
include __DIR__ . '/db.php';

$sql = "SELECT vendas.id, clientes.nome AS cliente_nome,
               arvores.nome AS arvore_nome, arvores.especie, arvores.preco,
               categorias.nome AS categoria_nome
        FROM vendas
        INNER JOIN clientes ON vendas.cliente_id = clientes.id
        INNER JOIN arvores ON vendas.arvore_id = arvores.id
        INNER JOIN categorias ON arvores.categoria_id = categorias.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Vendas de Árvores</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Lista de Vendas de Árvores</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Árvore</th>
                    <th>Espécie</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['cliente_nome'] . "</td>";
                        echo "<td>" . $row['arvore_nome'] . "</td>";
                        echo "<td>" . $row['especie'] . "</td>";
                        echo "<td>R$ " . number_format($row['preco'], 2, ',', '.') . "</td>";
                        echo "<td>" . $row['categoria_nome'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhuma venda encontrada.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
