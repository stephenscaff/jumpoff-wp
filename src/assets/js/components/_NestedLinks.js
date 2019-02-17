import Utils from '../components/_Utils.js'

/**
 * Nested Links
 * Allows for links nested inside a block level link wrap
 * via a data attribute of the link location.
 * @author Stephen Scaff
 */
const NestedLinks = (() => {

  let nestedLinks = document.querySelectorAll('[data-nested-link]');

  return{

    /**
     * Init
     */
    init: function(){
      this.buildLink();
    },

    /**
     * Build Link
     * Constructs our nested link from our data attribute
     */
    buildLink(){


      Utils.forEach ( nestedLinks, function (index, nestedLink) {

        nestedLink.addEventListener('click', function (e) {
          var fakieLink = this.dataset.nestedLink;
          fakieLink && (e.preventDefault(), e.stopPropagation(),
          window.open && e.metaKey ? window.open(fakieLink) : window.location.assign(fakieLink));
        });
      });
    },
  };
 })();

export default NestedLinks;
