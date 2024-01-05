<?php
session_start();
require_once("../connection.php");
$id_dokter = $_SESSION['id_dokter'];
$query = mysqli_query($conn, "SELECT daftar_poli.id, daftar_poli.no_antrian, daftar_poli.keluhan, pasien.nama as nama_pasien, jadwal_periksa.hari, jadwal_periksa.jam_mulai, jadwal_periksa.jam_selesai FROM daftar_poli JOIN jadwal_periksa ON daftar_poli.id_jadwal = jadwal_periksa.id JOIN dokter ON jadwal_periksa.id_dokter = dokter.id JOIN pasien ON daftar_poli.id_pasien = pasien.id WHERE jadwal_periksa.id_dokter = $id_dokter AND daftar_poli.sudah_periksa = 0");
$data = array();
if ($query) {
  while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
  }
  echo json_encode($data);
}