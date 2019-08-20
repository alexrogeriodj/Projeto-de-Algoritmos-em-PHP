Developing Large Web Applications
readme.txt

Instructions for the Demos

Untar this package so that the top-level directory (lgwebapp) is located in
the document root of your web server (or create a symbolic link to it here).

Copy or link lgwebapp/common/lgwebapp.inc to lgwebapp.inc in your document
root. All demos look for this file in this location in order to configure a
few other paths. If you follow the directions above, you should not need to 
change any of the paths defined in lgwebapp.inc; however, this is the place
to do so if you need to.

To run the demos, go to:
http://<yourhost>/lgwebapp

Note:

You need to ensure that your web server is set up to run .html files through
the PHP interpreter. This follows the good practice of hiding .php extensions
as measure of security (albeit a slight measure).

The JavaScript files with versions of the form x.y.z are from the Yahoo! User
Interface library. They have been included here in their minified form. All
other JavaScript is from the book and is not minified to remain readable.

The file containing the json_parse method for working safely with JSON data
was downloaded from http://json.org/json_parse.js.

The examples directory contains the code directly from each of the numbered
examples in the book.
