WS Formn Pro Documentation\
\
\
Javascript Events

WS Form fires a number of different events during the lifecycle of a
form. You can use these to run your own javascript when the event fires.

All WS Form events are passed the following parameters:

-   event -- Event object

-   form_object -- The form object (Form configuration).

-   form_id -- The form ID.

-   instance_id -- The instance ID of the form on the page. This is an
    integer that begins with 1. To learn more about instances, [click
    here](https://wsform.com/knowledgebase/the-anatomy-of-a-form/).

-   form_el -- The form element jQuery object

-   form_canvas_el -- The form canvas element jQuery object

When using the WS Form WooCommerce extension, form_el will refer to the
WooCommerce product form and form_canvas_el will refer to the form
injected by WS Form.

Example of using the WS Form JavaScript are:

\$(**document**).on(\'wsf-submit-before-ajax\', **function**(event,
form_object, form_id, instance_id, form_el, form_canvas_el) {

// Debug

**console**.log(\'Event type: \' + event.type + \' fired.\');

**console**.log(\'Form ID: \' + form_id);

**console**.log(\'Instance ID: \' + instance_id);

// Get FormData object from form element

**var** form_data = new FormData(form_el\[0\]);

});

... where wsf-submit-before-ajax is the event type. In this example,
the wsf-submit-before-ajax event fires immediately before we push the
form data to our server side API.

Another example showing how to handle a lock event on the form. The form
is locked when the form submit button is clicked to help prevent double
clicks.

\$(**document**).on(\'wsf-lock\', **function**(event, form_object,
form_id, instance_id) {

alert(\'Form ID \' + form_id + \' was locked!\');

});

Events

The JavaScript events fired by WS Form at a document level are
chronologically listed below:

  ---------------------------------------------------------------------------------------
  Name         Description                                       Trigger
  ------------ ------------------------------------------------- ------------------------
  Rendered     This fires when a form has finished rendering.    wsf-rendered

  Tab Clicked  This fires when a tab is clicked or is moved to   wsf-tab-clicked
               using conditional logic.                          

  Submit       This fires prior to the form being submitted      wsf-submit-before
  Before       (when submit button is clicked).                  

  Save Before  This fires prior to the form being saved (when    wsf-save-before
               save button is clicked).                          

  Validation   This fires prior to the form being validated.     wsf-validate-before
  Before                                                         

  Validation   This fires when form validation has finished.     wsf-validate-after
  After                                                          

  Validation   This fires when validation was successful.        wsf-validate-success
  Success                                                        

  Validation   This fires when validation failed.                wsf-validate-fail
  Fail                                                           

  Submit       This fires when the form data is about to be      wsf-submit
               processed for submission.                         

  Save         This fires when the form data is about to be      wsf-save
               processed for saving.                             

  Lock         This fires when the form is locked, just prior to wsf-lock
               the data being posted on a submit or save.        

  Submit Ajax  This fires just before the form data is submitted wsf-submit-before-ajax
  Before       to the WS Form server side API after the Submit   
               button is clicked.                                

  Save Ajax    This fires just before the form data is submitted wsf-save-before-ajax
  Before       to the WS Form server side API after the Save     
               button is clicked.                                

  Complete     This fires when the form submit or save is        wsf-complete
               completed.                                        

  Submit       This fires when the form submit is completed.     wsf-submit-complete
  Complete                                                       

  Save         This fires when the form save is completed.       wsf-save-complete
  Complete                                                       

  Success      This fires when the form submit or save is        wsf-success
               successful.                                       

  Submit       This fires when the form submit is successful.    wsf-submit-success
  Success                                                        

  Save Success This fires when the form save is successful.      wsf-save-success

  Error        This fires when the form submit or save           wsf-error
               encounters an error.                              

  Submit Error This fires when the form submit encounters an     wsf-submit-error
               error.                                            

  Save Error   This fires when the form save encounters an       wsf-save-error
               error.                                            

  Actions      This fires when the form actions start to run on  wsf-actions-start
  Start        the client side.                                  

  Actions      This fires when the form actions finish on the    wsf-actions-finish
  Finish       client side.                                      

  Unlock       This fires when the form is unlocked.             wsf-unlock

  Reset Before This fires when a form reset starts (when reset   wsf-reset-before
               button is clicked).                               

  Reset        This fires when a form reset completes.           wsf-reset-complete
  Complete                                                       

  Clear Before This fires when a form clear starts (when clear   wsf-clear-before
               button is clicked).                               

  Clear        This fires when a form clear completes.           wsf-clear-complete
  Complete                                                       
  ---------------------------------------------------------------------------------------

HTML Form Attributes

WS Form is a WordPress form plugin that supports features such as:

-   **Multiple forms** per page, including **multiple instances** of the
    same form.

-   [Conditional
    logic](https://wsform.com/knowledgebase/conditional-logic/)

-   [Repeatable
    sections](https://wsform.com/knowledgebase/repeatable-sections/)

-   [Calculated
    fields](https://wsform.com/knowledgebase/calculated-fields/)

...and more!

WS Form automatically assigns IDs to forms and fields to ensure all IDs
are unique and to ensure that all functionality provided by the plugin
works as intended.

Additionally, WS Form automatically adds custom data attributes and
classes to all fields for the purpose of referencing different form
elements with CSS and JavaScript.

This article explains how instances work and how form and field
attributes are configured in WS Form.

Need help styling forms? Check out our [Styling Forms with
CSS](https://wsform.com/knowledgebase/styling-forms-with-css/) article.

If you require additional assistance understanding form attributes,
please see our [Custom Project
Development](https://wsform.com/knowledgebase/custom-project-development/) article.

Contents

-   [Instances](https://wsform.com/knowledgebase/html-form-attributes/#instances)

-   [Form
    Attributes](https://wsform.com/knowledgebase/html-form-attributes/#form-attributes)

-   [Field Wrapper
    Attributes](https://wsform.com/knowledgebase/html-form-attributes/#field-wrapper-attributes)

-   [Field
    Attributes](https://wsform.com/knowledgebase/html-form-attributes/#field-attributes)

Instances

Each form on a page is assigned an instance. The first form to render on
the page is given an instance of 1. The second instance of a form is
given an instance of 2, so on and so forth. By using instances, WS Form
is able to render the same form multiple times on a page. For example,
you might have a newsletter sign up at the top and bottom of a page.

Form Attributes

A simplified example of a form element generated by WS Form is as
follows (we've removed some attributes for clarity):

\<form id=\"ws-form-1\" class=\"wsf-form\" data-id=\"123\"
data-instance-id=\"1\"\>

Lets run through each of these attributes in turn. Choose a tab to learn
more.

-   [id](https://wsform.com/knowledgebase/html-form-attributes/#form-id)

-   [class](https://wsform.com/knowledgebase/html-form-attributes/#form-class)

-   [data-id](https://wsform.com/knowledgebase/html-form-attributes/#form-data-id)

-   [data-instance](https://wsform.com/knowledgebase/html-form-attributes/#form-data-instance)

id

The DOM element ID of a form is stored in an attribute called:

id

An example of this attribute is as follows:

id=\"ws-form-1\"

The format of this attribute is follows:

id=\"ws-form-\<instance_id\>\"

So, the first form rendered on a page (first instance) would have an ID
of:

ws-form-1

You could reference this in CSS and JavaScript by using a selector such
as:

#ws-form-1

If you only have one instance of a form on a page, the ID of the form
can be changed. For example, the [form
shortcode](https://wsform.com/knowledgebase/adding-forms-to-your-website/) can
have an element_id attribute added to it. Other site builder elements
also support the ability to change the ID in a setting if necessary. We
generally recommend leaving WS Form to handle these IDs.

class

The form class is stored in an attribute called:

class

An example of this attribute is:

class=\"wsf-form\"

All forms have a class of:

wsf-form

You could be reference this in CSS and JavaScript by using a selector
such as:

.wsf-form

Adding Custom Form Classes

You can add custom classes to a form in the [Form
Settings](https://wsform.com/knowledgebase/form-settings/) \> **Styling** (Tab)
\> **Classes** \> **Form Wrapper** setting.

![WS Form - Form Settings - Styling - Classes - Form
Wrapper](media/image1.gif){width="5.555555555555555in"
height="6.430555555555555in"}

data-id

The actual form ID (i.e. the database ID of the form) is stored in a
data attribute called:

data-id

An example of this attribute is:

data-id=\"123\"

You could reference this in CSS and JavaScript by using a selector such
as:

\[data-id=\"123\"\]

... or a more specific example:

.wsf-form\[data-id=\"123\"\]

data-instance-id

The instance of a form is stored in an attribute called:

data-instance-id

An example of this attribute is:

data-instance-id=\"1\"

You could reference this in CSS and JavaScript by using a selector such
as:

\[data-instance-id=\"1\"\]

... or a more specific example:

.wsf-form\[data-instance-id=\"1\"\]

Field Wrapper Attributes

Most fields in WS Form are contained within a wrapper. The wrapper
provides the ability to style a field, as well as grouping elements such
as checkbox or radio fields.

A simplified example of a field wrapper element generated by WS Form is
as follows (we've removed some attributes for clarity):

\<div id=\"wsf-1-field-wrapper-123\" class=\"wsf-field-wrapper\"
data-id=\"123\" data-type=\"checkbox\"\>

Lets run through each of these attributes in turn. Choose a tab to learn
more.

-   [id](https://wsform.com/knowledgebase/html-form-attributes/#field-wrapper-id)

-   [class](https://wsform.com/knowledgebase/html-form-attributes/#field-wrapper-class)

-   [data-id](https://wsform.com/knowledgebase/html-form-attributes/#field-wrapper-data-id)

-   [data-type](https://wsform.com/knowledgebase/html-form-attributes/#field-wrapper-data-type)

id

The DOM element ID of a field wrapper is stored in an attribute called:

id

And example of this attribute is:

id=\"wsf-1-field-wrapper-123\"

The format of a field wrapper ID is as follows:

wsf-\<instance_id\>-field-wrapper-\<field_id\>

So, the first form rendered on a page (first instance), for field ID 5
would have an ID of:

wsf-1-field-wrapper-5

You could be reference this in CSS and JavaScript by using a selector
such as:

#wsf-1-field-wrapper-5

Field Wrapper Attributes

Most fields in WS Form are contained within a wrapper. The wrapper
provides the ability to style a field, as well as grouping elements such
as checkbox or radio fields.

A simplified example of a field wrapper element generated by WS Form is
as follows (we've removed some attributes for clarity):

\<div id=\"wsf-1-field-wrapper-123\" class=\"wsf-field-wrapper\"
data-id=\"123\" data-type=\"checkbox\"\>

Lets run through each of these attributes in turn. Choose a tab to learn
more.

-   [id](https://wsform.com/knowledgebase/html-form-attributes/#field-wrapper-id)

-   [class](https://wsform.com/knowledgebase/html-form-attributes/#field-wrapper-class)

-   [data-id](https://wsform.com/knowledgebase/html-form-attributes/#field-wrapper-data-id)

-   [data-type](https://wsform.com/knowledgebase/html-form-attributes/#field-wrapper-data-type)

class

The field wrapper class is stored in an attribute called:

class

An example of this attribute is:

class=\"wsf-field-wrapper\"

All fields have a class of:

wsf-field-wrapper

You could be reference this in CSS and JavaScript by using a selector
such as:

.wsf-field-wrapper

... or a more specific example:

.wsf-form .wsf-field-wrapper

Adding Custom Classes to All Field Wrappers

You can add custom classes to all field wrappers in the [Form
Settings](https://wsform.com/knowledgebase/form-settings/) \> **Styling** (Tab)
\> **Classes** \> **Field Wrapper** setting.

![WS Form - Form Settings - Styling - Classes - Field
Wrapper](media/image2.gif){width="5.496527777777778in" height="9.0in"}

Field Wrapper Attributes

Most fields in WS Form are contained within a wrapper. The wrapper
provides the ability to style a field, as well as grouping elements such
as checkbox or radio fields.

A simplified example of a field wrapper element generated by WS Form is
as follows (we've removed some attributes for clarity):

\<div id=\"wsf-1-field-wrapper-123\" class=\"wsf-field-wrapper\"
data-id=\"123\" data-type=\"checkbox\"\>

Lets run through each of these attributes in turn. Choose a tab to learn
more.

-   [id](https://wsform.com/knowledgebase/html-form-attributes/#field-wrapper-id)

-   [class](https://wsform.com/knowledgebase/html-form-attributes/#field-wrapper-class)

-   [data-id](https://wsform.com/knowledgebase/html-form-attributes/#field-wrapper-data-id)

-   [data-type](https://wsform.com/knowledgebase/html-form-attributes/#field-wrapper-data-type)

data-id

The actual field ID (i.e. the database ID of the field) is stored in a
data attribute called:

data-id

An example of this attribute for field ID 123 is:

data-id=\"123\"

You could reference this in CSS and JavaScript by using a selector such
as:

\[data-id=\"123\"\]

... or a more specific example:

.wsf-form .wsf-field-wrapper\[data-id=\"123\"\]

#    wsf_submit_field_validate

Contents

-   [[Description]{.underline}](https://wsform.com/knowledgebase/wsf_submit_field_validate/#wsf-kb-hook-description)

-   [[Usage]{.underline}](https://wsform.com/knowledgebase/wsf_submit_field_validate/#wsf-kb-hook-usage)

-   [[Parameters]{.underline}](https://wsform.com/knowledgebase/wsf_submit_field_validate/#wsf-kb-hook-parameters)

-   [[Return]{.underline}](https://wsform.com/knowledgebase/wsf_submit_field_validate/#wsf-kb-hook-return)

-   [[Example]{.underline}](https://wsform.com/knowledgebase/wsf_submit_field_validate/#wsf-kb-hook-example)

-   [[Source
    File]{.underline}](https://wsform.com/knowledgebase/wsf_submit_field_validate/#wsf-kb-hook-source-file)

-   [[More
    Resources]{.underline}](https://wsform.com/knowledgebase/wsf_submit_field_validate/#wsf-kb-hook-more-resources)

Description

The **wsf_submit_field_validate** filter hook is used to validate each
field when a form is submitted.

Usage

add_filter( \'wsf_submit_field_validate\', \'my_hook_function\', 10, 6
);

Parameters

1.  \$field_error_action_array [[Array]{.underline}](https://www.php.net/manual/en/language.types.array.php)

> An array of actions that are passed back to form to execute. This will
> typically include field_invalid_feedback and/or message actions.

2.  \$field_id [[Integer]{.underline}](https://www.php.net/manual/en/language.types.integer.php)

> The field ID being validated.

3.  \$field_value Mixed

> The submitted value. Note that for some fields (e.g. Select, checkbox
> and file upload) the value may contain an array.

4.  \$section_repeatable_index [[Integer]{.underline}](https://www.php.net/manual/en/language.types.integer.php)

> If the field is contained within a repeatable section, this argument
> represents the row index (starts with 1).

5.  \$post_mode [[String]{.underline}](https://www.php.net/manual/en/language.types.string.php)

> The post mode. Values are: submit, save and action.

6.  \$submit Submit Object

> The submit object. Please note that this is a partial submit object
> because the submit object is still being constructed at the point this
> filter runs.

Return

The errors are added to the form by pushing elements to
the \$field_error_action_array array and returning them in your hook
function.

Error Types

There are two types of error message you can show on a form if a field
does not validate; Field Invalid Feedback and Messages. You can also
redirect a user in the event of an error.

Field Invalid Feedback

Field invalid feedback appears underneath the field being validated.

![Server-Side Validation - Field Invalid
Feedback](media/image3.jpeg){width="5.573611111111111in"
height="1.8090277777777777in"}

Messages

Messages can appear before or after the form, and have a variety of
designs and options.

![Server-Side Validation -
Message](media/image4.jpeg){width="8.338194444444444in"
height="0.9555555555555556in"}

Redirect

You can redirect the user to a different URL.

Pushing Elements to \$field_error_action_array

WS Form supports the display of one or more errors on the form. Each
error is stored in the \$field_error_action_arrayarray.

WS Form adds its own errors to this array, such as file upload,
de-duplication or reCaptacha errors.

Your hook function adds errors to this array if your own validation
fails. \$field_error_action_array is then returned to WS Form when your
function ends.

Example array elements you can push to
the \$field_error_action_array are shown below:

Field Invalid Feedback

+---------------------------+------------------------------------------+
| Array Element             | Description                              |
+===========================+==========================================+
| **\$field                 | Show  the standard invalid feedback      |
| _error_action_array\[\]** | message on the field.                    |
| = **false**;              |                                          |
|                           | Type: Boolean false                      |
+---------------------------+------------------------------------------+
| **\$field                 | Show your own custom invalid feedback    |
| _error_action_array\[\]** | message on the field.                    |
| = \'My custom invalid     |                                          |
| feedback message\';       | Type: String                             |
+---------------------------+------------------------------------------+
| **\$field                 | Show your own custom invalid feedback    |
| _error_action_array\[\]** | message on the field (Alternative        |
| = **array**(              | method).                                 |
|                           |                                          |
| \'action\' =\>            | Type: Array                              |
| \'                        |                                          |
| field_invalid_feedback\', |                                          |
|                           |                                          |
| \'message\' =\> \'My      |                                          |
| custom invalid feedback   |                                          |
| message\'                 |                                          |
|                           |                                          |
| );                        |                                          |
+---------------------------+------------------------------------------+

Messages

+------------------+---------------------------------------------------+
| Array Element    | Description                                       |
+==================+===================================================+
| **               | Show an error message containing the standard     |
| \$field_error_ac | invalid feedback text for that field.             |
| tion_array\[\]** |                                                   |
| = **array**(     | Type: Array                                       |
|                  |                                                   |
| \'action\' =\>   |                                                   |
| \'message\'      |                                                   |
|                  |                                                   |
| );               |                                                   |
+------------------+---------------------------------------------------+
| **               | Show an error message with your own custom        |
| \$field_error_ac | message.                                          |
| tion_array\[\]** |                                                   |
| = **array**(     | Type: Array                                       |
|                  |                                                   |
| \'action\' =\>   |                                                   |
| \'message\',     |                                                   |
|                  |                                                   |
| \'message\' =\>  |                                                   |
| \'My custom      |                                                   |
| message\'        |                                                   |
|                  |                                                   |
| );               |                                                   |
+------------------+---------------------------------------------------+
| **               | Show an error message with your own custom        |
| \$field_error_ac | message with type information.                    |
| tion_array\[\]** |                                                   |
| = **array**(     | See the 'Customizing Message' section below for   |
|                  | additional message configuration keys.            |
| \'action\' =\>   |                                                   |
| \'message\',     | Type: Array                                       |
|                  |                                                   |
| \'message\' =\>  |                                                   |
| \'My custom      |                                                   |
| message\',       |                                                   |
|                  |                                                   |
| \'type\' =\>     |                                                   |
| \'information\'  |                                                   |
|                  |                                                   |
| );               |                                                   |
+------------------+---------------------------------------------------+

Redirect

+----------------------------------+-----------------------------------+
| Array Element                    | Description                       |
+==================================+===================================+
| **                               | Redirect to the specified URL.    |
| \$field_error_action_array\[\]** |                                   |
| = **array**(                     | Type: Array                       |
|                                  |                                   |
| \'action\' =\> \'redirect\',     |                                   |
|                                  |                                   |
| \'url\' =\> \'/redirect-here/\'  |                                   |
|                                  |                                   |
| );                               |                                   |
+----------------------------------+-----------------------------------+

Customizing Messages

The following **optional** array keys can be added
to \$field_error_action_array message elements. If these keys are
excluded, WS Form will use the values configured in [[Form
Settings]{.underline}](https://wsform.com/knowledgebase/form-settings/).

+---------+------------------------------------------------------------+
| Array   | Description                                                |
| Pa      |                                                            |
| rameter |                                                            |
+=========+============================================================+
| message | The message to show.                                       |
+---------+------------------------------------------------------------+
| type    | The type of message to show. Supported values are:         |
|         |                                                            |
|         | -   success                                                |
|         |                                                            |
|         | -   information                                            |
|         |                                                            |
|         | -   warning                                                |
|         |                                                            |
|         | -   danger                                                 |
|         |                                                            |
|         | -   none                                                   |
+---------+------------------------------------------------------------+
| method  | Whether to show the message before or after the form.      |
|         | Supported values are:                                      |
|         |                                                            |
|         | -   before                                                 |
|         |                                                            |
|         | -   after                                                  |
+---------+------------------------------------------------------------+
| clear   | Whether to clear other messages before the message is      |
|         | shown (Only applies to the first message shown). Supported |
|         | values are:                                                |
|         |                                                            |
|         | -   on                                                     |
|         |                                                            |
|         | -   off                                                    |
+---------+------------------------------------------------------------+
| scr     | Whether to scroll to the top of the page when the message  |
| oll_top | is shown. Supported values are:                            |
|         |                                                            |
|         | -   instant                                                |
|         |                                                            |
|         | -   smooth                                                 |
|         |                                                            |
|         | -   off                                                    |
+---------+------------------------------------------------------------+
| scr     | Scroll top offset in pixels (integer). Useful if you have  |
| oll_top | a floating top navigation.                                 |
| _offset |                                                            |
+---------+------------------------------------------------------------+
| scrol   | If smooth scrolling is selected, this value specifies how  |
| l_top_d | long in milliseconds the scroll should take.               |
| uration |                                                            |
+---------+------------------------------------------------------------+
| fo      | Whether to hide the form when the message is shown.        |
| rm_hide | Supported values are:                                      |
|         |                                                            |
|         | -   on                                                     |
|         |                                                            |
|         | -   off                                                    |
+---------+------------------------------------------------------------+
| d       | How long the form should be shown for. Supported values    |
| uration | are:                                                       |
|         |                                                            |
|         | -   \[blank\] -- Indefinite                                |
|         |                                                            |
|         | -   \[integer\] -- Time in milliseconds                    |
+---------+------------------------------------------------------------+

Example

Basic

// My validation function

**function** my_hook_function( **\$field_error_action_array,**
**\$field_id,** **\$field_value,** **\$section_repeatable_index,**
**\$post_mode,** **\$submit** ) {

// Only process validation if the form is submitted and not saved

**if** ( **\$post_mode** !== \'submit\' ) {

**return** **\$field_error_action_array**;

}

// Process each field

**switch**( **\$field_id** ) {

// Validate field ID 123

**case** 123 :

// Put your own validation statement here

**if** ( \'\' === **\$field_value** ) {

// Field did not validate, show invalid feedback text on the field

**\$field_error_action_array\[\]** = **false**;

}

**break**;

// Other field ID validations here \...

}

// Return \$field_error_action_array to WS Form

**return** **\$field_error_action_array**;

}

// Add a callback function for the wsf_submit_field_validate filter hook

add_filter( \'wsf_submit_field_validate\', \'my_hook_function\', 10, 6
);

Advanced

// My validation function

**function** my_hook_function( **\$field_error_action_array,**
**\$field_id,** **\$field_value,** **\$section_repeatable_index,**
**\$post_mode,** **\$submit** ) {

// Only process validation if the form is submitted and not saved

**if** ( **\$post_mode** !== \'submit\' ) {

**return** **\$field_error_action_array**;

}

// Process each field

**switch**( **\$field_id** ) {

// Validate field ID 1

**case** 1 :

// Put your own validation statement here

**if** ( \'\' === **\$field_value** ) {

// Field did not validate, show standard invalid feedback text the field

**\$field_error_action_array\[\]** = **false**;

}

**break**;

// Validate field ID 2

**case** 2 :

// Put your own validation statement here

**if** ( \'\' === **\$field_value** ) {

// Field did not validate, show invalid feedback with a custom message

**\$field_error_action_array\[\]** = \_\_( \'My custom message\' );

}

**break**;

// Validate field ID 3

**case** 3 :

// Put your own validation statement here

**if** ( \'\' === **\$field_value** ) {

// Field did not validate, show a custom message

**\$field_error_action_array\[\]** = **array**(

\'action\' =\> \'message\',

\'message\' =\> \_\_( \'My custom message\' ),

\'type\' =\> \'information\',

\'clear\' =\> \'on\',

\'duration\' =\> 500,

\'scroll_top\' =\> \'smooth\'

);

}

// Validate field ID 4

**case** 4 :

// Put your own validation statement here

**if**(

( \'\' === **\$field_value** ) &&

// Example showing how to limit validation to the first row in a
repeatable section

( 1 === **\$section_repeatable_index** )

) {

// Field did not validate, lets do two things\...

// 1. Show a custom message

**\$field_error_action_array\[\]** = **array**(

\'action\' =\> \'message\',

\'message\' =\> \_\_( \'My custom message\' ),

);

// 2. Show invalid feedback on this field

**\$field_error_action_array\[\]** = **false**;

}

**break**;

// Other field ID validations here \...

}

// Return \$field_error_action_array to WS Form

**return** **\$field_error_action_array**;

}

// Add a callback function for the wsf_submit_field_validate filter hook

add_filter( \'wsf_submit_field_validate\', \'my_hook_function\', 10, 6
);

Source File

This hook can be found in: \<plugin
root\>/includes/core/class-ws-form-submit.php

##  Targeting Forms

WS Form supports multiple forms per page. Each form on the page is
called an instance.

Each instance on the page is given a unique ID. For example:

\<form id=\"ws-form-1\" data-id=\"123\" class=\"wsf-form\"\>

Let's break those attributes down.

The id attribute is a unique identifier for the form. It has the
format ws-form-\<instance_id\>. In this example it is referencing
instance 1.

The data-id attribute indicates which form ID is being rendered. In this
example it is rendering form ID 123.

The class attribute wsf-form appears on all forms. You can use it to
target all forms rendered by WS Form.

Selector Examples

.wsf-form Target all forms.

form\[data-id=\"123\"\] Target form ID 123 on any page.

#ws-form-1 Target the first instance of a form on any page.

Adding Classes to a Form

It is also possible to add classes to form elements so that you can
target them with your own CSS.

Form

To add a class to the form.

-   Click the settings  icon at the top of the [[layout
    editor]{.underline}](https://wsform.com/knowledgebase/the-layout-editor/).

-   Click the **Styling** tab in the sidebar.

-   In the **Classes** settings enter a class name in the **Form
    Wrapper** setting.

Tabs (All)

Tabs are made up two components, the tab itself and the tab content. To
add a class to these components:

-   Click the settings  icon at the top of the [[layout
    editor]{.underline}](https://wsform.com/knowledgebase/the-layout-editor/).

-   Click the **Styling** tab in the sidebar.

-   In the **Classes** settings enter a class name in the **Tab
    Wrapper** or **Tab Content Wrapper** setting.

The class(es) entered will be added to all tabs in the form.

Tabs (Individual)

If you have more than one tab in your form, you can also add a class
each tab content individually. To do this:

-   Click the settings  icon for a specific tab in the layout editor.

-   Click the **Advanced** tab in the sidebar.

-   In the **Classes** settings enter a class name in the **Tab Content
    Wrapper** setting.

The class(es) entered will be added to the content for that tab.

Sections (All)

To add a class to all sections in your form:

-   Click the settings  icon at the top of the [[layout
    editor]{.underline}](https://wsform.com/knowledgebase/the-layout-editor/).

-   Click the **Styling** tab in the sidebar.

-   In the **Classes** settings enter a class name in the **Section
    Wrapper** setting.

The class(es) entered will be added to all sections in the form.

Section (Individual)

To add a class to a specific section in your form:

-   Click the settings  icon for a specific section in the layout
    editor.

-   Click the **Advanced** tab in the sidebar.

-   In the **Classes** settings enter a class name in the **Section
    Wrapper** setting.

The class(es) entered will be added to that specific section.

Fields (All)

Fields are made up of a wrapper and the field itself. To add wrapper or
field classes to all fields on your form:

-   Click the settings  icon at the top of the [[layout
    editor]{.underline}](https://wsform.com/knowledgebase/the-layout-editor/).

-   Click the **Styling** tab in the sidebar.

-   In the **Classes** settings enter a class name in the **Field
    Wrapper** or **Field** setting.

The class(es) entered will be added to all fields in the form.

Field (Individual)

To add a class to a specific field in your form:

-   Click the settings  icon for a specific section in the layout
    editor.

-   Click the **Advanced** tab in the sidebar.

-   In the **Classes** settings enter a class name in the **Field
    Wrapper** or **Field** setting.

The class(es) entered will be added to that specific section.

Setting the Form ID in a Shortcode

The format of the WS Form shortcode is very simple:

Unable to read published form data

... where **123** is equal to your form ID.

The shortcode also has an option element_id parameter which enables you
to set the ID of the form element. For example:

Unable to read published form data

This is useful if you want to target your form using JavaScript.

**[HOW TO REFRENCE WS FORMS IN CODING]{.underline}**

**THE FORM NEEDS TO BE REFERENCED DIFFERENTLY DEPENDING ON THE CODING
LANGUAGE BEING USED. REFERENCE THE FOLLOWING WHEN WRITING CODE:**

Based on your specific requirements and the goal of integrating with
Authorize.net\'s API, here\'s a more definitive answer:

**HTML: \<form id=\"ws-form-1\" data-id=\"14\"\>**

**JavaScript: document.querySelector(\'form\[data-id=\"14\"\]\')**

**jQuery: \$(\'form\[data-id=\"14\"\]\')**

**PHP (when using WS Form functions): wsf_form(14)**

**CSS: form\[data-id=\"14\"\]**

**WordPress Shortcode: \[ws_form id=\"14\"\]**

**PHP (when querying the database directly): \$wpdb-\>get_row(\"SELECT
\* FROM {\$wpdb-\>prefix}wsf_form WHERE id = 14\")**

For API interactions (like with Authorize.net):

\- Use the form ID 14 when you need to identify this specific form in
your custom plugin or API integration code.

When capturing form data to send to Authorize.net, you\'ll likely use
JavaScript or PHP to collect the form data after submission. The form\'s
data-id=\"14\" attribute is the most reliable way to identify this
specific form across different contexts.
