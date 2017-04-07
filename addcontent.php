<?php 

require 'templates/header.php';
require_once('resources/db/db_connect.php');

$create_db_query = 'CREATE TABLE IF NOT EXISTS Content(
id INT NOT NULL AUTO_INCREMENT,
title VARCHAR(50),
author VARCHAR(50),
creation_date DATE,
description VARCHAR(255),
transcript TEXT,
PRIMARY KEY(id)
)ENGINE=InnoDB;';


if (isset($_POST['contentsubmit'])){
    /*if (isset($_FILES['audio_file'])){
        try{
            $audio_filename = $_FILES['audio_file']['name'];
            $audio_tmp_name = $_FILES['audio_file']['tmp_name'];
            $new_audio_filename = 'resources/audio/' . basename($audio_filename);
            move_uploaded_file($audio_tmp_name, $new_audio_filename);
            
        }catch (Exception $e){
            
        }
    }*/
    
    try{
        $title = $_POST['title'];
        $author = $_POST['author'];
        $description = $_POST['description'];
        $transcript = $_POST['transcript'];
        $creation_date = $_POST['creation_date'];
        $insert_query = 'INSERT INTO Content (title, author, description, creation_date, transcript)'.
            ' VALUES (?,?,?,?,?)';
        
        //create table if not exists
        $conn->query($create_db_query);
        
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param('sssss',$title, $author, $description, $creation_date, $transcript);
        $stmt->execute();
    }catch (Exception $e){
        //echo $e->getMessage();
    }finally{
        $stmt->close();
        $conn->close();
    }
}
?>
<div id="maincontent">

<div
	class="back-image-1">

			<div id="userform-div-cover">
			
	<form class="userform" id="addcontentform" action="" method="POST">
		<div>
			<label>Title</label><br />
			<input type="text" class="rform" name="title" />

			<br> <label>Author</label><br />
			<input type="text" class="rform" name="author" />

			<br /> <label>Description</label><br />
			<textarea class="rform" name="description" style="height: 100px;"></textarea>

			<br /> <label>Creation Date</label><br />
			<input type="date" class="rform" name="creation_date" />

			<!--<br /> <label>Audio File</label><br />
			<input type="file" class="rform" name="audio_file" />-->
			
			<br /> <label>Transcript</label><br />
			<textarea class="rform" name="transcript" style="height: 150px;"></textarea>
			
			<br /> <br> <input id="addContentsubmit" type="submit"
				name="contentsubmit" value="Add" />
		</div>
	</form>
	</div>
	</div>

	<br />
	<div style="color: white;">
		<span></span>
	</div>
	<div id="dialog" title="Incorrect input"></div>
	
</div>
<!--END OF MAIN CONTENT-->
<?php require 'templates/footer.php'; ?>