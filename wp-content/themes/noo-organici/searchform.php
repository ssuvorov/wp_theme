<form method="GET" class="form-horizontal noo-organici-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="sr-only"><?php esc_html__( 'Search', 'noo-organici' ); ?></label>
	<input type="search" name="s" class="form-control" value="<?php echo get_search_query(); ?>" placeholder="<?php echo esc_attr__( 'Enter keyword to search...', 'noo-organici' ); ?>" />
	<input type="submit" class="hidden" value="<?php echo esc_attr__( 'Search', 'noo-organici' ); ?>" />
</form>