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
                                </div>
                                <div class="col-md-4 text-center">
                                    <div style="margin-top: 8px" id="message">
                                        <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                    </div>
                                </div>
                                <div class="col-md-4 text-right">
                                    <form action="<?php echo site_url('admin/absence/search'); ?>" class="form-inline" method="post">
                                        <input name="keyword" class="form-control" value="<?php echo $keyword; ?>" />
                                        <?php
                                        if ($keyword <> '') {
                                            ?>
                                            <a href="<?php echo site_url('admin/absence'); ?>" class="btn btn-default">Reset</a>
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
                                    <th width="60%">Name</th>
                                    <th width="10%">Date</th>
                                    <th width="10%">In</th>
                                    <th width="10%">Out</th>
                                    <th width="5%">Action</th>
                                </tr><?php
                                foreach ($absence_data as $absence) {
                                    ?>
                                    <tr>
                                        <td><?php echo ++$start ?></td>
                                        <td><?php echo $absence->nama_user ?></td>
                                        <td><?php echo $absence->date_absence ?></td>
                                        <td><?php echo $absence->time_in ?></td>
                                        <td><?php echo $absence->time_out ?></td>
                                        <td style="text-align:center">
                                            <div class="btn-group fa-border">
                                                <a class="btn btn-success" href="<?php echo base_url() . "admin/absence/update/" . $absence->id_absence ?>"><i class="fa fa-edit"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
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
