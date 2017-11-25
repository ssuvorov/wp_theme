<?php


if( !class_exists('Noo_Organici_Happyhours') ){
    class Noo_Organici_Happyhours extends  WP_Widget{

        public function __construct(){
            parent::__construct(
                'noo_happyhours',
                'Noo Happy Hours',
                array('description'=>esc_html__('Display Happy Hours', 'noo-organici' ))
            );
            add_action('wp_ajax_add_tab', array($this, 'add_tab'));
        }

        public function widget($args, $instance){
            extract( $args );
            extract( $instance );
            if ( ! empty( $instance['title'] ) ) {
                $title = apply_filters( 'widget_title', $instance['title'] );
            }
            echo $before_widget;
            if ( ! empty( $title ) ) {
                echo $before_title . $title . $after_title;
            }
            ?>
            <ul class="noo-happyhours">
                <?php
                    if( isset($tabs) && !empty($tabs)  ):
                        foreach($tabs as $tab):
                ?>
                   <li>
                       <div>
                           <?php echo esc_attr($tab['title']);  ?>
                       </div>
                       <div>
                           <?php echo esc_attr($tab['content']);  ?>
                       </div>
                   </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <?php
            echo $after_widget;
        }

        public function form( $instance ){
            extract(wp_parse_args($instance, array(
                'title' =>  esc_html__('Happy Hours', 'noo-organici' ),
                'tabs'  => array(
                    1 => array(
                        'title'  =>  '',
                        'content' =>  ''
                    )
                )
            )));
            ?>
            <p>
                <label for="<?php echo $this -> get_field_id('title'); ?>"><?php esc_html_e('Title:', 'noo-organici' ); ?></label>
                <input type="text" id="<?php echo $this -> get_field_id('title'); ?>" name="<?php echo $this -> get_field_name('title') ?>" class="widefat" value="<?php echo esc_attr($title); ?>">
            </p>
            <div class="open-hours">
                <?php

                    $tabs = is_array($tabs) ? $tabs : $instance['tabs'];
                    $count = 0;
                    foreach($tabs as $tab) {
                        $this->tab($tab, $count);
                        $count++;
                    }
                ?>
            </div>
            <p><span class="add-hours button-primary" data-num="<?php echo esc_attr(count($tabs)); ?>"><?php esc_html_e('ADD Field', 'noo-organici' ); ?></span></p>
            <?php
        }
        function tab($tab = array(), $count = 0) {
            ?>
                <div class="openhousrs-item">
                    <p class="tab-desc description">
                        <label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo esc_attr($count) ?>-title"><?php esc_html_e('Title', 'noo-organici' ); ?></label>
                        <input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo esc_attr($count) ?>-title" class="widefat" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo esc_attr($count) ?>][title]" value="<?php echo esc_attr($tab['title']) ?>" />

                    </p>
                    <p class="tab-desc description">
                        <label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo esc_attr($count) ?>-content"><?php esc_html_e('Content', 'noo-organici' ); ?></label>
                        <input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo esc_attr($count) ?>-content" class="widefat" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo esc_attr($count) ?>][content]" value="<?php echo esc_attr($tab['content']) ?>" />
                    </p>
                    <button class="openhours-remove">X</button>
                </div>
            <?php
        }
        function update($new_instance, $old_instance) {
            $new_instance = $new_instance;
            return $new_instance;
        }

        /* AJAX add tab */
        function add_tab() {
            $count = isset($_POST['count']) ? absint($_POST['count']) : false;

            //default key/value for the tab
            $tab = array(
                'title' => '',
                'content' => ''
            );

            if($count) {
                $this->tab($tab, $count);
            } else {
                die(-1);
            }

            die();
        }

    }
    register_widget('Noo_Organici_Happyhours');
}
if( !class_exists('Noo_Organici_Openhours') ){
    class Noo_Organici_Openhours extends  WP_Widget{

        public function __construct(){
            parent::__construct(
                'noo_openhours',
                'Noo Open Hours',
                array('description'=>esc_html__('Display Open Hours', 'noo-organici' ))
            );
            add_action('wp_ajax_add_tab2', array($this, 'add_tab2'));
        }

        public function widget($args, $instance){
            extract( $args );
            extract( $instance );
            if ( ! empty( $instance['title'] ) ) {
                $title = apply_filters( 'widget_title', $instance['title'] );
            }
            echo $before_widget;
            if ( ! empty( $title ) ) {
                echo $before_title . $title . $after_title;
            }
            ?>
            <ul class="noo-openhours">
                <?php
                    if( isset($tabs) && !empty($tabs)  ):
                        foreach($tabs as $tab):
                ?>
                   <li>
                       <span>
                           <?php echo esc_attr($tab['title']);  ?>
                       </span>
                       <span>
                           <?php echo esc_attr($tab['content']);  ?>
                       </span>
                   </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
            <?php
            echo $after_widget;
        }

        public function form( $instance ){
            extract(wp_parse_args($instance, array(
                'title' =>  esc_html__('Open Hours', 'noo-organici' ),
                'tabs'  => array(
                    1 => array(
                        'title'  =>  '',
                        'content' =>  ''
                    )
                )
            )));
            ?>
            <p>
                <label for="<?php echo $this -> get_field_id('title'); ?>"><?php esc_html_e('Title:', 'noo-organici' ); ?></label>
                <input type="text" id="<?php echo $this -> get_field_id('title'); ?>" name="<?php echo $this -> get_field_name('title') ?>" class="widefat" value="<?php echo esc_attr($title); ?>">
            </p>
            <div class="open-hours">
                <?php

                    $tabs = is_array($tabs) ? $tabs : $instance['tabs'];
                    $count = 0;
                    foreach($tabs as $tab) {
                        $this->tab($tab, $count);
                        $count++;
                    }
                ?>
            </div>
            <p><span class="add-hours2 button-primary" data-num="<?php echo esc_attr(count($tabs)); ?>"><?php esc_html_e('ADD Field', 'noo-organici' ); ?></span></p>
            <?php
        }
        function tab($tab = array(), $count = 0) {
            ?>
                <div class="openhousrs-item">
                    <p class="tab-desc description">
                        <label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo esc_attr($count) ?>-title"><?php esc_html_e('Title', 'noo-organici' ); ?></label>
                        <input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo esc_attr($count) ?>-title" class="widefat" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo esc_attr($count) ?>][title]" value="<?php echo esc_attr($tab['title']) ?>" />

                    </p>
                    <p class="tab-desc description">
                        <label for="<?php echo $this->get_field_id('tabs') ?>-<?php echo esc_attr($count) ?>-content"><?php esc_html_e('Content', 'noo-organici' ); ?></label>
                        <input type="text" id="<?php echo $this->get_field_id('tabs') ?>-<?php echo esc_attr($count) ?>-content" class="widefat" name="<?php echo $this->get_field_name('tabs') ?>[<?php echo esc_attr($count) ?>][content]" value="<?php echo esc_attr($tab['content']) ?>" />
                    </p>
                    <button class="openhours-remove">X</button>
                </div>
            <?php
        }
        function update($new_instance, $old_instance) {
            $new_instance = $new_instance;
            return $new_instance;
        }

        /* AJAX add tab */
        function add_tab2() {
            $count = isset($_POST['count']) ? absint($_POST['count']) : false;

            //default key/value for the tab
            $tab = array(
                'title' => '',
                'content' => ''
            );

            if($count) {
                $this->tab($tab, $count);
            } else {
                die(-1);
            }

            die();
        }

    }
    register_widget('Noo_Organici_Openhours');
}

