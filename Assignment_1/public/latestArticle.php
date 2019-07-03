<?php
	require 'header.php';
?>
<main>
<?php
	require 'leftColumn.php';
?>
			<article>
				<h2>Latest Articles</h2>
				<form>
				</form>
<?php
// retrieve the articles in descending order.
	$articles = $dbAccessObject->retrieveLatestArticle();
	foreach ($articles as $row){
		
		echo '<a href="article.php?article=' . $row['articleName'] . '"><h2>' . $row['articleName'] . '</h2></a> <p> Written by: ' . $row['articleAuthor'] . '</p> <p> Created: ' . $row['creationDate'] . '</p>';
		echo '<form>';
		echo '</form>';
	} 
?>

			</article>
		</main>
<?php
	require 'footer.php';
?>