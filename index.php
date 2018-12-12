<?php 
/*
 Plugin Name: Construction Realestate Post Type
 Plugin URI: https://www.buywptemplates.com/
 Description: Creating new post type for Construction Realestate Pro Theme
 Author: Buy WP Templates
 Version: 1.3
 Author URI: https://www.buywptemplates.com/
 Text Domain: construction-realestate-posttype
 Domain Path: /languages/
*/

define( 'CONSTRUCTION_REALESTATE_POSTTYPE_VERSION', '1.3' );

/* Properties*/
add_action( 'init', 'createpackages');
add_action( 'init', 'construction_realestate_pro_create_post_type' );

function construction_realestate_pro_create_post_type() {
  register_post_type( 'properties',
    array(
		'labels' => array(
			'name' => __( 'Properties','construction-realestate-posttype' ),
			'singular_name' => __( 'Properties','construction-realestate-posttype' )
		),
		'capability_type' =>  'post',
		'menu_icon'  => 'dashicons-admin-home',
		'public' => true,
		'supports' => array(
		'title',
		'editor',
		'excerpt',
		'trackbacks',
		'custom-fields',
		'revisions',
		'thumbnail',
		'author',
		'comments'
		)
    )
  );
  register_post_type( 'agents',
    array(
        'labels' => array(
            'name' => __( 'Agents','construction-realestate-posttype' ),
            'singular_name' => __( 'Agents','construction-realestate-posttype' )
        ),
        'capability_type' =>  'post',
        'menu_icon'  => 'dashicons-businessman',
        'public' => true,
        'supports' => array(
        'title',
        'editor',
        'excerpt',
        'thumbnail',
        'page-attributes',
        'comments'
        )
    )
  );
  register_post_type( 'testimonials',
	array(
		'labels' => array(
			'name' => __( 'Testimonials','construction-realestate-pro-posttype' ),
			'singular_name' => __( 'Testimonials','construction-realestate-pro-posttype' )
			),
		'capability_type' => 'post',
		'menu_icon'  => 'dashicons-businessman',
		'public' => true,
		'supports' => array(
			'title',
			'editor',
			'thumbnail'
			)
		)
	);
}

function createpackages() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => __( 'Properties Packages', 'construction-realestate-posttype' ),
		'singular_name'     => __( 'Properties Packages', 'construction-realestate-posttype' ),
		'search_items'      => __( 'Search Ccats', 'construction-realestate-posttype' ),
		'all_items'         => __( 'All Properties Packages', 'construction-realestate-posttype' ),
		'parent_item'       => __( 'Parent Properties Packages', 'construction-realestate-posttype' ),
		'parent_item_colon' => __( 'Parent Properties Packages:', 'construction-realestate-posttype' ),
		'edit_item'         => __( 'Edit Properties Packages', 'construction-realestate-posttype' ),
		'update_item'       => __( 'Update Properties Packages', 'construction-realestate-posttype' ),
		'add_new_item'      => __( 'Add New Properties Packages', 'construction-realestate-posttype' ),
		'new_item_name'     => __( 'New Properties Packages Name', 'construction-realestate-posttype' ),
		'menu_name'         => __( 'Properties Packages', 'construction-realestate-posttype' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'createpackages' ),
	);

	register_taxonomy( 'createpackages', array( 'properties' ), $args );
}

/* Adds a meta box to the Trainer editing screen */
function construction_realestate_pro_bn_custom_meta_properties() {

    add_meta_box( 'bn_meta', __( 'Property Meta', 'construction-realestate-posttype' ), 'construction_realestate_pro_bn_meta_callback_properties', 'properties', 'normal', 'high' );
}
/* Hook things in for admin*/
if (is_admin())
	add_action('admin_menu', 'construction_realestate_pro_bn_custom_meta_properties');

