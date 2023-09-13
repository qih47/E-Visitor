// Hold Alerts
$(document).ready(function () {
  window.setTimeout(function () {
    $(".alert")
      .fadeTo(500, 0)
      .slideUp(1000, function () {
        $(this).remove();
      });
  }, 3000);
});

// Brand size
$(document).ready(function () {
  $("#brandtittle").hide();
  $("#bars").on("click", function () {
    if ($("#brand").hasClass("brand-link")) {
      $("#brand").removeClass("brand-link");
      $("#brand").addClass("px-4");
      $("#brandtittle").hide();
      $("#navitem").addClass("mt-3");
    } else {
      $("#brandtittle").text("PAM E-VISITOR").show();
      $("#navitem").removeClass("mt-3");
      $("#brand").addClass("brand-link");
      $("#brand").removeClass("px-4");
      $("#brandtittle").show();
    }
  });
});

// Jam Sidebar
function showTime() {
  var date = new Date();
  var h = date.getHours();
  var m = date.getMinutes();
  var s = date.getSeconds();
  var day = date.getDate();
  var month = date.getMonth();
  var year = date.getFullYear();
  var daysOfWeek = [
    "Minggu",
    "Senin",
    "Selasa",
    "Rabu",
    "Kamis",
    "Jumat",
    "Sabtu",
  ];
  var monthsOfYear = [
    "Januari",
    "Februari",
    "Maret",
    "April",
    "Mei",
    "Juni",
    "Juli",
    "Agustus",
    "September",
    "Oktober",
    "November",
    "Desember",
  ];

  // Format waktu
  var text = " WIB";
  if (m < 10) {
    mnol = "0";
  } else {
    mnol = "";
  }
  if (s < 10) {
    snol = "0";
  } else {
    snol = "";
  }

  var time = h + ":" + mnol + m + ":" + snol + s + text;

  // Format tanggal dan waktu
  var tanggal =
    daysOfWeek[date.getDay()] +
    ", " +
    day +
    " " +
    monthsOfYear[month] +
    " " +
    year;

  document.getElementById("MyClockDisplay").innerText = time;
  document.getElementById("MyClockDisplay").textContent = time;
  document.getElementById("tanggal").innerText = tanggal;
  document.getElementById("tanggal").textContent = tanggal;

  setTimeout(showTime, 1000);
}
showTime();

// Function Logout
$("#logout").on("click", function () {
  swal
    .fire({
      title: "Anda yakin ingin keluar?",
      text: "Tekan OK untuk keluar atau CANCEL untuk batalkan!",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "OK",
      closeOnConfirm: true,
      closeOnCancel: true,
      dangerMode: true,
    })
    .then((result) => {
      if (result.value === true) {
        window.location = "?hal=logout";
      } else {
        swal.fire({
          text: "Anda tidak jadi keluar halaman, silahkan lanjutkan tugas!",
          icon: "info",
          type: "success",
          button: true,
        });
      }
    });
});

