<?php
require_once(dirname(__FILE__).'./vendor/autoload.php');//autoload packages

 // get database connection
if($_POST){
	$db = new Database();
	$user = new User($db->conn);

	 $user->email = $_POST['email'];
    $user->password = $_POST['password'];

    if($user->login()){
    	header ("Location: homepage.php");
    	//echo 'logged in';exit;
    }else{
    	//echo 'not logged in';exit;
    	$state = false;
    }
}

?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Maternal Login Form</title>
    
    
    
    
        <style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      @import url(http://fonts.googleapis.com/css?family=Exo:100,200,400);
@import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:700,400,300);

body{
	margin: 0;
	padding: 0;
	background: #fff;

	color: #fff;
	font-family: Arial;
	font-size: 12px;
}

.body{
	position: absolute;
	top: -10px;
	left: -10px;
	right: -20px;
	bottom: -20px;
	width: auto;
	height: auto;
	background-image: url(http://localhost/maternal/images/mother-baby.jpg);
	background-size: cover;
	-webkit-filter: blur(0px);
	z-index: 0;
}

.grad{
	position: absolute;
	top: -20px;
	left: -20px;
	right: -40px;
	bottom: -40px;
	width: auto;
	height: auto;
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.65))); /* Chrome,Safari4+ */
	z-index: 1;
	opacity: 0.7;
}

.header{
	position: absolute;
	top: calc(50% - 35px);
	left: calc(50% - 255px);
	z-index: 2;
}

.header div{
	float: left;
	color: #fff;
	font-family: 'Exo', sans-serif;
	font-size: 35px;
	font-weight: 200;
}

.header div span{
	color: #5379fa !important;
}

.login{
	position: absolute;
	top: calc(50% - 75px);
	left: calc(50% - 50px);
	height: 150px;
	width: 350px;
	padding: 10px;
	z-index: 2;
}

.login input[type=text]{
	width: 250px;
	height: 30px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-radius: 2px;
	color: #fff;
	font-family: 'Exo', sans-serif;
	font-size: 16px;
	font-weight: 400;
	padding: 4px;
}

.login input[type=password]{
	width: 250px;
	height: 30px;
	background: transparent;
	border: 1px solid rgba(255,255,255,0.6);
	border-radius: 2px;
	color: #fff;
	font-family: 'Exo', sans-serif;
	font-size: 16px;
	font-weight: 400;
	padding: 4px;
	margin-top: 10px;
}

.login input[type=submit]{
	width: 260px;
	height: 35px;
	background: #fff;
	border: 1px solid #fff;
	cursor: pointer;
	border-radius: 2px;
	color: #a18d6c;
	font-family: 'Exo', sans-serif;
	font-size: 16px;
	font-weight: 400;
	padding: 6px;
	margin-top: 10px;
}

.login input[type=submit]:hover{
	opacity: 0.8;
}

.login input[type=submit]:active{
	opacity: 0.6;
}

.login input[type=text]:focus{
	outline: none;
	border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=password]:focus{
	outline: none;
	border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=submit]:focus{
	outline: none;
}

.fv-form-foundation .error .fv-control-feedback {
    color: #ffffff;
}

::-webkit-input-placeholder{
   color: rgba(255,255,255,0.6);
}

::-moz-input-placeholder{
   color: rgba(255,255,255,0.6);
}
    </style>

     <link rel="stylesheet" href="./css/bootstrap.css"/>
    <link rel="stylesheet" href="./css/formValidation.css"/>

    <script type="text/javascript" src="./js/jquery.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./js/formValidation.js"></script>
    <script type="text/javascript" src="./js/framework/bootstrap.js"></script>

    
        <script src="js/prefixfree.min.js"></script>

    
  </head>

  <body>

    <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>Maternal</div>
		</div>
		<br>
		<div class="login">
		<form id="loginForm" method="post" action="login.php">

		<?php 
		if(isset($state)){
			if($state == false){
		echo '<div class="alert alert-danger">
		<strong>login not successful</strong>
		</div>';
		}
		}
		?>
			<div class="form-group row">
                <div class="col-sm-9">
                    <input type="text" class="form-control" value="<?= value('email')?>" name="email" placeholder="email" />
                </div>
            </div>

            	<div class="form-group row">
                <div class="col-sm-9">
                    <input type="password" class="form-control" name="password" placeholder="password" />
                </div>
            </div>
				<input type="submit" id="submit_btn"  value="Login">
				<div class="btn">
				<a href="register.php"> register</a>
				</div>
		</form>
		</div>

<script>
	// $( "#submit" ).click(function() {
	//   $( "#loginForm" ).submit();
	// });

	function myFunction() {
    document.getElementById("loginForm").submit();
}
</script>

    
    <script type="text/javascript">
    $(document).ready(function() {
        $('#loginForm').formValidation({
            message: 'This value is not valid',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email address is required'
                        },
                        emailAddress: {
                            message: 'The input is not a valid email address'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required'
                        },
                        different: {
                            field: 'email',
                            message: 'The password cannot be the same as email'
                        },
                        stringLength: {
                            min: 6,
                            max: 12,
                            message: 'The password must be more than 6 and less than 12 characters long'
                        }
                    }
                }
            }
        });
    });
</script>
 

    
  </body>
</html>
