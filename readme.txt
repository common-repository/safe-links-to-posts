=== Safe Links ===

Contributors: thekrotek
Donate link: https://thekrotek.com/support
Tags: sef urls, seo, sef links
Requires at least: 4.0
Tested up to: 5.1.0
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allows you to add safe (non-SEF) relative links in posts and automatically makes them SEF (or non-SEF) on post display.

== Description ==

By default WordPress returns full permalinks in post editing form queries. If later you decide to change site path or post title, your links in posts may become invalid and you'll have to update them all. With this plugin you can add safe (non-SEF) absolute or relative links to posts, which won't require update.

**Default behavior**

Original linked post title: My Cool Post
Original linked post href: http://yoursite.com/my-cool-post
Displayed linked post URL: http://yoursite.com/my-cool-post

New linked post URL: New Great Title
New linked post href: http://yoursite.com/new-great-title
Displayed linked post URL: http://yoursite.com/my-cool-post

**With Safe Links plugin**

Original linked post title: My Cool Post
Original linked post href: ?p=123 (http://yoursite.com/?p=123)
Displayed linked post URL: http://yoursite.com/my-cool-post

New linked post URL: New Great Title
New linked post href: ?p=123 (http://yoursite.com/?p=123)
Displayed linked post URL: http://yoursite.com/new-great-title

See screenshots for visual demonstration of the concept.

**FEATURES**

- Returns safe (non-SEF) links in queries, which doesn't require update, if path or title changed.
- Automatically makes permalinks from safe links.
- Two link query modes: Absolute and Relative.
- Two link display modes: Auto and Non-SEF.
- Can save you a lot of time, when moving to another server, domain or database.

More information can be found on <a href="https://thekrotek.com">our site</a>.

== Installation ==

1. Unpack and upload all files to "/wp-content/plugins/plugin-name" directory. Or simply install plugin through Plugins page.
2. Activate extension on "Plugins" page.
3. Setup plugin according to your liking.

On Settings -> Permalinks page find Safe Links section. Available options:

- Links Query Mode - Absolute (http://yoursite.com/?p=123), Relative (?p=123).
- Links Display Mode - Auto - follow permalink settings, Non-SEF - always display short link (http://yoursite.com/?p=123).

== Frequently Asked Questions ==

**Paid extensions support**

For any support inquieries and pre-sales questions, please, see our <a href="https://thekrotek.com/support">Support page</a>.

**Do you provide support for free extensions?**

Unfortunately we don't have resources to provide support for free extensions. You can, of course, report an issue or request a feature, but there's absolutely no guarantee, that we will respond. Anyway, feel free to contact us via email <a href="mailto:support@thekrotek.com">support@thekrotek.com</a>.

== Screenshots ==

1. Queried linked post URL on post editing page.
2. Displayed linked post URL on front-end.
3. Plugin settings.

== Changelog ==

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 1.0 =
* Initial release.