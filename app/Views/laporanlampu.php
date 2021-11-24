<?php 
$data['title'] = "Cek Lampu";
echo view('_partials/header', $data); 
?>
<?php echo view('_partials/sidebar'); ?>
<style type="text/css">
    .penomoran {
      counter-reset: serial-number;  /* Atur penomoran ke 0 */
    }
    .penomoran td:first-child:after {
      counter-increment: serial-number;  /* Kenaikan penomoran */
      content: counter(serial-number);  /* Tampilan counter */
    }
</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Cek Lampu</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Cek Lampu</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

<!-- TABLE -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
            <!-- CEK LAMPU -->
    
                <div class="col-md-6">
                <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Realtime</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
    <!--                     
                            <tr>
                                <td>Tanggal</td>
                            </tr>
                            <tr>
                                <td>Lampu 1</td>
                            </tr>
                            <tr>
                                <td>Lampu 2</td>
                            </tr>
                            <tr>
                                <td>Lampu 3</td>
                            </tr>
                            <tr>
                                <td>Lampu 4</td>
                            </tr>
                        -->
                        <tbody id="tbody2">

                        </tbody>
                    </table>
                    
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
                </div>
            
            <!--Info-->
            <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Info</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap penomoran">
    <!--                     
                            <tr>
                                <td>Tanggal</td>
                            </tr>
                            <tr>
                                <td>Lampu 1</td>
                            </tr>
                            <tr>
                                <td>Lampu 2</td>
                            </tr>
                            <tr>
                                <td>Lampu 3</td>
                            </tr>
                            <tr>
                                <td>Lampu 4</td>
                            </tr>
                        -->
                        <tbody id="tbody3">

                        </tbody>
                    </table>
                    
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
                </div>
                
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">History</h3>
                            <!-- <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                            </div> -->

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
              <div class="card-body table-responsive p-0" style="height: 500px;">
                <table class="table table-hover text-nowrap table-head-fixed">
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
        <!-- /.row -->
        </div>
    </div>
</div>

<!-- Update Model -->
<form action="" method="POST" class="users-update-record-model form-horizontal">
    <div id="update-modal" data-backdrop="static" data-keyboard="false" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="width:55%;">
            <div class="modal-content" style="overflow: hidden;">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Update</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body" id="updateBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-success LampuTambah">Update
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

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
    firebase.database().ref('data_lampu/lampu/').on('value', function (snapshot) {
        var value = snapshot.val();
        var htmls = [];
        
        $.each(value, function (index, value) {
            if (value) {
                htmls.push('<tr>\
                <td>Lampu </td>\
                <td>untuk ' + value.namalampu + '</td>\
             </tr>');
            }
            lastIndex = index;
        });
        $('#tbody3').html(htmls);
        $("#submitLaporan").removeClass('disabled');
    });
    
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

    // Get Data
    firebase.database().ref('lampu/cek/').limitToLast(1).on('value', function (snapshot) {
        var value = snapshot.val();
        var htmls = [];
        $.each(value, function (index, value) {
            if (value) {
                htmls.push('<tr>\
                <th>Tanggal</th>\
                <td>' + value.tanggal + '</td>\
                </tr>\
                <tr>\
                <th>Lampu 1</th>\
                <td>' + value.lampu1 + '</td>\
                </tr>\
                <tr>\
                <th>Lampu 2</th>\
                <td>' + value.lampu2 + '</td>\
                </tr>\
                <tr>\
                <th>Lampu 3</th>\
                <td>' + value.lampu3 + '</td>\
                </tr>\
                <tr>\
                <th>Lampu 4</th>\
                <td>' + value.lampu4 + '</td>\
                </tr>');
            }
            // akhirIndex = indexx;
            lastIndex = index;
        });
        $('#tbody2').html(htmls);
        $("#submitLaporan").removeClass('disabled');
    });
    
    // Update Data
    // var updateID = 0;
    $('body').on('click', '.LampuTambah', function () {
        // updateID = $(this).attr('data-id');

        firebase.database().ref('lampu/tambah_lampu/-MfliC7KFOW3F0V5Y_o61').on('value', function (snapshot) {
            var values = snapshot.val();
            var updateData = '<div class="form-group">\
                <label for="edit_lampu_nyala" class="col-md-12 col-form-label">Tambah Lampu</label>\
                <div class="col-md-12">\
                    <input id="lampuTambah" type="number" class="form-control" name="tambah_lampu" value="' + values.tambah_lampu + '" placeholder="Tambah Lampu" required autofocus>\
                </div>\
            </div>';

            $('#updateBody').html(updateData);
        });
    });

    $('.LampuTambah').on('click', function () {
        var values = $(".users-update-record-model").serializeArray();
        var postData = {
            tambah_lampu: values[0].value,
        };
        var updates = {};
        updates['/lampu/tambah_lampu/-MfliC7KFOW3F0V5Y_o61'] = postData;
        firebase.database().ref().update(updates);
        // menyembunyikan modal 
        $("#update-modal").modal('hide');
        // menampilkan alert
        alert("Berhasil mengubah data");
    });

    // // Remove Data
    // $("body").on('click', '.removeLaporan', function () {
    //     var id = $(this).attr('data-id');
    //     $('body').find('.users-remove-record-model').append('<input name="id" type="hidden" value="' + id + '">');
    // });

    // $('.deleteLaporan').on('click', function () {
    //     var values = $(".users-remove-record-model").serializeArray();
    //     var id = values[0].value;
    //     firebase.database().ref('laporan/data_laporan/' + id).remove();
    //     $('body').find('.users-remove-record-model').find("input").remove();
    //     // menyembunyikan modal
    //     $("#remove-modal").modal('hide');
    //     // menampilkan alert
    //     alert("Berhasil menghapus data");
    //     // toastr.success("Berhasil menghapus data");
    // });
    // $('.remove-data-from-delete-form').click(function () {
    //     $('body').find('.users-remove-record-model').find("input").remove();
    // });
</script>

<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->

<?php echo view('_partials/footer'); ?>
