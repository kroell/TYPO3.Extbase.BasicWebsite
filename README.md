# TYPO3.Extbase.BasicWebsite (ot_website)

A TYPO3 website EXT inspired by [Oliver Thiele](http://www.oliver-thiele.de).  

Original Description by Oliver Thiele:  
```
A TYPO3 website in one extension with Bootstrap3.
You need a licence for the included Fancybox-Lightbox, if you use this JS!

All content elements will have an additional tab for the Bootstrap Grid CSS classes.
Additional Backend-Layouts are added with the new BackendLayoutDataProvider.
```


### Installation
All dependencies (Bootstrap, VHS ViewHelper, jQuery, Fancyox, etc.) will be installed by composer.  
```
# Clone Repository
cd typo3conf/ext/
git clone TYPO3.Extbase.BasicWebsite ot_website

# Install dependencies
composer update --dry-run
composer update
```
