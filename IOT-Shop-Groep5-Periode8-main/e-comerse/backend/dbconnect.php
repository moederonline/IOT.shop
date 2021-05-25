<?php
class dbConfig{
	protected $conn;
	public function connect(){
		try{
			$conn = new PDO("mysql: host=localhost;dbname=blogsite","root","");
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conn;
		}
		catch(PDOException $e){
			echo 'Connection failed '. $e->getMessage();
		}
	}
}
?>