// Tabel Visitor
$(document).ready(function () {
  var table = $("#tableVisitor").DataTable({
    processing: true,
    serverSide: true,
    sPaginationType: "full_numbers",
    ajax: {
      url: "system/controllers/showBuku.php",
    },
    dataSrc: "",
    order: [],
    fnCreatedRow: function (row, data, index) {
      $("td", row)
        .eq(0)
        .html(index + 1);
    },

    columnDefs: [
      {
        targets: 0,
        render: function (data, type, row, meta) {
          var pageInfo = table.page.info();
          return meta.row + 1;
        },
      },
      {
        searchable: false,
        data: null,
        targets: [11],
        "width  ": "8%",

        render: function (data, dt, id, type, row) {
          var indexID = data[0];
          var indexInstansi = data[4];
          var status = data[1];
          var selesai = "";
          var proses = "";
          if (status === "Berlangsung") {
            proses = `<span></span>`;
            selesai = `<a onclick="confirmSelesaiKunjungan('${indexID}', '${indexInstansi}')" class="btn btn-warning btn-xs">
        <i class="fas fa-sign-out-alt"></i> Selesai
        </a>`;
          } else if (status === "Selesai") {
            selesai = `<span></span>`;
            proses = `<span></span>`;
          } else {
            selesai = `<span></span>`;
            proses = `    <a onclick="prosesKunjungan('${indexID}')" class="btn btn-primary btn-xs">
        <i class="fas fa-address-card"></i> Proses
    </a>`;
          }
          var btn = `
        <center>
            <a onclick="showDetail('${indexID}')" class="btn btn-success btn-xs">
                <i class="fas fa-eye"></i>
            </a>
            <div class="btn-group">
            <a type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown">
            <i class="fas fa-list"></i>
            </a>
<div class="dropdown-menu" style="min-width: 200px;">
  ${selesai} ${proses}
    <a onclick="confirmDeleteRegistrasi('${indexID}', '${indexInstansi}')" class="btn btn-danger btn-xs">
        <i class="fas fa-trash"></i> Hapus
    </a>
</div>

            </div>
        </center>`;
          return btn;
        },
      },
      {
        targets: [12],
        visible: false,
      },
      {
        targets: [1],
        width: "0%",
      },
      {
        targets: [9],
        width: "7%",
      },
      {
        targets: [5],
        data: null,
        render: function (data) {
          var penerima = "";
          var tujuan = "";
          var jenis = data[9];
          if (jenis === "UMUM" || jenis === "PRAKERIN") {
            penerima = data[11];
            tujuan = data[5];
          } else {
            penerima = data[14];
            tujuan = data[15];
          }
          var Label =
            "</a> <a style='font-weight : bold;padding : 5px;'>" +
            penerima +
            " " +
            "(" +
            tujuan +
            ")" +
            "</a>";

          var Label_status = "</a> <a>" + Label + "</a>";
          return Label_status;
        },
      },
      {
        targets: [1],
        data: null,
        render: function (data) {
          var status = data[1];
          if (status === "Berlangsung") {
            var Label =
              "<center></a> <a style='border-radius: 10px;background-color : lightgreen;color:black;font-weight : bold;padding : 5px;font-size:12px;'>" +
              status +
              "</a></center>";
          } else if (status === "Selesai") {
            var Label =
              "<center></a> <a style='border-radius: 10px;background-color : red;color:black;font-weight : bold;padding : 5px;font-size:12px;'>" +
              status +
              "</a></center>";
          } else {
            var Label =
              "<center></a> <a style='border-radius: 10px;background-color : orange;color:black;font-weight : bold;padding : 5px;font-size:12px;'>" +
              status +
              "</a></center>";
          }
          var Label_status = "<center></a> <a>" + Label + "</a></center>";
          return Label_status;
        },
      },
      {
        targets: [9],
        data: null,
        render: function (data) {
          var jenis = data[9];
          var area = data[13];
          var colorbg = "";
          if (area === "1") {
            colorbg = "red";
          } else if (area === "2") {
            colorbg = "yellow";
          } else if (area === "3") {
            colorbg = "lightgreen";
          } else {
            colorbg = "green";
          }
          if (jenis === "UMUM") {
            icon = "user";
          } else if (jenis === "DIREKSI") {
            icon = "user-tie";
          } else {
            icon = "user-graduate";
          }
          // console.log(area);
          // console.log(colorbg);
          var Label = `<center><a style='border-radius: 10px;background-color : ${colorbg};color:black;font-weight : bold;padding : 5px;font-size:12px;'>${jenis}<i class="fas fa-${icon}"></i></a></center>`;

          var Label_status = `<center><a>${Label}</a></center>`;
          return Label_status;
        },
      },
      {
        targets: [10],
        data: null,
        render: function (data) {
          var verifikasi = data[10];
          if (verifikasi === "verified") {
            var Label =
              "<center></a> <a style='border-radius: 10px;background-color : lightgreen;color:black;font-weight : bold;padding : 5px;font-size:12px;'>" +
              verifikasi +
              '<i class="fas fa-check-double"></i></a></center>';
          } else {
            var Label =
              "<center></a> <a style='border-radius: 10px;background-color : lightblue;color:black;font-weight : bold;padding : 5px;font-size:12px'>" +
              "NO " +
              '<i class="fas fa-check"></i></a></center>';
          }
          var Label_status = "<center></a> <a>" + Label + "</a></center>";
          return Label_status;
        },
      },
    ],
    select: {
      style: "multi",
    },
    order: [[0, "ASC"]],
    createdRow: function (row, data, dataIndex) {
      $(row).find("td").css("font-weight", "bold");
    },
  });
});

$(document).ready(function () {
  var tableDivisi = $("#divisiTable").DataTable({
    processing: true,
    serverSide: true,
    sPaginationType: "full_numbers",
    ajax: {
      url: "system/controllers/showDivisi.php",
    },
    dataSrc: "",
    order: [],
    fnCreatedRow: function (row, data, index) {
      $("td", row)
        .eq(0)
        .html(index + 1);
    },

    columnDefs: [
      {
        targets: 0,
        render: function (data, type, row, meta) {
          var pageInfo = tableDivisi.page.info();
          return meta.row + 1;
        },
      },
      {
        targets: [5],
        data: null,
        render: function (data, dt, ids, type, row) {
          var indexID = data[0];
          var indexNama = data[1];
          var indexKode = data[2];
          var btn =
            '<center></a> <a href="pages/controllers/index/hal.php?i=pages13&pesan=' +
            data[2] +
            '"class="btn btn-success btn-xs"><i class="fas fa-edit"></i></a> <a onclick="confirmDeleteValidasi(\'' +
            indexID +
            "', '" +
            indexNama +
            "', '" +
            indexKode +
            '\')" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></a></center>';
          return btn;
        },
      },
      {
        targets: [4],
        data: null,
        render: function (data) {
          var indexArea = data[4];
          if (indexArea === "Terlarang") {
            colorbg = "green";
          } else if (indexArea === "Terbatas") {
            colorbg = "yellow";
          } else {
            colorbg = "red";
          }
          var Label = `<center><a style='border-radius: 10px;background-color : ${colorbg};color:black;font-weight : bold;padding : 5px;font-size:12px;'>${indexArea}</a></center>`;
          var Label_status = `<center><a>${Label}</a></center>`;
          return Label_status;
        },
      },
    ],
  });
});

