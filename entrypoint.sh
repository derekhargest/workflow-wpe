#!/bin/bash -e
#############################################################################
# Name: deploy-wpe
#
# Description: Deploys to a git repository. Inspired by WordPress VIP Go's deploy script, see
# https://github.com/Automattic/vip-go-build/blob/master/deploy.sh
#
# Globals:
# - CI_BRANCH: The name of the Git branch currently being built.
# - CI_COMMIT: Commit SHA that triggered the CI build
# - REPO_SSH_URL: Repository to deploy to
#############################################################################

set -ex

DEPLOY_SUFFIX="-built"

BRANCH="$CI_BRANCH"

SRC_DIR="$PWD"
BUILD_DIR="/tmp/build-$(date +%s)"

COMMIT_SHA=${CI_COMMIT}
DEPLOY_BRANCH="${BRANCH}${DEPLOY_SUFFIX}"
cd $SRC_DIR
COMMIT_AUTHOR_NAME="$( git log --format=%an -n 1 ${COMMIT_SHA} )"
COMMIT_AUTHOR_EMAIL="$( git log --format=%ae -n 1 ${COMMIT_SHA} )"
COMMIT_COMMITTER_NAME="$( git log --format=%cn -n 1 ${COMMIT_SHA} )"
COMMIT_COMMITTER_EMAIL="$( git log --format=%ce -n 1 ${COMMIT_SHA} )"


# Run some checks
# ---------------

if [[ -z "${BRANCH}" ]]; then
	echo "ERROR: No branch specified!"
	echo "This variable should be set by Travis CI and CircleCI, if you consistently experience errors please check with WordPress.com VIP support."
	exit 1
fi

if [[ -d "$BUILD_DIR" ]]; then
	echo "ERROR: ${BUILD_DIR} already exists."
	echo "This should not happen, if you consistently experience errors please check with WordPress.com VIP support."
	exit 1
fi

if [[ "${BRANCH}" == *${DEPLOY_SUFFIX} ]]; then
	echo "NOTICE: Attempting to build from branch '${BRANCH}' to deploy '${DEPLOY_BRANCH}', seems like recursion so aborting."
	echo "This is a protective measure, no action is required."
	exit 0
fi

# Everything seems OK, getting the built repo sorted
# --------------------------------------------------

echo "Deploying ${BRANCH} to ${DEPLOY_BRANCH}"

# Making the directory we're going to sync the build into
git init "${BUILD_DIR}"
cd "${BUILD_DIR}"
git remote add origin "${REPO_SSH_URL}"
if [[ 0 = $(git ls-remote --heads "${REPO_SSH_URL}" "${DEPLOY_BRANCH}" | wc -l) ]]; then
	echo -e "\nCreating a ${DEPLOY_BRANCH} branch..."
	git checkout --quiet --orphan "${DEPLOY_BRANCH}"
else
	echo "Using existing ${DEPLOY_BRANCH} branch"
	git fetch origin "${DEPLOY_BRANCH}" --depth=1
	git checkout --quiet "${DEPLOY_BRANCH}"
fi

# Expand all submodules
git submodule update --init --recursive;

# Copy the files over
# -------------------

if ! command -v 'rsync'; then
	APT_GET_PREFIX=''
	if command -v 'sudo'; then
		APT_GET_PREFIX='sudo'
	fi

	$APT_GET_PREFIX apt-get update
	$APT_GET_PREFIX apt-get install -q -y rsync
fi

echo "Syncing files... quietly"

rsync --delete -a "${SRC_DIR}/" "${BUILD_DIR}" --exclude='.git/' --exclude='.cache/'

# gitignore override
# To allow commiting built files in the build branch (which are typically ignored)
# -------------------

BUILD_DEPLOYIGNORE_PATH="${BUILD_DIR}/.deployignore"
if [ -f $BUILD_DEPLOYIGNORE_PATH ]; then
	BUILD_GITIGNORE_PATH="${BUILD_DIR}/.gitignore"

	if [ -f $BUILD_GITIGNORE_PATH ]; then
		rm $BUILD_GITIGNORE_PATH
	fi

	echo "-- found .deployignore; emptying all gitignore files"
	find $BUILD_DIR -type f -name '.gitignore' | while read GITIGNORE_FILE; do
		echo "# Emptied by vip-go-build; '.deployignore' exists and used as global .gitignore. See https://wp.me/p9nvA-89A" > $GITIGNORE_FILE
		echo "${GITIGNORE_FILE}"
	done

       	echo "-- using .deployignore as global .gitignore"
	mv $BUILD_DEPLOYIGNORE_PATH $BUILD_GITIGNORE_PATH
fi

# Make up the commit, commit, and push
# ------------------------------------

# Set Git committer
git config user.name "${COMMIT_COMMITTER_NAME}"
git config user.email "${COMMIT_COMMITTER_EMAIL}"

# Add changed files, delete deleted, etc, etc, you know the drill
git add -A .

if [ -z "$(git status --porcelain)" ]; then
	echo "NOTICE: No changes to deploy"
	exit 0
fi

# Commit it.
MESSAGE=$( printf 'Build changes from %s\n\n%s' "${COMMIT_SHA}" "${CIRCLE_BUILD_URL}" )
# Set the Author to the commit (expected to be a client dev) and the committer
# will be set to the default Git user for this CI system
git commit --author="${COMMIT_AUTHOR_NAME} <${COMMIT_AUTHOR_EMAIL}>" -m "${MESSAGE}"

# Push it (push it real good).
git push origin "${DEPLOY_BRANCH}"
