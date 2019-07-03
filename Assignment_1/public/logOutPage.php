<?php
	require 'header.php';

?>
<main>
<?php
	
	require 'leftColumn.php';
?>
			<article>
				<h2>Log Out!</h2>
				
<?php		// lets you log out and destroys the session variables. 
			if (!isset($_POST['submit'])){
				
				echo '<p> Please confirm that you would like to log out by clicking the log out button below </p>			
				<form action="index.php" method="POST">
					<input type="submit" name="submit" value="Log Out." />
				</form>';
				session_destroy();
			}
			else {
				
			}
?>
			</article>
		</main>
<?php
	require 'footer.php';
?>