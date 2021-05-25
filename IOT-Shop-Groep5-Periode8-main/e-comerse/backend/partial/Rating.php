<?php
require_once('../backend/dbconnect.php');
	
	class Rating extends dbConfig{
		
		
		public function getAllRatings($id){
			$sql = "SELECT * FROM comments WHERE post_id = :id ORDER BY created_on DESC";
			$stmt = $this->connect()->prepare($sql);
            $stmt->bindParam(":id", $id);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}




		public function ratePost($name, $message, $post_id){
			try{
				
					$sql = "INSERT INTO comments (name, message, post_id) VALUES
                     (:name, :message, :post_id)";
					$stmt = $this->connect()->prepare($sql);
					$stmt->bindParam(":post_id", $post_id);
					$stmt->bindParam(":name", $name);
					$stmt->bindParam(":message", $message);
					if($stmt->execute()){
						header("location: ../voorbeeld/post.php?id=$post_id");
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