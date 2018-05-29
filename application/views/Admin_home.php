<?php $this->load->view('header');?>

<!DOCTYPE html>
<html lang="en">

<body>

    <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            <!-- <div class="col-sm-12">
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                  <span class="badge badge-pill badge-success">Success</span> You successfully read this important alert message.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div> -->


           <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-1">
                    <div class="card-body pb-0">
                        <h4 class="mb-0">
                            <span class="count">10468</span>
                        </h4>
                        <p class="text-light">guru belum verifikasi</p>

                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart1"></canvas>
                        </div>

                    </div>

                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-2">
                    <div class="card-body pb-0">
                        <h4 class="mb-0">
                            <span class="count">10468</span>
                        </h4>
                        <p class="text-light">Guru verified</p>

                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart2"></canvas>
                        </div>

                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-3">
                    <div class="card-body pb-0">
                        <h4 class="mb-0">
                            <span class="count">10468</span>
                        </h4>
                        <p class="text-light">Siswa terdaftar</p>

                    </div>

                        <div class="chart-wrapper px-0" style="height:70px;" height="70">
                            <canvas id="widgetChart3"></canvas>
                        </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-4">
                    <div class="card-body pb-0">
                        <h4 class="mb-0">
                            <span class="count">10468</span>
                        </h4>
                        <p class="text-light">pesanan</p>

                        <div class="chart-wrapper px-3" style="height:70px;" height="70">
                            <canvas id="widgetChart4"></canvas>
                        </div>

                    </div>
                </div>
            </div>
            <!--/.col-->


        </div> <!-- .content -->

  
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="col-sm-6 col-lg-4">
        <table class="table table-bordered" id="example2">
            <thead>
                <td>nama mapel</td>
                <td> 
                    <center><a data-toggle="modal" class="btn-secondary btn-sm" style="background-color: #272c33" href="#ModalInputMapel"><i class="fa fa-plus"></i> Mapel </a>
                    </center>
                </td>
            </thead>
            <tbody>
                <?php foreach ($daftar_mapel as $key) { ?>
                    <tr>
                        <td><?php echo $key->nama_mapel ?></td>
                        <td ><center>
                            <a data-toggle="modal" href="#ModalUpdateMapel"onclick="return forUpdateMapel(<?php echo $key->id_mapel.",'".$key->nama_mapel."'"; ?>);"><i class="fa fa-edit"></i></a>
                            <a href="<?php echo site_url('Admin/deleteMapel/').$key->id_mapel?>" type="button" ><i class="fa fa-trash"></i></a></center>
                        </td>
                    </tr>
                <?php } ?>
            </tbody> 
        </table>
    </div>

    <div class="col-sm-6 col-lg-4">
        <table class="table table-bordered" id="example2">
            <thead>
                <td>nama kelas</td>
                <td> 
                    <center><a data-toggle="modal" class="btn-secondary btn-sm" style="background-color: #272c33" href="#ModalInputKelas"><i class="fa fa-plus"></i> Kelas </a>
                    </center>
                </td>
            </thead>
            <tbody>
                <?php foreach ($daftar_kelas as $key) { ?>
                    <tr>
                        <td><?php echo $key->nama_kelas ?></td>
                        <td ><center>
                            <a data-toggle="modal" href="#ModalUpdateKelas"onclick="return forUpdateKelas(<?php echo $key->id_kelas.",'".$key->nama_kelas."'"; ?>);"><i class="fa fa-edit"></i></a>
                            <a href="<?php echo site_url('Admin/deleteKelas/').$key->id_kelas?>" type="button" ><i class="fa fa-trash"></i></a></center>
                        </td>
                    </tr>
                <?php } ?>
            </tbody> 
        </table>
    </div>

    <div class="col-sm-6 col-lg-4">
        <table class="table table-bordered" id="example2">
            <thead>
                <td>nama Jenjang</td>
                <td> 
                    <center><a data-toggle="modal" class="btn-secondary btn-sm" style="background-color: #272c33" href="#ModalInputJenjang"><i class="fa fa-plus"></i> Jenjang </a>
                    </center>
                </td>
            </thead>
            <tbody>
                <?php foreach ($daftar_jenjang as $key) { ?>
                    <tr>
                        <td><?php echo $key->nama_jenjang ?></td>
                        <td ><center>
                            <a data-toggle="modal" href="#ModalUpdateJenjang"onclick="return forUpdateJenjang(<?php echo $key->id_jenjang.",'".$key->nama_jenjang."'"; ?>);"><i class="fa fa-edit"></i></a>
                            <a href="<?php echo site_url('Admin/deleteJenjang/').$key->id_jenjang?>" type="button" ><i class="fa fa-trash"></i></a></center>
                        </td>
                    </tr>
                <?php } ?>
            </tbody> 
        </table>
    </div>
</div>





