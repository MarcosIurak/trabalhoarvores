<?php include __DIR__ . '/db.php'; ?>
<?php include __DIR__ . '/includes/header.php'; ?>

<?php
$id = $_GET['id'];
$sql = "SELECT * FROM clientes WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<h2 class="mt-4">Editar Cliente</h2>

<form action="editar_cliente.php?id=<?php echo $id; ?>" method="POST">
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $row['nome']; ?>" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
    </div>
    <div class="form-group">
        <label for="telefone">Telefone</label>
        <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $row['telefone']; ?>" required>
    </div>
    <button type="submit" class="btn btn-success">Atualizar</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $sql = "UPDATE clientes SET nome='$nome', email='$email', telefone='$telefone' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success mt-4'>Cliente atualizado com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger mt-4'>Erro: " . $conn->error . "</div>";
    }
}
?>

<?php include __DIR__ . '/footer.php'; ?>
