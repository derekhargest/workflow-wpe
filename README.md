<<<<<<< Updated upstream
# Mindgrub Starter Theme DEV BRANCH
=======
# WPEngine Workflow for GMMB
>>>>>>> Stashed changes

This repository is a starting point for a modern WordPress workflow for GMMB and leverages the WPEngine hosting platform. This development product includes local development through lando, dependency management through webpack and deployment through GitHub actions. It uses WPEngine's deploy action to connect to the WPEngine Servers and deploy to each environment.

The theme uses Mindgrub's Wordpress Starter theme as a starting point. 

## Prerequisites

### For CI / CD through GitHub Actions:

GitHub: This product assumes the use of GitHub for version control and CI / CD
* Generate a new SSH key - https://wpengine.com/support/ssh-keys-for-shell-access/#Generate_New_SSH_Key
* Add PRIVATE KEY to Organization Secrets

WPEngine: This product assumes a hosting provider of WPEngine. 
* Aquire access to  GMMB's WPEngine account.
* Add the PUBLIC KEY to your WPEngine account by navigating to Profile > SSH keys > Create SSH key and pasting your public key in the field

### For Development:

Install NVM - https://github.com/nvm-sh/nvm
Install Lando - https://docs.lando.dev/getting-started/installation.html

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
		* lando init
			* select current folder as root
		* lando db-import wp-content/mysql.sql
			* imports database from wpengine backup
		* lando wp search-replace '//wpengineurl.wpengine.com' '//desiredurl.lndo.site'
	* change wp-config file to point to the lando database:
		DB_NAME - wordpress
		DB_USER - wordpress
		DB_PASSWORD - wordpress
		DB_HOST - database
* Add minimal working files from repo
	* git remote add origin https://github.com/derekhargest/workflow-wpe.git
	* git pull origin minimal
	* rm -rf .git
* edit the .env file in the root of the theme, editing the variables with the names of the corresponding instances:

	PROD_ENVIRONMENT=prodname
	STG_ENVIRONMENT=stgname
	DEV_ENVIRONMENT=devname
	THEME_NAME=themename