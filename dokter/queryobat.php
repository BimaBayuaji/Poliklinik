<?php
session_start();
require_once("../connection.php");
$query = mysqli_query($conn, "SELECT * FROM obat ORDER BY id ASC");
$data = array();
if ($query) {
  while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
  }
  echo json_encode($data);
}