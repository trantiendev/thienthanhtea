import Siema from 'siema'

export default class Carousel {
  constructor (selector, options) {
    this.selector = selector
    this.config = Carousel.mergeSettings(options)

    this.carouselItems = this.selector.querySelector('.carousel-items')
    this.next = this.selector.querySelector('.carousel-next')
    this.prev = this.selector.querySelector('.carousel-prev')
    this.carouselDots = this.selector.querySelector('.carousel-dots')
    this.dots = null
    this.interval = null

    // Prevent display on DOM when loading carousel
    this.selector.style.display = `block`
  }

  static mergeSettings (options) {
    return Object.assign({
      loopDuration: 2800,
      autoPlay: false,
      perPage: 1,
      threshold: 60,
      dot: true
    }, options)
  }

  _initSiema () {
    this.siema = new Siema({
      selector: this.carouselItems,
      duration: 500,
      easing: 'ease-in-out',
      loop: true,
      perPage: this.config.perPage,
      onChange: () => {
        this.activeDot()
      }
    })

    // Binding event
    this._bindings()

    // Autoplay
    if (this.config.autoPlay) {
      this.autoPlay()
      this.stopAutoPlayWhenHover()
    }

    // Render dot element
    this.renderDots()
  }

  _bindings () {
    this.next.addEventListener('click', () => {
      this.siema.next()
      this.resetAutoPlay()
    })

    this.prev.addEventListener('click', () => {
      this.siema.prev()
      this.resetAutoPlay()
    })
  }

  autoPlay () {
    this.interval = setInterval(() => {
      this.siema.next()
    }, this.config.loopDuration)
  }

  stopAutoPlayWhenHover () {
    this.carouselItems.addEventListener('mouseenter', () => {
      this.pauseCarousel()
    })

    this.carouselItems.addEventListener('mouseleave', () => {
      this.replayCarousel()
    })
  }

  pauseCarousel () {
    clearInterval(this.interval)
  }

  replayCarousel () {
    setTimeout(() => {
      this.autoPlay()
    }, 0)
  }

  resetAutoPlay () {
    // When click dot / button, reset interval
    if (this.config.autoPlay) {
      this.pauseCarousel()
      this.replayCarousel()
    }
  }

  renderDot (i) {
    const $dot = document.createElement('span')
    if (i === 0) $dot.classList.add('active')

    $dot.addEventListener('click', () => {
      this.siema.goTo(i)
      this.resetAutoPlay()
    })

    this.carouselDots.appendChild($dot)

    // Assign carousel dots
    this.dots = Array.prototype.slice.call(this.carouselDots.querySelectorAll('span'))
  }

  renderDots () {
    for (var i = 0; i < this.siema.innerElements.length; i++) {
      this.renderDot(i)
    }
  }

  activeDot () {
    this.dots.forEach(dot => {
      dot.classList.remove('active')
    })
    this.dots[Math.abs(this.siema.currentSlide)].classList.add('active')
  }

  init () {
    this._initSiema()
  }
}