class Noo_Organici_Widget_Recent_Posts extends WP_Widget {

    /**
     * Sets up a new Recent Posts widget instance.
     *
     * @since 2.8.0
     * @access public
     */
    public function __construct() {
        $widget_ops = array('classname' => 'widget_recent_entries', 'description' => esc_html__( "Your site&#8217;s most recent Posts.",'noo-organici') );
        parent::__construct('noo-recent-posts', esc_html__('Noo Recent Posts','noo-organici'), $widget_ops);
        $this->alt_option_name = 'widget_recent_entries';
    }

    /**
     * Outputs the content for the current Recent Posts widget instance.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Recent Posts widget instance.
     */
    public function widget( $args, $instance ) {
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts','noo-organici' );

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
        if ( ! $number )
            $number = 5;
        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

        /**
         * Filter the arguments for the Recent Posts widget.
         *
         * @since 3.4.0
         *
         * @see WP_Query::get_posts()
         *
         * @param array $args An array of arguments used to retrieve the recent posts.
         */
        $r = new WP_Query( apply_filters( 'widget_posts_args', array(
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true
        ) ) );

        if ($r->have_posts()) :
        ?>
        <?php echo $args['before_widget']; ?>
        <?php if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        } ?>
        <ul class="post_list_widget">
        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
            <li>
                <a href="<?php the_permalink(); ?>">
                     <?php
                        $url_img = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID() ));
                     ?>
                    <span class="post-thumb" style="background-image: url(<?php echo esc_url($url_img[0]); ?>)"></span>
                    <span class="post-title"><?php get_the_title() ? the_title() : the_ID(); ?></span>
                    <?php if ( $show_date ) : ?>
                        <span class="post-date"><?php echo get_the_date(); ?></span>
                    <?php endif; ?>
                </a>
            </li>
        <?php endwhile; ?>
        </ul>
        <?php echo $args['after_widget']; ?>
        <?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();

        endif;
    }

    /**
     * Handles updating the settings for the current Recent Posts widget instance.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['number'] = (int) $new_instance['number'];
        $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
        return $instance;
    }

    /**
     * Outputs the settings form for the Recent Posts widget.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'noo-organici' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of posts to show:', 'noo-organici' ); ?></label>
        <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($number); ?>" size="3" /></p>

        <p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php esc_html_e( 'Display post date?' , 'noo-organici'); ?></label></p>
<?php
    }
}

register_widget('Noo_Organici_Widget_Recent_Posts');

class Noo_Organici_Nav_Menu_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'classname' => 'noo-nav-menu-widget', 'description' => esc_html__( 'Display Noo Custom Menu.', 'noo-organici' ) );
		parent::__construct( 'noo_nav_menu', esc_html__('Noo Custom Menu', 'noo-organici'), $widget_ops );
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// Get menu
		$nav_menu1 = ! empty( $instance['nav_menu1'] ) ? wp_get_nav_menu_object( $instance['nav_menu1'] ) : false;
		$nav_menu2 = ! empty( $instance['nav_menu2'] ) ? wp_get_nav_menu_object( $instance['nav_menu2'] ) : false;

		if ( !$nav_menu1 && $nav_menu2 )
			return;

		/** This filter is documented in wp-includes/default-widgets.php */
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];

		$nav_menu_args1 = array(
			'fallback_cb' => '',
			'menu'        => $nav_menu1
		);
		$nav_menu_args2 = array(
			'fallback_cb' => '',
			'menu'        => $nav_menu2
		);

		/**
		 * Filter the arguments for the Custom Menu widget.
		 *
		 * @since 4.2.0
		 *
		 * @param array    $nav_menu_args {
		 *     An array of arguments passed to wp_nav_menu() to retrieve a custom menu.
		 *
		 *     @type callback|bool $fallback_cb Callback to fire if the menu doesn't exist. Default empty.
		 *     @type mixed         $menu        Menu ID, slug, or name.
		 * }
		 * @param stdClass $nav_menu      Nav menu object for the current menu.
		 * @param array    $args          Display arguments for the current widget.
		 */
		wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args1, $nav_menu1, $args ) );
		wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args2, $nav_menu2, $args ) );

		echo $args['after_widget'];
	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		}
		if ( ! empty( $new_instance['nav_menu1'] ) ) {
			$instance['nav_menu1'] = (int) $new_instance['nav_menu1'];
		}
		if ( ! empty( $new_instance['nav_menu2'] ) ) {
			$instance['nav_menu2'] = (int) $new_instance['nav_menu2'];
		}
		return $instance;
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu1 = isset( $instance['nav_menu1'] ) ? $instance['nav_menu1'] : '';
		$nav_menu2 = isset( $instance['nav_menu2'] ) ? $instance['nav_menu2'] : '';

		// Get menus
		$menus = wp_get_nav_menus();

		// If no menus exists, direct the user to go and create some.
		?>
		<p class="nav-menu-widget-no-menus-message" <?php if ( ! empty( $menus ) ) { echo ' style="display:none" '; } ?>>
			<?php
			if ( isset( $GLOBALS['wp_customize'] ) && $GLOBALS['wp_customize'] instanceof WP_Customize_Manager ) {
				$url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
			} else {
				$url = admin_url( 'nav-menus.php' );
			}
			?>
			<?php echo sprintf( __( 'No menus have been created yet. <a href="%s">Create some</a>.','noo-organici' ), esc_attr( $url ) ); ?>
		</p>
		<div class="nav-menu-widget-form-controls" <?php if ( empty( $menus ) ) { echo ' style="display:none" '; } ?>>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:' , 'noo-organici') ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>"/>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'nav_menu1' ); ?>"><?php esc_html_e( 'Select Menu 1:', 'noo-organici' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'nav_menu1' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu1' ); ?>">
					<option value="0"><?php esc_html_e( '&mdash; Select &mdash;', 'noo-organici' ); ?></option>
					<?php foreach ( $menus as $menu ) : ?>
						<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu1, $menu->term_id ); ?>>
							<?php echo esc_html( $menu->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'nav_menu2' ); ?>"><?php esc_html_e( 'Select Menu 2:', 'noo-organici' ); ?></label>
				<select id="<?php echo $this->get_field_id( 'nav_menu2' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu2' ); ?>">
					<option value="0"><?php esc_html_e( '&mdash; Select &mdash;', 'noo-organici' ); ?></option>
					<?php foreach ( $menus as $menu ) : ?>
						<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu2, $menu->term_id ); ?>>
							<?php echo esc_html( $menu->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
		</div>
		<?php
	}
}
register_widget('Noo_Organici_Nav_Menu_Widget');



