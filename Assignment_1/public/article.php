<?php
	require 'header.php';
?>
<main>
<?php
	
		require 'leftColumn.php';
	
?>
			<article>
<?php
	
	// below is a query that gathers all the information of an article.
	$article = $dbAccessObject->retrieveArticle($_GET['article']);
	// loop to help print out the results of the above query.
	foreach ($article as $row){
		
		echo '<h2>' . $row['articleName'] . '</h2>';
		echo '<p> Date written: ' . $row['creationDate'] . '</p>';
		echo '<p> Written by: ' . $row['articleAuthor'] . '</p>';
		echo '<form>';
		echo '<p>' . $row['articleContent'] . '</p>';
		echo '</form>';
		echo '<form>
		</form>';
		// this will retrieve the comments for the article. that are authorised.
		$comments = $dbAccessObject->retrieveArticleComments($_GET['article']);
		
		// loop to print out the results of the query.
		foreach ($comments as $row) {
			echo '<h4> Name: ' . $row['firstName'] . ' ' . $row['surname'] . '</h4>';
			echo '<p> Date written: ' . $row['commentDate'] .'</p>';
			echo '<p> Comment: ' . $row['commentContent'] .'</p>';
			echo '<form>
				</form>';
		}
		// checks to see if someone is logged in
		if ($_SESSION['loggedIn'] == true){
			// passes the post variables through so i can validate them.
			$validationResults = validateFields($_POST);
			if ($validationResults['isValid']){
				// below helps pull through the comment ID.
				$getCommentId = $dbAccessObject->getCommentId();
				// below line helps keep spaces in text fields. This is done by looking for \n (newline) and changes it to <br>.
				$commentContent=preg_replace("/[\n]/","<br>",$_POST['comment']);
				// adds 1 to the comment ID.
				$getCommentId++;
				// add system date to the comment database.
				$commentDate = date('Y/m/d');
				// criteria for the add comment query.
				$addCommentCriteria = [
						'commentId' => $getCommentId,
						'firstName' => $_SESSION['firstName'],
						'surname' => $_SESSION['surname'],
						'email' => $_SESSION['email'],
						'articleName' => $_GET['article'],
						'commentDate' => $commentDate,
						'commentContent' => $commentContent,
						'authorised' => 'N'];
				// runs the code to execute the add comment query. 
				$addComment = $dbAccessObject->addComment($addCommentCriteria);
				echo '<p> Comment has been added. </p>';
				unset($_POST);
			}
			else {
				
				// form to add the comment.
				echo '  <form action="article.php?article=' . $row['articleName'] . '" method="POST">
						<label> Comment: </label><textarea name="comment"> </textarea>
						<input type="submit" name="submit" value="Submit" />
					</form> ';
			}
		}
		else {
			echo '<p> Please log in inorder to add a comment. </p>';
		}
	}
	// validation section for the page.
		function validateFields($fields){
	// array for validating the fields if they are false or blank then the field isn't valid	 
		$valid = [
			'isValid' => true,
			'invalidField' => ''
		];
		
		if(!isset($fields['comment']) || empty($fields['comment'])){
			$valid['isValid'] = false;
			$valid['invalidField'] = 'comment';
		}
		
		return $valid;
	}
?>
			</article>
		</main>
<?php
	require 'footer.php';
?>