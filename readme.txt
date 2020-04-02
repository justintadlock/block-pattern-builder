=== Block Pattern Builder ===

Contributors: greenshady
Tags: block-editor
Requires at least: 5.0
Tested up to: 5.4
Requires PHP: 5.6
Stable tag: 1.0.0
License: GPLv2 or later

Create custom block patterns from the WordPress admin. No coding required.

== Description ==

Block Pattern Builder is a simple plugin that allows end-users to create custom block patterns within the WordPress plugin directory.  The plugin currently **requires Gutenberg 7.8+**.  Block patterns will be a part of core WordPress in the future.  For now, Gutenberg is a hard requirement.

More information on block patterns can be found via the following links:

- [Gutenberg 7.8 Adds Patterns API and Continues Interface Cleanup](https://wptavern.com/gutenberg-7-8-adds-patterns-api-and-continues-interface-cleanup)
- [Block Patterns Will Change Everything](https://wptavern.com/block-patterns-will-change-everything)

### How to Use the Plugin

After installing and activating the plugin, you should see a new "Block Patterns" menu item in your WordPress admin.  From that point, you can create a new pattern just like you would any post or page.  The process is the same.

The idea with patterns is to create a reusable pattern or section of blocks that you will use later.  Once you publish a pattern, it will be available within the pattern library.

Now, go to any post or page.  Click on the pattern icon.  At the time of writing, that icon is in the top right corner of the block editor, but this will surely change in future versions of Gutenberg and WordPress.  After clicking on the icon, you should see your custom pattern in the pattern library/list.  Click on it.  It will be inserted into your post.

== Frequently Asked Questions ==

### Why was this plugin created?

I thought it would be fun to build block patterns from the admin instead of writing code for them.

### Block pattern is invalid. What should I do?

If this happens, something is off in the pattern.  See if you can resolve the issue.  Currently, block patterns are very early in development, so there is a distinct possibility of breakage.

### Can I use this to build patterns for my theme?

Yes, certainly.  You can build the patterns via the admin.  Then, go to the code editor and copy the code version of the pattern.  Then, register in your theme's `functions.php` via the `register_pattern()` function.  This way, you can ship your custom patterns directly to your theme users.

== Screenshots ==

1. Block Patterns management screen.
2. Creating a custom block pattern.
3. Inserting a block pattern into the post editor.

== Changelog ==

The change log is located in the `changelog.md` file in the plugin folder.  You may also [view the change log](https://github.com/justintadlock/block-pattern-builder/blob/master/changelog.md) online.
