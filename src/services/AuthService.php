<?php
    namespace App\Services;

    require "../src/models/user.php";
    use App\Models\User;
    use PDOException;

    class AuthService {
        private $userModel;

        public function __construct() {
            $this->userModel = new User();
        }

        public function register($username, $email, $tel, $password) {
            if (!$this->userModel->getUserByEmail($email)) {
                $this->userModel->createUser($username, $email, $tel, $password);
                return true;
            } else {
                throw new \Exception("Este E-mail já foi Registrado!");
            }
        }

        public function login($email, $password) {
            $user = $this->userModel->getUserByEmail($email);
        
            if (!$user) {
                throw new \Exception("Usuário não Encontrado!");
            }
        
            if (!$this->userModel->verifyPassword($password, $user["password"])) {
                throw new \Exception("Senha Incorreta.");
            }
            // Iniciar sessão
            session_start();

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["email"] = $email; // Certifique-se de que o email está sendo definido
            $_SESSION["tel"] = $user["tel"];
            $_SESSION["isAdmin"] = $user["isAdmin"]; // Definindo is_admin
            $_SESSION["image_path"] = $user["image_path"];
            $_SESSION["tmp_email"] = $user["tmp_email"];
            $_SESSION["tmp_token"] = $user["tmp_token"];


        }
        
        public function logout() {
            session_start();
            session_destroy();
            session_unset(); // Limpar todas as variáveis de sessão
        }

        public function isLoggedIn() {
            return isset($_SESSION["user_id"]);
        }

    }
?>
