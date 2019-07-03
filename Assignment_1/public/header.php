<?php
	// this is to run session start on all the pages. 
	session_start();
	// this checks to see if someone is logged in or not.
	if(!isset($_SESSION['loggedIn'])){
		$_SESSION['loggedIn'] = false;
	}
	// this connects to the database. 
	require 'dbAccessObject.php';
	// sets the variables for connecting with the database. 
	$server = 'v.je';
	$username = 'student';
	$password = 'student';
	$schema = 'Northampton_News';
	// connects to the database function and passes it the variables. 
	$dbAccessObject = new DbAccessObject($server, $username, $password, $schema);
	$pdo = $dbAccessObject->getPdo();
	// this pulls through the categories. 
	$Categories = $dbAccessObject->retrieveCategories();
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles.css"/>
		<title>Northampton News - Home</title>
	</head>
	<body>
		<header>
			<section>
					<h1>Northampton News</h1>
			</section>
		</header>
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="latestArticle.php">Articles</a></li>
				<li><a href="articleCategory.php?category=category">Categories</a>
				<ul>
<?php
// this pulls the categories through. 
	foreach ($Categories as $row){
			echo '<li><a href="articleCategory.php?category=' . $row['categoryName'] . '">' . $row['categoryName'] . '</a></li>';
		
	} 

?>
				</ul>
				</li>
				<li><a href="contact.php">Contact us</a></li>
			</ul>
		</nav>
		<img src="images/banners/randombanner.php" />
		