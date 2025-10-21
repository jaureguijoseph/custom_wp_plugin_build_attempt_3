#  **REST API**

[↑ [Back to
top]{.underline}](https://developer.wordpress.org/plugins/rest-api/#wp--skip-link--target)

WordPress 4.4 introduced the infrastructure for a REST API.  The REST
API provides an easy way to get data into and out of WordPress.  Data
can be retrieved and stored by sending HTTP requests to the REST API
server.  The REST API takes advantage of different HTTP methods.

-   GET should be used for retrieving data from the API.

-   POST should be used for creating new resources (i.e users, posts,
    taxonomies).

-   PUT should be used for updating resources.

-   DELETE should be used for deleting resources.

-   OPTIONS should be used to provide context about our resources.

A resource is any single entity or object.  A good example of a resource
for WordPress would be a post. A post has different properties like its
title and content.  A response from the API could show us title and
content as fields in the response.  The REST API enables us to interact
with posts and other WordPress resources  in a new way.  The REST API
makes sharing our content with the rest of the web easier, and it
provides us a structured way to handle complex interactions within
WordPress.

In this chapter of the Plugin Handbook, we will explore how the API
works and how we can leverage its power to do great things with
WordPress!

**First published**

August 26, 2021

#   **REST API Overview**

In this article

-   [Why use the WordPress REST
    API](https://developer.wordpress.org/plugins/rest-api/rest-api-overview/#why-use-the-wordpress-rest-api)

-   [Key
    Concepts](https://developer.wordpress.org/plugins/rest-api/rest-api-overview/#key-concepts)

    -   [Routes &
        Endpoints](https://developer.wordpress.org/plugins/rest-api/rest-api-overview/#routes-endpoints)

    -   [Requests](https://developer.wordpress.org/plugins/rest-api/rest-api-overview/#requests)

    -   [Responses](https://developer.wordpress.org/plugins/rest-api/rest-api-overview/#responses)

    -   [Schema](https://developer.wordpress.org/plugins/rest-api/rest-api-overview/#schema)

    -   [Controller
        Classes](https://developer.wordpress.org/plugins/rest-api/rest-api-overview/#controller-classes)

-   [Next
    Steps](https://developer.wordpress.org/plugins/rest-api/rest-api-overview/#next-steps)

The WordPress REST API brings many new features to WordPress. The REST
API uses JSON (JavaScript Object Notation) as its data format.  JSON is
an open standard data format that is becoming more widely used across
the web as a whole, and software in general.  It is light-weight and
human readable, and looks like Objects do in JavaScript; hence the name.
 When you make a request to the API, the response will be returned in
JSON. This enables developers to use WordPress in languages beyond PHP,
which in turn allows WordPress to be used in new and exciting ways.

[**[Why use the WordPress REST
API]{.underline}**](https://developer.wordpress.org/plugins/rest-api/rest-api-overview/#why-use-the-wordpress-rest-api)

There are many use cases for the WordPress REST API.  One of the largest
use cases is creating Single Page Applications on top of WordPress.  You
could create an entirely new admin experience for WordPress, or you
could create an entirely new front end experience for WordPress.  You
would not even have to write the applications in PHP.  Any programming
language that can make HTTP requests and interpret JSON could be used to
write something on WordPress.

The WordPress REST API can also serve as a strong replacement for the
admin-ajax API in core.  By using the REST API, you can more easily
structure the way you want to get data into and out of WordPress.  AJAX
calls can be greatly simplified by using the REST API, enabling us to
provide better user experiences in our work.

The use cases extend beyond these and really our imagination is the only
limit to what can be done.  The bottom line is, if you want an
structured, extensible, and simple way to get data in and out of
WordPress, you probably want to use the REST API.  The API, for all of
its simplicity, can be quite complex at first and we will attempt to
break it down into smaller components so that we can easily piece
together the larger puzzle.

[**[Key
Concepts]{.underline}**](https://developer.wordpress.org/plugins/rest-api/rest-api-overview/#key-concepts)

To get started with using the WordPress REST API we will break down some
of the key concepts and terms associated with the API:

-   Routes/Endpoints

-   Requests

-   Responses

-   Schema

-   Controller Classes

Each of these concepts play a crucial role in using and understanding
the WordPress REST API.  Let's briefly break them down so that we can
later explore each in greater depth.

[**[Routes &
Endpoints]{.underline}**](https://developer.wordpress.org/plugins/rest-api/rest-api-overview/#routes-endpoints)

A route, in the context of the WordPress REST API, is a URI which can be
mapped to different HTTP methods.  The mapping of an individual HTTP
method to a route is known as an endpoint.  To clarify: If we make
a GETrequest to http://oursite.com/wp-json/, we will get a JSON response
showing us what routes are available, and within each route, what
endpoints are available. /wp-json/ Is a route itself and when
a GET request is made it matches to the endpoint that displays what is
known as the index for the WordPress REST API. We will learn how to
register our own routes and endpoints in the following sections.

[**[Requests]{.underline}**](https://developer.wordpress.org/plugins/rest-api/rest-api-overview/#requests)

In the WordPress REST API infrastructure one of the primary classes
is WP_REST_Request. The request class is used to store and retrieve
information for the current request, requests can also be made
internally within PHP to avoid using HTTP. WP_REST_Request objects are
automatically generated for you whenever you make an HTTP request to a
registered route. The data specified in the request will have an impact
on what response you get back out of the API. There are a lot of neat
things that can be done using the request class. The request section
will go into greater detail.

[**[Responses]{.underline}**](https://developer.wordpress.org/plugins/rest-api/rest-api-overview/#responses)

Responses are the data you get back from the API.
The WP_REST_Responseprovides a way to interact with the response data
returned by endpoints. Responses can return the desired data, and they
can also be used to return errors.

[**[Schema]{.underline}**](https://developer.wordpress.org/plugins/rest-api/rest-api-overview/#schema)

When we have responses and requests of different kinds of data, we need
to be able to tell what type of data we are interacting with. Schema
provides us a way to structure our data. Schema also provides security
benefits for the API as it enables us to validate requests being made to
the API. Schema is a large topic and we will get into that in the schema
section.

[**[Controller
Classes]{.underline}**](https://developer.wordpress.org/plugins/rest-api/rest-api-overview/#controller-classes)

As you can see the WordPress REST API has a lot of moving parts that all
need to work together. Controller classes enable us to bring all of
these elements together in a single place. With a controller class we
will be able to manage the registering of routes & endpoints, handle
requests, utilize schema, and generate responses.

[**[Next
Steps]{.underline}**](https://developer.wordpress.org/plugins/rest-api/rest-api-overview/#next-steps)

Let's dive into how to register routes and endpoints for the REST API

[Developer Blog](https://developer.wordpress.org/news/)

-   [Code Reference](https://developer.wordpress.org/reference/)

-   [WP-CLI Commands](https://developer.wordpress.org/cli/commands/)

[[Home](https://developer.wordpress.org)[Plugin
Handbook](https://developer.wordpress.org/plugins/)[REST
API](https://developer.wordpress.org/plugins/rest-api/)]{.underline}Routes
& Endpoints

Top of Form

Search

Bottom of Form

**Routes & Endpoints**

In this article

-   [[Overview]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/#overview)

-   [[Routes]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/#routes)

    -   [[Namespaces]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/#namespaces)

    -   [[Resource
        Paths]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/#resource-paths)

    -   [[Path
        Variables]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/#path-variables)

-   [[Endpoints]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/#endpoints)

    -   [[HTTP
        Methods]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/#http-methods)

    -   [[Callbacks]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/#callbacks)

    -   [[Arguments]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/#arguments)

-   [[Summary]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/#summary)

[↑ [Back to
top]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/#wp--skip-link--target)

[**[Overview]{.underline}**](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/#overview)

The REST API provides us a way to match URIs to various resources in our
WordPress install. By default, if you have pretty permalinks enabled,
the WordPress REST API "lives" at /wp-json/. At our WordPress
site https://ourawesomesite.com, we can access the REST API's index by
making a GET request to https://ourawesomesite.com/wp-json/. The index
provides information regarding what routes are available for that
particular WordPress install, along with what HTTP methods are supported
and what endpoints are registered.

If we wanted to create an endpoint that would return the phrase "Hello
World, this is the WordPress REST API", we would first need to register
the route for that endpoint. To register routes you should use
the register_rest_route() function. It needs to be called on
the rest_api_init action hook. register_rest_route() handles all of the
mapping for routes to endpoints. Let's try to create a "Hello World,
this is the WordPress REST API" route.

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/)

/\*\*

\* This is our callback function that embeds our phrase in a
WP_REST_Response

\*/

**function** prefix_get_endpoint_phrase() {

// rest_ensure_response() wraps the data we want to return into a
WP_REST_Response, and ensures it will be properly returned.

**return** rest_ensure_response( \'Hello World, this is the WordPress
REST API\' );

}

/\*\*

\* This function is where we register our routes for our example
endpoint.

\*/

**function** prefix_register_example_routes() {

// register_rest_route() handles more arguments but we are going to
stick to the basics for now.

register_rest_route( \'hello-world/v1\', \'/phrase\', **array**(

// By using this constant we ensure that when the WP_REST_Server changes
our readable endpoints will work as intended.

\'methods\' =\> WP_REST_Server::READABLE,

// Here we register our callback. The callback is fired when this
endpoint is matched by the WP_REST_Server class.

\'callback\' =\> \'prefix_get_endpoint_phrase\',

) );

}

add_action( \'rest_api_init\', \'prefix_register_example_routes\' );

The first argument passed into register_rest_route() is the namespace,
which provides us a way to group our routes. The second argument passed
in is the resource path, or resource base. For our example, the resource
we are retrieving is the "Hello World, this is the WordPress REST API"
phrase. The third argument is an array of options. We specify what
methods the endpoint can use and what callback should happen when the
endpoint is matched (more things can be done but these are the
fundamentals).

The third argument also allows us to provide a permissions callback,
which can restrict access for the endpoint to only certain users. The
third argument also offers a way to register arguments for the endpoint
so that requests can modify the response of our endpoint. We will get
into those concepts in the endpoints section of this guide.

When we go
to https://ourawesomesite.com/wp-json/hello-world/v1/phrase we can now
see our REST API greeting us kindly. Let's take a look at routes a bit
more in depth.

[**[Routes]{.underline}**](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/#routes)

Routes in the REST API are represented by URIs. The route itself is what
is tacked onto the end of https://ourawesomesite.com/wp-json. The index
route for the API is \'/\' which is
why https://ourawesomesite.com/wp-json/ returns all of the available
information for the API. All routes should be built onto this route,
the wp-json portion can be changed, but in general, it is advised to
keep it the same.

We want to make sure that our routes are unique. For instance we could
have a route for books like this: /books. Our books route would now live
at https://ourawesomesite.com/wp-json/books. However, this is not a good
practice as we would end up polluting potential routes for the API. What
if another plugin we wanted to register a books route as well? We would
be in big trouble in that case, as the two routes would conflict with
each other and only one could be used. The fourth parameter
to register_rest_field()is a boolean for whether the route should
override an existing route.

The override parameter does not really solve our problem either, as both
routes could override or we would want to use both routes for different
things. This is where using namespaces for our routes comes in.

[**[Namespaces]{.underline}**](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/#namespaces)

It is extremely important to add namespaces to your routes. The "core"
endpoints, which are awaiting to be merged into WordPress core, use
the /wp/v2 namespace.

**DO NOT PLACE ANYTHING INTO THE /wp NAMESPACE UNLESS YOU ARE MAKING
ENDPOINTS WITH THE INTENTION OF MERGING THEM INTO CORE.**

There are some key things to take notice of in the core endpoint
namespace. The first part of the namespace is /wp, which represents the
vendor name; WordPress. For our plugins we will want to come up with
unique names for what we call the vendor portion of the namespace. In
the example above we used hello-world.

Following the vendor portion is the version portion of the namespace.
The "core" endpoints utilize v2 to represent version 2 of the WordPress
REST API. If you are writing a plugin, you can maintain backwards
compatibility of your REST API endpoints by simply creating new
endpoints and bumping up the version number you provide. This way both
the original v1 and v2endpoints can be accessed.

The part of the route that follows the namespace is the resource path.

[**[Resource
Paths]{.underline}**](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/#resource-paths)

The resource path should signify what resource the endpoint is
associated with. In the example we used above, we used the
word phrase to signify that the resource we are interacting with is a
phrase. To avoid any collisions, each resource path we register should
also be unique within a namespace. Resource paths should be used to
define different resource routes within a given namespace.

Let's say we have a plugin that handles some basic eCommerce
functionality. We will have two main resource types orders, and
products. Orders are a request for product(s) but they are not the
product themselves. The same concept applies to products. Although these
resources are related they are not the same thing and each should live
in a separate resource paths. Our routes will end up looking something
like this for our eCommerce
plugin: /my-shop/v1/orders and /my-shop/v1/products.

Using routes like this, we would want each to return a collection of
orders or products. What if we wanted to grab a specific product by ID,
we would need to use path variables in our routes.

[**[Path
Variables]{.underline}**](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/#path-variables)

Path variables enable us to add dynamic routes. To expand on our
eCommerce routes, we could register a route to grab individual products.

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/)

/\*\*

\* This is our callback function to return our products.

\*

\* \@param WP_REST_Request \$request This function accepts a rest
request to process data.

\*/

**function** prefix_get_products( \$request ) {

// In practice this function would fetch the desired data. Here we are
just making stuff up.

\$products = **array**(

\'1\' =\> \'I am product 1\',

\'2\' =\> \'I am product 2\',

\'3\' =\> \'I am product 3\',

);

**return** rest_ensure_response( \$products );

}

/\*\*

\* This is our callback function to return a single product.

\*

\* \@param WP_REST_Request \$request This function accepts a rest
request to process data.

\*/

**function** prefix_get_product( \$request ) {

// In practice this function would fetch the desired data. Here we are
just making stuff up.

\$products = **array**(

\'1\' =\> \'I am product 1\',

\'2\' =\> \'I am product 2\',

\'3\' =\> \'I am product 3\',

);

// Here we are grabbing the \'id\' path variable from the \$request
object. WP_REST_Request implements ArrayAccess, which allows us to grab
properties as though it is an array.

\$id = (**string**) \$request\[\'id\'\];

**if** ( **isset**( \$products\[ \$id \] ) ) {

// Grab the product.

\$product = \$products\[ \$id \];

// Return the product as a response.

**return** rest_ensure_response( \$product );

} **else** {

// Return a WP_Error because the request product was not found. In this
case we return a 404 because the main resource was not found.

**return** **new** WP_Error( \'rest_product_invalid\', esc_html\_\_(
\'The product does not exist.\', \'my-text-domain\' ), **array**(
\'status\' =\> 404 ) );

}

// If the code somehow executes to here something bad happened return a
500.

**return** **new** WP_Error( \'rest_api_sad\', esc_html\_\_( \'Something
went horribly wrong.\', \'my-text-domain\' ), **array**( \'status\' =\>
500 ) );

}

/\*\*

\* This function is where we register our routes for our example
endpoint.

\*/

**function** prefix_register_product_routes() {

// Here we are registering our route for a collection of products.

register_rest_route( \'my-shop/v1\', \'/products\', **array**(

// By using this constant we ensure that when the WP_REST_Server changes
our readable endpoints will work as intended.

\'methods\' =\> WP_REST_Server::READABLE,

// Here we register our callback. The callback is fired when this
endpoint is matched by the WP_REST_Server class.

\'callback\' =\> \'prefix_get_products\',

) );

// Here we are registering our route for single products. The
(?P\<id\>\[\\d\]+) is our path variable for the ID, which, in this
example, can only be some form of positive number.

register_rest_route( \'my-shop/v1\', \'/products/(?P\<id\>\[\\d\]+)\',
**array**(

// By using this constant we ensure that when the WP_REST_Server changes
our readable endpoints will work as intended.

\'methods\' =\> WP_REST_Server::READABLE,

// Here we register our callback. The callback is fired when this
endpoint is matched by the WP_REST_Server class.

\'callback\' =\> \'prefix_get_product\',

) );

}

add_action( \'rest_api_init\', \'prefix_register_product_routes\' );

The above example covers a lot. The important part to note is that in
the second route we register, we add on a path variable /(?P\[\\d\]+) to
our resource path /products. The path variable is a regular expression.
In this case it uses \[\\d\]+ to signify that should be any numerical
character at least once. If you are using numeric IDs for your
resources, then this is a great example of how to use a path variable.
When using path variables, we now have to be careful around what can be
matched as it is user input.

The regex luckily will filter out anything that is not numerical.
However, what if the product for the requested ID doesn't exist. We need
to do error handling. You can see the basic way we are handling errors
in the code example above. When you return a WP_Error in your endpoint
callbacks the API server will automatically handle serving the error to
the client.

Although this section is about routes, we have covered quite a bit about
endpoints. Endpoints and routes are interrelated, but they definitely
have distinctions.

[**[Endpoints]{.underline}**](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/#endpoints)

Endpoints are the destination that a route needs to map to. For any
given route, you could have a number of different endpoints registered
to it. We will expand on our fictitious eCommerce plugin, to better show
the distinction between routes and endpoints. We are going to create two
endpoints that exist at the /wp-json/my-shop/v1/products/ route. One
endpoint uses the HTTP verb GET to get products, and the other endpoint
uses the HTTP verb POST to create a new product.

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/)

/\*\*

\* This is our callback function to return our products.

\*

\* \@param WP_REST_Request \$request This function accepts a rest
request to process data.

\*/

**function** prefix_get_products( \$request ) {

// In practice this function would fetch the desired data. Here we are
just making stuff up.

\$products = **array**(

\'1\' =&gt; \'I am product 1\',

\'2\' =&gt; \'I am product 2\',

\'3\' =&gt; \'I am product 3\',

);

**return** rest_ensure_response( \$products );

}

/\*\*

\* This is our callback function to return a single product.

\*

\* \@param WP_REST_Request \$request This function accepts a rest
request to process data.

\*/

**function** prefix_create_product( \$request ) {

// In practice this function would create a product. Here we are just
making stuff up.

**return** rest_ensure_response( \'Product has been created\' );

}

/\*\*

\* This function is where we register our routes for our example
endpoint.

\*/

**function** prefix_register_product_routes() {

// Here we are registering our route for a collection of products and
creation of products.

register_rest_route( \'my-shop/v1\', \'/products\', **array**(

**array**(

// By using this constant we ensure that when the WP_REST_Server
changes, our readable endpoints will work as intended.

\'methods\' =&gt; WP_REST_Server::READABLE,

// Here we register our callback. The callback is fired when this
endpoint is matched by the WP_REST_Server class.

\'callback\' =&gt; \'prefix_get_products\',

),

**array**(

// By using this constant we ensure that when the WP_REST_Server
changes, our create endpoints will work as intended.

\'methods\' =&gt; WP_REST_Server::CREATABLE,

// Here we register our callback. The callback is fired when this
endpoint is matched by the WP_REST_Server class.

\'callback\' =&gt; \'prefix_create_product\',

),

) );

}

add_action( \'rest_api_init\', \'prefix_register_product_routes\' );

Depending on what HTTP Method we use for the
route /wp-json/my-shop/v1/products, we are matched to a different
endpoint and a different callback is fired. When we use POST we trigger
the prefix_create_product() callback, and when we use GET we trigger
the prefix_get_products() callback.

There are a number of different HTTP methods and the REST API can make
use of any of them.

[**[HTTP
Methods]{.underline}**](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/#http-methods)

HTTP methods are sometimes referred to as HTTP verbs. They are simply
just different ways to communicate via HTTP. The main ones used by the
WordPress REST API are:

-   GET should be used for retrieving data from the API.

-   POST should be used for creating new resources (i.e users, posts,
    taxonomies).

-   PUT should be used for updating resources.

-   DELETE should be used for deleting resources.

-   OPTIONS should be used to provide context about our resources.

It is important to note that these methods are not supported by every
client, as they were introduced in HTTP 1.1. Luckily, the API provides a
workaround for these unfortunate cases. If you want to delete a resource
but can't send a DELETE request, then you can use the \_method parameter
or the X-HTTP-Method-Override header in your request. How this works is
you will send a POST request
to https://ourawesomesite.com/wp-json/my-shop/v1/products/1?\_method=DELETE.
Now you will have deleted product number 1, even though your client
could not send the proper HTTP method in the request, or maybe there was
a firewall in place that blocks out DELETE requests.

The HTTP method, in combination with the route and callbacks, are what
make up the core of an endpoint.

[**[Callbacks]{.underline}**](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/#callbacks)

There are currently only two types of callbacks for endpoints supported
by the REST API; callback and permissions_callback. The main callback
should handle the interaction with the resource. The permissions
callback should handle what users have access to the endpoint. You can
add additional callbacks by adding additional information when
registering an endpoint. You can then hook
into rest_pre_dispatch, rest_dispatch_request,
or rest_post_dispatch hooks to fire your new custom callbacks.

**Endpoint Callback**

The main callback for a delete endpoint should only delete the resource
and return a copy of it in the response. The main callback for a
creation endpoint should only create the resource and return a response
matching the newly created data. An update callback should only modify
resources that actually exist. A reading callback should only retrieve
data that already exists. It is important to take into account the
concept of idempotence.

Idempotence, in the context of a REST API, means that if you make the
same request to an endpoint the server will process the request the same
way. Imagine if our read endpoint was not idempotent. Whenever we made a
request to it the state of our server would be modified by the request,
even though we were only trying to get data. This could be catastrophic.
Any time someone fetched data from your server something would change
internally. It is important to make sure that read, update, and delete
endpoints do not have nasty side effects and just stick to what they are
intended to do.

In a REST API, the concept of idempotence is tied to HTTP methods
instead of endpoint callbacks. Any callback
using GET, HEAD, TRACE, OPTIONS, PUT, or DELETE, should not produce any
side effects. POST requests are not idempotent, and are typically used
for creating resources. If you created an idempotent creation method
then you would only ever create one resource because when you make the
same request there would be no more side effects to the server. For
creating, if you make the same request over and over the server should
generate new resources each time.

To restrict usage of endpoints we need to register a permissions
callback.

**Permissions Callback**

Permissions callbacks are extremely important for security with the
WordPress REST API. If you have any private data that should not be
displayed publicly, then you need to have permissions callbacks
registered for your endpoints. Below is an example of how to register
permissions callbacks.

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/)

/\*\*

\* This is our callback function that embeds our resource in a
WP_REST_Response

\*/

**function** prefix_get_private_data() {

// rest_ensure_response() wraps the data we want to return into a
WP_REST_Response, and ensures it will be properly returned.

**return** rest_ensure_response( \'This is private data.\' );

}

/\*\*

\* This is our callback function that embeds our resource in a
WP_REST_Response

\*/

**function** prefix_get_private_data_permissions_check() {

// Restrict endpoint to only users who have the edit_posts capability.

**if** ( ! current_user_can( \'edit_posts\' ) ) {

**return** **new** WP_Error( \'rest_forbidden\', esc_html\_\_( \'OMG you
can not view private data.\', \'my-text-domain\' ), **array**(
\'status\' =\> 401 ) );

}

// This is a black-listing approach. You could alternatively do this via
white-listing, by returning false here and changing the permissions
check.

**return** true;

}

/\*\*

\* This function is where we register our routes for our example
endpoint.

\*/

**function** prefix_register_example_routes() {

// register_rest_route() handles more arguments but we are going to
stick to the basics for now.

register_rest_route( \'my-plugin/v1\', \'/private-data\', **array**(

// By using this constant we ensure that when the WP_REST_Server changes
our readable endpoints will work as intended.

\'methods\' =\> WP_REST_Server::READABLE,

// Here we register our callback. The callback is fired when this
endpoint is matched by the WP_REST_Server class.

\'callback\' =\> \'prefix_get_private_data\',

// Here we register our permissions callback. The callback is fired
before the main callback to check if the current user can access the
endpoint.

\'permissions_callback\' =\>
\'prefix_get_private_data_permissions_check\',

) );

}

add_action( \'rest_api_init\', \'prefix_register_example_routes\' );

If you try out this endpoint without any Authentication enabled then you
will also be returned the error response, preventing you from seeing the
data. Authentication is a huge topic and eventually a portion of this
chapter will be created to show you how to create your own
authentication processes.

[**[Arguments]{.underline}**](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/#arguments)

When making requests to an endpoint you might need to specify extra
parameters to change the response. These extra parameters can be added
while registering endpoints. Let's look at an example of how to use
arguments with an endpoint.

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/)

/\*\*

\* This is our callback function that embeds our resource in a
WP_REST_Response

\*/

**function** prefix_get_colors( \$request ) {

// In practice this function would fetch the desired data. Here we are
just making stuff up.

\$colors = **array**(

\'blue\',

\'blue\',

\'red\',

\'red\',

\'green\',

\'green\',

);

**if** ( **isset**( \$request\[\'filter\'\] ) ) {

\$filtered_colors = **array**();

**foreach** ( \$colors **as** \$color ) {

**if** ( \$request\[\'filter\'\] === \$color ) {

\$filtered_colors\[\] = \$color;

}

}

**return** rest_ensure_response( \$filtered_colors );

}

**return** rest_ensure_response( \$colors );

}

/\*\*

\* We can use this function to contain our arguments for the example
product endpoint.

\*/

**function** prefix_get_color_arguments() {

\$args = **array**();

// Here we are registering the schema for the filter argument.

\$args\[\'filter\'\] = **array**(

// description should be a human readable description of the argument.

\'description\' =\> esc_html\_\_( \'The filter parameter is used to
filter the collection of colors\', \'my-text-domain\' ),

// type specifies the type of data that the argument should be.

\'type\' =\> \'string\',

// enum specified what values filter can take on.

\'enum\' =\> **array**( \'red\', \'green\', \'blue\' ),

);

**return** \$args;

}

/\*\*

\* This function is where we register our routes for our example
endpoint.

\*/

**function** prefix_register_example_routes() {

// register_rest_route() handles more arguments but we are going to
stick to the basics for now.

register_rest_route( \'my-colors/v1\', \'/colors\', **array**(

// By using this constant we ensure that when the WP_REST_Server changes
our readable endpoints will work as intended.

\'methods\' =\> WP_REST_Server::READABLE,

// Here we register our callback. The callback is fired when this
endpoint is matched by the WP_REST_Server class.

\'callback\' =\> \'prefix_get_colors\',

// Here we register our permissions callback. The callback is fired
before the main callback to check if the current user can access the
endpoint.

\'args\' =\> prefix_get_color_arguments(),

) );

}

add_action( \'rest_api_init\', \'prefix_register_example_routes\' );

We have now specified a filter argument for this example. We can specify
the argument as a query parameter when we request the endpoint. If we
make a GET request
to https://ourawesomesitem.com/my-colors/v1/colors?filter=blue, we will
be returned only the blue colors in our collection. You could also pass
these as body parameters in the request body, instead of in the query
string. To understand the distinction between query parameters and body
parameters you should read about the HTTP spec. Query parameters live in
the query string tacked onto the URL and body parameters are directly
embedded in the body of an HTTP request.

We have created an argument for our endpoint, but how do we verify that
the argument is a string and tell whether it matches the value red,
green, or blue. To do this we need to specify a validation callback for
our argument.

**Validation**

Validation and sanitization are extremely important for security in the
API. The validate callback (in WP 4.6+), fires before the sanitize
callback. You should use the validate_callback for your arguments to
verify whether the input you are receiving is valid.
The sanitize_callback should be used to transform the argument input or
clean out unwanted parts out of the argument, before the argument is
processed by the main callback.

In the example above, we need to verify that the filter parameter is a
string, and it matches the value red, green, or blue. Let's look at what
the code looks like after adding in a validate_callback.

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/)

/\*\*

\* This is our callback function that embeds our resource in a
WP_REST_Response

\*/

**function** prefix_get_colors( \$request ) {

// In practice this function would fetch more practical data. Here we
are just making stuff up.

\$colors = **array**(

\'blue\',

\'blue\',

\'red\',

\'red\',

\'green\',

\'green\',

);

**if** ( **isset**( \$request\[\'filter\'\] ) ) {

\$filtered_colors = **array**();

**foreach** ( \$colors **as** \$color ) {

**if** ( \$request\[\'filter\'\] === \$color ) {

\$filtered_colors\[\] = \$color;

}

}

**return** rest_ensure_response( \$filtered_colors );

}

**return** rest_ensure_response( \$colors );

}

/\*\*

\* Validate a request argument based on details registered to the route.

\*

\* \@param mixed \$value Value of the \'filter\' argument.

\* \@param WP_REST_Request \$request The current request object.

\* \@param string \$param Key of the parameter. In this case it is
\'filter\'.

\* \@return WP_Error\|boolean

\*/

**function** prefix_filter_arg_validate_callback( \$value, \$request,
\$param ) {

// If the \'filter\' argument is not a string return an error.

**if** ( ! is_string( \$value ) ) {

**return** **new** WP_Error( \'rest_invalid_param\', esc_html\_\_( \'The
filter argument must be a string.\', \'my-text-domain\' ), **array**(
\'status\' =\> 400 ) );

}

// Get the registered attributes for this endpoint request.

\$attributes = \$request-\>get_attributes();

// Grab the filter param schema.

\$args = \$attributes\[\'args\'\]\[ \$param \];

// If the filter param is not a value in our enum then we should return
an error as well.

**if** ( ! in_array( \$value, \$args\[\'enum\'\], true ) ) {

**return** **new** WP_Error( \'rest_invalid_param\', sprintf( \_\_( \'%s
is not one of %s\' ), \$param, implode( \', \', \$args\[\'enum\'\] ) ),
**array**( \'status\' =\> 400 ) );

}

}

/\*\*

\* We can use this function to contain our arguments for the example
product endpoint.

\*/

**function** prefix_get_color_arguments() {

\$args = **array**();

// Here we are registering the schema for the filter argument.

\$args\[\'filter\'\] = **array**(

// description should be a human readable description of the argument.

\'description\' =\> esc_html\_\_( \'The filter parameter is used to
filter the collection of colors\', \'my-text-domain\' ),

// type specifies the type of data that the argument should be.

\'type\' =\> \'string\',

// enum specified what values filter can take on.

\'enum\' =\> **array**( \'red\', \'green\', \'blue\' ),

// Here we register the validation callback for the filter argument.

\'validate_callback\' =\> \'prefix_filter_arg_validate_callback\',

);

**return** \$args;

}

/\*\*

\* This function is where we register our routes for our example
endpoint.

\*/

**function** prefix_register_example_routes() {

// register_rest_route() handles more arguments but we are going to
stick to the basics for now.

register_rest_route( \'my-colors/v1\', \'/colors\', **array**(

// By using this constant we ensure that when the WP_REST_Server changes
our readable endpoints will work as intended.

\'methods\' =\> WP_REST_Server::READABLE,

// Here we register our callback. The callback is fired when this
endpoint is matched by the WP_REST_Server class.

\'callback\' =\> \'prefix_get_colors\',

// Here we register our permissions callback. The callback is fired
before the main callback to check if the current user can access the
endpoint.

\'args\' =\> prefix_get_color_arguments(),

) );

}

add_action( \'rest_api_init\', \'prefix_register_example_routes\' );

**Sanitizing**

In the above example, we do not need to use a sanitize_callback, because
we are restricting input to only values in our enum. If we did not have
strict validation and accepted any string as a parameter, we would
definitely need to register a sanitize_callback. What if we wanted to
update a content field and the user entered something like alert(\'ZOMG
Hacking you\');. The field value could potentially be a executable
script. To strip out unwanted data or to transform data into a desired
format we need to register a sanitize_callback for our arguments. Here
is an example of how to use WordPress's sanitize_text_field() for a
sanitize callback:

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/)

/\*\*

\* This is our callback function that embeds our resource in a
WP_REST_Response.

\*

\* The parameter is already sanitized by this point so we can use it
without any worries.

\*/

**function** prefix_get_item( \$request ) {

**if** ( **isset**( \$request\[\'data\'\] ) ) {

**return** rest_ensure_response( \$request\[\'data\'\] );

}

**return** **new** WP_Error( \'rest_invalid\', esc_html\_\_( \'The data
parameter is required.\', \'my-text-domain\' ), **array**( \'status\'
=\> 400 ) );

}

/\*\*

\* Validate a request argument based on details registered to the route.

\*

\* \@param mixed \$value Value of the \'filter\' argument.

\* \@param WP_REST_Request \$request The current request object.

\* \@param string \$param Key of the parameter. In this case it is
\'filter\'.

\* \@return WP_Error\|boolean

\*/

**function** prefix_data_arg_validate_callback( \$value, \$request,
\$param ) {

// If the \'data\' argument is not a string return an error.

**if** ( ! is_string( \$value ) ) {

**return** **new** WP_Error( \'rest_invalid_param\', esc_html\_\_( \'The
filter argument must be a string.\', \'my-text-domain\' ), **array**(
\'status\' =\> 400 ) );

}

}

/\*\*

\* Sanitize a request argument based on details registered to the route.

\*

\* \@param mixed \$value Value of the \'filter\' argument.

\* \@param WP_REST_Request \$request The current request object.

\* \@param string \$param Key of the parameter. In this case it is
\'filter\'.

\* \@return WP_Error\|boolean

\*/

**function** prefix_data_arg_sanitize_callback( \$value, \$request,
\$param ) {

// It is as simple as returning the sanitized value.

**return** sanitize_text_field( \$value );

}

/\*\*

\* We can use this function to contain our arguments for the example
product endpoint.

\*/

**function** prefix_get_data_arguments() {

\$args = **array**();

// Here we are registering the schema for the filter argument.

\$args\[\'data\'\] = **array**(

// description should be a human readable description of the argument.

\'description\' =\> esc_html\_\_( \'The data parameter is used to be
sanitized and returned in the response.\', \'my-text-domain\' ),

// type specifies the type of data that the argument should be.

\'type\' =\> \'string\',

// Set the argument to be required for the endpoint.

\'required\' =\> true,

// We are registering a basic validation callback for the data argument.

\'validate_callback\' =\> \'prefix_data_arg_validate_callback\',

// Here we register the validation callback for the filter argument.

\'sanitize_callback\' =\> \'prefix_data_arg_sanitize_callback\',

);

**return** \$args;

}

/\*\*

\* This function is where we register our routes for our example
endpoint.

\*/

**function** prefix_register_example_routes() {

// register_rest_route() handles more arguments but we are going to
stick to the basics for now.

register_rest_route( \'my-plugin/v1\', \'/sanitized-data\', **array**(

// By using this constant we ensure that when the WP_REST_Server changes
our readable endpoints will work as intended.

\'methods\' =\> WP_REST_Server::READABLE,

// Here we register our callback. The callback is fired when this
endpoint is matched by the WP_REST_Server class.

\'callback\' =\> \'prefix_get_item\',

// Here we register our permissions callback. The callback is fired
before the main callback to check if the current user can access the
endpoint.

\'args\' =\> prefix_get_data_arguments(),

) );

}

add_action( \'rest_api_init\', \'prefix_register_example_routes\' );

[**[Summary]{.underline}**](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/#summary)

We have covered the basics of registering endpoints for the WordPress
REST API. Routes are the URIs that our endpoints live at. Endpoints are
a collection of callbacks, methods, args, and other options. Each
endpoint is mapped to a route when using register_rest_route(). An
endpoint by default can support various HTTP methods, a main callback, a
permissions callback, and registered arguments. We can register
endpoints to cover any of our use cases for interacting with WordPress.
The endpoints serve as the core interaction point with the REST API, but
there are many other topics to explore and understand, to fully utilize
this powerful API.

**First published**

August 26, 2021

**Last updated**

July 19, 2024

[PreviousREST API OverviewPrevious: REST API
Overview](https://developer.wordpress.org/plugins/rest-api/rest-api-overview/)

[NextRequestsNext:
Requests](https://developer.wordpress.org/plugins/rest-api/requests/)

Bottom of Form

**Requests**

In this article

-   [[Overview]{.underline}](https://developer.wordpress.org/plugins/rest-api/requests/#overview)

-   [[WP_REST_Request]{.underline}](https://developer.wordpress.org/plugins/rest-api/requests/#wp_rest_request)

-   [[Request
    Properties]{.underline}](https://developer.wordpress.org/plugins/rest-api/requests/#request-properties)

    -   [[Method]{.underline}](https://developer.wordpress.org/plugins/rest-api/requests/#method)

    -   [[Route]{.underline}](https://developer.wordpress.org/plugins/rest-api/requests/#route)

    -   [[Headers]{.underline}](https://developer.wordpress.org/plugins/rest-api/requests/#headers)

    -   [[Parameters]{.underline}](https://developer.wordpress.org/plugins/rest-api/requests/#parameters)

    -   [[Attributes]{.underline}](https://developer.wordpress.org/plugins/rest-api/requests/#attributes)

-   [[Internal
    Requests]{.underline}](https://developer.wordpress.org/plugins/rest-api/requests/#internal-requests)

[↑ [Back to
top]{.underline}](https://developer.wordpress.org/plugins/rest-api/requests/#wp--skip-link--target)

[**[Overview]{.underline}**](https://developer.wordpress.org/plugins/rest-api/requests/#overview)

The REST API is very simple in many ways. There is input, known as the
request. The input is interpreted by the server and output is created.
The output, is known as the response. In some ways, you can think of a
request to the WordPress REST API as a set of directions or instructions
that should be carried out and interpreted by the API. By default, the
WordPress REST API is intended to use HTTP requests as its request
medium. HTTP is the foundation for communication of data over the
internet, which makes the WordPress REST API a very far reaching API.
Requests in the API utilize a lot of the different aspects present in
HTTP requests like URIs, HTTP methods, headers, and parameters. The data
structure of a request is conveniently handled by
the WP_REST_Request class.

[**[WP_REST_Request]{.underline}**](https://developer.wordpress.org/plugins/rest-api/requests/#wp_rest_request)

This class is one of the three main infrastructure classes introduced in
WordPress 4.4. When an HTTP request is made to an endpoint of the API,
the API will automatically create an instance of
the WP_REST_Request class, matching the provided data. The response
object is auto-generated in WP_REST_Server's serve_request() method.
Once the request is created and authentication is checked, the request
is dispatched and our endpoint callbacks begin to be fired. All of the
data stored up in the WP_REST_Request object is passed into our
callbacks for our registered endpoints. So both
our permissions_callback and callback are called with the request object
being passed in. This enables us to access the various request
properties in our callbacks, so that we can tailor our responses to
match the desired output.

[**[Request
Properties]{.underline}**](https://developer.wordpress.org/plugins/rest-api/requests/#request-properties)

Request objects have many different properties, each of which can be
used in various ways. The main properties are the request method, route,
headers, parameters and attributes. Let's break each of these down into
their role in a request. If you were to create a request object yourself
it would look like this:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/rest-api/requests/)

\$request = **new** WP_REST_Request( \'GET\',
\'/my-namespace/v1/examples\' );

In the above code sample we are only specifying that the request object
method is GET and we should be matching the
route /my-namespace/v1/examples which in the context of an entire URL
would look like
this: https://ourawesomesite.com/wp-json/my-namepsace/v1/examples. The
method and route arguments for the WP_REST_Request constructor are used
to map the request to the desired endpoint. If the request is made to an
endpoint that is not registered then a helpful 404 error message is
returned in the response. Let's look at the various properties in more
depth.

[**[Method]{.underline}**](https://developer.wordpress.org/plugins/rest-api/requests/#method)

The method property of a request object by default matches the HTTP
Request method. The method in most cases will be one
of GET, POST, PUT, DELETE, OPTIONS, or HEAD. These methods will be used
to match the various endpoints registered to a route. When the API finds
a match for the method and route it will fire the callbacks for that
endpoint.

The following convention is a best practice for matching HTTP
methods: GETfor read only tasks, POST for creation, PUT for updating,
and DELETE for deleting. The request method acts as an indicator for the
expected functionality of your endpoints. When you make a GET request to
a route, you should expect to be returned read only data.

[**[Route]{.underline}**](https://developer.wordpress.org/plugins/rest-api/requests/#route)

The route for a request, by default, will match the server environment
variable for path info; \$\_SERVER\[\'PATH_INFO\'\]. When you make an
HTTP request to a route of the WordPress REST API, the
generated WP_REST_Requestobject will be made to match that path, which
will hopefully then be matched to a valid endpoint. In short the route
for a request is where you want to target your request in the API.

If we had registered a books endpoint, using GET, it might live
at https://ourawesomesite.com/wp-json/my-namespace/v1/books. If we went
to that URL in our browser, we would see our collection of books
represented in JSON. WordPress will automatically generate the request
object for us and handle all of the routing to match endpoints. So since
we don't really have to worry about the routing ourselves understanding
how to pass extra data we want in our requests is a much more important
thing to understand.

[**[Headers]{.underline}**](https://developer.wordpress.org/plugins/rest-api/requests/#headers)

HTTP Request headers are simply just extra data about our HTTP request.
Request headers can specify caching policy, what our request content is,
where the request is coming from and many other things. Request headers
do not necessarily interact with our endpoints directly, but the
information in the headers helps WordPress know what to do. To pass in
data that we want our endpoints to interact with we want to use
parameters.

[**[Parameters]{.underline}**](https://developer.wordpress.org/plugins/rest-api/requests/#parameters)

When making requests to the WordPress REST API, most of the additional
data passed in will take on the form of parameters. What are parameters?
There are four different types in the context of the API. There are
route parameters, query parameters, body parameters, and file
parameters. Let's take a look at each one a bit more in depth.

**URL Params**

URL parameters are automatically generated in a WP_REST_Request from the
path variables in the requested route. What does that mean? Let's look
at this route, which grabs individual books by
id: /my-namespace/v1/books/(?P\\d+). The odd looking (?P\\d+) is a path
variable. The name of the path variable is 'id'.

If we were to make a request like GET
https://ourawesomesite.com/wp-json/my-namespace/v1/books/5, 5 will
become the value for our id path variable. The WP_REST_Requestobject
will automatically take that path variable and store it as a URL
parameter. Now inside of our endpoint callbacks we can interact with
that URL parameter really easily. Let's look at an example.

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/rest-api/requests/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/rest-api/requests/)

// Register our individual books endpoint.

**function** prefix_register_book_route() {

register_rest_route( \'my-namespace/v1\', \'/books/(?P\<id\>\\d+)\',
**array**(

// Supported methods for this endpoint. WP_REST_Server::READABLE
translates to GET.

\'methods\' =\> WP_REST_Server::READABLE,

// Register the callback for the endpoint.

\'callback\' =\> \'prefix_get_book\',

) );

}

add_action( \'rest_api_init\', \'prefix_register_book_route\' );

/\*\*

\* Our registered endpoint callback. Notice how we are passing in
\$request as an argument.

\* By default, the WP_REST_Server will pass in the matched request
object to our callback.

\*

\* \@param WP_REST_Request \$request The current matched request object.

\*/

**function** prefix_get_book( \$request ) {

// Here we are accessing the path variable \'id\' from the \$request.

\$book = prefix_get_the_book( \$request\[\'id\'\] );

**return** rest_ensure_response( \$book );

}

// A simple function that grabs a book title from our books by ID.

**function** prefix_get_the_book( \$id ) {

\$books = **array**(

\'Design Patterns\',

\'Clean Code\',

\'Refactoring\',

\'Structure and Interpretation of Computer Programs\',

);

\$book = \'\';

**if** ( **isset**( \$books\[ \$id \] ) ) {

// Grab the matching book.

\$book = \$books\[ \$id \];

} **else** {

// Error handling.

**return** **new** WP_Error( \'rest_not_found\', esc_html\_\_( \'The
book does not exist\', \'my-text-domain\' ), **array**( \'status\' =\>
404 ) );

}

**return** \$book;

}

In the example above we see how path variables are stored as URL
parameters in the request object. We can then access those parameters in
our endpoint callbacks. The above example is a pretty common use case
for using URL params. Adding too many path variables to a route can slow
down the matching of routes and it can also over complicate registering
endpoints, it is advised to use URL parameters sparingly. If we aren't
supposed to use parameters directly in our URL path, then we need
another way to pass in extra information to our request. This is where
query and body parameters come in, they will typically do most of the
heavy lifting in your API.

**Query Params**

Query parameters exist in the query string portion of a URI. The query
string portion of a URI
in https://ourawesomesite.com/wp-json/my-namespace/v1/books?per_page=2&genre=fictionis ?per_page=2&genre=fiction.
The query string is started by the '?' character, the different values
within the query string are separated by the '&' character. We specified
two parameters in our query string; per_page and fiction. In our
endpoint we would want to grab only two books from the fiction genre. We
could access those values in a callback like
this: \$request\[\'per_page\'\], and \$request\[\'genre\'\] ( assuming
\$request is the name of the argument we are using ). If you are
familiar with PHP you have probably used query parameters in your web
applications.

In PHP, the query parameters get stored in the superglobal \$\_GET. It
is important to note that you should never directly access any
superglobals or server variables in your endpoints. It is always best to
work with what is provided by the WP_REST_Request class. Another common
method for passing in variables to an endpoint is to use body
parameters.

**Body Params**

Body parameters are key value pairs that are stored in the request body.
If you have ever sent a POST request via a , through cURL, or some other
method, then you have used body parameters. With body parameters you can
pass them as different content types as well. The
default Content-Typeheader for a POST request is x-www-form-urlencoded.
When using x-www-form-urlencoded, the parameters are sent like a query
string; per_page=2&genre=fiction. An HTML form, by default, will bundle
up the various inputs and send a POST request matching
the x-www-form-urlencoded pattern.

It is important to note that although the HTTP specification does not
prohibit the use of sending body parameters in GET requests, it is
encouraged that you do not use body parameters in a GET request. Body
parameters can and should be used for POST, PUT, and DELETE requests.

**File Params**

File parameters in a WP_REST_Request object are stored when the request
uses a special content type header; multipart/form-data. The file data
can then be accessed from the request object
using \$request-\>get_file_params(). The file parameters are equivalent
to the PHP superglobal: \$\_FILES. Remember, do not access the
superglobals directly only use what the WP_REST_Request object provides.

In the endpoint callback we could use wp_handle_upload() to then add in
the desired files to WordPress's media uploads directory. The file
parameters are only useful for dealing with file data and you should
never use them for any other purpose.

[**[Attributes]{.underline}**](https://developer.wordpress.org/plugins/rest-api/requests/#attributes)

WP_REST_Request also supports request attributes. The attributes of a
request are the attributes registered to the match route. If we made
a GETrequest to my-namespace/v1/books, and then we
called \$request-\>get_attributes() inside of our endpoint callback, we
would be returned all of the registration options for
the my-namespace/v1/booksendpoint. If we made a POST request to the same
route and our endpoint callback also
returned \$request-\>get_attributes(), we would receive a different set
of endpoint options registered to the POST endpoint callback.

In the attributes we will get a response containing supported methods,
options, whether to show this endpoint in the index, a list of
registered arguments for the endpoint, and our registered callbacks. It
might look something like this:

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/rest-api/requests/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/rest-api/requests/)

{

\"methods\": {

\"GET\": true

},

\"accept_json\": false,

\"accept_raw\": false,

\"show_in_index\": true,

\"args\": {

\"context\": {

\"description\": \"Scope under which the request is made; determines
fields present in response.\",

\"type\": \"string\",

\"sanitize_callback\": \"sanitize_key\",

\"validate_callback\": \"rest_validate_request_arg\",

\"enum\": \[

\"view\",

\"embed\",

\"edit\"

\],

\"default\": \"view\"

},

\"page\": {

\"description\": \"Current page of the collection.\",

\"type\": \"integer\",

\"default\": 1,

\"sanitize_callback\": \"absint\",

\"validate_callback\": \"rest_validate_request_arg\",

\"minimum\": 1

},

\"per_page\": {

\"description\": \"Maximum number of items to be returned in result
set.\",

\"type\": \"integer\",

\"default\": 10,

\"minimum\": 1,

\"maximum\": 100,

\"sanitize_callback\": \"absint\",

\"validate_callback\": \"rest_validate_request_arg\"

},

\"search\": {

\"description\": \"Limit results to those matching a string.\",

\"type\": \"string\",

\"sanitize_callback\": \"sanitize_text_field\",

\"validate_callback\": \"rest_validate_request_arg\"

},

\"after\": {

\"description\": \"Limit response to resources published after a given
ISO8601 compliant date.\",

\"type\": \"string\",

\"format\": \"date-time\",

\"validate_callback\": \"rest_validate_request_arg\"

},

\"author\": {

\"description\": \"Limit result set to posts assigned to specific
authors.\",

\"type\": \"array\",

\"default\": \[\],

\"sanitize_callback\": \"wp_parse_id_list\",

\"validate_callback\": \"rest_validate_request_arg\"

},

\"author_exclude\": {

\"description\": \"Ensure result set excludes posts assigned to specific
authors.\",

\"type\": \"array\",

\"default\": \[\],

\"sanitize_callback\": \"wp_parse_id_list\",

\"validate_callback\": \"rest_validate_request_arg\"

},

\"before\": {

\"description\": \"Limit response to resources published before a given
ISO8601 compliant date.\",

\"type\": \"string\",

\"format\": \"date-time\",

\"validate_callback\": \"rest_validate_request_arg\"

},

\"exclude\": {

\"description\": \"Ensure result set excludes specific ids.\",

\"type\": \"array\",

\"default\": \[\],

\"sanitize_callback\": \"wp_parse_id_list\"

},

\"include\": {

\"description\": \"Limit result set to specific ids.\",

\"type\": \"array\",

\"default\": \[\],

\"sanitize_callback\": \"wp_parse_id_list\"

},

\"offset\": {

\"description\": \"Offset the result set by a specific number of
items.\",

\"type\": \"integer\",

\"sanitize_callback\": \"absint\",

\"validate_callback\": \"rest_validate_request_arg\"

},

\"order\": {

\"description\": \"Order sort attribute ascending or descending.\",

\"type\": \"string\",

\"default\": \"desc\",

\"enum\": \[

\"asc\",

\"desc\"

\],

\"validate_callback\": \"rest_validate_request_arg\"

},

\"orderby\": {

\"description\": \"Sort collection by object attribute.\",

\"type\": \"string\",

\"default\": \"date\",

\"enum\": \[

\"date\",

\"relevance\",

\"id\",

\"include\",

\"title\",

\"slug\"

\],

\"validate_callback\": \"rest_validate_request_arg\"

},

\"slug\": {

\"description\": \"Limit result set to posts with a specific slug.\",

\"type\": \"string\",

\"validate_callback\": \"rest_validate_request_arg\"

},

\"status\": {

\"default\": \"publish\",

\"description\": \"Limit result set to posts assigned a specific status;
can be comma-delimited list of status types.\",

\"enum\": \[

\"publish\",

\"future\",

\"draft\",

\"pending\",

\"private\",

\"trash\",

\"auto-draft\",

\"inherit\",

\"any\"

\],

\"sanitize_callback\": \"sanitize_key\",

\"type\": \"string\",

\"validate_callback\": \[

{},

\"validate_user_can_query_private_statuses\"

\]

},

\"filter\": {

\"description\": \"Use WP Query arguments to modify the response;
private query vars require appropriate authorization.\"

},

\"categories\": {

\"description\": \"Limit result set to all items that have the specified
term assigned in the categories taxonomy.\",

\"type\": \"array\",

\"sanitize_callback\": \"wp_parse_id_list\",

\"default\": \[\]

},

\"tags\": {

\"description\": \"Limit result set to all items that have the specified
term assigned in the tags taxonomy.\",

\"type\": \"array\",

\"sanitize_callback\": \"wp_parse_id_list\",

\"default\": \[\]

}

},

\"callback\": \[

{},

\"get_items\"

\],

\"permission_callback\": \[

{},

\"get_items_permissions_check\"

\]

}

As you can see we have all of the information we have registered to our
endpoint already there, ready to go! The request attributes are
typically used at a lower level and are handled by
the WP_REST_Server class, however there are cool things that can be done
inside of endpoint callbacks, like restricting accepted parameters to
match registered arguments.

The WP REST API is designed for you so that you do not have to mess
around with any internals, so some of these more advanced methods of
interacting with WP_REST_Request are not going to be commonly practiced.
The core of using the WP REST API is linked to registering routes and
endpoints. Requests are the tool we use to tell the API which endpoint
we want to hit. This is most commonly done over HTTP, however we can
also use WP_REST_Requests internally.

[**[Internal
Requests]{.underline}**](https://developer.wordpress.org/plugins/rest-api/requests/#internal-requests)

The key to making internal requests is using rest_do_request(). All you
need to do is pass in a request object and you will be returned a
response. Because the request is never served by the WP_REST_Server, the
response data is never encoded into json, meaning we have our response
object as a PHP object. This is pretty awesome and enables us to do a
lot of interesting things. For one, we can create efficient batch
endpoints. From a performance perspective, one of the hurdles is
minimizing HTTP requests. We can create batch endpoints that will
use rest_do_request() to serve all of our requests internally all in one
HTTP request. Here is a very simplistic batch endpoint for read only
data, so you can see rest_do_request() in action.

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/rest-api/requests/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/rest-api/requests/)

// Register our mock batch endpoint.

**function** prefix_register_batch_route() {

register_rest_route( \'my-namespace/v1\', \'/batch\', **array**(

// Supported methods for this endpoint. WP_REST_Server::READABLE
translates to GET.

\'methods\' =\> WP_REST_Server::READABLE,

// Register the callback for the endpoint.

\'callback\' =\> \'prefix_do_batch_request\',

// Register args for the batch endpoint.

\'args\' =\> prefix_batch_request_parameters(),

) );

}

add_action( \'rest_api_init\', \'prefix_register_batch_route\' );

/\*\*

\* Our registered endpoint callback. Notice how we are passing in
\$request as an argument.

\* By default, the WP_REST_Server will pass in the matched request
object to our callback.

\*

\* \@param WP_REST_Request \$request The current matched request object.

\*/

**function** prefix_do_batch_request( \$request ) {

// Here we initialize the array that will hold our response data.

\$data = **array**();

\$data = prefix_handle_batch_requests( \$request\[\'requests\'\] );

**return** \$data;

}

/\*\*

\* This handles the building of the response for the batch requests we
make.

\*

\* \@param array \$requests An array of data to build WP_REST_Request
objects from.

\* \@return WP_REST_Response A collection of response data for batch
endpoints.

\*/

**function** prefix_handle_batch_requests( \$requests ) {

\$data = **array**();

// Foreach request specified in the requests param run the endpoint.

**foreach** ( \$requests **as** \$request_params ) {

\$response = prefix_handle_request( \$request_params );

\$key = \$request_params\[\'method\'\] . \' \' .
\$request_params\[\'route\'\];

\$data\[ \$key \] = prefix_prepare_for_collection( \$response );

}

**return** rest_ensure_response( \$data );

}

/\*\*

\* This handles the building of the response for the batch requests we
make.

\*

\* \@param array \$request_params Data to build a WP_REST_Request object
from.

\* \@return WP_REST_Response Response data for the request.

\*/

**function** prefix_handle_request( \$request_params ) {

\$request = **new** WP_REST_Request( \$request_params\[\'method\'\],
\$request_params\[\'route\'\] );

// Add specified request parameters into the request.

**if** ( **isset**( \$request_params\[\'params\'\] ) ) {

**foreach** ( \$request_params\[\'params\'\] **as** \$param_name =\>
\$param_value ) {

\$request-\>set_param( \$param_name, \$param_value );

}

}

\$response = rest_do_request( \$request );

**return** \$response;

}

/\*\*

\* Prepare a response for inserting into a collection of responses.

\*

\* This is lifted from WP_REST_Controller class in the WP REST API v2
plugin.

\*

\* \@param WP_REST_Response \$response Response object.

\* \@return array Response data, ready for insertion into collection
data.

\*/

**function** prefix_prepare_for_collection( \$response ) {

**if** ( ! ( \$response **instanceof** WP_REST_Response ) ) {

**return** \$response;

}

\$data = (**array**) \$response-\>get_data();

\$server = rest_get_server();

**if** ( method_exists( \$server, \'get_compact_response_links\' ) ) {

\$links = call_user_func( **array**( \$server,
\'get_compact_response_links\' ), \$response );

} **else** {

\$links = call_user_func( **array**( \$server, \'get_response_links\' ),
\$response );

}

**if** ( ! **empty**( \$links ) ) {

\$data\[\'\_links\'\] = \$links;

}

**return** \$data;

}

/\*\*

\* Returns the JSON schema data for our registered parameters.

\*

\* \@return array \$params A PHP representation of JSON Schema data.

\*/

**function** prefix_batch_request_parameters() {

\$params = **array**();

\$params\[\'requests\'\] = **array**(

\'description\' =\> esc_html\_\_( \'An array of request objects
arguments that can be built into WP_REST_Request instances.\',
\'my-text-domain\' ),

\'type\' =\> \'array\',

\'required\' =\> true,

\'validate_callback\' =\> \'prefix_validate_requests\',

\'items\' =\> **array**(

**array**(

\'type\' =\> \'object\',

\'properties\' =\> **array**(

\'method\' =\> **array**(

\'description\' =\> esc_html\_\_( \'HTTP Method of the desired
request.\', \'my-text-domain\' ),

\'type\' =\> \'string\',

\'required\' =\> true,

\'enum\' =\> **array**(

\'GET\',

\'POST\',

\'PUT\',

\'DELETE\',

\'OPTIONS\',

),

),

\'route\' =\> **array**(

\'description\' =\> esc_html\_\_( \'Desired route for the request.\',
\'my-text-domain\' ),

\'required\' =\> true,

\'type\' =\> \'string\',

\'format\' =\> \'uri\',

),

\'params\' =\> **array**(

\'description\' =\> esc_html\_\_( \'Key value pairs of desired request
parameters.\', \'my-text-domain\' ),

\'type\' =\> \'object\',

),

),

),

),

);

**return** \$params;

}

**function** prefix_validate_requests( \$requests, \$request,
\$param_key ) {

// If requests isn\'t an array of requests then we don\'t process the
batch.

**if** ( ! is_array( \$requests ) ) {

**return** **new** WP_Error( \'rest_invald_param\', esc_html\_\_( \'The
requests parameter must be an array of requests.\' ), **array**(
\'status\' =\> 400 ) );

}

**foreach** ( \$requests **as** \$request ) {

// If the method or route is not set then we do not run the requests.

**if** ( ! **isset**( \$request\[\'method\'\] ) \|\| ! **isset**(
\$request\[\'route\'\] ) ) {

**return** **new** WP_Error( \'rest_invald_param\', esc_html\_\_( \'You
must specify the method and route for each request.\' ), **array**(
\'status\' =\> 400 ) );

}

**if** ( **isset**( \$request\[\'params\'\] ) && ! is_array(
\$request\[\'params\'\] ) ) {

**return** **new** WP_Error( \'rest_invald_param\', esc_html\_\_( \'You
must specify the params for each request as an array of named key value
pairs.\' ), **array**( \'status\' =\> 400 ) );

}

}

// This is a black listing approach to data validation.

**return** true;

}

That is quite a decent chunk of code that covers a number of topics, but
everything centers around what happens in prefix_handle_request(). Here
we are passing in an array that tells us a HTTP method, a route, and a
set of parameters we want to turn into a request. We then build the
request object for the method and route. If any parameters were
specified we use the WP_REST_Request::set_param() method to add in the
desired parameters. Once our WP_REST_Request is ready to go we
use rest_do_request to internally match that endpoint and the response
is returned to our batch endpoint response collection. Using a batch
endpoint like this can net you huge performance gains, as you will only
make one HTTP request to get a response for multiple endpoints. The
implementation of this is not necessarily the best and serves as an
example; not the only way to do this.

**First published**

August 26, 2021

**Last updated**

July 19, 2024

[PreviousRoutes & EndpointsPrevious: Routes &
Endpoints](https://developer.wordpress.org/plugins/rest-api/routes-endpoints/)

[NextResponsesNext:
Responses](https://developer.wordpress.org/plugins/rest-api/responses-2/)

-   [Developer Blog](https://developer.wordpress.org/news/)

-   [Code Reference](https://developer.wordpress.org/reference/)

-   [WP-CLI Commands](https://developer.wordpress.org/cli/commands/)

[[Home](https://developer.wordpress.org)[Plugin
Handbook](https://developer.wordpress.org/plugins/)[REST
API](https://developer.wordpress.org/plugins/rest-api/)]{.underline}Responses

Top of Form

Search

Bottom of Form

**Responses**

In this article

-   [[Overview]{.underline}](https://developer.wordpress.org/plugins/rest-api/responses-2/#overview)

-   [[WP_REST_Response]{.underline}](https://developer.wordpress.org/plugins/rest-api/responses-2/#wp_rest_response)

    -   [[Error
        Handling]{.underline}](https://developer.wordpress.org/plugins/rest-api/responses-2/#error-handling)

-   [[Linking]{.underline}](https://developer.wordpress.org/plugins/rest-api/responses-2/#linking)

[**[Overview]{.underline}**](https://developer.wordpress.org/plugins/rest-api/responses-2/#overview)

Responses in the API are what holds all of the data we want. If we made
a mistake in our request, our response's data should also inform us that
an error occurred. Responses in the WordPress REST API should return the
data we requested or an error message. Responses in the API are handled
by the WP_REST_Response class, one of the three infrastructural classes
for the API.

[**[WP_REST_Response]{.underline}**](https://developer.wordpress.org/plugins/rest-api/responses-2/#wp_rest_response)

The WP_REST_Response extends WordPress's WP_HTTP_Response class,
allowing us access to response headers, response status code, and
response data.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/rest-api/responses-2/)

// The following code will not do anything and just serves as a
demonstration.

\$response = **new** WP_REST_Response( \'This is some data\' );

// To get the response data we can use this method. It should equal
\'This is some data\'.

\$our_data = \$response-\>get_data();

// To access the HTTP status code we can use this method. The most
common status code is probably 200, which means OK!

\$our_status = \$response-\>get_status();

// To access the HTTP response headers we can use this method.

\$our_headers = \$response-\>get_headers();

The above is pretty straightforward and shows you how to get what you
need out of a response. The WP_REST_Response takes things a bit further.
You can access the matched route for the response to backtrack which
endpoint the response came from
with \$response-\>get_matched_route(). \$response-\>get_matched_handler() will
return the options registered for the endpoint that produced our
response. These could be useful for logging the API among other things.
The response class also helps us with error handling.

[**[Error
Handling]{.underline}**](https://developer.wordpress.org/plugins/rest-api/responses-2/#error-handling)

If something went terribly wrong in our request, we can
return WP_Errorobjects in our endpoint callbacks explaining what went
wrong, like this:

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/rest-api/responses-2/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/rest-api/responses-2/)

// Register our mock batch endpoint.

**function** prefix_register_broken_route() {

register_rest_route( \'my-namespace/v1\', \'/broken\', **array**(

// Supported methods for this endpoint. WP_REST_Server::READABLE
translates to GET.

\'methods\' =\> WP_REST_Server::READABLE,

// Register the callback for the endpoint.

\'callback\' =\> \'prefix_get_an_error\',

) );

}

add_action( \'rest_api_init\', \'prefix_register_broken_route\' );

/\*\*

\* Our registered endpoint callback. Notice how we are passing in
\$request as an argument.

\* By default, the WP_REST_Server will pass in the matched request
object to our callback.

\*

\* \@param WP_REST_Request \$request The current matched request object.

\*/

**function** prefix_get_an_error( \$request ) {

**return** **new** WP_Error( \'oops\', esc_html\_\_( \'This endpoint is
currently broken, try another endpoint, I promise the API is cool!
EEEK!!!!\', \'my-textdomain\' ), **array**( \'status\' =\> 400 ) );

}

That is kind of a silly example but it touches on some key things. The
most important thing to understand is that the WordPress REST API will
automatically handle changing
the [[WP_Error]{.underline}](https://developer.wordpress.org/reference/classes/wp_error/) object
into an HTTP Response containing your data. When you set the status code
in the WP_Error object your HTTP response status code will take on that
value. This comes in really handy when you need to use different error
codes like 404 for content that wasn't found, or 403 for forbidden
access. All we have to do is have our endpoint callbacks return a
request and the WP_REST_Server class will handle a lot of really
important things for us.

There are other cool things the response class can help us with, like
Linking.

[**[Linking]{.underline}**](https://developer.wordpress.org/plugins/rest-api/responses-2/#linking)

What if we wanted to get a post and the first comment for that post?
Would we write a separate endpoint to handle this use case? If we did
that, we would need to start adding a lot of endpoints to handle various
small use cases and our API index would get bloated really fast.
Response Linking provides us a way to form relations between our
resources that the API can understand. The API implements a standard
known as HAL for resource linking. Let's look at our post and comment
example, it would be better to have routes for each resource. 

Let's say we have post with ID = 1 and comment ID = 3. The comment is
assigned to post 1, so realistically the two resources could live at the
routes /my-namespace/v1/posts/1 and /my-namespace/v1/comments/3. We
would add links to the responses to create the relationships between
them. Let's look at this from the comment perspective first.

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/rest-api/responses-2/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/rest-api/responses-2/)

// Register our mock endpoints.

**function** prefix_register_my_routes() {

register_rest_route( \'my-namespace/v1\', \'/posts/(?P\<id\>\[\\d\]+)\',
**array**(

// Supported methods for this endpoint. WP_REST_Server::READABLE
translates to GET.

\'methods\' =\> WP_REST_Server::READABLE,

// Register the callback for the endpoint.

\'callback\' =\> \'prefix_get_rest_post\',

) );

register_rest_route( \'my-namespace/v1\', \'/comments\', **array**(

// Supported methods for this endpoint. WP_REST_Server::READABLE
translates to GET.

\'methods\' =\> WP_REST_Server::READABLE,

// Register the callback for the endpoint.

\'callback\' =\> \'prefix_get_rest_comments\',

// Register the post argument to limit results to a specific post
parent.

\'args\' =\> **array**(

\'post\' =\> **array**(

\'description\' =\> esc_html\_\_( \'The post ID that the comment is
assigned to.\', \'my-textdomain\' ),

\'type\' =\> \'integer\',

\'required\' =\> true,

),

),

) );

register_rest_route( \'my-namespace/v1\',
\'/comments/(?P\<id\>\[\\d\]+)\', **array**(

// Supported methods for this endpoint. WP_REST_Server::READABLE
translates to GET.

\'methods\' =\> WP_REST_Server::READABLE,

// Register the callback for the endpoint.

\'callback\' =\> \'prefix_get_rest_comment\',

) );

}

add_action( \'rest_api_init\', \'prefix_register_my_routes\' );

// Grab a post.

**function** prefix_get_rest_post( \$request ) {

\$id = (**int**) \$request\[\'id\'\];

\$post = get_post( \$id );

\$response = rest_ensure_response( **array**( \$post ) );

\$response-\>add_links( prefix_prepare_post_links( \$post ) );

**return** \$response;

}

// Prepare post links.

**function** prefix_prepare_post_links( \$post ) {

\$links = **array**();

\$replies_url = rest_url( \'my-namespace/v1/comments\' );

\$replies_url = add_query_arg( \'post\', \$post-\>ID, \$replies_url );

\$links\[\'replies\'\] = **array**(

\'href\' =\> \$replies_url,

\'embeddable\' =\> true,

);

**return** \$links;

}

// Grab a comments.

**function** prefix_get_rest_comments( \$request ) {

**if** ( ! **isset**( \$request\[\'post\'\] ) ) {

**return** **new** WP_Error( \'rest_bad_request\', esc_html\_\_( \'You
must specify the post parameter for this request.\', \'my-text-domain\'
), **array**( \'status\' =\> 400 ) );

}

\$data = **array**();

\$comments = get_comments( **array**( \'post\_\_in\' =\>
\$request\[\'post\'\] ) );

**if** ( **empty**( \$comments ) ) {

**return** **array**();

}

**foreach**( \$comments **as** \$comment ) {

\$response = rest_ensure_response( \$comment );

\$response-\>add_links( prefix_prepare_comment_links( \$comment ) );

\$data\[\] = prefix_prepare_for_collection( \$response );

}

\$response = rest_ensure_response( \$data );

**return** \$response;

}

// Grab a comment.

**function** prefix_get_rest_comment( \$request ) {

\$id = (**int**) \$request\[\'id\'\];

\$post = get_comment( \$id );

\$response = rest_ensure_response( \$comment );

\$response-\>add_links( prefix_prepare_comment_links( \$comment ) );

**return** \$response;

}

// Prepare comment links.

**function** prefix_prepare_comment_links( \$comment ) {

\$links = **array**();

**if** ( 0 !== (**int**) \$comment-\>comment_post_ID ) {

\$post = get_post( \$comment-\>comment_post_ID );

**if** ( ! **empty**( \$post-\>ID ) ) {

\$links\[\'up\'\] = **array**(

\'href\' =\> rest_url( \'my-namespace/v1/posts/\' .
\$comment-\>comment_post_ID ),

\'embeddable\' =\> true,

\'post_type\' =\> \$post-\>post_type,

);

}

}

**return** \$links;

}

/\*\*

\* Prepare a response for inserting into a collection of responses.

\*

\* This is lifted from WP_REST_Controller class in the WP REST API v2
plugin.

\*

\* \@param WP_REST_Response \$response Response object.

\* \@return array Response data, ready for insertion into collection
data.

\*/

**function** prefix_prepare_for_collection( \$response ) {

**if** ( ! ( \$response **instanceof** WP_REST_Response ) ) {

**return** \$response;

}

\$data = (**array**) \$response-\>get_data();

\$server = rest_get_server();

**if** ( method_exists( \$server, \'get_compact_response_links\' ) ) {

\$links = call_user_func( **array**( \$server,
\'get_compact_response_links\' ), \$response );

} **else** {

\$links = call_user_func( **array**( \$server, \'get_response_links\' ),
\$response );

}

**if** ( ! **empty**( \$links ) ) {

\$data\[\'\_links\'\] = \$links;

}

**return** \$data;

}

As you can see in the example above we are using links to create the
relations between our resources. If the post has comments, our endpoint
callback will add a link to the comments route specifying the \`post\`
parameter to match our current post ID. So if you were to follow that
route you would now get the comments that have that assigned post ID. If
you search for comments then each comment will have a link point \`up\`
to the post. \`up\` has special meaning in links using the HAL spec. If
we follow an up link for a comment then we will be returned the post
that is the comment parent. Linking is pretty awesome, but it gets
better.

The WordPress REST API also supports what is referred to as embedding.
If you notice in both of the links we added, we specified
that embeddable =\> true. This enables us to embed our linked data in
our responses. So if we wanted to grab comment 3 and its assigned post
we could make this
request https://ourawesomesite.com/wp-json/my-namespace/v1/comments/3?\_embed.
The \_embed parameter tells the API we want all of the embeddable
resource links for our request to also be added to the API. Using embed
is a performance gain as the multiple resources are all handled in one
HTTP Request.

Smart use of embedding and links make the WordPress REST API incredibly
flexible and powerful for interacting with WordPress.

**First published**

August 26, 2021

**Last updated**

July 19, 2024

[PreviousRequestsPrevious:
Requests](https://developer.wordpress.org/plugins/rest-api/requests/)

[NextSchemaNext:
Schema](https://developer.wordpress.org/plugins/rest-api/schema/)

Schema

-   [Developer Blog](https://developer.wordpress.org/news/)

-   [Code Reference](https://developer.wordpress.org/reference/)

-   [WP-CLI Commands](https://developer.wordpress.org/cli/commands/)

[[Home](https://developer.wordpress.org)[Plugin
Handbook](https://developer.wordpress.org/plugins/)[REST
API](https://developer.wordpress.org/plugins/rest-api/)]{.underline}Schema

Top of Form

Search

Bottom of Form

**Schema**

In this article

-   [[Overview]{.underline}](https://developer.wordpress.org/plugins/rest-api/schema/#overview)

-   [[JSON
    Schema]{.underline}](https://developer.wordpress.org/plugins/rest-api/schema/#json-schema)

-   [[Resource
    Schema]{.underline}](https://developer.wordpress.org/plugins/rest-api/schema/#resource-schema)

-   [[Argument
    Schema]{.underline}](https://developer.wordpress.org/plugins/rest-api/schema/#argument-schema)

-   [[Overview]{.underline}](https://developer.wordpress.org/plugins/rest-api/schema/#overview-2)

[↑ [Back to
top]{.underline}](https://developer.wordpress.org/plugins/rest-api/schema/#wp--skip-link--target)

[**[Overview]{.underline}**](https://developer.wordpress.org/plugins/rest-api/schema/#overview)

Schema is data that tells us how are other data should be structured.
Most databases implement some form of schema which enables us to reason
about our data in a more structured manner. The WordPress REST API
utilizes JSON Schema to handle the structuring of its data. You can
implement endpoints without using schema, but you will be missing out on
a lot of things. It is up to you to decide what suits you best.

[**[JSON
Schema]{.underline}**](https://developer.wordpress.org/plugins/rest-api/schema/#json-schema)

First, let's talk about JSON a bit. JSON is a human readable data format
that resembles JavaScript objects. JSON stands for JavaScript Object
Notation. JSON is growing wildly in popularity and seems to be taking
the world of data structure by storm. The WordPress REST API uses a
special specification for JSON known as JSON schema. To learn more about
JSON Schema please check out the [[JSON Schema
website]{.underline}](http://json-schema.org/) and this [[easier to
understand introduction to JSON
Schema]{.underline}](https://spacetelescope.github.io/understanding-json-schema/index.html).
Schema affords us many benefits: improved testing, discoverability, and
overall better structure. Let's look at a JSON blob of data.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/rest-api/schema/)

{

\"shouldBeArray\": \'LOL definitely not an array\',

\"shouldBeInteger\": \[\'lolz\', \'you\', \'need\', \'schema\'\],

\"shouldBeString\": 123456789

}

A JSON parser will go through that data no problem and won't complain
about anything, because it is valid JSON. The clients and servers know
nothing about the data and what to expect they just see the JSON. By
implementing schema we can actually simplify our codebase. Schema will
help structure our data better so our applications can more easily
reason about our interactions with the WordPress REST API. The WordPress
REST API does not force you to use schema, but it is encouraged. There
are two ways in which schema data is incorporated into the API; schema
for resources and schema for our registered arguments.

[**[Resource
Schema]{.underline}**](https://developer.wordpress.org/plugins/rest-api/schema/#resource-schema)

The schema for a resource indicates what fields are present for a
particular object. When we register our routes we can also specify the
resource schema for the route. Let's look at what a simple comment
schema might look like in a PHP representation of JSON schema.

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/rest-api/schema/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/rest-api/schema/)

// Register our routes.

**function** prefix_register_my_comment_route() {

register_rest_route( \'my-namespace/v1\', \'/comments\', **array**(

// Notice how we are registering multiple endpoints the \'schema\'
equates to an OPTIONS request.

**array**(

\'methods\' =\> \'GET\',

\'callback\' =\> \'prefix_get_comment_sample\',

),

// Register our schema callback.

\'schema\' =\> \'prefix_get_comment_schema\',

) );

}

add_action( \'rest_api_init\', \'prefix_register_my_comment_route\' );

/\*\*

\* Grabs the five most recent comments and outputs them as a rest
response.

\*

\* \@param WP_REST_Request \$request Current request.

\*/

**function** prefix_get_comment_sample( \$request ) {

\$args = **array**(

\'post_per_page\' =\> 5,

);

\$comments = get_comments( \$args );

\$data = **array**();

**if** ( **empty**( \$comments ) ) {

**return** rest_ensure_response( \$data );

}

**foreach** ( \$comments **as** \$comment ) {

\$response = prefix_rest_prepare_comment( \$comment, \$request );

\$data\[\] = prefix_prepare_for_collection( \$response );

}

// Return all of our comment response data.

**return** rest_ensure_response( \$data );

}

/\*\*

\* Matches the comment data to the schema we want.

\*

\* \@param WP_Comment \$comment The comment object whose response is
being prepared.

\*/

**function** prefix_rest_prepare_comment( \$comment, \$request ) {

\$comment_data = **array**();

\$schema = prefix_get_comment_schema( \$request );

// We are also renaming the fields to more understandable names.

**if** ( **isset**( \$schema\[\'properties\'\]\[\'id\'\] ) ) {

\$comment_data\[\'id\'\] = (**int**) \$comment-\>comment_id;

}

**if** ( **isset**( \$schema\[\'properties\'\]\[\'author\'\] ) ) {

\$comment_data\[\'author\'\] = (**int**) \$comment-\>user_id;

}

**if** ( **isset**( \$schema\[\'properties\'\]\[\'content\'\] ) ) {

\$comment_data\[\'content\'\] = apply_filters( \'comment_text\',
\$comment-\>comment_content, \$comment );

}

**return** rest_ensure_response( \$comment_data );

}

/\*\*

\* Prepare a response for inserting into a collection of responses.

\*

\* This is copied from WP_REST_Controller class in the WP REST API v2
plugin.

\*

\* \@param WP_REST_Response \$response Response object.

\* \@return array Response data, ready for insertion into collection
data.

\*/

**function** prefix_prepare_for_collection( \$response ) {

**if** ( ! ( \$response **instanceof** WP_REST_Response ) ) {

**return** \$response;

}

\$data = (**array**) \$response-\>get_data();

\$server = rest_get_server();

**if** ( method_exists( \$server, \'get_compact_response_links\' ) ) {

\$links = call_user_func( **array**( \$server,
\'get_compact_response_links\' ), \$response );

} **else** {

\$links = call_user_func( **array**( \$server, \'get_response_links\' ),
\$response );

}

**if** ( ! **empty**( \$links ) ) {

\$data\[\'\_links\'\] = \$links;

}

**return** \$data;

}

/\*\*

\* Get our sample schema for comments.

\*

\* \@param WP_REST_Request \$request Current request.

\*/

**function** prefix_get_comment_schema( \$request ) {

\$schema = **array**(

// This tells the spec of JSON Schema we are using which is draft 4.

\'\$schema\' =\> \'http://json-schema.org/draft-04/schema#\',

// The title property marks the identity of the resource.

\'title\' =\> \'comment\',

\'type\' =\> \'object\',

// In JSON Schema you can specify object properties in the properties
attribute.

\'properties\' =\> **array**(

\'id\' =\> **array**(

\'description\' =\> esc_html\_\_( \'Unique identifier for the object.\',
\'my-textdomain\' ),

\'type\' =\> \'integer\',

\'context\' =\> **array**( \'view\', \'edit\', \'embed\' ),

\'readonly\' =\> true,

),

\'author\' =\> **array**(

\'description\' =\> esc_html\_\_( \'The id of the user object, if author
was a user.\', \'my-textdomain\' ),

\'type\' =\> \'integer\',

),

\'content\' =\> **array**(

\'description\' =\> esc_html\_\_( \'The content for the object.\',
\'my-textdomain\' ),

\'type\' =\> \'string\',

),

),

);

**return** \$schema;

}

If you notice, each comment resource now matches up to our schema that
we specified. We made this switch in prefix_rest_prepare_comment(). By
creating schema for our resources, we can now view this schema by
making OPTIONS requests. Why is this useful? If we wanted other
languages, JavaScript for example, to interpret our data and validate
the data from our endpoint, JavaScript would need to know how our data
is structured. When we provide schema, we open the doors for other
authors, and ourselves, to build on top of our endpoints in a consistent
manner.

Schema provides machine readable data, so potentially anything that can
read JSON can understand what kind of data it is looking at. When we
look at the API index by making a GET request
to https://ourawesomesite.com/wp-json/, we are returned the schema of
our API, enabling others to write client libraries to interpret our
data. This process of reading schema data is known as discovery. When we
have provided schema for a resource we make that resource discoverable
via OPTIONS requests to that route. Exposing resource schema is only one
part of our schema puzzle. We also want to use schema for our registered
arguments.

[**[Argument
Schema]{.underline}**](https://developer.wordpress.org/plugins/rest-api/schema/#argument-schema)

When we register request arguments for an endpoint, we can also use JSON
Schema to provide us data about what the arguments should be. This
enables us to write validation libraries that can be reused as our
endpoints expand. Schema is more work upfront, but if you are going to
write a production application that will grow, you should definitely
consider using schema. Let's look at an example of using argument schema
and validation.

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/rest-api/schema/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/rest-api/schema/)

// Register our routes.

**function** prefix_register_my_arg_route() {

register_rest_route( \'my-namespace/v1\', \'/schema-arg\', **array**(

// Here we register our endpoint.

**array**(

\'methods\' =\> \'GET\',

\'callback\' =\> \'prefix_get_item\',

\'args\' =\> prefix_get_endpoint_args(),

),

) );

}

// Hook registration into \'rest_api_init\' hook.

add_action( \'rest_api_init\', \'prefix_register_my_arg_route\' );

/\*\*

\* Returns the request argument \`my-arg\` as a rest response.

\*

\* \@param WP_REST_Request \$request Current request.

\*/

**function** prefix_get_item( \$request ) {

// If we didn\'t use required in the schema this would throw an error
when my arg is not set.

**return** rest_ensure_response( \$request\[\'my-arg\'\] );

}

/\*\*

\* Get the argument schema for this example endpoint.

\*/

**function** prefix_get_endpoint_args() {

\$args = **array**();

// Here we add our PHP representation of JSON Schema.

\$args\[\'my-arg\'\] = **array**(

\'description\' =\> esc_html\_\_( \'This is the argument our endpoint
returns.\', \'my-textdomain\' ),

\'type\' =\> \'string\',

\'validate_callback\' =\> \'prefix_validate_my_arg\',

\'sanitize_callback\' =\> \'prefix_sanitize_my_arg\',

\'required\' =\> true,

);

**return** \$args;

}

/\*\*

\* Our validation callback for \`my-arg\` parameter.

\*

\* \@param mixed \$value Value of the my-arg parameter.

\* \@param WP_REST_Request \$request Current request object.

\* \@param string \$param The name of the parameter in this case,
\'my-arg\'.

\*/

**function** prefix_validate_my_arg( \$value, \$request, \$param ) {

\$attributes = \$request-\>get_attributes();

**if** ( **isset**( \$attributes\[\'args\'\]\[ \$param \] ) ) {

\$argument = \$attributes\[\'args\'\]\[ \$param \];

// Check to make sure our argument is a string.

**if** ( \'string\' === \$argument\[\'type\'\] && ! is_string( \$value )
) {

**return** **new** WP_Error( \'rest_invalid_param\', sprintf(
esc_html\_\_( \'%1\$s is not of type %2\$s\', \'my-textdomain\' ),
\$param, \'string\' ), **array**( \'status\' =\> 400 ) );

}

} **else** {

// This code won\'t execute because we have specified this argument as
required.

// If we reused this validation callback and did not have required args
then this would fire.

**return** **new** WP_Error( \'rest_invalid_param\', sprintf(
esc_html\_\_( \'%s was not registered as a request argument.\',
\'my-textdomain\' ), \$param ), **array**( \'status\' =\> 400 ) );

}

// If we got this far then the data is valid.

**return** true;

}

/\*\*

\* Our santization callback for \`my-arg\` parameter.

\*

\* \@param mixed \$value Value of the my-arg parameter.

\* \@param WP_REST_Request \$request Current request object.

\* \@param string \$param The name of the parameter in this case,
\'my-arg\'.

\*/

**function** prefix_sanitize_my_arg( \$value, \$request, \$param ) {

\$attributes = \$request-\>get_attributes();

**if** ( **isset**( \$attributes\[\'args\'\]\[ \$param \] ) ) {

\$argument = \$attributes\[\'args\'\]\[ \$param \];

// Check to make sure our argument is a string.

**if** ( \'string\' === \$argument\[\'type\'\] ) {

**return** sanitize_text_field( \$value );

}

} **else** {

// This code won\'t execute because we have specified this argument as
required.

// If we reused this validation callback and did not have required args
then this would fire.

**return** **new** WP_Error( \'rest_invalid_param\', sprintf(
esc_html\_\_( \'%s was not registered as a request argument.\',
\'my-textdomain\' ), \$param ), **array**( \'status\' =\> 400 ) );

}

// If we got this far then something went wrong don\'t use user input.

**return** **new** WP_Error( \'rest_api_sad\', esc_html\_\_( \'Something
went terribly wrong.\', \'my-textdomain\' ), **array**( \'status\' =\>
500 ) );

}

In the example above we have abstracted away from using
the \'my-arg\'name. We can use these validation and sanitizing functions
for any other argument that should be a string we have specified schema
for. As your codebase and endpoints grow, schema will help keep your
code lightweight and maintainable. Without schema you can validate and
sanitize, however it will be more difficult to keep track of which
functions should be validating what. By adding schema to request
arguments we can also expose our argument schema to clients, so
validation libraries can be built client side which can help performance
by preventing invalid requests from ever being sent to the API.

If you are uncomfortable with using schema, it is still possible to have
validate/sanitize callbacks for each of your arguments, and in some
cases it will make the most sense to do a custom validation.

[**[Overview]{.underline}**](https://developer.wordpress.org/plugins/rest-api/schema/#overview-2)

Schema can seem silly at points and possibly like unnecessary work, but
if you want maintainable, discoverable, and easily extensible endpoints,
it is essential to use schema. Schema also helps to self document your
endpoints both for humans and computers!

**First published**

August 26, 2021

**Last updated**

July 19, 2024

[PreviousResponsesPrevious:
Responses](https://developer.wordpress.org/plugins/rest-api/responses-2/)

[NextController ClassesNext: Controller
Classes](https://developer.wordpress.org/plugins/rest-api/controller-classes/)

-   [Developer Blog](https://developer.wordpress.org/news/)

-   [Code Reference](https://developer.wordpress.org/reference/)

-   [WP-CLI Commands](https://developer.wordpress.org/cli/commands/)

[[Home](https://developer.wordpress.org)[Plugin
Handbook](https://developer.wordpress.org/plugins/)[REST
API](https://developer.wordpress.org/plugins/rest-api/)]{.underline}Controller
Classes

Top of Form

Search

Bottom of Form

**Controller Classes**

In this article

-   [[Overview]{.underline}](https://developer.wordpress.org/plugins/rest-api/controller-classes/#overview)

-   [[Controllers]{.underline}](https://developer.wordpress.org/plugins/rest-api/controller-classes/#controllers)

-   [[Overview & The
    Future]{.underline}](https://developer.wordpress.org/plugins/rest-api/controller-classes/#overview-the-future)

[↑ [Back to
top]{.underline}](https://developer.wordpress.org/plugins/rest-api/controller-classes/#wp--skip-link--target)

[**[Overview]{.underline}**](https://developer.wordpress.org/plugins/rest-api/controller-classes/#overview)

When writing endpoints it can be helpful to use a controller class to
handle the functionality of an endpoint. Controller classes will provide
a standard way to interact with the API and also a more maintainable way
to interact with the API. WordPress's current minimum PHP version is
5.2, if you are developing endpoints that will be used by the WordPress
ecosystem at large you should consider supporting WordPress's minimum
requirements.

PHP 5.2 does not have namespacing built into it. This means that every
function you declare will be in the global scope. If you decide to use a
common function name for endpoints like get_items() and another plugin
also registers that function, PHP will fail with a fatal error. This is
because the function get_items() is being declared twice. By wrapping
our endpoints we can avoid these naming conflicts and also have a
consistent way to interact with the API.

[**[Controllers]{.underline}**](https://developer.wordpress.org/plugins/rest-api/controller-classes/#controllers)

Controllers typically do one thing; they receive input, and generate
output. For the WordPress REST API our controllers will handle request
input as WP_REST_Request objects and generate response output
as WP_REST_Response objects. Let's look at an example controller class:

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/rest-api/controller-classes/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/rest-api/controller-classes/)

**class** My_REST_Posts_Controller {

// Here initialize our namespace and resource name.

**public** **function** \_\_construct() {

\$this-\>namespace = \'/my-namespace/v1\';

\$this-\>resource_name = \'posts\';

}

// Register our routes.

**public** **function** register_routes() {

register_rest_route( \$this-\>namespace, \'/\' . \$this-\>resource_name,
**array**(

// Here we register the readable endpoint for collections.

**array**(

\'methods\' =\> \'GET\',

\'callback\' =\> **array**( \$this, \'get_items\' ),

\'permission_callback\' =\> **array**( \$this,
\'get_items_permissions_check\' ),

),

// Register our schema callback.

\'schema\' =\> **array**( \$this, \'get_item_schema\' ),

) );

register_rest_route( \$this-\>namespace, \'/\' . \$this-\>resource_name
. \'/(?P\<id\>\[\\d\]+)\', **array**(

// Notice how we are registering multiple endpoints the \'schema\'
equates to an OPTIONS request.

**array**(

\'methods\' =\> \'GET\',

\'callback\' =\> **array**( \$this, \'get_item\' ),

\'permission_callback\' =\> **array**( \$this,
\'get_item_permissions_check\' ),

),

// Register our schema callback.

\'schema\' =\> **array**( \$this, \'get_item_schema\' ),

) );

}

/\*\*

\* Check permissions for the posts.

\*

\* \@param WP_REST_Request \$request Current request.

\*/

**public** **function** get_items_permissions_check( \$request ) {

**if** ( ! current_user_can( \'read\' ) ) {

**return** **new** WP_Error( \'rest_forbidden\', esc_html\_\_( \'You
cannot view the post resource.\' ), **array**( \'status\' =\>
\$this-\>authorization_status_code() ) );

}

**return** true;

}

/\*\*

\* Grabs the five most recent posts and outputs them as a rest response.

\*

\* \@param WP_REST_Request \$request Current request.

\*/

**public** **function** get_items( \$request ) {

\$args = **array**(

\'post_per_page\' =\> 5,

);

\$posts = get_posts( \$args );

\$data = **array**();

**if** ( **empty**( \$posts ) ) {

**return** rest_ensure_response( \$data );

}

**foreach** ( \$posts **as** \$post ) {

\$response = \$this-\>prepare_item_for_response( \$post, \$request );

\$data\[\] = \$this-\>prepare_response_for_collection( \$response );

}

// Return all of our comment response data.

**return** rest_ensure_response( \$data );

}

/\*\*

\* Check permissions for the posts.

\*

\* \@param WP_REST_Request \$request Current request.

\*/

**public** **function** get_item_permissions_check( \$request ) {

**if** ( ! current_user_can( \'read\' ) ) {

**return** **new** WP_Error( \'rest_forbidden\', esc_html\_\_( \'You
cannot view the post resource.\' ), **array**( \'status\' =\>
\$this-\>authorization_status_code() ) );

}

**return** true;

}

/\*\*

\* Grabs the five most recent posts and outputs them as a rest response.

\*

\* \@param WP_REST_Request \$request Current request.

\*/

**public** **function** get_item( \$request ) {

\$id = (**int**) \$request\[\'id\'\];

\$post = get_post( \$id );

**if** ( **empty**( \$post ) ) {

**return** rest_ensure_response( **array**() );

}

\$response = prepare_item_for_response( \$post );

// Return all of our post response data.

**return** \$response;

}

/\*\*

\* Matches the post data to the schema we want.

\*

\* \@param WP_Post \$post The comment object whose response is being
prepared.

\*/

**public** **function** prepare_item_for_response( \$post, \$request ) {

\$post_data = **array**();

\$schema = \$this-\>get_item_schema( \$request );

// We are also renaming the fields to more understandable names.

**if** ( **isset**( \$schema\[\'properties\'\]\[\'id\'\] ) ) {

\$post_data\[\'id\'\] = (**int**) \$post-\>ID;

}

**if** ( **isset**( \$schema\[\'properties\'\]\[\'content\'\] ) ) {

\$post_data\[\'content\'\] = apply_filters( \'the_content\',
\$post-\>post_content, \$post );

}

**return** rest_ensure_response( \$post_data );

}

/\*\*

\* Prepare a response for inserting into a collection of responses.

\*

\* This is copied from WP_REST_Controller class in the WP REST API v2
plugin.

\*

\* \@param WP_REST_Response \$response Response object.

\* \@return array Response data, ready for insertion into collection
data.

\*/

**public** **function** prepare_response_for_collection( \$response ) {

**if** ( ! ( \$response **instanceof** WP_REST_Response ) ) {

**return** \$response;

}

\$data = (**array**) \$response-\>get_data();

\$server = rest_get_server();

**if** ( method_exists( \$server, \'get_compact_response_links\' ) ) {

\$links = call_user_func( **array**( \$server,
\'get_compact_response_links\' ), \$response );

} **else** {

\$links = call_user_func( **array**( \$server, \'get_response_links\' ),
\$response );

}

**if** ( ! **empty**( \$links ) ) {

\$data\[\'\_links\'\] = \$links;

}

**return** \$data;

}

/\*\*

\* Get our sample schema for a post.

\*

\* \@param WP_REST_Request \$request Current request.

\*/

**public** **function** get_item_schema( \$request ) {

\$schema = **array**(

// This tells the spec of JSON Schema we are using which is draft 4.

\'\$schema\' =\> \'http://json-schema.org/draft-04/schema#\',

// The title property marks the identity of the resource.

\'title\' =\> \'post\',

\'type\' =\> \'object\',

// In JSON Schema you can specify object properties in the properties
attribute.

\'properties\' =\> **array**(

\'id\' =\> **array**(

\'description\' =\> esc_html\_\_( \'Unique identifier for the object.\',
\'my-textdomain\' ),

\'type\' =\> \'integer\',

\'context\' =\> **array**( \'view\', \'edit\', \'embed\' ),

\'readonly\' =\> true,

),

\'content\' =\> **array**(

\'description\' =\> esc_html\_\_( \'The content for the object.\',
\'my-textdomain\' ),

\'type\' =\> \'string\',

),

),

);

**return** \$schema;

}

// Sets up the proper HTTP status code for authorization.

**public** **function** authorization_status_code() {

\$status = 401;

**if** ( is_user_logged_in() ) {

\$status = 403;

}

**return** \$status;

}

}

// Function to register our new routes from the controller.

**function** prefix_register_my_rest_routes() {

\$controller = **new** My_REST_Posts_Controller();

\$controller-\>register_routes();

}

add_action( \'rest_api_init\', \'prefix_register_my_rest_routes\' );

[**[Overview & The
Future]{.underline}**](https://developer.wordpress.org/plugins/rest-api/controller-classes/#overview-the-future)

Controller classes tackle two big problems for us while developing
endpoints; lack of namespacing and consistent structures. It is
important to note that you should not abuse inheritance of your
endpoints. For example: if you wrote a controller class for a posts
endpoint, like the above example, and wanted to support custom post
types as well, you should **NOT** extend
your My_REST_Posts_Controller like this class My_CPT_REST_Controller
extends My_REST_Posts_Controller.

Instead you should either create an entirely separate controller class
or make My_REST_Posts_Controller handle all available post types. When
you start go down the dark chasm of inheritance, it is important to
understand that if the parent classes ever have to change at any point
and your subclasses are dependent on them, you will have a major
headache. In most cases, you will want to create a base controller class
as either an interfaceor abstract class, that each of your endpoint
controllers can implement or extend. The abstract class approach is
being taken by the WP REST API team for the potential inclusion to core
for the WP_REST_Controllerclass.

Currently, "core endpoints" supporting posts, post types, post statuses,
revisions, taxonomies, terms, users, comments, and attachments/media
resources, are being developed in a feature plugin that will hopefully
be moved into WordPress core at some point. Within the plugin is a
proposed WP_REST_Controller class that can be used to build your own
controllers for your endpoints. WP_REST_Controller features a lot of
advantages and a consistent way to create endpoints for the API.

**First published**

August 26, 2021

**Last updated**

July 19, 2024

[PreviousSchemaPrevious:
Schema](https://developer.wordpress.org/plugins/rest-api/schema/)

[NextJavaScriptNext:
JavaScript](https://developer.wordpress.org/plugins/javascript/)

Heartbeat API

-   [Developer Blog](https://developer.wordpress.org/news/)

-   [Code Reference](https://developer.wordpress.org/reference/)

-   [WP-CLI Commands](https://developer.wordpress.org/cli/commands/)

[[Home](https://developer.wordpress.org)[Plugin
Handbook](https://developer.wordpress.org/plugins/)[JavaScript](https://developer.wordpress.org/plugins/javascript/)]{.underline}Heartbeat
API

Top of Form

Search

Bottom of Form

**Heartbeat API**

In this article

-   [[How it
    works]{.underline}](https://developer.wordpress.org/plugins/javascript/heartbeat-api/#how-it-works)

-   [[Using the
    API]{.underline}](https://developer.wordpress.org/plugins/javascript/heartbeat-api/#using-the-api)

    -   [[Sending Data to the
        Server]{.underline}](https://developer.wordpress.org/plugins/javascript/heartbeat-api/#sending-data-to-the-server)

    -   [[Receiving and Responding on the
        Server]{.underline}](https://developer.wordpress.org/plugins/javascript/heartbeat-api/#receiving-and-responding-on-the-server)

    -   [[Processing the
        Response]{.underline}](https://developer.wordpress.org/plugins/javascript/heartbeat-api/#processing-the-response)

[↑ [Back to
top]{.underline}](https://developer.wordpress.org/plugins/javascript/heartbeat-api/#wp--skip-link--target)

The Heartbeat API is a simple server polling API built in to WordPress,
allowing near-real-time frontend updates.

[**[How it
works]{.underline}**](https://developer.wordpress.org/plugins/javascript/heartbeat-api/#how-it-works)

When the page loads, the client-side heartbeat code sets up an interval
(called the "tick") to run every 15-120 seconds. When it runs, heartbeat
gathers data to send via a jQuery event, then sends this to the server
and waits for a response. On the server, an admin-ajax handler takes the
passed data, prepares a response, filters the response, then returns the
data in JSON format. The client receives this data and fires a final
jQuery event to indicate the data has been received.

The basic process for custom Heartbeat events is:

1.  Add additional fields to the data to be sent
    (JS heartbeat-send event)

2.  Detect sent fields in PHP, and add additional response fields
    (heartbeat_received filter)

3.  Process returned data in JS (JS heartbeat-tick)

(You can choose to use only one or two of these events, depending on
what functionality you need.)

[**[Using the
API]{.underline}**](https://developer.wordpress.org/plugins/javascript/heartbeat-api/#using-the-api)

Using the heartbeat API requires two separate pieces of functionality:
send and receive callbacks in JavaScript, and a server-side filter to
process passed data in PHP.

[**[Sending Data to the
Server]{.underline}**](https://developer.wordpress.org/plugins/javascript/heartbeat-api/#sending-data-to-the-server)

When Heartbeat sends data to the server, you can include custom data.
This can be any data you want to send to the server, or a simple true
value to indicate you are expecting data.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/heartbeat-api/)

jQuery( document ).on( \'heartbeat-send\', **function** ( event, data )
{

// Add additional data to Heartbeat data.

data.myplugin_customfield = \'some_data\';

});

[**[Receiving and Responding on the
Server]{.underline}**](https://developer.wordpress.org/plugins/javascript/heartbeat-api/#receiving-and-responding-on-the-server)

On the server side, you can then detect this data, and add additional
data to the response.

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/javascript/heartbeat-api/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/heartbeat-api/)

/\*\*

\* Receive Heartbeat data and respond.

\*

\* Processes data received via a Heartbeat request, and returns
additional data to pass back to the front end.

\*

\* \@param array \$response Heartbeat response data to pass back to
front end.

\* \@param array \$data Data received from the front end (unslashed).

\*

\* \@return array

\*/

**function** myplugin_receive_heartbeat( **array** \$response, **array**
\$data ) {

// If we didn\'t receive our data, don\'t send any back.

**if** ( **empty**( \$data\[\'myplugin_customfield\'\] ) ) {

**return** \$response;

}

// Calculate our data and pass it back. For this example, we\'ll hash
it.

\$received_data = \$data\[\'myplugin_customfield\'\];

\$response\[\'myplugin_customfield_hashed\'\] = sha1( \$received_data );

**return** \$response;

}

add_filter( \'heartbeat_received\', \'myplugin_receive_heartbeat\', 10,
2 );

[**[Processing the
Response]{.underline}**](https://developer.wordpress.org/plugins/javascript/heartbeat-api/#processing-the-response)

Back on the frontend, you can then handle receiving this data back.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/heartbeat-api/)

jQuery( document ).on( \'heartbeat-tick\', **function** ( event, data )
{

// Check for our data, and use it.

**if** ( ! data.myplugin_customfield_hashed ) {

**return**;

}

alert( \'The hash is \' + data.myplugin_customfield_hashed );

});

Not every feature will need all three of these steps. For example, if
you don't need to send any data to the server, you can use just the
latter two steps.

**First published**

January 17, 2017

**Last updated**

November 17, 2022

[PreviousJavaScriptPrevious:
JavaScript](https://developer.wordpress.org/plugins/javascript/)

jQuery

-   [Developer Blog](https://developer.wordpress.org/news/)

-   [Code Reference](https://developer.wordpress.org/reference/)

-   [WP-CLI Commands](https://developer.wordpress.org/cli/commands/)

[[Home](https://developer.wordpress.org)[Plugin
Handbook](https://developer.wordpress.org/plugins/)[JavaScript](https://developer.wordpress.org/plugins/javascript/)]{.underline}jQuery

Top of Form

Search

Bottom of Form

**jQuery**

**Using jQuery**

Your jQuery script runs on the user's browser after your WordPress
webpage is received. A basic jQuery statement has two parts: a selector
that determines which HTML elements the code applies to, and an action
or event, which determines what the code does or what it reacts to. The
basic event statement looks like this:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/jquery/)

jQuery.(selector).event(**function**);

When an event, such as a mouse click, occurs in an HTML element selected
by the selector, the function that is defined inside the final set of
parentheses is executed.

All the following code examples are based on this HTML page content.
Assume it appears on your plugin's admin settings screen, defined by the
file myplugin_settings.php. It is a simple table with radio buttons next
to each title.

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/javascript/jquery/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/jquery/)

\<form id=\"radioform\"\>

\<table\>

\<tbody\>

\<tr\>

\<td\>\<input class=\"pref\" checked=\"checked\" name=\"book\"
type=\"radio\" value=\"Sycamore Row\" /\>Sycamore Row\</td\>

\<td\>John Grisham\</td\>

\</tr\>

\<tr\>

\<td\>\<input class=\"pref\" name=\"book\" type=\"radio\" value=\"Dark
Witch\" /\>Dark Witch\</td\>

\<td\>Nora Roberts\</td\>

\</tr\>

\</tbody\>

\</table\>

\</form\>

The output could look something like this on your settings page.

![sample table](media/image1.png){width="4.632638888888889in"
height="1.3381944444444445in"}

In the [[article on
AJAX]{.underline}](https://developer.wordpress.org/plugin/javascript/ajax/),
we will build an AJAX exchange that saves the user selection in usermeta
and adds the number of posts tagged with the selected title. Not a very
practical application, but it illustrates all the important steps.
jQuery code can either reside in an external file or be output to the
page inside a \<script\> block. We will focus on the external file
variation because passing values from PHP requires special attention.
The same code can be output to the page if that seems more expedient to
you.

**Selector and Event**

The selector is the same form as CSS selectors: \".class\" or \"#id\".
There's many [[more
forms]{.underline}](http://api.jquery.com/category/selectors/), but
these are the two you will frequently use. In our example, we will use
class \".pref\". There's also a slew of
possible [[events]{.underline}](http://api.jquery.com/category/events/),
one you will likely use a lot is *'click'*. In our example we will
use *'change'* to capture a radio button selection. Be aware that jQuery
events are often named somewhat differently than those with JavaScript.
So far, after we add in an empty anonymous function, our example
statement looks like this:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/jquery/)

\$.(\".pref\").change(**function**(){

/\*do stuff\*/

});

This code will "do stuff" when any element of the "pref" class changes.

**Note:** This code snippet, and all examples on this page, are for
illustrating the use of AJAX. The code is not suitable for production
environments because related operations such
as [[sanitization]{.underline}](https://developer.wordpress.org/plugins/plugin-security/securing-input/), [[security]{.underline}](https://developer.wordpress.org/plugins/plugin-security/user-capabilities-nonces/#nonces), [[error
handling]{.underline}](http://www.sitepoint.com/error-handling-in-php/),
and [[internationalization]{.underline}](https://developer.wordpress.org/plugins/javascript/internationalization/) have
been intentionally omitted. Be sure to always address these important
operations in your production code.

**First published**

October 28, 2014

**Last updated**

November 17, 2022

[PreviousHeartbeat APIPrevious: Heartbeat
API](https://developer.wordpress.org/plugins/javascript/heartbeat-api/)

[NextAJAXNext:
AJAX](https://developer.wordpress.org/plugins/javascript/ajax/)

#  **AJAX**

In this article

-   [[What is
    AJAX?]{.underline}](https://developer.wordpress.org/plugins/javascript/ajax/#what-is-ajax)

-   [[Why use
    AJAX?]{.underline}](https://developer.wordpress.org/plugins/javascript/ajax/#why-use-ajax)

-   [[How Do I Use
    AJAX?]{.underline}](https://developer.wordpress.org/plugins/javascript/ajax/#how-do-i-use-ajax)

-   [[Using AJAX with
    jQuery]{.underline}](https://developer.wordpress.org/plugins/javascript/ajax/#using-ajax-with-jquery)

    -   [[URL]{.underline}](https://developer.wordpress.org/plugins/javascript/ajax/#url)

    -   [[Data]{.underline}](https://developer.wordpress.org/plugins/javascript/ajax/#data)

    -   [[Nonce]{.underline}](https://developer.wordpress.org/plugins/javascript/ajax/#nonce)

    -   [[Action]{.underline}](https://developer.wordpress.org/plugins/javascript/ajax/#action)

    -   [[Callback]{.underline}](https://developer.wordpress.org/plugins/javascript/ajax/#callback)

[**[What is
AJAX?]{.underline}**](https://developer.wordpress.org/plugins/javascript/ajax/#what-is-ajax)

AJAX is the acronym for Asynchronous JavaScript And XML. XML is a data
exchange format and UX is software developer shorthand for User
Experience. Ajax is an Internet communications technique that allows a
web page displayed in a user's browser to request specific information
from a server and display this new information on the same page without
the need to reload the entire page. You can already imagine how this
improves the user experience.

While XML is the traditional data exchange format used, the exchange can
actually be any convenient format. When working with PHP code, many
developers favor JSON because the internal data structure created from
the transmitted data stream is easier to interface with.

To see AJAX in action, go to your WordPress administration area and add
a category or tag. Pay close attention when you click the Add New
button, notice the page changes but does not actually reload. Not
convinced? Check your browser's back history, if the page had reloaded,
you would see two entries for the page.

AJAX does not even require a user action to work. Google Docs
automatically saves your document every few minutes with AJAX without
you needing to initiate a save action.

[**[Why use
AJAX?]{.underline}**](https://developer.wordpress.org/plugins/javascript/ajax/#why-use-ajax)

Obviously, it improves the user experience. Instead of presenting a
boring, static page, AJAX allows you to present a dynamic, responsive,
user friendly experience. Users can get immediate feedback that some
action they took was right or wrong. No need to submit an entire form
before finding out there is a mistake in one field. Important fields can
be validated as soon as the data is entered. Or suggestions could be
made as the user types.

AJAX can dramatically decrease the amount of data flowing back and
forth. Only the pertinent data needs to be exchanged instead of all of
the page content, which is what happens when the page reloads.

Specifically related to WordPress plugins, AJAX is by far the best way
to initiate a process independent of WordPress content. If you've
programmed PHP before, you would likely do this by simply linking to a
new PHP page. The user following the link initiates the process. The
problem with this is that you cannot access any WordPress functions when
you link to a new external PHP page. In the past, developers accessed
WordPress functions by including the core file wp-load.php on their new
PHP page. The problem with doing that is you cannot possibly know the
correct path to this file anymore. The WordPress architecture is now
flexible enough that the /wp-content/ and your plugin files can be moved
from its usual location to one level from the installation root. You
cannot know where wp-load.php is relative to your plugin files, and you
cannot know the absolute path to the installation folder either.

What you can know is where to send an AJAX request, because it is
defined in a global JavaScript variable. Your PHP AJAX handler script is
actually an action hook, so all WordPress functions are automatically
available to it, unlike an external PHP file.

[**[How Do I Use
AJAX?]{.underline}**](https://developer.wordpress.org/plugins/javascript/ajax/#how-do-i-use-ajax)

If you are new to WordPress but have experience using AJAX in other
environments, you will need to relearn a few things. The way WordPress
implements AJAX is most likely different than what you are used to. If
everything is new to you, no problem. You will learn the basics here.
Once you've developed a basic AJAX exchange, it's a cinch to expand on
that base and develop that killer app with an awesome user interface!

There are two major components of any AJAX exchange in WordPress. The
client side JavaScript or jQuery and the server side PHP. All AJAX
exchanges follow the following sequence of events.

1.  Some sort of page event initiates a JavaScript or jQuery function.
    That function gathers some data from the page and sends it via a
    HTTP request to the server. Because handling HTTP requests with
    JavaScript is awkward and jQuery is bundled into WordPress anyway,
    we are going to focus only on jQuery code from here on out. AJAX
    with straight JavaScript is possible, but it's not worth doing it
    when jQuery is available.

2.  The server receives the request and does something with the data. It
    may assemble related data and send it back to the client browser in
    the form of an HTTP response. This is not a requirement, but since
    keeping the user informed about what's going on is desirable, it's
    very rare not to send some kind of response.

3.  The jQuery function that sent the initial AJAX request receives the
    server response and does something with it. It may update something
    on the page and/or present a message to the user by some means.

[**[Using AJAX with
jQuery]{.underline}**](https://developer.wordpress.org/plugins/javascript/ajax/#using-ajax-with-jquery)

Now we will define the "do stuff" portion from the [[snippet in the
article on
jQuery]{.underline}](https://developer.wordpress.org/plugin/javascript/jquery/#selector-and-event).
We will use
the [[\$.post()]{.underline}](http://api.jquery.com/jQuery.post/) method,
which takes 3 parameters: the URL to send the POST request to, the data
to send, and a callback function to handle the server response. Before
we do that though, we have a bit of advance planning to get out of the
way. We do the following assignment for use later in the callback
function. The purpose will be more evident in the [[Callback
section]{.underline}](https://developer.wordpress.org/plugins/javascript/ajax/#callback).

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/ajax/)

**var** this2 = **this**;

[**[URL]{.underline}**](https://developer.wordpress.org/plugins/javascript/ajax/#url)

All WordPress AJAX requests must be sent to wp-admin/admin-ajax.php. The
correct, complete URL needs to come from PHP, jQuery cannot determine
this value on its own, and you cannot hardcode the URL in your jQuery
code and expect anyone else to use your plugin on their site. If the
page is from the administration area, WordPress sets the correct URL in
the global JavaScript variable ajaxurl. For a page from the public area,
you will need to establish the correct URL yourself and pass it to
jQuery
using [[wp_localize_script()]{.underline}](https://developer.wordpress.org/reference/functions/wp_localize_script/) .
This will be covered in more detail in the [[PHP
section]{.underline}](https://developer.wordpress.org/plugin/javascript/enqueuing/).
For now just know that the URL that will work for both the front and
back end is available as a property of a global object that you will
define in the PHP segment. In jQuery it is referenced like so:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/ajax/)

my_ajax_obj.ajax_url

[**[Data]{.underline}**](https://developer.wordpress.org/plugins/javascript/ajax/#data)

All data that needs to be sent to the server is included in the data
array. Besides any data needed by your app, you must send an action
parameter. For requests that could result in a change to the database
you need to send a nonce so the server knows the request came from a
legitimate source. Our example data array provided to the .post() method
looks like this:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/ajax/)

{

\_ajax_nonce: my_ajax_obj.nonce, // nonce

action: \"my_tag_count\", // action

title: this.value // data

}

Each component is explained below.

[**[Nonce]{.underline}**](https://developer.wordpress.org/plugins/javascript/ajax/#nonce)

[[Nonce]{.underline}](https://codex.wordpress.org/WordPress_Nonces) is a
portmanteau of "Number used ONCE". It is essentially a unique serial
number assigned to each instance of any form served. The nonce is
established with PHP script and passed to jQuery the same way the URL
was, as a property in a global object. In this case it is referenced
as my_ajax_obj.nonce.

**Note**

A true nonce needs to be refreshed every time it is used so the next
AJAX call has a new, unused nonce to send as verification. As it
happens, the WordPress nonce implementation is not a true nonce. The
same nonce can be used as many times as necessary in a 24 hour period,
unless you logout. Generating a nonce with the same seed phrase will
always yield the same number for a 12 hour period after which a new
number will finally be generated.

If your app needs serious security, implement a true nonce system where
the server sends a new, fresh nonce in response to an Ajax request for
the script to use to verify the next request.

It's easiest if you key this nonce value to \_ajax_nonce. You can use a
different key if it's coordinated with the PHP code verifying the nonce,
but it's easier to just use the default value and not worry about
coordination. Here is the way the declaration of this key-value pair
appears:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/ajax/)

\_ajax_nonce: my_ajax_obj.nonce

[**[Action]{.underline}**](https://developer.wordpress.org/plugins/javascript/ajax/#action)

All WordPress AJAX requests must include an action argument in the data.
This value is an arbitrary string that is used in part to construct an
action tag you use to hook your AJAX handler code. It's useful for this
value to be a very brief description of the AJAX call's purpose.
Unsurprisingly, the key for this value is *'action'*. In this example,
we will use \"my_tag_count\" as our action value. The declaration of
this key-value pair looks like this:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/ajax/)

action: \"my_tag_count\"

Any other data the server needs to do its task is also included in this
array. If there are a lot of fields to transmit, there are two common
formats to combine data fields into a single string for more convenient
transmission, XML and JSON. Using these formats is optional, but
whatever you do does need to be coordinated with the PHP script on the
server side. More information on these formats is available in the
following Callback section. It is more common to receive data in this
format than to send it, but it can work both ways.

In our example, the server only needs one value, a single string for the
selected book title, so we will use the key *'title'*. In jQuery, the
object that fired the event is always contained in the variable this.
Accordingly, the value of the selected element is this.value. Our
declaration of this key-value pair appears like so:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/ajax/)

title: **this**.value

[**[Callback]{.underline}**](https://developer.wordpress.org/plugins/javascript/ajax/#callback)

The callback handler is the function to execute when a response comes
back from the server after the request is made. Once again, we usually
see an anonymous function here. The function is passed one parameter,
the server response. The response could be anything from a yes or no to
a huge XML database. JSON formatted data is also a useful format for
data. The response is not even required. If there is none, then no
callback need be specified. In the interest of UX, it's always a good
idea to let the user know what happened to any request, so it is
recommended to always respond and provide some indication that something
happened.

In our example, we replace the current text following the radio input
with the server response, which includes the number of posts tagged by
the book title. Here is our anonymous callback function:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/ajax/)

**function**( data ) {

this2.nextSibling.remove();

\$( this2 ).after( data );

}

data contains the entire server response. Earlier we assigned
to this2 the object that triggered the change event (referenced as this)
with the line var this2 = this;. This is because variable scope in
closures only extends one level. By assigning this2 in the event handler
(the part that initially just contained *"/\* do stuff \*/"*), we are
able to use it in the callback where thiswould be out of scope.

The server response can take on any form. Significant quantities of data
should be encoded into a data stream for easier handling. XML and JSON
are two common encoding schemes.

**XML**

XML is the old data exchange format for AJAX. It is after all the 'X' in
AJAX. It continues to be a viable exchange format even though it can be
difficult to work with using native PHP functions. Many PHP programmers
prefer the JSON exchange format for that reason. If you do use XML, the
parsing method depends on the browser being used. Use Microsoft.XMLDOM
ActiveX for Internet Explorer and use DOMParser for everything else.
Note that [[Internet Explorer is no longer supported by
WordPress]{.underline}](https://make.wordpress.org/core/2021/04/22/ie-11-support-phase-out-plan/) since
5.8 release. 

**JSON**

JSON is often favored for its light weight and ease of use. You can
actually parse JSON using eval(), but don't do that! The use
of eval() carries significant security risks. Instead, use a dedicated
parser, which is also faster. Use the global instance of the parser
object JSON. To ensure that it is available, be sure it is enqueued with
other scripts on the page. More information about enqueuing is included
later in the [[PHP
section]{.underline}](https://developer.wordpress.org/plugins/javascript/ajax/#json).

**Other**

As long as the data format is coordinated with the PHP handler, it can
be any format you like, such as comma delimited, tab delimited, or any
kind of structure that works for you.

**Client Side Summary**

Now that we've added our callback as the final parameter for
the \$.post()function, we've completed our sample jQuery Ajax script.
All the pieces put together look like this:

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/javascript/ajax/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/ajax/)

jQuery(document).ready(**function**(\$) { //wrapper

\$(\".pref\").change(**function**() { //event

**var** this2 = **this**; //use in callback

\$.post(my_ajax_obj.ajax_url, { //POST request

\_ajax_nonce: my_ajax_obj.nonce, //nonce

action: \"my_tag_count\", //action

title: **this**.value //data

}, **function**(data) { //callback

this2.nextSibling.remove(); //remove current title

\$(this2).after(data); //insert server response

}

);

} );

} );

This script can either be output into a block on the web page or
contained in its own file. This file can reside anywhere on the
Internet, but most plugin developers place it in a /js/ subfolder of the
plugin's main folder. Unless you have reason to do otherwise, you may as
well follow convention. For this example we will name our
file myjquery.js

#   **Server Side PHP and Enqueuing**

In this article

-   [[Enqueue
    Script]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/#enqueue-script)

    -   [[Enqueue]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/#enqueue)

    -   [[Nonce]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/#nonce)

    -   [[Localize]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/#localize)

-   [[AJAX
    Action]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/#ajax-action)

    -   [[Data]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/#data)

    -   [[Die]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/#die)

    -   [[AJAX Handler
        Summary]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/#ajax-handler-summary)

[↑ [Back to
top]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/#wp--skip-link--target)

There are two parts to the server side PHP script that are needed to
implement AJAX communication. First we need to enqueue the jQuery script
on the web page and localize any PHP values that the jQuery script
needs. Second is the actual handling of the AJAX request.

[**[Enqueue
Script]{.underline}**](https://developer.wordpress.org/plugins/javascript/enqueuing/#enqueue-script)

This section covers the two major quirks of AJAX in WordPress that trip
up experienced coders new to WordPress. One is the need to enqueue
scripts in order to get meta links to appear correctly in the page's
head section. The other is that **all** AJAX requests need to be sent
through wp-admin/admin-ajax.php. Never send requests directly to your
plugin pages.

[**[Enqueue]{.underline}**](https://developer.wordpress.org/plugins/javascript/enqueuing/#enqueue)

Use the
function [[wp_enqueue_script()]{.underline}](https://developer.wordpress.org/reference/functions/wp_enqueue_script/) to
get WordPress to insert a meta link to your script in the page's
section. Never hardcode such links in the header template. As a plugin
developer, you do not have ready access to the header template, but this
rule bears mentioning anyway.

The enqueue function accepts five parameters as follows:

-   **\$handle** is the name for the script.

-   **\$src** defines where the script is located. For portability,
    use plugins_url() to build the proper URL. If you are enqueuing the
    script for something besides a plugin, use some related function to
    create a proper URL -- never hardcode it

-   **\$deps** is an array that can handle any script that your new
    script depends on, such as jQuery. Since we are using jQuery to send
    an AJAX request, you will at least need to list \'jquery\' in the
    array.

-   **\$ver** lets you list a version number.

-   **\$args** an array of arguments that define footer printing (via
    an in_footer key) and script loading strategies (via a strategy key)
    such as defer or async. This replaces/overloads
    the \$in_footerparameter as of WordPress version 6.3.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/)

wp_enqueue_script(

\'ajax-script\',

plugins_url( \'/js/myjquery.js\', \_\_FILE\_\_ ),

**array**( \'jquery\' ),

\'1.0.,0\',

**array**(

\'in_footer\' =\> true,

)

);

You cannot enqueue scripts directly from your plugin code page when it
is loaded. Scripts must be enqueued from one of a few action hooks --
which one depends on what sort of page the script needs to be linked to.
For administration pages, use admin_enqueue_scripts. For front-end pages
use wp_enqueue_scripts, except for the login page, in which case
use login_enqueue_scripts.

The admin_enqueue_scripts hook passes the current page filename to your
callback. Use this information to only enqueue your script on pages
where it is needed. The front-end version does not pass anything. In
that case, use template tags such as is_home(), is_single(), etc. to
ensure that you only enqueue your script where it is needed. This is the
complete enqueue code for our example:

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/)

add_action( \'admin_enqueue_scripts\', \'my_enqueue\' );

**function** my_enqueue( \$hook ) {

**if** ( \'myplugin_settings.php\' !== \$hook ) {

**return**;

}

wp_enqueue_script(

\'ajax-script\',

plugins_url( \'/js/myjquery.js\', \_\_FILE\_\_ ),

**array**( \'jquery\' ),

\'1.0.0\',

**array**(

\'in_footer\' =\> true,

)

);

}

Why do we use a named function here but use anonymous functions with
jQuery? Because closures are only recently supported by PHP. jQuery has
supported them for quite some time. Since some people may still be
running older versions of PHP, we always use named functions for maximum
compatibility. If you have a recent PHP version and are developing only
for your own installation, go ahead and use closures if you like.

**Register vs. Enqueue**

You will see examples in other tutorials that religiously
use [[wp_register_script()]{.underline}](https://developer.wordpress.org/reference/functions/wp_register_script/).
This is fine, but its use is optional. What is not optional
is wp_enqueue_script(). This function must be called in order for your
script file to be properly linked on the web page. So why register
scripts? It creates a useful tag or handle with which you can easily
reference the script in various parts of your code as needed. If you
just need your script loaded and are not referencing it elsewhere in
your code, there is no need to register it.

**Delayed Script Loading**

WordPress provides support for specifying a script loading strategy via
the wp_register_script() and wp_enqueue_script() functions, by way of
the strategy key within the new \$args array parameter introduced in
WordPress 6.3.

Supported strategies are as follows:

-   **defer**

    -   Added by specifying an array key value pair of \'strategy\' =\>
        \'defer\' to the \$args parameter.

    -   Scripts marked for deferred execution --- via the defer script
        attribute --- are only executed once the DOM tree has fully
        loaded (but before the DOMContentLoaded and window load events).
        Deferred scripts are executed in the same order they were
        printed/added in the DOM, unlike asynchronous scripts.

-   **async**

    -   Added by specifying an array key value pair of \'strategy\' =\>
        \'async\' to the \$args parameter.

    -   Scripts marked for asynchronous execution --- via
        the async script attribute --- are executed as soon as they are
        loaded by the browser. Asynchronous scripts do not have a
        guaranteed execution order, as script B (although added to the
        DOM after script A) may execute first given that it may complete
        loading prior to script A. Such scripts may execute either
        before the DOM has been fully constructed or after
        the DOMContentLoaded event.

Following is an example of specifying a loading strategy for an
additional script enqueue within our plugin:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/)

wp_register_script(

\'ajax-script-two\',

plugins_url( \'/js/myscript.js\', \_\_FILE\_\_ ),

**array**( ajax-script ),

\'1.0.,0\',

**array**(

\'strategy\' =\> \'defer\',

)

);

The same approach applies when using wp_enqueue_script(). In the example
above, we indicate that we intend to load the \'ajax-script-two\'script
in a deferred manner.

When specifying a delayed script loading strategy, consideration of the
script's dependency tree (its dependencies and/or dependents) is taken
into account when deciding on an "eligible strategy" so as not to result
in application of a strategy that is valid for one script but
detrimental to others in the tree by causing an unintended out of order
of execution. As a result of such logic, the intended loading strategy
that you pass via the \$argsparameter may not be the final (chosen)
strategy, but it will never be detrimental to (or stricter than) the
intended strategy.

[**[Nonce]{.underline}**](https://developer.wordpress.org/plugins/javascript/enqueuing/#nonce)

You need to create a nonce so that the jQuery AJAX request can be
validated as a legitimate request instead of a potentially nefarious
request from some unknown bad actor. Only your PHP script and your
jQuery script will know this value. When the request is received, you
can verify it is the same value created here. This is how to create a
nonce for our example:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/)

\$title_nonce = wp_create_nonce( \'title_example\' );

The parameter title_example can be any arbitrary string. It's suggested
the string be related to what the nonce is used for, but it can really
be anything that suits you.

[**[Localize]{.underline}**](https://developer.wordpress.org/plugins/javascript/enqueuing/#localize)

If you recall from the [[jQuery
Section]{.underline}](https://developer.wordpress.org/plugins/javascript/jquery/),
data created by PHP for use by jQuery was passed in a global object
named my_ajax_obj. In our example, this data was a nonce and the
complete URL to admin-ajax.php. The process of assigning object
properties and creating the global jQuery object is
called **localizing**. This is the localizing code used in our example
which
uses [[wp_localize_script()]{.underline}](https://developer.wordpress.org/reference/functions/wp_localize_script/).

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/)

wp_localize_script(

\'ajax-script\',

\'my_ajax_obj\',

**array**(

\'ajax_url\' =\> admin_url( \'admin-ajax.php\' ),

\'nonce\' =\> \$title_nonce,

)

);

Note how our script handle ajax-script is used so that the global object
is assigned to the right script. The object is global to our script, not
to all scripts. Localization can also be called from the same hook that
is used to enqueue scripts. The same goes for creating a nonce, though
that particular function can be called virtually anywhere. All of that
combined together in a single hook callback looks like this:

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/)

add_action( \'admin_enqueue_scripts\', \'my_enqueue\' );

/\*\*

\* Enqueue my scripts and assets.

\*

\* \@param \$hook

\*/

**function** my_enqueue( \$hook ) {

**if** ( \'myplugin_settings.php\' !== \$hook ) {

**return**;

}

wp_enqueue_script(

\'ajax-script\',

plugins_url( \'/js/myjquery.js\', \_\_FILE\_\_ ),

**array**( \'jquery\' ),

\'1.0.0\',

true

);

wp_localize_script(

\'ajax-script\',

\'my_ajax_obj\',

**array**(

\'ajax_url\' =\> admin_url( \'admin-ajax.php\' ),

\'nonce\' =\> wp_create_nonce( \'title_example\' ),

)

);

}

Remember to only add this nonce localization to the needed pages, do not
display a nonce to someone who should not use it. And remember to
use current_user_can() with a capability or role to complete the
security.

[**[AJAX
Action]{.underline}**](https://developer.wordpress.org/plugins/javascript/enqueuing/#ajax-action)

The other major part of the server side PHP code is the actual AJAX
handler that receives the POSTed data, does something with it, then
sends an appropriate response back to the browser. This takes on the
form of a WordPress [[action
hook]{.underline}](https://developer.wordpress.org/plugins/hooks/actions/).
Which hook tag you use depends on whether the user is logged in or not
and what value your jQuery script passed as the *action:* value.

**\$\_GET , \$\_POST and \$\_COOKIE vs \$\_REQUEST**

You've probably used one or more of the PHP super globals such
as \$\_GET or \$\_POST to retrieve values from forms or cookies
(using \$\_COOKIE). Maybe you prefer \$\_REQUEST instead, or at least
have seen it used. It's kind of cool -- regardless of the request
method, POST or GET, it will have the form values. Works great for pages
that use both methods. On top of that, it has cookie values as well. One
stop shopping! Therein lies its tragic flaw. In the case of a name
conflict, the cookie value will override any form values. Thus it is
ridiculously easy for a bad actor to craft a counterfeit cookie on their
browser, which will overwrite any form value you might be expecting from
the request. \$\_REQUEST is an easy route for hackers to inject
arbitrary data into your form values. To be extra safe, stick to the
specific variables and avoid the one size fits all.

Since our AJAX exchange is for the plugin's settings page, the user must
be logged in. If you recall from the [[jQuery
section]{.underline}](https://developer.wordpress.org/plugins/javascript/jquery/),
the action: value is \"my_tag_count\". This means our action hook tag
will be wp_ajax_my_tag_count. If our AJAX exchange were to be utilized
by users who were not currently logged in, the action hook tag would
be wp_ajax_nopriv_my_tag_count The basic code used to hook the action
looks like this:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/)

add_action( \'wp_ajax_my_tag_count\', \'my_ajax_handler\' );

/\*\*

\* Handles my AJAX request.

\*/

**function** my_ajax_handler() {

// Handle the ajax request here

wp_die(); // All ajax handlers die when finished

}

The first thing your AJAX handler should do is verify the nonce sent by
jQuery
with [[check_ajax_referer()]{.underline}](https://developer.wordpress.org/reference/functions/check_ajax_referer/),
which should be the same value that was localized when the script was
enqueued.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/)

check_ajax_referer( \'title_example\' );

The provided parameter must be identical to the parameter
provided [[earlier]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/#php-nonce)to wp_create_nonce().
The function simply dies if the nonce does not check out. If this were a
true nonce, now that it was used, the value is no longer any good. You
would then generate a new one and send it to the callback script so that
it can be used for the next request. But since WordPress nonces are good
for twenty-four hours, you needn't do anything but check it.

[**[Data]{.underline}**](https://developer.wordpress.org/plugins/javascript/enqueuing/#data)

With the nonce out of the way, our handler can deal with the data sent
by the jQuery script contained in \$\_POST\[\'title\'\]. First we assign
the value to a new variable, after running it
through [[wp_unslash()]{.underline}](https://developer.wordpress.org/reference/functions/wp_unslash/) to
remove any unexpected quotes.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/)

\$title = wp_unslash( \$\_POST\[\'title\'\] );

We can save the user's selection in user meta by
using [[update_user_meta()]{.underline}](https://developer.wordpress.org/reference/functions/update_user_meta/).

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/)

update_user_meta( get_current_user_id(), \'title_preference\',
sanitize_post_title( \$title ) );

Then we build a query in order to get the post count for the selected
title tag.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/)

\$args = **array**(

\'tag\' =\> \$title,

);

\$the_query = **new** WP_Query( \$args );

Finally we can send the response back to the jQuery script. There's
several ways to transmit data. Let's look at some of the options before
we deal with the specifics of our example.

**XML**

PHP support for XML leaves something to be desired. Fortunately,
WordPress provides
the [[WP_Ajax_Response]{.underline}](https://developer.wordpress.org/reference/classes/wp_ajax_response/) class
to make the task easier.
The [[WP_Ajax_Response]{.underline}](https://developer.wordpress.org/reference/classes/wp_ajax_response/) class
will generate an XML-formatted response, set the correct content type
for the header, output the response xml, then die --- ensuring a proper
XML response.

**JSON**

This format is lightweight and easy to use, and WordPress provides
the [[wp_send_json]{.underline}](https://developer.wordpress.org/reference/functions/wp_send_json/) function
to json-encode your response, print it, and die --- effectively
replacing [[WP_Ajax_Response]{.underline}](https://developer.wordpress.org/reference/classes/wp_ajax_response/).
WordPress also provides
the [[wp_send_json_success]{.underline}](https://developer.wordpress.org/reference/functions/wp_send_json_success/) and [[wp_send_json_error]{.underline}](https://developer.wordpress.org/reference/functions/wp_send_json_error/) functions,
which allow the appropriate done() or fail() callbacks to fire in JS.

**Other**

You can transfer data any way you like, as long as the sender and
receiver are coordinated. Text formats like comma delimited or tab
delimited are one of many possibilities. For small amounts of data,
sending the raw stream may be adequate. That is what we will do with our
example -- we will send the actual replacement HTML, nothing else.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/)

**echo** esc_html( \$title ) . \' (\' . \$the_query-\>post_count . \')
\';

In a real world application, you must account for the possibility that
the action could fail for some reason--for instance, maybe the database
server is down. The response should allow for this contingency, and the
jQuery script receiving the response should act accordingly, perhaps
telling the user to try again later.

[**[Die]{.underline}**](https://developer.wordpress.org/plugins/javascript/enqueuing/#die)

When the handler has finished all of its tasks, it needs to die. If you
are using
the [[WP_Ajax_Response]{.underline}](https://developer.wordpress.org/reference/classes/wp_ajax_response/) or
wp_send_json\* functions, this is automatically handled for you. If not,
simply use the
WordPress [[wp_die()]{.underline}](https://developer.wordpress.org/reference/functions/wp_die/)function.

[**[AJAX Handler
Summary]{.underline}**](https://developer.wordpress.org/plugins/javascript/enqueuing/#ajax-handler-summary)

The complete AJAX handler for our example looks like this:

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/)

/\*\*

\* AJAX handler using JSON

\*/

**function** my_ajax_handler\_\_json() {

check_ajax_referer( \'title_example\' );

\$title = wp_unslash( \$\_POST\[\'title\'\] );

update_user_meta( get_current_user_id(), \'title_preference\',
sanitize_post_title( \$title ) );

\$args = **array**(

\'tag\' =\> \$title,

);

\$the_query = **new** WP_Query( \$args );

wp_send_json( esc_html( \$title ) . \' (\' . \$the_query-\>post_count .
\') \' );

}

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/enqueuing/)

/\*\*

\* AJAX handler not using JSON.

\*/

**function** my_ajax_handler() {

check_ajax_referer( \'title_example\' );

\$title = wp_unslash( \$\_POST\[\'title\'\] );

update_user_meta( get_current_user_id(), \'title_preference\',
sanitize_post_title( \$title ) );

\$args = **array**(

\'tag\' =\> \$title,

);

\$the_query = **new** WP_Query( \$args );

**echo** esc_html( \$title ) . \' (\' . \$the_query-\>post_count . \')
\';

wp_die(); // All ajax handlers should die when finished

}

**First published**

October 19, 2014

#  **Summary**

In this article

-   [[PHP]{.underline}](https://developer.wordpress.org/plugins/javascript/summary/#php)

-   [[jQuery]{.underline}](https://developer.wordpress.org/plugins/javascript/summary/#jquery)

-   [[More
    Information]{.underline}](https://developer.wordpress.org/plugins/javascript/summary/#more-information)

[↑ [Back to
top]{.underline}](https://developer.wordpress.org/plugins/javascript/summary/#wp--skip-link--target)

Here are all the example code snippets from the preceding discussion,
assembled into two complete code pages: one for jQuery and the other for
PHP.

[**[PHP]{.underline}**](https://developer.wordpress.org/plugins/javascript/summary/#php)

This code resides on one of your plugin pages.

[[Expand
code]{.underline}](https://developer.wordpress.org/plugins/javascript/summary/)

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/summary/)

add_action( \'admin_enqueue_scripts\', \'my_enqueue\' );

**function** my_enqueue( \$hook ) {

**if** ( \'myplugin_settings.php\' !== \$hook ) {

**return**;

}

wp_enqueue_script(

\'ajax-script\',

plugins_url( \'/js/myjquery.js\', \_\_FILE\_\_ ),

**array**( \'jquery\' ),

\'1.0.0\',

true

);

\$title_nonce = wp_create_nonce( \'title_example\' );

wp_localize_script(

\'ajax-script\',

\'my_ajax_obj\',

**array**(

\'ajax_url\' =\> admin_url( \'admin-ajax.php\' ),

\'nonce\' =\> \$title_nonce,

)

);

}

add_action( \'wp_ajax_my_tag_count\', \'my_ajax_handler\' );

**function** my_ajax_handler() {

check_ajax_referer( \'title_example\' );

\$title = wp_unslash( \$\_POST\[\'title\'\] );

update_user_meta( get_current_user_id(), \'title_preference\', \$title
);

\$args = **array**(

\'tag\' =\> \$title,

);

\$the_query = **new** WP_Query( \$args );

**echo** esc_html( \$title ) . \' (\' . \$the_query-\>post_count . \')
\';

wp_die(); // all ajax handlers should die when finished

}

[**[jQuery]{.underline}**](https://developer.wordpress.org/plugins/javascript/summary/#jquery)

This code is in the file js/myjquery.js below your plugin folder.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/javascript/summary/)

jQuery(document).ready(**function**(\$) { //wrapper

\$(\".pref\").change(**function**() { //event

**var** this2 = **this**; //use in callback

\$.post(my_ajax_obj.ajax_url, { //POST request

\_ajax_nonce: my_ajax_obj.nonce, //nonce

action: \"my_tag_count\", //action

title: **this**.value //data

}, **function**(data) { //callback

this2.nextSibling.remove(); //remove the current title

\$(this2).after(data); //insert server response

});

});

});

And after storing the preference, the resulting post count is added to
the selected title.

#       **Cron**

In this article

-   [[What is
    WP-Cron]{.underline}](https://developer.wordpress.org/plugins/cron/#what-is-wp-cron)

-   [[Why use
    WP-Cron]{.underline}](https://developer.wordpress.org/plugins/cron/#why-use-wp-cron)

[↑ [Back to
top]{.underline}](https://developer.wordpress.org/plugins/cron/#wp--skip-link--target)

[**[What is
WP-Cron]{.underline}**](https://developer.wordpress.org/plugins/cron/#what-is-wp-cron)

WP-Cron is how WordPress handles scheduling time-based tasks in
WordPress. Several WordPress core features, such as checking for updates
and publishing scheduled post, utilize WP-Cron. The "Cron" part of the
name comes from the cron time-based task scheduling system that is
available on UNIX systems.

WP-Cron works by checking, on every page load, a list of scheduled tasks
to see what needs to be run. Any tasks due to run will be called during
that page load. 

WP-Cron does not run constantly as the system cron does; it is only
triggered on page load.

Scheduling errors could occur if you schedule a task for 2:00PM and no
page loads occur until 5:00PM.

[**[Why use
WP-Cron]{.underline}**](https://developer.wordpress.org/plugins/cron/#why-use-wp-cron)

-   WordPress core and many plugins need a scheduling system to perform
    time-based tasks. However, many hosting services are shared and do
    not provide access to the system scheduler.

-   Using the WordPress API is a simpler method for setting scheduled
    tasks than going outside of WordPress to the system scheduler.

-   With the system scheduler, if the time passes and the task did not
    run, it will not be re-attempted. With WP-Cron, all scheduled tasks
    are put into a queue and will run at the next opportunity (meaning
    the next page load). So while you can't be 100% sure *when* your
    task will run, you can be 100% sure that it will run *eventually*.

**Hooking WP-Cron Into the System Task Scheduler**

In this article

-   [Windows](https://developer.wordpress.org/plugins/cron/hooking-wp-cron-into-the-system-task-scheduler/#windows)

-   [MacOS and
    Linux](https://developer.wordpress.org/plugins/cron/hooking-wp-cron-into-the-system-task-scheduler/#macos-and-linux)

[↑ Back to
top](https://developer.wordpress.org/plugins/cron/hooking-wp-cron-into-the-system-task-scheduler/#wp--skip-link--target)

As previously mentioned, WP-Cron does not run continuously, which can be
an issue if there are critical tasks that must run on time. There is an
easy solution for this. Simply set up your system's task scheduler to
run on the intervals you desire (or at the specific time needed). The
easiest solution is to use a tool to make a web request to
the wp-cron.php file.

After scheduling the task on your system, there is one more step to
complete. WordPress will continue to run WP-Cron on each page load. This
is no longer necessary and will contribute to extra resource usage on
your server. WP-Cron can be disabled in the wp-config.php file. Open
the wp-config.phpfile for editing and add the following line:

[Copy](https://developer.wordpress.org/plugins/cron/hooking-wp-cron-into-the-system-task-scheduler/)

define( \'DISABLE_WP_CRON\', true );

[**Windows**](https://developer.wordpress.org/plugins/cron/hooking-wp-cron-into-the-system-task-scheduler/#windows)

Windows calls their time based scheduling system the Task Scheduler. It
can be accessed via the **Administrative Tools** in the control panel.

How you setup the task varies with server setup. One method is to use
PowerShell and a Basic Task. After creating a Basic Task the following
command can be used to call the WordPress Cron script.

[Copy](https://developer.wordpress.org/plugins/cron/hooking-wp-cron-into-the-system-task-scheduler/)

powershell \"Invoke-WebRequest http://YOUR_SITE_URL/wp-cron.php\"

[**MacOS and
Linux**](https://developer.wordpress.org/plugins/cron/hooking-wp-cron-into-the-system-task-scheduler/#macos-and-linux)

Mac OS X and Linux both use cron as their time based scheduling system.
It is typically access from the terminal with the crontab -e command. It
should be noted that tasks will be run as a regular user or as root
depending on the system user running the command.

Cron has a specific syntax that needs to be followed and contains the
following parts:

-   Minute

-   Hour

-   Day of month

-   Month

-   Day of week

-   Command to execute

![A colorful text on a white background Description automatically
generated](media/image2.png){width="6.5in" height="3.25in"}

If a command should be run regardless of one of the time sections an
asterisk (\*) should be used. For example if you wanted to run a command
every 15 minutes regardless of the hour, day, or month it would look
like:

[Copy](https://developer.wordpress.org/plugins/cron/hooking-wp-cron-into-the-system-task-scheduler/)

\*/15 \* \* \* \* command

Many servers have wget installed and this is an easy tool to call the
WordPress Cron script.

[Copy](https://developer.wordpress.org/plugins/cron/hooking-wp-cron-into-the-system-task-scheduler/)

wget \--delete-after http://YOUR_SITE_URL/wp-cron.php

Note: without --delete-after option, wget would save the output of the
HTTP GET request.

A daily call to your site's WordPress Cron that triggers at midnight
every night could look similar to:

[Copy](https://developer.wordpress.org/plugins/cron/hooking-wp-cron-into-the-system-task-scheduler/)

0 0 \* \* \* wget \--delete-after http://YOUR_SITE_URL/wp-cron.php

**Scheduling WP Cron Events**

In this article

-   [[Adding the
    Hook]{.underline}](https://developer.wordpress.org/plugins/cron/scheduling-wp-cron-events/#adding-the-hook)

-   [[Scheduling the
    Task]{.underline}](https://developer.wordpress.org/plugins/cron/scheduling-wp-cron-events/#scheduling-the-task)

-   [[Unscheduling
    tasks]{.underline}](https://developer.wordpress.org/plugins/cron/scheduling-wp-cron-events/#unscheduling-tasks)

The WP Cron system uses hooks to add new scheduled tasks.

[**[Adding the
Hook]{.underline}**](https://developer.wordpress.org/plugins/cron/scheduling-wp-cron-events/#adding-the-hook)

In order to get your task to run you must create your own custom hook
and give that hook the name of a function to execute. This is a very
important step. Forget it and your task will never run.

The following example will create a hook. The first parameter is the
name of the hook you are creating, and the second is the name of the
function to call.

[[Copy]{.underline}](https://developer.wordpress.org/plugins/cron/scheduling-wp-cron-events/)

add_action( \'bl_cron_hook\', \'bl_cron_exec\' );

Remember, the "bl\_" part of the function name is a *function prefix*.
You can learn why prefixes are
important [[here]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/best-practices/#prefix-everything). 

You can read more about
actions [[here]{.underline}](https://developer.wordpress.org/plugins/hooks/actions/).

[**[Scheduling the
Task]{.underline}**](https://developer.wordpress.org/plugins/cron/scheduling-wp-cron-events/#scheduling-the-task)

An important note is that WP-Cron is a simple task scheduler. As we
know, tasks are added by the hook created to call the function that runs
the desired task. However if you call wp_schedule_event() multiple
times, even with the same hook name, the event will be scheduled
multiple times. If your code adds the task on each page load this could
result in the task being scheduled several thousand times. This is not
what you want. 

WordPress provides a convenient function
called [[wp_next_scheduled()]{.underline}](https://developer.wordpress.org/reference/functions/wp_next_scheduled/) to
check if a particular hook is already
scheduled. wp_next_scheduled()takes one parameter, the hook name. It
will return either a string containing the timestamp of the next
execution or false, signifying the task is not scheduled. It is used
like so:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/cron/scheduling-wp-cron-events/)

wp_next_scheduled( \'bl_cron_hook\' )

Scheduling a recurring task is accomplished
with [[wp_schedule_event()]{.underline}](https://developer.wordpress.org/reference/functions/wp_schedule_event/) .
This function takes three required parameters, and one additional
parameter that is an array that can be passed to the function executing
the wp-cron task. We will focus on the first three parameters. The
parameters are as follows:

1.  \$timestamp -- The UNIX timestamp of the first time this task should
    execute

2.  \$recurrence -- The name of the interval in which the task will
    recur in seconds

3.  \$hook -- The name of our custom hook to call

We will use the 5 second interval we
created [[here]{.underline}](https://developer.wordpress.org/plugins/cron/understanding-wp-cron-scheduling/) and
the hook we created above, like so:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/cron/scheduling-wp-cron-events/)

wp_schedule_event( time(), \'five_seconds\', \'bl_cron_hook\' );

Remember, we need to first ensure the task is not already scheduled. So
we wrap the scheduling code in a check like this:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/cron/scheduling-wp-cron-events/)

**if** ( ! wp_next_scheduled( \'bl_cron_hook\' ) ) {

wp_schedule_event( time(), \'five_seconds\', \'bl_cron_hook\' );

}

[**[Unscheduling
tasks]{.underline}**](https://developer.wordpress.org/plugins/cron/scheduling-wp-cron-events/#unscheduling-tasks)

When you no longer need a task scheduled you can unschedule tasks
with [[wp_unschedule_event()]{.underline}](https://developer.wordpress.org/reference/functions/wp_unschedule_event/) .
This function takes the following two parameters:

1.  \$timestamp -- Timestamp of the next occurrence of the task

2.  \$hook -- Name of the custom hook to be called

This function will not only unschedule the task indicated by the
timestamp, it will also unschedule all future occurrences of the task.
Since you probably will not know the timestamp for the next task, there
is another handy
function, [[wp_next_scheduled()]{.underline}](https://developer.wordpress.org/reference/functions/wp_next_scheduled/) that
will find it for you. wp_next_scheduled() takes one parameter (that we
care about):

1.  \$hook -- The name of the hook that is called to execute the task

Put it all together and the code looks like:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/cron/scheduling-wp-cron-events/)

\$timestamp = wp_next_scheduled( \'bl_cron_hook\' );

wp_unschedule_event( \$timestamp, \'bl_cron_hook\' );

It is very important to unschedule tasks when you no longer need them
because WordPress will continue to attempt to execute the tasks, even
though they are no longer in use (or even after your plugin has been
deactivated or removed). An important place to remember to unschedule
your tasks is upon plugin deactivation. 

Unfortunately there are many plugins in the WordPress.org Plugin
Directory that do not clean up after themselves. If you find one of
these plugins please let the author know to update their code. WordPress
provides a function
called [[register_deactivation_hook()]{.underline}](https://developer.wordpress.org/reference/functions/register_deactivation_hook/) that
allows developers to run a function when their plugin is deactivated. It
is very simple to setup and looks like:

[[Copy]{.underline}](https://developer.wordpress.org/plugins/cron/scheduling-wp-cron-events/)

register_deactivation_hook( \_\_FILE\_\_, \'bl_deactivate\' );

**function** bl_deactivate() {

\$timestamp = wp_next_scheduled( \'bl_cron_hook\' );

wp_unschedule_event( \$timestamp, \'bl_cron_hook\' );

}

You can read more about activation and deactivation
hooks [[here]{.underline}](https://developer.wordpress.org/plugins/plugin-basics/activation-deactivation-hooks/).

**First published**

October 19, 2014

#   **Testing of WP-Cron**

In this article

-   [[WP-CLI]{.underline}](https://developer.wordpress.org/plugins/cron/simple-testing/#wp-cli)

-   [[WP-Cron Management
    Plugins]{.underline}](https://developer.wordpress.org/plugins/cron/simple-testing/#wp-cron-management-plugins)

-   [[\_get_cron_array()]{.underline}](https://developer.wordpress.org/plugins/cron/simple-testing/#_get_cron_array)

-   [[wp_get_schedules()]{.underline}](https://developer.wordpress.org/plugins/cron/simple-testing/#wp_get_schedules)

[↑ [Back to
top]{.underline}](https://developer.wordpress.org/plugins/cron/simple-testing/#wp--skip-link--target)

[**[WP-CLI]{.underline}**](https://developer.wordpress.org/plugins/cron/simple-testing/#wp-cli)

Cron jobs can be tested
using [[WP-CLI]{.underline}](https://wp-cli.org/). It offers commands
like wp cron event list and wp cron event run {job name}. [[Check the
documentation]{.underline}](https://developer.wordpress.org/cli/commands/cron/) for
more details.

[**[WP-Cron Management
Plugins]{.underline}**](https://developer.wordpress.org/plugins/cron/simple-testing/#wp-cron-management-plugins)

[[Several plugins are available on the WordPress.org Plugin Directory
for viewing, editing, and controlling the scheduled cron events and
available schedules on your
site.]{.underline}](https://wordpress.org/plugins/tags/cron/)

[**[\_get_cron_array()]{.underline}**](https://developer.wordpress.org/plugins/cron/simple-testing/#_get_cron_array)

[[The \_get_cron_array() function]{.underline}](https://developer.wordpress.org/reference/functions/_get_cron_array/) returns
an array of all currently scheduled cron events. Use this function if
you need to inspect the raw list of events.

[**[wp_get_schedules()]{.underline}**](https://developer.wordpress.org/plugins/cron/simple-testing/#wp_get_schedules)

[[The wp_get_schedules() function]{.underline}](https://developer.wordpress.org/reference/functions/wp_get_schedules/) returns
an array of available event recurrence schedules. Use this function if
you need to inspect the raw list of available schedules.

**Understanding WP-Cron Scheduling**

[↑ Back to
top](https://developer.wordpress.org/plugins/cron/understanding-wp-cron-scheduling/#wp--skip-link--target)

Unlike a traditional system cron that schedules tasks for specific times
(e.g. "every hour at 5 minutes past the hour"), WP-Cron uses intervals
to simulate a system cron. 

WP-Cron is given two arguments: the time for the first task, and an
interval (in seconds) after which the task should be repeated. For
example, if you schedule a task to begin at 2:00PM with an interval of
300 seconds (five minutes), the task would first run at 2:00PM and then
again at 2:05PM, then again at 2:10PM, and so on, every five minutes.

To simplify scheduling tasks, WordPress provides some default intervals
and an easy method for adding custom intervals.

The default intervals provided by WordPress are:

-   hourly

-   twicedaily

-   daily

-   weekly (since WP 5.4)

**Custom Intervals**

To add a custom interval, you can create a filter, such as:

[Copy](https://developer.wordpress.org/plugins/cron/understanding-wp-cron-scheduling/)

add_filter( \'cron_schedules\', \'example_add_cron_interval\' );

**function** example_add_cron_interval( \$schedules ) {

\$schedules\[\'five_seconds\'\] = **array**(

\'interval\' =\> 5,

\'display\' =\> esc_html\_\_( \'Every Five Seconds\' ), );

**return** \$schedules;

}

This filter function creates a new interval that will allow us to run a
cron task every five seconds.

**Note:** All intervals are in seconds.

**First published**

October 19, 2014
