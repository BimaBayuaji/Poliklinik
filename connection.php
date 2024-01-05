<?php
$conn = mysqli_connect("localhost", "root", "", "policaps");
if (!$conn) {
  die("Gagal terhubung database: " . mysqli_connect_error());
}
