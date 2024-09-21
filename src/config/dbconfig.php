<?php
    namespace App\Config;

    use Dotenv\Dotenv;
    use PDO;
    use PDOException;

    class Database
    {
        private $host;
        private $db;
        private $user;
        private $pass;
        private $charset = 'utf8mb4';
        public $pdo;

        public function __construct()
        {
            // Carregar variáveis de ambiente do diretório raiz
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
            $dotenv->load();

            // Carregar variáveis do ambiente usando $_ENV
            $this->host = $_ENV['DB_HOST'];
            $this->db = $_ENV['DB_NAME'];
            $this->user = $_ENV['DB_USER'];
            $this->pass = $_ENV['DB_PASS'];

            // Depuração: Verificar se as variáveis de ambiente estão sendo carregadas corretamente
            // var_dump($_ENV['DB_HOST']);
            // var_dump($_ENV['DB_NAME']);
            // var_dump($_ENV['DB_USER']);
            // var_dump($_ENV['DB_PASS']); // Não exiba a senha por motivos de segurança

            $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";

            try {
                $this->pdo = new PDO($dsn, $this->user, $this->pass);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage());
            }
        }
    }
// ?>