<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url() ?>assets/images/user/user3-128x128.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php
                    $q = $this->session->nama;
                    $tampil = explode(" ", $q);
                    echo $tampil[0];
                    ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="<?php echo base_url('dashboard') ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Inventory</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Jaminan') ?>"><i class="fa fa-circle-o"></i> Office Branch</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Employee Absence</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Jaminan') ?>"><i class="fa fa-circle-o"></i> Perekaman Jaminan</a></li>
                    <li><a href="<?php echo base_url('Jaminan/browse') ?>"><i class="fa fa-circle-o"></i> Browse Jaminan</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-text-o"></i>
                    <span>Report</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Out') ?>"><i class="fa fa-circle-o"></i> Master List</a></li>
                    <li><a href="<?php echo base_url('Jaminan/browse') ?>"><i class="fa fa-circle-o"></i> Realisasi</a></li>
                </ul>
            </li>
            <li>
                <a href="<?php echo base_url('dashboard') ?>">
                    <i class="fa fa-dashboard"></i> <span>Global Summary</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-database"></i>
                    <span>Settings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Perusahaan') ?>"><i class="fa fa-circle-o"></i> Database Perusahaan</a></li>
                    <li><a href="<?php echo base_url('Penjamin') ?>"><i class="fa fa-circle-o"></i> Database Penjamin</a></li>
                    <li><a href="<?php echo base_url('Seksi') ?>"><i class="fa fa-circle-o"></i> Database Seksi</a></li>
                </ul>
            </li>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">