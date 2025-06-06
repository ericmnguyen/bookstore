<!DOCTYPE html>
<html lang="en">

<body>
  <?php
  require('connect_db.php');
  $dbname = "db_22074118";
  mysqli_select_db($dbc, $dbname)
    or die(mysqli_connect_error());

  $popular_query = 'SELECT Book.bookId, Book.title, Author.authorName, Category.CategoryName
FROM 
Book JOIN Authorship ON Book.bookId = Authorship.bookId
JOIN Author ON Author.authorId = Authorship.authorId
JOIN BookCategory ON Book.bookId = BookCategory.bookId
JOIN Category ON BookCategory.cateId = Category.cateId
WHERE categoryName = "Popular"';

  $new_release_query = 'SELECT Book.bookId, Book.title, Author.authorName, Category.CategoryName
  FROM 
  Book JOIN Authorship ON Book.bookId = Authorship.bookId
  JOIN Author ON Author.authorId = Authorship.authorId
  JOIN BookCategory ON Book.bookId = BookCategory.bookId
  JOIN Category ON BookCategory.cateId = Category.cateId
  WHERE categoryName = "New Release"';

  $other_query = 'SELECT Book.bookId, Book.title, Author.authorName, Category.CategoryName
  FROM 
  Book JOIN Authorship ON Book.bookId = Authorship.bookId
  JOIN Author ON Author.authorId = Authorship.authorId
  JOIN BookCategory ON Book.bookId = BookCategory.bookId
  JOIN Category ON BookCategory.cateId = Category.cateId
  WHERE categoryName = "Other"';

  $popularBooks = mysqli_query($dbc, $popular_query);
  if (!$popularBooks) {
    die(mysqli_connect_error());
  }
  $newReleaseBooks = mysqli_query($dbc, $new_release_query);
  if (!$newReleaseBooks) {
    die(mysqli_connect_error());
  }
  $otherBooks = mysqli_query($dbc, $other_query);
  if (!$otherBooks) {
    die(mysqli_connect_error());
  }

  mysqli_close($dbc);

  // while ($row = mysqli_fetch_row($result)) {
  //   foreach ($row as $value) print("<br>$value");
  //   print "<hr align=left style='margin-bottom:-
  //   10px;width:10%'>";
  // }
  ?>
  <?php
  require('navbar.php');
  ?>
  <div class="content">
    <?php
    require('side-menu.php');
    ?>
    <div class="main-page">
      <div class="popular-book-container">
        <h2>Popular books</h2>
        <div class="popular-books mb-3">
          <div class="book-group">
            <?php
            while ($row = mysqli_fetch_row($popularBooks)) {
              // foreach ($row as $value) print("<br>$value");
              echo "<div class='book p-2'>
          <a href='book-details.php?bookId=".$row[0]."'>
          <img src='./public/images/$row[0].jpg' style='width:190px;height:250px;' class='card-img-top' alt='" . $row[0] . "'>
          </a>
          <div class='book-body'>
            <h5 class='book-title'>
              <a href='book-details.php?bookId=".$row[0]."'>" . $row[1] . "</a>
            </h5>
            <p class='book-author'>" . $row[2] . "</p>
          </div>
        </div>";
            }
            ?>
          </div>
        </div>
      </div>
      <div class="new-release-container">
        <h2>New releases</h2>
        <div class="new-releases mb-3">
          <div class="book-group overflow-x-auto d-flex flex-nowrap">
            <?php
            while ($row = mysqli_fetch_row($newReleaseBooks)) {
              // foreach ($row as $value) print("<br>$value");
              echo "<div class='book p-2'>
              <a href='book-details.php?bookId=".$row[0]."'>
                <img src='./public/images/$row[0].jpg' style='width:190px;height:250px;' class='card-img-top' alt='" . $row[0] . "'>
              </a>
          <div class='book-body'>
            <h5 class='book-title'>
              <a href='book-details.php?bookId=".$row[0]."'>" . $row[1] . "</a>
            </h5>
            <p class='book-author'>" . $row[2] . "</p>
          </div>
        </div>";
            }
            ?>
          </div>
        </div>
      </div>
      <div class="suggested-books-container">
        <h2>Other books that you might like</h2>
        <div class="new-releases mb-3">
          <div class="book-group overflow-x-auto d-flex flex-nowrap">
            <?php
            while ($row = mysqli_fetch_row($otherBooks)) {
              // foreach ($row as $value) print("<br>$value");
              echo "<div class='book p-2'>
              <a href='book-details.php?bookId=".$row[0]."'>
                <img src='./public/images/$row[0].jpg' style='width:190px;height:250px;' class='card-img-top' alt='" . $row[0] . "'>
              </a>
          <div class='book-body'>
            <h5 class='book-title'>
              <a href='book-details.php?bookId=".$row[0]."'>" . $row[1] . "</a>
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
  </div>
</body>

</html>