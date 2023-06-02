<?php
	include 'functions.php';
	template_header('PHP results vote');
	$id_page = $_GET['id'];	
?>

<form class="content_to_center" action="<?php echo $_SERVER["PHP_SELF"]."?id=".$id_page; ?>" method="POST">
	<h2>Delete Poll #<?php echo $id_page; ?></h2><br><hr><br>
	<p>Are you sure you want to delete poll #<?php echo $id_page; ?></p><br>
    <button name="submit" value="yes">Yes</button>
    <button name="submit" value="no">No</button>
</form>

<?php
	if (isset($_POST['submit']) == 1) {
		if($_POST['submit'] == "yes"){
			mysqli_query($conection, "DELETE FROM polls WHERE id = $id_page");
			mysqli_query($conection, "DELETE FROM poll_answers WHERE poll_id = $id_page");
			change_location("index.php");
		}
		else
			change_location("index.php");
	}
	close_db($conection);
	template_footer();
?>