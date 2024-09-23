<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = ""; // Coloque sua senha do MySQL aqui, ou deixe vazia se não houver senha.
$dbname = "escola";

// Tenta a conexão com o banco de dados
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
} catch (mysqli_sql_exception $e) {
    die("Erro de conexão: " . $e->getMessage());
}

// Funções para CRUD de Professores
if (isset($_POST['create_professor'])) {
    $nome = $_POST['nome'];
    $sql = "INSERT INTO Professores (Nome) VALUES ('$nome')";
    if ($conn->query($sql) === TRUE) {
        echo "Professor adicionado com sucesso!<br>";
    } else {
        echo "Erro: " . $conn->error . "<br>";
    }
}

if (isset($_POST['update_professor'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $sql = "UPDATE Professores SET Nome='$nome' WHERE ID=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Professor atualizado com sucesso!<br>";
    } else {
        echo "Erro: " . $conn->error . "<br>";
    }
}

if (isset($_GET['delete_professor'])) {
    $id = $_GET['delete_professor'];
    $sql = "DELETE FROM Professores WHERE ID=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Professor deletado com sucesso!<br>";
    } else {
        echo "Erro: " . $conn->error . "<br>";
    }
}

// Funções para CRUD de Aulas
if (isset($_POST['create_aula'])) {
    $sala = $_POST['sala'];
    $sql = "INSERT INTO Aulas (Sala) VALUES ('$sala')";
    if ($conn->query($sql) === TRUE) {
        echo "Aula adicionada com sucesso!<br>";
    } else {
        echo "Erro: " . $conn->error . "<br>";
    }
}

if (isset($_POST['update_aula'])) {
    $id = $_POST['id'];
    $sala = $_POST['sala'];
    $sql = "UPDATE Aulas SET Sala='$sala' WHERE ID=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Aula atualizada com sucesso!<br>";
    } else {
        echo "Erro: " . $conn->error . "<br>";
    }
}

if (isset($_GET['delete_aula'])) {
    $id = $_GET['delete_aula'];
    $sql = "DELETE FROM Aulas WHERE ID=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Aula deletada com sucesso!<br>";
    } else {
        echo "Erro: " . $conn->error . "<br>";
    }
}

// Funções para CRUD de Diário
if (isset($_POST['create_diario'])) {
    $id_professor = $_POST['id_professor'];
    $id_aula = $_POST['id_aula'];
    $hora_aula = $_POST['hora_aula'];
    $sql = "INSERT INTO Diario (ID_Professor, ID_Aula, HoraAula) VALUES ('$id_professor', '$id_aula', '$hora_aula')";
    if ($conn->query($sql) === TRUE) {
        echo "Diário adicionado com sucesso!<br>";
    } else {
        echo "Erro: " . $conn->error . "<br>";
    }
}

if (isset($_POST['update_diario'])) {
    $id = $_POST['id'];
    $id_professor = $_POST['id_professor'];
    $id_aula = $_POST['id_aula'];
    $hora_aula = $_POST['hora_aula'];
    $sql = "UPDATE Diario SET ID_Professor='$id_professor', ID_Aula='$id_aula', HoraAula='$hora_aula' WHERE ID=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Diário atualizado com sucesso!<br>";
    } else {
        echo "Erro: " . $conn->error . "<br>";
    }
}

if (isset($_GET['delete_diario'])) {
    $id = $_GET['delete_diario'];
    $sql = "DELETE FROM Diario WHERE ID=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Diário deletado com sucesso!<br>";
    } else {
        echo "Erro: " . $conn->error . "<br>";
    }
}

// Exibição dos dados
function exibir_professores($conn) {
    $sql = "SELECT * FROM Professores";
    $result = $conn->query($sql);
    echo "<h2>Professores:</h2>";
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row['ID'] . " - Nome: " . $row['Nome'];
        echo " <a href='?delete_professor=" . $row['ID'] . "'>Deletar</a><br>";
    }
}

function exibir_aulas($conn) {
    $sql = "SELECT * FROM Aulas";
    $result = $conn->query($sql);
    echo "<h2>Aulas:</h2>";
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row['ID'] . " - Sala: " . $row['Sala'];
        echo " <a href='?delete_aula=" . $row['ID'] . "'>Deletar</a><br>";
    }
}

function exibir_diarios($conn) {
    $sql = "SELECT * FROM Diario";
    $result = $conn->query($sql);
    echo "<h2>Diários:</h2>";
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row['ID'] . " - ID Professor: " . $row['ID_Professor'] . " - ID Aula: " . $row['ID_Aula'] . " - Hora: " . $row['HoraAula'];
        echo " <a href='?delete_diario=" . $row['ID'] . "'>Deletar</a><br>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Professores, Aulas e Diário</title>
</head>
<body>

<h1>CRUD - Professores, Aulas e Diário</h1>

<!-- Formulário para Adicionar Professor -->
<h2>Adicionar Professor</h2>
<form method="POST" action="">
    Nome: <input type="text" name="nome">
    <button type="submit" name="create_professor">Adicionar</button>
</form>

<!-- Formulário para Adicionar Aula -->
<h2>Adicionar Aula</h2>
<form method="POST" action="">
    Sala: <input type="text" name="sala">
    <button type="submit" name="create_aula">Adicionar</button>
</form>

<!-- Formulário para Adicionar Diário -->
<h2>Adicionar Diário</h2>
<form method="POST" action="">
    ID Professor: <input type="number" name="id_professor">
    ID Aula: <input type="number" name="id_aula">
    Hora da Aula: <input type="time" name="hora_aula">
    <button type="submit" name="create_diario">Adicionar</button>
</form>

<!-- Exibir Dados -->
<?php
exibir_professores($conn);
exibir_aulas($conn);
exibir_diarios($conn);
?>

</body>
</html>

<?php
$conn->close();
?>