<?php 
$data['title'] = "Data Laporan";
echo view('_partials/header', $data); 
?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Laporan</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Laporan</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

<!-- TABLE -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Laporan</h3>

                            <!-- <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div> -->
                        </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Lampu 1</th>
                      <th>Lampu 2</th>
                      <th>Lampu 3</th>
                      <th>Lampu 4</th>
                    </tr>
                  </thead>
                  <tbody id="tbody">
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- col-12 -->
        </div>
        <!-- /.row -->
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.10.1/firebase.js"></script>
<script>
    // Initialize Firebase
    var firebaseConfig = {
        apiKey: "<?= ENV('apiKey') ?>",
        authDomain: "<?= ENV('authDomain') ?>",
        databaseURL: "<?= ENV('databaseURL') ?>",
        storageBucket: "<?= ENV('storageBucket') ?>",
        messagingSenderId: "<?= ENV('messagingSenderId') ?>",
        appId: "<?= ENV('appId') ?>",
        measurementId: "<?= ENV('measurementId') ?>",
        appId: "<?= ENV('appId') ?>"
    };
    firebase.initializeApp(firebaseConfig);

    var database = firebase.database();

    var lastIndex = 0;

    // Get Data
    firebase.database().ref('lampu/cek/').on('value', function (snapshot) {
        var value = snapshot.val();
        var htmls = [];
        $.each(value, function (index, value) {
            if (value) {
                htmls.push('<tr>\
                <td>' + value.tanggal + '</td>\
                <td>' + value.lampu1 + '</td>\
                <td>' + value.lampu2 + '</td>\
                <td>' + value.lampu3 + '</td>\
                <td>' + value.lampu4 + '</td>\
             </tr>');
            }
            lastIndex = index;
        });
        $('#tbody').html(htmls);
        $("#submitLaporan").removeClass('disabled');
    });

    // Add Data
    $('#submitLaporan').on('click', function () {
        var values = $("#addLaporan").serializeArray();
        var tanggal = values[0].value;
        var lampu_nyala = values[1].value;
        var lampu_mati = values[2].value;
        var lampu_baru = values[3].value;
        //var userID = lastIndex + 1;

        firebase.database().ref('laporan/data_laporan/').push({
            tanggal: tanggal,
            lampu_nyala: lampu_nyala,
            lampu_mati: lampu_mati,
            lampu_baru: lampu_baru,
        });

        // Reassign lastID value
        lastIndex = userID;
        $("#addLaporan input").val("");
        // menampilkan alert
        alert("Berhasil menambah data");
        // toastr.success("Berhasil menambah data");
    });

    // Update Data
    var updateID = 0;
    $('body').on('click', '.updateLaporan', function () {
        updateID = $(this).attr('data-id');
        firebase.database().ref('laporan/data_laporan/' + updateID).on('value', function (snapshot) {
            var values = snapshot.val();
            var updateData = '<div class="form-group">\
                <label for="edit_tanggal" class="col-md-12 col-form-label">Tanggal</label>\
                <div class="col-md-12">\
                    <input id="edi_tanggal" name="tanggal" type="date" value="' + values.tanggal + '" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask required autofocus>\
                </div>\
            </div>\
            <div class="form-group">\
                <label for="edit_lampu_nyala" class="col-md-12 col-form-label">Lampu Nyala</label>\
                <div class="col-md-12">\
                    <input id="edit_lampu_nyala" type="text" class="form-control" name="lampu_nyala" value="' + values.lampu_nyala + '" placeholder="Nomor Induk Siswa" required autofocus>\
                </div>\
            </div>\
            <div class="form-group">\
                <label for="edit_lampu_mati" class="col-md-12 col-form-label">Lampu Mati</label>\
                <div class="col-md-12">\
                    <input id="edit_lampu_mati" type="text" class="form-control" name="lampu_mati" value="' + values.lampu_mati + '" placeholder="Nama Siswa" required autofocus>\
                </div>\
            </div>\
            <div class="form-group">\
                <label for="edit_lampu_baru" class="col-md-12 col-form-label">Lampu Baru</label>\
                <div class="col-md-12">\
                    <input id="edit_lampu_baru" type="text" class="form-control" name="lampu_mati" value="' + values.lampu_baru + '" placeholder="Usia" required autofocus>\
                </div>\
            </div>';

            $('#updateBody').html(updateData);
        });
    });

    $('.updateLaporan').on('click', function () {
        var values = $(".users-update-record-model").serializeArray();
        var postData = {
            tanggal: values[0].value,
            lampu_nyala: values[1].value,
            lampu_mati: values[2].value,
            lampu_baru: values[3].value,
        };
        var updates = {};
        updates['/laporan/data_laporan/' + updateID] = postData;
        firebase.database().ref().update(updates);
        // menyembunyikan modal 
        $("#update-modal").modal('hide');
        // menampilkan alert
        alert("Berhasil mengubah data");
    });

    // Remove Data
    $("body").on('click', '.removeLaporan', function () {
        var id = $(this).attr('data-id');
        $('body').find('.users-remove-record-model').append('<input name="id" type="hidden" value="' + id + '">');
    });

    $('.deleteLaporan').on('click', function () {
        var values = $(".users-remove-record-model").serializeArray();
        var id = values[0].value;
        firebase.database().ref('laporan/data_laporan/' + id).remove();
        $('body').find('.users-remove-record-model').find("input").remove();
        // menyembunyikan modal
        $("#remove-modal").modal('hide');
        // menampilkan alert
        alert("Berhasil menghapus data");
        // toastr.success("Berhasil menghapus data");
    });
    $('.remove-data-from-delete-form').click(function () {
        $('body').find('.users-remove-record-model').find("input").remove();
    });
</script>

<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->

<?php echo view('_partials/footer'); ?>