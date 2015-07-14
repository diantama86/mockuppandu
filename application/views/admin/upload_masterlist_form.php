<?php
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/select2-4.0.0/dist/css/select2.min.css') ?>" rel="stylesheet" type="text/css" />

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">


                    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" >
                        <div class="form-group">
                            <label for="varchar">Nomor Permohonan <?php echo form_error('nomor_permohonan') ?></label>
                            <input type="text" class="form-control" name="nomor_permohonan" id="nomor_permohonan" placeholder="Masukkan Nomor Permohonan" value="<?php echo $nomor_permohonan; ?>" disabled />
                        </div>
                        <div class="form-group">
                            <label for="date">Tanggal Permohonan <?php echo form_error('tanggal_permohonan') ?></label>
                            <input type="text" class="datepicker form-control" name="tanggal_permohonan" id="tanggal_permohonan" placeholder="Masukkan Tanggal Permohonan" value="<?php echo $tanggal_permohonan; ?>" disabled/>
                        </div>
                        <div class="form-group">
                            <label for="int">Nomor Ijin<?php echo form_error('id_ijin') ?></label>
                            <?php
                            $dd_ijin_att = 'class="form-control select2" readonly';
                            echo form_dropdown('id_ijin', $id_ijin, $ijin_selected, $dd_ijin_att);
                            ?>                        
                        </div>
                        <div class="form-group">
                            <label for="varchar">Pilih File <?php echo $error ?></label>
                            <input class="file" type="file" name="userfile">
                        </div>     
                        <input type="hidden" name="id_out" value="<?php echo $id_out ?>" />
                        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                        <a href="<?php echo site_url('out') ?>" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>        
</section><!-- /.content -->
<?php
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->

<?php
$this->load->view('template/foot');
?>