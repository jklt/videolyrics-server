videolyrics-server
==================

### Set up development environment
1. Make sure [PHP](http://php.net) and [Composer](https://getcomposer.org) are installed.
2. Make sure [Laravel Homestead](http://laravel.com/docs/homestead) is installed and configured.
3. Add `videolyrics` to the databases list in the `Homestead.yaml` file.
4. Run Homestead.
5. Migrate the database using "php artisan migrate --env=local" (updating database structures)
7. View the site in the browser.

### Deploy the application
1. Make sure the [Heroku Toolbelt](https://toolbelt.heroku.com) is installed.
2. Add the `heroku` remote to the Git repository: `cd` into the `videolyrics-server` directory and run `heroku git:remote -a videolyrics`
3. Run `git push heroku master` to deploy the application to Heroku.
4. Run `git push -u origin master` to push the application to GitHub.
5. If it is the first time the application is deployed, make sure you change the database configuration and execute "heroku run php artisan migrate"

### View the deployed application
Go to https://video-lyrics.herokuapp.com/.