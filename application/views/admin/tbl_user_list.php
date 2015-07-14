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
        <small>Employee</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Setting</li>
        <li class="active">Employee</li>
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
                            <div class="row" style="margin-bottom: 10px">
                                <div class="col-md-4">
                                    <?php echo anchor(site_url('admin/user/create'), 'Create', 'class="btn btn-primary"'); ?>
                                </div>
                                <div class="col-md-4 text-center">
                                    <div style="margin-top: 8px" id="message">
                                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                    </div>
                                </div>
                                <div class="col-md-4 text-right">
                                    <form action="<?php echo site_url('admin/user/search'); ?>" class="form-inline" method="post">
                                        <input name="keyword" class="form-control" value="<?php echo $keyword; ?>" />
                                        <?php
                                        if ($keyword <> '') {
                                            ?>
                                            <a href="<?php echo site_url('admin/user'); ?>" class="btn btn-default">Reset</a>
                                            <?php
                                        }
                                        ?>
                                        <input type="submit" value="Search" class="btn btn-primary" />
                                    </form>
                                </div>
                            </div>
                            <table class="table table-bordered" style="margin-bottom: 10px">
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Department</th>
                                    <th>Action</th>
                                </tr><?php
                                foreach ($user_data as $user) {
                                    ?>
                                    <tr>
                                        <td><?php echo ++$start ?></td>
                                        <td><?php echo $user->username ?></td>
                                        <td><?php echo $user->nama_user ?></td>
                                        <td><?php echo $user->nama_jabatan ?></td>
                                        <td><?php echo $user->nama_department ?></td>
                                        <td style="text-align:center">
                                            <div class="btn-group fa-border">
                                                <a class="btn btn-warning" href="<?php echo base_url() . "admin/user/create/" . $user->id_user ?>"><i class="fa fa-plus-circle"></i></a>
                                                <a class="btn btn-success" href="<?php echo base_url() . "admin/user/read/" . $user->id_user ?>"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-danger" href="<?php echo base_url() . "admin/user/delete/" . $user->id_user ?>"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="pagination" style="margin-top: 0px">
                                        <li class="active"><a href="#">Total Record : <?php echo $total_rows ?></a></li>
                                    </ul>
                                </div>
                                <div class="col-md-6 text-right">
                                    <?php echo $pagination ?>
                                </div>
                            </div>
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
