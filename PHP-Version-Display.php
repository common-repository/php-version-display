<?php
/**
 * @package PHP Version Display
 */
/**
 * Plugin Name: PHP Version Display
 * Plugin URI: https://wordpress.org/plugins/PHP-Version-Display/
 * Description: Display the currently PHP-MYSQL version at the end of "At a Glance" admin dashboard widget
 * Version: 1.0.1
 * Author: Amr Naga
 * Author URI:https://profiles.wordpress.org/amrnaga/
 * Text Domain: PHPVersionDisplay
 * Domain Path: /languages
 * License: GPLv2 or later 
 */
/*
{PHP Version Display} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
{PHP Version Display} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with {PHP Version Display}. If not, see {https://www.gnu.org/licenses/gpl-3.0.html}.
*/

 // For Security
 defined( 'ABSPATH' ) or die( 'Access Denied' );

 // Get Php And Mysql Version
 class phpMysqlVersion
 {
    public function Activate()
    {
        flush_rewrite_rules();
    }
    public function Deactivate()
    {
        flush_rewrite_rules();
    }
    public function GetPhpMysqlVersion()
    {
        $php_version = phpversion();
        $sql_info = mysqli_get_server_info( mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME ) );   
        $remove ='/^5.5.5-/i';
        $sql_version = preg_replace($remove,'',$sql_info);
        echo "PHP version: " . "<span style='color:darkgreen;font-weight: bold;'>" . esc_html( $php_version ) . "</span>"."<br>" 
        . " MySQL version: " . "<span style='color:darkgreen;font-weight: bold;'>" . esc_html( $sql_version ) . "</span>";
    }
 }

 $get_php_mysql_version = new phpMysqlVersion();
 register_activation_hook( __FILE__, [ $get_php_mysql_version, 'Activate' ] );
 register_deactivation_hook( __FILE__, [ $get_php_mysql_version, 'Deactivate' ] );
 add_action( 'activity_box_end', [ $get_php_mysql_version,'GetPhpMysqlVersion' ] );

 