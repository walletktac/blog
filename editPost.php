<?
	session_start();
	include_once("db.php");

	if(!isset($_SESSION['username'])){
	header("Location: login.php");
	return;
	}

	if(!isset($_GET['pid'])){
	header("Location: index.php");
	}

	$pid = $_GET['pid'];

	if(isset($_POST['update'])){
		$title = strip_tags($_POST['title']);
		$content = strip_tags($_POST['content']);
		
		$title = mysqli_real_escape_string($db, $title);
		$content = mysqli_real_escape_string($db, $content);
		
		$date = date('l jS \of F Y h:i:s A');
		
		$sql = "UPDATE posts SET title='$title', content='$content', date='$date' WHERE id=$pid";
		
		if($title == "" || $content == ""){
			echo "Dokończ wypełnianie";
			return;
		}
		
		mysqli_query($db, $sql);
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>Blog PhP</head>
	<body>
		<?
			$sql_get = "SELECT * FROM posts WHERE id=$pid LIMIT 1";
			$result = mysqli_query($db, $sql_get);
		
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_assoc($result)){
					$title = $row['title'];
					$content = $row['content'];
					
					echo "<form action='editPost.php?pid=$pid' method='post' enctype='multipart/form-data'>";
					echo "<input placeholder='Tytuł' name='title' type='text' autofocus size='48' value='$title'><br><br>";
					echo "<textarea placeholder='treść' name='content' rows='15' cols='50' value='$content'></textarea><br>";
					echo "<input name='update' type='submit' value='Edycja'>";
					echo "</form>";
				}
			}
		?>
	</body>
</html>