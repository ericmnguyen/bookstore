<!DOCTYPE html>
<html lang="en">

<body>
  <?php
  require('connect_db.php');
  $dbname = "db_22074118";
  mysqli_select_db($dbc, $dbname)
    or die(mysqli_connect_error());

  $searchValue = $_GET["searchValue"];
  $search_query = 'SELECT Book.bookId, Book.title, Author.authorName
  FROM Book
  JOIN Authorship ON Book.bookId = Authorship.bookId
  JOIN Author ON Author.authorId = Authorship.authorId
  WHERE Book.title LIKE "%' . $searchValue . '%" OR Author.authorName LIKE "%' . $searchValue . '%"';

  $searchResults = mysqli_query($dbc, $search_query);
  if (!$searchResults) {
    die(mysqli_connect_error());
  }

  mysqli_close($dbc);
  ?>
  <?php
  require('navbar.php');
  ?>
  <div class="content">
    <?php
    require('side-menu.php');
    ?>
  </div>
  <div class="main-page">
    <div class="search-container">
      <h2>Search results with "<?php echo $searchValue ?>"</h2>
      <div class="popular-books mb-3">
        <div class="book-group">
          <?php
          while ($row = mysqli_fetch_row($searchResults)) {
            // foreach ($row as $value) print("<br>$value");
            echo "<div class='book p-2'>
          <a href='book-details.php?bookId=" . $row[0] . "'>
          <img src='./public/images/$row[0].jpg' style='width:190px;height:250px;' class='card-img-top' alt='" . $row[0] . "'>
          </a>
          <div class='book-body'>
            <h5 class='book-title'>
              <a href='book-details.php?bookId=" . $row[0] . "'>" . $row[1] . "</a>
            </h5>
            <p class='book-author'>" . $row[2] . "</p>
          </div>
        </div>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</body>

</html>