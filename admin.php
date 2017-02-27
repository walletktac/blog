<?
	session_start();
	include_once("db.php");

	if(!isset($_SESSION['admin']) && $_SESSION['admin'] != 1){
		header("Location: login.php");
		return;
	}

	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Blog PhP</title>
	</head>
	<body>
		<?
			$sql = "SELECT * FROM posts ORDER BY id DESC";
		
			$result = mysqli_query($db, $sql) or die(mysqli_error());
		
			$posts = "";
		
			if(mysqli_num_rows($result) > 0)	{
				while($row = mysqli_fetch_assoc($result))	{
					$id = $row['id'];
					$title = $row['title'];
					$content = $row['content'];
					$date = $row['date'];
					
					$admin = "<div><a href=\"delPost.php?pid=$id\">Usuń</a>&nbsp<a href=\"editPost.php?pid=$id\">Edytuj</a></div>";
					
					$posts .= "<div><h2><a href=\"viewPost.php?pid=$id\" target='_blank'>$title</a></h2><h3>$date</h3>$admin<hr></div>";
				}
				echo $posts;
			}else echo "Nie ma";
				
	
		?>
		<a href="post.php" target="_blank">Dodaj Post</a>
	</body>
</html>