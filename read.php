<?php
include "koneksi.php";

$no     = 1;
$query  = mysqli_query($connection, "select * from mahasiswa");

$elements   = "";
if (mysqli_num_rows($query) > 0) {
    while ($row  = mysqli_fetch_array($query)) {
        $elements .= "
            <tr>
                <td>" . $no++ . "</td>
                <td>" . $row["nama"] . "</td>
                <td>" . $row["nim"] . "</td>
                <td>" . $row["alamat"] . "</td>
                <td>
                    <button type='button' class='btn btn-warning' data-toggle='modal' data-target='#editModal' onclick='setEditModal(" . json_encode($row) . ")'>Edit</button> |
                    <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#deleteModal' onclick='setdeleteModal(" . json_encode($row["id"]) . ")'>Delete</button>
                </td>
            </tr>
        ";
    }
} else {
    $elements .= "
            <tr>
                <td colspan='5' class='text-center'>data kosong.</td>
            </tr>
        ";
}

echo $elements;
