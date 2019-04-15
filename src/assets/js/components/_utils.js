/**
 * Global Utilities
 */

var Util = (function() {

  return {

    /**
     * A render utility
     * @param {mixed} - A template
     * @param {Node/Selector} - Where we render our template to
     * @example Util.render(someTemplate, renderToEl)
     */
    render: function (template, node) {
      if (!node) return;
      node.innerHTML = (typeof template === 'function' ? template() : template);
      var event = new CustomEvent('elementRenders', {
          bubbles: true
      });
      node.dispatchEvent(event);
      return node;
    },


    /**
     * Is In View?
     * A super simple in viewport check
     * Would probs want to build this out a bit more
     *
     * @param  {el} Element to test
     * @param  {threshold} Integar Amount of threshold
     * @return {boolean}
     */
    isInView: function(el, threshold) {
      // 'sup jquery
      if (typeof jQuery === "function" && el instanceof jQuery) {
        el = el[0];
      }
      var threshold = Math.floor(threshold * 100),
          winY = window.innerHeight - threshold || document.documentElement.clientHeight - threshold,
          bounds = el.getBoundingClientRect(),
          isTopVisible = (bounds.top >= 0) && (bounds.top <= winY);

      return isTopVisible;
    },


    /**
     * ForEach Utility
     * Ensure we can loop over a object or nodelist
     * @see https://toddmotto.com/ditch-the-array-foreach-call-nodelist-hack/
     */
    forEach: function (array, callback, scope) {
      for (var i = 0; i < array.length; i++) {
        callback.call(scope, i, array[i]);
      }
    },


    /**
     * Throttle Util
     * Stoopid simple throttle util to control scroll events and so on.
     *
     * @param  {Function}  Function call to throttle.
     * @param  {int}       milliseconds to throttle  method
     * @return {Function}  Returns a throttled function
     */
    throttle: function(callback, ms) {
      var wait = false;
      return function () {
          if (!wait) {
              callback.call();
              wait = true;
              setTimeout(function () {
                  wait = false;
              }, ms);
          }
      };
    },

    /**
     * Has Class
     */
    hasClass: function(el, className) {
      if (el.classList.contains(className)){
        return true;
      }
    },

    /**
     * toggle/add/remove
     */
    classList: function(el) {
      var list = el.classList;

      return {
          toggle: function(c) { list.toggle(c); return this; },
          add:    function(c) { list.add   (c); return this; },
          remove: function(c) { list.remove(c); return this; }
      };
    },

    /**
     * Detected when animations end
     */
    whichAnimationEvent: function(){
      var t;
      var el = document.createElement("fakeelement");

      var animations = {
        "animation"      : "animationend",
        "OAnimation"     : "oAnimationEnd",
        "MozAnimation"   : "animationend",
        "WebkitAnimation": "webkitAnimationEnd"
      }

      for (t in animations){
        if (el.style[t] !== undefined){
          return animations[t];
        }
      }
    },

    /**
     * Trigger Event
     */
    triggerEvent: function( elem, event ) {
      var clickEvent = new Event( event );
      elem.dispatchEvent( clickEvent );
    },

    /**
     * Get the value of a querystring
     * @param  {String} field The field to get the value of
     * @param  {String} url   The URL to get the value from (optional)
     * @return {String}       The field value
     */
    getQueryString: function ( field, url ) {
    	var href = url ? url : window.location.href;
    	var reg = new RegExp( '[?&]' + field + '=([^&#]*)', 'i' );
    	var string = reg.exec(href);
    	return string ? string[1] : null;
    },


    /**
     * JSONP Helper to load external data
     * @param {String} url
     * @param {function} callback
     * @param {Object} Invoked context in callback
     */
     loadJSONP: function(url, callback, context){

       var unique = 0;
       var name = "_jsonp_" + unique++;
       if (url.match(/\?/)) url += "&callback="+name;
       else url += "?callback="+name;

       // Create script
       var script = document.createElement('script');
       script.type = 'text/javascript';
       script.src = url;

       window[name] = function(data){
         callback.call((context || window), data);
         document.getElementsByTagName('head')[0].removeChild(script);
         script = null;
         delete window[name];
       };

       // Load JSON
       document.getElementsByTagName('head')[0].appendChild(script);

     },
   };
 })();
