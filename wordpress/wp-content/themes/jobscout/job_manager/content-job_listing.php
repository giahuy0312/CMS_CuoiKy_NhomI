<?php

/**
 * Job listing in the loop.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager
 * @category    Template
 * @since       1.0.0
 * @version     1.27.0
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

global $post;
$job_salary   = get_post_meta(get_the_ID(), '_job_salary', true);
$job_featured = get_post_meta(get_the_ID(), '_featured', true);
$company_name = get_post_meta(get_the_ID(), '_company_name', true);

?>
<link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<article <?php job_listing_class(); ?> data-longitude="<?php echo esc_attr($post->geolocation_lat); ?>"
  data-latitude="<?php echo esc_attr($post->geolocation_long); ?>">
  <div class="row logo-image">
    <div class="col-4 ">
      <figure class="company-logo">
        <?php the_company_logo('thumbnail'); ?>
      </figure>
    </div>
    <div class="col-8 entry-base">
      <h2 class="entry-title">
        <a href="<?php the_job_permalink(); ?>"><?php wpjm_the_job_title(); ?></a>
      </h2>

      <div class="created-post">Created: <?php echo get_post_datetime($post)->format('M d, Y') ?></div>
      <div class="job-posting">
        <?php
        if (get_option('job_manager_enable_types')) {
          $types = wpjm_get_the_job_types();
          if (!empty($types)) : foreach ($types as $jobtype) : ?>
        <li class="job-type-top-job job-type <?php echo esc_attr(sanitize_title($jobtype->slug)); ?>">
          <?php echo esc_html($jobtype->name); ?></li>
        <li class=" job-type-top-job job-type category-name ">
          <!-- <?php echo esc_html($jobtype->post->job_listing_category); ?> -->category-name
        </li>
        <li
          class="job-type-top-job job-type <?php echo esc_attr(sanitize_title($location = get_the_job_location($post))); ?>">
          <?php echo esc_html($location = get_the_job_location($post)); ?></li>
        <?php endforeach;
          endif;
        }
        do_action('job_listing_meta_end');
        ?>
      </div>
    </div>

  </div>
  <div class="row job-description1">
    <div class=" col " style="padding-left: revert;">
      <li>áđâsđá</li>
      <li>áđâsda</li>
      <li>sđâsdấdsád</li>
    </div>
  </div>

  <?php if ($job_featured) { ?>
  <div class="featured-label"><?php esc_html_e('Featured', 'jobscout'); ?></div>
  <?php } ?>

</article>