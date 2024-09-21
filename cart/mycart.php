// Pasta onde o arquivo será salvo
$dir = "../uploads/";
$filename = basename($_FILES["file"]["name"]);
$path = $dir . $filename;
$filetype = strtolower(pathinfo($path, PATHINFO_EXTENSION));

// Permitir apenas certos formatos de arquivo (JPG e PNG)
$allowedTypes = array('jpg', 'jpeg', 'png');
if (!in_array($filetype, $allowedTypes)) {
    echo "Desculpe, apenas arquivos JPG, JPEG e PNG são permitidos.";
    exit();
}

// Verificar se é uma imagem real
$check = getimagesize($_FILES["file"]["tmp_name"]);
if ($check === false) {
    echo "O arquivo não é uma imagem.";
    exit();
}

// Verificar se o arquivo já existe
if (file_exists($path)) {
    echo "Desculpe, o arquivo já existe.";
    exit();
}

// Verificar o tamanho do arquivo (limite de 5MB)
if ($_FILES["file"]["size"] > 5 * 1024 * 1024) {
    echo "Desculpe, seu arquivo é muito grande (limite de 5MB).";
    exit();
}

// Mover arquivo para o diretório de upload
if (move_uploaded_file($_FILES["file"]["tmp_name"], $path)) {
    // Salvar o caminho do arquivo no banco de dados
    $user_id = $_SESSION['user_id'];
    $userModel->saveUserImage($user_id, $path); // Método para salvar caminho da imagem no banco de dados

    echo "O arquivo " . htmlspecialchars($fileName) . " foi enviado com sucesso.";
} else {
    echo "Desculpe, houve um erro ao enviar seu arquivo.";
}
