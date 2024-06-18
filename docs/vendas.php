<?php
include_once('db.php');

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

$sql = "SELECT * FROM vendas";

$result = $conn->query($sql);
if (!$result) {
    die("Erro ao consultar vendas: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Vendas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1>Lista de Vendas</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente ID</th>
                <th>Árvore ID</th>
                <th>Quantidade</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['cliente_id'] . "</td>";
                echo "<td>" . $row['arvore_id'] . "</td>";
                echo "<td>" . $row['quantidade'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
$conn->close();
?>
