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
Bifurcation is a PHP application independent of other systems. You only need the PHP interpreter to run it.

```shell
php -S localhost:8000
```

## How to create a support script

Create a file with the '.workflow.php' extension in the `config` folder. The name preceding this extension will be used as the script name and route parameter.

Use the `sample.workflow.php` file structure as an example.
