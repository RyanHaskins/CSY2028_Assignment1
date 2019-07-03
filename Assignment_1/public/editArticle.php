<?php
	require 'header.php';
?>
<main>
<?php
	
		require 'leftColumn.php';
	
?>
			<article>
<?php
	
// the if statements runs to check whats stored in the get array. it will then run each function depending on what is stored in the get. 
	if ($_GET['edit'] == 'delete') {
		echo '<h2> Delete an article:</h2>';
		// validates the post fields have been filled out.
		$validationResults = validateDeleteFields($_POST);
		if ($validationResults['isValid']){
			// check the article is there inorder to delete it.
			$deleteArticleVerificationResult = $dbAccessObject->checkDeleteArticle($_POST['deleteArticle']);
			if ($deleteArticleVerificationResult->rowCount() == 0){
				echo '<p> could not find article to delete. Please retry the process. </p>';
				}
			else{
				// runs deleteing an article query. 
				$deleteArticle = $dbAccessObject->deleteArticle($_POST['deleteArticle']);
				echo '<p> Article has been deleted. </p>';
				unset($_POST);
			}	
		}
		else {
			echo '
			<p> Please type the name of the article you wish to delete. </p>
				<form action="editArticle.php?edit=delete" method="POST">
					<label>Article: </label> <input type="text" name="deleteArticle" />
					<input type="submit" name="submit" value="Submit" />
				</form>';
		}
	}
