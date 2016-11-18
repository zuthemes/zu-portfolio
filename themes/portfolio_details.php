<?php

/* Template Name: Easy-Portfolio Details Page */

get_header();
function zu_add_meta_tags() {
		global $post;
		$metatitle = get_post_meta($post->ID, '_zu_metatitle', true);
		$metadesc = get_post_meta($post->ID, '_zu_metadesc', true); ?>
		<meta name="title" content="<?php echo $metatitle; ?>"/>
		<meta name="description" content="<?php echo $metadesc; ?>"/>
<?php }?>
<div class="wrapper section">
	<div class="container">
 			<?php while(have_posts()) : the_post(); ?>
   			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="post-inner">
					   	<div class="row">
								<div class="col-md-12 post-header">
                <h1 class="post-title"><?php the_title(); ?></h1>
								</div>

                 <div class="col-md-8 post-content">
                <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
								<div class="clearfix"></div>




								<?php
					$prev_post = get_previous_post();
					$next_post = get_next_post();
				?>

				<div class="post-navigation">

					<div class="post-navigation-inner">

						<?php
						if (!empty( $prev_post )): ?>

							<div class="post-nav-prev">
								<p><?php _e('Previous', 'lovecraft'); ?></p>
								<h4>
									<a href="<?php echo get_permalink( $prev_post->ID ); ?>" title="<?php _e('Previous post', 'lovecraft'); echo ': ' . esc_attr( get_the_title($prev_post) ); ?>">
										<?php echo get_the_title($prev_post); ?>
									</a>
								</h4>
							</div>
						<?php endif; ?>

						<?php
						if (!empty( $next_post )): ?>

							<div class="post-nav-next">
								<p><?php _e('Next', 'lovecraft'); ?></p>
								<h4>
									<a title="<?php _e('Next post', 'lovecraft'); echo ': ' . esc_attr( get_the_title($next_post) ); ?>" href="<?php echo get_permalink( $next_post->ID ); ?>">
										<?php echo get_the_title($next_post); ?>
									</a>
								</h4>
							</div>

						<?php endif; ?>

						<div class="clear"></div>

					</div> <!-- /post-navigation-inner -->

				</div> <!-- /post-navigation -->

								<div class="clearfix"></div>

								<?php comments_template( '', true ); ?>

								</div>
                <div class="col-md-4">
									<?php
                    $portfoliourl = get_post_meta( $post->ID, '_zu_portfoliourl', true);
                    $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");
                    $terms = wp_get_object_terms( $post->ID, 'portfolio_category' );
                    ?>
                	<b><?php _e('Portfolio Categories', 'lovecraft');?>:</b>
                    <p><?php foreach($terms as $val){ echo $val->name.'&nbsp;';} ?></p><br />
                    <?php if($portfoliourl){ ?><b><?php _e('Project URL', 'lovecraft');?>:</b>
                    <p>
                    <a target="_blank" href="<?php echo $portfoliourl; ?>">Go To Project</a></p><?php } ?>
                    <div class="zu_featured-image" id="zu_detail_img" >
                    <?php if(get_the_post_thumbnail($post->ID, 'thumbnail')){?>
                    <a href="<?php echo $imgsrc[0]; ?>" rel="prettyPhoto[portfolio]">
                        <?php echo get_the_post_thumbnail($post->ID, 'thumbnail'); ?>
                    </a>
                     <?php }else{ ?>
                 <img width="150" height="150" class="attachment-thumbnail wp-post-image" src="<?php echo PORTFOLIO_URL; ?>/images/no_images.jpg" />
                <?php }?>
                    </div>
                </div>
							</div>


				</div>
				</article>
				<?php endwhile;  ?>

	</div>
</div>
<?php get_footer(); ?>
<style>
.pp_hoverContainer{display:none!important;}
</style>
