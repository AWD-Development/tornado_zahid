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
    if ( dynamic_sidebar( 'special-page' ) ){
        /* IF NOT EMPTY */    
    }

    else if( $default ){
        echo '<div class="widget widget_text mythemes-default-content ' . esc_attr( $default_class ) . '">';
        echo '<h4 class="widget-title">' . __( 'Contact Us' , 'materialize' ) . '</h4>';
        echo '<div class="textwidget">';
        echo sprintf( __( 'facebook: %s' , 'materialize' ) , ' <a href="#">https://facebook.com/#</a>' ) . '<br>';
        echo sprintf( __( 'direct: %s' , 'materialize' ) , ' <a href="#">http://your-website.com/#</a>' ) . '<br>';
        echo '</div>';
        echo '</div>';

        echo '<div class="widget widget_text mythemes-default-content ' . esc_attr( $default_class ) . '">';
        echo '<h4 class="widget-title">' . __( 'Working Hours' , 'materialize' ) . '</h4>';
        echo '<div class="textwidget">';
        echo '08:00 - 17:00<br/>';
        echo __( 'Monday to Friday' , 'materialize' );
        echo '</div>';
        echo '</div>';

        echo '<div class="widget widget_text mythemes-default-content ' . esc_attr( $default_class ) . '">';
        echo '<h4 class="widget-title">' . __( 'Address' , 'materialize' ) . '</h4>';
        echo '<div class="textwidget">';
        echo '1 Infinite Loop<br/>Cupertino, CA 95014, USA';
        echo '</div>';
        echo '</div>';
    }
?>