<?php
	class DbAccessObject{
	// declaring the private variables for this class.	
		private $server;
		private $username;
		private $password;
		private $schema;
		private $pdo;
	// function to connect to the database. construct allows you to intialise your properties. basically give them values. 
		public function __construct($server, $username, $password, $schema){
			$this->server = $server;
			$this->username = $username;
			$this->password = $password;
			$this->pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password,
			[ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
		}
	// allows you to get the server. 
		public function getServer(){
			return $this->server;
		}
	// allows you to get the username.	
		public function getUsername(){
			return $this->username;
		}
	// allows you to get the password.
		public function getPassword(){
			return $this->password;
		}
	// allows you to get the schema.	
		public function getSchema(){
			return $this->schema;
		}
	// allows you to get the Pdo.	
		public function getPdo(){
			return $this->pdo;
		}
	// alows you to set the server.	
		public function setServer($server){
			$this->server = $server;
		}
	// allows you to set the username.	
		public function setUsername($username){
			$this->username = $username;
		}
	// allows you to set the password.	
		public function setPassword($password){
			$this->password = $password;
		}
	// allows you to set the schema.	
		public function setSchema($schema){
			$this->schema = $schema;
		}
	// allows you to set the pdo.	
		public function setPdo(){
			$this->pdo = $pdo;
		}
	// function to retrieve a users email address. 
		public function getUsersByEmail($email){
			
			$query = $this->pdo->prepare('
			SELECT Email 
			FROM Users 
			WHERE Email = :email');
		
			$criteria = ['email' => $email];
	// executes and stores the results from the database for the above query this variable is then returned.				
			$query->execute($criteria);
			
			return $query;

		}
		
	// function for inserting the user information into the database.
		public function insertUser($criteria){
			
			$query = $this->pdo->prepare('
				INSERT INTO Users(FirstName, Surname, DOB, Email, Password) 
				VALUES (:FirstName, :Surname, :DOB, :Email, :Password)');
			// this will return whether the query has run or not this is true or false.	
			return $query->execute($criteria);
			
		}
	// pulls through the users password.	
		public function usersPass($pass){
			
			$query = $this->pdo->prepare('
				SELECT Password
				FROM Users
				WHERE Password = :pass');
				
			$criteria = ['pass' => $pass];
			
			$query->execute($criteria);
		
	// below returns the results of the query.		
			return $query;
		}
	// pulls through the first name off a user. 	
		public function fetchFirstName($email){
			
			$query = $this->pdo->prepare('
				SELECT FirstName 
				FROM Users 
				WHERE Email = :email');
		
			$criteria = ['email' => $email];
			
	// executes and stores the results from the database for the above query this variable is then returned.				
			$query->execute($criteria);
			$row = $query->fetch();
			return $row['FirstName'];

		}
	// this pulls through the surname of a user.	
		public function fetchSurname($email){
			
			$query = $this->pdo->prepare('
				SELECT Surname 
				FROM Users 
				WHERE Email = :email');
		
			$criteria = ['email' => $email];
			
	// executes and stores the results from the database for the above query this variable is then returned.				
			
			$query->execute($criteria);
			$row = $query->fetch();
			return $row['Surname'];

		}
	// pulls through the categories that is stored in the database.
		public function retrieveCategories(){
			
			$query = $this->pdo->query('
				SELECT categoryName
				FROM categories');

			return $query;
			
		}
	//this adds a category to the database.	
		public function addCategory($categoryName){
			
			$query = $this->pdo->prepare('
				INSERT INTO categories(categoryName)
				VALUES (:Name)');
			
			$criteria = ['Name' => $categoryName];
			
			return $query->execute($criteria);
			
		}
	// pulls through the categories to check if it is already there or not.	
		public function checkAddCategory($categoryName){
			
			$query = $this->pdo->prepare('
				SELECT categoryName
				FROM categories
				WHERE categoryName = :Name');
			
			$criteria = ['Name' => $categoryName];
			
			$query->execute($criteria);
			
			return $query;
			
		}
	// pulls through the categories inorder to check the category is already there or not.	
		public function checkDeleteCategory($categoryName){
			
			$query = $this->pdo->prepare('
				SELECT categoryName
				FROM categories
				WHERE categoryName = :Name');
			
			$criteria = ['Name' => $categoryName];
			
			$query->execute($criteria);
			
			return $query;
			
		}
		
	// this deletes a category out of the database.	
		public function deleteCategory($categoryName){
			
			$query = $this->pdo->prepare('
				DELETE FROM categories
				WHERE categoryName = :Name');
			
			$criteria = ['Name' => $categoryName];
		// the below returns true or false depending on whether it has worked or not. 	
			return $query->execute($criteria);	
		}
	// pulls through the categories to see if its in the database.	
		public function checkEditCategory($categoryName){
			
			$query = $this->pdo->prepare('
				SELECT categoryName
				FROM categories
				WHERE categoryName = :Name');
			
			$criteria = ['Name' => $categoryName];
			
			$query->execute($criteria);
			
			return $query;
			
		}
	// this updates the categories. 	
		public function updateCategory($categoryName,$nameReplace){
			
			$query = $this->pdo->prepare('
				UPDATE categories
				SET categoryName = :newName
				WHERE categoryName = :Name');
			
			$criteria = ['Name' => $categoryName,
						'newName' =>$nameReplace];
		// the below returns true or false depending on whether it has worked or not. 	
			return $query->execute($criteria);	
		}
	// this allows you to add an article.	
		public function addArticle($criteria){

			$query = $this->pdo->prepare('
				INSERT INTO articles (articleName, articleAuthor, creationDate, categoryName, articleContent)
				VALUES (:articleName, :articleAuthor, :creationDate, :categoryName, :articleContent)');
			
			return $query->execute($criteria);
		}
	// this checks the article name.	
		public function checkArticleName($articleName){
			
			$query = $this->pdo->prepare('
				SELECT articleName
				FROM articles
				WHERE articleName = :Name');
			
			$criteria = ['Name' => $articleName];
			
			$query->execute($criteria);
			
			return $query;
			
		}
	// this checks to see if the article is their same as above. 	
		public function checkDeleteArticle($articleName){
			
			$query = $this->pdo->prepare('
				SELECT articleName
				FROM articles
				WHERE articleName = :Name');
			
			$criteria = ['Name' => $articleName];
			
			$query->execute($criteria);
			
			return $query;
		}
	// this lets us delete an article.	
		public function deleteArticle($articleName){
			
			$query = $this->pdo->prepare('
				DELETE FROM articles
				WHERE articleName = :Name');
			
			$criteria = ['Name' => $articleName];
			
			return $query->execute($criteria);
		}
	// checks the name of an article this can be changed as its a duplicate.	
		public function checkEditArticle($articleName){
			
			$query = $this->pdo->prepare('
				SELECT articleName
				FROM articles
				WHERE articleName = :Name');
			
			$criteria = ['Name' => $articleName];
			
			$query->execute($criteria);
			
			return $query;
		}
	// this updates the article name. 	
		public function editArticleName($articleName, $newArticleName){
			
			$query = $this->pdo->prepare('
				UPDATE articles
				SET articleName = :newName
				WHERE articleName = :Name');
			
			$criteria = ['Name' => $articleName,
						'newName' =>$newArticleName];
		// the below returns true or false depending on whether it has worked or not. 	
			return $query->execute($criteria);	
		}
	// this updates the author name.	
		public function editArticleAuthor($articleName, $newArticleAuthor){
			
			$query = $this->pdo->prepare('
				UPDATE articles
				SET articleAuthor = :newAuthor
				WHERE articleName = :Name');
			
			$criteria = ['Name' => $articleName,
						'newAuthor' =>$newArticleAuthor];
		
		// the below returns true or false depending on whether it has worked or not. 	
			return $query->execute($criteria);	
		}
	// this updates the article category. 	
		public function editArticleCategory($articleName, $newArticleCategory){
			
			$query = $this->pdo->prepare('
				UPDATE articles
				SET categoryName = :newCategory
				WHERE articleName = :Name');
			
			$criteria = ['Name' => $articleName,
						'newCategory' =>$newArticleCategory];
		// the below returns true or false depending on whether it has worked or not. 	
			return $query->execute($criteria);	
		}
	// this pulls through all info of an article.	
		public function retrieveArticles($category){
			
			$query = $this->pdo->prepare('
				SELECT *
				FROM articles
				WHERE categoryName = :category
				ORDER BY creationDate DESC');
				
			$criteria = ['category' => $category];
			
			$query->execute($criteria);
			
			return $query;
			
		}
	//  pulls through all ifo on an aticle by descending order. 	
		public function retrieveArticle($articleName){
			
			$query = $this->pdo->prepare('
				SELECT *
				FROM articles
				WHERE articleName = :articleName
				ORDER BY creationDate DESC');
				
			$criteria = ['articleName' => $articleName];
			
			$query->execute($criteria);
			
			return $query;
			
		}

	// same as above but doesn't prepare the query or take the criteria.	
		public function retrieveLatestArticle(){
			
			$query = $this->pdo->query('
				SELECT *
				FROM articles
				ORDER BY creationDate DESC');
			
			return $query;
			
		}
	// pulls comments through and all there information. 	
		public function retrieveArticleComments($articleName) {
			
			$query = $this->pdo->prepare('
				SELECT *
				FROM comment
				WHERE articleName = :articleName
				AND authorised = :authorised
				');
			
			$criteria = ['articleName' => $articleName,
						'authorised' => 'Y'];
			
			$query->execute($criteria);
			
			return $query;
		}
	// 	adds a comment to the database.
		public function addComment($criteria){

			$query = $this->pdo->prepare('
				INSERT INTO comment (commentId, firstName, surname, articleName, commentDate, commentContent, authorised, email)
				VALUES (:commentId, :firstName, :surname, :articleName, :commentDate, :commentContent, :authorised, :email)');
						 
			return $query->execute($criteria);
		} 
	// pulls through comment ID in descending order. 	
		public function getCommentId(){
			
			$query = $this->pdo->query('
				SELECT commentId
				FROM comment
				ORDER BY commentId DESC');
			
			$row = $query->fetch();
			return $row['commentId'];
		}
	// updates article content. 	
		Public function editArticleContent($articleContent, $articleName){
			
			$query = $this->pdo->prepare('
				UPDATE articles
				SET articleContent = :newContent
				WHERE articleName = :Name');
				
			$criteria = ['Name' => $articleName,
						'newContent' => $articleContent];
			
			$query->execute($criteria);
			
			
			return $query;
		}
		
	// this will pull through comments that need authoriseing.
			public function unauthorisedComments(){
			
			$query = $this->pdo->prepare('
				SELECT *
				FROM comment
				WHERE authorised = :authorised');
				
			$criteria = ['authorised' => 'N'];
			
			$query->execute($criteria);

			return $query;
			
		}
	// deleting a comment.
		public function deleteComment($commentId){
			
			$query = $this->pdo->prepare('
				DELETE FROM comment
				WHERE commentId = :commentId');
			
			$criteria = ['commentId' => $commentId];
			
			return $query->execute($criteria);
		}
	// authorise a comment by changing the authorised column of a comment.
		public function updateAuthorisedComment($commentId){
			
			$query = $this->pdo->prepare('
				UPDATE comment
				SET authorised = :authorised
				WHERE commentId = :commentId');
				
			$criteria = ['commentId' => $commentId,
						'authorised' => 'Y'];
			
			$query->execute($criteria);
			
			
			return $query;
			
		}
	// update a users first name in the database. 
		Public function updateUserFirstName(){
			
			$query = $this->pdo->prepare('
				UPDATE Users
				SET firstName = :Name
				WHERE email = :email');
				
			$criteria = ['Name' => $_POST['firstName'],
						'email' => $_POST['email']];
			
			return	$query->execute($criteria);		 
		}
	// update a users surname in the database. 
		public function updateUserSurname(){
			
			$query = $this->pdo->prepare('
				UPDATE Users
				SET Surname = :Name
				WHERE email = :email');
				
			$criteria = ['Name' => $_POST['surname'],
						'email' => $_POST['email']];
			
			return	$query->execute($criteria);	
		}
	// update a users DoB in the database. 
		public function updateUserDob(){
			
			$query = $this->pdo->prepare('
				UPDATE Users
				SET DOB = :Date
				WHERE email = :email');
				
			$criteria = ['Date' => $_POST['dob'],
						'email' => $_POST['email']];
			
			return	$query->execute($criteria);	
		}
	// update a users email in the database. 
		public function updateUserEmail(){
			
			$query = $this->pdo->prepare('
				UPDATE Users
				SET Email = :newEmail
				WHERE email = :email');
				
			$criteria = ['newEmail' => $_POST['newEmail'],
						'email' => $_POST['email']];
			
			return	$query->execute($criteria);	
		}
	// update a users password in the database. 
		public function updateUserPassword(){
			
			$query = $this->pdo->prepare('
				UPDATE Users
				SET Password = :password
				WHERE email = :email');
				
			$criteria = ['password' => sha1($_POST['email'] . $_POST['password']),
						'email' => $_POST['email']];
			
			return	$query->execute($criteria);	
		}
	
	// deleting a user.
		public function deleteUser(){
			
			$query = $this->pdo->prepare('
				DELETE FROM Users
				WHERE email = :email');
			
			$criteria = ['email' => $_POST['email']];
			
			return $query->execute($criteria);
		}
	
	// pulls article through by category
		public function retrieveArticleByCategory($category){
		
			$query = $this->pdo->prepare('
				SELECT *
				FROM articles
				WHERE categoryName = :category
				ORDER BY creationDate DESC');
				
			$criteria = ['category' => $category];
			
			$query->execute($criteria);
			
			return $query;	
		}
	// pulls article through by author.
		public function retrieveArticleByAuthor($name){
		
			$query = $this->pdo->prepare('
				SELECT *
				FROM articles
				WHERE articleAuthor = :name
				ORDER BY creationDate DESC');
				
			$criteria = ['name' => $name];
			
			$query->execute($criteria);
			
			return $query;	
		}
	// pulls article through by author.
		public function retrieveUserByName($name){
		
			$query = $this->pdo->prepare('
				SELECT *
				FROM Users
				WHERE FirstName = :name
				');
				
			$criteria = ['name' => $name];
			
			$query->execute($criteria);
			
			return $query;	
		}
	// pulls user details through via email.
		public function retrieveUserByEmail($email){
		
			$query = $this->pdo->prepare('
				SELECT *
				FROM Users
				WHERE Email = :email
				');
				
			$criteria = ['email' => $email];
			
			$query->execute($criteria);
			
			return $query;	
		}
	// pulls comments through for a user.
		public function retrieveUserComments($email){
		
			$query = $this->pdo->prepare('
				SELECT *
				FROM comment
				WHERE Email = :email
				');
				
			$criteria = ['email' => $email];
			
			$query->execute($criteria);
			
			return $query;	
		}
	}	