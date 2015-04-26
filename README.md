Installation
----------------------------------------------------

For basic installation into your local directory called `htdocs`:

1. Clone this repo to your server: `git clone https://github.com/one-europe/habari.git htdocs`
2. Use *config-sample.php* to create *config.php* file (will be ignored on commits) and configure your local database connection (DB dump will be provided separately).
3. We use two branches:
  * *master* branch for working on tasks;
  * *dev* branch for playing around with stuff that is for demo only.

Folder structure
----------------------------------------------------
1. *user/themes/euro* - main OE theme files
2. *builder* - JavaScript and CSS builder folder ([Grunt](http://gruntjs.com))
 * *gruntfile.js* - [Gruntfile](http://gruntjs.com/sample-gruntfile) used to configure or define tasks and load Grunt plugins
 * *package.json* - stores metadata of the modules used in this project
 * *.jshintrc* - special file used for configuration of [JSHINT](http://jshint.com/about)
 * *watch.bat* - runs watch task for any JavaScript and LESS files modifications
 * *node_modules* - main folder where all Grunt's plugins stored (ignored on commit; will be added automatically when you install your local copy of Grunt)
3. *src* - JavaScript and LESS source files
 * *js* - JavaScript source files minified and compiled to *user/themes/euro/js* folder
 * *less* - LESS source files minified and compiled to *user/themes/euro/css* folder

**NEVER** update files in *user/themes/euro/js* and *user/themes/euro/css* folders as they are automatically generated from *src* folder by Grunt.

In order to install Grunt, first install [Node.js](https://nodejs.org). That will install node package manager (npm). Then when you clone repo to your local folder, go to *builder* and run **npm install** in the console. This command will install *node_modules* from *package.json* file.

Habari
----------------------------------------------------

As this version of website built on Habari here is the [wiki](http://wiki.habariproject.org/en/Habari_on_github) for an in-depth description of the various ways you can get and manage your Habari instances. [The wiki](http://wiki.habariproject.org/en/Main_Page) also has much more information, including how to customize Habari and where to get help. Enjoy!