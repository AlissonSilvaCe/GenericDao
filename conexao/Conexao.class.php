<?php
 date_default_timezone_set('America/Fortaleza');
 //ela herdarÃ¡ os mÃ©todos e atributos do PDO atravÃ©s da palavra-chave extends
 class Conexao extends PDO{

  private $dsn = 'pgsql:host=localhost;dbname=pda;port=5432';
  private $user = 'postgres';
  private $password = '';

 	//variÃ¡vel para manter objeto de conexÃ£o
 	protected static $conn;
 
 	//private construct - classe nÃ£o pode ser instaciada externamente.
 	private function __construct(){
 
 		try {
 
 			//Atribui PDO object a variÃ¡vel $conn
 			self::$conn = new PDO($this->dsn, $this->user,$this->password);
 			self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
 		}catch(PDOException $e){
 
 			echo "Erro de Conexao: ".$e->getMessage();
 
 		}
 	}
 
 	//Obtem a funÃ§Ã£o de conexÃ£o.
 	//MÃ©todo estÃ¡tico - acessÃ­veis sem instanciaÃ§Ã£o
 	 static function getConnection(){
 
 		//Garante Ãºnica instÃ¢ncia , se nenhum objeto de conexÃ£o existe , entÃ£o, criar um.
 		if (!self::$conn) {
 
 			self:: $conn = new Conexao();
 			
 		}
 
 		//return connection.
 		return self::$conn;
 	}
 }

?>
