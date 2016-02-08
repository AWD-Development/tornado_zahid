function lg( params ){
	console.log( params );
}

function mythemes_hex2rgb( hex )
{
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec( hex );
    var colors = result ? {
        r: parseInt( result[1], 16 ),
        g: parseInt( result[2], 16 ),
        b: parseInt( result[3], 16 )
    } : null;

    var rett = '';

    if( colors.hasOwnProperty( 'r' ) ){
    	rett += colors.r + ' , ';
    }
    else{
    	rett += '255 , ';
    }

    if( colors.hasOwnProperty( 'g' ) ){
    	rett += colors.g + ' , ';
    }
    else{
    	rett += '255 , ';
    }

    if( colors.hasOwnProperty( 'b' ) ){
    	rett += colors.b;
    }
    else{
    	rett += '255';	
    }

    return rett;
}

function mythemes_brightness( hex, steps )
{
    var steps 	= Math.max( -255, Math.min( 255, steps ) );
    var hex 	= hex.toString().replace( /#/g, "" );

    if ( hex.length == 3 ) {
        hex = 
        hex.substring( 0, 1 ) + hex.substring( 0, 1 ) +
        hex.substring( 1, 2 ) + hex.substring( 1, 2 ) +
        hex.substring( 2, 3 ) + hex.substring( 2, 3 );
    }

    var r = parseInt( hex.substring( 0, 2 ).toString() , 16 );
    var g = parseInt( hex.substring( 2, 4 ).toString() , 16 );
    var b = parseInt( hex.substring( 4, 6 ).toString() , 16 );

    r = Math.max( 0, Math.min( 255, r + steps ) ).toString(16).toUpperCase();
    g = Math.max( 0, Math.min( 255, g + steps ) ).toString(16).toUpperCase();  
    b = Math.max( 0, Math.min( 255, b + steps ) ).toString(16).toUpperCase();

	var r_hex = Array( 3 - r.length ).join( '0' ) + r;
	var g_hex = Array( 3 - g.length ).join( '0' ) + g;
	var b_hex = Array( 3 - b.length ).join( '0' ) + b;

    return '#' + r_hex + g_hex + b_hex;
}

function mythemes_load_sidebar( sidebar, position )
{
    jQuery(function(){

        if( typeof mythemes_js_ajaxurl == 'string' && mythemes_js_ajaxurl.length ){

            if( jQuery( 'div.content > div.container > div.row > aside' ).length ){
                jQuery( 'div.content > div.container > div.row > aside' ).remove();
            }

            if( jQuery( 'div.content > div.container > div.row > section' ).hasClass( 'l12' ) ){
                jQuery( 'div.content > div.container > div.row > section' ).removeClass( 'l12' );
                jQuery( 'div.content > div.container > div.row > section' ).addClass( 'l9' );
            }

            if( position == 'left' ){
                jQuery( 'div.content > div.container > div.row' ).prepend( '<aside class="col s12 m12 l3 mythemes-sidebar sidebar-to-' + position + '"></aside>' );
            }
            else{
                jQuery( 'div.content > div.container > div.row' ).append( '<aside class="col s12 m12 l3 mythemes-sidebar sidebar-to-' + position + '"></aside>' );
            }

            jQuery.post( mythemes_js_ajaxurl, 
                {
                    'action' : 'mythemes_layout_load_sidebar',
                    'sidebar': sidebar
                },
                function( result ){
                    jQuery( 'div.content > div.container > div.row > aside' ).html( result );
                }
            );

            _mythemes_masonry.init( 'div.mythemes-gallery', function(){
                jQuery( 'div.mythemes-gallery' ).masonry();
            });
        }
    });
} 

(function($){

    {   //- SITE IDENTITY -//

        wp.customize( 'blogname' , function( value ){
            value.bind(function( newval ){
                if( newval ){
                    jQuery( 'div.mythemes-blog-identity a.mythemes-blog-title' ).html( newval );
                }
            });
        });
        wp.customize( 'description' , function( value ){
            value.bind(function( newval ){
                if( newval ){
                    jQuery( 'div.mythemes-blog-identity a.mythemes-blog-description' ).html( newval );
                }
            });
        });
        wp.customize( 'mythemes-blog-logo' , function( value ){
            value.bind(function( newval ){

            	if( newval.length ){

            		if( jQuery( 'div.mythemes-blog-identity a.mythemes-blog-logo' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-blog-identity a.mythemes-blog-logo' ).removeClass( 'hide' );
            		}

            		if( jQuery( 'div.mythemes-blog-identity a.mythemes-blog-logo img' ).length ){
            			jQuery( 'div.mythemes-blog-identity a.mythemes-blog-logo img' ).attr( 'src' , newval );	
            		}
            		else{
            			jQuery( '<img src="' + newval + '"/>' ).appendTo( 'div.mythemes-blog-identity a.mythemes-blog-logo' );
            		}
            		
            	}
            	else{
    				if( !jQuery( 'div.mythemes-blog-identity a.mythemes-blog-logo' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-blog-identity a.mythemes-blog-logo' ).addClass( 'hide' );
            		}
            	}
            });
        });
        wp.customize( 'mythemes-blog-logo-m-top' , function( value ){
            value.bind(function( newval ){

                if( newval ){

                    if( !jQuery( 'div.mythemes-blog-identity a.mythemes-blog-logo' ).hasClass( 'hide' ) ){
                        jQuery( 'div.mythemes-blog-identity a.mythemes-blog-logo' ).css({ 'margin-top' : newval + 'px' });
                    }
                    
                }
            });
        });
        wp.customize( 'mythemes-blog-logo-m-bottom' , function( value ){
            value.bind(function( newval ){

                if( newval ){

                    if( !jQuery( 'div.mythemes-blog-identity a.mythemes-blog-logo' ).hasClass( 'hide' ) ){
                        jQuery( 'div.mythemes-blog-identity a.mythemes-blog-logo' ).css({ 'margin-bottom' : newval + 'px' });
                    }
                    
                }
            });
        });
    }


    {   //- HEADER -//

        {   //- GENERAL -//

            wp.customize( 'mythemes-header-front-page' , function( value ){
                value.bind(function( newval ){
                    if( jQuery( 'div.mythemes-header.parallax-container' ).hasClass( 'on-front-page' ) ){
                        if( newval ){
                            if( jQuery( 'div.mythemes-header.parallax-container' ).hasClass( 'hide' ) ){
                                jQuery( 'div.mythemes-header.parallax-container' ).removeClass( 'hide' );
                            }

                            if( jQuery( 'body > header' ).hasClass( 'mythemes-miss-header-image' ) ){
                                jQuery( 'body > header' ).removeClass( 'mythemes-miss-header-image' );
                            }
                        }
                        else{
                            if( !jQuery( 'div.mythemes-header.parallax-container' ).hasClass( 'hide' ) ){
                                jQuery( 'div.mythemes-header.parallax-container' ).addClass( 'hide' );
                            }

                            if( !jQuery( 'body > header' ).hasClass( 'mythemes-miss-header-image' ) ){
                                jQuery( 'body > header' ).addClass( 'mythemes-miss-header-image' );
                            }   
                        }

                        ;(function($){
                            $(function(){
                                $('.parallax').parallax();
                            });
                        })(jQuery);
                    }
                });
            });

            wp.customize( 'mythemes-header-blog-page' , function( value ){
                value.bind(function( newval ){
                    if( jQuery( 'div.mythemes-header.parallax-container' ).hasClass( 'on-blog-page' ) ){
                        if( newval ){
                            if( jQuery( 'div.mythemes-header.parallax-container' ).hasClass( 'hide' ) ){
                                jQuery( 'div.mythemes-header.parallax-container' ).removeClass( 'hide' );
                            }

                            if( jQuery( 'body > header' ).hasClass( 'mythemes-miss-header-image' ) ){
                                jQuery( 'body > header' ).removeClass( 'mythemes-miss-header-image' );
                            }
                        }
                        else{
                            if( !jQuery( 'div.mythemes-header.parallax-container' ).hasClass( 'hide' ) ){
                                jQuery( 'div.mythemes-header.parallax-container' ).addClass( 'hide' );
                            }

                            if( !jQuery( 'body > header' ).hasClass( 'mythemes-miss-header-image' ) ){
                                jQuery( 'body > header' ).addClass( 'mythemes-miss-header-image' );
                            }
                        }

                        ;(function($){
                            $(function(){
                                $('.parallax').parallax();
                            });
                        })(jQuery);
                    }
                });
            });

            wp.customize( 'mythemes-header-templates' , function( value ){
                value.bind(function( newval ){
                    if( jQuery( 'div.mythemes-header.parallax-container' ).hasClass( 'on-templates' ) ){
                        if( newval ){
                            if( jQuery( 'div.mythemes-header.parallax-container' ).hasClass( 'hide' ) ){
                                jQuery( 'div.mythemes-header.parallax-container' ).removeClass( 'hide' );
                            }

                            if( jQuery( 'body > header' ).hasClass( 'mythemes-miss-header-image' ) ){
                                jQuery( 'body > header' ).removeClass( 'mythemes-miss-header-image' );
                            }
                        }
                        else{
                            if( !jQuery( 'div.mythemes-header.parallax-container' ).hasClass( 'hide' ) ){
                                jQuery( 'div.mythemes-header.parallax-container' ).addClass( 'hide' );
                            }

                            if( !jQuery( 'body > header' ).hasClass( 'mythemes-miss-header-image' ) ){
                                jQuery( 'body > header' ).addClass( 'mythemes-miss-header-image' );
                            }
                        }

                        ;(function($){
                            $(function(){
                                $('.parallax').parallax();
                            });
                        })(jQuery);
                    }
                });
            });

            wp.customize( 'mythemes-header-single-posts' , function( value ){
                value.bind(function( newval ){
                    if( jQuery( 'div.mythemes-header.parallax-container' ).hasClass( 'on-single-posts' ) ){
                        if( newval ){
                            if( jQuery( 'div.mythemes-header.parallax-container' ).hasClass( 'hide' ) ){
                                jQuery( 'div.mythemes-header.parallax-container' ).removeClass( 'hide' );
                            }

                            if( jQuery( 'body > header' ).hasClass( 'mythemes-miss-header-image' ) ){
                                jQuery( 'body > header' ).removeClass( 'mythemes-miss-header-image' );
                            }
                        }
                        else{
                            if( !jQuery( 'div.mythemes-header.parallax-container' ).hasClass( 'hide' ) ){
                                jQuery( 'div.mythemes-header.parallax-container' ).addClass( 'hide' );
                            }

                            if( !jQuery( 'body > header' ).hasClass( 'mythemes-miss-header-image' ) ){
                                jQuery( 'body > header' ).addClass( 'mythemes-miss-header-image' );
                            }
                        }

                        ;(function($){
                            $(function(){
                                $('.parallax').parallax();
                            });
                        })(jQuery);
                    }
                });
            });

            wp.customize( 'mythemes-header-single-pages' , function( value ){
                value.bind(function( newval ){
                    if( jQuery( 'div.mythemes-header.parallax-container' ).hasClass( 'on-single-pages' ) ){
                        if( newval ){
                            if( jQuery( 'div.mythemes-header.parallax-container' ).hasClass( 'hide' ) ){
                                jQuery( 'div.mythemes-header.parallax-container' ).removeClass( 'hide' );
                            }

                            if( jQuery( 'body > header' ).hasClass( 'mythemes-miss-header-image' ) ){
                                jQuery( 'body > header' ).removeClass( 'mythemes-miss-header-image' );
                            }
                        }
                        else{
                            if( !jQuery( 'div.mythemes-header.parallax-container' ).hasClass( 'hidde' ) ){
                                jQuery( 'div.mythemes-header.parallax-container' ).addClass( 'hide' );
                            }

                            if( !jQuery( 'body > header' ).hasClass( 'mythemes-miss-header-image' ) ){
                                jQuery( 'body > header' ).addClass( 'mythemes-miss-header-image' );
                            }
                        }

                        ;(function($){
                            $(function(){
                                $('.parallax').parallax();
                            });
                        })(jQuery);
                    }
                });
            });

            wp.customize( 'mythemes-header-height' , function( value ){
                value.bind(function( newval ){
                    jQuery( 'div.mythemes-header.parallax-container' ).css( 'height' , parseInt( newval ).toString() + 'px' );
                });
            });

            wp.customize( 'mythemes-header-image' , function( value ){
                value.bind(function( newval ){
                    if( jQuery( '.mythemes-header.parallax-container div.parallax img' ).length ){
                        jQuery( '.mythemes-header.parallax-container div.parallax img' ).attr( 'src' , newval );
                    }
                    else{
                        jQuery( '.mythemes-header.parallax-container div.parallax' ).html( '<img src="' + newval + '"/>' );
                    }

                    ;(function($){
                        $(function(){
                            $('.parallax').parallax();
                        });
                    })(jQuery);
                });
            });

            wp.customize( 'mythemes-header-background-color' , function( value ){
                value.bind(function( newval ){
                    jQuery( 'body' ).css( 'background-color' , newval );
                    jQuery( 'body' ).css( 'backgroundColor' , newval );
                });
            });

            wp.customize( 'mythemes-header-mask-color' , function( value ){
                value.bind(function( newval ){
                    var opacity = parseFloat( wp.customize.instance( 'mythemes-header-mask-opacity' ).get() / 100 ).toString();
                    jQuery( 'div.mythemes-header div.valign-cell-wrapper' ).css( 'background-color' , 'rgba(' + mythemes_hex2rgb( newval ) + ' , ' + opacity + ')' );
                });
            });

            wp.customize( 'mythemes-header-mask-opacity' , function( value ){
                value.bind(function( newval ){
                    var opacity = parseFloat( newval / 100 ).toString();
                    var color   = wp.customize.instance( 'mythemes-header-mask-color' ).get().toString();
                    jQuery( 'div.mythemes-header div.valign-cell-wrapper' ).css( 'background-color' , 'rgba(' + mythemes_hex2rgb( color ) + ' , ' + opacity + ')' );
                });
            });
        }

        {   //- CONTENT -//

            {   //- TITLE COLOR
                wp.customize( 'mythemes-header-title-label' , function( value ){
                    value.bind(function( newval ){
                        if( newval ){
                            jQuery( '.mythemes-header a.header-title' ).html( newval );
                        }
                    });
                });
                wp.customize( 'mythemes-header-title' , function( value ){
                    value.bind(function( newval ){
                    	if( newval ){
                    		if( jQuery( '.mythemes-header a.header-title' ).hasClass( 'hide' ) ){
                    			jQuery( '.mythemes-header a.header-title' ).removeClass( 'hide' );
                    		}
                    	}
                    	else{
                    		if( !jQuery( '.mythemes-header a.header-title' ).hasClass( 'hide' ) ){
                    			jQuery( '.mythemes-header a.header-title' ).addClass( 'hide' );
                    		}	
                    	}
                    });
                });
                wp.customize( 'mythemes-header-title-color', function( value ){
                    value.bind(function( newval ){
                        jQuery( 'style#mythemes-header-title-color' ).html(
                            'div.mythemes-header a.header-title{' +
                            'color: ' + newval + ';' +
                            '}'
                        );
                    });
                });
            }

            {   //- DESCRIPTION COLOR -//

                wp.customize( 'mythemes-header-description-label' , function( value ){
                    value.bind(function( newval ){
                        if( newval ){
                            jQuery( '.mythemes-header a.header-description' ).html( newval );
                        }
                    });
                });
                wp.customize( 'mythemes-header-description' , function( value ){
                    value.bind(function( newval ){
                    	if( newval ){
                    		if( jQuery( '.mythemes-header a.header-description' ).hasClass( 'hide' ) ){
                    			jQuery( '.mythemes-header a.header-description' ).removeClass( 'hide' );
                    		}
                    	}
                    	else{
                    		if( !jQuery( '.mythemes-header a.header-description' ).hasClass( 'hide' ) ){
                    			jQuery( '.mythemes-header a.header-description' ).addClass( 'hide' );
                    		}	
                    	}
                    });
                });
                wp.customize( 'mythemes-header-description-color', function( value ){
                    value.bind(function( newval ){

                        var hex     = newval;
                        var rgba1   = 'rgba( ' + mythemes_hex2rgb( hex ) + ', 0.55 )';
                        var rgba2   = 'rgba( ' + mythemes_hex2rgb( hex ) + ', 1.0 )';

                        jQuery( 'style#mythemes-header-description-color' ).html(
                            'div.mythemes-header a.header-description{' +
                            'color: ' + rgba1 + ';' +
                            '}' +

                            'div.mythemes-header a.header-description:hover{' +
                            'color: ' + rgba2 + ';' +
                            '}'
                        );
                    });
                });
            }
        }


        {   //- FIRST BUTTON -//

            wp.customize( 'mythemes-first-btn' , function( value ){
                value.bind(function( newval ){
                    if( newval ){
                        if( jQuery( 'div.mythemes-header-buttons a.mythemes-first-button' ).hasClass( 'hide' ) ){
                            jQuery( 'div.mythemes-header-buttons a.mythemes-first-button' ).removeClass( 'hide' );
                        }
                    }
                    else{
                        if( !jQuery( 'div.mythemes-header-buttons a.mythemes-first-button' ).hasClass( 'hide' ) ){
                            jQuery( 'div.mythemes-header-buttons a.mythemes-first-button' ).addClass( 'hide' );
                        }   
                    }
                });
            });
            wp.customize( 'mythemes-first-btn-color' , function( value ){
                value.bind(function( newval ){
                    jQuery( 'style#mythemes-first-btn-color' ).html(
                        'div.mythemes-header.parallax-container div.mythemes-header-buttons a.btn-large.mythemes-first-button{' +
                        'color: ' + newval + ';' +
                        '}'
                    );
                });
            });
            wp.customize( 'mythemes-first-btn-bkg-color' , function( value ){
                value.bind(function( newval ){
                    jQuery( 'style#mythemes-first-btn-bkg-color' ).html(
                        'div.mythemes-header.parallax-container div.mythemes-header-buttons a.btn-large.mythemes-first-button{' +
                        'background-color: ' + newval + ';' +
                        '}'
                    );
                });
            });
            wp.customize( 'mythemes-first-btn-bkg-h-color' , function( value ){
                value.bind(function( newval ){
                    jQuery( 'style#mythemes-first-btn-bkg-h-color' ).html(
                        'div.mythemes-header.parallax-container div.mythemes-header-buttons a.btn-large.mythemes-first-button:hover{' +
                        'background-color: ' + newval + ';' +
                        '}'
                    );
                });
            });
            wp.customize( 'mythemes-first-btn-url' , function( value ){
                value.bind(function( newval ){
                    jQuery( 'div.mythemes-header-buttons a.mythemes-first-button' ).attr( 'href' , newval );
                });
            });
            wp.customize( 'mythemes-first-btn-label' , function( value ){
                value.bind(function( newval ){
                    jQuery( 'div.mythemes-header-buttons a.mythemes-first-button' ).html( newval );
                });
            });
            wp.customize( 'mythemes-first-btn-description' , function( value ){
                value.bind(function( newval ){
                    jQuery( 'div.mythemes-header-buttons a.mythemes-first-button' ).attr( 'title' , newval );
                });
            });
        }

        {   //- SECOND BUTTON -//

            wp.customize( 'mythemes-second-btn' , function( value ){
                value.bind(function( newval ){
                    if( newval ){
                        if( jQuery( 'div.mythemes-header-buttons a.mythemes-second-button' ).hasClass( 'hide' ) ){
                            jQuery( 'div.mythemes-header-buttons a.mythemes-second-button' ).removeClass( 'hide' );
                        }
                    }
                    else{
                        if( !jQuery( 'div.mythemes-header-buttons a.mythemes-second-button' ).hasClass( 'hide' ) ){
                            jQuery( 'div.mythemes-header-buttons a.mythemes-second-button' ).addClass( 'hide' );
                        }   
                    }
                });
            });
            wp.customize( 'mythemes-second-btn-color' , function( value ){
                value.bind(function( newval ){
                    jQuery( 'style#mythemes-second-btn-color' ).html(
                        'div.mythemes-header.parallax-container div.mythemes-header-buttons a.btn-large.mythemes-second-button{' +
                        'color: ' + newval + ';' +
                        '}'
                    );
                });
            });
            wp.customize( 'mythemes-second-btn-bkg-color' , function( value ){
                value.bind(function( newval ){
                    jQuery( 'style#mythemes-second-btn-bkg-color' ).html(
                        'div.mythemes-header.parallax-container div.mythemes-header-buttons a.btn-large.mythemes-second-button{' +
                        'background-color: ' + newval + ';' +
                        '}'
                    );
                });
            });
            wp.customize( 'mythemes-second-btn-bkg-h-color' , function( value ){
                value.bind(function( newval ){
                    jQuery( 'style#mythemes-second-btn-bkg-h-color' ).html(
                        'div.mythemes-header.parallax-container div.mythemes-header-buttons a.btn-large.mythemes-second-button:hover{' +
                        'background-color: ' + newval + ';' +
                        '}'
                    );
                });
            });
            wp.customize( 'mythemes-second-btn-url' , function( value ){
                value.bind(function( newval ){
                    jQuery( 'div.mythemes-header-buttons a.mythemes-second-button' ).attr( 'href' , newval );
                });
            });
            wp.customize( 'mythemes-second-btn-label' , function( value ){
                value.bind(function( newval ){
                    jQuery( 'div.mythemes-header-buttons a.mythemes-second-button' ).html( newval );
                });
            });
            wp.customize( 'mythemes-second-btn-description' , function( value ){
                value.bind(function( newval ){
                    jQuery( 'div.mythemes-header-buttons a.mythemes-second-button' ).attr( 'title' , newval );
                });
            });
        }
    }


    {   //- BREADCRUMBS -//

    	wp.customize( 'mythemes-breadcrumbs' , function( value ){
            value.bind(function( newval ){

            	if( newval ){
            		jQuery( 'div.mythemes-page-header' ).show();
            	}
            	else{
            		jQuery( 'div.mythemes-page-header' ).hide();	
            	}
            });
        });
        wp.customize( 'mythemes-home-label' , function( value ){
            value.bind(function( newval ){
            	jQuery( 'div.mythemes-page-header li#home-label a span' ).html( newval );
            });
        });
        wp.customize( 'mythemes-home-link-description' , function( value ){
            value.bind(function( newval ){
                jQuery( 'div.mythemes-page-header li#home-label a' ).attr( 'title' , newval );
            });
        });
        wp.customize( 'mythemes-breadcrumbs-space' , function( value ){
            value.bind(function( newval ){
            	jQuery( 'div.mythemes-page-header' ).css({ 'padding-top' : newval + 'px' , 'padding-bottom' : newval + 'px' });
            });
        });
    }

    {   /* ADDITIONAL */

        wp.customize( 'mythemes-blog-title' , function( value ){
            value.bind(function( newval ){
            	jQuery( 'div.mythemes-page-header h1#blog-title' ).html( newval );
            });
        });
        
        wp.customize( 'mythemes-default-content' , function( value ){
            value.bind(function( newval ){
                if( newval ){
                    if( jQuery( 'div.mythemes-default-content' ).hasClass( 'hide' ) ){
                        jQuery( 'div.mythemes-default-content' ).removeClass( 'hide' );
                    }

                    /* HEADER WIDGETS */
                    if( jQuery( 'div.mythemes-white.mythemes-default-content aside > div' ).find( 'div.mythemes-default-content' ).length ){
                        if( jQuery( 'div.mythemes-white.mythemes-default-content' ).hasClass( 'hide' ) ){
                            jQuery( 'div.mythemes-white.mythemes-default-content' ).removeClass( 'hide' );
                        }
                    }

                    /* FOOTER WIDGETS */
                    if( jQuery( 'footer aside.mythemes-default-content div.container div.row > div' ).find( 'div.mythemes-default-content' ).length ){
                        if( jQuery( 'footer aside.mythemes-default-content' ).hasClass( 'hide' ) ){
                            jQuery( 'footer aside.mythemes-default-content' ).removeClass( 'hide' );
                        }
                    }
                }
                else{
                    if( !jQuery( 'div.mythemes-default-content' ).hasClass( 'hide' ) ){
                        jQuery( 'div.mythemes-default-content' ).addClass( 'hide' );
                    }

                    /* HEADER WIDGETS */
                    if( !jQuery( 'div.mythemes-white.mythemes-default-content aside > div' ).find( 'div.mythemes-default-content' ).length ){
                        if( jQuery( 'div.mythemes-white.mythemes-default-content' ).hasClass( 'hide' ) ){
                            jQuery( 'div.mythemes-white.mythemes-default-content' ).removeClass( 'hide' );
                        }
                    }

                    else if( jQuery( 'div.mythemes-white.mythemes-default-content aside > div' ).find( 'div.mythemes-default-content' ).length == 3 ){
                        if( !jQuery( 'div.mythemes-white.mythemes-default-content' ).hasClass( 'hide' ) ){
                            jQuery( 'div.mythemes-white.mythemes-default-content' ).addClass( 'hide' );
                        }
                    }

                    /* FOOTER WIDGETS */
                    if( !jQuery( 'footer aside.mythemes-default-content div.container div.row > div' ).find( 'div.mythemes-default-content' ).length ){
                        if( jQuery( 'div.content aside.mythemes-default-content' ).hasClass( 'hide' ) ){
                            jQuery( 'div.content aside.mythemes-default-content' ).removeClass( 'hide' );
                        }
                    }

                    else if( jQuery( 'footer aside.mythemes-default-content div.container div.row > div' ).find( 'div.mythemes-default-content' ).length == 3 ){
                        if( !jQuery( 'footer aside.mythemes-default-content' ).hasClass( 'hide' ) ){
                            jQuery( 'footer aside.mythemes-default-content' ).addClass( 'hide' );
                        }
                    }
                }
            });
        });

        wp.customize( 'mythemes-top-meta' , function( value ){
            value.bind(function( newval ){

            	if( newval ){
            		jQuery( 'div.mythemes-top-meta' ).show();
            	}
            	else{
            		jQuery( 'div.mythemes-top-meta' ).hide();	
            	}
            });
        });

        wp.customize( 'mythemes-bottom-meta' , function( value ){
            value.bind(function( newval ){

            	if( newval ){
            		jQuery( 'div.post-meta-terms' ).show();
            	}
            	else{
            		jQuery( 'div.post-meta-terms' ).hide();	
            	}
            });
        });

        wp.customize( 'mythemes-html-suggestions' , function( value ){
            value.bind(function( newval ){

            	if( newval ){
            		jQuery( 'div.mythemes-html-suggestions' ).show();
            	}
            	else{
            		jQuery( 'div.mythemes-html-suggestions' ).hide();	
            	}
            });
        });
    }

    
    {   //- LAYOUT -//

        {   //- GENERAL -//

            wp.customize( 'mythemes-layout' , function( value ){
                value.bind(function( newval ){

                    if( jQuery( 'div.content > div.container > div.row > section' ).hasClass( 'mythemes-classic' ) ){

                        var sidebar = wp.customize.instance( 'mythemes-sidebar' ).get().toString();

                        if( newval == 'left' || newval == 'right' ){
                            mythemes_load_sidebar( sidebar, newval );
                        }
                        else{
                            jQuery( 'div.content > div.container > div.row aside' ).addClass( 'hide' );
                            jQuery( 'div.content > div.container > div.row section' ).removeAttr( 'class' );
                            jQuery( 'div.content > div.container > div.row section' ).addClass( 'col s12 m12 l12 mythemes-classic' );

                            _mythemes_masonry.init( 'div.mythemes-gallery', function(){
                                jQuery( 'div.mythemes-gallery' ).masonry();
                            });
                        }
                    }

                });
            });
            wp.customize( 'mythemes-sidebar' , function( value ){
                value.bind(function( newval ){

                    if( jQuery( 'div.content > div.container > div.row > section' ).hasClass( 'mythemes-classic' ) ){

                        var layout = wp.customize.instance( 'mythemes-layout' ).get().toString();

                        if( layout == 'left' || layout == 'right' ){
                            mythemes_load_sidebar( newval, layout );
                        }
                        else{
                            jQuery( 'div.content > div.container > div.row aside' ).addClass( 'hide' );
                            jQuery( 'div.content > div.container > div.row section' ).removeAttr( 'class' );
                            jQuery( 'div.content > div.container > div.row section' ).addClass( 'col s12 m12 l12 mythemes-classic' );

                            _mythemes_masonry.init( 'div.mythemes-gallery', function(){
                                jQuery( 'div.mythemes-gallery' ).masonry();
                            });
                        }
                    }
                });
            });
        }


        {   //- FRONT PAGE -//

            wp.customize( 'mythemes-front-page-layout' , function( value ){
                value.bind(function( newval ){

                    var id = wp.customize.instance( 'mythemes-special-page' ).get().toString();
                    
                    if( jQuery( 'body' ).hasClass( 'page-id-' + id ) ){
                        return;
                    }

                    if( jQuery( 'body' ).hasClass( 'home' ) && jQuery( 'body' ).hasClass( 'page' ) ){

                        var sidebar = wp.customize.instance( 'mythemes-front-page-sidebar' ).get().toString();

                        if( newval == 'left' || newval == 'right' ){
                            mythemes_load_sidebar( sidebar, newval );
                        }
                        else{
                            jQuery( 'div.content > div.container > div.row aside' ).addClass( 'hide' );
                            jQuery( 'div.content > div.container > div.row section' ).removeAttr( 'class' );
                            jQuery( 'div.content > div.container > div.row section' ).addClass( 'col s12 m12 l12 mythemes-classic' );

                            _mythemes_masonry.init( 'div.mythemes-gallery', function(){
                                jQuery( 'div.mythemes-gallery' ).masonry();
                            });
                        }
                    }
                });
            });
            wp.customize( 'mythemes-front-page-sidebar' , function( value ){
                value.bind(function( newval ){

                    var id = wp.customize.instance( 'mythemes-special-page' ).get().toString();
                    
                    if( jQuery( 'body' ).hasClass( 'page-id-' + id ) ){
                        return;
                    }

                    if( jQuery( 'body' ).hasClass( 'home' ) && jQuery( 'body' ).hasClass( 'page' ) ){

                        var layout = wp.customize.instance( 'mythemes-front-page-layout' ).get().toString();

                        if( layout == 'left' || layout == 'right' ){
                            mythemes_load_sidebar( newval, layout );
                        }
                        else{
                            jQuery( 'div.content > div.container > div.row aside' ).addClass( 'hide' );
                            jQuery( 'div.content > div.container > div.row section' ).removeAttr( 'class' );
                            jQuery( 'div.content > div.container > div.row section' ).addClass( 'col s12 m12 l12 mythemes-classic' );

                            _mythemes_masonry.init( 'div.mythemes-gallery', function(){
                                jQuery( 'div.mythemes-gallery' ).masonry();
                            });
                        }
                    }
                });
            });
        }


        {   //- PAGE -//

            wp.customize( 'mythemes-page-layout' , function( value ){
                value.bind(function( newval ){

                    lg( [ newval, sidebar ] );

                    var id = wp.customize.instance( 'mythemes-special-page' ).get().toString();

                    if( jQuery( 'body' ).hasClass( 'page-id-' + id ) ){
                        return;
                    }

                    if( !jQuery( 'body' ).hasClass( 'home' ) && jQuery( 'body' ).hasClass( 'page' ) ){

                        var sidebar = wp.customize.instance( 'mythemes-page-sidebar' ).get().toString();

                        if( newval == 'left' || newval == 'right' ){
                            mythemes_load_sidebar( sidebar, newval );
                        }
                        else{
                            jQuery( 'div.content > div.container > div.row aside' ).addClass( 'hide' );
                            jQuery( 'div.content > div.container > div.row section' ).removeAttr( 'class' );
                            jQuery( 'div.content > div.container > div.row section' ).addClass( 'col s12 m12 l12 mythemes-classic' );

                            _mythemes_masonry.init( 'div.mythemes-gallery', function(){
                                jQuery( 'div.mythemes-gallery' ).masonry();
                            });
                        }
                    }
                });
            });
            wp.customize( 'mythemes-page-sidebar' , function( value ){
                value.bind(function( newval ){

                    var id = wp.customize.instance( 'mythemes-special-page' ).get().toString();

                    if( jQuery( 'body' ).hasClass( 'page-id-' + id ) ){
                        return;
                    }

                    if( !jQuery( 'body' ).hasClass( 'home' ) && jQuery( 'body' ).hasClass( 'page' ) ){

                        var layout = wp.customize.instance( 'mythemes-page-layout' ).get().toString();

                        if( layout == 'left' || layout == 'right' ){
                            mythemes_load_sidebar( newval, layout );
                        }
                        else{
                            jQuery( 'div.content > div.container > div.row aside' ).addClass( 'hide' );
                            jQuery( 'div.content > div.container > div.row section' ).removeAttr( 'class' );
                            jQuery( 'div.content > div.container > div.row section' ).addClass( 'col s12 m12 l12 mythemes-classic' );

                            _mythemes_masonry.init( 'div.mythemes-gallery', function(){
                                jQuery( 'div.mythemes-gallery' ).masonry();
                            });
                        }
                    }
                });
            });
        }


        {   //- POST LAYOUT -//

            wp.customize( 'mythemes-post-layout' , function( value ){
                value.bind(function( newval ){

                    if( jQuery( 'body' ).hasClass( 'single' ) ){

                        var sidebar = wp.customize.instance( 'mythemes-post-sidebar' ).get().toString();

                        if( newval == 'left' || newval == 'right' ){
                            mythemes_load_sidebar( sidebar, newval );
                        }
                        else{
                            jQuery( 'div.content > div.container > div.row aside' ).addClass( 'hide' );
                            jQuery( 'div.content > div.container > div.row section' ).removeAttr( 'class' );
                            jQuery( 'div.content > div.container > div.row section' ).addClass( 'col s12 m12 l12 mythemes-classic' );

                            _mythemes_masonry.init( 'div.mythemes-gallery', function(){
                                jQuery( 'div.mythemes-gallery' ).masonry();
                            });
                        }
                    }
                });
            });
            wp.customize( 'mythemes-post-sidebar' , function( value ){
                value.bind(function( newval ){

                    if( jQuery( 'body' ).hasClass( 'single' ) ){

                        var layout = wp.customize.instance( 'mythemes-post-layout' ).get().toString();

                        if( layout == 'left' || layout == 'right' ){
                            mythemes_load_sidebar( newval, layout );
                        }
                        else{
                            jQuery( 'div.content > div.container > div.row aside' ).addClass( 'hide' );
                            jQuery( 'div.content > div.container > div.row section' ).removeAttr( 'class' );
                            jQuery( 'div.content > div.container > div.row section' ).addClass( 'col s12 m12 l12 mythemes-classic' );

                            _mythemes_masonry.init( 'div.mythemes-gallery', function(){
                                jQuery( 'div.mythemes-gallery' ).masonry();
                            });
                        }
                    }
                });
            });
        }

        {   //- SPECIAL PAGE -//

            wp.customize( 'mythemes-special-page' , function( value ){
                value.bind(function( newval ){

                    var id = newval;

                    if( id == '0' ){
                        return;
                    }

                    if( !jQuery( 'body' ).hasClass( 'home' ) && jQuery( 'body' ).hasClass( 'page' ) && jQuery( 'body' ).hasClass( 'page-id-' + id ) ){

                        var sidebar = wp.customize.instance( 'mythemes-special-page-sidebar' ).get().toString();
                        var layout  = wp.customize.instance( 'mythemes-special-page-layout' ).get().toString();

                        if( layout == 'left' || layout == 'right' ){
                            mythemes_load_sidebar( sidebar, layout );
                        }
                        else{
                            jQuery( 'div.content > div.container > div.row aside' ).addClass( 'hide' );
                            jQuery( 'div.content > div.container > div.row section' ).removeAttr( 'class' );
                            jQuery( 'div.content > div.container > div.row section' ).addClass( 'col s12 m12 l12 mythemes-classic' );

                            _mythemes_masonry.init( 'div.mythemes-gallery', function(){
                                jQuery( 'div.mythemes-gallery' ).masonry();
                            });
                        }
                    }
                });
            });
            wp.customize( 'mythemes-special-page-layout' , function( value ){
                value.bind(function( newval ){

                    var id = wp.customize.instance( 'mythemes-special-page' ).get().toString();

                    if( id == '0' ){
                        return;
                    }

                    if( !jQuery( 'body' ).hasClass( 'home' ) && jQuery( 'body' ).hasClass( 'page' ) && jQuery( 'body' ).hasClass( 'page-id-' + id ) ){

                        var sidebar = wp.customize.instance( 'mythemes-special-page-sidebar' ).get().toString();

                        if( newval == 'left' || newval == 'right' ){
                            mythemes_load_sidebar( sidebar, newval );
                        }
                        else{
                            jQuery( 'div.content > div.container > div.row aside' ).addClass( 'hide' );
                            jQuery( 'div.content > div.container > div.row section' ).removeAttr( 'class' );
                            jQuery( 'div.content > div.container > div.row section' ).addClass( 'col s12 m12 l12 mythemes-classic' );

                            _mythemes_masonry.init( 'div.mythemes-gallery', function(){
                                jQuery( 'div.mythemes-gallery' ).masonry();
                            });
                        }
                    }
                });
            });
            wp.customize( 'mythemes-special-page-sidebar' , function( value ){
                value.bind(function( newval ){

                    var id = wp.customize.instance( 'mythemes-special-page' ).get().toString();

                    if( id == '0' ){
                        return;
                    }

                    if( !jQuery( 'body' ).hasClass( 'home' ) && jQuery( 'body' ).hasClass( 'page' ) && jQuery( 'body' ).hasClass( 'page-id-' + id ) ){

                        var layout = wp.customize.instance( 'mythemes-special-page-layout' ).get().toString();

                        if( layout == 'left' || layout == 'right' ){
                            mythemes_load_sidebar( newval, layout );
                        }
                        else{
                            jQuery( 'div.content > div.container > div.row aside' ).addClass( 'hide' );
                            jQuery( 'div.content > div.container > div.row section' ).removeAttr( 'class' );
                            jQuery( 'div.content > div.container > div.row section' ).addClass( 'col s12 m12 l12 mythemes-classic' );

                            _mythemes_masonry.init( 'div.mythemes-gallery', function(){
                                jQuery( 'div.mythemes-gallery' ).masonry();
                            });
                        }
                    }
                });
            });
        }
    }
    

    {   //- SOCIAL -//

        wp.customize( 'mythemes-vimeo' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-vimeo' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-vimeo' ).removeClass( 'hide' );	
            		}
            		
            		jQuery( 'div.mythemes-social a.icon-vimeo' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-vimeo' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-vimeo' ).addClass( 'hide' );	
            		}
            	}
            });
        });

        wp.customize( 'mythemes-twitter' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-twitter' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-twitter' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-twitter' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-twitter' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-twitter' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-skype' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-skype' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-skype' ).removeClass( 'hide' );	
            		}
            		
            		jQuery( 'div.mythemes-social a.icon-skype' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-skype' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-skype' ).addClass( 'hide' );	
            		}
            	}
            });
        });

        wp.customize( 'mythemes-renren' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-renren' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-renren' ).removeClass( 'hide' );
            		}
            		
            		jQuery( 'div.mythemes-social a.icon-renren' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-renren' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-renren' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-github' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-github' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-github' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-github' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-github' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-github' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-rdio' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-rdio' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-rdio' ).removeClass( 'hide' );
            		}
            		
            		jQuery( 'div.mythemes-social a.icon-rdio' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-rdio' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-rdio' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-linkedin' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-linkedin' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-linkedin' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-linkedin' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-linkedin' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-linkedin' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-behance' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-behance' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-behance' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-behance' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-behance' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-behance' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-dropbox' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-dropbox' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-dropbox' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-dropbox' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-dropbox' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-dropbox' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-flickr' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-flickr' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-flickr' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-flickr' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-flickr' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-flickr' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-tumblr' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-tumblr' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-tumblr' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-tumblr' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-tumblr' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-tumblr' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-instagram' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-instagram' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-instagram' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-instagram' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-instagram' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-instagram' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-vkontakte' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-vkontakte' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-vkontakte' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-vkontakte' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-vkontakte' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-vkontakte' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-facebook' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-facebook' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-facebook' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-facebook' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-facebook' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-facebook' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-evernote' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-evernote' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-evernote' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-evernote' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-evernote' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-evernote' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-flattr' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-flattr' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-flattr' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-flattr' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-flattr' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-flattr' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-picasa' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-picasa' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-picasa' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-picasa' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-picasa' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-picasa' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-dribbble' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-dribbble' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-dribbble' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-dribbble' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-dribbble' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-dribbble' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-mixi' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-mixi' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-mixi' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-mixi' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-mixi' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-mixi' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-stumbleupon' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-stumbleupon' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-stumbleupon' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-stumbleupon' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-stumbleupon' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-stumbleupon' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-lastfm' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-lastfm' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-lastfm' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-lastfm' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-lastfm' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-lastfm' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-gplus' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-gplus' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-gplus' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-gplus' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-gplus' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-gplus' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-google-circles' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-google-circles' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-google-circles' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-google-circles' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-google-circles' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-google-circles' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-pinterest' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-pinterest' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-pinterest' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-pinterest' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-pinterest' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-pinterest' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-smashing' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-smashing' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-smashing' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-smashing' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-smashing' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-smashing' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-soundcloud' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-soundcloud' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-soundcloud' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-soundcloud' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-soundcloud' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-soundcloud' ).addClass( 'hide' );
            		}
            	}
            });
        });

        wp.customize( 'mythemes-rss' , function( value ){
            value.bind(function( newval ){
            	if( newval.length ){
            		if( jQuery( 'div.mythemes-social a.icon-rss' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-rss' ).removeClass( 'hide' );
            		}

            		jQuery( 'div.mythemes-social a.icon-rss' ).attr( 'href' , newval );
            	}
            	else{
            		if( !jQuery( 'div.mythemes-social a.icon-rss' ).hasClass( 'hide' ) ){
            			jQuery( 'div.mythemes-social a.icon-rss' ).addClass( 'hide' );
            		}
            	}
            });
        });
    }


    {   //- OTHERS -//

        wp.customize( 'mythemes-custom-css' , function( value ){
            value.bind(function( newval ){
            	jQuery( 'style#mythemes-custom-css' ).html( newval );
            });
        });

        wp.customize( 'mythemes-copyright' , function( value ){
            value.bind(function( newval ){
            	jQuery( 'div.mythemes-copyright span.copyright' ).html( newval );
            });
        });
    }


    {   //- COLORS -//

        wp.customize( 'background_color' , function( value ){
            value.bind(function( newval ){

                var bg_color        = newval;
                var bg_color_rgba   = 'rgba( ' + mythemes_hex2rgb( newval ) + ' , 0.91 )';
                jQuery( 'style#mythemes-custom-style-background' ).html(

                    /* BACKGROUND COLOR */
                    'body > div.content{' +
                    'background-color: ' + bg_color + ';' +
                    '}' +

                    /* MENU NAVIGATION */
                    /* BACKGROUND COLOR */
                    'body.scroll-nav .mythemes-poor{' +
                    'background-color: ' + bg_color_rgba + ';' +
                    '}' +

                    '.mythemes-poor{' +
                    'background-color: ' + bg_color + ';' +
                    '}'
                );
            });
        });
    }


    {   //- BACKGROUND IMAGE -//

        wp.customize( 'background_image' , function( value ){
            value.bind(function( newval ){
                console.log( newval );
                jQuery( 'body > div.content' ).css( 'background-image' , 'url(' + newval + ')' );
            });
        });

        wp.customize( 'background_repeat' , function( value ){
            value.bind(function( newval ){
                console.log( newval );
                jQuery( 'body > div.content' ).css( 'background-repeat' , newval );
            });
        });

        wp.customize( 'background_position_x' , function( value ){
            value.bind(function( newval ){
                console.log( newval );
                jQuery( 'body > div.content' ).css( 'background-position' , newval );
            });
        });

        wp.customize( 'background_attachment' , function( value ){
            value.bind(function( newval ){
                console.log( newval );
                jQuery( 'body > div.content' ).css( 'background-attachment' , newval );
            });
        });
    }

})(jQuery);