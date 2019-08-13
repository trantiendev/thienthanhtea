export const header = () => {
  const navbar = document.querySelector('.js-navbar')
  const hamburger = navbar.querySelector('.js-navbar-collapse')
  const dropDown = navbar.querySelector('.js-dropdown')

  window.addEventListener('resize', onHandleClickMenu)
  onHandleClickMenu()

  function onHandleClickMenu() {
    window.innerWidth < 1200 ? addEventClick() : removeEventClick()
  }

  function addEventClick() {
    hamburger.addEventListener('click', navbarCollapse)
    dropDown.addEventListener('click', dropdownMenu)
  }

  function removeEventClick() {
    navbar.classList.remove('is-active')
    dropDown.classList.remove('is-active')
    hamburger.removeEventListener('click', navbarCollapse)
    dropDown.removeEventListener('click', dropdownMenu)
  }

  function navbarCollapse() {
    navbar.classList.toggle('is-active')
  }

  function dropdownMenu() {
    dropDown.classList.toggle('is-active')
  }
}
