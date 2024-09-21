<?php
    namespace App\Utils;

    class CSRF
    {
        public static function generateToken()
        {
            if (empty($_SESSION['csrf_token'])) {
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            }
            return $_SESSION['csrf_token'];
        }

        public static function validateToken($token)
        {
            return hash_equals($_SESSION['csrf_token'], $token);
        }
    }
?>
