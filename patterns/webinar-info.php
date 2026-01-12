<?php 
/**
 * Title: Webinar Informationen
 * Slug: fse-fescon/webinar-info
 * Inserter: true
 * Categories: fescon
 * Benutzt in Single-Referenzen
 */

$postID = get_the_ID();

// Webinar Metas
$start_datum	= strtotime(get_post_meta($postID, '_start_datum', true));
$start_day 		= (!empty($start_datum))? date_i18n("l", $start_datum) : "";
$start_datumtext= (!empty($start_datum))? date_i18n("j. M Y", $start_datum) : "";
$start_zeittext	= (!empty($start_datum))? date_i18n("H:i", $start_datum):"";	
$end_datum 		= strtotime(get_post_meta($postID, '_end_datum', true));
$end_datumtext 	= (!empty($end_datum))? date_i18n("j. M Y", $end_datum):"";
$end_zeittext	= (!empty($end_datum))? date_i18n("H:i", $end_datum):"";
$link           = (!empty(get_field('anmeldelink'))) ? get_field('anmeldelink') : "";

?>
<div class="fescon-meta-fields">
    <?php if($start_day) : ?>
    <div>
        <label>Veranstaltungstag</label>    
        <p><?php echo $start_day  . ", " .$start_datumtext ?></p>
    </div>
    <?php endif; ?>

    <?php if($start_zeittext) : ?>
    <div>
        <label>Uhrzeit</label>
        <p>
        <?php 
            echo $start_zeittext;
            if($end_zeittext){ 
                echo " - " .$end_zeittext;
            }
        ?>
         Uhr</p>
    </div>
    <?php endif; ?>

    <?php if(get_field('dozentanbieter')) : ?>
    <div>
        <label>Dozent/Anbieter</label>        
        <p><?php echo get_field('dozentanbieter') ?></p>  
    </div>
    <?php endif; ?>

    <?php if(get_field('anmeldelink')) : ?>
    <div>
        <label>Anmeldelink</label>
        <p>
            <a href="<?php echo get_field('anmeldelink') ?>">
                <?php 
                echo mb_strimwidth(get_field('anmeldelink'), 0, 40, ' ...');
                ?>
            </a>
        </p> 
    </div>
    <?php endif; ?>


    <?php if(get_field('fur_kunden_von')) : ?>
    <div>
        <label>Für Kunden von</label>
        <p>
            <?php foreach(get_field('fur_kunden_von') as $kundenvon) echo "<span class='taxonomy-item'>".$kundenvon."</span>"; ?>
        </p> 
    </div>
    <?php endif; ?>
</div>