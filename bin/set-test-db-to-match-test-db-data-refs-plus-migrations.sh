#!/bin/bash

#set -x;

script_path=`dirname $0`
cd $script_path/..

# fail on any error
set -o errexit

if [[ "$PROJECT_BASEPATH" == "" ]]; then
  echo "Test shell is not properly bootstrapped for tests. Please run 'source bashrc/before-test.sh' then try again"
  exit 1
fi

if [[ "$DATA" != test-* ]]; then
  echo "* Prefixing the current data profile with test-, so that there is less risk that tests run against live data";
  export DATA=test-$DATA
fi

cd $PROJECT_BASEPATH
source vendor/neam/php-app-config/shell-export.sh
cd -

# set the value of the test db to correspond to the current data refs/dumps + migrations
time $PROJECT_BASEPATH/bin/reset-db.sh;
mysqldump --user="$DATABASE_USER" --password="$DATABASE_PASSWORD" --host="$DATABASE_HOST" --port="$DATABASE_PORT" --skip-triggers --no-create-db $IGNORED_TABLES_STRING $DATABASE_NAME \
| pv > $PROJECT_BASEPATH/dna/tests/codeception/_tmp/dump-db-dependent.$DATA.sql
sed -i -e 's/\/\*!50013 DEFINER=`[^`]*`@`[^`]*` SQL SECURITY DEFINER \*\///' $PROJECT_BASEPATH/dna/tests/codeception/_tmp/dump-db-dependent.$DATA.sql
echo "* Codeception is set to reload the profile $DATA between tests (codeception/_tmp/dump-db-dependent.$DATA.sql)."
