<?php
if(isset($portfolio_cal)){
	$limit=$portfolio_cal['limit'];
	$order_by=$portfolio_cal['order'];
	$portfolio = new WP_Query(array('post_type' => 'portfolio','posts_per_page'=>$limit,'order'=>$order_by,'post_status' => 'publish'));
}else{
	$portfolio = new WP_Query(array('post_type' => 'portfolio','posts_per_page'=>-1,'post_status' => 'publish'));
?>
        <ul class="zu_filter zu_group">
             <li class="current all">
                <a href="#" rel="all">All</a>
             </li>
                <?php zu_portfolio_list_categories(); ?>
        </ul>
   		<?php } ?>
<ul class="zu_portfolio zu_group">
<?php $i=1; global $post; while ($portfolio->have_posts()) : $portfolio->the_post();
	$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");
	$portfoliourl = get_post_meta( $post->ID, '_zu_portfoliourl', true); ?>
    <li class="zu_item col-sm-4" data-id="id-<?php echo $i; ?>" data-type="<?php zu_portfolio_get_item_slug(get_the_ID()); ?>">
			<div class="wrapep">
		<?php if(get_the_post_thumbnail($post->ID, 'medium')){?>
               <?php echo get_the_post_thumbnail($post->ID, 'medium',array( 'class' => 'portfolio_img' ) ); ?>
               <?php }else{ ?>
               <img width="150" height="150" class="attachment-thumbnail wp-post-image" src="<?php echo PORTFOLIO_URL; ?>/images/no_images.jpg" />
               <?php }?>
               <div class="zu_portfoliourl">
					<div class="zu_portfoliourl_wrap">
                        <div class="zu_portfoliourl_cont">
                        <h4 class="item_title"><?php the_title(); ?></h4>
                            <div class="item_more">
                             <span><a class="zoom" target="_blank" href="<?php echo $imgsrc[0]; ?>" rel="prettyPhoto[portfolio]"></a></span>
                             <span><a class="link_post" href="<?php echo get_permalink($post->ID); ?>"></a></span>
                           </div>
                        </div>
                    </div>
               </div>
						</div>
 			</li>
<?php $i++; endwhile;?>
</ul>
