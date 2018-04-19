#!/bin/bash

composer require annotations
composer require mailer
composer require symfony/flex
composer remove symfony/symfony
composer require annotations asset orm-pack twig \
composer require --dev dotenv maker-bundle orm-fixtures profiler
rm -fr vendor/*
composer install
composer require form
