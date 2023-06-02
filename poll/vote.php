<?php
	include 'functions.php';
	template_header('PHP vote');
	$id_page = $_GET['id'];	
?>

<form action="<?php echo $_SERVER["PHP_SELF"]."?id=".$id_page; ?>" method="POST" class="content_to_center">
	<?php
		
		//afisare titlu poll ======================================================================================
		$result = mysqli_query($conection, "SELECT title FROM polls WHERE id = $id_page") or die("Error:".mysqli_error($conection));
		$Poll_title = mysqli_fetch_assoc($result);
		$Poll_title = $Poll_title['title'];
		print '<br><h1>'.$Poll_title.'</h1><br><hr><br>';

		// afisare in procentaj voturile obtinute =================================================================
		$query  = "SELECT * FROM poll_answers 
					WHERE poll_id = $id_page
					ORDER BY votes DESC";
		$result = mysqli_query($conection, $query) or die("Error: ".mysqli_error($conection));

		while($polls_answers = mysqli_fetch_assoc($result) ){
			$title = $polls_answers['title'];
			print '<input id="'.$title.'" type="radio" name="vote_answer" value="'.$polls_answers['id'].'"> <label for="'.$title.'">'.$title.'</label>';
			print '<br>';
		}

		if(isset($_POST['submit']) == 1 ){
			$id_submited_poll = $_POST['vote_answer'];
			echo $id_submited_poll;
			$query = "UPDATE poll_answers SET votes = votes + 1 
					  WHERE id = $id_submited_poll";

			mysqli_query($conection, $query) or die("Error: ".mysqli_error($conection));
			change_location("index.php");
		}
	?>
	<br>
	<input type="submit" name="submit" value="Vote">
</form>
<?php
	close_db($conection);
	template_footer();
?>