<?php

$pages  = mythemes_cfg::get_pages();


$cols   = array();
$boxes  = array();
$sett   = array();


$pages[ 'mythemes-materialize-faq' ] = array(
    'menu' => array(
        'label'     => __( 'Materialize FAQ' , 'materialize' )
    ),
    'cols'  => & $cols,
    'boxes' => & $boxes,
    'sett'  => & $sett
);


mythemes_cfg::set_pages( $pages );


$is_enb_fp  = get_option( 'show_on_front' ) == 'page';
$content    = array( 'left', 'full', 'right' );
$sidebars   = array(
    'main-sidebar'          => __( 'Main Sidebar' , 'materialize' ),
    'front-page-sidebar'    => __( 'Front Page Sidebar' , 'materialize' ),
    'page-sidebar'          => __( 'Default Page Sidebar' , 'materialize' ),
    'post-sidebar'          => __( 'Default Post Sidebar' , 'materialize' ),
    'special-page-sidebar'  => __( 'Special Page Sidebar' , 'materialize' )
);

$sett[ 'author-link' ] = array(
    'type' => array(
        'validator' => 'copyright'
    )
);

mythemes_cfg::set_sett( array_merge( mythemes_cfg::get_sett() , $sett ) );
?>