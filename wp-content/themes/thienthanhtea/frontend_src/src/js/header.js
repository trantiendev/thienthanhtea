export const header = () => {
  const navbar = document.querySelector('.js-navbar')
  const hamburger = navbar.querySelector('.js-navbar-collapse')
  const dropDowns = [...navbar.querySelectorAll('.js-dropdown')]

  dropDowns.forEach(dropDown => {
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

    function dropdownMenu() {
      getSiblings(dropDown).map(item => {
        item.classList.remove('is-active')
      })
      dropDown.classList.toggle('is-active')
    }
  })

  function navbarCollapse() {
    navbar.classList.toggle('is-active')
  }
}

const getSiblings = element => {
	// Setup siblings array and get the first sibling
	let siblings = []
	let sibling = element.parentNode.firstChild

	// Loop through each sibling and push to the array
	while (sibling) {
		if (sibling.nodeType === 1 && sibling !== element) {
			siblings.push(sibling)
		}
		sibling = sibling.nextSibling
  }

	return siblings
}
