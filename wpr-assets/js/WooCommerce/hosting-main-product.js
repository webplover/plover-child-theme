document.querySelector(".hosting-starter-add-to-cart").appendChild(document.querySelector('a[data-product_sku="HST"]'));

document.querySelector(".hosting-bronze-add-to-cart").appendChild(document.querySelector('a[data-product_sku="HBR"]'));

document.querySelector(".hosting-silver-add-to-cart").appendChild(document.querySelector('a[data-product_sku="HSI"]'));

document.querySelector(".hosting-gold-add-to-cart").appendChild(document.querySelector('a[data-product_sku="HGO"]'));

document.querySelector(".hosting-platinum-add-to-cart").appendChild(document.querySelector('a[data-product_sku="HPL"]'));

document.querySelector(".hosting-diamond-add-to-cart").appendChild(document.querySelector('a[data-product_sku="HDI"]'));

// Lastly, remove the whole .entry-summary container
document.querySelector("div.summary.entry-summary").remove();
