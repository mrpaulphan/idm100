jQuery(document).ready(function($) {
  'use strict';

  // Perfect Scrollbar
  if ($('.elementor-section').hasClass('neuron-fixed-yes')) {
    var ps = new PerfectScrollbar('.neuron-fixed-yes');
  }

  /**
   * Mega Menu Calculation
   */
  function calculateMegaMenu() {
    $('.elementor-widget-neuron-nav-menu').each(function() {
      var $menu = $(this);

      var $navHolder = $menu.find('.m-nav-menu--holder');
      var $subMenu = $navHolder.find('.m-mega-menu > .sub-menu');
      var $elementorContainer = $menu.parents('.elementor-container');

      var columnPadding = parseInt(
        $menu.parents('.elementor-column-wrap').css('padding')
      );

      var containerOffset = $elementorContainer.offset().left;
      var subMenuOffset = $navHolder.offset().left;

      var width = $elementorContainer.outerWidth() - columnPadding * 2;
      var offset = containerOffset - subMenuOffset + columnPadding;

      $subMenu.css({
        width: width,
        left: offset
      });
    });
  }

  /**
   * Mobile Menu Calculation
   */
  function calculateMobileMenu() {
    $('.m-nav-menu--stretch.elementor-widget-neuron-nav-menu').each(function() {
      var $menu = $(this);

      var $navHolder = $menu.find('.m-nav-menu--mobile-holder');
      var $mobileMenu = $navHolder.find('.m-nav-menu--mobile');
      var $elementorContainer = $menu.parents('.elementor-container');

      var columnPadding = parseInt(
        $menu.parents('.elementor-column-wrap').css('padding')
      );

      var columnLeftMargin = parseInt(
        $menu.find('.elementor-widget-container').css('marginLeft')
      );

      columnLeftMargin = columnLeftMargin ? columnLeftMargin : 0;

      var containerOffset = $elementorContainer.offset().left;
      var mobileMenuOffset = $navHolder.offset().left;

      var width = $elementorContainer.outerWidth() - columnPadding * 2;
      var offset =
        containerOffset - mobileMenuOffset + columnPadding + columnLeftMargin;

      $mobileMenu.css({
        width: width,
        left: offset
      });
    });
  }

  function neuronHamburgerMenu() {
    $('.elementor-widget-neuron-nav-menu').each(function() {
      var $menu = $(this);

      $menu
        .find('.m-nav-menu--mobile-holder .m-nav-menu--mobile-icon')
        .on('click', function(e) {
          e.stopPropagation();
          e.preventDefault();

          $menu
            .find('.m-nav-menu--mobile-holder .m-nav-menu--mobile')
            .toggleClass('active');

          $menu
            .find(
              '.m-nav-menu--mobile-holder .m-nav-menu--mobile .menu-item-has-children > .menu-item-icon'
            )
            .removeClass('active');

          $menu
            .find('.m-nav-menu--mobile-holder .m-nav-menu--mobile')
            .find('.sub-menu')
            .slideUp('fast');
        });
    });
  }

  function removeHiddenSections() {
    var $neuron_fixed = $('.neuron-fixed-yes');
    if (
      $neuron_fixed.is('.elementor-hidden-tablet') &&
      $(window).width() > 730 &&
      $(window).width() < 1025
    ) {
      $neuron_fixed.hide();
    } else if (
      $neuron_fixed.is('.elementor-hidden-phone') &&
      $(window).width() < 730
    ) {
      $neuron_fixed.hide();
    } else {
      $neuron_fixed.show();
    }
  }

  removeHiddenSections();
  calculateMegaMenu();
  calculateMobileMenu();
  neuronHamburgerMenu();

  $(window).on('resize', function() {
    removeHiddenSections();
    calculateMegaMenu();
    calculateMobileMenu();
  });
});
