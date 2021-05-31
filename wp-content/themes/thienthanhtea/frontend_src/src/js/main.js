import { header } from './header'
import { onclickBtnSearch, onFilterPost } from './common'
import Carousel from './carousel'

window.addEventListener('DOMContentLoaded', function () {
  header()
  onclickBtnSearch()
  onFilterPost()

  const carouselHome = document.querySelector('#carousel-home')
  if (carouselHome) new Carousel(carouselHome, { autoPlay: true }).init()

  const carouselPost = document.querySelector('#carousel-post')
  if (carouselPost) new Carousel(carouselPost, { autoPlay: false, dot: false }).init()
})
