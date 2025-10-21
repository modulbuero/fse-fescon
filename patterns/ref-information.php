<?php 
/**
 * Title: Referenz Informationen
 * Slug: fse-fescon/ref-information
 * Inserter: true
 * Categories: fescon
 * Benutzt in Single-Referenzen
 */
?>
<div class="fescon-ref-info-fields">
    <?php if(get_field('branche')) : ?>
    <div>
        <label>Branche</label>    
        <p><?php echo get_field('branche') ?></p>
    </div>
    <?php endif; ?>

    <?php if(get_field('produkte')) : ?>
    <div>
        <label>Produkte</label>
        <p><?php echo get_field('produkte') ?></p>
    </div>
    <?php endif; ?>

    <?php if(get_field('kunde_seit')) : ?>
    <div>
        <label>Kunde seit</label>        
        <p><?php echo get_field('kunde_seit') ?></p>  
    </div>
    <?php endif; ?>

    <?php if(get_field('anwender')) : ?>
    <div>
        <label>Anwender</label>
        <p><?php echo get_field('anwender') ?></p> 
    </div>
    <?php endif; ?>
</div>