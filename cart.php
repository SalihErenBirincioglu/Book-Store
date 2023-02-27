<?php
  include_once 'header.php';
  include_once "includes/dbh.inc.php";
  ?>

  <section class="shop-form" >
    <h2>Your Cart</h2>
    <div class="shop-form-form">
      <?php
        $sql = "SELECT * FROM books
          INNER JOIN cart
              ON books.id=cart.book_id WHERE user_id=$yourid;";

        $result = mysqli_query($conn, $sql);

        $resultCheck = mysqli_num_rows($result);
        echo '<p style="font-size=0.25em"> AUTHOR NAME / TITLE  / TYPE / YEAR / BOOK ID </p>';
        if ($resultCheck > 0) {
          
          while ($row = mysqli_fetch_assoc($result)) {
            echo $row['author'] . " / " .$row['title'] . " / " . $row['type'] . " / " . $row['year']. " / " . $row['book_id']."<br>";
          }
        }
      ?>
      <br>
      </section>
<?php
  include_once 'footer.php';
?>
