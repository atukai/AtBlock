<?php

namespace AtBlock\Block\Type;

use AtBlock\Entity\BlockInterface;

/**
 * Class Rss
 * @package AtBlock\Block\Type
 */
class Rss extends Template
{
    /**
     * @var string
     */
    protected $template = 'at-block/block/rss';

    /**
     * {@inheritdoc}
     */
    public function execute(BlockInterface $block)
    {
        $settings = array_merge($this->getDefaultSettings(), $block->getSettings());

        $feeds = false;
        if ($settings['feed_uri']) {
            $options = array(
                'http' => array(
                    'user_agent' => 'AtCms/RSS Reader',
                    'timeout' => 2,
                )
            );

            // retrieve contents with a specific stream context to avoid php errors
            $content = @file_get_contents($settings['feed_uri'], false, stream_context_create($options));

            if ($content) {
                try {
                    $feed = new \SimpleXMLElement($content);
                    $title = $feed->channel->title;
                    $feeds = $feed->channel->item;
                } catch (\Exception $e) {
                    // silently fail error
                }
            }
        }

        return $this->render($this->getTemplate(), array(
            'block'    => $block,
            'title'    => $title,
            'feeds'    => $feeds,
            'settings' => $settings
        ));
    }

    /**
     * @return array
     */
    public function getDefaultSettings()
    {
        return array(
            'feed_uri' => 'http://framework.zend.com/blog/feed-rss.xml',
        );
    }
}