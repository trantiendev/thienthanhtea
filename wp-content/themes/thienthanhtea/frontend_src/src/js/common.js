export const onclickBtnSearch = () => {
  const navbarSearch = document.querySelector('.js-navbar-search')
  if(!navbarSearch) return

  const formSearch = navbarSearch.querySelector('.js-form-search')

  navbarSearch.querySelector('.js-btn-seach').addEventListener('click', () => {
    formSearch.classList.toggle('is-active')
  })

  document.addEventListener('click', event => {
    if (navbarSearch.contains(event.target) || event.target.className === 'js-form-search') return
    formSearch.classList.remove('is-active')
  })
}
