=== Plugin Name ===
Plugin Name: ChoiceCuts Home or Away
Plugin URI: http://www.workwithchoicecuts.com
Version: 1.0
Author: Ian Huet http://www.workwithchoicecuts.com
Tags: formatting, content, comments
Tested up to: 3.0.1
License: GPL2

This is a content & comment filter which will dynamically add a class attribute 'external' to all links pointing away from your website/blog.


== Description ==

ChoiceCuts Home or Away simply identifies all links within content & comments and checks if they are external links. If an external link is found then CSS class hook 'external' is automatically inserted.

This plug-in uses the PHP DOMDocument family of functions which is only available as part of PHP5+.

Please forward any feedback or issues experienced while using this plug-in to support@choicecuts.com.


== Installation ==

1. Upload this plug-in to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Add CSS styling for '.external' as required.


== Frequently Asked Questions ==

= How do I make the 'external' style appear? =

Add something like the following into the style.css contained with your active theme directory.

`.external { color: #FF0000; }`