function refreshDataTable() {
  $("#tableVisitor").DataTable().ajax.reload(null, false);
}
// Confirm Selesai Kunjungan
function confirmSelesaiKunjungan(id, instansi) {
  Swal.fire({
    title: "Konfirmasi Penyelesaian Kunjungan",
    text: "Apakah kunjungan dari " + instansi + " sudah selesai?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Selesai",
    cancelButtonText: "Batal",
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
  })
    .then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "system/controllers/updateData.php",
          method: "POST",
          data: {
            id: id,
            sesi: "selesai",
          },
          success: function (response) {
            if (response === "sukses") {
              // $("#test").html(response).css("color", "green");
              kunjunganSelesai();
              refreshDataTable();
            } else {
              // $("#test").html(response).css("color", "red");
              gagalUbahData();
            }
          },
          error: function (error) {
            console.log(error);
            Swal.fire(
              "Error",
              "Terjadi kesalahan saat menyelesaikan data kunjungan.",
              "error"
            );
          },
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire("Dibatalkan", "Operasi dibatalkan.", "info");
      }
    })
    .catch((error) => {
      console.log(error);
      Swal.fire("Error", "Terjadi kesalahan dalam menampilkan pesan.", "error");
    });
}

// Confirm Delete Registrasi
function confirmDeleteRegistrasi(id, instansi) {
  Swal.fire({
    title: "Konfirmasi Penghapusan Data",
    text:
      "Anda yakin ingin menghapus data registrasi dengan ID " +
      id +
      " dari instansi " +
      instansi +
      "?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Hapus",
    cancelButtonText: "Batal",
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
  })
    .then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "system/controllers/deleteDataRegistrasi.php",
          method: "POST",
          data: {
            id: id,
            sesi: "register",
          },
          success: function (response) {
            if (response === "sukses") {
              // $("#test").html(response).css("color", "green");
              deleteRegistrasiOK();
              refreshDataTable();
            } else {
              // $("#test").html(response).css("color", "red");
              deleteGagal();
            }
          },
          error: function (error) {
            console.log(error);
            Swal.fire(
              "Error",
              "Terjadi kesalahan saat menghapus data.",
              "error"
            );
          },
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire("Dibatalkan", "Operasi penghapusan dibatalkan.", "info");
      }
    })
    .catch((error) => {
      console.log(error);
      Swal.fire("Error", "Terjadi kesalahan dalam menampilkan pesan.", "error");
    });
}

