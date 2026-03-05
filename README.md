# API Products Plugin

A WordPress plugin to fetch products from an external API and display them with **AJAX-powered, responsive product cards**. Built to demonstrate **professional plugin development patterns** including `wp_ajax`, `wp_localize_script`, and dynamic UI updates.

---

## Features

- Fetch products from any external API (currently uses [Fake Store API](https://fakestoreapi.com/)).
- Display products in **modern, responsive product cards**.
- **AJAX loading** for better performance and user experience.
- Works for both logged-in and guest users.
- Easy to customize and extend.

---

## Installation

1. Clone or download the repository.
2. Upload the plugin folder to your WordPress `/wp-content/plugins/` directory.
3. Activate the plugin via the WordPress Admin Panel.
4. Use the shortcode `[api_products]` in any page or post.

---

## Usage

Add the shortcode anywhere you want to display the products:

```[api_products]```

It will show a **Load Products** button, and when clicked, products are fetched via AJAX and displayed dynamically.

---

## Screenshots

![Product Cards](https://via.placeholder.com/600x300?text=Product+Cards+Preview)

---

## Plugin Structure

- `api-products.php` - Main plugin file containing the PHP logic.
- `script.js` - JavaScript for AJAX requests and dynamic rendering.
- `style.css` - Styles for responsive product cards and layout.

---

## How It Works

1. The shortcode renders a container and a “Load Products” button.
2. When clicked, JS sends an **AJAX request** to `admin-ajax.php`.
3. PHP fetches products from the external API and returns JSON.
4. JS dynamically renders product cards inside the container.

---

## Contributing

Contributions are welcome! Feel free to submit pull requests or suggest improvements.

---

## License

This project is licensed under the MIT License.
