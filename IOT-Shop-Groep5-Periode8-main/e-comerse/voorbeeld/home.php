<?php

require_once('../backend/partial/header.php');
require_once('../backend/Post.php');
session_start();
$PostIns = new Post();
if(isset($_POST['addPost'])){
	echo $PostIns->addPost($_POST['title'], $_POST['description'], $_POST['content']);
}

?>
<!doctype html>
<html>
<head>

<meta charset="utf-8">
<title>addpost</title>
<link href="../CSS/style.css" rel="stylesheet" type="text/css">
</head>

<body>

</body>
</html>
<?php

require_once('../partial/footer.php');

?>