// Show Detail Informasi Registrasi
function showDetail(id) {
  $.ajax({
    url: "system/controllers/getDataRegistrasi.php",
    method: "POST",
    data: {
      id: id,
    },
    dataType: "json",
    success: function (data) {
      var modalBody = document.getElementById("modal-body");
      var modalFooter = document.getElementById("modal-footer");
      var selisihHari = parseInt(data.selisih_hari) + 1;
      var kunciLocker = data.locker !== "" ? data.locker : "Tidak Ada";
      var jenis = data.jenisTamu;
      var area = data.idArea;

      var colorbg = "";
      if (area === "1") {
        colorbg = "red";
      } else if (area === "2") {
        colorbg = "yellow";
      } else if (area === "3") {
        colorbg = "lightgreen";
      } else {
        colorbg = "green";
      }
      if (jenis === "UMUM") {
        icon = "user";
      } else if (jenis === "DIREKSI") {
        icon = "user-tie";
      } else {
        icon = "user-graduate";
      }
      var verifikasi = data.verifikasi;
      if (verifikasi === "verified") {
        var dataVerifikasi =
          "<a style='border-radius: 10px;background-color : lightgreen;color:black;font-weight : bold;padding : 5px;font-size:12px;'>" +
          verifikasi +
          '<i class="fas fa-check-double"></i></a>';
      } else {
        var dataVerifikasi =
          "<a style='border-radius: 10px;background-color : lightblue;color:black;font-weight : bold;padding : 5px;font-size:12px'>" +
          verifikasi +
          '<i class="fas fa-check"></i></a>';
      }
      var statusStyle = "";
      var statusText = data.statusKunjungan;

      if (data.statusKunjungan === "Selesai") {
        statusStyle =
          "background-color: red; color: black; font-weight: bold; padding: 5px;border-radius: 10px;";
        iconStatus = "door-open";
      } else if (data.statusKunjungan === "Berlangsung") {
        statusStyle =
          "background-color: lightgreen; color: black; font-weight: bold; padding: 5px; border-radius: 10px;";
        iconStatus = "handshake";
      } else {
        statusStyle =
          "background-color: orange; color: black; font-weight: bold; padding: 5px; border-radius: 10px;";
        iconStatus = "clock";
      }
      jenisStyle =
        "color: black; font-weight: bold; padding: 5px; border-radius: 10px;";
      modalBody.innerHTML = `
    <div class="row">
      <div class="col-md-6">
        <a>No. Kunjungan: </a> <a style="${statusStyle}"> ${
        id || "Menunggu"
      }</a> 
      </div>
      </div><br>
      <div class="row">
      <div class="col-md-6">
        <a>Status Kunjungan: </a> <a style="${statusStyle}"> ${
        statusText || "Menunggu"
      } <i class="fas fa-${iconStatus}"></i></a> 
      </div>
      </div><br>
      <div class="row">
      <div class="col-md-4">
      <a>Jenis Tamu: </a><a style="background-color:${colorbg};${jenisStyle}"> ${
        data.jenisTamu
      }<i class="fas fa-${icon}"></i></a></center></a></div>
      </div>
    </div><br>
    <div class="row">
      <div class="col-md-6">
        <p>Jam Masuk: ${data.jam_masuk || "Belum Ada"}</p>
      </div>
      <div class="col-md-6">
        <p>Jam Keluar: ${data.jam_keluar || "Belum Ada"}</p>
      </div>
    </div><br>
    <label>INFORMASI AKSES</label>
    <div class="row">
      <div class="col-md-6">
        <p>Kartu Akses: ${data.no_kartu || "Belum Ada"}</p>
      </div>
      <div class="col-md-6">
        <p>Kunci Locker: ${kunciLocker || "Tidak Ada"}</p>
      </div>
    </div><br>
    <label>INFORMASI DASAR IZIN MASUK</label>
    <div class="row">
      <div class="col-md-6">
        <p>Dasar: ${data.dasar || "Belum Ada"}</p>
      </div>
      <div class="col-md-6">
        <p>Tanggal Dasar: ${data.tanggalDasar || "Belum Ada"}</p>
      </div>
      <div class="col-md-6">
        <p>Tanggal Kunjungan: ${data.awalKunjungan || "Belum Ada"} s/d ${
        data.akhirKunjungan || "Belum Ada"
      }</p>
      </div>
      <div class="col-md-6">
        <p>Masa Kunjungan: ${selisihHari} HARI</p>
      </div>
    </div><br>
    <label>INFORMASI IDENTITAS PENGUNJUNG</label>
      <div class="row">
        <div class="col-md-12">
          <p>Nama Pengunjung: ${data.nama || "Belum Ada"}</p>
      </div>
        <div class="col-md-6">
          <p>Jumlah Pengunjung: ${data.totalVisitor || "Belum Ada"} ORANG</p>
      </div>
        <div class="col-md-6">
          <p>Instansi: ${data.instansi || "Belum Ada"}</p>
      </div>
        <div class="col-md-6">
          <p>Alamat: ${data.alamat || "Belum Ada"}</p>
      </div>
        <div class="col-md-6">
          <p>Keperluan: ${data.keperluan || "Belum Ada"}</p>
      </div>
      <div class="col-md-6">
        <p>Kendaraan: ${data.kendaraan || "Belum Ada"}</p>
    </div>
      <div class="col-md-6">
        <p>No. HP: ${data.noHp || "Belum Ada"}</p>
    </div>
    <div class="col-md-6">
        Verifikasi Data: ${dataVerifikasi || "Belum Ada"}
    </div>
    </div><br>
    <label>INFORMASI IDENTITAS PENERIMA</label>
    <div class="row">
      <div class="col-md-6">
        <p>Nama Penerima: ${data.penerima || "Belum Ada"}</p>
    </div>
      <div class="col-md-6">
        <p>Divisi Penerima: ${data.nama_divisi || "Belum Ada"}</p>
    </div>
    </div>
    </div>
  `;
      if (data.statusKunjungan === "Menunggu") {
        modalFooter.innerHTML = `
<a class="btn btn-secondary" onclick="prosesKunjungan('${id}')" value="${data.id}">
  <i class="fas fa-address-card pr-2"></i>Proses Registrasi
</a>

`;
      } else {
        modalFooter.innerHTML = `
  <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-book pr-2"></i> Kunjungan Ulang</button>
  <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-edit pr-2"></i> Edit Data</button>
<a href="pages/controllers/index/hal.php?i=pages5&pesan=${data.id}" target="_blank" class="btn btn-success" value="${data.id}">
  <i class="fas fa-print pr-2"></i>Cetak Bukti Kunjungan
</a>
`;
      }

      $("#myModal").modal("show"); // Menampilkan modal
    },
  });
}

