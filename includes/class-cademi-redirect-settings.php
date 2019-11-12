<?php

class CademiRedirectSettings 
{
    static public $option_key = 'cademi_redirect_settings';
    static public $defaults = [
        'cademi_key' => 'f408cdd44b8115f6079393bf4a3ad2f3',
        'cademi_url' => ''
    ];

    public static function get()
    {
        $options    = self::$defaults;
        $options_wp = get_option(self::$option_key);

        if( !$options_wp ) {
            add_option( self::$option_key, $options );
            $options_wp = $options;
        }

        return $options_wp;
    }

    public static function set( $data )
    {
        if(!isset($data['cademi-redirect-nonce']) || wp_verify_nonce($data['cademi-redirect-nonce'])) {
            echo '<div class="alert alert-error text-center m-4">'. __( 'Erro ao salvar definições.', 'cademi-redirect' ).'</div>';
            return $data['data'];
        }

        update_option(self::$option_key, array_merge(self::get(), $data['data']));
        echo '<div class="alert alert-success text-center m-4">'. __( 'Definições salvas.', 'cademi-redirect' ).'</div>';

        return self::get();
    }
}