<?php get_header(); ?>

<?php
    global $wp_customize;

    if( isset( $wp_customize ) ) {
        $breadcrumbs = true;
        $classes = !(bool)get_theme_mod( 'mythemes-breadcrumbs', true ) ? 'hide' : '';
    }
    else{
        $breadcrumbs = (bool)get_theme_mod( 'mythemes-breadcrumbs', true );
        $classes = '';
    }

    if( $breadcrumbs ){
?>
        <div class="mythemes-page-header <?php echo esc_attr( $classes ); ?>">
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <nav class="mythemes-nav-inline">
                            <ul class="mythemes-menu">
                                <?php echo mythemes_breadcrumbs::home(); ?>
                                <li></li>
                            </ul>
                        </nav>
                        <h1><?php printf( __( 'Error %s' , 'materialize' ) , number_format_i18n( 404 ) ); ?></h1>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
?>

    <div class="content">
        <div class="container">
            <div class="row">

                <!-- CONTENT -->
                <section class="col s12">

                    <div>
                        <h1 class="error-404"><?php echo number_format_i18n( 404 ); ?></h1>
                        <big class="error-404-message"><?php _e( 'not found results' , 'materialize' )?></big>
                        <p class="error-404-description"><?php _e( 'We apologize but this page, post or resource does not exist or can not be found. Perhaps it is necessary to change the call method to this page, post or resource.' , 'materialize' ) ?></p>

                        <div class="error-404-search">
                            <?php get_search_form(); ?>
                        </div>
                    <div>

                </section>

            </div>
        </div>
    </div>

<?php get_footer(); ?>