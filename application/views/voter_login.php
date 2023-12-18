<br/><br/><br/><br/><br/><br/><br/><br/>

<div class="container">
  <h2><center>Imo State University, Online Voting System<center></h2>
  	<?php echo validation_errors(); ?>
	  <?php echo form_open('login', $attributes = array('class'=>'', 'id' => ''))?>
    <div class="form-group">
      <label for="email">Email:</label>
      <?php echo form_input($username); ?>
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <?php echo form_input($password); ?>
    </div>
    <?php echo form_button($submit); ?>
  <?php echo form_close(); ?>
</div>

</body>
</html>