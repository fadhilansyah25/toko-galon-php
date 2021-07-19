<?php
$servername = "localhost";
$username = "root";
$password = "";

($conn = mysqli_connect($servername, $username, $password)) or
  die("Connection to database was failed : " . mysqli_connect_error());
