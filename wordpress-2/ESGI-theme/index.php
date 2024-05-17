<?php get_header(); ?>

<main id="site-content">
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <?php
                get_template_part('template-parts/identity-card');
                ?>
                <div id="list-wrapper">
                    <?php
                    get_template_part('template-parts/posts-list');
                    ?>
                </div>

            </div>
        </div>
    </div>


</main>

<?php get_footer(); ?>