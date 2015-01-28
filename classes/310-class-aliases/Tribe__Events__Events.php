<?php

if ( ! class_exists( 'Tribe__Events__Events' ) && class_exists( 'TribeEvents' ) ) {
	class Tribe__Events__Events extends TribeEvents {}
}
