<?php

/*
 * Template Name: Cuentas
 *
 * The template for displaying the WPBilbao Community Accounting.
 *
 * @package WPBilbao\Template\Cuentas
 * @author  Ibon Azkoitia
 * @license GPL-2.0+
 * @link    http://www.kreatidos.com
 *
 */

/** Init WPBilbao Cuentas Page **/
add_action('genesis_meta', 'wpbilbao_template_cuentas');

function wpbilbao_template_cuentas() {

  // Add custom content to the entry footer.
  add_action('genesis_entry_footer', 'wpbilbao_template_cuentas_do_loop');

  // Force full with content.
  add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');

}

function wpbilbao_template_cuentas_do_loop() { ?>

  <div id="donaciones">
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
      <input name="cmd" type="hidden" value="_s-xclick">
      <input name="hosted_button_id" type="hidden" value="JZR46SV74MWYE">
      <input alt="Aportación a la Comunidad de WordPress" name="submit" src="<?php echo plugin_dir_url(__FILE__) . '../images/aportar.png'; ?>" type="image">
      <img src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" alt="" width="1" height="1">
    </form>
  </div><!-- #donaciones -->

  <div id="tabs-cuentas">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#2016" aria-controls="2016" role="tab" data-toggle="tab">2016</a></li>
      <li role="presentation"><a href="#2015" aria-controls="2015" role="tab" data-toggle="tab">2015</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="2016">
        <?php wpbilbao_loop_cuentas_2016(); ?>
      </div>
      <div role="tabpanel" class="tab-pane" id="2015">
        <?php wpbilbao_loop_cuentas_2015(); ?>
      </div>
    </div>
  </div><!-- #tabs-cuentas -->

<?php }

genesis();