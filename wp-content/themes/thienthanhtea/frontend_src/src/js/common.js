export const onclickBtnSearch = () => {
  const navbarSearch = document.querySelector('.js-navbar-search')
  const navbarSearchBtn = document.querySelector('.js-btn-seach')
  if(!navbarSearch) return

  const formSearch = navbarSearch.querySelector('.js-form-search')

  navbarSearchBtn.addEventListener('click', () => {
    navbarSearchBtn.classList.toggle('is-active')
  })

}
