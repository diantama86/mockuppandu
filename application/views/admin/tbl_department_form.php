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
        Settings
        <small>Department</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Setting</li>
        <li class="active">Department</li>
        <li class="active">New Department</li>
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
                                    <label for="nama_department">Input Department Name <?php echo form_error('nama_department') ?></label>
                                    <textarea class="form-control" rows="3" name="nama_department" id="nama_department" placeholder="Department Name"><?php echo $nama_department; ?></textarea>
                                </div>
                                <input type="hidden" name="id_department" value="<?php echo $id_department; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('admin/department') ?>" class="btn btn-default">Cancel</a>
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
