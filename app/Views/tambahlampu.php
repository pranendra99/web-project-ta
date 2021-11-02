<?php 
$data['title'] = "Tambah Lampu";
echo view('_partials/header', $data); 
?>
<?php echo view('_partials/sidebar'); ?>
<!-- <?php date_default_timezone_set('Asia/Jakarta'); ?> -->
<style type="text/css">
    .penomoran {
      counter-reset: serial-number;  /* Atur penomoran ke 0 */
    }
    .penomoran td:first-child:before {
      counter-increment: serial-number;  /* Kenaikan penomoran */
      content: counter(serial-number);  /* Tampilan counter */
    }
</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Lampu</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Lampu</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

<!-- SELECT2 EXAMPLE -->
<section class="content">
      <div class="container-fluid">
        <div class="card card-default card-primary collapsed-card">
          <div class="card-header">
            <h3 class="card-title">Tambah Data</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
            
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
              <form id="addLaporan" method="POST" action="">
                
                <div class="form-group">
                    <label for="Nama Lampu">Nama Lampu</label> (Contoh: Lampu Depan Kelas 1)
                    <!-- <input type="text" name="lampu" class="form-control" id="lampu" placeholder="Lampu" required autofocus> -->
                    <input type="hidden" id="tanggal" name="tanggal" value="<?php echo date("d/m/Y H:i:s"); ?>"/>
                    <input type="text" name="namalampu" class="form-control" id="namalampu" placeholder="Nama Lampu" required autofocus>
                    <br>  
                    <label for="Kondisi">Kondisi Lampu</label>
                    <select id="kondisi" name="kondisi" class="form-control" placeholder="Kondisi" required autofocus>
                          <option>Pilih</option>
                          <option value="Nyala">Nyala</option>
                          <option value="Mati">Mati</option>
                    </select>
                    <!-- <label for="Nilai">Nilai</label>
                    <select id="Kondisi" name="Kondisi" class="form-control" placeholder="Kondisi" required autofocus>
                          <option>Pilih</option>
                          <option value="Nyala">Nyala</option>
                          <option value="Mati">Mati</option>
                    </select> -->
                </div>
                <!-- /.form-group -->
              
              <!-- /.col -->
              </form>
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
            <div class="card-footer">
                <button id="submitLaporan" type="submit button" class="btn btn-primary">Submit</button>
            </div>
        </div>
        <!-- /.card -->
    </div>
</section>


<!-- TABLE -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Lampu</h3>


                            <div class="card-tools">
                                <!-- <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div> -->
                                <!-- <br>
                                <button id="hapusData" type="submit button" class="btn btn-danger">Hapus</button> -->
                            </div>
                        </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 350px;">
                <table class="table table-hover text-nowrap table-head-fixed penomoran">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Lampu</th>
                      <th>Kondisi Lampu</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="tbody">
                    

                  </tbody>
                  <!-- <td><button id="hapusData" type="submit button" class="btn btn-danger">Hapus data terakhir</button></td> -->
                  
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
                    <button type="button" class="btn btn-success updateLaporan">Update
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Delete Model -->
<form action="" method="POST" class="users-remove-record-model">
    <div id="remove-modal" data-backdrop="static" data-keyboard="false" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Delete</h4>
                    <button type="button" class="close remove-data-from-delete-form" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data lampu ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-danger waves-effect waves-light deleteLaporan">Delete
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

    // var lastIndex = 0;

    // Get Data
    firebase.database().ref('data_lampu/lampu/').on('value', function (snapshot) {
        var value = snapshot.val();
        var htmls = [];
        let no = "";

        $.each(value, function (index, value) {
            if (value) {
                htmls.push('<tr>\
                    <td></td>\
                    <td>' + value.namalampu +'</td>\
                    <td>' + value.kondisi + '</td>\
                    <td><button data-toggle="modal" data-target="#update-modal" class="btn btn-info updateLaporan" data-id="' + index + '">Update</button>\
                    <button data-toggle="modal" data-target="#remove-modal" class="btn btn-danger removeLaporan" data-id="' + index + '">Delete</button></td>\
            </tr>');
            }

            // lastIndex = index;
        });
        
        $('#tbody').html(htmls);
        $("#submitLaporan").removeClass('disabled');
    });

