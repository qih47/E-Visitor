<section class="content">
    <div class="container-fluid">
    </div>
    <div class="card">
        <div class="row mt-2 mb-2 ml-3">
            <div class="btn-group nav-item">
                <a href="#" class="nav-link btn btn-primary pull-right button" id="tambahDivisiBtn"><i class="fas fa-plus-circle pr-2"></i>Tambah Divisi</a>
            </div>
        </div>
        <form action="?" id="tambahDivisi" method="post" class="hidden">
            <div class="card-body">
                <div class="form-group">
                    <label for="">Nama Divisi</label>
                    <input type="text" name="divisi" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Kode Divisi</label>
                    <input type="text" name="kode_divisi" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Area </label>
                    <select class="form-control" name="area" id="area">
                        <option> Pilih Area</option>
                        <?php
                        $getArea = $database->getArea();
                        if (!empty($getArea)) {
                            foreach ($getArea as $row) {
                        ?>
                                <option value="<?= $row["id"] ?>">
                                    <?= $row["kode_area"] ?> (
                                    <?= $row["keterangan"] ?> )
                                </option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            </div>
        </form>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="table-responsive">
                <table id="divisiTable" class="table table-dark table-striped table-hover wb-table" cellspacing="0" width="100%">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Nama Divisi</th>
                            <th>Kode Divisi</th>
                            <th>Zona </th>
                            <th>Area</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- List Data Menggunakan DataTable -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>