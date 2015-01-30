<div id="legend_box" class="teccc-legend">

    <ul id="legend">

        <?php foreach ( $teccc->terms as $id => $attributes ): ?>
            <?php
            $slug = esc_attr( $attributes[ Tribe__Events__Category_Colors__Main::SLUG ] );
            $name = esc_attr( $attributes[ Tribe__Events__Category_Colors__Main::NAME ] );
            $link = get_term_link( $id, Tribe__Events__Events::TAXONOMY );
            ?>
            <li class="tribe-events-category-<?php echo $slug ?> tribe-events-category-<?php esc_attr_e( $id ) ?>">
                <a href="<?php echo $link ?>">
                    <?php echo $name ?>
                </a>
                <input type="hidden" value="<?php echo $slug ?>" />
            </li>

        <?php endforeach ?>

    </ul>

</div>