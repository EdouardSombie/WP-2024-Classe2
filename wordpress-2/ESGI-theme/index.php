<?php get_header(); ?>

<main id="site-content">
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <?php
                get_template_part('template-parts/identity-card');
                ?>

                <?php
                if (!is_front_page()) {
                    // Si pas sur la page d'accueil : afficher les articles

                    $args = [
                        'numberposts' => 6,
                        'orderby' => 'date',
                        'order' => 'DESC'
                    ];
                    $posts = get_posts($args);

                    echo '<ul class="postsList">';
                    foreach ($posts as $p) { ?>

                        <li>
                            <a href="<?= get_permalink($p) ?>">
                                <span><?= $p->post_title ?></span>
                                <time><?= wp_date('j F Y', strtotime($p->post_date))  ?></time>
                            </a>
                        </li>

                <?php }
                    echo '</ul>';
                }
                ?>
            </div>
        </div>
    </div>


</main>

<?php get_footer(); ?>