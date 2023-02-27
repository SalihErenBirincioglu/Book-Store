<?php

// Check for empty input signup
function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) {
	$result;
	if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function emptyInputEdit($author, $title, $type, $year) {
	$result;
	if (empty($author) || empty($title) || empty($type) || empty($year)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function emptyInputEditDelete($author, $title) {
	$result;
	if (empty($author) || empty($title)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function bookExists($conn, $author, $title) {
  $sql = "SELECT * FROM books WHERE author = ? AND title = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../edit.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "ss", $author, $title);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}
	else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

	function addBook($conn, $author, $title, $type, $year) {
		$bookExists = bookExists($conn, $author,$title);

		if ($bookExists === false) {
	  $sql = "INSERT INTO books (author, title, type, year) VALUES (?, ?, ?, ?);";

		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
		 	header("location: ../edit.php?error=stmtfailed");
			exit();
		}

	mysqli_stmt_bind_param($stmt, "ssss", $author, $title, $type, $year);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../edit.php?error=none");
	exit();
	}
	else{
		header("location: ../edit.php?error=alreadyExists");
		exit();
}
}
function deleteBook($conn, $author, $title) {
	$bookExists = bookExists($conn, $author,$title);

	if ($bookExists === false) {
		header("location: ../edit.php?error=bookDoesntExists");
		exit();
	}
	else{
	$sql = "DELETE FROM books WHERE author= ? AND title= ?;";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../edit.php?error=stmtfailed");
		exit();
	}

mysqli_stmt_bind_param($stmt, "ss", $author, $title);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($conn);
header("location: ../edit.php?error=none");
exit();
}
}

// Check invalid username
function invalidUid($username) {
	$result;
	if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check invalid email
function invalidEmail($email) {
	$result;
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check if passwords matches
function pwdMatch($pwd, $pwdrepeat) {
	$result;
	if ($pwd !== $pwdrepeat) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

// Check if username is in database, if so then return data
function uidExists($conn, $username) {
  $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../signup.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "ss", $username, $username);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}
	else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}

// Insert new user into database
function createUser($conn, $name, $email, $username, $pwd) {
  $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../signup.php?error=stmtfailed");
		exit();
	}

	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

	mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../signup.php?error=none");
	exit();
}

// Check for empty input login
function emptyInputLogin($username, $pwd) {
	$result;
	if (empty($username) || empty($pwd)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function emptyCartorId($bookid, $uid) {
	$result;
	if (empty($bookid) || empty($uid)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function addToCart($conn ,$bookid, $uid) {

  $newsql = "INSERT INTO cart ( user_id, book_id) VALUES (?, ?);";

	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $newsql)) {
	 	header("location: ../shop.php?error=sqlfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "ss",$uid, $bookid);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	header("location: ../shop.php?error=none");
	exit();
}


// Log user into website
function loginUser($conn, $username, $pwd) {
	$uidExists = uidExists($conn, $username);

	if ($uidExists === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	}

	$pwdHashed = $uidExists["usersPwd"];
	$checkPwd = password_verify($pwd, $pwdHashed);

	if ($checkPwd === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	}
	elseif ($checkPwd === true) {
		session_start();
		$_SESSION["userid"] = $uidExists["usersId"];
		$_SESSION["useruid"] = $uidExists["usersUid"];
		header("location: ../index.php?error=none");
		exit();
	}
}
function adminCheck($conn, $username, $pwd) {
	$sql = "SELECT usersPwd FROM users WHERE usersId = 1;";

	$uidExists = uidExists($conn, $username);

	if ($uidExists === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	}

	$pwdHashed = $uidExists["usersPwd"];
	$checkPwd = password_verify($pwd, $pwdHashed);

	if ($checkPwd === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	}
	elseif ($checkPwd === true) {

		session_start();
		$_SESSION["adminid"] = $uidExists["usersId"];
		$_SESSION["adminuid"] = $uidExists["usersUid"];
		header("location: ../index.php?error=none");
		exit();
	}
}
