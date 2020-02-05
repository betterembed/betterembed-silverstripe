<?php

namespace BetterEmbed\SilverStripe;

use SilverStripe\ORM\DataExtension;
use SilverStripe\View\ArrayData;
use SilverStripe\View\SSViewer;
use SilverStripe\View\Requirements;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\FieldType\DBHTMLText;

class BetterEmbedExtender extends DataExtension
{

    private static $casting = [
        'betterEmbedShortcodeHandler' => 'HTMLText'
    ];

    public function onBeforeWrite()
    {
        $this->checkAllFieldsForShortcode();
    }

    public static function betterEmbedShortcodeHandler($arguments, $content = null, $parser = null, $tagName)
    {

        Requirements::javascript('betterembed/silverstripe-betterembed:client/js/betterembed.js');
        Requirements::css('betterembed/silverstripe-betterembed:client/css/betterembed.css');

        $url = $arguments['url'];
        $betterembed = BetterEmbedObject::getByLink($url);

        if ($betterembed) {
            $template = new SSViewer("BetterEmbedShortCode");
            return $template->process($betterembed);
        }
    }

    public function checkAllFieldsForShortcode()
    {
        $allFields = DataObject::getSchema()->fieldSpecs($this->owner);
        $be_urls = [];

        foreach ($allFields as $field => $fieldSpec) {

            $fieldObj = $this->owner->dbObject($field);
            if ($fieldObj instanceof DBHTMLText) {

                $be_urlsInField = $this->parseField($this->owner->$field);
                $be_urls = array_merge($be_urls, $be_urlsInField);

            }
        }

        foreach ($be_urls as $be_url) {
            $betterembed = BetterEmbedObject::getByLink($be_url);
            if (!$betterembed) {
                $be = new BetterEmbedObject();
                $be->Link = $be_url;
                $be->write();
            }
        }
    }

    public function parseField($htmlValue)
    {
        $results = array();

        $matches = array();
        if (preg_match('/\[betterembed(?:\s*|%20|,)?url=(?<url>[A-Za-z0-9_\.\-\+\?\/=:]+)\](#(?<anchor>.*))?/i', $htmlValue, $matches)) {
            $results[] = $matches['url'];
        }

        return $results;
    }
}
