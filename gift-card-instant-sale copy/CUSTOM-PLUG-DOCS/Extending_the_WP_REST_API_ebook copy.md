**Table of Contents**

+----------------------------------------------------------------+-----+
| **Foreword**                                                   | >   |
|                                                                |  ** |
|                                                                | 3** |
+:===============================================================+:====+
| **Introduction**                                               | >   |
|                                                                |  ** |
|                                                                | 5** |
+----------------------------------------------------------------+-----+
| **API Design Primer**                                          | >   |
|                                                                |  ** |
|                                                                | 6** |
+----------------------------------------------------------------+-----+
| > Verbs                                                        | > 7 |
+----------------------------------------------------------------+-----+
| > Routes                                                       | > 7 |
+----------------------------------------------------------------+-----+
| > Endpoints                                                    | > 8 |
+----------------------------------------------------------------+-----+
| > Authorization                                                | >   |
|                                                                |  10 |
+----------------------------------------------------------------+-----+
| > Authentication                                               | >   |
|                                                                |  10 |
+----------------------------------------------------------------+-----+
| > Wrap Up                                                      | >   |
|                                                                |  11 |
+----------------------------------------------------------------+-----+
| **The Example Code**                                           | >   |
|                                                                | **1 |
|                                                                | 2** |
+----------------------------------------------------------------+-----+
| > Installation                                                 | >   |
|                                                                |  13 |
+----------------------------------------------------------------+-----+
| **Routes and Endpoints**                                       | >   |
|                                                                | **1 |
|                                                                | 5** |
+----------------------------------------------------------------+-----+
| > Defining Endpoints                                           | >   |
|                                                                |  17 |
+----------------------------------------------------------------+-----+
| > Callbacks                                                    | >   |
|                                                                |  23 |
+----------------------------------------------------------------+-----+
| > Permissions                                                  | >   |
|                                                                |  24 |
+----------------------------------------------------------------+-----+
| > Arguments                                                    | >   |
|                                                                |  25 |
+----------------------------------------------------------------+-----+
| > Context                                                      | >   |
|                                                                |  27 |
+----------------------------------------------------------------+-----+
| **Schemas**                                                    | >   |
|                                                                | **2 |
|                                                                | 8** |
+----------------------------------------------------------------+-----+
| > Defining a Schema                                            | >   |
|                                                                |  29 |
+----------------------------------------------------------------+-----+
| > Displaying the Schema                                        | >   |
|                                                                |  31 |
+----------------------------------------------------------------+-----+
| > Context Revisited                                            | >   |
|                                                                |  32 |
+----------------------------------------------------------------+-----+
| **Requests**                                                   | **3 |
|                                                                | 4** |
+----------------------------------------------------------------+-----+
| > get_param()                                                  | >   |
|                                                                |  35 |
+----------------------------------------------------------------+-----+
| > get_headers()                                                | >   |
|                                                                |  36 |
+----------------------------------------------------------------+-----+

+----------------------------------------------------------------+-----+
| > Design Decisions                                             | >   |
|                                                                |  47 |
+:===============================================================+=====+
| > The Code                                                     | >   |
|                                                                |  48 |
+----------------------------------------------------------------+-----+
| > Wrap Up                                                      | >   |
|                                                                |  54 |
+----------------------------------------------------------------+-----+
| **Custom Controllers**                                         | >   |
|                                                                | **5 |
|                                                                | 5** |
+----------------------------------------------------------------+-----+
| **Conclusion**                                                 | >   |
|                                                                | **5 |
|                                                                | 7** |
+----------------------------------------------------------------+-----+

Other Important Methods 37

ArrayAccess 39

**Responses 41**

Headers 42

Status 44

Wrap Up 45

**Sample Plugin:**

**wp_podcast_api 46**

# Foreword

I wonder when tech historians in the far future look back to this point
in history, how will WordPress be viewed?

Will it be it's relative server-side simplicity? WordPress is in fact
one of the most popular self-hosted software frameworks today - built on
top of the mySQL database and PHP programming language. Any server that
supports that simple combination can run WordPress - from a Raspberry Pi
to a large data center that hosts thousands of sites. Relative to other
popular server side technologies today, a server needed to run WordPress
is relatively easy to set up.

How about flexibility? While starting off as a blogging engine,
WordPress has grown in time to power so much more. People are creating
everything from mobile applications to social networking sites with it.
If there's a public (or in many cases) private API out there, chances
are WordPress already has a plugin for it... or someone can build one
relatively quickly. How about it's community? WordPress is open source,
licensed under the GPL, and that brings with it a mindset of sharing
both code and knowledge with others freely. This happens often every
week either in a meetup, conference, or WordCamp. Even developers from
rival companies can sit at a table, kick back, and freely share. That's
the mentality that the open source (and in particular) the WordPress
community has in abundance.

It's through that community that I met Cal. As I started in 2008 to
organize tech events (such as WordCamp Miami) I've come to know Cal as
an excellent speaker, warm community leader, and a clever developer -
qualities that you don't often see in a single individual. Cal's passion
for knowledge is seen in the way he shares it - on stage or one-on-one.

It's with great pleasure that I am writing to tell you that there is
nobody better to lead you on a deeper journey into one of the best ways
you can expand WordPress itself\... the WordPress REST API.

There are many interesting and trending technologies today - everything
from "Jamstack" solutions to million-dollar corporations that want to
host your site (and your content). These technologies are legit (and
always use the right tool for the job). But along with these new
developments it's a credit to WordPress itself - a technology over 15
years old and built on relatively simple server requirements - that it
continues to grow and (as of this writing) nearly surpassed 39% market
share\*.

I believe WordPress has a long life in it and the REST API is one of the
ways we'll see the software continue to thrive and transform a wide
variety of projects from a diverse set of developers. I can't think of a
better community, a better opportunity, or a better time to learn as a
developer about this subject. Grab a beverage of your choice and allow
Cal to guide you through this.

Smooth sailing.

## David Bisset 

*WordPress/PHP Developer*

