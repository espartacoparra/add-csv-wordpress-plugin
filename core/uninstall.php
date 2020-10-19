<?php
require_once('../../../../wp-load.php');
if (!current_user_can('manage_options')) {
    exit();
}
if ($defined("WP_UNISTALL_PLUGIN")) {
    die();
}
