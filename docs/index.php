<?php include __DIR__ . '/db.php'; ?>
<?php include __DIR__ . '/header.php'; ?>

<h2 class="mt-4">Catálogo de Árvores</h2>
<a href="adicionar.php" class="btn btn-success mb-4">Adicionar Nova Árvore</a>

<?php
$sql = "SELECT arvores.*, categorias.nome AS categoria_nome FROM arvores LEFT JOIN categorias ON arvores.categoria_id = categorias.id";
$result = $conn->query($sql);
?>

<div class="row">
    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="<?php echo $row['imagem']; ?>" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="#"><?php echo $row['nome']; ?></a>
                        </h4>
                        <h5>R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?></h5>
                        <p class="card-text"><?php echo $row['especie']; ?></p>
                    </div>
                    <div class="card-footer">
                        <a href="editar.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="excluir.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Excluir</a>
                        <a href="adicionar_venda.php?arvore_id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm float-right">Vender</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="col-12">Nenhuma árvore encontrada</p>
    <?php endif; ?>
</div>

<h2 class="mt-4">Vendas Realizadas</h2>
<?php
$sql = "SELECT vendas.*, clientes.nome AS cliente_nome, arvores.nome AS arvore_nome 
        FROM vendas 
        JOIN clientes ON vendas.cliente_id = clientes.id
        JOIN arvores ON vendas.arvore_id = arvores.id";
$result = $conn->query($sql);
?>

<?php if ($result->num_rows > 0): ?>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Árvore</th>
                <th>Quantidade</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['cliente_nome']; ?></td>
                    <td><?php echo $row['arvore_nome']; ?></td>
                    <td><?php echo $row['quantidade']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="col-12">Nenhuma venda realizada ainda</p>
<?php endif; ?>

<?php include __DIR__ . '/footer.php'; ?>
