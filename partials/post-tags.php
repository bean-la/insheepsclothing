<?php
$tags = get_the_tags($post->ID);
if ($tags) {
?>
<div class="margin-bottom-tiny grid-row">
  <span class="grid-item item-s-2">Tags:&nbsp;</span>
  <ul class="grid-item">
<?php
  foreach ($tags as $i => $tag) {
?>
    <li class="u-inline-block">
      <a class="link-underline" href="<?php echo get_tag_link($tag); ?>"><?php echo $tag->name; ?></a>
      <?php if ($i + 1 < count($tags)) { ?>
        <span>&nbsp;/&nbsp;</span>
      <?php } ?>
    </li>
<?php
  }
?>
  </ul>
</div>
<?php
}
?>
