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

## Field Type: Browser User Agent

TODO

## Field Type: Email

TODO

## Field Type: String

TODO

## Field Type: Text

TODO

## Field Type: URL

TODO


## Installing

Usual installation for a Symfony app.

Make sure you run ````php app/console FeedbackField:updateBrowseCap```` during installation and before use. This updates information on browsers needed by the Browser User Agent field type.

## Cron jobs

The following commands should be run regularly.

### Process

    php app/console FeedbackField:process

If you have any exports defined, this command will process any new feedback items and actually export them.

### UpdateBrowseCap

    php app/console FeedbackField:updateBrowseCap

If you use the Browser User Agent field type, we try to extract extra info from the User Agent string. To do this, we need up to date browsecap data. This command updates and caches that data.

If you don't run this command regularly but use this field type, the software will try to download the data when a piece of feedback is received. This will take a lot of time and memory use!
