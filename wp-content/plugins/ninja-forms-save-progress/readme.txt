=== Ninja Forms - Save Progress Extension ===
Contributors: kstover, jameslaws
Donate link: http://wpninjas.com
Tags: form, forms
Requires at least: 3.3
Tested up to: 3.5
Stable tag: 1.0.2

License: GPLv2 or later

== Description ==
The Ninja Forms Save Progress Extension allows users to save their form progress and return at a later time to finish.

== Screenshots ==

To see up to date screenshots, visit the [Ninja Forms](http://wpninjas.com/ninja-forms/) page.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the `ninja-forms` directory to your `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Visit the 'Forms' menu item in your admin sidebar
4. When you create a form, you will have now have save progress options on the form settings page.

== Use ==

For help and video tutorials, please visit our website: [Ninja Forms Documentation](http://wpninjas.com/ninja-forms/docs/)

== Changelog ==

= 1.0.2 =

*Bugs:*

* Fixed visual bugs with the placement of the save progress form settings metabox.

= 1.0.1 =

*Changes:*

* Added the option to allow users multiple saves per form. This setting can be enabled on the "Form Settings" tab underneath the "Save Progress" section.
* Added the option to place a table of incomplete entries above the form. This will show the user all of their saved submissions and allow them to click on an item to edit it. Optionally, they may also be allowed to delete their saved submissions from the same table. Columns for this table may be chosen from any of the form fields using a multi-select box.
* Added a shortcode that will place a "saved submissions" table on any page: ninja_forms_save_table. It requires the following settings: form_id - The ID of the form for which you want to show saved submissions, cols - A comma separated list of field IDs that will serve as the columns for the table, url - A url that holds the original form.

= 1.0 =

*Changes:*

* Added an action hook that runs after a submission is saved.

= 0.9 =

*Bugs:*

* Fixed a bug that was causing the Save Progress extension to work improperly with the Multi-Part extension.

= 0.8 =

*Bugs:*

* Fixed a bug that caused forms to be un-intentionally hidden when using multiple forms on one page.

= 0.7 =
* Fixed a bug that caused some users to experience saving errors.

= 0.6 =
* Fixed a bug that prevented the Save Progress extension from interacting properly with the Multi-Part extension.

= 0.5 =
* The [ninja_forms_field id=3] method of inserting user submitted data will now work for saved emails.

= 0.4 =
* Added the ability to send emails to users when they save form.
* Added an action that runs when the user's data is saved. 'ninja_forms_save_progress'.

= 0.3 =
* Fixed a bug that prevented the "including incomplete entries" checkbox from being shown on the select submissions page.

= 0.2 =
* Various bug fixes.
* Changed the way that javascript and css files are loaded in extensions.