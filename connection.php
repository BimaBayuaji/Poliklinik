<?php
$conn = mysqli_connect("localhost", "root", "", "capstone_rs");
if (!$conn) {
  die("Gagal terhubung database: " . mysqli_connect_error());
}
