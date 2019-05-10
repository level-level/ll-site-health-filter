# Site Health Filter <IN DEVELOPMENT>
---
Solution to hide sensitive data from the Wordpress Site Health Tool in the admin sidebar menu.

## How to install
---
You can simply install this package by adding it as a composer dependency.
After you've included the composer autoload file in your website, it should work automatically.

## How to view complete Site Health information
---
You can still view Site Health information, if the requirements below are followed.

1.	The current logged in user has permission to administrator.
2.	a) `?show_debug=true` is added to the url
	OR
	b) `WP_DEBUG` is set to `true` in `wp-config.php`
https://developer.wordpress.org/reference/classes/wp_site_health/
https://developer.wordpress.org/reference/classes/wp_debug_data/
