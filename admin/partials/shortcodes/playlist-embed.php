<?php if ( $hash !== '' ) : ?>
<div class='embed-container'>
  <iframe
    width="<?php echo $width;?>"
    height="<?php echo $height;?>"
    src="<?php echo $url;?>"
    frameborder="0"
    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
    loading="lazy"
    allowfullscreen>
  </iframe>
</div>
<?php endif; ?>