[**https://davidbisset.com**](https://davidbisset.com/)

> ● [**https://w3techs.com/technologies/history_overview/content\_**
> **management/all**](https://w3techs.com/technologies/history_overview/content_management/all)

**Introduction**

Dear Reader,

A little more than a year has passed since I wrote the companion volume
to this book, "Using the WordPress REST API." In that time, so much has
changed. We are living in a different world. Still, one of the constants
throughout all the upheaval is that all of us are still learning. My
hope with this book is to share what I have learned, so you can build on
top of that. I do not pretend I am a giant equal to those whose
shoulders I am standing upon. Even so, if I can boost you even a little,
you can reach things you've never reached before. More importantly, as
you learn and then share what you have learned, the next generation of
developers will be able to reach new heights.

Learn, share, repeat. Until next time,

I \<3 \|\<

=C=

## Cal Evans

*May 10, 2021*

*West Palm Beach, Florida, USA*

# API Design Primer

![](media/image2.jpg){width="5.803334426946631in"
height="3.1466666666666665in"}This book assumes the reader is familiar
with the WordPress REST API. If not, get a copy of **["Using the
WordPress REST
API](https://www.siteground.com/wordpress-rest-api-guide)"** and start
there.

Before we dive into Extending the WordPress REST API, we need to
understand some basic concepts. This is not a full explanation of REST
but instead explains the concepts covered in this book. If, after
reading this book, you want to dive deeper into REST, there are a lot of
great books and courses available to you, and you are recommended to dig
in deep.

## Verbs

Let's start the discussion in an odd place, HTTP verbs. Every call to a
web server involves both a URL and a verb. When you enter a domain name
into a browser, it by default issues a GET. When you fill out a form and
click submit, the browser by default issues a POST. Most developers are
familiar with GET and POST, but HTTP defines several other verbs that
developers can use. In this book, we will be using the following verbs:

-   GET - Retrieve the entity at the URL

-   POST - Create a new entity

-   PATCH - Update an existing entity with a subset of the data the
    entity contains

-   DELETE - Remove the entity

In this book and the sample code, we deviate from WordPress standards by
enforcing the strict meaning of the verbs. WordPress' REST API accepts
POST, PUT, and PATCH to update an existing entity. This goes against the
concepts of REST. In fairness, developers call most REST APIs "RESTful"
because almost most of them deviate from the specification at some point
or other.

## Routes

Now that you understand HTTP verbs let's move to routes.

A\>Depending on what part of the world you are in, this is pronounced
"root" as in what a plant has, or "route" that sounds like "ouch."
Thankfully, the text version of this book does not have to deal with the
"proper" pronunciation.

No matter how you pronounce it, an API route is the URI to access an
entity. A route is made up of a collection of endpoints.

*For example:*

If our WordPress installation was at https://example.com, then the
WordPress REST API would live at https://example.com/wp-json/. You
probably already know about the native WordPress routes and endpoints
that live under the wp namespace. Endpoints like wp/v2/posts/1, which
allows us to manipulate post number one in our WordPress installation.
Notice that was not 'retrieve' or 'edit' the post. Yes, developers can
do that via this route, but the actual functionality requested is
determined by the HTTP verb you specify. The route is the URI.

Putting all that together, the full URI to manipulate post number one in
our

WordPress install would be https://example.com/wp-son/wp/v2/ posts/1.

Routes don't have to stop at the item number, though; you could have
additional parts to the URI that extend the route.

For example, https://example.com/wp-json/eicc/podcasts/v1/

episodes/297/publish. This route would allow us to create endpoints that
would publish a podcast episode. Precisely what "publish" means is up to
the author of the code.

Routes define how you access entities in a REST API.

## Endpoints

If routes define how you access entities in a REST API, endpoints define
what you do with those endpoints. Endpoints are the combination of a
route and a verb.

Calling https://example.com/wp-son/wp/v2/posts/1 with the verb

GET is the proper way to retrieve the first post in our WordPress
installation.

The combination of these two pieces of information is called the
endpoint.

Endpoints point to functioning code. The Route itself is useless without
the verb because the system would not know what to do.

A\> Do not confuse the fact that if you do not specify a verb, almost
all libraries and programs default to GET without having a verb. Every
call to an HTTPbased API has to have a verb.

As developers, it is our job to define the verbs that are allowed to be
specified on any given route and then write the code for each of them.
Throughout this process, it is important to remain consistent.

-   Consistent within our code.

-   Consistent with WordPress standards.

-   Consistent with REST.

When any of those three conflicts, it is important that you think the
problem through because there is no one default layer that should always
win.

An example of consistency would be POST should never be allowed on a
specific ID. Since POST is a create concept, you should never specify
the exact ID to create. If you wanted to create a post in our sample
WordPress install, you would call
https://example.com/wp-son/wp/v2/posts/ with the verb POST and without
the post ID. WordPress creates the post and returns it to you with the
post ID of the new post.

On the other hand, PATCH is not a create verb. Therefore, PATCH should
always have an ID in the URI, https://example.com/wp-son/wp/v2/posts/1.
Sending a PATCH to the route with a post ID of an existing post allows
you to edit that post but not create a new one. Sending a PATCH to the
route without a post ID would make no sense because PATCH is not a
create verb. This should return an error.

In reality, there is nothing to prevent developers from creating a route
that allows POST to update if an identifier is passed in and create if
one is not. As stated before, this is how the WordPress REST API
operates. This, however, is not consistent with the REST specification.
Therefore, our sample application will not demonstrate this behavior.

### Authorization

Another important concept to understand before you dive into the details
of extending the WordPress REST API is authorization. Many people
shorten the term to "auth," but that road leads to confusion. "Auth" can
mean *authorization* or *authentication*.

Authentication can be defined as whether a user has valid login
credentials.

In this book, as in "Using the WordPress REST API," you will be using a
plugin for JWT to help us with authentication. Once you have the token,
you can use it to access other endpoints and prove out authorization.
The code inside the controller determines authentication and acts
accordingly.

### Authentication

The other "auth" is authentication. Authentication is "what is this user
allowed to do?" In WordPress, users are assigned roles. The user's role
determines their authorization because it defines what actions they are
allowed to take.

API access comes in two variants, public and private. Public, for
example, https://example.com/wp-json/wp/v2/posts, allows anyone to
access certain endpoints without authorization. These are usually
limited to GET access to information that you could see on a website
anyhow. RSS feeds are a good example of a publicly accessible endpoint.

The majority of endpoints, though, require both authorization and
authentication. Just like in WordPress, you may be able to log in, but
unless the role you have been assigned allows you to create posts, you
will not be able to create them.

A properly designed REST API endpoint will check both authorization and
authentication.

### Wrap Up

Now that you understand and agree on the terms used in this book, you
can start diving into the code. Without this common vocabulary, though,
the rest of this book would be both difficult to write and even more
confusing to understand.

# The Example Code

![](media/image3.jpg){width="5.803334426946631in"
height="3.1466666666666665in"}Before you dive into the code, there is
one more thing that needs to be discussed---the sample code project. The
sample application for this book is a series of routes and endpoints the
author created when building a new workflow for podcasts.

This is a simple example and was meant to be so. It is contained in a
single controller. It defines a series of routes and endpoints that are
necessary for accessing and manipulating WordPress posts via "podcast
episode number," which is stored in each post as metadata.

A sample endpoint in production looks like this:

[**https://voicesoftheelephpant.com/wp-json/eicc/podcasts/v1/episodes/297**.](https://voicesoftheelephpant.com/wp-json/eicc/podcasts/v1/episodes/297)
If you use Firefox to access that endpoint, its internal JSON parser
will display all of the content publicly available for that episode.

You can find the example code at
[**https://gitlab.com/calevans/wp_podcast_api**](https://gitlab.com/calevans/wp_podcast_api).

As with any open source project, pull requests are always welcome.

## Installation

This is a complex plugin that requires more than just clicking "Install
New Plugin" button from the WordPress admin. This plugin has no admin
interface because it needs no configuration. There are a few steps you
have to follow, though, to get it to work.

-   Install, configure, and test [**JWT Authentication for
    WP-API**](https://wordpress.org/plugins/jwt-authentication-for-wp-rest-api/).
    This process was briefly described in [**Using the WordPress REST
    API**](https://www.siteground.com/wordpress-rest-api-guide), but the
    best source of installation instructions is the plugin's page on
    WordPress.org. Once you can authenticate and receive a token, it is
    safe to move on to the next steps. If you can't, nothing below will
    work.

-   I also recommend that you install [**Yoast
    SEO**](https://wordpress.org/plugins/wordpress-seo/). The API plugin
    writes to meta fields that Yoast sets up and uses. It will still
    work without it, but I recommend installing Yoast SEO. No
    configuration is necessary for this plugin to work.

-   Clone the repo. You can alternately download and unzip the zip file
    from the repo; the choice is yours. Cloning the repo allows you to
    update things easily. If you plan to submit a pull request (or want
    to make sure you never lose access to the code), fork the repo
    before you clone it. This way, you are always working from your
    local copy of the code.

-   From the command line, in the plugin's directory, run the following
    command:

\$ composer install

This installs all the necessary dependencies for the plugin to operate.
Currently, the only requirement is PHP 7.3+. There are dev dependencies,
and if you are planning on doing any coding on this, then I highly
recommend these in your development environment. Never load dev
requirements in production.

The plugin should now be ready to use. You can make sure it is
operational by pointing a browser at
https://yourWordPressInstall.com/wp-json. In the namespaces portion of
the payload, you should see eicc/podcasts/ v1. This lets you know the
namespace has been registered.

# Routes and Endpoints

In the first chapter, the idea was discussed that routes are
collections. They are part of the endpoint equation but not the entire
equation. A route, combined with a verb, is actually an endpoint.

![](media/image4.jpg){width="5.803334426946631in"
height="3.1466666666666665in"}This means that in the sample code, two
decisions have to be made when defining the endpoint. First, what was
the URI that was called---the route. In determining the route, we also
have to pick apart any information passed in as part of the route.

For example:

https://example.com/wp-json/eicc/podcasts/v1/episodes/1

The URI below calls the route /eicc/podcasts/v1/episodes/ and passes in
the episode ID of 1.

A\> This API exists because the post ID and episode ID are never the
same. If they were, we could simply use the post endpoints.

The same route called without the episode ID returns a paginated list of
episodes. https://example.com/wp-json/eicc/podcasts/v1/episodes

It is also possible to define routes that have parts after the ID. For
instance:

https://example.com/wp-json/eicc/podcasts/v1/episodes/1/graphics

This is an example route that is not defined in our controller; however,
it would be possible to do so. This would give us all the graphical
elements defined for episode 1.

The second decision to be made is which HTTP verbs to support. Most
endpoints support more than one verb. In the first example above, the
code could support GET, PATCH, PUT, and DELETE. However, it does not
make sense for it to support POST since POST is a create verb, and the
fact that the episode ID is specified means that the entity already
exists.

Similarly, it would not make sense for the first example above to
support DELETE. No episode ID is being passed in; therefore, the API
would have no idea which episode to delete.

Getting the routes and endpoints right is one of the hardest tasks in
creating an API. Developers spend a lot of time fretting over them and
tweaking the list to ensure all use cases are covered. The best advice
is to start small and grow. Don't try to define every endpoint that is
needed; begin with the most obvious one and build out from there.

In the case of the sample code, the first route designed was the simple
one. https://example.com/wp-json/eicc/podcasts/v1/episodes

Once it was decided that the route had to exist, the next step was to
decide what verbs to support. In this case, GET and POST were all that
it needed to support.

-   GET to return the collection

-   POST to create new episode entities

## Defining Endpoints

How does all of this translate into code? Here is the method necessary
to register this single endpoint in WordPress.

public function register_routes() { register_rest_route(

\$this-\>namespace,

\$this-\>uri,

\[

\[

'methods' =\> WP_REST_Server::READABLE,

'callback' =\> \[ \$this, 'get_episodes' \],

'args' =\> \$this-\>get_args_schema(),

\],

\[

'methods' =\> WP_REST_Server::CREATABLE,

'callback' =\> \[ \$this, 'create_episode' \],

'permission_callback' =\> \[ \$this, 'can_create' \],

\],

\]

);

}

In the example above \$this-\>namespace and \$this-\>uri are defined in
the object's constructor: \$this-\>namespace="/eicc/podcasts/v1" and
\$this-\>uri="episodes".

Since we are subclassing WP_REST_Controller, we are sticking with the
method names defined by it. Future chapters explore developing endpoints
from scratch. In those examples, you are free to name your methods in
ways that make sense in the context of the problem you are solving.

WordPress has a built-in function
[**register_rest_route()**](https://developer.wordpress.org/reference/functions/register_rest_route/)
that is called with the proper parameters to register the route. Each
route needs its own call to register_rest_route(). However, as seen
above, multiple verbs can be represented in a single route definition.

### READABLE

The first parameter passed into register_rest_route is the namespace. In
short, this is everything after /wp-json and before the name of the
entity that the endpoint represents. The URI is the name of the entity
itself as well, and anything else passed after it. In our case, that is
/eicc/podcasts/v1.

Next is the URI. This is the beginning of the identifier of this
particular controller. This controller is for the episode endpoints.
There may be other controllers under the eicc/podcasts/v1 namespace.

After the namespace and the URI, the next parameter is an array which
defines the verbs this route processes and what method should be
executed when the route is called with a specific verb. Each verb
represents a sub-array element in this array. The parts of the sub-array
are as follows.

#### methods

This takes a comma-delimited list of verbs that this array element
defines. The WP_REST_Server class defines several of these to make
coding easier.

However, developers are free to hard-code the values. In the above code,
WP\_ REST_Server::READABLE could easily be replaced with the string
'GET'.

Here is a list of the constants defined in WP_REST_Server.

+-------------------------------------+--------------------------------+
| > **CONSTANT**                      | **VERBS**                      |
+:====================================+:===============================+
| > **READABLE**                      | GET                            |
+-------------------------------------+--------------------------------+
| > **CREATABLE**                     | POST                           |
+-------------------------------------+--------------------------------+
| > **EDITABLE**                      | POST, PUT, PATCH               |
+-------------------------------------+--------------------------------+
| > **DELETABLE**                     | DELETE                         |
+-------------------------------------+--------------------------------+
| > **ALLMETHODS**                    | GET, POST, PUT, PATCH, DELETE  |
+-------------------------------------+--------------------------------+

#### callback

The callback is the actual code that is called when this endpoint is
called. In the READABLE endpoint example, the callback is a callable
that points to the method get_episodes(). Thus, a GET call to
https://example. com/wp-json/eicc/podcasts/v1/episodes makes a call to
the method get_episodes() and returns to the client whatever it
returned. In very simple endpoints, this can be an anonymous function
instead of a callable.

#### args

The final element in the array for this endpoint is a list of arguments.
args take an array of arrays that define the arguments which can be
passed into this endpoint after the ?. In many endpoint definitions,
these arguments are exactly the same. Instead of recreating the array
each time, the sample code passes in a callable get_arg_schema() which
returns the array. In a larger application with multiple endpoints, this
method could be defined as a trait, so it could be easily reused.

The sample code does not allow for searching episodes. Therefore, the
only arguments that are supported on collection endpoints are pagination
parameters, page number, and entities per page.

### CREATEABLE

The second verb defined for the collections endpoint is CREATABLE. The
parameters passed in are similar. However, in this case, there are no
arguments. This endpoint ignores any and all parameters passed in after
the ? on this endpoint. The other difference is that this endpoint
defined permission\_ callback. The READABLE endpoint is a public
endpoint. It is open to anyone who knows it. Conversely, it does not do
anything that can change the data, and it does not return any sensitive
data. The CREATEABLE version creates a new entity; therefore, before
calling it is allowed, the caller must authenticate. The system must
check to see that the caller is authorized to create entities.
permission_callback gives developers a callback that they can call,
which returns true or false. If it returns false, then the callback will
not be called, and the caller is returned the appropriate HTTP response
code.

public function can_create( \$request ) { return current_user_can(
'edit_posts' ); }

As can be seen, can_create, the permission_callback makes a single call
to the WordPress method current_user_can('edit_posts').

If the authenticated user is authorized to edit posts, then this call is
allowed. Otherwise, a 401 error is returned because they are not
authorized. Unstated, but still important, is that if the CREATEABLE
endpoint is called and no user has been authenticated, then obviously,
it fails.

In the case of the sample code, this means the CREATABLE endpoint has to
have the Bearer header passed in with it, or it will fail.

### EDITABLE

The collection endpoint is great for listing. However, there are times
when applications want all the information available on a single
episode. For this action, a route is declared that accepts a required
parameter of episode ID.

register_rest_route(

\$this-\>namespace,

\$this-\>uri . '/(?P\<episode_id\>\[\\d\]+)',

This is specified in the uri parameter. It is denoted by using regex to
specify that a parameter is to be passed in. In the case of the route
above, the parameter is named episode_id, and that variable contains the
digits that appear after the / in the URI until it hits a non-digit
character; this includes /.

The following is an example of requesting a single episode from the API.
https://example.com/wp-json/eicc/podcasts/v1/episodes/297 In this case,
episode_id would contain the value 297.

Since episode_id has now been specified, it must be defined so that
WordPress knows how to deal with it. This is done in the args array
element.

'args' =\> \[

'episode_id' =\> \[

'description' =\> esc_html\_ \_( 'Unique identifier for the episode.',
'wp_podcast_api' ), 'type' =\> 'integer',

'sanitize_callback' =\> \[ \$this, 'sanitize_int' \],

'required' =\> true,

\],

episode_id must always be an integer. While it is always important to
sanitize all inputs in the main body of code, here, at this first touch,
it can be sanitized early and properly deal with something other than an
integer being passed in. To do this, WordPress allows developers to
specify a sanitize\_ callback. In the case of the sample code, a class
method has been created, sanitize_int, that can be used by any method in
this class. It is simply called filter_var() and returns the value.

In some cases, developers want more complex validation of the passed in
parameters other than simple sanitation. This can be accomplished by
using the validate_callback parameter. sanitize_callback should only be
used to sanitize the parameter. validate_callback is used to make sure
the parameter is valid, however valid is defined. validate_callback
should return a Boolean describing whether the value passed in as the
parameter is valid.

validate_callback takes precedence over sanitize_callback. If both are
specified, but validate_callback returns false, sanitize\_ callback is
never called.

Additionally, it should be noted that these may not be necessary at all
for simple sanitize. Take a look at the sample code repository, and
notice the app permissions flow back through can_create(). In the case
of this application, can_edit is the only relevant permission. In most
cases, the permissions are more complex. Therefore, it is a good idea to
be in the habit of specifying can_create(), can_edit(), can_delete() for
all routes which deliver more than just publicly available.

### DELETABLE

The final array element passed into the register_rest_route() for the
route defined with an episode_id is for the DELETE verb. This allows
users with permission to actually delete a post identified by its
episode_id.

\[

'methods' =\> WP_REST_Server::DELETABLE,

'callback' =\> \[ \$this, 'delete_item' \],

'permission_callback' =\> \[ \$this, 'delete_item_permissions\_ check'
\],

'schema' =\> \[ \$this, 'get_item_schema' \],

'args' =\> \[

'episode_id' =\> \[

'description' =\> esc_html\_ \_( 'Unique identifier for the episode.',
'wp_podcast_api' ), 'type' =\> 'integer',

'sanitize_callback' =\> \[ \$this, 'sanitize_int' \],

'required' =\> true,

\],

\],

\],

This is the same as the previous definitions, however, the methods
element is DELETABLE. Defining this allows the sample API to be used to
remove episodes from our podcast.

Now it is time to examine some concepts introduced in the code above.

## Callbacks

The main work of an endpoint is done in the callback. When defining the
route, callback is defined as any callable. This can be a function name
if the code is not object-oriented, a PHP callable specifying the object
and method to be called or an anonymous function. If your code is
simple, it is acceptable to include an anonymous function as the
callback, validate_callback, or sanitize_callback. This, however, is
usually the exception, not the rule. In most cases, using an anonymous
function as one of the callbacks makes the route definition more
difficult to read with no significant upside.

In the case of the DELETE endpoint defined above, the main callback is
this:

'callback' =\> \[ \$this, 'delete_item' \],

This is standard PHP notation for executing the method delete_episode on
the object \$this. The same format can be seen in the args section when
the sanitize_callback argument is defined.

When this route is called with the DELETE verb, and all validations
pass, then \$this-\>delete_item() is called.

## Permissions

Like an iceberg, the public surface of an API---the part available
without having to authenticate---is usually very small compared to the
part that is available to those who have authenticated. To control what
parts of an API require authentication and authorization, the WordPress
REST API gives developers the ability to define permission_callback for
each endpoint.

'permission_callback' =\> \[ \$this, 'can_delete' \],

As described in the Callbacks section, the value assigned to
permission\_ callback can be any valid PHP callable that returns a
Boolean. In the sample code, each endpoint has its own method that is
called. In theory, developers may want to require different permissions
or roles for different actions. Practically, in the sample code, only
one permission is required for all actions, edit_posts. All of the
permission callbacks in the sample code call can_create. can\_ create
relies on the WordPress internal function current_user_can() and returns
true or false depending on whether the user who was granted the token
has edit_posts permission.

public function can_create( \$request ) : bool { return
current_user_can( 'edit_posts' );

}

current_user_can() returns false automatically if there is no user
logged in. If a user logged in, it returns whether the user has the
permission specified. This one call handles both authentication checks
and authorization checks. In more complex code, developers may want
additional checks, and this is fine. The only requirement is that
whatever is called in permission\_ callback returns a Boolean.

A\> If a callable is called by permission_callback and returns a
nonBoolean return value, PHP will coerce it into a Boolean using its
normal rules for coercion. Thus, any non-empty/non-false value will be
considered a positive result. This can have disastrous results if
developers are not careful. Returning the literal string, "You do not
have permission to do this," is considered a positive value. For this
reason, it is strongly recommended that API code have type hints and
that strict typing is turned on.

## Arguments

As seen in the example code above, when defining routes, a major
consideration is the arguments that the endpoint supports. Arguments
passed to an API can take two forms. The first and most common form is
what developers normally refer to as the "query string" part of a URI;
anything past the ?. An ampersand delimits these key=value pairs. Each
key=value pair is considered an argument that is passed into the
endpoint.

https://example.com/wp-json/eicc/sample/v1/explore/
request?cal=evans&kathy=evans

In the URL above, there are two arguments, cal and kathy. Each of the
arguments have the same value, evans. The WordPress REST API does not
require the arguments to be defined for them to be used. If, however,
they are defined, they appear in the schema and thus allow other
developers to understand what the endpoint expects to operate properly.

The other form that arguments can take are in-line in the route itself.
These are defined as regex. The snippet below is an example of such an
argument. Notice that the argument name episode_id is defined in the
regex.

\$this-\>uri . '/(?P\<episode_id\>\[\\d\]+)',

To define accepted arguments, developers create an array element named
args at the same level as method or callback. Here is the example used
above for the DELETE endpoint.

\[

'methods' =\> WP_REST_Server::DELETABLE,

'callback' =\> \[ \$this, 'delete_episode' \],

'permission_callback'=\> \[ \$this, 'can_delete' \],

'args' =\> \[ 'episode_id' =\> \[

'description' =\> esc_html\_ \_( 'Unique identifier for the episode.',
'wp_podcast_api' ),

'type' =\> 'integer',

'sanitize_callback'=\> \[ \$this, 'sanitize_int' \],

'required' =\> true,

\],

\],

\],

Even though the argument is defined in the route, it still needs to be
listed in the arguments section of the route definition so that metadata
can be defined and, when necessary, constraints can be placed on the
argument.

Six properties can be defined for any given argument.

1.  **description** - Developers can define a description that will be
    returned as part of the schema. The metadata's sole purpose is to
    let other developers know what this argument is and for what it is
    used.

2.  **default** - Using the default property, developers can define the
    default value for a property should the property not be passed in.

3.  **required** - If required is set to true, then the endpoint fails
    with an error code 400. NOTE: If required is true and *8default*\*
    has a valid value, then required is ignored since the system picks
    up the default value. In most cases, developers will not want to set
    a default value for arguments that are required.

4.  **validate_callback** - A callable can be set as the
    validate_callback for an argument. Whatever method or anonymous
    function defined as the validate_callback should return a Boolean.
    If the validate_callback returns false, then the endpoint fails with
    an error code 400. This is used to validate that the value is within
    acceptable parameters. If all it is used for is to validate a type,
    the type below is a better way to do that.

5.  **type** - The proper way to validate the type of the value is to
    specify the type property. It is important to note that if type is
    specified, that default if specified, must be of the same type.
    Specifying a type and a default that do not match causes the
    endpoint to fail with an error code 400, even if the value passed in
    matches the proper type. While it is possible to use the type
    property for any parameter, it is highly suggested that developers
    not define type but rather check the type in the validate_callback
    method. This is the defined and documented way to making sure the
    argument passed in is proper.

6.  **sanitize_callback** - Similar to validate_callback,
    sanitize_callback can be defined as any callable. Unlike
    validate_callback, though sanitize_callback returns a value, one
    that, if type is specified, matches type. sanitize_callback is the
    proper place to enforce constraints on the value being passed in.
    For example, if the argument requires a string less than 20
    characters in length, then sanitize_callback can return the first 20
    characters of the value. In most cases, either validate_callback or
    sanitize_callback is defined. The WordPress REST API allows both to
    be defined, but validate_callback is called first. If it fails, then
    sanitize_callback is never called.

Arguments can be passed into the endpoint without them being defined in
the args section of the definition of the route. It is, however,
considered a best practice to define them, so the definitions appear in
the schema, and the intention of the endpoint is clear.

## Context

One more thing needs to be discussed when talking about endpoints. This
is a WordPress specific issue. When requesting READABLE or EDITABLE
endpoints, WordPress defaults to a "context" of view. There are three
default defined contexts, edit, view, and embed. Developers are free to
create their own contexts in code as well.

Defining context will be discussed in the schema section of the book.
For now, all that needs to be understood is that the default is view.
view returns publicly available information. When a developer wants all
the information that can be edited, they can specify ?context=edit on
the URI. This returns all of the properties of an entity that are in the
edit context.

Unless the application already has the complete schema for the API being
called, the application needs to call the API with a context of edit
before calling a PATCH to send back edits.

Returning the edit context requires authentication, whereas view and
embed do not.

# Schemas

![](media/image5.jpg){width="5.803334426946631in"
height="3.1466666666666665in"}An API's schema is like a database's
structure. The metadata describes what can and can't be sent to the API
and what can be expected back. In the WordPress REST API, the schema is
defined using the [**JSON Schema**](http://json-schema.org/)
specification. While it is unnecessary to understand the JSON Schema
specification to use a WordPress REST API endpoint, understanding it
helps to better understand how to create a schema for a new endpoint
properly.

Defining a schema is optional in the WordPress REST API. However, it is
a good idea to do. Since many routes return the exact same schema,
defining a function that returns the array is usually the most effective
way to define a schema for the WordPress REST API.

Defining a schema for a route allows clients to request it, usually via
an OPTIONS request. The schema returned is then used by the client
software to understand, validate, and/or describe the payload that the
route returns.

## Defining a Schema

While the JSON Schema specification can be used to describe complex
entities, the schema for the example code is very basic. It does not
list any fields as required, nor does it add any other constraints to
any fields. Our schema simply describes the universe of possible return
entities.

Where appropriate, constraints help client software understand what is
supposed to be returned and how to display it properly.

The first section of the example schema is the preamble. In it is
described the schema document itself.

'\$schema' =\> 'http://json-schema.org/draft-04/schema#',

'title' =\> self::ENTITY,

'type' =\> 'object',

-   \$schema gives the version number of the official schema for the
    draft of the standard that applies to this schema. For obvious
    reasons, make sure single quotes surround this key as the dollar
    sign (\$) is a required part of the key.

-   title is a descriptive title of this schema document.

-   type is the first constraint of this schema document. It tells the
    client that this schema is defined as an object. In the sample code,
    this is the only constraint in the document.

Since the document is defined as the type object, the next element is
properties. These are the properties of the object and the elements of
our schema. For brevity, the entire sample schema is not listed. Readers
are encouraged to check out the code repository for this book and
examine the entire schema, and the payload returned from an endpoint to
see the correlations.

The following is an element from the sample code's schema.

'episode_id' =\> \[

'description' =\> esc_html\_ \_(

'Unique identifier for the episode.',

'wp_podcast_api'

),

'type' =\> 'integer',

\]

In this case, episode_id is being described. The only two properties
defined for episode_id are description and type. With only these two
pieces of information, the client software now has a description to use
for display and understands how to properly format the results because
the results are defined as an integer. The description is also passed
through the WordPress Translation and escape method esc_html\_ \_ , so
the results are localized if translation files are provided.

Schemas help clients build displays that are responsive to the items
being returned. In the source of the sample code, the episode_id should
be required as it is necessary for the proper function of the API. Any
entity returned without an episode_id is in all probability not a
podcast episode, but a return WordPress post. The fact that the API
returned something without an episode_id should be of concern and should
not be possible. However, if episode_id is for some reason absent from
the entity, if it were a required field, the client would understand
that this is an invalid payload and react accordingly instead of trying
to display it.

## Displaying the Schema

Once the schema is defined, clients need a way to retrieve it. In most
REST APIs, the schema, if defined, can be returned for a given route by
calling the route with the OPTIONS verb.

curl -X OPTIONS https://example.com/wp-json/eicc/podcasts/v1/ episodes/1

The cURL command above does not return an episode. Instead, it returns
the schema. Since the schema is versioned like the API itself, if the
schema changes, then the version number will need to change. This allows
clients to cache the schema and not request it on every interaction,
thus reducing the load on the server.

In addition to the above method of retrieving the schema, the JSON
Schema specification defines, but does not require, an additional
endpoint. curl
https://example.com/wp-json/eicc/podcasts/v1/episodes/schema

register_rest_route(

\$this-\>namespace,

\$this-\>uri . '/schema',

\[

\[

'methods' =\> WP_REST_Server::READABLE,

'callback' =\> \[\$this, 'get_schema'\],

\]

\]

);

Now the API follows expected norms and allows clients to discover
schemas in a standard and understood way.

Schemas are not for the API developer; they are for the API client
developer and software. They are an optional part of any API, but if
present, allow the client to abstract away many of the details of
display and validation. This makes client programming easier and more
responsive to problems.

## Context Revisited

As discussed previously, the WordPress REST API allows developers to
define contexts. There are three contexts defined by default: edit,
view, and embed. In a nutshell, context defines the visibility scope for
a given attribute in an entity. edit returns everything because it
assumes that the client is going to be editing the record. view returns
only the attributes that are necessary to present the entity to the
user.

embed is a special case. It is not the WordPress version of
**[oEmbed](https://oembed.com/).** Instead, the embed context forced
WordPress to make additional subqueries to resolve related entities. The
URLs to these entities are placed in the \_embed array in the response
instead of just links to them in the \_links array. Because this can
dramatically increase overall payload size, the embed context defines a
small subset of attributes to return. For example, if the context
requested is view then the content attribute of a post entity is
returned. However, if the context is embed, then excerpt is returned in
the main entity and any related entities to reduce the size of the
overall payload.

-   The view context is assumed if context is not specified, and the
    HTTP verb is GET.

-   WordPress overrides a specified context with edit if the HTTP verb
    is POST or PUT.

-   embed embeds the related objects instead of just providing links,
    but it returns an abbreviated subset of the available attributes.

There is nothing magical about view or edit contexts; they simply define
the attributes that will be returned. Developers are free to create
their own contexts. The sample code creates a context of episode that
only returns a subset of the data necessary to display a given episode
on any client device.

# Requests

![](media/image6.jpg){width="5.803334426946631in"
height="3.1466666666666665in"}The basic point of any API is accepting a
well-formed request and returning an expected response. Throughout the
very short history of API design, different groups have tried various
tactics to achieve the standard and expected part of that statement. For
the past few years, REST has been the defacto standard for building APIs
for web applications. Additionally, JSON has broken through as the
preferred encoding protocol. That is not to say that XML, the other
primary encoding protocol, is not a solid tool; it's just that many
developers---especially web developers---seem to have gravitated towards
JSON.

Since the first part of the equation is the request, this chapter
examines the
[**WP_REST_Request**](https://developer.wordpress.org/reference/classes/wp_rest_request/)
object. This is the container that WordPress translates the incoming
request into internally. The Request object encapsulates everything the
system knows about the incoming request. The GET parameters passed in,
if any, the POST payload if any, and the headers passed in by the client
are the most common things developers access from the request object.

The WP_REST_Request object is created automatically by the WP\_
REST_Server object when a request comes into a registered endpoint. This
class is primarily a data structure which standardizes the request, so
the rest of the system knows what to expect and how to access the data
it contains.

The WP_REST_Request class is not
[**PSR-7**](https://www.php-fig.org/psr/psr-7/) compliant. It does,
however, implement the ArrayAccess interface and thus can be used any
place an ArrayAccess can be used.

WP_REST_Request gives developers several methods to help extract the
data out of the request. The most commonly used are get_headers() and
get_params()

## get_param()

get_params() and its companion get_param() allow developers to access
the arguments passed in via the request, regardless of how they were
passed in. Under the hood, the WordPress REST API looks for a parameter
in several places in a specific order. Developers can access the order
via the method get_parameter_order(). get_parameter_order() returns an
array describing the places the WordPress REST API checks for a
parameter and in what order.

In the case of a call to the wp_rest_explorer /request endpoint, if
called with a GET, the array returned looks like this one.

\[get_parameter_order\] =\> \[

1.  =\> GET

2.  =\> URL

3.  =\> defaults

\]

If the same endpoint is called with a POST, the return of
get_parameter\_ order() looks like this one.

\[get_parameter_order\] =\> \[

\[0\] =\> JSON \[1\] =\> POST

2.  =\> GET

3.  =\> URL

4.  =\> defaults

\]

This shows that the order is dynamic and changes based on the
circumstances. The results of a call to get_parameter_order() are
generally not important to developers. What it represents, however, is
important to developers. It tells us the order in which the different
sources of a potential parameter are searched. The same parameter can be
specified in different places. It is possible to set the same parameter
in both a form and on the URL. This array tells developers which one
WordPress selects. WordPress searches each of the specified sources
until it finds the first one with the parameter requested and then stops
looking and returns the value found. In the case described above, where
the same parameter is passed in both as a form element, and on the URL
WordPress chooses the one coming from the form and ignores the one
coming from the URL.

At the bottom of each of the responses above are the element defaults.
Defaults means the last thing checked when a call to
get_parameter('cal') is made is the defaults specified in the schema.
Since WordPress stops looking as soon as it finds a hit in any of the
other places, the only way a default is used is if the parameter
requested is not passed in at all.

A\> As discussed in the previous chapter, if a parameter is required and
has a default, then the required parameter is ignored because it always
has a value. get_params() returns an array of all the parameters passed
in or that have defaults specified in the schema using the rules
described above.

## get_headers()

The other popular method in the WP_REST_Request object is the get\_
headers(). get_headers() delivers precisely what you would expect, an
array of the headers that came in with the request. This gives
developers the complete list of headers that are submitted, so they can
use them to make decisions. It is important to note that the header name
is the key to this array and that all header names are converted to
lowercase.

get_header() allows a developer to retrieve a single header instead of
the entire collection. Regardless of the header name you pass in, it is
converted to lowercase before any processing is done.

Should you need your results as an array, get_header_as_array() returns
you a single header wrapped in an array. Do not confuse this with all of
the values of the header being returned as separate elements in an
array. This returns a single string with all the values in that string.

For instance, it is acceptable to specify multiple values of the Accept
header. However, if you specify application/json and text/html in your
Accept header then calling get_header_as_array('accept') returns the
following:

\[

\[0\] =\> application/json, text/html

\]

get_header('accept') returns the following application/json, text/html

As you can see, in both cases, you get a comma-delimited list of the
acceptable content types; in the former, however, it is wrapped in an
array.

## Other Important Methods

The WP_REST_Request object gives developers many more tools to work
with, but those are the ones that are most frequently used. Developers
can view the entire list of methods in the WP_REST_Request object by
visiting its page,
[**WP_REST_Request.**](https://developer.wordpress.org/reference/classes/wp_rest_request/)
Some are more useful than others. Outside of the ones described above,
here are four more that developers need to be familiar with.

### get_body()

The body of a request can contain many different things. However, when
talking to an API, the body usually contains parameters that are useful
to the API in fulfilling the request. In the case of the example
application, the overall point of the API is to manage WordPress posts
that have been tagged with a podcast episode_id. In this example, the
body of POST and PATCH contain a JSON encoded payload. The WordPress
REST API automatically decodes these and makes them parameters that can
be accessed using the methods described above. The raw, encoded JSON is
still intact should it be needed. To access the raw body, the
WP_REST_Request object gives us the get_body() method. If the body of
the post was a JSON encoded payload, then this method returns the
raw---still encoded---payload for developers to use as they wish.

### get_body_params()

If an endpoint is called with a POST, and the body contains the input
from a form, and the Content-Type header to application/x-www-form-

urlencoded header is set, then this returns a list of the form fields
and values. This is almost always the contents of the \$\_POST
superglobal. Things can be added to the list of body parameters via the
set_body_params() method, so it cannot be said that it is a mirror of
\$\_POST.

### get_file_params()

An API often allows the client to upload a file of some type for storage
or processing. In PHP, the process for doing this has been a well-known
pattern for many years. The WordPress REST API makes it easy for
developers to accept files from clients using the get_file_params()
method. The get\_ file_params() returns to you the parameters you would
normally find in the \$\_FILES superglobal.

\[test_file_txt\] =\> \[

\[name\] =\> test_file.txt

\[type\] =\> text/plain

\[tmp_name\] =\> /tmp/phpglCv8i

\[error\] =\> 0

\[size\] =\> 567

\]

The above payload is what is returned when a file named test_file.txt is
uploaded to an endpoint. At this point, a developer has everything they
need to move the file into place for processing and then process the
file.

### get_method()

There may be times when multiple endpoints call the same method in the
controller. In these cases, it is helpful to know the HTTP verb that was
used. (Remember, the verb is one half of the endpoint; the route is the
other.) get\_ method() tells you which HTTP verb was used in making the
call. This allows developers to branch similar code based on the verb
used.

## ArrayAccess

As noted in the opening of this chapter, the WP_REST_Request class
implements the
[**ArrayAccess**](https://www.php.net/manual/en/class.arrayaccess.php)
interface. This means parameters that have been passed in or set with
defaults in the schema can be accessed as array elements.

https://example.com/wp-json/eiccc/sample/v1/explore/ request?kathy=evans

\$payload\['kathy'\] = \$request\['kathy'\];

The above would access the parameter kathy passed in on the URL.

\$payload\['cal'\] = \$request\['cal'\];

Assuming that in the schema definition, the argument cal was defined
with a default value, the above code would return the default value
because it was not passed in.

Array access to the WP_REST_Request is syntactical sugar. Developers can
get the same access by using \$request-\>get_param('kathy');. Because
the Iterable interface was not implemented, the WP_REST_Request object
cannot be used in foreach loops or any place an Iterable can be used.

# Responses

![](media/image7.jpg){width="5.803334426946631in"
height="3.1466666666666665in"}The previous chapter discussed how clients
make requests to the WordPress REST API and the tools developers have
for accessing those requests to write code to fulfill them. That is one
half of the equation; the other half is how responses are returned to
the client. This chapter focuses on the [**WP_REST\_**
**Response**](https://developer.wordpress.org/reference/classes/wp_rest_response/)**.**

The WP_REST_Response is the internal object WordPress creates, passes
around, and eventually uses to emit the appropriate response back to the
client software. Like the WP_REST_Request, it contains all the data
necessary to emit the response and several important helper methods for
developers to manipulate the response.

Like most of the WordPress API, WP_REST_Response is designed to be
extensionable. Data can be added; functionality can be added; it can
even be subclassed to create entirely new classes that operate in new
ways. However, the WordPress REST API Handbook cautions against removing
existing data from the WP_REST_Response. Removing data can potentially
break other parts of the system, like plugins relying on all data being
present.

The sample application is simple and does not attempt to modify the WP\_

REST_Response. It adds, updates, or deletes an existing WordPress Post
Type and manipulates metadata associated with that post. Much more
complex scenarios are available to developers, including custom post
types. Since the bulk of the work is done as basic CRUD, the sample
application overrides the standard WP_REST_Server method of
prepare_item_for\_ response() to build the needed WP_REST_Response.

\$response = \$this-\>prepare_item_for_response( \$new_post, \$request
);

In the sample application, every request, POST, GET, and DELETE all
return a post. Even DELETE returns the Post that was deleted. Therefore,
prepare\_ item_for_response() the Post, converts it to an array and then
hands that array to the WordPress function rest_ensure_response. rest\_
ensure_response returns a WP_REST_Response object ready to finalize with
any additional data and hand it back to the calling client software.

A\> Author's Note: Having written several WordPress REST endpoints which
accomplish a wide variety of tasks, I can say that for the majority of
tasks that will be accomplished with the WordPress REST API, there
should be very little need to do more than create the desired output as
an array and then call rest_ensure_response.

There are, however, a few helper methods that are important in some
tasks.

## Headers

WP_REST_Response allows developers to manipulate the headers being
returned with several methods.

### header()

Here is an example header:

Content-Type: application/json

The simplest way to set a single header is with the header() method.
header() takes three parameters:

-   key - This is the name of the header. Given the example above, the
    key would be 'Content-Type'. (Note the absence of the ':')

-   value - This is the value of the header being set. Given our
    example, the value would be 'application/json'.

-   replace - This tells WordPress whether to replace the existing value
    of this header if it exists. This defaults to false. If it is false,
    and the header already exists, the new value is appended to the
    existing value along with a comma. Thus, the result is one header
    key with a comma-delimited list of values.

*For example:*

\$response-\>header('Accept','text/html');

\$response-\>header('Accept','text/text');

The header, when emitted to the client, would be set as:

Accept: text/html, text/text

If replace is set to true, on the second call to header() above, then
the header would be emitted as:

Accept: text/text

In addition to setting a single header at a time, WP_REST_Response also
gives the method set_headers(). set_headers() takes as its one parameter
an array of headers. set_headers() replaces the entire headers array of
the response with the array passed in without validation.

\$headers = \[

'Accept' =\> 'text/html, text/text',

'Content-Type' =\> 'application/json'

\];

\$response-\>set_headers( \$headers );

Finally, WP_REST_Response has get_headers() which returns the entire
array of headers set for this response. This is very useful when using
set_headers() because it gives, as a starting point, the current list of
headers. Developers can then manipulate this array directly and then set
it with set_headers().

## Status

One of the most important---and potentially the most misused pieces of
information any API response can serve up is the [**HTTP
status**](https://en.wikipedia.org/wiki/List_of_HTTP_status_codes) code.
Architecting an API or even building out a simple endpoint means you
need to understand what codes are available and what they mean.

A\>The most important thing you need to know about HTTP status codes: No
matter the situation, if your API is returning an error code, do not
return a status code of 200. Too many API developers return a status 200
with a payload that gives an error. A status code of 200 means that
everything went well, not that the client successfully communicated with
the server.

Here are the most common status codes you need to know. This is not an
exhaustive list---just the most common ones.

-   **200 OK:** Everything is OKAY. Whatever you were trying to do
    worked. This is most common on GET requests.

-   **201 Created:** This is the proper response for a successful POST.
    Usually, the payload also contains more information about the entity
    created. In the case of the WordPress REST API, the entity (Post,
    Page, Custom Post Type, etc.) created is returned in its entirety.

-   **204 No Content:** Outside of WordPress, this is the most common
    response to a DELETE. However, WordPress returns the deleted entity,
    so a 204 is not appropriate. In that case, a 200 is appropriate.

-   **400 Bad Request:** This tells the client you cannot fulfill their
    request because they did not send you the proper information. If
    required properties are missing from the request, a 400 is the
    proper status to return.

-   **401 Unauthorized:** This is the proper response to return when
    someone tries to access an endpoint, and they do not offer the
    proper credentials.

-   **403 Forbidden:** This is similar to a 401 in that something was
    requested, and the proper credentials were not offered. This is also
    appropriate if an attempt to access a route is made with an improper
    verb. For example, if a user attempted to access a route with DELETE
    when DELETE is not supported. In this case, a 403 would be
    appropriate.

These are by far the most common status codes that API endpoints return.
It's advisable that all developers working on an API be familiar with
the list of status code so that when the need arises, the proper code
can be returned as part of a response.

## Wrap Up

The response from your API endpoint lets the client software know what
happened. By its headers, it can also let them know what kind of payload
has been returned, so they can respond accordingly. An API response is
not an afterthought! Care must be taken to return the proper status code
and payload; it is also incumbent on the developer to honor any headers
that came in from the request. If the client software only gave you the
'Accept: application/json' header, don't return plain text or HTML.
Craft the response carefully, so the client software can not only
consume your response but display it properly to the end-user.

**Sample Plugin:**

# wp_podcast_api

![](media/image8.jpg){width="5.803334426946631in"
height="3.1466666666666665in"}Now that the groundwork has been laid, the
sample application should start to make sense. Now it's time to bring
all the pieces together and see how they work as a unit.

This WordPress REST API endpoint allows the user to manipulate WordPress
posts via a piece of information stored in a meta key episode_id. Each
post with an episode_id is considered a podcast episode. The endpoint
does not assume that all posts are episodes, just the ones containing
the episode\_ id.

This endpoint is actually production code. It is used at **[Voices of
the ElePHPant](https://voicesoftheelephpant.com/).**

Pointing a browser that can properly display JSON (Firefox) at
[**https://**
**voicesoftheelephpant.com/wp-json/eicc/podcasts/v1**](https://voicesoftheelephpant.com/wp-json/eicc/podcasts/v1)
shows the schema discussed in Chapter 4.

## Design Decisions

Several design decisions were made before work began on the controller.

### Custom Post Types

The biggest of these decisions was whether to create a custom post type
for episodes. Much thought was given to this question, but in the end,
the value added by an episode's post type did not outweigh the work it
would take to create and maintain it. In short, it was more work than it
was worth. Therefore, this sample application works on standard
WordPress post types but with several meta fields added to them.

### WP_REST_Controller Versus a Custom Class

Another design decision was to subclass the WP_REST_Controller class and
override its methods instead of building a controller from scratch. This
decision was largely based on the code being used as reference code for
others. Once a developer has at least one properly working controller
under their belt, they are strongly encouraged to experiment by creating
a controller from scratch. Doing so gives the developer much more
freedom in method names so that the resulting code reads more naturally
given the problem-space.

By way of example, because the sample code subclassed WP_REST\_
Controller, many of the methods end in \_item. Given that the
problemspace was dealing with podcast episodes, it would have been
easier to read had the methods been named ending in \_episode. In a
custom controller, a developer is under no such constraints and can name
methods any way they like.

### Authentication and Authorization

The other major design decision was how to handle security. As discussed
in **["Using the WordPress REST
API,"](https://www.siteground.com/wordpress-rest-api-guide)** WordPress
ships natively with only basic HTTP authentication built-in. Thankfully,
there are a couple of plugins in the marketplace that fill this niche.
The sample code does not dictate how authentication and authorization
are done, just that they be done because certain endpoints are only
accessible with an authenticated user. If installed from the repo and
spun up with Lando, the **[JWT Auth -- WordPress JSON
Web](https://wordpress.org/plugins/jwt-auth/) [Token
Authentication](https://wordpress.org/plugins/jwt-auth/)** is installed
and configured. The client software that uses this endpoint in
production expects it to be installed.

There are other JWT plugins in the WordPress Plugin repository. The one
chosen seemed to be the most complete that was under active development.
For the sample application, though, how a user is authenticated is
irrelevant. All that is relevant is that a user can be authenticated.

## The Code

The rest of this chapter is a high-level tear-down of the code in the
plugin. Not all of the code is examined, but all of the methods and how
they interact are discussed. Seasoned developers can glean most of this
from reading the code in question. This chapter serves to explain some
of the why in addition to the how.

### The Controller

There are only two parts to the sample plugin, the controller and the
main plugin file. This tear-down only focuses on the controller as the
bulk of the interesting code in there.

### Constants

The very first thing in the controller is the addition of four class
constants. These are used not only in building the URI but also in
building the base name for all the meta keys. Defining these as
constants makes them easy to access and change in the future.

const VENDOR = 'eicc'; const PACKAGE = 'podcasts'; const ENTITY =
'episodes'; const VERSION = 1;

A\> I've now developed several controllers for different namespaces,
each containing many endpoints. This convention of putting this
information as class constants has served well as a pattern.

These constants are only used in the sample code in the \_\_construct()
method.

### \_\_construct()

WP_REST_Controller does not have a \_\_construct() method, so there is
no need to call the parent method. Instead, we use the \_\_construct()
to build the uri property and the meta_key_base property.

### register_routes()

register_routes() is a method in the WP_REST_Controller class that we
are overriding. Given the name, it is self-explanatory. In Chapter 3, we
discussed the pieces that go into this method and how they are called.
The order of definition of the routes is not relevant. By convention,
they are usually defined from widest to narrowest in descending order.
*For example:*

-   /episodes

-   /episodes/1234

If there are multiple groups of endpoints in the controller---for
example, episodes and seasons---then again, by convention, these are
grouped together when defining them. At the bottom of the method are the
ancillary endpoints like /schema.

A\> While it is possible to build controllers containing multiple groups
of endpoints that is a design decision that has to be defended in code
reviews. For the most part, the acceptable practice is that each
grouping gets its own controller. It is perfectly fine to have multiple
controllers inside the same plugin.

### prepare_item_for_response()

prepare_item_for_response() exists in WP_REST_Controller but has to be
overridden as the original is a placeholder; if not overridden, it
throws a WP_Error reminding the developer to override it.

This method contains everything necessary to prepare a WP_HTTP\_
Response and then calls the method rest_ensure_response(), which creates
and returns the WP_HTTP_Response.

### get_items()

With get_items(), we get into the meat of the actual controller. These
are the methods that actually manipulate the request. All of the
\_item(s) methods are defined in the original WP_REST_Controller class.
As with most of the methods in that abstract class, there is code in the
method. However, if a developer subclasses WP_REST_Controller and does
not override these methods, they return a WP_Error stating that it must
be overridden.

public function get_items( \$request ) {

return new WP_Error( 'invalid-method',

sprintf( \_ \_( "Method '%s' not implemented.

Must be overridden in subclass." ), \_ \_METHOD\_ \_ ),

array( 'status' =\> 405 )

);

}

get_items() is called when the most basic route is called with a GET.
/eicc/

podcast/v1/episodes calls get_items() and returns the collection of
episodes to the calling client. It pulls a collection of episodes into
an array, creates a WP_REST_Response from it, and then returns the
response. The episodes returned depend on the pagination parameters
passed in. Without any, it defaults to the last 10 episodes.

### get_item()

Similarly, get_item() returns a single episode. The request passed in
must contain an episode ID. Thus, calling the route /eicc/podcast/v1/
episodes/347 with a GET verb, where 347 is the episode ID, triggers this
method.

Like most public methods in this controller, it returns either a
WP_REST\_ Response if it finds the episode or a WP_Error if it can't. If
it can't, it sets the status of the WP_Error to 404 to indicate to the
client software that the episode could not be found.

### create_item()

create_item() is called when the basic route is called with a POST
instead of a GET. It expects the body of the request to be a JSON
formatted payload containing, at the very least, the required fields for
creating a WordPress post. This does all the processing necessary not
only to create a WordPress POST, but it adds in the metadata needed to
identify it as a podcast episode. After it saves the post, it has to
juggle things a little and manually remove the \_encloseme record from
the database. If this doesn't happen, when WordPress reads the post the
first time, it notices that the enclosure does not contain a URL to the
media and deletes the enclosure record. Manually deleting the
\_encloseme record keeps this code from triggering.

### \*\_item_permissions_check()

All the actions that can either manipulate data or return data that is
not normally available publicly have a \*\_item_permissions_check()
method. For example, create_item_permissions_check(). In this simple
example, create_item_permissions_check() and
create_item_permissions_check() call the WordPress method
current_user_can( 'edit_posts' ). It is good to remember that any method
called with an Authorization header is executed within the context of a
logged-in user. Therefore, all the rights and privileges of that user
are available to the API code.

### prepare_item_for_database()

There is a big difference in a payload that comes in from the web and
what WordPress expects when it is writing data to the database.
prepare\_ item_for_database() bridges those two worlds. This is a method
that is in the abstract class and throws an error if called but not
overridden. If you are following the WordPress way, you will use this to
convert a WP_REST\_ Request into something that can be written to the
database.

In the case of the sample code, a StdClass is instantiated and populated
with the fields from the WP_REST_Request that need to be written to the
database. This is eventually handed to wp_insert_post() or wp\_
update_post().

Each version of this method is slightly different. The concepts are the
same as the sample code, but the individual properties, metadata, and
processing are different.

### update_item()

Like create_item(), update_item() takes the incoming payload and
prepares it for the database. Unlike create_item(), update_item()
requires that an episode_id be passed in as one of the parameters. It is
only called when either PATCH or PUT are used as the verb. WordPress
breaks from the REST specification here in that PUT should require the
entire entity to be part of the payload, whereas PATCH accepts a partial
entity and only updates the fields sent in. WordPress (like the vast
majority of REST APIs these days) does not distinguish between these two
verbs. In our case, either of them triggers update_item().

update_item() converts the passed in episode_id into a post_id and then
pushes the new data to the database via a call to wp_update\_ post().
Upon success, it returns a 200. If the episode_id cannot be found, it
returns a WP_Error with the status of 404, appropriate for not being
able to find the entity being modified. Any other errors return a 500
status code to let the client software know that something went wrong.

### delete_item()

This method is called when the route containing an episode ID is called
with a DELETE verb. Assuming authorization passes, and the episode
exists, it is deleted from the database. As is practice with WordPress
endpoints, upon successful deletion, the deleted post is returned to the
client as the payload along with a status code of 200.

There are a few other methods in the main class that are left to the
reader to explore. Most of them have already been discussed elsewhere in
the book, so there is no need to rehash them.

## Wrap Up

There is always more than one way to accomplish a task. The code
described in this chapter follows the WordPress current practices on how
to build a REST API Controller. In the next chapter, a different
approach will be discussed. Neither is considered the best way, only
different possible ways.

So far, the sample code has demonstrated the "WordPress way" for
creating custom REST controllers. There is nothing wrong with
subclassing the abstract

# Custom Controllers

class WP_Rest_Controller to create a new controller. It is, however, not
the only way to do this.

![](media/image9.jpg){width="5.803334426946631in"
height="3.1466666666666665in"}Developers have the option of creating a
custom class or class hierarchy for REST controllers. Simple controllers
can be created that only contain the methods necessary.

Another sample WordPress REST project uses WordPress as the user and
media controller for a series of distributed monitors that display
advertisements. Each monitor has a different schedule for pulling new
images; this would be a REST endpoint. This endpoint would not need all
the support methods included in WP_Rest_Controller because of its simple
nature. Therefore, it would be much better, in this case, to define a
custom class outside of the WP\_ REST\_\* hierarchy.

Another benefit of creating custom classes instead of subclassing
WP_Rest\_ Controller is that it gives developers the ability to use
problemspace vocabulary. As discussed in Chapter 7, subclassing
WP_Rest_Controller means each endpoint is named with \_item. For a
generic controller, this is good; however, in our sample code, had the
controller been written as a custom controller instead of a subclass of
WP_Rest_Controller, all methods would have used \_episode. In the sample
advertising system described above, endpoints could have ended with
\_ad. This might seem to be a minor point, but using the problemspace
vocabulary in your code allows for a more natural reading of the code
and helps new developers step into the project more easily.

As with most things in software development, there is no one "correct"
answer. The answer to the question "Should I subclass WP_Rest_Controller
or create a custom controller?" is almost always, "It depends."
Developers should let the problem unfold mentally before attempting to
make this critical design decision.

# Conclusion

This book has introduced the concepts necessary to craft a custom
WordPress REST API endpoint. Readers should now be ready to begin
thinking through the process and developing the software necessary. What
this book has not focused on is the why. Why should a developer use the
WordPress REST API? The obvious answer is that they already have a
WordPress install and need to extend it in new ways or solve new
business problems. This is where most developers begin their journey
with WordPress and REST. There is, however, so much more out there to be
considered.

WordPress has evolved over the years into a solid framework for
application development. One that is useful not just for people who
don't want to write code but want to install plugins. One that is useful
for developers who have an idea but don't want to get bogged down in
details like a fully vetted user management system.

Out of the box, WordPress provides:

-   User management

-   Media management

-   Database storage

It is possible to build entire applications on top of WordPress that
have nothing to do with blogging or ecommerce. The only limits present
are the imagination of the developer. If WordPress by itself can do all
of this, then how much more can be accomplished by adding a few
well-crafted REST API endpoints? Suddenly, you have expanded your
potential audience from all users on the internet to all things
connected to the internet. New data can be brought in, processed,
aggregated, analyzed, and then presented in whole new forms. All of this
without building pages and themes, but endpoints that return JSON or XML
so other developers can build even more on the top.

WordPress itself is a powerful tool. WordPress, with the addition of
REST, is exponentially more powerful. Developers who understand how to
tap this power have the tools necessary to build the next generation of
internet applications.

[www.siteground.com](http://www.siteground.es/)
