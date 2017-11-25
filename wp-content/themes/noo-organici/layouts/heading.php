<?php
$heading = noo_organici_new_heading();
if( $heading['img'] && !empty($heading['img']) ):
    ?>


    <section class="noo-page-heading" style="background-image: url('<?php echo esc_url($heading['img']) ?>')">
        <div class="noo-container">
            <div class="noo-heading-content">
                <h1 class="page-title"><?php echo esc_html($heading['title']); ?></h1>
                <?php if(function_exists('bcn_display') && !is_search()): ?>
                    <div class="noo-page-breadcrumb">
                        <?php bcn_display();  ?>
                    </div>
                <?php endif; ?>
            </div>
        </div><!-- /.container-boxed -->
    </section>

<?php endif; ?>
