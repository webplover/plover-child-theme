/**
 * Project types dropdown menu
 */

let str = location.href.toLowerCase();
Array.from(document.querySelectorAll(".projectTypesDDM option")).forEach((e) => {
  if (str.indexOf(e.value.toLowerCase()) > -1) {
    e.setAttribute("selected", true);
  }
});
