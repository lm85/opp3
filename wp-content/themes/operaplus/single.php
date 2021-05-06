<?php
if( get_the_ID()==2326) {
if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
  wpcf7_enqueue_scripts();
}
 
if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
  wpcf7_enqueue_styles();
}
 }
?>
<?php get_template_part('templates/content-single', get_post_format() ); ?>
