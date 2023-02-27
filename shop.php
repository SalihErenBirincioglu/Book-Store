<?php
  include_once 'header.php';
  include_once "includes/dbh.inc.php";
  ?>


  <section class="shop-form" >
    <h2>Shop</h2>
    <div class="shop-form-form">

      <form action="searchbar.php" method="POST">
	     <input type="text" name="search" placeholder="Search">
	      <button type="submit" name="submit-search">Search</button>
          </form>
            <?php

        $sql = "SELECT * FROM books;";
        $result = mysqli_query($conn, $sql);

        $resultCheck = mysqli_num_rows($result);
        echo '<p style="font-size=0.25em"> AUTHOR NAME / TITLE  / TYPE / YEAR / ID </p>';
        if ($resultCheck > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo $row['author'] . " / " .$row['title'] . " / " . $row['type'] . " / " . $row['year']. " / " . $row['id']."<br>";
          }
        }
      ?>
      <br>
    <h3 style="text-align: center; color:#FF0000">Enter the books you want to add to cart </h3>
    <div class="signup-form-form">
      <form action="includes/shop.inc.php" method="post">
        <input type="text" name="uid" placeholder="Enter your user id">
        <input type="text" name="bookid" placeholder="Enter the book id you want to add to cart">
        <button type="submit" name="addtocart">Add to cart</button>
      </form>
          </div>
          <?php
            // Error messages
            if (isset($_GET["error"])) {
              if ($_GET["error"] == "emptyinput") {
                echo '<p>Empty Cart</p>';
              }
            }
          ?>

      </section>
<?php
  include_once 'footer.php';
?>
