<?php if ( $embed_url !== '' ) : ?>
<div class='embed-container'>
  <iframe
    src="<?php echo $embed_url;?>"
    style="width: <?php echo $width;?>; height: <?php echo $height;?>; border: none;"
    frameborder="0"
    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
    loading="lazy"
    allowfullscreen>
  </iframe>
</div>
<?php endif; ?>
