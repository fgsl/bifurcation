# Bifurcation

Bifurcation is a support script system.

The home page displays the registered scripts.

Each script is generated from a configuration file with the extension `.workflow.php`. This file contains a trinary tree with the following nodes:

0. The answer if no
1. The answer if yes
2. The question.

The exception is the first level of the tree, which has two additional nodes:

3. Script title
4. Script description

The answer can be text or a new node with the same structure.

An example of a configuration file for a support script is the one that implements Epicurus' Paradox.

```php
<?php
// Epicurus's Paradox
return
[
    0 => 'Then there is no problem',
    1 => [
        0 => 'Then he is not omniscient',
        1 => [
            0 => 'Then he is not omnipotent',
            1 => [
                0 => 'Then he is not good',
                1 => 'Then why does evil exist?',
                2 => 'Does God want to end evil?'
            ],
            2 => 'Can God end evil?',
        ],
        2 => 'Does God know that evil exists?'
    ],
    2 => 'Does evil exist?',
    3 => 'Example',
    4 => 'Example workflow using Epicurus\'s Paradox'
];
```

This script can be run in the Example option on the home screen.

## How to run the application

Bifurcation is a PHP application independent of other systems - if you use filesystems storage. You only need the PHP interpreter to run it.

```shell
php -S localhost:8000
```

## Storage options

### filesystem

This is default storage. You create PHP files containing arrays into `config` folder. Each file is a support script.

Create a file with the '.workflow.php' extension in the `config` folder. The name preceding this extension will be used as the script name and route parameter.

Use the `sample.workflow.php` file structure as an example.

### mongodb

For this option it is required the PHP MongoDB extension. You can install it from several ways.

Using PECL:

```php
$ sudo pecl install mongodb
```

Using a package distributing system, like apt for Debian-like systems:

```php
$ sudo apt install php-mongodb
```

You also need to install MongoDB server. Read about it at https://www.mongodb.com/docs/manual/installation/.


The MongoDB storage requires a database named `workflows`. You can create it from the MongoDB shell like this:

```shell
use workflows;
```

The workflows must be created as **collections**. For example, the workflow apiacme (available at the `apiacme.workflow.php` file) can be created like this:

```javascript
db.apiacme.insertOne(
    {
        "0" : 'Then the problem is with your API, not the Acme API platform. The API development team is responsible. If they need support, contact ANDAT.',
        "1" : {
            "0" : 'Open an internal request in ALM.',
            "1" : 'This means there is no authorization for access. You need to contact the security team to arrange access.',
            "2" : 'The Acme API is responding with the following message: {"code":"900908","message":"Resource forbidden","description":"Access failure for API: [API URL], version: [VERSION] status: (900908) - Resource forbidden "} ?'
        },
        "2" : 'Is your API responding normally when accessed directly?',
        "3" : 'Acme API Support Triage',
        "4" : 'Acme API is Acme\'s Business Intelligence Platform, with APIs consumed directly by Acme customers.'
    }
);
```

The workflow ploc (available at the `apiacme.workflow.php` file) can be created like this:

```javascript
db.ploc.insertOne(
{
        "0" : 'So the problem is with your API, not the Ploc platform. The API development team is responsible. If they need support, contact devops team',
        "1" : {
            "0" : 'Open an internal request in ALM',
            "1" : 'This means there is no authorization for access. You need to contact the security team to arrange access.',
            "2" : 'Ploc is responding with the following message: {"code":"900908","message":"Resource forbidden ","description":"Access failure for API: [API URL], version: [VERSION] status: (900908) - Resource forbidden "} ?'
        },
        "2" : 'Is your API responding normally when accessed directly?',
        "3" : 'Triage for Ploc support',
        "4" : 'Ploc is the API platform consumed internally by Acme applications.'
});
```

The Epicurus's Paradox can provide a sample of a decision tree with more levels.
This paradox is the model for filesystem structure in the `template.workflow.php.dist` file. The same content for a MongoDB collection is given by the following code:

```javascript
db.ploc.insertOne(
{
        "0" : 'Then there is no problem',
        "1" : {
            "0" : 'Then he is not omniscient',
            "1" : {
                "0" : 'Then he is not omnipotent',
                "1" : {
                    "0" : 'Then he is not good',
                    "1" : 'Then why does evil exist?',
                    "2" : 'Does God want to end evil?'
                },
                "2" : 'Can God end evil?',
            },
            "2" : 'Does God know that evil exists?'
        },
        "2" : 'Does evil exist?',
        "3" : 'Example',
        "4" : 'Example workflow using Epicurus\'s Paradox'
});
```

You can get the nodes from these structures in MongoDB shell using `find` method like this, that recovers the node "0" at the first level. For example, for the `apiacme` collection:

```javascript
db.apiacme.find({},{"0":1});
```
