<div class="row bg-blue flex-grow-1">
  <div class="searchie-sidebar-profile">
    <?php if ( $me ) : ?>
      <img  src="<?php echo $me->photo_url;?>" class="card-img-top img-fluid mx-auto" style="width:200px;">
    <?php endif; ?>
    <?php if ( $me ) : ?>

      <h5 class="card-title"><?php echo $me->name;?></h5>

      <p class="lead">
        API Profile.
      </p>

      <p>Current Team ID : <?php echo $me->current_team_id;?></p>
      <p>Current Team Hash : <?php echo $me->current_team_hash;?></p>
      <p></p>

      <!-- <a class="btn btn-primary btn-sm" href="admin.php?page=Searchie&_method=getme" role="button">Click to Re-Download /me Data</a> -->
      <p>
        <small class="text-muted">By Clicking Re-Download will get your updated data in API.</small>
      </p>

    <?php else: ?>
      <?php if ( sio_has_token() ) : ?>
        <p class="lead">
          Get your profile and store for later use.
        </p>
        <a class="btn btn-primary btn-sm" href="admin.php?page=Searchie&_method=getme" role="button">Store /me Data</a>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</div>
