<?php
	include 'functions.php';
	template_header('PHP poll');
?>
<script>
	var element = document.getElementsByTagName('form')[0];
	if (typeof(element) != 'undefined' && element != null)
		element.remove();
</script>
<article class="content_to_center">
	<style>
		table tbody tr td:nth-child(1) { color: black; }
	</style>
	<br>
	<h2>Polls</h2>
	<br>

	<table>
        <thead>
            <tr>
                <td>Title</td>
				<td>Answers</td>
				<td>Description</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
        	<?php
				$query ='SELECT p.*, GROUP_CONCAT(pa.title ORDER BY pa.id) AS answers 
						 FROM polls p 
						 LEFT JOIN poll_answers pa ON pa.poll_id = p.id 
						 GROUP BY p.id';
        		$result = mysqli_query($conection, $query);
        		while($polls = mysqli_fetch_assoc($result)){
	        		$id      = $polls['id'];
	        		$title   = $polls['title'];
	        		$answers = $polls['answers']; 
	        		$desc    = $polls['desc'];			
	        		echo '
			            <tr>
			                <td>'.$title.'</td>
							<td>'.$answers.'</td>
							<td>'.$desc.'</td>
			                <td class="actions">
			                	<a href="vote.php?id='.$id.'" class="view" title="Vote Poll">
			                		<i class="fas fa-poll"></i>
			                	</a>
								<a href="result.php?id='.$id.'" class="view" title="View Poll">
									<i class="fas fa-eye"></i>
								</a>
			                </td>
			            </tr>        		
	      			';
        		}

        	?>
        </tbody>
    </table>
</article>

<?php
	close_db($conection);
	template_footer();
?>