// Move form to custom div
let varForm = document.querySelector(".variations_form");
document.querySelector(".wpr-hosting-options").appendChild(varForm);

/**
 * '.reset_variations' button, visibility property is set, we want to set its property
 * to display none to empty its space when it is not visible.
 */

document.querySelector(".reset_variations").addEventListener("click", (e) => {
  e.target.style.display = "none";
});

document.querySelector(".variations select").addEventListener("change", (e) => {
  if (e.target.value == "") {
    e.target.parentNode.querySelector(".reset_variations").style.display = "none";
  } else {
    e.target.parentNode.querySelector(".reset_variations").style.display = "inline-block";
  }
});

// Lastly, remove the whole .entry-summary container
document.querySelector("div.summary.entry-summary").remove();
