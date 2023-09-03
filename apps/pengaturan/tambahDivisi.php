            <!-- Main content -->
            <section class="content" style="margin:0">
                <div class="container-fluid">
                </div>
                        <!-- form start -->
                        <form action="?" method="post">
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
                                   $sql = "SELECT * FROM area";
                                   $result = mysqli_query($conn, $sql);                                   
                                   if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while($row = mysqli_fetch_assoc($result)) {
                                      ?>
                                        <option value="<?= $row["id"] ?>"> <?= $row["kode_area"] ?> (
                                            <?= $row["keterangan"] ?> ) </option>
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
                </div>
            </section>
