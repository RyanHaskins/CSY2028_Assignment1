<?php
	require 'header.php';
?>
<main>
<?php
	require 'leftColumn.php';
?>
			<article>
<?php
	echo ' <h2> Edit a User: </h2>';
	// form to selcet what changes should be made. 
	if (!isset($_POST['submit']) || empty($_POST['submit'])){
		echo ' <p> Please make the changes to a user below. </p> '; 
		echo ' <p> If you wish to delete a user you must enter their email address in the account you want to edit box and the delete box. </p> ';
	
		echo ' <form action="users.php?edit=user" method="POST"> 
							<label> user\'s email address of the account you want to edit:<input type="text" name="email" />
							<label>Change first name:</label> <input type="text" name="firstName" />
							<label>Change surname:</label> <input type="text" name="surname" />
							<label>Change date of birth:</label> <input type="date" name="dob" />
							<label>Change Email:</label> <input type="text" name="newEmail" />
							<label>Change Password:</label> <input type="text" name="password" />
							<label> Enter email address of user you wish to delete:<input type="text" name="delete" />
							<input type="submit" name="submit" value="Submit" />
				</form>';
	}
	else {
		// checks that a user's email is entered to find the user that will be edited. 
		if (!isset($_POST['email']) || empty($_POST['email'])) {
			echo ' <p> account to change hasn\'t been entered please fill out the first box of the previous page. </p>';
		}
		else{
			$emailVerificationResult = $dbAccessObject->getUsersByEmail($_POST['email']);
			if ($emailVerificationResult->rowCount() >= 1){	
			// this to change users first name.
				if (!isset($_POST['firstName']) || empty($_POST['firstName'])){

				}
				else {
					$changeUserFirstName = $dbAccessObject->updateUserFirstName($_POST['firstName']);
					
					if ($changeUserFirstName == true) {
						echo '<p> The User\'s first name has been changed to ' . $_POST['firstName'] . '.</p>';
					}
					else {
						echo '<p> The process has failed please rerun the process again. </p>';
					}
				}
			// this changes the users surname.	
				if (!isset($_POST['surname']) || empty($_POST['surname'])) {
					
				}
				else {
					$changeUserSurname = $dbAccessObject->updateUserSurname($_POST['surname']);
					
					if ($changeUserSurname == true) {
						echo '<p> The User\'s surname has been changed to ' . $_POST['surname'] . '.</p>';
					}
					else {
						echo '<p> The process has failed please rerun the process again. </p>';
					}
				}
				
				if (!isset($_POST['dob']) || empty($_POST['dob'])) {
					
				}
				else {
					$changeUserDob = $dbAccessObject->updateUserDob($_POST['dob']);
					
					if ($changeUserDob == true) {
						echo '<p> The User\'s DoB has been changed to ' . $_POST['dob'] . '.</p>';
					}
					else {
						echo '<p> The process has failed please rerun the process again. </p>';
					}
				}
			// this changes the users password.	
				if (!isset($_POST['password']) || empty($_POST['password'])) {
					
				}
				else {
					$changeUserPassword = $dbAccessObject->updateUserPassword($_POST['password']);
					
					if ($changeUserPassword == true) {
						echo '<p> The User\'s password has been changed.</p>';
					}
					else {
						echo '<p> The process has failed please rerun the process again. </p>';
					}
				}
		// this deletes a user from the database
				if (!isset($_POST['delete']) || empty($_POST['delete'])) {
					
				}
				else {
					$emailVerificationResult = $dbAccessObject->getUsersByEmail($_POST['delete']);
					if ($emailVerificationResult->rowCount() >= 1){		
						$deleteUser = $dbAccessObject->deleteUser($_POST['delete']);
						
						if ($deleteUser == true) {
							echo '<p> The User has been deleted.</p>';
						}
						else {
							echo '<p> The process has failed please rerun the process again. </p>';
						}
					}
					else {
						echo '<p> Could not find user to delete. </p>';
					}
				}
		// this changes the users email address.	
			if (!isset($_POST['newEmail']) || empty($_POST['newEmail'])) {
					
				}
				else {
					$emailVerificationResult = $dbAccessObject->getUsersByEmail($_POST['newEmail']);
					if ($emailVerificationResult->rowCount() == 0){	
						$changeUserEmail = $dbAccessObject->updateUserEmail($_POST['newEmail']);
						
						if ($changeUserEmail == true) {
							echo '<p> The User\'s email has been changed to ' . $_POST['newEmail'] . '.</p>';
						}
						else {
							echo '<p> The process has failed please rerun the process again. </p>';
						}
					}
					else {
						echo '<p> Please enter a unique email address. Email address: ' . $_POST['newEmail'] . ' is already in use.</p>';
					}
				}
				
			}
			else {
				echo '<p>Email address has not been found. Please try again. </p>';
			}
		}
	}
				
				
?>				
	
			</article>
		</main>
<?php
	require 'footer.php';
?>