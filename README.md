# Mindgrub Starter Theme

This is a WordPress theme intended to be used as a starting point for making a custom theme.

## Build Process

This theme uses NPM and webpack to build and optimize front end assets including CSS, JS, and images. After running an `npm install` from the theme root you will be able to utilize the following commands.

> **<em>NOTE: The theme now uses Webpack 5 and has been tested up to the following dependency versions. Use [nvm](https://github.com/nvm-sh/nvm) to switch between versions if needed.</em>**
> - **node: v14.0.0**
> - **npm: v6.14.4**
>
> And requires a minimum of:
> - **node: v12.0.0**
> - **npm: v6.9.0**
>
> Some projects may need their CI/CD scripts updated to ensure that these versions of
> node/npm are supported. It's possible that the image used can support it, but if not, there is an easy solution: nvm.
> You would want to add the following right before `npm run build` is being executed:
> ```html
> - curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.1/install.sh | bash
> - ". ~/.nvm/nvm.sh"
> - nvm install v12.0.0
```

### npm run start
This command will run webpack in watch mode. Any changes made to the front end assets will trigger the build process. This command will also start a browser sync instance at http://localhost:3791. It will use a proxy URL defined in webpack.config.js. If you get a 404 error it most likely means that the proxy URL differs from the configured Lando URL.

### npm run build
This command will run webpack once with several optimizations that are too slow for watch mode. Typically this command is run as part of our CI deployment process.

### Actions
The build script
* Transpiles ECMASCRIPT 2015+ JavaScript using Babel.
* Minifies .js and .css files.
* Adds browser prefixes for CSS rules using autoprefixer.
* Compiles .scss files.
* Creates sourcemaps for .scss and .js files.
* Creates dist directory with the built images, fonts, styles, and scripts.

## Special Notes
This theme uses a wrapper to put the header and footer around the main content; there's no need to include the header and footer in individual webpage templates.

## Structure
The following is a description of the structure and purpose of each of the theme directories.

### acf-json
When this directory is present within a theme the Advanced Custom Fields (ACF) plugin will automatically save configuration changes to JSON files in addition to the database. When displaying fields ACF will prioritize using the JSON files as the source of truth over the database. This allows us to commit our ACF configuration to code rather than sync the configuration between environments via the database.

### dist
The webpack build process places optimized assets in this directory.

#### fonts
Should contain fonts that are not pulled from the web. A config should be kept here for custom generated icon fonts ( i.e. from Fontello ).

#### images
Should contain images used by the theme that are not sourced from the CMS.

### includes
Contains custom PHP functions, classes, filters, and actions used by the theme.

*  admin-cleanup - Removes unused features from the admin dashboard.
*  admin-editor - Customizations and additions to the admin WYSIWYG editor (TinyMCE).
*  admin - General admin dashboard customizations and additions.
*  enqueue - Handles the loading of scripts and styles on both the front and backends.
*  image-functions - Image helper functions.
*  misc-functions - General helper functions.
*  text-funcitons - Text helper functions.
*  theme-functions - Theme specific functions.
*  theme-hooks - Theme specific filters and actions.
*  video-functions - Video helper functions.
*  wrapper - Implements a theme "wrapper" which improves code reuse when creating new templates.

### partials
Should contain WordPress templates for contained, reusable components for use in full WordPress templates.

### plugins
Contains filters and actions specific to functions we commonly use.

### scripts
Contains JS source files used by the theme. Wherever possible components have been separated out and the files in the root scripts directory are only entry points. Components are written as [CommonJS](https://flaviocopes.com/commonjs/) modules where possible. Modules with backend dependencies ( i.e. those that call functions via AJAX ) should be named the same as their PHP counterparts in includes. Note that jQuery is loaded as an external by Webpack as many WordPress functions rely on a global jQuery library. You may use it without requiring or importing it.

* admin - Used to override default behavior in the WordPress admin dashboard.
* theme - Used to provide behavior for the front end of the site.

### styles
Contains SCSS source files used by the theme. Wherever possible components have been separated out and the files in the root styles directory are only entry points. The [BEM](http://getbem.com/) methodology is used wherever possible and top level blocks typically correspond to template partials.

Please read Mindgrub's [Front-End Development](https://mindgrub.atlassian.net/wiki/spaces/WEB/pages/1499627541/Front-End+Development) document on Confluence for more guidance and information on our standards.

* admin - Used to override defaults in the WordPress admin dashboard.
* editor - Used to style the admin WYSIWYG editor to more closely match the front end.
* theme - Used to style the front end of the site.

### taxonomies
Contains boilerplate for custom taxonomy definitions.

### types
Contains boilerplate for custom post type definitions.
