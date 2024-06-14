export default function menu() {
  $('.header .menu-btn button').click(function() {
    $('aside').toggleClass('active')
    $('.header').toggleClass('active')
    $('.container').toggleClass('active')
  })
}