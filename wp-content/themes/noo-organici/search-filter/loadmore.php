<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
include('../../../../wp-load.php');
$paged = htmlspecialchars(trim($_REQUEST['paged']));
$display_post = htmlspecialchars(trim($_REQUEST['display_post']));
$offset = htmlspecialchars(trim($_REQUEST['offset']));
if(isset($_REQUEST['text_query']))
$text_query = var_dump(json_decode($_REQUEST['text_query']));
if(isset($_REQUEST['searchkey']))
$s = isset($_REQUEST['searchkey'])?$_REQUEST['searchkey']:"";
//print_r($text_query);
$last_args=array(
	'post_type' => 'post',
	'offset' => $offset,
	'paged' => $paged,
	'title_filter' => $s,
    'title_filter_relation' => 'AND',	
	'posts_per_page' => $display_post,
	'post_status' => 'publish',
	'tax_query'=>$text_query,
);
//print_r($last_args);
$the_query = new WP_Query( $last_args );
if($the_query->have_posts()) 
{
	while ( $the_query->have_posts() ) : $the_query->the_post(); 
	
	?>
   <!--grid-item start-->
                    <li class="grid-item" id="<?php the_ID(); ?>">
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
	endwhile;
}
else
{
	echo "fail";
}
?>