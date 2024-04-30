<?php 
    namespace App\adms\Controllers;

    /**
     *Controller da página de erro 
    */
    class Erro {
        /**
         * Recebe os dados que serão enviados para a view de erros;
         * @var array|string|null $data;
        */
        private array|string|null $data;

        public function index() {
            echo "Página de erro<br>";

            $this->data = "<p style='color: #f00'>Página não encontrada!</p>";

            $loadView = new \Core\ConfigView("adms/Views/erro/erro", $this->data);
            $loadView->loadView();
        }
    }
?>