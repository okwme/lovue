<?php 
$name = get_bloginfo( 'name' );
$description = get_bloginfo( 'description' );
$menu = wp_get_nav_menu_items( 'main' );

$post_args = array(
  'post_type'              => array( 'post' ),
  'post_status'            => array( 'publish' ),
);
$posts = new WP_Query( $post_args );
foreach($posts->posts as &$post) {
  $post->permalink = str_replace(get_site_url(), '', get_the_permalink($post->ID));
  $fields = get_fields($post->ID);
  if(is_array($fields)){
    foreach($fields as $field=>$value){
      $post->$field = $value;
    }
  }
}
// echo "<script>var posts = " . json_encode($posts) . ";</script>";
?>
<?php 
$page_args = array(
  'post_type'              => array( 'page' ),
  'post_status'            => array( 'publish' ),
);
$pages = new WP_Query( $page_args );
// debug($pages);
foreach($pages->posts as &$page) {
  $post->permalink = str_replace(get_site_url(), '', get_the_permalink($post->ID));
  $fields = get_fields($page->ID);
  if(is_array($fields)){
    foreach($fields as $field=>$value){
      $page->$field = $value;
    }
  }
}
// echo "<script>var pages = " . json_encode($pages) . ";</script>";
$data = 'var wordpress = ' . json_encode(array('name'=>$name, 'description'=>$description, 'menu'=>$menu, 'posts'=>$posts, 'pages'=>$pages));
$my_file = getcwd() . '/wp-content/themes/lovue/lovue/static/wordpress.js';

$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file); //implicitly creates file
fwrite($handle, $data);
fclose($handle);

// $data = str_replace("module.exports", "var wordpress", $data);

// $my_file = getcwd() . '/wp-content/themes/lovue/lovue/dist/static/wordpress.js';
// $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file); //implicitly creates file
// fwrite($handle, $data);
// fclose($handle);

// echo "<script type='text/javascript' src='/wp-content/themes/lovue/lovue/dist/static/wordpress.js'></script>";

$my_file = getcwd() . '/wp-content/themes/lovue/lovue/dist/index.html';

$my_file = file_get_contents($my_file);
$my_file = str_replace('<script type=text/javascript src=static/wordpress.js></script>', '<script>' . $data . '</script>', $my_file);
echo $my_file;
// include($my_file);
?>
