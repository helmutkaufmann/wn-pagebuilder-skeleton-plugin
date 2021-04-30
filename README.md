# Mercator Page Builder
This is a WinterCM plugin that allows you to create custom page builders for Winter's Static Pages. It has been tested with WinterCMS 1.1.3.


## Installation
```
composer require mercator/wn-pagebuilder-plugin
```
## Configuration
### Page Builder Definition
The plugin will allow you to define indvidual elements that the user can configure in the backend. 
These are defined in a single YAML file, sich is locates in *components/partials/_pagebuilder.yaml*.
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
      placeholder: 'A H1 header'
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
This would provide for two elements, **richtext** and **markdown**. You can extend/replace this as required.


### Page Builder Element Rendering
Fior each element defined in the above YAML, you must create a partial in **components/partials** that renders it. 
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
This file defines renders the individual Page Builder Elements that have been defined. You will need to adapt this, 
e.g., enhance it with CSS and alike to meet the frontend library you are using.


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

## Next Steps
This is just a simple example of how this works. This Plugin is NOT production ready and the next version will 
over-write the YAML and the components that you have defined. Suggest not to auto update. The next version will 
cater for a more user-friendly version.
