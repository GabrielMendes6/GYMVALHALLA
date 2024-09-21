<?php
    namespace App\Models;

    require "../vendor/autoload.php";
    require "../src/config/dbconfig.php";
    use App\Config\Database;
    use PDO;
    use PDOException;
    use PHPMailer\PHPMailer\PHPMailer;
    use Vonage\Client\Credentials\Basic as VonageCredentials;
    use Vonage\Client as VonageClient;
    use Vonage\SMS\Message\SMS;

    class User {
        private $pdo;
        private $vonageClient;

        public function __construct() {
            $db = new Database();
            $this->pdo = $db->pdo;

            $apiKey = '74932511';
            $apiSecret = 'ZY80ee1n0vxApO3B';
            $credentials = new VonageCredentials($apiKey, $apiSecret);
            $this->vonageClient = new VonageClient($credentials);
        }

        public function saveUserImage($user_id, $image_path) {
            try {
                $sql = 'UPDATE users SET image_path = :image_path WHERE id = :user_id';
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    'image_path' => $image_path,
                    'user_id' => $user_id
                ]);
            } catch (PDOException $e) {
                // Trate os erros de PDO aqui
                echo "Erro ao salvar caminho da imagem: " . $e->getMessage();
            }
        }

        public function updateUserName($username) {
            try {
                $sql = 'UPDATE users SET username = :username'; // Corrigido: removido o INTO e adicionado SET
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    "username" => $username,
                ]);
                $_SESSION["username"] = $username;
            } catch (PDOException $e) {
                // Trate os erros de PDO aqui
                echo "Erro ao atualizar usuário: " . $e->getMessage();
                return false;
            }
            return true;
        }

        public function storeEmailVerificationToken($user_id, $new_email, $token) {
            try {
                $sql = 'UPDATE users SET tmp_email = :newemail, tmp_token = :token WHERE id = :user_id';
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    "user_id" => $user_id,
                    "newemail" => $new_email,
                    "token" => $token,
                ]);
            } catch (PDOException $e) {
                echo "Erro ao armazenar o token de verificação: " . $e->getMessage();
            }
        }
    
        public function sendVerificationEmail($new_email, $token) {
            $to = $new_email;
            $subject = "Trocar seu Email GYMVALHALLA";
            $message = "<p style='font-size: 10pt;'> Olá, este é o ultimo passo para trocar o email de sua conta.</p> <br>";
            $message .= "<p style='font-size: 10pt;'>Clique no seguinte Link:</p>";
            $message .= "<a style='color: #7C0A0C' href='http://localhost/gymvalhalla/email/confirmEmail.php?token=" . $token . "'>Confirmar E-mail</a>";
            $message .= " <br> <p> Atenciosamente</p>";
            $message .= "<p style='font-size: 10pt;'> GYMVALHALLA</p> <br>";
            $message .= "<p style='font-size: 10pt;'>***</p>";
            $message .= "<p style='font-size: 10pt;'>Se você não criou uma conta em nosso site, favor desconsiderar este e-mail.</p>";

            
            // Configurações SMTP para Mailtrap
            $headers = "From: gymvalhalla@gmail.com\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
    
            // Configurações do PHPMailer
            
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'e2af335000460c'; // Substitua pelo seu usuário Mailtrap
            $mail->Password = 'bfe9b320cd1014'; // Substitua pela sua senha Mailtrap
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
    
            $mail->setFrom('gymvalhalla@gmail.com', 'GYMVALHALLA');
            $mail->addAddress($new_email);
    
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;
            
            if(!$mail->send()) {
                echo 'Erro ao enviar o e-mail de verificação: ' . $mail->ErrorInfo;
                return false;
            } else {
                return true;
            }
        }
    
        public function updateUserEmail($user_id, $newEmail) {
            try {
                $sql = 'UPDATE users SET email = :newEmail, tmp_email = NULL, tmp_token = NULL WHERE id = :user_id';
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    "newEmail" => $newEmail,
                    "user_id" => $user_id,
                ]);
                $_SESSION["email"] = $newEmail;
            } catch (PDOException $e) {
                // Trate os erros de PDO aqui
                echo "Erro ao atualizar e-mail: " . $e->getMessage();
                return false;
            }
            return true;
        }
    
        public function validateEmailWithToken($token) {
            try {
                $sql = 'SELECT id, tmp_email FROM users WHERE tmp_token = :token';
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(['token' => $token]);
                $user = $stmt->fetch();
    
                if ($user) {
                    $this->updateUserEmail($user['id'], $user['tmp_email']);
                    return true;
                }
            } catch (PDOException $e) {
                echo "Erro ao validar o token: " . $e->getMessage();
            }
            return false;
        }

        public function storeTelVerificationCod($user_id, $newTel, $cod) {
            try {
                $sql = "UPDATE users SET tmp_tel = :newtel, tmp_cod = :cod WHERE id = :user_id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    "user_id" => $user_id,
                    "newtel" => $newTel,
                    "cod" => $cod,
                ]);
            } catch (PDOException $e) {

            }
        }

        public function updateUserTel($user_id, $newTel) {
            try {
                $sql = 'UPDATE users SET tel = :newTel, tmp_tel = NULL, tmp_cod = NULL WHERE id = :user_id';
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    "newTel" => $newTel,
                    "user_id" => $user_id,
                ]);
                $_SESSION["tel"] = $newTel;

            } catch (PDOException $e) {
                // Trate os erros de PDO aqui
                echo "Erro ao atualizar e-mail: " . $e->getMessage();
                return false;
            }
            return true;
        }

        public function validateTelWithCod($cod) {
            try {
                $sql = "SELECT id, tmp_tel FROM users WHERE tmp_cod = :cod";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(["cod" => $cod]);
                $user = $stmt->fetch();
                print_r($user);
                
                if ($user) {
                    $this->updateUserTel($user["id"], $user["tmp_tel"]);
                    return true;
                }
            } catch (PDOException $e) {
                echo "Erro ao validar usuário: " . $e->getMessage();
                
                return false;
            }
        }

        public function sendVerificationTel($phone, $verificationCode) {
            $message = "Seu Codigo de Verificação GYMVALHALLA é: $verificationCode";

            try {
                $sms = new SMS($phone, 'GYMVALHALLA', $message);
                $response = $this->vonageClient->sms()->send($sms);
    

                if($response->current()->getStatus() == 0) {
                    return true;
                } else {
                    echo "erro ao enviar SMS" . $response->current()->getStatus();
                    return false;
                }
            } catch (PDOException $e) {
                echo "erro ao enviar SMS: " . $e->getMessage();
                return false;
            }
        }

        public function createUser($username, $email, $tel, $password) {
            try {
                $sql = 'INSERT INTO users (username, email, tel, password) VALUES (:username, :email, :tel, :password)';
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    "username" => $username,
                    "email" => $email,
                    "tel" => $tel,
                    "password" => password_hash($password, PASSWORD_BCRYPT)
                ]);

            } catch (PDOException $e) {
                // Trate os erros de PDO aqui
                echo "Erro ao criar usuário: " . $e->getMessage();
                return false;
            }
            return true;
        }

        public function getUserByEmail($email) {
            try {
                $sql = 'SELECT * FROM users WHERE email = :email';
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute(['email' => $email]);
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Trate os erros de PDO aqui
                echo "Erro ao buscar usuário por email: " . $e->getMessage();
                return null;
            }
        }

        public function verifyPassword($password, $hashedPassword) {
            return password_verify($password, $hashedPassword);
        }
    }
?>
