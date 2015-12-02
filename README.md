MATA CMS Form
==========================================

![MATA CMS Module](https://s3-eu-west-1.amazonaws.com/qi-interactive/assets/mata-cms/gear-mata-logo%402x.png)


Form module manages forms for MATA CMS.


Installation
------------

- Add the module using composer:

```json
"matacms/matacms-form": "~1.0.0"
```

-  Run migrations
```
php yii migrate/up --migrationPath=@vendor/matacms/matacms-form/migrations
```


Changelog
---------

## 1.0.2.1-alpha, December 02, 2015

- Fixed actionDeleteSubmission in SubmissionController

## 1.0.2-alpha, August 21, 2015

- Added infinite scroll for list view
- Updated markup for entry detail view.

## 1.0.1-alpha, August 04, 2015

- Updated markup for entry detail view.

## 1.0.0-alpha, May 18, 2015

- Initial release.