/* Adds a meta box for custom post */
function construction_realestate_pro_bn_meta_callback_properties( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'bn_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );
    ?>
	<div id="property_stuff">
		<table id="list-table" style="background: #fff;padding: 1%;border: 0;">			
			<tbody id="the-list" data-wp-lists="list:meta">
				<tr id="meta-1">
					<td class="left" id="meta-pricelabel">
						<?php esc_html_e( 'Price', 'construction-realestate-posttype' )?>
					</td>
					<td class="left" >
						<input type="number" name="meta-price" id="meta-price" value="<?php echo $bn_stored_meta['meta-price'][0]; ?>" />
					</td>
				</tr>
				<tr id="meta-2">
					<td class="left" id="meta-compricelable">
						<?php esc_html_e( 'Compare Price', 'construction-realestate-posttype' )?>
					</td>
					<td class="left" >
						<input type="number" name="meta-comprice" id="meta-comprice" value="<?php echo $bn_stored_meta['meta-comprice'][0]; ?>" />
					</td>
				</tr>
				<tr id="meta-3">
					<td class="left">
						<?php esc_html_e( 'Property ID', 'construction-realestate-posttype' )?>
					</td>
					<td class="left" >
						<input type="text" name="meta-propertyid" id="meta-propertyid" value="<?php echo $bn_stored_meta['meta-propertyid'][0]; ?>" />
					</td>
				</tr>
				<tr id="meta-4">
					<td class="left" id="meta-addresslabel">
						<?php esc_html_e( 'Property Address', 'construction-realestate-posttype' )?>
					</td>
					<td class="left" >
						<textarea class="widefat" id="meta-address" name="meta-address" type="text"  value="<?php echo $bn_stored_meta['meta-address'][0]; ?>" ><?php echo $bn_stored_meta['meta-address'][0]; ?></textarea>
					</td>
				</tr>
				<tr id="meta-4">
					<td class="left" id="meta-location">
						<?php esc_html_e( 'Location', 'construction-realestate-posttype' )?>
					</td>
					<td class="left" >
						<input class="widefat" id="meta-location" name="meta-location" type="text"  value="<?php echo $bn_stored_meta['meta-location'][0]; ?>" >
					</td>
				</tr>
				<tr id="meta-5">
					<td class="left">
						<?php esc_html_e( 'Property Type', 'construction-realestate-posttype' )?>
					</td>
					<td class="left" >
						<input type="text" name="meta-proptype" id="meta-proptype" value="<?php echo $bn_stored_meta['meta-proptype'][0]; ?>" />
					</td>
				</tr>
				<tr id="meta-6">
					<?php  $meta_element_class = get_post_meta($post->ID, 'meta-status', true); //true ensures you get just one value instead of an array
    				?>  
					<td class="left">
						<?php esc_html_e( 'Property Status', 'construction-realestate-posttype' )?>
					</td>
					<td class="left" >
						<select name="meta-status" id="meta-status" class="selectbox">
					        <option value="" <?php selected( $meta_element_class, '' ); ?>><?php esc_html_e('','construction-realestate-posttype' ); ?></option>
					        <option value="Sale" <?php selected( $meta_element_class, 'Sale' ); ?>><?php esc_html_e('Sale','construction-realestate-posttype' ); ?></option>
					        <option value="Rent" <?php selected( $meta_element_class, 'Rent' ); ?>><?php esc_html_e('Rent','construction-realestate-posttype' ); ?></option>
					    </select>
					</td>
				</tr>
				<tr id="meta-7">
					<td class="left">
						<?php esc_html_e( 'Property Size', 'construction-realestate-posttype' )?>
					</td>
					<td class="left" >
						<input type="text" name="meta-size" id="meta-size" value="<?php echo $bn_stored_meta['meta-size'][0]; ?>" />
					</td>
				</tr>
				<tr id="meta-8">
					<td class="left">
						<?php esc_html_e( 'Bathrooms', 'construction-realestate-posttype' )?>
					</td>
					<td class="left" >
						<input type="text" name="meta-bathrooms" id="meta-bathrooms" value="<?php echo $bn_stored_meta['meta-bathrooms'][0]; ?>" />
					</td>
				</tr>
				<tr id="meta-9">
					<td class="left">
						<?php esc_html_e( 'Bedrooms', 'construction-realestate-posttype' )?>
					</td>
					<td class="left" >
						<input type="text" name="meta-bedrooms" id="meta-bedrooms" value="<?php echo $bn_stored_meta['meta-bedrooms'][0]; ?>" />
					</td>
				</tr>
				<tr id="meta-10">
					<td class="left">
						<?php esc_html_e( 'Garage', 'construction-realestate-posttype' )?>
					</td>
					<td class="left" >
						<input type="text" name="meta-garage" id="meta-garage" value="<?php echo $bn_stored_meta['meta-garage'][0]; ?>" />
					</td>
				</tr>
				<tr id="meta-11">
					<td class="left">
						<?php esc_html_e( 'Year Built', 'construction-realestate-posttype' )?>
					</td>
					<td class="left" >
						<input type="text" name="meta-yearbuilt" id="meta-yearbuilt" value="<?php echo $bn_stored_meta['meta-yearbuilt'][0]; ?>" />
					</td>
				</tr>
				<tr id="meta-12">
					<td class="left">
						<?php esc_html_e( 'Child Rooms', 'construction-realestate-posttype' )?>
					</td>
					<td class="left" >
						<input type="text" name="meta-childrooms" id="meta-childrooms" value="<?php echo $bn_stored_meta['meta-childrooms'][0]; ?>" />
					</td>
				</tr>
				<tr id="meta-13">
					<td class="left">
						<?php esc_html_e( 'Furnished', 'construction-realestate-posttype' )?>
					</td>
					<td class="left" >
						<input type="text" name="meta-furnished" id="meta-furnished" value="<?php echo $bn_stored_meta['meta-furnished'][0]; ?>" />
					</td>
				</tr>
				<tr id="meta-14">
					<td class="left">
						<?php esc_html_e( 'No of Floors', 'construction-realestate-posttype' )?>
					</td>
					<td class="left" >
						<input type="text" name="meta-floors" id="meta-floors" value="<?php echo $bn_stored_meta['meta-floors'][0]; ?>" />
					</td>
				</tr>
				<tr id="meta-12">
					<td class="left">
						<?php esc_html_e( 'Swimming Pool', 'construction-realestate-posttype' )?>
					</td>
					<td class="left" >
						<input type="text" name="meta-swimming" id="meta-swimming" value="<?php echo $bn_stored_meta['meta-swimming'][0]; ?>" />
					</td>
				</tr>
				<tr id="meta-6">
					<td class="left">
						<?php esc_html_e( 'Longitude', 'lconstruction-realestate-posttype' )?>
					</td>
					<td class="left" >
						<input type="text" name="meta-longitude" id="meta-longitude" value="<?php echo $bn_stored_meta['meta-longitude'][0]; ?>" />
					</td>
				</tr>
				<tr id="meta-13">
					<td class="left">
						<?php esc_html_e( 'Latitude', 'lconstruction-realestate-posttype' )?>
					</td>
					<td class="left" >
						<input type="text" name="meta-latitude" id="meta-latitude" value="<?php echo $bn_stored_meta['meta-latitude'][0]; ?>" />
					</td>
				</tr>
			</tbody>
		</table>
	</div>
    <?php
}

