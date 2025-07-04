// Кнопка "Купить в 1 клик" в каталоге и карточке товара
add_action('woocommerce_after_shop_loop_item', 'add_quick_order_button_spectra', 20);
add_action('woocommerce_after_add_to_cart_button', 'add_quick_order_button_spectra', 20);

function add_quick_order_button_spectra() {
    global $product;
    if (!$product) return;

    $id = $product->get_id();
    $title = esc_js($product->get_title());
    $price_html = esc_attr($product->get_price_html()); // Escaping как строка

    echo '<button 
        type="button"
        class="quick-order-btn spectra-popup-trigger-28694" 
        data-product-id="' . esc_attr($id) . '"
        data-title="' . esc_attr($title) . '"
        data-price-html="' . $price_html . '"
    >Купить в 1 клик</button>';
}
// JS-скрипт подстановки данных в попап
add_action('wp_footer', function () {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.spectra-popup-trigger-28694').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const title = btn.dataset.title || '';
                const price = btn.dataset.priceHtml || '';

                const popup = document.querySelector('.quick-order-popup-content');
                if (popup) {
                    const nameEl = popup.querySelector('.product-name');
                    const priceEl = popup.querySelector('.product-price');
                    if (nameEl) nameEl.innerHTML = title;
                    if (priceEl) priceEl.innerHTML = price;
                }

                const inputName = document.getElementById('cf7-product-name');
                const inputPrice = document.getElementById('cf7-product-price');
                if (inputName) inputName.value = title;
                if (inputPrice) inputPrice.value = price;
            });
        });
    });
    </script>
    <?php
});
