<?php
/*
* Plugin Name: Youtube to Mp3 Converter
* Plugin URI: https://alamgir.website
* Version: 1.0.0
* Author: Alamgir
* Author URI: http://alamgir.website
* Description: This is very simple Youtube Video to MP3 Converter WordPress Plugin
* Text Domain: yttmp3
* @package: YTTMP3
* License: GPL2 or Later
*/


if( !defined( 'ABSPATH' ) ){
	exit();
}



Class Youtube_To_MP3_Converter{

    // define plugin version here
    public $version;

    // define text domain here
    public $text_domain;

    // plugin url
    public $yttmp3_plugin_url;

    function __construct()
    {

        // inits installations
        $this->version          = '1.0.0';
        $this->text_domain      = 'yttmp3';
        $this->yttmp3_plugin_url  = plugin_basename(__FILE__);
        $this->yttmp3_plugin_define_func;

        // plugin activate and deactivated hooks
        register_activation_hook(__FILE__, array( $this , 'yttmp3_plugin_active_func' ) );
        register_deactivation_hook(__FILE__, array( $this , 'yttmp3_plugin_deactive_func' ) );

        // register scripts and styles
        add_action( 'admin_enqueue_scripts', array( $this, 'yttmp3_plugin_enqueue_scripts_admin') );
        add_action( 'wp_enqueue_scripts', array( $this, 'yttmp3_plugin_enqueue_scripts_frontend') );

        // add yttmp3_create_short_code
        add_shortcode('yttmp3-form', array( $this, 'yttmp3_create_short_code' ) );
        add_shortcode('yttmp3-video-to-mp3', array( $this, 'yttmp3_get_video_to_mp3' ) );
        add_shortcode('yttmp3-download', array( $this, 'yttmp3_get_video_to_mp3_download' ) );
        add_shortcode('yttmp3-youtube-image', array( $this, 'yttmp3_get_youtube_image' ) );

        // add menu
        add_action( 'admin_menu', array($this, 'yttmp3_plugin_add_setting_pages' ) );

        // add settings links
        add_filter( 'plugin_action_links_'.$this->yttmp3_plugin_url, array($this, 'yttmp3_plugin_add_setting_link') );

    }

    /**
     * yttmp3 plugin add setting link
     *
     */
    public function yttmp3_plugin_add_setting_link( $links ) {
        $settings_link = '<a href="admin.php?page=youtube-to-mp3">Settings</a>';
        array_push($links, $settings_link);
        return $links;
    }

    /**
     * yttmp3 plugin add setting pages
     */
    public function yttmp3_plugin_add_setting_pages() {
        add_menu_page('Youtube To MP3', 'Youtube To MP3', 'manage_options', 'youtube-to-mp3', array($this, 'yttmp3_plugin_setting_page_content'), 'dashicons-video-alt3', 110);
    }

    /**
     * yttmp3 plugin setting page content
     */
    public function yttmp3_plugin_setting_page_content() {
        require_once dirname( __FILE__ ).'/templates/admin_settings_page.php';
    }

    /**
     * yttmp3 show form create short code
     */
    public function yttmp3_create_short_code() {
        require_once dirname( __FILE__ ).'/form.php';
    }

    /**
     * yttmp3 get video to mp3 create short code
     */
    public function yttmp3_get_video_to_mp3() {
        require_once dirname( __FILE__ ).'/getvideo.php';
    }

    /**
     * yttmp3 get video to mp3 image create short code
     */
    public function yttmp3_get_youtube_image() {
        require_once dirname( __FILE__ ).'/getimage.php';
    }

    /**
     * yttmp3 download
     */
    public function yttmp3_get_video_to_mp3_download() {
        require_once dirname( __FILE__ ).'/mp3_download.php';
    }

    /*
     * Get page by slug
     *
     * @param $slug
     *
     * @return boolean
     */
    public function yttmp3_get_page_by_slug( $slug ) {
        if ($pages = get_pages())
            foreach ($pages as $page)
                if ($slug === $page->post_name) return $page;
        return false;
    }


    /*
     * When plugin uninstall then this function will call
     */
    public function yttmp3_plugin_uninstall() {
        // will add option in future
    }

    /*
     * Register Admin Area Styles/Scripts
     */
    public function yttmp3_plugin_enqueue_scripts_admin() {
        // will add in future if need any script/style in admin area
    }

    /*
     * Register Frontend area Styles/Scripts
     */
    public function yttmp3_plugin_enqueue_scripts_frontend() {
        wp_enqueue_style('yttmp3-bootstrap.min', plugins_url('/youtube-to-mp3/css/bootstrap.min.css'));
        wp_enqueue_style('yttmp3-custom', plugins_url('/youtube-to-mp3/css/custom.css'));

        wp_enqueue_script('yttmp3-bootstrap', plugins_url('/youtube-to-mp3/js/bootstrap.js'));
        wp_enqueue_script('yttmp3-bootstrap.min', plugins_url('/youtube-to-mp3/js/bootstrap.min.js'));
        wp_enqueue_script('yttmp3-jquery.min', plugins_url('/youtube-to-mp3/js/jquery.min.js'));
        wp_enqueue_script('yttmp3-npm', plugins_url('/youtube-to-mp3/js/npm.js'));
    }

    public function yttmp3_plugin_define_func() {
       define('WPMP_VERSION', $this->version);
       define('WPMP_TEXT_DOMAIN', $this->text_domain);
       define('WPMP_PLUGIN_URL', basename(__FILE__));
       define('WPMP_ASSETS_URL', basename(__FILE__).'/assets/');
    }

    public function yttmp3_plugin_active_func() {

        // create yttmp3 get video to mp3 page
        if( !$this->yttmp3_get_page_by_slug( 'youtube-video-to-mp3-convert' ) ) {
            $yttmp3_get_video_to_mp3 = array(
                'post_title'    => 'Youtube Video to MP3 Convert',
                'post_content'  => '[yttmp3-video-to-mp3]',
                'post_type'     => 'page',
                'post_status'   => 'publish'
            );
            wp_insert_post($yttmp3_get_video_to_mp3);
        }

        // create yttmp3 mp3 download page
        if( !$this->yttmp3_get_page_by_slug( 'youtube-video-to-mp3-download' ) ) {
            $yttmp3_get_download = array(
                'post_title'    => 'Youtube Video to MP3 Download',
                'post_content'  => '[yttmp3-download]',
                'post_type'     => 'page',
                'post_status'   => 'publish'
            );
            wp_insert_post($yttmp3_get_download);
        }

        // call plugin activation
        flush_rewrite_rules();
    }

    public function yttmp3_plugin_deactive_func() {
        // call plugin deactivation
        flush_rewrite_rules();
    }


    function __destruct()
    {
        // TODO: Implement __destruct() method.

    }


}


/*
 * Check Main class exist or not
 */
if( class_exists('Youtube_To_MP3_Converter') ) {
    $youtube_to_mp3_converter = new Youtube_To_MP3_Converter();
}else{
    die('Sorry! Youtube_To_MP3_Converter class is not define yet');
}
