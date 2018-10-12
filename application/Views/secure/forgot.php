<?php echo view("theme/header", array('pagetitle'=>$pagetitle, 'endofheader'=>'')); ?>
<style type="text/css">
	body{
		color: #fff;
		font-family: 'Roboto', sans-serif;
    }
	.login-form {
		width: 340px;
    	margin: 50px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2,
	.login-form label,
	p.actionlinks a {	
		color: #333;
	}
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="login-form">
<?php if (isset($viewdata) && isset($viewdata['msg'])) : ?>
		<div class="alert alert-danger">
  <strong>Request failed.</strong> <?php echo $viewdata['msg']; ?></div>
		<?php endif; ?>      

    <form action="/secure/forgot" method="post">
        <h2 class="text-center">Recover Password</h2>       
        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Email" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Send Reset Link</button>
        </div>
        <div class="clearfix">
            <a href="/secure/login" class="pull-right">Go back to login</a>
        </div>        
    </form>
    <p class="text-center actionlinks"><a href="/secure/register">Create an Account</a></p>
</div>
</body>
</html>                                		                            