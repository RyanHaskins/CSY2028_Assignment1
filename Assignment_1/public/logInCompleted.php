<?php
	require 'header.php';
	
?>
<main>
<?php
	// validates the fields from the post array. 
		$validationResults = validateFields($_POST);
	
		if ($validationResults['isValid']){
			// pulls through the information to check the entered info is the same as its in the database. 
			$pass = sha1($_POST['email'] . $_POST['pass']);
			$userEmailValidation = $dbAccessObject->getUsersByEmail($_POST['email']);
			$userPassValidation = $dbAccessObject->usersPass($pass);
			$email = $_POST['email'];	
			
			
			
			if ($userEmailValidation->rowCount() == 1){	
			
				if ($userPassValidation->rowCount() == 1){
					$firstName = $dbAccessObject->fetchFirstName($email);
					$surname = $dbAccessObject->fetchSurname($email);
					$_SESSION['loggedIn'] = true;
					$_SESSION['email'] = $email;
					$_SESSION['firstName'] = $firstName;
					$_SESSION['surname'] = $surname;
					require 'leftColumn.php';
					echo '<h2> You have successfully logged in. </h2>';
					echo '<p> Please enjoy all the functions that you now have access too. </p>';
					
				}
				else {
				require 'leftColumn.php';
				echo '<h4> Incorrect Information: </h4>';
				echo ' <p> Unable to log in please check your password. </p>';
			
			}
			}
		
			else {
				require 'leftColumn.php';
				echo '<h4> Incorrect Information: </h4>';
				echo ' <p> Unable to log in please check the credentials and try again. </p>';
			
			}
		}
		else {
				require 'leftColumn.php';
				echo '<h4> Incorrect Information: </h4>';
				echo ' <p> Unable to log in please check the credentials and try again. </p>';
			
			}
		

		
		
?>
			<article>
<?php
	
	
	// below function validates the fields are filled out from the form on the log In page. 
	function validateFields($fields){
	// array for validating the fields if they are false or blank then the field isn't valid	
		$valid = [
			'isValid' => true,
			'invalidField' => ''
		];
		
		if(!isset($fields['email']) || empty($fields['email'])){
			$valid['isValid'] = false;
			$valid['invalidField'] = 'email';
		}
		if(!isset($fields['pass']) || empty($fields['pass'])){
		
			$valid['isValid'] = false;
			$valid['invalidField'] = 'pass';
		}
		
		return $valid;
	}
?>
	</article>
			
		</main>
<?php
	require 'footer.php';
?>