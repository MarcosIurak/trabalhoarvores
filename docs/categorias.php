<?php include __DIR__ . '/db.php'; ?>
<?php include __DIR__ . '/header.php'; ?>

<h2 class="mt-4">Categorias</h2>
<a href="adicionar_categoria.php" class="btn btn-success mb-4">Adicionar Nova Categoria</a>

<?php
$sql = "SELECT * FROM categorias";
$result = $conn->query($sql);
?>

<div class="row">
    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nome']; ?></td>
                        <td>
                            <a href="editar_categoria.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="excluir_categoria.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="col-12">Nenhuma categoria encontrada</p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/footer.php'; ?>
