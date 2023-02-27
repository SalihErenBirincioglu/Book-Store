<?php

if (isset($_POST["adddatabase"])) {

  $author = $_POST["author"];
  $title = $_POST["title"];
  $type = $_POST["type"];
  $year = $_POST["year"];

  require_once "dbh.inc.php";
  require_once 'functions.inc.php';

  if (emptyInputEdit($author, $title, $type, $year) !== false) {
    header("location: ../edit.php?error=emptyinput");
		exit();
  }

  addBook($conn, $author, $title, $type, $year);

} else {
	header("location: ../edit.php");
    exit();
}
