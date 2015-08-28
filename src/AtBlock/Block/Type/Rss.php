<?php

namespace AtBlock\Block\Type;

use AtBlock\Entity\BlockInterface;
use Zend\Feed\Reader\Reader;

class Rss extends Template
{
    /**
     * @var string
     */
    protected $template = 'at-block/block/rss';

    /**
     * @return array
     */
    public function getDefaultSettings()
    {
        return [
            'feed_uri' => 'http://framework.zend.com/blog/feed-rss.xml',
            'feed_entries' => 10
        ];
    }

    /**
     * @param BlockInterface $block
     * @return mixed|string
     */
    public function execute(BlockInterface $block)
    {
        $settings = array_merge($this->getDefaultSettings(), $block->getSettings());

        $feed = Reader::import($settings['feed_uri']);
        $data = array(
            'title'        => $feed->getTitle(),
            'link'         => $feed->getLink(),
            'dateModified' => $feed->getDateModified(),
            'description'  => $feed->getDescription(),
            'language'     => $feed->getLanguage(),
            'entries'      => array(),
        );

        foreach ($feed as $entry) {
            $entryData = array(
                'title'        => $entry->getTitle(),
                'description'  => $entry->getDescription(),
                'dateModified' => $entry->getDateModified(),
                'authors'      => $entry->getAuthors(),
                'link'         => $entry->getLink(),
                'content'      => $entry->getContent()
            );
            $data['entries'][] = $entryData;
        }

        return $this->render($this->getTemplate(), array(
            'block'    => $block,
            'title'    => $data['title'],
            'entries'  => array_slice($data['entries'], 0, $settings['feed_entries']),
            'settings' => $settings
        ));
    }
}