<?php
/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<div class="layout-flex-grid ie-fix clearfix">
  <?php foreach ($rows as $delta => $row): ?>
    <?php print $row; ?>
  <?php endforeach; ?>
</div>