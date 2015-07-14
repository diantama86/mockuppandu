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
        <h2 style="margin-top:0px">Tbl_jabatan <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                <label for="nama_jabatan">nama_jabatan <?php echo form_error('nama_jabatan') ?></label>
                <textarea class="form-control" rows="3" name="nama_jabatan" id="nama_jabatan" placeholder="nama_jabatan"><?php echo $nama_jabatan; ?></textarea>
            </div>
	    <input type="hidden" name="id_jabatan" value="<?php echo $id_jabatan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('jabatan') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>