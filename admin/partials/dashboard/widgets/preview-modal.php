<?php if ( $embed_url !== '' ) : ?>
<iframe
  src="<?php echo $embed_url;?>"
  style="width: <?php echo $width;?>; height:75%; border: none;"
  frameborder="0"
  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
  allowfullscreen>
</iframe>
<div class="bootstrap-iso">
  <div class="container">
    <div class="media media-item">
      <div class="media-body">
        <h5 class="mt-0 mb-1"><?php echo $title;?></h5>
        <div class="input-group mb-3">
          <input
            type="text"
            class="form-control form-control-sm copy-clipboard"
            value="[sio_embed_widget embed_url='<?php echo $embed_url;?>' width='100%' height='100vh']"
            style="height:75%;"
            >
          <div class="input-group-append">
            <button class="btn btn-outline-secondary btn-sm copy-to-clipboard" type="button">Copy to clipboard</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
