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
        Setting
        <small>Employee Database</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Setting</li>
        <li class="active">Employee Database</li>
        <li class="active">New Employee</li>
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
                                    <label for="nama">Nama <?php echo form_error('nama') ?></label>
                                    <input type="text" name="nama" class="form-control" value="<?php echo $nama ?>" placeholder="Masukkan Nama">
                                </div>
                                <div class="form-group">
                                    <label for="username">Username <?php echo form_error('username') ?></label>
                                    <input type="text" name="username" class="form-control" value="<?php echo $username ?>" placeholder="Masukkan Username">
                                </div>
                                <div class="form-group">
                                    <label for="int">Jabatan <?php echo form_error('id_jabatan') ?></label>
                                    <?php
                                    $dd_jabatan_att = 'class="form-control select2"';
                                    echo form_dropdown('id_jabatan', $id_jabatan, $jabatan_selected, $dd_jabatan_att);
                                    ?>                                 
                                </div>
                                <div class="form-group">
                                    <label for="int">Department <?php echo form_error('id_department') ?></label>
                                    <?php
                                    $dd_department_att = 'class="form-control select2"';
                                    echo form_dropdown('id_department', $id_department, $department_selected, $dd_department_att);
                                    ?>                                 
                                </div>
                                <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('admin/user') ?>" class="btn btn-default">Cancel</a>
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
