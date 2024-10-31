<div class="sio-card">
  <?php if ( $files && !empty($files) ) : ?>

    <a class="btn btn-primary btn-sm" href="<?php echo admin_url('?page=Searchie&_method=getfiles');?>" role="button">Sync Media Data</a>
    <p>
      <small class="text-muted">By Clicking Sync will get your updated data in API.</small>
    </p>
    <div class="file-container">
      <ul class="list-unstyled">
        <?php foreach ( $files as $file ) : ?>
          <li class="media">

            <?php if ( $file->thumbnail->small != '' ) : ?>
              <img style="width:75px;" src="<?php echo sio_get_files_thumb_url( $file->thumbnail->small );?>" class="img-fluid img-thumbnail mr-3">
            <?php endif; ?>

            <div class="media-body">
              <h5 class="mt-0 mb-1"><?php echo $file->title;?></h5>
              <p>
                <input
                  type="text"
                  class="form-control form-control-sm"
                  value="[sio_embed_media embed_url='<?php echo $file->embed_url;?>' width='560' height='315']"
                  readonly
                  style="height:75%;"
                  >
                <small class="form-text text-muted">Copy paste this shortcode to add in your content.</small>
              </p>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php else: ?>
    <?php if ( sio_has_token() ) : ?>
      <a class="btn btn-primary btn-sm" href="<?php echo admin_url('?page=Searchie&_method=getfiles');?>" role="button">Get Files and Store data.</a>
    <?php endif; ?>
  <?php endif; ?>
</div>
