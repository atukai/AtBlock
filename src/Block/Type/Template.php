<?php

namespace AtBlock\Block\Type;

use Zend\View\Renderer\RendererInterface;
use AtBlock\Entity\BlockInterface;

class Template extends AbstractType
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
     * @param BlockInterface $block
     * @return mixed|string
     */
    public function execute(BlockInterface $block)
    {
        $settings = array_merge($this->getDefaultSettings(), $block->getSettings());

        if (isset($settings['template'])) {
            $this->setTemplate($settings['template']);
            unset($settings['template']);
        }

        return $this->render($this->getTemplate(), [
            'block'    => $block,
            'settings' => $settings
        ]);
    }

    /**
     * @return array
     */
    public function getDefaultSettings()
    {
        return [
            'content' => 'Insert your custom text here',
        ];
    }

    /**
     * @param $template
     * @param array $params
     * @return string
     */
    public function render($template, array $params = [])
    {
        return $this->renderer->render($template, $params);
    }
}