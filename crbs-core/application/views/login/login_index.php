<?php
if (!empty($message)) {
	echo "<div>" . nl2br($message) . "</div><br><br>";
}

echo $this->session->flashdata('auth');

echo validation_errors();

echo form_open('login/submit', array('id'=>'login','class'=>'cssform'), array('page' => $this->uri->uri_string()) );
?>


<fieldset style="width:336px;"><legend accesskey="L" tabindex="<?php echo tab_index() ?>">Log in</legend>

	<p>
	  <label for="username" class="required">Username</label>
	  <?php
		$value = set_value('username', '', FALSE);
		echo form_input(array(
			'name' => 'username',
			'id' => 'username',
			'size' => '20',
			'maxlength' => '100',
			'tabindex' => tab_index(),
			'value' => $value,
		));
		?>
	</p>


	<p>
	  <label for="password" class="required">Password</label>
	  <?php
		echo form_password(array(
			'name' => 'password',
			'id' => 'password',
			'size' => '20',
			'tabindex' => tab_index(),
		));
		?>
	</p>

</fieldset>


<?php

$this->load->view('partials/submit', array(
	'submit' => array('Login', tab_index()),
));

echo form_close();


if ($_GET['UTENTE'] === 'tv1') {
	// Output JS to auto-fill and submit the form
	?>
	<script>
	document.addEventListener('DOMContentLoaded', function() {
		document.getElementById('username').value = 'tv1'; // set TV username
		document.getElementById('password').value = 'Tambosi2024'; // set TV password
		document.getElementById('login').submit();
	});
	</script>
	<?php
}
if ($_GET['UTENTE'] === 'tv2') {
	// Output JS to auto-fill and submit the form
	?>
	<script>
	document.addEventListener('DOMContentLoaded', function() {
		document.getElementById('username').value = 'tv2'; // set TV username
		document.getElementById('password').value = 'Tambosi2024'; // set TV password
		document.getElementById('login').submit();
	});
	</script>
	<?php
}
if ($_GET['UTENTE'] === 'tv3') {
	// Output JS to auto-fill and submit the form
	?>
	<script>
	document.addEventListener('DOMContentLoaded', function() {
		document.getElementById('username').value = 'tv3'; // set TV username
		document.getElementById('password').value = 'Tambosi2024'; // set TV password
		document.getElementById('login').submit();
	});
	</script>
	<?php
}
if ($_GET['UTENTE'] === 'tv4') {
	// Output JS to auto-fill and submit the form
	?>
	<script>
	document.addEventListener('DOMContentLoaded', function() {
		document.getElementById('username').value = 'tv4'; // set TV username
		document.getElementById('password').value = 'Tambosi2024'; // set TV password
		document.getElementById('login').submit();
	});
	</script>
	<?php
}