// edits an article name below. 	
	if ($_GET['edit'] == 'editArticleName') {
		echo '<h2> Change an article\'s name:</h2>';
		// checks the fields are all filled out correctly for the post array. 
		$validationResults = validateEditArticleNameFields($_POST);
		if ($validationResults['isValid']){
			// check to edit an article in order to check the article is there.
			$editArticleVerificationResult = $dbAccessObject->checkEditArticle($_POST['articleName']);
			if ($editArticleVerificationResult->rowCount() == 0){
				echo '<p> could not find article to edit. Please retry the process. </p>';
				}
			else{
				// this allows you to change the articles name. 
				$editArticleName = $dbAccessObject->editArticleName($_POST['articleName'], $_POST['newArticleName']);
				echo '<p> Article name has been changed. </p>';
				unset($_POST);
			}	
		}
		else {
			echo '<p> Please type the name of the article you wish to edit. </p>
				<form action="editArticle.php?edit=editArticleName" method="POST">
					<label>Article name: </label> <input type="text" name="articleName" />
					<label>New article name: </label> <input type="text" name="newArticleName" />
					<input type="submit" name="submit" value="Submit" />
				</form>';
		}
	}
	// the below edits the authour of the articles. 
	if ($_GET['edit'] == 'editArticleAuthor') {
		echo '<h2> Change an article\'s author:</h2>';
		// validates the information as before. 
		$validationResults = validateEditArticleAuthorFields($_POST);
		if ($validationResults['isValid']){
			// this checks the article is in the database to edit. 
			$editArticleVerificationResult = $dbAccessObject->checkEditArticle($_POST['articleName']);
			if ($editArticleVerificationResult->rowCount() == 0){
				echo '<p> could not find article to edit. Please retry the process. </p>';
				}
			else{
				// the below updates the authour on an article. 
				$editArticleAuthor = $dbAccessObject->editArticleAuthor($_POST['articleName'], $_POST['newArticleAuthor']);
				echo '<p> Article Author has been changed. </p>';
				unset($_POST);
			}	
		}
		else {
			echo '<p> Please type the name of the article you wish to change. </p>
				<form action="editArticle.php?edit=editArticleAuthor" method="POST">
					<label>Article name: </label> <input type="text" name="articleName" />
					<label>New authors name: </label> <input type="text" name="newArticleAuthor" />
					<input type="submit" name="submit" value="Submit" />
				</form>';
		}
	}
	// edits an articles category. 
	if ($_GET['edit'] == 'editArticleCategory') {
		echo '<h2> Change an article\'s category:</h2>';
		// checks the fields have been filled out. 
		$validationResults = validateEditArticleCategoryFields($_POST);
		if ($validationResults['isValid']){
			// check the article is there. to edit.
			$editArticleVerificationResult = $dbAccessObject->checkEditArticle($_POST['articleName']);
			if ($editArticleVerificationResult->rowCount() == 0){
				echo '<p> could not find article to edit. Please retry the process. </p>';
			}
			else{
				// checks that the category is stored in the database already. 
				$editCategoryVerificationResult = $dbAccessObject->checkEditCategory($_POST['newArticleCategory']);
				if ($editCategoryVerificationResult->rowCount() == 0){
					echo '<p> The category is not listed. Please add this category before setting it to any articles by using the tool bar.</p>'; 
				}
				else{
				//	this updates the article category. 
					$editArticleAuthor = $dbAccessObject->editArticleCategory($_POST['articleName'], $_POST['newArticleCategory']);
					echo '<p> Article category has been changed. </p>';
					unset($_POST);
				}
			}	
		}
		else {
			echo '<p> Please type the name of the article you wish to change. </p>
				<form action="editArticle.php?edit=editArticleCategory" method="POST">
					<label>Article name: </label> <input type="text" name="articleName" />
					<label>New article category: </label> <input type="text" name="newArticleCategory" />
					<input type="submit" name="submit" value="Submit" />
				</form>';
		}
	}
	// this edits the articles content. 
	if ($_GET['edit'] == 'editArticleContent') {
		echo '<h2> Change an article\'s content:</h2>';
		// check that the fields have been filled out correctly. 
		$validationResults = validateEditArticleContentFields($_POST);
		if ($validationResults['isValid']) {
			// check the article is in the article already.
			$editArticleVerificationResult = $dbAccessObject->checkEditArticle($_POST['articleName']);
			if ($editArticleVerificationResult->rowCount () == 0) {
				echo '<p> could not find article. Please retry the process. </p>';
			}
			else {
				// check the fields have been set. 
					if (!isset($_POST['articleName']) || empty($_POST['articleName']) || !isset($_POST['articleContent']) || empty($_POST['articleContent'])) {
					echo '<p> Content hasn\'t been changed please retry the process and check that all fields are filled out.</p>';
					}
					else {
						echo '<p> updated </p>';
						echo '<p> If you would like to view the article click the below link. </p>';
						echo '<a href="article.php?article=' . $_POST['articleName'] . '"><p>' . $_POST['articleName'] . '</p>'; 
						// below line helps keep spaces in text fields. This is done by looking for \n (newline) and changes it to <br>.
						$articleContent=preg_replace("/[\n]/","<br>",$_POST['articleContent']);
						$editArticleContent = $dbAccessObject->editArticleContent($articleContent, $_POST['articleName']);
						unset($_POST);
					}
			}
		}
		else {
			echo '<p> Please type the name of the article you wish to edit and the new content. </p>
				<form action="editArticle.php?edit=editArticleContent" method="POST">
					<label>Article name: </label> <input type="text" name="articleName" />
					<label>Article content:</label><textarea name="articleContent"></textarea>
					<input type="submit" name="submit" value="Submit" />
				</form>';
		}
	}
	// the functin belows helps validate the fields to check the information coming through is correct. 
	function validateDeleteFields($fields){
	// array for validating the fields if they are false or blank then the field isn't valid	
		$valid = [
			'isValid' => true,
			'invalidField' => ''
		];
		
		if(!isset($fields['deleteArticle']) || empty($fields['deleteArticle'])){
			$valid['isValid'] = false;
			$valid['invalidField'] = 'deleteArticle';
		}
		
		return $valid;
	}
	
	function validateEditArticleNameFields($fields){
	// array for validating the fields if they are false or blank then the field isn't valid	
		$valid = [
			'isValid' => true,
			'invalidField' => ''
		];
		
		if(!isset($fields['articleName']) || empty($fields['articleName'])){
			$valid['isValid'] = false;
			$valid['invalidField'] = 'articleName';
		}
		if(!isset($fields['newArticleName']) || empty($fields['newArticleName'])){
			$valid['isValid'] = false;
			$valid['invalidField'] = 'newArticleName';
		}
		
		return $valid;
	}
	
	function validateEditArticleAuthorFields($fields){
	// array for validating the fields if they are false or blank then the field isn't valid	
		$valid = [
			'isValid' => true,
			'invalidField' => ''
		];
		
		if(!isset($fields['articleName']) || empty($fields['articleName'])){
			$valid['isValid'] = false;
			$valid['invalidField'] = 'articleName';
		}
		if(!isset($fields['newArticleAuthor']) || empty($fields['newArticleAuthor'])){
			$valid['isValid'] = false;
			$valid['invalidField'] = 'newArticleAuthor';
		}
		
		return $valid;
	}
	
	function validateEditArticleCategoryFields($fields){
	// array for validating the fields if they are false or blank then the field isn't valid	
		$valid = [
			'isValid' => true,
			'invalidField' => ''
		];
		
		if(!isset($fields['articleName']) || empty($fields['articleName'])){
			$valid['isValid'] = false;
			$valid['invalidField'] = 'articleName';
		}
		if(!isset($fields['newArticleCategory']) || empty($fields['newArticleCategory'])){
			$valid['isValid'] = false;
			$valid['invalidField'] = 'newArticleCategory';
		}
		
		return $valid;
	}
	
	function validateEditArticleContentFields ($fields){
	// array for validating the fields if they are false or blank then the field isn't valid
		$valid = [
			'isValid' => true,
			'invalidField' => ''
			];
		
		if(!isset($fields['articleName']) || empty ($fields['articleName'])) {
			$valid['isValid'] = false; 
			$valid['invalidField'] = 'articleName';
		}
		
		return $valid;
	}
?>
			</article>
		</main>
<?php
	require 'footer.php';
?>