// Proses Kunjungan
function prosesKunjungan(id) {
  console.log(id);
  $.ajax({
    url: "system/controllers/getDataRegistrasi.php",
    method: "POST",
    data: {
      id: id,
    },
    dataType: "json",
    success: function (data) {
      var modalBody = document.getElementById("modal-body-proses");
      var modalFooter = document.getElementById("modal-footer-proses");
      var jenis = data.jenisTamu;
      var penerima = "";
      var tujuan = "";
      if (jenis === "DIREKSI") {
        penerima = data.nama_dir;
        tujuan = data.jabatan;
        readonly = "readonly";
        colorbd = "red";
      } else {
        penerima = data.penerima;
        tujuan = data.nama_divisi;
        readonly = "";
        colorbd = "green";
      }
      var izin = data.jenisIzin;
      if (izin === "Lisan") {
        jenisIzin = izin + "/ Konfirmasi Penerima";
      } else {
        jenisIzin = izin;
      }
      // console.log(penerima,tujuan);
      modalBody.innerHTML = `
                                <div class="row">
      <div class="col-md-6">
        <a id="noKunjungan" name="nameKunjungan"><i class="fas fa-book-open"></i> No. Kunjungan: </a> <a style="font-size:20px"> ${id} </a> 
      </div>
      </div><br>
                    <label for="dasarIzin"><u>AKSES PENGUNJUNG</u></label>

                          <div class="row">
                            <div class="col-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span style="font-weight:bold;" class="input-group-text">Kartu Akses
                                        </span>
                                    </div>
                                    <select style="border-color: green;" name="kartuAkses" id="kartuAkses" class="form-control" placeholder="Pilih Akses">
                                        <option> Pilih</option>

                                    </select>
                                </div>
                            </div>
                                            <div class="col-2">
                                <div class="input-group">
                              <div class="input-group-prepend">
                                  <span style="font-weight:bold;" class="input-group-text">Kunci Locker</span>
                              </div>
                              <select style="border-color: green;" name="kunci" id="kunci" class="form-control" placeholder="Pilih Kunsi">
                                  <option value="kosong"> Pilih</option>
                                  ${generateLockerOptions()}
                              </select>
                          </div>
                      </div>
                        </div><br>
                <label for="dasarIzin"><u>DASAR IZIN MASUK</u></label>
                <div class="row">
                    <div class="col-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span style="font-weight:bold;" class="input-group-text">Jenis Izin</span>
                            </div>
                            <input type="text" name="JenisIzin" id="jenisIzin" style="border-color: red;" class="form-control" readonly value="${jenisIzin}">
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span style="font-weight:bold;" class="input-group-text">Dasar Izin</span>
                            </div>
                            <input type="text" name="dasarIzinTM" id="dasarIzinTM" style="border-color: red;" class="form-control" readonly value="${
                              data.dasar
                            }">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span style="font-weight:bold;" class="input-group-text">Tanggal Izin</span>
                            </div>
                            <input type="text" name="tglDasar" id="tglDasar" style="border-color: red;" class="form-control" readonly value="${
                              data.tanggalDasar
                            }">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span style="font-weight:bold;" class="input-group-text">Awal</span>
                            </div>
                            <input type="text" name="awal" id="awal" style="border-color: red;" class="form-control" readonly value="${
                              data.tanggalDasar
                            }">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span style="font-weight:bold;" class="input-group-text">Akhir</span>
                            </div>
                            <input type="text" name="akhir" id="akhir" style="border-color: red;" class="form-control" readonly value="${
                              data.tanggalDasar
                            }">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span style="font-weight:bold;" class="input-group-text">Masa</span>
                            </div>
                            <input type="text" name="masa" id="masa" style="border-color: red;" class="form-control" readonly value="${
                              data.masaKunjungan + " Hari"
                            }">
                        </div>
                    </div>
                </div><br>
               <label for="dasarIzin"><u>DATA PENGUNJUNG</u></label>
                <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <div class="input-group control-group ">
                                        <span style="font-weight:bold;" class="input-group-text">Nama</span>
                                        <input type="text" name="addmore[]" style="border-color: green;" class="form-control" placeholder="Masukan Nama Pengunjung" required>
                                        <div class="input-group-btn">
                                            <button class="btn btn-success add-more-visitor" type="button"><i class="glyphicon glyphicon-plus fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="after-add-more">
                                    </div>
                                </div>
                            </div>
                    <div class="col-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span style="font-weight:bold;" class="input-group-text">Penerima</span>
                            </div>
                            <input type="text" name="penerima" id="penerima" style="border-color: ${colorbd};" class="form-control" value="${penerima}" placeholder="Masukan Penerima" ${readonly}>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span style="font-weight:bold;" class="input-group-text">Tujuan</span>
                            </div>
                            <input type="text" name="tujuan" id="tujuan" style="border-color: red;" class="form-control" readonly value="${tujuan}">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span style="font-weight:bold;" class="input-group-text">Instansi</span>
                            </div>
                            <input type="text" name="masa" id="masa" style="border-color: red;" class="form-control" readonly value="${
                              data.instansi
                            }">
                        </div>
                    </div>
                </div><br>
                        <div class="row">
                            <div class="col-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span style="font-weight:bold;" class="input-group-text">Alamat</span>
                                    </div>
                                    <input type="text" name="alamat" id="alamat" style="border-color: green;" class="form-control" placeholder="Masukan Alamat" required oninvalid="this.setCustomValidity('Alamat Tidak Boleh Kosong..')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                              <div class="col-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span style="font-weight:bold;" class="input-group-text">Keperluan</span>
                                    </div>
                                    <select style="border-color: green;" name="keperluan" id="keperluan" class="form-control" placeholder="Pilih Keperluan">
                                        <option value="Tidak Ada"> Pilih </option>
                                        <option value="Dinas">Dinas</option>
                                        <option value="Meeting">Meting</option>
                                        <option value="Aanwizing">Aanwizing</option>
                                        <option value="Kirim Barang">Kirim Barang</option>
                                        <option value="Kirim Dokumen">Kirim Dokumen</option>
                                        <option value="Order">Order</option>
                                        <option value="Cek Stock">Cek Stock</option>
                                        <option value="Cek Kotak Amal">Cek Kotak Amal</option>
                                        <option value="Register">Register</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group" id="kendaraan">
                                    <div class="input-group control-group ">
                                        <div class="input-group-prepend">
                                            <span style="font-weight:bold;" class="input-group-text">Kendaraan</span>
                                        </div>
                                        <input type="text" name="kendaraan" style="border-color: green;" class="form-control" placeholder="Nama & Plat Nomor Kendaraan">
                                    </div>
                                </div>
                            </div>
                             <div class="col-2">
                                <div class="form-group" id="nohpfrm">
                                    <div class="input-group control-group ">
                                        <div class="input-group-prepend">
                                            <span style="font-weight:bold;" class="input-group-text">No HP</span>
                                        </div>
                                        <input type="text" name="nohp" style="border-color: green;" class="form-control" placeholder="Masukan No HP">
                                    </div>
                                </div>
                            </div>
                      </div><br>

      `;
      // get Kartu
      $("#kartuAkses").empty();
      var id_divisi = data.id_divisi;
      var id_direktur = data.id_direktur;
      $.get(
        "system/controllers/getKartu.php",
        {
          id_divisi: id_divisi,
          id_direktur: id_direktur,
        },
        function (response) {
          try {
            var jsonResponse = response;
            var responseObj = JSON.parse(jsonResponse);
            var dataValue = responseObj.data;
            var dataArray = dataValue.split(" ");
            $.each(dataArray, function (index, value) {
              $("#kartuAkses").append(
                $("<option></option>").attr("value", value).text(value)
              );
            });
          } catch (error) {
            console.log(response);
            console.error(
              "JSON ERROR: " + error.message
            );
          }
        }
      ).fail(function (jqXHR, textStatus, errorThrown) {
        console.error(
          "Gagal menampilkan data: " + textStatus,
          errorThrown
        );
      });

      // Add more pengunjung
      $(".add-more-visitor").click(function () {
        var html =
          '<div class="control-group input-group" style="margin-top:10px"> <input type="text" name="addmore[]" class="form-control" placeholder="Masukan Nama Pengunjung"> <div class="input-group-btn"> <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove fa fa-minus"></i></button> </div> </div>';
        $(".after-add-more").append(html);
      });
      $("body").on("click", ".remove", function () {
        $(this).parents(".control-group").remove();
      });

      // Generate Key locker
      function generateLockerOptions() {
        let options = "";
        for (let i = 1; i <= 40; i++) {
          options += `<option value='Key-${i}'>Key-${i}</option>`;
        }
        return options;
      }

      // show hide modal
      $("#myModal").modal("hide");
      $("#prosesFrmModal").modal("show");
    },
  });
}

