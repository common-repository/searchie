<div class="container widgets-container">
  <div class="row">
    <div class="col-md-10 col-sm-12 col-searchie-content">
      <p>To embed a playlists anywhere on your site, copy the embed code and paste in place.</p>
    </div>
    <div class="col-sm-12 col-searchie-content" style="margin-bottom:25px;">
      <div class="">
        <a class="button-primary" href="<?php echo admin_url('?page=searchie-playlists&_method=sync');?>" role="button">Sync Playlists</a>
        <p>Sync Playlist from Searchie to WP database.</p>
      </div>
    </div>
  </div>

  <div class="row">
    <ul class="list-group list-group-horizontal">
      <li class="list-group-item">Total Files <span class="badge badge-primary badge-pill"><?php echo count($data);?></span> </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-searchie-content">
      <form action="<?php echo admin_url();?>" method="GET">
        <input type="hidden" name="page" value="searchie-playlists">
        <input type="hidden" name="_method" value="search-playlists">
        <div class="form-row align-items-center">
          <div class="col-sm-12 col-md-10">
            <label class="sr-only" for="inlineFormSearchInput">Search Playlists</label>
            <input value="<?php echo $search_query;?>" type="text" name="search" class="form-control form-control-sm mb-2 large-text searchie-playlists _searchie-input-search" placeholder="Search Playlists">
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-primary btn-sm mb-2">Search</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="widgets-list-container container dashboard-list-container">
      <ul class="list-unstyled searchie-search-items">
        <?php foreach ( $playlists as $playlist ) : ?>
          <li class="media media-item">
            <?php
              $ajax_url = add_query_arg(
                  array(
                      'action' => 'tb_show_playlist',
                      'hash' => $playlist->hash,
                      'title' => $playlist->title,
                      'width' => 600,
                      'height' => 650,
                  ),
                  admin_url( 'admin-ajax.php' )
              );
            ?>
            <div class="media-body">
              <h5 class="mt-0 mb-1"><?php echo $playlist->title;?></h5>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <a href="<?php echo $ajax_url;?>" class="btn btn-outline-secondary btn-sm thickbox" >Preview Playlist</a>
                </div>
                <input
                  type="text"
                  class="form-control form-control-sm copy-clipboard"
                  value="[sio_embed_playlist hash='<?php echo $playlist->hash;?>' width='560' height='315']"
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
    <?php
      sio_paginator($limit, $page, $total_page, admin_url($link_href));
    ?>
  </div>

</div>
