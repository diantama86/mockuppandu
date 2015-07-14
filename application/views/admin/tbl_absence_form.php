<?php
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/admin/sidebar');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Employee Absence
        <small>Browse Absence</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Employee Absence</li>
        <li class="active">Browse Absence</li>
        <li class="active">Update Absence</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?php echo $action; ?>" method="post">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="id_user" id="id_user" placeholder="id_user" value="<?php echo $id_user; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="int">Nama Karyawan <?php echo form_error('nama_user') ?></label>
                                    <input type="text" class="form-control" name="nama_user" id="nama_user" placeholder="nama_user" readonly="readonly" value="<?php echo $nama_user; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="date">Tanggal Absen <?php echo form_error('date_absence') ?></label>
                                    <input type="text" class="form-control" name="date_absence" id="date_absence" placeholder="date_absence" value="<?php echo $date_absence; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="time">Jam Masuk <?php echo form_error('time_in') ?></label>
                                    <input type="text" class="form-control" name="time_in" id="time_in" placeholder="time_in" value="<?php echo $time_in; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="time">Jam Keluar <?php echo form_error('time_out') ?></label>
                                    <input type="text" class="form-control" name="time_out" id="time_out" placeholder="time_out" value="<?php echo $time_out; ?>" />
                                </div>
                                <input type="hidden" name="id_absence" value="<?php echo $id_absence; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('admin/absence') ?>" class="btn btn-default">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
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
