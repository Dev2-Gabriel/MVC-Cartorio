<?php 
    namespace App\adms\Models\helper;

use PDO;
use PDOException;

    /**
     * Seleciona um registro do banco
     * Isso é um select genérico 
    */
    class HRead extends HConn {
        private string $select;
        private array $values = [];
        private array|null $result;
        private object $query;
        private object $conn;

        function getResult(): array|null {
            return $this->result;
        }

        /**
         * converte a string para um array
        */
        public function Exec_Read(string $table, string|null $terms = null, string|null $parseString = null):void{
            if (!empty($parseString)) {
                parse_str($parseString, $this->values);
            }

            $this->select = "SELECT * FROM {$table} {$terms}";
            $this->Exec_Comando();
        }

        /**
         * Leitura completa, do comando select
        */
        public function fullRead(string $query, string|null $parseString = null):void {
            $this->select = $query;
            if (!empty($parseString)) {
                parse_str($parseString, $this->values);
            }
            $this->Exec_Comando();
        }

        private function Exec_Comando(): void{
            $this->connection();
            try {
                $this->Exec_Parametros();
                $this->query->execute();
                $this->result = $this->query->fetchAll();
            } catch (PDOException $e) {
                $this->result = null;
            }
        }

        private function connection():void {
            $this->conn = $this->connectBD();
            $this->query = $this->conn->prepare($this->select);
            $this->query->setFetchMode(PDO::FETCH_ASSOC);
        }

        /**
         * Subistitui os links da QUERY pelos valores utilizados no bindValue;
         * 
         * @return void 
        */
        private function Exec_Parametros(){
            if ($this->values) {
                foreach($this->values as $link => $value) {
                    // O if abaixo é utilizado mais para paginação;
                    if (($link == 'limit') or ($link == 'offset') or ($link == 'id')) {
                       $value = (int) $value;
                    }

                    $this->query->bindValue(":{$link}", $value, (is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR));
                }
            }
        }
    }
?>