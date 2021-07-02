/**
 * pick #wpr_subscription_domain from after "checkout form" and put
 * inside .woocommerce-billing-fields to looks good
 */

wooBillingFields = document.querySelector(".woocommerce-billing-fields");

wprSubscriptionDomain = document.querySelector("#wpr_subscription_domain");

if (wooBillingFields && wprSubscriptionDomain) {
  wooBillingFields.appendChild(wprSubscriptionDomain);
}
