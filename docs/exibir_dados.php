<?php
include __DIR__ . '/db.php';

$clientes_sql = "SELECT * FROM clientes";
$clientes_result = $conn->query($clientes_sql);

$vendas_sql = "SELECT vendas.id, clientes.nome AS cliente_nome, arvores.nome AS arvore_nome, vendas.quantidade, vendas.valor_total
               FROM vendas
               JOIN clientes ON vendas.cliente_id = clientes.id
               JOIN arvores ON vendas.arvore_id = arvores.id";
$vendas_result = $conn->query($vendas_sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Exibir Dados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <a class="navbar-brand" href="#">Loja de Árvores</a>
        <button class="navbar-toggler primary-color" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="adicionar_cliente.php">Cadastrar Cliente</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="adicionar_venda.php">Cadastrar Venda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="adicionar_categoria.php">Cadastrar Categoria</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categorias.php">Mostrar Categorias</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="exibir_dados.php">Exibir Dados</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Clientes</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($clientes_result->num_rows > 0) : ?>
                    <?php while ($row = $clientes_result->fetch_assoc()) : ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['nome'] ?></td>
                            <td><?= $row['email'] ?></td>
                            
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4">Nenhum cliente encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2>Vendas</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Árvore</th>
                    <th>Quantidade</th>
                    <th>Valor Total</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($vendas_result->num_rows > 0) : ?>
                    <?php while ($row = $vendas_result->fetch_assoc()) : ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['cliente_nome'] ?></td>
                            <td><?= $row['arvore_nome'] ?></td>
                            <td><?= $row['quantidade'] ?></td>
                            <td><?= $row['valor_total'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5">Nenhuma venda encontrada.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
