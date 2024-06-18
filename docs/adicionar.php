<?php include __DIR__ . '/db.php'; ?>
<?php include __DIR__ . '/header.php'; ?>

<h2 class="mt-4">Adicionar Nova Árvore</h2>

<form action="adicionar.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
    </div>
    <div class="form-group">
        <label for="especie">Espécie</label>
        <input type="text" class="form-control" id="especie" name="especie" required>
    </div>
    <div class="form-group">
        <label for="preco">Preço</label>
        <input type="number" step="0.01" class="form-control" id="preco" name="preco" required>
    </div>
    <div class="form-group">
        <label for="categoria_id">Categoria</label>
        <select class="form-control" id="categoria_id" name="categoria_id" required>
            <option value="">Selecione a Categoria</option>
            <?php
            $sql = "SELECT * FROM categorias";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['nome']}</option>";
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Adicionar</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $especie = $_POST['especie'];
    $preco = $_POST['preco'];
    $categoria_id = $_POST['categoria_id'];
    

    $sql = "INSERT INTO arvores (nome, especie, preco, categoria_id) VALUES ('$nome', '$especie', '$preco', '$categoria_id')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success mt-4'>Árvore adicionada com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger mt-4'>Erro: " . $conn->error . "</div>";
    }
}
?>

<?php include __DIR__ . '/footer.php'; ?>