/* Saves the custom meta input */
function construction_realestate_pro_bn_meta_save_properties( $post_id ) {

	// Save price
	if( isset( $_POST[ 'meta-price' ] ) ) {
	    update_post_meta( $post_id, 'meta-price', $_POST[ 'meta-price' ] );
	}
	if( isset( $_POST[ 'meta-comprice' ] ) ) {
	    update_post_meta( $post_id, 'meta-comprice', $_POST[ 'meta-comprice' ] );
	}

	// Save main meta_propertyid
	if( isset( $_POST[ 'meta-propertyid' ] ) ) {
	    update_post_meta( $post_id, 'meta-propertyid', $_POST[ 'meta-propertyid' ] );
	}
	// Save address
	if( isset( $_POST[ 'meta-address' ] ) ) {
	    update_post_meta( $post_id, 'meta-address', $_POST[ 'meta-address' ] );
	}
	// Save location
	if( isset( $_POST[ 'meta-location' ] ) ) {
	    update_post_meta( $post_id, 'meta-location', $_POST[ 'meta-location' ] );
	}
	// Save property type
	if( isset( $_POST[ 'meta-proptype' ] ) ) {
	    update_post_meta( $post_id, 'meta-proptype', $_POST[ 'meta-proptype' ] );
	}
	// // Save property status
	// if( isset( $_POST[ 'meta-status' ] ) ) {
	//     update_post_meta( $post_id, 'meta-status', $_POST[ 'meta-status' ] );
	// }

	if(isset($_POST["meta-status"])){
         //UPDATE: 
        $meta_element_class = $_POST['meta-status'];
        //END OF UPDATE

        update_post_meta($post_id, 'meta-status', $meta_element_class);
        //print_r($_POST);
    }

	// Save property status
	if( isset( $_POST[ 'meta-size' ] ) ) {
	    update_post_meta( $post_id, 'meta-size', $_POST[ 'meta-size' ] );
	}

	// Save package meta_bathrooms
	if( isset( $_POST[ 'meta-bathrooms' ] ) ) {
	    update_post_meta( $post_id, 'meta-bathrooms', $_POST[ 'meta-bathrooms' ] );
	}

	// Save garage
	if( isset( $_POST[ 'meta-garage' ] ) ) {
	    update_post_meta( $post_id, 'meta-garage', $_POST[ 'meta-garage' ] );
	}

	// Save bedrooms
	if( isset( $_POST[ 'meta-bedrooms' ] ) ) {
	    update_post_meta( $post_id, 'meta-bedrooms', $_POST[ 'meta-bedrooms' ] );
	}

	// Save Year built
	if( isset( $_POST[ 'meta-yearbuilt' ] ) ) {
	    update_post_meta( $post_id, 'meta-yearbuilt', $_POST[ 'meta-yearbuilt' ] );
	}
	// Save Year built
	if( isset( $_POST[ 'meta-childrooms' ] ) ) {
	    update_post_meta( $post_id, 'meta-childrooms', $_POST[ 'meta-childrooms' ] );
	}
	// Save Year built
	if( isset( $_POST[ 'meta-furnished' ] ) ) {
	    update_post_meta( $post_id, 'meta-furnished', $_POST[ 'meta-furnished' ] );
	}
	// Save Year built
	if( isset( $_POST[ 'meta-floors' ] ) ) {
	    update_post_meta( $post_id, 'meta-floors', $_POST[ 'meta-floors' ] );
	}
	// Save Year built
	if( isset( $_POST[ 'meta-swimming' ] ) ) {
	    update_post_meta( $post_id, 'meta-swimming', $_POST[ 'meta-swimming' ] );
	}
	// Save property type
	if( isset( $_POST[ 'meta-longitude' ] ) ) {
	    update_post_meta( $post_id, 'meta-longitude', $_POST[ 'meta-longitude' ] );
	}
	// Save property type
	if( isset( $_POST[ 'meta-latitude' ] ) ) {
	    update_post_meta( $post_id, 'meta-latitude', $_POST[ 'meta-latitude' ] );
	}
	}
