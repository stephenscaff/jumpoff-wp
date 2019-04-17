<?php
/**
 * Views/Post/Search
 * Displays search form
 *
 * @author    Stephen Scaff
 * @package   jumpoff
 */

namespace Jumpoff;

if ( ! defined( 'ABSPATH' ) ) exit;

?>

<form
  id="js-search"
  role="search"
  method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <div class="input-group ">
  <i class="input-group__prefix-icon icon-search"></i>
    <input
      id="s"
      class="input-group__input"
      name="s"
      type="text"
      placeholder="Search the site">
    <button
      class="input-group__btn"
      type="submit"
      aria-label="Submit"
      title="Submit">
      <i class="icon-search"></i>
    </button>
   </div>
</form>
