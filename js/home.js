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
  swiperInit();
});


function swiperInit() {
    
    // fewer slides on smaller screens
    var w = window.innerWidth;
    const swiperMedium = 768;
    const swiperTeeny = 500;
    var slidesNum = 5;
    if (w < swiperMedium && w > swiperTeeny) {
      slidesNum = 3;
    } 
    if (w < swiperTeeny) {
      slidesNum = 2;
    } 

    var mySwiper = new Swiper ('.swiper-container', {
      // Optional parameters
      direction: 'horizontal',
      loop: true,
      slidesPerView: slidesNum,

      // Navigation arrows
      navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
      }
      
  });

  console.log(mySwiper.params);
}


{/* <iframe type="text/html" src="https://www.youtube.com/embed/<?php echo get_theme_mod( 'fp-vlog-id')  ?>" frameborder="0"></iframe> */}


function playFeaturedVideo() {
  const wrapper = document.querySelector('.featured-vlog-wrapper');
  const tnail = wrapper.querySelector('.thumbnail')
  const vid = wrapper.querySelector('.vlog-embed-wrapper')
  const vidId = vid.dataset.vlogId;
  const iframeSrc = `https://www.youtube.com/embed/${vidId}?autoplay=1`;
  const iframe = document.createElement('iframe');
  iframe.setAttribute('src', iframeSrc);
  iframe.setAttribute('frameborder', 0);
  iframe.setAttribute('allowfullscreen', true)
  vid.appendChild(iframe);

  tnail.style.display = 'none';
  vid.style.display = 'block';
}
