#/bin/sh
# The following allows importing a database from an SSH location.
# Future @todo:
#  - Allow to specify database backup URL or filepath (avoid download).
#  - Allow import from S3 or URL to avoid SSH public key requirement.

SCRIPT_DIR=$(cd $(dirname "$0") && pwd -P)
BASE_DIR=$(cd ${SCRIPT_DIR}/.. && pwd -P)

PANTHEON_ENV="develop"
PANTHEON_BASIC_AUTH="admin:[the auth token goes here]"
SFP_DOMAIN="http://${PANTHEON_BASIC_AUTH}${PANTHEON_ENV}-unified-platform.pantheonsite.io"
SFP_DIR="sites/default/files"
DRUSH=${BASE_DIR}/bin/drush

# Site root to run drush commands from. Usually a multisite directory.
SITE_ROOT=${BASE_DIR}/web/sites/my.devsite

cd ${SITE_ROOT}

echo "Syncing database from ${PANTHEON_ENV} site."
${DRUSH} sql-sync @unified-platform.${PANTHEON_ENV} @my.devsite -y

${DRUSH} use @my.devsite

echo "Database imported. Finishing up..."

${DRUSH} updb -y

echo "Import complete."
