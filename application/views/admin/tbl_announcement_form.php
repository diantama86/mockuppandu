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
        <small>Announcement</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Setting</li>
        <li class="active">Announcement</li>
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
                                    <label for="content">Announcement Content <?php echo form_error('content') ?></label>
                                    <textarea class="form-control" rows="3" name="content" id="content" placeholder="content"><?php echo $content; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="int">Set Status <?php echo form_error('status') ?></label>
                                    <?php
                                    $dd_status_att = 'class="form-control select2"';
                                    echo form_dropdown('status', $status, $status_selected, $dd_status_att);
                                    ?>    
                                </div>
                                <input type="hidden" name="id_announcement" value="<?php echo $id_announcement; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('admin/announcement') ?>" class="btn btn-default">Cancel</a>
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
