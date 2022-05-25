<?php
include "connection.php";

$data = isset($_POST) ? $_POST : null;
if ($data != null) {
    $query = mysqli_query(
        $connection,
        "insert into mahasiswa set
        nama    = '$data[nama]',
        nim     = '$data[nim]',
        alamat  = '$data[alamat]'"
    );
}
