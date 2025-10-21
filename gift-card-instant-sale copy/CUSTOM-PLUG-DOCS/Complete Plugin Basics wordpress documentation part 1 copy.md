Bottom of Form

**Plugin Basics**

In this article

-   [[Getting
    Started]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/#getting-started)

-   [[Hooks: Actions and
    Filters]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/#hooks-actions-and-filters)

    -   [[Basic
        Hooks]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/#basic-hooks)

    -   [[Adding
        Hooks]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/#adding-hooks)

    -   [[Removing
        Hooks]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/#removing-hooks)

-   [[WordPress
    APIs]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/#wordpress-apis)

-   [[How WordPress Loads
    Plugins]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/#how-wordpress-loads-plugins)

-   [[Sharing your
    Plugin]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/#sharing-your-plugin)

[↑ [Back to
top]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/#wp--skip-link--target)

[**[Getting
Started]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/#getting-started)

At its simplest, a WordPress plugin is a PHP file with a WordPress
plugin header comment. It's highly recommended that you create a
directory to hold your plugin so that all of your plugin's files are
neatly organized in one place.

To get started creating a new plugin, follow the steps below.

1.  Navigate to the WordPress installation's **wp-content** directory.

2.  Open the **plugins** directory.

3.  Create a new directory and name it after the plugin
    (e.g. plugin-name).

4.  Open the new plugin's directory.

5.  Create a new PHP file (it's also good to name this file after your
    plugin, e.g. plugin-name.php).

Here's what the process looks like on the Unix command line:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/)

wordpress \$ cd wp-content

wp-content \$ cd plugins

plugins \$ mkdir plugin-name

plugins \$ cd plugin-name

plugin-name \$ vi plugin-name.php

In the example above, vi is the name of the text editor. Use whichever
editor that is comfortable for you.

Now that you're editing your new plugin's PHP file, you'll need to add a
plugin header comment. This is a specially formatted PHP block comment
that contains metadata about the plugin, such as its name, author,
version, license, etc. The plugin header comment must comply with
the [[header
requirements]{.underline}](https://developer.wordpress.org/plugins/the-basics/header-requirements/),
and at the very least, contain the name of the plugin.

Only one** **file in the plugin's folder should have the header comment
--- if the plugin has multiple PHP files, only one of those files should
have the header comment.

After you save the file, you should be able to see your plugin listed in
your WordPress site. Log in to your WordPress site, and
click **Plugins** on the left navigation pane of your WordPress Admin.
This page displays a listing of all the plugins your WordPress site has.
Your new plugin should now be in that list!

[**[Hooks: Actions and
Filters]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/#hooks-actions-and-filters)

WordPress hooks allow you to tap into WordPress at specific points to
change how WordPress behaves without editing any core files.

There are two types of hooks within WordPress: *actions* and *filters*.
Actions allow you to add or change WordPress functionality, while
filters allow you to alter content as it is loaded and displayed to the
website user.

Hooks are not just for plugin developers; hooks are used extensively to
provide default functionality by WordPress core itself. Other hooks are
unused place holders that are simply available for you to tap into when
you need to alter how WordPress works. This is what makes WordPress so
flexible.

[**[Basic
Hooks]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/#basic-hooks)

The 3 basic hooks you'll need when creating a plugin are
the [[register_activation_hook()]{.underline}](https://developer.wordpress.org/reference/functions/register_activation_hook/) ,
the [[register_deactivation_hook()]{.underline}](https://developer.wordpress.org/reference/functions/register_deactivation_hook/) ,
and
the [[register_uninstall_hook()]{.underline}](https://developer.wordpress.org/reference/functions/register_uninstall_hook/) .

The [[activation
hook]{.underline}](https://developer.wordpress.org/plugins/the-basics/activation-deactivation-hooks/) is
run when you *activate* your plugin. You would use this to provide a
function to set up your plugin --- for example, creating some default
settings in the options table.

The [[deactivation
hook]{.underline}](https://developer.wordpress.org/plugins/the-basics/activation-deactivation-hooks/) is
run when you *deactivate* your plugin. You would use this to provide a
function that clears any temporary data stored by your plugin.

These [[uninstall
methods]{.underline}](https://developer.wordpress.org/plugins/the-basics/uninstall-methods/) are
used to clean up after your plugin is *deleted*using the WordPress
Admin. You would use this to delete all data created by your plugin,
such as any options that were added to the options table.

[**[Adding
Hooks]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/#adding-hooks)

You can add your own, custom hooks
with [[do_action()]{.underline}](https://developer.wordpress.org/reference/functions/do_action/) ,
which will enable developers to extend your plugin by passing functions
through your hooks.

[**[Removing
Hooks]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/#removing-hooks)

You can also use
invoke [[remove_action()]{.underline}](https://developer.wordpress.org/reference/functions/remove_action/) to
remove a function that was defined earlier. For example, if your plugin
is an add-on to another plugin, you can
use [[remove_action()]{.underline}](https://developer.wordpress.org/reference/functions/remove_action/) with
the same function callback that was added by the previous plugin
with [[add_action()]{.underline}](https://developer.wordpress.org/reference/functions/add_action/) .
The priority of actions is important in these situations,
as [[remove_action()]{.underline}](https://developer.wordpress.org/reference/functions/remove_action/) would
need to run after the
initial [[add_action()]{.underline}](https://developer.wordpress.org/reference/functions/add_action/) .

You should be careful when removing an action from a hook, as well as
when altering priorities, because it can be difficult to see how these
changes will affect other interactions with the same hook. We highly
recommend testing frequently.

You can learn more about creating hooks and interacting with them in
the [[Hooks]{.underline}](https://developer.wordpress.org/plugin/hooks/) section
of this handbook.

[**[WordPress
APIs]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/#wordpress-apis)

Did you know that WordPress provides a number of [[Application
Programming Interfaces
(APIs)]{.underline}](https://make.wordpress.org/core/handbook/core-apis/)?
These APIs can greatly simplify the code you need to write in your
plugins. You don't want to reinvent the wheel, especially when so many
people have done a lot of the work and testing for you.

The most common one is the [[Options
API]{.underline}](https://codex.wordpress.org/Options_API), which makes
it easy to store data in the database for your plugin. If you're
thinking of
using [[cURL]{.underline}](https://en.wikipedia.org/wiki/CURL) in your
plugin, the [[HTTP
API]{.underline}](https://codex.wordpress.org/HTTP_API) might be of
interest to you.

Since we're talking about plugins, you'll want to study the [[Plugin
API]{.underline}](https://codex.wordpress.org/Plugin_API). It has a
variety of functions that will assist you in developing plugins.

[**[How WordPress Loads
Plugins]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/#how-wordpress-loads-plugins)

When WordPress loads the list of installed plugins on the Plugins page
of the WordPress Admin, it searches through the plugins folder (and its
sub-folders) to find PHP files with WordPress plugin header comments. If
your entire plugin consists of just a single PHP file, like [[Hello
Dolly]{.underline}](https://wordpress.org/plugins/hello-dolly/), the
file could be located directly inside the root of the plugins folder.
But more commonly, plugin files will reside in their own folder, named
after the plugin.

[**[Sharing your
Plugin]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/#sharing-your-plugin)

Sometimes a plugin you create is just for your site. But many people
like to share their plugins with the rest of the WordPress community.
Before sharing your plugin, one thing you need to do is [[choose a
license]{.underline}](https://opensource.org/licenses/category). This
lets the user of your plugin know how they are allowed to use your code.
To maintain compatibility with WordPress core, it is recommended that
you pick a license that works with GNU General Public License (GPLv2+).

**First published**

September 16, 2014

**Last updated**

December 14, 2023

[PreviousWhat is a Plugin?Previous: What is a
Plugin?](https://developer.wordpress.org/plugins/intro/what-is-a-plugin/)

[NextHeader RequirementsNext: Header
Requirements](https://developer.wordpress.org/plugins/plugin-basics/header-requirements/)

**Hooks**

In this article

-   [[Actions vs.
    Filters]{.underline}](https://developer.wordpress.org/plugins/hooks/#actions-vs-filters)

-   [[More
    Resources]{.underline}](https://developer.wordpress.org/plugins/hooks/#more-resources)

Hooks are a way for one piece of code to interact/modify another piece
of code at specific, pre-defined spots. They make up the foundation for
how plugins and themes interact with WordPress Core, but they're also
used extensively by Core itself.

There are two types of
hooks: [[Actions]{.underline}](https://developer.wordpress.org/plugins/hooks/actions/) and [[Filters]{.underline}](https://developer.wordpress.org/plugins/hooks/filters/).
To use either, you need to write a custom function known as a Callback,
and then register it with a WordPress hook for a specific action or
filter.

[[Actions]{.underline}](https://developer.wordpress.org/plugins/hooks/actions/) allow
you to add data or change how WordPress operates. Actions will run at a
specific point in the execution of WordPress Core, plugins, and themes.
Callback functions for Actions can perform some kind of a task, like
echoing output to the user or inserting something into the database.
Callback functions for an Action do not return anything back to the
calling Action hook.

[[Filters]{.underline}](https://developer.wordpress.org/plugins/hooks/filters/) give
you the ability to change data during the execution of WordPress Core,
plugins, and themes. Callback functions for Filters will accept a
variable, modify it, and return it. They are meant to work in an
isolated manner, and should never have [[side
effects]{.underline}](https://en.wikipedia.org/wiki/Side_effect_(computer_science)) such
as affecting global variables and output. Filters expect to have
something returned back to them.

WordPress provides many hooks that you can use, but you can
also [[create your
own]{.underline}](https://developer.wordpress.org/plugins/hooks/custom-hooks/) so
that other developers can extend and modify your plugin or theme.

[**[Actions vs.
Filters]{.underline}**](https://developer.wordpress.org/plugins/hooks/#actions-vs-filters)

The main difference between an action and a filter can be summed up like
this: 

-   an action takes the info it receives, does something with it, and
    returns nothing. In other words: it *acts* on something and then
    exits, returning nothing back to the calling hook.

-   a filter takes the info it receives, modifies it somehow, and
    returns it. In other words: it *filters* something and passes it
    back to the hook for further use.

Said another way: 

-   an action interrupts the code flow to do something, and then returns
    back to the normal flow without modifying anything;

-   a filter is used to modify something in a specific way so that the
    modification is then used by code later on.

The *something* referred to is the parameter list sent via the hook
definition. More on this in later sections.

[[Home](https://developer.wordpress.org)[Plugin
Handbook](https://developer.wordpress.org/plugins/)[Settings](https://developer.wordpress.org/plugins/settings/)]{.underline}Custom
Settings Page

Top of Form

Search

Bottom of Form

**Custom Settings Page**

[↑ [Back to
top]{.underline}](https://developer.wordpress.org/plugins/settings/custom-settings-page/#wp--skip-link--target)

Creating a custom settings page includes the combination of: [[creating
an administration
menu]{.underline}](https://developer.wordpress.org/plugins/administration-menus/), [[using
Settings
API]{.underline}](https://developer.wordpress.org/plugins/settings/using-settings-api/) and [[Options
API]{.underline}](https://developer.wordpress.org/plugins/settings/options-api/).

Please read these chapters before attempting to create your own settings
page.

The example below can be used for quick reference on these topics by
following the comments.

**Complete Example**

Complete example which adds a Top-Level Menu named WPOrg, registers a
custom option named wporg_options and performs the CRUD (create, read,
update, delete) logic using Settings API and Options API (including
showing error/update messages).

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/settings/custom-settings-page/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/settings/custom-settings-page/)

/\*\*

\* \@internal never define functions inside callbacks.

\* these functions could be run multiple times; this would result in a
fatal error.

\*/

/\*\*

\* custom option and settings

\*/

**function** wporg_settings_init() {

// Register a new setting for \"wporg\" page.

register_setting( \'wporg\', \'wporg_options\' );

// Register a new section in the \"wporg\" page.

add_settings_section(

\'wporg_section_developers\',

\_\_( \'The Matrix has you.\', \'wporg\' ),
\'wporg_section_developers_callback\',

\'wporg\'

);

// Register a new field in the \"wporg_section_developers\" section,
inside the \"wporg\" page.

add_settings_field(

\'wporg_field_pill\', // As of WP 4.6 this value is used only
internally.

// Use \$args\' label_for to populate the id inside the callback.

\_\_( \'Pill\', \'wporg\' ),

\'wporg_field_pill_cb\',

\'wporg\',

\'wporg_section_developers\',

**array**(

\'label_for\' =\> \'wporg_field_pill\',

\'class\' =\> \'wporg_row\',

\'wporg_custom_data\' =\> \'custom\',

)

);

}

/\*\*

\* Register our wporg_settings_init to the admin_init action hook.

\*/

add_action( \'admin_init\', \'wporg_settings_init\' );

/\*\*

\* Custom option and settings:

\* - callback functions

\*/

/\*\*

\* Developers section callback function.

\*

\* \@param array \$args The settings array, defining title, id,
callback.

\*/

**function** wporg_section_developers_callback( \$args ) {

**?\>**

\<p id=\"**\<?php** **echo** esc_attr( \$args\[\'id\'\] );
**?\>**\"\>**\<?php** esc_html_e( \'Follow the white rabbit.\',
\'wporg\' ); **?\>**\</p\>

**\<?php**

}

/\*\*

\* Pill field callbakc function.

\*

\* WordPress has magic interaction with the following keys: label_for,
class.

\* - the \"label_for\" key value is used for the \"for\" attribute of
the \<label\>.

\* - the \"class\" key value is used for the \"class\" attribute of the
\<tr\> containing the field.

\* Note: you can add custom key value pairs to be used inside your
callbacks.

\*

\* \@param array \$args

\*/

**function** wporg_field_pill_cb( \$args ) {

// Get the value of the setting we\'ve registered with
register_setting()

\$options = get_option( \'wporg_options\' );

**?\>**

\<select

id=\"**\<?php** **echo** esc_attr( \$args\[\'label_for\'\] ); **?\>**\"

data-custom=\"**\<?php** **echo** esc_attr(
\$args\[\'wporg_custom_data\'\] ); **?\>**\"

name=\"wporg_options\[**\<?php** **echo** esc_attr(
\$args\[\'label_for\'\] ); **?\>**\]\"\>

\<option value=\"red\" **\<?php** **echo** **isset**( \$options\[
\$args\[\'label_for\'\] \] ) ? ( selected( \$options\[
\$args\[\'label_for\'\] \], \'red\', false ) ) : ( \'\' ); **?\>**\>

**\<?php** esc_html_e( \'red pill\', \'wporg\' ); **?\>**

\</option\>

\<option value=\"blue\" **\<?php** **echo** **isset**( \$options\[
\$args\[\'label_for\'\] \] ) ? ( selected( \$options\[
\$args\[\'label_for\'\] \], \'blue\', false ) ) : ( \'\' ); **?\>**\>

**\<?php** esc_html_e( \'blue pill\', \'wporg\' ); **?\>**

\</option\>

\</select\>

\<p class=\"description\"\>

**\<?php** esc_html_e( \'You take the blue pill and the story ends. You
wake in your bed and you believe whatever you want to believe.\',
\'wporg\' ); **?\>**

\</p\>

\<p class=\"description\"\>

**\<?php** esc_html_e( \'You take the red pill and you stay in
Wonderland and I show you how deep the rabbit-hole goes.\', \'wporg\' );
**?\>**

\</p\>

**\<?php**

}

/\*\*

\* Add the top level menu page.

\*/

**function** wporg_options_page() {

add_menu_page(

\'WPOrg\',

\'WPOrg Options\',

\'manage_options\',

\'wporg\',

\'wporg_options_page_html\'

);

}

/\*\*

\* Register our wporg_options_page to the admin_menu action hook.

\*/

add_action( \'admin_menu\', \'wporg_options_page\' );

/\*\*

\* Top level menu callback function

\*/

**function** wporg_options_page_html() {

// check user capabilities

**if** ( ! current_user_can( \'manage_options\' ) ) {

**return**;

}

// add error/update messages

// check if the user have submitted the settings

// WordPress will add the \"settings-updated\" \$\_GET parameter to the
url

**if** ( **isset**( \$\_GET\[\'settings-updated\'\] ) ) {

// add settings saved message with the class of \"updated\"

add_settings_error( \'wporg_messages\', \'wporg_message\', \_\_(
\'Settings Saved\', \'wporg\' ), \'updated\' );

}

// show error/update messages

settings_errors( \'wporg_messages\' );

**?\>**

\<div class=\"wrap\"\>

\<h1\>**\<?php** **echo** esc_html( get_admin_page_title() );
**?\>**\</h1\>

\<form action=\"options.php\" method=\"post\"\>

**\<?php**

// output security fields for the registered setting \"wporg\"

settings_fields( \'wporg\' );

// output setting sections and their fields

// (sections are registered for \"wporg\", each field is registered to a
specific section)

do_settings_sections( \'wporg\' );

// output save settings button

submit_button( \'Save Settings\' );

**?\>**

\</form\>

\</div\>

**\<?php**

}

**First published**

September 24, 2014

**Last updated**

November 17, 2022

[PreviousSettingsPrevious:
Settings](https://developer.wordpress.org/plugins/settings/)

[NextOptions APINext: Options
API](https://developer.wordpress.org/plugins/settings/options-api/)

-   

[**[Get WordPress]{.underline}**](https://wordpress.org/download/)

[[WordPress Developer
Resources]{.underline}](https://developer.wordpress.org)

Options API

-   [Developer Blog](https://developer.wordpress.org/news/)

-   [Code Reference](https://developer.wordpress.org/reference/)

-   [WP-CLI Commands](https://developer.wordpress.org/cli/commands/)

[[Home](https://developer.wordpress.org)[Plugin
Handbook](https://developer.wordpress.org/plugins/)[Settings](https://developer.wordpress.org/plugins/settings/)]{.underline}Options
API

Top of Form

Search

Bottom of Form

**Options API**

In this article

-   [[Where Options are
    Stored?]{.underline}](https://developer.wordpress.org/plugins/settings/options-api/#where-options-are-stored)

-   [[How Options are
    Stored?]{.underline}](https://developer.wordpress.org/plugins/settings/options-api/#how-options-are-stored)

    -   [[Single
        Value]{.underline}](https://developer.wordpress.org/plugins/settings/options-api/#single-value)

    -   [[Array of
        Values]{.underline}](https://developer.wordpress.org/plugins/settings/options-api/#array-of-values)

-   [[Function
    Reference]{.underline}](https://developer.wordpress.org/plugins/settings/options-api/#function-reference)

[↑ [Back to
top]{.underline}](https://developer.wordpress.org/plugins/settings/options-api/#wp--skip-link--target)

The Options API, added in WordPress 1.0, allows creating, reading,
updating and deleting of WordPress options. In combination with
the [[Settings
API]{.underline}](https://developer.wordpress.org/plugins/settings/settings-api/) it
allows controlling of options defined in settings pages.

[**[Where Options are
Stored?]{.underline}**](https://developer.wordpress.org/plugins/settings/options-api/#where-options-are-stored)

Options are stored in
the {\$wpdb-\>prefix}\_options table. \$wpdb-\>prefix is defined by
the \$table_prefix variable set in the wp-config.php file.

[**[How Options are
Stored?]{.underline}**](https://developer.wordpress.org/plugins/settings/options-api/#how-options-are-stored)

Options may be stored in the WordPress database in one of two ways: as a
single value or as an array of values.

[**[Single
Value]{.underline}**](https://developer.wordpress.org/plugins/settings/options-api/#single-value)

When saved as a single value, the option name refers to a single value.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/settings/options-api/)

// add a new option

add_option(\'wporg_custom_option\', \'hello world!\');

// get an option

\$option = get_option(\'wporg_custom_option\');

[**[Array of
Values]{.underline}**](https://developer.wordpress.org/plugins/settings/options-api/#array-of-values)

When saved as an array of values, the option name refers to an array,
which itself may be comprised key/value pairs.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/settings/options-api/)

// array of options

\$data_r = **array**(\'title\' =\> \'hello world!\', 1, false );

// add a new option

add_option(\'wporg_custom_option\', \$data_r);

// get an option

\$options_r = get_option(\'wporg_custom_option\');

// output the title

**echo** esc_html(\$options_r\[\'title\'\]);

If you are working with a large number of related options, storing them
as an array can have a positive impact on overall performance.

Accessing data as individual options may result in many individual
database transactions, and as a rule, database transactions are
expensive operations (in terms of time and server resources). When you
store or retrieve an array of options, it happens in a single
transaction, which is ideal.

[**[Function
Reference]{.underline}**](https://developer.wordpress.org/plugins/settings/options-api/#function-reference)

  ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  Add Option                                                                                                Get Option                                                                                                Update Option                                                                                                   Delete Option
  --------------------------------------------------------------------------------------------------------- --------------------------------------------------------------------------------------------------------- --------------------------------------------------------------------------------------------------------------- ---------------------------------------------------------------------------------------------------------------
  [[add_option()]{.underline}](https://developer.wordpress.org/reference/functions/add_option/)             [[get_option()]{.underline}](https://developer.wordpress.org/reference/functions/get_option/)             [[update_option()]{.underline}](https://developer.wordpress.org/reference/functions/update_option/)             [[delete_option()]{.underline}](https://developer.wordpress.org/reference/functions/delete_option/)

  [[add_site_option()]{.underline}](https://developer.wordpress.org/reference/functions/add_site_option/)   [[get_site_option()]{.underline}](https://developer.wordpress.org/reference/functions/get_site_option/)   [[update_site_option()]{.underline}](https://developer.wordpress.org/reference/functions/update_site_option/)   [[delete_site_option()]{.underline}](https://developer.wordpress.org/reference/functions/delete_site_option/)
  ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

**First published**

September 24, 2014

**Last updated**

November 17, 2022

[PreviousCustom Settings PagePrevious: Custom Settings
Page](https://developer.wordpress.org/plugins/settings/custom-settings-page/)

[NextSettings APINext: Settings
API](https://developer.wordpress.org/plugins/settings/settings-api/)

[[Skip to
content]{.underline}](https://developer.wordpress.org/plugins/settings/settings-api/#wp--skip-link--target)

-   [Developer Blog](https://developer.wordpress.org/news/)

-   [Code Reference](https://developer.wordpress.org/reference/)

-   [WP-CLI Commands](https://developer.wordpress.org/cli/commands/)

[[Home](https://developer.wordpress.org)[Plugin
Handbook](https://developer.wordpress.org/plugins/)[Settings](https://developer.wordpress.org/plugins/settings/)]{.underline}Settings
API

Top of Form

Search

Bottom of Form

**Settings API**

In this article

-   [[Why Use the Setting
    API?]{.underline}](https://developer.wordpress.org/plugins/settings/settings-api/#why-use-the-setting-api)

    -   [[Visual
        Consistency]{.underline}](https://developer.wordpress.org/plugins/settings/settings-api/#visual-consistency)

    -   [[Robustness
        (Future-Proofing!)]{.underline}](https://developer.wordpress.org/plugins/settings/settings-api/#robustness-future-proofing)

    -   [[Less
        Work!]{.underline}](https://developer.wordpress.org/plugins/settings/settings-api/#less-work)

-   [[Function
    Reference]{.underline}](https://developer.wordpress.org/plugins/settings/settings-api/#function-reference)

The Settings API, added in WordPress 2.7, allows admin pages containing
settings forms to be managed semi-automatically. It lets you define
settings pages, sections within those pages and fields within the
sections.

New settings pages can be registered along with sections and fields
inside them. Existing settings pages can also be added to by registering
new settings sections or fields inside of them.

Organizing registration and validation of fields still requires some
effort from developers, but avoids a lot of complex debugging of
underlying options management.

When using the Settings API, the form POST to wp-admin/options.phpwhich
provides fairly strict capabilities checking. Users will need
the manage_options capability (and in Multisite will have to be a Super
Admin) to submit the form.

[**[Why Use the Setting
API?]{.underline}**](https://developer.wordpress.org/plugins/settings/settings-api/#why-use-the-setting-api)

A developer *could* ignore this API and write their own settings page
without it. That begs the question, what benefit does this API bring to
the table? Following is a quick rundown of some of the benefits.

[**[Visual
Consistency]{.underline}**](https://developer.wordpress.org/plugins/settings/settings-api/#visual-consistency)

Using the API to generate your interface elements guarantees that your
settings page will look like the rest of the administrative content.
Your interface will follow the same styleguide and look like it belongs,
and thanks to the talented team of WordPress designers, it'll look
awesome!

[**[Robustness
(Future-Proofing!)]{.underline}**](https://developer.wordpress.org/plugins/settings/settings-api/#robustness-future-proofing)

Since the API is part of WordPress Core, any updates will automatically
consider your plugin's settings page. If you make your own interface
without using Setting API, WordPress Core updates are more likely to
break your customizations. There is also a wider audience testing and
maintaining that API code, so it will tend to be more stable.

[**[Less
Work!]{.underline}**](https://developer.wordpress.org/plugins/settings/settings-api/#less-work)

Of course the most immediate benefit is that the WordPress API does a
lot of work for you under the hood. Here are a few examples of things
the Settings API does besides applying an awesome-looking, integrated
design.

-   **Handling Form Submissions --** Let WordPress handle retrieving and
    storing your \$\_POST submissions.

-   **Include Security Measures --** You get extra security measures
    such as nonces, etc. for free.

-   **Sanitizing Data --** You get access to the same methods that the
    rest of WordPress uses for ensuring strings are safe to use.

[**[Function
Reference]{.underline}**](https://developer.wordpress.org/plugins/settings/settings-api/#function-reference)

  ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  Setting Register/Unregister                                                                                     Add Field/Section
  --------------------------------------------------------------------------------------------------------------- --------------------------------------------------------------------------------------------------------------------
  [[register_setting()]{.underline}](https://developer.wordpress.org/reference/functions/register_setting/)\      [[add_settings_section()]{.underline}](https://developer.wordpress.org/reference/functions/add_settings_section/)\
  [[unregister_setting()]{.underline}](https://developer.wordpress.org/reference/functions/unregister_setting/)   [[add_settings_field()]{.underline}](https://developer.wordpress.org/reference/functions/add_settings_field/)

  ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

  ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  Options Form Rendering                                                                                               Errors
  -------------------------------------------------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------
  [[settings_fields()]{.underline}](https://developer.wordpress.org/reference/functions/settings_fields/)\             [[add_settings_error()]{.underline}](https://developer.wordpress.org/reference/functions/add_settings_error/)\
  [[do_settings_sections()]{.underline}](https://developer.wordpress.org/reference/functions/do_settings_sections/)\   [[get_settings_errors()]{.underline}](https://developer.wordpress.org/reference/functions/get_settings_errors/)\
  [[do_settings_fields()]{.underline}](https://developer.wordpress.org/reference/functions/do_settings_fields/)        [[settings_errors()]{.underline}](https://developer.wordpress.org/reference/functions/settings_errors/)

  ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

**First published**

September 24, 2014

**Last updated**

August 29, 2020

[PreviousOptions APIPrevious: Options
API](https://developer.wordpress.org/plugins/settings/options-api/)

[NextUsing Settings APINext: Using Settings
API](https://developer.wordpress.org/plugins/settings/using-settings-api/)

**Privacy**

In this article

-   [[What is
    Privacy?]{.underline}](https://developer.wordpress.org/plugins/privacy/#what-is-privacy)

-   [[Privacy By
    Design]{.underline}](https://developer.wordpress.org/plugins/privacy/#privacy-by-design)

-   [[Food for Thought for Your
    Plugin]{.underline}](https://developer.wordpress.org/plugins/privacy/#food-for-thought-for-your-plugin)

-   [[External
    Resources]{.underline}](https://developer.wordpress.org/plugins/privacy/#external-resources)

Are you writing a plugin that handles personal data -- things like
names, addresses, and other things that can be used to identify a
person? You'll want to take care with that data and protect the privacy
of your users and visitors.

[**[What is
Privacy?]{.underline}**](https://developer.wordpress.org/plugins/privacy/#what-is-privacy)

WordPress.org made several enhancements ahead of Europe's General Data
Protection Regulation. Following the launch of this work, we have made
Privacy a permanent focus in core trac development, which will allow us
to continue making enhancements on privacy and data protection outside
specific legislation.

But what kind of issues might fall under the definition of "privacy",
and how do we define it? Although privacy requirements vary widely
across countries, cultures, and legal systems, there are several general
principles applicable across any situation:

-   **Consent and choice:** giving users (and site visitors) choices and
    options over the uses of their data, and requiring clear, specific,
    and informed opt-in;

-   **Purpose legitimacy and specification:** only collect and use the
    personal data for the purpose it was intended for, and for which the
    user was clearly informed of in advance;

-   **Collection limitation:** only collect the user data which is
    needed; don't make extra copies of data or combine your data with
    data from other plugins if you can avoid it

-   **Data minimization:** restrict the processing of data, as well as
    the number of people who have access to it, to the minimum uses and
    people necessary;

-   **Use, retention and disclosure limitation:** delete data which is
    no longer needed, both in active use and in archives, by both the
    recipient and any third parties;

-   **Accuracy and quality:** ensure that the data collected and used is
    correct, relevant, and up-to-date, especially if inaccurate or poor
    data could adversely impact the user;

-   **Openness, transparency and notice:** inform users how their data
    is being collected, used, and shared, as well as any rights they
    have over those uses;

-   **Individual participation and access:** give users a means to
    access or download their data;

-   **Accountability:** documenting the uses of data, protecting it in
    transit and in use by third parties, and preventing misuse and
    breaches as much as is possible;

-   **Information security:** protecting data through appropriate
    technical and security measures;

-   **Privacy compliance:** ensuring that the work meets the privacy
    regulations of the location where it will be used to collect and
    process people's data.

(Source: [[ISO 29100/Privacy Framework
standard]{.underline}](https://www.iso.org/standard/45123.html))

While not all of these principles will be applicable across all
situations and uses, using them in the development process can help to
ensure user trust.

[**[Privacy By
Design]{.underline}**](https://developer.wordpress.org/plugins/privacy/#privacy-by-design)

Many of these principles are espoused in the Privacy by Design
framework, which states that:

-   Privacy should be proactive, not reactive, and must anticipate
    privacy issues before they reach the user. Privacy must also be
    preventative, not remedial.

-   Privacy should be the default setting. The user should not have to
    take actions to secure their privacy, and consent for data sharing
    should not be assumed.

-   Privacy should be built into design as a core function, not an
    add-on.

-   Privacy should be positive sum: there should be no trade-off between
    privacy and security, privacy and safety, or privacy and service
    provision.

-   Privacy should offer end-to-end lifecycle protection through data
    minimization, minimal data retention, and regular deletion of data
    which is no longer required.

-   The privacy standards used on your plugin (and service, if
    applicable) should be visible, transparent, open, documented and
    independently verifiable.

-   Privacy should be user-centric. People should be given options such
    as granular privacy choices, maximized privacy defaults, detailed
    privacy information notices, user-friendly options, and clear
    notification of changes.

[**[Food for Thought for Your
Plugin]{.underline}**](https://developer.wordpress.org/plugins/privacy/#food-for-thought-for-your-plugin)

To help your plugin be ready, we recommend going through the following
list of questions for every plugin that you make:

1.  How does your plugin handle personal data? Use
    wp_add_privacy_policy_content (link) to disclose to your users any
    of the following:

    -   Does the plugin share personal data with third parties (e.g. to
        outside APIs/servers). If so, what data does it share with which
        third parties and do they have a published privacy policy you
        can provide a link to?

    -   Does the plugin collect personal data? If so, what data and
        where is it stored? Think about places like user data/meta,
        options, post meta, custom tables, files, etc.

    -   Does the plugin use personal data collected by others? If so,
        what data? Does the plugin pass personal data to a SDK? What
        does that SDK do with the data?

    -   Does the plugin collect telemetry data, directly or indirectly?
        Loading an image from a third-party source on every install, for
        example, could indirectly log and track the usage data of all of
        your plugin installs.

    -   Does the plugin enqueue Javascript, tracking pixels or embed
        iframes from a third party (third party JS, tracking pixels and
        iframes can collect visitor's data/actions, leave cookies,
        etc.)?

    -   Does the plugin store things in the browser? If so, where and
        what? Think about things like cookies, local storage, etc.

2.  If your plugin collects personal data...

    -   Does it provide a personal data exporter?

    -   Does it provide a personal data eraser callback?

    -   For what reasons (if any) does the plugin refuse to erase
        personal data? (e.g. order not yet completed, etc) -- those
        should be disclosed as well.

3.  Does the plugin use error logging? Does it avoid logging personal
    data if possible? Could you use things like
    wp_privacy_anonymize_data to minimize the personal data logged? How
    long are log entries kept? Who has access to them?

4.  In wp-admin, what role/capabilities are required to access/see
    personal data? Are they sufficient?

5.  What personal data is exposed on the front end of the site by the
    plugin? Does it appear to logged-in and logged-out users? Should it?

6.  What personal data is exposed in REST API endpoints by the plugin?
    Does it appear to logged-in and logged-out users? What
    roles/capabilities are required to see it? Are those appropriate?

7.  Does the plugin properly remove/clean-up data, including especially
    personal data:

    -   During uninstall of the plugin?

    -   When a related item is deleted (e.g. from the post meta or any
        post-referencing rows in another table)?

    -   When a user is deleted (e.g. from any user referencing rows in a
        table)?

8.  Does the plugin provide controls to reduce the amount of personal
    data required?

9.  Does the plugin share personal data with SDKs or APIs only when the
    SDK or API requires it, or is the plugin also sharing personal data
    that is optional?

10. Does the amount of personal data collected or shared by this plugin
    change when certain other plugins are also installed?

**Privacy Related Options, Hooks and Capabilities**

In this article

-   [[Options]{.underline}](https://developer.wordpress.org/plugins/privacy/privacy-related-options-hooks-and-capabilities/#options)

-   [[Actions]{.underline}](https://developer.wordpress.org/plugins/privacy/privacy-related-options-hooks-and-capabilities/#actions)

-   [[Filters]{.underline}](https://developer.wordpress.org/plugins/privacy/privacy-related-options-hooks-and-capabilities/#filters)

-   [[Capabilities]{.underline}](https://developer.wordpress.org/plugins/privacy/privacy-related-options-hooks-and-capabilities/#capabilities)

The privacy tools were originally introduced in WordPress 4.9.6. These
tools are designed to allow (and encourage) developers to use them as
part of the Privacy Exporter, Privacy Eraser and the Privacy Policy
Guide.

Since then, several newer hooks have been introduced to expand on the
available capabilities. These hooks allow developers to include
additional personal data in export and erasure requests, and introduce
suggested content for the privacy policy guide. 

Along with the ability to control these tools, there are several new
filters for use with the request and confirmation emails, enabling
finer-grained controls over these notifications.

[**[Options]{.underline}**](https://developer.wordpress.org/plugins/privacy/privacy-related-options-hooks-and-capabilities/#options)

wp_page_for_privacy_policy -- contains the page ID of a site's privacy
page

[**[Actions]{.underline}**](https://developer.wordpress.org/plugins/privacy/privacy-related-options-hooks-and-capabilities/#actions)

user_request_action_confirmed -- fired when a user confirms a privacy
request

wp_privacy_delete_old_export_files -- a scheduled action used to prune
old exports from the personal data exports folder

wp_privacy_personal_data_erased -- fired after the last page of the last
eraser is complete

wp_privacy_personal_data_export_file -- used to create a personal data
export file as part of the export flow

wp_privacy_personal_data_export_file_created -- fires after a personal
data export file has been created

[**[Filters]{.underline}**](https://developer.wordpress.org/plugins/privacy/privacy-related-options-hooks-and-capabilities/#filters)

privacy_policy_url -- filters the URL of the privacy policy page.

the_privacy_policy_link -- filters the privacy policy page link HTML.

wp_get_default_privacy_policy_content -- filters the default content
suggested for inclusion through the privacy policy guide.

user_request_action_confirmed_message -- allows modifying the action
confirmation message displayed to the user

user_request_action_description -- filters the user action description.

user_request_action_email_content -- filters the text of the email sent
when an account action is attempted.

user_request_action_email_headers -- filters the headers of the email
sent when an account action is attempted.

user_request_action_email_subject -- filters the subject of the email
sent when an account action is attempted.

user_request_confirmed_email_content -- filters the body of the user
request confirmation email.

user_request_confirmed_email_headers -- filters the headers of the user
request confirmation email.

user_request_confirmed_email_subject -- filters the subject of the user
request confirmation email.

user_request_confirmed_email_to -- filters the recipient of the data
request confirmation notification.

user_request_key_expiration -- filters the expiration time of
confirmation keys for user requests.

wp_privacy_additional_user_profile_data -- filter to extend the user's
profile data for the privacy exporter.

wp_privacy_export_expiration -- controls how old export files are
allowed to get, default is 3 days

wp_privacy_personal_data_email_content -- allows modifying the email
message send to users with their personal data export file link

wp_privacy_personal_data_email_headers -- filters the headers of the
email sent with a personal data export file.

wp_privacy_personal_data_email_subject -- filters the subject of the
email sent when an export request is completed.

wp_privacy_personal_data_email_to -- filters the recipient of the
personal data export email notification.

wp_privacy_personal_data_email_to should be used with great caution to
avoid sending the data export link to the wrong recipient email
address(es).

wp_privacy_personal_data_erasers -- supports registration of core and
plugin personal data erasers

wp_privacy_personal_data_erasure_page -- Filters a page of personal data
eraser data. Allows the erasure response to be consumed by destinations
in addition to Ajax.

wp_privacy_personal_data_exporters -- supports registration of core and
plugin personal data exporters

wp_privacy_personal_data_export_page -- filters a page of personal data
exporter data. Used to build the export report. Allows the export
response to be consumed by destinations in addition to Ajax.

wp_privacy_anonymize_data -- filters the anonymous data for each type.

wp_privacy_exports_dir -- filters the directory used to store personal
data export files.

wp_privacy_exports_url -- filters the URL of the directory used to store
personal data export files.

user_confirmed_action_email_content -- Filters the body of the user
request confirmation email. The email is sent to an administrator when
an user request is confirmed.

user_erasure_fulfillment_email_to -- Filters the recipient of the data
erasure fulfillment notification.

user_erasure_complete_email_subject -- Filters the subject of the email
sent when an erasure request is completed.

user_confirmed_action_email_content -- Filters the body of the data
erasure fulfillment notification. The email is sent to a user when a
their data erasure request is fulfilled by an administrator.

user_erasure_complete_email_headers -- Filters the headers of the data
erasure fulfillment notification.

[**[Capabilities]{.underline}**](https://developer.wordpress.org/plugins/privacy/privacy-related-options-hooks-and-capabilities/#capabilities)

Access to the privacy tools is controlled by a few new capabilities.
Administrators (on non-multisite installations) have these capabilities
by default. These capabilities are:

erase_others_personal_data -- determines if the Erase Personal Data
sub-menu is available under Tools

export_others_personal_data -- determines if the Export Personal Data
sub-menu is available under Tools

manage_privacy_options -- determines if the Privacy sub-menu is
available under Settings

**First published**

May 17, 2018

-   

[**[Get WordPress]{.underline}**](https://wordpress.org/download/)

[[WordPress Developer
Resources]{.underline}](https://developer.wordpress.org)

Top-Level Menus

-   [Developer Blog](https://developer.wordpress.org/news/)

-   [Code Reference](https://developer.wordpress.org/reference/)

-   [WP-CLI Commands](https://developer.wordpress.org/cli/commands/)

[[Home](https://developer.wordpress.org)[Plugin
Handbook](https://developer.wordpress.org/plugins/)[Administration
Menus](https://developer.wordpress.org/plugins/administration-menus/)]{.underline}Top-Level
Menus

Top of Form

Search

Bottom of Form

**Top-Level Menus**

In this article

-   [[Add a Top-Level
    Menu]{.underline}](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/#add-a-top-level-menu)

    -   [[Example]{.underline}](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/#example)

    -   [[Using a PHP File for
        HTML]{.underline}](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/#using-a-php-file-for-html)

-   [[Remove a Top-Level
    Menu]{.underline}](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/#remove-a-top-level-menu)

    -   [[Example]{.underline}](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/#example-2)

-   [[Submitting
    forms]{.underline}](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/#submitting-forms)

    -   [[Form action
        attribute]{.underline}](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/#form-action-attribute)

    -   [[Processing the
        form]{.underline}](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/#processing-the-form)

[↑ [Back to
top]{.underline}](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/#wp--skip-link--target)

[**[Add a Top-Level
Menu]{.underline}**](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/#add-a-top-level-menu)

To add a new Top-level menu to WordPress Administration, use
the [[add_menu_page()]{.underline}](https://developer.wordpress.org/reference/functions/add_menu_page/) function.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/)

add_menu_page(

**string** \$page_title,

**string** \$menu_title,

**string** \$capability,

**string** \$menu_slug,

**callable** \$function = \'\',

**string** \$icon_url = \'\',

**int** \$position = null

);

[**[Example]{.underline}**](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/#example)

Lets say we want to add a new Top-level menu called "WPOrg".

**The first step** will be creating a function which will output the
HTML. In this function we will perform the necessary security checks and
render the options we've registered using the [[Settings
API]{.underline}](https://developer.wordpress.org/plugins/settings/).

We recommend wrapping your HTML using a \<div\> with a class of wrap.

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/)

**function** wporg_options_page_html() {

**?\>**

\<div class=\"wrap\"\>

\<h1\>**\<?php** **echo** esc_html( get_admin_page_title() );
**?\>**\</h1\>

\<form action=\"options.php\" method=\"post\"\>

**\<?php**

// output security fields for the registered setting \"wporg_options\"

settings_fields( \'wporg_options\' );

// output setting sections and their fields

// (sections are registered for \"wporg\", each field is registered to a
specific section)

do_settings_sections( \'wporg\' );

// output save settings button

submit_button( \_\_( \'Save Settings\', \'textdomain\' ) );

**?\>**

\</form\>

\</div\>

**\<?php**

}

**The second step** will be registering our WPOrg menu. The registration
needs to occur during the admin_menu action hook.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/)

add_action( \'admin_menu\', \'wporg_options_page\' );

**function** wporg_options_page() {

add_menu_page(

\'WPOrg\',

\'WPOrg Options\',

\'manage_options\',

\'wporg\',

\'wporg_options_page_html\',

plugin_dir_url(\_\_FILE\_\_) . \'images/icon_wporg.png\',

20

);

}

For a list of parameters and what each do please see
the [[add_menu_page()]{.underline}](https://developer.wordpress.org/reference/functions/add_menu_page/)in
the reference.

[**[Using a PHP File for
HTML]{.underline}**](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/#using-a-php-file-for-html)

The best practice for portable code would be to create a Callback that
requires/includes your PHP file.

For the sake of completeness and helping you understand legacy code, we
will show another way: passing a PHP file path as
the \$menu_slugparameter with an null \$function parameter.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/)

add_action( \'admin_menu\', \'wporg_options_page\' );

**function** wporg_options_page() {

add_menu_page(

\'WPOrg\',

\'WPOrg Options\',

\'manage_options\',

plugin_dir_path(\_\_FILE\_\_) . \'admin/view.php\',

null,

plugin_dir_url(\_\_FILE\_\_) . \'images/icon_wporg.png\',

20

);

}

[**[Remove a Top-Level
Menu]{.underline}**](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/#remove-a-top-level-menu)

To remove a registered menu from WordPress Administration, use
the [[remove_menu_page()]{.underline}](https://developer.wordpress.org/reference/functions/remove_menu_page/) function.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/)

remove_menu_page(

**string** \$menu_slug

);

Removing menus won't prevent users accessing them directly.\
This should never be used as a way to restrict [[user
capabilities]{.underline}](https://developer.wordpress.org/plugins/users/roles-and-capabilities/).

[**[Example]{.underline}**](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/#example-2)

Lets say we want to remove the "Tools" menu from.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/)

add_action( \'admin_menu\', \'wporg_remove_options_page\', 99 );

**function** wporg_remove_options_page() {

remove_menu_page( \'tools.php\' );

}

Make sure that the menu have been registered with the admin_menu hook
before attempting to remove, specify a higher priority number
for [[add_action()]{.underline}](https://developer.wordpress.org/reference/functions/add_action/) .

[**[Submitting
forms]{.underline}**](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/#submitting-forms)

To process the submissions of forms on options pages, you will need two
things:

1.  Use the URL of the page as the action attribute of the form.

2.  Add a hook with the slug, returned by add_menu_page.

You only need to follow those steps if you are manually creating forms
in the back-end. The [[Settings
API]{.underline}](https://developer.wordpress.org/plugins/settings/) is
the recommended way to do this.

[**[Form action
attribute]{.underline}**](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/#form-action-attribute)

Use the \$menu_slug parameter of the options page as the first parameter
of [[menu_page_url()]{.underline}](https://developer.wordpress.org/reference/functions/menu_page_url/).
By the function will automatically escape URL and echo it by default, so
you can directly use it within the \<form\> tag:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/)

\<form action=\"**\<?php** menu_page_url( \'wporg\' ) **?\>**\"
method=\"post\"\>

[**[Processing the
form]{.underline}**](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/#processing-the-form)

The \$function you specify while adding the page will only be called
once it is time to display the page, which makes it inappropriate if you
need to send headers (ex. redirects) back to the browser.

add_menu_page returns a \$hookname, and WordPress triggers
the \"load-\$hookname\" action before any HTML output. You can use this
to assign a function, which could process the form.

\"load-\$hookname\" will be executed every time before an options page
will be displayed, even when the form is not being submitted.

With the return parameter and action in mind, the example from above
would like this:

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/)

add_action( \'admin_menu\', \'wporg_options_page\' );

**function** wporg_options_page() {

\$hookname = add_menu_page(

\'WPOrg\',

\'WPOrg Options\',

\'manage_options\',

\'wporg\',

\'wporg_options_page_html\',

plugin_dir_url(\_\_FILE\_\_) . \'images/icon_wporg.png\',

20

);

add_action( \'load-\' . \$hookname, \'wporg_options_page_submit\' );

}

You can program wporg_options_page_submit according to your needs, but
keep in mind that you must manually perform all necessary checks,
including:

1.  Whether the form is being submitted (\'POST\' ===
    \$\_SERVER\[\'REQUEST_METHOD\'\]).

2.  [[CSRF
    verification]{.underline}](https://developer.wordpress.org/plugins/security/nonces/)

3.  Validation

4.  Sanitization

**First published**

September 17, 2014

**Last updated**

November 17, 2022

[PreviousSub-MenusPrevious:
Sub-Menus](https://developer.wordpress.org/plugins/administration-menus/sub-menus/)

[NextShortcodesNext:
Shortcodes](https://developer.wordpress.org/plugins/shortcodes/)

[Code Reference](https://developer.wordpress.org/reference/)

-   [WP-CLI Commands](https://developer.wordpress.org/cli/commands/)

[[Home](https://developer.wordpress.org)[Plugin
Handbook](https://developer.wordpress.org/plugins/)[Administration
Menus](https://developer.wordpress.org/plugins/administration-menus/)]{.underline}Sub-Menus

Top of Form

Search

Bottom of Form

**Sub-Menus**

In this article

-   [[Add a
    Sub-Menu]{.underline}](https://developer.wordpress.org/plugins/administration-menus/sub-menus/#add-a-sub-menu)

    -   [[Example]{.underline}](https://developer.wordpress.org/plugins/administration-menus/sub-menus/#example)

-   [[Predefined
    Sub-Menus]{.underline}](https://developer.wordpress.org/plugins/administration-menus/sub-menus/#predefined-sub-menus)

-   [[Remove a
    Sub-Menu]{.underline}](https://developer.wordpress.org/plugins/administration-menus/sub-menus/#remove-a-sub-menu)

-   [[Submitting
    forms]{.underline}](https://developer.wordpress.org/plugins/administration-menus/sub-menus/#submitting-forms)

[**[Add a
Sub-Menu]{.underline}**](https://developer.wordpress.org/plugins/administration-menus/sub-menus/#add-a-sub-menu)

To add a new Sub-menu to WordPress Administration, use
the add_submenu_page() function.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/administration-menus/sub-menus/)

add_submenu_page(

**string** \$parent_slug,

**string** \$page_title,

**string** \$menu_title,

**string** \$capability,

**string** \$menu_slug,

**callable** \$function = \'\'

);

[**[Example]{.underline}**](https://developer.wordpress.org/plugins/administration-menus/sub-menus/#example)

Lets say we want to add a Sub-menu "WPOrg Options" to the "Tools"
Top-level menu.

**The first step** will be creating a function which will output the
HTML. In this function we will perform the necessary security checks and
render the options we've registered using the [[Settings
API]{.underline}](https://developer.wordpress.org/plugins/settings/).

We recommend wrapping your HTML using a \<div\> with a class of wrap.

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/administration-menus/sub-menus/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/administration-menus/sub-menus/)

**function** wporg_options_page_html() {

// check user capabilities

**if** ( ! current_user_can( \'manage_options\' ) ) {

**return**;

}

**?\>**

\<div class=\"wrap\"\>

\<h1\>**\<?php** **echo** esc_html( get_admin_page_title() );
**?\>**\</h1\>

\<form action=\"options.php\" method=\"post\"\>

**\<?php**

// output security fields for the registered setting \"wporg_options\"

settings_fields( \'wporg_options\' );

// output setting sections and their fields

// (sections are registered for \"wporg\", each field is registered to a
specific section)

do_settings_sections( \'wporg\' );

// output save settings button

submit_button( \_\_( \'Save Settings\', \'textdomain\' ) );

**?\>**

\</form\>

\</div\>

**\<?php**

}

**The second step** will be registering our WPOrg Options Sub-menu. The
registration needs to occur during the admin_menu action hook.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/administration-menus/sub-menus/)

**function** wporg_options_page()

{

add_submenu_page(

\'tools.php\',

\'WPOrg Options\',

\'WPOrg Options\',

\'manage_options\',

\'wporg\',

\'wporg_options_page_html\'

);

}

add_action(\'admin_menu\', \'wporg_options_page\');

For a list of parameters and what each do please see
the [[add_submenu_page()]{.underline}](https://developer.wordpress.org/reference/functions/add_submenu_page/) in
the reference.

[**[Predefined
Sub-Menus]{.underline}**](https://developer.wordpress.org/plugins/administration-menus/sub-menus/#predefined-sub-menus)

Wouldn't it be nice if we had helper functions that define
the \$parent_slugfor WordPress built-in Top-level menus and save us from
manually searching it through the source code?

Below is a list of parent slugs and their helper functions:

-   [[add_dashboard_page()]{.underline}](https://developer.wordpress.org/reference/functions/add_dashboard_page/) -- index.php

-   [[add_posts_page()]{.underline}](https://developer.wordpress.org/reference/functions/add_posts_page/) -- edit.php

-   [[add_media_page()]{.underline}](https://developer.wordpress.org/reference/functions/add_media_page/) -- upload.php

-   [[add_pages_page()]{.underline}](https://developer.wordpress.org/reference/functions/add_pages_page/) -- edit.php?post_type=page

-   [[add_comments_page()]{.underline}](https://developer.wordpress.org/reference/functions/add_comments_page/) -- edit-comments.php

-   [[add_theme_page()]{.underline}](https://developer.wordpress.org/reference/functions/add_theme_page/) -- themes.php

-   [[add_plugins_page()]{.underline}](https://developer.wordpress.org/reference/functions/add_plugins_page/) -- plugins.php

-   [[add_users_page()]{.underline}](https://developer.wordpress.org/reference/functions/add_users_page/) -- users.php

-   [[add_management_page()]{.underline}](https://developer.wordpress.org/reference/functions/add_management_page/) -- tools.php

-   [[add_options_page()]{.underline}](https://developer.wordpress.org/reference/functions/add_options_page/) -- options-general.php

-   [[add_options_page()]{.underline}](https://developer.wordpress.org/reference/functions/add_options_page/) -- settings.php

-   [[add_links_page()]{.underline}](https://developer.wordpress.org/reference/functions/add_links_page/) -- link-manager.php --
    requires a plugin since WP 3.5+

-   Custom Post Type -- edit.php?post_type=wporg_post_type

-   Network Admin -- settings.php

[**[Remove a
Sub-Menu]{.underline}**](https://developer.wordpress.org/plugins/administration-menus/sub-menus/#remove-a-sub-menu)

The process of removing Sub-menus is exactly the same as [[removing
Top-level
menus]{.underline}](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/#remove-a-top-level-menu).

[**[Submitting
forms]{.underline}**](https://developer.wordpress.org/plugins/administration-menus/sub-menus/#submitting-forms)

The process of handling form submissions within Sub-menus is exactly the
same as [[Submitting forms within Top-Level
Menus]{.underline}](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/#submitting-forms).

add_submenu_page() along with all functions for pre-defined sub-menus
(add_dashboard_page, add_posts_page, etc.) will return a \$hookname,
which you can use as the first parameter of add_action in order to
handle the submission of forms within custom pages:

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/administration-menus/sub-menus/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/administration-menus/sub-menus/)

**function** wporg_options_page() {

\$hookname = add_submenu_page(

\'tools.php\',

\'WPOrg Options\',

\'WPOrg Options\',

\'manage_options\',

\'wporg\',

\'wporg_options_page_html\'

);

add_action( \'load-\' . \$hookname, \'wporg_options_page_html_submit\'
);

}

add_action(\'admin_menu\', \'wporg_options_page\');

As always, do not forget to check whether the form is being submitted,
do CSRF
verification, [[validation]{.underline}](https://developer.wordpress.org/plugins/security/data-validation/),
and sanitization.

**First published**

September 17, 2014

**Last updated**

November 17, 2022

[PreviousAdministration MenusPrevious: Administration
Menus](https://developer.wordpress.org/plugins/administration-menus/)

[NextTop-Level MenusNext: Top-Level
Menus](https://developer.wordpress.org/plugins/administration-menus/top-level-menus/)

**Shortcodes**

In this article

-   [[Why
    Shortcodes?]{.underline}](https://developer.wordpress.org/plugins/shortcodes/#why-shortcodes)

-   [[Built-in
    Shortcodes]{.underline}](https://developer.wordpress.org/plugins/shortcodes/#built-in-shortcodes)

-   [[Shortcode Best
    Practices]{.underline}](https://developer.wordpress.org/plugins/shortcodes/#shortcode-best-practices)

-   [[Quick
    Reference]{.underline}](https://developer.wordpress.org/plugins/shortcodes/#quick-reference)

-   [[External
    Resources]{.underline}](https://developer.wordpress.org/plugins/shortcodes/#external-resources)

As a security precaution, running PHP inside WordPress content is
forbidden; to allow dynamic interactions with the content, Shortcodes
were presented in WordPress version 2.5.

Shortcodes are macros that can be used to perform dynamic interactions
with the content. i.e creating a gallery from images attached to the
post or rendering a video.

[**[Why
Shortcodes?]{.underline}**](https://developer.wordpress.org/plugins/shortcodes/#why-shortcodes)

Shortcodes are a valuable way of keeping content clean and semantic
while allowing end users some ability to programmatically alter the
presentation of their content.

When the end user adds a photo gallery to their post using a shortcode,
they're using the least data possible to indicate how the gallery should
be presented.

Advantages:

-   No markup is added to the post content, which means that markup and
    styling can easily be manipulated on the fly or at a later state.

-   Shortcodes can also accept parameters, allowing users to modify how
    the shortcode behaves on an instance by instance basis.

[**[Built-in
Shortcodes]{.underline}**](https://developer.wordpress.org/plugins/shortcodes/#built-in-shortcodes)

By default, WordPress includes the following shortcodes:

-   \[caption\] -- allows you to wrap captions around content

-   \[gallery\] -- allows you to show image galleries

-   \[audio\] -- allows you to embed and play audio files

-   \[video\] -- allows you to embed and play video files

-   \[playlist\] -- allows you to display collection of audio or video
    files

-   \[embed\] -- allows you to wrap embedded items

[**[Shortcode Best
Practices]{.underline}**](https://developer.wordpress.org/plugins/shortcodes/#shortcode-best-practices)

Best practices for developing shortcodes include the [[plugin
development best
practices]{.underline}](https://developer.wordpress.org/plugins/the-basics/best-practices/) and
the list below:

-   **Always return!**\
    Shortcodes are essentially filters, so creating "[[side
    effects]{.underline}](https://en.wikipedia.org/wiki/Side_effect_(computer_science))"
    will lead to unexpected bugs.

-   Prefix your shortcode names to avoid collisions with other plugins.

-   Sanitize the input and escape the output.

-   Provide users with clear documentation on all shortcode attributes.

[**[Quick
Reference]{.underline}**](https://developer.wordpress.org/plugins/shortcodes/#quick-reference)

See the complete example of using a [[basic shortcode structure, taking
care of self-closing and enclosing scenarios, shortcodes within
shortcodes and securing
output]{.underline}](https://developer.wordpress.org/plugins/shortcodes/shortcodes-with-parameters/#complete-example).

Best Practices

-   [Developer Blog](https://developer.wordpress.org/news/)

-   [Code Reference](https://developer.wordpress.org/reference/)

-   [WP-CLI Commands](https://developer.wordpress.org/cli/commands/)

[[Home](https://developer.wordpress.org)[Plugin
Handbook](https://developer.wordpress.org/plugins/)[Plugin
Basics](https://developer.wordpress.org/plugins/plugin-basics/)]{.underline}Best
Practices

Top of Form

Search

Bottom of Form

**Best Practices**

In this article

-   [[Avoid Naming
    Collisions]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#avoid-naming-collisions)

    -   [[Procedural Coding
        Method]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#procedural-coding-method)

    -   [[Object Oriented Programming
        Method]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#object-oriented-programming-method)

-   [[File
    Organization]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#file-organization)

    -   [[Folder
        Structure]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#folder-structure)

-   [[Plugin
    Architecture]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#plugin-architecture)

    -   [[Conditional
        Loading]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#conditional-loading)

    -   [[Avoiding Direct File
        Access]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#avoiding-direct-file-access)

    -   [[Architecture
        Patterns]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#architecture-patterns)

    -   [[Architecture Patterns
        Explained]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#architecture-patterns-explained)

-   [[Boilerplate Starting
    Points]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#boilerplate-starting-points)

[↑ [Back to
top]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#wp--skip-link--target)

Here are some best practices to help organize your code so it works well
alongside WordPress core and other WordPress plugins.

[**[Avoid Naming
Collisions]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#avoid-naming-collisions)

A naming collision happens when your plugin is using the same name for a
variable, function or a class as another plugin.

Luckily, you can avoid naming collisions by using the methods below.

[**[Procedural Coding
Method]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#procedural-coding-method)

By default, all variables, functions and classes are defined in
the **global namespace**, which means that it is possible for your
plugin to override variables, functions and classes set by another
plugin and vice-versa. Variables that are defined *inside* of functions
or classes are not affected by this.

**Prefix Everything**

All globally accessible code should be prefixed with
a *unique* identifier. Prefixes prevent conflicts with other plugins and
prevents them from overwriting your variables and accidentally calling
your functions and classes.

In order to prevent conflicts with other plugins, your prefix should be
at least 4 letters long, though we recommend 5. You should avoid using a
common English word, and instead choose something unique to your plugin.
We host tens of thousands of plugins on WordPress.org alone. There are
hundreds of thousands more outside our servers. You're *going* to run
into conflicts.

A good way to do this is with a prefix. For example, if your plugin is
called "Easy Custom Post Types" then you could use names like these:

-   function ecpt_save_post()

-   define( 'ECPT_LICENSE', true );

-   class ECPT_Admin{}

-   namespace EasyCustomPostTypes;

-   update_option( \'ecpt_settings\', \$settings );

Because you are making code as a part of the **WordPress** project, you
must avoid the use of prefixes that have a high probability of
conflicting with the core WordPress. This includes but is not limited
to: \_\_ (double underscores), wp\_ , WordPress, or \_ (single
underscore)

If you are making code for a 'sub' plugin (such as a WooCommece
extension), you would similarly need to avoid using any of their
normal/common prefixes (i.e. Woo, WooCommerce).

You can use them *inside* your classes or namespace, but not as
stand-alone function/namespace/class.

If you're using \_n() or \_\_() for translation, that's fine.
We're **only** talking about functions you've created for your plugin,
not the core functions from WordPress. In fact, those core features
are *why* you need to not use those prefixes in your own plugin! You
wouldn't want to break WordPress for your users.

Remember: Good prefix names are unique and distinct to your plugin. This
will help you and the next person in debugging, as well as prevent
conflicts.

Code that **must** be prefixed includes:

-   Functions (unless namespaced)

-   Classes, interfaces, and traits (unless namespaced)

-   Namespaces

-   Global variables

-   Options and transients

**Check for Existing Implementations**

PHP provides a number of functions to verify existence of variables,
functions, classes and constants. All of these will return true if the
entity exists.

-   **Variables**: [[isset()]{.underline}](http://php.net/manual/en/function.isset.php) (includes
    arrays, objects, etc.)

-   **Functions**: [[function_exists()]{.underline}](http://php.net/manual/en/function.function-exists.php)

-   **Classes**: [[class_exists()]{.underline}](http://php.net/manual/en/function.class-exists.php)

-   **Constants**: [[defined()]{.underline}](http://php.net/manual/en/function.defined.php)

Keep in mind that using(!function_exists('NAME ')) { around all your
functions and classes sounds like a great idea until you realize the
fatal flaw. If something else has a function with the same name and
their code loads first, your plugin will break. Using if-exists to
replace/override a function or class should be reserved
for *shared* libraries only.

**Example**

[[Copy]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/best-practices/)

// Create a function called \"wporg_init\" if it doesn\'t already exist

**if** ( ! function_exists( \'wporg_init\' ) ) {

**function** wporg_init() {

register_setting( \'wporg_settings\', \'wporg_option_foo\' );

}

}

// Create a function called \"wporg_get_foo\" if it doesn\'t already
exist

**if** ( ! function_exists( \'wporg_get_foo\' ) ) {

**function** wporg_get_foo() {

**return** get_option( \'wporg_option_foo\' );

}

}

[**[Object Oriented Programming
Method]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#object-oriented-programming-method)

An easier way to tackle the naming collision problem is to use
a [[class]{.underline}](http://php.net/manual/en/language.oop5.php) for
the code of your plugin.

You will still need to take care of checking whether the name of the
class you want is already taken but the rest will be taken care of by
PHP.

**Example**

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/best-practices/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/best-practices/)

**if** ( ! class_exists( \'WPOrg_Plugin\' ) ) {

**class** WPOrg_Plugin {

**public** **static** **function** init() {

register_setting( \'wporg_settings\', \'wporg_option_foo\' );

}

**public** **static** **function** get_foo() {

**return** get_option( \'wporg_option_foo\' );

}

}

WPOrg_Plugin::init();

WPOrg_Plugin::get_foo();

}

[**[File
Organization]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#file-organization)

The root level of your plugin directory should contain
your plugin-name.php file and, optionally,
your [[uninstall.php]{.underline}](https://developer.wordpress.org/plugin/the-basics/uninstall-methods/) file.
All other files should be organized into sub folders whenever possible.

[**[Folder
Structure]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#folder-structure)

A clear folder structure helps you and others working on your plugin
keep similar files together.

Here's a sample folder structure for reference:

/plugin-name

plugin-name.php

uninstall.php

/languages

/includes

/admin

/js

/css

/images

/public

/js

/css

/images

[**[Plugin
Architecture]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#plugin-architecture)

The architecture, or code organization, you choose for your plugin will
likely depend on the size of your plugin.

For small, single-purpose plugins that have limited interaction with
WordPress core, themes or other plugins, there's little benefit in
engineering complex classes; unless you know the plugin is going to
expand greatly later on.

For large plugins with lots of code, start off with classes in mind.
Separate style and scripts files, and even build-related files. This
will help code organization and long-term maintenance of the plugin.

[**[Conditional
Loading]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#conditional-loading)

It's helpful to separate your admin code from the public code. Use the
conditional [[is_admin()]{.underline}](https://codex.wordpress.org/Function_Reference/is_admin).
You must still perform capability checks as this doesn't indicate the
user is authenticated or has Administrator-level access. See [[Checking
User
Capabilities]{.underline}](https://developer.wordpress.org/plugins/security/checking-user-capabilities/).

For example:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/best-practices/)

**if** ( is_admin() ) {

// we are in admin mode

**require_once** \_\_DIR\_\_ . \'/admin/plugin-name-admin.php\';

}

[**[Avoiding Direct File
Access]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#avoiding-direct-file-access)

As a security precaution, it's a good practice to disallow access if
the ABSPATH global is not defined. This is only applicable to files
which contain code outside of class or function definitions, such as the
main plugin file.

You can implement this by including this code at the top of the file:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/best-practices/)

**if** ( ! defined( \'ABSPATH\' ) ) {

**exit**; // Exit if accessed directly

}

[**[Architecture
Patterns]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#architecture-patterns)

While there are a number of possible architecture patterns, they can
broadly be grouped into three variations:

-   [[Single plugin file, containing
    functions]{.underline}](https://github.com/GaryJones/move-floating-social-bar-in-genesis/blob/master/move-floating-social-bar-in-genesis.php)

-   [[Single plugin file, containing a class, instantiated object and
    optionally
    functions]{.underline}](https://github.com/norcross/wp-comment-notes/blob/master/wp-comment-notes.php)

-   [[Main plugin file, then one or more class
    files]{.underline}](https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate)

[**[Architecture Patterns
Explained]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#architecture-patterns-explained)

Specific implementations of the more complex of the above code
organizations have already been written up as tutorials and slides:

-   [[Slash -- Singletons, Loaders, Actions, Screens,
    Handlers]{.underline}](https://jjj.blog/2012/12/slash-architecture-my-approach-to-building-wordpress-plugins/)

-   [[Implementing the MVC Pattern in WordPress
    Plugins]{.underline}](http://iandunn.name/wp-mvc)

[**[Boilerplate Starting
Points]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#boilerplate-starting-points)

Instead of starting from scratch for each new plugin you write, you may
want to start with a **boilerplate**. One advantage of using a
boilerplate is to have consistency among your own plugins. Boilerplates
also make it easier for other people to contribute to your code if you
use a boilerplate they are already familiar with.

These also serve as further examples of different yet comparable
architectures.

-   [[WordPress Plugin
    Boilerplate]{.underline}](https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate):
    A foundation for WordPress Plugin Development that aims to provide a
    clear and consistent guide for building your plugins.

-   [[WordPress Plugin
    Bootstrap]{.underline}](https://github.com/claudiosmweb/wordpress-plugin-boilerplate):
    Basic bootstrap to develop WordPress plugins using Grunt, Compass,
    GIT, and SVN.

-   [[WP Skeleton
    Plugin]{.underline}](https://github.com/ptahdunbar/wp-skeleton-plugin):
    Skeleton plugin that focuses on unit tests and use of composer for
    development.

-   [[WP CLI
    Scaffold]{.underline}](https://developer.wordpress.org/cli/commands/scaffold/plugin/):
    The Scaffold command of WP CLI creates a skeleton plugin with
    options such as CI configuration files

Of course, you could take different aspects of these and others to
create your own custom boilerplate.

**First published**

September 16, 2014

**Last updated**

August 28, 2024

[PreviousActivation / Deactivation HooksPrevious: Activation /
Deactivation
Hooks](https://developer.wordpress.org/plugins/plugin-basics/activation-deactivation-hooks/)

[NextDetermining Plugin and Content DirectoriesNext: Determining Plugin
and Content
Directories](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/)

**Determining Plugin and Content Directories**

In this article

-   [Common
    Usage](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/#common-usage)

-   [Available
    Functions](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/#available-functions)

    -   [Plugins](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/#plugins)

    -   [Themes](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/#themes)

    -   [Site
        Home](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/#site-home)

    -   [WordPress](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/#wordpress)

    -   [Multisite](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/#multisite)

-   [Constants](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/#constants)

-   [Related](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/#related)

When coding WordPress plugins you often need to reference various files
and folders throughout the WordPress installation and within your plugin
or theme.

WordPress provides several functions for easily determining where a
given file or directory lives. Always use these functions in your
plugins instead of hard-coding references to the wp-content directory or
using the WordPress internal constants.

WordPress allows users to place their wp-content directory anywhere they
want and rename it whatever they want. Never assume that plugins will be
in wp-content/plugins, uploads will be in wp-content/uploads, or that
themes will be in wp-content/themes.

PHP's \_\_FILE\_\_ magic-constant resolves symlinks automatically, so if
the wp-content or wp-content/plugins or even the individual plugin
directory is symlinked, hardcoded paths will not work correctly.

[**[Common
Usage]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/#common-usage)

If your plugin includes JavaScript files, CSS files or other external
files, then it's likely you'll need the URL to these files so you can
load them into the page. To do this you should use
the [[plugins_url()]{.underline}](https://developer.wordpress.org/reference/functions/plugins_url/) function
like so:

[Copy](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/)

plugins_url( \'myscript.js\', \_\_FILE\_\_ );

This will return the full URL to myscript.js, such
as example.com/wp-content/plugins/myplugin/myscript.js.

To load your plugins' JavaScript or CSS into the page you should
use [[wp_enqueue_script()]{.underline}](https://developer.wordpress.org/reference/functions/wp_enqueue_script/) or [[wp_enqueue_style()]{.underline}](https://developer.wordpress.org/reference/functions/wp_enqueue_style/) respectively,
passing the result of plugins_url() as the file URL.

[**[Available
Functions]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/#available-functions)

WordPress includes many other functions for determining paths and URLs
to files or directories within plugins, themes, and WordPress itself.
See the individual DevHub pages for each function for complete
information on their use.

[**[Plugins]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/#plugins)

[Copy](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/)

plugins_url()

plugin_dir_url()

plugin_dir_path()

plugin_basename()

[**[Themes]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/#themes)

[Copy](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/)

get_template_directory_uri()

get_stylesheet_directory_uri()

get_stylesheet_uri()

get_theme_root_uri()

get_theme_root()

get_theme_roots()

get_stylesheet_directory()

get_template_directory()

[**[Site
Home]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/#site-home)

[Copy](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/)

home_url()

get_home_path()

[**[WordPress]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/#wordpress)

[Copy](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/)

admin_url()

site_url()

content_url()

includes_url()

wp_upload_dir()

[**[Multisite]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/#multisite)

[Copy](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/)

get_admin_url()

get_home_url()

get_site_url()

network_admin_url()

network_site_url()

network_home_url()

[**[Constants]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/#constants)

WordPress makes use of the following constants when determining the path
to the content and plugin directories. These should not be used directly
by plugins or themes, but are listed here for completeness.

[Copy](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/)

WP_CONTENT_DIR // no trailing slash, full paths only

WP_CONTENT_URL // full url

WP_PLUGIN_DIR // full path, no trailing slash

WP_PLUGIN_URL // full url, no trailing slash

// Available per default in MS, not set in single site install

// Can be used in single site installs (as usual: at your own risk)

UPLOADS // (If set, uploads folder, relative to ABSPATH) (for e.g.:
/wp-content/uploads)

[**[Related]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/determining-plugin-and-content-directories/#related)

**WordPress Directories**:

  ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  [[home_url()]{.underline}](https://developer.wordpress.org/reference/functions/home_url/)             Home URL    [[http://www.example.com]{.underline}](http://www.example.com)
  ----------------------------------------------------------------------------------------------------- ----------- ------------------------------------------------------------------------------------------------------------------------------------------------------
  [[site_url()]{.underline}](https://developer.wordpress.org/reference/functions/site_url/)             Site        [[http://www.example.com]{.underline}](http://www.example.com) or [[http://www.example.com/wordpress]{.underline}](http://www.example.com/wordpress)
                                                                                                        directory   
                                                                                                        URL         

  [[admin_url()]{.underline}](https://developer.wordpress.org/reference/functions/admin_url/)           Admin       [[http://www.example.com/wp-admin]{.underline}](http://www.example.com/wp-admin)
                                                                                                        directory   
                                                                                                        URL         

  [[includes_url()]{.underline}](https://developer.wordpress.org/reference/functions/includes_url/)     Includes    [[http://www.example.com/wp-includes]{.underline}](http://www.example.com/wp-includes)
                                                                                                        directory   
                                                                                                        URL         

  [[content_url()]{.underline}](https://developer.wordpress.org/reference/functions/content_url/)       Content     [[http://www.example.com/wp-content]{.underline}](http://www.example.com/wp-content)
                                                                                                        directory   
                                                                                                        URL         

  [[plugins_url()]{.underline}](https://developer.wordpress.org/reference/functions/plugins_url/)       Plugins     [[http://www.example.com/wp-content/plugins]{.underline}](http://www.example.com/wp-content/plugins)
                                                                                                        directory   
                                                                                                        URL         

  [[wp_upload_dir()]{.underline}](https://developer.wordpress.org/reference/functions/wp_upload_dir/)   Upload      [[http://www.example.com/wp-content/uploads]{.underline}](http://www.example.com/wp-content/uploads)
                                                                                                        directory   
                                                                                                        URL         
                                                                                                        (returns an 
                                                                                                        array)      
  ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Uninstall Methods

-   [Developer Blog](https://developer.wordpress.org/news/)

-   [Code Reference](https://developer.wordpress.org/reference/)

-   [WP-CLI Commands](https://developer.wordpress.org/cli/commands/)

[[Home](https://developer.wordpress.org)[Plugin
Handbook](https://developer.wordpress.org/plugins/)[Plugin
Basics](https://developer.wordpress.org/plugins/plugin-basics/)]{.underline}Uninstall
Methods

Top of Form

Search

Bottom of Form

**Uninstall Methods**

In this article

-   [[Method 1:
    register_uninstall_hook]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/uninstall-methods/#method-1-register_uninstall_hook)

-   [[Method 2:
    uninstall.php]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/uninstall-methods/#method-2-uninstall-php)

[↑ [Back to
top]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/uninstall-methods/#wp--skip-link--target)

Your plugin may need to do some clean-up when it is uninstalled from a
site.

A plugin is considered uninstalled if a user has deactivated the plugin,
and then clicks the delete link within the WordPress Admin.

When your plugin is uninstalled, you'll want to clear out any plugin
options and/or settings specific to the plugin, and/or other database
entities such as tables.

Less experienced developers sometimes make the mistake of using the
deactivation hook for this purpose.

This table illustrates the differences between deactivation and
uninstall.

  ------------------------------------------------------------------------------------------------------------------------------------
  Scenario                                                                                              Deactivation     Uninstall
                                                                                                        Hook             Hook
  ----------------------------------------------------------------------------------------------------- ---------------- -------------
  Flush Cache/Temp                                                                                      Yes              No

  Flush Permalinks                                                                                      Yes              No

  Remove Options from                                                                                   No               Yes
  {\$[[wpdb]{.underline}](https://developer.wordpress.org/reference/classes/wpdb/)-\>prefix}\_options                    

  Remove Tables from [[wpdb]{.underline}](https://developer.wordpress.org/reference/classes/wpdb/)      No               Yes
  ------------------------------------------------------------------------------------------------------------------------------------

[**[Method 1:
register_uninstall_hook]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/uninstall-methods/#method-1-register_uninstall_hook)

To set up an uninstall hook, use
the [[register_uninstall_hook()]{.underline}](https://developer.wordpress.org/reference/functions/register_uninstall_hook/) function:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/uninstall-methods/)

register_uninstall_hook(

\_\_FILE\_\_,

\'pluginprefix_function_to_run\'

);

[**[Method 2:
uninstall.php]{.underline}**](https://developer.wordpress.org/plugins/plugin-basics/uninstall-methods/#method-2-uninstall-php)

To use this method you need to create an uninstall.php file inside the
root folder of your plugin. This magic file is run automatically when
the users deletes the plugin.

For example: /plugin-name/uninstall.php

Always check for the constant WP_UNINSTALL_PLUGIN in uninstall.phpbefore
doing anything. This protects against direct access.

The constant will be defined by WordPress during
the uninstall.phpinvocation.

The constant is **NOT** defined when uninstall is performed
by [[register_uninstall_hook()]{.underline}](https://developer.wordpress.org/reference/functions/register_uninstall_hook/) .

Here is an example deleting option entries and dropping a database
table:

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/uninstall-methods/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/uninstall-methods/)

// if uninstall.php is not called by WordPress, die

**if** ( ! defined( \'WP_UNINSTALL_PLUGIN\' ) ) {

**die**;

}

\$option_name = \'wporg_option\';

delete_option( \$option_name );

// for site options in Multisite

delete_site_option( \$option_name );

// drop a custom database table

**global** \$wpdb;

\$wpdb-\>query( \"DROP TABLE IF EXISTS {\$wpdb-\>prefix}mytable\" );

In Multisite, looping through all blogs to delete options can be very
resource intensive.

**First published**

September 16, 2014

**Last updated**

February 20, 2024

[PreviousIncluding a Software LicensePrevious: Including a Software
License](https://developer.wordpress.org/plugins/plugin-basics/including-a-software-license/)

[NextPlugin SecurityNext: Plugin
Security](https://developer.wordpress.org/plugins/security/)

**Using Settings API**

In this article

-   [Adding
    Settings](https://developer.wordpress.org/plugins/settings/using-settings-api/#adding-settings)

    -   [Add a
        Setting](https://developer.wordpress.org/plugins/settings/using-settings-api/#add-a-setting)

    -   [Add a
        Section](https://developer.wordpress.org/plugins/settings/using-settings-api/#add-a-section)

    -   [Add a
        Field](https://developer.wordpress.org/plugins/settings/using-settings-api/#add-a-field)

    -   [Example](https://developer.wordpress.org/plugins/settings/using-settings-api/#example)

-   [Getting
    Settings](https://developer.wordpress.org/plugins/settings/using-settings-api/#getting-settings)

    -   [Example](https://developer.wordpress.org/plugins/settings/using-settings-api/#example-2)

[**[Adding
Settings]{.underline}**](https://developer.wordpress.org/plugins/settings/using-settings-api/#adding-settings)

You must define a new setting
using [[register_setting()]{.underline}](https://developer.wordpress.org/reference/functions/register_setting/) ,
it will create an entry in the {\$wpdb-\>prefix}\_options table.

You can add new sections on existing pages
using [[add_settings_section()]{.underline}](https://developer.wordpress.org/reference/functions/add_settings_section/) .

You can add new fields to existing sections
using [[add_settings_field()]{.underline}](https://developer.wordpress.org/reference/functions/add_settings_field/) .

[[register_setting()]{.underline}](https://developer.wordpress.org/reference/functions/register_setting/) as
well as the mentioned add_settings\_\*() functions should all be added
to the admin_init action hook.

[**[Add a
Setting]{.underline}**](https://developer.wordpress.org/plugins/settings/using-settings-api/#add-a-setting)

[Copy](https://developer.wordpress.org/plugins/settings/using-settings-api/)

register_setting( **string** \$option_group, **string** \$option_name,
**array** \$args = \[\]);

Please refer to the Function Reference
about [[register_setting()]{.underline}](https://developer.wordpress.org/reference/functions/register_setting/) for
full explanation about the used parameters.

[**[Add a
Section]{.underline}**](https://developer.wordpress.org/plugins/settings/using-settings-api/#add-a-section)

[Copy](https://developer.wordpress.org/plugins/settings/using-settings-api/)

add_settings_section( **string** \$id, **string** \$title, **callable**
\$callback, **string** \$page, **array** \$args = \[\]);

Sections are the groups of settings you see on WordPress settings pages
with a shared heading. In your plugin you can add new sections to
existing settings pages rather than creating a whole new page. This
makes your plugin simpler to maintain and creates fewer new pages for
users to learn.

Please refer to the Function Reference
about [[add_settings_section()]{.underline}](https://developer.wordpress.org/reference/functions/add_settings_section/) for
full explanation about the used parameters.

[**[Add a
Field]{.underline}**](https://developer.wordpress.org/plugins/settings/using-settings-api/#add-a-field)

[Copy](https://developer.wordpress.org/plugins/settings/using-settings-api/)

add_settings_field(

**string** \$id,

**string** \$title,

**callable** \$callback,

**string** \$page,

**string** \$section = \'default\',

**array** \$args = \[\]

);

Please refer to the Function Reference
about [[add_settings_field()]{.underline}](https://developer.wordpress.org/reference/functions/add_settings_field/) for
full explanation about the used parameters.

[**[Example]{.underline}**](https://developer.wordpress.org/plugins/settings/using-settings-api/#example)

[Expand
code](https://developer.wordpress.org/plugins/settings/using-settings-api/)

[Copy](https://developer.wordpress.org/plugins/settings/using-settings-api/)

**function** wporg_settings_init() {

// register a new setting for \"reading\" page

register_setting(\'reading\', \'wporg_setting_name\');

// register a new section in the \"reading\" page

add_settings_section(

\'wporg_settings_section\',

\'WPOrg Settings Section\', \'wporg_settings_section_callback\',

\'reading\'

);

// register a new field in the \"wporg_settings_section\" section,
inside the \"reading\" page

add_settings_field(

\'wporg_settings_field\',

\'WPOrg Setting\', \'wporg_settings_field_callback\',

\'reading\',

\'wporg_settings_section\'

);

}

/\*\*

\* register wporg_settings_init to the admin_init action hook

\*/

add_action(\'admin_init\', \'wporg_settings_init\');

/\*\*

\* callback functions

\*/

// section content cb

**function** wporg_settings_section_callback() {

**echo** \'\<p\>WPOrg Section Introduction.\</p\>\';

}

// field content cb

**function** wporg_settings_field_callback() {

// get the value of the setting we\'ve registered with
register_setting()

\$setting = get_option(\'wporg_setting_name\');

// output the field

**?\>**

\<input type=\"text\" name=\"wporg_setting_name\" value=\"**\<?php**
**echo** **isset**( \$setting ) ? esc_attr( \$setting ) : \'\';
**?\>**\"\>

**\<?php**

}

[**[Getting
Settings]{.underline}**](https://developer.wordpress.org/plugins/settings/using-settings-api/#getting-settings)

[Copy](https://developer.wordpress.org/plugins/settings/using-settings-api/)

get_option(

**string** \$option,

**mixed** \$default = false

);

Getting settings is accomplished with
the [[get_option()]{.underline}](https://developer.wordpress.org/reference/functions/get_option/) function.\
The function accepts two parameters: the name of the option and an
optional default value for that option.

[**[Example]{.underline}**](https://developer.wordpress.org/plugins/settings/using-settings-api/#example-2)

[Copy](https://developer.wordpress.org/plugins/settings/using-settings-api/)

// Get the value of the setting we\'ve registered with
register_setting()

\$setting = get_option(\'wporg_setting_name\');

**Using Settings API**

In this article

-   [Adding
    Settings](https://developer.wordpress.org/plugins/settings/using-settings-api/#adding-settings)

    -   [Add a
        Setting](https://developer.wordpress.org/plugins/settings/using-settings-api/#add-a-setting)

    -   [Add a
        Section](https://developer.wordpress.org/plugins/settings/using-settings-api/#add-a-section)

    -   [Add a
        Field](https://developer.wordpress.org/plugins/settings/using-settings-api/#add-a-field)

    -   [Example](https://developer.wordpress.org/plugins/settings/using-settings-api/#example)

-   [Getting
    Settings](https://developer.wordpress.org/plugins/settings/using-settings-api/#getting-settings)

    -   [Example](https://developer.wordpress.org/plugins/settings/using-settings-api/#example-2)

[**Adding
Settings**](https://developer.wordpress.org/plugins/settings/using-settings-api/#adding-settings)

You must define a new setting
using [register_setting()](https://developer.wordpress.org/reference/functions/register_setting/) ,
it will create an entry in the {\$wpdb-\>prefix}\_options table.

You can add new sections on existing pages
using [add_settings_section()](https://developer.wordpress.org/reference/functions/add_settings_section/) .

You can add new fields to existing sections
using [add_settings_field()](https://developer.wordpress.org/reference/functions/add_settings_field/) .

[register_setting()](https://developer.wordpress.org/reference/functions/register_setting/) as
well as the mentioned add_settings\_\*() functions should all be added
to the admin_init action hook.

[**Add a
Setting**](https://developer.wordpress.org/plugins/settings/using-settings-api/#add-a-setting)

[Copy](https://developer.wordpress.org/plugins/settings/using-settings-api/)

register_setting( **string** \$option_group, **string** \$option_name,
**array** \$args = \[\]);

Please refer to the Function Reference
about [register_setting()](https://developer.wordpress.org/reference/functions/register_setting/) for
full explanation about the used parameters.

[**Add a
Section**](https://developer.wordpress.org/plugins/settings/using-settings-api/#add-a-section)

[Copy](https://developer.wordpress.org/plugins/settings/using-settings-api/)

add_settings_section( **string** \$id, **string** \$title, **callable**
\$callback, **string** \$page, **array** \$args = \[\]);

Sections are the groups of settings you see on WordPress settings pages
with a shared heading. In your plugin you can add new sections to
existing settings pages rather than creating a whole new page. This
makes your plugin simpler to maintain and creates fewer new pages for
users to learn.

Please refer to the Function Reference
about [add_settings_section()](https://developer.wordpress.org/reference/functions/add_settings_section/) for
full explanation about the used parameters.

[**Add a
Field**](https://developer.wordpress.org/plugins/settings/using-settings-api/#add-a-field)

[Copy](https://developer.wordpress.org/plugins/settings/using-settings-api/)

add_settings_field(

**string** \$id,

**string** \$title,

**callable** \$callback,

**string** \$page,

**string** \$section = \'default\',

**array** \$args = \[\]

);

Please refer to the Function Reference
about [add_settings_field()](https://developer.wordpress.org/reference/functions/add_settings_field/) for
full explanation about the used parameters.

[**Example**](https://developer.wordpress.org/plugins/settings/using-settings-api/#example)

[Expand
code](https://developer.wordpress.org/plugins/settings/using-settings-api/)

[Copy](https://developer.wordpress.org/plugins/settings/using-settings-api/)

**function** wporg_settings_init() {

// register a new setting for \"reading\" page

register_setting(\'reading\', \'wporg_setting_name\');

// register a new section in the \"reading\" page

add_settings_section(

\'wporg_settings_section\',

\'WPOrg Settings Section\', \'wporg_settings_section_callback\',

\'reading\'

);

// register a new field in the \"wporg_settings_section\" section,
inside the \"reading\" page

add_settings_field(

\'wporg_settings_field\',

\'WPOrg Setting\', \'wporg_settings_field_callback\',

\'reading\',

\'wporg_settings_section\'

);

}

/\*\*

\* register wporg_settings_init to the admin_init action hook

\*/

add_action(\'admin_init\', \'wporg_settings_init\');

/\*\*

\* callback functions

\*/

// section content cb

**function** wporg_settings_section_callback() {

**echo** \'\<p\>WPOrg Section Introduction.\</p\>\';

}

// field content cb

**function** wporg_settings_field_callback() {

// get the value of the setting we\'ve registered with
register_setting()

\$setting = get_option(\'wporg_setting_name\');

// output the field

**?\>**

\<input type=\"text\" name=\"wporg_setting_name\" value=\"**\<?php**
**echo** **isset**( \$setting ) ? esc_attr( \$setting ) : \'\';
**?\>**\"\>

**\<?php**

}

[**Getting
Settings**](https://developer.wordpress.org/plugins/settings/using-settings-api/#getting-settings)

[Copy](https://developer.wordpress.org/plugins/settings/using-settings-api/)

get_option(

**string** \$option,

**mixed** \$default = false

);

Getting settings is accomplished with
the [get_option()](https://developer.wordpress.org/reference/functions/get_option/) function.\
The function accepts two parameters: the name of the option and an
optional default value for that option.

[**Example**](https://developer.wordpress.org/plugins/settings/using-settings-api/#example-2)

[Copy](https://developer.wordpress.org/plugins/settings/using-settings-api/)

// Get the value of the setting we\'ve registered with
register_setting()

\$setting = get_option(\'wporg_setting_name\');

[[Skip to
content]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#wp--skip-link--target)

Managing Post Metadata

-   [Developer Blog](https://developer.wordpress.org/news/)

-   [Code Reference](https://developer.wordpress.org/reference/)

-   [WP-CLI Commands](https://developer.wordpress.org/cli/commands/)

[[Home](https://developer.wordpress.org)[Plugin
Handbook](https://developer.wordpress.org/plugins/)[Metadata](https://developer.wordpress.org/plugins/metadata/)]{.underline}Managing
Post Metadata

Top of Form

Search

Bottom of Form

**Managing Post Metadata**

In this article

-   [[Adding
    Metadata]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#adding-metadata)

-   [[Updating
    Metadata]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#updating-metadata)

-   [[Deleting
    Metadata]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#deleting-metadata)

-   [[Character
    Escaping]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#character-escaping)

    -   [[Workaround]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#workaround)

-   [[Hidden Custom
    Fields]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#hidden-custom-fields)

    -   [[Hidden
        Arrays]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#hidden-arrays)

[↑ [Back to
top]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#wp--skip-link--target)

[**[Adding
Metadata]{.underline}**](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#adding-metadata)

Adding metadata can be done quite easily
with [[add_post_meta()]{.underline}](https://developer.wordpress.org/reference/functions/add_post_meta/) .
The function accepts a post_id, a meta_key, a meta_value, and
a uniqueflag.

The meta_key is how your plugin will reference the meta value elsewhere
in your code. Something like mycrazymetakeyname would work, however a
prefix related to your plugin or theme followed by a description of the
key would be more useful. wporg_featured_menu might be a good one. It
should be noted that the same meta_key may be used multiple times to
store variations of the metadata (see the unique flag below).

The meta_value can be a string, integer, or an array. If it's an array,
it will be automatically serialized before being stored in the database.

The unique flag allows you to declare whether this key should be unique.
A **non** unique key is something a post can have multiple variations
of, like price.\
If you only ever want **one** price for a post, you should flag
it unique and the meta_key will have one value only.

[**[Updating
Metadata]{.underline}**](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#updating-metadata)

If a key already exists and you want to update it,
use [[update_post_meta()]{.underline}](https://developer.wordpress.org/reference/functions/update_post_meta/) .
If you use this function and the key does **NOT** exist, then it will
create it, as if you'd
used [[add_post_meta()]{.underline}](https://developer.wordpress.org/reference/functions/add_post_meta/) .

Similar
to [[add_post_meta()]{.underline}](https://developer.wordpress.org/reference/functions/add_post_meta/) ,
the function accepts a post_id, a meta_key, and meta_value. It also
accepts an optional prev_value -- which, if specified, will cause the
function to only update existing metadata entries with this value. If it
isn't provided, the function defaults to updating all entries.

[**[Deleting
Metadata]{.underline}**](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#deleting-metadata)

[[delete_post_meta()]{.underline}](https://developer.wordpress.org/reference/functions/delete_post_meta/) takes
a post_id, a meta_key, and optionally meta_value. It does exactly what
the name suggests.

[**[Character
Escaping]{.underline}**](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#character-escaping)

Post meta values are passed through
the [[stripslashes()]{.underline}](http://php.net/manual/en/function.stripslashes.php) function
upon being stored, so you will need to be careful when passing in values
(such as JSON) that might include escaped characters.

Consider the JSON value {\"key\":\"value with \\\"escaped quotes\\\"\"}:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/)

\$escaped_json = \'{\"key\":\"value with \\\"escaped quotes\\\"\"}\';

update_post_meta( \$id, \'escaped_json\', \$escaped_json );

\$broken = get_post_meta( \$id, \'escaped_json\', true );

/\*

\$broken, after stripslashes(), ends up unparsable:

{\"key\":\"value with \"escaped quotes\"\"}

\*/

[**[Workaround]{.underline}**](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#workaround)

By adding one more level of escaping using the
function [[wp_slash()]{.underline}](https://developer.wordpress.org/reference/functions/wp_slash/)(introduced
in WP 3.6), you can compensate for the call
to [[stripslashes()]{.underline}](http://php.net/manual/en/function.stripslashes.php):

[[Copy]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/)

\$escaped_json = \'{\"key\":\"value with \\\"escaped quotes\\\"\"}\';

update_post_meta( \$id, \'double_escaped_json\', wp_slash(
\$escaped_json ) );

\$fixed = get_post_meta( \$id, \'double_escaped_json\', true );

/\*

\$fixed, after stripslashes(), ends up as desired:

{\"key\":\"value with \\\"escaped quotes\\\"\"}

\*/

[**[Hidden Custom
Fields]{.underline}**](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#hidden-custom-fields)

If you are a plugin or theme developer and you are planning to use
custom fields to store parameters, it is important to note that
WordPress will not show custom fields which have meta_key starting with
an "\_" (underscore) in the custom fields list on the post edit screen
or when using
the [[the_meta()]{.underline}](https://developer.wordpress.org/reference/functions/the_meta/)template
function.

This can be useful in order to show these custom fields in an unusual
way by using
the [[add_meta_box()]{.underline}](https://developer.wordpress.org/reference/functions/add_meta_box/) function.

The example below will add a unique custom field with the meta_key name
'\_color' and the meta_value of 'red' but this custom field will not
display in the post edit screen:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/)

add_post_meta( 68, \'\_color\', \'red\', true );

[**[Hidden
Arrays]{.underline}**](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#hidden-arrays)

In addition, if the meta_value is an array, it will not be displayed on
the page edit screen, even if you don't prefix the meta_key name with an
underscore.

**First published**

September 24, 2014

**Last updated**

November 17, 2022

[PreviousMetadataPrevious:
Metadata](https://developer.wordpress.org/plugins/metadata/)

[NextCustom Meta BoxesNext: Custom Meta
Boxes](https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/)

[[Skip to
content]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#wp--skip-link--target)

Managing Post Metadata

-   [Developer Blog](https://developer.wordpress.org/news/)

-   [Code Reference](https://developer.wordpress.org/reference/)

-   [WP-CLI Commands](https://developer.wordpress.org/cli/commands/)

[[Home](https://developer.wordpress.org)[Plugin
Handbook](https://developer.wordpress.org/plugins/)[Metadata](https://developer.wordpress.org/plugins/metadata/)]{.underline}Managing
Post Metadata

Top of Form

Search

Bottom of Form

**Managing Post Metadata**

In this article

-   [[Adding
    Metadata]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#adding-metadata)

-   [[Updating
    Metadata]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#updating-metadata)

-   [[Deleting
    Metadata]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#deleting-metadata)

-   [[Character
    Escaping]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#character-escaping)

    -   [[Workaround]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#workaround)

-   [[Hidden Custom
    Fields]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#hidden-custom-fields)

    -   [[Hidden
        Arrays]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#hidden-arrays)

[↑ [Back to
top]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#wp--skip-link--target)

[**[Adding
Metadata]{.underline}**](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#adding-metadata)

Adding metadata can be done quite easily
with [[add_post_meta()]{.underline}](https://developer.wordpress.org/reference/functions/add_post_meta/) .
The function accepts a post_id, a meta_key, a meta_value, and
a uniqueflag.

The meta_key is how your plugin will reference the meta value elsewhere
in your code. Something like mycrazymetakeyname would work, however a
prefix related to your plugin or theme followed by a description of the
key would be more useful. wporg_featured_menu might be a good one. It
should be noted that the same meta_key may be used multiple times to
store variations of the metadata (see the unique flag below).

The meta_value can be a string, integer, or an array. If it's an array,
it will be automatically serialized before being stored in the database.

The unique flag allows you to declare whether this key should be unique.
A **non** unique key is something a post can have multiple variations
of, like price.\
If you only ever want **one** price for a post, you should flag
it unique and the meta_key will have one value only.

[**[Updating
Metadata]{.underline}**](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#updating-metadata)

If a key already exists and you want to update it,
use [[update_post_meta()]{.underline}](https://developer.wordpress.org/reference/functions/update_post_meta/) .
If you use this function and the key does **NOT** exist, then it will
create it, as if you'd
used [[add_post_meta()]{.underline}](https://developer.wordpress.org/reference/functions/add_post_meta/) .

Similar
to [[add_post_meta()]{.underline}](https://developer.wordpress.org/reference/functions/add_post_meta/) ,
the function accepts a post_id, a meta_key, and meta_value. It also
accepts an optional prev_value -- which, if specified, will cause the
function to only update existing metadata entries with this value. If it
isn't provided, the function defaults to updating all entries.

[**[Deleting
Metadata]{.underline}**](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#deleting-metadata)

[[delete_post_meta()]{.underline}](https://developer.wordpress.org/reference/functions/delete_post_meta/) takes
a post_id, a meta_key, and optionally meta_value. It does exactly what
the name suggests.

[**[Character
Escaping]{.underline}**](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#character-escaping)

Post meta values are passed through
the [[stripslashes()]{.underline}](http://php.net/manual/en/function.stripslashes.php) function
upon being stored, so you will need to be careful when passing in values
(such as JSON) that might include escaped characters.

Consider the JSON value {\"key\":\"value with \\\"escaped quotes\\\"\"}:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/)

\$escaped_json = \'{\"key\":\"value with \\\"escaped quotes\\\"\"}\';

update_post_meta( \$id, \'escaped_json\', \$escaped_json );

\$broken = get_post_meta( \$id, \'escaped_json\', true );

/\*

\$broken, after stripslashes(), ends up unparsable:

{\"key\":\"value with \"escaped quotes\"\"}

\*/

[**[Workaround]{.underline}**](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#workaround)

By adding one more level of escaping using the
function [[wp_slash()]{.underline}](https://developer.wordpress.org/reference/functions/wp_slash/)(introduced
in WP 3.6), you can compensate for the call
to [[stripslashes()]{.underline}](http://php.net/manual/en/function.stripslashes.php):

[[Copy]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/)

\$escaped_json = \'{\"key\":\"value with \\\"escaped quotes\\\"\"}\';

update_post_meta( \$id, \'double_escaped_json\', wp_slash(
\$escaped_json ) );

\$fixed = get_post_meta( \$id, \'double_escaped_json\', true );

/\*

\$fixed, after stripslashes(), ends up as desired:

{\"key\":\"value with \\\"escaped quotes\\\"\"}

\*/

[**[Hidden Custom
Fields]{.underline}**](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#hidden-custom-fields)

If you are a plugin or theme developer and you are planning to use
custom fields to store parameters, it is important to note that
WordPress will not show custom fields which have meta_key starting with
an "\_" (underscore) in the custom fields list on the post edit screen
or when using
the [[the_meta()]{.underline}](https://developer.wordpress.org/reference/functions/the_meta/)template
function.

This can be useful in order to show these custom fields in an unusual
way by using
the [[add_meta_box()]{.underline}](https://developer.wordpress.org/reference/functions/add_meta_box/) function.

The example below will add a unique custom field with the meta_key name
'\_color' and the meta_value of 'red' but this custom field will not
display in the post edit screen:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/)

add_post_meta( 68, \'\_color\', \'red\', true );

[**[Hidden
Arrays]{.underline}**](https://developer.wordpress.org/plugins/metadata/managing-post-metadata/#hidden-arrays)

In addition, if the meta_value is an array, it will not be displayed on
the page edit screen, even if you don't prefix the meta_key name with an
underscore.

**First published**

September 24, 2014

**Last updated**

November 17, 2022

[PreviousMetadataPrevious:
Metadata](https://developer.wordpress.org/plugins/metadata/)

[NextCustom Meta BoxesNext: Custom Meta
Boxes](https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/)

**Rendering Post Metadata**

Here is a non exhaustive list of functions and [[template
tags]{.underline}](https://developer.wordpress.org/themes/basics/template-tags/) used
to get and render Post Metadata:

-   [[the_meta()]{.underline} ](https://developer.wordpress.org/reference/functions/the_meta/)--
    Template tag that automatically lists all Custom Fields of a post

-   [[get_post_custom()]{.underline}](https://developer.wordpress.org/reference/functions/get_post_custom/) and [[get_post_meta()]{.underline}](https://developer.wordpress.org/reference/functions/get_post_meta/) --
    Retrieves one or all metadata of a post.

-   [[get_post_custom_values()]{.underline}](https://developer.wordpress.org/reference/functions/get_post_custom_values/) --
    Retrieves values for a custom post field.

[[Skip to
content]{.underline}](https://developer.wordpress.org/plugins/post-types/registering-custom-post-types/#wp--skip-link--target)

Registering Custom Post Types

-   [Developer Blog](https://developer.wordpress.org/news/)

-   [Code Reference](https://developer.wordpress.org/reference/)

-   [WP-CLI Commands](https://developer.wordpress.org/cli/commands/)

[[Home](https://developer.wordpress.org)[Plugin
Handbook](https://developer.wordpress.org/plugins/)[Custom Post
Types](https://developer.wordpress.org/plugins/post-types/)]{.underline}Registering
Custom Post Types

Top of Form

Search

Bottom of Form

**Registering Custom Post Types**

In this article

-   [[Naming Best
    Practices]{.underline}](https://developer.wordpress.org/plugins/post-types/registering-custom-post-types/#naming-best-practices)

-   [[URLs]{.underline}](https://developer.wordpress.org/plugins/post-types/registering-custom-post-types/#urls)

    -   [[A Custom Slug for a Custom Post
        Type]{.underline}](https://developer.wordpress.org/plugins/post-types/registering-custom-post-types/#a-custom-slug-for-a-custom-post-type)

[↑ [Back to
top]{.underline}](https://developer.wordpress.org/plugins/post-types/registering-custom-post-types/#wp--skip-link--target)

WordPress comes with five default post
types: post, page, attachment, revision, and menu.

While developing your plugin, you may need to create your own specific
content type: for example, products for an e-commerce website,
assignments for an e-learning website, or movies for a review website.

Using Custom Post Types, you can register your own post type. Once a
custom post type is registered, it gets a new top-level administrative
screen that can be used to manage and create posts of that type.

To register a new post type, you use
the [[register_post_type()]{.underline}](https://developer.wordpress.org/reference/functions/register_post_type/) function.

We recommend that you put custom post types in a plugin rather than a
theme. This ensures that user content remains portable even if the theme
is changed.

The following minimal example registers a new post type, Products, which
is identified in the database as wporg_product.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/post-types/registering-custom-post-types/)

**function** wporg_custom_post_type() {

register_post_type(\'wporg_product\',

**array**(

\'labels\' =\> **array**(

\'name\' =\> \_\_(\'Products\', \'textdomain\'),

\'singular_name\' =\> \_\_(\'Product\', \'textdomain\'),

),

\'public\' =\> true,

\'has_archive\' =\> true,

)

);

}

add_action(\'init\', \'wporg_custom_post_type\');

Please visit the reference page
for [[register_post_type()]{.underline}](https://developer.wordpress.org/reference/functions/register_post_type/) for
the description of arguments.

You must call register_post_type() before
the [[admin_init]{.underline}](https://developer.wordpress.org/reference/hooks/admin_init/) hook
and after
the [[after_setup_theme]{.underline}](https://developer.wordpress.org/reference/hooks/after_setup_theme/) hook.
A good hook to use is
the [[init]{.underline}](https://developer.wordpress.org/reference/hooks/init/) action
hook.

[**[Naming Best
Practices]{.underline}**](https://developer.wordpress.org/plugins/post-types/registering-custom-post-types/#naming-best-practices)

It is important that you prefix your post type functions and identifiers
with a short prefix that corresponds to your plugin, theme, or website.

**Make sure your custom post type identifier does not exceed 20
characters**as the post_type column in the database is currently a
VARCHAR field of that length.

**To ensure forward compatibility**, do not use **wp\_** as your
identifier --- it is being used by WordPress core.

If your identifier is too generic (for example: "product"), it may
conflict with other plugins or themes that have chosen to use that same
identifier.

**Solving duplicate post type identifiers is not possible without
disabling one of the conflicting post types.**

[**[URLs]{.underline}**](https://developer.wordpress.org/plugins/post-types/registering-custom-post-types/#urls)

A custom post type gets its own slug within the site URL structure.

A post of type wporg_product will use the following URL structure by
default: http://example.com/wporg_product/%product_name%.

wporg_product is the slug of your custom post type and %product_name%is
the slug of your particular product.

The final permalink would
be: http://example.com/wporg_product/wporg-is-awesome.

You can see the permalink on the edit screen for your custom post type,
just like with default post types.

[**[A Custom Slug for a Custom Post
Type]{.underline}**](https://developer.wordpress.org/plugins/post-types/registering-custom-post-types/#a-custom-slug-for-a-custom-post-type)

To set a custom slug for the slug of your custom post type all you need
to do is add a key =\> value pair to the rewrite key in
the register_post_type() arguments array.

Example:

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/post-types/registering-custom-post-types/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/post-types/registering-custom-post-types/)

**function** wporg_custom_post_type() {

register_post_type(\'wporg_product\',

**array**(

\'labels\' =\> **array**(

\'name\' =\> \_\_( \'Products\', \'textdomain\' ),

\'singular_name\' =\> \_\_( \'Product\', \'textdomain\' ),

),

\'public\' =\> true,

\'has_archive\' =\> true,

\'rewrite\' =\> **array**( \'slug\' =\> \'products\' ), // my custom
slug

)

);

}

add_action(\'init\', \'wporg_custom_post_type\');

The above will result in the following URL
structure: http://example.com/products/%product_name%

Using a generic slug like products can potentially conflict with other
plugins or themes, so try to use one that is more specific to your
content.

Unlike the custom post type identifiers, the duplicate slug problem can
be solved easily by changing the slug for one of the conflicting post
types.

If the plugin author included an apply_filters() call on the arguments,
this can be done programmatically by overriding the arguments submitted
via the register_post_type() function.

**First published**

September 24, 2014

**Last updated**

November 17, 2022

[PreviousCustom Post TypesPrevious: Custom Post
Types](https://developer.wordpress.org/plugins/post-types/)

[NextWorking with Custom Post TypesNext: Working with Custom Post
Types](https://developer.wordpress.org/plugins/post-types/working-with-custom-post-types/)

Working with Custom Post Types

-   [Developer Blog](https://developer.wordpress.org/news/)

-   [Code Reference](https://developer.wordpress.org/reference/)

-   [WP-CLI Commands](https://developer.wordpress.org/cli/commands/)

[[Home](https://developer.wordpress.org)[Plugin
Handbook](https://developer.wordpress.org/plugins/)[Custom Post
Types](https://developer.wordpress.org/plugins/post-types/)]{.underline}Working
with Custom Post Types

Top of Form

Search

Bottom of Form

**Working with Custom Post Types**

In this article

-   [[Custom Post Type
    Templates]{.underline}](https://developer.wordpress.org/plugins/post-types/working-with-custom-post-types/#custom-post-type-templates)

-   [[Querying by Post
    Type]{.underline}](https://developer.wordpress.org/plugins/post-types/working-with-custom-post-types/#querying-by-post-type)

-   [[Altering the Main
    Query]{.underline}](https://developer.wordpress.org/plugins/post-types/working-with-custom-post-types/#altering-the-main-query)

[↑ [Back to
top]{.underline}](https://developer.wordpress.org/plugins/post-types/working-with-custom-post-types/#wp--skip-link--target)

[**[Custom Post Type
Templates]{.underline}**](https://developer.wordpress.org/plugins/post-types/working-with-custom-post-types/#custom-post-type-templates)

You can create
custom [[templates]{.underline}](https://make.wordpress.org/docs/theme-developer-handbook/theme-basics/theme-files/) for
your custom post types. In the same way posts and their archives can be
displayed using single.php and archive.php, you can create the
templates:

-   single-{post_type}.php -- for single posts of a custom post type

-   archive-{post_type}.php -- for the archive

Where {post_type} is the post type identifier, used as
the \$post_typeargument of the register_post_type() function.

Building upon what we've learned previously, you could
create single-wporg_product.php and archive-wporg_product.phptemplate
files for single product posts and the archive.

Alternatively, you can use
the [[is_post_type_archive()]{.underline}](https://developer.wordpress.org/reference/functions/is_post_type_archive/) function
in any template file to check if the query shows an archive page of a
given post type, and
the [[post_type_archive_title()]{.underline}](https://developer.wordpress.org/reference/functions/post_type_archive_title/)  function
to display the post type title.

[**[Querying by Post
Type]{.underline}**](https://developer.wordpress.org/plugins/post-types/working-with-custom-post-types/#querying-by-post-type)

You can query posts of a specific type by passing the post_type key in
the arguments array of the WP_Query class constructor.

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/post-types/working-with-custom-post-types/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/post-types/working-with-custom-post-types/)

**\<?php**

\$args = **array**(

\'post_type\' =\> \'product\',

\'posts_per_page\' =\> 10,

);

\$loop = **new** WP_Query(\$args);

**while** ( \$loop-\>have_posts() ) {

\$loop-\>the_post();

**?\>**

\<div class=\"entry-content\"\>

**\<?php** the_title(); **?\>**

**\<?php** the_content(); **?\>**

\</div\>

**\<?php**

}

This loops through the latest ten product posts and displays the title
and content of them one by one.

[**[Altering the Main
Query]{.underline}**](https://developer.wordpress.org/plugins/post-types/working-with-custom-post-types/#altering-the-main-query)

Registering a custom post type does not mean it gets added to the main
query automatically.

If you want your custom post type posts to show up on standard archives
or include them on your home page mixed up with other post types, use
the [[pre_get_posts]{.underline}](https://developer.wordpress.org/reference/hooks/pre_get_posts/) action
hook.

The next example will show posts from post, page and movie post types on
the home page:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/post-types/working-with-custom-post-types/)

**function** wporg_add_custom_post_types(\$query) {

**if** ( is_home() && \$query-\>is_main_query() ) {

\$query-\>set( \'post_type\', **array**( \'post\', \'page\', \'movie\' )
);

}

**return** \$query;

}

add_action(\'pre_get_posts\', \'wporg_add_custom_post_types\');

**First published**

September 24, 2014

**Last updated**

November 17, 2022

[PreviousRegistering Custom Post TypesPrevious: Registering Custom Post
Types](https://developer.wordpress.org/plugins/post-types/registering-custom-post-types/)

**Taxonomies**

A **Taxonomy** is a fancy word for the classification/grouping of
things. Taxonomies can be hierarchical (with parents/children) or flat.

WordPress stores the Taxonomies in the term_taxonomy database table
allowing developers to register Custom Taxonomies along the ones that
already exist.

Taxonomies have **Terms** which serve as the topic by which you
classify/group things. They are stored inside the terms table.

For example: a Taxonomy named "Art" can have multiple Terms, such as
"Modern" and "18th Century".

This chapter will show you how to register Custom Taxonomies, how to
retrieve their content from the database, and how to render them to the
public.

[[Skip to
content]{.underline}](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/#wp--skip-link--target)

[[WordPress Developer
Resources]{.underline}](https://developer.wordpress.org)

-   [Developer Blog](https://developer.wordpress.org/news/)

-   [Code Reference](https://developer.wordpress.org/reference/)

-   [WP-CLI Commands](https://developer.wordpress.org/cli/commands/)

[[Home](https://developer.wordpress.org)[Plugin
Handbook](https://developer.wordpress.org/plugins/)[Taxonomies](https://developer.wordpress.org/plugins/taxonomies/)]{.underline}Working
with Custom Taxonomies

Top of Form

Search

Bottom of Form

**Working with Custom Taxonomies**

In this article

-   [[Introduction to
    Taxonomies]{.underline}](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/#introduction-to-taxonomies)

-   [[Custom
    Taxonomies]{.underline}](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/#custom-taxonomies)

-   [[Why Use Custom
    Taxonomies?]{.underline}](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/#why-use-custom-taxonomies)

-   [[Example: Courses
    Taxonomy]{.underline}](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/#example-courses-taxonomy)

    -   [[Step 1: Before You
        Begin]{.underline}](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/#step-1-before-you-begin)

    -   [[Step 2: Creating a New
        Plugin]{.underline}](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/#step-2-creating-a-new-plugin)

    -   [[Step 3: Review the
        Result]{.underline}](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/#step-3-review-the-result)

    -   [[Code
        Breakdown]{.underline}](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/#code-breakdown)

    -   [[Summary]{.underline}](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/#summary)

-   [[Using Your
    Taxonomy]{.underline}](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/#using-your-taxonomy)

[**[Introduction to
Taxonomies]{.underline}**](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/#introduction-to-taxonomies)

To understand what Taxonomies are and what they do please read
the [[Taxonomy]{.underline}](https://developer.wordpress.org/plugins/taxonomies/) introduction.

[**[Custom
Taxonomies]{.underline}**](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/#custom-taxonomies)

As classification systems go, "Categories" and "Tags" aren't very
structured, so it may be beneficial for a developer to create their own.

WordPress allows developers to create **Custom Taxonomies**. Custom
Taxonomies are useful when one wants to create distinct naming systems
and make them accessible behind the scenes in a predictable way.

[**[Why Use Custom
Taxonomies?]{.underline}**](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/#why-use-custom-taxonomies)

You might ask, "Why bother creating a Custom Taxonomy, when I can
organize by Categories and Tags?"

Well... let's use an example. Suppose we have a client that is a chef
who wants you to create a website where she'll feature original recipes.

One way to organize the website might be to create a Custom Post Type
called "Recipes" to store her recipes. Then create a Taxonomy "Courses"
to separate "Appetizers" from "Desserts", and finally a Taxonomy
"Ingredients" to separate "Chicken" from "Chocolate" dishes.

These groups *could* be defined using Categories or Tags, you could have
a "Courses" Category with Subcategories for "Appetizers" and "Desserts",
and an "Ingredients" Category with Subcategories for each ingredient.

The main advantage of using Custom Taxonomies is that you can reference
"Courses" and "Ingredients" independently of Categories and Tags. They
even get their own menus in the Administration area.

In addition, creating Custom Taxonomies allows you to build custom
interfaces which will ease the life of your client and make the process
of inserting data intuitive to their business nature.

Now imagine that these Custom Taxonomies and the interface is
implemented inside a plugin; you've just built your own Recipes plugin
that can be reused on any WordPress website.

[**[Example: Courses
Taxonomy]{.underline}**](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/#example-courses-taxonomy)

The following example will show you how to create a plugin which adds a
Custom Taxonomy "Courses" to the default post Post Type. Note that the
code to add custom taxonomies does not have to be in its own plugin; it
can be included in a theme or as part of an existing plugin if desired.

Please make sure to read the [[Plugin
Basics]{.underline}](https://developer.wordpress.org/plugin/the-basics/) chapter
before attempting to create your own plugin.

[**[Step 1: Before You
Begin]{.underline}**](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/#step-1-before-you-begin)

Go to **Posts \> Add New** page. You will notice that you only have
Categories and Tags.

![No Custom Taxonomy Meta Box
(Yet)](media/image1.png){width="12.059027777777779in"
height="8.161805555555556in"}

[**[Step 2: Creating a New
Plugin]{.underline}**](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/#step-2-creating-a-new-plugin)

Register the Taxonomy "course" for the post type "post" using
the initaction hook.

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/)

/\*

\* Plugin Name: Course Taxonomy

\* Description: A short example showing how to add a taxonomy called
Course.

\* Version: 1.0

\* Author: developer.wordpress.org

\* Author URI: https://codex.wordpress.org/User:Aternus

\*/

**function** wporg_register_taxonomy_course() {

\$labels = **array**(

\'name\' =\> \_x( \'Courses\', \'taxonomy general name\' ),

\'singular_name\' =\> \_x( \'Course\', \'taxonomy singular name\' ),

\'search_items\' =\> \_\_( \'Search Courses\' ),

\'all_items\' =\> \_\_( \'All Courses\' ),

\'parent_item\' =\> \_\_( \'Parent Course\' ),

\'parent_item_colon\' =\> \_\_( \'Parent Course:\' ),

\'edit_item\' =\> \_\_( \'Edit Course\' ),

\'update_item\' =\> \_\_( \'Update Course\' ),

\'add_new_item\' =\> \_\_( \'Add New Course\' ),

\'new_item_name\' =\> \_\_( \'New Course Name\' ),

\'menu_name\' =\> \_\_( \'Course\' ),

);

\$args = **array**(

\'hierarchical\' =\> true, // make it hierarchical (like categories)

\'labels\' =\> \$labels,

\'show_ui\' =\> true,

\'show_admin_column\' =\> true,

\'query_var\' =\> true,

\'rewrite\' =\> \[ \'slug\' =\> \'course\' \],

);

register_taxonomy( \'course\', \[ \'post\' \], \$args );

}

add_action( \'init\', \'wporg_register_taxonomy_course\' );

[**[Step 3: Review the
Result]{.underline}**](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/#step-3-review-the-result)

Activate your plugin, then go to **Posts \> Add New**. You should see a
new meta box for your "Courses" Taxonomy.

![courses_taxonomy_post_screen](media/image2.png){width="14.220833333333333in"
height="7.573611111111111in"}

[**[Code
Breakdown]{.underline}**](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/#code-breakdown)

The following discussion breaks down the code used above describing the
functions and parameters.

The function wporg_register_taxonomy_course contains all the steps
necessary for registering a Custom Taxonomy.

The \$labels array holds the labels for the Custom Taxonomy.\
These labels will be used for displaying various information about the
Taxonomy in the Administration area.

The \$args array holds the configuration options that will be used when
creating our Custom Taxonomy.

The
function [[register_taxonomy()]{.underline}](https://developer.wordpress.org/reference/functions/register_taxonomy/) creates
a new Taxonomy with the identifier course for the post Post Type using
the \$args array for configuration.

The
function [[add_action()]{.underline}](https://developer.wordpress.org/reference/functions/add_action/) ties
the wporg_register_taxonomy_coursefunction execution to the init action
hook.

**\$args**

The \$args array holds important configuration for the Custom Taxonomy,
it instructs WordPress how the Taxonomy should work.

Take a look
at [[register_taxonomy()]{.underline}](https://developer.wordpress.org/reference/functions/register_taxonomy/) function
for a full list of accepted parameters and what each of these do.

[**[Summary]{.underline}**](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/#summary)

With our Courses Taxonomy example, WordPress will automatically create
an archive page and child pages for the course Taxonomy.

The archive page will be at /course/ with child pages spawning under it
using the Term's slug (/course/%%term-slug%%/).

[**[Using Your
Taxonomy]{.underline}**](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/#using-your-taxonomy)

WordPress has **many** functions for interacting with your Custom
Taxonomy and the Terms within it.

Here are some examples:

-   the_terms: Takes a Taxonomy argument and renders the terms in a
    list.

-   wp_tag_cloud: Takes a Taxonomy argument and renders a tag cloud of
    the terms.

-   is_taxonomy: Allows you to determine if a given taxonomy exists.

**First published**

September 24, 2014

**Last updated**

November 17, 2022

[PreviousTerm Splitting (WordPress 4.2)Previous: Term Splitting
(WordPress
4.2)](https://developer.wordpress.org/plugins/taxonomies/split-terms-wp-4-2/)

[NextUsersNext: Users](https://developer.wordpress.org/plugins/users/)

**Users**

In this article

-   [[Roles and
    Capabilities]{.underline}](https://developer.wordpress.org/plugins/users/#roles-and-capabilities)

-   [[The Principle of Least
    Privileges]{.underline}](https://developer.wordpress.org/plugins/users/#the-principle-of-least-privileges)

[↑ [Back to
top]{.underline}](https://developer.wordpress.org/plugins/users/#wp--skip-link--target)

A *User* is an access account with corresponding capabilities within the
WordPress installation. Each WordPress user has, at the bare minimum, a
username, password and email address.

Once a user account is created, that user may log in using the WordPress
Admin (or programmatically) to access WordPress functions and data.
WordPress stores the Users in the users table.

[**[Roles and
Capabilities]{.underline}**](https://developer.wordpress.org/plugins/users/#roles-and-capabilities)

Users are
assigned [[roles]{.underline}](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#roles),
and each role has a set
of [[capabilities]{.underline}](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#capabilities).

You can create new roles with their own set of capabilities. Custom
capabilities can also be created and assigned to existing roles or new
roles.

In WordPress, developers can take advantage of user roles to limit the
set of actions an account can perform.

[**[The Principle of Least
Privileges]{.underline}**](https://developer.wordpress.org/plugins/users/#the-principle-of-least-privileges)

# WordPress adheres to the principal of least privileges, the practice of giving a user *only* the privileges that are essential for performing the desired work. You should follow this lead when possible by creating roles where appropriate and checking capabilities before performing sensitive tasks. **Roles and Capabilities**

In this article

-   [Roles](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#roles)

    -   [Adding
        Roles](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#adding-roles)

    -   [Removing
        Roles](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#removing-roles)

-   [Capabilities](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#capabilities)

    -   [Adding
        Capabilities](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#adding-capabilities)

    -   [Removing
        Capabilities](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#removing-capabilities)

-   [Using Roles and
    Capabilities](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#using-roles-and-capabilities)

    -   [Get
        Role](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#get-role)

    -   [User
        Can](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#user-can)

    -   [Current User
        Can](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#current-user-can)

    -   [Example](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#example)

-   [Multisite](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#multisite)

-   [Reference](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#reference)

[↑ Back to
top](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#wp--skip-link--target)

Roles and capabilities are two important aspects of WordPress that allow
you to control user privileges.

WordPress stores the Roles and their Capabilities in the options table
under the user_roles key.

[**[Roles]{.underline}**](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#roles)

A role defines a set of capabilities for a user. For example, what the
user may see and do in his dashboard.

**By default, WordPress have six roles:**

-   Super Admin

-   Administrator

-   Editor

-   Author

-   Contributor

-   Subscriber

More roles can be added and the default roles can be removed.

![A screenshot of a computer Description automatically
generated](media/image3.png){width="5.632638888888889in"
height="1.9708333333333334in"}

[**[Adding
Roles]{.underline}**](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#adding-roles)

Add new roles and assign capabilities to them
with [[add_role()]{.underline}](https://developer.wordpress.org/reference/functions/add_role/) .

[Expand
code](https://developer.wordpress.org/plugins/users/roles-and-capabilities/)

[Copy](https://developer.wordpress.org/plugins/users/roles-and-capabilities/)

**function** wporg_simple_role() {

add_role(

\'simple_role\',

\'Simple Role\',

**array**(

\'read\' =\> true,

\'edit_posts\' =\> true,

\'upload_files\' =\> true,

),

);

}

// Add the simple_role.

add_action( \'init\', \'wporg_simple_role\' );

After the first call
to [[add_role()]{.underline}](https://developer.wordpress.org/reference/functions/add_role/) ,
the Role and it's Capabilities will be stored in the database!

Sequential calls will do nothing: including altering the capabilities
list, which might not be the behavior that you're expecting.

To alter the capabilities list in bulk: remove the role
using [[remove_role()]{.underline}](https://developer.wordpress.org/reference/functions/remove_role/) and
add it again
using [[add_role()]{.underline}](https://developer.wordpress.org/reference/functions/add_role/) with
the new capabilities.

Make sure to do it only if the capabilities differ from what you're
expecting (i.e. condition this) or you'll degrade performance
considerably!

[**[Removing
Roles]{.underline}**](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#removing-roles)

Remove roles
with [[remove_role()]{.underline}](https://developer.wordpress.org/reference/functions/remove_role/) .

[Copy](https://developer.wordpress.org/plugins/users/roles-and-capabilities/)

**function** wporg_simple_role_remove() {

remove_role( \'simple_role\' );

}

// Remove the simple_role.

add_action( \'init\', \'wporg_simple_role_remove\' );

After the first call
to [[remove_role()]{.underline}](https://developer.wordpress.org/reference/functions/remove_role/) ,
the Role and it's Capabilities will be removed from the database!

Sequential calls will do nothing.

If you're removing the default roles:

-   We advise **against** removing the Administrator and Super Admin
    roles!

-   Make sure to keep the code in your plugin/theme as future WordPress
    updates may add these roles again.

-   Run update_option(\'default_role\', YOUR_NEW_DEFAULT_ROLE)\
    since you'll be deleting subscriber which is WP's default role.

[**[Capabilities]{.underline}**](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#capabilities)

Capabilities define what a **role** can and can not do: edit posts,
publish posts, etc.

Custom post types can require a certain set of Capabilities.

[**[Adding
Capabilities]{.underline}**](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#adding-capabilities)

You may define new capabilities for a role.

Use [[get_role()]{.underline}](https://developer.wordpress.org/reference/functions/get_role/) to
get the role object, then use the add_cap() method of that object to add
a new capability.

[Copy](https://developer.wordpress.org/plugins/users/roles-and-capabilities/)

**function** wporg_simple_role_caps() {

// Gets the simple_role role object.

\$role = get_role( \'simple_role\' );

// Add a new capability.

\$role-\>add_cap( \'edit_others_posts\', true );

}

// Add simple_role capabilities, priority must be after the initial role
definition.

add_action( \'init\', \'wporg_simple_role_caps\', 11 );

It's possible to add custom capabilities to any role.

Under the default WordPress admin, they would have no effect, but they
can be used for custom admin screen and front-end areas.

[**[Removing
Capabilities]{.underline}**](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#removing-capabilities)

You may remove capabilities from a role.

The implementation is similar to Adding Capabilities with the difference
being the use of remove_cap()method for the role object.

[**[Using Roles and
Capabilities]{.underline}**](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#using-roles-and-capabilities)

[**[Get
Role]{.underline}**](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#get-role)

Get the role object including all of it's capabilities
with [[get_role()]{.underline}](https://developer.wordpress.org/reference/functions/get_role/) .

[Copy](https://developer.wordpress.org/plugins/users/roles-and-capabilities/)

get_role( \$role );

[**[User
Can]{.underline}**](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#user-can)

Check if a user have a
specified **role** or **capability** with [[user_can()]{.underline}](https://developer.wordpress.org/reference/functions/user_can/) .

[Copy](https://developer.wordpress.org/plugins/users/roles-and-capabilities/)

user_can( \$user, \$capability );

There is an undocumented, third argument, \$args, that may include the
object against which the test should be performed.

E.g. Pass a post ID to test for the capability of that specific post.

[**[Current User
Can]{.underline}**](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#current-user-can)

[[current_user_can()]{.underline}](https://developer.wordpress.org/reference/functions/current_user_can/) is
a wrapper function
for [[user_can()]{.underline}](https://developer.wordpress.org/reference/functions/user_can/) using
the current user object as the \$userparameter.

Use this in scenarios where back-end and front-end areas should require
a certain level of privileges to access and/or modify.

[Copy](https://developer.wordpress.org/plugins/users/roles-and-capabilities/)

current_user_can( \$capability );

[**[Example]{.underline}**](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#example)

Here's a practical example of adding an Edit link on the in a template
file if the user has the proper capability:

[Copy](https://developer.wordpress.org/plugins/users/roles-and-capabilities/)

**if** ( current_user_can( \'edit_posts\' ) ) {

edit_post_link( esc_html\_\_( \'Edit\', \'wporg\' ), \'\<p\>\',
\'\</p\>\' );

}

[**[Multisite]{.underline}**](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#multisite)

The [[current_user_can_for_blog()]{.underline}](https://developer.wordpress.org/reference/functions/current_user_can_for_blog/) function
is used to test if the current user has a
certain **role** or **capability**on a specific blog.

[Copy](https://developer.wordpress.org/plugins/users/roles-and-capabilities/)

current_user_can_for_blog( \$blog_id, \$capability );

[**[Reference]{.underline}**](https://developer.wordpress.org/plugins/users/roles-and-capabilities/#reference)

Codex Reference for [[User Roles and
Capabilities]{.underline}](https://wordpress.org/support/article/roles-and-capabilities/).

Top of Form

Search

Bottom of Form

**HTTP API**

In this article

-   [[Introduction]{.underline}](https://developer.wordpress.org/plugins/http-api/#introduction)

    -   [[HTTP
        methods]{.underline}](https://developer.wordpress.org/plugins/http-api/#http-methods)

    -   [[Response
        codes]{.underline}](https://developer.wordpress.org/plugins/http-api/#response-codes)

-   [[GETting data from an
    API]{.underline}](https://developer.wordpress.org/plugins/http-api/#getting-data-from-an-api)

    -   [[GET the body you always
        wanted]{.underline}](https://developer.wordpress.org/plugins/http-api/#get-the-body-you-always-wanted)

    -   [[GET the response
        code]{.underline}](https://developer.wordpress.org/plugins/http-api/#get-the-response-code)

    -   [[GET a specific
        header]{.underline}](https://developer.wordpress.org/plugins/http-api/#get-a-specific-header)

    -   [[GET using basic
        authentication]{.underline}](https://developer.wordpress.org/plugins/http-api/#get-using-basic-authentication)

-   [[POSTing data to an
    API]{.underline}](https://developer.wordpress.org/plugins/http-api/#posting-data-to-an-api)

-   [[HEADing off bandwidth
    usage]{.underline}](https://developer.wordpress.org/plugins/http-api/#heading-off-bandwidth-usage)

-   [[Make any sort of
    request]{.underline}](https://developer.wordpress.org/plugins/http-api/#make-any-sort-of-request)

-   [[Introduction to
    caching]{.underline}](https://developer.wordpress.org/plugins/http-api/#introduction-to-caching)

-   [[When should you
    cache?]{.underline}](https://developer.wordpress.org/plugins/http-api/#when-should-you-cache)

-   [[WordPress
    Transients]{.underline}](https://developer.wordpress.org/plugins/http-api/#wordpress-transients)

    -   [[Cache an object ( Set a transient
        )]{.underline}](https://developer.wordpress.org/plugins/http-api/#cache-an-object-set-a-transient)

    -   [[Get a cached object ( Get a transient
        )]{.underline}](https://developer.wordpress.org/plugins/http-api/#get-a-cached-object-get-a-transient)

-   [[Delete a cached object (Delete a
    transient)]{.underline}](https://developer.wordpress.org/plugins/http-api/#delete-a-cached-object-delete-a-transient)

[**[Introduction]{.underline}**](https://developer.wordpress.org/plugins/http-api/#introduction)

HTTP stands for Hypertext Transfer Protocol and is the foundational
communication protocol for the entire Internet. Even if this is your
first experience with HTTP it's likely that you probably understand more
than you realize. At its most basic level, HTTP works like this:

-   "Hello server XYZ, may I please have file abc.html"

-   "Well hello there little client, yes you may, here it is"

There are many different methods to send HTTP requests in PHP. The
purpose of the WordPress HTTP API is to support as many of those methods
as possible and use the one that is the most suitable for the particular
request.

The WordPress HTTP API can also be used to communicate and interact with
other APIs like the Twitter API or the Google Maps API.

[**[HTTP
methods]{.underline}**](https://developer.wordpress.org/plugins/http-api/#http-methods)

HTTP has several methods, or verbs, that describe particular types of
actions. Though a couple more exist, WordPress has pre-built functions
for three of the most common. Whenever an HTTP request is made a method
is also passed with it to help the server determine what kind of action
the client is requesting.

**GET**

GET is used to retrieve data. This is by far the most commonly used
verb. Every time you view a website or pull data from an API you are
seeing the result of a GET request. In fact your browser sent a GET
request to the server you are reading this on and requested the data
used to build this very article.

**POST**

POST is used to send data to the server for the server to act upon in
some way. For example, a contact form. When you enter data into the form
fields and click the submit button the browser takes the data and sends
a POST request to the server with the text you entered into the form.
From there the server will process the contact request.

**HEAD**

HEAD is much less well known than the other two. HEAD is essentially the
same as a GET request except that it does not retrieve the data, only
information about the data. This data describes such things as when the
data was last updated, whether the client should cache the data, what
type the data is, etc. Modern browsers often send HEAD requests to pages
you have previously visited to determine if there are any updates. If
not, you may actually be seeing a previously downloaded copy of the page
instead of using bandwidth needlessly pulling in the same copy.

All good API clients utilize HEAD before performing a GET request to
potentially save on bandwidth. Though it will require two separate HTTP
requests if HEAD says there is new data, the data size with a GET
request can be very large. Only using GET when HEAD says the data is new
or should not be cached will help save on expensive bandwidth and load
times.

**Custom Methods**

There are other HTTP methods, such as PUT, DELETE, TRACE, and CONNECT.
These methods will not be covered in this article as there aren't
pre-built methods to utilize them in WordPress, nor is it yet common for
APIs to implement them.

Depending upon how your server is configured you can also implement
additional HTTP methods of your own. It is always a gamble to go outside
of the standard methods, and places huge potential limitations on other
developers creating clients to consume your site or API, however it is
possible to utilize any method you wish with WordPress. We will briefly
touch on how to do that in this article.

[**[Response
codes]{.underline}**](https://developer.wordpress.org/plugins/http-api/#response-codes)

HTTP utilizes both numeric and string response codes. Rather than go
into a lengthy explanation of each, here are the standard response
codes. You can define your own response codes when creating APIs,
however unless you need to support specific types of responses it may be
best to stick to the standard codes. Custom codes are usually in the 1xx
ranges.

**Code Classes**

The type of response can quickly be seen by the leftmost digit of the
three digit codes.

  -----------------------------------------------------------------------
  Status   Description
  Code     
  -------- --------------------------------------------------------------
  2xx      Request was successful

  3xx      Request was redirected to another URL

  4xx      Request failed due to client error. Usually invalid
           authentication or missing data

  5xx      Request failed due to a server error. Commonly missing or
           misconfigured configuration files
  -----------------------------------------------------------------------

** Common Codes**

These are the most common codes you will encounter.

  -----------------------------------------------------------------------
  Status Code   Description
  ------------- ---------------------------------------------------------
  200           OK -- Request was successful

  301           Resource was moved permanently

  302           Resource was moved temporarily

  403           Forbidden -- Usually due to an invalid authentication

  404           Resource not found

  500           Internal server error

  503           Service unavailable
  -----------------------------------------------------------------------

[**[GETting data from an
API]{.underline}**](https://developer.wordpress.org/plugins/http-api/#getting-data-from-an-api)

[[GitHub]{.underline}](https://github.com/) provides an excellent API
that does not require app registration for many public aspects, so to
demonstrate some of these methods, examples will target the GitHub API.

GETting data is made incredibly simple in WordPress through
the [[wp_remote_get()]{.underline}](https://developer.wordpress.org/reference/functions/wp_remote_get/) function.
This function takes the following two arguments:

1.  \$url -- Resource to retrieve data from. This must be in a standard
    HTTP format

2.  \$args -- OPTIONAL -- You may pass an array of arguments in here to
    alter behavior and headers, such as cookies, follow redirects, etc.

The following defaults are assumed, though they can be changed via the
\$args parameter:

-   method -- GET

-   timeout -- 5 -- How long to wait before giving up

-   redirection -- 5 -- How many times to follow redirects.

-   httpversion -- 1.0

-   blocking -- true -- Should the rest of the page wait to finish
    loading until this operation is complete?

-   headers -- array()

-   body -- null

-   cookies -- array()

Let's use the URL to a GitHub user account and see what sort of
information we can get

[[Copy]{.underline}](https://developer.wordpress.org/plugins/http-api/)

\$response = wp_remote_get( \'https://api.github.com/users/blobaugh\' );

\$response will contain all the headers, content, and other meta data
about our request

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/http-api/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/http-api/)

**Array**(

\[headers\] =\> **Array**(

\[server\] =\> nginx

\[date\] =\> Fri, 05 Oct 2012 04:43:50 GMT

\[content-type\] =\> application/json; charset=utf-8

\[connection\] =\> close

\[status\] =\> 200 OK

\[vary\] =\> Accept

\[x-ratelimit-remaining\] =\> 4988

\[content-length\] =\> 594

\[last-modified\] =\> Fri, 05 Oct 2012 04:39:58 GMT

\[etag\] =\> \"5d5e6f7a09462d6a2b473fb616a26d2a\"

\[x-github-media-type\] =\> github.beta

\[cache-control\] =\> **public**, s-maxage=60, max-age=60

\[x-content-type-options\] =\> nosniff

\[x-ratelimit-limit\] =\> 5000

)

\[body\] =\>
{\"type\":\"User\",\"login\":\"blobaugh\",\"gravatar_id\":\"f25f324a47a1efdf7a745e0b2e3c878f\",\"public_gists\":1,\"followers\":22,\"created_at\":\"2011-05-23T21:38:50Z\",\"public_repos\":31,\"email\":\"ben@lobaugh.net\",\"hireable\":true,\"blog\":\"http://ben.lobaugh.net\",\"bio\":null,\"following\":30,\"name\":\"Ben
Lobaugh\",\"company\":null,\"avatar_url\":\"https://secure.gravatar.com/avatar/f25f324a47a1efdf7a745e0b2e3c878f?d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png\",\"id\":806179,\"html_url\":\"https://github.com/blobaugh\",\"location\":null,\"url\":\"https://api.github.com/users/blobaugh\"}

\[response\] =\> **Array**(

\[preserved_text 5237511b45884ac6db1ff9d7e407f225 /\] =\> 200

\[message\] =\> OK

)

\[cookies\] =\> **Array**()

\[filename\] =\>

)

All of the same helper functions can be used on this function as with
the previous two. The exception here being that HEAD never returns a
body, so that element will always be empty.

[**[GET the body you always
wanted]{.underline}**](https://developer.wordpress.org/plugins/http-api/#get-the-body-you-always-wanted)

Just the body can be retrieved
using [[wp_remote_retrieve_body()]{.underline}](https://developer.wordpress.org/reference/functions/wp_remote_retrieve_body/).
This function takes just one parameter, the response from any of the
other [[wp_remote_X]{.underline}](https://developer.wordpress.org/?s=wp_remote_&post_type%5B%5D=wp-parser-function) functions
where retrieve is not the next value.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/http-api/)

\$response = wp_remote_get( \'https://api.github.com/users/blobaugh\' );

\$body = wp_remote_retrieve_body( \$response );

Still using the GitHub resource from the previous example, \$body will
be

[[Copy]{.underline}](https://developer.wordpress.org/plugins/http-api/)

{\"type\":\"User\",\"login\":\"blobaugh\",\"public_repos\":31,\"gravatar_id\":\"f25f324a47a1efdf7a745e0b2e3c878f\",\"followers\":22,\"avatar_url\":\"https://secure.gravatar.com/avatar/f25f324a47a1efdf7a745e0b2e3c878f?d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png\",\"public_gists\":1,\"created_at\":\"2011-05-23T21:38:50Z\",\"email\":\"ben@lobaugh.net\",\"following\":30,\"name\":\"Ben
Lobaugh\",\"company\":null,\"hireable\":true,\"id\":806179,\"html_url\":\"https://github.com/blobaugh\",\"blog\":\"http://ben.lobaugh.net\",\"location\":null,\"bio\":null,\"url\":\"https://api.github.com/users/blobaugh\"}

If you do not have any other operations to perform on the response other
than getting the body you can reduce the code to one line with

[[Copy]{.underline}](https://developer.wordpress.org/plugins/http-api/)

\$body = wp_remote_retrieve_body( wp_remote_get(
\'https://api.github.com/users/blobaugh\' ) );

Many of these helper functions can be used on one line similarly.

[**[GET the response
code]{.underline}**](https://developer.wordpress.org/plugins/http-api/#get-the-response-code)

You may want to check the response code to ensure your retrieval was
successful. This can be done via
the [[wp_remote_retrieve_response_code()]{.underline}](https://developer.wordpress.org/reference/functions/wp_remote_retrieve_response_code/) function:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/http-api/)

\$response = wp_remote_get( \'https://api.github.com/users/blobaugh\' );

\$http_code = wp_remote_retrieve_response_code( \$response );

If successful \$http_code will contain 200.

[**[GET a specific
header]{.underline}**](https://developer.wordpress.org/plugins/http-api/#get-a-specific-header)

If your desire is to retrieve a specific header, say last-modified, you
can do so
with [[wp_remote_retrieve_header()]{.underline}](https://developer.wordpress.org/reference/functions/wp_remote_retrieve_header).
This function takes two parameters

1.  \$response -- The response from the get call

2.  \$header -- Name of the header to retrieve

To retrieve the last-modified header

[[Copy]{.underline}](https://developer.wordpress.org/plugins/http-api/)

\$response = wp_remote_get( \'https://api.github.com/users/blobaugh\' );

\$last_modified = wp_remote_retrieve_header( \$response,
\'last-modified\' );

\$last_modified will contain \[last-modified\] =\> Fri, 05 Oct 2012
04:39:58 GMT\
You can also retrieve all of the headers in an array
with wp_remote_retrieve_headers( \$response ).

[**[GET using basic
authentication]{.underline}**](https://developer.wordpress.org/plugins/http-api/#get-using-basic-authentication)

APIs that are secured more provide one or more of many different types
of authentication. A common, though not highly secure, authentication
method is HTTP Basic Authentication. It can be used in WordPress by
passing 'Authorization' to the second parameter of
the [[wp_remote_get()]{.underline}](https://developer.wordpress.org/reference/functions/wp_remote_get) function,
as well as the other HTTP method functions.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/http-api/)

\$args = **array**(

\'headers\' =\> **array**(

\'Authorization\' =\> \'Basic \' . base64_encode( YOUR_USERNAME . \':\'
. YOUR_PASSWORD )

)

);

wp_remote_get( \$url, \$args );

[**[POSTing data to an
API]{.underline}**](https://developer.wordpress.org/plugins/http-api/#posting-data-to-an-api)

The same helper methods
([[wp_remote_retrieve_body()]{.underline}](https://developer.wordpress.org/reference/functions/wp_remote_retrieve_body),
etc ) are available for all of the HTTP method calls, and utilized in
the same fashion.

POSTing data is done using
the [[wp_remote_post()]{.underline}](https://developer.wordpress.org/reference/functions/wp_remote_post) function,
and takes exactly the same parameters
as [[wp_remote_get()]{.underline}](https://developer.wordpress.org/reference/functions/wp_remote_get).
It should be noted here that you are required to pass in ALL of the
elements in the array for the second parameter. The Codex provides the
default acceptable values. You only need to care right now about the
data you are sending so the other values will be defaulted.

To send data to the server you will need to build an associative array
of data. This data will be assigned to the \'body\' value. From the
server side of things the value will appear in the \$\_POST variable as
you would expect. i.e. if body =\> array( \'myvar\' =\> 5 ) on the
server \$\_POST\[\'myvar\'\] = 5.

Because GitHub does not allow POSTing to the API used in the previous
example, this example will pretend that it does. Typically if you want
to POST data to an API you will need to contact the maintainers of the
API and get an API key or some other form of authentication token. This
simply proves that your application is allowed to manipulate data on the
API the same way logging into a website as a user does to the website.

Lets assume we are submitting a contact form with the following fields:
name, email, subject, comment. To setup the body we do the following:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/http-api/)

\$body = **array**(

\'name\' =\> \'Jane Smith\',

\'email\' =\> \'some@email.com\',

\'subject\' =\> \'Checkout this API stuff\',

\'comment\' =\> \'I just read a great tutorial. You gotta check it
out!\',

);

Now we need to set up the rest of the values that will be passed to the
second parameter
of [[wp_remote_post()]{.underline}](https://developer.wordpress.org/reference/functions/wp_remote_post)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/http-api/)

\$args = **array**(

\'body\' =\> \$body,

\'timeout\' =\> \'5\',

\'redirection\' =\> \'5\',

\'httpversion\' =\> \'1.0\',

\'blocking\' =\> true,

\'headers\' =\> **array**(),

\'cookies\' =\> **array**(),

);

Then of course to make the call

[[Copy]{.underline}](https://developer.wordpress.org/plugins/http-api/)

\$response = wp_remote_post( \'http://your-contact-form.com\', \$args );

[**[HEADing off bandwidth
usage]{.underline}**](https://developer.wordpress.org/plugins/http-api/#heading-off-bandwidth-usage)

It can be pretty important, and sometimes required by the API, to check
a resource status using HEAD before retrieving it. On high traffic APIs,
GET is often limited to a number of requests per minute or hour. There
is no need to even attempt a GET request unless the HEAD request shows
that the data on the API has been updated.

As mentioned previously, HEAD contains data on whether or not the data
has been updated, if the data should be cached, when to expire the
cached copy, and sometimes a rate limit on requests to the API.

Going back to the GitHub example, here are few headers to watch out for.
Most of these headers are standard, but you should always check the API
docs to ensure you understand which headers are named what, and their
purpose.

-   x-ratelimit-limit -- Number of requests allowed in a time period

-   x-ratelimit-remaining -- Number of remaining available requests in
    time period

-   content-length -- How large the content is in bytes. Can be useful
    to warn the user if the content is fairly large

-   last-modified -- When the resource was last modified. Highly useful
    to caching tools

-   cache-control -- How should the client handle caching

The following will check the HEAD value of my GitHub user account:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/http-api/)

\$response = wp_remote_head( \'https://api.github.com/users/blobaugh\'
);

\$response should look similar to

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/http-api/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/http-api/)

**Array**(

\[headers\] =\> **Array**

(

\[server\] =\> nginx

\[date\] =\> Fri, 05 Oct 2012 05:21:26 GMT

\[content-type\] =\> application/json; charset=utf-8

\[connection\] =\> close

\[status\] =\> 200 OK

\[vary\] =\> Accept

\[x-ratelimit-remaining\] =\> 4982

\[content-length\] =\> 594

\[last-modified\] =\> Fri, 05 Oct 2012 04:39:58 GMT

\[etag\] =\> \"5d5e6f7a09462d6a2b473fb616a26d2a\"

\[x-github-media-type\] =\> github.beta

\[cache-control\] =\> **public**, s-maxage=60, max-age=60

\[x-content-type-options\] =\> nosniff

\[x-ratelimit-limit\] =\> 5000

)

\[body\] =\>

\[response\] =\> **Array**

(

\[preserved_text 39a8515bd2dce2aa06ee8a2a6656b1de /\] =\> 200

\[message\] =\> OK

)

\[cookies\] =\> **Array**(

)

\[filename\] =\>

)

All of the same helper functions can be used on this function as with
the previous two. The exception here being that HEAD never returns a
body, so that element will always be empty.

[**[Make any sort of
request]{.underline}**](https://developer.wordpress.org/plugins/http-api/#make-any-sort-of-request)

If you need to make a request using an HTTP method that is not supported
by any of the above functions do not panic. The great people developing
WordPress already thought of that and lovingly
provided [[wp_remote_request()]{.underline}](https://developer.wordpress.org/reference/functions/wp_remote_request).
This function takes the same two parameters
as [[wp_remote_get()]{.underline}](https://developer.wordpress.org/reference/functions/wp_remote_get),
and allows you to specify the HTTP method as well. What data you need to
pass along is up to your method.

To send a DELETE method example you may have something similar to the
following:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/http-api/)

\$args = **array**(

\'method\' =\> \'DELETE\',

);

\$response = wp_remote_request(
\'http://some-api.com/object/to/delete\', \$args );

[**[Introduction to
caching]{.underline}**](https://developer.wordpress.org/plugins/http-api/#introduction-to-caching)

Caching is a practice whereby commonly used objects or objects requiring
significant time to build are saved into a fast object store for quick
retrieval on later requests. This prevents the need to spend the time
fetching and building the object again. Caching is a vast subject that
is part of website optimization and could go into an entire series of
articles by itself. What follows is just an introduction to caching and
a simple yet effective way to quickly setup a cache for API responses.

Why should you cache API responses? Well, the big elephant in the room
is because external APIs slow down your site. Many consultants will tell
you tapping into external APIs will improve the performance of your
website by reducing the amount of connections and processing it
performs, as well as costly bandwidth, but sometimes this is simply not
true.

It is a fine balancing act between the speed your server can send data
and the amount of time it takes for the remote server to process a
request, build the data, and send it back. The second glaring aspect is
that many APIs have a limited number of requests in a time period, and
possibly a limit to the number of connections by an application at once.
Caching helps solve these dilemmas by placing a copy of the data on your
server until it needs to be refreshed.

[**[When should you
cache?]{.underline}**](https://developer.wordpress.org/plugins/http-api/#when-should-you-cache)

The snap answer to this is \*always\*, but again there are times when
you should not. If you are dealing with real time data or the API
specifically says not to cache in the headers you may not want to cache,
but for all other situations it is generally a good idea to cache any
resources retrieved from an API.

[**[WordPress
Transients]{.underline}**](https://developer.wordpress.org/plugins/http-api/#wordpress-transients)

WordPress Transients provide a convenient way to store and use cached
objects. Transients live for a specified amount of time, or until you
need them to expire when a resource from the API has been updated. Using
the transient functionality in WordPress may be the easiest to use
caching system you ever encounter. There are only three functions to do
all the heavy lifting for you.

[**[Cache an object ( Set a transient
)]{.underline}**](https://developer.wordpress.org/plugins/http-api/#cache-an-object-set-a-transient)

Caching an object is done with
the [[set_transient()]{.underline}](https://developer.wordpress.org/reference/functions/set_transient) function.
This function takes the following three parameters:

1.  \$transient -- Name of the transient for future reference

2.  \$value -- Value of the transient

3.  \$expiration -- How many seconds from saving the transient until it
    expires

An example of caching the GitHub user information response from above
for one hour would be

[[Copy]{.underline}](https://developer.wordpress.org/plugins/http-api/)

\$response = wp_remote_get( \'https://api.github.com/users/blobaugh\' );

set_transient( \'prefix_github_userinfo\', \$response, 60 \* 60 );

[**[Get a cached object ( Get a transient
)]{.underline}**](https://developer.wordpress.org/plugins/http-api/#get-a-cached-object-get-a-transient)

Getting a cached object is quite a bit more complex than setting a
transient. You need to request the transient, but then you also need to
check to see if that transient has expired and if so fetch updated data.
Usually the set_transient() call is made inside of
the get_transient() call. Here is an example of getting the transient
data for the GitHub user profile:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/http-api/)

\$github_userinfo = get_transient( \'prefix_github_userinfo\' );

**if** ( false === \$github_userinfo ) {

// Transient expired, refresh the data

\$response = wp_remote_get( \'https://api.github.com/users/blobaugh\' );

set_transient( \'prefix_github_userinfo\', \$response, HOUR_IN_SECONDS
);

}

// Use \$github_userinfo as you will

[**[Delete a cached object (Delete a
transient)]{.underline}**](https://developer.wordpress.org/plugins/http-api/#delete-a-cached-object-delete-a-transient)

Deleting a cached object is the easiest of all the transient functions,
simply pass it a parameter of the name of the transient and you are
done.

To remove the Github user info:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/http-api/)

delete_transient( \'blobaugh_github_userinfo\' );

More information on transients can be
found [[here]{.underline}](https://developer.wordpress.org/apis/handbook/transients/).

**First published**

September 24, 2014

**Last updated**

December 14, 2023

[PreviousWorking with UsersPrevious: Working with
Users](https://developer.wordpress.org/plugins/users/working-with-users/)

[NextREST APINext: REST
API](https://developer.wordpress.org/plugins/rest-api/)

#  
