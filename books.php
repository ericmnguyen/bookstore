<!DOCTYPE html>
<html lang="en">

<body>
  <?php
  require('connect_db.php');
  $dbname = "db_22074118";
  mysqli_select_db($dbc, $dbname)
    or die(mysqli_connect_error());

  $books_query = 'SELECT DISTINCT Book.bookId, Book.title, Author.authorId, Author.authorName
  FROM Book
  JOIN Authorship ON Book.bookId = Authorship.bookId
  JOIN Author ON Author.authorId = Authorship.authorId
  JOIN BookCategory ON Book.bookId = BookCategory.bookId
  JOIN Category ON Category.cateId = BookCategory.cateId';

  $books = mysqli_query($dbc, $books_query);
  if (!$books) {
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
    <div class="book-container">
      <h2>List of Books</h2>
      <div class="book-table my-3">
        <table class="table">
          <thead class="table-light">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Book Cover</th>
              <th scope="col">Book Name</th>
              <th scope="col">Author</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($row = mysqli_fetch_row($books)) {
              // foreach ($row as $value) print("<br>$value");
              echo "<tr>
                <td><a href='./book-details.php?bookId=" . $row[0] . "'>" . $row[0] . "</a></td>
                <td><img src='./public/images/$row[0].jpg' class='card-img-top' style='width:190px;height:250px;' alt='" . $row[0] . "'></td>
                <td>" . $row[1] . "</td>
                <td><a href='./author.php?authorId=" . $row[2] . "'>" . $row[3] . "</a></td>
              </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>