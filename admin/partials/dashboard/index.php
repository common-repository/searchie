<div class="bootstrap-iso">
  <div class="container-fluid searchie-dashboard">
    <div class="row justify-content-center min-vh-90">
      <div class="col-md-2 col-sm-12 xbg-red searchie-dashboard-left">
        <div class="d-flex flex-column h-100 searchie-dashboard-left-content">
          <h3>Searchie</h3>

          <div class="row xbg-purple">
            <div class="searchie-dashboard-sidebar">
              <?php do_action('searchie-dashboard-sidebar-content'); ?>
            </div>
          </div>

          <?php do_action('searchie-after-dashboard-sidebar-content'); ?>
        </div>
      </div>

      <div class="col-md-10 col-sm-12 bg-white searchie-dashboard-right">
        <div class="container searchie-dashboard-content searchie-dashboard-right-content">
          <h3><?php echo apply_filters('searchie-right-content-title', 'Right Content Title'); ?></h3>

          <?php do_action('searchie-dashboard-right-content'); ?>

        </div>
      </div>

    </div>
  </div>
</div>
