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
	if ($_GET['authorise'] == 'no') {
		$deleteComment = $dbAccessObject-> deleteComment($_GET['commentId']);
		echo '<p> Comment has been deleted. </p>';
	}
	if ($_GET['authorise'] == 'yes') {
		$authoriseComment = $dbAccessObject-> updateAuthorisedComment($_GET['commentId']);
		echo '<p> Comment has been approved. </p>';
	}
				
							
					
?>		

			</article>
		</main>
<?php
	require 'footer.php';
?>