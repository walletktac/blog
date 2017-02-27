<?
	session_start();
	include_once("db.php");
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
		
			$sql = "SELECT * FROM posts ORDER BY id DESC";
		
			$result = mysqli_query($db, $sql) or die(mysqli_error());
		
			$posts = "";
		
			if(mysqli_num_rows($result) > 0)	{
				while($row = mysqli_fetch_assoc($result))	{
					$id = $row['id'];
					$title = $row['title'];
					$content = $row['content'];
					$date = $row['date'];
;
					
					$output = $bbcode->Parse($content);
					
					$posts .= "<div><h2><a href=\"viewPost.php?pid=$id\">$title</a></h2><h3>$date</h3><p>$content</p><hr></div>";
				}
				echo $posts;
			}else echo "Nie ma";
				
			if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
				echo "<a href='admin.php'>Admin</a> | <a href='logout.php'>Wyloguj</a>";
			}
		
			if(!isset($_SESSION['username'])){
				echo "<a href='login.php'>Zaloguj</a> <br>";
			}
			if(!isset($_SESSION['username']) && !isset($_SESSION['admin'])){
				echo "<a href='logout.php'>Wyloguj</a>";
			}
		?>
	
	</body>
</html>