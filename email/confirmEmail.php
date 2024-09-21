<?php
    // Inclua o autoloader do Composer
    require '../vendor/autoload.php';
    require '../src/models/user.php';

    use App\Models\User;

    session_start();

    // Verifique se o token está presente na URL
    if (isset($_GET['token'])) {
        $token = $_GET['token'];
        $userModel = new User();
        echo $token;
        
        // Valide o token e atualize o e-mail do usuário
        if ($userModel->validateEmailWithToken($token)) {
            Header("location: ../identity/person.php");
        } else {
            echo "Token inválido ou expirado.";
        }
    } else {
        echo "Token não fornecido.";
    }
?>
