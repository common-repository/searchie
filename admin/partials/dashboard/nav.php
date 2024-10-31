<nav class="navbar navbar-expand-lg ">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="nav flex-column">
      <?php foreach($navs as $nav) : ?>
        <li class="nav-item <?php echo ($nav['id'] == $current_page) ? 'active':'';?>">
          <a class="nav-link" href="<?php echo $nav['link'];?>"><?php echo $nav['name'];?> <span class="sr-only">(current)</span></a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</nav>
