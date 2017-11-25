<?php
/**
 * HTML Functions for NOO Framework.
 * This file contains various functions used for rendering site's small layouts.
 *
 * @package    NOO Framework
 * @version    1.0.0
 * @author     Kan Nguyen <khanhnq@nootheme.com>
 * @copyright  Copyright (c) 2014, NooTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://nootheme.com
 */

get_template_part('includes/functions/noo-html-featured');
get_template_part('includes/functions/noo-html-pagination');

if (!function_exists('noo_organici_get_readmore_link')):
	function noo_organici_get_readmore_link() {
		if( noo_organici_get_option('noo_blog_show_readmore', 1 ) ) {
			return '<a href="' . get_permalink() . '" class="view-more">'
			. ''
			. '<span>'
			. esc_html__( 'View more', 'noo-organici' )
			. '</span>'
			. '</a>';
		} else {
			return '';
		}
	}
endif;

if (!function_exists('noo_organici_readmore_link')):
	function noo_organici_readmore_link() {
		if( noo_organici_get_option('noo_blog_show_readmore', 1 ) ) {
			echo noo_organici_get_readmore_link();
		} else {
			echo '';
		}
	}
endif;

if (!function_exists('noo_organici_list_comments')):
	function noo_organici_list_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		GLOBAL $post;
		$avatar_size = isset($args['avatar_size']) ? $args['avatar_size'] : 60;
		?>
		<li id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<div class="comment-wrap">
				<div class="comment-img">
					<div class="img-thumbnail">
						<?php echo get_avatar($comment, $avatar_size); ?>
					</div>
					<?php if ($comment->user_id === $post->post_author): ?>
						<div class="ispostauthor">
							<?php echo esc_html__( 'Post<br/>Author', 'noo-organici'); ?>
						</div>
					<?php endif; ?>
				</div>
				<article id="comment-<?php comment_ID(); ?>" class="comment-block">
					<header class="comment-header">
						<cite class="comment-author"><?php echo get_comment_author_link(); ?></cite>
						
						<div class="comment-meta">
							<time datetime="<?php echo get_comment_time('c'); ?>">
								<?php echo sprintf( esc_html__('%1$s at %2$s', 'noo-organici') , get_comment_date() , get_comment_time()); ?>
							</time>
							<span class="comment-edit">
								<?php edit_comment_link('<i class="fa fa-edit"></i> ' . esc_html__( 'Edit', 'noo-organici')); ?>
							</span>
						</div>
						<?php if ('0' == $comment->comment_approved): ?>
							<p class="comment-pending"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'noo-organici'); ?></p>
						<?php endif; ?>
					</header>
					<section class="comment-content">
						<?php comment_text(); ?>
					</section>
					<span class="pull-left">
						<?php comment_reply_link(array_merge($args, array(
							'reply_text' => ( esc_html__('Reply', 'noo-organici') . ' <span class="comment-reply-link-after"><i class="fa fa-reply"></i></span>') ,
							'depth' => $depth,
							'max_depth' => $args['max_depth']
						))); ?>
					</span>
				</article>
			</div>
		<?php
	}
endif;

