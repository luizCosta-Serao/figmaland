export default function scrollSuave() {
  const target = $('target').attr('target')

  if ($('target').length >= 1) {
    const section = $(`#${target}`)
    const sectionTop = $(section).offset().top
    
    $('html,body').animate({
      'scrollTop': sectionTop
    },2000)
  }
} 