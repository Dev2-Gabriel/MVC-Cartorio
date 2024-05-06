<?php 
    namespace App\adms\Models\helper;

    class MvalorCampoVazio {
        private array|null $data;
        private bool $result;

        function getResult() {
            return $this->result;
        }

        // aqui verifica se os campos estão preenchidos
        public function validaCampo(array $data = null) {
            $this->data = $data;

            $this->data = array_map('strip_tags', $this->data);

            $this->data = array_merge('trim', $this->data);

            if(in_array('', $this->data)){
                $_SESSION['msg'] = "<p style='color: #f00'>Erro: Nescessário preencher todos os campos!</p> ";
                $this->result = false;
            } else {
                $this->result = true;
            }
        }
    }
?>