<?php
namespace Fragen\Category_Colors;

use Tribe__Events__Main;

$teccc = Main::instance();

?>
<div id="legend_box" class="teccc-legend">

    <ul id="legend">

        <?php foreach ( $teccc->terms as $id => $attributes ): ?>
            <?php
            $slug = esc_attr( $attributes[ Main::SLUG ] );
            $name = esc_attr( $attributes[ Main::NAME ] );
            $link = get_term_link( $id, Tribe__Events__Main::TAXONOMY );
            ?>
            <li class="tribe-events-category-<?php echo $slug ?> tribe-events-category-<?php esc_attr_e( $id ) ?>">
                <a href="<?php echo $link ?>">
                    <?php echo $name ?>
                </a>
                <input type="hidden" value="<?php echo $slug ?>" />
            </li>
        <?php endforeach ?>

	    <?php $options = get_option( 'teccc_options' ); ?>
	    <?php if ( isset( $options['show_ignored_cats_legend'] ) ): ?>
		    <?php foreach ( $teccc->ignored_terms as $ignored_term ): ?>
			    <?php
			    $slug = esc_attr( $ignored_term[0] );
			    $name = esc_attr( $ignored_term[1] );
			    $link = get_term_link( $ignored_term[0], Tribe__Events__Main::TAXONOMY );
			    ?>
			    <li class="teccc-hidden-category">
				    <a href="<?php echo $link ?>">
					    <?php echo $name ?>
				    </a>
				    <input type="hidden" value="<?php echo $slug ?>" />
			    </li>
		    <?php endforeach ?>
	    <?php endif ?>

    </ul>

</div>
