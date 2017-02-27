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
			require_once("nbbc/nbbc.php");
		
			$bbcode = new BBCode;
		
			$pid = $_GET['pid'];
		
			$sql = "SELECT * FROM posts ORDER BY id DESC";
		
			$result = mysqli_query($db, $sql) or die(mysqli_error());
		
			$posts = "";
		
			if(mysqli_num_rows($result) > 0)	{
				while($row = mysqli_fetch_assoc($result))	{
					$id = $row['id'];
					$title = $row['title'];
					$date = $row['date'];
					$content = $row['content'];
					
					if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
						$admin = "<div><a href=\"delPost.php?pid=$id\">Usuń</a>&nbsp<a href=\"editPost.php?pid=$id\">Edytuj</a></div>";

					}else{ 
						$admin = "";
					}
					$output = $bbcode->Parse($content);
					
					echo "<div><h2>$title</h2><h3>$date</h3><p>$output</p>$admin<hr></div>";
				}
				
			}else echo "Nie ma";
		?>
		<a href="index.php">Wróć do strony głównej</a>
	
	</body>
</html>