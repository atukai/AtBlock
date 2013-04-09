<?php

namespace AtBlock\Block\Type;

use Zend\View\Renderer\RendererInterface;
use AtBlock\Block\Type\TypeInterface;
use AtBlock\Entity\BlockInterface;

/**
 * Class Template
 * @package AtBlock\Block\Type
 */
class Template implements TypeInterface
{
    /**
     * @var \Zend\View\Renderer\RendererInterface
     */
    protected $renderer;

    /**
     * @var string
     */
    protected $template = 'at-block/block/base';

    /**
     * @param \Zend\View\Renderer\RendererInterface $renderer
     */
    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BlockInterface $block)
    {
        $settings = array_merge($this->getDefaultSettings(), $block->getSettings());
        return $this->render($this->getTemplate(), array(
            'block'    => $block,
            'settings' => $settings
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultSettings()
    {
        return array(
            'content' => 'Insert your custom text here',
        );
    }

    /**
     * @param string $template
     * @param array $params
     */
    public function render($template, array $params = array())
    {
        return $this->renderer->render($template, $params);
    }
}