add_action( 'save_post', 'construction_realestate_pro_bn_meta_save_properties' );

/*Properties shortcode */
function construction_realestate_pro_properties_shortcode( $atts ) {
	$services = '<div class="outer-prop">';
	$post_data = '';
	$rent = '';
    $args = array(
		'post_type' => 'properties',
		'paged' => $paged
    );
    $query = new WP_Query( $args );
    $services .= "<div class='row'>";

    if ( $query->have_posts() ){
        while ( $query->have_posts() ) : $query->the_post();
        	$post_id = get_the_ID();
			$prop_status = get_post_meta($post_id,'meta-status',true);
			$price = get_post_meta($post_id,'meta-price',true);
			if(get_post_meta($post_id,'meta-status',true) == 'Rent'){ $rent = 'prop_rent';}
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_data), 'medium' );
			$url = $thumb['0'];
			$price_meta =''; $fprice=''; $comprice_meta =''; $fcompprice =''; $compf = ''; $pcurrency_symb =''; $ccurrency_symb ='';
			if(get_post_meta($post_id,'meta-price',true != '')){
				$price_meta = get_post_meta($post_id);
				$fprice = number_format($price_meta['meta-price'][0], 2, '.', '');
			}
			if(get_post_meta($post_id,'meta-comprice',true != '')){
				$comprice_meta = get_post_meta($post_id);
				$fcompprice = number_format($comprice_meta['meta-comprice'][0], 2, '.', '');
			}
			if($fprice < $fcompprice){ $compf = $fcompprice; }
			if($fprice != ''){
				$pcurrency_symb = get_theme_mod('construction_realestate_pro_property_currency',__('$','construction-realestate-pro'));
			}
			if($fcompprice != ''){
				$ccurrency_symb = get_theme_mod('construction_realestate_pro_property_currency',__('$','construction-realestate-pro'));
			}

			$services .= '
            	<div class="col-lg-3 col-md-4 col-sm-6">   
					<div class="properties"> 
						<div class="images-box">
							<img class="client-img" src="'.esc_url($url).'" alt="agents-thumbnail" />
							<p class="prop_status '.esc_html($rent).'">'.esc_html($prop_status).'</p>
							<div class="hover-box">
							  <a href="'.get_permalink().' ?>">DETAILS</a>
							</div>
						</div> 
						<div class="inner-content">
							<a href="'.get_permalink().'"><h6 class="prop-title">'.get_the_title().'</h6></a>
							<p class="price">     
								<span>'.esc_html($pcurrency_symb . $fprice).'</span>
								<span class="comp_price"><strike>'.esc_html($ccurrency_symb . $compf).'</strike></span>
							</p>
						</div> 
					</div>       
                </div>';
        endwhile;
    
        wp_reset_postdata();
    }else{ 
    	$services .='<h2 class="center">'.__('Post Not Found','construction-realestate-posttype').'</h2>';
    }
	$services .= '<div class="clearfix"></div></div></div>';
	return $services;
}
add_shortcode( 'all_properties', 'construction_realestate_pro_properties_shortcode' );

// Call properties by shortcode:
function construction_realestate_pro_properties_cat_shortcode( $atts, $cat_name ) {

	$services = '<div class="main_row">';
	$post_data = '';
	$rent = '';
	$cat_name = isset( $atts['cat_name'] ) ? esc_html( $atts['cat_name'] ) : '';
    $args = array(
		'post_type' => 'properties',
		'createpackages'=> $cat_name,
		'paged' => $paged
    );

    $query = new WP_Query( $args );
    $services .= "<div class='row'>";

    if ( $query->have_posts() ){
        while ( $query->have_posts() ) : $query->the_post();
        	$post_id = get_the_ID();
			$prop_status = get_post_meta($post_id,'meta-status',true);
			$price = get_post_meta($post_id,'meta-price',true);
			if(get_post_meta($post_id,'meta-status',true) == 'Rent'){ $rent = 'prop_rent';}
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_data), 'medium' );
			$url = $thumb['0'];
			$price_meta =''; $fprice=''; $comprice_meta =''; $fcompprice =''; $compf = ''; $pcurrency_symb = ''; $ccurrency_symb = '';
			if(get_post_meta($post_id,'meta-price',true != '')){
				$price_meta = get_post_meta($post_id);
				$fprice = number_format($price_meta['meta-price'][0], 2, '.', '');
			}
			if(get_post_meta($post_id,'meta-comprice',true != '')){
				$comprice_meta = get_post_meta($post_id);
				$fcompprice = number_format($comprice_meta['meta-comprice'][0], 2, '.', '');
			}
			if($fprice < $fcompprice){ $compf = $fcompprice; }
			if($fprice != ''){
				$pcurrency_symb = get_theme_mod('construction_realestate_pro_property_currency',__('$','construction-realestate-pro'));
			}
			if($fcompprice != ''){
				$ccurrency_symb = get_theme_mod('construction_realestate_pro_property_currency',__('$','construction-realestate-pro'));
			}
			$services .= '
            	<div class="col-lg-3 col-md-4 col-sm-6">   
					<div class="properties"> 
						<div class="images-box">
							<img class="client-img" src="'.esc_url($url).'" alt="agents-thumbnail" />
							<p class="prop_status '.esc_html($rent).'">'.esc_html($prop_status).'</p>
							<div class="hover-box">
							  <a href="'.get_permalink().' ?>">DETAILS</a>
							</div>
						</div> 
						<div class="inner-content">
							<a href="'.get_permalink().'"><h6 class="prop-title">'.get_the_title().'</h6></a>
							<p class="price">     
								<span>'.esc_html($pcurrency_symb . $fprice).'</span>
								<span class="comp_price"><strike>'.esc_html($ccurrency_symb . $compf).'</strike></span>
							</p>
						</div> 
					</div>       
                </div>';
        endwhile;
    
        wp_reset_postdata();
    }else{ 
    	$services .='<h2 class="center">'.__('Post Not Found','construction-realestate-posttype').'</h2>';
    }
	$services .= '<div class="clearfix"></div></div></div>';
	return $services;
}
add_shortcode( 'properties_by_cat', 'construction_realestate_pro_properties_cat_shortcode' );

