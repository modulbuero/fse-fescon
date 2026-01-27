<?php 
/**
 * Title: Referenz Fazit
 * Slug: fse-fescon/ref-fazit
 * Inserter: true
 * Categories: fescon
 * Benutzt in Single-Referenzen
 */


if(get_field('fazit-text')) : ?>

<!-- wp:group {"className":"fazit-wrap","layout":{"type":"constrained"}} -->
<div class="wp-block-group fazit-wrap">
    <!-- wp:heading -->
    <h2 class="wp-block-heading">Fazit</h2>
    <!-- /wp:heading -->

    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
    <div class="wp-block-group">
        <?php if(get_field('fazit-bild')): ?>
            <!-- wp:image {"id":28,"sizeSlug":"large","linkDestination":"none"} -->
            <figure class="wp-block-image size-large">
                <img src="<?php echo get_field('fazit-bild'); ?>" alt="Fazit Foto" class=""/>
            </figure>
            <!-- /wp:image -->
        <?php else: ?>
            <!-- wp:image {"id":28,"sizeSlug":"large","linkDestination":"none"} -->
            <figure class="wp-block-image size-large">
                <img src="http://fescon.gmbh.178-20-102-49.modulbuero.kundencloudserver.de/wp-content/uploads/2025/10/fescon-bild2-blog-1200x779.jpg" alt="" class="wp-image-28"/>
            </figure>
            <!-- /wp:image -->
        <?php endif; ?>

        <!-- wp:quote -->
        <blockquote class="wp-block-quote"><!-- wp:paragraph -->
            <p>„<?php echo get_field('fazit-text') ?>“</p>
            <!-- /wp:paragraph -->
            <cite><?php echo get_field('fazit-geber') ?></cite>
        </blockquote>
        <!-- /wp:quote -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->

<?php endif; ?>