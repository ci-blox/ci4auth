<style type="text/css">
	body{
		color: #fff;
		font-family: 'Roboto', sans-serif;
	}
    .form-control{
		height: 40px;
		box-shadow: none;
		color: #969fa4;
	}
	.form-control:focus{
		border-color: #5cb85c;
	}
    .form-control, .btn{        
        border-radius: 3px;
    }
	.signup-form{
		width: 400px;
		margin: 0 auto;
		padding: 30px 0;
	}
	.signup-form h2{
		color: #636363;
        margin: 0 0 15px;
		position: relative;
		text-align: center;
    }
    .signup-form .hint-text{
		color: #999;
		margin-bottom: 30px;
		text-align: center;
	}
    .signup-form form{
		color: #999;
		border-radius: 3px;
    	margin-bottom: 15px;
        background: #f2f3f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
	.signup-form .form-group{
		margin-bottom: 20px;
	}
	.signup-form input[type="checkbox"]{
		margin-top: 3px;
	}
	.signup-form .btn{        
        font-size: 16px;
        font-weight: bold;		
		min-width: 140px;
        outline: none !important;
    }
	.signup-form .row div:first-child{
		padding-right: 10px;
	}
	.signup-form .row div:last-child{
		padding-left: 10px;
	}    	
    .signup-form a{
		color: #fff;
		text-decoration: underline;
	}
    .signup-form a:hover{
		text-decoration: none;
	}
	.signup-form form a{
		color: #5cb85c;
		text-decoration: none;
	}	
	.signup-form form a:hover{
		text-decoration: underline;
	}  

meter {
    /* Reset the default appearance */
    /*-webkit-appearance: none;*/
       -moz-appearance: none;
            appearance: none;

    margin: 0 auto 0.8em;
    width: 100%;
    height: .5em;

    /* Applicable only to Firefox */
    background: none;
    background-color: rgba(0,0,0,0.1);
}

meter.no-appearance {
  -webkit-appearance: none;
}

meter::-webkit-meter-bar {
    background: none;
    background-color: rgba(0,0,0,0.1);
}
	
#Styling the meter value
meter[value="1"]::-webkit-meter-optimum-value { background: red; }
meter[value="2"]::-webkit-meter-optimum-value { background: yellow; }
meter[value="3"]::-webkit-meter-optimum-value { background: orange; }
meter[value="4"]::-webkit-meter-optimum-value { background: green; }

meter[value="1"]::-moz-meter-bar { background: red; }
meter[value="2"]::-moz-meter-bar { background: yellow; }
meter[value="3"]::-moz-meter-bar { background: orange; }
meter[value="4"]::-moz-meter-bar { background: green; }

#password {margin-top:-1.3em}

#password-strength-text {
	float: right;
    margin-top: -35px;
    margin-right: 8px;
    text-transform: uppercase;
    font-size: 9px;
}
</style>
</head>
<body>
<div class="signup-form">
<?php $vmsg = service('validation')->listErrors() ?>
<?php if (isset($viewdata) && isset($viewdata['msg'])) $vmsg .= $viewdata['msg'];
if ($vmsg) :
?>
		<div class="alert alert-danger">
  <strong>Cannot change password.</strong> <?php echo $vmsg; ?></div>
		<?php endif; ?>      
    <form action="/secure/changepassword" method="post">
		<h2>Change Password</h2>
		<p class="hint-text text-left">Select a new password for your account.</p>
		<div class="form-group">
            <input type="password" class="form-control" name="old_password" placeholder="Current Password" required="required" autofocus>
        </div>        
		<div class="form-group">
			<meter max="4" id="password-strength-meter"></meter>
            <input type="password" class="form-control" name="password" id="password" placeholder="New Password" required="required" autocomplete="off" />
			<p id="password-strength-text"></p> 
       </div>
		<div class="form-group">
            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm New Password" required="required">
        </div>        
		<div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Change Password</button>
        </div>
    </form>
	<p>
	</p>
</div>
<script type='text/javascript' src="/assets/js/zxcvbn.js" ></script>
<script type='text/javascript'>
var strength = {
  0: "Very Poor",
  1: "Bad",
  2: "Weak",
  3: "Good",
  4: "Strong"
};
var password = document.getElementById('password');
var meter = document.getElementById('password-strength-meter');
var text = document.getElementById('password-strength-text');

password.addEventListener('input', function() {
  var val = password.value;
  var result = zxcvbn(val);

  // Update the password strength meter
  meter.value = result.score;

  // Update the text indicator
  if (val !== "") {
    text.innerHTML = "Strength: " + strength[result.score]; 
  } else {
    text.innerHTML = "";
  }
});
</script>
</body>
</html>                            