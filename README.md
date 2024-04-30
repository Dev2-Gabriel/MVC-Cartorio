Aqui está o código principa, que pode ou será utilizado no projeto;

ATENÇÃO: No arquivo o Config talvez seja nescessário colocar a senha, e o host onde o projeto está hospedado No caso apenas substituir o localhost presente no arquivo, nele também talvez seja nescessário acrescentar a senha do banco de dados mysql para que ele funcione;

Local do arquivo: core\Config.php Mude caso nescessário, as seguintes definições: *define('PASS', ''); --> entre as aspas simples vaizias, informe a senha do banco;

*define('URL', 'http://localhost/innersoft'); *define('URLADM', 'http://localhost/innersoft/'); Em ambas as urls, substitua o 'localhost' pela hospedagem do site.

ATENÇÃO pt2: Inicialize o projeto com o seguinte comando no seu terminal: composer update Isso deve ser feito no terminal referente a pasta do seu projeto, exemplo: C:\Users\Você\Desktop\innersoft> composer update
