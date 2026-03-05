jQuery(document).ready(function($) {

    $('#load-products').on('click', function() {

        var $loader = $('#products-loader');
        var $list = $('#products-list');

        $loader.show();
        $list.empty();

        $.ajax({
            url: api_ajax_obj.ajax_url,
            method: 'POST',
            data: { action: 'fetch_products' },
            success: function(response) {

                $loader.hide();

                if (response.success === false) {
                    $list.html('<p>Error loading products.</p>');
                    return;
                }

                response.forEach(function(product) {
                    var html = '<div class="product-card">';
                    html += '<img src="' + product.image + '" alt="' + product.title + '">';
                    html += '<h3>' + product.title + '</h3>';
                    html += '<p class="price">$' + product.price + '</p>';
                    html += '<button class="add-to-cart">Add to Cart</button>';
                    html += '</div>';
                    $list.append(html);
                });

            },
            error: function() {
                $loader.hide();
                $list.html('<p>AJAX request failed.</p>');
            }
        });

    });

});