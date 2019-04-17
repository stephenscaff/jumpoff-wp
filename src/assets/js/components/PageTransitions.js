import Utils from '../components/Utils.js'

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
const PageTransitions = (() => {

  let s
  const html = document.querySelector('html');
  const siteURL = location.host.toString();

  // The no-trans class
  var noTrans = 'no-trans';

  return {

    /**
     * Settings Object
     */
    settings: {
      transLinks: document.querySelectorAll('a[href^="http://' + siteURL + '"], a[href^="https://' + siteURL + '"], a[href^="/"]',),
      linkLocation: null,
      html: document.querySelector('html'),
      body: document.querySelector('body'),
      exitDuration: 900,
      entranceDuration: 500,
      isLoaded: false,
      isMenuLink: false,
      finalAnimationStart: 600,
      classes: {
        loading: 'is-loading',
        loaded: 'is-loaded',
        exiting: 'is-exiting'
      }
    },

    /**
     * Init
     */
    init() {
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
    entrance() {
      s.html.classList.add(s.classes.loading);

      if (s.isLoaded = true) {
        setTimeout(function() {
          s.html.classList.remove(s.classes.loading);
          s.html.classList.add(s.classes.loaded);
        }, s.entranceDuration);

        setTimeout(function() {
          s.html.classList.add('is-animation-ready');
        }, s.finalAnimationStart);
      }
    },

    /**
     * Exit Page
     */
    exit(duration) {
      s.html.classList.add(s.classes.exiting);

      setTimeout(function() {
        PageTransitions.redirectPage();
      }, duration);
    },

    /**
     * Is Loaded Check
     */
    isPageLoaded() {
      const state = document.readyState;
      if (state === 'interactive' || state === 'complete') s.isLoaded = true;
    },

    /**
     * Transition Page
     */
    transitionPage() {

      Utils.forEach ( s.transLinks, function (index, transLink) {

        transLink.addEventListener('click', function (e) {

          s.linkLocation = this.href;

          // Bail if body has no-trans class
          if (s.html.classList.contains(noTrans) || this.classList.contains(noTrans)) return;

          if (transLink.href.match('pdf')) return;
          // Bail if modifer keys (must be before preventDefault)
          if (e.metaKey || e.ctrlKey || e.shiftKey) return;

          e.preventDefault();

          window.scroll({top: 0, left: 0, behavior: 'smooth' });
          PageTransitions.exit(s.exitDuration);
        });
      });
    },

    /**
     * Redirect Page
     */
    redirectPage() {
      window.location = s.linkLocation;
    },
    /**
     * Unload Window
     * Ensures back button works in FF,
     * @todo  update for jquery 3
     */
    unloadWindow() {
      // For back button history
      window.onbeforeunload = null;
    },

    /**
     * Workaround
     * Check the persisted property of the onpageshow event
     * to stop back button cache in Safari
     */
    workaround() {
      // For Safari browser
      window.onpageshow = function(e) {
        if (e.persisted) window.location.reload();
      };
    }
  }
})();

// Init our Module
export default PageTransitions;
