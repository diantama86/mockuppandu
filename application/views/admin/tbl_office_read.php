<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Tbl_office Read</h2>
        <table class="table">
	    <tr><td>branch_name</td><td><?php echo $branch_name; ?></td></tr>
	    <tr><td>branch_address</td><td><?php echo $branch_address; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('office') ?>" class="btn btn-default">Cancel</button></td></tr>
	</table>
    </body>
</html>