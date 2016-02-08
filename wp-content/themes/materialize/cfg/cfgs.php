<?php

/* SOCIAL SHARIG */
$facebook_title         = 'Hello my friends. A few minutes ago I found a freemium WordPress theme easily customized! I love Materialize! I suggest you to try it! #Materialize';
$facebook_url           = 'http://bit.ly/1PllWxv';

$gplus                  = 'http://bit.ly/1YwtzHH';
$twitter                = 'Hello my friends. A few minutes ago I found a WP Theme easily customized! I love #Materialize! Try it here: http://bit.ly/1MmM6j0';

$pinterest_description  = 'Hello my friends. A few minutes ago I found a freemium WordPress theme easily customized! I love Materialize! I suggest you to try it! #Materialize';
$pinterest_url          = 'http://bit.ly/1FbIpgs';
$media                  = get_template_directory_uri() . '/screenshot.png';

$mailto_subject          = str_replace( '&amp;', '%26', rawurlencode( 'I suggest you to try Materialize' ) );
$mailto_body             = str_replace( '&amp;', '%26', rawurlencode( 'Hello my friends. A few minutes ago I found a freemium WordPress theme easily customized! I love Materialize! I suggest you to try it!' . "\n\n" . 'http://bit.ly/1V6vXWv' ) );


$social  = '';
$social .= '<div class="mythemes-social">';
$social .= '<a href="https://www.facebook.com/sharer/sharer.php?display=popup&amp;u=' . urlencode( esc_url( $facebook_url ) ) . '&amp;t=' . urlencode( esc_attr( $facebook_title ) ) . '" class="btn facebook" data-social-network-link="" rel="nofollow" target="_blank" onclick="javascript:window.open( this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600\');return false;"><i class="icon-facebook"></i></a>';
$social .= '<a href="https://plus.google.com/share?url=' . urlencode( esc_url( $gplus ) ) . '" class="btn gplus" data-social-network-link="" rel="nofollow" target="_blank" onclick="javascript:window.open( this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=350,width=480\');return false;"><i class="icon-gplus"></i></a>';
$social .= '<a href="https://twitter.com/intent/tweet?text=' . urlencode( esc_attr( $twitter ) ) . '" class="btn twitter" data-social-network-link="" rel="nofollow" target="_blank" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600\');return false;"><i class="icon-twitter"></i></a>' ;
$social .= '<a href="http://pinterest.com/pin/create/button?description=' . urlencode( esc_attr( $pinterest_description ) ) . '&amp;media=' . urlencode( esc_url( $media ) ) . '&amp;url=' . urlencode( esc_url( $pinterest_url ) ) . '" class="btn pinterest" data-social-network-link="" rel="nofollow" target="_blank" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600\');return false;"><i class="icon-pinterest"></i></a>';
$social .= '<a href="mailto:?Subject=' . esc_attr( $mailto_subject ) . '&amp;Body=' . esc_attr( $mailto_body ) . '" class="btn mail" data-social-network-link="" rel="nofollow" target="_blank" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600\');return false;"><i class="icon-mail"></i></a>';
$social .= '<div class="clear clearfix"></div>';
$social .= '</div>';


