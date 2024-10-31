<div class="row xbg-blue flex-grow-1">
  <div class="searchie-sidebar-profile">
    <?php if ( $me ) : ?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4 col-sm-12">
            <img  src="<?php echo $me->photo_url;?>" class="" style="width:44px;">
          </div>
          <div class="col-md-8 col-sm-12 profile-details">
            <h5 class="profile-name"><?php echo $me->name;?></h5>
            <span class="api-profile">API Profile</span>
          </div>
        </div>
        <ul class="list-group list-group-flush">
          <li class="d-flex justify-content-between align-items-center">
            Current Team ID :
            <span class="badge"><?php echo $me->current_team_id;?></span>
          </li>
          <li class="d-flex justify-content-between align-items-center">
            Current Team Hash :
            <span class="badge"><?php echo $me->current_team_hash;?></span>
          </li>
        </ul>
        <ul class="list-unstyled">
          <!-- <li><a class="button-primary button-dashboard" href="admin.php?page=Searchie&_method=getme" role="button"><?php //esc_attr_e( 'Re-download /me Data' ); ?></a></li> -->
          <li><a class="button-secondary button-dashboard" href="admin.php?page=Searchie&_method=disconnect" role="button"><?php esc_attr_e( 'Disconnect' ); ?></a></li>
        </ul>
      </div>
    <?php endif; ?>
  </div>
</div>
