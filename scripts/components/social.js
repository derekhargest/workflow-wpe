/**
 * Module: social
 *
 * @package mindgrub-starter-theme
 */

var utilities = require( './utilities.js' );

var defaults = {
	channelAttrName: "share-channel"
};

/**
 * Constructor
 *
 * @param {Object} options Optional properties to override defaults
 */
function SocialShare(options) {
	this.options = $.extend( {}, defaults, options );
	this.init();
}

/**
 * Setup
 */
SocialShare.prototype.init = function () {
	let self = this;

	$( '[data-' + self.options.channelAttrName + ']' ).each(
		function() {

			$( this ).on(
				'click',
				function () {
					let data    = $( this ).data(),
					    channel = data[ utilities.dashToCamel( self.options.channelAttrName ) ],
					    url     = self[channel + 'Share']( data ),
					    popup = (url) ? window.open( url, 'share', 'resizable=yes,scrollbars=yes,width=600,height=500' ) : false;

					return false;
				}
			);
		}
	);
};

/**
 * Builds Facebook share url.
 *
 * Example button: <button data-share-channel="facebook" data-url="https://www.domain.com/example">Share on Facebook</button>.
 *
 * @return {String}
 */
SocialShare.prototype.facebookShare = function (details) {
	let url       = details.u || document.location.href,
	    title     = encodeURIComponent( details.title ),
	    final_url = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURI( url );

	if ( 'undefined' !== title && '' !== title ) {
	    final_url += '&t=' + title;
	}

	return final_url;
};

/**
 * Builds Twitter share url.
 *
 * @return {String}
 */
SocialShare.prototype.twitterShare = function (details) {
	let url       = details.url || document.location.href,
	    text      = encodeURIComponent( details.text.substring( 0, 140 ) ) || "",
	    hashtags  = encodeURIComponent( details.hashtags ) || "",
	    via       = encodeURIComponent( details.via ) || "",
	    final_url = 'http://twitter.com/share?url=' + encodeURI( url );

	if ( 'undefined' !== hashtags && '' !== hashtags ) {
	    final_url += '&hashtags=' + hashtags;
	}

	if ( 'undefined' !== via && '' !== via ) {
	    final_url += '&via=' + via;
	}

	if ( 'undefined' !== text && '' !== text ) {
	    final_url += '&text=' + text;
	}

	return final_url;
};

/**
 * Builds Pinterest share url.
 *
 * @return {String}
 */
SocialShare.prototype.pinterestShare = function (details) {
	let url         = details.url || document.location.href,
	    media       = encodeURI( details.media ) || "",
	    description = encodeURIComponent( details.description ) || "",
	    final_url   = 'http://www.pinterest.com/pin/create/button/?url=' + encodeURI( url );

	if ( 'undefined' !== media && '' !== media ) {
	    final_url += '&media=' + media;
	}

	if ( 'undefined' !== description && '' !== description ) {
	    final_url += '&description=' + description;
	}

	return final_url;
};

/**
 * Builds LinkedIn share url
 *
 * @return {String}
 */
SocialShare.prototype.linkedinShare = function (details) {
	let url       = details.url || document.location.href,
	    title     = encodeURIComponent( details.title ) || "",
	    summary   = encodeURIComponent( details.summary ) || "",
	    source    = encodeURIComponent( details.source ) || "",
	    final_url = 'https://www.linkedin.com/shareArticle?mini=true&url=' + encodeURI( url );

	if ( 'undefined' !== title && '' !== title ) {
	    final_url += '&title=' + title;
	}

	if ( 'undefined' !== summary && '' !== summary ) {
	    final_url += '&summary=' + summary;
	}

	if ( 'undefined' !== source && '' !== source ) {
	    final_url += '&source=' + source;
	}

	return final_url;
};

/**
 * Public API
 *
 * @type {Object}
 */
module.exports = {
	init: function (opts) {
		return new SocialShare( opts );
	}
};
