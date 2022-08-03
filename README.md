# WPEngine Workflow for GMMB

This repository is a starting point for a modern WordPress workflow for GMMB and leverages the WPEngine hosting platform. This development product includes local development through lando, dependency management through webpack and deployment through GitHub actions. It uses WPEngine's deploy action to connect to the WPEngine Servers and deploy to each environment.

The theme uses Mindgrub's Wordpress Starter theme as a starting point. 

## Prerequisites

### For CI / CD through GitHub Actions:

GitHub: This product assumes the use of GitHub for version control and CI / CD ( this step only needs to be completed for one key )
* Generate a new SSH KEY - https://wpengine.com/support/ssh-keys-for-shell-access/#Generate_New_SSH_Key
* Add PRIVATE KEY to Organization Secrets

WPEngine: This product assumes a hosting provider of WPEngine. 
* Aquire access to GMMB's WPEngine account.
* Add the PUBLIC KEY to your WPEngine account by navigating to Profile > SSH keys > Create SSH key and pasting your public key in the field

### For Development:

* Install NVM - https://github.com/nvm-sh/nvm
* Install Lando - https://docs.lando.dev/getting-started/installation.html

:exclamation: Make sure all repo branches are up to date: we will be creating a new repo with DEV as a base.  The addition of this workflow is a good spot to sync all the environments. It is possible to update branches with the specific environments theme files, but is out of scope of these instructions. :exclamation:

## Installation

### As part of an existing project:

(These instructions assume the project does not have a current repo or a new repo will be created for the project with this new workflow. This also assumes the existing project is already on WPEngine.)

* Create new local installation of site if one has not already been set up:
	* Create new backup point in WPEngine, preferably from the dev environment so any code updates being worked on are included in your work
	* Prepare Zip from backup point
	* Download Zip when preparation is complete
	* Unzip to desired folder
	* run:
		```
		lando init
		```
			* select current folder as root
		```
		lando db-import wp-content/mysql.sql
		```
			* imports database from wpengine backup
		```
		lando wp search-replace '//wpengineurl.wpengine.com' '//desiredurl.lndo.site'
		```
	* change wp-config file to point to the lando database:
		
		```
		DB_NAME - wordpress
		DB_USER - wordpress
		DB_PASSWORD - wordpress
		DB_HOST - database
		```
* Add minimal working files from repo and remove minimal repo's git folder
	
	```
	git remote add origin https://github.com/derekhargest/workflow-wpe.git
	```
	```
	git pull origin minimal
	```
	```
	rm -rf .git
	```
* edit the .env file in the root of the theme, editing the variables with the names of the corresponding environments:
	
	```
	PROD_ENVIRONMENT=prodname
	STG_ENVIRONMENT=stgname
	DEV_ENVIRONMENT=devname
	THEME_NAME=themename
	```
* Change the proxy address in webpack.config.js > plugins > BrowserSyncPlugin if not done already
* Create repo in github
* Initialize git, add contents of the folder to the local repo, change the name of master to main, add the remote origin, create the staging branch from the main branch, create the dev branch from the main branch:

	```
	git init
	git add .
	git commit -m "first commit"
	git branch -M main
	git remote add origin git@github.com:[GMMBDevelopment/repo-name.git]
	git checkout -b stage main
	git checkout -b dev main
	```
* At this point, development can be started (see development) on local until first desired push
* When ready to push first commit:
	* git add ...
	* git commit -m ...
	* git push -u origin dev
* This will deploy any code changes to the development environment in WPEngine
* When ready, commit and deploy to the staging and production environments
* GitHub actions will run 'npm run build' and deploy the necessary files to the corresponding environments

### To start a new project:

* Create a new repo in GitHub
* Spin up a new WordPress site locally using lando: https://docs.lando.dev/wordpress/getting-started.html
* Using terminal, navigate to the wp-content/themes folder
* git clone this repo into the themes folder
* change the name of the folder to the desired theme name
* delete .git folder in the theme folder
* create a new site in wpengine
* create staging and dev environments for this new site in wpengine noting the name of the environments
* edit the .env file in the root of the theme, updating the variables with the names of the corresponding environments and theme name:

	``` 
	PROD_ENVIRONMENT=prodname
	STG_ENVIRONMENT=stgname
	DEV_ENVIRONMENT=devname
	THEME_NAME=themename
	```

* Change the proxy address in webpack.config.js > plugins > BrowserSyncPlugin
* In terminal in the theme folder - Initialize git, add contents of the folder to the local repo, change the name of master to main, add the remote origin, create the staging branch from the main branch, create the dev branch from the main branch:

	```
	git init
	git add .
	git commit -m "first commit"
	git branch -M main
	git remote add origin git@github.com:GMMBDevelopment/repo-name.git
	git checkout -b stage main
	git checkout -b dev main
	```

* At this point, development can be started (see development) on local until first desired push
* When ready to push first commit:
	* git add ...
	* git commit -m ...
	* git push -u origin dev
* This will deploy any code changes to the development environment in WPEngine
* When ready, commit and deploy to the staging and production environments
* Don't forget to select your theme as the active theme in wordpress' admin for each environment
* GitHub actions will run 'npm run build' and deploy the necessary files to the corresponding environments

## Development:

* In terminal, navigate to the local site's root
* run:
	* lando start
* In terminal, navigate to the desired theme folder
* run:
	* nvm install 14
	* nvm use 14
	* npm install
	* npm run start

## Notes:

This product comes with an exclude.txt file in the root, any files listed here will NOT be deployed to the environments. There is a preloaded default, just be aware this is where the node_modules folder, gitignore, etc are taken out of the payload deployed to the environments. It works like any .gitignore file.

That's it! Happy Developing! :smile: