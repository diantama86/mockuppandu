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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box box-danger box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Important Announcement</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /.box-tools -->
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <?php
                                    foreach ($announcement AS $data) {
                                        ?>
                                        <?php echo $data->content ?><br>
                                    <?php } ?>
                                </div><!-- /.box-body -->
                            </div>

                            <!-- Info boxes -->
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">CPU Traffic</span>
                                            <span class="info-box-number">90<small>%</small></span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </div><!-- /.col -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Likes</span>
                                            <span class="info-box-number">41,410</span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </div><!-- /.col -->

                                <!-- fix for small devices only -->
                                <div class="clearfix visible-sm-block"></div>

                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Sales</span>
                                            <span class="info-box-number">760</span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </div><!-- /.col -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">New Members</span>
                                            <span class="info-box-number">2,000</span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->

                            <div class="row">
                                <!-- Left col -->
                                <div class="col-md-8">
                                    <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>                      
                                </div><!-- /.col -->

                                <div class="col-md-4">
                                    <!-- Info Boxes Style 2 -->
                                    <div class="info-box bg-yellow">
                                        <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Inventory</span>
                                            <span class="info-box-number">5,200</span>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: 50%"></div>
                                            </div>
                                            <span class="progress-description">
                                                50% Increase in 30 Days
                                            </span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                    <div class="info-box bg-green">
                                        <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Mentions</span>
                                            <span class="info-box-number">92,050</span>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: 20%"></div>
                                            </div>
                                            <span class="progress-description">
                                                20% Increase in 30 Days
                                            </span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                    <div class="info-box bg-red">
                                        <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Downloads</span>
                                            <span class="info-box-number">114,381</span>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: 70%"></div>
                                            </div>
                                            <span class="progress-description">
                                                70% Increase in 30 Days
                                            </span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                    <div class="info-box bg-aqua">
                                        <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Direct Messages</span>
                                            <span class="info-box-number">163,921</span>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: 40%"></div>
                                            </div>
                                            <span class="progress-description">
                                                40% Increase in 30 Days
                                            </span>
                                        </div><!-- /.info-box-content -->
                                    </div><!-- /.info-box -->
                                </div><!-- /.col -->
                            </div><!-- /.row -->


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
<script type="text/javascript">
    $(function () {

        $(document).ready(function () {

            // Build the chart
            $('#container').highcharts({
                credits: {
                    enabled: false
                },
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Browser market shares January, 2015 to May, 2015'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [{
                        name: "Brands",
                        colorByPoint: true,
                        data: [{
                                name: "Microsoft Internet Explorer",
                                y: 56.33
                            }, {
                                name: "Chrome",
                                y: 24.03,
                                sliced: true,
                                selected: true
                            }, {
                                name: "Firefox",
                                y: 10.38
                            }, {
                                name: "Safari",
                                y: 4.77
                            }, {
                                name: "Opera",
                                y: 0.91
                            }, {
                                name: "Proprietary or Undetectable",
                                y: 0.2
                            }]
                    }]
            });
        });
    });
</script>
<script src="<?php echo base_url('assets/highchart-4.1.7/js/highcharts.js') ?>"></script>
<script src="<?php echo base_url('assets/highchart-4.1.7/js/modules/exporting.js') ?>"></script>
<?php
$this->load->view('template/foot');
?>
