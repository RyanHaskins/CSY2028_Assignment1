<?php
	require 'header.php';
?>
<main>
<?php
	require 'leftColumn.php';
?>
			<article>
<?php
		if ($_GET['category'] == 'category'){
			$categories = $dbAccessObject-> retrieveCategories();
			foreach ($categories as $row){
				echo '<a href="articleCategory.php?category=' . $row['categoryName'] . '"><h4>' . $row['categoryName'] . '</h4>';
				echo '<form>';
				echo '</form>';
			}
		}
		else{
		// uses the retrive article function inorder to grab the categories. 
			$articles = $dbAccessObject->retrieveArticles($_GET['category']);
		// displays the results using a loop. This will show a list of all the categories that are available. 
			if ($articles ->rowCount() == 0) {
				echo '<p> Unfortunately there is no articles for this category. </p>';
			}
			else {
				foreach ($articles as $row){
					echo '<a href="article.php?article=' . $row['articleName'] . '"><h2>' . $row['articleName'] . '</h2></a> <p> Written by: ' . $row['articleAuthor'] . '</p> <p> Created: ' . $row['creationDate'] . '</p>';
					echo '<form>';
					echo '</form>';
				}
			}
		}	
				
							
					
?>		

			</article>
		</main>
<?php
	require 'footer.php';
?>