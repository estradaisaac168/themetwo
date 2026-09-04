
const toggleMenuElement = document.getElementById("button-toggle");
const closeMenuElement = document.getElementById("button-close");
const contentMenu = document.getElementById("content-menu");
const itemsWithChildren = document.querySelectorAll(".menu-item-has-children");
const menuLinks = document.querySelectorAll("#content-menu a");

// Función auxiliar para cerrar todo y habilitar el scroll de nuevo
const closeMobileMenu = () => {
  if (contentMenu) contentMenu.classList.remove("show");
  document.body.classList.remove("menu-open");
};

if (toggleMenuElement && contentMenu) {
  toggleMenuElement.addEventListener("click", () => {
    contentMenu.classList.toggle("show");
    // Alterna el bloqueo de scroll del body según si el menú está abierto o no
    document.body.classList.toggle("menu-open", contentMenu.classList.contains("show"));
  });
}

if (closeMenuElement) {
  closeMenuElement.addEventListener("click", () => {
    closeMobileMenu();
  });
}

// Cierra el menú y libera el scroll al hacer clic en un enlace de destino final
menuLinks.forEach((link) => {
  link.addEventListener("click", (e) => {
    const parentItem = link.parentElement;
    
    if (parentItem.classList.contains("menu-item-has-children")) {
      return; // Si es desplegable, no cierra el menú
    }

    closeMobileMenu();
  });
});

// Control de acordeón para padres, hijos y nietos con submenús
itemsWithChildren.forEach((item) => {
  item.addEventListener("click", (e) => {
    e.stopPropagation();

    const subMenu = item.querySelector(":scope > .sub-menu");
    const isOpen = item.classList.contains("open");

    const parentList = item.parentElement;
    if (parentList) {
      parentList.querySelectorAll(":scope > .menu-item-has-children").forEach((sibling) => {
        if (sibling !== item) {
          sibling.classList.remove("open");
          const siblingSub = sibling.querySelector(":scope > .sub-menu");
          if (siblingSub) siblingSub.classList.remove("show-sub-menu");
        }
      });
    }

    if (isOpen) {
      item.classList.remove("open");
      if (subMenu) subMenu.classList.remove("show-sub-menu");
    } else {
      item.classList.add("open");
      if (subMenu) subMenu.classList.add("show-sub-menu");
    }
  });
});
















// const toggleMenuElement = document.getElementById("button-toogle");
// const closeMenuElement = document.getElementById("button-close");
// const contentMenu = document.getElementById("content-menu");
// const itemsWithChildren = document.querySelectorAll(".menu-item-has-children");
// const menuLinks = document.querySelectorAll("#content-menu a");

// if (toggleMenuElement && contentMenu) {
//   toggleMenuElement.addEventListener("click", () => {
//     contentMenu.classList.toggle("show");
//   });
// }

// if (closeMenuElement && contentMenu) {
//   closeMenuElement.addEventListener("click", () => {
//     contentMenu.classList.remove("show");
//   });
// }

// // 1. Cierra el menú móvil al hacer clic en CUALQUIER enlace que sea un destino final
// menuLinks.forEach((link) => {
//   link.addEventListener("click", (e) => {
//     const parentItem = link.parentElement;
    
//     // Si el elemento padre DIRECTO tiene un submenú, significa que este enlace es un desplegable 
//     // y NO una página final, por lo que dejamos que abra el submenú en lugar de cerrar el menú general.
//     if (parentItem.classList.contains("menu-item-has-children")) {
//       return; 
//     }

//     // Si es un hijo o nieto final (sin submenú debajo), cerramos el menú móvil de inmediato
//     if (contentMenu) {
//       contentMenu.classList.remove("show");
//     }
//   });
// });

// // 2. Control de acordeón para padres, hijos y nietos con submenús
// itemsWithChildren.forEach((item) => {
//   item.addEventListener("click", (e) => {
//     e.stopPropagation();

//     const subMenu = item.querySelector(":scope > .sub-menu");
//     const isOpen = item.classList.contains("open");

//     // Cierra los hermanos del mismo nivel (comportamiento acordeón)
//     const parentList = item.parentElement;
//     if (parentList) {
//       parentList.querySelectorAll(":scope > .menu-item-has-children").forEach((sibling) => {
//         if (sibling !== item) {
//           sibling.classList.remove("open");
//           const siblingSub = sibling.querySelector(":scope > .sub-menu");
//           if (siblingSub) siblingSub.classList.remove("show-sub-menu");
//         }
//       });
//     }

//     // Alterna el estado del menú actual
//     if (isOpen) {
//       item.classList.remove("open");
//       if (subMenu) subMenu.classList.remove("show-sub-menu");
//     } else {
//       item.classList.add("open");
//       if (subMenu) subMenu.classList.add("show-sub-menu");
//     }
//   });
// });
















