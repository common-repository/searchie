<div class="container widgets-container">
  <div class="row">
    <div class="col-md-10 col-sm-12 col-searchie-content">
      <p>To embed a widget anywhere on your site, copy the embed code and paste in place.</p>
    </div>
    <!-- <div class="col-md-2 col-sm-12 col-searchie-content">
      <div class="float-right">
        <a class="button-primary" href="<?php //echo admin_url('?page=Searchie&_method=getfiles');?>" role="button">Sync Widget data</a>
      </div>
    </div> -->
  </div>

  <div class="row">
    <ul class="list-group list-group-horizontal">
      <li class="list-group-item">Total Files <span class="badge badge-primary badge-pill"><?php echo $meta->total;?></span> </li>
      <li class="list-group-item">Current Page <span class="badge badge-primary badge-pill"><?php echo $page;?></span> </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-searchie-content">
      <form>
        <div class="form-group">
          <input type="text" class="large-text searchie-input-search" placeholder="Search Widgets">
        </div>
      </form>
    </div>
  </div>

  <div class="row">
    <?php SIO_API_Pagination::get_instance()->show(['links' => $links, 'meta' => $meta, 'link_href' => $link_href]); ?>
  </div>

  <div class="row">
    <?php //sio_dd($medias); ?>
    <div class="widgets-list-container container dashboard-list-container">
      <ul class="list-unstyled searchie-search-items">
        <?php foreach ( $widgets as $widget ) : ?>
          <li class="media media-item">
            <?php
              $ajax_url = add_query_arg(
                  array(
                      'action' => 'tb_show_widget',
                      'embed_url' => $widget->embed_url,
                      'title' => $widget->name,
                      'width' => 600,
                      'height' => 650,
                  ),
                  admin_url( 'admin-ajax.php' )
              );
            ?>
            <div class="media-body">
              <h5 class="mt-0 mb-1"><?php echo $widget->name;?></h5>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <a href="<?php echo $ajax_url;?>" class="btn btn-outline-secondary btn-sm thickbox" >Preview Widget</a>
                </div>
                <input
                  type="text"
                  class="form-control form-control-sm copy-clipboard"
                  value="[sio_embed_widget embed_url='<?php echo $widget->embed_url;?>' width='100%' height='100vh']"
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
