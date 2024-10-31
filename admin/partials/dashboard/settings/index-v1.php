<div class="bootstrap-iso">
  <div class="wrap settings-wrapper">

    <div class="welcome">
      <div class="row">
        <div class="col-md-12 col-sm-12">
          <div class="jumbotron">
            <h1 class="display-4">Searchie</h1>
            <p class="lead">This is a sample text</p>
            <hr class="my-4">

            <div class="row">
              <div class="col-md-4 col-sm-6">
                <div class="card border-light  mb-3">
                  <div class="card-body text-dark">
                    <h5 class="card-title"></h5>
                    <?php if ( isset($msg->error) ) : ?>
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> <?php echo $msg->error;?> - <?php echo $msg->message;?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <?php elseif( $msg && $msg !== '' ) : ?>
                      <div class="alert alert-success alert-success fade show" role="alert">
                        <strong>Well Done!</strong> <?php echo $msg;?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <?php endif; ?>
                    <p></p>
                    <!-- <a class="btn btn-primary btn-lg" href="<?php echo $auth_url;?>" role="button">Connect to Searchie</a> -->
                    <p></p>
                    <div class="">
                      <form method="post" action="<?php echo admin_url('admin.php?page=Searchie');?>">
                        <input type="hidden" name="_method" value="connect-searchie">
                        <div class="form-group">
                          <label for="username">Username</label>
                          <input type="text" class="large-text" name="username" id="username" aria-describedby="usernameHelp">
                        </div>
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" name="password" class="large-text" id="password">
                        </div>
                        <button class="button-secondary" type="submit">Connect to Searchie</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="dashboard-api">
      <div class="row">

        <div class="col-md-3 col-sm-6">
          <div class="card border-light  mb-3">
            <div class="card-body text-dark">
              <h5 class="card-title">Profile</h5>
              <div class="profile-template">
                <?php SIO_API_Profile::get_instance()->show(); ?>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-5 col-sm-6">
          <div class="card border-light  mb-3">
            <div class="card-body text-dark">
              <h5 class="card-title">Media</h5>
              <div class="files-template">
                <?php SIO_API_Files::get_instance()->show(); ?>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-sm-6">
          <div class="card border-light  mb-3">
            <div class="card-body text-dark">
              <h5 class="card-title">Widget</h5>
              <div class="widget-template">
                <?php SIO_API_Widgets::get_instance()->show(); ?>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>
