
<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main noo-container">
        <div class="noo-row">
            <div class="<?php noo_organici_main_class(); ?>">
                <?php
                    while ( have_posts() ) : the_post();
                        get_template_part( 'content', get_post_format() );  ?>
                        <?php noo_organici_content_social_and_tags(); ?>
                        
                        <?php //if(noo_organici_get_option('noo_blog_post_author_bio', false) != false): ?>
                            <!--div id="author-bio">
                                <div class="author-avatar">
                                    <?php //echo get_avatar( get_the_author_meta( 'user_email' ), 90); ?>
                                </div>
                                <!--div class="author-info">
                                    <h4>
                                        <a title="<?php //printf( esc_html__( 'Post by %s','noo-organici'), get_the_author() ); ?>" href="<?php //echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                                            <?php //echo get_the_author() ?>
                                        </a>
                                    </h4>
                                    <p>
                                        <?php the_author_meta( 'description' ) ?>
                                    </p>
                                    <!--p class="author-social">
                                        <!--a href="<?php //the_author_meta( 'facebook_profile' ) ?>"><i class="fa fa-facebook"></i></a>
                                        <a href="<?php //the_author_meta( 'twitter_profile' ) ?>"><i class="fa fa-twitter"></i></a>
                                        <a href="<?php// the_author_meta( 'google_profile' ) ?>"><i class="fa fa-google-plus"></i></a>
                                    </p>
                                </div>
                            </div-->
                        <?php// endif; ?>
                        <?php //noo_organici_post_nav();?>
                        <?php
                        // if ( comments_open() || get_comments_number() ) :
                            // comments_template();
                        // endif;
                     endwhile;
                ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </main><!-- .site-main -->
</div><!-- .content-area -->
<style>
.content-thumb img {
    display: none;
}
.noo-row {
    margin-top: 10% !important;
  
}
#main{
	  margin-left: 9% !important;
	
}
</style>
<?php get_footer(); ?>