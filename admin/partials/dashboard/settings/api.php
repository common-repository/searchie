<div class="api-container">

  <div class="row">

    <div class="col-md-4 col-sm-6 profile-template">
      <?php SIO_API_Profile::get_instance()->showPartProfile(); ?>
    </div>

    <div class="col-md-8 col-sm-6 files-template">
      <?php SIO_API_Files::get_instance()->showPartFile(); ?>
    </div>

  </div>

</div>
