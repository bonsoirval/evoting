
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php base_url(); ?>static/js/bootstrap.min.js"></script>
</body>

</html>
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body>
	<div class="col-sm-12">
		<?php
		if (!isset($_SESSION)) {
			session_start();
		}
		if (isset($_SESSION['SESS_NAME']) != "") {
			header("Location: voter.php");
		}
		
		?>
	</div>
	<br>
	<br>

	<div class="col-sm-12">
		<?php global $nam;
		echo $nam; ?>
		<?php global $error;
		echo $error; ?>
	</div>

	<div class="container" style="padding:100px;">
		<div class="row">
			<div class="col-sm-12" style="border:2px outset gray;">
				<div class="page-header text-center">
					<h3 class="specialHead">Register!.. </h3>
				</div>

						<?php echo validation_errors(); ?>
						<?php echo form_open('register')?>

						<div class="form-group">
							<label for="email">First Name :</label>
							<?php echo form_input($firstname); ?>
						</div>																				
						<div class="form-group">
							<label for="lastname">Lastname : </label>
							<?php echo form_input($lastname); ?>
						</div>
						<div class="form-group">	
							<label for="email">Email : </label>
							<?php echo form_input($email); ?>
						</div>
						<div class="form-group">
							<label for="username">Username : </label>
							<?php echo form_input($username); ?>
						</div>
						<div class="form-groupd">
							<label for='state'>State : </label>
							<?php print(form_dropdown('region', $options,'select', $extra = array('class' => 'form-control'))); ?>
						</div>
						<div class="form-group">
							<label for="nin">NIN : </label>
							<?php echo form_input($nin); ?>
						</div>
						<div class="form-group">
							<label for="password">Password : </label>
							<?php echo form_input($password); ?>
						</div>
						<div class="form-group">
							<label for="passconf">Repeat Password : </label>
							<?php echo form_input($passconf); ?>
						</div>				
						<div class="form-group">
							<input id="register" name="register" type="submit" value="Register">
						</div>

						</form>
				<br><br>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var frmvalidator = new Validator("myform");
		frmvalidator.addValidation("firstname", "req", "Please enter student firstname");
		frmvalidator.addValidation("firstname", "maxlen=50");
		frmvalidator.addValidation("lastname", "req", "Please enter student lastname");
		frmvalidator.addValidation("lastname", "maxlen=50");
		frmvalidator.addValidation("username", "req", "Please enter student username");
		frmvalidator.addValidation("username", "maxlen=50");
		frmvalidator.addValidation("password", "req", "Please enter student password");
		frmvalidator.addValidation("password", "minlen=6", "Password must not be less than 6 characters.");
	</script>
	
</body>

</html>