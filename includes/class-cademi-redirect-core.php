<?php

class CademiRedirectCore
{
	public function __construct($loader)
	{
		$this->options = CademiRedirectSettings::get();
		
		$loader->add_action('init', $this, 'taxonomyCreate');
		$loader->add_action('pre_insert_term', $this, 'taxonomyBlock', 0, 2);
		$loader->add_action('template_redirect', $this, 'check');
	}

	public function check()
	{
		if(is_admin())
            return; 
        
        if( ! is_page())
            return;
        
        if(is_preview())
            return;
        
        if( ! in_array(get_queried_object_id(), $this->getPagesID()))
            return;
       
        if( isset($_GET['cademi_key']) && $_GET['cademi_key'] == $this->options['cademi_key'] )
            return;

        global $wp;
        $url = urlencode(base64_encode(home_url( $wp->request )));
        wp_redirect($this->options['cademi_url'].'/auth/login?redirect=/browse/remote/frame/'.$url);
        exit;
	}

	public function getPagesID()
	{
		return get_posts([
			'numberposts' 	=> -1,
			'post_type'		=> 'page',
			'tax_query'		=> [
				[
					'taxonomy' 	=> '_c_r_check',
					'field'	   	=> 'slug',
					'terms'		=> 'sim'
				]
			],
			'fields' => 'ids'
		]);
	}

	public function taxonomyCreate()
	{
		register_taxonomy(
	        '_c_r_check',
	        'page',
	        array(
	            'label' 			=> __( 'Redirecionar para Cademí?' ),
	            'rewrite' 			=> array( 'slug' => 'cademi_redirect' ),
	            'hierarchical' 		=> true,
	            'show_ui'           => true,
            	'show_admin_column' => true,
            	'show_in_menu'		=> false,
            	'show_in_rest' 		=> true
	        )
	    );

	    $sim_exists = term_exists('sim', '_c_r_check');
	    if( ! $sim_exists )
	    	wp_insert_term('Sim', '_c_r_check', ['slug' => 'sim']);
    }

    public function taxonomyBlock($term, $taxonomy)
    {
    	return ('_c_r_check' === $taxonomy) ?
    		new WP_Error('term_addition_blocked', __('Não é possível adicionar categorias aqui.')) :
    		$term;
    }

}