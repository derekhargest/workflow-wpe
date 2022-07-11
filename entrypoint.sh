#!/bin/bash
# If any commands fail (exit code other than 0) entire script exits
set -e

# See if our project has a gulpfile either in the root directory if it's a theme
# or in the assets/ folder if it is a plugin

package_path="./package.json"
build_type=none

# Go to the working directory (current directory by default)
cd ${working_directory:-./}

# If we have composer dependencies make sure they are installed
if [ -f "$package_path" ]
then
	echo "Package File found. Starting build."
	composer install
	echo "Initiating NPM Install"
	npm install
	echo "Building"
	npm run build
fi