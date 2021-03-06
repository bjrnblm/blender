#!/usr/bin/env bash

# Usage: modulegenerator Raccoon Raccoons => Generates a raccoon module

singular="$1"
lcsingular="$(tr '[:upper:]' '[:lower:]' <<< ${singular:0:1})${singular:1}"
plural="$2"
lcplural="$(tr '[:upper:]' '[:lower:]' <<< ${plural:0:1})${plural:1}"
now=$(date +"%Y_%m_%d_%H%M%S")

function generate() {
    cp "$1" "$2"
    sed -i '' "s/NewsItems/${plural}/g" "$2"
    sed -i '' "s/newsItems/${lcplural}/g" "$2"
    sed -i '' "s/NewsItem/${singular}/g" "$2"
    sed -i '' "s/newsItem/${lcsingular}/g" "$2"
    sed -i '' "s/news_items/${lcplural}/g" "$2"
    sed -i '' "s/news_item/${lcsingular}/g" "$2"
}

# Model & related objects
generate  app/Models/NewsItem.php                          app/Models/${singular}.php
generate  app/Models/Translations/NewsItemTranslation.php  app/Models/Translations/${singular}Translation.php
generate  app/Models/Updaters/NewsItemUpdater.php          app/Models/Updaters/${singular}Updater.php

# Repositories
generate  app/Repositories/NewsItemRepository.php             app/Repositories/${singular}Repository.php
generate  app/Repositories/Database/NewsItemDbRepository.php  app/Repositories/Database/${singular}DbRepository.php

# Http
generate  app/Http/Controllers/Back/NewsItemController.php  app/Http/Controllers/Back/${singular}Controller.php
generate  app/Http/Requests/Back/NewsItemRequest.php        app/Http/Requests/Back/${singular}Request.php

# Views
mkdir resources/views/back/${lcplural}
mkdir resources/views/back/${lcplural}/_partials
generate  resources/views/back/newsItems/_partials/form.blade.php  resources/views/back/${lcplural}/_partials/form.blade.php
generate  resources/views/back/newsItems/index.blade.php           resources/views/back/${lcplural}/index.blade.php
generate  resources/views/back/newsItems/edit.blade.php            resources/views/back/${lcplural}/edit.blade.php

# Lang
generate  resources/lang/nl/back-newsItems.yml  resources/lang/nl/back-${lcplural}.yml
generate  resources/lang/en/back-newsItems.yml  resources/lang/en/back-${lcplural}.yml

# Database
generate  database/factories/NewsItemFactory.php                            database/factories/${singular}Factory.php
generate  database/seeds/NewsItemSeeder.php                                 database/seeds/${singular}Seeder.php
generate  database/migrations/2015_05_26_153558_create_news_items_tables.php  database/migrations/${now}_create_${lcplural}_tables.php

# Tests
generate  tests/Integration/Back/NewsItemTest.php  tests/Integration/Back/${singular}Test.php

# Todos
echo "ALL DONE!"
echo "- Todo: Register repository in App\Providers\RepositoryServiceProvider"
echo "- Todo: Register routes in App\Http\Routes\back.php"
echo "- Todo: Register breadcrumbs in App\Services\Navigation\Navigation"
echo "- Todo: Register navigation in App\Services\Navigation\Breadcrumbs"
echo "- Todo: Register seeder in DatabaseSeeder"
