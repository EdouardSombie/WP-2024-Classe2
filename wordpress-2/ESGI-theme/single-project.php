<?php get_header(); ?>

<main id="site-content">
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <h1 class="post-title"><?= the_title() ?></h1>

                <div class="post-content">
                    <div class="post-thumbnail">
                        <?= get_the_post_thumbnail($post, 'large'); ?>
                    </div>
                    <?= the_content() ?>
                </div>
            </div>
            <?php
            if (get_theme_mod('has_sidebar')) {
                get_sidebar();
            }
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>