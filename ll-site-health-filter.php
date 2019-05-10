<?php

use Clarkson\Filters\SiteHealthFilter;

// Skip loading the site health filter if not in a WordPress context
if ( ! defined('WPINC') ) {
  return;
}
$siteHealthManager = new SiteHealthFilter();
