<?php
function zu_add_portfolio_metaboxes() {
  	add_meta_box('zu_portfolio_url', 'Portfolio Settings', 'zu_portfolio_urls', 'portfolio', 'normal', 'high');
}
function zu_portfolio_urls() {
	global $post;
 	$portfoliourl = get_post_meta($post->ID, '_zu_portfoliourl', true);
	$metatitle = get_post_meta($post->ID, '_zu_metatitle', true);
	$metadescription = get_post_meta($post->ID, '_zu_metadesc', true); ?>
        <table>
          <tr>
            <th scope="row"><label>Portfolio URL</label></th>
             <td><input size="50" type="text" name="_zu_portfoliourl" value="<?php echo $portfoliourl; ?>"/></td>
              <td><span>Enter Your Portfolio URL optional)</span></td>
          </tr>
          <tr>
            <th scope="row"><label>Meta Title</label></th>
             <td><input size="50" type="text" name="_zu_metatitle" value="<?php echo $metatitle; ?>"/></td>
              <td><span>Enter Portfolio Meta Title (optional)</span></td>
          </tr>
          <tr>
            <th scope="row"><label>Meta Description</label></th>
            <td><textarea cols="50" rows="5" name="_zu_metadesc"><?php echo $metadescription; ?></textarea></td>
            <td><span>Enter Portfolio Meta Description(optional)</span></td>
          </tr>
        </table>
<?php } ?>
<?php
function zu_save_portfolio($post_id, $post) {
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
	$data = array();
	if(isset($_POST['_zu_portfoliourl'])){
		$data['_zu_portfoliourl'] = $_POST['_zu_portfoliourl'];
 	}
	if(isset($_POST['_zu_metatitle'])){
 		$data['_zu_metatitle'] = $_POST['_zu_metatitle'];
 	}
	if(isset($_POST['_zu_metadesc'])){
 		$data['_zu_metadesc'] = $_POST['_zu_metadesc'];
	}
	foreach ($data as $key => $value) {
		if( $post->post_type == 'revision' ) return;
		$value = implode(',', (array)$value);
		if(get_post_meta($post->ID, $key, FALSE)) {
			update_post_meta($post->ID, $key, $value);
		} else {
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key);
	}
}
add_action('save_post', 'zu_save_portfolio', 1, 2);
?>