function simpanFromProsesModal() {
  const kartuValue = document.getElementById("kartu").value;
  const jenisIzinValue = document.getElementById("jenisIzin").value;
  const dasarIzinValue = document.getElementById("dasarIzinTM").value;
  const tglDasar = document.getElementById("tglDasar").value;
  const awal = document.getElementById("awal").value;
  const akhir = document.getElementById("akhir").value;
  const namaPengunjungElements = document.querySelectorAll(
    "input[name='addmore[]']"
  );

  // Membuat array kosong untuk menyimpan nilai-niaila nama pengunjung
  const namaPengunjung = [];

  // Mengambil nilai dari setiap elemen input yang memiliki nilai (tidak kosong)
  namaPengunjungElements.forEach(function (element) {
    if (element.value.trim() !== "") {
      namaPengunjung.push(element.value);
    }
  });

  // Menggabungkan semua nama pengunjung dalam satu string dengan koma sebagai pemisah
  const namaPengunjungString = namaPengunjung.join(", ");

  // Mendapatkan jumlah pengunjung
  const jumlahPengunjung = namaPengunjung.length;

  // Sekarang Anda dapat menggunakan nilai-nilai ini sesuai dengan kebutuhan Anda
  console.log("Nilai Kartu Akses:", kartuValue);
  console.log("Nilai Jenis Izin:", jenisIzinValue);
  console.log("Nilai Dasar Izin:", dasarIzinValue);
  console.log("Nilai Tgl Izin:", tglDasar);
  console.log("Nilai Awal :", awal);
  console.log("Nilai Akhir :", akhir);
  $.ajax({
    url: "system/controllers/simpanData.php?sesi=prosesRegistrasi",
    method: "POST",
    data: {},
  });
}

