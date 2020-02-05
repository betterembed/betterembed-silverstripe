<?php

use SilverStripe\View\Parsers\ShortcodeParser;

ShortcodeParser::get()->register('betterembed', array('BetterEmbed\SilverStripe\BetterEmbedExtender', 'betterEmbedShortcodeHandler'));
