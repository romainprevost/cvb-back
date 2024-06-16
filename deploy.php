<?php
namespace Deployer;

require 'recipe/laravel.php';
require 'recipe/provision.php';

// Config

set('repository', ''); // address of the repo to pull from when deploying

add('shared_files', ['database/database.sqlite']);

// For SQLite database, make db as shared between deployments
//add('shared_files', ['database/database.sqlite']);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('ApiServer') // Set the alias name of the server
    ->setHostname('') // Set ip address of the server or domain
    ->set('remote_user', '') // Set the user that will deploy on the server
    ->set('deploy_path', '~/cvb-back'); // Folder where api will be deployed

// Hooks

after('deploy:failed', 'deploy:unlock');
