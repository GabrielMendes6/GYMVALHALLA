<?php
    namespace App\Controllers;

    require("../src/services/AuthService.php");
    require_once("../src/utils/CSRF.php");

    use App\Services\AuthService;
    use App\Utils\CSRF;

    class UserController {
        private $authService;

        public function __construct() {
            $this->authService = new AuthService();
        }

        public function register() {
            // Verifica se a sessão já está iniciada
            if (session_status() == PHP_SESSION_NONE) {
                session_start(); // Inicia a sessão se não estiver iniciada
            }

            // Gera um novo token CSRF se não existir um na sessão
            $csrfToken = CSRF::generateToken();

            // Verifica se é uma requisição POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Verifica se o token CSRF foi enviado no formulário
                if (!isset($_POST['csrf_token'])) {
                    throw new \Exception('CSRF token missing.');
                }

                // Obtém o token CSRF enviado no formulário
                $userToken = $_POST['csrf_token'];

                // Valida o token CSRF
                if (!CSRF::validateToken($userToken)) {
                    throw new \Exception('Invalid CSRF token.');
                }

                // Se o token CSRF for válido, continua com o registro do usuário
                $username = $_POST["name"];
                $email = $_POST["email"];
                $tel = $_POST["tel"];
                $password = $_POST["pass"];

                try {
                    $this->authService->register($username, $email, $tel, $password);
                    header('Location: ../login/login.php');
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
            }
        }

        public function login($email, $password) {
            try {
                $this->authService->login($email, $password);
                header("Location: ../home/home.php");
            } catch (\Exception $e){
                echo $e->getMessage();
            }
        }
    }
    
?>
