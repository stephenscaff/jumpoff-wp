/**
 * Site Menu
 * Site Menu Opening
 * @author Stephen Scaff
 */
 var SiteMenu = (function() {

   var html = document.querySelector('html');
   var menuToggle = document.querySelector('.js-menu-toggle');
   var isOpen = false;

   return{

     /**
      * Init
      */
     init: function() {
       this.bindEvents();
     },

     bindEvents:function() {

       menuToggle.addEventListener('click', function (e) {
         SiteMenu.transitionState();
         e.preventDefault();
       });

       window.onkeydown = function(e) {
         if (isOpen && e.keyCode === 27) {
           SiteMenu.transitionState();
           e.preventDefault();
         }
       }
     },

     /**
      * Transition State logic
      */
     transitionState: function(elem){
       if (isOpen) {
         SiteMenu.close();
       } else {
         SiteMenu.open();
       }
     },

     /**
      * Close
      */
     close: function(){
       html.classList.add('menu-is-closing');

       setTimeout(function(){
         html.classList.remove('menu-is-open');
         html.classList.add('menu-is-closed');
         html.classList.remove('menu-is-closing');
         isOpen = false;
       }, 1800);
     },

     /**
      * Open
      */
     open: function(){
       html.classList.add('menu-is-opening');

       setTimeout(function(){
         html.classList.remove('menu-is-closed');
         html.classList.add('menu-is-open');
         html.classList.remove('menu-is-opening');
        isOpen = true;

       }, 0);
     },
   };
  })();
 SiteMenu.init();
