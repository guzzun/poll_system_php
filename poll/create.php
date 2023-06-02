<?php 
    include 'functions.php';
    template_header('Create Poll'); 
?>
<style>
    form{
        display: flex;
        flex-flow: column wrap;
    }
    form input, form textarea{
        margin-top: 1.5vh;
        width: 25%;
    }
    form input[type=submit]{
        margin-top: 3vh;
        width: 15%;
    }
</style>
<div class="content_to_center">
    <form action="create.php" method="post">
    	<br>
        <h2>Create Poll</h2>
        <br>
        <hr>
        <br>
        <label for="title">Title</label>
        <input type="text" name="title" id="title">

        <label for="desc">Description</label>
        <input type="text" name="desc" id="desc">

        <label for="answers">Answers (per line)</label>
        <textarea name="answers" id="answers" rows=7></textarea>

        <input type="submit" value="Create">
        <?php 
            if (!empty($_POST)) {
                $title = isset($_POST['title']) ? $_POST['title'] : '';
                $desc = isset($_POST['desc']) ? $_POST['desc'] : '';
                $answers = isset($_POST['answers']) ? explode(PHP_EOL, $_POST['answers']) : '';

                $query = "INSERT INTO polls VALUES(NULL, '$title', '$desc')";
                mysqli_query($conection, $query) or die("Error: ".mysqli_error($conection) );

                $last_inserted_id = mysqli_fetch_row(mysqli_query($conection, "SELECT MAX(id) AS max_poll_id FROM polls") );
                $last_inserted_id = intval($last_inserted_id[0]);

                for ($i =0; $i < count($answers); $i++) {
                    if( empty($answers[$i]) ) 
                        continue;
                    mysqli_query($conection, "INSERT INTO poll_answers VALUES (NULL, $last_inserted_id, '$answers[$i]', 0)") 
                    or die("Error: ".mysqli_error($conection) );
                }

                echo "<br>Poll created succesful!";
            }  
        ?>         
    </form>
   
</div>

<?php template_footer(); ?>