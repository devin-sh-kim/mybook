<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Dashboard">
	<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<title>UJACHA - Moneybook</title>
	<!-- Bootstrap core CSS -->
	<link href="<?=$ctx?>css/bootstrap.css" rel="stylesheet">
	<!--external css-->
	<link href="<?=$ctx?>font-awesome/css/font-awesome.css" rel="stylesheet" />

	<!-- Custom styles for this template -->
	<link href="<?=$ctx?>css/style.css" rel="stylesheet">
	<link href="<?=$ctx?>css/style-responsive.css" rel="stylesheet">

	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<style type="text/css">
.form-group .form-control-feedback {
    top: 0px;
    right: 0px;
}
</style>

</head>

<body>

<!-- **********************************************************************************************************************************************************
	MAIN CONTENT
*********************************************************************************************************************************************************** -->

<div id="login-page">
	<div class="container">
		<form id="loginForm" class="form-login" action="<?=$ctx?>login" method="POST">
			<h2 class="form-login-heading">sign in now</h2>

			<div class="login-wrap">
				<? if(isset($loginError) && $loginError == true){ ?>
				<div class="alert alert-warning alert-dismissable fade in" id="login-error">
    				<a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
    				Not found user or wrong password.
				</div>
				<? } ?>
				<div class="form-group">
					<input name="email" type="text" class="form-control" placeholder="Email" autofocus>
				</div>
				<div class="form-group">
					<input name="password" type="password" class="form-control" placeholder="Password">
				</div>
				<label class="checkbox">
					<span class="pull-right">
						<a data-toggle="modal" href="login.html#myModal"> Forgot Password?</a>		
					</span>
				</label>
				<button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
				<hr>
<!--
<div class="login-social-link centered">
<p>or you can sign in via your social network</p>
<button class="btn btn-facebook" type="submit"><i class="fa fa-facebook"></i> Facebook</button>
<button class="btn btn-twitter" type="submit"><i class="fa fa-twitter"></i> Twitter</button>
</div>
-->
				<div class="registration">
					Don't have an account yet?<br/>
					<a class="" data-toggle="modal" href="login.html#createAccountModal">Create an account</a>
				</div>
			</div>
		</form>	  	
	</div>
</div>

<!-- Create an account Modal -->
<div aria-hidden="true" aria-labelledby="createAccountModalLabel" role="dialog" tabindex="-1" id="createAccountModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="createAccountForm" action="createAccount" method="POST">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Create an account</h4>
				</div>
				<div class="modal-body">
					<p>Enter your e-mail address and password.</p>
					<div class="form-group">
						<input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
					</div>
					<div class="form-group">
					<input type="password" name="password" maxlength="40" minlength="4" placeholder="Password" autocomplete="off" class="form-control placeholder-no-fix">
					</div>
					<div class="form-group">
					<input type="text" name="username" maxlength="20" minlength="3" placeholder="Your Name" autocomplete="off" class="form-control placeholder-no-fix">
					</div>
				</div>
				<div class="modal-footer">
					<button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
					<button class="btn btn-theme" type="submit">Sign Up</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- modal -->

<!-- Modal
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title">Forgot Password ?</h4>
</div>
<div class="modal-body">
<p>Enter your e-mail address below to reset your password.</p>
<input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

</div>
<div class="modal-footer">
<button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
<button class="btn btn-theme" type="button">Submit</button>
</div>
</div>
</div>
</div>
 -->
<!-- modal -->

<!-- js placed at the end of the document so the pages load faster -->
<script src="<?=$ctx?>js/jquery.js"></script>
<script src="<?=$ctx?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>

<!--BACKSTRETCH-->
<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
<script type="text/javascript" src="<?=$ctx?>js/jquery.backstretch.min.js"></script>
<script>
	$.backstretch("<?=$ctx?>img/login-bg-1920x1080.jpg", {speed: 500});
</script>

<!-- Validation -->
<script>
 
$(document).ready(function() {
	$('#loginForm').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	email: {
                validators: {
                    notEmpty: {
                        message: 'The email is required and cannot be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    }
                }
            },
            password: {
            	validators: {
                    notEmpty: {
                        message: 'The password is required and cannot be empty'
                    }
            	}
            }
        }
	});
	
	$('#createAccountForm').bootstrapValidator({
		message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	email: {
                validators: {
                    notEmpty: {
                        message: 'The email is required and cannot be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    },remote: {
                        message: 'The email is not available',
                        url: 'api/checkEmail'
                    }
                    
                }
            },
            password: {
            	validators: {
                    notEmpty: {
                        message: 'The password is required and cannot be empty'
                    }
            	}
            },
            username: {
            	validators: {
                    notEmpty: {
                        message: 'The username is required and cannot be empty'
                    }
            	}
            }
        }
	});
	
});

</script>


</body>
</html>
