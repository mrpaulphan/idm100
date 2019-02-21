jQuery(function($) {
  var $elementor_container_width_description = $(
    '.form-table .elementor_container_width .description'
  );

  if ($elementor_container_width_description) {
    $elementor_container_width_description.text(
      'Sets the default width of the content area (Default: 1350)'
    );
  }
});
