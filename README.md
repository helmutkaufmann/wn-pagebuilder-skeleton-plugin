# Mercator Page Builder
This is a WinterCMS plugin that allows you to create custom page builders for Winter's Static Pages. It has been tested with WinterCMS 1.1.3.

## Installation - Composer
```
composer require mercator/wn-pagebuilder-skeleton-plugin
php artisan winter:up
```
## Configuration
### Page Builder Definition
The plugin will allow you to define indvidual elements that the user can configure in the backend. 
On the frontend, the elements will then be rendered as defined in user-defined templates. 

The available elements are defined in a single YAML file, wich is locates in *components/partials/_pagebuilder.yaml*.
As a starting point, the YAML could look as follows:
```
richtext:
  name: Rich Text
  description: Rich Text Field
  icon: icon-paragraph
  fields:
    label:
      label: Rich Text
      type: section
      comment: Rich text field.
      span: left
    header:
      label: Haeder text
      type: text
      span: full
      placeholder: 'The H1 header'
    text:
      label: Text
      type: richeditor
      size: giant
      placeholder: 'Content including tables, images, ...'

markdown:
  name: Markdown Text
  description: Markdown text field
  icon: icon-paragraph
  fields:
    label:
      label: Markdown Text
      type: section
      comment: Markdown text field.
      span: left
    text:
      label: Text
      type: markdown
      placeholder: 'Content formatted in Markdown language including tables, images, ...'
```
This would provide for two elements, **richtext** and **markdown**. You can extend/replace the YAML as required.


### Page Builder Element Rendering
For each element defined in the above YAML, create a partial in **components/partials** that renders it. 
For example, for **richtext**, create a **richtext.htm**, which could look as follows
```
<H1>{{ element.header }}</H1>
{{ element.text | raw }}
```
You can reference the individual attributes defined in the YAML as per the above, e.g., "element.header" holds the H1.

### Page Builder Interaction
There is one more file that needs attention: **components/pagebuilder/default.htm**:
```
{% for i in pagebuilder %}
   {% set thisPartial = ("@" ~ i._group) %}
   {% partial thisPartial element=i %}					  
{% endfor %}
```
This file renders the individual Page Builder Elements that have been defined - typically one after the other.  
You will need to adapt this, e.g., enhance it with CSS and alike in line with the frontend library you are using.

### Layout File
Create a layout file, the below is the most simple example. It will basically call the code you have just seen above.
```
description = "Page Builder"
[viewBag]
[PageBuilder]
==
{% component 'PageBuilder' %}
```                           

### Using it
Create a new Static Page. In the secondary tab wou should now see tab "Page Builder" and in there a button 
on the bottom reading "ADD PAGE BUILDER CPOMPONENT". Just press it - the rest should be clear.

### One more thing... Site-wide settings
If your plugin requires site-wide/plugin-wide settimgs, these can be defined in the backend. You just need to add respective field defintions to **models/settings/pagebuilder.yaml**.

## Next Steps
This is just a simple example of how this works. This Plugin is NOT production ready and the next version will 
over-write the YAML and the components that you have defined. Suggest not to auto update. The next version will 
cater for a more user-friendly version.
