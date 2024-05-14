<?php 
    namespace App\adms\Models\helper;

    use PDOException;

    class HCreate extends HConn {
        private string $table;
        private array $data;
        private string|null $result;
        private object $insert;
        private string $query;
        private object $conn;

        function getResult():string {
            return $this->result;
        }

        public function Exec_Create(string $table, array $data):void {
            // recebe o nome da tabela;
            $this->table = $table;

            // recebe os valores do formulário pra um novo usuário;
            $this->data = $data;

            $this->Exec_ReplaceValores();
        }

        // prepara os valores para serem colocados no banco
        private function Exec_ReplaceValores() {
            // coloca o nome das colunas corretamente;
            $colunas = implode(', ', array_keys($this->data));

            // separa os valores corretamente a serem inseridos na tabela usando o bindParam
            $values = ':' . implode(', :', array_keys($this->data));

            $this->query = "INSERT INTO {$this->table} ($colunas) VALUES ($values)";
            $this->Exec_Comando();
        }

        //Executa o comando de insert na tabela do banco
        private function Exec_Comando(){
            $this->connection();
            try {
                $this->insert->execute($this->data);
                $this->result = $this->conn->lastInsertId();
            } catch (PDOException $e) {
                $this->result = null;
            }
        }

        // realiza a conexão com o banco e executa o query
        private function connection():void {
            $this->conn = $this->connectBD();
            $this->insert = $this->conn->prepare($this->query);
        }
    }
?>