<br>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <table class="table table-bordered" id="example2">
        <thead>
            <td>nama</td>
            <td>email</td>
            <td>password</td>
            <td> action </td>
        </thead>
        <tbody>
            <?php foreach ($daftar_guru as $key) { ?>
            <tr>
                <td><?php echo $key->nama ?></td>
                <td><?php echo $key->email ?></td>
                <td><?php echo $key->password ?></td>
                <td class="col-sm-2"><center>
                   <?php if($key->status == '0') { ?>
                   <a href="<?php echo site_url('admin/verGuru/').$key->id_guru?>" type="button" class="btn btn-warning">Verifikasi<i class="glyphicon glyphicon-certificate"></i>
                   </a>
                   <?php } else {
                    if($key->status=='1')
                        echo "verified" ?>
                    <?php } ?>
                                                <!-- <a href="<?php echo site_url('Crud_housing/editSyarat1/').$key->id_s1?>" type="button" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i>
                                                </a>
                                                <a href="<?php echo site_url('Crud_housing/deleteSyarat1/').$key->id_s1?>" type="button" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>
                                                </a> -->

                                            </center>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody> 
                            </table>
                        </div>         



<!-- tampilan pop-up mapel-->
<!-- insert -->
<div class="modal fade" id="ModalInputMapel" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <?php echo form_open_multipart('Admin/createMapel/'); ?>
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel">Tambah Mapel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="nama_mapel1" name="nama_mapel" placeholder="masukkan nama mapel" maxlength="50" required>
            </div>
            <div class="modal-footer">
                <input class="btn btn-primary btn-sm pull-right" type="submit" value="Simpan" name="simpan">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- update -->
<div class="modal fade" id="ModalUpdateMapel" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <!-- <?php echo json_encode($_POST);?> -->
            <?php echo form_open_multipart('Admin/updateMapel/'); ?>
            <?php echo validation_errors(); ?>
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel">Edit Mapel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" id="id_mapel" name="id_mapel" hidden>
                <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" placeholder="masukkan nama mapel" maxlength="50" required>
            </div>
            <div class="modal-footer">
                <input class="btn btn-primary btn-sm pull-right" type="submit" value="Simpan" name="simpan">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- end tampilan pop-up  mapel-->

<!-- tampilan pop-up kelas-->
<!-- insert -->
<div class="modal fade" id="ModalInputKelas" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <?php echo form_open_multipart('Admin/createKelas/'); ?>
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel">Tambah Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="nama_kelas1" name="nama_kelas" placeholder="masukkan nama kelas" maxlength="50" required>
            </div>
            <div class="modal-footer">
                <input class="btn btn-primary btn-sm pull-right" type="submit" value="Simpan" name="simpan">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- update -->
<div class="modal fade" id="ModalUpdateKelas" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
           <!--  <?php echo json_encode($_POST);?> -->
            <?php echo form_open_multipart('Admin/updateKelas/'); ?>
            <?php echo validation_errors(); ?>
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel">Edit Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" id="id_kelas" name="id_kelas" hidden>
                <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="masukkan nama mapel" maxlength="50" required>
            </div>
            <div class="modal-footer">
                <input class="btn btn-primary btn-sm pull-right" type="submit" value="Simpan" name="simpan">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- end tampilan pop-up Kelas -->

<!-- tampilan pop-up JENJANG-->
<!-- insert -->
<div class="modal fade" id="ModalInputJenjang" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <?php echo form_open_multipart('Admin/createJenjang/'); ?>
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel">Tambah Jenjang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="nama_jenjang1" name="nama_jenjang" placeholder="masukkan nama mapel" maxlength="50" required>
            </div>
            <div class="modal-footer">
                <input class="btn btn-primary btn-sm pull-right" type="submit" value="Simpan" name="simpan">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- update -->
<div class="modal fade" id="ModalUpdateJenjang" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <!--<?php echo json_encode($_POST);?> -->
            <?php echo form_open_multipart('Admin/updateJenjang/'); ?>
            <?php echo validation_errors(); ?>
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel">Edit Jenjang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" id="id_jenjang" name="id_jenjang" hidden>
                <input type="text" class="form-control" id="nama_jenjang" name="nama_jenjang" placeholder="masukkan nama mapel" maxlength="50" required>
            </div>
            <div class="modal-footer">
                <input class="btn btn-primary btn-sm pull-right" type="submit" value="Simpan" name="simpan">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- end tampilan pop-up  JENJANG-->

<script>
    function forUpdateMapel(id_mapel,nama_mapel) {
        document.getElementById('id_mapel').value=id_mapel;
        document.getElementById('nama_mapel').value=nama_mapel;
    }
    function forUpdateKelas(id_kelas,nama_kelas) {
        document.getElementById('id_kelas').value=id_kelas;
        document.getElementById('nama_kelas').value=nama_kelas;
    }
    function forUpdateJenjang(id_jenjang,nama_jenjang) {
        document.getElementById('id_jenjang').value=id_jenjang;
        document.getElementById('nama_jenjang').value=nama_jenjang;
    }
</script>

</body>
</html>