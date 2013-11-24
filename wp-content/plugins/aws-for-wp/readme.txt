=== Amazon Web Services for WordPress ===
Tags: uploads, amazon, aws, s3, mirror, admin, media, cdn, cloudfront, security, google authenticator, 2-factor authentication, cloudmanager
Author URI: http://www.cloudsafe365.com
Author: Cloudsafe365
Contributors: cloudsafe365, henrikschack, joetan
Requires at least: 3.2
Tested up to: 3.5.1
Stable tag: 0.1
Version: 0.1
License: GPLv3

Copy media uploads to Amazon S3/CloudFront for storage and delivery. Add 2-factor authentication using Google Authenticator for extra security.

== Description ==

This plugin automatically copies any media added through WordPress' media uploader to [Amazon Simple Storage Service](http://aws.amazon.com/s3/) (S3). It then automatically replaces the URL to each media file with their respective S3 URL or, if you have configured [Amazon CloudFront](http://aws.amazon.com/cloudfront/), the respective CloudFront URL. Image thumbnails are also copied to S3 and delivered through S3/CloudFront.

Uploading files *directly* to your S3 account is not currently supported by this plugin. Also, if you're adding this plugin to a site that's been around for a while, your existing media files will not be copied or served from S3. Only newly uploaded files will be copied and served from S3.

You'll also find a new icon next to the "Add Media" button when editing a post. This allows you to easily browse and manage files in S3.

AWS for WP also provides an extra layer of security to your site against hackers/bots by adding 2-factor authentication through the use of Google Authenticator. 

You can also backup your Google Authenticator secret key to a free [Cloudmanager](http://www.cloudsafe365.com) account in case your mobile device is lost or stolen.

*This plugin extends two existing plugins:
[Amazon S3 for WordPress with CloudFront](http://wordpress.org/extend/plugins/tantan-s3-cloudfront/) and [Google Authenticator](http://wordpress.org/extend/plugins/google-authenticator/).*

== Installation ==

1. Use WordPress' built-in installer
2. Access the Amazon S3 option under AWS for WP > Amazon S3 and configure your Amazon details
3. Access the Google Authenticator option under AWS for WP > Google Authenticator and follow the instructions

== Screenshots ==

1. Plugin dashboard
2. Configure Amazon S3
3. Browse S3 bucket
4. Configure Google Authenticator
5. User profile with Google Authenticator 

