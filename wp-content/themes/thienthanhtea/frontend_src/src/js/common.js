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

export const onFilterPost = () => {
  const filterPost = document.querySelector('.js-filter-post')
  if (!filterPost) return

  const inputValueFilterS = [...filterPost.querySelectorAll('input[name=radio-tab]')]

  inputValueFilterS.forEach(inputValueFilter => {
    inputValueFilter.addEventListener('change', event => {
      displayContent(event.target.value)
    })
  })
}

const displayContent = inputValue => {
  const tabContents = [...document.querySelectorAll('.js-tab-content')]
  if (!tabContents.length) return

  tabContents.forEach(tabContent => {
    tabContent.getAttribute('id') === inputValue ? tabContent.classList.remove('u-hidden') : tabContent.classList.add('u-hidden')
  })
}
