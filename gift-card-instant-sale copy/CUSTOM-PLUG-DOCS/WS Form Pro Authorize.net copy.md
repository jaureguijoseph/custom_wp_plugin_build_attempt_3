Authorize.Net AcceptPRO

This knowledge base article relates to the WS Form Authorize.Net Accept
add-on. Included with
the [[Agency]{.underline}](https://wsform.com/pricing/) edition or [[buy
separately]{.underline}](https://wsform.com/checkout/?edd_action=add_to_cart&download_id=3458)for
other editions.

**Note:** You must serve the page containing the payment form over
HTTPS. In short, the address of the page containing Authorize.Net Accept
must start with https:// rather than just http://.

The Authorize.Net add-on allows you to accept credit card payments from
your forms. You can either charge a fixed amount using the button in
isolation, or you can use the [[WS Form E-Commerce
fields]{.underline}](https://wsform.com/knowledgebase_category/field-types-ecommerce/) to
produce more advanced cart options.

The Authorize.Net button uses the latest, client-side payment process
offered by Authorize.Net called Accept.

Installation

The WS Form Authorize.Net add-on is installed in the same way
as [[installing the WS Form PRO
plugin]{.underline}](https://wsform.com/knowledgebase/installation/).

Once installed you will need to activate the license for the plugin.
When you purchase the Authorize.Net add-on, you will be given a license
key. If you have lost your license key(s), [[click
here]{.underline}](https://wsform.com/knowledgebase/licensing/).

To activate your license key:

1.  Click **WS Form** in the WordPress administration menu.

2.  Click **Settings**.

3.  Click the **Authorize.Net** tab at the top of the page.

4.  Enter your license key.

5.  Click the **Activate** button.

If your license key fails to activate, please ensure you are using the
correct license key and not your WS Form PRO license key.

Configuring Authorize.Net

In order to use the Authorize.Net button, you first need to enter the
following information for your sandbox and/or production accounts:

-   API Login ID

-   API Transaction Key

-   Client Key

To find these credentials, log in to your sandbox or production account
and go to: Authorize.Net under Account \> Settings \> Security Settings
\> General Security Settings

Your API Login ID and Transaction Key can be found under **API
Credentials and Keys**.\
Your Client Key can be found (or created) under **Manage Public Client
Key**.

If you do not yet have an Authorize.Net sandbox or production account,
you can create them here:

-   [[Create Sandbox
    Account]{.underline}](https://developer.authorize.net/hello_world/) (We
    recommend you read the [[Authorize.Net Testing
    Guide]{.underline}](https://developer.authorize.net/hello_world/testing_guide.html))

To enter your credentials and keys:

1.  Click **WS Form** in the WordPress administration menu.

2.  Click **Settings**.

3.  Click the **Authorize.Net** tab at the top of the page.

4.  Choose **Sandbox** or **Production** under **Environment**,
    depending on the environment you want to use.

5.  Enter your sandbox and production credentials and keys.

6.  Click the **Save** button.

Once configured, the Authorize.Net button will appear under
the **E-Commerce** section of the toolbox when editing a form.

You can enter sandbox and/or production credentials and keys; having
both sets is not necessary.

Adding The Authorize.Net Button

To learn how to add, edit, clone, move, resize, offset, or delete an
Authorize.Net button field, please [[click
here]{.underline}](https://wsform.com/knowledgebase/fields/).

When editing a custom button field, the field settings sidebar will
appear. This contains the following tabs:

-   [[Basic]{.underline}](https://wsform.com/knowledgebase/auth_checkout/#basic)

-   [[Advanced]{.underline}](https://wsform.com/knowledgebase/auth_checkout/#advanced)

You can edit any of the settings in each of these tabs and then click
the **Save** button to save your changes. If you do not want to save
your changes, you can click the **Cancel** button or click any other
form element to close the field settings sidebar.

For a full explanation of the configuration options for the
Authorize.Net button, [[click
here]{.underline}](https://developer.paypal.com/docs/checkout/how-to/customize-button/).

Basic

The basic tab contains settings that the majority of WS Form users will
need to control a field. The settings are as follows:

Label

This label is used to identify the custom button in the WS Form form
builder.

Transaction

Type

You can create a one-time charge or initiate a subscription (ARB). The
available options are:

-   One-Time

-   Subscription

-   By Field

The **By Field** setting allows you to specify the type by a field. For
example you could use
a [[Radio]{.underline}](https://wsform.com/knowledgebase/radio/) field
to determine the type of transaction. The type field should
return onetime or subscription as a value.

Amount To Charge

By default this field is blank, and the Authorize.Net button will charge
the amount calculated by the e-commerce fields on your form (the same as
entering #ecommerce_cart_total). For example, you might have a single
price field for making a donation or a more elaborate form with prices,
quantities, and subtotals.

You can also enter a fixed amount into this field.

WS
Form [[variables]{.underline}](https://wsform.com/knowledgebase/variables/) can
be entered into this field.

Description

Enter the description of the transaction in this field. For example:
Payment To My Blog.

WS
Form [[variables]{.underline}](https://wsform.com/knowledgebase/variables/) can
be entered into this field.

Subscription

These settings are only shown if the transaction **Type** is set
to **Subscription**.

Name

Enter the name of the subscription for reference.

Interval Length

Enter the interval length for the subscription. For a unit of days, use
an integer between 7 and 365, inclusive. For a unit of months, use an
integer between 1 and 12, inclusive.

Interval Unit

Choose the interval unit. Options are:

-   Month(s)

-   Days

-   By Field

Total Occurencies

Enter how many times the subscription will occur. Enter 9999 for
infinite.

Start Date

Enter a start date for the payment schedule.

Customer

ID

Enter a unique customer ID used to represent the customer associated
with the transaction. WS Form variables can be used in this field, for
example:

#field(1)-#field(2)

Email

Select a email field on your form to associate with the transaction.
This field is optional.

Phone

Select a phone field on your form to associate with the transaction.
This field is optional.

Type

Select **Individual** or **Business** to determine how transactions
should be classified.

Appearance

Billing Address Option

Specify whether the name and postal code fields should be shown on the
form and whether they are required to be filled in.

Header Text

This is the text that is displayed on the header of the payment form.
The default is to not display any text.

Button Label

This is the text that is displayed on the button. The default is "Pay".

Advanced

The advanced tab contains additional form attribute settings that
provide further control over how the Authorize.Net button is rendered.

Billing

Billing Address Mapping

This field is optional. Billing Address Mapping tells WS Form which of
your form fields relate to the corresponding billing fields in
Authorize.Net.

To map a field:

1.  Click the **Add**  icon at the bottom right of the field mapping
    section.

2.  In the left-hand column, select your form field.

3.  In the right-hand column, select the corresponding Authorize.Net
    field.

4.  Repeat this process for each field on your form.

5.  Click the **Save** button at the bottom of the sidebar to save your
    changes.

Shipping Address Mapping

This field is optional. Shipping Address Mapping tells WS Form which of
your form fields relate to the corresponding shipping fields in
Authorize.Net.

To map a field:

1.  Click the **Add**  icon at the bottom right of the field mapping
    section.

2.  In the left-hand column, select your form field.

3.  In the right-hand column, select the corresponding Authorize.Net
    field.

4.  Repeat this process for each field on your form.

5.  Click the **Save** button at the bottom of the sidebar to save your
    changes.

Transaction

Zero Amount

You can configure how WS Form should handle zero amounts for
Authorize.Net buttons. In some cases you may wish to show an error
message (e.g., a donation amount is set to zero). In other cases you may
wish to still submit the form (e.g., if something is determined to be
free). Select the appropriate action from the pull-down list.

Zero Amount Message

If you opt to show an error message, enter the error message you would
like to be shown here.

Error Messages

WS Form PRO processes any error messages as standard WS Form messages.
The error message settings match those of the [[Show
Message]{.underline}](https://wsform.com/knowledgebase/show-message/) action.
You can configure these options to change how the error messages are
displayed to users.

Classes

For developers WS Form allows you to add your own classes to fields.

Field Wrapper

The wrapper CSS class setting enables you to add a class (or classes) to
a field wrapper. Field wrappers are sections of HTML added around a
field to position them on the page. To add multiple classes, add a space
between the class names.

Field

To add a class to the actual field element itself, enter a class (or
classes) to this setting. To add multiple classes, add a space between
the class names.

Breakpoints

The breakpoint settings define the width of a field and also what the
offset (how many columns from the left-hand side of the form or the
previous field) of a field is for each breakpoint. For more information
about the breakpoint settings and capabilities of WS Form, [[click
here]{.underline}](https://wsform.com/knowledgebase/responsive-forms/).
