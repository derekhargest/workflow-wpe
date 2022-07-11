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
	echo "NVM"
	curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.1/install.sh | bash
	export NVM_DIR="$([ -z "${XDG_CONFIG_HOME-}" ] && printf %s "${HOME}/.nvm" || printf %s "${XDG_CONFIG_HOME}/nvm")"
	[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh" # This loads nvm
	nvm install 14
	nvm use 14
	echo "Initiating NPM Install"
	npm install
	echo "Building"
	npm run build
fi