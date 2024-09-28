<?php
namespace Hop_EL_Kit\Templates;

defined('ABSPATH') || die();

class Templates {
    private static $instance = null;

    public static function url(){
       return trailingslashit(plugin_dir_url( __FILE__ ));
    }

    public static function dir(){
        return trailingslashit(plugin_dir_path( __FILE__ ));
    }

    public static function version(){
        return '1.0.0';
    }

    public function init()
    {
        
        add_action( 'wp_enqueue_scripts', function() {       
            wp_enqueue_style( "hop-el-template-front", self::url() . 'assets/css/template-frontend.min.css' , ['elementor-frontend'], self::version() );  
            } 
        );
        
        add_action( 'elementor/editor/after_enqueue_scripts', function() {     
            wp_enqueue_style( "hop-load-template-editor", self::url() . 'assets/css/template-library.min.css' , ['elementor-editor'], self::version() );  
            wp_enqueue_script("hop-load-template-editor", self::url() . 'assets/js/template-library.min.js', ['elementor-editor'], self::version(), true); 
            $pro = get_option('__validate_author_dtaddons__', false);
            
            $localize_data = [
                'hasPro'                          => !$pro ? false : true,
                'templateLogo'                    => TEMPLATE_LOGO_SRC,
                'i18n' => [
                    'templatesEmptyTitle'       => esc_html__( 'No Templates Found', 'hop-elementor-kit' ),
                    'templatesEmptyMessage'     => esc_html__( 'Try different category or sync for new templates.', 'hop-elementor-kit' ),
                    'templatesNoResultsTitle'   => esc_html__( 'No Results Found', 'hop-elementor-kit' ),
                    'templatesNoResultsMessage' => esc_html__( 'Please make sure your search is spelled correctly or try a different words.', 'hop-elementor-kit' ),
                ],
                'tab_style' => json_encode(self::get_tabs()),
                'default_tab' => 'section'
            ];
            wp_localize_script(
                'hop-load-template-editor',
                'hopEditor',
                $localize_data
            );

            },
            999
        );

        add_action( 'elementor/preview/enqueue_styles', function(){
            $data = '.elementor-add-new-section .dlhop_templates_add_button {
                background-color: black !important;
                margin-left: 5px;
                font-size: 18px;
                vertical-align: bottom;
            }
            ';
            wp_add_inline_style( 'hop-el-template-front', $data );
        }, 999 );
    }

    public static function get_tabs() {
        return apply_filters('hop_editor/templates_tabs', [
            'section' => [ 'title' => 'Blocks'],
            'page' => [ 'title' => 'Ready Pages'],
        ]);
    }
    public static function instance(){
        if( is_null(self::$instance) ){
            self::$instance = new self();
        }
        return self::$instance;
    }
}

