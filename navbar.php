<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="/your-path-to-fontawesome/css/fontawesome.css" rel="stylesheet" />
  <link href="/your-path-to-fontawesome/css/brands.css" rel="stylesheet" />
  <link href="/your-path-to-fontawesome/css/solid.css" rel="stylesheet" />
  <link rel="stylesheet" href='./styles.css'>
  <title>Book Store</title>

  <script>
    function handle(e) {
      if (e.keyCode === 13) {
        e.preventDefault();
        const searchVal = document.getElementById('searchText').value;
        console.log(window.location.pathname);
        window.location.href = 'http://localhost/search.php?searchValue=' + searchVal;
      }
    }
  </script>
</head>

<body>
  <div class="nav-bar">
    <div class="container pt-3">
      <div class="row">
        <div class="col">
          <div class="p-2 w-350 title">
            <h1 class="title text-start"><a href="./">Book Store</a></h1>
          </div>
        </div>
        <div class="col">
          <div class="p-2 text-center">
            <input class="form-control search-bar" type="text" name='search-text' maxlength="50" list="datalistOptions" id="searchText" onkeypress="handle(event)" placeholder="Search book name or author name...">
          </div>
        </div>
        <div class="col">
          <div class="p-2 text-end">
            <a href="about.php"><img style="width: 30px; height :50px" src="profile.svg" /></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>