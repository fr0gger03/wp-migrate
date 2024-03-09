<?php
/**
 * Bloglo Customizer custom select control class.
 *
 * @package     Bloglo
 * @author      Peregrine Themes
 * @since       1.0.0
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Bloglo_Customizer_Control_Sortable' ) ) :
	/**
	 * Bloglo Customizer custom select control class.
	 */
	class Bloglo_Customizer_Control_Sortable extends Bloglo_Customizer_Control {

		/**
		 * The control type.
		 *
		 * @var string
		 */
		public $type = 'bloglo-sortable';

		/**
		 * Should this element be sortable. Useful to control only visibility of items.
		 *
		 * @var boolean
		 */
		public $sortable = true;

		/**
		 * Set the default typography options.
		 *
		 * @since 1.0.0
		 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
		 * @param string               $id      Control ID.
		 * @param array                $args    Default parent's arguments.
		 */
		public function __construct( $manager, $id, $args = array() ) {// phpcs:ignore Generic.CodeAnalysis.UselessOverridingMethod.Found

			parent::__construct( $manager, $id, $args );
		}

		/**
		 * Refresh the parameters passed to the JavaScript via JSON.
		 *
		 * @see WP_Customize_Control::to_json()
		 */
		public function to_json() {
			parent::to_json();

			$this->json['choices']  = $this->choices;
			$this->json['sortable'] = $this->sortable;

			foreach ( $this->choices as $key => $value ) {
				if ( ! isset( $this->json['value'][ $key ] ) ) {
					$this->json['value'][ $key ] = $this->json['default'][ $key ];
				}
			}

			foreach ( $this->json['value'] as $key => $value ) {
				if ( ! isset( $this->json['choices'][ $key ] ) ) {
					unset( $this->json['value'][ $key ] );
				}
			}
		}

		/**
		 * An Underscore (JS) template for this control's content (but not its container).
		 *
		 * Class variables for this control class are available in the `data` JS object;
		 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
		 *
		 * @see WP_Customize_Control::print_template()
		 */
		protected function content_template() {
			?>
				<div class="bloglo-control-wrapper bloglo-sortable-wrapper">

					<label>
						<# if ( data.label ) { #>
							<div class="customize-control-title">
								<span>{{{ data.label }}}</span>

								<# if ( data.description ) { #>
									<i class="bloglo-info-icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
											<circle cx="12" cy="12" r="10"></circle>
											<path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
											<line x1="12" y1="17" x2="12" y2="17"></line>
										</svg>
										<span class="bloglo-tooltip">{{{ data.description }}}</span>
									</i>
								<# } #>

							</div>
						<# } #>
					</label>

					<ul class="bloglo-sortable-control">
						<# for ( key in data.value ) { #>
							<li class="bloglo-sortable-item<# if ( _.has( data.value, key) && ! data.value[ key ] || ! _.has( data.value, key ) && _.has( data.default, key ) && ! data.default[ key ] ) { #> invisible<# } #>" data-value="{{ key }}">
								<# if ( data.sortable ) { #>
									<i class="dashicons dashicons-menu"></i>
								<# } #>
								<i class="dashicons dashicons-visibility visibility dashicons-visibility-faint"></i>
								<span>{{{ data.choices[ key ] }}}</span>
							</li>
						<# } #>
					</ul>

				</div><!-- END .bloglo-control-wrapper -->
				<?php
		}
	}
endif;
