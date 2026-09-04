/**
 * Selectores de variación tipo botón (swatches).
 *
 * Convierte cada <select> de las variaciones en botones: círculos de color
 * para atributos tipo "color" y píldoras de texto para el resto. El <select>
 * nativo se oculta pero se mantiene en el DOM para que el JS de variaciones
 * de WooCommerce siga funcionando (el valor se sincroniza en cada clic).
 *
 * La configuración (tipo + colores por atributo) llega desde PHP vía
 * window.childThemeSwatches (inc/woocommerce-custom.php).
 */
(function () {
  "use strict";

  const CONFIG = window.childThemeSwatches || {};

  const toTaxonomy = (attrName) =>
    String(attrName || "").replace(/^attribute_/, "");

  const buildSwatches = (select) => {
    const tax = toTaxonomy(select.getAttribute("data-attribute_name"));
    const cfg = CONFIG[tax];

    const list = document.createElement("div");
    list.className = "swatch-list";

    Array.from(select.options).forEach((option) => {
      if (option.value === "") return; // "Elige una opción".

      const value = option.value;
      const text = option.textContent.trim();
      const color =
        cfg && cfg.type === "color" && cfg.colors && cfg.colors[value]
          ? cfg.colors[value]
          : null;

      const btn = document.createElement("button");
      btn.type = "button";
      btn.className = "swatch swatch--" + (color ? "color" : "button");
      btn.dataset.value = value;
      btn.setAttribute("role", "radio");
      btn.setAttribute("aria-checked", "false");
      btn.setAttribute("aria-label", text);

      if (color) {
        btn.style.backgroundColor = color;
        btn.setAttribute("title", text);
      } else {
        btn.textContent = text;
      }

      list.appendChild(btn);
    });

    select.parentNode.insertBefore(list, select);
    select.style.display = "none";

    return list;
  };

  const syncSwatches = (form) => {
    form
      .querySelectorAll(".variations select[data-attribute_name]")
      .forEach((select) => {
        const list = select.parentNode.querySelector(":scope > .swatch-list");
        if (!list) return;
        const selected = select.value;

        Array.from(list.querySelectorAll(".swatch")).forEach((btn) => {
          const option = Array.from(select.options).find(
            (o) => o.value === btn.dataset.value,
          );
          const isSelected = selected === btn.dataset.value;
          const isDisabled =
            !option || option.disabled || option.classList.contains("disabled");

          btn.classList.toggle("is-selected", isSelected);
          btn.classList.toggle("is-disabled", isDisabled);
          btn.setAttribute("aria-checked", isSelected ? "true" : "false");
          btn.disabled = isDisabled;
        });
      });
  };

  const initVariationSwatches = () => {
    document.querySelectorAll("form.variations_form").forEach((form) => {
      form
        .querySelectorAll(".variations select[data-attribute_name]")
        .forEach((select) => {
          if (select.parentNode.querySelector(":scope > .swatch-list")) return;

          const list = buildSwatches(select);

          list.addEventListener("click", (e) => {
            const btn = e.target.closest(".swatch");
            if (!btn || btn.disabled) return;

            select.value = btn.dataset.value;
            select.dispatchEvent(new Event("change", { bubbles: true }));
            syncSwatches(form);
          });
        });

      // Sincroniza el estado cuando WooCommerce cambia o resetea opciones.
      form.addEventListener("change", () =>
        window.setTimeout(() => syncSwatches(form), 0),
      );
      form.addEventListener("reset_data", () => syncSwatches(form));
      form.addEventListener("found_variation", () => syncSwatches(form));
      form.addEventListener("wc_variation_form", () => syncSwatches(form));

      // El "Limpiar" de WooCommerce resetea los <select> sin disparar
      // eventos nativos observables en todas las versiones; sincronizamos
      // después de su handler (setTimeout 0).
      form.querySelectorAll(".reset_variations").forEach((link) => {
        link.addEventListener("click", () =>
          window.setTimeout(() => syncSwatches(form), 0),
        );
      });

      syncSwatches(form);
    });
  };

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initVariationSwatches);
  } else {
    initVariationSwatches();
  }
})();

