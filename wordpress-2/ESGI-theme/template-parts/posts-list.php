<?php
if (!isset($page)) {
    $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
} else {
    $paged = $page; // prise en compte du param envoyé par le fetch
}
$args = [
    // 'posts_per_page' => 1,
    'paged' => $paged,
    'orderby' => 'date',
    'order' => 'DESC'
];

$the_query = new WP_Query($args);

// La loop WP  :)
if ($the_query->have_posts()) {
    echo '<ul class="postsList">';
    while ($the_query->have_posts()) {
        $the_query->the_post(); // Instanciation du WP_Post
        $post = get_post();
?>
        <li>
            <a href="<?= get_permalink($p) ?>">
                <span><?= $post->post_title ?></span>
                <time><?= wp_date('j F Y', strtotime($post->post_date))  ?></time>
            </a>
        </li>
<?php
    }
    echo '</ul>';

    $big = 999999999; // need an unlikely integer

    echo paginate_links([
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, $paged),
        'total' => $the_query->max_num_pages
    ]);
}
?>