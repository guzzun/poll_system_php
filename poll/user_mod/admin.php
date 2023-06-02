<?php
	include 'functions.php';
	template_header('PHP poll');
?>
<script>
	document.getElementsByTagName('form')[0].remove();
	function change_location(url){
		location.replace(url);
	}
</script>
<article class="content_to_center">
	<br>
	<h2>Polls</h2>
	<br>
	<hr>
	<?php
		print <<<EOT
				<br><button onclick="change_location('create.php')">Create Poll</button><br><br>
				EOT;
	?>
	
	<table>
        <thead>
            <tr>
                <td>#</td>
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
			                <td>'.$id.'</td>
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
			                    <a href="delete.php?id='.$id.'" class="trash" title="Delete Poll">
			                   		<i class="fas fa-minus-circle">
			                    </i></a>
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