/* Agents */
/* Adds a meta box for Designation */
function construction_realestate_posttype_bn_designation_meta() {
    add_meta_box( 'construction_realestate_posttype_bn_meta', __( 'Enter Designation','construction-realestate-posttype' ), 'construction_realestate_posttype_bn_meta_callback', 'agents', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'construction_realestate_posttype_bn_designation_meta');
}
/* Adds a meta box for custom post */
function construction_realestate_posttype_bn_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'construction_realestate_posttype_bn_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );
    ?>
    <div id="agent_custom_stuff">
        <table id="list-table">         
            <tbody id="the-list" data-wp-lists="list:meta">
                <tr id="meta-1">
                    <td class="left">
                        <?php esc_html_e( 'Email', 'construction-realestate-posttype' )?>
                    </td>
                    <td class="left" >
                        <input type="text" name="meta-desig" id="meta-desig" value="<?php echo esc_html($bn_stored_meta['meta-desig'][0]); ?>" />
                    </td>
                </tr>
                <tr id="meta-2">
                    <td class="left">
                        <?php esc_html_e( 'Phone Number', 'construction-realestate-posttype' )?>
                    </td>
                    <td class="left" >
                        <input type="text" name="meta-call" id="meta-call" value="<?php echo esc_html($bn_stored_meta['meta-call'][0]); ?>" />
                    </td>
                </tr>
                <tr id="meta-3">
                  <td class="left">
                    <?php esc_html_e( 'Facebook Url', 'construction-realestate-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-facebookurl" id="meta-facebookurl" value="<?php echo esc_url($bn_stored_meta['meta-facebookurl'][0]); ?>" />
                  </td>
                </tr>
                <tr id="meta-4">
                  <td class="left">
                    <?php esc_html_e( 'Linkedin URL', 'construction-realestate-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-linkdenurl" id="meta-linkdenurl" value="<?php echo esc_url($bn_stored_meta['meta-linkdenurl'][0]); ?>" />
                  </td>
                </tr>
                <tr id="meta-5">
                  <td class="left">
                    <?php esc_html_e( 'Twitter Url', 'construction-realestate-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-twitterurl" id="meta-twitterurl" value="<?php echo esc_url( $bn_stored_meta['meta-twitterurl'][0]); ?>" />
                  </td>
                </tr>
                <tr id="meta-6">
                  <td class="left">
                    <?php esc_html_e( 'GooglePlus URL', 'construction-realestate-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-googleplusurl" id="meta-googleplusurl" value="<?php echo esc_url($bn_stored_meta['meta-googleplusurl'][0]); ?>" />
                  </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}
/* Saves the custom Designation meta input */
function construction_realestate_posttype_bn_metadesig_save( $post_id ) {
    if( isset( $_POST[ 'meta-desig' ] ) ) {
        update_post_meta( $post_id, 'meta-desig', esc_html($_POST[ 'meta-desig' ]) );
    }
    if( isset( $_POST[ 'meta-call' ] ) ) {
        update_post_meta( $post_id, 'meta-call', esc_html($_POST[ 'meta-call' ]) );
    }
    // Save facebookurl
    if( isset( $_POST[ 'meta-facebookurl' ] ) ) {
        update_post_meta( $post_id, 'meta-facebookurl', esc_url($_POST[ 'meta-facebookurl' ]) );
    }
    // Save linkdenurl
    if( isset( $_POST[ 'meta-linkdenurl' ] ) ) {
        update_post_meta( $post_id, 'meta-linkdenurl', esc_url($_POST[ 'meta-linkdenurl' ]) );
    }
    if( isset( $_POST[ 'meta-twitterurl' ] ) ) {
        update_post_meta( $post_id, 'meta-twitterurl', esc_url($_POST[ 'meta-twitterurl' ]) );
    }
    // Save googleplusurl
    if( isset( $_POST[ 'meta-googleplusurl' ] ) ) {
        update_post_meta( $post_id, 'meta-googleplusurl', esc_url($_POST[ 'meta-googleplusurl' ]) );
    }
}
add_action( 'save_post', 'construction_realestate_posttype_bn_metadesig_save' );

add_action( 'add_meta_boxes', 'construction_realestate_posttype_cs_custom_meta' );

/* Adds a meta box to the post editing screen */
function construction_realestate_posttype_cs_custom_meta() {
    add_meta_box( 'cs_meta', __( 'Settings', 'construction-realestate-posttype' ),  'construction_realestate_posttype_cs_meta_callback' , 'agents');
}
/**
 * Outputs the content of the meta box
*/
function construction_realestate_posttype_cs_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'construction_realestate_posttype_cs_nonce' );
    $cs_stored_meta = get_post_meta( $post->ID );
    ?>
	<div id="agent_custom_stuff">
        <div class="Checkbox-home">
	        <label for="show_home"><?php esc_html_e( 'Show it on home page' ); ?></label><?php  
	        	$construction_realestate_posttype_upcars_status=get_post_meta($post->ID, "construction_realestate_posttype_agents_featured", true); 
	        	if($construction_realestate_posttype_upcars_status==1){ ?>
		    		<input type="checkbox" checked="checked" name="construction_realestate_posttype" id="construction_realestate_posttype_agents_featured" ><?php
		    	}else{ ?>	
		    		<input type="checkbox" name="construction_realestate_posttype_agents_featured" id="construction_realestate_posttype_agents_featured" ><?php
		    	} ?>	
        </div>
	</div>
    <?php
}

add_action( 'save_post', 'bn_meta_save' );
/* Saves the custom meta input */
function bn_meta_save( $post_id ) {
	if( isset( $_POST[ 'construction_realestate_posttype_agents_featured' ] )) {
	    update_post_meta( $post_id, 'construction_realestate_posttype_agents_featured', esc_attr(1));
	}else{
		update_post_meta( $post_id, 'construction_realestate_posttype_agents_featured', esc_attr(0));
	}
}

/* Agents shorthcode */
function construction_realestate_posttype_agent_func( $atts ) {
    $agents = ''; 
    $agents = '<div class="row">';
    $query = new WP_Query( array( 'post_type' => 'agents', 'paged' => $paged ) );
    if ( $query->have_posts() ) :
    $k=1;
    $new = new WP_Query('post_type=agents'); 
    while ($new->have_posts()) : $new->the_post();
    	$post_id = get_the_ID();
    	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_data), 'medium' );
		$url = $thumb['0'];
        $excerpt = construction_realestate_pro_string_limit_words(get_the_excerpt(),20);
        $facebookurl = get_post_meta($post_id,'meta-facebookurl',true);
        if($facebookurl != ''){ $f_show_hide = 'show_icon'; } else { $f_show_hide =  'hide_icon';  }
        $linkedin = get_post_meta($post_id,'meta-linkdenurl',true);
        if($linkedin != ''){ $l_show_hide = 'show_icon'; } else { $l_show_hide =  'hide_icon';  }
        $twitter = get_post_meta($post_id,'meta-twitterurl',true);
        if($twitter != ''){ $t_show_hide = 'show_icon'; } else { $t_show_hide =  'hide_icon';  }
        $googleplus = get_post_meta($post_id,'meta-googleplusurl',true);
        if($googleplus != ''){ $g_show_hide = 'show_icon'; } else { $g_show_hide =  'hide_icon';  }
        $agents .= '
            <div class="col-lg-3 col-md-4 col-sm-6"> 
                <div class="agents_box">
                    <div class="image-box agents-box">
                      <img class="client-img" src="'.esc_url($url).'" alt="agents-thumbnail" />
                      <h4 class="agent_name">'.get_the_title().'</h4>
                      <div class="about-socialbox fdfd">
                      <a class="chef_social '.$f_show_hide.'" href="'.$facebookurl.'" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                      <a class="chef_social '.$t_show_hide.'" href="'.$twitter.'" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                      <a class="chef_social '.$g_show_hide.'" href="'.$googleplus.'" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                      <a class="chef_social '.$l_show_hide.'" href="'.$linkedin.'" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                    </div>
                    </div>
                  <div class="content_box">
                    <div class="short_text">'.$excerpt.'</div>
                    <div class="more_info"><a href="'.get_permalink().'">Read More</a>
                    </div>
                  </div>
              </div>
                </div>';
        if($k%2 == 0){
            $agents.= '<div class="clearfix"></div>'; 
        } 
      $k++;         
  endwhile; 
  wp_reset_postdata();
  $agents.= '</div>';
  else :
    $agents = '<h2 class="center">'.esc_html_e('Not Found','construction-realestate-posttype').'</h2>';
  endif;
  return $agents;
}
add_shortcode( 'agents', 'construction_realestate_posttype_agent_func' );

