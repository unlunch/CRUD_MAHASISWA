<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <h1 class="text-center mt-5 mb-5">CRUD Data Mahasiswa</h1>
    <hr>

    <div class="container mt-5">
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">Tambah</button>
        <table id="index-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Alamat</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>


    <!-- addModal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="createData">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama" id="nama" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nim" class="col-sm-2">NIM</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nim" id="nim" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-2">Alamat</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-modal">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- editModal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editData">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id-edit">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama" id="nama-edit" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nim" class="col-sm-2">NIM</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nim" id="nim-edit" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-2">Alamat</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="alamat" id="alamat-edit" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-modal">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- deleteModal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="deleteData">
                    <div class="modal-body mt-3">
                        <input type="hidden" name="id" id="id-delete">
                        <h4 class="text-center m-3">Apakah Anda yakin ingin menghapus data ini?</h4>
                    </div>
                    <div class="text-center mb-5">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger" id="btn-modal">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- Script -->
    <script>
        function readData() {
            $.get("read.php", function(data) {
                $("#index-table > tbody").children().remove();
                $("#index-table > tbody").append(data);
                $("#index-table > tbody").children().children().addClass("align-middle");
            });
        }
        readData();

        $("#createData").submit(function(e) {
            e.preventDefault();
            let serializedData = $(this).serialize();
            let post = $.post("create.php", serializedData)

            post.done(function(data) {
                $("#createData").trigger("reset");
                $("#addModal").modal("hide");
                readData();
            });

            post.fail(function(data) {
                alert("error");
            });
        });

        function setEditModal(data) {
            $("#id-edit").val(data.id);
            $("#nama-edit").val(data.nama);
            $("#nim-edit").val(data.nim);
            $("#alamat-edit").val(data.alamat);
        }

        $("#editData").submit(function(e) {
            e.preventDefault();
            let serializedData = $(this).serialize();
            let post = $.post("update.php", serializedData)

            post.done(function(data) {
                $("#editModal").modal("hide");
                readData();
            });

            post.fail(function(data) {
                alert("error");
            });
        });

        function setdeleteModal(id) {
            $("#id-delete").val(id);
        }

        $("#deleteData").submit(function(e) {
            e.preventDefault();
            let serializedData = $(this).serialize();
            let post = $.post("delete.php", serializedData)

            post.done(function(data) {
                $("#deleteModal").modal("hide");
                readData();
            });

            post.fail(function(data) {
                alert("error");
            });
        });
    </script>
</body>

</html>