if( !class_exists('Noo_Organici_About') ):
    class Noo_Organici_About extends WP_Widget{

        public function __construct(){
            $widget_option = array('classname'  =>  'widget_about','description' => esc_html__('Display about', 'noo-organici' ));
            parent::__construct('organici-about',esc_html__('Noo About', 'noo-organici' ), $widget_option);
            add_action('admin_enqueue_scripts', array($this, 'register_js'));
        }

        public function register_js(){

            wp_enqueue_media();
            wp_register_script('upload_img', get_template_directory_uri() . '/includes/admin_assets/js/upload_img.js', false, false, $in_footer=true);
            wp_enqueue_script('upload_img');

        }

        // method for front-end
        public function widget( $args, $instance ){
            extract( $args );
            extract( $instance );
            echo $before_widget;
            ?>
            <div class="noo_about_widget">
                <a href="<?php echo esc_url($link); ?>">
                    <img src="<?php echo esc_url($image); ?>" alt="<?php bloginfo('title'); ?>">
                </a>
                <?php if( isset($title) && !empty($title) ): ?><h3 class="about-title"><?php echo esc_html($title); ?></h3><?php endif; ?>
                <p>
                    <?php echo esc_html($description); ?>
                </p>
            </div>
            <?php
            echo $after_widget;
        }

        // method widget form
        public function form( $instance ){

            $instance = wp_parse_args( $instance, array(
                'title'  =>  'Upload logo',
                'link'   =>  '',
                'image'  =>  '',
                'description'  =>  ''
            ) );
            extract($instance);
            ?>
            <p>
                <label for="<?php echo $this -> get_field_id('title'); ?>"><?php esc_html_e('Title:', 'noo-organici' ); ?></label>
                <input type="text" id="<?php echo $this -> get_field_id('title'); ?>" name="<?php echo $this -> get_field_name('title') ?>" class="widefat" value="<?php echo esc_attr($title); ?>">
            </p>
            <p>
                <label for="<?php echo $this -> get_field_id('link'); ?>"><?php esc_html_e('Link Image:', 'noo-organici' ); ?></label>
                <input type="text" id="<?php echo $this -> get_field_id('link'); ?>" name="<?php echo $this -> get_field_name('link') ?>" class="widefat" value="<?php echo esc_attr($link); ?>">
            </p>
            <p>
                <label for="<?php echo $this -> get_field_id('image'); ?>"><?php esc_html_e('Image', 'noo-organici' ) ; ?></label>
                <input class="widefat" type="text" name="<?php echo $this -> get_field_name('image'); ?>" id="<?php echo $this -> get_field_id('image') ; ?>" value="<?php echo esc_attr($image); ?>">
                <a href="#" class="noo_upload_button button" rel="image"><?php esc_html_e('Upload', 'noo-organici' ) ?></a>
            </p>
            <p>
                <label for="<?php echo $this -> get_field_id('description'); ?>"><?php esc_html_e('Description', 'noo-organici' ) ; ?></label>
                <textarea name="<?php echo $this -> get_field_name('description'); ?>" id="<?php echo $this -> get_field_id('description') ; ?>" cols="10" rows="5" class="widefat"><?php echo esc_attr($description); ?></textarea>
            </p>


        <?php
        }

        // method update
        public function update( $new_instance, $old_instance ){
            $instance                 =   $old_instance;
            $instance['title']        =   $new_instance['title'];
            $instance['link']         =   $new_instance['link'];
            $instance['image']        =   $new_instance['image'];
            $instance['description']  =   $new_instance['description'];
            return $instance;
        }

    }
    register_widget('Noo_Organici_About');
