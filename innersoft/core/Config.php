<?php 
    namespace Core;

    /**
     * Constantes de configurações;
     * Configurações de endereço de projeto;
    */
    abstract class Config {
        protected function configAdm(){
            define('URL', 'http://localhost/innersoft/');

            define('URLADM', 'http://localhost/innersoft/');

            define('CONTROLLER', 'Login');
            define('METODO', 'index');
            define('CONTROLLER_ERRO', 'Erro');

            define('EMAILADM', 'Teste_Email@gmail.com');

            /**
             * Abaixo são as variáveis de conexão com o banco de dados;
             * Caso nescessário mude para adaptar ao seu projeto; 
            */
            define('HOST', '10.8.0.8');
            define('DBNAME', 'dbcmc');
            define('USER', 'root');
            define('PASS', '');
            define('PORT', 3306);
        }
    }
?>