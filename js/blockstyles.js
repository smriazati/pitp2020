// ty: https://soderlind.no/hide-block-styles-in-gutenberg/
// wp.domReady(() => {
// 	// find blocks styles
// 	wp.blocks.getBlockTypes().forEach((block) => {
// 		if (_.isArray(block['styles'])) {
// 			console.log(block.name, _.pluck(block['styles'], 'name'));
// 		}
// 	});
// });


wp.domReady(() => {
	wp.blocks.unregisterBlockStyle('core/image', 'rounded');
	wp.blocks.unregisterBlockStyle('core/button', 'outline');
	wp.blocks.unregisterBlockStyle('core/pullquote', 'solid-color');
	wp.blocks.unregisterBlockStyle('core/separator', 'dots');
} );



// core/image 
// Array [ "default", "rounded" ]
// blockstyles.js:5:12
// core/quote 
// Array [ "default", "large" ]
// blockstyles.js:5:12
// core/button 
// Array [ "fill", "outline" ]
// blockstyles.js:5:12
// core/pullquote 
// Array [ "default", "solid-color" ]
// blockstyles.js:5:12
// core/separator 
// Array(3) [ "default", "wide", "dots" ]
// blockstyles.js:5:12
// core/social-links 
// Array(3) [ "default", "logos-only", "pill-shape" ]
// blockstyles.js:5:12
// core/table 
// Array [ "regular", "stripes" ]