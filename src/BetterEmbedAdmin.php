<?php

namespace BetterEmbed\SilverStripe;

use SilverStripe\Admin\ModelAdmin;

class BetterEmbedAdmin extends ModelAdmin
{

    private static $menu_icon_class = 'icon-betterembed';

    private static $managed_models = [
        'BetterEmbed\SilverStripe\BetterEmbedObject',
    ];

    private static $url_segment = 'betterembed';

    private static $menu_title = 'BetterEmbed';
}
