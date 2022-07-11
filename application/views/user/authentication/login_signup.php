<div class="container my-4">
	<?php $this->load->view('user/includes/alerts'); ?>
	<div class="row justify-content-center">
        <?php if ( !$user_count ) { ?>
    		<div class="col-md-7">
                <h4>Sign Up</h4>
                <hr/>
    			<form id="signup_form" autocomplete="off" method="post" action="<?php echo site_url('authentication/signup') ?>">
                    <div class="row">
                        <div class="col-md-6">
            				<div class="form-group">
            					<small class="req text-danger">* </small>
                                <label for="firstname"><?php _el('firstname'); ?>:</label>
            					<input type="text" class="form-control" placeholder="<?php _el('firstname'); ?>" id="firstname" name="firstname" />
            				</div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
            					<small class="req text-danger">* </small>
                                <label for="lastname"><?php _el('lastname'); ?>:</label>
                                <input type="text" class="form-control" placeholder="<?php _el('lastname'); ?>" id="lastname" name="lastname" />
            				</div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
            					<small class="req text-danger">* </small>
                                <label for="email"><?php _el('email'); ?>:</label>
                                <input type="email" class="form-control" placeholder="<?php _el('email'); ?>" id="email" name="email" class="email" />
            				</div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
            					<small class="req text-danger">* </small>
                                <label for="mobile_no"><?php _el('mobile_no'); ?>:</label>
                                <input type="text" class="form-control" placeholder="<?php _el('mobile_no'); ?>" id="mobile_no" name="mobile_no" />
            				</div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
            					<small class="req text-danger">* </small>
                                <label for="password"><?php _el('password'); ?>:</label>
                                <input type="password" class="form-control" placeholder="<?php _el('password'); ?>" id="password" name="password" />
            				</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <small class="req text-danger">* </small>
                                <label for="confirm_password"><?php _el('confirm_password'); ?>:</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="<?php _el('confirm_password'); ?>" />
                            </div>
                        </div>
                    </div>
    				<button type="submit" class="btn btn-primary">Sign Up</button>
    			</form>
    		</div>
        <?php } else { ?>
    		<div class="col-md-4">
                <h4>Login</h4><hr/>
    			<form id="login_form" autocomplete="off" method="post" action="<?php echo site_url('authentication/'); ?>">
    				<div class="form-group">
                        <small class="req text-danger">* </small>
    					<label for="sign-in-email">Email</label>
    					<input type="email" class="form-control" placeholder="<?php _el('email') ?>" name="email" id="sign-in-email" value="<?php if (get_cookie('email_cookie')!=null){ echo get_cookie('email_cookie');}?>" >
    				</div>
    				<div class="form-group">
                        <small class="req text-danger">* </small>
    					<label for="sign-in-password">Password</label>
    					<input type="password" class="form-control" placeholder="<?php _el('password') ?>" name="password" id="sign-in-password" value="<?php if (get_cookie('password_cookie')!= null)
                        {
                        echo get_cookie('password_cookie');
                        }?>">
    				</div>
                    <div class="form-group">
                        <label class="checkbox-inline">
                            <input type="checkbox" class="styled" name="remember" <?php if (get_cookie('email_cookie')!=null)
                            {
                                echo "checked";
                            } ?>>
                            <?php _el('remember_me') ?>
                        </label>
                        <a class="pull-right" href="<?php echo site_url('authentication/forgot_password'); ?>"><?php _el('forgot_password') ?></a>
                    </div>	
    				<button type="submit" class="btn btn-primary"><?php _el('login') ?></button>
    			</form>
    		</div>
        <?php } ?>
	</div>
<script type="text/javascript">

$.validator.addMethod("emailExists", function(value, element) 
{
    var mail_id = $(element).val();
    var ret_val = '';
    $.ajax({
        url:BASE_URL+'authentication/email_exists',
        type: 'POST',
        data: { email: mail_id },
        async: false,
        success: function(msg) 
        {   
            if(msg==1)
            {
                ret_val = false;
            }
            else
            {
                ret_val = true;
            }
        }
    }); 

    return ret_val;
            
}, "<?php _el('email_exists') ?>");

$("#signup_form").validate({
    rules: {
        firstname: {
            required: true,
        },
        lastname: {
            required: true,
        },
        mobile_no: {
            required: true,
            number: true,
            minlength:10,
        },
        email: {
            required: true,
            email: true,
            emailExists: true,
        },
        password: {
            required: true,
            minlength: 8
        },
        confirm_password: {
            required: true,
            equalTo: "#password",
        },
        role: {
            required: true,
        },
    },
    messages: {
        firstname: {
            required:"<?php _el('please_enter_', _l('firstname')) ?>",
        },
        lastname: {
            required:"<?php _el('please_enter_', _l('lastname')) ?>",
        },
        mobile_no: 'Please enter a valid 10 digit mobile number',
        email: {
            required:"<?php _el('please_enter_', _l('email')) ?>",
            email:"<?php _el('please_enter_valid_', _l('email')) ?>"
        },        
        password: {
            required:"<?php _el('please_enter_', _l('password')) ?>",
            minlength: "<?php _el('password_min_length_must_be_', 8) ?>",
        },
        confirm_password: {
            required:"<?php _el('please_enter_', _l('password')) ?>",
            equalTo: "<?php _el('conf_password_donot_match') ?>",
        }, 
        role: {
            required:"<?php _el('please_select_', _l('role')) ?>",
        },
    },
}); 

$("#login_form").validate
    ({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            }
        },
        messages: {
            email: {
                required:"<?php _el('please_enter_', _l('email')) ?>",
                email:"<?php _el('please_enter_valid_', _l('email')) ?>"
            },
            password: {
                required:"<?php _el('please_enter_', _l('password')) ?>"
            },
        }
    });
    	
</script>
