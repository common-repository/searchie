=== Searchie ===
Contributors: allan.casilum, mariusgnicula
Donate link: https://www.searchie.io/
Tags: video, audio, content
Requires at least: 5.6
Tested up to: 6.0
Stable tag: 1.17.0
Requires PHP: 7.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Searchie WordPress Plugin.

== Description ==

Searchie WordPress Plugin. Unlock the full potential of your video and audio content Searchie helps reduce content overwhelm for your customers and team, making your content more accessible and easier to consume.  You create, And let Searchie do the work for you.

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `searchie` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress


== Changelog ==

= 1.17.0 =
* Fix Widget JS script embed
* Remove some of widget settings and in page meta, user can choose which widget data to use.

= 1.16.1 =
* Tested on WP 6.0
* Fix immediate issue on missing class.

= 1.16.0 =
* Improve the deactivate, remove all data that was stored when activating the plugin.
* Add exclude files for thrive architect plugin.

= 1.15.0 =
* Improve API that check if token exists, should not run any API if token is invalid.
* Compatible with WordPress version 5.8

= 1.14.0 =
* Fix popup widget on frontend

= 1.13.0 =
* Fix the search media files in the API
* Fix the search local media, playlist and events
* Fix search in the gutenberg block media

= 1.12.35 =
* Fix conflict in Elementor Builder

= 1.12.34 =
* Update Gutenberg media block iframe for public.

= 1.12.33 =
* Improve the media gutenberg block to be compatible with the version 5.7
* Fix some minor bugs.

= 1.11.33 =
* Update the current version to latest WordPress stable version.
* Fix some bug due to some incompatible.

= 1.11.30 =
* Fix the issue on Searchie API login.

= 1.11.29 =
* update tested up to 5.5.1 WordPress version.

= 1.11.28 =
* Add sync media, sync live media to local database for optimize use.
* Add sync widgets, sync live widgets to local database for optimize use.
* Add sync playlist, sync live playlist to local database for optimize use.
* Add Audience enable or disable.

= 1.8.27 =
* fix float position on searchie widget

= 1.8.26 =
* update default class iframe embed in frontend
* improve UI in blocks in searching media files, add toggle properly for responsive embed
* improve the UI on settings page
* widget meta blocks cant be use if there is a setting widget set
* update highlight colour

= 1.8.20 =
* added a responsive checkbox in the media gutenberg blocks
* update the searchie API timeout
* fix media files thumbnail
* update shortcode media files with responsive attribute

= 1.8.17 =
* added a Media Files gutenberg block
* media files add search function
* changes in some verbage in playlist page

= 1.8.9 =
* updated the padding on the content
* updated the padding on top of the titles
* updated the playlist verbage preview
* updated the default image preview in the media/files

= 1.8.7 =
* update api endpoint url

= 1.8.6 =
* update client keys

= 1.8.5 =
* improve the admin page layout

= 1.8.4 =
* update admin page layout

= 1.7.4 =
* Convert the blocks to use Carbon Fields library.

= 1.6.4 =
* Add full width template.

= 1.6.3 =
* Add a searchie widget button on the Nav menu, set it using checkbox.

= 1.6.2 =
* Add a custom button for paragraph block, when text is highlighted convert to widget button.

= 1.6.0 =
* changed popout widget embed to a meta field.
* add text and background color for popout button blocks.

= 1.5.9 =
* Change auth method.

= 1.5.7 =
* Add popout widget embed block.
* Add widget custom button block.

= 1.5.4 =
* Add Player embed block.
* Add Widget embed block.
* Add global widget with settings.


= 1.4.4 =
* Add ACF support.
* Create a block using acf.

= 1.4.0 =
* Add Files API.
* Add shortcode to use in the content.

= 1.3.0 =
* Add the JS sdk into the header of WordPress theme.
* When connecting to the searchie, and sucess it will auto store the profile into the local database.

= 1.2.0 =
* Add oauth2 authorize.
* Add oauth2 token validation from authorize.
* Added API 'profile/me' to get current token authorize user.

= 1.0 =
* First Version Base plugin.

== Upgrade Notice ==

= 1.0 =
First Version
