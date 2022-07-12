<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $this->page_title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/icons/icomoon/styles.css'); ?>" >
    <link rel="stylesheet" href="<?php echo base_url('assets/css/components.css'); ?>" >
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>" >
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/select2/select2.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/validation/validate.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/notifications/sweet_alert.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/custom/common.js'); ?>"></script>
</head>
<body>
    <nav class="navbar navbar-light bg-light navbar-expand-lg fixed-top">
        <a class="navbar-brand" href="<?php echo site_url(); ?>"><?php echo get_settings('company_name'); ?></a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="navbar-nav ml-auto"> 
                <?php if ( is_user_logged_in() ) { ?>  
                    <li class="navbar-item">
                        <a class="nav-link" href="<?php echo site_url('project') ?>">Manage Projects</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript: void(0);" id="navbardrop" data-toggle="dropdown">Manage Updates</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo site_url('updates') ?>">My Updates</a>
                            <a class="dropdown-item" href="<?php echo site_url('select-project') ?>">Write New Updates</a>
                        </div>
                    </li>
                    <li class="navbar-item">
                        <a class="nav-link" href="<?php echo site_url() ?>"><?php echo get_loggedin_info('username'); ?></a>
                    </li>
                    <li class="navbar-item">
                        <a class="nav-link" href="<?php echo site_url('authentication/logout'); ?>"><?php _el('logout'); ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
    <div class="mt-md-5">
        <?php echo $content; ?>
    </div>
	<section class="p-2 bg-light d-none">
        <hr class="mt-0 border-0">
        <footer class="mr-5 text-right">
            <p class="mr-3">Developed By &copy; Mitesh Rathod (MRA) - <?php echo date('Y') ?> <?php echo get_settings('company_name'); ?></a></p>
        </footer>
    </section>
    <script type="text/javascript">
        const BASE_URL = '<?php echo base_url(); ?>';
        $('select').select2();
    </script>
    <?php
        if ( isset( $footer_js ) ) {
            foreach ( $footer_js as $js ) {
                ?>
                <script type="text/javascript" src="<?php echo base_url( $js ); ?>"></script>
                <?php 
            }
        }
    ?>
</body>
</html>