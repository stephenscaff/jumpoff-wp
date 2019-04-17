import Utils from '../components/_Utils.js'

/**
* Header State
* Updats Header state on scroll
*/

const HeaderState = (() => {


 const body = document.querySelector('body');
 const header = document.querySelector('.app-header');
 const threshold = 40;
 const throttleAmnt = 10;
 const lastKnownScrollY = 0;
 const classes = {
   pinned : 'header-is-pinned',
   unpinned : 'header-is-unpinned',
 }

 return {

   init(){
     this.bindEvents()
   },

   bindEvents(){
     setTimeout(function() {
       window.addEventListener('scroll', Utils.throttle(HeaderState.scrollLogic, throttleAmnt));
     }, 10);
   },

  /**
   * Handles the scroll logic
   */
  scrollLogic() {

    var scrollDistance =  Math.round(window.scrollY);

    if (scrollDistance >= threshold) {
      HeaderState.pin();
    }

    if (scrollDistance <= 0) {
      HeaderState.unpin();
    }
  },

  /**
   * Pinned State (fixed position)
   */
  pin() {
     body.classList.remove(classes.unpinned);
     body.classList.add(classes.pinned);
     header.classList.remove(classes.unpinned);
     header.classList.add(classes.pinned);
   },

   /**
    * Unpinned State
    */
   unpin() {
     body.classList.remove(classes.pinned);
     body.classList.add(classes.unpinned);
     header.classList.remove(classes.pinned);
     header.classList.add(classes.unpinned);
   }
 };
})();


export default HeaderState;
