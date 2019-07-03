<?php
	require 'header.php';
?>
<main>
<?php
	require 'leftColumn.php';
?>
			
			<article>
				<h2>Sign Up</h2>
				<form action="signUpcompleted.php" method="POST">
					<p>Please enter the below information in order to set up an account.</p>

					<label>First Name</label> <input type="text" name="fName" /> <!--value="" --> 
					<label>Surname</label> <input type="text" name="sName" />
					<label>Date Of Birth</label> <input type="date" name="dob" />
					<label>Email</label> <input type="text" name="email" />
					<label>Password</label> <input type="password" name="pass" />
					<input type="submit" name="submit" value="Submit" />
				</form>

			</article>
		</main>
<?php
	require 'footer.php';
?>