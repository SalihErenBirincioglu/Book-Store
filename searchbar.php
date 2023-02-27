<?php
	include 'header.php';
  include_once "includes/dbh.inc.php";
?>
<section>
<h1>Search results</h1>

<div class="search-page">
  <?php
	if (isset($_POST['submit-search'])) {
		$search = mysqli_real_escape_string($conn, $_POST['search']);
		$sql = "SELECT * FROM books WHERE author LIKE '%$search%' OR title LIKE '%$search%' OR type LIKE '%$search%' OR year LIKE '%$search%'";
		$result = mysqli_query($conn, $sql);
		$queryResult = mysqli_num_rows($result);

		echo "<h1 style='font-size:1.25em'> There are ".$queryResult." books with this search criteria </h1> <br>";

		if ($queryResult > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo $row['author'] . " / " .$row['title'] . " / " . $row['type'] . " / " . $row['year']. "<br>";
			}
		} else {
			echo "We dont have the book you are searching for";
		}

    echo "<li class=nav><a href='shop.php'> Return to Shop</a></li>";
	}
?>
</div>
</section>
<?php
  include_once 'footer.php';
?>
