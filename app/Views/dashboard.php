<?php 
$data['title'] = "Dashboard";
echo view('_partials/header', $data); 
?>
<?php echo view('_partials/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h5 class="m-0">Welcome!</h5>
                        </div>
                        <div class="card-body">
                            <p>Web ini adalah halaman untuk mendata laporan dari aplikasi Kontrol Lampu</p>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="m-0">Latest Transaction</h5>
                        </div>
                        <div class="card-body">
                            <p>Halaman latest transaction</p>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<?php echo view('_partials/footer'); ?>