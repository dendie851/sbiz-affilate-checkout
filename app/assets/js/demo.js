// Auto update layout
(function() {
  window.layoutHelpers.setAutoUpdate(true);
  window.attachMaterialRippleOnLoad();
})();

// Collapse menu
(function() {
  if ($('#layout-sidenav').hasClass('sidenav-horizontal') || window.layoutHelpers.isSmallScreen()) {
    return;
  }

  try {
    window.layoutHelpers.setCollapsed(
      localStorage.getItem('layoutCollapsed') === 'true',
      false
    );
  } catch (e) {}
})();

$(function() {
  // Initialize sidenav
  $('#layout-sidenav').each(function() {
    new SideNav(this, {
      orientation: $(this).hasClass('sidenav-horizontal') ? 'horizontal' : 'vertical'
    });
  });

  // Initialize sidenav togglers
  $('body').on('click', '.layout-sidenav-toggle', function(e) {
    e.preventDefault();
    window.layoutHelpers.toggleCollapsed();
    if (!window.layoutHelpers.isSmallScreen()) {
      try { localStorage.setItem('layoutCollapsed', String(window.layoutHelpers.isCollapsed())); } catch (e) {}
    }
  });

  if ($('html').attr('dir') === 'rtl') {
    $('#layout-navbar .dropdown-menu').toggleClass('dropdown-menu-right');
  }
});

$(function() {
    // ***************************************************
    // Menu Customizer HTML
    /*
    $('body').append('' +
        '<div id="ui-builder" class="ui-builder">' +
            '<div class="style-toggler">' +
                '<a href="javascript:"></a>' +
            '</div>' +
            '<div class="ui-block">' +
                '<div class="style-head">' +
                    '<h5 class="m-0">Bhumlu Live UI Personalize</h5>' +
                '</div>' +
                '<div class="style-body">' +
                    '<div class="scroll-div mst-scroll">' +
                        '<h6>Sidebar background</h6>' +
                        '<label class="switcher switcher-dark mb-4">' +
                            '<input type="checkbox" class="switcher-input" id="nav-dark" checked>' +
                            '<span class="switcher-indicator">' +
                                '<span class="switcher-yes">' +
                                    '<span class="ion ion-md-checkmark"></span>' +
                                '</span>' +
                                '<span class="switcher-no">' +
                                    '<span class="ion ion-md-close"></span>' +
                                '</span>' +
                            '</span>' +
                            '<span class="switcher-label">Dark</span>' +
                        '</label><br>' +
                        '<h6>header background</h6>' +
                        '<div class="layout header-color">' +
                            '<a href="#!" class=" active" data-val="bg-white"><span></span><span></span></a>' +
                            '<a href="#!" class="" data-val="bg-primary"><span></span><span></span></a>' +
                            '<a href="#!" class="" data-val="bg-danger"><span></span><span></span></a>' +
                            '<a href="#!" class="" data-val="bg-success"><span></span><span></span></a>' +
                            '<a href="#!" class="" data-val="bg-warning"><span></span><span></span></a>' +
                            '<a href="#!" class="" data-val="bg-info"><span></span><span></span></a>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
            '</div>' +
        '</div>');
    */
    // ***********************************************************
    // Menu Customizer Start

    // open Menu Styler
    $('#ui-builder > .style-toggler').on('click', function() {
        $('#ui-builder').toggleClass('open');
    });

    // Navbar background
    $('#nav-dark').change(function() {
        if ($(this).is(":checked")) {
            $('#layout-sidenav').removeClass('bg-white');
            $('#layout-sidenav').addClass('bg-dark');
        } else {
            $('#layout-sidenav').addClass('bg-white');
            $('#layout-sidenav').removeClass('bg-dark');
        }
    });
    // Layout Fixed
    $('#layout-fixed').change(function() {
        if ($(this).is(":checked")) {
            $('html').addClass('layout-fixed');
        } else {
            $('html').removeClass('layout-fixed');
        }
    });

    // Menu Fixed
    $('#menu-fixed').change(function() {
        if ($(this).is(":checked")) {
            $('html').addClass('layout-navbar-fixed');
        } else {
            $('html').removeClass('layout-navbar-fixed');
        }
    });

    // Box layouts
    $('#box-layouts').change(function() {
        if ($(this).is(":checked")) {
            $('body').addClass('container');
            $('body').addClass('box-layout');
        } else {
            $('body').removeClass('container');
            $('body').removeClass('box-layout');
        }
    });

    // Header Color
    $('.header-color > a').on('click', function() {
        var temp = $(this).attr('data-val');
        $('#layout-navbar').removeClassPrefix('bg-');
        $('#layout-navbar').addClass(temp);
    });

    $.fn.removeClassPrefix = function(prefix) {
        this.each(function(i, it) {
            var classes = it.className.split(" ").map(function(item) {
                return item.indexOf(prefix) === 0 ? "" : item;
            });
            it.className = classes.join(" ");
        });
        return this;
    };
    // Menu Customizer End
    // ***************************************************
});
