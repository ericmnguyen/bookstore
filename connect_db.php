<?php
$dbc = mysqli_connect('127.0.0.1', '22074118', 'Zuhan@123', 'db_22074118')
OR die
  (mysqli_connect_error());

# set encoding to match PHP script encoding
mysqli_set_charset($dbc, 'utf8');

// printf("Host information: %s\n", mysqli_get_host_info($dbc));
?>
