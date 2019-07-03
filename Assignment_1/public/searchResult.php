<?php
	require 'header.php';
?>
<main>
<?php
	require 'leftColumn.php';
?>
			<article>
<?php
	// heading on the page title with line.
	echo ' <h2> Search Function. </h2>';
	$validationResults = validateSearchFields($_POST);
	
	if ($validationResults['isValid']) {
		// pulls through articles search on the title of articles.
		if (!isset($_POST['article']) || empty($_POST['article'])){
		}
		else if ($_POST['article'] == 'on') {
			$searchArticleName = $dbAccessObject->retrieveArticle($_POST['keyword']);
			if ($searchArticleName->rowCount () == 0) {
				echo '<p> No articles by this name. </p>';
			}
			foreach ($searchArticleName as $row) {
				echo '<a href="article.php?article=' . $row['articleName'] . '"><h2>' . $row['articleName'] . '</h2></a>';
				echo '<p> Date written: ' . $row['creationDate'] . '</p>';
				echo '<p> Written by: ' . $row['articleAuthor'] . '</p>';
				echo '<form>
				</form>';	
			} 
		}
		// checks the category radio button and pulls through articles if it has been selected.
		if (!isset($_POST['category']) || empty($_POST['category'])){
			
		}
		else if ($_POST['category'] == 'on') {
				$searchArticleCategory = $dbAccessObject->retrieveArticleByCategory($_POST['keyword']);
					if ($searchArticleCategory->rowCount () == 0) {
						echo '<p> No articles in this category. </p>';
					}
					foreach ($searchArticleCategory as $row) {
						echo '<a href="article.php?article=' . $row['articleName'] . '"><h2>' . $row['articleName'] . '</h2></a>';
						echo '<p> Date written: ' . $row['creationDate'] . '</p>';
						echo '<p> Written by: ' . $row['articleAuthor'] . '</p>';
						echo '<p> Category: ' . $row['categoryName'] . '</p>';
						echo '<form>
						</form>'; 	
					}
		}
		
		if (!isset($_POST['author']) || empty($_POST['author'])){
		
		}
		else if ($_POST['author'] == 'on') {
				$searchArticleAuthor = $dbAccessObject->retrieveArticleByAuthor($_POST['keyword']);
					if ($searchArticleAuthor->rowCount () == 0) {
						echo '<p> No articles by this author. </p>';
					}
					foreach ($searchArticleAuthor as $row) {
						echo '<a href="article.php?article=' . $row['articleName'] . '"><h2>' . $row['articleName'] . '</h2></a>';
						echo '<p> Date written: ' . $row['creationDate'] . '</p>';
						echo '<p> Written by: ' . $row['articleAuthor'] . '</p>';
						echo '<form>
						</form>'; 	
					}
		}
		// find users by name 
		if (!isset($_POST['user']) || empty($_POST['user'])){
		
		}
		else if ($_POST['user'] == 'on') {
				$searchUsers = $dbAccessObject->retrieveUserByName($_POST['keyword']);
					if ($searchUsers->rowCount () == 0) {
						echo '<p> No users by this name. </p>';
					}
					foreach ($searchUsers as $row) {
						echo '<a href="userComments.php?email=' . $row['Email'] . '"><h2>' . $row['FirstName'] . " " . $row['Surname'] . '</h2></a>';
						echo '<p> Email: ' . $row['Email'] . '</p>';
						echo '<form>
						</form>'; 	
					}
		}
		else {
			echo ' <p> please select a search criteria by using the radio buttons. </p>';
		}
	}
	else {
		echo '<p> need to enter a keyword in the search box. </p>';
	}
	
	// the below checks that the information has been entered. 
	function validateSearchFields($fields){
	// array for validating the fields if they are false or blank then the field isn't valid	
		$valid = [
			'isValid' => true,
			'invalidField' => ''
		];
		// checks the keyword has been entered.
		if(!isset($fields['keyword']) || empty($fields['keyword'])){
			$valid['isValid'] = false;
			$valid['invalidField'] = 'radio';
		}
		
		return $valid;
	}
?>		

			</article>
		</main>
<?php
	require 'footer.php';
?>