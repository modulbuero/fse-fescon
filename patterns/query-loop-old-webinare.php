<?php
 /**
  * Title: MB QueryLoop alte Webinare fescon
  * Slug: fse-fescon/query-loop-old-webinare
  * Keywords: loop, query
  * Inserter: true
  * Categories: query, fescon
  * Block Types: core/query

* Lässt sich nicth nutzen -> shortcode
  */
?>

<!-- wp:query {"align":"wide", {"query":{"perPage":3,"pages":0,"offset":0,"postType":"termin","order":"desc","orderBy":"meta_value","meta_key":"_start_datum","author":"","search":"","exclude":[],"sticky":"","inherit":false,"meta_query":{"relation":"AND","0":{"key":"_start_datum","value":"<?php echo date('Y-m-d'); ?>","compare":"<","type":"DATE"},"1":{"key":"_start_datum","value":["<?php echo date('Y'); ?>0101","<?php echo date('Y'); ?>1231"],"compare":"BETWEEN","type":"DATE"}}}}} -->
<div class="wp-block-query alignwide mbfse-block-termine-template query-loop-termine old-webinars">
	<!-- wp:post-template {"align":"wide"} -->
		
		<!-- wp:post-featured-image {"sizeSlug":"medium_large"} /-->
				
		<!-- wp:group -->
		<div class="wp-block-group query-text-container mbfse-block-termine-text-container deadae">
			<!-- wp:fse-modulbuero/termin-infos-block /-->

			<!-- wp:post-title /-->
			
			<!-- wp:post-excerpt /-->
             <!-- wp:group -->
			<div class="wp-block-group no-distance-bottom has-global-padding is-layout-constrained wp-block-group-is-layout-constrained">
                <!-- wp:paragraph -->
                <p class="wp-block-button__link wp-element-button">Details</p>
                <!-- /wp:paragraph -->
                <!-- wp:post-terms {"term":"category"} /-->
            </div>
            <!-- /wp:group -->
		</div>
		<!-- /wp:group -->
		
		<!-- wp:read-more /-->
	<!-- /wp:post-template -->

	<!-- wp:query-pagination {"paginationArrow":"arrow","align":"wide","layout":{"type":"flex","justifyContent":"center"}} -->
		<!-- wp:query-pagination-previous /-->
		<!-- wp:query-pagination-numbers /-->
		<!-- wp:query-pagination-next /-->
	<!-- /wp:query-pagination -->

	
</div>
<!-- /wp:query -->