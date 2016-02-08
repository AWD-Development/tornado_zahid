<?php
    $bg_color       = esc_attr( '#' . get_background_color() );
    $hd_bkg_color   = esc_attr( get_theme_mod( 'header-background-color', '#ffffff' ) );
    $bkg            = esc_url( get_theme_mod( 'background_image' ) );
?>

<style type="text/css">

    /* HEADER */
    body{
        background-color: <?php echo esc_attr( $hd_bkg_color ); ?>;
    }

    /* BACKGROUND IMAGE */
    body > div.content{

    <?php
        if( !empty( $bkg ) ){
    ?>
            background-image: url(<?php echo $bkg; ?>);
            background-repeat: <?php echo esc_attr( get_theme_mod( 'background_repeat' , 'repeat' ) ); ?>;
            background-position: <?php echo esc_attr( get_theme_mod( 'background_position_x' , 'center' ) ); ?>;
            background-attachment: <?php echo esc_attr( get_theme_mod( 'background_attachment' , 'scroll' ) ); ?>;
    <?php
        }
    ?>
    }

    /* BREADCRUMBS */
    div.mythemes-page-header{
        padding-top: <?php echo absint( get_theme_mod( 'mythemes-breadcrumbs-space', 60 ) ); ?>px;
        padding-bottom: <?php echo absint( get_theme_mod( 'mythemes-breadcrumbs-space', 60 ) ); ?>px;
    }
</style>

<style type="text/css" id="mythemes-custom-style-background">
    /* BACKGROUND COLOR */
    body > div.content{
        background-color: <?php echo $bg_color; ?>;
    }
</style>

<?php //- HEADLINE COLOR -// ?>

<style type="text/css" id="mythemes-header-title-color" media="all">
    div.mythemes-header a.header-title{
        color: <?php echo esc_attr( get_theme_mod( 'mythemes-header-title-color', '#e53932' ) ); ?>
    }
</style>

<?php //- DESCRIPTION COLOR, HOVER COLOR -// ?>

<style type="text/css" id="mythemes-header-description-color" media="all">

    <?php
        $hex    = esc_attr( get_theme_mod( 'mythemes-header-description-color', '#000000' ) );
        $rgba1  = 'rgba( ' . mythemes_tools::hex2rgb( $hex ) . ', 0.55 )';
        $rgba2  = 'rgba( ' . mythemes_tools::hex2rgb( $hex ) . ', 1.0 )';
    ?>

    div.mythemes-header a.header-description{
        color: <?php echo esc_attr( $rgba1 ); ?>;
    }
    div.mythemes-header a.header-description:hover{
        color: <?php echo esc_attr( $rgba2 ); ?>;
    }
</style>



<?php //- FIRST BUTTON -// ?>

<style type="text/css" id="mythemes-first-btn-color" media="all">
    div.mythemes-header.parallax-container div.mythemes-header-buttons a.btn-large.mythemes-first-button{
        color: <?php echo esc_attr( get_theme_mod( 'mythemes-first-btn-color', '#ffffff' ) ); ?>;
    }
</style>

<style type="text/css" id="mythemes-first-btn-bkg-color" media="all">
    div.mythemes-header.parallax-container div.mythemes-header-buttons a.btn-large.mythemes-first-button{
        background-color: <?php echo esc_attr( get_theme_mod( 'mythemes-first-btn-bkg-color', '#4caf50' ) ); ?>;
    }
</style>

<style type="text/css" id="mythemes-first-btn-bkg-h-color" media="all">
    div.mythemes-header.parallax-container div.mythemes-header-buttons a.btn-large.mythemes-first-button:hover{
        background-color: <?php echo esc_attr( get_theme_mod( 'mythemes-first-btn-bkg-h-color', '#43a047' ) ); ?>;
    }
</style>



<?php //- SECOND BUTTON -// ?>

<style type="text/css" id="mythemes-second-btn-color" media="all">
    div.mythemes-header.parallax-container div.mythemes-header-buttons a.btn-large.mythemes-second-button{
        color: <?php echo esc_attr( get_theme_mod( 'mythemes-second-btn-color', '#ffffff' ) ); ?>;
    }
</style>

<style type="text/css" id="mythemes-second-btn-bkg-color" media="all">
    div.mythemes-header.parallax-container div.mythemes-header-buttons a.btn-large.mythemes-second-button{
        background-color: <?php echo esc_attr( get_theme_mod( 'mythemes-second-btn-bkg-color', '#e53935' ) ); ?>;
    }
</style>

<style type="text/css" id="mythemes-second-btn-bkg-h-color" media="all">
    div.mythemes-header.parallax-container div.mythemes-header-buttons a.btn-large.mythemes-second-button:hover{
        background-color: <?php echo esc_attr( get_theme_mod( 'mythemes-second-btn-bkg-h-color', '#d32f2f' ) ); ?>;
    }
</style>



<style type="text/css" id="mythemes-custom-css">

    <?php
        echo mythemes_validate_css( get_theme_mod( 'mythemes-custom-css' ) );
    ?>

</style>