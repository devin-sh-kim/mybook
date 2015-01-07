<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Dashboard">
	<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<title>Mybook.UJACHA.NET</title>
	<!-- Bootstrap core CSS -->
	{{ HTML::style('css/bootstrap.css'); }}
	<!--external css-->
	{{ HTML::style('font-awesome/css/font-awesome.css'); }}

	<!-- Custom styles for this template -->
	{{ HTML::style('css/style.css'); }}
	{{ HTML::style('css/style-responsive.css'); }}

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
		<form id="loginForm" class="form-login" action="{{ $loginUrl }}" method="POST">
			<h2 class="form-login-heading">sign in now</h2>

			<div class="login-wrap">
				<? if(isset($loginError) && $loginError == true){ ?>
				<div class="alert alert-warning alert-dismissable fade in" id="login-error">
    				<a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
    				등록되지 않은 계정<br/> 또는 비밀번호가 맞지 않습니다.
				</div>
				<? } ?>
				<div class="alert alert-success alert-dismissable fade in" id="signup-success">
    				<a class="close" data-dismiss="alert" href="#" aria-hidden="true">×</a>
    				계정이 생성되었습니다.
				</div>

				<div class="form-group">
					<input name="email" type="text" class="form-control" placeholder="Email" autofocus>
				</div>
				<div class="form-group">
					<input name="password" type="password" class="form-control" placeholder="Password">
				</div>
				<div class="form-group">
				    <label>
				        <input type="checkbox" name="remember" id="remember"> remember me
				    </label>
				    <!--
				    <span class="pull-right">
						<a data-toggle="modal" href="login.html#myModal"> Forgot Password?</a>		
					</span>
					-->
				</div>
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
			<form id="createAccountForm" action="{{ $createAccountUrl }}" method="POST">
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
					<button class="btn btn-theme" type="button" id="btn-signup">Sign Up</button>
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
{{ HTML::script('js/jquery.js'); }}
{{ HTML::script('js/bootstrap.min.js'); }}
{{ HTML::script('js/bootstrap-js/alert.js'); }}
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>

<!--BACKSTRETCH-->
<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
{{ HTML::script('js/jquery.backstretch.min.js'); }}
<script>
	$.backstretch("{{ asset('img/login-bg-1920x1080.jpg') }}", {speed: 500});
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
	
	$("#signup-success").hide();
	
	// create Account
	$("button#btn-signup").click(function(){
        $.ajax({
            type: "POST",
            url: $('#createAccountForm').prop('action'),
            data: $('#createAccountForm').serialize(),
            success: function(data){
                //alert(data.result);
                $("#signup-success").show();
                $("#createAccountModal").modal('hide');	
            },
            error: function(data){
                alert(data);
            }
        });
        return;
    });
});

</script>


</body>
</html>
