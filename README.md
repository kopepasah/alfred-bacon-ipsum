#Alfred's Bacon Ipsum

This workflow will get some juicy ipsum from [Bacon Ipsum](http://baconipsum.com/). It requires [Alfred](http://alfredapp.com) version 2 or above.

[Workflows](https://github.com/jdfwarrior/Workflows) class is written by David Ferguson (many thanks).

###Installation
Download the latest release and install the workflow via Alfred.


###Usage
Type __bacon__ to initilze the cooking.

Add up to three ingredients, separated by spaces.

* Number of paragraphs/list items/words (e.g 6) _(optional)_
* HTML tag - __none__ (default), __ul__, __ol__, __p__, or any header element (__h1__, __h2__, __h3__, __h4__, __h5__, __h6__). _(optional)_
* content type - __all-meat__ (default) or __meat-and-filler__. _(optional)_

Press Enter to copy the contents to the clipboard.

NOTE: If no options are supplied, 5 paragraphs will be copied without any HTML tags.

Examples:

- __bacon 3 p__ - Generates 3 paragraphs wrapped with `<p>` tags.
- __bacon 10 ul__ - Generates 10 unordered list items.
- __bacon 5 h3__ - Generates 5 words wrapped in `<h1>` tags.



