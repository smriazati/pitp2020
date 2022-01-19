// from https://stackoverflow.com/questions/9899372/pure-javascript-equivalent-of-jquerys-ready-how-to-call-a-function-when-t

function docReady(fn) {
    // see if DOM is already available
    if (document.readyState === "complete" || document.readyState === "interactive") {
        // call on next available tick
        setTimeout(fn, 1);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }


}    


docReady(function() {
    dynamicHeader();
    makeLinksExternal();
    fadeInMain();
});

window.onscroll = function() { scrollFunction()} ;

function scrollFunction() {
    dynamicHeader();


    const searchContainer = document.getElementById('header-nav-search');
    const searchForm = searchContainer.querySelector('.search-wrapper');
    positionSearchUnderHeader(searchForm);
}


function dynamicHeader() {
    var scrollPoint = 50;

    if (document.body.scrollTop > scrollPoint || document.documentElement.scrollTop > scrollPoint) {
    flatLogo();
    } else {
    tallLogo();
    }
    
    setMainDynamicMargin();
}

function flatLogo() {
    document.querySelector(".site-header .site-logo a .image-tall").style.display = "none";
    document.querySelector(".site-header .site-logo a .image-flat").style.display = "block";
    // add margin 
}

function tallLogo() {
    document.querySelector(".site-header .site-logo a .image-flat").style.display = "none";
    document.querySelector(".site-header .site-logo a .image-tall").style.display = "block";
}

function isHeaderLoaded() {
    var isHeaderLoaded = document.querySelector(".site-header .site-logo a .image-tall").complete;
    //console.log('header is loaded?', isHeaderLoaded);
    return isHeaderLoaded;
}

function getHeaderHeight() {
    //if (isHeaderLoaded()) {
        var headerHeight = document.querySelector(".site-header").offsetHeight;
        //console.log('header height is', headerHeight);
        return headerHeight + 'px';
    //}
}

function setMainDynamicMargin() {
    if (isHeaderLoaded()) {
        document.querySelector(".site-main").style.marginTop = getHeaderHeight();
    } else {
        document.querySelector(".site-main").style.marginTop = '184px';
    }
    //console.log(getHeaderHeight());
}


// show search
function toggleSearch() {
    const searchContainer = document.getElementById('header-nav-search');
    const searchForm = searchContainer.querySelector('.search-wrapper');
    searchForm.classList.toggle( 'toggled' );

    positionSearchUnderHeader(searchForm);

    var closeBtnDiv = document.createElement("DIV");
    var closeBtn = document.createElement("BUTTON");
    closeBtnDiv.classList.add('close-button');
    closeBtnDiv.appendChild(closeBtn);

    closeBtnDiv.addEventListener("click", function(){
        searchForm.classList.remove('toggled');
    });

    if (searchForm.querySelector('.close-button') === null) {
        searchForm.appendChild(closeBtnDiv);
    }
}

function positionSearchUnderHeader(el) {
    var headerHeight = getHeaderHeight();
    el.style.top = headerHeight;
    //console.log('height is', headerHeight);
}

function fadeInMain() {
    const mainSection = document.querySelector('main');

    var op = 0.1;  // initial opacity
    //element.style.display = 'block';
    var timer = setInterval(function () {
        if (op >= 1){
            clearInterval(timer);
        }
        mainSection.style.opacity = op;
        mainSection.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op += op * 0.2;
    }, 10);
}




function detectTouchDevice() {
	// Touch Device Detection
    var isTouchDevice = 'ontouchstart' in document.documentElement;
    var docBody = document.querySelector('body');
	if( isTouchDevice ) {
		docBody.classList.remove('no-touch');
	}
}

function makeLinksExternal() {
    const wrapper = document.querySelector('.featuredcats');
    const ref = 'prettyinthepines.com';
    if (wrapper) {
      const links = wrapper.querySelectorAll('a');
      if (links) {
        for (let link of links) {
          const href = link.href;
          if (!href.includes(ref)) {
            link.setAttribute('target', '_blank')
          }
        }
      }
    }
}
  