$cfgs = array(

    /* AUTHOR */
    'author'        => array(
        'name'              => 'myThem.es',
        'description'       => __( 'myThem.es Marketplace provides WordPress themes with the best quality and the smallest prices.' , 'materialize' ),
        'url'               => 'http://mythem.es/'
    ),

    /* THEMES */
    'theme'         => array(
        'type'              => 'free',
        'description'       => __( 'Materialize - Best WordPress Theme based on Material Design.' , 'materialize' ),
        //'premium'           => 'http://mythem.es/item/cannyon-premium-multipurpose-wordpress-theme/'
    ),

    /* LINKS */
    'links'         => array(
        'referrals'         => 'http://mythem.es/referrals/',
        'affiliates'        => 'http://mythem.es/affiliates/',
        'plugins'           => 'javascript:void(null);',
        'items'             => 'http://mythem.es/our-items/'
    ),

    'faqs'          => array(
        array(
            'title'     => __( 'Welcome Message !' , 'materialize' ),
            'content'   => 

                '<p>' . __( 'Thank you for choosing myThem.es and use one of our WordPress Themes your choice is greatly appreciated!' , 'materialize' ) . '</p>' .

                '<p>' . __( 'If you have any questions ask!' , 'materialize' ) . '</p>' .

                '<p>' . __( 'And please help us to increase the theme quality ( report bugs ).' , 'materialize' ) . '</p>' .

                '<p>' . __( 'Also please help us to increase the theme rank!' , 'materialize' ) . '</p>' .

                $social
        ),
        array(
            'title'     => __( 'Default content from Sidebars: Front Page, Footer, Blog, Single.' , 'materialize' ),
            'content'   => 

                '<p><big><strong>' . __( 'GENERAL ABOUT DEFAULT CONTENT' , 'materialize' ) . '</strong></big></p>' .

                '<p>' . __( 'The default content exists only in sidebars !' , 'materialize' ) . '</p>' .
                '<p>' . __( 'The default content is hardcoded in theme files. But you can:' , 'materialize' ) . '</p>' .
                '<p>' . __( '1. Disable all default content and fill with your content.', 'materialize' ) . '</p>' .
                '<p>' . __( '2. Replace only on section or more section with your content.', 'materialize' ) . '</p>' .

                '<div id="mythemes-header-alert" class="mythemes-flat-alert success"><p>' .
                __( 'You can hide all default content if you go to <strong>Admin Dashboard &rsaquo; Appearance &rsaquo; Customize &rsaquo; Additional</strong> and disable option "Display default content".' , 'materialize' ) .
                '</p></div>' .

                '<p>' . __(  'To replace Header - Front Page default content ( from 3 sidebars )' , 'materialize' ) . '</p>' .
                '<p>' . __( 'go to: <strong>Admin Dashboard &rsaquo; Appearance &rsaquo; Widgets</strong>' , 'materialize' ) . '</p>' .
                '<p>' . __( 'here you have multiple sidebars ( can be collapsed ) and also you have next sidebars:' , 'materialize' ) . '</p>' .

                '<p>' . __( '...' , 'materialize' ) . '</p>' .
                '<p>' . __( '...' , 'materialize' ) . '</p>' .
                '<p>' . __( 'Header - First Front Page Sidebar' , 'materialize' ) . '</p>' .
                '<p>' . __( 'Header - Second Front Page Sidebar' , 'materialize' ) . '</p>' .
                '<p>' . __( 'Header - Third Front Page Sidebar' , 'materialize' ) . '</p>' .
                '<p>' . __( '...' , 'materialize' ) . '</p>' .
                '<p>' . __( '...' , 'materialize' ) . '</p>' .

                '<p>' . __( '<strong>IMPORTANT</strong>: if the option "Display default content" is enabled and the Header Sidebars is empty then will be displayed the default content ( hardcoded ) from this sidebar.' , 'materialize' ) . '</p>' .
                '<p>' . __( 'So, just is need to get and put a text widget to a header sidebar and fill the Text widget with you Title and with your Content.' , 'materialize' ) . '</p>' .
                '<p>' . __( '<strong>IMPORTANT</strong>: The widgets are placed in the left and the sidebars are placed in the right ( <strong>Appearance &rsaquo; Widgets</strong> ).' , 'materialize' ) . '</p>' .

                '<br/><hr><br/><br/>'.

                '<p><big><strong>' . __( 'FRONT PAGE' , 'materialize' ) . '</strong></big></p>' .

                '<p>' . __( 'In the home page below the HEADER image there are 3 components that are entitle:' , 'materialize' ) . '</p>' .

                '<br/>' .

                '<p>' . __( '1. MANY COMPONENTS' , 'materialize' ) . '</p>' .
                '<p>' . __( '2. BLOCK MODEL' , 'materialize' ) . '</p>' .
                '<p>' . __( '3. RESPONSIVE LAYOUT' , 'materialize' ) . '</p>' .

                '<br/>' .

                '<p>' . __( 'Here we have three sidebars with default content. These are "Header Front Page Sidebars". If you go to Admin Dashboard &rsaquo; Appearance &rsaquo; Widgets you can see sidebars:' , 'materialize' ) . '</p>' .

                '<br/>' .

                '<p>' . __( '1. Header - First Front Page sidebar' , 'materialize' ) . '</p>' .
                '<p>' . __( '2. Header - Second Front Page sidebar' , 'materialize' ) . '</p>' .
                '<p>' . __( '3. Header - Third Front Page sidebar' , 'materialize' ) . '</p>' .

                '<br/>' .

                '<p>' . __( 'You can replace the default content with your custom content. Just is need to put a "Text" widget to each "Header Front Page Sidebar" and fill it with your content.' , 'materialize' ) . '</p>' .

                '<br/><hr><br/><br/>'.

                '<p><big><strong>' . __( 'FOOTER' , 'materialize' ) . '</strong></big></p>' .

                '<p>' . __( 'In the footer before the copyright section there are 3 components that are entitle:' , 'materialize' ) . '</p>' .

                '<br/>' .

                '<p>' . __( '1. Materialize' , 'materialize' ) . '</p>' .
                '<p>' . __( '2. ADDRESS' , 'materialize' ) . '</p>' .
                '<p>' . __( '3. CONTACT' , 'materialize' ) . '</p>' .
                '<p>' . __( '4. WORKING HOURS' , 'materialize' ) . '</p>' .

                '<br/>' .

                '<p>' . __( 'Here we have three sidebars with default content. These are "Header Front Page Sidebars". If you go to Admin Dashboard &rsaquo; Appearance &rsaquo; Widgets you can see sidebars:' , 'materialize' ) . '</p>' .

                '<br/>' .

                '<p>' . __( '1. Footer - First Sidebar ( is used the sample Text widget )' , 'materialize' ) . '</p>' .
                '<p>' . __( '2. Footer - Second Sidebar ( is used the sample Text widget )' , 'materialize' ) . '</p>' .
                '<p>' . __( '3. Footer - Third Sidebar ( is used the sample Text widget )' , 'materialize' ) . '</p>' .
                '<p>' . __( '4. Footer - Fourth Sidebar ( is used the sample Text widget )' , 'materialize' ) . '</p>' .

                '<br/><hr><br/><br/>'.

                '<p><big><strong>' . __( 'BLOG ( MAIN SIDEBAR )' , 'materialize' ) . '</strong></big></p>' .

                '<p>' . __( 'By default is used content from next widgets: "Search", "Tags Cloud" and "Categories".' , 'materialize' ) . '</p>' .

                '<br/><hr><br/><br/>'.

                '<p><big><strong>' . __( 'SINGLE POST ( SINGLE SIDEBAR )' , 'materialize' ) . '</strong></big></p>' .
                
                '<p>' . __( 'By default is used content from next widgets: "Post Meta [myThem.es]", "Post Categories [myThem.es]" and "Post Tags [myThem.es]".' , 'materialize' ) . '</p>' .

                '<br/><hr><br/><br/>'.

                '<p><big><strong>' . __( 'REPLACE CONTENT VS DISABLE DEFAULT CONTENT' , 'materialize' ) . '</strong></big></p>' .

                '<p>' . __( 'If you disable the default content then it will disable all default content from your web site ( sidebars with default content listed above ):' , 'materialize' ) . '</p>' .

                '<br/>' .

                '<p>' . __( '- Front Page Heade Sidebars' , 'materialize' ) . '</p>' .
                '<p>' . __( '- Footer Sidebars' , 'materialize' ) . '</p>' .
                '<p>' . __( '- Main Blog Sidebar' , 'materialize' ) . '</p>' .
                '<p>' . __( '- Single Sidebar' , 'materialize' ) . '</p>' .
                '<p>' . __( '- ...' , 'materialize' ) . '</p>' .

                '<br/>' .

                '<p>' . __( 'Also you can replace the default content with your content. This will allow you to make one or more changes. You will not need to replace all default content.' , 'materialize' ) . '</p>' .

                '<p>' . __( 'To replace the default content you need to add a widget with your content in the sidebar with default content ( listed above). The default content will automatically change with your content (only for this sidebar).' , 'materialize' ) . '</p>'

        ),
        array(
            'title'     => __( 'Custom CSS and Customizations' , 'materialize' ),
            'content'   => 

                '<p>' . __( 'This theme comes with special option. This option allow add custom css to customize your web site to your needs.' , 'materialize' ) . '</p>' .

                '<p>' . __( 'To use it go to Admin Dashboard' , 'materialize' ) . '</p>' .

                '<p>' . __( 'Appearance &rsaquo; Customize &rsaquo; Others - option "Custom css".' , 'materialize' ) . '</p>' .

                '<p>' . __( 'You can use it for multiple case, just is need to add you css in this field.' , 'materialize' ) . '</p>'
        ),
        array(
            'title'     => __( 'Customize the Theme' , 'materialize' ),
            'content'   =>

                '<p>' . __( 'This theme comes with a set of options what allow you to customize content, header, layouts, social items and others.' , 'materialize' ) . '</p>' .

                '<p>' . __( 'You can see theme options if you go to Admin Dashboard' , 'materialize' ) . '</p>' .

                '<p>' . __( 'Appearance &rsaquo; Customize' , 'materialize' ) . '</p>' .

                '<p>' . __( 'Here you can see:' , 'materialize' ) . '</p>' .

                '<br/>' .

                '<p>' . __( '01. Site Identity' , 'materialize' ) . '</p>' .
                '<p>' . __( '02. Colors' , 'materialize' ) . '</p>' .
                '<p>' . __( '03. Background Image' , 'materialize' ) . '</p>' .
                '<p>' . __( '04. Header Image' , 'materialize' ) . '</p>' .
                '<p>' . __( '05. Header Elements' , 'materialize' ) . '</p>' .
                '<p>' . __( '06. Breadcrumbs' , 'materialize' ) . '</p>' .
                '<p>' . __( '07. Additional' , 'materialize' ) . '</p>' .
                '<p>' . __( '08. Layout' , 'materialize' ) . '</p>' .
                '<p>' . __( '09. Social' , 'materialize' ) . '</p>' .
                '<p>' . __( '10. Others' , 'materialize' ) . '</p>' .
                '<p>' . __( '11. Menu' , 'materialize' ) . '</p>' .
                '<p>' . __( '12. Widgets' , 'materialize' ) . '</p>' .
                '<p>' . __( '13. Static Front Page' , 'materialize' ) . '</p>' .

                '<br/>' .

                '<p>' . __( 'All you have to do is play with them and view live changes.' , 'materialize' ) . '</p>' .

                '<p>' . __( 'Try and you will discover how easy it is to customize your own style.' , 'materialize' ) . '</p>'
        )

    ),

    'adds'          => array(
        array(
            'thumbnail'     => get_template_directory_uri() . '/media/_backend/img/cannyon-premium.jpg',
            'name'          => __( 'Cannyon Premium' , 'materialize' ),
            'price'         => 45,
            'url'           => 'http://mythem.es/item/cannyon-premium-multipurpose-wordpress-theme/',
        ),
        array(
            'thumbnail'     => get_template_directory_uri() . '/media/_backend/img/treeson-premium.jpg',
            'name'          => __( 'Treeson Premium' , 'materialize' ),
            'price'         => 43,
            'url'           => 'http://mythem.es/item/treeson-premium-multipurpose-wordpress-theme/',
        ),
        array(
            'thumbnail'     => get_template_directory_uri() . '/media/_backend/img/nerocity-premium.jpg',
            'name'          => __( 'Nerocity Premium' , 'materialize' ),
            'price'         => 40,
            'url'           => 'http://mythem.es/item/nerocity-premium-wordpress-theme/',
        ),
        array(
            'thumbnail'     => get_template_directory_uri() . '/media/_backend/img/verbo-premium.jpg',
            'name'          => __( 'Verbo Premium' , 'materialize' ),
            'price'         => 40,
            'url'           => 'http://mythem.es/item/verbo-premium-wordpress-theme/',
        ),
        array(
            'thumbnail'     => get_template_directory_uri() . '/media/_backend/img/my-contrastica-premium.jpg',
            'name'          => __( 'My Contrastica Premium' , 'materialize' ),
            'price'         => 30,
            'url'           => 'http://mythem.es/item/my-contrastica-premium/',
        ),
        array(
            'thumbnail'     => get_template_directory_uri() . '/media/_backend/img/my-engine-premium.jpg',
            'name'          => __( 'My Engine Premium' , 'materialize' ),
            'price'         => 30,
            'url'           => 'http://mythem.es/item/my-engine-premium/',
        ),
        array(
            'thumbnail'     => get_template_directory_uri() . '/media/_backend/img/my-lovely-premium.jpg',
            'name'          => __( 'My Lovely Premium' , 'materialize' ),
            'price'         => 30,
            'url'           => 'http://mythem.es/item/my-lovely-premium/',
        ),
        array(
            'thumbnail'     => get_template_directory_uri() . '/media/_backend/img/my-world-with-grass-and-dew-premium.jpg',
            'name'          => __( 'My Word with ... Premium' , 'materialize' ),
            'price'         => 30,
            'url'           => 'http://mythem.es/item/my-world-with-grass-and-dew-premium-wp-theme/',
        )
    ),
    'diff'          => array(
        array(
            __( 'Paid Customization' , 'materialize' ),
            1,
            1
        ),
        array(
            __( 'Support' , 'materialize' ),
            1,
            1
        ),
        array(
            __( 'Premium Support' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Documentation' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Responsive layout' , 'materialize' ),
            1,
            1
        ),
        array(
            __( 'Full support for multilanguages' , 'materialize' ),
            0,
            1,
        ),
        array(
            __( 'Custom colors' , 'materialize' ),
            1,
            1
        ),
        array(
            __( 'Quick Contact info' , 'materialize' ),
            0,
            1,
        ),
        array(
            __( 'Custom breadcrumbs settings' , 'materialize' ),
            1,
            1
        ),
        array(
            __( 'Scrollable header menu' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'WP Classic comments' , 'materialize' ),
            1,
            1
        ),
        array(
            __( 'Facebook comments' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Disqus comments' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'General header settings' , 'materialize' ),
            1,
            1
        ),
        array(
            __( 'Single post header settings ( each post )' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Single page header settings ( each page )' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Single portfolio Header settings ( each portfolio )' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Fly Effect on header' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Related Posts ( by Tags or Categories )' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Custom Front Page' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Front Page layout' , 'materialize' ),
            1,
            1
        ),
        array(
            __( 'Custom post Portfolio' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Custom page template for Portfolios' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Portfolios archives' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Portfolios layouts ( page / single / archive )' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'General layout settings' , 'materialize' ),
            1,
            1
        ),
        array(
            __( 'Posts layout settings' , 'materialize' ),
            1,
            1
        ),
        array(
            __( 'Single post layout settings ( each post )' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Page layout settings' , 'materialize' ),
            1,
            1
        ),
        array(
            __( 'Single page layout settings ( each page )' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Sidebar builder ( build unlimited number of sidebars )' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Social settings' , 'materialize' ),
            1,
            1
        ),
        array(
            __( 'Footer background image' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Footer background color' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Footer link and text colors' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Footer copyright settings' , 'materialize' ),
            1,
            1
        ),
        array(
            __( 'Footer credit link settings' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Footer Custom Menu' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Custom CSS' , 'materialize' ),
            1,
            1
        ),
        array(
            __( 'Additional JavaScript settings' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Exclude pages / posts / portfolios / features / testimonials from the search results' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Exclude pages / posts / portfolios / features / testimonials from the RSS Feed' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'External URL for each portfolio / post / page' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Video thumbnail extractor - YouTube &amp; Vimeo for each portfolio / post' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Portfolio slideshow instead of thumbnail' , 'materialize' ),
            0,
            1
        ),
        array(
            __( '2 Addvertising section ( before content and after content ) for each portfolio / post' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Custom post Testimonials' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Custom post Features' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Additional Widgets' , 'materialize' ),
            4,
            14
        ),
        array(
            __( 'Additional Shortcodes' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Shortcodes Manager' , 'materialize' ),
            0,
            1
        ),
        array(
            __( 'Gallery special Effects' , 'materialize' ),
            '1',
            '5'
        ),
        array(
            __( 'jetpack widgets [styled]' , 'materialize' ),
            1,
            1
        ),
        array(
            __( 'jetpack related posts [styled]' , 'materialize' ),
            1,
            1
        ),
        array(
            __( 'jetpack post numbers of views' , 'materialize' ),
            1,
            1
        ),
        array(
            __( 'Contact Form 7 [styled]' , 'materialize' ),
            1,
            1
        )
    )
);

mythemes_cfg::set( $cfgs );
?>