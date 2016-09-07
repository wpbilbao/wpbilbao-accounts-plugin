<?php

/*
 * Loop Cuentas 2015
 *
 * @package WPBilbao\Cuentas\LoopCuentas2015
 * @author  Ibon Azkoitia
 * @license GPL-2.0+
 * @link    https://www.wpbilbao.es
 *
 */

/** Loop Cuentas 2015 - Gastos **/
function wpbilbao_loop_cuentas_2015() {

  $totalIngresos = 0;
  $totalGastos = 0;

  ?>

  <div class="cuentas row">
    <div class="gastos col-xs-12 col-sm-6">

      <h2><?php _e('Gastos', 'wpbilbao'); ?></h2>

      <div class="table-responsive">
        <table class="table">
          <thead>
          <tr>
            <th><?php _e('Fecha', 'wpbilbao'); ?></th>
            <th><?php _e('Descripción', 'wpbilbao'); ?></th>
            <th class="text-right"><?php _e('Cantidad', 'wpbilbao'); ?></th>
          </tr>
          </thead>

          <tbody>

          <?php
          global $post;

          /*
           * Seleccionamos los argumentos necesarios para el loop
           *
           * En este caso el Custom Post Type es 'cuentas'
           * Orden Ascendente
           * Buscamos por la taxonomía, en este caso solo hay una 'tipo'. Esta tiene 2 categorías, Gastos e Ingresos.
           * Asignamos la ID de la categoría que queremos, en este caso Gastos = ID 131
           * Cuentas por Página: 100
           */
          $args = wp_parse_args(
            genesis_get_custom_field('query_args'),
            array(
              'post_type'      => 'cuentas',
              'order'          => 'ASC',
              'tax_query'      => array(
                array(
                  'taxonomy' => 'tipo',
                  'terms'    => '26',
                  'operator' => 'IN' //o 'AND' o 'NOT IN'
                )),
              'post_status'    => 'publish',
              'posts_per_page' => 100,
              'year' => 2015
            )
          );

          global $wp_query;
          $wp_query = new WP_Query($args); ?>

          <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>

              <tr>
                <td><?php the_field('cuentas_fecha'); ?></td>
                <td>
                  <?php if (get_field('cuentas_factura')) { ?>
                    <a href="<?php the_field('cuentas_factura'); ?>" title="<?php the_field('cuentas_descripcion'); ?>"
                       target="_blank"><i class="fa fa-file-text"></i></a>
                  <?php } ?>
                  <?php the_field('cuentas_descripcion'); ?>
                </td>
                <td class="precio"><?php the_field('cuentas_cantidad') ?> €</td>
              </tr>

              <?php
                $cuentasCantidadGastos = get_field('cuentas_cantidad');
                $totalGastos = $totalGastos + $cuentasCantidadGastos;
              ?>

            <?php endwhile; // End of one post. ?>
          <?php else : // If no posts exist. ?>
            <?php do_action('genesis_loop_else'); ?>
          <?php endif; //* End of the loop. ?>

          <?php wp_reset_query(); ?>

          <tr>
            <td></td>
            <td class="text-right"><strong><?php _e('TOTAL', 'wpbilbao'); ?>:</strong></td>
            <td class="precio"><strong><?php echo $totalGastos . ' €'; ?></strong></td>
          </tr>
          </tbody>
        </table>
      </div><!-- .responsive-table -->
    </div><!-- .gastos -->


    <div class="ingresos col-xs-12 col-sm-6">
      <h2><?php _e('Ingresos', 'wpbilbao'); ?></h2>

      <div class="table-responsive">
        <table class="table">
          <thead>
          <tr>
            <th><?php _e('Fecha', 'wpbilbao'); ?></th>
            <th><?php _e('Descripción', 'wpbilbao'); ?></th>
            <th class="text-right"><?php _e('Cantidad', 'wpbilbao'); ?></th>
          </tr>
          </thead>

          <tbody>

          <?php

          global $post;

          /*
           * Seleccionamos los argumentos necesarios para el loop
           *
           * En este caso el Custom Post Type es 'cuentas'
           * Orden Ascendente
           * Buscamos por la taxonomía, en este caso solo hay una 'tipo'. Esta tiene 2 categorías, Gastos e Ingresos.
           * Asignamos la ID de la categoría que queremos, en este caso Ingresos = ID 130
           * Cuentas por Página: 100
           */
          $args = wp_parse_args(
            genesis_get_custom_field('query_args'),
            array(
              'post_type'      => 'cuentas',
              'order'          => 'ASC',
              'tax_query'      => array(
                array(
                  'taxonomy' => 'tipo',
                  'terms'    => '27',
                  'operator' => 'IN' //Or 'AND' or 'NOT IN'
                )),
              'post_status'    => 'publish',
              'posts_per_page' => 100,
              'year' => 2015
            )
          );

          global $wp_query; ?>
          <?php $wp_query = new WP_Query($args); ?>

          <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>

              <tr>
                <td><?php the_field('cuentas_fecha'); ?></td>
                <td>
                  <?php if (get_field('cuentas_factura')) { ?>
                    <a href="<?php the_field('cuentas_factura'); ?>" title="<?php the_field('cuentas_descripcion'); ?>"
                       target="_blank"><i class="fa fa-file-text"></i></a>
                  <?php } ?>
                  <?php the_field('cuentas_descripcion'); ?>
                </td>
                <td class="precio"><?php the_field('cuentas_cantidad') ?> €</td>
              </tr>

              <?php
                $cuentasCantidadIngresos = get_field('cuentas_cantidad');
                $totalIngresos = $totalIngresos + $cuentasCantidadIngresos;
              ?>

            <?php endwhile; // End of one post. ?>
          <?php else : // If no posts exist. ?>
            <?php do_action('genesis_loop_else'); ?>
          <?php endif; //* End of the loop. ?>

          <?php wp_reset_query(); ?>

          <tr>
            <td></td>
            <td class="text-right"><strong><?php _e('TOTAL', 'wpbilbao'); ?>:</strong></td>
            <td class="precio"><strong><?php echo $totalIngresos . ' €'; ?></strong></td>
          </tr>
          </tbody>
        </table>
      </div><!-- .responsive-table -->
    </div><!-- .ingresos -->
  </div> <!-- .cuentas -->

  <div id="total-cuentas" class="text-center">
    <?php
    /*
     * Check if Total it's positive or negative.
     * If Negative, the H2 tag would have the "text-danger" class.
     * If Positive, the H2 tag would have the "text-sucess" class.
     *
     * As the input it's Numeric type, we have to add the € symbol.
     */

    $cuentasTotal = $totalIngresos - $totalGastos;
    if ($cuentasTotal < 0) : ?>
      <h2><?php _e('TOTAL', 'wpbilbao'); ?>: &nbsp; &nbsp; <strong
          class="text-danger"><?php echo $cuentasTotal ?> €</strong></h2>
    <?php else : ?>
      <h2><?php _e('TOTAL', 'wpbilbao'); ?>: &nbsp; &nbsp; <strong
          class="text-success"><?php echo $cuentasTotal ?> €</strong></h2>
    <?php endif; ?>
  </div><!-- #total-cuentas -->

<?php }
