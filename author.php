<!DOCTYPE html>
<html lang="en">

<body>
  <?php
  require('connect_db.php');
  $dbname = "db_22074118";
  mysqli_select_db($dbc, $dbname)
    or die(mysqli_connect_error());

  $authorId = $_REQUEST['authorId'];
  $author_name_query = 'SELECT Author.authorName FROM Author WHERE Author.authorId = "' . $authorId . '"';
  $author_query = 'SELECT Book.bookId, Book.title, Author.authorId, Author.authorName
  FROM 
  Book JOIN Authorship ON Book.bookId = Authorship.bookId
  JOIN Author ON Author.authorId = Authorship.authorId
  WHERE Author.authorId = "' . $authorId . '"';

  $authorBooks = mysqli_query($dbc, $author_query);
  if (!$authorBooks) {
    die(mysqli_connect_error());
  }

  $authorName = mysqli_query($dbc, $author_name_query);
  if (!$authorName) {
    die(mysqli_connect_error());
  }

  mysqli_close($dbc);
  ?>
  <?php
  require('navbar.php');
  $name = mysqli_fetch_row($authorName);
  ?>
  <div class="content">
    <?php
    require('side-menu.php');
    ?>
  </div>
  <div class="main-page">
    <div class="author-container">
      <h2><?php echo $name[0] ?>'s books</h2>
      <div class="author mb-3">
        <div class="book-group">
          <?php
          while ($row = mysqli_fetch_row($authorBooks)) {
            // foreach ($row as $value) print("<br>$value");
            echo "<div class='book p-2'>
          <a href='./book-details.php?bookId=" . $row[0] . "'>
          <img src='./public/images/$row[0].jpg' style='width:190px;height:250px;' class='card-img-top' alt='" . $row[0] . "'>
          </a>
          <div class='book-body'>
            <h5 class='book-title'>
              <a href='./book-details.php?bookId=" . $row[0] . "'>" . $row[1] . "</a>
            </h5>
            <p class='book-author'>" . $row[3] . "</p>
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