var swiper = new Swiper(".testimonial-swiper", {
  slidesPerView: 1,
  spaceBetween: 10,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    576: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 40,
    },
    992: {
      slidesPerView: 3,
      spaceBetween: 45,
    },
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  autoHeight: false,
});





jQuery(document).ready(function($) {
    $(document).on('click', '.quantity .qty-btn', function(e) {
        e.preventDefault();
        
        var $button = $(this);
        var $input = $button.siblings('input.qty');
        var oldValue = parseFloat($input.val()) || 0;
        var newVal = 0;
        
        var min = parseFloat($input.attr('min')) || 0;
        var max = parseFloat($input.attr('max')) || '';
        var step = parseFloat($input.attr('step')) || 1;
        
        if ($button.hasClass('plus')) {
            newVal = oldValue + step;
            if (max !== '' && newVal > max) {
                newVal = max;
            }
        } else {
            newVal = oldValue - step;
            if (newVal < min) {
                newVal = min;
            }
        }
        
        $input.val(newVal).trigger('change');
    });
});



// ==========================================
// 2. Swatches de Variaciones (jQuery)
// ==========================================
jQuery(function($) {
    const $form = $('.variations_form');
    const variationsData = $form.data('product_variations');

    if (!variationsData) return;

    function updateSwatchAvailability() {
        // Cacheamos las selecciones actuales una sola vez por ciclo
        const currentSelections = {};
        $form.find('select').each(function() {
            currentSelections[this.name] = $(this).val();
        });

        $('.custom-swatches').each(function() {
            const $container = $(this);
            const attributeName = $container.data('attribute_name');

            $container.find('.custom-swatch-btn').each(function() {
                const $btn = $(this);
                const swatchVal = $btn.data('value');
                let isAvailable = false;

                for (let i = 0; i < variationsData.length; i++) {
                    const variation = variationsData[i];
                    const attrVal = variation.attributes[attributeName];

                    if (attrVal === '' || attrVal === swatchVal) {
                        let matchesOtherSelections = true;

                        for (const attrKey in currentSelections) {
                            if (attrKey !== attributeName && currentSelections[attrKey] !== '') {
                                const varAttr = variation.attributes[attrKey];
                                if (varAttr !== '' && varAttr !== currentSelections[attrKey]) {
                                    matchesOtherSelections = false;
                                    break;
                                }
                            }
                        }

                        if (matchesOtherSelections && variation.is_in_stock && variation.is_purchasable) {
                            isAvailable = true;
                            break;
                        }
                    }
                }

                // Alternar estado visual (delegado al CSS mediante la clase .disabled)
                $btn.toggleClass('disabled', !isAvailable).prop('disabled', !isAvailable);
            });
        });
    }

    // Eventos nativos de WooCommerce en lugar de setTimeout
    $form.on('show_variation reset_data update_variation_values', updateSwatchAvailability);

    // Inicializar al cargar
    updateSwatchAvailability();

    // Clic en el swatch personalizado
    $(document).on('click', '.custom-swatch-btn', function(e) {
        e.preventDefault();
        const $button = $(this);
        
        if ($button.hasClass('disabled') || $button.is(':disabled')) return;

        const $container = $button.closest('.custom-swatches');
        const value = $button.data('value');

        $container.find('.custom-swatch-btn').removeClass('selected');
        $button.addClass('selected');

        // Sincronizar con el select oculto de WooCommerce
        const $select = $container.siblings('.hidden-select-wrapper').find('select');
        if ($select.val() !== value) {
            $select.val(value).trigger('change');
        }
    });

    // Resetear swatches
    $(document).on('click', '.reset_variations', function() {
        $('.custom-swatch-btn').removeClass('selected disabled').prop('disabled', false);
    });
});