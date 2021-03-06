[![GitHub Actions status](https://github.com/level-level/ll-site-health-filter/workflows/Build%20%26%20test/badge.svg)](https://github.com/level-level/ll-site-health-filter/actions)

# Site Health Filter <IN DEVELOPMENT>

Solution to hide sensitive data from the Wordpress Site Health Tool in the admin sidebar menu.
It will do the same for the WooCommerce status page.

## How to install

You can simply install this package by adding it as a composer dependency.
After you've included the composer autoload file in your website, it should work automatically.

## How to view complete Site Health information

You can still view Site Health information, if the requirements below are followed.

1.	The current logged in user has permission to administrator.
2.	One of the following is true:
	* a) `?show_debug=true` is added to the url
	* b) `WP_DEBUG` is set to `true` in `wp-config.php`

## Wordpress reference

More information about the Wordpress status and debug pages can be found in the [WP_Site_Health](https://developer.wordpress.org/reference/classes/wp_site_health/) and [WP_Debug_data](https://developer.wordpress.org/reference/classes/wp_debug_data/) documentation.

## WooCommerce reference

More information about the WooCommerce status pages can be found in the [WC_Admin_Status](https://docs.woocommerce.com/wc-apidocs/class-WC_Admin_Status.html) documentation.

## Author

Level Level

Website: [https://level-level.com](https://level-level.com)

Email: [info@level-level.com](mailto:info@level-level.com)
