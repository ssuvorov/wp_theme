<?php
    $format = get_post_format( get_the_ID() );
    $limit_excerpt = !isset( $limit_excerpt ) ? 20 : $limit_excerpt;
?>
    <div class="blog-item">
        <?php if ( $format == 'gallery' ) : ?>
            <div class="content-featured">
                <?php noo_organici_featured_gallery(); ?>
            </div>
        <?php elseif ( $format == 'audio' ) : ?>
            <div class="content-featured">
                <?php noo_organici_featured_audio(); ?>
            </div>
        <?php elseif ( $format == 'quote' ) : ?>
            <?php
                $quote = '';
                $quote = noo_organici_get_post_meta(get_the_ID() , '_noo_wp_post_quote', '');
                if($quote == '') {
                    $quote = get_the_title( get_the_ID() );
                }
                $cite = noo_organici_get_post_meta(get_the_ID() , '_noo_wp_post_quote_citation', '');
                $alias = noo_organici_get_post_meta(get_the_ID() , '_noo_wp_post_quote_alias', '');

                $url_img = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID() ),'full');
            ?>
            <div class="content-featured">
                <div class="blog-quote" style="background-image: url(<?php echo $url_img[0]; ?>);">
                    <h3 class="content-title">
                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(sprintf(esc_html__('Permanent link to: "%s"', 'noo-organici') , the_title_attribute('echo=0'))); ?>">
                            <?php echo esc_html($quote); ?>
                        </a>
                    </h3>
                    <cite>- <?php echo esc_html($cite);?> -</cite>
                    <span class="alias">(<?php echo esc_html($alias);?>)</span>
                </div>
            </div>
        <?php else: ?>
            <a class="blog-thumbnail" href="<?php the_permalink() ?>">
                <?php
                    if ( $format == 'video' ) {
                        noo_organici_featured_video();
                    } elseif ( $format == 'image' ) {
                        noo_organici_featured_default();
                    } else {
                        the_post_thumbnail( array(370, 280) );
                    }
                ?>
            </a>
        <?php endif; ?>
        <?php if ( $format != 'quote' ) : ?>
        <div class="blog-description">
            <span class="cat">
                <?php the_category('/'); ?>
            </span>
            <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
            <?php if ( $format != 'video' && $format != 'audio' ) : ?>
            <p class="blog_excerpt">
                <?php
                    $excerpt = get_the_excerpt();
                    $trim_ex = wp_trim_words($excerpt,esc_attr($limit_excerpt),'...');
                    echo esc_html($trim_ex);
                ?>
            </p>
            <?php endif; ?>
            <a class="view-more" href="<?php the_permalink() ?>"><?php echo esc_html__('View more','noo-organici'); ?></a>
        </div>
        <?php endif; ?>
    </div>