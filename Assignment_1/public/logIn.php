<?php
	require 'header.php';

?>
<main>
<?php
	require 'leftColumn.php';
?>
			<article>
				<h2>Log In</h2>
				<form action="logInCompleted.php" method="POST">
					<label>Email</label> <input type="text" name="email" />
					<label>Password</label> <input type="password" name="pass" />
					<input type="submit" name="submit" value="Submit" />
				</form>

			</article>
		</main>
<?php
	require 'footer.php';
?>