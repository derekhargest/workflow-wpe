/**
 * Theme main entry point.
 *
 * @package mindgrub-starter-theme
 */

import social from './components/social.js';
import ui from './components/ui.js';

/**
 * Initialize the app on DOM ready
 */
$(
	function() {
		social.init();
		ui.init();
	}
);
