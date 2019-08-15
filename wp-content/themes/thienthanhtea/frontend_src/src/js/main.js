import { header } from './header'
import { onclickBtnSearch } from './common'
import Carousel from './carousel'

window.addEventListener('DOMContentLoaded', function () {
  header()
  onclickBtnSearch()

  const carouselHome = document.querySelector('#carousel-home')
  if (carouselHome) new Carousel(carouselHome, { autoPlay: true, dot: false }).init()

  const carouselPost = document.querySelector('#carousel-post')
  if (carouselPost) new Carousel(carouselPost, { autoPlay: false, dot: false }).init()
})
