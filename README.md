[![Latest Stable Version](https://poser.pugx.org/betterembed/silverstripe-betterembed/v/stable)](https://packagist.org/packages/betterembed/silverstripe-betterembed)
[![Latest Unstable Version](https://poser.pugx.org/betterembed/silverstripe-betterembed/v/unstable)](https://packagist.org/packages/betterembed/silverstripe-betterembed)
[![License](https://poser.pugx.org/betterembed/silverstripe-betterembed/license)](https://packagist.org/packages/betterembed/silverstripe-betterembed)

# BetterEmbed SilverStripe CMS plugin

BetterEmbed is a free service to easily integrate content like 
YouTube videos, twitter and facebook posts, blog posts or any other kind of remote content.

## Benefits of BetterEmbed

- easily integrate external content
- improve privacy by keeping out unwanted tracking cookies (GDPR)
- increase page speed by not loading external javascript and css resources

## Requirements

SilverStripe ^4

## Installation

`composer require betterembed/silverstripe-betterembed`

After that, make sure you rebuild the database, class and configuration manifests by going to `http://yoursite.com/dev/build?flush=all`

## Usage

Upon installation, BetterEmbed shortcodes are available to use on the SilverStripe website.
Shortcode syntax should follow this format

[betterembed,url=write_url_here]

Example shortcode with Twitter post URL:
[betterembed,url=https://twitter.com/BetterEmbed/status/1201878663173726208]
