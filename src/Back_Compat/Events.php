<?php

if ( ! class_exists( 'Tribe__Events__Main' ) && class_exists( 'TribeEvents' ) ) {
	class Tribe__Events__Main extends TribeEvents {}
}
