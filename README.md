# FeedbackField

## What is it?

This is a Symfony app that lets you collect feedback from a form on your website.

The data is available to view through an admin interface. It can also be downloaded and certain feedbacks can be automatically exported to other systems.

## Projects

This app can host multiple projects. Each project has it's own set of data and configuration options.

## Fields

Each project has a set of configurable fields.

Each field has a different type.

## Receiving feedback

An API end point is set up to receive feedback.

  *  /api1/project/PROJECT-ID/submit  - return JSON
  *  /api1/project/PROJECT-ID/submit.json
  *  /api1/project/PROJECT-ID/submit.jsonp - pass "callback" GET parameter to specify function name

Pass the fields as GET or POST parameters.

## Field Types as Bundles

Each Field Type is a separate bundle.

This lets you add your own field types by adding a bundle.

Some field types can be set to Auto Fill. In this case, data will try to be filled in automatically.

## Field Type: Browser User Agent

This should be used with Auto Fill. The user agent string of the browser making the request is logged. It is also broken down into more details.
## Field Type: Email

Stores an email address.

## Field Type: String

Stores a string (Single line);

## Field Type: Text

Stores a string (Mulit Line);

## Field Type: URL

Stores a URL.  It is also broken down into more details.

## Installing

Usual installation for a Symfony app.

Make sure you run ````php app/console FeedbackField:updateBrowseCap```` during installation. This updates information on browsers needed by the Browser User Agent field type.

## Cron jobs

The following commands should be run regularly.

### Process

    php app/console FeedbackField:process

If you have any exports defined, this command will process any new feedback items and actually export them.

### UpdateBrowseCap

    php app/console FeedbackField:updateBrowseCap

If you use the Browser User Agent field type, we try to extract extra info from the User Agent string. To do this, we need up to date browsecap data. This command updates and caches that data.

If you don't run this command regularly but use this field type, the software will try to download the data when a piece of feedback is received. This will take a lot of time and memory use!


## How to give admin access to a user

Get the user to register in the browser at /register

In the command line, run

    php app/console fos:user:promote

Enter the new users name and for a role enter: ROLE_ADMIN

The user will have to log out and in again to see the difference.
