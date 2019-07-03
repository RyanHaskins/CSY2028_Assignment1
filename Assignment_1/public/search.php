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
	echo ' <p> Only select one of the radio buttons depending on what search you wish to carry out. </p>';
	echo ' <form action="searchResult.php" method="POST">
					<label>get article by title:</label> <input type="radio" name="article" />
					<label>get article by category:</label> <input type="radio" name="category" />
					<label>get article by author name:</label> <input type="radio" name="author" />
					<label>get user by first name:</label> <input type="radio" name="user" />
					<label>Search:</label> <input type="text" name="keyword" />
					<input type="submit" name="submit" value="Submit" />
			</form>';
	
	
?>		

			</article>
		</main>
<?php
	require 'footer.php';
?>