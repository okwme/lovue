<!-- <script>
var name = <?php echo json_encode(get_bloginfo( 'name' ) ); ?>;
var description = <?php echo json_encode(get_bloginfo( 'description' ) ); ?>;
var menu = <?php echo json_encode(wp_get_nav_menu_items( 'main' ) ); ?>;
</script> -->
<?php 
$post_args = array(
  'post_type'              => array( 'post' ),
  'post_status'            => array( 'publish' ),
);
$posts = new WP_Query( $post_args );
foreach($posts->posts as &$post) {
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
