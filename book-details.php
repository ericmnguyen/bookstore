<!DOCTYPE html>
<html lang="en">

<head>
  <script>
    function validateForm() {
      let ratingSelectValue = document.forms["add-review"]["ratingSelect"].value;
      if (ratingSelectValue == "") {
        const el = document.getElementById("ratings-required");
        el.style = 'display: inline; color: red;';
        return false;
      }
      return true;
    }

    function onChangeSelect() {
      const el = document.getElementById("ratings-required");
      el.style = 'display: none';
    }

    function handleSubmit() {

    }
  </script>
</head>

<body>
  <?php
  session_start();
  require('connect_db.php');
  $dbname = "db_22074118";
  mysqli_select_db($dbc, $dbname)
    or die(mysqli_connect_error());

  $reviewerNameText = $_POST["reviewerNameText"];
  $ratingSelect = $_POST["ratingSelect"];
  $bookId = $_REQUEST['bookId'];

  if ($reviewerNameText && $ratingSelect && $_POST['randcheck'] == $_SESSION['rand']) {
    $review_query = "INSERT INTO Reviewer(reviewerName) VALUES ('$reviewerNameText')";
    $new_review = mysqli_query($dbc, $review_query);
    if (!$new_review) {
      die(mysqli_connect_error());
    }

    // Get the added name to add rating and date
    $get_added_record_query = "SELECT reviewerId from Reviewer where reviewerId=LAST_INSERT_ID()";
    $reviewerIdData = mysqli_query($dbc, $get_added_record_query);
    if (!$reviewerIdData) {
      die(mysqli_connect_error());
    }
    $reviewerId = mysqli_fetch_row($reviewerIdData);

    // add rating
    $rating_query = "INSERT INTO Report(bookId, reviewerId, rating) VALUES ('" . $bookId . "', '$reviewerId[0]', '$ratingSelect')";
    $ratingData = mysqli_query($dbc, $rating_query);
    if (!$ratingData) {
      die(mysqli_connect_error());
    }
  }

  $book_details_query = 'SELECT Book.bookId, Book.title, Author.authorId, Author.authorName
  FROM Book
  JOIN Authorship ON Book.bookId = Authorship.bookId
  JOIN Author ON Author.authorId = Authorship.authorId
  WHERE Book.bookId = "' . $bookId . '"';

  $categories_query = 'SELECT Category.cateId, Category.categoryName
  FROM Category
  JOIN BookCategory ON Category.cateId = BookCategory.cateId
  JOIN Book ON BookCategory.bookId = Book.bookId
  WHERE Book.bookId = "' . $bookId . '"';

  $reviews_query = 'SELECT Report.rating, Reviewer.reviewerName, Report.reviewDate
  FROM Book
  JOIN Report ON Report.bookId = Book.bookId
  JOIN Reviewer ON Report.reviewerId = Reviewer.reviewerId
  WHERE Book.bookId = "' . $bookId . '"';


  $bookDetails = mysqli_query($dbc, $book_details_query);
  if (!$bookDetails) {
    die(mysqli_connect_error());
  }

  $categories = mysqli_query($dbc, $categories_query);
  if (!$categories) {
    die(mysqli_connect_error());
  }

  $reviews = mysqli_query($dbc, $reviews_query);
  if (!$reviews) {
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
    <div class="book-details">
      <?php
      $bookInfo = mysqli_fetch_row($bookDetails);
      while ($row = mysqli_fetch_row($bookDetails)) {
        foreach ($row as $value) print("<br>$value");
      }
      ?>
      <h1><?php echo $bookInfo[1] ?></h2>
        <img src='./public/images/<?php echo $bookInfo[0] ?>.jpg' style='width:auto;height:350px;' class='card-img-details' alt=''>
        <h5 class="mt-3">Author: <a href='./author.php?authorId=<?php echo $bookInfo[2] ?>'><?php echo $bookInfo[3] ?></a></h5>
        <p>Categories:
          <?php
          while ($row = mysqli_fetch_row($categories)) {
            print("<a href=./category.php?cateId=" . $row[0] . ">$row[1]</a> ");
          }
          ?>
        </p>
        <br>
        <h2>Reviews</h2>
        <div class="review-group align-items-center">
          <?php
          while ($row = mysqli_fetch_row($reviews)) {
            $actualRating = '';
            for ($star = 0; $star < 5; $star += 1) {
              if ($star < (int)$row[0]) {
                $actualRating .= '<img style="width: 15px; height: 15px" src="star-full.svg" />';
              } else {
                $actualRating .= '<img style="width: 15px; height: 15px" src="star-empty.svg" />';
              }
            };
            print("<div class='review p-2'>
            <h5 class='review-name'>
              " . $row[1] . "
            </h5>
            <p class='review-rating'>Rating: " . $actualRating . "</p>
            <p class='review-date'>" . date('d-m-Y', strtotime($row[2])) . "</p>
          </div>");
          }
          ?>

        </div>
        <br>
        <br>
        <form name="add-review" class="row g-3" method="post" action="book-details.php?bookId=<?php echo $bookId ?>">
          <?php
          $rand = rand();
          $_SESSION['rand'] = $rand;
          ?>
          <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
          <div class="mb-3">
            <label for="reviewerNamelbl" class="form-label">Name</label>
            <input type="text" class="form-control" name="reviewerNameText" placeholder="Input your name" required>
          </div>
          <select name="ratingSelect" class="form-select" onchange="onChangeSelect();" aria-label="Select book ratings">
            <option selected value="">Rate this book</option>
            <option value="1">1 star</option>
            <option value="2">2 stars</option>
            <option value="3">3 stars</option>
            <option value="4">4 stars</option>
            <option value="5">5 stars</option>
          </select>
          <p id="ratings-required" style="display: none; color: red;">This field is required.</p>
          <button type="submit" style="background-color: #392A48; font-weight: bold;" onclick="return validateForm();" class="btn btn-primary my-3">Submit</button>
        </form>
        <br>
        <br>
    </div>
  </div>
</body>

</html>