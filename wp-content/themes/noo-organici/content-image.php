<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="blog-item">
        <!--Start featured-->
        <?php if( noo_organici_has_featured_content() && !is_singular() ) : ?>
            <div class="content-featured">
                <div class="blog-thumbnail">
                    <?php noo_organici_featured_default(); ?>
                </div>
            </div>
        <?php endif; ?>
        <!--Start end featured-->

        <div class="blog-description">
            <!--Start Header-->
            <span class="cat">
                <?php the_category('/'); ?>
            </span>
            <?php if ( is_singular() ) : ?>
                <h1><?php the_title(); ?></h1>
            <?php else : ?>
                <h3><a href="<?php the_permalink() ?>" title="<?php echo esc_attr( sprintf( esc_html__( 'Permanent link to: "%s"','noo-organici' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title() ?></a></h3>
            <?php endif; ?>
            <?php noo_organici_content_meta(); ?>
            <!--Start end header-->
            <!--Start content-->
            <p class="blog_excerpt">
                <?php if ( !is_single() ) : ?>
                    <?php if(get_the_excerpt()):?>
                        <?php the_excerpt(); ?>
                    <?php endif;?>
                <?php endif; ?>
            </p>
            <?php if ( ! is_single() ) : ?>
                <?php noo_organici_content_social_and_tags(); ?>
            <?php endif;?>
            <!--Start end content-->
        </div>
        
        <?php if( noo_organici_has_featured_content() && is_singular() ) : ?>
            <div class="content-featured">
                <div class="blog-thumbnail">
                    <?php noo_organici_featured_default(); ?>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if ( is_single() ) : ?>
            <p class="blog_excerpt">
                <?php the_content(); ?>
                <?php wp_link_pages(); ?>
            </p>
        <?php endif; ?>

</article> <!-- /#post- -->