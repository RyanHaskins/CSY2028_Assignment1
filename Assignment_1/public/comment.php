<?php
	require 'header.php';
?>
<main>
<?php
	require 'leftColumn.php';
?>
			<article>
<?php
	echo ' <h2> Authorise Comments. </h2>';
	echo ' <form>
		</form>';
	
	$retrieveUnauthorisedComments = $dbAccessObject->unauthorisedComments();
	if ($retrieveUnauthorisedComments->rowCount() == 0){
		echo '<p> There is currently no comments to action. </p>';
	}
	else {
		foreach ($retrieveUnauthorisedComments as $row) {
			echo '<h4>' . $row['firstName'] . ' ' . $row['surname'] .  '</h4>';
			echo '<p>' . $row['commentDate'] . '</p>';
			echo '<p>' . $row['commentContent'] . '</p>';
			echo '<a href="authoriseComment.php?authorise=yes&commentId=' . $row['commentId'] . '">Authorise comment.</a>';
			echo '</br>';
			echo '<a href="authoriseComment.php?authorise=no&commentId=' . $row['commentId'] . '">Remove comment.</a>';
			echo '<form>
				</form>';
		}
		
	}
				
							
					
?>		

			</article>
		</main>
<?php
	require 'footer.php';
?>