<?php
  include_once 'header.php';
  include_once "includes/dbh.inc.php";
  ?>

  <section class="shop-form" >
    <h2>CART OF THE USERS</h2>
    <div class="shop-form-form">
      <?php
      $sql = "SELECT * FROM books RIGHT OUTER JOIN cart
              on books.id = cart.book_id;";

        $result = mysqli_query($conn, $sql);

        $resultCheck = mysqli_num_rows($result);
        echo '<p style="font-size=0.25em"> AUTHOR NAME / TITLE  / TYPE / YEAR / USER ID / BOOK ID</p>';
        if ($resultCheck > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo $row['author'] . " / " .$row['title'] . " / " . $row['type'] . " / " . $row['year']. " / " . $row['user_id']. " / " . $row['book_id']."<br>";
          }
        }
      ?>
      <br>
      <h2>EDIT DATABASE</h2>
    <h3 style="text-align: center; color:#FF0000">Write the values of the book to add to database </h3>
    <div class="signup-form-form">
      <form action="includes/edit.inc.php" method="post">
        <input type="text" name="author" placeholder="Enter the author name">
        <input type="text" name="title" placeholder="Enter the book title">
        <input type="text" name="type" placeholder="Enter the book type">
        <input type="text" name="year" placeholder="Enter the book publish year">
        <button type="submit" name="adddatabase">Add to database</button>
      </form>
          </div>
          <?php
            if (isset($_GET["error"])) {
              if ($_GET["error"] == "emptyinput") {
                echo "<p>Empty Input</p>";
              }
            }
            if (isset($_GET["error"])) {
              if ($_GET["error"] == "alreadyExists") {
                echo "<p> This book already exists</p>";
              }
            }
          ?>
          <h3 style="text-align: center; color:#FF0000">Write the values of the book to delete from database </h3>
          <div class="signup-form-form">
            <form action="includes/edit2.inc.php" method="post">
              <input type="text" name="author" placeholder="Enter the author name">
              <input type="text" name="title" placeholder="Enter the book title">
              <button type="submit" name="deletedatabase">Delete from database</button>
            </form>
                </div>

      </section>
<?php
  include_once 'footer.php';
?>
