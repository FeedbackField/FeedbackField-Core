# FeedbackField


## Installing

Usual installation for a Symfony app.

Make sure you run ````php app/console FeedbackField:updateBrowseCap```` during installation and before use.

## Cron jobs

The following commands should be run regularly.

### Process

    php app/console FeedbackField:process

If you have any exports defined, this command will process any new feedback items and actually export them.

### UpdateBrowseCap

    php app/console FeedbackField:updateBrowseCap

If you use the Browser User Agent field type, we try to extract extra info from the User Agent string. To do this, we need up to date browsecap data. This command updates and caches that data.

If you don't run this command regularly but use this field type, the software will try to download the data when a piece of feedback is received. This will take a lot of time and memory use!