if ( ! function_exists( 'noo_organici_comment_form' ) ) :
	function noo_organici_comment_form( $args = array(), $post_id = null ) {
	    global $id;
	    $user = wp_get_current_user();
	    $user_identity = $user->exists() ? $user->display_name : '';

	    if ( null === $post_id ) {
	        $post_id = $id;
	    }
	    else {
	        $id = $post_id;
	    }

	    if ( comments_open( $post_id ) ) :
	    ?>
	    <div id="respond-wrap">
	        <?php 
	            $commenter = wp_get_current_commenter();
	            $req = get_option( 'require_name_email' );
	            $aria_req = ( $req ? " aria-required='true'" : '' );
	            $fields =  array(
	                'author' => '<div class="noo-row"><div class="noo-sm-4"><p class="comment-form-author"><input id="author" name="author" type="text" placeholder="' . esc_html__( 'Name*', 'noo-organici' ) . '" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
	                'email' => '<p class="comment-form-email"><input id="email" name="email" type="text" placeholder="' . esc_html__( 'Email*', 'noo-organici' ) . '" class="form-control" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
	                'url' => '<p class="comment-form-website"><input id="url" name="url" type="text" placeholder="' . esc_html__( 'Website', 'noo-organici' ) . '" class="form-control" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" size="30" /></p></div>',
	                'comment_field'  => '<div class="noo-sm-8"><p class="comment-form-comment"><textarea class="form-control" placeholder="' . esc_html__( 'Your Comment', 'noo-organici' ) . '" id="comment" name="comment" cols="40" rows="6" aria-required="true"></textarea></p></div></div>'
	            );
	            $comments_args = array(
	                    'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
	                    'logged_in_as'         => '<p class="logged-in-as">' . sprintf( wp_kses( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'noo-organici' ), noo_organici_allowed_html() ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
	                    'title_reply'          => sprintf('<span>%s</span>', esc_html__( 'Leave us a comment', 'noo-organici' )),
	                    'title_reply_to'       => sprintf('<span>%s</span>', esc_html__( 'Leave a reply to %s', 'noo-organici' )),
	                    'cancel_reply_link'    => esc_html__( 'Click here to cancel the reply', 'noo-organici' ),
	                    'comment_notes_before' => '',
	                    'comment_notes_after'  => '',
	                    'label_submit'         => esc_html__( 'Post Comments', 'noo-organici' ),
	                    'comment_field'        =>'',
	                    'must_log_in'          => ''
	            );
	            if(is_user_logged_in()){
	                $comments_args['comment_field'] = '<p class="comment-form-comment"><textarea class="form-control" placeholder="' . esc_html__( 'Your Comment', 'noo-organici' ) . '" id="comment" name="comment" cols="40" rows="6" aria-required="true"></textarea></p>';
	            }
	        	comment_form($comments_args); 
	        ?>
	    </div>

	    <?php
	    endif;
	}
endif;

if ( ! function_exists( 'noo_organici_social_share' ) ) :
	function noo_organici_social_share( $post_id = null ) {
		$post_id = (null === $post_id) ? get_the_id() : $post_id;
		$post_type =  get_post_type($post_id);
		$prefix = 'noo_blog';

		if(noo_organici_get_option("{$prefix}_social", true ) === false) {
			return '';
		}

		$share_url     = urlencode( get_permalink() );
		$share_title   = urlencode( get_the_title() );
		$share_source  = urlencode( get_bloginfo( 'name' ) );
		$share_content = urlencode( get_the_content() );
		$share_media   = wp_get_attachment_thumb_url( get_post_thumbnail_id() );
		$popup_attr    = 'resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0';

		$share_title  = noo_organici_get_option( "{$prefix}_social_title", '' );
		$facebook     = noo_organici_get_option( "{$prefix}_social_facebook", true );
		$twitter      = noo_organici_get_option( "{$prefix}_social_twitter", true );
		$google		  = noo_organici_get_option( "{$prefix}_social_google", true );
		$pinterest    = noo_organici_get_option( "{$prefix}_social_pinterest", false );
		$linkedin     = noo_organici_get_option( "{$prefix}_social_linkedin", false );
		$html = array();

		if ( $facebook || $twitter || $google || $pinterest || $linkedin ) {
			$html[] = '<div class="content-share">';
			if( $share_title !== '' ) {
				$html[] = '<p class="social-title">';
				$html[] = '  ' . $share_title;
				$html[] = '</p>';
			}
			$html[] = '<div class="noo-social social-share">';

			if($facebook) {
				$html[] = '<a href="#share" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" class="noo-share"'
							. ' title="' . esc_html__( 'Share on Facebook', 'noo-organici' ) . '"'
							. ' onclick="window.open(' 
								. "'http://www.facebook.com/sharer.php?u={$share_url}&amp;t={$share_title}','popupFacebook','width=650,height=270,{$popup_attr}');"
								. ' return false;">';
				$html[] = '<i class="fa fa-facebook"></i>';
				$html[] = '</a>';
			}

			if($twitter) {
				$html[] = '<a href="#share" class="noo-share"'
							. ' title="' . esc_html__( 'Share on Twitter', 'noo-organici' ) . '"'
							. ' onclick="window.open('
								. "'https://twitter.com/intent/tweet?text={$share_title}&amp;url={$share_url}','popupTwitter','width=500,height=370,{$popup_attr}');"
								. ' return false;">';
				$html[] = '<i class="fa fa-twitter"></i></a>';
			}

			if($google) {
				$html[] = '<a href="#share" class="noo-share"'
							. ' title="' . esc_html__( 'Share on Google+', 'noo-organici' ) . '"'
								. ' onclick="window.open('
								. "'https://plus.google.com/share?url={$share_url}','popupGooglePlus','width=650,height=226,{$popup_attr}');"
								. ' return false;">';
				$html[] = '<i class="fa fa-google-plus"></i></a>';
			}

			if($pinterest) {
				$html[] = '<a href="#share" class="noo-share"'
							. ' title="' . esc_html__( 'Share on Pinterest', 'noo-organici' ) . '"'
							. ' onclick="window.open('
								. "'http://pinterest.com/pin/create/button/?url={$share_url}&amp;media={$share_media}&amp;description={$share_title}','popupPinterest','width=750,height=265,{$popup_attr}');"
								. ' return false;">';
				$html[] = '<i class="fa fa-pinterest"></i></a>';
			}

			if($linkedin) {
				$html[] = '<a href="#share" class="noo-share"'
							. ' title="' . esc_html__( 'Share on LinkedIn', 'noo-organici' ) . '"'
							. ' onclick="window.open('
								. "'http://www.linkedin.com/shareArticle?mini=true&amp;url={$share_url}&amp;title={$share_title}&amp;summary={$share_content}&amp;source={$share_source}','popupLinkedIn','width=610,height=480,{$popup_attr}');"
								. ' return false;">';
				$html[] = '<i class="fa fa-linkedin"></i></a>';
			}

			$html[] = '</div>'; // .noo-social.social-share
			$html[] = '</div>'; // .share-wrap
		}

		echo implode("\n", $html);
	}
endif;

if ( ! function_exists( 'noo_organici_social_share_product' ) ) :
	function noo_organici_social_share_product( $post_id = null ) {
		$post_id = (null === $post_id) ? get_the_id() : $post_id;
		$post_type =  get_post_type($post_id);
		$prefix = 'noo_blog';

		if(noo_organici_get_option("{$prefix}_social", true ) === false) {
			return '';
		}

		$share_url     = urlencode( get_permalink() );
		$share_title   = urlencode( get_the_title() );
		$share_media   = wp_get_attachment_thumb_url( get_post_thumbnail_id() );
		$popup_attr    = 'resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0';


		$html = array();


			$html[] = '<div class="noo-social-share">';

            $html[] = '<span>'.esc_html__('Share:','noo-organici').'</span>';

            $html[] = '<a href="#share" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" class="noo-share"'
                . ' title="' . esc_html__( 'Share on Facebook', 'noo-organici' ) . '"'
                . ' onclick="window.open('
                . "'http://www.facebook.com/sharer.php?u={$share_url}&amp;t={$share_title}','popupFacebook','width=650,height=270,{$popup_attr}');"
                . ' return false;">';
            $html[] = '<i class="fa fa-facebook"></i>';
            $html[] = '</a>';

            $html[] = '<a href="#share" class="noo-share"'
                . ' title="' . esc_html__( 'Share on Twitter', 'noo-organici' ) . '"'
                . ' onclick="window.open('
                . "'https://twitter.com/intent/tweet?text={$share_title}&amp;url={$share_url}','popupTwitter','width=500,height=370,{$popup_attr}');"
                . ' return false;">';
            $html[] = '<i class="fa fa-twitter"></i></a>';

            $html[] = '<a href="#share" class="noo-share"'
                . ' title="' . esc_html__( 'Share on Google+', 'noo-organici' ) . '"'
                . ' onclick="window.open('
                . "'https://plus.google.com/share?url={$share_url}','popupGooglePlus','width=650,height=226,{$popup_attr}');"
                . ' return false;">';
            $html[] = '<i class="fa fa-google-plus"></i></a>';

            $html[] = '<a href="#share" class="noo-share"'
                . ' title="' . esc_html__( 'Share on Pinterest', 'noo-organici' ) . '"'
                . ' onclick="window.open('
                . "'http://pinterest.com/pin/create/button/?url={$share_url}&amp;media={$share_media}&amp;description={$share_title}','popupPinterest','width=750,height=265,{$popup_attr}');"
                . ' return false;">';
            $html[] = '<i class="fa fa-pinterest"></i></a>';


			$html[] = '</div>'; // .noo-social.social-share


		echo implode("\n", $html);
	}
endif;

if (!function_exists('noo_organici_social_icons')):
	function noo_organici_social_icons($position = 'topbar', $direction = '') {
		if ($position == 'topbar') {
			// Top Bar social
		} else {
			// Bottom Bar social
		}
		
		$class = isset($direction) ? $direction : '';
		$html = array();
		$html[] = '<div class="noo-social social-icons ' . $class . '">';
		
		$social_list = array(
			'facebook'      => esc_html__( 'Facebook', 'noo-organici') ,
			'twitter'       => esc_html__( 'Twitter', 'noo-organici') ,
			'google-plus'   => esc_html__( 'Google+', 'noo-organici') ,
			'pinterest'     => esc_html__( 'Pinterest', 'noo-organici') ,
			'linkedin'      => esc_html__( 'LinkedIn', 'noo-organici') ,
			'rss'           => esc_html__( 'RSS', 'noo-organici') ,
			'youtube'       => esc_html__( 'YouTube', 'noo-organici') ,
			'instagram'     => esc_html__( 'Instagram', 'noo-organici') ,
		);
		
		$social_html = array();
		foreach ($social_list as $key => $title) {
			$social = noo_organici_get_option("noo_social_{$key}", '');
			if ($social) {
				$social_html[] = '<a href="' . $social . '" title="' . $title . '" target="_blank">';
				$social_html[] = '<i class="fa fa-' . $key . '"></i>';
				$social_html[] = '</a>';
			}
		}
		
		if(empty($social_html)) {
			$social_html[] = esc_html__( 'No Social Media Link','noo-organici');
		}
		
		$html[] = implode($social_html, "\n");
		$html[] = '</div>';
		
		echo implode($html, "\n");
	}
endif;

if ( ! function_exists( 'noo_organici_entry_meta' ) ) :
    /**
     * Prints HTML with meta information for the categories, tags.
     *
     * @since Twenty Fifteen 1.0
     */
    function noo_organici_entry_meta() {

        printf( '<span class="posted-on"><i class="fa fa-calendar"></i><a href="%1$s" rel="bookmark">%2$s</a></span>',
            esc_url( get_permalink() ),
            get_the_date()
        );
        if ( 'post' == get_post_type() ) {
            printf( '<span class="author vcard"><i class="fa fa-user"></i><a class="url fn n" href="%1$s">%2$s</a></span>',
                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                get_the_author()
            );
            $categories_list = get_the_category_list( ', ' );
            if ( $categories_list) {
                printf( '<span class="cat-links"><i class="fa fa-briefcase"></i>%1$s</span>',
                    $categories_list
                );
            }
            $tags_list = get_the_tag_list( '', ', ' );
            if ( $tags_list ) {
                printf( '<span class="tags-links"><i class="fa fa-tags"></i>%1$s</span>',
                    $tags_list
                );
            }
        }

        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link"><i class="fa fa-comments"></i>';
            comments_popup_link( esc_html__( 'Leave a comment', 'noo-organici' ), esc_html__( '1 Comment', 'noo-organici' ), esc_html__( '% Comments', 'noo-organici' ) );
            echo '</span>';
        }
    }

endif;

if(!function_exists('noo_organici_gototop')):
	function noo_organici_gototop(){
		if( noo_organici_get_option( 'noo_organici_back_to_top', true ) ) {
			echo '<a href="#" class="go-to-top hidden-print"><i class="fa fa-angle-up"></i></a>';
		}
		return ;
	}
	add_action('wp_footer','noo_organici_gototop');
endif;

