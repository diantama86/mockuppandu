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
        <li class="active">Detail</li>
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
                            <table class="table">
                                <tr><td width="30%">Username</td><td><?php echo $username; ?></td></tr>
                                <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
                                <tr><td>Jabatan</td><td><?php echo $jabatan; ?></td></tr>
                                <tr><td>Department</td><td><?php echo $department; ?></td></tr>
                                <tr><td></td><td><a href="<?php echo site_url('admin/user') ?>" class="btn btn-default">Cancel</a></td></tr>
                            </table>
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
