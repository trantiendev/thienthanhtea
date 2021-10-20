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

  const carouselListPartners = document.querySelector('#carousel-list-partners')
  if (carouselListPartners) new Carousel(carouselListPartners, {
    autoPlay: true,
    dot: false,
    perPage: {
      768: 4,
      1200: 6,
    },
    loopDuration: 2000,
  }).init()

  const carouselListBestSeller = document.querySelector('#carousel-list-best-seller')
  if (carouselListBestSeller) {
    const carouselListBestSellerItems = carouselListBestSeller.querySelector('.carousel-items').children.length

    new Carousel(carouselListBestSeller, {
      autoPlay: false,
      dot: false,
      perPage: {
        768: carouselListBestSellerItems >= 4 ? 4 : carouselListBestSellerItems,
        1200: carouselListBestSellerItems >= 5 ? 5 : carouselListBestSellerItems,
      }
    }).init()
  }
})
