export default function menuMobile() {
  $('.header .menu-mobile').click(function() {
    $('.header .menu').slideToggle();
  })

  $(window).resize(function() {
    const match = window.matchMedia('(max-width: 876px)').matches
    console.log(match)
    if (!match) {
      $('.header .menu').css({display: 'flex'});
    } else {
      $('.header .menu').css({display: 'none'});
    }
  })

  $(window).scroll(function() {
    const match = window.matchMedia('(max-width: 876px)').matches
    if (!match) {
      $('.header .menu').css({display: 'flex'});
    } else {
      $('.header .menu').css({display: 'none'});
    }
  })
}