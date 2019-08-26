export const onclickBtnSearch = () => {
  const navbarSearch = document.querySelector('.js-navbar-search')
  const navbarSearchBtn = document.querySelector('.js-btn-seach')
  if(!navbarSearch) return

  const formSearch = navbarSearch.querySelector('.js-form-search')

  navbarSearchBtn.addEventListener('click', () => {
    navbarSearchBtn.classList.toggle('is-active')
    formSearch.classList.toggle('is-active')
  })

  document.addEventListener('click', event => {
    if (navbarSearch.contains(event.target) || event.target.className === 'js-form-search') return
    formSearch.classList.remove('is-active')
    navbarSearchBtn.classList.remove('is-active')
  })
}
