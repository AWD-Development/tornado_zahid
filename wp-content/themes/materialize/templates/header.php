<?php
    global $wp_customize, $mythemes_header_class;

    /* BLOG TITLE & DESCRIPTION  */
    $title_label            = esc_html( get_theme_mod( 'mythemes-header-title-label' , __( 'Best WordPress Theme based on Material Design' , 'materialize' ) ) );
    $description_label      = esc_html( get_theme_mod( 'mythemes-header-description-label' , __( 'Materialize is a freemium WordPress theme developed by myThem.es' , 'materialize' ) ) );

    /* HEADER HEIGHT */
    $header_height          = absint( get_theme_mod( 'mythemes-header-height' , 450 ) );

    /* HEADER MASK */
    $header_mask_color      = esc_attr( get_theme_mod( 'mythemes-header-mask-color', '#ffffff' ) );
    $header_mask_opacity    = floatval( absint( get_theme_mod( 'mythemes-header-mask-opacity' , 75 ) ) / 100 );

    /* HEADER FIRST BUTTON */
    $first_btn_url          = esc_url( get_theme_mod( 'mythemes-first-btn-url', home_url( '#' ) ) );
    $first_btn_label        = esc_html( get_theme_mod( 'mythemes-first-btn-label', __( 'First Button', 'materialize' ) ) );
    $first_btn_description  = esc_attr( get_theme_mod( 'mythemes-first-btn-description', __( 'first button link description...', 'materialize' ) ) );

    /* HEADER SECOND BUTTON */
    $second_btn_url         = esc_url( get_theme_mod( 'mythemes-second-btn-url', home_url( '#' ) ) );
    $second_btn_label       = esc_html( get_theme_mod( 'mythemes-second-btn-label', __( 'Second Button', 'materialize' ) ) );
    $second_btn_description = esc_attr( get_theme_mod( 'mythemes-second-btn-description', __( 'second button link description...', 'materialize' ) ) );

    /* HEADER CUSTOMIZER */
    if( isset( $wp_customize ) ) {

        /* HEADER TITLE */
        $header_title       = true;
        $header_title_class = !(bool)get_theme_mod( 'mythemes-header-title', true ) ? 'hide' : '';

        /* HEADER DESCRIPTION */
        $header_desc        = true;
        $header_desc_class  = !(bool)get_theme_mod( 'mythemes-header-description', true ) ? 'hide' : '';

        /* HEADER FIRST BUTTON */
        $first_btn          = true;
        $first_btn_class    = !(bool)get_theme_mod( 'mythemes-first-btn', true ) ? 'hide' : '';

        /* HEADER SECOND BUTTON */
        $second_btn         = true;
        $second_btn_class   = !(bool)get_theme_mod( 'mythemes-second-btn', true ) ? 'hide' : '';
    }

    /* HEADER FRONTEND */
    else{

        /* HEADER TITLE */
        $header_title       = (bool)get_theme_mod( 'mythemes-header-title', true );
        $header_title_class = '';

        /* HEADER DESCRIPTION */
        $header_desc        = (bool)get_theme_mod( 'mythemes-header-description', true );
        $header_desc_class  = '';

        /* HEADER FIRST BUTTON */
        $first_btn          = (bool)get_theme_mod( 'mythemes-first-btn', true );
        $first_btn_class    = '';

        /* HEADER SECOND BUTTON */
        $second_btn         = (bool)get_theme_mod( 'mythemes-second-btn', true );
        $second_btn_class   = '';
    }
?>


<div class="mythemes-header overflow-wrapper parallax-container <?php echo esc_attr( $mythemes_header_class ); ?>" style="height: <?php echo absint( $header_height ); ?>px;">
    <div class="valign-cell-wrapper" style="background: rgba( <?php echo mythemes_tools::hex2rgb( esc_attr( $header_mask_color ) ); ?>, <?php echo floatval( $header_mask_opacity ); ?> );">

        <!-- VERTICAL ALIGN CENTER -->
        <div class="valign-cell">
            
            <div class="container">
                <div class="row center">
                    <?php

                        /* HEADER TITLE */
                        if( $header_title ){
                            echo '<a class="header-title ' . esc_attr( $header_title_class ) . '" href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( $title_label . ' - ' . $description_label ) . '">';
                            echo esc_html( $title_label );
                            echo '</a>';
                        }

                        /* HEADER DESCRIPTION */
                        if( $header_desc ){
                            echo '<a class="header-description ' . esc_attr( $header_desc_class ) . '" href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( $title_label . ' - ' . $description_label ) . '">';
                            echo esc_html( $description_label );
                            echo '</a>';
                        }

                        if( $first_btn || $second_btn ){

                            echo '<div class="mythemes-header-buttons">';

                            /* HEADER FIRST BUTTON */
                            if( $first_btn ){
                                echo '<a href="' . esc_url( $first_btn_url ) . '" class="btn-large waves-effect waves-light mythemes-first-button ' . esc_attr( $first_btn_class ) . '" title="' . esc_attr( $first_btn_description ) . '">';
                                echo esc_html( $first_btn_label );
                                echo '</a>';
                            }

                            /* HEADER SECOND BUTTON */
                            if( $second_btn ){
                                echo '<a href="' . esc_url( $second_btn_url ) . '" class="btn-large waves-effect waves-light mythemes-second-button ' . esc_attr( $second_btn_class ) . '" title="' . esc_attr( $second_btn_description ) . '">';
                                echo esc_html( $second_btn_label );
                                echo '</a>';
                            }

                            echo '</div>';
                        }
                    ?>
                </div>
            </div>
                
        </div>
    </div>

    <?php
        $header_image = esc_url( get_header_image() );

        if( !empty( $header_image ) ){
            echo '<div class="parallax">';
            echo '<img src="' . esc_url( $header_image ) . '" alt="' . esc_attr( $header_title . ' - ' . $header_desc ) . '">';
            echo '</div>';
        }
    ?>
</div>