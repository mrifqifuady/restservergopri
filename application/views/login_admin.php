<!DOCTYPE html>
<html lang="en">
<!-- Dependencies -->

<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GOPRI</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="<?php echo base_url('');?>apple-icon.png" href="">
    <link rel="shortcut icon"  href="<?php echo base_url('');?>favicon.ico">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <link href="<?php echo base_url('');?>assets/css/normalize.css" rel="stylesheet">
    <link href="<?php echo base_url('');?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('');?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url('');?>assets/css/themify-icons.css" rel="stylesheet">
    <link href="<?php echo base_url('');?>assets/css/flag-icon.min.css" rel="stylesheet">
    <link href="<?php echo base_url('');?>assets/css/cs-skin-elastic.css" rel="stylesheet">
    <link href="<?php echo base_url('');?>assets/scss/style.css" rel="stylesheet">
    <link href="<?php echo base_url('');?>assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">
   
   </head>
<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <!-- <img class="align-content" src="<?php echo base_url('');?>images/logo.png" alt=""> -->
                        GOPRI
                    </a>
                </div>
                <div class="login-form">
                    <?php echo form_open_multipart('admin/cekLogin') ?>
                    <h5 class="text-center title-login">
                        <?php if (isset($sukses)) { ?>
                        <p style="color: white;"><i><?php echo $sukses; ?>&nbsp</i></p>
                        <?php } ?>
                    </h5>
                    <?php echo validation_errors(); ?>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" placeholder="username" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                            <label class="pull-right">
                                <a href="#">Forgotten Password?</a>
                            </label>

                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30" value="login">Sign in</button>
                       <?php echo form_close(); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>

    <!-- jQuery -->
        <script src="<?php echo base_url('') ?>assets/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url('') ?>assets/bootstrap/js/bootstrap.min.js"></script>

        <script src="<?php echo base_url('') ?>assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="<?php echo base_url('') ?>assets/js/plugins.js"></script>
    <script src="<?php echo base_url('') ?>assets/js/main.js"></script>


    <script src="<?php echo base_url('') ?>assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="<?php echo base_url('') ?>assets/js/dashboard.js"></script>
    <script src="<?php echo base_url('') ?>assets/js/widgets.js"></script>
    <script src="<?php echo base_url('') ?>assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="<?php echo base_url('') ?>assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="<?php echo base_url('') ?>assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="<?php echo base_url('') ?>assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
    <script>
        ( function ( $ ) {
            "use strict";

            jQuery( '#vmap' ).vectorMap( {
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: [ '#1de9b6', '#03a9f5' ],
                normalizeFunction: 'polynomial'
            } );
        } )( jQuery );
    </script>