// Download Laporan
$(document).ready(function () {
  $("#form_bulan_download").removeClass("hidden");
  $("#form_bulan_download").hide();
  $("#downloadlaporanbtn").on("click", function () {
    $("#form_bulan_download").toggle();
  });

  $("#downloadlaporan").on("click", function () {
    var bulanTahun = $("#monthdownload").val();

    var tahun = bulanTahun.substring(0, 4);
    var bulan = bulanTahun.substring(5);
    var page =
      "../config/processing/export-excel.php?bulan=" +
      bulan +
      "&tahun=" +
      tahun +
      "";
    $.ajax({
      url: page,

      method: "GET",
      success: function (response) {
        window.location = page;
      },
      error: function () {
        alert("gagal export");
      },
    });
  });
});

// Show Form Kunjungan
$(document).ready(function () {
  $("#visitor-form").hide();
  $("#tambah-tamu").on("click", function () {
    $("#visitor-form").removeClass("hidden");
    $("#visitor-form").toggle();
  });
});

// Pilih Tamu
$(document).ready(function () {
  $("#direkturFrm").hide();
  $("#prakerinFrm").hide();
  $("#penerimaFrm").hide();
  $("#jenisTamuFrm").hide();

  $("#tmumum").on("click", function () {
    $("#divisiTujuan").show();
    $("#penerimaFrm").show();
    $("#direkturFrm").hide();
    $("#prakerinFrm").hide();
    $("#jenisTamuFrm").show();
  });

  $("#tmdireksi").on("click", function () {
    $("#divisiTujuan").hide();
    $("#direkturFrm").show();
    $("#prakerinFrm").hide();
    $("#penerimaFrm").hide();
    $("#jenisTamuFrm").show();
  });

  $("#tmprakerin").on("click", function () {
    $("#divisiTujuan").show();
    $("#prakerinFrm").show();
    $("#direkturFrm").hide();
    $("#penerimaFrm").hide();
    $("#jenisTamuFrm").show();
  });
});

// Tambah Pengunjung
$(document).ready(function () {
  $(".add-more-visitor").click(function () {
    var html =
      '<div class="control-group input-group" style="margin-top:10px"> <input type="text" name="addmore[]" class="form-control" placeholder="Masukan Nama Pengunjung"> <div class="input-group-btn"> <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove fa fa-minus"></i></button> </div> </div>';
    $(".after-add-more").append(html);
  });
  $("body").on("click", ".remove", function () {
    $(this).parents(".control-group").remove();
  });
});

$(document).ready(function () {
  $("#registrasiFrm").hide();
  $("#reg").on("click", function () {
    $("#registrasiFrm").removeClass("hidden");
    $("#registrasiFrm").toggle();
  });
});

