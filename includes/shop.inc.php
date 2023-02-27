<?php

if (isset($_POST["addtocart"])) {

  $bookid = $_POST["bookid"];
  $uid = $_POST["uid"];


  require_once "dbh.inc.php";
  require_once 'functions.inc.php';

  if (emptyCartorId($bookid, $uid) === true) {
    header("location: ../shop.php?error=emptyinput");
    echo $uid;
    echo $bookid;
    exit();
  }
  else{
    addToCart($conn, $bookid, $uid);
  }

} else {
	header("location: ../shop.php");
    exit();
}
