(function () {
  function normalizePath(url) {
    var link = document.createElement("a");
    link.href = url;
    return link.pathname.replace(/\/+/g, "/").toLowerCase();
  }

  function markCurrentLinks() {
    var current = normalizePath(window.location.href);
    var links = document.querySelectorAll("#topmenu a[href], #bildmenu a[href], #impressum a[href]");
    var sectionTarget = "";

    if (current.indexOf("/country/") !== -1) {
      sectionTarget = "country-line.html";
    } else if (current.indexOf("/city/") !== -1) {
      sectionTarget = "city-forum.html";
    } else if (current.indexOf("/stoffe/") !== -1) {
      sectionTarget = "stoffe-uebersicht.html";
    } else if (current.indexOf("/signature/") !== -1) {
      sectionTarget = "signature-edition.html";
    } else if (current.indexOf("/kamin/") !== -1 || current.slice(-10) === "kamin.html") {
      sectionTarget = "footstools.html";
    }

    for (var i = 0; i < links.length; i++) {
      var linkPath = normalizePath(links[i].href);
      if (linkPath === current || (sectionTarget && linkPath.slice(-sectionTarget.length) === sectionTarget)) {
        links[i].setAttribute("aria-current", "page");
      }
    }
  }

  function addSkipLink() {
    if (document.querySelector(".skip-link")) {
      return;
    }

    var target = document.querySelector("#inhalt, #inhaltleft, #inhaltcenter, #inhaltfootstools, #inhalttab");
    if (!target) {
      return;
    }

    if (!target.id) {
      target.id = "inhalt";
    }
    if (!target.hasAttribute("tabindex")) {
      target.setAttribute("tabindex", "-1");
    }

    var link = document.createElement("a");
    link.className = "skip-link";
    link.href = "#" + target.id;
    link.appendChild(document.createTextNode("Zum Inhalt springen"));
    document.body.insertBefore(link, document.body.firstChild);
  }

  function integrateDetailPriceTable() {
    var price = document.querySelector("#preistabelle");
    var detail = document.querySelector(".detail-page") || document.querySelector("#inhaltleft");

    if (!price || !detail) {
      return;
    }

    var table = price.querySelector(".preise");
    if (!table) {
      return;
    }

    if ((" " + detail.className + " ").indexOf(" detail-page ") === -1) {
      detail.className += detail.className ? " detail-page" : "detail-page";
    }

    if (price.parentNode === detail) {
      return;
    }

    price.className += price.className ? " detail-price" : "detail-price";

    var firstImage = detail.querySelector("img");
    var target = firstImage;
    if (firstImage && firstImage.parentNode && firstImage.parentNode.tagName.toLowerCase() === "a" && firstImage.parentNode.parentNode === detail) {
      target = firstImage.parentNode;
    }

    detail.insertBefore(price, target || detail.firstChild);
  }

  function closestElement(element, selector) {
    if (element && element.nodeType !== 1) {
      element = element.parentNode;
    }

    while (element && element.nodeType === 1) {
      if (element.matches && element.matches(selector)) {
        return element;
      }
      element = element.parentNode;
    }
    return null;
  }

  function getLinkFromEvent(event) {
    var target = event.target;
    while (target && target !== document) {
      if (target.tagName && target.tagName.toLowerCase() === "a") {
        return target;
      }
      target = target.parentNode;
    }
    return null;
  }

  function splitLightboxImages(value, fallback) {
    var list = [];
    var source = value || fallback || "";
    var parts = source.split("|");

    for (var i = 0; i < parts.length; i++) {
      var part = parts[i].replace(/^\s+|\s+$/g, "");
      if (part) {
        list.push(part);
      }
    }

    return list;
  }

  function createProductLightbox() {
    var modal = document.createElement("div");
    modal.className = "product-lightbox";
    modal.setAttribute("hidden", "hidden");
    modal.setAttribute("role", "dialog");
    modal.setAttribute("aria-modal", "true");
    modal.innerHTML =
      '<div class="product-lightbox__backdrop" data-lightbox-close></div>' +
      '<div class="product-lightbox__panel" role="document" tabindex="-1">' +
      '<button class="product-lightbox__close" type="button" aria-label="Schlie&szlig;en" data-lightbox-close>&times;</button>' +
      '<div class="product-lightbox__media">' +
      '<button class="product-lightbox__nav product-lightbox__nav--prev" type="button" aria-label="Vorheriges Bild">&lsaquo;</button>' +
      '<img class="product-lightbox__image" alt="">' +
      '<button class="product-lightbox__nav product-lightbox__nav--next" type="button" aria-label="N&auml;chstes Bild">&rsaquo;</button>' +
      '<div class="product-lightbox__thumbs"></div>' +
      '</div>' +
      '<div class="product-lightbox__info">' +
      '<h2 class="product-lightbox__title"></h2>' +
      '<div class="product-lightbox__specs"></div>' +
      '</div>' +
      '</div>';
    document.body.appendChild(modal);
    return modal;
  }

  function initProductLightbox() {
    var lightboxRoot = document.querySelector("[data-lightbox-images]");
    if (!lightboxRoot) {
      return;
    }

    var lightboxScope = document.querySelector("#main") || document;
    var modal = createProductLightbox();
    var panel = modal.querySelector(".product-lightbox__panel");
    var image = modal.querySelector(".product-lightbox__image");
    var title = modal.querySelector(".product-lightbox__title");
    var specs = modal.querySelector(".product-lightbox__specs");
    var thumbs = modal.querySelector(".product-lightbox__thumbs");
    var previous = modal.querySelector(".product-lightbox__nav--prev");
    var next = modal.querySelector(".product-lightbox__nav--next");
    var images = [];
    var activeIndex = 0;
    var lastFocus = null;

    function showImage(index) {
      if (!images.length) {
        return;
      }

      activeIndex = (index + images.length) % images.length;
      image.src = images[activeIndex];

      var buttons = thumbs.querySelectorAll("button");
      for (var i = 0; i < buttons.length; i++) {
        if (i === activeIndex) {
          buttons[i].setAttribute("aria-current", "true");
        } else {
          buttons[i].removeAttribute("aria-current");
        }
      }
    }

    function closeLightbox() {
      modal.setAttribute("hidden", "hidden");
      document.documentElement.className = document.documentElement.className.replace(/\s?lightbox-open/g, "");
      image.removeAttribute("src");
      if (lastFocus && lastFocus.focus) {
        lastFocus.focus();
      }
    }

    function openLightbox(link) {
      var product = closestElement(link, ".product-card") || closestElement(link, "tr");
      var rowTitle = product ? product.querySelector(".product-title") : null;
      var rowSpecs = product ? product.querySelector(".product-specs") : null;
      var linkedImage = link.querySelector("img");
      var imageText = linkedImage ? linkedImage.getAttribute("alt") : "";
      var linkText = link.textContent.replace(/^\s+|\s+$/g, "");

      images = splitLightboxImages(link.getAttribute("data-lightbox-images"), link.getAttribute("href"));
      if (!images.length) {
        return;
      }

      title.textContent = link.getAttribute("data-lightbox-title") || (rowTitle ? rowTitle.textContent : linkText || imageText || "Goldmann Footstool");
      specs.innerHTML = "";
      if (rowSpecs) {
        specs.appendChild(rowSpecs.cloneNode(true));
      }

      thumbs.innerHTML = "";
      for (var i = 0; i < images.length; i++) {
        var button = document.createElement("button");
        var thumb = document.createElement("img");
        button.type = "button";
        button.setAttribute("aria-label", "Bild " + (i + 1));
        button.setAttribute("data-index", String(i));
        thumb.src = images[i];
        thumb.alt = "";
        button.appendChild(thumb);
        thumbs.appendChild(button);
      }

      modal.className = images.length > 1 ? "product-lightbox product-lightbox--multiple" : "product-lightbox";
      modal.removeAttribute("hidden");
      if (document.documentElement.className.indexOf("lightbox-open") === -1) {
        document.documentElement.className += " lightbox-open";
      }
      lastFocus = document.activeElement;
      showImage(0);
      panel.focus();
    }

    lightboxScope.addEventListener("click", function (event) {
      var link = getLinkFromEvent(event);
      if (!link || !link.getAttribute("data-lightbox-images") || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
        return;
      }

      event.preventDefault();
      openLightbox(link);
    });

    modal.addEventListener("click", function (event) {
      var closeTarget = closestElement(event.target, "[data-lightbox-close]");
      if (closeTarget) {
        closeLightbox();
        return;
      }

      var thumb = closestElement(event.target, ".product-lightbox__thumbs button");
      if (thumb) {
        showImage(parseInt(thumb.getAttribute("data-index"), 10));
      }
    });

    previous.addEventListener("click", function () {
      showImage(activeIndex - 1);
    });

    next.addEventListener("click", function () {
      showImage(activeIndex + 1);
    });

    document.addEventListener("keydown", function (event) {
      if (modal.hasAttribute("hidden")) {
        return;
      }

      if (event.key === "Escape") {
        closeLightbox();
      } else if (event.key === "ArrowLeft") {
        showImage(activeIndex - 1);
      } else if (event.key === "ArrowRight") {
        showImage(activeIndex + 1);
      }
    });
  }

  function init() {
    document.documentElement.className += " js";
    markCurrentLinks();
    integrateDetailPriceTable();
    addSkipLink();
    initProductLightbox();
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
