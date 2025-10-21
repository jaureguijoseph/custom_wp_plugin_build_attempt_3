**API Hello world Support Se~~a~~rch Contact usSign in ~~(~~/su**

# Accept Hosted

Accept Hosted is a mobile-optimized payment form hosted by
Authorize.net. It enables you to use the Authorize.net API to submit
payment transactions while maintaining SAQ-A level PCI compliance. You
can redirect customers to the Accept Hosted payment form or embed the
payment form directly in your own page.

For Accept Hosted API details, see the [API Reference
Guide.]{.underline}

> [(https://developer.authorize.net/api/reference/#accept-suite-get-an-acceptpayment-page)]{.underline}

To use a JavaScript library to accept payments, using either your
payment form or the included hosted form, see the documentation for
[Accept.js
(https://developer.authorize.net/api/reference/features/acceptjs.html)]{.underline}.

The implementation and use of Accept Hosted follow a basic work!ow:

1.  You call [getHostedPaymentPageRequest]{.underline}

[(https://developer.authorize.net/api/reference/#accept-suite-get-an-acceptpayment-page)]{.underline}
to request a form token. This request contains transaction information
and form parameter settings.

2.  You embed the payment form or redirect the customer to the payment
    form bysending an HTML POST containing the form token to
    https://accept.authorize.net/payment/payment .

3.  Your customer completes and submits the payment form.

4.  The API sends the transaction to Authorize.net for processing.

5.  The customer is returned to your site, which displays a result page
    based on theURL followed or the response details sent.

**Resources Sample Accept**

> **Hosted Application on GitHub**

**(https://github.com/AuthorizeNet/accept**

> **sample-app) API Reference**

**(http://developer.authorize.net/api/refer**

> **Looking for AIM/SIM?**

**(http://developer.authorize.net/api/upgra**

## Requesting the Form Token

The Accept Hosted process starts with a [getHostedPaymentPageRequest
(https://developer.authorize.net/api/reference/#accept-suite-get-an-acceptpayment-page)]{.underline}
API call. The response contains a **form token** that you can use in a
subsequent request to display the hosted payment form. Using the form
token ensures that the payment form request comes from you and that the
transaction details remain unchanged by the customer or a third party.

The form token is valid for 15 minutes. You must display the payment
form within that time. If the browser makes a request for the payment
form using an expired form token, an error is displayed.

The

[getHostedPaymentPageRequest]{.underline}

[(]{.underline}

[https://developer.authorize.net/api/reference/#accept-suite-get-an-accept-]{.underline}

[payment-page]{.underline}

[)]{.underline}

call contains two primary elements:

**Setting Name**

**Description**

transactionRequest

Required. Contains information about the

transaction.

hostedPaymentSettings

Required. Contains parameters that control

the payment form for that transaction.

**Transaction Request Details**

The transactionRequest element contains transaction details and values
that can be used to populate the form \"elds. It uses the same child
elements as the transactionRequest element in
[createTransactionRequest]{.underline}

> [(https://developer.authorize.net/api/reference/#accept-suite-get-an-acceptpayment-page)]{.underline}
> . Only the transactionType and amount elements are required.
>
> **Important:** No form \"eld is displayed if its corresponding element
> in transactionRequest is absent or set to a NULL value.

### Presenting Payment Options

You can present up to four payment options depending on which values you
use in the hosted form parameters settings (explained in [Hosted Form
Parameter Settings]{.underline} below). Payment options include:

> Credit Card - use the hostedPaymentPaymentOptions parameter.
>
> eCheck (bank account) - use the hostedPaymentPaymentOptions parameter.
>
> Customer Pro\"le - use the hostedPaymentPaymentOptions parameter. See
> note below.
>
> **Important:** If you use the [Customer Pro\"les]{.underline}

[(https://developer.authorize.net/api/reference/features/customer-pro\"les.html)]{.underline}
feature to store customer payment information, you can send a customer
pro\"le ID in the customerPro\"leId element of the
[getHostedPaymentPageRequest
(https://developer.authorize.net/api/reference/#accept-suite-get-an-acceptpayment-page)]{.underline}
call. When the browser displays the form, the four most recent payment
pro\"les for that customer pro\"le are displayed as shown in the image
below. The customer can choose among these payment methods or enter new
payment information, and save the new payment information in a payment
pro\"le that can be used in later transactions.

![](media/image1.jpg){width="4.111111111111111in"
height="3.0416666666666665in"}

### Hosted Form Parameter Settings

To control the payment form, use the following parameter settings within
the hostedPaymentSettings element of the [getHostedPaymentPageRequest
(https://developer.authorize.net/api/reference/#accept-suite-get-an-acceptpayment-page)]{.underline}
API call.

The values for all parameters sent within hostedPaymentSettings are sent
as

JSON objects, regardless of whether you sent the
[getHostedPaymentPageRequest]{.underline}

> [(https://developer.authorize.net/api/reference/#accept-suite-get-an-acceptpayment-page)]{.underline}
> API call in JSON or XML format. If you send the API request in

JSON format, use backslashes to escape the quote characters within
hostedPaymentSettings , as shown in the [Get Hosted Payment Page Request
and Response]{.underline} section below.

**Important:** The following parameter settings include options for
marking form \"elds as required. However, the \"elds marked as required
are not automatically required by Authorize.net.

To require \"elds on the hosted form:

1.  Log in to the Merchant Interface at [https://login.authorize.net/
    (https://login.authorize.net/)]{.underline} as an Account
    Administrator.

2.  Choose **Account \> Payment Form \> Form Fields**.

3.  Check **Required** for each \"eld that you wish to require, or to
    disable the requirement.

**Setting Name**

**Parameters**

hostedPaymentReturnOptions

{

\"showReceipt\": true, \"url\"

:

[\"https://mysite.com/rec]{.underline}

eipt\", \"url

\"Continue\", \"cancelUrl\":

\"https://mysite.com/cancel\", \"can

\"Cancel\"}

**4.**

Click

**Submit**

.

hostedPaymentButtonOptions

{

\"text\": \"Pay\"

}

hostedPaymentStyleOptions

{

\"bgColor\": \"red\"

}

hostedPaymentPaymentOptions

{

\"cardCodeRequired\": false, \"sho

true, \"showBankAccount\": true,

\"customerPro

\"

leId\": false}

hostedPaymentSecurityOptions

{

\"captcha\": false

}

hostedPaymentShippingAddressOptions

{

\"show\": false, \"required\": false

}

hostedPaymentBillingAddressOptions

{

\"show\": true, \"required\": false

}

hostedPaymentCustomerOptions

{

\"showEmail\": false, \"requiredEma

\"addPaymentPro

\"

le\": true}

hostedPaymentOrderOptions

{

\"show\": true, \"merchantName\": \"

Questions Inc.\"}

hostedPaymentIFrameCommunicatorUrl

{

\"url\"

:

\"https://mysite.com/IFrameComm

> **Get Hosted Payment Page Request and**

## Response

### JSON Request

{

**Copy**

> \"getHostedPaymentPageRequest\": {
>
> \"merchantAuthentication\": {
>
> \"name\": \"API_LOGIN_ID\",
>
> \"transactionKey\": \"API_TRANSACTION_KEY\"
>
> },
>
> \"transactionRequest\": {
>
> \"transactionType\": \"authCaptureTransaction\",
>
> \"amount\": \"20.00\",
>
> \"pro\"le\": {
>
> \"customerPro\"leId\": \"123456789\"
>
> },
>
> \"customer\": {
>
> \"email\": \"ellen@mail.com\"
>
> },
>
> \"billTo\": {
>
> \"\"rstName\": \"Ellen\",

### JSON Response

{

**Copy**

\"token\": \"FCfc6VbKGFztf8g4sI0B1bG35quHGGlnJx7G8zRpqV0gha2862KkqR

> \"messages\": {
>
> \"resultCode\": \"Ok\",
>
> \"message\": \[
>
> {
>
> \"code\": \"I00001\",
>
> \"text\": \"Successful.\"
>
> }
>
> \]
>
> }
>
> }

### XML Request

\<getHostedPaymentPageRequest
xmlns=\"AnetApi/xml/v1/schema/AnetApiSche**^Copy^**

> \<merchantAuthentication\>
>
> \<name\>API_LOGIN_ID\</name\>
>
> \<transactionKey\>API_TRANSACTION_KEY\</transactionKey\>
>
> \</merchantAuthentication\>
>
> \<transactionRequest\>
>
> \<transactionType\>authCaptureTransaction\</transactionType\>
>
> \<amount\>20.00\</amount\>
>
> \<pro\"le\>

\<customerPro\"leId\>123456789\</customerPro\"leId\>

> \</pro\"le\>
>
> \<customer\>
>
> \<email\>ellen@mail.com\</email\>
>
> \</customer\>
>
> \<billTo\>
>
> \<\"rstName\>Ellen\</\"rstName\>
>
> \<lastName\>Johnson\</lastName\>

### XML Response

\<getHostedPaymentPageResponse
xmlns:xsi=\"http://www.w3.org/2001/XMLSc**^Copy^**

> \<messages\>
>
> \<resultCode\>Ok\</resultCode\>
>
> \<message\>
>
> \<code\>I00001\</code\>
>
> \<text\>Successful.\</text\>
>
> \</message\>
>
> \</messages\>
>
> \<token\>fpXAkWfQzJUD6zzuU+yz9olx2YkoHd2bPzjm6u/teYYsKi3KmR9xmszK
> \</getHostedPaymentPageResponse\>

## Displaying the Form

Call the form by passing the form token that you received from the token

> element in the [getHostedPaymentPageResponse]{.underline}
>
> [(https://developer.authorize.net/api/reference/#accept-suite-get-an-acceptpayment-page)]{.underline}
> API response.

You can integrate and display the Accept Hosted payment form on your
site in three ways:

> [Integrate the form using a redirect]{.underline}, in which case the
> payment form \"lls the full browser window.
>
> [Integrate the form using iframes]{.underline}, in which case the form
> pops up in a lightbox overlaid on your website.
>
> [Integrate the form using an embedded frame]{.underline}, in which
> case the payment form appears within your website.

### Form POST URLs

> **Sandbox:** https://test.authorize.net/payment/payment
>
> **Production:** https://accept.authorize.net/payment/payment
>
> See the [sample application on GitHub
> (https://github.com/AuthorizeNet/acceptsample-app)]{.underline} to
> explore different ways to display the hosted form.

The payment form validates the customer \"eld data and permits changes
before the customer submits the data. In case of a payment decline or
error, the customer remains on the form where they can make changes and
try again. The customer can also click the cancel button, which displays
the text submitted in the cancelUrlText parameter, and which returns the
customer to the merchant page

de\"ned by cancelUrl .

If the transaction is processed successfully, and if you did not set
showReceipt to false , a receipt page with a continue button is
displayed. Use urlText to label the button. Upon clicking the button,
the customer goes to the merchant page de\"ned by url .

**Important:** There are Payment Form settings in the Authorize.net
[Merchant Interface (https://account.authorize.net/)]{.underline} that
can cause transaction errors when unsent \"elds are marked as required.

To avoid errors caused by required \"elds:

1.  Log into the Merchant Interface at [https://login.authorize.net/
    (https://login.authorize.net/)]{.underline} as an Account
    Administrator.

2.  Choose **Account \> Payment Form \> Form Fields**.

3.  Choose **Required** for each \"eld that you wish to require, or to
    disable the requirement.

4.  Click **Submit**.

### Integrating the Form using a Redirect

Submit the form POST using the following HTML parameter:
action=\"https://test.authorize.net/payment/payment\" :

\<!

DOCTYPE html

\>

**Copy**

> \<html\>
>
> \<meta name=\"viewport\" content=\"width=device-width,
> initial-scale=1, maximum \<head\>
>
> \</head\>
>
> \<body\>

\<form method=\"post\"
action=\"https://test.authorize.net/payment/paymen

\<input type=\"hidden\" name=\"token\" value=\"Replace with form token
fro

> Continue to Authorize.net to Payment Page

\<button id=\"btnContinue\"\>Continue to next page\</button\>

> \</form\>
>
> \</body\>
>
> \</html\>

The following code example shows the individual steps together:

> \<html xmlns=\"http://www.w3.org/1999/xhtml\"\>
>
> \<head\>
>
> \<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"\>
>
> \<meta charset=\"utf-8\"\>
>
> \<meta name=\"viewport\" content=\"width=device-width,
> initial-scale=1, maxi
>
> \<script src=\"scripts/jquery.min.js\"\>\</script\>
>
> \<script src=\"scripts/bootstrap.min.js\"\>\</script\>
>
> \<script type=\"text/javascript\"\>
>
> \$(function () {
>
> \$(\"#btnContinue\").click(function () {
>
> \$(\"#redirectToken\").val(\$(\"#inputtoken\").val());
>
> });
>
> });
>
> \</script\>
>
> \</head\>
>
> \<body\>
>
> \<input type=\"text\" id=\"inputtoken\" value=\"\" /\>

### Integrating the Form Using Iframes and Lightboxes

**Step 1.** Create and host an iframe communicator HTML \"le like the
one shown below. The name of the \"le must match the

> hostedPaymentIFrameCommunicatorUrl setting name in your
>
> [getHostedPaymentPageRequest]{.underline}

[(https://developer.authorize.net/api/reference/#accept-suite-get-an-acceptpayment-page)]{.underline}
API call. You must host the \"le on the same domain as the page in which
you embedded the iframe popup window, and you must use HTTPS to encrypt
the data sent to the iframe communicator URL.

> \<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
> \"http://www.w3.o
>
> \<html xmlns=\"http://www.w3.org/1999/xhtml\"\>
>
> \<head\>
>
> \<title\>Iframe Communicator\</title\>
>
> \<script type=\"text/javascript\"\>
>
> //\<\![CDATA\[ function callParentFunction(str) { if (str &&
> str.length \> 0
>
> && window.parent

&& window.parent.parent

> && window.parent.parent.AuthorizeNetPopup
>
> && window.parent.parent.AuthorizeNetPopup.onReceiv
>
> {
>
> // Errors indicate a mismatch in domain between the page containing
> the iframe

window.parent.parent.AuthorizeNetPopup.onReceiv

> }
>
> }
>
> **Step 2.** Create an empty.html \"le:
>
> \<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
> \"http://www**^Copy^**
>
> \<html xmlns=\"http://www.w3.org/1999/xhtml\"\>
>
> \<head\>
>
> \<title\>empty\</title\>
>
> \</head\> \<body\>
>
> \</body\> \</html\>

**Step 3.** Copy and paste the following HTML code snippet into the web
page where you want your Accept Payment iframe popup. The HTML code
snippet enables communication through the iframe communicator to
Authorize.net for window resizing and successful events. You might need
to add a button to trigger the iframe communication.

\<div id=\"divAuthorizeNetPopup\" style=\"display:none;\"
class=\"AuthorizeNetPopu

> \<div class=\"AuthorizeNetPopupOuter\"\>
>
> \<div class=\"AuthorizeNetPopupTop\"\>
>
> \<div class=\"AuthorizeNetPopupClose\"\>
>
> \<a href=\"javascript:;\" onclick=\"AuthorizeNetPopup.closePopup(
> \</div\>
>
> \</div\>
>
> \<div class=\"AuthorizeNetPopupInner\"\>

\<iframe name=\"iframeAuthorizeNet\" id=\"iframeAuthorizeNet\" src=\"

> \</div\>
>
> \<div class=\"AuthorizeNetPopupBottom\"\>

\<div class=\"AuthorizeNetPopupLogo\" title=\"Powered by Authorize.n

> \</div\>
>
> \<div id=\"divAuthorizeNetPopupScreen\"
> style=\"display:none;\"\>\</div\> \</div\>
>
> \</div\>

**Step 4.** Submit the form token in an HTTP POST to Authorize.net, as
shown below. The target should be the same as the iframe ID mentioned in
Step 3. The action attribute speci\"es the Accept Hosted payment page
URL. Steps 3 and 4 together provide the Authorize.net iframe popup in
your web page, and you can customize the location.

\<form method=\"post\"
action=\"https://test.authorize.net/payment/payment\" id**^Copy^**

\<input type=\"hidden\" id=\"popupToken\" name=\"token\" value=\"Replace
with f

> \</form\>

**Step 5.** Add CSS styles to adjust the size and location of the
Authorize.net popup screen.

> **Step 6.** Implement a method to receive the iframe communication
> response:
>
> AuthorizeNetPopup.onReceiveCommunication = function (querystr) { var
> params = parseQueryString(querystr); alert(params); switch
> (params\[\"action\"\]) { case \"successfulSave\":
>
> AuthorizeNetPopup.closePopup(); break;
>
> case \"cancel\":
>
> AuthorizeNetPopup.closePopup(); break;
>
> case \"transactResponse\":
>
> var response = params\[\"response\"\];
>
> document.getElementById(\"token\").value = response;
> AuthorizeNetPopup.closePopup(); break;
>
> case \"resizeWindow\":
>
> var w = parseInt(params\[\"width\"\]);

The following code example shows all of the steps:

\<html xmlns=\"http://www.w3.org/1999/xhtml\"\>

**Copy**

> \<head\>
>
> \<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"\>
>
> \<meta charset=\"utf-8\"\>
>
> \<meta name=\"viewport\" content=\"width=device-width,
> initial-scale=1, maxi
>
> \<script src=\"scripts/jquery.min.js\"\>\</script\>
>
> \<script src=\"scripts/bootstrap.min.js\"\>\</script\>
>
> \<title\>HostedPayment Test Page\</title\>
>
> \<style type=\"text/css\"\> body { margin: 0px; padding: 0px;
>
> }
>
> #divAuthorizeNetPopupScreen { left: 0px; top: 0px;

### Integrating an Embedded Iframe

> **Step 1.** Create and host an HTML \"le like the one shown below. The
> name of the

\"le must match the hostedPaymentIFrameCommunicatorUrl setting name in
your [getHostedPaymentPageRequest]{.underline}

> [(https://developer.authorize.net/api/reference/#accept-suite-get-an-accept-]{.underline}
>
> [payment-page)]{.underline} API call. You must host the \"le on the
> same domain as the page in which you embedded the iframe popup window,
> and you must use HTTPS to encrypt the data sent to the iframe
> communicator URL.
>
> \<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
> \"http://www.w3.o**^Copy^**
>
> \<html xmlns=\"http://www.w3.org/1999/xhtml\"\>
>
> \<head\>
>
> \<title\>Iframe Communicator\</title\>
>
> \<script type=\"text/javascript\"\>
>
> //\<\![CDATA\[ function callParentFunction(str) { if (str &&
> str.length \> 0
>
> && window.parent
>
> && window.parent.parent
>
> && window.parent.parent.AuthorizeNetIFrame
>
> && window.parent.parent.AuthorizeNetIFrame.onReceiveCo
>
> {
>
> // Errors indicate a mismatch in domain between the page containing
> the iframe

window.parent.parent.AuthorizeNetIFrame.onReceiveC

> }
>
> }
>
> **Step 2.** Add an iframe place holder:
>
> \<div id=\"iframe_holder\" class=\"center-block\"
> style=\"width:90%;max-width**^Copy^**: 100
>
> \<iframe id=\"add_payment\" class=\"embed-responsive-item panel\"
> name=\"ad \</iframe\> \</div\>
>
> **Step 3.** Submit an HTTP POST:
>
> \<form id=\"send_token\" action=\"\" method=\"post\"
> target=\"add_payment\"**^Copy^**\>
>
> \<input type=\"hidden\" name=\"token\" value=\"Replace with form token
> from g \</form\>
>
> **Step 4.** Implement a method to receive the iframe Communication
> response:
>
> AuthorizeNetIFrame.onReceiveCommunication = function (querystr) {
> **^Copy^** var params = parseQueryString(querystr); switch
> (params\[\"action\"\]) { case \"successfulSave\":
>
> break;
>
> case \"cancel\":
>
> break;
>
> case \"resizeWindow\":
>
> var w = parseInt(params\[\"width\"\]); var h =
> parseInt(params\[\"height\"\]); var ifrm =
> document.getElementById(\"add_payment\");
>
> ifrm.style.width = w.toString() + \"px\"; ifrm.style.height =
> h.toString() + \"px\";
>
> break;
>
> case \"transactResponse\": var ifrm =
> document.getElementById(\"add_payment\"); ifrm.style.display =
> \'none\';
>
> The following code example shows all of the steps:

\<!DOCTYPE html\>

**Copy**

> \<html\>
>
> \<meta name=\"viewport\" content=\"width=device-width,
> initial-scale=1, maximum
>
> \<head\>
>
> \<title\>HostedPayment Test Page\</title\>
>
> \<script src=\"scripts/lib/jquery.min.js\"\>\</script\>
>
> \<script type=\"text/javascript\"\>
>
> \$(function () {
>
> \$(\"#btnOpenAuthorizeNetIFrame\").click(function () {
>
> \$(\"#add_payment\").show();

\$(\"#send_token\").attr({ \"action\": \"https://test.authorize.net/pa

> \$(window).scrollTop(\$(\'#add_payment\').offset().top - 50);
>
> });
>
> });

## Transaction Response

> If the customer returns to the customer site, the merchant receives
> the results of the transaction. How the merchant receives the results
> depends on how you integrate the payment form.

### Iframe/Lightbox Method

> For security reasons, web browsers do not allow JavaScript
> communication from a page inside an iframe to the page that contains
> the iframe if the pages have different domains. Therefore, the hosted
> form cannot directly provide transaction details to the page that
> hosts the iframe.
>
> However, by hosting on your domain a small JavaScript-powered page
> called an iframe communicator, you can pass some details between the
> payment form and the merchant site.
>
> When you embed the hosted payment form in an iframe on your page, the
> form can in turn embed your iframe communicator within an invisible
> iframe. Through this invisible iframe, messages are sent to your
> iframe communicator. If you host the iframe communicator on the same
> domain as the page in which you embedded the form, the iframe
> communicator relays the messages to your page\'s listener script.
>
> **Important:** You must use HTTPS in the URL to your iframe
> communicator.
>
> Your iframe communicator can receive three types of messages:

**Message**

**Type**

**Message Fields and Format**

**Descriptio**

Resize

Window

action=resizeWindow&width=698&height=697

When

actio

height

par

suggested

Request

Canceled

action=cancel

When

actio

payment fo

cancelUrl

getHosted

(

https://dev

suite-get-a

Request

Successful

action=transactResponse&response= \...

When

actio

parameter

details. See

createTran

details on t

The JSON o

createPaym

indicates w

new payme

  -------------- --------------------------------------------- -----------

  -------------- --------------------------------------------- -----------

> The following example shows the iframe communicator message when the
> customer successfully submits a transaction through the embedded
> payment form. The createPaymentPro\"leResponse property appears only
> if the customer opts to save a new payment method, and if a new
> payment pro\"le was successfully created, the success parameter is set
> to true .
>
> action=transactResponse&response={\"accountType\":\"MasterCard\",\"acco
> \"transId\":\"2155590169\",\"responseCode\":\"1\",\"authorization\":\"D29J20\"
>
> \"G and S Questions Inc.\",\"billTo\":{\"phoneNumber\":\"425 111
> 2222\",\"f
>
> \"lastName\":\"Smith\",\"address\":\"1234 Test Ave N.E.
> %5\",\"city\":\"Teste
>
> \"98009\",\"country\":\"USA\"},\"shipTo\":{\"firstName\":\"Bob\",\"lastName\":\"S
>
> \"1234 Test Ave
> N.E.\",\"city\":\"Tester\",\"state\":\"WA\",\"zip\":\"98009\",\"c
>
> \"orderDescription\":\"Order
> description\",\"taxAmount\":\"1.01\",\"shippin
>
> \"dutyAmount\":\"3.01\",\"customerId\":\"CUST12345\",\"totalAmount\":\"62.88\"
>
> \"PO#12345678\",\"orderInvoiceNumber\":\"INV_pf7JzZb\",\"dateTime\":\"9/13/
>
> \"createPaymentProfileResponse\":{\"success\":\"true\",\"message\":\"null\"}
>
> **Important:** If you host the form in an iframe, you must include the
> iframe communicator URL in the hostedPaymentIFrameCommunicatorUrl
> parameter of your [getHostedPaymentPageRequest]{.underline}
>
> [(https://developer.authorize.net/api/reference/#accept-suite-get-an-acceptpayment-page)]{.underline}
> API call. To ensure that you receive a response code, you must also
> set showReceipt to false .
>
> We provide an example of an [iframe communicator
> (https://github.com/AuthorizeNet/accept-sample-]{.underline}
>
> [app/blob/master/IFrameCommunicator.html)]{.underline} and more
> details about how it works in the [sample application on GitHub
> (https://github.com/AuthorizeNet/acceptsample-app)]{.underline}.

### Redirect Method

> When you use the hosted payment form directly, rather than from within
> an iframe, the continue and cancel buttons send an HTTP GET request to
> that URL when clicked, and the customer is redirected to the cancel
> URL or continue URL, depending on which button the customer clicked.
> No other information about the transaction is provided. **When you use
> the redirect method, the receipt**
>
> **page is always displayed.**

### All Methods

> With any of the form integration methods, you can embed information
> speci\"c to the customer into the continue URL or the cancel URL. The
> merchant server\'s code can embed a tracking code into the URL that
> can identify the speci\"c customer and order details when the customer
> returns. URL-encode any namevalue pairs embedded in the URL to ensure
> correct processing in the form request.
>
> Additionally, developers can register for [Webhooks]{.underline}
>
> [(https://developer.authorize.net/api/reference/features/webhooks.html)]{.underline}
> to receive real-time noti\"cations when transactions are either
> declined or approved. A developer using Webhooks will receive a
> transaction noti\"cation regardless of whether the customer closed the
> browser without clicking the continue button.

## Error and Fraud Filter Handling

> Transaction declines and errors appear directly within the hosted
> payment form. For example, the image below shows a general decline
> (response code 2), which you can simulate in the sandbox environment
> by passing the ZIP code 46282. The customer can try another card or
> update other payment form \"elds to resolve the issue. See the
> [Sandbox Testing Guide]{.underline}
>
> [(http://developer.authorize.net/hello_world/testing_guide/)]{.underline}
> for more details on simulating errors.
>
> ![](media/image4.jpg){width="5.0in" height="4.333333333333333in"}
>
> For declines caused by the \"lters in the [Advanced Fraud Detection
> Suite
> (https://www.authorize.net/our-features/advanced-fraud-detection/)]{.underline}
> (AFDS), including Address Veri\"cation Service (AVS) \"lters, the form
> displays the error, and the customer can update the information and
> try again.
>
> ![](media/image5.jpg){width="5.0in" height="4.430555555555555in"}

### Held Transactions

> When a transaction request triggers an [AFDS
> (https://www.authorize.net/ourfeatures/advanced-fraud-detection/)]{.underline}
> \"lter set to hold transactions for review, the result looks very much
> like a successful transaction; the held transaction has a transaction
> ID, but its status indicates that it is held for review. The
> transaction might also have an authorization code if the merchant
> con\"gured the AFDS \"lter to authorize the transaction before holding
> it for review. The transaction has a
>
> Response Code of 4, indicating that the transaction is held for
> review. To learn more about handling held transactions using the API,
> see the [Fraud Management
> (https://developer.authorize.net/api/reference/index.html#fraud-management)]{.underline}
> section of the API Reference.
>
> If you use the redirect method with the hosted receipt page, and a
> customer submits a transaction that is held for review, the receipt
> page displays as normal, and the transaction appears to have processed
> successfully. The lack of errors or other indicators of a held review
> makes it harder to guess which conditions cause \"ltering and thus
> helps to reduce fraud.
>
> If you use an iframe and showReceipt is set to false , you can check
> the response code in the transactResponse message sent to your iframe
> communicator:

{

**Copy**

> \"accountType\": \"Visa\",
>
> \"accountNumber\": \"XXXX1111\",
>
> \"transId\": \"2153422684\",
>
> \"responseCode\": \"4\",
>
> \"billTo\": {
>
> \"\"rstName\": \"Ellen\",
>
> \"lastName\": \"Johnson\",
>
> \"company\": \"Souveniropolis\",
>
> \"address\": \"14 Main Street\",
>
> \"city\": \"Pecan Springs\",
>
> \"state\": \"TX\",
>
> \"zip\": \"44628\"
>
> },
>
> \"shipTo\": {},
>
> \"totalAmount\": \"99990.00\",
>
> \"dateTime\": \"2/3/2017 4:24:36 PM\"
>
> }

**Visa (https://usa.visa.com/legal/privacy-policy.html)**

**Cybersource.com**(/)
**(//policy.cookiereports.com/40b0dfe0-en-gb.html)**

**Privacy (//policy.cookiereports.com/40b0dfe0-en-gb.html)**

> **Ad prefernces (//policy.cookiereports.com/40b0dfe0-en-gb.html)**
>
> **Cookie policy (//policy.cookiereports.com/40b0dfe0-en-gb.html)**

**Terms and conditions (https://www.authorize.net/about-us/terms.html)**

> © 2019-2022. Authorize.net. All rights reserved. All brand names and
> logos are the property of their respective owners, are used for
> identi\"cation purposes only, and do not imply product endorsement or
> af\"liation with Authorize.net.
