<?php include("header.php") ?>
<title>E-VISITOR | Data Divisi/Tujuan</title>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include("navbar.php");
    include("config/koneksi.php");
    date_default_timezone_set('Asia/Jakarta');

    ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php   if ($_SESSION['level'] == 'super_admin'){
            include("side_menu_superadmin.php");
        }else{
            include("side_menu.php");  
        }  
            ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Data Tujuan/Divisi</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Data Tujuan/Divisi</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="m-5">
                <div class="row ml-5 ">
                    <a href="tambah_divisi.php" class="btn btn-primary pull-right button"><i
                            class="fas fa-plus-circle pr-2"></i>Tambah Divisi</a>
                </div>
                <div class="m-5">
                    <table class="table table-striped rowTipis" id="tableDivisi">
                        <thead>
                            <tr class="text-center">
                                <th style="display:none"></th>
                                <th>Nomor</th>
                                <th>Nama Tujuan/Divisi</th>
                                <th>Kode Tujuan/Divisi</th>
                                <th>Zona </th>
                                <th>Area</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
              $i = 1;
              $list_divisi = mysqli_query($conn, "SELECT divisi.* ,area.nama_area, area.keterangan FROM divisi LEFT JOIN area ON divisi.id_area = area.id ORDER BY area.id DESC");
              while ($data_divisi = $list_divisi->fetch_assoc()) {
              ?>
                            <tr>
                                <td class="d-none"><?= $data_divisi["id"];?></td>
                                <td><?= $i++; ?></td>
                                <td><?= $data_divisi["nama_divisi"]; ?></td>
                                <td><?= $data_divisi["kode_divisi"]; ?></td>
                                <td><?= $data_divisi["nama_area"]; ?></td>
                                <td><?= $data_divisi["keterangan"]; ?></td>

                                <td align="right">
                                    <div class="dropdown">
                                        <button class="btn btn-success dropdown-toggle btn-Style" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">Aksi</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                            <a class="dropdown-item"
                                                href="edit_divisi.php?id=<?=$data_divisi["id"] ?>"><i
                                                    class="fas fa-edit pr-2"></i>Edit</a>
                                            <a class="dropdown-item"
                                                onclick="deleteConfirm('<?= $data_divisi['id']; ?>','<?= $data_divisi['kode_divisi']; ?>')"><i
                                                    class="fas fa-trash pr-2 mr-1"></i>Hapus</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <?php
              }

              ?>
                        </tbody>
                    </table>

                </div>
                <!-- /.content -->
            </div>
        </div>
        <!-- /.content-wrapper -->

        <?php include("footer.php") ?>
        <script>
        function deleteConfirm(id, kode_divisi) {
            // console.log(id);
            var indexID = id;
            var indexKode = kode_divisi;
            swal({
                    title: "Anda yakin ingin menghapus divisi ini?",
                    text: "Data dengan id " + indexID + " dengan nama divisi " + indexKode + " akan di hapus",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = '?deletediv=' + indexID + '';
                    } else {
                        // swal("Data id "+indexID+" dengan nama "+indexNama+" tidak dihapus");
                        swal({
                            text: 'Data id ' + indexID + ' dengan nama divisi ' + indexKode +
                                ' tidak dihapus',
                            icon: 'info',
                            type: 'success',
                            button: true
                        });
                    }
                });
        }
        $(document).ready(function() {
            $('#tableDivisi').DataTable({
                "order": [
                    [1, "asc"]
                ]
            });
        });
        </script>
</body>
<?php
if (isset($_GET["deletediv"])) {
  $deletediv = $_GET["deletediv"];
  $deleteselectid = mysqli_query($conn, "DELETE FROM divisi WHERE id=$deletediv");
  if ($deleteselectid == true) {
    echo "<script>swal({title: 'Sukses', text: 'Data Divisi berhasil dihapus!',icon:'success', type: 'success',button:false,timer:1000}).then(function(){window.location = 'data_divisi.php';});</script>";
  }
}
?>

</html>