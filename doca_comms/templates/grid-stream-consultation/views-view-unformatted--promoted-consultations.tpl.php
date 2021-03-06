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
<?php foreach ($rows as $delta => $row): ?>
  <?php if ($delta == 2) : ?>
    <div class="layout-flex-grid">
  <?php endif; ?>
  <?php print $row; ?>
  <?php if ($delta >= 2 && ($delta == (count($rows) - 1))): ?>
    </div>
  <?php endif; ?>
<?php endforeach; ?>
