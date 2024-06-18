<?php include __DIR__ . '/db.php'; ?>
<?php include __DIR__ . '/header.php'; ?>

<?php
$id = $_GET['id'];
$sql = "SELECT * FROM arvores WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<h2 class="mt-4">Editar Árvore</h2>

<form action="editar.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $row['nome']; ?>" required>
    </div>
    <div class="form-group">
        <label for="especie">Espécie</label>
        <input type="text" class="form-control" id="especie" name="especie" value="<?php echo $row['especie']; ?>" required>
    </div>
    <div class="form-group">
        <label for="preco">Preço</label>
        <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="<?php echo $row['preco']; ?>" required>
    </div>
    <div class="form-group">
        <label for="categoria_id">Categoria</label>
        <select class="form-control" id="categoria_id" name="categoria_id" required>
            <?php
            $sql = "SELECT * FROM categorias";
            $categorias = $conn->query($sql);
            while ($categoria = $categorias->fetch_assoc()) {
                $selected = $categoria['id'] == $row['categoria_id'] ? 'selected' : '';
                echo "<option value='{$categoria['id']}' $selected>{$categoria['nome']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="imagem">Imagem</label>
        <input type="file" class="form-control-file" id="imagem" name="imagem">
        <?php if ($row['imagem']): ?>
            <img src="<?php echo $row['imagem']; ?>" class="img-thumbnail mt-2" width="150" alt="<?php echo $row['nome']; ?>">
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-success">Atualizar</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $especie = $_POST['especie'];
    $preco = $_POST['preco'];
    $categoria_id = $_POST['categoria_id'];
    $imagem = $row['imagem'];

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $imagem_dir = 'uploads/';
        $imagem_path = $imagem_dir . basename($_FILES['imagem']['name']);
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem_path)) {
            $imagem = $imagem_path;
        }
    }

    $sql = "UPDATE arvores SET nome='$nome', especie='$especie', preco='$preco', categoria_id='$categoria_id', imagem='$imagem' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success mt-4'>Árvore atualizada com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger mt-4'>Erro: " . $conn->error . "</div>";
    }
}
?>

<?php include __DIR__ . '/footer.php'; ?>
