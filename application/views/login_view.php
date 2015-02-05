<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>timecms // login</title>
    <link rel="shortcut icon" href="<?= base_url(); ?>public/img/avatar_144bf176a04f_128.png">
    <link rel="apple-touch-icon-precomposed" href="<?= base_url(); ?>public/img/avatar_144bf176a04f_128.png">

    <!-- CSS go to here -->
    <link rel="stylesheet" href="<?= base_url();?>public/login/fonts/arimo.css" id="style-resource-1"> 
    <link rel="stylesheet" href="<?= base_url();?>public/login/css/fonts/linecons/css/linecons.css" id="style-resource-2"> 
    <link rel="stylesheet" href="<?= base_url();?>public/login/css/fonts/fontawesome/css/font-awesome.min.css" id="style-resource-3"> 
    <link rel="stylesheet" href="<?= base_url();?>public/login/css/bootstrap.css" id="style-resource-4"> 
    <link rel="stylesheet" href="<?= base_url();?>public/login/css/xenon-core.css" id="style-resource-5"> 
    <link rel="stylesheet" href="<?= base_url();?>public/login/css/xenon-forms.css" id="style-resource-6"> 
    <link rel="stylesheet" href="<?= base_url();?>public/login/css/xenon-components.css" id="style-resource-7">
    <link rel="stylesheet" href="<?= base_url();?>public/login/css/xenon-skins.css" id="style-resource-8">  
    <link rel="stylesheet" href="<?= base_url();?>public/login/css/custom.css" id="style-resource-9">

    <style type="text/css">
        .login-page.login-light {
            background: url(<?= base_url();?>public/img/blur-background09.jpg) repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>

    <script src="<?= base_url();?>public/login/js/jquery-1.11.1.min.js"></script> 
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries --> 
    <!--[if lt IE 9]> 
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script> 
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script> 
    <![endif]--> 
    <!-- TS1414594710: Xenon - Boostrap Admin Template created by Laborator --> 

</head>

<body class="page-body login-page login-light"> 
        <div class="login-container"> 
            <div class="row"> 
                <div class="col-sm-6"> 

                    <script type="text/javascript">
                        jQuery(document).ready(function($)
                        {
                            // Reveal Login form
                            setTimeout(function(){ $(".fade-in-effect").addClass('in'); }, 1);

                            // Validation and Ajax action
                            $("form#login").validate({
                                rules: {
                                    username: {
                                        required: true
                                    },
                                    password: {
                                        required: true
                                    }
                                },
                                messages: {
                                    username: {
                                        required: 'Masukkan username Anda.'
                                    },
                                    password: {
                                        required: 'Masukkan password Anda.'
                                    }
                                },
                                // Form Processing via AJAX
                                submitHandler: function(form)
                                {
                                    show_loading_bar(70); // Fill progress bar to 70% (just a given value)
                                    $.ajax({
                                        url: "<?=base_url()?>login/dologin",
                                        method: 'POST',
                                        dataType: 'json',
                                        data:$('#login').serialize(),
                                        success: function(resp)
                                        {
                                            show_loading_bar({
                                                delay: .5,
                                                pct: 100,
                                                finish: function(){
                                                    // Redirect after successful login page (when progress bar reaches 100%)
                                                    if(resp.accessGranted == 1)
                                                    {
                                                        window.location.href = '<?=base_url()?>dashboard';
                                                    }
                                                }
                                            });

                                            // Remove any alert
                                            $(".errors-container .alert").slideUp('fast');

                                            // Show errors
                                            if(resp.accessGranted == 0)
                                            {
                                                // alert("Salah");
                                                $(".errors-container").html('<div class="alert alert-danger">\
                                                    <button type="button" class="close" data-dismiss="alert">\
                                                        <span aria-hidden="true">&times;</span>\
                                                        <span class="sr-only">Close</span>\
                                                    </button>\
                                                    ' + resp.error + '\
                                                </div>');

                                                $(".errors-container .alert").hide().slideDown();
                                                $(form).find('#password').select();
                                            }
                                        }
                                    });
                                }
                            });

                            // Set Form focus
                            $("form#login .form-group:has(.form-control):first .form-control").focus();
                        });
                    </script>
                     
                    <div class="errors-container"> 
                    <?php
                        if(isset($error)) {
                    ?>
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Tutup</span>
                            </button>
                            <?=$error;?>
                        </div>
                    <?php
                        }
                    ?>
                    </div> 

                    <!-- <form method="post" role="form" id="login" class="login-form fade-in-effect"> -->
                    <?php
                        $attributes = array(
                            'class' => 'login-form fade-in-effect', 
                            'id' => 'login',
                            'role' => 'form'
                        ); 
                        echo form_open('',$attributes);
                    ?>
                        <div class="login-header"> 
                            <a href="<?= base_url();?>" class="logo"> 
                                <img src="<?= base_url();?>public/login/images/logo-white-bg%402x.png" alt="timeCMS" /> 
                                <span>log in</span> 
                            </a> 
                            <p>Untuk user, silakan log in untuk masuk ke dashboard!</p> 
                        </div> 
                        <div class="form-group"> 
                            <label class="control-label" for="username">Username</label> 
                            <input type="text" class="form-control" name="username" id="username" autocomplete="off" /> 
                        </div> 
                        <div class="form-group"> 
                            <label class="control-label" for="password">Password</label> 
                            <input type="password" class="form-control" name="password" id="password" autocomplete="off" /> 
                        </div> 
                        <div class="form-group"> 
                            <button type="submit" class="btn btn-primary btn-block text-left"> <i class="fa-lock"></i>Log In</button> 
                        </div> 
                        <div class="login-footer"> 
                            <a href="#">Lupa password?</a> 
                            <div class="info-links"> 
                                <a href="#">ToS</a> - <a href="#">Privacy Policy</a> 
                            </div> 
                        </div> 
                    <!-- </form> -->
                    <?php echo form_close(); ?> 
                </div> 
            </div> 
        </div> 

        <script src="<?= base_url();?>public/login/js/bootstrap.min.js" id="script-resource-1"></script> 
        <script src="<?= base_url();?>public/login/js/TweenMax.min.js" id="script-resource-2"></script> 
        <script src="<?= base_url();?>public/login/js/xenon-api.js" id="script-resource-5"></script> 
        <script src="<?= base_url();?>public/login/js/jquery-validate/jquery.validate.min.js" id="script-resource-7"></script> 

        <!-- JavaScripts initializations and stuff --> 
        <script src="<?= base_url();?>public/login/js/xenon-custom.js" id="script-resource-9"></script>  

        
    </body> 
</html>