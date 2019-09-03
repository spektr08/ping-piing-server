#!/usr/bin/env bash
echo Wait for servers to be up
sleep 10

php yii migrate --interactive=0
php yii migrate --interactive=0 --db=dbGame --migrationPath=@app/migrations/game

# Run migrations on test database
php yii migrate --interactive=0 --db=testDb
# php yii migrate --interactive=0 --db=testDb --migrationPath=@app/migrations/testing
php yii migrate --interactive=0 --db=testDbGame --migrationPath=@app/migrations/game
php yii migrate --interactive=0 --db=testDbGame --migrationPath=@app/migrations/game/testing
