$(document).ready(function () {

  var dd = $('.vticker').easyTicker({
      direction: 'up',
      easing: 'easeInOutBack',
      speed: 'slow',
      interval: 2000,
      height: '130px',
      visible: 5,
      mousePause: 0,
  })
  $(".marketlist").moveItems();
});
var move = 6;
$.fn.moveItems = function () {
  var cM = document.getElementById("marketlist");
  if (cM != null) {
      var c = cM.childElementCount;
      if (c > move) {
          $(".marketlist").stop();
          $(this).children(':first-child').fadeOut(
              1000,
              function () {
                  var $child = $(this);
                  var $parent = $child.parent();
                  $child.appendTo($parent).fadeIn(2000, function () {
                      $parent.moveItems();
                  });
              }
          );
      }
  }
}

function myPromo() {
  location.href = "Promo.aspx";
}

function myFunction(x) {
  if (x.matches) { // If media query matches
      //alert(3);
      move = 3;
      $(".marketlist").moveItems();
  } else {
      //alert(6);
      move = 6;
  }
}

// var x = window.matchMedia("(max-width: 812px)")
// myFunction(x) // Call listener function at run time
// x.addListener(myFunction) // Attach listener function on state changes

// function closeLoginForm() {
//   document.getElementById("divMobLogin").style.display = "none";
// }

// function openLoginForm() {
//   document.getElementById("divMobLogin").style.display = "block";
// }

// function usrnameblur() {
//   var x = document.getElementById("SubContent_username");
//   $("#web_username").val(x.value);

//   var x = document.getElementById("SubContent_password");
//   $("#web_password").val(x.value);
// }

// Wow Js
new WOW().init();
$('#nav-onChecked').click(function () {
    $(this).toggleClass('active');
    $(".sub_nav").toggleClass('show');
});

// backToTop Scroll 
var backToTopBtn = $('#backToTop');
$(window).scroll(function() {
    if ($(window).scrollTop() > 500) {
    backToTopBtn.addClass('show');
    } else {
    backToTopBtn.removeClass('show');
    }
});

backToTopBtn.on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({scrollTop:0}, '300');
});

// License Script
var __lc = {};
__lc.license = 6588521;
(function () {
  var lc = document.createElement("script");
  lc.type = "text/javascript";
  lc.async = true;
  lc.src =
    ("https:" == document.location.protocol ? "https://" : "http://") +
    "cdn.livechatinc.com/tracking.js";
  var s = document.getElementsByTagName("script")[0];
  s.parentNode.insertBefore(lc, s);
})();


// button toggle 
// game button 
$(".Game-button-toggler").click(function(){
  $(this).toggleClass('active')
  $('.game-submenu-wrapper').toggleClass('is-active');
  if ($('.Lain-button-toggler').hasClass('active')) {
    $('.Lain-button-toggler').toggleClass('active');
  }
  if ($('.lain-submenu-wrapper').hasClass('is-active')) {
    $('.lain-submenu-wrapper').toggleClass('is-active');
  }
});

// Lain button 
$(".Lain-button-toggler").click(function(){
  $(this).toggleClass('active')
  $('.lain-submenu-wrapper').toggleClass('is-active');
  if ($('.Game-button-toggler').hasClass('active')) {
      $('.Game-button-toggler').toggleClass('active');
  }
  if ($('.game-submenu-wrapper').hasClass('is-active')) {
    $('.game-submenu-wrapper').toggleClass('is-active');
  }
});


const tabs = document.querySelectorAll(".tab");
const tabContent = document.querySelectorAll(".tab-content");

let tabNo = 0;
let contentNo = 0;

tabs.forEach((tab) => {
  tab.dataset.id = tabNo;
  tabNo++;
  tab.addEventListener("click", function () {
    tabs.forEach((tab) => {
      tab.classList.remove("active");
      tab.classList.add("non-active");
    });
    this.classList.remove("non-active");
    this.classList.add("active");
    tabContent.forEach((content) => {
      content.classList.add("hidden");
      if (content.dataset.id === tab.dataset.id) {
          content.classList.remove("hidden");
      }
    });
  });
});

tabContent.forEach((content) => {
  content.dataset.id = contentNo;
  contentNo++;
});


// Live Search Option
function mySearchFunction() {
  let input = document.getElementById('myInput');
  input = input.value.toLowerCase();
  let gameItem = document.getElementsByClassName("game-item");
  for (i = 0; i < gameItem.length; i++) {
      if (!gameItem[i].children[1].innerHTML.toLowerCase().includes(input)){
          gameItem[i].style.display = "none";
      }else{
          gameItem[i].style.display = "block";
      }
  }
}

// path selected
let cataEl = document.getElementById('cataSelector');
let cataPath = window.location.pathname.split('/')[3];
for(let i = 0; i<cataEl.children.length; i++){
  // console.log(cataEl[i].value.split('/').join(''))
  // console.log('****')
  // console.log(cataPath)
    if(cataEl[i].value.split('/').join('')==cataPath){
        cataEl.value = cataEl[i].value;
            cataEl[i].setAttribute('selected', true);
    }
}

