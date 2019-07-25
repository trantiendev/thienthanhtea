import { header } from './header'
import { footer } from './footer'
import Carousel from './carousel'

window.addEventListener('DOMContentLoaded', function () {
  header()
  footer()

  const carouselHome = document.querySelector('#carousel-home')
  if (carouselHome) new Carousel(carouselHome, { autoPlay: true }).init()
})
