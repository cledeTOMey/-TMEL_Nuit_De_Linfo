<?php  

$host = "localhost";
$login = "postgres";
$dbType = "pgsql"; // Choisir ici pgsql ou mysql

if($dbType == "pgsql")
{
			// PGSQL

	$dbnamepg = "chatbot";
	$port = "5432";
	$passwdpg = "";

	$db = new PDO("pgsql:host=".$host.";dbname=".$dbnamepg.";port=".$port, $login, $passwdpg);
	$db->query("SET search_path TO chatbot;");
}
else if($dbType == "mysql")
{
	// MYSQL

	$dbnamemy = "chatbot";
	$passwdmy = "";

	$db = new PDO("mysql:dbname=".$dbnamemy, $login, $passwdmy);

}
		
function db()
{
	global $db;
	return $db;
}


?>