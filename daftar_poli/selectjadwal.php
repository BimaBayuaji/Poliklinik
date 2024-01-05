<?php
require_once("../connection.php");
$idPoli = $_GET['id'];
$query = mysqli_query($conn, "SELECT jadwal_periksa.id, jadwal_periksa.hari, jadwal_periksa.jam_mulai, jadwal_periksa.jam_selesai, dokter.id AS id_dokter, poli.id AS id_poli, dokter.nama FROM jadwal_periksa JOIN dokter ON jadwal_periksa.id_dokter = dokter.id JOIN poli ON dokter.id_poli = poli.id WHERE poli.id = $idPoli;");
$data = array();
if ($query) {
  while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
  }
  echo json_encode($data);
}