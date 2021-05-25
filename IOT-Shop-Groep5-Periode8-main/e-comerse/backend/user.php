<?php
require_once('dbconnect.php');
class User extends dbConfig{
	
		private $usernameBool;
		private $passwordBool;
		
		public function deleteUser($id){
			$sql = "DELETE FROM user WHERE id = :id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->bindParam(":id", $id);
			if($stmt->execute()){
				header("Location: contentuser.php");
			}
			else{
				header("Location: user.php?id=$id");
			}
		}
		
		public function getAllUsers(){
			$sql = "SELECT * FROM user";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		
		public function updateUser($id, $username, $password){
			try{
				$user = $this->getUser($id);
				$sql = "UPDATE user SET";
				if(!empty($username) && $user->username !=$username){
					$this->usernameBool = true;
					$sql = $sql . " username= :username";
				}
				if(!empty($password) && $user ->password != $password){
					$options = ['cost' => 12];
					$passwordCrypt = password_hash($password, PASSWORD_BCRYPT, $options);
					if($this->usernameBool){
						$sql = $sql . " ,";
					}
					$this->passwordBool = true;
					$sql = $sql . " password = :password";
				}
				if($user->username == $username && $user ->password == $password){
					return 'Gebruikersnaam en/of wachtwoord is hetzelfde';
				}
				$sql = $sql . " WHERE id = :id";
				$stmt = $this->connect()->prepare($sql);
				$stmt->bindParam("id", $id);
				if($this->usernameBool)
					$stmt->bindParam(":username", $username);
				if($this->passwordBool)
					$stmt->bindParam(":password", $passwordCrypt);
				if($stmt->execute()){
					header("Location: contentuser.php");
				}
				else{
					throw new Exception("Éen of meer waarder zijn niet correct");
				}
				
			}
			
			catch(Exception $e){
				return $e->getMessage();
			}
		}
		
		public function getUser($id){
			$sql = "SELECT * FROM user WHERE id = :id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->bindParam(":id", $id);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
		}
	
	public function login($username, $password){
		try{
			$sql = "SELECT * FROM user WHERE username = :uname";
			$stmt = $this->connect()->prepare($sql);
			$stmt->bindParam(':uname', $username);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			
			if($result && password_verify($password, $result->password)){
				session_start();
				$_SESSION['login'] = true;
				$_SESSION['username'] = $username;
				$_SESSION['user_id'] = $result->id;
				$conn=null;
				header("location: admin.php");
			}else{
				$conn=null;
				throw new Exception("Combinatie van username en wachtwoord is incorrect");
			}
		}
		catch( Exception $e){
			echo $e->getMessage();
		}
		
	}
	
	public function register($username, $password, $passwordConf){
		try{
			if($password == $passwordConf){
				$options = ['cost' => 12];
				$passwordCrypt = password_hash($password, PASSWORD_BCRYPT, $options);
				
				$sql = "INSERT INTO user (username, password) VALUES (:uname, :pass)";
				$stmt = $this->connect()->prepare($sql);
				$stmt->bindParam(":uname", $username);
				$stmt->bindParam(":pass", $passwordCrypt);
				if($stmt->execute()){
					header("location: login.php");
				}else{
					throw new Exception("Er is iets mis met je account");
				}
			}else{
				throw new Exception("wachtwoorden komnen niet overeen");
			}
		}catch(Exception $e){
			return $e->getMessage();
		}
	}
	
	
	
	
}
?>