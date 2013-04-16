# AtBlock

Version 0.1.1

AtCms is a [Zend Framework 2](http://framework.zend.com) module which provides a base CMS functionality.
Helps to create html pages and blocks. Blocks functionality is a port of [SonataAdminBundle](https://github.com/sonata-project/SonataBlockBundle)

>This module is still under heavy development. Do not use it in production. In future blocks functionality will
>move to separate module.

## Requirements

* [Zend Framework 2](https://github.com/zendframework/zf2)

## Installation

 1. Add `"atukai/at-block": "0.*"` to your `composer.json` file and run `php composer.phar update`.
 2. Add `AtBlock` to your `config/application.config.php` file under the `modules` key.

## Configuration

There are three default block types:

1. Text
2. Template
3. Rss

A block type is just a service which must implements the \AtCms\Block\Type\TypeInterface interface.
There is only one instance of a block type, however there are many block instances. So you can create many blocks
given type. TypeInterface provides two methods: getDefaultSettings() which return array of settings and
execute(BlockInterface $block)

First of all you must to create new block type and implement two methods like this:

```
use AtCms\Block\Type\TypeInterface;

class SimpleBlockType implements TypeInterface
{
    public function getDefaultSettings()
    {
        return array(
            'additional_content' => '...',
        );
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
use AtCms\Block\Type\TypeInterface;

class CustomTemplate extends Template
{
    protected $template = 'my-module/block/custom';

    public function getDefaultSettings()
    {
        return array(
            'additional_content' => '...',
        );
    }

    public function execute(BlockInterface $block)
    {
        $settings = array_merge($this->getDefaultSettings(), $block->getSettings());
        return $this->render($this->getTemplate(), array(
            'block'    => $block,
            'settings' => $settings
        ));
    }
}
```

Next you need to describe new block type in Service Manager

```
'block_type_simple' => function ($sm) {
    return new SimpleBlockType();
},
```

or

```
'block_type_customtemplate' => function ($sm) {
    return new CustomTemplate($sm->get('ViewRenderer'));
},
```

## Usage

In your layout or view script just call view helper

```
<?= $this->atBlock('block_type_simple', array('additional_content' => 'some content'))
<?= $this->atBlock('block_type_customtemplate', array(...))
```