endif; // endif check class

/*widget social*/

class Noo_Organici_Social  extends WP_Widget {

    /* *
    * Register widget with WordPress.
    * parent user function class father
    */
    function  __construct() {
        parent::__construct(
            'noo_social', // Base Id
            esc_html__('Noo Social', 'noo-organici' ), // NAME
            array('description' => esc_html__('Display soical', 'noo-organici' )) // args
        ) ;
    }

    /**
     * Front-end display of widget
     */
    public function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        echo $before_widget ;
        if ( $title ) :
            echo $before_title.$title.$after_title ;
        endif;
        $arg_social = array(
            array('id'       =>  'facebook'),
            array('id'       =>  'google-plus'),
            array('id'       =>  'twitter'),
            array('id'       =>  'youtube'),
            array('id'       =>  'skype'),
            array('id'       =>  'linkedin'),
            array('id'       =>  'dribbble'),
            array('id'       =>  'pinterest'),
            array('id'       =>  'flickr'),
            array('id'       =>  'instagram')

        ) ;
        ?>
        <div class="noo_social">
            <div class="social-all">
                <?php
                foreach($arg_social as $social):
                    if (!empty($instance[$social['id']])):
                        ?>
                        <a href="<?php echo esc_url($instance[$social['id']]); ?>" class="fa fa-<?php echo esc_attr($social['id']); ?>"></a>
                    <?php
                    endif;
                endforeach;
                ?>
            </div>
        </div>
        <?php
        echo $after_widget ;


    }

    /**
     * Back-end widget form
     */
    public function  form($instrance) {
        // wp_parse_args : set default values
        $instrance = wp_parse_args( $instrance, array(
			'title'       =>  'NooTheme',
			'facebook'    =>  '',
			'google-plus' =>  '',
			'twitter'     =>  '',
			'youtube'     =>  '',
			'skype'       =>  '',
			'linkedin'    =>  '',
			'dribbble'    =>  '',
			'pinterest'   =>  '',
			'flickr'      =>  '',
			'instagram'   =>  ''
        ) );
        ?>
        <p>
            <label for="<?php echo $this ->  get_field_id('title'); ?>">
                <?php esc_html_e('Title', 'noo-organici' ) ; ?>
            </label>
            <br>
            <input type="text" name="<?php echo $this -> get_field_name('title') ; ?>" id="<?php echo $this -> get_field_id('title'); ?>" class="widefat" value="<?php echo esc_html($instrance['title']); ?>">
        </p>
        <p>
            <label for="<?php echo $this -> get_field_id('facebook') ?>" >
                <?php esc_html_e('Facebook', 'noo-organici' ) ; ?>
            </label>
            <br>
            <input type="text" name="<?php echo $this -> get_field_name('facebook') ; ?>" id="<?php echo $this -> get_field_id('facebook'); ?>" class="widefat" value="<?php echo esc_attr($instrance['facebook']); ?>">
        </p>
        <p>
            <label for="<?php echo $this -> get_field_id('google-plus') ?>">
                <?php esc_html_e('Google', 'noo-organici' ) ; ?>
            </label>
            <br>
            <input type="text" name="<?php echo $this -> get_field_name('google-plus') ; ?>" id="<?php echo $this -> get_field_id('google-plus'); ?>" class="widefat" value="<?php echo esc_attr($instrance['google-plus']); ?>">
        </p>
        <p>
            <label for="<?php echo $this -> get_field_id('twitter') ?>">
                <?php esc_html_e('Twitter', 'noo-organici' ) ; ?>
            </label>
            <br>
            <input type="text" name="<?php echo $this -> get_field_name('twitter') ; ?>" id="<?php echo $this -> get_field_id('twitter'); ?>" class="widefat" value="<?php echo esc_attr($instrance['twitter']); ?>">
        </p>
        <p>
            <label for="<?php echo $this -> get_field_id('youtube') ?>">
                <?php esc_html_e('Youtube', 'noo-organici' ) ; ?>
            </label>
            <br>
            <input type="text" name="<?php echo $this -> get_field_name('youtube') ; ?>" id="<?php echo $this -> get_field_id('youtube'); ?>" class="widefat" value="<?php echo esc_attr($instrance['youtube']); ?>">
        </p>
        <p>
            <label for="<?php echo $this -> get_field_id('skype'); ?>">
                <?php  esc_html_e('Skype', 'noo-organici' ) ; ?>
            </label>
            <br>
            <input type="text" name="<?php echo $this -> get_field_name('skype') ; ?>" id="<?php echo $this -> get_field_id('skype'); ?>" class="widefat" value="<?php echo esc_attr($instrance['skype']); ?>">
        </p>
        <p>
            <label for="<?php echo $this -> get_field_id('linkedin') ?>">
                <?php esc_html_e('linkedin', 'noo-organici' ) ; ?>
            </label>
            <br>
            <input type="text" name="<?php echo $this -> get_field_name('linkedin') ; ?>" id="<?php echo $this -> get_field_id('linkedin'); ?>" class="widefat" value="<?php echo esc_attr($instrance['linkedin']); ?>">
        </p>
        <p>
            <label for="<?php echo $this -> get_field_id('dribbble') ?>">
                <?php esc_html_e('Dribbble', 'noo-organici' ) ; ?>
            </label>
            <br>
            <input type="text" name="<?php echo $this -> get_field_name('dribbble') ; ?>" id="<?php echo $this -> get_field_id('dribbble'); ?>" class="widefat" value="<?php echo esc_attr($instrance['dribbble']); ?>">
        </p>
        <p>
            <label for="<?php echo $this -> get_field_id('pinterest') ?>">
                <?php esc_html_e('Pinterest', 'noo-organici' ) ; ?>
            </label>
            <br>
            <input type="text" name="<?php echo $this -> get_field_name('pinterest') ; ?>" id="<?php echo $this -> get_field_id('pinterest'); ?>" class="widefat" value="<?php echo esc_attr($instrance['pinterest']); ?>">
        </p>
        <p>
            <label for="<?php echo $this -> get_field_id('flickr') ?>">
                <?php esc_html_e('Flickr', 'noo-organici' ) ; ?>
            </label>
            <br>
            <input type="text" name="<?php echo $this -> get_field_name('flickr') ; ?>" id="<?php echo $this -> get_field_id('flickr'); ?>" class="widefat" value="<?php echo esc_attr($instrance['flickr']); ?>">
        </p>
		<p>
            <label for="<?php echo $this -> get_field_id('instagram') ?>">
                <?php esc_html_e('Instagram', 'noo-organici' ) ; ?>
            </label>
            <br>
            <input type="text" name="<?php echo $this -> get_field_name('instagram') ; ?>" id="<?php echo $this -> get_field_id('instagram'); ?>" class="widefat" value="<?php echo esc_attr($instrance['instagram']); ?>">
        </p>
    <?php
    }

    /* *
     * Method update
     */
    function update( $new_instance, $old_instance ) {
        $instance = array() ;
        $instance['title']     = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['facebook']  = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : ''  ;
        $instance['google-plus']    = ( ! empty( $new_instance['google-plus'] ) ) ? strip_tags( $new_instance['google-plus'] ) : ''  ;
        $instance['twitter']   = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : ''  ;
        $instance['youtube']   = ( ! empty( $new_instance['youtube'] ) ) ? strip_tags( $new_instance['youtube'] ) : ''  ;
        $instance['skype']     = ( ! empty( $new_instance['skype'] ) ) ? strip_tags( $new_instance['skype'] ) : ''  ;
        $instance['linkedin']  = ( ! empty( $new_instance['linkedin'] ) ) ? strip_tags( $new_instance['linkedin'] ) : ''  ;
        $instance['dribbble']  = ( ! empty( $new_instance['dribbble'] ) ) ? strip_tags( $new_instance['dribbble'] ) : ''  ;
        $instance['pinterest'] = ( ! empty( $new_instance['pinterest'] ) ) ? strip_tags( $new_instance['pinterest'] ) : ''  ;
        $instance['flickr']    = ( ! empty( $new_instance['flickr'] ) ) ? strip_tags( $new_instance['flickr'] ) : ''  ;
        $instance['instagram']    = ( ! empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : ''  ;
        return $instance ;
    }

}
register_widget('Noo_Organici_Social');









