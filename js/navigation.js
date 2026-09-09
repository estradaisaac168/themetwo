const toggleMenuElement = document.getElementById("button-toggle");
const closeMenuElement = document.getElementById("button-close");
const contentMenu = document.getElementById("nav-content");
const itemsWithChildren = document.querySelectorAll(".menu-item-has-children");
const menuLinks = document.querySelectorAll("#nav-content a");

// Función auxiliar para cerrar todo, habilitar el scroll y limpiar focos y clases de submenús
const closeMobileMenu = () => {
  contentMenu?.classList.remove("show");
  document.body.classList.remove("menu-open");
  document.activeElement?.blur();

  const allOpenItems = document.querySelectorAll("#nav-content .menu-item-has-children, #nav-content .is-megamenu");
  allOpenItems.forEach((el) => el.classList.remove("open"));

  const allVisibleSubMenus = document.querySelectorAll("#nav-content .sub-menu, #nav-content .show-sub-menu");
  allVisibleSubMenus.forEach((sub) => sub.classList.remove("show-sub-menu"));
};

// Toggle general del menú móvil
if (toggleMenuElement && contentMenu) {
  toggleMenuElement.addEventListener("click", () => {
    toggleMenuElement.blur();
    const isOpen = contentMenu.classList.toggle("show");
    document.body.classList.toggle("menu-open", isOpen);

    if (!isOpen) {
      closeMobileMenu();
    }
  });
}

// Botón de cierre explícito
closeMenuElement?.addEventListener("click", () => {
  closeMenuElement.blur();
  closeMobileMenu();
});

// Enlaces del menú (cierra si no es un elemento con hijos desplegables)
menuLinks.forEach((link) => {
  const handleLinkAction = () => {
    link.blur();
    if (!link.closest(".menu-item-has-children")) {
      closeMobileMenu();
    }
  };

  link.addEventListener("click", handleLinkAction);
  link.addEventListener("touchend", () => link.blur(), { passive: true });
});

// Control de acordeón para elementos con submenús (Separando la flecha del enlace <a>)
itemsWithChildren.forEach((item) => {
  const innerLink = item.querySelector(":scope > a");
  const subMenu = item.querySelector(":scope > .sub-menu");

  // Función para alternar el despliegue del submenú
  const toggleSubmenu = (e) => {
    e.preventDefault();
    e.stopPropagation();

    innerLink?.blur();
    const isOpen = item.classList.contains("open");

    // Cerrar hermanos activos en el mismo nivel
    item.parentElement?.querySelectorAll(":scope > .menu-item-has-children").forEach((sibling) => {
      if (sibling !== item) {
        sibling.classList.remove("open");
        sibling.querySelector(":scope > .sub-menu")?.classList.remove("show-sub-menu");
      }
    });

    // Alternar estado actual del acordeón
    item.classList.toggle("open", !isOpen);
    subMenu?.classList.toggle("show-sub-menu", !isOpen);
  };

  // 1. Si se hace clic estrictamente en el pseudo-elemento flecha (zona derecha del li)
  item.addEventListener("click", (e) => {
    const rect = item.getBoundingClientRect();
    const clickX = e.clientX - rect.left;
    const itemWidth = rect.width;

    // Detectamos si el clic ocurrió en el último 20% del ancho del elemento (donde está la flecha)
    // o si el enlace tiene un atributo/comportamiento especial de despliegue.
    const isArrowArea = clickX > itemWidth - 60; // Área aproximada de la flecha

    if (isArrowArea && subMenu) {
      toggleSubmenu(e);
    } else {
      // Si hace clic en el enlace, permitimos la navegación normal de WordPress
      // pero cerramos el menú móvil si corresponde
      if (!innerLink?.contains(e.target)) return;
      innerLink.blur();
      closeMobileMenu();
    }
  });

  // 2. Control táctil específico para evitar conflictos en móviles
  item.addEventListener("touchend", (e) => {
    innerLink?.blur();
  }, { passive: true });
});

