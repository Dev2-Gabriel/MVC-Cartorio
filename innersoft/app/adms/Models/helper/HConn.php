<?php 
    namespace App\adms\Models\helper;

    use PDO;
    use PDOException;

    /**
     * Os atributos abixo são para conexão do BD, seja realizada;
     * 
     * Caso seja nescessario mudar alguma variável, mude especificamente no arquivo Config.php, na pasta Core;
     * Core/Config.php
    */
    abstract class HConn{
        private string $host = HOST;
        private string $user = USER;
        private string $pass = PASS;
        private string $dbname = DBNAME;
        private int|string $port = PORT;

        // A variavél abaixo recebe a conexão com o BD;
        private object $connect;

        protected function connectBD() : object {
            try {
                // Conexão o projeto com o banco de dados;
                $this->connect = new PDO("mysql:host={$this->host};port={$this->port};dbname=" . $this->dbname, $this->user, $this->pass);

                return $this->connect;
            } catch (PDOException $err) {
                die("Erro - conexão: Por favor tente novamente. Caso o problema persista, entre em contato com o administrador: " . EMAILADM);
            }
        }
    }
?>