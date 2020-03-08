<?php

class Conexao
{
    private $pdo; 
    private $msgErro = "";

    // const MYSQL_DSN = 'mysql:host=localhost;dbname=estagio';
    // const MYSQL_USER = 'root';
    // const MYSQL_PASSWORD = '';

    function __construct()
    {
        try 
        {
            define('MYSQL_DSN', 'mysql:host=localhost;dbname=teste');
            define('MYSQL_USER', 'root');
            define('MYSQL_PASSWORD', '');
            
            $this->pdo = new PDO(MYSQL_DSN,MYSQL_USER,MYSQL_PASSWORD);
        }	
        catch (PDOExecption $e) 
        {
            $this->msgErro = $e->getMessage();
        } 
    }

    function get_conn()
    {
        return $this->pdo;
    }
}
?>
