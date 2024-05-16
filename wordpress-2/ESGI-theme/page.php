<?php get_header(); ?>

<main id="site-content">
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <h1 class="post-title"><?= the_title() ?></h1>
                <div class="post-content">
                    <?= the_content() ?>
                </div>
            </div>
        </div>
    </div>

</main>

<?php get_footer(); ?>