/* Testimonial section */
/* Adds a meta box to the Testimonial editing screen */
function construction_realestate_pro_posttype_bn_testimonial_meta_box() {
	add_meta_box( 'construction-realestate-pro-posttype-testimonial-meta', __( 'Enter Designation', 'construction-realestate-pro-posttype' ), 'construction_realestate_pro_posttype_bn_testimonial_meta_callback', 'testimonials', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'construction_realestate_pro_posttype_bn_testimonial_meta_box');
}

/* Adds a meta box for custom post */
function construction_realestate_pro_posttype_bn_testimonial_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'construction_realestate_pro_posttype_testimonial_meta_nonce' );
	$desigstory = get_post_meta( $post->ID, 'construction_realestate_pro_posttype_testimonial_desigstory', true );
	?>
	<div id="testimonials_custom_stuff">
		<table id="list">
			<tbody id="the-list" data-wp-lists="list:meta">
				<tr id="meta-1">
					<td class="left">
						<?php esc_html_e( 'Designation', 'construction-realestate-pro-posttype' )?>
					</td>
					<td class="left" >
						<input type="text" name="construction_realestate_pro_posttype_testimonial_desigstory" id="construction_realestate_pro_posttype_testimonial_desigstory" value="<?php echo esc_attr( $desigstory ); ?>" />
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<?php
}

