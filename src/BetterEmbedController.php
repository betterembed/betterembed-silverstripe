<?php

namespace BetterEmbed\SilverStripe;

use SilverStripe\Control\Controller;
use SilverStripe\Control\HTTPRequest;

class BetterEmbedController extends Controller
{

    private static $allowed_actions = [
        'index'
    ];

    public function index(HTTPRequest $request)
    {
        $params = $request->allParams();
        $betterembed = BetterEmbedObject::get()->filter(['ID' => $params['ID']])->First();
        if ($betterembed) {
            return $betterembed->embedHtml;
        }
    }
}
