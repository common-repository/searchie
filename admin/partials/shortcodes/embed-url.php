<?php if ( $embed_url !== '' ) : ?>
  <?php $class_responsive = 'sio-frontend-iframe-container-fix'; ?>
  <?php if ( $responsive == '1' ) : ?>
    <?php $class_responsive = 'sio-frontend-iframe-container'; ?>
  <?php endif; ?>
<div class='embed-container <?php echo $class_responsive;?>'>
  <iframe
    width="<?php echo $width;?>"
    height="<?php echo $height;?>"
    src="<?php echo $embed_url;?>"
    frameborder="0"
    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
    allowfullscreen
    style="<?php echo $css_inline;?>"
    loading="lazy"
    >
  </iframe>
</div>
<?php endif; ?>
