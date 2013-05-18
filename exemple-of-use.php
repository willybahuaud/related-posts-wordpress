$q = new WP_Query(
  array(
    'post_type'      => 'conference',
    'posts_per_page' => '-1',
    'meta_query'     => array(
      'operator'       => 'AND',
      array(
        'key'     => '_conferenciers_presents',
        'value'   => $post->ID,
        'compare' => '='
      )
    )
  )
);