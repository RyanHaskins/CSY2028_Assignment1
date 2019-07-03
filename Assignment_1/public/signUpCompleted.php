<?php
	require 'header.php';
?>
<main>
<?php
	require 'leftColumn.php';
?>
			<article>
<?php
	// checks to see that the fields from the sign up form have been filled in and are set.  
	$validationResults = validateFields($_POST);
	// if statement to run as long as all the fields have been filled out. 
	if ($validationResults['isValid']){
	// this sends the email from the form to a function to validate that it isn't already in the database.
		$emailVerificationResult = $dbAccessObject->getUsersByEmail($_POST['email']);
		if ($emailVerificationResult->rowCount() >= 1){	
			echo '<p>Email address already taken please enter another email address. </p>';
		}
		else {
			//call your insert function. pass it the array below.
			$Uiplacements = [
				'FirstName' => $_POST['fName'],
				'Surname' => $_POST['sName'],
				'DOB' => $_POST['dob'],
				'Email' => $_POST['email'],
				'Password' => sha1($_POST['email'] . $_POST['pass'])];
			$userInserted = $dbAccessObject->insertUser($Uiplacements);
			echo '<p> You have been added to the database. Please log in. </p>';
			
		}
	}
	// code below runs if the fields arn't validated which means the boxes are empty. this will read out which field has been left blank. 
	else {
		echo '<p> Unable to sign up. Please fill out all the boxes. </p>';
	}
	// below function validates the fields are filled out from the form on the sign up page. 
	function validateFields($fields){
	// array for validating the fields if they are false or blank then the field isn't valid	
		$valid = [
			'isValid' => true,
			'invalidField' => ''
		];
		
		if(!isset($fields['fName']) || empty($fields['fName'])){
			$valid['isValid'] = false;
			$valid['invalidField'] = 'fName';
		}
		
		if(!isset($fields['sName']) || empty($fields['sName'])){
			$valid['isValid'] = false;
			$valid['invalidField'] = 'sName';
		}
		
		if(!isset($fields['dob']) || empty($fields['dob'])){
			$valid['isValid'] = false;
			$valid['invalidField'] = 'dob';
		}
		
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

