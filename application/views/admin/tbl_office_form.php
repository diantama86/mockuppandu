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
        Inventory
        <small>Office</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Inventory</li>
        <li class="active">Office</li>
        <li class="active">Input New Office Branch</li>
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
                                    <label for="branch_name">Branch Name <?php echo form_error('branch_name') ?></label>
                                    <input id="branch_name" type="text" name="branch_name" placeholder="Input Branch Name" class="form-control" value="<?php echo $branch_name ?>">
                                </div>
                                <div class="form-group">
                                    <label for="branch_address">Address <?php echo form_error('branch_address') ?></label>
                                    <textarea class="form-control" rows="3" name="branch_address" id="branch_address" placeholder="Branch Address"><?php echo $branch_address; ?></textarea>
                                </div>
                                <input type="hidden" name="id_office" value="<?php echo $id_office; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('admin/office') ?>" class="btn btn-default">Cancel</a>
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
