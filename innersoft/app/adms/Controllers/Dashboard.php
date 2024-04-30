<?php 
    namespace App\adms\Controllers;

    /**
     * Controller da página Dashboard;
    */
    class Dashboard {
        /**
         * Recebe os dados que serão enviados para a view Dashboard;
         * @var array|string|null $data; 
        */
        private array|string|null $data;

        public function index() : void {
            $this->data = "<p style='color: green'>Bem Vindo!</p>";

            $loadView = new \Core\ConfigView("adms/Views/dashboard/dashboard", $this->data);
            $loadView->loadView();
        }
    }
?>