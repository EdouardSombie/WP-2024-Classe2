<?php get_header(); ?>

<main id="site-content">
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <?php
                get_template_part('template-parts/identity-card');
                ?>

                <?php

                $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
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
                ?>
                        <li>
                            <a href="<?= get_permalink($post) ?>">
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
                        'current' => max(1, get_query_var('paged')),
                        'total' => $the_query->max_num_pages
                    ]);
                }
                ?>

            </div>
        </div>
    </div>


</main>

<?php get_footer(); ?>