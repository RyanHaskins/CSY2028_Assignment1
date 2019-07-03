<?php
// sorts out the left column which is the toolbox for editing the articles.
	if (!$_SESSION['loggedIn']){
		echo'<nav>
				<ul>
					<li><a href="search.php">Search feature</a></li>
					<li><a href="signUp.php">Sign up</a></li>
					<li><a href="logIn.php">Log in</a></li>
				</ul>
			</nav>';
	}
	else {
		echo'<nav>
				<ul>
					<li><a href="search.php">Search feature</a></li>
					<li><a href="comment.php">Authorise Comments.</a></li>
					<li><a href="addArticle.php">Add a new article.</a></li>
					<li><a href="categories.php">Edit the categories.</a></li>
					<li><a href="editArticle.php?edit=editArticleContent">Edit an article\'s content.</a></li>
					<li><a href="editArticle.php?edit=editArticleName">Edit an article\'s name.</a></li>
					<li><a href="editArticle.php?edit=editArticleAuthor">Edit an article\'s author.</a></li>
					<li><a href="editArticle.php?edit=editArticleCategory">Edit an article\'s category.</a></li>
					<li><a href="editArticle.php?edit=delete">delete an article.</a></li>
					<li><a href="users.php">Edit users.</a></li>
					<li><a href="logOutPage.php">Log Out.</a></li>
				</ul>
			</nav>';
	}
?>