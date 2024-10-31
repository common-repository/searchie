<div class="sio-card">
  <?php if ( $datas && !empty($datas) ) : ?>
    <a class="btn btn-primary btn-sm" href="<?php echo admin_url('?page=Searchie&_method=getwidgets');?>" role="button">Sync Widgets Data</a>
    <p>
      <small class="text-muted">By Clicking Sync will get your updated data in API.</small>
    </p>
    <div class="container set-global-widget">

      <form>
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="globalWidget">Set global Pop-out widget</label>
            <?php $widget_options = SIO_Settings_Widgets::get_instance()->widget_global(['action'=>'r','single'=>true]); ?>
            <select id="globalWidget" class="form-control form-control-sm" style="height:75%;">
              <option value="-1">Choose widgets / None</option>
              <?php foreach ( $datas as $data ) : ?>
                <option value="<?php echo $data->hash;?>" <?php echo ($data->hash == $widget_options) ? 'selected':'';?> ><?php echo $data->name;?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="form-row">
          <?php $widget_type = SIO_Settings_Widgets::get_instance()->widget_global_settings(['action'=>'r','single'=>true]); ?>
          <div class="form-group col-md-12">
            <select id="widgetType" class="form-control form-control-sm" style="height:75%;">
              <option value="full-height" <?php echo ($widget_type['type'] == 'full-height' ) ? 'selected' : ''; ?> >Full Height</option>
              <option value="floating-widget" <?php echo ($widget_type['type'] == 'floating-widget' ) ? 'selected' : ''; ?> >Floating</option>
            </select>
          </div>

        </div>

        <div class="form-row ">
          <div class="form-group col-md-12 float-position">
            <?php $option_float_position = SIO_Settings_Widgets::get_instance()->widget_float_position(['action'=>'r','single'=>true]); ?>
            <?php $float_positions = SIO_Settings_Widgets::get_instance()->floatPositionArr(); ?>
            <select id="floatPosition" class="form-control form-control-sm" style="height:75%;">
              <?php foreach( $float_positions as $key => $float_position ) : ?>
                <option value="<?php echo $key;?>" <?php echo ($key == $option_float_position) ? 'selected':'';?>><?php echo $float_position;?></option>
              <?php endforeach; ?>
            </select>
          </div>

            <?php
              $custom_button = SIO_Settings_Widgets::get_instance()->widget_custom_button([
                'action'  => 'r',
                'single'  =>  true
              ]);
            ?>
            <div class="form-group col-md-12 use-custom-button">
              <label for="globalWidget">Use custom button?</label>
              <select id="useCustomButton" name="useCustomButton" class="form-control form-control-sm" style="height:75%;">
                <option value="no" <?php echo ($custom_button == 'no' ) ? 'selected':'';?>>No</option>
                <option value="yes" <?php echo ($custom_button == 'yes' ) ? 'selected':'';?>>Yes</option>
              </select>
            </div>

          <?php
            $left_side = SIO_Settings_Widgets::get_instance()->widget_left_side([
              'action'  => 'r',
              'single'  =>  true
            ]);
          ?>
          <div class="form-group col-md-12 use-left-side">
            <label for="leftSide">Left side?</label>
            <select id="leftSide" name="leftSide" class="form-control form-control-sm" style="height:75%;">
              <option value="no" <?php echo ($left_side == 'no' ) ? 'selected':'';?>>No</option>
              <option value="yes" <?php echo ($left_side == 'yes' ) ? 'selected':'';?>>Yes</option>
            </select>
          </div>

        </div>

        <div class="form-row sio-widget-embed-button">
          <div class="form-group col-md-12 ">
            <p>Copy and paste this code where you want your button, usually on your template, or add as html embed in editor.</p>
            <textarea class="form-control" id="codeBUtton" rows="3" ><a href="javascript:window._searchie.toggle()">Click Here</a></textarea>
          </div>
        </div>

        <button type="submit" class="btn btn-primary btn-sm set-global-widget-btn">Set Global Widget</button>
        <small class="form-text text-muted ajax-msg-set-global-widget"></small>
      </form>
    </div>
    <div class="file-container">
      <ul class="list-unstyled">
        <?php foreach ( $datas as $data ) : ?>
          <li class="list-group-item">
            <div class="media-body">
              <h5 class="mt-0 mb-1"><?php echo $data->name;?></h5>
              <p>
                Embed Widget
                <input
                  type="text"
                  class="form-control form-control-sm"
                  value="[sio_embed_widget embed_url='<?php echo $data->embed_url;?>' width='100%' height='100vh']"
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
      <a class="btn btn-primary btn-sm" href="<?php echo admin_url('?page=Searchie&_method=getwidgets');?>" role="button">Get Widgets and Store data.</a>
    <?php endif; ?>
  <?php endif; ?>
</div>
