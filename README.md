JFILIP Symfony 2 Tutorial Application
=====================================

This is an attempt to create somethin similar to the Zend 2 tutorial skeleton
application by writing it in Symfony 2.1 from scratch.
  - http://framework.zend.com/manual/2.0/en/user-guide/overview.html
  - http://symfony.com/doc/current/book/installation.html

Symfony standard README
-----------------------

 Please see the README-Symfony.md file within this repository for the standard
 Symfony 2.1 readme file contents.

Usage notes
-----------

### Install Composer

To install Composer on your system so it is executable from anywhere, use the
following command:

    curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin

At this point, composer can be executed by typing `compser.phar` (so long as
`/usr/local/bin` is in your executable PATH). Otherwise you must type the full
path to use it: `/usr/local/bin/composer`

### Setup the Symfony application on your machine

Within the root of this repository, simply run

    composer.phar install

### Configure your system to access Symfony via Apache

Please refer to this page for more information or if you run into problems:
http://symfony.com/doc/current/book/installation.html

You will want to create an Apache 2 VHost configuration. This can be done
either by creating a new "site" configuration for Apache installs that use the
`sites-enabled` configuration setup or by editing the main httpd.conf or some
kind of VHost-specific file to add the following:

    <Directory "/[FULL_PATH_TO_SYMFONY2_CHECKOUT]/symfony2/web/sf">
     AllowOverride All
     Allow from All
    </Directory>
    <VirtualHost *:80>
      ServerName symfony2.localhost
      DocumentRoot "[FULL_PATH_TO_SYMFONY2_CHECKOUT]/web"
      DirectoryIndex index.php
      Alias /sf [FULL_PATH_TO_SYMFONY2_CHECKOUT]/web/sf
      <Directory "[FULL_PATH_TO_SYMFONY2_CHECKOUT]/web">
       AllowOverride All
       Allow from All
      </Directory>
    </VirtualHost>

Restart your Apache server after making these changes to ensure that it works
correctly.

Next you will need to edit your `/etc/hosts` file to add the following line

    127.0.0.1    symfony2.localhost symfony2

This will allow you to access your Symfony2 application via the URL

    http://symfony2.localhost/

### Configure application properties

    cp app/config/parameters.dist.yml app/config/parameters.yml

Edit the file `app/config/parameters.yml` to set up the name of your database
driver (either *pdo_mysql* or *pdo_pgsql* most likely). The database name
should be the name of a database that does not exist on your system. Symfony
will be used to create this for you.

    NOTE: MySQL is recommended as there is apparently a bug in created a
          database when using the Postgres driver.

### Create the database 

The following command will create the database based on the configuration
defined within `parameters.yml` earlier:

    php app/console propel:database:create

Then you can use a command to create an SQL install file and use it to create
the database schema as defined by the code:

    php app/console propel:build --insert-sql

Specific code to look at
------------------------

The following files are the files that were created as part of this demonstration
project:

    src/Demo/SecurityBundle/Controller/SecurityController.php
    src/Demo/SecurityBundle/Resources/config/routing.yml
    src/Demo/SecurityBundle/Resources/views/Security/login.html.twig
    src/Demo/SecurityBundle/Tests/Controller/SecurityController.php
    src/Demo/TutorialBundle/Controller/DefaultController.php
    src/Demo/TutorialBundle/Resources/config/routing.yml
    src/Demo/TutorialBundle/Resources/config/schema.xml
    src/Demo/TutorialBundle/Resources/views/Default/add.html.twig
    src/Demo/TutorialBundle/Resources/views/Default/album_base.html.twig
    src/Demo/TutorialBundle/Resources/views/Default/delete.html.twig
    src/Demo/TutorialBundle/Resources/views/Default/edit.html.twig
    src/Demo/TutorialBundle/Resources/views/Default/index.html.twig
    src/Demo/TutorialBundle/Tests/Controller/DefaultController.php
    src/Demo/TutorialBundle/Tests/Model/Album.php
