<?php
    global $wp_customize;

    $default_class = '';

    /* WP CUSTOMIZE */
    if( isset( $wp_customize ) ){
        $default = true;
        $default_class = !(bool)get_theme_mod( 'mythemes-default-content', true ) ? 'hide' : '';
    }

    /* FRONTEND */
    else{
        $default = (bool)get_theme_mod( 'mythemes-default-content', true );
    }

    /* SIDEBAR */
    if ( dynamic_sidebar( 'front-page-header-third' ) ){
        /* IF NOT EMPTY */    
    }

    else if( $default ){
        echo '<div class="widget widget_text mythemes-default-content ' . esc_attr( $default_class ) . '">';
        echo '<h3>' . __( 'Responsive Layout' , 'materialize' ) . '</h3>';
        echo '<div class="textwidget">';
        echo '<p>' . __( 'We haven\'t forgotten about responsive layout. With theme Materialize, you can create a website with full mobile support.' , 'materialize' ) . '</p>';
        echo '</div>';
        echo '</div>';
    }
?>