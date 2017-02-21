<?php
 
  function add_your_fields_meta_box() {

    add_meta_box(
      'your_fields_meta_box', // $id
      'Custom Back-End Fields', // $title
      'show_your_fields_meta_box', // $callback
      'portfolio', // $screen
      'normal', // $context
      'high' // $priority
    );
  }

add_action( 'add_meta_boxes', 'add_your_fields_meta_box' ); 
 
function show_your_fields_meta_box() {

  global $post;  
    $meta = get_post_meta( $post->ID, 'your_fields', true ); 
    $contact_no = (isset($meta['contact_no'])?$meta['contact_no']:'');
    $full_name = (isset($meta['full_name'])?$meta['full_name']:'');
    $show_public = (isset($meta['show_public'])?$meta['show_public']:'');

    ?>
   <!-- Nonce -->    
  <input type="hidden" name="your_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">
  
  
  <!-- Show Author Name -->
  <p>
    <label for="your_fields[checkbox]">Show Full Name : 
      <input type="text" name="your_fields[full_name]" id="your_fields[full_name]" class="regular-text" value="<?php echo $full_name; ?>">
    </label>
  </p>

  <!-- Contact No -->
  <p>
    <label for="your_fields[contact_no]">Contact No</label> 
    <input type="text" name="your_fields[contact_no]" id="your_fields[contact_no]" class="regular-text" value="<?php echo $contact_no; ?>">
  </p>

  <!-- Show Contact No -->
  <p>
    <label for="your_fields[checkbox]">Show Public : 
      <input type="checkbox" name="your_fields[show_public]" value="yes" <?php if ( $show_public === 'yes' ) echo 'checked'; ?>>
    </label>
  </p>


    <!-- All fields will go here -->

  <?php }

 function save_your_fields_meta( $post_id ) {   
  // verify nonce
  if ( !wp_verify_nonce( $_POST['your_meta_box_nonce'], basename(__FILE__) ) ) {
    return $post_id; 
  }
  // check autosave
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return $post_id;
  }
  // check permissions
  if ( 'page' === $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) ) {
      return $post_id;
    } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
      return $post_id;
    }  
  }
  
  $old = get_post_meta( $post_id, 'your_fields', true );
  $new = $_POST['your_fields'];

  if ( $new && $new !== $old ) {
    update_post_meta( $post_id, 'your_fields', $new );
  } elseif ( '' === $new && $old ) {
    delete_post_meta( $post_id, 'your_fields', $old );
  }
}
add_action( 'save_post', 'save_your_fields_meta' );