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

  function init() {
    document.documentElement.className += " js";
    markCurrentLinks();
    integrateDetailPriceTable();
    addSkipLink();
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
