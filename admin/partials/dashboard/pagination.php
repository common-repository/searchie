<?php
  $first = $url_links['first'];
  $prev = $url_links['prev'];
  $next = $url_links['next'];
  $last = $url_links['last'];

  $first_href = '#';
  if ( $first != '' ) {
    $first_href = admin_url($link_href . $first);
  }
  $prev_href = '#';
  if ( $prev != '' ) {
    $prev_href = admin_url($link_href . $prev);
  }
  $next_href = '#';
  if ( $next != '' ) {
    $next_href = admin_url($link_href . $next);
  }
  $last_href = '#';
  if ( $last != '' ) {
    $last_href = admin_url($link_href . $last);
  }
?>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-end">
    <li class="page-item <?php echo ($first == '') ? 'disabled' : '';?>" >
      <a class="page-link" href="<?php echo $first_href;?>" data-paged="<?php echo ($first == '') ? 0 : $first;?>" aria-disabled="<?php echo ($first == '') ? 'true' : '';?>" >First</a>
    </li>
    <li class="page-item <?php echo ($prev == '') ? 'disabled' : '';?>">
      <a class="page-link" href="<?php echo $prev_href;?>" data-paged="<?php echo ($prev == '') ? 0 : $prev;?>"aria-disabled="<?php echo ($prev == '') ? 'true' : '';?>" >Previous</a>
    </li>
    <li class="page-item <?php echo ($next == '') ? 'disabled' : '';?>">
      <a class="page-link" href="<?php echo $next_href;?>" data-paged="<?php echo ($next == '') ? 0 : $next;?>" aria-disabled="<?php echo ($next == '') ? 'true' : '';?>" >Next</a>
    </li>
    <li class="page-item" <?php echo ($last == '') ? 'disabled' : '';?>>
      <a class="page-link" href="<?php echo $last_href;?>" data-paged="<?php echo ($last == '') ? 0 : $last;?>" aria-disabled="<?php echo ($last == '') ? 'true' : '';?>" >Last</a>
    </li>
  </ul>
</nav>
