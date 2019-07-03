<?php
	require 'header.php';
?>
<main>
<?php
	
		require 'leftColumn.php';
	
?>
			<article>
<?php
	
	// below is a query that gathers all the information of a user.
	$user = $dbAccessObject->retrieveUserByEmail($_GET['email']);
	// loop to help print out the results of the above query.
	foreach ($user as $row){
		
		echo '<h2>' . $row['FirstName'] . " " . $row['Surname'] . '</h2>';
		echo '<p> Email: ' . $row['Email'] . '</p>';
		echo '<form>
		</form>';
	}
	echo '<h4> Comments: </h4>';
	echo '</br>';
	// gets the comments for a certain user.
	$userComments = $dbAccessObject->retrieveUserComments($_GET['email']);
	// loop over the results
	foreach ($userComments as $row) {
		echo '<p> Article title: ' . $row['articleName'] . '</p>';
		echo '</br>';
		echo '<p> Date of comment: ' . $row['commentDate'] . '</p>';
		echo '</br>';
		echo '<p>Comment: ' . $row['commentContent'] . '</p>';
		echo '<form>
		</form>';
	
	}
	
?>	
			</article>
		</main>
<?php
	require 'footer.php';
?>