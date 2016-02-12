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
    if ( dynamic_sidebar( 'front-page-header-second' ) ){
        /* IF NOT EMPTY */    
    }

    else if( $default ){
        echo '<div class="widget widget_text mythemes-default-content ' . esc_attr( $default_class ) . '">';
        echo '<h3>' . __( 'Кайкі Дейсю' , 'materialize' ) . '</h3>';
        echo '<div class="textwidget">';
        echo '<p>' . __( '"М\'ясо-все, що потрібно людині для щастя. Незалежно від того молода вона чи ні, в житті не буває без хвилювань. Але смачне м\'ясо може допомогти їх розвіяти."' , 'materialize' ) . '</p>';
        echo '</div>';
        echo '</div>';
    }
?>