
// pinterest share buttons for images 
( function() {

// create buttons
const entry = document.querySelector('.entry-content');
if (entry) {
  const images = entry.querySelectorAll('figure');
  // console.log(images);
 
   for (const figure of images) {
     
     if (!figure.classList.contains('wp-block-embed') && !figure.classList.contains('wp-block-gallery')) {
       const pintButton = document.createElement("a");
       //console.log(pintButton);
       //console.log(pintButton);
       //console.log(figure);
       const img = figure.querySelector("img");
       // const link = figure.querySelector("a");
 
       // if the image is a child of the figure, and the image isn't a broken link
       if (img) {
         if (img.parentNode === figure) {
           //console.log(figure);
           figure.insertBefore(pintButton, img);
           pintButton.classList.add('pinterest-image-share');
           pintButton.setAttribute('target', '_blank');
     
           // add pinterest url to the button
           const url = figure.childNodes[1].baseURI.slice(0, -1).replace(/:/g,"%3A").replace(/\//g,"%2F");
          // console.log(url);
     
           let tnail = ''; 
           if (figure.childNodes[1].attributes.srcset) {
             const tnailOg = figure.childNodes[1].attributes.srcset.value
             const tnailString = tnailOg.substring(0,tnailOg.indexOf(' '));
             tnail = tnailString.replace(/:/g,"%3A").replace(/\//g,"%2F");
           }
           //console.log(tnail);
     
           const desc = document.title.replace(/ /g, "%20").replace(/,/g, "%20");
           //console.log(desc);
     
           const pintApiRequest = 'https://www.pinterest.com/pin/create/button/?url=' + url + '&media=' + tnail + '&description=' + desc;
           //console.log(pintApiRequest);
           pintButton.setAttribute('href', pintApiRequest);
         }
       }
     }
   }
}
  
}() );



function addModal(theFigureClass) {
  const modalCont = document.querySelectorAll( theFigureClass );
  Array.prototype.forEach.call(modalCont, function (pic) {
    //console.log(pic);
    let img = pic.querySelector('img');
    // console.log('img is', img)
    let closeBtn = document.createElement('button');
    closeBtn.classList.add('close-btn')

    if (img) {
      img.addEventListener('click', function() {
        pic.classList.toggle('open-modal');
        pic.insertBefore(closeBtn, img)
  
        // modal styles
        if(pic.classList.contains('open-modal')) {
          let rect = img.getBoundingClientRect();
  
          closeBtn.style.left = `${rect.x + rect.width - closeBtn.offsetWidth - 15}px`;
          closeBtn.style.position = `absolute`;
          img.style.paddingTop = `${closeBtn.offsetHeight + 15}px`;
        } else {
          pic.removeChild(closeBtn);
          img.style.paddingTop = '0px';
        }
      });
  
      closeBtn.addEventListener('click', function(){
        pic.classList.toggle('open-modal');
        pic.removeChild(closeBtn);
      });      
    }

  });
}

// add selector to get the direct parent figure element to the image 
( function() {
    addModal('.wp-block-gallery figure');
    addModal('figure.wp-block-media-text__media');
    addModal('figure.wp-block-image');
    addModal('.divi-col figure');
}() );

// Create facebook share button

function facebookShareButton(url) {
 // console.log(url)
   FB.ui({
    display: 'popup',
    method: 'share',
    href: url,
  }, function(response){});
}
