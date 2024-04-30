<?php 
    namespace Core;

    class ConfigView {
        /**
         * Instancia a classe, reponsável em carregar a view;
         * @param string $nameView Endereço da view deve ser carregada;
         * @param array|string|null $data Dados que a view irá receber;
        */
        public function __construct(private string $nameView, array|string|null $data) {}

        /**
         * Confirma se o arquivo a ser procurado existe;
         * @return void
        */
        public function loadView() : void {
            if(file_exists('app/' . $this->nameView . '.php')) {
                include 'app/' . $this->nameView . '.php';
            } else {
                die("Erro - página não encontrada: Por favor tente novamente. Se o problema persistir, fale com o nosso administrador: " . EMAILADM);
            }
        }
    }
?>