// <td>' + value.no + '</td>\
// <td><button data-toggle="modal" data-target="#update-modal" class="btn btn-info updateLaporan" data-id="' + index + '">Update</button>\

    // Hapus Data

    // $('#hapusData').on('click', function () {
    //     // firebase.database().ref('/data_lampu/lampu/').limitToLast(1).remove();
        

    //     const del = firebase.database().ref('/data_lampu/lampu');
    //     del.limitToLast(1).once("value", (snapshot) => {
    //         snapshot.forEach((lampSnapshot) =>{
    //              lampSnapshot.ref.remove();
    //         })
    //     })

    //     // menampilkan alert
    //     alert("Berhasil menghapus data");        
    // });

    // Add Data
    $('#submitLaporan').on('click', function () {
        var values = $("#addLaporan").serializeArray();
        //var lampu = values[0].value;
        var tanggal = values[0].value;
        var namalampu = values[1].value;
        var kondisi = values[2].value;
        // var nilai = values[1].value;
        // var nomer = nom + 1;


        // document.getElementById('kondisi').addEventListener('change', function (e) {
        //   if (e.target.value === "Nyala") {
        //     var nilai = 0;
        //   }else if(e.target.value === "Mati") {
        //     var nilai = 1;
        //   }
        // });

        // nil = nilai;

        if(document.getElementById('kondisi').value == "Nyala") {
            var nilai = 0;
        }else if(document.getElementById('kondisi').value == "Mati"){
            var nilai = 1;
        }

        firebase.database().ref('data_lampu/lampu/').push({
            tanggal: tanggal, 
            namalampu: namalampu,
            kondisi: kondisi,
            nilai: nilai,
        });

        // Reassign lastID value
        // lastIndex = userID;
        $("#addLaporan input").val("");
        // menampilkan alert
        alert("Berhasil menambah data");
        //reload page
        location.reload();
        return false;
    });

    // Update Data
    var updateID = 0;
    $('body').on('click', '.updateLaporan', function () {
        updateID = $(this).attr('data-id');
        
        firebase.database().ref('data_lampu/lampu/' + updateID).on('value', function (snapshot) {
            var values = snapshot.val();
            var updateData = '<div class="form-group">\
                <label for="namalampu" class="col-form-label">Nama Lampu</label> (Contoh: Lampu Depan Kelas 1)\
                <div class="col-md-12">\
                    <input type="hidden" id="tanggal1" name="tanggal" value="<?php echo date("d/m/Y H:i:s"); ?>"/>\
                    <input id="namalampu" type="text" class="form-control" name="namalampu" value="' + values.namalampu + '" placeholder="Nama Lampu" required autofocus>\
                </div>\
            </div>\
            <div class="form-group">\
                <label for="kondisi" class="col-form-label">Kondisi Lampu</label>\
                <div class="col-md-12">\
                    <select id="kondisiUbah" name="kondisi" class="form-control" placeholder="Kondisi" required autofocus>\
                          <option>Pilih</option>\
                          <option value="Nyala">Nyala</option>\
                          <option value="Mati">Mati</option>\
                    </select>\
                </div>\
            </div>';

            $('#updateBody').html(updateData);
        });
    });


    // "'+if (values.nilai==0) {"selected"}+'"\
    // "'+if (values.nilai==1) {"selected"}+'"\
    // '+ if (values.kondisi == "Nyala") {"'selected'"}+'
    // '+ if (values.kondisi == "Mati") {"'selected'"}+'

    $('.updateLaporan').on('click', function () {
        var values = $(".users-update-record-model").serializeArray();
        var tanggal = values[0].value;
        
        // var nomer = lastIndex + 0;

        if(document.getElementById('kondisiUbah').value == "Nyala") {
            var nilai = 0;
        }else if(document.getElementById('kondisiUbah').value == "Mati"){
            var nilai = 1;
        }

        var postData = {
            tanggal: tanggal,
            namalampu: values[1].value,
            kondisi: values[2].value,
            nilai: nilai,
        };
        var updates = {};
        updates['/data_lampu/lampu/' + updateID] = postData;
        firebase.database().ref().update(updates);

        // Reassign lastID value
        // lastIndex = nomer;

        // menyembunyikan modal 
        $("#update-modal").modal('hide');
        // menampilkan alert
        alert("Berhasil mengubah data");
        //reload page
        location.reload();
        return false;
    });

//////////////
    // Remove Data
    $("body").on('click', '.removeLaporan', function () {
        var id = $(this).attr('data-id');
        $('body').find('.users-remove-record-model').append('<input name="id" type="hidden" value="' + id + '">');
    });

    $('.deleteLaporan').on('click', function () {
        var values = $(".users-remove-record-model").serializeArray();
        var id = values[0].value;
        firebase.database().ref('data_lampu/lampu/' + id).remove();
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

<!-- <input id="no" type="hidden" class="form-control" name="no" value="' + values.no + '" placeholder="Lampu Nyala" required autofocus>\ -->