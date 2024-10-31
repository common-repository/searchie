<?php foreach( $messages as $message ) : ?>
  <div class="notice notice-<?php echo $notice;?> inline">
  	<p>
  		<?php echo $message; ?>
  	</p>
  </div>
<?php endforeach; ?>
