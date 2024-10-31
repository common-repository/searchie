<div id="searchie-login">
  <h2>Connect to your Searchie Account</h2>
  <h2>in order to use this plugin</h2>
  <?php if ( isset($msg) ) : ?>
    <?php SIO_Notices::get_instance()->error($msg); ?>
  <?php endif; ?>
  <form class="searchie-login-form" action="<?php echo admin_url('?page=Searchie');?>" method="post">
    <input type="hidden" name="_method" value="connect-searchie">
    <p>
			<label for="user_login">Username</label>
			<input type="text" name="user_login" id="user_login" class="large-text" value="" size="20" autocapitalize="off" placeholder="Type Here">
		</p>
    <p>
			<label for="user_pass">Password</label>
			<input type="password" name="user_pass" id="user_pass" class="large-text" value="" size="20" autocapitalize="off" placeholder="Type Here">
		</p>
    <p>
      <a href="https://app.searchie.io/login/forgot" target="_blank">Forgot your password?</a>
    </p>
    <p class="submit">
      <input type="submit" name="searchie-login-submit" class="button button-primary button-large searchie-login-submit" value="Connect to Searchie">
    </p>
  </form>
</div>
