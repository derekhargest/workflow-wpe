/**
 * Postcss Config.
 *
 * @package mindgrub-starter-theme
 */

module.exports = {
	plugins: [
		require( 'autoprefixer' ),
		require( 'cssnano' )(
			{
				preset: 'default',
			}
		)
	]
}
