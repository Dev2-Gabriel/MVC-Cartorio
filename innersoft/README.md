Aqui está o código principa, que pode ou será utilizado no projeto;

ATENÇÃO: No arquivo o Config talvez seja nescessário colocar a senha, e o host onde o projeto está hospedado
No caso apenas substituir o localhost presente no arquivo, nele também talvez seja nescessário acrescentar a senha do banco de dados mysql para que ele funcione;

Local do arquivo: core\Config.php
Mude caso nescessário, as seguintes definições:
*define('PASS', ''); --> entre as aspas simples vaizias, informe a senha do banco; 

*define('URL', 'http://localhost/innersoft');
*define('URLADM', 'http://localhost/innersoft/');
Em ambas as urls, substitua o 'localhost' pela hospedagem do site.

ATENÇÃO pt2: Inicialize o projeto com o seguinte comando no seu terminal: composer update
Isso deve ser feito no terminal referente a pasta do seu projeto, exemplo: 
C:\Users\Você\Desktop\innersoft> composer update

6/05/2024
Foi adicionado no programa, a capacidade de inserir os dados vindos, do formulário de cadastro de usuários, no banco de dados.

Também foi criado na pasta assets um arquivo js que valida se os dados dos formulários, de login e do cadastro de usuários.

14/05/2024
Foi adicionado uma nova aba que é referente a comparação de email,
nela fazemos um pequeno comparativo com o email que será cadastrado como um novo usuário,
com um dos emails já cadastrados no banco de dados;

Foi colocado também, no arquivo js, uma verificação de senha com pelo menos 6 caracteres;