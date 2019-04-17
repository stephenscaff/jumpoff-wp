/**
 * Site Menu on Mobile
 * Site Menu Opening
 * @author Stephen Scaff
 */
const MenuSmall = (() => {

   const html = document.querySelector('html');
   const menuToggle = document.querySelector('.js-menu-toggle');
   const times = {
     open: 0,
     close: 800,
   }
   var isOpen = false;

   return{

     /**
      * Init
      */
     init() {
       this.bindEvents();
     },

     bindEvents() {

       menuToggle.addEventListener('click', function (e) {
         MenuSmall.transitionState();
         e.preventDefault();
       });

       window.onkeydown = function(e) {
         if (isOpen && e.keyCode === 27) {
           MenuSmall.transitionState();
           e.preventDefault();
         }
       }
     },

     /**
      * Transition State logic
      */
     transitionState(elem){
       if (isOpen) {
         MenuSmall.close();
       } else {
         MenuSmall.open();
       }
     },

     /**
      * Open
      */
     open(){
       html.classList.add('menu-is-opening');
       setTimeout(() => {
         html.classList.remove('menu-is-closed');
         html.classList.add('menu-is-open');
         html.classList.remove('menu-is-opening');
        isOpen = true;

      }, times.open);
     },

     /**
      * Close
      */
     close(){
       html.classList.add('menu-is-closing');

       setTimeout(() => {
         html.classList.remove('menu-is-open');
         html.classList.add('menu-is-closed');
         html.classList.remove('menu-is-closing');
         isOpen = false;
       }, times.close);
     },
   };
  })();

export default MenuSmall;
