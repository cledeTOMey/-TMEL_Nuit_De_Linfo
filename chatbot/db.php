<?php  

class DB{
	private static $connection = null;
	public static function getInstance(){
		if(self::$connection == null){
            self::$connection = new PDO("pgsql:host=localhost;port=5432;dbname=chatbot","postgres","");
            $searchpath = self::$connection->exec('SET search_path TO chatbot');
		}
		return self::$connection;
	}
}


?>