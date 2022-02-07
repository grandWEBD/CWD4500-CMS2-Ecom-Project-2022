console.log('Block Editor');

/* wp.blocks.registerBlockStyle( 'core/quote', {
    name: 'cms-ecomm-theme-quote',
    label: 'my theme Quote',
} ); */

wp.domReady( function () {
    wp.blocks.unregisterBlockStyle( 'core/quote', 'large' );
    wp.blocks.unregisterBlockStyle( 'core/quote', 'plain' );
} );