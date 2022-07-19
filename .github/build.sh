set -e

cd ./

echo "Installing NVM"
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.1/install.sh | bash
export NVM_DIR="$HOME/.nvm"
echo "Load Bash Completion"
[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"
[ -s "$NVM_DIR/bash_completion" ] && \. "$NVM_DIR/bash_completion"

echo "Install and Use NVM 14"
nvm install 14
nvm use 14

echo "Initiating NPM Install"
npm install

echo "Building Theme"
npm run build

echo "Removing Node Modules"
rm -rf node_modules/