<?php
/**
 * Search & Filter Pro 
 *
 * Sample Results Template
 * 
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      http://www.designsandcode.com/
 * @copyright 2014 Designs & Code
 * 
 * Note: these templates are not full page templates, rather 
 * just an encaspulation of the your results loop which should
 * be inserted in to other pages by using a shortcode - think 
 * of it as a template part
 * 
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs 
 * and using template tags - 
 * 
 * http://codex.wordpress.org/Template_Tags
 *
 */
//
if ( $query->have_posts() )
{
	?>
	<?php  $totalpost = $query->found_posts; ?>
    <?php  $currentpage= $query->query['paged']; ?>
    <?php  $maxnumpage=$query->max_num_pages; ?>
    <?php  $s = $query->query['s']; ?>
    <?php  $tax_query = $query->query['tax_query']; ?>
    	
	<div class="pagination" >
		
		<div class="nav-previous" style="display:none;"><?php next_posts_link( 'Older posts', $query->max_num_pages ); ?></div>
		<div class="nav-next" style="display:none;"><?php previous_posts_link( 'Newer posts' ); ?></div>
		<?php
			/* example code for using the wp_pagenavi plugin */
			if (function_exists('wp_pagenavi'))
			{
				echo "<br />";
				wp_pagenavi( array( 'query' => $query ) );
			}
		?>
	</div>
    
    
    <!--Search-Result Page Start-->
    <div class="search-result-blk">
    	<div class="">
        	<div class="search-listing">
            	<ul class="grid effect-1" id="grid">
                <?php
				while ($query->have_posts())
				{
					$query->the_post();
					
					?>
                	<!--grid-item start-->
                    <li class="grid-item">
                    	<div class="search-result-box">
                        	<div class="box-image">
							<?php 
								if ( has_post_thumbnail() ) {					
									the_post_thumbnail("small");					
								}
							?>
                            </div>
                            <div class="box-text">
                            	<h3 class="b-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="b-rating">
                                <span class="activ"></span>
                                <span class="activ"></span>
                                <span class="activ"></span>
                                <span class="activ"></span>
                                <span></span>
                                </div>
                                <div class="b-text">
                                	<p><?php the_excerpt(); ?></p>
                                </div>
                                <!--<div class="b-author">
                                	<div class="author-img"><img src="images/author.jpg" alt=""></div>
                                    <div class="author-txt">By <a href="#">contributor</a></div>
                                </div>-->
                                <div class="b-caption">
                                	<?php //the_category();
									//$terms = get_terms('category');          							
									//print_r($terms);
									 ?>
                                    <?php the_tags(); ?>
                                    <small><?php the_date(); ?></small>
                                	<!--<div class="c-item"><span>Prep:</span>45 min</div>
                                    <div class="c-item"><span>Cook:</span>1 hr 30 min</div>
                                    <div class="c-item"><span>Yields:</span>6 Servings</div>-->
                                </div>
                            </div>
                        </div>
                    </li>
                    <!--grid-item end-->
                 <?php
				}
				?>  
                   
                </ul>
            </div>
        </div>
    </div>
    <?php if($maxnumpage>1): ?>
    <div class="more-botton"><a href="javascript:void(0)" class="load-more-button" id="more_posts">Load More</a></div>
	<?php endif; ?>
    <!--Search-Result Page End-->    	
	
	<div class="pagination" style="display:none;">
		
		<div class="nav-previous"><?php next_posts_link( 'Older posts', $query->max_num_pages ); ?></div>
		<div class="nav-next"><?php previous_posts_link( 'Newer posts' ); ?></div>
		<?php
			/* example code for using the wp_pagenavi plugin */
			if (function_exists('wp_pagenavi'))
			{
				echo "<br />";
				wp_pagenavi( array( 'query' => $query ) );
			}
		?>
	</div>
	<?php
}
else
{
	echo "No Results Found";
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready( function($) {
        var ajaxUrl = "<?php echo admin_url('admin-ajax.php')?>";

        // What page we are on.
        var page = <?php echo $currentpage; ?>;
		
		var current = <?php echo $currentpage; ?>;
		
		var maxpage = <?php echo $maxnumpage; ?>;
		
		var total = <?php echo $totalpost; ?>;
		<?php if(isset($s)): ?>
		var s = "<?php echo $s; ?>";
		<?php endif; ?>
		
        // Post per page
        var ppp = 10;

        $("#more_posts").on("click", function() {			
            // When btn is pressed.
            $("#more_posts").attr("disabled",true);
			
			var jtax_query = <?php echo json_encode($tax_query); ?>;

            // Disable the button, temp.
            $.post("<?php echo get_template_directory_uri(); ?>/search-filter/loadmore.php", {
                paged: page,
                offset: (page * ppp) + 1,
                display_post: ppp,
				<?php if(count($tax_query)>0): ?>
				text_query:jtax_query,
				<?php endif; ?>
				<?php if(isset($s)): ?>
				searchkey:s,
				<?php endif; ?>
            })
            .success(function(posts) {
				if(posts=="fail"){
				$("#more_posts").hide();
				}
				else{
                page++;
                $("#grid").append(posts);
                // CHANGE THIS!
				if(page >= maxpage)
                {
                $("#more_posts").attr("disabled", false);
				}
				}
				new AnimOnScroll( document.getElementById( 'grid' ), {
				minDuration : 0.4,
				maxDuration : 0.7,
				viewportFactor : 0.2
			   });
            });
        });
    });
</script>