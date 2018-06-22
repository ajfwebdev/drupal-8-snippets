#! /bin/bash

###
# Automated process to sync local databases with Acquia.
# Should be run from the root of the vagrant repo on the host machine.
# With no arguments it will load the Dev database.
# Use the -e option with an env name to load a different database, like:
# ./scripts/acquia_sync.sh -e test
###

# Set the default environment.
ENVIRONMENT=dev
DRUSH_ALIAS=@mydrushalias
while getopts ":e:" opt; do
  case $opt in
    e)
      echo "-e set to: $OPTARG" >&2
      ENVIRONMENT=$OPTARG
      ;;
    \?)
      echo "Invalid option: -$OPTARG" >&2

      exit 1
      ;;
    :)
      echo "Option -$OPTARG requires an argument." >&2
      exit 1
      ;;
  esac
done

echo "Environment set to "$ENVIRONMENT

# Verify connection to acquia
if [[ ! $(drush @mydrushalias.$ENVIRONMENT status) ]]
then
  echo "Failed to connect to Acquia server using Drush. Cannot sync databases."
  exit 1
fi

# Download database dumps
# Ensure db directory exists
if [[ ! -d ./db ]]
then
  mkdir ./db
fi

# Download db dumps
echo "Downloading "$ENVIRONMENT" database dumps..."
drush $DRUSH_ALIAS.$ENVIRONMENT sql-dump --structure-tables-key=common > db/pp.$ENVIRONMENT.sql

# Drop all your local tables.
echo "Dropping all local data. Don't panic."
drush $DRUSH_ALIAS.mcdev sql-drop -y

# Sync databases to local
echo "Loading " $ENVIRONMENT " Drupal data..."
vagrant ssh -c "cd /vagrant/db; mysql -u root -ppassword my_local_db_name < pp.$ENVIRONMENT.sql"

