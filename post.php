<?
	session_start();
	include_once("db.php");

	if(!isset($_SESSION['username'])){
	header("Location: login.php");
	return;
	}

	if(isset($_POST['post'])){
		$title = strip_tags($_POST['title']);
		$content = strip_tags($_POST['content']);
		
		$title = mysqli_real_escape_string($db, $title);
		$content = mysqli_real_escape_string($db, $content);
		
		$date = date('l jS \of F Y h:i:s A');
		
		$sql = "INSERT INTO posts (title, content, date) VALUES ('$title', '$content', '$date')";
		
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
		<form action="post.php" method="post" enctype="multipart/form-data">
			<input placeholder="Tytuł" name="title" type="text" autofocus size="48"><br><br>
			<textarea placeholder="treść" name="content" rows="15" cols="50"></textarea><br>
			<input name="post" type="submit" value="Wyślij">
		</form>
		
	</body>
</html>