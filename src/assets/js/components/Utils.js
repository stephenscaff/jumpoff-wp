//import 'whatwg-fetch'

/**
 * Global Utilities
 */
const Utils = (() => {

  return {


    /**
     * Is doc ready
     */
    isReady: function() {
      var state = document.readyState;
      if ( state === 'interactive' || state === 'complete') {
        return true;
      }
    },


    /**
     * A render utility
     * @param {mixed} - A template
     * @param {Node/Selector} - Where we render our template to
     * @example Util.render(someTemplate, renderToEl)
     */
    render(template, node) {
      if (!node) return;
      node.innerHTML = (typeof template === 'function' ? template() : template);
      var event = new CustomEvent('elementRenders', {
          bubbles: true
      });
      node.dispatchEvent(event);
      return node;
    },



    /**
     * ForEach Utility
     * Ensure we can loop over a object or nodelist
     * @see https://toddmotto.com/ditch-the-array-foreach-call-nodelist-hack/
     */
    forEach(array, callback, scope) {
      for (var i = 0; i < array.length; i++) {
        callback.call(scope, i, array[i]);
      }
    },


    /**
     * Throttler
     */
    throttle(fn, wait) {
      var time = Date.now();
      return function() {
        if ((time + wait - Date.now()) < 0) {
          fn();
          time = Date.now();
        }
      }
    },

    /**
     * Has Class
     */
    hasClass(el, className) {
      if (el.classList.contains(className)){
        return true;
      }
    },

    /**
     * toggle/add/remove
     */
    classList(el) {
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
    whichAnimationEvent(){
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
    triggerEvent( elem, event ) {
      var clickEvent = new Event( event );
      elem.dispatchEvent( clickEvent );
    },

    /**
     * Get the value of a querystring
     * @param  {String} field The field to get the value of
     * @param  {String} url   The URL to get the value from (optional)
     * @return {String}       The field value
     */
    getQueryString( field, url ) {
    	var href = url ? url : window.location.href;
    	var reg = new RegExp( '[?&]' + field + '=([^&#]*)', 'i' );
    	var string = reg.exec(href);
    	return string ? string[1] : null;
    },

    fetchData(url) {
      return window.fetch(url)
        .then(res => {
          return res.json()
        })
        .then(json => {
          return json
        })
        .catch(ex => console.log('failed', ex));
    },
    //
    // fetchData(url) {
    //    return fetch(url)
    //   .then(function(response) {
    //     return response.json()
    //   }).then(function(json) {
    //     console.log('parsed json', json);
    //     return json;
    //   }).catch(function(ex) {
    //     console.log('parsing failed', ex)
    //   })
    // },


    /**
     * JSONP Helper to load external data
     * @param {String} url
     * @param {function} callback
     * @param {Object} Invoked context in callback
     */
     loadJSONP(url, callback, context){

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

export default Utils;
