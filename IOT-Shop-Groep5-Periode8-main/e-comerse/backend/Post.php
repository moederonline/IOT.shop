<?php
require_once('../backend/dbconnect.php');
	
	class Post extends dbConfig{
		private $postBool;
		private $desBool;
		private $contentBool;
		
		public function deletePost($id){
			$sql = "DELETE FROM posts WHERE id = :id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->bindParam(":id", $id);
			if($stmt->execute()){
				header("Location: allposts.php");
			}
			else{
			}                                                                                                                                                                                                                                             
		}
		
		public function getAllPosts($page, $filter){
			if($page > 1){$page -= 1; $offset = $page * 10;} else{$offset = 0;} 
			$sql = "SELECT * FROM posts ORDER BY $filter LIMIT 10 OFFSET $offset";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
		
		public function updatePost($id, $title, $description, $content){
			try{
				$posts = $this->getPost($id);
				$sql = "UPDATE posts SET";
				if(!empty($title) && $posts->title !=$title){
					$this->postBool = true;
					$sql = $sql . " title= :title";
				}
				if($posts->description != $description){
					if($this->postBool){
						$sql = $sql . ","; 
					}
					$this->desBool = true;
					$sql = $sql . " description = :description";
				}
				if($posts->content != $content){
					if($this->desBool){
						$sql = $sql . ",";
					}
					$this->contentBool = true;
					$sql = $sql . " content = :content";
				}

				
				if($posts->content == $content && $posts->description == $description && $posts->title ==$title){
					return 'Gebruikersnaam en/of wachtwoord is hetzelfde';
				}
				$sql = $sql . " WHERE id = :id";
				$stmt = $this->connect()->prepare($sql);
				$stmt->bindParam("id", $id);
				if($this->postBool)
					$stmt->bindParam(":title", $title);
				if($this->desBool)
					$stmt->bindParam(":description", $description);
				if($this->contentBool)
					$stmt->bindParam(":content", $content);
				if($stmt->execute()){
					header("Location: allposts.php");
				}
				else{
					throw new Exception("Titel is niet ingevuld");
				}
				
			}
			
			catch(Exception $e){
				return $e->getMessage();
			}
		}
		
		public function getPost($id){
			$sql = "SELECT * FROM posts WHERE id = :id";
			$stmt = $this->connect()->prepare($sql);
			$stmt->bindParam(":id", $id);
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_OBJ);
		}




		public function addPost($title, $description, $content){
			try{
				
					$sql = "INSERT INTO posts (title, description, content) VALUES (:title, :description, :content)";
					$stmt = $this->connect()->prepare($sql);
					$stmt->bindParam(":title", $title);
					$stmt->bindParam(":description", $description);
					$stmt->bindParam(":content", $content);
					if($stmt->execute()){
						header("location: ../voorbeeld/allposts.php?page=1&filter=title");
					}else{
						throw new Exception("Er is iets misgegaan");
					}
				
			}catch(Exception $e){
				return $e->getMessage();
			}
		}

	}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin</title>
</head>

<body>
	
</body>
</html>