// FRM Izin Masuk
$(document).ready(function () {
  $("#suratIzin").hide();
  $("#tglSurat").hide();
  $("#konfirm").hide();
  $("#dasar").on("change", function () {
    var dasar = document.getElementById("dasar");
    // console.log(dasar.value);
    if (dasar.value == "Surat Izin Masuk") {
      $("#suratIzin").removeClass("hidden");
      $("#tglSurat").removeClass("hidden");
      $("#konfirm").addClass("hidden");
      $("#divisiTujuan").addClass("mt-4");
      $("#instansiFrm").addClass("mt-4");
      $("#akhirKunjunganFrm").addClass("mt-4");
      $("#suratIzin").toggle();
      $("#tglSurat").toggle();
      $("#konfirm").hide();
    } else {
      $("#instansiFrm").removeClass("mt-4");
      $("#konfirm").removeClass("hidden");
      $("#suratIzin").addClass("hidden");
      $("#tglSurat").addClass("hidden");
      $("#akhirKunjunganFrm").removeClass("mt-4");
      $("#divisiTujuan").addClass("mt-4");
      $("#suratIzin").hide();
      $("#tglSurat").hide();
      $("#konfirm").toggle();
    }
  });
});

$(document).ready(function () {
  var jenisTMInput = document.getElementById("jenisTM");
  $("#tmumum").on("click", function () {
    jenisTMInput.value = "UMUM";
  });

  $("#tmdireksi").on("click", function () {
    jenisTMInput.value = "DIREKSI";
  });

  $("#tmprakerin").on("click", function () {
    jenisTMInput.value = "PRAKERIN";
  });
});

// Pre Register
function PreRegister() {
  var jenisSurat = $("#jenisSurat").val();
  var noSurat = $("#nosurat").val();
  var divisiSurat = $("#divisiSurat").val();
  var bulanSurat = $("#blnrom").val();
  var tahunSurat = $("#tglthn").val();
  var jenisTamu = $("#jenisTM").val();
  var umum = $("#penerima").val();
  var direksi = $("#direktur").val();
  var prakerin = $("#pembimbing").val();
  if (jenisTamu === "UMUM") {
    penerima = umum;
  } else if (jenisTamu === "DIREKSI") {
    penerima = direksi;
  } else {
    penerima = prakerin;
  }
  var dasarSurat = "";
  if (jenisSurat === "") {
    dasarSurat = "Tidak Ada";
  } else {
    dasarSurat =
      jenisSurat +
      "/" +
      noSurat +
      "/" +
      divisiSurat +
      "/" +
      bulanSurat +
      "/" +
      tahunSurat;
  }
  $.ajax({
    url: "system/controllers/simpanData.php?sesi=preRegister",
    method: "POST",
    data: {
      dasar: dasar.value,
      konfirm: konfirmLisan.value,
      dasarSurat: dasarSurat,
      tglSurat: tanggalSurat.value,
      awal: awalKunjungan.value,
      akhir: akhirKunjungan.value,
      instansi: instansi.value,
      divisi: divisi.value,
      penerima: penerima,
      jenisTamu: jenisTamu,
    },
    success: function (response) {
      if (response === "error") {
        // $("#test").html("GAGAL MENGIRIM DATA").css("color", "green");
        simpanGagal();
      } else {
        preRegisterOK();
        // $("#test").html(response).css("color", "green");
        // var copydeskripsi = document.getElementById("copydeskripsi");
        // submitButton.disabled = true;
        // copydeskripsi.disabled = false;
      }
    },
  });
}

// sweetalert PreRegister Sukses
function preRegisterOK() {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      refreshDataTable();
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });

  Toast.fire({
    icon: "success",
    title:
      "<span style='color: black'>Data berhasil dimasukan ke buku tamu!!</span>",
  });
}
// sweetalert selesai Sukses
function kunjunganSelesai() {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      refreshDataTable();
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });

  Toast.fire({
    icon: "success",
    title:
      "<span style='color: black'>Kunjungan tamu telah di selesaikan!!</span>",
  });
}

// sweetalert Simpan data gagal
function simpanGagal() {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });

  Toast.fire({
    icon: "error",
    title:
      "<span style='color: black'>Gagal menyimpan data ke database!!</span>",
  });
}

// Delete Gagal
function deleteGagal() {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });

  Toast.fire({
    icon: "error",
    title:
      "<span style='color: black'>Gagal menghapus data dari database!!</span>",
  });
}

// Selesai Gagal
function gagalUbahData() {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });

  Toast.fire({
    icon: "error",
    title:
      "<span style='color: black'>Gagal mengubah data di database!!</span>",
  });
}

// sweetalert delete data berhasil
function deleteRegistrasiOK() {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });

  Toast.fire({
    icon: "success",
    title:
      "<span style='color: black'>Data berhasil dihapus dari buku tamu!!</span>",
  });
}

$(document).ready(function () {
  $("#tambahDivisi").hide();
  $("#tambahDivisiBtn").on("click", function () {
    $("#tambahDivisi").toggle();
  });
});
