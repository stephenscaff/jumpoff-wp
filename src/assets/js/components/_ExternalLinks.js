import Utils from '../components/_Utils.js'
/**
 * Speed Bump
 * Determines if a 'real' external link was clicked,
 * in order to show a speed bumb modal with close / continue buttons

 * @author Stephen Scaff
 */
const ExternalLinks = (() => {


   return{

     /**
      * Init
      */
     init() {
       this.bindEvents();
     },

     /**
      * Bind Events
      */
     bindEvents() {
       ExternalLinks.checkLinks();
     },


    /**
     * Check Links
     * Loops through page links, if external
     * calls Speed Bump modal and applies follow link to btn.
     */
    checkLinks() {
      var links = document.getElementsByTagName('a');

      Utils.forEach ( links, function (index, link) {

        if (!ExternalLinks.isExternal(link)) return

        link.target = '_blank';

      });
    },


    /**
     * Checks if link is really external
     * and not a 'fake' external (ie; mailto, tel, js handler)
     * @return boolean
     */
    isExternal(link) {

      return (
        link.hasAttribute("href")     &&
        !link.href.match(/^mailto\:/) &&
        !link.href.match(/^tel\:/)    &&
        !link.href.match(/^#\:/)      &&
        link.hostname !== window.location.hostname
      );
    },
 };
})();

export default ExternalLinks;
