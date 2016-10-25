# AtBlock

AtBlock is a [Zend Framework 2/3](http://framework.zend.com) module which helps to create widgets and blocks.

## Requirements

* [PHP 5.6+] (http://php.net)
* [Zend View](https://github.com/zendframework/zend-view)
* [Zend ServiceManager](https://github.com/zendframework/zend-servicemanager)

## Installation

 1. Run `composer require "atukai/at-block".
 2. Add `AtBlock` to your `config/application.config.php` file under the `modules` key.

## Configuration

There are two default block types:

1. Text
2. Template

A block type is just a service which must implements the \AtBlock\Block\Type\TypeInterface interface.
There is only one instance of a block type, however there are many block instances. So you can create many blocks of
given type. TypeInterface provides two methods: getDefaultSettings() which return array of settings and
execute(BlockInterface $block)

First of all you must to create new block type and implement two methods like this:

```
use AtBlock\Block\Type\TypeInterface;

class SimpleBlockType implements TypeInterface
{
    public function getDefaultSettings()
    {
        return [
            'additional_content' => '...',
        ];
    }

    public function execute(BlockInterface $block)
    {
        $settings = array_merge($this->getDefaultSettings(), $block->getSettings());
        return 'Simple Block Type Content' . $settings['additional_content'];
    }
}
```

or if you want block render a template just extend Template type, specify template name and
also implement two methods:

```
use AtBlock\Block\Type\Template;

class CustomTemplate extends Template
{
    protected $template = 'my-module/block/custom';

    public function getDefaultSettings()
    {
        return [
            'additional_content' => '...',
        ];
    }
}
```

Next you should add block type to plugin manager

```
'atblock' => [
    'atblock_block_plugin_manager' => [
        'factories' => [
            'block_type_simple' => function ($pluginManager) {
                return new SimpleBlockType();
            },
        ]
    ],
],
```

or

```
'atblock' => [
    'atblock_block_plugin_manager' => [
        'factories' => [
            'block_type_customtemplate' => function ($pluginManager) {
                return new CustomTemplate($pluginManager->getServiceLocator()->get('ViewRenderer'));
            },
        ]
    ],
],
```

## Usage

In your layout or view script just call view helper

```
<?php echo $this->atBlock('block_type_simple', ['additional_content' => 'some content']) ?>
<?php echo $this->atBlock('block_type_customtemplate', [...]) ?>
```