<?php

class Conexao
{
    private $pdo; 
    private $msgErro = "";

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
