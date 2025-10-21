![](media/image1.jpg){width="8.500535870516185in"
height="11.000356517935257in"}

**Using the WordPress REST API**

Everything you need to know to being using the

WordPress REST API

Cal Evans

This book is for sale at
<http://leanpub.com/using_the_wordpress_rest_api>

This version was published on 2019-07-15

![](media/image2.png){width="0.7874037620297463in"
height="0.6102373140857393in"}

This is a [Leanpub](http://leanpub.com/) book. Leanpub empowers authors
and publishers with the Lean Publishing process. [Lean
Publishing](http://leanpub.com/manifesto) is the act of publishing an
in-progress ebook using lightweight tools and many iterations to get
reader feedback, pivot until you have the right book and build traction
once you do.

© 2019 E.I.C.C., Inc.

**Tweet This Book!**

Please help Cal Evans by spreading the word about this book on
[Twitter](http://twitter.com/)!

The suggested tweet for this book is:

[I am about to start Using the WordPress REST
API!](https://twitter.com/intent/tweet?text=I%20am%20about%20to%20start%20Using%20the%20WordPress%20REST%20API!)

The suggested hashtag for this book is
[#usingWPREST](https://twitter.com/search?q=%23usingWPREST).

Find out what other people are saying about the book by clicking on this
link to search for this hashtag on Twitter:
[#usingWPREST](https://twitter.com/search?q=%23usingWPREST)

**Also By [Cal Evans](http://leanpub.com/u/calevans)**

[Signaling PHP](http://leanpub.com/signalingphp)

[Iterating PHP Iterators](http://leanpub.com/iteratingphpiterators)

[Going Pro](http://leanpub.com/goingpro)

[Culture of Respect](http://leanpub.com/cultureofrespect)

[Uncle Cal's Career Advice to
Developers](http://leanpub.com/uncle-cals-career-advice)

**Contents**

Register . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . . 1

Foreword . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . 2

[Introduction [4](#introduction)](#introduction)

[Introduction to the WordPress REST API
[5](#introduction-to-the-wordpress-rest-api)](#introduction-to-the-wordpress-rest-api)

[A Brief Definition of an API . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . 5](#a-brief-definition-of-an-api)

[What Can You Do With an API?
[5](#what-can-you-do-with-an-api)](#what-can-you-do-with-an-api)

[Why Have a REST API in WordPress? . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . 5](#why-have-a-rest-api-in-wordpress)

[What Can You Do With the WordPress REST API?
[6](#what-can-you-do-with-the-wordpress-rest-api)](#what-can-you-do-with-the-wordpress-rest-api)

[What You Need to Get Started
[7](#what-you-need-to-get-started)](#what-you-need-to-get-started)

[Summary [8](#summary)](#summary)

[Reading Public Endpoints - Posts and Pages
[9](#reading-public-endpoints---posts-and-pages)](#reading-public-endpoints---posts-and-pages)

[Understanding wp-json Metadata
[9](#understanding-wp-json-metadata)](#understanding-wp-json-metadata)

[Listing Posts [12](#listing-posts)](#listing-posts)

[Requesting a Single Post
[14](#requesting-a-single-post)](#requesting-a-single-post)

[Pagination [15](#pagination)](#pagination)

[Parameters for Posts and Pages
[15](#parameters-for-posts-and-pages)](#parameters-for-posts-and-pages)

[Other posts endpoints
[17](#other-posts-endpoints)](#other-posts-endpoints)

[Page Endpoints [18](#page-endpoints)](#page-endpoints)

[Summary [18](#summary-1)](#summary-1)

[Reading Public Endpoints - Everything Else
[19](#reading-public-endpoints---everything-else)](#reading-public-endpoints---everything-else)

[Taxonomy [19](#taxonomy)](#taxonomy)

[List Categories [20](#list-categories)](#list-categories)

[List Tags [21](#list-tags)](#list-tags)

[Global parameters [23](#global-parameters)](#global-parameters)

[Using the oEmbed Endpoint
[26](#using-the-oembed-endpoint)](#using-the-oembed-endpoint)

[Summary [28](#summary-2)](#summary-2)

[Authentication, WordPress, and You
[29](#authentication-wordpress-and-you)](#authentication-wordpress-and-you)

[Authentication Versus Authorization
[29](#authentication-versus-authorization)](#authentication-versus-authorization)

[HTTP Basic Authentication
[30](#http-basic-authentication)](#http-basic-authentication)

CONTENTS

JWT - JSON Web Tokens . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . 30

Using the Token . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . 33

Token Management . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . 35

Summary . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . 36

Modifying Data Using the REST API . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . 37

Creating Our Sample Application . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . 37

Manipulating WordPress . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . 38

User Management . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . 41

Summary . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . 44

Controlling WordPress from Another Application . . . . . . . . . . . . .
. . . . . . . . . . . . 45

Setting up the WordPress Frontend for the application . . . . . . . . .
. . . . . . . . . . . . . 45

Setting Up the CLI Application . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . 45

Dissecting the Application . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . 47

Fat Models . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . 49

Summary . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . 50

Conclusion . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . 51

Making WordPress Work Harder . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . 51

Additional Reading . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . 51

Thank you . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . 51

Odds and Ends . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . 52

jv.sh . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
. . . . . . . . . . . . . . . . . . . . 52

**Register**

> ![](media/image3.jpg){width="3.2500076552930883in"
> height="2.2930610236220472in"}

Cal Evans Hi!

Before you dive in, I just wanted to say thinks for being a reader. I
have a few add-on videos planned for this book and would love to tell
you about them when they are released.

If you want to stay up-to-date, [Click
Here](https://calevans.com/register/wp_rest_i) and fill out the form.

I do not ever share your email address with anyone, ever.

This will be a very low-volume mailing list. Probably one email a month.
But since you are interested in the WordPress REST API, I want to make
sure I can reach you when I add new content.

I hope you like the book!

Cheers! :)

=C=

Cal Evans

p.s. Feedback and testimonials are always welcome. Email me,
cal@calevans.com. See, I shared my email address with you. :)

Photo Credit: Matthew Trask.

\(c\) 2019 Matthew Trask, All Rights Reserved.

**Foreword**

I first met Cal via Twitter through an exchange around PHP, and we've
kept up ever since often discussing concepts that apply universally to
PHP developers but also WordPress developers as well. When I learned he
was writing a book on the REST API, I was interested.

And I think you should be, as well.

When I began working with WordPress in a professional capacity, it was
little more than a powerful application for blogging. Now, though, there
are a lot of features available that allow us to do so much more.

One of those features is the REST API.

But let me back up for a moment. One of the things we often hear about
WordPress is that it's not well-suited for anything more than a blogging
platform, let alone a content management system.

As the application has matured, new features have appeared, and existing
features have improved. Sure, there are aspects of the codebase that
maintain backward compatibility, which means that features specific to
modern versions of PHP are not in the core codebase.

That doesn't mean modern applications can't be developed on top of
WordPress, though. On the contrary. If you treat WordPress as an
application foundation, then you can de-couple your business logic and
presentation logic from the core application and write well-engineered,
testable, and scalable code.

When you consider the incorporation of the REST API, the possibilities
of building applications on WordPress extend beyond the web. For
example, through the REST API, we're able to leverage the database and
core features of WordPress along with custom logic to create unique
applications not previously possible.

For example, imagine writing an iOS application that communicates with
WordPress through a set of endpoints that provide authentication, data
serialization, validation, and retrieval. This functionality can be
extended further by writing an administrative frontend that reads the
data provided by the iOS application.

And this is but one example.

I don't think there's ever been a time in which so much was possible
with PHP and WordPress. And what Cal provides in this book is a
fantastic exploration of the WordPress REST API.

Through it, you have the opportunity to see what WordPress offers and
how you can apply it in your day-to-day work or in your side projects to
build powerful applications backed by WordPress and accessible through a
custom API.

Foreword 3

May the following chapters help you to recognize the potential that
exists with WordPress and empower you to write applications that you
didn't think were possible with a platform that powers over a third of
the internet.

Tom McFarlin [\@tommcfarlin](https://twitter.com/tommcfarlin)
[https://tommcfarlin.com](https://tommcfarlin.com/)

# Introduction

Dear Reader,

I didn't start out with the intention of writing a book on the WordPress
REST API; like most of my projects, I started out with an idea. I wanted
to add some functionality to my podcast's website.

Approximately 10 hours later, I realized I had three browser windows
open and twenty-seven tabs open across them, all about the WordPress
REST API.

I sat back and began to think. I've been programming for 36 years.
During that time, the most important skill I've honed across all
languages I've worked in, is the ability to find information, and figure
things out. I realize other developers may not have developed this skill
to the level I have or just may not be as tenacious as I am when I have
a project in mind.

Working with the WordPress REST API should not require this much effort.
Honestly, once you do find all the pieces and begin assembling them, you
begin to understand it really isn't difficult to work with.

I've collected everything I learned about the WordPress REST API here in
this one book. Everything you need to know to manipulate posts, images,
taxonomies, users, and everything else is covered here.

I hope this book saves you hours of research and helps you get to the
fun part more quickly, making WordPress do cool things.

Until next time,

I \<3 \|\<

=C=

Cal Evans

June 24, 2019

West Palm Beach, Florida, USA

# Introduction to the WordPress REST API

In this chapter, we lay the groundwork for the rest of the book. If you
know what an API is, if you understand a little about REST, and you are
confident in your abilities, it is safe to skip it. If, however, you've
not done any work with an API before, take the time to read this if only
so that you understand what you are diving into.

## A Brief Definition of an API

First, for those not familiar, an API is an "Application Programming
Interface." An API is a structured way for one program to talk to
another program.

[REST](https://en.wikipedia.org/wiki/Representational_state_transfer) is
a way many web-based APIs are structured. If you have ever typed a URL
into a web browser, you have used a REST API. REST is nothing more than
a way of thinking about APIs, a set of constraints that are applied so
systems can interoperate.

## What Can You Do With an API?

Strictly speaking, an API is not for humans to use, but for other
programs to use to communicate with a system. APIs can be used to
create, read, update, and delete entities from systems. Additionally,
APIs may be used to provide things like real-time updates from a system.

If you use the social media platform Twitter, every time you tweet, the
program you are using is making an API call to the main Twitter API to
send your tweet to everyone reading. When you read tweets, it is because
your program has made a call to Twitter's API to get the most recent
tweets for you. Even if you are using Twitter's website, you do not have
to constantly refresh the page to see new tweets; the site fetches them
for you in the background.

APIs are an agreed upon way for two different systems to interact.

## Why Have a REST API in WordPress?

There is no doubt that WordPress is a powerful system. What started out
as a simple blog has now been extended to build everything from
ecommerce storefronts to social media platforms. Over the years, the
WordPress Core Developers have built this simple system into a highly
extensionable software development framework.

> Throughout its history, developers have sought ways to extend the
> usefulness of WordPress in various ways. Once plugins were introduced
> in [version 1.2](https://wordpress.org/support/article/history/),
> developers had an official way of doing some tasks, but others simply
> did not fit in the model. Version 4.7 gave us the first REST endpoints
> to allow for machine-readable external access for enhanced third-party
> interaction.
>
> This was a huge improvement, even in its early stages. Since then,
> WordPress' REST API has grown more powerful with each release. The
> integrations that are now possible simply were not available before.
> Many plugins now define their own REST API endpoints to extend their
> usefulness to developers.
>
> Tasks that used to require code to be written and executed outside of
> WordPress to access the raw database and manipulate WordPress data can
> now be accomplished by making calls to REST endpoints and working
> within the system.
>
> Many WordPress systems can happily exist without ever having knowledge
> of the REST API. Going forward, however, all developers who extend
> WordPress on behalf of their projects or clients will have to know how
> the REST API operates and how to make calls to it to manage all
> aspects of a WordPress based system.

## What Can You Do With the WordPress REST API?

> Throughout the rest of this book, and this book's companion [Extending
> the WordPress REST API](https://leanpub.com/wordpress_rest_api_ii), we
> will examine different use cases for using it. Most of these use cases
> are simple and designed to demonstrate the how not the why.
>
> To illustrate a moderately complex use case, consider the following
> scenario.
>
> [WooCommerce](https://woocommerce.com/) is a very well known and
> widely used ecommerce solution built on top of WordPress. WooCommerce,
> however, does not have much in the way of Customer Relationship
> Management. (CRM). There is a self-hosted, open source solution for
> CRM named [Mautic](https://mautic.org/).
>
> When someone buys something from a WooCommerce shop, it is beneficial
> for the company to capture the customer's information and the
> transaction in the CRM system so this information can be aggregated
> with other data, and marketing decisions can be made.
>
> To get the data out of WooCommerce and into Mautic, the shopping cart
> process would need to make a call to the Mautic API (yes, there is
> one) to push the transaction data.
>
> When preparing marketing messages, Mautic needs to pull item data out
> of WooCommerce on an individual message basis. Mautic can do that by
> using WooCommerce's extensions to the WordPress REST API to retrieve
> the information necessary to send each person a customized message
> recommending a purchase.
>
> These two systems can talk to each other because they both have well
> defined APIs. The fact that they are both REST APIs makes it easier
> for the developer building the integration.

7

> Creating a well known and standardized way for applications to talk to
> each other allows developers to build systems that are more valuable
> than their individual parts.
>
> In this book, we cover what developers can do using the standard REST
> API endpoints that are baked into all WordPress installations. We will
> manipulate :

-   Posts

-   Media

-   Users

> The WordPress REST API also supports:

-   Tags

-   Pages

-   Comments

-   Taxonomies

-   Post Types

-   Post Statuses

-   General Blog Settings

> Once you understand the basics of how to use the WordPress REST API,
> understanding how to use the other endpoints is simply a matter of
> syntax and parameters.

## What You Need to Get Started

> In the next chapter, we will discuss reading from the WordPress REST
> API. The examples in the next chapter are non-destructive, read-only.
> You can use any WordPress blog as your backend data source. You are
> welcome to use the sample site we have set up for that purpose at
> example.wp-rest-api.com.
>
> You will need a computer with curl installed and a basic understanding
> of how to work in a command line environment. If you are using Linux
> or macOS, curl is already installed. You can verify this by opening a
> terminal and typing cURL at the prompt.
>
> If you are using Windows, you can install curl using the instructions
> on this page [How To Use cURL On Windows
> 10](https://www.addictivetips.com/windows-tips/use-curl-on-windows-10/).
>
> Once you move past the second chapter, though, you will need a
> WordPress installation of your own that you can work with. This can be
> local or remote, as long as it is hosted at an IP address you can get
> to. If you do not have a development WordPress site setup and do not
> want to bother with setting up and managing a development site, I
> highly recommend [Local
> Flywheel](https://getflywheel.com/layout/local-wordpress-development-environment-how-to/).
> This will let you set up your development environment locally, and
> turn it on and off as needed.
>
> Throughout this book, examples will be shown in the following format.

1 \$ command-to-be-executed \--parameters

> This is the standard shell prompt for Linux and macOS. If you are
> using Windows and you are on Windows 10, it is highly recommended you
> install the [Windows Linux
> Subsystem](https://docs.microsoft.com/en-us/windows/wsl/install-win10).
> This will allow you to use see the same format as above.
>
> It is possible to run the examples from the Windows command line like
> this.

1 C:**\\\\**your**\\\\**current**\\\\**path command-to-be-executed
\--parameters

> It is up to you to make sure the necessary software is properly
> installed, and the command is called in the proper format.

## Summary

> This chapter discussed what an API is, what REST is, and why WordPress
> now comes with a REST API. We delved into a little of what you can do
> with the WordPress REST API. Finally, we discussed the requirements
> for running the examples in this book. This chapter helped introduce
> you to the concepts; it is now time to put those concepts into action.

# Reading Public Endpoints - Posts and Pages

> Welcome to chapter two! In chapter one, we talked about the basic
> concepts of the WordPress REST API. In chapter two, we start seeing
> the magic behind the concepts. We'll start exploring some of the
> things we can do with the WordPress REST API which will work for any
> WordPress install that has the REST API implemented.
>
> In this chapter, we are going to discuss the following topics:

-   Understanding wp-json Metadata

-   List Posts

-   Requesting a single post

-   Pagination

-   Parameters for posts and pages

-   Summary

## Understanding wp-json Metadata

> The easiest WordPress REST API endpoint to access is simply /wp-json.
> This endpoint is the root of all other endpoints and calling it will
> show you information about the blog as well as the other registered
> endpoints.

#### Firefox Is Your Friend

> The exercises in this chapter will be shown using the command line
> interface and cURL, however, if you have
> [Firefox](https://www.mozilla.org/en-US/firefox/new/) installed,
> Firefox will automatically convert JSON payloads to a human-readable
> format. It may be easier for you to visualize what is going on by
> using Firefox.
>
> To see the metadata the WordPress REST API will show you about a given
> WordPress install, access the /wp-json endpoint. This is the most
> basic of endpoints.
>
> 1 \$ curl -s http://example.com/wp-json \| jv.sh Let's look at the
> payload returned to us.

#### Basic Installation Information

1.  \"name\": \"Cal&#039;s Test Site\",

2.  \"description\": \"If it pleases and sparkles\...\",

3.  \"url\": \"http://example.com\",

4.  \"home\": \"http://example.com\",

5.  \"gmt_offset\": \"0\",

6.  \"timezone_string\": \"\",

> The first six pieces of information are the basics about the given
> WordPress install. Anyone familiar with setting up a WordPress install
> will recognize this information from the Admin-\>General-\>Settings
> page.

#### Namespaces

> After this, we are given a list of the namespaces installed. In
> WordPress REST API installs, a "namespace" is the root path of an API.
> While there are no hard and fast rules as to how namespaces are
> structured, the best practice recommended by the WordPress REST API
> Handbook is the format vendor\\version. As you can see from our
> example, the exact definition is left up to the vendor.

1.  \"namespaces\": \[

2.  \"oembed/1.0\",

3.  \"wp/v2\"

4.  \],

> The oEmbed API uses a version of major.minor, while the official API
> endpoint uses "v"+version. Either version works. The version number is
> important because if a vendor changes an endpoint, they will usually
> version their API. This way calls that would normally fail, will
> automatically fail, until the developer updates the call and the URL
> being accessed.
>
> By default, these are the only two REST APIs installed when you create
> a basic WordPress install. Adding additional plugins like Akismet,
> will add new namespaces to this list.
>
> Namespaces in the WordPress REST API are different in structure and
> meaning from namespaces in PHP or other programming languages. Don't
> get confused by assuming they are the same thing.

#### Routes

> Namespaces plus endpoints make up "routes." For example, if your
> WordPress install is at [https://example.com](https://example.com/),
> and your namespace is eicc/v1/podcast and your route is "episode, then
> the entire URL to your endpoint is
> <https://example.com/wp-json/eicc/v1/podcast/episode>. Note the
> wp-json after the domain name. This is where all the WordPress REST
> API endpoints exist, both native and custom. The route is the custom
> part of the endpoint. In the case above, the namespace is my company
> name + this plugin's namespace + the version for this plugin. This
> allows me to create multiple plugins under the eicc namespace, version
> each one, and have different endpoints for each one.
>
> The combination of all of this is an endpoint. The route portion of
> the endpoint is the combination of the pieces above. From this point
> on, unless we are discussing a piece of the route individually, we
> will assume to endpoint to mean the entire URL.
>
> Our listing of the wp-json endpoint above gave us several routes. All
> the routes given fall under one of the listed namespaces.

1.  \"routes\": {

2.  **\"/\"**: {

3.  **\"namespace\"**: \"\",

4.  **\"methods\"**: \[

5.  \"GET\"

6.  \],

7.  **\"endpoints\"**: \[

8.  {

9.  **\"methods\"**: \[

10. \"GET\"

11. \],

12. **\"args\"**: {

13. **\"context\"**: {

14. **\"required\"**: **false**,

15. **\"default\"**: \"view\"

16. }

17. }

18. }

19. \],

20. **\"\_links\"**: {

21. **\"self\"**: \"http://example.com/wp-json/\"

22. }

23. },

> This is a listing for the endpoint <https://example.com/wp-json>, the
> one we accessed. From this we can tell the following:

-   There is only one route, /. This means that
    <https://example.com/wp-json/> is valid, but
    <https://example.com/wp-json/4> is not.

-   There is no namespace assigned to this route.

-   There is only one method that is allowed to access this endpoint,
    GET. If you try to POST to this endpoint, for instance, you will
    receive an error.

-   There are no required parameters to access this endpoint.

-   This endpoint only allows for one argument (defined in the args
    collection) "context," and the default value for this argument is
    "view."

-   The link to this endpoint is listed in \_links.self.

> You will get one entry in the routes collection for each endpoint
> registered. They are grouped by namespace.
>
> This collection of information will help you see what REST API
> endpoints are available to you and what parameters each endpoint
> takes. While we are reading this information and digesting it
> ourselves, it would be trivial to write code that consumes this page,
> determines if the endpoint it is looking for exists on this WordPress
> install, and if so, take action. APIs are, after all, for computers
> and not for humans.
>
> All namespaces in the WordPress REST API will output their own subset
> of the above data if you access / with the verb GET. For example, if
> you access <https://example.com/wp-json/oembed/1.0/> it will emit just
> the endpoints, arguments, and constraints for the oEmbed REST API.

## Listing Posts

> Since posts are the most ubiquitous types in WordPress, we will start
> our experimenting with the WordPress REST API by listing and
> retrieving posts. This is also the simplest example of use of the API.

1 \$ curl -s http://example.com/wp-json/wp/v2/posts \| jv.sh

> We know from the previous section, if we leave posts off then we will
> get the metadata for the namespace. Adding posts to it tells WordPress
> we are now interested in talking to it about posts. The metadata tells
> us this endpoint will accept two verbs GET and POST.
>
> Do not confuse the HTTP verb POST with the WordPress concept of posts.

-   GET will retrieve a listing of posts. The number of posts retrieved
    by default is controlled by the Admin setting in the WordPress
    install, however, this number can be overridden with a parameter.

-   POST will allow us to actually create a new post in this WordPress
    installation. We will go into more detail about that in the coming
    chapters. Before we can do that, we need to understand concepts like
    authentication and authorization; we'll get to that.

> For now, we will use the command above to retrieve a list of posts.
> Let's unpack the results.

1.  {

2.  **\"id\"**: 200,

3.  **\"date\"**: \"2019-06-01T14:45:20\",

4.  **\"date_gmt\"**: \"2019-06-01T14:45:20\",

5.  **\"guid\"**: {

6.  **\"rendered\"**: \"http://example.com/?p=200\"

7.  },

8.  **\"modified\"**: \"2019-06-01T14:45:20\",

9.  **\"modified_gmt\"**: \"2019-06-01T14:45:20\",

10. **\"slug\"**: \"using-the-wordpress-rest-api\",

11. **\"status\"**: \"publish\",

12. **\"type\"**: \"post\",

13. **\"link\"**:
    \"http://example.com/2019/06/using-the-wordpress-rest-api/\",

14. **\"title\"**: {

15. **\"rendered\"**: \"Using the WordPress REST API\"

16. },

17. **\"content\"**: {

18. **\"rendered\"**: \"\<h1\>The complete HTML of the post as stored in
    the data sto\\

19. re, sans the theme.\",

20. **\"protected\"**: **false**

21. },

22. **\"excerpt\"**: {

23. **\"rendered\"**: \"The first paragraph of the content unless an
    excerpt was se\\

24. t on the post.\",

25. **\"protected\"**: **false**

26. },

27. **\"author\"**: 1,

28. **\"featured_media\"**: 0,

29. **\"comment_status\"**: \"closed\",

30. **\"ping_status\"**: \"closed\",

31. **\"sticky\"**: **false**,

32. **\"template\"**: \"\",

33. **\"format\"**: \"standard\",

34. **\"meta\"**: \[\],

> There is a lot here to unpack.

-   id is the ID of the post.

-   date field holds the date in server local time that the post was
    originally published.

-   date_gmt holds the original date published in GMT time.

-   guid is a collection which holds a single element, rendered. This is
    the complete URL as if permalinks are turned off. This is a globally
    unique identifier (GUId) for this particular post.

-   modified and modified_gmt are similar in nature to the above date
    fields except their value is the date and time the post was last
    modified.

-   slug is a unique-to-this-installation identifier for this particular
    post. Permalinks uses this as the identifier of the post.

-   status is the status of the post. This is usually publish or draft
    but future, pending, and private are also valid values.

-   type is the post type for this post. If this WordPress installation
    has custom post types, this value can be any of the custom post
    types, the default is post.

-   link is the link to the post honoring the PermaLink rules if any.

-   title is a collection with a single element, rendered. This is the
    title of the post.

-   content is the full content of the post. If this is a standard
    WordPress post, then this is the body of the post including all
    HTML. This does not include anything that is in the template for the
    post, only the content you see displayed in the editor.

-   excerpt If an excerpt for the post was set, then this is that
    content. Otherwise, this is the first paragraph of the post.

-   author This is the ID of the author of the post.

-   featured_media This is the post ID of the featured media for this
    post or 0 if none.

-   comment_status tells you whether or not comments can be posted to
    this post. Valid values are open and closed.

-   ping_status Similar to above, this field tells you whether or not
    pingbacks to this post will be recorded. Valid values are open and
    closed.

-   sticky This field is true if this post is a sticky post and false if
    it is not.

-   template is the name of the theme file to use to render this page or
    empty string if none is specified.

-   format This is the format for this post. The default value is
    standard but aside, chat, gallery, link, image, quote, status,
    video, and audio are also acceptable values.

-   meta is a collection of metadata associated with the post or empty
    collection if none. Note, this collection will not contain any and
    all metadata associated with the given post, only registered
    metadata.

> All of these fields will be returned for each post returned. We will
> talk about pagination in the section below about global variables.
> Right now, all you need to know is the number of posts returned is the
> default set by the blog Admin in the Settings-\>Read page. You can
> override that number and you can also specific pages of posts from
> this endpoint.

## Requesting a Single Post

> Now that we've seen how to get an entire list of posts, let's look at
> how we get the information for a single post.

1 \$ curl -s http://example.com/wp-json/wp/v2/posts/200 \| jv.sh

> The payload returned is very similar to the one above with the
> exception that you only get a single post returned, not a collection
> of posts.
>
> The other major difference between requesting a single post and a
> collection of posts is if you do not have authorization to view the
> requested post, you will receive a 401 error. You may not have
> authorization for a variety of reasons including the following.

-   The post is not a public post, and you are not logged in.

-   The post requires a password to access.

> Since we are experimenting with public endpoints at the moment, if any
> of these are true, we will receive a 401 error. Additionally, if we
> request a post that does not exist, or a post that exists but has not
> yet been published, we will receive a 404 error.

## Pagination

> As with almost any API that returns a collection, WordPress gives
> developers control over the content of the list via pagination
> controls. The WordPress REST API gives developers the standard
> controls of number of entries per page and page to display. These
> parameters are page and per_page respectively. These parameters are
> passed in on the URL.

1 \$ curl -s http://example.com/wp-json/wp/v2/posts?page=2&per_page=20
\| jv.sh

> This will return a collection of posts which is per_page long. The
> collection will begin at post page \* per_page. Both parameters must
> contain a positive integer value. per_page has a maximum value of 100.
> Any value for either parameter that is out of bounds will result in a
> response code 400.

## Parameters for Posts and Pages

> In addition to pagination, the WordPress REST API has other parameters
> that can be passed into any endpoint resulting in a collection. These
> parameters help filter the resulting list. Many plugin routes
> implement the /schema endpoint, which returns a collection of
> parameters that can be used to manipulate the endpoint. Sadly, the
> default /wp/v2 routes do not. As of this writing, here are the query
> parameters for posts and pages.

-   context: The possible values for this are view, embed, edit. The
    default is \*8view\*\*. Context determines which fields are returned
    in the response payload.

-   page, per_page: See section above on pagination.

-   search: Adding search and a word or a phrase, will limit the results
    set to entities that contain that word or phrase somewhere in the
    post, title, or excerpt.

-   before, after: If you specify either of these parameters and a
    ISO8601 formatted date as its value, the resulting collection will
    only contain entities published after the date specified. For after
    to work you have to specify the full and correctly formatted ISO8601
    date.

> YYYY-MM-DDTHH:II:SS. You cannot use one of the abbreviated formats.

1.  **echo** (**New** DateTimeImmutable())

2.  -\>format(DateTimeInterface::ISO8601);

    -   author, author_exclude: If you specify the 8author parameter and
        then a valid author ID, the resulting collection will only
        contain entities from that author. author_exclude is the logical
        opposite.

    -   exclude: If you pass in exclude as a command line parameter, the
        value can be a single entity ID (e.g., post ID, page ID, etc.)
        or a comma-delimited list of entity IDs. These entities will be
        excluded from the resulting collection.

    -   include: Similar to exclude but if present then the collection
        will only contain the entities specified.

    -   offset: This is mainly used in pagination. Instead of specifying
        page and letting the system computer page \* per_page, you can
        specify the offset to use.

1 \$ curl -s
http://example.com/wp-json/wp/v2/posts?offset=120&per_page=20 \| jv.sh

The command above will result in a collection of 20 posts, starting at
the 120th most recent post.

-   order: Valid values are DESC and ASC. By default, all collections
    are ordered in DESCending order of date published. The above example
    counts backward from the most recent post and starting with 120,
    builds the collection. If you specify ASC, then it will start with
    the first post in the system and count forward.

-   orderby: The default order for any collection is date. If you want
    to change that, you can specify another field to order on. Valid
    values are:

    -   author

    -   date

    -   id

    -   include

    -   modified

    -   parent

    -   relevance

    -   slug

    -   title

<!-- -->

-   slug: You can specify the slug of the post you want retrieved. This
    has to be an exact match. A partial slug will not return all
    matches; it will return an empty collection.

-   status: You can filter on the status of the entity. The default is
    publish. Any valid status is accepted. If you pass in a status with
    no entities in that status, you will receive an empty collection. If
    you pass in a string that is not a valid status, you will receive a
    400 error. If you specify a status which requires authorization to
    view and you are not authenticated and authorized (we cover that in
    a coming chapter), then you will receive a 400 error.

-   categories, categories_exclude: Two sides of the same coin, you can
    either specify a commadelimited list of categories to include, or
    exclude.

-   tags, tags_exclude: A tag ID or comma-delimited list of tag IDs on
    which to filter the collection. All entities in the collection will
    contain one of the specified tags. tags_exclude is the logical
    opposite. No entity will be included in the collection if it
    contains one of the specified tags.

-   sticky: Limits the collection to only items that have been marked as
    sticky.

## Other posts endpoints

> In addition to viewing a collection of posts, and a single post, other
> endpoints give other information of use to developers. Here is a
> complete list of all the endpoints for a post including the ones that
> we have already covered. Not all of these endpoints are publicly
> available. Most need authentication and authorization before they can
> be called.

-   /wp/posts/

    -   GET Retrieve a collection of posts

    -   POST Create a new post

-   /wp/posts/#ID#/

    -   GET Retrieve a single post

    -   POST, PUT, PATCH Update a single post

    -   DELETE Delete a single post

-   /wp/posts/#ID#/revisions

    -   GET Retrieve a collection of post's revisions

-   /wp/posts/#ID#/autosaves

    -   GET Retrieve a collection of post's autosaves

    -   DELETE Delete the autosaves for a given post

-   /wp/posts/#ID#/autosaves/#AUTOSAVEID#

    -   GET Retrieve a single autosave of a post

## Page Endpoints

> WordPress implements the same endpoints for pages as it does for
> posts. The access methods are very similar as well as the payloads. We
> will not rehash access methods or payloads here since they are so
> similar. We will, however, provide a list of the endpoints for
> reference. Not all of these endpoints are publicly available. Most
> need authentication and authorization before they can be called.

-   /wp/pages/

    -   GET Retrieve a collection of pages

    -   page Create a new page

-   /wp/pages/#ID#/

    -   POST, PUT, PATCH Update a single page

    -   DELETE Delete a single page

-   /wp/pages/#ID#/revisions

    -   GET Retrieve a collection of page's revisions

-   /wp/pages/#ID#/autosaves

    -   GET Retrieve a collection of page's autosaves

    -   DELETE Delete the autosaves for a given page

-   /wp/pages/#ID#/autosaves/#AUTOSAVEID#

    -   GET Retrieve a single autosave of a page

## Summary

> We have examined some of the main things you can do with the WordPress
> REST API without authentication and authorization. It is important
> that before you move forward, you understand the basics of retrieving
> information. All of the endpoints discussed here can be accessed on
> any WordPress installation that has not disabled REST. Before moving
> forward, you are encouraged to explore. See what you can accomplish
> just with these endpoints.

# Reading Public Endpoints - Everything Else

> In the last chapter, we focused on the two main public endpoints,
> posts and pages. A standard WordPress install, however, has other
> public endpoints that can be accessed. This chapter describes some
> other endpoints you can access. By now you should have set up a test
> WordPress install you can practice on. If not, these endpoints are
> read-only, so it won't hurt to access them on a production system.
> That having been said, this is the last chapter you will be able to
> work through without an install to which you can make changes.
>
> In this chapter, we will discuss the following topics.

-   Taxonomy

-   List Categories

-   List Tags

-   Global parameters

-   Using the oEmbed endpoint

## Taxonomy

> In its most simple definition, taxonomy is how we classify things in
> WordPress. In a standard WordPress installation, there are two types
> of taxonomy: categories and tags. Categories tend to be broad
> classifications, and tags tend to be more narrowly focused. There,
> however, is no right or wrong way to use these taxonomies so your
> usage may differ.
>
> The WordPress REST API gives us endpoints for manipulating standard
> taxonomies, and they are described for us in the call to /wp-json.
>
> Both of these have similar endpoints. We discuss the collection
> endpoint for each as they are available without authentication and
> authorization. Here is the complete list of the categories endpoints;
> tags has the exact same list.

-   /wp-json/wp/v2/categories

    -   GET returns a collection of categories.

    -   POST creates a new category.

-   /wp-json/wp/v2/categories/#ID#

    -   GET retrieves a single category.

    -   POST, PUT, and PATCH will update an existing category.

    -   DELETE removes a category form the system.

## List Categories

> WordPress also provides REST API endpoints to query categories. The
> categories endpoint returns a collection:

1 \$ curl -s http://example.com/wp-json/wp/v2/categories \| jv.sh

> Below we see a single category payload to show what this endpoint
> returns.

1.  \[

2.  {

3.  **\"id\"**: 268,

4.  **\"count\"**: 3,

5.  **\"description\"**: \"\",

6.  **\"link\"**: \"https://example.com/category/periscopes/\",

7.  **\"name\"**: \"Periscopes\",

8.  **\"slug\"**: \"periscopes\",

9.  **\"taxonomy\"**: \"category\",

10. **\"parent\"**: 0,

11. **\"meta\"**: \[\], 12 **\"\_links\"**: {

<!-- -->

13. **\"self\"**: \[

14. {

15. **\"href\"**: \"https://example.com/wp-json/wp/v2/categories/268\"

16. }

17. \],

18. **\"collection\"**: \[

19. {

20. **\"href\"**: \"https://example.com/wp-json/wp/v2/categories\"

21. }

22. \],

23. **\"about\"**: \[

24. {

25. **\"href\"**:
    \"https://example.com/wp-json/wp/v2/taxonomies/category\"

26. }

27. \],

28. **\"wp:post_type\"**: \[

29. {

30. **\"href\"**:
    \"https://example.com/wp-json/wp/v2/posts?categories=268\"

31. }

32. \],

33. **\"curies\"**: \[

34. {

35. **\"name\"**: \"wp\",

36. **\"href\"**: \"https://api.w.org/{rel}\",

37. **\"templated\"**: **true**

38. }

39. \]

40. }

41. }

42. \]

> Beyond the normal information we as developers are used to seeing
> about categories, we see the endpoint returns a \_links collection.
> Almost all WordPress REST APIs return \_links. This collection is a
> collection of related endpoints of interest which are related to the
> payload returned.

-   All \_links payloads have the attribute self. self is the link
    necessary to access the element being described. In the case above,
    self is a link to the category "periscopes," which is part of a
    collection.

-   collection is a link to fetch the collection of this type of item,
    in our case, categories. If we had called the single category
    endpoint, collection would give us access to the entire collection.

-   about is a link that will give information about the type of item
    being displayed. In this case, since we asked for the collection of
    categories, the about gives a link to an endpoint that describes
    what a category is.

-   wp:post_type is a call to the posts endpoint described above with
    the parameter "categories" and the value of the category being
    displayed. This will return a collection of all the posts tagged
    with this category.

-   curies are part of the HAL specification. They are supposed to be a
    link to additional information. Here is a great article by Mike G.
    Stowe titled [What the Heck are
    CURIEs?!](http://www.mikestowe.com/2015/01/what-the-heck-are-curies.php).
    Sadly, it does not look like this is operational at w.org. In our
    case, the URL would be <https://api.w.org/categories> to get an
    official definition of a category. However, that link brings up a
    404 as of this writing.

## List Tags

> Similar to categories, tags has its own endpoint.

1 \$ curl -s http://example.com/wp-json/wp/v2/tags \| jv.sh

> The above call will return a collection of tags. The payload is also
> similar to categories. We won't take the time to discuss each item,
> see the discussion above.

1.  {

2.  **\"id\"**: 292,

3.  **\"count\"**: 1,

4.  **\"description\"**: \"\",

5.  **\"link\"**: \"https://example.com/tag/my-tag/\",

6.  **\"name\"**: \"my-tag\",

7.  **\"slug\"**: \"my-tag\",

8.  **\"taxonomy\"**: \"post_tag\",

9.  **\"meta\"**: \[\], 10 **\"\_links\"**: {

<!-- -->

11. **\"self\"**: \[

12. {

13. **\"href\"**: \"https://example.com/wp-json/wp/v2/tags/292\"

14. }

15. \],

16. **\"collection\"**: \[

17. {

18. **\"href\"**: \"https://example.com/wp-json/wp/v2/tags\"

19. }

20. \],

21. **\"about\"**: \[

22. {

23. **\"href\"**:
    \"https://example.com/wp-json/wp/v2/taxonomies/post_tag\"

24. }

25. \],

26. **\"wp:post_type\"**: \[

27. {

28. **\"href\"**: \"https://example.com/wp-json/wp/v2/posts?tags=292\"

29. }

30. \],

31. **\"curies\"**: \[

32. {

33. **\"name\"**: \"wp\",

34. **\"href\"**: \"https://api.w.org/{rel}\",

35. **\"templated\"**: **true**

36. }

37. \]

38. }

39. },

## Global parameters

> Throughout this chapter, as we discuss an endpoint, we have given the
> verbs available, as well as the arguments it will accept. There are
> also a series of global parameters available for all of the endpoints.
> Let's take a look at them and how they affect the result sets.

#### \_envelope

> There are clients - mostly older clients - that do not allows access
> to the entire response. The WordPress REST API allows you to specify
> \_envelope as a parameter on the URL; it requires no value with it.
> When you pass this parameter, all the response data, the response
> code, and the headers are encapsulated in a collection named body.
>
> This is a parameter that is normally not necessary.

#### \_method

> Some older clients may not allow developers to specify HTTP verbs
> other than GET and POST. In these rare cases, the WordPress REST API
> provides a parameter to allow the developer to specify what VERB was
> intended.

1.  \$ curl -v **\\**

2.  -H \"Content-type: application/json\" **\\**

3.  -H \"Accept: application/json\" **\\**

4.  -H \"Authorization: Bearer \$TOKEN\" **\\**

5.  -d =\'{\"name\":\"test\"}\' **\\**

6.  -X GET

7.  http://example.com/wp-json/wp/v2/tags?\_method=POST

> The above call - assuming you have authentication and authorization
> which we cover in the next chapter - will create a tag in the system
> named "test." The above call forces cURL to issue a GET with the line
> -X GET but passes in the parameter \_method to tell the WordPress REST
> API to treat it as a POST. A new tag will be created if one does not
> already exist because that is the action registered for a POST on that
> endpoint.
>
> This is a parameter that is normally not necessary.

#### \_jsonp

> JSONP is an old-style attempt to bypass CORS and allow an application
> to load data from another domain. It does this by using the \<script\>
> tag to load in data. (Or, more recently, jQuery's getScript()). The
> problem is if you use one of these methods to load data, JavaScript
> will attempt to compile whatever is returned. Since an object cannot
> compile into code, JavaScript will throw an error. By passing in the
> \_jsonp parameter, along with a callback function name, the WordPress
> REST API will wrap the return payload in a call to the function name
> supplied. For example, a call to fetch a single tag like this:
>
> 1 \$ curl -s
> http://example.com/wp-json/wp/v2/tags/1?\_jsonp=parseResponse \| jv.sh
> Will return the following payload.

1.  */\*\*/*

2.  parseResponse (

3.  {

4.  \"id\": 8,

5.  \"count\": 0,

6.  \"description\": \"\",

7.  \"link\": \"http://example.com/tag/test/\",

8.  \"name\": \"test\",

9.  \"slug\": \"test\",

10. \"taxonomy\": \"post_tag\"

11. }

12. )

> Notice the entire response is wrapped in a call to parseResponse(). It
> is up to you to make sure the callback function is accessible in your
> code. You can name your callback any legal JavaScript function name;
> there is nothing magical about the name parseResponse. Additionally,
> it can be as simple as the example below, which simply returns the
> data ready for you to manipulate it, or you can do pre-processing and
> validation in your callback.

1.  **function** parseResponse(data)

2.  {

3.  **return** data;

4.  }

> JSONP is not normally used anymore and is included in the WordPress
> REST API to facilitate access from legacy systems. It is now possible
> to control access to [cross origin resource
> sharing](https://en.wikipedia.org/wiki/Cross-origin_resource_sharing),
> and for security reasons, this is the preferred method.
>
> This is a parameter that is normally not necessary.

#### \_embed

> This one is a bit more useful. Passing \_embed on the URL will create
> another element in the payload collection named \_embedded in each
> element in the collection. If you are requesting a collection of
> posts, each post item will have an \_embedded element.
>
> The \_embedded element is a collection. This collection contains full
> elements for each item in the parent collection that specified an ID.
> For example, if you specify \_embed when requesting a post, you still
> get the element author with the author's user ID as the value.
> However, in the \_embed collection, you will also have an element
> author that will contain the full user collection for the author of
> the post.
>
> Here is an example. This is only a partial payload.

1.  \_embedded\": {

2.  \"author\": \[

3.  {

4.  \"id\": 1,

5.  \"name\": \"Cal Evans\",

6.  \"url\": \"https://blog.calevans.com\",

7.  \"description\": \"Author of the book \'Using the WordPress REST
    API\'\",

8.  \"link\": \"http://example.com/author/calevans/\",

9.  \"slug\": \"calevans\",

10. \"avatar_urls\": {

11. \"24\":
    \"http://1.gravatar.com/avatar/d6d504bf40dea91cd33027e5bb85f7df?s=24&\\

12. d=mm&r=g\",

13. \"48\":
    \"http://1.gravatar.com/avatar/d6d504bf40dea91cd33027e5bb85f7df?s=48&\\

14. d=mm&r=g\",

15. \"96\":
    \"http://1.gravatar.com/avatar/d6d504bf40dea91cd33027e5bb85f7df?s=96&\\

16. d=mm&r=g\"

17. },

18. \"\_links\": {

19. \"self\": \[

20. {

21. \"href\": \"http://example.com/wp-json/wp/v2/users/1\"

22. }

23. \],

24. \"collection\": \[

25. {

26. \"href\": \"http://example.com/wp-json/wp/v2/users\"

27. }

28. \]

29. }

30. }

31. \],

> As you can see, this will make your response payloads much larger in
> most cases. However, it is designed to reduce the number of calls a
> developer has to make to the system to gather the data they need. If
> you regularly make multiple calls to the system to retrieve objects
> that are referenced in your original call, and you are working on a
> platform where bandwidth and memory constraints are not an issue, then
> it is recommended you specify \_embed.

## Using the oEmbed Endpoint

> Since we are discussing standard endpoints accessible on any default
> WordPress installation, let's take a quick look at the oEmbed
> namespace.
>
> [oEmbed](https://oembed.com/) is a standard implemented by many media
> providers like YouTube, Flickr, and Twitter. Each of these providers
> (and many others) allow you to request an oEmbed payload that
> describes a specific piece of content. For instance, Flicker
> implements oEmbed like this.

1.  curl -s
    http://www.flickr.com/services/oembed/?format=json&url=https://www.flick**\\**

2.  r.com/photos/calevans/286000639/ \| jv.sh

> Making that call will return the following JSON payload.

1.  {

2.  **\"type\"**: \"photo\",

3.  **\"flickr_type\"**: \"photo\",

4.  **\"title\"**: \"7 of Clubs\",

5.  **\"author_name\"**: \"CalEvans\",

6.  **\"author_url\"**: \"https://www.flickr.com/photos/calevans/\",

7.  **\"width\"**: 465,

8.  **\"height\"**: \"640\",

9.  **\"url\"**:
    \"https://live.staticflickr.com/119/286000639_84220944e3_z.jpg\",

10. **\"web_page\"**:
    \"https://www.flickr.com/photos/calevans/286000639/\",

11. **\"thumbnail_url\"**:
    \"https://live.staticflickr.com/119/286000639_84220944e3_q.jpg\",

12. **\"thumbnail_width\"**: 150,

13. **\"thumbnail_height\"**: 150,

14. **\"web_page_short_url\"**: \"https://flic.kr/p/rgQ2v\",

15. **\"license\"**: \"All Rights Reserved\",

16. **\"license_id\"**: 0,

17. **\"html\"**: \"\<a data-flickr-embed=\\\"true\\\"
    href=\\\"https://www.flickr.com/photos/cale\\ 18 vans/286000639/\\\"
    title=\\\"7 of Clubs by CalEvans, on Flickr\\\"\>\<img
    src=\\\"https://liv\\

19 e.staticflickr.com/119/286000639_84220944e3_z.jpg\\\"
width=\\\"465\\\" height=\\\"640\\\" alt\\ 20 =\\\"7 of
Clubs\\\"\>\</a\>\<script async
src=\\\"https://embedr.flickr.com/assets/client-code\\

21. .js\\\" charset=\\\"utf-8\\\"\>\</script\>\",

22. **\"version\"**: \"1.0\",

23. **\"cache_age\"**: 3600,

24. **\"provider_name\"**: \"Flickr\",

25. **\"provider_url\"**: \"https://www.flickr.com/\"

26. }

> As you can see, this gives developers all the data they need to embed
> the picture into a document. If you have ever pasted a link to a
> YouTube video into the classic WordPress editor and it replaced it
> with the thumbnail of the video, the oEmbed specification is how that
> is done.
>
> WordPress includes an oEmbed endpoint for anyone wanting to get
> embeddable information on a public post.

1.  curl -s
    http://example.com/wp-json/oembed/1.0/embed?url=http://example.com/?p=20**\\**

2.  0 \| jv.sh

> Will give a payload with all the information necessary to create an
> embed of the post in another document.

1.  {

2.  **\"version\"**: \"1.0\",

3.  **\"provider_name\"**: \"Cal&#039;s Test Site\",

4.  **\"provider_url\"**: \"http://example.com\",

5.  **\"author_name\"**: \"Jane Doe\",

6.  **\"author_url\"**: \"http://example.com/author/janedoe/\",

7.  **\"title\"**: \"Interview with Kris Kringle\",

8.  **\"type\"**: \"rich\",

9.  **\"width\"**: 600,

10. **\"height\"**: 338,

11. **\"html\"**: \"\<blockquote class=\\\"wp-embedded-content\\\"\>\<a
    href=\\\"http://example.com/\\ 12
    2019/06/interview-with-kris-kringle/\\\"\>Interview with Kris
    Kringle\</a\>\</blockquote\>\"\\

<!-- -->

13. ,

14. **\"thumbnail_url\"**:
    \"http://example.com/wp-content/uploads/2019/05/302.jpg\",

15. **\"thumbnail_width\"**: 400, 16 **\"thumbnail_height\"**: 400

17 }

> We have the name of the post, the name of the author, the content of
> the post, and a thumbnail of the graphic. Using this information, we
> could easily create anything from a callout to a graphic with a link
> to the actual post. Most importantly, the html field contains code
> that can be inserted into an HTML document on the same site, as is.
>
> The WordPress oEmbed REST API will return data on any public content
> that is stored in the posts table. This means pages, posts, custom
> post types, and media will all return an oEmbed payload.
>
> The WordPress oEmbed REST API takes three parameters.

-   url: This is the only required parameter. You have to pass in the
    full URL of the item you want to embed. If it is not public, if it
    is not valid, or if it is not a URL for this site, you will be
    returned an error.

-   format: The oEmbed API will return its payload in two different
    formats, JSON or XML. JSON is the default if you do not specify a
    format. If JSON is your preferred format, there is no need to
    specify this format.

-   maxwidth: If the item you are requesting an embeddable for is an
    image, you can specify the maxwidth parameter. This will resize the
    graphic to the proper size.

## Summary

> For the last two chapters, we have discussed and used the WordPress
> REST API endpoints you can use without logging in. This is a very
> limited subset of the things the WordPress REST API can do. In the
> next chapter, we introduce the concepts of authentication and
> authorization, the two sides of the auth coin. Understanding this is
> the key to unlocking all of the possibilities.

# Authentication, WordPress, and You

> There is only so much a system will let you do without knowing who you
> are and what you are allowed to do. WordPress started life as a
> blogging platform. As a blogging platform, all were allowed to read,
> but only those that could prove we knew them could actually post. They
> had to authenticate with the system before they were allowed. Later
> on, WordPress allowed roles to be assigned. Now, just because you
> could authenticate with the system, didn't mean you had permission to
> actually write and publish a post; you had to also have authorization.
>
> In this chapter, we will talk a little about the difference between
> the two. Then, we'll discuss how they are implemented in WordPress and
> how we use them to secure the WordPress REST API.

-   Authentication Versus Authorization

-   HTTP Basic Authentication

-   JWT

-   Token Management • Dealing with CORS

## Authentication Versus Authorization

> Often you will hear a developer use the term "auth" when they mean one
> of the two sides of the auth coin.

-   Authentication is side one of the auth coin. Does our system know
    this person at all? Do they have the proper credentials (user name
    and password) to authenticate to our system?

-   Authorization is side two of the auth coin. Once we know the person
    has the credentials to authenticate, we then need to know what
    permissions they have in the system. This is known as authorization.

> Taken together, they are collectively known as "auth." It is important
> when discussing APIs that you understand the difference and use the
> full and proper term when having a discussion.
>
> "The user needs auth to execute that task."
>
> This is an example of bad communication. Is this person saying the
> user needs authentication to the system, and that once authenticated,
> any user can perform the task? Or is this person saying the user needs
> the proper authorization before they can perform the task?
>
> Words mean things; be as explicit as possible when having a technical
> discussion.

## HTTP Basic Authentication

> By default, the WordPress REST API only supports one type of
> authentication: [HTTP basic
> authentication](https://en.wikipedia.org/wiki/Basic_access_authentication).
> To use basic authentication, you pass in a header with every request
> with your username and password, base_64 encoded.

1.  \$username = \'myUserName\';

2.  \$password = \'myPassword\';

3.  \$credentials = base64_encode(\$username . \':\' . \$password);

4.  header(\'Authorization: Basic \' . \$credentials);

> This will work, but it is not a good idea in production. The biggest
> problem with basic authentication is that you are constantly passing
> your username and password over the wire. Even with an encrypted
> session (HTTPS), you are still widening the "attack window."
>
> Basic authentication is fine if you are doing local development and
> don't want to spend the cycles implementing something more secure.
> However, before you put your system into production, you are strongly
> urged to move to a more secure authentication concept.

### JWT - JSON Web Tokens

> For our purposes, there is a more secure, and easily implemented
> solution for the WordPress REST API, JWT. Specifically, the plugin
> [JWT Authentication for WP REST
> API](https://wordpress.org/plugins/jwt-authentication-for-wp-rest-api/).
>
> JSON Web Tokens are signed and/or encrypted tokens that can be passed
> around. Yes, we still have to use basic authorization to pass our
> username and password to the WordPress REST API the first time, but
> then get back a token we can use instead. JWT tokens are "bearer"
> tokens. That means whoever has them, can use them. You still need to
> keep them safe. The main advantage of a token over passing your
> username and password around is that you can "expire" a token. By
> default, JWT tokens created by the plugin above are good for seven
> days. In theory, you could expire them so that they can't be used.
> However, the plugin does not give an interface to do that. It does
> offer a hook which allows developers to write code to change the
> expiration date. Changing the date to a point in the past time() - 1
> would expire the token.
>
> The plugin exposes several new endpoints that allow developers to
> authenticate via a REST interface.

#### Authenticating

> As stated above, the first step in authenticating is passing in your
> user credentials. Depending on what you are doing, this may be your
> real user or a user you created just for the API. In most cases,
> unless you are allowing other users to authenticate and do things they
> are authorized to do via the WordPress REST API, it is recommended
> that you create a user just for the API. Give this user the minimum
> permissions you can to allow it to accomplish the tasks that you want.
> Use the WordPress password generator to give it a nice long and secure
> password.
>
> For example, in the companion volume to this book, "Extending the
> WordPress REST API," I show a plugin which creates REST API endpoints
> to allow me to manipulate posts by episode number. I create, update,
> and publish posts, as well as upload media via these endpoints.
>
> To facilitate this, I created a special user account, gave it a secure
> password, and gave it enough permissions to accomplish these tasks.
> This user is never used for anything else. Should I need to, I can
> change the password, and then update my software's config files
> without affecting any other user in the system.
>
> NEVER USE YOUR ADMIN CREDENTIALS FOR THE API! If for no other reason
> than the one discussed above, passing them around like this opens up a
> window of vulnerability. If your admin account is compromised, you
> have serious problems outside the scope of this book.

#### Installing and Configuring the JWT Plugin

> Installing this plugin will take a few minutes. You have to edit your
> wp-config.php and your web server's config file (or .htaccess). Still,
> it shouldn't take more than five minutes to get it up and running.
> Take note that the changes to your .htaccess or (better idea) your web
> server's config file will almost certainly be necessary. The easy way
> to get it working is to modify the .htaccess file. Once you get it
> working and can create tokens, it is highly recommended you move the
> changes out of .htaccess and into your web server's config file.

#### Verifying the Installation

> Below I have included a quick PHP script you can use to verify your
> JWT plugin is configured and working correctly.

1.  \<?php

2.  error_reporting(**E_ALL**);

3.  ini_set(\'display_errors\', 1);

> 4

5.  \$username = \'\';

6.  \$password = \'\';

7.  \$url = \'https://example.com/wp-json/jwt-auth/v1/token\';

> 8

9.  \$command = \'curl -s \'

10. . \'-H \"Content-type: application/json\" \'

11. . \'-H \"Accept: application/json\" \'

12. . \'-d \\\'{\"username\":\"\' . \$username .\'\",\"password\":\"\' .
    \$password. \'\"}\\\' \'

13. . \'-X POST \'

14. . \$url ;

15. exec(\$command, \$return, \$code);

16. \$token = json_decode(\$return\[0\], **true**)\[\'token\'\];

17. **echo** \"**\\n**Return Code: \" . \$code . \"**\\n**\";

18. **echo** \"Token : \" . \$token . \"**\\n**\";

19. **echo** \"**\\n**Done**\\n**\";

> Yes, that's ugly, but it should work on the majority of systems. It
> was written on Windows 10 using the WLS. It has been tested using
> macOS and Linux as well.

1.  Add your username.

2.  Add your password.

3.  Update the URL to point to your domain.

4.  Save and run the script.

> If you get a token and a return code of 0, then congratulations, your
> plugin is properly configured, and you can move forward. If, however,
> you get anything else, STOP. Everything else in this book and the
> companion volume depends on this plugin being properly configured and
> working.
>
> As you can see from our test script, we do still pass the username and
> password in. We only do this once, though. Our token is good for seven
> days. We can store the token somewhere and use it until the expiration
> date before we have to pass in our username and password again.
>
> The code above strips out the token from the payload because it is all
> we are interested in. There is more information returned; the full
> payload looks like this.

1.  {

2.  **\"token\"**:
    \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90ZXN0LmNhb\\
    3
    GV2YW5zLmNvbSIsImlhdCI6MTU1OTc1NjEwNSwibmJmIjoxNTU5NzU2MTA1LCJleHAiOjE1NjAzNjA5MDUsI\\

<!-- -->

4.  mRhdGEiOnsidXNlciI6eyJpZCI6IjEifX19.-yessY6DzjkS4fUJF9MTEkKNvZaj5BqmDUinvd6aIpo\",

5.  **\"user_email\"**: \"apiuser@example.com\",

6.  **\"user_nicename\"**: \"apiuser\",

7.  **\"user_display_name\"**: \"API User\"

8.  }

> One piece of information that is missing from the response payload
> above is the user_id. Thankfully, the plugin offers developers five
> hooks that can be registered, one of them being
> jwt_auth_token_before_dispatch. Hooking into this allows developers to
> modify the response payload before it is dispatched to the user.
>
> Now that we have the token, all of our requests to the WordPress REST
> API can include it in a header.

1 Authorization: Bearer TOKEN

> As with all HTTP headers, spacing is important.
>
> With that header, all of your requests will contain authorization
> credentials. It is safe to pass this header into endpoints that do not
> require authorization like the ones we learned about in the previous
> chapters. The WordPress API will ignore it if not needed.
>
> The plugin also gives us an endpoint we can use to verify a token
> before using it, /jwt-auth/v1/token/validate. We can access this
> endpoint with POST and no body but with the Authorization: Bearer
> header.
>
> If the token is valid, the following response payload will be
> returned.

1.  {

2.  **\"code\"**: \"jwt_auth_valid_token\",

3.  **\"data\"**: {

4.  **\"status\"**: 200

5.  }

6.  }

> An invalid token will return the following response payload.

1.  {

2.  **\"code\"**: \"jwt_auth_invalid_token\",

3.  **\"message\"**: \"Syntax error, malformed JSON\",

4.  **\"data\"**: {

5.  **\"status\"**: 403

6.  }

7.  }

### Using the Token

> Now that we are authorized, let's see a quick example of what we can
> do with it. Before you can do this, you need to make sure you have at
> least one post in your WordPress test installation in draft status.
> The easiest way to do this is to create a new post and save it, but do
> not publish it.
>
> Building on the code we used above, we can test to make sure JWT was
> set up and working properly.
>
> We need to modify it a little and we can use it to actually fetch
> data.

1.  \<?php

2.  error_reporting(**E_ALL**);

3.  ini_set(\'display_errors\', 1);

> 4

5.  \$username = \'\';

6.  \$password = \'\';

7.  \$baseurl = \'https://example.com/wp-json\';

8.  \$token = \'\';

> 9

10 \$token = getToken(\$username, \$password, \$baseurl);

11

12. \$command = \'curl -s \'

13. . \'-H \"Authorization: Bearer \"\' . \$token . \' \'

14. . \'-H \"Content-type: application/json\" \'

15. . \'-H \"Accept: application/json\" \'

16. . \$baseurl . \'/wp/v2/posts?status=draft\';

17. exec(\$command, \$return);

18

19. **if** ( is_array(\$return) **and** ! **empty**(\$return)) {

20. print_r(json_decode(\$return\[0\]));

21. }

22

23 **echo** \"**\\n**Done**\\n**\";

24

25. **function** getToken(

26. string \$username,

27. string \$password,

28. string \$baseurl

29. ) : string {

30. \$command = \'curl -s \'

31. . \'-H \"Content-type: application/json\" \'

32. . \'-H \"Accept: application/json\" \'

33. . \'-d \\\'{\"username\":\"\' . \$username .

34. \'\",\"password\":\"\' . \$password. \'\"}\\\' \'

35. . \'-X POST \'

36. . \$baseurl . \'/jwt-auth/v1/token\';

37. exec(\$command, \$return);

38

39 \$payload = json_decode(\$return\[0\], **true**, JSON_THROW_ON_ERROR
);

40

41. **if** ( is_array(\$payload) && isset(\$payload\[\'code\'\]) ) {

42. **throw new**
    \\Exception(\$payload\[\'code\'\],\$payload\[\'data\'\]\[\'status\'\]);

43. }

44

45. **return** \$payload\[\'token\'\];

46. }

> This example is a little better than the original, but not much. It
> does allow us to test that everything is working and for the first
> time, we can access an endpoint that requires authentication.
>
> If you did not receive any output, it's time to do a little debugging.

-   If your login and password are incorrect, getToken() will throw an
    exception. That is the easy one to correct.

-   When we build the command to fetch all posts in the status of draft,
    the first switch we pass cURL is -s for silent. Change that to -v
    for verbose to see the conversation happening between the script and
    the server. Any line that starts with \> is a line the script sent
    to the server. Any line that starts with \< is a line the server
    sent back to the script. Look for the line that starts like this:

> 1 \< HTTP/1.1
>
> That will tell you the status the server sent back to your script. If
> it is anything but 200, figure out why.
>
> If it works correctly, you should see a dump of the first post that is
> in draft status.

### Token Management

> Now that you have your token, what should you do with it? Honestly,
> that depends on your application. Some applications will access the
> REST API so infrequently that storing the token makes no sense. Tokens
> only live for seven days. If your application is only used once a
> week, it is not worth the effort to attempt to store it.
>
> If on the other hand, your application is used frequently, yes, store
> it locally and only renew it when it fails. JWT tokens can be stored
> in cookies in browsers or using local storage. If your application is
> a CLI script, you can write them to your data store or to the file
> system.
>
> In theory, JWT tokens can be revoked. However, with the plugin we are
> using, there currently is no easy way to do that. The only thing you
> can do is change the password on the account, but that won't
> invalidate existing tokens, it will just prevent new ones from being
> issued.
>
> JWT tokens are not as sensitive as login credentials, but they do give
> access to your system. JWT tokens should always be passed through a
> secure (HTTPS) connection. They should never be a parameter of the
> URL, but always passed as a header.

### Summary

> Congratulations, you can now authenticate with the WordPress REST API.
> Honestly, getting this right is the hardest part of using the
> WordPress REST API. You have made it over the hump. Now let's look at
> some of the cooler things we can do with our newfound power.
>
> **Modifying Data Using the REST API**
>
> Welcome, you are through the looking glass now. Anyone with curl can
> do the basics with the WordPress REST API; you have moved beyond that.
> You can now authenticate with your WordPress installation and now have
> access to everything you can do via the web interface. Let's write
> some code.
>
> In this chapter, we will cover the following topics.

-   Creating our sample application

-   Manipulating WordPress

-   User management

### Creating Our Sample Application

> In this section, we are going to build a simple command line
> application that will:

-   Authenticate with a WordPress installation

-   Upload a picture

-   Create a post

-   Add the picture to the post

> From this point on the book, we will not give complete working code
> listings. When discussing code, we will examine snippets. You can get
> the source code for the sample application at [Simple WordPress API
> Demo](https://gitlab.com/calevans/simple-wordpress-api-demo). It is
> highly recommended you fork this repository and then clone your fork
> locally. This will allow you the maximum freedom and give you the
> ability to also submit PRs back to the project.

#### Steps to Get the Code Working

> First, the requirements:

1.  This repository requires PHP 7.3+.

2.  This project requires Composer be installed and accessible.

> You need to make sure both of those requirements are met before
> progressing. Once they are met, you can proceed to follow these steps.

1.  Fork the repository into your own copy.

2.  Clone your copy of the repository to your local machine.

3.  In the root of the project, execute the following:

> \$ composer install

4.  Rename config/config.sample to config/config.php.

5.  Open config.php in an editor and enter in the needed values.

    -   username

    -   password

    -   the root URL for the REST API on your test WordPress
        installation, e.g., https://example.com/wp-json.

6.  Save config.php.

7.  Change directories to the app directory.

8.  Execute the following:

1 \$ ./console validate

> If everything is set up properly and you have entered the credentials
> properly, this command will fetch a token and display it. If anything
> is wrong, it will throw an error, and you will need to debug.
>
> Once it works, you can now move forward in the book.

### Manipulating WordPress

> If you understood the concepts in chapters two, three, and four, then
> the sample code will not be much of a stretch. We have moved from
> using exec() to using [Guzzle](https://github.com/guzzle/guzzle) to
> make the calls, but other than that, it should look familiar. If this
> is your first time using Guzzle, the format may be confusing, but you
> quickly get used to it. It is the most popular PHP HTTP client library
> and a great tool in any developer's toolbox.
>
> The code we are executing is in
> app/WPREST/Command/MakePostCommand.php. This is a [Symfony Console
> Command](https://symfony.com/doc/current/components/console.html). The
> SCC is another great tool you need to know if you build a lot of
> command line applications in PHP.

#### Creating a Post

> I'm going to skip all the set up and Symfony specific stuff and leave
> that for you to investigate later if you like. The heart of the code
> is in the execute() method.
>
> This command reads a text file data/post.txt, which is just a
> KEY=VALUE formatted file, and uses the content for the post we are
> about to create.
>
> \$response = \$client-\>request(

2.  \'POST\',

3.  \$this-\>getApplication()-\>config\[\'baseurl\'\] .
    \'/wp/v2/posts\',

4.  \[\'json\' =\> \$payload,

5.  \'headers\' =\> \[

6.  \'Authorization\' =\> \'Bearer \' . \$this-\>token\[\'token\'\],

7.  \'Accept\' =\> \'application/json\',

8.  \'Content-type\' =\> \'application/json\',

9.  \],

10. \'debug\' =\> \$this-\>debug

11. \]

12. );

13. \$post = json_decode(\$response-\>getBody()-\>getContents());

> This is the command which creates the post. If you look in the
> post.txt file, you will notice we create it in draft mode.
>
> \$payload is the array created from the text file. It contains the
> bare minimum fields necessary to create a post. Since we used the
> array key json, Guzzle will JSON encode the array for us and send it
> as the body of the POST.
>
> The second command takes what comes back from the server and JSON
> decodes it and stores it in the variable \$post. We need that in a
> minute when we update the post.
>
> Notice the headers we set. We tell the server what content we are
> sending (Content-type), what content we expect back (Accept), and we
> hand it our authentication token in the Authorization: Bearer header.
>
> That is all it takes to create a post using the WordPress REST API. In
> a previous chapter, we listed the parameters the posts endpoint will
> take and you can add any of those to the post.txt file to add them to
> the post.

#### Uploading an Image

> Now that we have a draft post, we need a picture to go with it. This
> requires us to POST to the media endpoint.
>
> \$rawBaseName = \'image.jpg\';

2.  \$file = fopen(

3.  \$this-\>getApplication()-\>config\[\'basepath\'\] . \'data/\' .
    \$rawBaseName ,

4.  \'r\'

5.  );

> 6

7.  \$response = \$client-\>request(

8.  \'POST\',

9.  \$this-\>getApplication()-\>config\[\'baseurl\'\] .
    \'/wp/v2/media\',

10. \[

11. \'body\' =\> \$file,

12. \'debug\' =\> \$this-\>debug,

13. \'headers\' =\> \[

14. \'Accept\' =\> \'application/json\',

15. \'Cache-Control\' =\> \'no-cache\',

16. \'Content-type\' =\> \'image/jpeg\',

17. \'Content-Disposition\' =\> \'form-data; filename=\"\' .
    \$rawBaseName . \'\"\',

18. \'Authorization\' =\> \'Bearer \' . \$this-\>token\[\'token\'\]

19. \]

20. \]

21. );

22. \$picture = json_decode(\$response-\>getBody()-\>getContents());

> This example is only slightly more complex. Guzzle allows us to hand
> it a stream for the file; it will read it and send it to the server.
> The first thing we do is fopen() the image file. No need to read it or
> do anything else, just open it for reading.
>
> Then, very similar to the command we used to make the post, we now
> POST to the /wp/v2/media endpoint. Instead of json, here we use body.
> Guzzle will not attempt to JSON decode this since we use body. It will
> still send the contents as the body of the POST.
>
> In the headers section, we add a new one Content-Disposition. This is
> so the server knows how to handle the file we are sending in. Note
> that it ends with the name of the file. This is the base name of the
> file, no directory structure information, just filename and extension.
> The server will use this name when handing it off to WordPress for
> processing. While the file name does not have to be the same as it is
> on your client file system - you can put whatever you want for the
> filename - best practices dictate you keep it the same.
>
> The payload you get back is the record that was just created. Among
> other things, you get the ID for this image which we will use to
> attach the image to the post.
>
> It should be noted that when you upload an image, you can only upload
> the image, you cannot set any other attributes. If, for instance, you
> wanted to set a caption, you would need to make a second call, a
> PATCH, to the image you just received with the appropriate attributes
> set in the payload.

#### Updating the Post

> So far, we have been creating new things using the POST verb. Now we
> need to update an entity. We want to set the featured_image of the
> post and change the status. For this, we will use the PATCH verb. In
> strict REST APIs, PATCH is used if you want to send a partial update
> of an entity, like we are doing here. If we want to send the entire
> entity over, we would use PUT. WordPress treats PUT and PATCH
> interchangeably so you do not need to worry about which one you use.

1.  \$payload = \[

2.  \'featured_media\' =\> \$picture-\>id,

3.  \'status\' =\> \'publish\'

4.  \];

> 5

6.  \$response = \$client-\>request(

7.  \'PATCH\',

8.  \$post-\>\_links-\>self\[0\]-\>href,

9.  \[\'json\' =\> \$payload,

10. \'headers\' =\> \[

11. \'Authorization\' =\> \'Bearer \' . \$this-\>token\[\'token\'\],

12. \'Accept\' =\> \'application/json\',

13. \'Content-type\' =\> \'application/json\',

14. \],

15. \'debug\' =\> \$this-\>debug

16. \]

17. );

> As you can see, again, it is very similar with the exception that our
> \$payload is only two keys.
>
> You have probably noticed the endpoint we are hitting has changed
> also. When we created the post, it contained a collection called
> \_links that we discussed in chapter two. One of the links is self.
> This is the URL to the post entity we just created.
>
> Once this call is made, our post is now live. You should be able to
> point a browser to the URL of your test WordPress install and see it.

### User Management

> One of the other big things you can do with the WordPress REST API is
> manage user accounts, yours or others. First, remember, that
> authentication does not equal authorization. Just because you are
> logged in (authentication) does not mean you have permission to edit
> other user accounts (authorization). For this reason, we are going to
> stick with updating our own account. The principals are the same if
> you are editing other's accounts.
>
> Our sample code is located in UserManagementCommand.php. It is a very
> simple script that will get our information. We will modify the
> description, and then we will update the system. The first hurdle we
> need to overcome is how to get our information. Yes, we are logged in,
> but we don't have access to get_currentuser_id() because this is a
> REST API call.
>
> Thankfully, our JWT plugin provides us with just enough information to
> get the job done. If you examine the payload we store in
> \$this-\>token, you will notice it is an array, and one of the
> elements is user_nicename. This translates into the user's slug. Slug
> is a parameter we can use to find a user by. Also, we are specifying
> the context of edit. Context can have several different values, view,
> embed, and edit. Edit gives us all the information on the user, not
> just the public-facing information. For our simple example, it is not
> strictly necessary since the default context is view and view returns
> the description field.

1.  \$response = \$client-\>request(

2.  \'GET\',

3.  \$this-\>getApplication()-\>config\[\'baseurl\'\] .
    \'/wp/v2/users/?slug=\' . \$this-\>token\[\\ 4 \'user_nicename\'\] .
    \'&context=edit\',

<!-- -->

5.  \[

6.  \'headers\' =\> \[

7.  \'Authorization\' =\> \'Bearer \' . \$this-\>token\[\'token\'\],

8.  \'Accept\' =\> \'application/json\',

9.  \'Content-type\' =\> \'application/json\',

10. \],

11. \'debug\' =\> \$this-\>debug

12. \]

13. );

14. \$user =
    json_decode(\$response-\>getBody()-\>getContents(),**true**)\[0\];

> It should be noted here we are not exactly requesting a specific user,
> we are requesting a collection of users filtered by slug. Since there
> can only be one user per slug, you will only get a single user back,
> but it will be as part of a collection. If you notice, on the last
> line, the last thing we do is 'dereference' the \[0\] element of the
> array. This means that \$user will be just the user, not the
> collection.

1.  \$counter = (int)\$user\[\'description\'\];

2.  \$user\[\'description\'\] = (string)(++\$counter); *// It HAS to be
    a string*

> We now have \$user\[\'counter\'\] incremented and ready to send back
> to the REST API.

1.  **try** {

2.  \$client-\>request(

3.  \'PATCH\',

4.  \$user\[\'\_links\'\]\[\'self\'\]\[0\]\[\'href\'\],

5.  \[

6.  \'json\' =\> \[\'description\' =\> \$user\[\'description\'\]\],

7.  \'headers\' =\> \[

8.  \'Authorization\' =\> \'Bearer \' . \$this-\>token\[\'token\'\],

9.  \'Accept\' =\> \'application/json\',

10. \'Content-type\' =\> \'application/json\',

11. \],

12. \'debug\' =\> \$this-\>debug

13. \]

14. );

15. } **catch** (\\GuzzleHttp\\Exception\\GuzzleException \$e) {

16. \$response =
    json_decode(\$e-\>getResponse()-\>getBody()-\>getContents(),**true**);
    17 \$output-\>writeln(\"An Error has occurred!**\\n**\" .
    print_r(\$response,**true**));

18 }

> In our example code, we are storing a counter of the number of times
> we have updated this user in the description field. This is a very
> simple example. There is no pressing need to build out a payload array
> separately; we can start to streamline our code. As a side note, there
> is also no pressing need to cram as many commands together as you can.
> The example above could be expressed as a single command joining the
> call to the API, the fetching of the body contents, and the
> json_decoding. While it is possible, it can hamper the readability of
> the code for some developers. Be cautious in aggregating commands
> together. In this case, we simply hard-coded the array on the json
> key.
>
> Notice that again, we are using the self URL from the \_links
> collection. Remember, we did not request a specific user but requested
> a collection filtered by slug. We cannot update the user the same way.
> To issue a PATCH, we have to have the URI of the entity we want to
> update. This is true for any entity on any REST API.
>
> Also, note that this time the \$user variable is expressed as an array
> and not an object. All code accessing the element of \$user must use
> array notation.
>
> This PATCH is wrapped in a try/catch statement in case we run into an
> exception. An example would be if \$user\[\'description\] was an
> integer, not a string. (We are casting it as a string above, but if
> you remove the (string), the WordPress REST API will return an error
> 400.) Guzzle has a horrible "feature;" if a message from the server is
> too long, it will truncate it. This means you do not see the entire
> message and in most cases, you will not be able to debug the problem.
> If the above catch had only caught \\Exception, then that is what you
> would have seen, the truncated message.
>
> The code above shows the proper way to handle an exception thrown by
> Guzzle. Developers should catch
> \\GuzzleHttp\\Exception\\GuzzleException as this is thrown first.
> Also, it has access to the Response object. The Response object's body
> still contains the complete error message at this point.
>
> You could act on it if you like. In the code above, we are just
> outputting it so you can see it.
>
> Use the following command to run our new code.

1 \$ ./console user

### Summary

> Hopefully, by now, you are beginning to see patterns in how the API is
> accessed and updated.
>
> Hopefully, these patterns make sense to you. Once you understand how
> the endpoints on the WordPress REST API are called, the rest is just
> understanding the options and schema needed to call them. In the next
> chapter, we are going to briefly examine two sample applications that
> put the API to work. Hopefully, by seeing how the API can be used in
> various scenarios, you can begin to envision how to use it in your own
> work.
>
> As an exercise to improve your skills with the API, you are encouraged
> to add functionality to your copy of the sample application to allow
> you to update the image we uploaded with an "alt text" attribute. If
> you have been paying attention, then this is not a difficult task. It
> will, however, force you to think through the process and modify the
> code.
>
> **Controlling WordPress from Another Application**
>
> We have spent this entire book discussing the details of how to use
> the WordPress API. We've even created a sample application which will
> post to a WordPress install. Let's now bring everything we have
> learned together and create a simple application that applies all the
> principals we have discussed.

### Setting up the WordPress Frontend for the application

> The sample application can be found at ["Microblogging with the
> WordPress REST
> API"](https://gitlab.com/calevans/microblogging-with-the-wordpress-rest-api).
>
> As the title suggests, the code uses WordPress as the front end for a
> personal micro-blogging platform. WordPress serves as the data store
> and the public-facing front end, but we use the CLI application to
> post our statuses.
>
> To experiment with this application, you will need a fully functioning
> WordPress installation. Additionally, you will need the JWT plugin
> installed and configured as described in the installation instructions
> for the plugin.
>
> You will want to set up an API user account that is set to the role of
> "editor." This gives the role permission to post as other users. If
> you don't want your posts coming from your admin account, you can also
> set up a personal user. That account can be set to "author."
>
> Finally, you want to select a theme that works for microblogging. For
> the [sample microblogging site](https://mb.wp-rest-api.com/), I chose
> [P2 Breathe](https://wordpress.com/theme/p2-breathe). Even though it
> got me 90 percent there, I still had to modify a few things to make it
> look the way I wanted. You can modify it to suit your tastes.

### Setting Up the CLI Application

> To set up the sample application, follow the instructions in the
> README.md. You will know you have it set up correctly when you can
> execute the validate command to validate the connection and
> credentials.

1 \$ ./console.sh validate

#### Using the CLI

> The application is straightforward. There are four commands available.

-   validate

-   post

-   entities • delete

> **validate**
>
> We have already covered using the validate command, however, for
> completeness, we will describe it here. Validate ensures your URL is
> correct and that the login credentials work. If all goes well, it will
> emit a token. There is no need to copy this token down or save it; it
> is just there to prove the application is working. **post**
>
> The post command allows us to create a new microblog post. The
> simplest form of this command is as follows:

1.  \$ ./console.sh post \"This is a test of the MicroBlogging
    application used in \'Usin\\

2.  g the WordPress REST API\' by Cal Evans\"

> Additionally, you can tag the post using the -t option.

1 \$ ./console.sh post -t example \"Another sample post\"

> The -t option can take a comma-delimited list of tags. If a given tag
> does not exist, then it is created and then applied to the post. If
> any of the tags contain spaces, wrap the entire list in quotes.

1 \$ ./console.sh post -t \"example number two, and three\" \"Another
sample post\"

> Even though we call this a microblogging application, our backend data
> store (WordPress) does not limit our character length. It is
> technically possible - although highly discouraged - to write longform
> posts using this command (up to the character limit for a POST on the
> web server you are using to host your WordPress installation). It
> seems that Apache has a practical limit fo 4GB. **entities**
>
> The entities command will list entities from the data store in a
> nicely formatted table. The basic format is to list the content of the
> post and then the tags associated with it.

1 \$ ./console.sh entities

> If you pass in a single -v to put the command in VERBOSE mode, the
> post ID will be listed as well. This is handy for the next command,
> delete.

1 \$ ./console.sh entities -v

> **delete**
>
> Our sample application allows you to delete an existing post given the
> post ID.

1 \$ ./console.sh delete -p 12

> A \# Debugging
>
> A If you need to debug the conversation between the app and the
> server, or if you are just curious, use -vvv. This puts the
> application into debug mode. Everything will continue to operate
> normally, but the application will emit the complete conversation
> between the app and the server. Debug mode works for all commands.
>
> We now have a fully functional microblogging application that uses the
> WordPress REST API for storage and retrieval. It would be possible to
> build a frontend for this application that also uses the API and never
> once uses the standard WordPress frontend.

### Dissecting the Application

> Now that we have described how to use the application, let's dig in
> and look at some of the code. This application is built using current
> best practices in object-oriented design and PHP. Much of what we will
> discuss below has little to do with the WordPress REST API and more to
> do with application design. It is safe to ignore this section if you
> are only interested in the WordPress REST API itself.

#### Thin Controllers

> In our sample application, the Symfony command serves the purpose of a
> controller. Like any good MVC application, we want to make sure the
> controller is as thin as possible. The logic belongs to the model.
>
> To that end, let's examine PostCommand.php, the controller behind
> posting statuses. The heart of any Symfony command is the execute()
> method.

1.  **public function** execute(InputInterface \$input, OutputInterface
    \$output)

2.  {

3.  \$output-\>writeln(\'MicroBlogging via the WordPress API\',
    OutputInterface::VERBOSI\\

4.  TY_NORMAL);

5.  \$this-\>debug = \$output-\>isDebug();

6.  \$this-\>getToken(\$this-\>debug);

> 7

8.  \$message = **new** Message(

9.  \$this-\>token\[\'token\'\],

10. \$this-\>getApplication()-\>config,

11. 0,

12. \$this-\>debug

13. );

14

15. \$message-\>title = date( \'Y-m-d h:i:s\');

16. \$message-\>content = \$input-\>getArgument(\'post\');

17. \$message-\>status = \'publish\';

18. \$message-\>author =
    \$this-\>getApplication()-\>config\[\'author_id\'\];

19. \$message-\>addTags(\$input-\>getOption(\'tags\'));

20. \$message-\>save();

21

22 \$output-\>writeln(\'Post ID: \' . \$message-\>id ,
OutputInterface::VERBOSITY_NORMAL);

23

24. \$output-\>writeln(\'Done\' , OutputInterface::VERBOSITY_NORMAL);

25. }

> The first thing to take note of is that we make a call to
> \$this-\>getToken(), but that method does not exist. getToken() is
> used in a variety of places in the application (and in others I have
> written) so to keep from copying and pasting it everywhere, getToken()
> is encapsulated in a trait. In the case of this application, it could
> have been included in the BaseCommand class since we have one. It
> isn't because it was written before the BaseCommand. It is neither a
> bad idea to have this method in a trait versus the BaseCommand class,
> nor is it a good idea. Both are valid paradigms for designing
> object-oriented systems. In most cases, I test to use traits versus
> hierarchy, but that is a personal preference.
>
> Most of the code shown above is set up and teardown code. The central
> thing to see is creating the new message object; this is where the
> magic happens. We create the message object, we set the properties,
> and then we call save() to commit it to the data store. If all goes
> well, then the message is posted, and the message class is updated
> with the ID of the post.
>
> If, for some reason, save() failed, an exception would be thrown that
> is not caught upstream. It could be caught here if you wanted to
> handle it more gracefully than the default of displaying it onscreen.

All of the execute() methods are similar in nature, so this is the only
one we will list. The real magic happens in the objects.

### Fat Models

> In good object-oriented design, the bulk of the work - the business
> logic - is done by the models. We call this type of design fat model
> design. Models, and any objects that help the models, should contain
> all the logic to be executed. The controller's job is basically
> "traffic cop."
>
> In PHP, the prevailing design theory is called "composition over
> inheritance." This means building objects by piecing together smaller
> pieces is preferred over an object inheritance tree. Part of this bias
> is a holdover from when inheritance was an expensive CPU process.
> These days with opcode caching, inheritance is not nearly as expensive
> as it used to be. Still, "composition over inheritance" is a valid way
> to build systems. It encourages breaking tasks into small pieces like
> traits and assembling objects from them.
>
> In our microblogging application, we do both. We have already
> discussed that getToken() is a trait. When building out the entity
> objects, patterns began to emerge. Each entity had a lot of similar
>
> "boilerplate" code. I have abstracted all of this code and placed it
> in an abstract parent class called BaseModel. Since most of the logic
> is in BaseModel, we are going to look at some of it as it applies to
> using the WordPress REST API.

#### read, save, and delete

> The bulk of the work done in BaseModel is done in these three methods.
> They compose the C, UUU, and D of C.R.U.D. Most of our controllers
> only hit the WordPress REST API a single time; PostCommand is the
> exception. Because post has to resolve tags passed in, it can hit the
> API multiple times with each request. For this reason, and to make
> unit testing our entity models easier, we pass the client into the
> model on \_\_construct(). Each model has a copy of the same client and
> re-uses it as needed.
>
> All of our methods also require the authorization token to perform
> their actions. That is one of the things we left in the command. Since
> the creation of an authorization token has nothing to do specifically
> with manipulating a status, it does not belong in our entity models.
> We pass it in as a parameter on construction.

#### list

> The other main functionality in the base model is the list function.
> list is different because while it returns an array of entities, it
> does not operate on a single entity like the rest of the methods in
> the entity class. Therefore, we make list part of the entity base
> model, but we make it static. list is not meant to be called on an
> instantiated object. Since it is a static method, we don't have access
> to \$this. We have to pass in everything needed to generate a list of
> entities.
>
> The one thing we do know is the class's entity constant. Each entity
> defines this constant, and it is used to build the URL for the
> endpoints we access. Since it is a class constant, it can be accessed
> in both static methods and instantiated objects.

#### Everything Else

> Everything else in BaseModel are helper methods. Sometimes they exist
> because we were doing the same thing in two or more places. Other
> times, they are there to simplify the reading of other methods. An
> example of this second type is in Message::resolveTags(). This code is
> only called one time, in Message::buildPayload(). Logically, the code
> could be located there. However, buildPayload() is much easier to read
> because we moved this processing into its own method.

### Summary

> I have specifically left code listings out of most of this chapter.
> All of the code used in this book is publicly available. You are
> encouraged to fork and clone the repository and experiment with it.
> You are also encouraged to submit pull requests for any changes you
> make that you feel make the code better.
>
> This chapter has been less about the WordPress REST API and more about
> how the code built to talk to it was constructed. As I hope you have
> begun to see, the code necessary to manipulate WordPress via the API
> is not difficult and in many cases, easier than working directly in a
> WordPress plugin structure.
>
> **Conclusion**

### Making WordPress Work Harder

> We set out to understand the basics of the WordPress REST API, and I
> hope we have accomplished this. The WordPress REST API is not just a
> toy to play with. It's a serious tool that can be used to make
> WordPress work harder for you. Not all applications are frontend
> intensive. WordPress is now a complete application platform that can
> be used as a starting point for a wide variety of categories of
> applications.

### Additional Reading

> In an effort of brevity, I have left out a lot of details. Details
> that are much better served by the [WordPress REST
> Handbook](https://developer.wordpress.org/rest-api/) because they will
> undoubtedly change over time. If you are doing any serious work with
> the WordPress REST API, bookmark this page and pay special attention
> to the
> [Reference](https://developer.wordpress.org/rest-api/reference/)
> section. This is where every entity that can be managed by the
> WordPress REST API is listed, along with the schema for each. Under
> each entity, a complete list of arguments are given.

### Thank you

> Thank you for reading my book. I do hope it was helpful to you. If you
> have questions about the materials or comments, I encourage you to
> drop me an email at cal@calevans.com. I do my best to respond to every
> email.
>
> If you find issues with any of the sample code, I urge you to fork the
> repo and submit a pull request.
>
> Finally, when you build something cool with the WordPress REST API,
> please drop me an email at cal@calevans.com and tell me about it. I
> love to celebrate the successes of others!
>
> **Odds and Ends**

### jv.sh

> There are times when you just want to see formatted JavaScript output
> instead of the JavaScript blob. For these cases, I write a simple PHP
> shell script,
> [jv.sh](https://gist.github.com/calevans/a3977ce73855b90f06c03689bdab7fba).
> It is for use on Linux based machines and assumes you have PHP
> installed. Yes, there are other options to do this; I didn't feel it
> necessary to install something else when a few lines of PHP would
> suffice.
>
> To use this, paste this code into a file named jv.sh. Save that file
> somewhere in your path. Then you can pipe commands into this, and it
> will emit formatted JSON.

1 \$curl http://example.com/wp-json \| jv.sh
