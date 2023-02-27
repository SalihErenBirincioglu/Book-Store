<?php

if (isset($_POST["deletedatabase"])) {

  $author = $_POST["author"];
  $title = $_POST["title"];

  require_once "dbh.inc.php";
  require_once 'functions.inc.php';


  if (emptyInputEditDelete($author, $title) !== false) {
    header("location: ../edit.php?error=emptyinput");
		exit();
  }

  deleteBook($conn, $author, $title);

} else {
	header("location: ../edit.php");
    exit();
}
