<?php
// WC Hooks used: woocommerce_customer_save_address
//
// The following snippet could be used within your WooCommerce shop to get a notification when a customer changes the billing and/or shipping address.
// The code must be inserted in the functions.php of your theme!
// You'll get a message that contains both addresses directly within the eMail.
//
// IMPORTANT: Change the placeholder EXAMPLE@EXAMPLE.COM eMail on line 43!
//
function ith_os__notify_by_change_of_address( $userId, $loadAddress) {
    $userInfo = get_userdata($userId);
    
    $customer = new WC_Customer($userId);
    $billingAddress = $customer->get_billing();
    $shippingAddress = $customer->get_shipping();
    
    $message = "Der Nutzer " . $userInfo->user_login . " hat seine Adresse geändert. Die neuen Adressen lauten: \n\n";
    $message .= "Rechnungsadresse: \n";
    $message .= "Name: " . (!empty($billingAddress['first_name']) ? wp_kses_post($billingAddress['first_name']) : '-') . " " . (!empty($billingAddress['last_name']) ? wp_kses_post($billingAddress['last_name']) : '-') . "\n";
    $message .= "Firma: " . (!empty($billingAddress['company']) ? wp_kses_post($billingAddress['company']) : '-') . "\n";
    $message .= "Straße und Hausnummer: " . (!empty($billingAddress['address_1']) ? wp_kses_post($billingAddress['address_1']) : '-') . "\n";
    $message .= "Adresszusatz: " . (!empty($billingAddress['address_2']) ? wp_kses_post($billingAddress['address_2']) : '-') . "\n";
    $message .= "Stadt: " . (!empty($billingAddress['city']) ? wp_kses_post($billingAddress['city']) : '-') . "\n";
    $message .= "Postleitzahl: " . (!empty($billingAddress['postcode']) ? wp_kses_post($billingAddress['postcode']) : '-') . "\n";
    $message .= "Land: " . (!empty($billingAddress['country']) ? wp_kses_post($billingAddress['country']) : '-') . "\n";
    $message .= "Bundesland: " . (!empty($billingAddress['state']) ? wp_kses_post($billingAddress['state']) : '-') . "\n";
    $message .= "eMail: " . (!empty($billingAddress['email']) ? wp_kses_post($billingAddress['email']) : '-') . "\n";
    $message .= "Telefonnummer: " . (!empty($billingAddress['phone']) ? wp_kses_post($billingAddress['phone']) : '-') . "\n\n";
    
    $message .= "---\n\n";

    $message .= "Lieferadresse: \n";
    $message .= "Name: " . (!empty($shippingAddress['first_name']) ? wp_kses_post($shippingAddress['first_name']) : '-') . " " . (!empty($shippingAddress['last_name']) ? wp_kses_post($shippingAddress['last_name']) : '-') . "\n";
    $message .= "Firma: " . (!empty($shippingAddress['company']) ? wp_kses_post($shippingAddress['company']) : '-') . "\n";
    $message .= "Straße und Hausnummer: " . (!empty($shippingAddress['address_1']) ? wp_kses_post($shippingAddress['address_1']) : '-') . "\n";
    $message .= "Adresszusatz: " . (!empty($shippingAddress['address_2']) ? wp_kses_post($shippingAddress['address_2']) : '-') . "\n";
    $message .= "Stadt: " . (!empty($shippingAddress['city']) ? wp_kses_post($shippingAddress['city']) : '-') . "\n";
    $message .= "Postleitzahl: " . (!empty($shippingAddress['postcode']) ? wp_kses_post($shippingAddress['postcode']) : '-') . "\n";
    $message .= "Land: " . (!empty($shippingAddress['country']) ? wp_kses_post($shippingAddress['country']) : '-') . "\n";
    $message .= "Bundesland: " . (!empty($shippingAddress['state']) ? wp_kses_post($shippingAddress['state']) : '-') . "\n";
    $message .= "Telefonnummer: " . (!empty($shippingAddress['phone']) ? wp_kses_post($shippingAddress['phone']) : '-') . "\n\n";

    wp_mail('EXAMPLE@EXAMPLE.COM', 'Benachrichtigung: Adressänderung durch Nutzer', $message);
}
add_action('woocommerce_customer_save_address', 'ith_os__notify_by_change_of_address', 10, 3);
