<?php
/**
 * Blog Section
 * 
 * @package JobScout
 */

$blog_heading = get_theme_mod( 'blog_section_title', __( 'Latest Articles', 'jobscout' ) );
$sub_title    = get_theme_mod( 'blog_section_subtitle', __( 'We will help you find it. We are your first step to becoming everything you want to be.', 'jobscout' ) );
$blog         = get_option( 'page_for_posts' );
$label        = get_theme_mod( 'blog_view_all', __( 'See More Posts', 'jobscout' ) );
$hide_author  = get_theme_mod( 'ed_post_author', false );
$hide_date    = get_theme_mod( 'ed_post_date', false );
$ed_blog      = get_theme_mod( 'ed_blog', true );

$args = array(
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => 4,
    'ignore_sticky_posts' => true
);

$qry = new WP_Query( $args );

?>
<style>
.post {
    box-shadow: none !important;
    border-radius: 0 !important;
    background: #fff;
    padding: 15px;
}

.photo img,
.photo svg {
    width: 160px;
    height: 160px
}

.post .content-blog {
    transform: translateY(calc(95px - 50%));
}

.titlebinh {
    text-decoration: none;
    color: black;
    font-weight: 700;
}

.rm-binh {
    text-decoration: none;
    color: #ff7f26;
    font-weight: 700;
}
</style>
<?php if($ed_blog && ($blog_heading || $sub_title || $qry->have_posts())) {
    ?><section id="blog-section" class="article-section" style="background: #f5f5f7; padding: 70px 0; margin: 0">
    <div class="container"><?php if($blog_heading) echo '<h2 class="section-title">'. esc_html($blog_heading) . '</h2>';
    if($sub_title) echo '<div class="section-desc">'. wpautop(wp_kses_post($sub_title)) . '</div>';

    ?><?php if($qry->have_posts()) {
        ?><div class="article-wrap"><?php while($qry->have_posts()) {
            $qry->the_post();

            ?><article class="post">
                <div class="row">
                    <div class="col-md-5 photo"><a href="<?php the_permalink(); ?>" class="post-thumbnail"><?php if(has_post_thumbnail()) {
                the_post_thumbnail('jobscout-blog', array('itemprop'=> 'image'));
            }

            else {
                jobscout_fallback_svg_image('jobscout-blog');
            }

            ?></a></div>
                    <div class="col-md-7 content-blog"><a href="<?php the_permalink(); ?>" class="titlebinh">
                            <div class="titlebinh"><?php the_title();
            ?></div>
                        </a>
                        <div class="des-titlebinh" itemprop="text"><?php // the_content();
            $content=get_the_content();
            $trimmed_content=substr(strip_tags($content), 0, 117);
            echo $trimmed_content;
            ?></div><a href="<?php the_permalink(); ?>" class="rm-binh">
                            <div class="rm-binh">Read More </div>
                        </a>
                    </div>
                </div>
            </article><?php
        }

        wp_reset_postdata();

        ?></div>
        <?php if($blog && $label) {
            ?><div class="btn-wrap"><a href="<?php the_permalink( $blog ); ?>" class="btn"><?php echo esc_html($label);
            ?></a></div><?php
        }

        ?><?php
    }

    ?>
    </div>
</section><?php
}