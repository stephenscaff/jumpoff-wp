<?php
/**
 * Video Module
 *
 * The module for creating vid blocks with mp4s, vimeo id, or youtube id.
 * Uses plyr.js for custom ui and integrations.
 *
 * @author       Stephen Scaff
 * @package      partials/modules
 * @see          js/plyr.js
 * @version      1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$mp4 = get_sub_field('video_mp4');
$youtube_id = get_sub_field('video_youtube_id');
$vimeo_id = get_sub_field('video_vimeo_id');

?>

<section class="vid-block module pad-sm">
  <div class="grid-lg">
    <div class="vid-block__vid">
    <?php if ($vimeo_id) : ?>
      <div id="js-plyr" class="js-plyr" data-plyr-provider="vimeo" data-plyr-embed-id="<?php echo $vimeo_id; ?>"></div>
    <?php elseif ($youtube_id) : ?>
      <div id="js-plyr" class="js-plyr" data-plyr-provider="youtube" data-plyr-embed-id="<?php echo $youtube_id; ?>"></div>
    <?php else : ?>
      <video class="vid-block__video " poster="" controls crossorigin poster="">
        <source type="video/mp4" src="<?php echo $work_mp4['url']; ?>">
      </video>
    <?php endif; ?>
    </div>
  </div>
</section>
