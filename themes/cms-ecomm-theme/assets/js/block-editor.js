console.log('Block Editor');

wp.domReady( function () {
    wp.blocks.unregisterBlockStyle( 'core/quote', 'large' );
    wp.blocks.unregisterBlockStyle( 'core/quote', 'plain' );

    wp.blocks.unregisterBlockStyle('core/image', 'rounded');

    wp.blocks.unregisterBlockStyle('core/social-link', 'pillshape');

    wp.blocks.unregisterBlockStyle('core/separator', 'dots');

    wp.blocks.unregisterBlockType( 'core/navigation' );
} );

