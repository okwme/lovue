<?php
add_action( 'after_setup_theme', 'lovue_setup' );
function lovue_setup()
{
load_theme_textdomain( 'lovue', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;
register_nav_menus(
array( 'main-menu' => __( 'Main Menu', 'lovue' ) )
);
}
add_action( 'wp_enqueue_scripts', 'lovue_load_scripts' );
function lovue_load_scripts()
{
wp_enqueue_script( 'jquery' );
}
add_action( 'comment_form_before', 'lovue_enqueue_comment_reply_script' );
function lovue_enqueue_comment_reply_script()
{
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'lovue_title' );
function lovue_title( $title ) {
if ( $title == '' ) {
return '&rarr;';
} else {
return $title;
}
}
add_filter( 'wp_title', 'lovue_filter_wp_title' );
function lovue_filter_wp_title( $title )
{
return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_action( 'widgets_init', 'lovue_widgets_init' );
function lovue_widgets_init()
{
register_sidebar( array (
'name' => __( 'Sidebar Widget Area', 'lovue' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
function lovue_custom_pings( $comment )
{
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php 
}
add_filter( 'get_comments_number', 'lovue_comments_number' );
function lovue_comments_number( $count )
{
if ( !is_admin() ) {
global $id;
$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}

function debug ($array) {
  echo "<pre>"; print_r($array); echo "</pre>";
}

/* apply this filter only on relevant to you pages */
function lovue_main_wp_query( $sql, WP_Query &$wpQuery ) {
    if ( $wpQuery->is_main_query() ) {
        /* prevent SELECT FOUND_ROWS() query*/
        $wpQuery->query_vars['no_found_rows'] = true;

        /* prevent post term and meta cache update queries */
        $wpQuery->query_vars['cache_results'] = false;

        return false;
    }
    return $sql;
}
// add_filter( 'posts_request', 'lovue_main_wp_query', 10, 2 );