// Inicialización del botón "Volver" en los megamenús móviles
document.addEventListener("DOMContentLoaded", function () {
  const megamenu = document.querySelector(".is-megamenu");

  if (megamenu) {
    const subMenu = megamenu.querySelector(":scope > .sub-menu");

    if (subMenu) {
      const backButton = document.createElement("button");
      backButton.type = "button";
      backButton.className = "megamenu-back-btn";
      backButton.innerHTML = `<i class="bi bi-arrow-left"></i> Volver`;

      subMenu.prepend(backButton);

      backButton.addEventListener("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        megamenu.classList.remove("open");
      });
    }
  }
});







// const toggleMenuElement = document.getElementById("button-toggle");
// const closeMenuElement = document.getElementById("button-close");
// const contentMenu = document.getElementById("nav-content");
// const itemsWithChildren = document.querySelectorAll(".menu-item-has-children");
// const menuLinks = document.querySelectorAll("#nav-content a");

// // Función auxiliar para cerrar todo, habilitar el scroll y limpiar focos
// const closeMobileMenu = () => {
//   contentMenu?.classList.remove("show");
//   document.body.classList.remove("menu-open");
//   document.activeElement?.blur();
// };

// // Toggle general del menú móvil
// if (toggleMenuElement && contentMenu) {
//   toggleMenuElement.addEventListener("click", () => {
//     toggleMenuElement.blur();
//     const isOpen = contentMenu.classList.toggle("show");
//     document.body.classList.toggle("menu-open", isOpen);
//   });
// }

// // Botón de cierre explícito
// closeMenuElement?.addEventListener("click", () => {
//   closeMenuElement.blur();
//   closeMobileMenu();
// });

// // Enlaces del menú (cierra si no es un elemento con hijos desplegables)
// menuLinks.forEach((link) => {
//   const handleLinkAction = () => {
//     link.blur();
//     if (!link.closest(".menu-item-has-children")) {
//       closeMobileMenu();
//     }
//   };

//   link.addEventListener("click", handleLinkAction);
//   link.addEventListener("touchend", () => link.blur(), { passive: true });
// });

// // Control de acordeón para elementos con submenús
// itemsWithChildren.forEach((item) => {
//   item.addEventListener("click", (e) => {
//     e.stopPropagation();
    
//     const innerLink = item.querySelector(":scope > a");
//     const subMenu = item.querySelector(":scope > .sub-menu");
//     const isOpen = item.classList.contains("open");

//     innerLink?.blur();

//     // Cerrar hermanos activos en el mismo nivel
//     item.parentElement?.querySelectorAll(":scope > .menu-item-has-children").forEach((sibling) => {
//       if (sibling !== item) {
//         sibling.classList.remove("open");
//         sibling.querySelector(":scope > .sub-menu")?.classList.remove("show-sub-menu");
//       }
//     });

//     // Alternar estado actual del acordeón
//     item.classList.toggle("open", !isOpen);
//     subMenu?.classList.toggle("show-sub-menu", !isOpen);
//   });

//   item.addEventListener("touchend", () => {
//     item.querySelector(":scope > a")?.blur();
//   }, { passive: true });
// });



// document.addEventListener("DOMContentLoaded", function () {
//   // Buscamos el submenú del mega menú en móvil
//   const megamenu = document.querySelector(".is-megamenu");

//   if (megamenu) {
//     const subMenu = megamenu.querySelector(":scope > .sub-menu");

//     if (subMenu) {
//       // Creamos el botón de volver
//       const backButton = document.createElement("button");
//       backButton.type = "button";
//       backButton.className = "megamenu-back-btn";
//       backButton.innerHTML = `<i class="bi bi-arrow-left"></i> Volver`;

//       // Lo insertamos justo al inicio del submenú
//       subMenu.prepend(backButton);

//       // Evento para cerrar/regresar al hacer clic en el botón
//       backButton.addEventListener("click", function (e) {
//         e.preventDefault();
//         e.stopPropagation();
//         // Quitamos la clase 'open' del li padre para ocultar el submenú
//         megamenu.classList.remove("open");
//       });
//     }
//   }
// });













// const toggleMenuElement = document.getElementById("button-toogle");
// const closeMenuElement = document.getElementById("button-close");
// const contentMenu = document.getElementById("nav-content");
// const itemsWithChildren = document.querySelectorAll(".menu-item-has-children");
// const menuLinks = document.querySelectorAll("#nav-content a");

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















