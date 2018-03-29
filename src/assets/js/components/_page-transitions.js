
/**
 *  Page Transitions
 *  All sexy like page transitions between page loads
 *  Adds 'is-loading' | 'is-loaded' classes for loading
 *  Adds 'is-exiting' class while exiting
 *  Exclude links with 'no-trans' class
 *
 *  @author   Stephen Scaff
 */

// Page Transition
var PageTransition = (function() {

  var s,
      html = document.querySelector('html'),
      siteURL = 'http://' + top.location.host.toString();

  // The no-trans class
  var noTrans = 'no-trans';

  return {

    /**
     * Settings Object
     */
    settings: {
      //transLinks: document.querySelectorAll('a[href^="' + siteURL + '"], a[href^="/"], a[href^="./"], a[href^="../"]'),
      transLinks: document.querySelectorAll('a[href^="' + siteURL + '"], a[href^="/"]'),
      linkLocation: null,
      html_body: document.querySelectorAll('html, body'),
      html: document.querySelector('html'),
      body: document.querySelector('body'),
      exitDuration: 1100,
      entranceDuration: 700,
      isLoaded: false,
      isMenuLink: false,
    },

    /**
     * Init
     */
    init: function() {
      s = this.settings;
      this.isPageLoaded();
      this.entrance();
      this.transitionPage();
      this.unloadWindow();
      this.workaround();
    },

    /**
     * Enter Page
     */
    entrance: function() {
      s.html.classList.add('is-loading');
      // Remove class to prevent any Webkit bugs

      if (s.isLoaded = true) {
        setTimeout(function() {
          s.html.classList.remove('is-loading');
          s.html.classList.add('is-loaded');
        }, s.entranceDuration);
      }
    },

    /**
     * Exit Page
     */
    exit: function(duration) {
      s.html.classList.add('is-exiting');

      setTimeout(function() {
        PageTransition.redirectPage();
      }, duration);
    },

    /**
     * Is Loaded Check
     */
    isPageLoaded: function() {
      var state = document.readyState;
      if (state === 'interactive' || state === 'complete') {
      s.isLoaded = true;
      }
    },

    /**
     * Transition Page
     */
    transitionPage: function() {

      Util.forEach ( s.transLinks, function (index, transLink) {

        transLink.addEventListener('click', function (e) {

          s.linkLocation = this.href;

          // Bail if body has no-trans class
          if (s.html.classList.contains(noTrans) || this.classList.contains(noTrans)) return
          // Bail if modifer keys (must be before preventDefault)
          if (e.metaKey || e.ctrlKey || e.shiftKey) return;

          e.preventDefault();

          if (this.classList.contains('site-menu__link')) {
            console.log('menu Link')
            //var siteMenu = document.querySelector('.site-menu');
            var transTest = document.querySelector('.site-menu');
            s.html.classList.add('is-exiting');

            SiteMenu.close();
            PageTransition.exit(1300);
            //
            // transTest.addEventListener("transitionend", function(event) {
            //   PageTransition.exit();
            //   console.log('done')
            //   PageTransition.redirectPage();
            // });
          } else {
            PageTransition.exit(500);
          }
        });
      });
    },

    /**
     * Redirect Page
     */
    redirectPage: function() {
      window.location = s.linkLocation;
    },
    /**
     * Unload Window
     * Ensures back button works in FF,
     * @todo  update for jquery 3
     */
    unloadWindow: function() {
      // For back button history
      window.onbeforeunload = null;
    },

    /**
     * Workaround
     * Check the persisted property of the onpageshow event
     * to stop back button cache in Safari
     */
    workaround: function() {
      // For Safari browser
      window.onpageshow = function(e) {
        if (e.persisted) window.location.reload();
      };
    }
  }
})();

// Init our Module
PageTransition.init();
