<?php
	include 'functions.php';
	template_header('PHP results vote');	
?>
<style>
	div.result_vot{
		background-color: #3DB577;
		border-radius: 0.4vw;
		text-align: center;
	    color: white;
	    padding: 1vh 0;
	}
	article{
		width: 40%;
		margin: 0 auto;
		padding: 1vw;
		background-color: white;
		border-radius: 0.3vw;
	}
	article > h1{
		width: 100%;
		text-align: center;
	}
</style>
<br>
<article>
	<?php
	$id_page = $_GET['id'];		
			//afisare titlu poll =====================================================================================
	$result = mysqli_query($conection, "SELECT title FROM polls WHERE id = $id_page") or die("Error:".mysqli_error($conection));
	$Poll_title = mysqli_fetch_assoc($result);
	$Poll_title = $Poll_title['title'];
	print '<h1>'.$Poll_title.'</h1>';


			// afisare in procentaj voturile obtinute =================================================================
	$query   = "SELECT * FROM poll_answers 
				WHERE poll_id = $id_page
				ORDER BY votes DESC";
	$result  = mysqli_query($conection, $query) or die("Error: ".mysqli_error($conection));

	while($polls_answers = mysqli_fetch_assoc($result) ){
				//aflam prin sql query suma totala la voturi
		$query = "SELECT SUM(votes) AS suma FROM poll_answers 
		WHERE poll_id = 1";
		$result_vot = mysqli_query($conection, $query) or die("Error: ".mysqli_error($conection) );
		$result_vot = mysqli_fetch_assoc($result_vot);
		$result_vot = intval($result_vot['suma']);

				//calcuma insusi procentajul
		$result_vot = calculate_procent(intval($polls_answers['votes']), $result_vot);

		print "<br>".$polls_answers['title']." (".$polls_answers['votes']."votes)";
		print '<br><div style="width: '.$result_vot.'%;" class="result_vot">'.$result_vot.'%</div>';
	}

	function calculate_procent($answer, $sum){
		$pr_sum  = $answer;
		$pr_sum += $sum;
		return round( ($answer * 100.0 / $pr_sum) );
	}
	?>

</article>	
<?php
	close_db($conection);
	template_footer();
?>