/* Saves the custom meta input */
function construction_realestate_pro_posttype_bn_metadesig_save( $post_id ) {
	if (!isset($_POST['construction_realestate_pro_posttype_testimonial_meta_nonce']) || !wp_verify_nonce($_POST['construction_realestate_pro_posttype_testimonial_meta_nonce'], basename(__FILE__))) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	// Save desig.
	if( isset( $_POST[ 'construction_realestate_pro_posttype_testimonial_desigstory' ] ) ) {
		update_post_meta( $post_id, 'construction_realestate_pro_posttype_testimonial_desigstory', sanitize_text_field($_POST[ 'construction_realestate_pro_posttype_testimonial_desigstory']) );
	}

}

add_action( 'save_post', 'construction_realestate_pro_posttype_bn_metadesig_save' );

/* Testimonials shortcode */
function construction_realestate_pro_posttype_testimonial_func( $atts ) {
	$testimonial = '';
	$testimonial = '<div class="row">';
	$query = new WP_Query( array( 'post_type' => 'testimonials') );

    if ( $query->have_posts() ) :

	$k=1;
	$new = new WP_Query('post_type=testimonials');

	while ($new->have_posts()) : $new->the_post();
      	$post_id = get_the_ID();
      	$excerpt = wp_trim_words(get_the_excerpt(),25);
      	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_data), 'medium' );
		$url = $thumb['0'];
      	$desigstory= get_post_meta($post_id,'construction_realestate_pro_posttype_testimonial_desigstory',true);
    	$testimonial .= '
			<div class="col-md-4 col-sm-6 testimonialwrapper-box">
				
				<div class="testi_qoute">
					<div class="image-box testimonial-box text-center">
						<a href="'.get_the_permalink().'"><img class="testi-img w-100" src="'.esc_url($url).'" alt="agents-thumbnail" /></a>
			        </div>
                	
					<div class="testimonial_content">
						<blockquote>'.esc_html($excerpt).'</blockquote>
						<span class="testi_name font-weight-bold">'.esc_html(get_the_title()) .'</span>
						<span class="testi-designation font-weight-bold">'.esc_html($desigstory).'</span>
					</div>
				</div>
				
			</div>';
		if($k%3 == 0){
			$testimonial.= '<div class="clearfix"></div>';
		}
      $k++;
  endwhile;
  else :
  	$testimonial = '<h2 class="center">'.esc_html__('Post Not Found','construction-realestate-pro-posttype').'</h2>';
  endif;
  $testimonial .= '</div>';
  return $testimonial;
}

add_shortcode( 'testimonials', 'construction_realestate_pro_posttype_testimonial_func' );

/* Property Image Gallery */

function bwt_gallery_images_metabox_enqueue($hook) {
	if ( 'post.php' === $hook || 'post-new.php' === $hook ) {
		wp_enqueue_script('bwt-gallery-images-metabox', plugin_dir_url( __FILE__ ) . '/js/bwt-gm.js', array('jquery', 'jquery-ui-sortable'));
		wp_enqueue_style('bwt-gallery-images-metabox', plugin_dir_url( __FILE__ ) . '/css/bwt-gm.css');

		global $post;
		if ( $post ) {
			wp_enqueue_media( array(
					'post' => $post->ID,
				)
			);
		}

	}
}

add_action('admin_enqueue_scripts', 'bwt_gallery_images_metabox_enqueue');

