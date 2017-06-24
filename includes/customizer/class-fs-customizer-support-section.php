<?php
	/**
	 * @package     Freemius
	 * @copyright   Copyright (c) 2015, Freemius, Inc.
	 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
	 * @since       1.2.2.7
	 */

	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	/**
	 * Class Zerif_Customizer_Theme_Info_Main
	 *
	 * @since  1.0.0
	 * @access public
	 */
	class FS_Customizer_Support_Section extends WP_Customize_Section {

		function __construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );
		}

		/**
		 * The type of customize section being rendered.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $type = 'freemius-support-section';

		/**
		 * @var Freemius
		 */
		public $freemius = null;

		/**
		 * Add custom parameters to pass to the JS via JSON.
		 *
		 * @since  1.0.0
		 */
		public function json() {
			$json = parent::json();

			$is_contact_visible = $this->freemius->is_submenu_item_visible( 'contact', true );
			$is_support_visible = $this->freemius->is_submenu_item_visible( 'support', true );

			$json['theme_title'] = $this->freemius->get_plugin_name();

			if ( $is_contact_visible && $is_support_visible ) {
				$json['theme_title'] .= ' ' . $this->freemius->get_text( 'support' );
			}

			if ( $is_contact_visible ) {
				$json['contact'] = array(
					'label' => $this->freemius->get_text( 'contact-us' ),
					'url'   => $this->freemius->contact_url(),
				);
			}

			if ( $is_support_visible ) {
				$json['support'] = array(
					'label' => $this->freemius->get_text( 'support-forum' ),
					'url'   => $this->freemius->apply_filters( 'support_forum_url', 'https://wordpress.org/support/' . $this->freemius->get_module_type() . '/' . $this->freemius->get_slug() )
				);
			}

			return $json;
		}

		/**
		 * Outputs the Underscore.js template.
		 *
		 * @since  1.0.0
		 */
		protected function render_template() {
			?>
			<li id="fs_customizer_support"
			    class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
				<h3 class="accordion-section-title">
					<span>{{ data.theme_title }}</span>
					<# if ( data.contact && data.support ) { #>
					<div class="button-group">
					<# } #>
						<# if ( data.contact ) { #>
							<a class="button" href="{{ data.contact.url }}" target="_blank">{{ data.contact.label }} </a>
							<# } #>
						<# if ( data.support ) { #>
							<a class="button" href="{{ data.support.url }}" target="_blank">{{ data.support.label }} </a>
							<# } #>
					<# if ( data.contact && data.support ) { #>
					</div>
					<# } #>
				</h3>
			</li>
			<?php
		}
	}