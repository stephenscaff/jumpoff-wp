/*jshint unused:false */
/*jshint -W081 */

/**
 * Fetch More posts
 * A simple load more posts deal using the Fetch API.
 * Note that wpFetchMore var is passed via wp_localize_script, in addition
 * to pagination page position vars.
 *
 * @see fetch-more.php
 * @author stephen scaff
 */
var FetchMore = (function() {

  var nextLink = wpFetchMore.nextLink,
      pageNum = parseInt(wpFetchMore.startPage) + 1,
      maxPages = parseInt(wpFetchMore.maxPages),
      postsContainer = document.querySelector('#js-posts'),
      link = document.querySelector('#js-fetch-more'),
      linkContainer = document.querySelector('.fetch-more'),
      linkBtn = document.querySelector('#js-fetch-more .btn'),
      linkText = "Keep Reading",
      linkLoadingText = 'Loading...';

  return{

    /**
     * Init
     */
    init: function() {
      s = this.settings;
      this.bindEvents();
    },

    /**
     * Bind our events
     */
    bindEvents: function() {

      // Main click event
      FetchMore.checkLink();

      link.addEventListener('click', function (e) {
        e.preventDefault();
        console.log('clicked', pageNum, maxPages)
        if (pageNum <= maxPages) {
          console.log('clicked', pageNum)
          FetchMore.startAnimation();
          FetchMore.loadPosts();
          FetchMore.checkLink();
        }
      });

      //FetchMore.checkLink();
    },

    /**
     * Gets Posts from available pagination
     */
    loadPosts: function() {
      fetch(nextLink)
      .then( function (response) {
        return response.text();
      })
      .then( function (data) {
        FetchMore.displayPosts(data);
      })
      .then( function () {
        FetchMore.updatePage()
        FetchMore.endAnimation()
      })
      .catch( function(error) {
        console.log(error);
      });
    },

    /**
     * Display posts
     * Uses a doc fragment to store and add
     * our fetched text() (html) response
     */
    displayPosts: function(data) {
      var docFrag = document.createDocumentFragment(),
          fragDiv = document.createElement("div");

      fragDiv.innerHTML = data;
      docFrag.appendChild(fragDiv);

      var fetchedPosts = docFrag.querySelector('#js-posts'),
          fetchedPostsHTML = fetchedPosts.innerHTML;

      postsContainer.insertAdjacentHTML('beforeend', fetchedPostsHTML);
    },

    /**
     * Hide link if no more posts
     */
    checkLink: function() {
      console.log(pageNum, maxPages, nextLink, pageNum);
      if (pageNum >= maxPages) {
        linkContainer.classList.add('no-more-posts');
      }
    },

    /**
     * Begins animation, update btn text
     */
    startAnimation: function() {
      linkContainer.classList.add('is-animating');
      postsContainer.classList.add('is-animating');
      linkBtn.innerHTML = linkLoadingText;
    },

    /**
     * Ends our animation, updates btn text
     */
    endAnimation: function() {
      setTimeout(function() {
       linkContainer.classList.remove('is-animating');
       postsContainer.classList.remove('is-animating');
       linkBtn.innerText = linkText;
      }, 900);
    },

    /**
     * Updates paginaion pages
     */
    updatePage: function() {
      pageNum++;
      nextLink = nextLink.replace(/\/page\/[0-9]*/, '/page/' + pageNum);

    },
  };
})();

/**
 * Let's Do This
 */
if (document.querySelector('.fetch-more')) {
  document.addEventListener("DOMContentLoaded", function(event) {
    FetchMore.init();
  });
}
