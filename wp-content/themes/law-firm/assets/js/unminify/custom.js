window.addEventListener('DOMContentLoaded',() => {
    
    const headerSearchBtn = document.querySelector('#headerSearchBtn')
    const headerSearchContainer = document.querySelector('.header-search__wrap')

    headerSearchBtn?.addEventListener('click', () => {
        headerSearchContainer.classList.toggle('active')
    })


    // Mobile Side Menu
    const mobileMenus = document.querySelectorAll('#mobileSideMenu .menu');

    mobileMenus?.forEach((mobileMenu) => {
        if (mobileMenu) {
            const menuItems = mobileMenu.querySelectorAll('.menu-item.menu-item-has-children');
            menuItems?.forEach((item) => {
                const subMenu = item.querySelector('.sub-menu');
                if (subMenu) {
                    const button = document.createElement('button');
                    button.classList.add('angle-down');
                    button.textContent = 'Angle down';
                    // Insert the button before the sub-menu
                    item.insertBefore(button, subMenu);
                }
            });
        }
    });

    const sideMenuOverlay = document.querySelector('#sideMenuOverlay')
    const hamBarEl = document.querySelector('#sideMenuOpener')
    const mobileSideMenuEl = document.querySelector('#mobileSideMenu')
    const mobileSideMenuClose = document.querySelector('#mobileSideMenuClose')

    if(sideMenuOverlay && hamBarEl && mobileSideMenuEl && mobileSideMenuClose){
        hamBarEl.addEventListener('click',() => {
            hamBarEl.classList.toggle('active')
            sideMenuOverlay.classList.add('active')
            mobileSideMenuEl.classList.add('active')
        })
    
        sideMenuOverlay.addEventListener('click', () => {
            sideMenuOverlay.classList.toggle('active')
            hamBarEl.classList.remove('active')
            mobileSideMenuEl.classList.remove('active')
        })
        mobileSideMenuClose.addEventListener('click',() => {
            sideMenuOverlay.classList.remove('active')
            hamBarEl.classList.remove('active')
            mobileSideMenuEl.classList.remove('active')
        })
    }

    const submenuOpener = document.querySelectorAll('.angle-down');
    const handleOpeningSubmenu = (opener) => {
        let totalHeight = 0; // Initialize totalHeight to 0
        const submenu = opener.nextElementSibling;
        totalHeight = submenu.scrollHeight
        const innerSubMenu = submenu.querySelectorAll('ul');
        innerSubMenu.forEach(menu => {
          totalHeight += menu.scrollHeight;
        })
        if(submenu.style.visibility === "visible"){
          submenu.style.visibility = "hidden";
          submenu.style.maxHeight = "0";
        }else{
          submenu.style.visibility = "visible";
          submenu.style.maxHeight =  totalHeight + "px";
        }
        opener.classList.toggle('active')
        totalHeight = 0;
    }
    submenuOpener.forEach(opener => {
        opener.addEventListener('click', () => handleOpeningSubmenu(opener));
    });

    // dynamic menu dropdown
    const subMenus = document.querySelectorAll('.desktop-header .menu .sub-menu');      
  
    subMenus.forEach(function (menu) {
        const rect = menu.getBoundingClientRect();
        if (rect.right > window.innerWidth) {
            if (menu.parentElement.parentElement.classList.contains('menu')) {
                menu.style.left = 'auto';
                menu.style.right = '0';
            } else {
                menu.style.left = 'auto';
                menu.style.right = '100%';
            }
        }
    });
     // Accordion
     const accordionContainer = document.querySelectorAll('.accordion');
     const accordionButtons = document.querySelectorAll('.accordion-button');
 
     // Define the Intersection Observer options
     const observerOptions = {
         root: null, // Use the viewport as the root
         rootMargin: '0px', // No margin
         threshold: 0.5, // Trigger when at least 50% of the target is visible
     };
 
     accordionContainer?.forEach(accordion => {
         const accordionButton = accordion.querySelectorAll('.accordion-button');
         const accordionItem = accordion.querySelectorAll('.accordion-item');
         const firstContent = accordionButton[0].nextElementSibling; 
         // Initialize the Intersection Observer for the first content
         const contentObserver = new IntersectionObserver(entries => {
             entries.forEach(entry => {
                 if (entry.isIntersecting) {
                     accordionItem[0].classList.add('active');
                     accordionButton[0].classList.add('active');
                     firstContent.classList.add('active');
                     firstContent.style.maxHeight = firstContent.scrollHeight + 20 + "px";
                     // Unobserve after activation
                     contentObserver.unobserve(firstContent);
                 }
           });
         }, observerOptions);    
         // Start observing the first content
         contentObserver.observe(firstContent);
     });
 
     accordionButtons?.forEach(button => {
         button.addEventListener('click', () => handleAccordion(button));
     });
 
     const handleAccordion = (button) => {
         accordionContainer.forEach((accordion) => {
             const accItems = accordion.querySelectorAll('.accordion-item')
             accItems.forEach((acc) => {
                 acc.classList.remove('active')
                 acc.querySelector('.accordion-button').classList.remove('active')
                 acc.querySelector('.accordion-content').classList.remove('active')
                 acc.querySelector('.accordion-content').style.maxHeight = null
                 
             })
         })
         const content = button.nextElementSibling;
         const accordionItem = button.parentElement;
         button.classList.toggle('active');
         accordionItem.classList.toggle('active');
         content.classList.toggle('active');
         content.style.maxHeight = content.style.maxHeight ? null : content.scrollHeight + 20 + "px";
     };


     // Counter
    const counterContainers = document.querySelectorAll('.counter__card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                startCount(entry.target);
                observer.unobserve(entry.target);
            }
        });
    });

    counterContainers.forEach((counter) => {
        observer.observe(counter);
    });

    const startCount = (counter) => {
        const counterEl = counter.querySelector('.counter__number');
        const prefix = counterEl.getAttribute('data-prefix');
        const target = +parseInt(counterEl.getAttribute('data-count'));
        let count = 0;
        let increment = target / 200; // Duration of the counter

        const timer = setInterval(() => {
            count += increment;
            if(prefix){
                counterEl.innerHTML = `${Math.floor(count)}<span>${prefix}</span>`;
            }else{
                counterEl.innerText = `${Math.floor(count)}`;
            }
            
            if (count >= target) {
                clearInterval(timer);
                if(prefix){
                    counterEl.innerHTML = `${target}<span>${prefix}</span>`;
                }else{
                    counterEl.innerText = `${target}`;
                }
            }
        }, 8);
    };

})