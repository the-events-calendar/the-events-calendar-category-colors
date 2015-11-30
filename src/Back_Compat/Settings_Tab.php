<?php

if ( ! class_exists( 'Tribe__Events__Settings_Tab' ) && class_exists( 'TribeSettingsTab' ) ) {
	class Tribe__Events__Settings_Tab extends TribeSettingsTab {}
}
if ( ! class_exists( 'Tribe__Settings_Tab' ) && class_exists( 'TribeSettingsTab' ) ) {
	class Tribe__Settings_Tab extends TribeSettingsTab {}
}
