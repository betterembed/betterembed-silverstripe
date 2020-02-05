<?php

namespace BetterEmbed\SilverStripe;

use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use GuzzleHttp\Psr7\Request;

class BetterEmbedObject extends DataObject
{

    private static $db = [
        'Link' => 'Varchar(255)',

        'embedHtml' => 'Text',
        'url' => 'Varchar(255)',
        'itemType' => 'Varchar(255)',
        'myTitle' => 'Varchar(255)',
        'body' => 'Text',
        'thumbnailUrl' => 'Varchar(255)',
        'authorName' => 'Varchar(255)',
        'authorUrl' => 'Varchar(255)',
        'publishedAt' => 'Date',
    ];

    private static $table_name = 'BetterEmbedObject';

    private static $summary_fields = [
        'ID',
        'url',
        'myTitle',
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        return $fields;
    }

    public function validate()
    {
        $result = parent::validate();

        if ($this->Link == '') {
            $result->addError('Link is required field');
        }

        return $result;
    }

    public function onBeforeWrite()
    {
        //if(!$this->isInDB()) {

        $feed = @file_get_contents('https://api.betterembed.com/api/v0/item?url=' . $this->Link);

        if ($feed) {
            $post = json_decode($feed, true);
        }

        try {
            $this->embedHtml = $post['embedHtml'];
            $this->url = $post['url'];
            $this->itemType = $post['itemType'];
            $this->myTitle = $post['title'];
            $this->body = $post['body'];
            $this->thumbnailUrl = $post['thumbnailUrl'];
            $this->authorName = $post['authorName'];
            $this->authorUrl = $post['authorUrl'];
            $this->publishedAt = $post['publishedAt'];
        } catch (Exception $e) {
        }

        //}

        parent::onBeforeWrite();
    }

    public static function getByLink($link)
    {
        return BetterEmbedObject::get()->filter(['Link' => $link])->First();
    }
}
