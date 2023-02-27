<?php
  session_start();
  include_once 'includes/functions.inc.php';
  if (isset($_SESSION["adminid"])) {
      $yourid=$_SESSION["adminid"];
    }
    if (isset($_SESSION["userid"])) {
        echo '<h1 style="font-size:0.95em">Your user id is = '.$_SESSION['userid'] .'</h1>';
        $yourid=$_SESSION["userid"];
      }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Salih Eren Birincioğlu</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset12.css">
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <nav>
      <div class="wrapper">
        <a href="index.php"><img src="img/book-store.png" alt="Logo" width="300" height="75"></a>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="information.php">About Us</a></li>
          <?php
          if (isset($_SESSION["adminuid"])) {
            echo "<li><a href='shop.php'>Shop</a></li>";
            echo "<li><a href='edit.php'>Edit</a></li>";
            echo "<li><a href='logout.php'>Logout</a></li>";
          }
            else if (isset($_SESSION["useruid"])) {
              echo "<li><a href='shop.php'>Shop</a></li>";
              echo "<li><a href='cart.php'>Cart</a></li>";
              echo "<li><a href='logout.php'>Logout</a></li>";
            }
            else {
              echo "<li><a href='signup.php'>Sign up</a></li>";
              echo "<li><a href='login.php'>Log in</a></li>";
            }
          ?>
        </ul>
      </div>
    </nav>

<div class="wrapper">
