<div class="container media-container">
  <div class="row">
    <div class="col-sm-12 col-searchie-content">
      <p>To embed a media file anywhere on your site, copy the embed code and paste in place.</p>
    </div>
  </div>

  <div class="row">
    <ul class="list-group list-group-horizontal">
      <li class="list-group-item">Total Files <span class="badge badge-primary badge-pill"><?php echo $meta->total;?></span> </li>
      <li class="list-group-item">Current Page <span class="badge badge-primary badge-pill"><?php echo $page;?></span> </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-searchie-content">
      <form action="<?php echo admin_url();?>" method="GET">
        <input type="hidden" name="page" value="searchie-media">
        <input type="hidden" name="_method" value="search-files">
        <div class="form-row align-items-center">
          <div class="col-sm-12 col-md-10">
            <label class="sr-only" for="inlineFormSearchInput">Search Files</label>
            <input value="<?php echo $search_query;?>" type="text" name="search" class="form-control form-control-sm mb-2 large-text searchie-media _searchie-input-search" placeholder="Search Media">
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-primary btn-sm mb-2">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="row">
    <?php SIO_API_Pagination::get_instance()->show(['links' => $links, 'meta' => $meta, 'link_href' => $link_href]); ?>
  </div>

  <div class="row">
    <div class="file-container dashboard-list-container container">
      <ul class="list-unstyled searchie-search-items">
        <?php foreach ( $medias as $media ) : ?>
          <li class="media media-item">
            <?php
              $ajax_url = add_query_arg(
                  array(
                      'action' => 'tb_show_media',
                      'embed_url' => $media->embed_url,
                      'title' => $media->title,
                      'width' => 600,
                      'height' => 650,
                  ),
                  admin_url( 'admin-ajax.php' )
              );
            ?>
            <a href="<?php echo $ajax_url;?>" class="thickbox">
              <img style="width:150px;" src="<?php echo sio_api_thumb($media)?>" class="thickbox img-fluid img-thumbnail mr-3">
            </a>
            <div class="media-body">
              <h5 class="mt-0 mb-1"><?php echo $media->title;?></h5>
              <div class="input-group mb-3">
                <input
                  type="text"
                  class="form-control form-control-sm copy-clipboard"
                  value="[sio_embed_media embed_url='<?php echo $media->embed_url;?>' width='560' height='315' responsive='0']"
                  style="height:75%;"
                  readonly
                  >
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary btn-sm copy-to-clipboard" type="button">Copy to clipboard</button>
                </div>
              </div>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <div class="row">
    <?php SIO_API_Pagination::get_instance()->show(['links' => $links, 'meta' => $meta, 'link_href' => $link_href]); ?>
  </div>
</div>