function bwt_gallery_images_add_gallery_metabox($post_type) {
	$types = array('properties');

	if (in_array($post_type, $types)) {
		add_meta_box(
			'bwt-gallery-image-metabox',
			__( 'Gallery Images', 'bwt-gallery-images' ),
			'bwt_gallery_images_meta_callback',
			$post_type,
			'normal',
			'high'
			);
	}
}

add_action('add_meta_boxes', 'bwt_gallery_images_add_gallery_metabox');

function bwt_gallery_images_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'bwt_gallery_images_meta_nonce' );
	$ids = get_post_meta( $post->ID, 'bwt_gallery_images_gal_id', true );

	?>
	<table class="form-table">
		<tr><td>
		<a class="gallery-add button" href="#" data-uploader-title="<?php esc_attr_e( 'Add image(s) to gallery', 'bwt-gallery-images' ); ?>" data-uploader-button-text="<?php esc_attr_e( 'Add image(s)', 'bwt-gallery-images' ); ?>"><?php esc_html_e( 'Add image(s)', 'bwt-gallery-images' ); ?></a>

		<ul id="bwt-gallery-images-item-list">
			<?php if ( $ids ) : foreach ( $ids as $key => $value ) : $image = wp_get_attachment_image_src( $value ); ?>

				<li>
					<input type="hidden" name="bwt_gallery_images_gal_id[<?php echo $key; ?>]" value="<?php echo $value; ?>">
					<img class="image-preview" src="<?php echo esc_url( $image[0] ); ?>">
					<a class="change-image button button-small" href="#" data-uploader-title="<?php esc_attr_e( 'Change image', 'bwt-gallery-images' ) ; ?>" data-uploader-button-text="<?php esc_attr_e( 'Change image', 'bwt-gallery-images' ) ; ?>"><?php esc_html_e( 'Change image', 'bwt-gallery-images' ) ; ?></a><br>
					<small><a class="remove-image" href="#"><?php esc_html_e( 'Remove image', 'bwt-gallery-images' ) ; ?></a></small>
				</li>

			<?php endforeach;
			endif; ?>
		</ul>

		</td></tr>
	</table>
	<?php
}

function bwt_gallery_images_meta_save($post_id) {
	if (!isset($_POST['bwt_gallery_images_meta_nonce']) || !wp_verify_nonce($_POST['bwt_gallery_images_meta_nonce'], basename(__FILE__))) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if(isset($_POST['bwt_gallery_images_gal_id'])) {
		$sanitized_values = array_map('intval', $_POST['bwt_gallery_images_gal_id']);
		update_post_meta($post_id, 'bwt_gallery_images_gal_id', $sanitized_values );
	} else {
		delete_post_meta($post_id, 'bwt_gallery_images_gal_id');
	}
}
add_action('save_post', 'bwt_gallery_images_meta_save');

function bwt_gallery_images_get_custom_post_type_template( $single_template ) {
	global $post;
	if ($post->post_type == 'bwt_gallery') {
		if ( file_exists( get_template_directory() . '/page-template/gallery.php' ) ) {
			$single_template = get_template_directory() . '/page-template/gallery.php';
		}
	}
	return $single_template;
}

add_filter( 'single_template', 'bwt_gallery_images_get_custom_post_type_template' );

function bwt_gallery_images_gallery_show($gallery_id) {
	if ( ! $gallery_id ) {
		return;
	}
	$images = get_post_meta($gallery_id, 'bwt_gallery_images_gal_id', true);

	$res = '';
	$res ='<div id="property_carousel" class="carousel slide" data-ride="carousel">';
	if(!empty($images)){
		$gal_i=1;
		$first_gal='';
		
		$res .= '<div class="carousel-inner">';
		foreach ($images as $image) {
			global $post;
			if($gal_i == 1){ $first_gal = 'active'; } else { $first_gal = 'notactive'; }
			$thumbnail = wp_get_attachment_link($image, 'medium');
			$full = wp_get_attachment_link($image, 'large');
			$res .= '<div class="gallery-image carousel-item '.$first_gal.' ">
			<div class="bwt_gallery view">
				'.$full.'
			</div>
			</div>';
			$gal_i++;
		}
		$res .= '</div>';

		$res .= '</div><a class="carousel-control-prev" href="#property_carousel" role="button" data-slide="prev">
				    <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fa fa-angle-left fa-3x" aria-hidden="true"></i></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="carousel-control-next" href="#property_carousel" role="button" data-slide="next">
				    <span class="carousel-control-next-icon" aria-hidden="true"><i class="fa fa-angle-right fa-3x" aria-hidden="true"></i></span>
				    <span class="sr-only">Next</span>
				  </a>';

	return $res;
	}
	else { the_post_thumbnail(); }
}

add_action( 'construction_realestate_posttype_plugins_loaded', 'construction_realestate_posttype_load_textdomain' );
/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function construction_realestate_posttype_load_textdomain() {
  load_plugin_textdomain( 'construction-realestate-posttype', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
}