<div class="bootstrap-iso">
  <div class="wrap settings-wrapper">

    <div class="jumbotron">
      <h2>Global Pop-Out Widget</h2>
      <p class="lead">General settings for your Searchie plugin.</p>
      <hr class="my-4">
      <form>
        <div class="form-row">
          <div class="col">
            <label for="globalWidget" class="font-weight-bold">Global pop-out widget to use</label>
            <?php $widget_options = SIO_Settings_Widgets::get_instance()->widget_global(['action'=>'r','single'=>true]); ?>
            <select id="globalWidget" class="form-control form-control-sm">
              <option value="-1">Choose widgets / None</option>
              <?php foreach ( $datas as $data ) : ?>
                <option value="<?php echo $data->hash;?>" <?php echo ($data->hash == $widget_options) ? 'selected':'';?> ><?php echo $data->name;?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- <div class="col sio-input" id="widgetTypeContainer">
            <label for="popoutstyle" class="font-weight-bold">Pop-Out Style</label>
            <?php $widget_type = SIO_Settings_Widgets::get_instance()->widget_global_settings(['action'=>'r','single'=>true]); ?>
            <select id="widgetType" class="form-control form-control-sm">
              <option value="full-height" <?php echo (isset($widget_type['type']) && $widget_type['type'] == 'full-height' ) ? 'selected' : ''; ?> >Full Height</option>
              <option value="floating-widget" <?php echo (isset($widget_type['type']) && $widget_type['type'] == 'floating-widget' ) ? 'selected' : ''; ?> >Floating</option>
            </select>
          </div> -->

        </div>

        <div class="form-row sio-input">
          <div class="col use-custom-button">
            <?php
              $custom_button = SIO_Settings_Widgets::get_instance()->widget_custom_button([
                'action'  => 'r',
                'single'  =>  true
              ]);
              if ( !$custom_button ) {
                $custom_button = 'no';
              }
            ?>
            <p class="font-weight-bold">Custom Button</p>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="useCustomButtonYes" name="useCustomButton" value="yes" class="form-control-sm custom-control-input useCustomButton" <?php echo ($custom_button == 'yes' ) ? 'checked':'';?>>
              <label class="custom-control-label" for="useCustomButtonYes"  >Yes</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="useCustomButtonNo" name="useCustomButton" value="no" class="form-control-sm custom-control-input useCustomButton" <?php echo ($custom_button == 'no' ) ? 'checked':'';?>>
              <label class="custom-control-label" for="useCustomButtonNo"  >No</label>
            </div>
          </div>
          <div class="col float-position">
            <!-- <?php //$option_float_position = SIO_Settings_Widgets::get_instance()->widget_float_position(['action'=>'r','single'=>true]); ?>
            <?php //$float_positions = SIO_Settings_Widgets::get_instance()->floatPositionArr(); ?>
            <label for="floatPosition">&nbsp;</label>
            <select id="floatPosition" name="floatPosition" class="form-control form-control-sm">
              <option value="-1">Button Position</option>
              <?php //foreach( $float_positions as $key => $float_position ) : ?>
                <option value="<?php //echo $key;?>" <?php //echo ($key == $option_float_position) ? 'selected':'';?>><?php //echo $float_position;?></option>
              <?php //endforeach; ?>
            </select> -->
          </div>
        </div>

        <div class="form-row sio-input">
          <?php
            // $left_side = SIO_Settings_Widgets::get_instance()->widget_left_side([
            //   'action'  => 'r',
            //   'single'  =>  true
            // ]);
          ?>
          <!-- <div class="col use-left-side">
            <p class="font-weight-bold">Left Side</p>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" name="leftSide" id="leftSideYes" value="1" class="form-control-sm custom-control-input leftSide" <?php echo ($left_side == 1 ) ? 'checked':'';?>>
              <label class="custom-control-label" for="leftSideYes"  >Yes</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" name="leftSide" id="leftSideNo" value="0" class="form-control-sm custom-control-input leftSide" <?php echo ($left_side == 0 ) ? 'checked':'';?>>
              <label class="custom-control-label" for="leftSideNo"  >No</label>
            </div>
          </div> -->
        </div>


        <div class="form-row sio-input">
          <div class="col sio-widget-embed-button">
            <div class="input-group mb-3">
              <input
                type="text"
                class="form-control form-control-sm copy-clipboard"
                value="<a href='javascript:window._searchie.toggle()'>Click Here</a>"
                id="codeBUtton"
                style="background-color:#fff;"
                readonly
                >
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary btn-sm copy-to-clipboard-settings" type="button">Copy to clipboard</button>
                </div>
            </div>
            <p>Copy and paste this code where you want your button, usually on your template, or add as html embed in editor.</p>
          </div>
        </div>

        <div class="" style="margin-top:20px;">
          <button type="submit" class="btn btn-primary btn-sm set-global-widget-btn">Set Global Widget</button>
          <small class="form-text text-muted ajax-msg-set-global-widget"></small>
        </div>

      </form>
    </div>

    <div class="jumbotron">
      <h2>Audience</h2>
      <p class="lead"></p>
      <hr class="my-4">
      <form action="<?php echo admin_url('?page=searchie-settings');?>" method="POST">
        <input type="hidden" name="page" value="searchie-settings">
        <input type="hidden" name="_method" value="set-audience">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="audience_status" id="audience_disable" value="disable" <?php echo (sio_get_audience_status() == 'disable') ? 'checked':'';?>>
          <label class="form-check-label" for="audience_disable">
            Disabled
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="audience_status" id="audience_enable" value="enable" <?php echo (sio_get_audience_status() == 'enable') ? 'checked':'';?>>
          <label class="form-check-label" for="audience_enable">
            Enabled
          </label>
        </div>
        <div class="" style="margin-top:20px;">
          <button type="submit" class="btn btn-primary btn-sm set-audience-btn">Save Settings</button>
        </div>
      </form>
    </div>

    <div class="jumbotron">
      <h2>Sync</h2>
      <p class="lead">Choose which datasource to get local or live.</p>
      <hr class="my-4">
      <form action="<?php echo admin_url('?page=searchie-settings');?>" method="POST">
        <input type="hidden" name="page" value="searchie-settings">
        <input type="hidden" name="_method" value="set-sync-media">
        <div class="form-group">
          <label for="sync-media" class="font-weight-bold">Media</label>
          <select name="media-datasource" class="form-control form-control-sm">
            <option value="live" <?php echo (sio_get_media_datasource() == 'live') ? 'selected':'';?>>Live</option>
            <option value="local" <?php echo (sio_get_media_datasource() == 'local') ? 'selected':'';?>>Local (Recommended)</option>
          </select>
        </div>
        <div class="" style="margin-top:20px;">
          <button type="submit" class="btn btn-primary btn-sm set-sync-btn">Set Media Sync Data</button>
        </div>
      </form>
      <hr class="my-4">
      <form action="<?php echo admin_url('?page=searchie-settings');?>" method="POST">
        <input type="hidden" name="page" value="searchie-settings">
        <input type="hidden" name="_method" value="set-sync-widgets">
        <div class="form-group">
          <label for="sync-widget" class="font-weight-bold">Widgets</label>
          <select name="widget-datasource" class="form-control form-control-sm">
            <option value="live" <?php echo (sio_get_widget_datasource() == 'live') ? 'selected':'';?>>Live</option>
            <option value="local" <?php echo (sio_get_widget_datasource() == 'local') ? 'selected':'';?>>Local (Recommended)</option>
          </select>
        </div>
        <div class="" style="margin-top:20px;">
          <button type="submit" class="btn btn-primary btn-sm set-sync-btn">Set Widgets Sync Data</button>
        </div>
      </form>
      <hr class="my-4">
      <form action="<?php echo admin_url('?page=searchie-settings');?>" method="POST">
        <input type="hidden" name="page" value="searchie-settings">
        <input type="hidden" name="_method" value="set-sync-playlist">
        <div class="form-group">
          <label for="sync-playlist" class="font-weight-bold">Playlist</label>
          <select name="playlist-datasource" class="form-control form-control-sm">
            <option value="live" <?php echo (sio_get_playlist_datasource() == 'live') ? 'selected':'';?>>Live</option>
            <option value="local" <?php echo (sio_get_playlist_datasource() == 'local') ? 'selected':'';?>>Local (Recommended)</option>
          </select>
        </div>
        <div class="" style="margin-top:20px;">
          <button type="submit" class="btn btn-primary btn-sm set-sync-btn">Set Playlist Sync Data</button>
        </div>
      </form>
    </div>

  </div>
</div>
