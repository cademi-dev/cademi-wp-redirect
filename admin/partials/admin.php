<div class="row mx-0 px-0">
    <div class="col-12">
        <img src="https://cademi.com.br/wp-content/uploads/2019/06/logo.png" class="d-block mx-auto my-5" style="max-width:280px;"/>
        <div class="text-center">
            Cademí Redirect v.1.0 instalado com <span class="text-success">sucesso.</span><br>
            Current Key: <span class="text-info"><?php echo $this->options['cademi_key'] ?></span>
        </div>
        <div class="col-6 mt-5 mx-auto">
            <form action="" method="post">
                 <?php wp_nonce_field('wp_create_nonce', 'cademi-redirect-nonce'); ?>
                <div class="form-group">
                    <label>Endereço da minha plataforma:</label>
                    <input type="text" class="form-control text-center" name="data[cademi_url]" value="<?php echo esc_attr( $this->options['cademi_url'] ); ?>"/>
                </div>
                <button type="submit" class="btn btn-success btn-rounded float-right">Salvar endereço</button>
            </form>
        </div>
    </div>
</div>
<style>
    #wpcontent{
        padding:0;
    }
</style>