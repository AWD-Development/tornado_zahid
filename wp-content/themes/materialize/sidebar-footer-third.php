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
    if ( dynamic_sidebar( 'footer-third' ) ){
        /* IF NOT EMPTY */    
    }

    else if( $default ){
        echo '<div class="widget widget_text mythemes-default-content ' . esc_attr( $default_class ) . '">';
        echo '<h5>' . __( 'Contact' , 'materialize' ) . '</h5>';
        echo '<div class="textwidget">';
        echo sprintf( __( 'facebook: %s' , 'materialize' ) , ' <a href="#">https://facebook.com/#</a>' ) . '<br>';
        echo sprintf( __( 'direct: %s' , 'materialize' ) , ' <a href="#">http://your-website.com/#</a>' ) . '<br>';
        echo sprintf( __( 'e-mail: %s' , 'materialize' ) ,  ' ' . antispambot( 'support@mythem.es' ) );
        echo '</div>';
        echo '</div>';
    }
?>