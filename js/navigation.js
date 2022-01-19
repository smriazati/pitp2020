( function() {
	const siteNavigation = document.getElementById( 'site-navigation' );
	const navBP = 1288;
	const menuBtn = siteNavigation.querySelector('.menu-toggle');
	const searchBtn = siteNavigation.querySelector('.mobile-search-toggle');
	const menuBlock = siteNavigation.querySelector('.mobile-menu');
	const searchForm = siteNavigation.querySelector('.mobile-search-form');


	const menu = siteNavigation.getElementsByTagName( 'ul' )[ 0 ];
	if ( ! menu.classList.contains( 'nav-menu' ) ) {
		menu.classList.add( 'nav-menu' );
	}

	// MOBILE MENU - MENU COLLAPSE & MOBILE SEARCH COLLAPSE
	function mobileMenu() {
		searchBtn.style.display = 'block';
		menuBlock.style.display = 'none';
		searchForm.style.display = 'none';

		menuBtn.addEventListener( 'click', function() {
			siteNavigation.classList.toggle( 'toggled' );
			searchForm.style.display = 'none';

			if ( menuBtn.getAttribute( 'aria-expanded' ) === 'true' ) {
				menuBtn.setAttribute( 'aria-expanded', 'false' );
			} else {
				menuBtn.setAttribute( 'aria-expanded', 'true' );
			}

			if (siteNavigation.classList.contains('toggled')) {
				menuBlock.style.display = 'flex';
				searchBtn.style.display = 'none';
			} else {
				menuBlock.style.display = 'none';
				searchBtn.style.display = 'block';
			}

		} );
		searchBtn.addEventListener( 'click', function() {
			siteNavigation.classList.toggle( 'toggled' );
			menuBlock.style.display = 'none';
			
			if ( searchBtn.getAttribute( 'aria-expanded' ) === 'true' ) {
				searchBtn.setAttribute( 'aria-expanded', 'false' );
			} else {
				searchBtn.setAttribute( 'aria-expanded', 'true' );
			}

			if (siteNavigation.classList.contains('toggled')) {
				searchForm.style.display = 'flex';
				searchBtn.style.display = 'none';
			} else {
				searchForm.style.display = 'none';
				searchBtn.style.display = 'block';
			}
		} );
	}	// end mobile menu 


	// POSITION DROPDOWN MENUS IN THE CENTER
	function positionDropdowns() {
		const dropdownContainers = document.querySelectorAll(".site-header .menu-item-has-children");
		// console.log(dropdownContainers);
		for (const dropdownContainer of dropdownContainers) {
			const dcWidth = dropdownContainer.clientWidth;
			const dcHeight = dropdownContainer.clientHeight;
			const dropdown = dropdownContainer.querySelector('.sub-menu');
			dropdown.style.display = 'block';
			const ddWidth = dropdown.offsetWidth;
			dropdown.style.display = 'none';
			// console.log(ddWidth);
			const offset = (ddWidth - dcWidth) / -2;
			//console.log('dcWidth',dcWidth,'dcHeight',dcHeight, 'ddWidth',ddWidth, 'offset',offset);
			dropdown.style.top = `${dcHeight}px`;
			dropdown.style.left = `${offset}px`;
		}
	}


	// SET BREAKPOINT_SPECIFIC FUNCTIONS

	function mobileMenuFunctions() {
		mobileMenu();
	}

	function desktopMenuFunctions() {
		searchBtn.style.display = 'none';
		menuBlock.style.display = 'flex';
		positionDropdowns();
	}


	// UPDATE MENU STATE IF WINDOW RESIZED
	let breakPointCrossed = 0; // 0 - not yet, 1 - crossed to mobile, 2 - crossed to desktop
	let mobileTime, desktopTime;

	function setDesktop() {
		desktopTime = true;
		mobileTime = false;
		desktopMenuFunctions();
		// console.log('desktop menu')
	}

	function setMobile() {
		desktopTime = false;
		mobileTime = true;
		mobileMenuFunctions();
		// console.log('mobile menu')
	}

	// functions to manage state
	function changeToDesktop() {
		breakPointCrossed = 2;
		setDesktop();
		// console.log('changed to desktop');
	}
	function changeToMobile() {
		breakPointCrossed = 1;
		setMobile();
		// console.log('changed to mobile');
	}

	// function to check & change the state
	function checkBreakpoint() {

		if (breakPointCrossed === 0) { // breakpoint has not changed yet 
			if (desktopTime) {  // if init @ desktop and screen gets too small, change it 
				if (window.innerWidth < navBP) { 
					changeToMobile();
				}
			}
			if (mobileTime) {
				if (window.innerWidth > navBP) { // if init @ mobile and screen gets too big, change it 
					changeToDesktop();
				}
			}
		}
		if (breakPointCrossed === 1) { // state is currently mobile, was previously desktop
			if (window.innerWidth > navBP) { // in state 1, if screen gets too big, change it 
				changeToDesktop();
			}
		}
		if (breakPointCrossed === 2) { // state is currently desktop, was previously mobile
			if (window.innerWidth < navBP) { // in state 2, if screen gets too small, change it 
				changeToMobile();
			}
		}
	}

	// initialize state 
	if (window.innerWidth < navBP) {
		setMobile();
	}
	if (window.innerWidth > navBP) {
		setDesktop();
	}

	// check & change state on resize 
	window.onresize = checkBreakpoint;

}() );
