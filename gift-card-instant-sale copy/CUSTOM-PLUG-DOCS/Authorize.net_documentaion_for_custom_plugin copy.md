# Authorize.net Documentation

**Payment Transactions**

The Authorize.net API provides robust features for processing payment
transactions through the Authorize.net gateway. The API supports XML and
JSON variants.

For detailed API reference information, see the [[API
Reference]{.underline}](http://developer.authorize.net/api/reference/).

If you are new to the Authorize.net API, start with the [[Payment Card
Payment
Tutorial]{.underline}](http://developer.authorize.net/api/reference/features/credit_card-tutorial.html).
Many of the core concepts in the tutorial apply to other payment types,
which makes it a good place to start. You should also sign up for
a [[sandbox
account]{.underline}](https://developer.authorize.net/hello_world/sandbox/) and
use the [[Testing
Guide]{.underline}](http://developer.authorize.net/hello_world/testing_guide/) for
your initial tests.

If you design solutions used by multiple merchants, consider registering
as a partner and generating a [[solution
ID]{.underline}](https://developer.authorize.net/api/solution_id/). By
using solution IDs, your solution identifies itself in your merchants\'
transactions when they review their reports.

When you develop your payment application and integrate it with the
Authorize.net API, you must consider the [[Payment Card Industry Data
Security Standards
(PCI-DSS)]{.underline}](https://www.pcisecuritystandards.org/pci_security/maintaining_payment_security).
For more information, see the [[Understanding PCI Compliance
page.]{.underline}](https://www.authorize.net/resources/blog/understanding-pci-compliance/)

While payment cards remain the primary method of payment, the
Authorize.net API supports several alternate payment types, such as
PayPal and Apple Pay. For more information on payment types and API
features supported by Authorize.net, see the [[API
Documentation]{.underline}](http://developer.authorize.net/api/) landing
page.

For information on specific payment processing platforms and the
features they support through the Authorize.net payment gateway, see
the [[Processor
Support]{.underline}](https://developer.authorize.net/api/reference/features/processor-support.html) documentation.

**Resources**

-   [**[API
    Reference]{.underline}**](http://developer.authorize.net/api/reference/index.html#payment-transactions)

-   [**[Card-On-File (COF)
    Mandates]{.underline}**](https://developer.authorize.net/api/reference/features/card-on-file.html)

-   [**[Purchase Return Authorization (PRA)
    Mandate]{.underline}**](https://developer.authorize.net/api/reference/features/pra-mandate.html)

-   [**[Processor
    Support]{.underline}**](https://developer.authorize.net/api/reference/features/processor-support.html)

-   [**[SDKs and Sample Code on
    GitHub]{.underline}**](https://github.com/AuthorizeNet)

-   [**[Looking for
    AIM/SIM]{.underline}**](http://developer.authorize.net/api/upgrade_guide/)

**Basics of Payment Card Processing**

Connecting a website or software application to payment processing
networks is exceptionally difficult and typically beyond the expertise
and technical resources of most merchants. Instead, merchants can
connect to the Authorize.net Payment Gateway, which provides the complex
infrastructure and security necessary to ensure fast, reliable, and
secure transmission of transaction data.

Typically, four actors participate in a payment card transaction.

-   A merchant sells products or services to customers, and can use the
    Authorize.net Payment Gateway and its API to submit payment
    transactions.

-   A customer buys products or services from merchants using a payment
    card from an issuing bank.

-   An issuing bank provides payment cards to customers and represent
    customers in disputes.

-   An acquiring bank underwrites merchants so the merchants can accept
    payment cards. Acquiring banks also represent merchants in disputes.

**Stages of a Transaction**

An online payment transaction goes through three stages.

**Authorization**

An authorization is a hold on the transaction amount against the
available balance on a customer\'s payment card. No funds are
transferred while the funds for the transaction are on hold. For
example, a merchant who sells products first authorizes the amount of
the transaction and then ships the order to the customer. Only after the
merchant ships the order does the merchant take the next steps.

**Capture**

A capture queues a transaction for settlement. Usually merchants capture
the full amount of the original authorization, but the capture amount
can be less. A single authorization can be captured only once. If you
capture only part of an authorization amount, a new authorization will
be required in order to capture more. For example, suppose that the
merchant does not have the full order in stock. The merchant can ship a
partial order and then capture the transaction for an adjusted amount.

Important: Authorize.net defaults to automatically capturing authorized
amounts. See [[Transaction
Types]{.underline}](https://developer.authorize.net/api/reference/features/payment-transactions.html#Transaction_Types) below
for more information.

**Settlement**

Settlement is the process through which merchants instruct the acquiring
bank to acquire the captured funds from the issuing bank. When the
merchant captures the transaction, Authorize.net settles the transaction
within 24 hours. After settlement completes, the acquiring bank deposits
the captured funds into the merchant's bank account.

**Transaction Types**

Authorize.net supports several transaction types for creating and
managing transactions through
the [createTransactionRequest](https://developer.authorize.net/api/reference/#payment-transactions)API
call.

**Authorization and Capture**

The transaction amount is sent for authorization and if it is approved,
the transaction is automatically submitted for settlement. This
transaction is the most common type of transaction and is the default
when merchants manually enter transactions in the Merchant Interface.

To submit an Authorization and Capture request, set
the transactionType element to authCaptureTransaction in
the [createTransactionRequest](https://developer.authorize.net/api/reference/#payment-transactions-charge-a-credit-card) API
call.

**Authorization Only**

The transaction amount is sent for authorization only. The transaction
is not settled until captured by Prior Authorization Capture (see
definition below), or the merchant manually captures the transaction in
the Merchant Interface. Authorization Only transactions that are not
captured within 30 days of authorization are expired and are no longer
available for settlement. Merchants with an expired transaction should
authorize and capture a new transaction to receive funds.

To submit an Authorization Only request, set the transactionType element
to authOnlyTransaction in
the [createTransactionRequest](https://developer.authorize.net/api/reference/#payment-transactions-authorize-a-credit-card) API
call.

**Prior Authorization Capture**

The previously authorized transaction is captured and queued for
settlement. Authorize.net accepts this transaction type if:

-   The original Authorization Only transaction was submitted within the
    past 30 days and has not expired.

-   The Authorization Only transaction was successful and is not yet
    captured.

-   The amount being requested for capture is less than or equal to the
    original authorized amount. Only one Prior Authorization Capture
    request can be submitted against an Authorization Only transaction.

-   The Prior Authorization Capture request is submitted with the valid
    transaction ID of an Authorization Only transaction.

To submit a Prior Authorization Capture request, set
the transactionType element to priorAuthCaptureTransaction in
the [createTransactionRequest](https://developer.authorize.net/api/reference/#payment-transactions-capture-a-previously-authorized-amount) API
call.

In addition, specify the transaction ID of the original Authorize Only
transaction in the refTransId element.

For the Prior Authorization Capture transaction type, the amount element
is required only if capturing less than the amount of the original
Authorization Only transaction. If no amount is submitted, Authorize.net
settles the transaction for the original authorization amount.

**Capture Only**

The transaction uses an authorization code that was not obtained through
the payment gateway, such as an authorization code obtained through a
voice authorization center.

To submit a Prior Authorization Capture request, set
the transactionType element to captureOnlyTransaction in
the [createTransactionRequest](https://developer.authorize.net/api/reference/#payment-transactions-capture-funds-authorized-through-another-channel) API
call.

In addition, specify the authorization code in the authCode element.

**Void**

The transaction specified in the refTransId element is canceled before
settlement. Once a transaction settles, it cannot be voided. Funds on a
voided transaction can be held briefly by the issuing bank, depending on
the issuing bank\'s policy, and then returned to the customer\'s
available balance.

To submit a Void request, set the transactionType element
to voidTransaction in
the [createTransactionRequest](https://developer.authorize.net/api/reference/#payment-transactions-void-a-transaction) API
call.

In addition, specify the transaction that you wish to void by passing
the transaction ID in the refTransId element.

**Credit**

The transaction specified in the refTransId element is refunded after
settlement. A credit is a new and distinct transaction from the original
charge with its own unique transaction ID. Merchants can submit credits
against settled transactions in amounts up to the original capture
amount. By default, the merchant can refund a settled transaction within
180 days of settlement.

Important: You may issue credits with the amount element set to any
amount up to the originally settled amount. For example, merchants can
issue partial credits if they are unable to fulfill the complete order
prior to settlement.

To submit a Credit request, set the transactionType element
to refundTransaction in
the [createTransactionRequest](https://developer.authorize.net/api/reference/#payment-transactions-refund-a-transaction) API
call.

In addition, specify the transaction that you wish to refund by passing
the transaction ID in the refTransId element.

Important: Some refund transactions processed by FDC Nashville merchants
may be subject to the [[Purchase Return Authorization (PRA)
Mandate]{.underline}](https://developer.authorize.net/api/reference/features/pra-mandate.html).

**Transaction Settings**

All [createTransactionRequest](https://developer.authorize.net/api/reference/#payment-transactions) calls
support optional per-transaction settings, such as email receipt
delivery, split tender, or duplication checks. You submit these
per-transaction settings through the transactionSettings element, using
pairs of settingName and settingValue child elements. The valid values
for settingName and their usages are listed below.

+-----------------+-------------------------------------+--------------+
| **settingName   | **Description**                     | **           |
| Value**         |                                     | settingValue |
|                 |                                     | Format**     |
+=================+=====================================+==============+
| emailCustomer   | Flags whether to send the customer  | Boolean.     |
|                 | email receipt.                      |              |
+-----------------+-------------------------------------+--------------+
| hea             | Text for header of customer email   | String. HTML |
| derEmailReceipt | receipt.                            | not          |
|                 |                                     | supported.   |
+-----------------+-------------------------------------+--------------+
| foo             | Text for footer of customer email   | String. HTML |
| terEmailReceipt | receipt.                            | not          |
|                 |                                     | supported.   |
+-----------------+-------------------------------------+--------------+
| a               | Flags whether to allow partial      | Boolean.     |
| llowPartialAuth | authorization on this transaction   |              |
|                 | request as part of a split tender   |              |
|                 | sale.                               |              |
+-----------------+-------------------------------------+--------------+
| duplicateWindow | Time in seconds to check for        | String.      |
|                 | subsequent duplicate requests of    | Maximum      |
|                 | this transaction. Use to help       | value =      |
|                 | prevent accidental double-billing.  | 28800 (8     |
|                 |                                     | hours).      |
+-----------------+-------------------------------------+--------------+
| r               | Recurring payment indicator.        | Boolean.     |
| ecurringBilling |                                     |              |
|                 | Use only if your software generated |              |
|                 | the recurring payments. Your        |              |
|                 | Merchant Service Provider might     |              |
|                 | require you to                      |              |
|                 | submit recurringBilling for         |              |
|                 | software-generated recurring        |              |
|                 | payments.                           |              |
|                 |                                     |              |
|                 | Se                                  |              |
|                 | tting recurringBilling to TRUE does |              |
|                 | not create subscriptions in your    |              |
|                 | account\'s recurring billing setup. |              |
|                 | See the [[Recurring                 |              |
|                 | Billing]{.underline}](htt           |              |
|                 | ps://developer.authorize.net/api/re |              |
|                 | ference/#recurring-billing) section |              |
|                 | of the API Reference for details on |              |
|                 | how to create a subscription for    |              |
|                 | recurring payments.                 |              |
+-----------------+-------------------------------------+--------------+

**Retail Transactions**

Authorize.net supports retail transactions, which vary from e-commerce
transactions as follows.

-   Retail transactions rely on track data obtained from either the
    card\'s EMV chip or from the magnetic stripe on the back of the
    card. While it is possible to submit a retail transaction using the
    card number and expiration date, merchant banks typically require
    track data for favorable retail rates.

-   A market type and device type indicate that the transaction is a
    retail transaction submitted through a device permitted by the
    merchant bank. For example, the merchant bank might approve the
    merchant for payments made through a kiosk, but not through an
    electronic cash register.

-   Retail transactions support partial authorizations for split-tender
    orders.

**Market Type and Device Type**

For retail transactions submitted with track data, you must set
the marketType element to 2 and also submit the deviceTypeelement.

Available values for deviceType are listed below.

  -----------------------------------------------------------------------
  **deviceType Value**             **Description**
  -------------------------------- --------------------------------------
  1                                Unknown device type

  2                                Unattended terminal

  3                                Self-service terminal

  4                                Electronic cash register

  5                                PC-based terminal

  7                                Wireless POS terminal

  8                                Website

  9                                Dial terminal

  1                                Virtual Terminal
  -----------------------------------------------------------------------

**Partial Authorization**

Partial authorization transactions allow split-tender orders so that a
customer can pay for one order with more than one payment card.

In the request, set allowPartialAuth to true to indicate that the
merchant\'s system can process partial authorizations.
Without allowPartialAuth, the transaction will be either authorized for
the full amount, or declined due to lack of funds on the card.

If the first transaction is successfully approved for a partial amount
of the total order, a split-tender ID is generated and returned to the
merchant in the response. This ID must be passed back with each of the
remaining transactions of the group, using the splitTenderId element.

Important: If you include both a split-tender ID and a transaction ID on
the same request, an error results.

All transactions grouped under a split-tender ID are not captured until
the final transaction of the group is successfully authorized.

If the merchant needs to capture the group of transactions before the
final transaction is approved---if the balance is paid by cash, for
example---send
an [updateSplitTenderGroupRequest](http://developer.authorize.net/api/reference/#payment-transactions-update-split-tender-group) request
and include the split-tender ID instead of a transaction ID. In this
case, you would also submit the splitTenderStatus element with a value
of completed.

If the merchant needs to void the group before completion, send a [[void
request]{.underline}](https://developer.authorize.net/api/reference/#payment-transactions-void-a-transaction) using
the split-tender ID instead of a transaction ID.

The transactions in a group are not captured for settlement until either
the merchant submits payments adding up to the full requested amount or
until the merchant indicates that the payment is complete by submitting
the splitTenderStatus element with a value of completed.

Unique elements that apply to partial authorization transactions are:

  ------------------------------------------------------------------------------
  **Element Name**    **API Call**                **Description**
  ------------------- --------------------------- ------------------------------
  allowPartialAuth    createTransactionRequest    (Optional) Indicates whether
                                                  to permit partial
                                                  authorization for this
                                                  transaction. This value
                                                  overrides the Merchant
                                                  Interface setting, which is
                                                  disabled by default.

  balanceOnCard       createTransactionResponse   The available balance
                                                  remaining on the card.

  requestedAmount     createTransactionResponse   The originally requested
                                                  amount of the order.

  splitTenderId       createTransactionResponse   The split-tender ID provided
                                                  in the response received for
                                                  the first partial
                                                  authorization. Use this ID
                                                  when submitting subsequent
                                                  transactions related to the
                                                  same order.

  splitTenderStatus   createTransactionResponse   The status of the split-tender
                                                  order as a whole. Possible
                                                  values are: completed, held,
                                                  or voided.
  ------------------------------------------------------------------------------

**Testing Partial Authorization in the Sandbox Environment**

See the [[Generating Card
Responses]{.underline}](https://developer.authorize.net/hello_world/testing_guide/#Generating_Card_Responses) section
of the Testing Guide for details on how to simulate partial
authorization scenarios in the sandbox.

**Basic Fraud Settings**

**AVS**

The Address Verification Service (AVS) is a system provided by issuing
banks and card associations to help identify suspicious payment card
activity for e-commerce transactions. AVS matches portions of the
customer\'s billing address, as provided by the merchant, against the
billing address on file with the issuing bank. The issuing bank, through
the merchant\'s processing network, sends AVS data indicating the
results to Authorize.net, which stores and uses the single-letter AVS
response code for display and optional filtering. The AVS response code
can be found in
the [createTransactionResponse](https://developer.authorize.net/api/reference/#payment-transactions)API
call. Based on the merchant\'s AVS rejection settings, the transaction
is accepted or rejected.

Rejected transactions display a transaction status of \"Declined (AVS
Mismatch)\" on the Transaction Detail page in the Merchant Interface,
and receive a [[Response Reason Code of
27]{.underline}](https://developer.authorize.net/api/reference/responseCodes.html?code=27).
The merchant cannot retrieve address information from the issuing bank;
the bank provides only a response indicating whether the street
address\'s house number and postal code match. Due to potential
misspellings and alternate address format conventions, issuing banks
typically ignore text portions of the billing address during AVS checks.

To implement AVS, the merchant must require the Address and ZIP fields
on their payment form. To manage AVS rejection settings, log in to the
Merchant Interface and choose Account \> Settings \> Security Settings
\> Basic Fraud Settings \> AVS.

**Card Code Verification (CCV)**

This feature compares the card code submitted by the customer with the
card code on file with the issuing bank. Filter settings in the Merchant
Interface allow the merchant to reject transactions based on the CCV
response received. To implement CCV, the merchant must require the
\"Card Code\" field on their payment form.

To manage rejection settings, log in to the Merchant Interface and
choose Account \> Settings \> Security Settings \> Basic Fraud Settings
\> CCV.

Visa refers to the card code as a Card Verification Value 2 (CVV2);
Mastercard uses Card Validation Code 2 (CVC2); and Discover and American
Express use Card Identification Number (CID).

For security reasons, Authorize.net does not store the card code data.
If you configure a fraud or velocity rule in the Advanced Fraud
Detection Suite with the action, \"Do not authorize, but hold for
review,\" the card code of the transactions flagged by this rule cannot
be validated when you approve the transaction later. Authorize.net
recommends that merchants who wish to validate CCV use the action,
\"Authorize and hold for review,\" instead of \"Do not authorize, but
hold for review.\"

**Daily Velocity Filter**

The Daily Velocity Filter enables merchants to specify a threshold for
the number of transactions allowed per day. All transactions exceeding
the threshold for that day are flagged and processed according to the
selected filter action. This filter is helpful in preventing certain
types of fraudulent activity on the merchant\'s account.

To configure the Daily Velocity Filter, log in to the Merchant Interface
and choose Account \> Settings \> Security Settings \> Basic Fraud
Settings \> Daily Velocity.

**Retrieving, Approving, and Declining Held Transactions**

The Authorize.net Merchant Interface provides access to the Advanced
Fraud Detection Suite (AFDS) for merchants who sign up. The
Authorize.net API implements some AFDS functions for retrieving,
approving, or declining suspicious transactions that are being held for
review. To see the reference information for those requests, see
the [[Fraud
Management]{.underline}](http://developer.authorize.net/api/reference/index.html#fraud-management) section
of the API Reference.

**Compliance**

The Payment Card Industry Data Security Standard (PCI DSS) is a set of
requirements designed to ensure that all companies that process, store,
or transmit payment card information maintain a secure environment. By
following PCI DSS, you assure your merchants that they have a solid
foundation for accepting secure payments. For more information, see
the [[PCI Security Standards
page]{.underline}](https://www.pcisecuritystandards.org/pci_security/maintaining_payment_security) and
the Authorize.net blog post on [[understanding PCI
compliance]{.underline}](http://www.authorize.net/resources/blog/understanding-pci-compliance/).

The following video explains more about payment industry security
standards. 

![Authorize.Net](media/image1.jpeg){width="2.5in"
height="0.5736111111111111in"}

[**[Visa]{.underline}**](https://usa.visa.com/legal/privacy-policy.html)

[**[Cybersource.com]{.underline}**](https://policy.cookiereports.com/40b0dfe0-en-gb.html)

[**[Privacy]{.underline}**](https://policy.cookiereports.com/40b0dfe0-en-gb.html)

[**[Ad
prefernces]{.underline}**](https://policy.cookiereports.com/40b0dfe0-en-gb.html)

[**[Cookie
policy]{.underline}**](https://policy.cookiereports.com/40b0dfe0-en-gb.html)

[**[Terms and
conditions]{.underline}**](https://www.authorize.net/about-us/terms.html)

© 2019-2022. Authorize.net. All rights reserved. All brand names and
logos are the property of their respective owners, are used for
identification purposes only, and do not imply product endorsement or
affiliation with Authorize.net.

##      API Documents  **Accept Suite**

Authorize.net Accept is a suite of developer tools for building websites
and mobile applications without increasing PCI burden for merchants. It
offers a range of integration options, including JavaScript libraries,
mobile SDKs and hosted forms.

**Create an Accept Payment Transaction**

Use this function to create an Authorize.net payment transaction
request, using the Accept Payment nonce in place of card data.

-   [**[API LIVE
    CONSOLE]{.underline}**](https://developer.authorize.net/api/reference/index.html#console-create-an-accept-payment-transaction)

-   [**[PHP]{.underline}**](https://developer.authorize.net/api/reference/index.html#php-create-an-accept-payment-transaction)

-   [**[CS]{.underline}**](https://developer.authorize.net/api/reference/index.html#cs-create-an-accept-payment-transaction)

-   [**[JAVA]{.underline}**](https://developer.authorize.net/api/reference/index.html#java-create-an-accept-payment-transaction)

-   [**[RUBY]{.underline}**](https://developer.authorize.net/api/reference/index.html#ruby-create-an-accept-payment-transaction)

-   [**[PYTHON]{.underline}**](https://developer.authorize.net/api/reference/index.html#python-create-an-accept-payment-transaction)

-   [**[NODE]{.underline}**](https://developer.authorize.net/api/reference/index.html#node-create-an-accept-payment-transaction)

Top of Form

**Request:**  

{

\"createTransactionRequest\": {

\"merchantAuthentication\": {

\"name\": \"3685u9pF3K3\",

\"transactionKey\": \"89AN2cMJWjv795Uz\"

},

\"refId\": \"123456\",

\"transactionRequest\": {

\"transactionType\": \"authCaptureTransaction\",

\"amount\": \"5\",

\"payment\": {

\"opaqueData\": {

\"dataDescriptor\": \"COMMON.ACCEPT.INAPP.PAYMENT\",

\"dataValue\":
\"1234567890ABCDEF1111AAAA2222BBBB3333CCCC4444DDDD5555EEEE6666FFFF7777888899990000\"

}

},

\"lineItems\": {

\"lineItem\": {

\"itemId\": \"1\",

\"name\": \"vase\",

\"description\": \"Cannes logo\",

\"quantity\": \"18\",

\"unitPrice\": \"45.00\"

}

},

\"poNumber\": \"456654\",

\"billTo\": {

\"firstName\": \"Ellen\",

\"lastName\": \"Johnson\",

\"company\": \"Souveniropolis\",

\"address\": \"14 Main Street\",

\"city\": \"Pecan Springs\",

\"state\": \"TX\",

\"zip\": \"44628\",

\"country\": \"US\"

},

\"shipTo\": {

\"firstName\": \"China\",

\"lastName\": \"Bayles\",

\"company\": \"Thyme for Tea\",

\"address\": \"12 Main Street\",

\"city\": \"Pecan Springs\",

\"state\": \"TX\",

\"zip\": \"44628\",

\"country\": \"US\"

},

\"customerIP\": \"192.168.1.1\",

\"userFields\": {

\"userField\": \[

{

\"name\": \"MerchantDefinedFieldName1\",

\"value\": \"MerchantDefinedFieldValue1\"

},

{

\"name\": \"favorite_color\",

\"value\": \"blue\"

}

\]

}

}

}

}

 

Bottom of Form

**Response:**

{

\"transactionResponse\": {

\"responseCode\": \"1\",

\"authCode\": \"2768NO\",

\"avsResultCode\": \"Y\",

\"cvvResultCode\": \"P\",

\"cavvResultCode\": \"2\",

\"transId\": \"60006537898\",

\"refTransID\": \"\",

\"transHash\": \"B3BDC21A6B341938D8F1927492F4D516\",

\"accountNumber\": \"XXXX0005\",

\"accountType\": \"AmericanExpress\",

\"messages\": \[

{

\"code\": \"1\",

\"description\": \"This transaction has been approved.\"

}

\],

\"userFields\": \[

{

\"name\": \"MerchantDefinedFieldName1\",

\"value\": \"MerchantDefinedFieldValue1\"

},

{

\"name\": \"favorite_color\",

\"value\": \"blue\"

}

\],

\"transHashSha2\": \"\"

},

\"refId\": \"123456\",

\"messages\": {

\"resultCode\": \"Ok\",

\"message\": \[

{

\"code\": \"I00001\",

\"text\": \"Successful.\"

}

\]

}

}

**REQUEST FIELD DESCRIPTION**

*createTransactionRequest*

  -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  **Element**                     **Description**                                                                                                                         **Format**
  ------------------------------- --------------------------------------------------------------------------------------------------------------------------------------- -------------------------------------------------------------------------------------------------------------------------------------
  **merchantAuthentication**      **Required.**\                                                                                                                          
                                  Contains merchant authentication information.                                                                                           

  name                            **Required.**\                                                                                                                          String, up to 25 characters.
                                  Merchant's unique API Login ID.\                                                                                                        
                                  \                                                                                                                                       
                                  The merchant API Login ID is provided in the Merchant Interface and must be stored securely.\                                           
                                  \                                                                                                                                       
                                  The API Login ID and Transaction Key together provide the merchant authentication required for access to the payment gateway.           

  transactionKey                  **Required.**\                                                                                                                          String, up to 16 characters.
                                  Merchant's unique Transaction Key.\                                                                                                     
                                  \                                                                                                                                       
                                  The merchant Transaction Key is provided in the Merchant Interface and must be stored securely.\                                        
                                  \                                                                                                                                       
                                  The API Login ID and Transaction Key together provide the merchant authentication required for access to the payment gateway.           

  refId                           Merchant-assigned reference ID for the request.\                                                                                        String, up to 20 characters.
                                  \                                                                                                                                       
                                  If included in the request, this value is included in the response. This feature might be especially useful for multi-threaded          
                                  applications.                                                                                                                           

  transactionRequest              **Required.**\                                                                                                                          
                                  This element is a container for transaction specific information.                                                                       

  transactionType                 Type of credit card transaction.\                                                                                                       String.\
                                  \                                                                                                                                       \
                                  If the value submitted does not match a supported value, the transaction is rejected.                                                   Use authCaptureTransactionto authorize and automatically capture the transaction, or use authOnlyTransaction to authorize the
                                                                                                                                                                          transaction for capture at a later time.

  amount                          **Required.**\                                                                                                                          Decimal, up to 15 digits with a decimal point.\
                                  Amount of the transaction.\                                                                                                             \
                                  \                                                                                                                                       Do not use currency symbols.\
                                  This is the total amount and must include tax, shipping, tips, and any other charges.                                                   \
                                                                                                                                                                          For example, 8.95.

  payment                         This element contains payment information.                                                                                              

  opaqueData                      **Required.**\                                                                                                                          
                                  Contains dataDescriptor and dataValue.                                                                                                  

  dataDescriptor                  **Required.**\                                                                                                                          String, 128 characters.\
                                  Specifies how the request should be processed.\                                                                                         \
                                  \                                                                                                                                       Use COMMON.ACCEPT.INAPP.PAYMENTfor Accept transactions.
                                  The value of dataDescriptor is based on the source of the value of dataValue.                                                           

  dataValue                       **Required.**\                                                                                                                          String, 8192 characters.
                                  Base64 encoded data that contains encrypted payment data, known as the payment nonce. The nonce is valid for 15 minutes.\               
                                  \                                                                                                                                       
                                  The payment gateway expects the encrypted payment data and meta data for the encryption keys.                                           

  solution                        Contains information about the software that generated the transaction.                                                                 

  id                              The unique Solution ID which you generate and associate with your solution through the [[Partner                                        String, up to 50 characters.
                                  Interface]{.underline}](https://account.authorize.net/interfaces/reseller/frontend/login.aspx).\                                        
                                  \                                                                                                                                       
                                  See the [[Solution ID Implementation Guide]{.underline}](https://developer.authorize.net/api/solution_id/)for details.                  

  name                            The name is generated by the solution provider and provided to Authorize.net.\                                                          String, up to 255 characters.
                                  \                                                                                                                                       
                                  See the [[Solution ID Implementation Guide]{.underline}](https://developer.authorize.net/api/solution_id/)for details.                  

  terminalNumber                  The merchant\'s in-store terminal number. Can identify the cashiers or kiosks used.\                                                    String.
                                  \                                                                                                                                       
                                  Do not use your processor\'s terminal ID for this field.                                                                                

  order                           Contains information about the order.                                                                                                   

  invoiceNumber                   Merchant-defined invoice number associated with the order.\                                                                             String, up to 20 characters.
                                  \                                                                                                                                       
                                  Worldpay RAFT 610 merchants can view the invoice number in the Worldpay Reporting Portal.                                               

  description                     Description of the item purchased.                                                                                                      String, up to 255 characters.

  lineItems                       Contains one or more lineItemelements, up to a maximum of 30 line items.                                                                

  lineItem                        Contains information about one item.                                                                                                    

  itemId                          Item identification.                                                                                                                    String, up to 31 characters.

  name                            The human-readable name for the item.                                                                                                   String, up to 31 characters.

  description                     A description of the item.                                                                                                              String, up to 255 characters.

  quantity                        The quantity of items sold.                                                                                                             Decimal, up to four decimal places.\
                                                                                                                                                                          \
                                                                                                                                                                          For example, 5.4321.

  unitPrice                       The cost per unit, excluding tax, freight, and duty.                                                                                    Decimal, up to four decimal places.\
                                                                                                                                                                          \
                                                                                                                                                                          For example, 5.4321.

  taxable                         Indicates whether the item is taxable.                                                                                                  Boolean.\
                                                                                                                                                                          \
                                                                                                                                                                          Either true or false.

  tax                             Contains information about applicable taxes.                                                                                            

  amount                          Amount of tax.\                                                                                                                         Decimal, up to four decimal places.\
                                  \                                                                                                                                       \
                                  The total transaction amount must include this value.                                                                                   For example, 5.4321.

  name                            Name of tax.                                                                                                                            String, up to 31 characters.

  description                     Description of tax.                                                                                                                     String, up to 255 characters.

  duty                            Contains information about any duty applied.                                                                                            

  amount                          Amount of duty.\                                                                                                                        Decimal, up to four decimal places.\
                                  \                                                                                                                                       \
                                  The total transaction amount must include this value.                                                                                   For example, 5.4321.

  name                            Name of duty.                                                                                                                           String, up to 31 characters.

  description                     Description of duty.                                                                                                                    String, up to 255 characters.

  shipping                        Items in this element describe shipping charges applied.                                                                                

  amount                          Amount of the shipping charges.\                                                                                                        Decimal, up to four decimal places.\
                                  \                                                                                                                                       \
                                  The total transaction amount must include this value.                                                                                   For example, 5.4321.

  name                            Name of the shipping charges.                                                                                                           String, up to 31 characters.

  description                     Description of the shipping charges.                                                                                                    String, up to 255 characters.

  taxExempt                       Indicates whether or not order is exempt from tax.                                                                                      Boolean.\
                                                                                                                                                                          \
                                                                                                                                                                          Either true or false.

  poNumber                        The merchant-assigned purchase order number.\                                                                                           String, up to 25 characters.\
                                  \                                                                                                                                       \
                                  If you use purchase order numbers, your solution should generate the purchase order number and send it with your transaction requests.  Use alphanumeric characters only, without spaces, dashes, or other symbols.
                                  Authorize.net does not generate purchase order numbers.                                                                                 

  customer                        The following fields contain customer information.                                                                                      

  type                            Type of customer.                                                                                                                       String.\
                                                                                                                                                                          \
                                                                                                                                                                          Either individual or business.

  id                              The unique customer ID used to represent the customer associated with the transaction.\                                                 String, up to 20 characters.\
                                  \                                                                                                                                       \
                                  If you use customer IDs, your solution should generate the customer ID and send it with your transaction requests. Authorize.net does   Use alphanumeric characters only, without spaces, dashes, or other symbols.
                                  not generate customer IDs.                                                                                                              

  email                           **Conditional.**\                                                                                                                       String, up to 255 characters.\
                                  \                                                                                                                                       \
                                  The customer's valid email address.\                                                                                                    For example, janedoe@example.com.
                                  \                                                                                                                                       
                                  Required only when using a [[European payment                                                                                           
                                  processor.]{.underline}](https://developer.authorize.net/api/reference/features/payment-transactions.html#Payment_Processors)\          
                                  \                                                                                                                                       
                                  If you enable Email Receipts in the Merchant Interface, and if the email address format is valid, the customer will receive an          
                                  Authorize.net generated email receipt.                                                                                                  

  billTo                          This element contains billing address information.\                                                                                     
                                  \                                                                                                                                       
                                  If EVO is your payment processor and you submit any of the following billTo fields, you must submit all of them.\                       
                                  \                                                                                                                                       
                                  firstName\                                                                                                                              
                                  lastName\                                                                                                                               
                                  address\                                                                                                                                
                                  city\                                                                                                                                   
                                  state\                                                                                                                                  
                                  zip                                                                                                                                     

  firstName                       **Conditional.**\                                                                                                                       String, up to 50 characters.
                                  \                                                                                                                                       
                                  First name associated with customer's billing address.\                                                                                 
                                  \                                                                                                                                       
                                  Required only when using a [[European payment                                                                                           
                                  processor.]{.underline}](https://developer.authorize.net/api/reference/features/payment-transactions.html#Payment_Processors)           

  lastName                        **Conditional.**\                                                                                                                       String, up to 50 characters.
                                  \                                                                                                                                       
                                  Last name associated with customer's billing address.\                                                                                  
                                  \                                                                                                                                       
                                  Required only when using a [[European payment                                                                                           
                                  processor.]{.underline}](https://developer.authorize.net/api/reference/features/payment-transactions.html#Payment_Processors)           

  company                         Company associated with customer's billing address.                                                                                     String, up to 50 characters.

  address                         **Conditional.**\                                                                                                                       String, up to 60 characters.
                                  \                                                                                                                                       
                                  Customer's billing address.\                                                                                                            
                                  \                                                                                                                                       
                                  Required if merchant would like to use the Address Verification Service security feature.\                                              
                                  \                                                                                                                                       
                                  Required when using GPN Canada or Worldpay Streamline Processing Platform.                                                              

  city                            **Conditional.**\                                                                                                                       String, up to 40 characters.
                                  \                                                                                                                                       
                                  City of customer's billing address.\                                                                                                    
                                  \                                                                                                                                       
                                  Required only when using a [[European payment                                                                                           
                                  processor.]{.underline}](https://developer.authorize.net/api/reference/features/payment-transactions.html#Payment_Processors)           

  state                           **Conditional.**\                                                                                                                       String, up to 40 characters.\
                                  \                                                                                                                                       \
                                  State of customer's billing address.\                                                                                                   For US states, use the [[USPS two-character abbreviation]{.underline}](https://pe.usps.com/text/pub28/28apb.htm) for the state.
                                  \                                                                                                                                       
                                  Required only when using a [[European payment                                                                                           
                                  processor.]{.underline}](https://developer.authorize.net/api/reference/features/payment-transactions.html#Payment_Processors)           

  zip                             **Conditional.**\                                                                                                                       String, up to 20 characters.
                                  \                                                                                                                                       
                                  The postal code of customer's billing address.\                                                                                         
                                  \                                                                                                                                       
                                  Required if merchant would like to use the Address Verification Service security feature.\                                              
                                  \                                                                                                                                       
                                  Required when using GPN Canada or Worldpay Streamline Processing Platform.                                                              

  country                         Country of customer's billing address.                                                                                                  String, up to 60 characters.\
                                                                                                                                                                          \
                                                                                                                                                                          Use the [[ISO 3166 alpha-2
                                                                                                                                                                          code]{.underline}](https://developer.cybersource.com/library/documentation/dev_guides/SmallBusiness/Intershop_NT/html/appB.html)for
                                                                                                                                                                          the country.

  phoneNumber                     Phone number associated with customer's billing address.                                                                                String, up to 25 characters.\
                                                                                                                                                                          \
                                                                                                                                                                          For example, (123) 555-1234.

  faxNumber                       Fax number associated with customer's billing address.                                                                                  String, up to 25 characters.\
                                                                                                                                                                          \
                                                                                                                                                                          For example, (123) 555-1234.

  shipTo                          This element contains shipping information.\                                                                                            
                                  \                                                                                                                                       
                                  If EVO is your payment processor and you submit any of the following shipTo fields, you must submit all of them.\                       
                                  \                                                                                                                                       
                                  firstName\                                                                                                                              
                                  lastName\                                                                                                                               
                                  address\                                                                                                                                
                                  city\                                                                                                                                   
                                  state\                                                                                                                                  
                                  zip                                                                                                                                     

  firstName                       First name associated with customer's shipping address.                                                                                 String, up to 50 characters.

  lastName                        Last name associated with customer's shipping address.                                                                                  String, up to 50 characters.

  company                         Company associated with customer's shipping address.                                                                                    String, up to 50 characters.

  address                         Customer's shipping address.                                                                                                            String, up to 60 characters.

  city                            City of customer's shipping address.                                                                                                    String, up to 40 characters.

  state                           State of customer's shipping address.                                                                                                   String, up to 40 characters.\
                                                                                                                                                                          \
                                                                                                                                                                          For US states, use the [[USPS two-character abbreviation]{.underline}](https://pe.usps.com/text/pub28/28apb.htm) for the state.

  zip                             The postal code of customer's shipping address.                                                                                         String, up to 20 characters.

  country                         Country of customer's shipping address.                                                                                                 String, up to 60 characters.

  customerIP                      **Conditional.**\                                                                                                                       String, up to 15 characters.\
                                  \                                                                                                                                       \
                                  The IPv4 address of the customer initiating the transaction. Defaults to 255.255.255.255 if not included in your request.\              Use dot-decimal formatting.\
                                  \                                                                                                                                       \
                                  Required only when the merchant is using customer IP based AFDS filters.                                                                For example, 255.255.255.255.

  cardholderAuthentication        **Important:** This field is deprecated and should not be used.\                                                                        
                                  \                                                                                                                                       
                                  Merchants using a third party cardholder authentication solution can submit the following authentication values with Visa and           
                                  Mastercard transactions.\                                                                                                               
                                  \                                                                                                                                       
                                  Invalid combinations of card type, authenticationIndicator, and cardholderAuthenticationValue will result in Response Reason Code 118.  

  authenticationIndicator         **Conditional.**\                                                                                                                       String.
                                  \                                                                                                                                       
                                  **Important:** This field is deprecated and should not be used.\                                                                        
                                  \                                                                                                                                       
                                  The Electronic Commerce Indicator (ECI) value for a Visa transaction, or the Universal Cardholder Authentication Field indicator (UCAF) 
                                  for a Mastercard transaction. The cardholder authentication process generates the ECI or UCAF value prior to submitting the             
                                  transaction.\                                                                                                                           
                                  \                                                                                                                                       
                                  Required only for authorizationOnlyTransaction and authCaptureTransaction requests processed through 3D Secure cardholder               
                                  authentication programs, such as Visa Secure or Mastercard Identity Check. When submitted with other values for transactionValue, this  
                                  element is ignored.\                                                                                                                    
                                  \                                                                                                                                       
                                  Invalid values of authenticationIndicator will result in Response Reason Code 116.\                                                     
                                  \                                                                                                                                       
                                  This field is currently supported through Chase Paymentech, FDMS Nashville, Global Payments and TSYS.                                   

  cardholderAuthenticationValue   **Conditional.**\                                                                                                                       String.
                                  \                                                                                                                                       
                                  **Important:** This field is deprecated and should not be used.\                                                                        
                                  \                                                                                                                                       
                                  The Cardholder Authentication Verification Value (CAVV) for a Visa transaction, or Accountholder Authentication Value (AVV)/ Universal  
                                  Cardholder Authentication Field indicator (UCAF) for a Mastercard transaction. The cardholder authentication process generates the      
                                  CAVV, AAV, or UCAF value prior to submitting the transaction.\                                                                          
                                  \                                                                                                                                       
                                  Required only for authorizationOnlyTransaction and authCaptureTransaction requests processed through 3D Secure cardholder               
                                  authentication programs, such as Visa Secure or Mastercard Identity Check. When submitted with other values for transactionValue, this  
                                  element is ignored.\                                                                                                                    
                                  \                                                                                                                                       
                                  Invalid values of cardholderAuthenticationValue will result in Response Reason Code 117.\                                               
                                  \                                                                                                                                       
                                  This field is currently supported through Chase Paymentech, FDMS Nashville, Global Payments and TSYS.                                   

  employeeId                      Merchant-assigned employee ID.\                                                                                                         Numeric string, 4 digits. Defaults to 0000.
                                  \                                                                                                                                       
                                  This field is required for the EVO processor, and is supported on the TSYS processor.                                                   

  transactionSettings             This element contains one or more setting elements.                                                                                     

  setting                         Contains settingName and settingValue.                                                                                                  

  settingName                     Name of a specific setting to be modified for this transaction.\                                                                        String.\
                                  \                                                                                                                                       \
                                  For a list of valid settingName values and their uses, please see the [[Transaction                                                     One of the following:\
                                  Settings]{.underline}](https://developer.authorize.net/api/reference/features/payment-transactions.html#Transaction_Settings) section   allowPartialAuth\
                                  of the Payment Transactions page.                                                                                                       duplicateWindow\
                                                                                                                                                                          emailCustomer\
                                                                                                                                                                          headerEmailReceipt\
                                                                                                                                                                          footerEmailReceipt\
                                                                                                                                                                          recurringBilling

  settingValue                    Indicates whether the specified setting is enabled or disabled.\                                                                        String.\
                                  \                                                                                                                                       \
                                  For a list of permitted settingValueformats, please see the [[Transaction                                                               Permitted values depend on the value of settingName.
                                  Settings]{.underline}](https://developer.authorize.net/api/reference/features/payment-transactions.html#Transaction_Settings) section   
                                  of the Payment Transactions page.                                                                                                       

  userFields                      These elements may be used to pass through information, such as session IDs and order details. The merchant will receive these elements 
                                  in the response, exactly as it was submitted in the request. Authorize.net will not store these values.\                                
                                  \                                                                                                                                       
                                  Do not use these fields to pass through sensitive details as doing so may be a violation of the PCI Data Security Standard.\            
                                  \                                                                                                                                       
                                  Worldpay RAFT 610 merchants can view the first two **userField** elements in the Worldpay Reporting Portal.                             

  userField                       The element for individual user-defined fields. Contains the name and value child elements.\                                            String.
                                  \                                                                                                                                       
                                  Up to 20 userField elements may be submitted per request.                                                                               

  name                            Name of the user-defined field.\                                                                                                        String.
                                  \                                                                                                                                       
                                  User reference field provided for the merchant's use. The merchant will receive this field in the response, exactly as it was submitted 
                                  in the request. Authorize.net will not store this value.                                                                                

  value                           Value of the user-defined field.\                                                                                                       String.
                                  \                                                                                                                                       
                                  User reference field provided for the merchant's use. The merchant will receive this field in the response, exactly as it was submitted 
                                  in the request. Authorize.net will not store this value.                                                                                

  surcharge                       Used to record payment card surcharges that are passed along to customers. Contains an amount and a descriptionchild element.\          
                                  \                                                                                                                                       
                                  Currently supported for TSYS merchants.\                                                                                                
                                  \                                                                                                                                       
                                  For details on surcharge rules, please see [[Visa\'s merchant regulations and                                                           
                                  fees.]{.underline}](https://www.visa.com/merchantsurcharging)                                                                           

  amount                          Amount of the surcharge.\                                                                                                               Decimal, up to 15 digits with a decimal point.\
                                  \                                                                                                                                       \
                                  Currently supported for TSYS merchants.\                                                                                                Do not use currency symbols.\
                                  \                                                                                                                                       \
                                  For details on surcharge rules, please see [[Visa\'s merchant regulations and                                                           For example, 8.95.
                                  fees.]{.underline}](https://www.visa.com/merchantsurcharging)                                                                           

  description                     Describes the reason or details for the surcharge.\                                                                                     String, up to 255 characters.
                                  \                                                                                                                                       
                                  Currently supported for TSYS merchants.\                                                                                                
                                  \                                                                                                                                       
                                  For details on surcharge rules, please see [[Visa\'s merchant regulations and                                                           
                                  fees.]{.underline}](https://www.visa.com/merchantsurcharging)                                                                           

  tip                             The amount of the tip authorized by the cardholder.\                                                                                    Decimal, up to 15 digits with a decimal point.\
                                  \                                                                                                                                       \
                                  The total transaction amount must include this value.                                                                                   Do not use currency symbols.\
                                                                                                                                                                          \
                                                                                                                                                                          For example, 8.95.
  -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

**RESPONSE FIELD DESCRIPTION**

**Get Accept Customer Profile Page**

Use this function to initiate a request for direct access to the
Authorize.net website.

-   [**[API LIVE
    CONSOLE]{.underline}**](https://developer.authorize.net/api/reference/index.html#console-get-accept-customer-profile-page)

-   [**[PHP]{.underline}**](https://developer.authorize.net/api/reference/index.html#php-get-accept-customer-profile-page)

-   [**[CS]{.underline}**](https://developer.authorize.net/api/reference/index.html#cs-get-accept-customer-profile-page)

-   [**[JAVA]{.underline}**](https://developer.authorize.net/api/reference/index.html#java-get-accept-customer-profile-page)

-   [**[RUBY]{.underline}**](https://developer.authorize.net/api/reference/index.html#ruby-get-accept-customer-profile-page)

-   [**[PYTHON]{.underline}**](https://developer.authorize.net/api/reference/index.html#python-get-accept-customer-profile-page)

-   [**[NODE]{.underline}**](https://developer.authorize.net/api/reference/index.html#node-get-accept-customer-profile-page)

Top of Form

**Request:**  

{

\"getHostedProfilePageRequest\": {

\"merchantAuthentication\": {

\"name\": \"3685u9pF3K3\",

\"transactionKey\": \"89AN2cMJWjv795Uz\"

},

\"customerProfileId\": \"YourProfileID\",

\"hostedProfileSettings\": {

\"setting\": \[

{

\"settingName\": \"hostedProfileReturnUrl\",

\"settingValue\": \"https://returnurl.com/return/\"

},

{

\"settingName\": \"hostedProfileReturnUrlText\",

\"settingValue\": \"Continue to confirmation page.\"

},

{

\"settingName\": \"hostedProfilePageBorderVisible\",

\"settingValue\": \"true\"

}

\]

}

}

}

 

Bottom of Form

**Response:**

{

\"token\":
\"e3X1JmlCM01EV4HVLqJhdbfStNUmKMkeQ/bm+jBGrFwpeLnaX3E6wmquJZtLXEyMHlcjhNPx471VoGzyrYF1/VIDKk/qcDKT9BShN64Noft0toiYq07nn1CD+w4AzK2kwpSJkjS3I92h9YompnDXSkPKJWopwUesi6n/trJ96CP/m4rf4Xv6vVQqS0DEu+e+foNGkobJwjop2qHPYOp6e+oNGNIYcGYc06VkwE3kQ+ZbBpBhlkKRYdjJdBYRwdSRtcE7YPia2ENTFGNuMYZvFv7rBaoBftWMvapK7Leb1QcE1uQ+t/9X0wlamazbJmubdiE4Gg5GSiFFeVMcMEhUGJyloDCkTzY/Yv1tg0kAK7GfLXLcD+1pwu+YAR4MasCwnFMduwOc3sFOEWmhnU/cvQ==\",

\"messages\": {

\"resultCode\": \"Ok\",

\"message\": \[

{

\"code\": \"I00001\",

\"text\": \"Successful.\"

}

\]

}

}

**REQUEST FIELD DESCRIPTION**

*getHostedProfilePageRequest*

  -------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  **Element**                  **Description**                                                                                       **Format**
  ---------------------------- ----------------------------------------------------------------------------------------------------- --------------------------------------
  **merchantAuthentication**   **Required.**\                                                                                        
                               Contains merchant authentication information.                                                         

  name                         **Required.**\                                                                                        String, up to 25 characters.
                               Merchant's unique API Login ID.\                                                                      
                               \                                                                                                     
                               The API Login ID is provided in the Merchant Interface and must be stored securely.\                  
                               \                                                                                                     
                               The API Login ID and Transaction Key together provide the merchant authentication required for access 
                               to the payment gateway.                                                                               

  transactionKey               **Required.**\                                                                                        String, up to 16 characters.
                               Merchant's unique Transaction Key.\                                                                   
                               \                                                                                                     
                               The merchant Transaction Key is provided in the Merchant Interface and must be stored securely.\      
                               \                                                                                                     
                               The API Login ID and Transaction Key together provide the merchant authentication required for access 
                               to the payment gateway.                                                                               

  refId                        Merchant-assigned reference ID for the request.\                                                      String, up to 20 characters.
                               \                                                                                                     
                               If included in the request, this value is included in the response. This feature might be especially  
                               useful for multi-threaded applications.                                                               

  customerProfileId            Payment gateway assigned ID associated with the customer profile.                                     Numeric string.

  hostedProfileSettings        This is an array of settings for the session (optional). For more information on these parameters,    
                               see the \'Guidelines for Parameter Setting\' section in our [[Customer Profiles developer             
                               guide]{.underline}](https://developer.authorize.net/api/reference/features/customer-profiles.html).   

  setting                      Contains settingName and settingValue.                                                                

  settingName                  The name of the setting you wish to change.                                                           String.\
                                                                                                                                     \
                                                                                                                                     One of:\
                                                                                                                                     hostedProfileReturnUrl\
                                                                                                                                     hostedProfileReturnUrlText\
                                                                                                                                     hostedProfileHeadingBgColor\
                                                                                                                                     hostedProfilePageBorderVisible\
                                                                                                                                     hostedProfileIFrameCommunicatorUrl\
                                                                                                                                     hostedProfileValidationMode\
                                                                                                                                     hostedProfileBillingAddressRequired\
                                                                                                                                     hostedProfileCardCodeRequired\
                                                                                                                                     hostedProfileBillingAddressOptions\
                                                                                                                                     hostedProfileManageOptions

  settingValue                 The value of the setting you wish to change.\                                                         String.
                               \                                                                                                     
                               For more information on settingValue, see the \'Guidelines for Parameter Setting\' section in         
                               our [[Customer Profiles developer                                                                     
                               guide]{.underline}](https://developer.authorize.net/api/reference/features/customer-profiles.html).   
  -------------------------------------------------------------------------------------------------------------------------------------------------------------------------

**RESPONSE FIELD DESCRIPTION**

**Get an Accept Payment Page**

Use this function to retrieve a form token which can be used to request
the Authorize.net Accept hosted payment page. For more information on
using the hosted payment page, see the [[Accept Hosted developer
guide.]{.underline}](https://developer.authorize.net/api/reference/features/accept-hosted.html)

-   [**[API LIVE
    CONSOLE]{.underline}**](https://developer.authorize.net/api/reference/index.html#console-get-an-accept-payment-page)

-   [**[PHP]{.underline}**](https://developer.authorize.net/api/reference/index.html#php-get-an-accept-payment-page)

-   [**[CS]{.underline}**](https://developer.authorize.net/api/reference/index.html#cs-get-an-accept-payment-page)

-   [**[JAVA]{.underline}**](https://developer.authorize.net/api/reference/index.html#java-get-an-accept-payment-page)

-   [**[RUBY]{.underline}**](https://developer.authorize.net/api/reference/index.html#ruby-get-an-accept-payment-page)

-   [**[PYTHON]{.underline}**](https://developer.authorize.net/api/reference/index.html#python-get-an-accept-payment-page)

-   [**[NODE]{.underline}**](https://developer.authorize.net/api/reference/index.html#node-get-an-accept-payment-page)

Top of Form

**Request:**  

{

\"getHostedPaymentPageRequest\": {

\"merchantAuthentication\": {

\"name\": \"3685u9pF3K3\",

\"transactionKey\": \"89AN2cMJWjv795Uz\"

},

\"transactionRequest\": {

\"transactionType\": \"authCaptureTransaction\",

\"amount\": \"20.00\",

\"profile\": {

\"customerProfileId\": \"123456789\"

},

\"customer\": {

\"email\": \"ellen@mail.com\"

},

\"billTo\": {

\"firstName\": \"Ellen\",

\"lastName\": \"Johnson\",

\"company\": \"Souveniropolis\",

\"address\": \"14 Main Street\",

\"city\": \"Pecan Springs\",

\"state\": \"TX\",

\"zip\": \"44628\",

\"country\": \"US\"

}

},

\"hostedPaymentSettings\": {

\"setting\": \[{

\"settingName\": \"hostedPaymentReturnOptions\",

\"settingValue\": \"{\\\"showReceipt\\\": true, \\\"url\\\":
\\\"https://mysite.com/receipt\\\", \\\"urlText\\\": \\\"Continue\\\",
\\\"cancelUrl\\\": \\\"https://mysite.com/cancel\\\",
\\\"cancelUrlText\\\": \\\"Cancel\\\"}\"

}, {

\"settingName\": \"hostedPaymentButtonOptions\",

\"settingValue\": \"{\\\"text\\\": \\\"Pay\\\"}\"

}, {

\"settingName\": \"hostedPaymentStyleOptions\",

\"settingValue\": \"{\\\"bgColor\\\": \\\"blue\\\"}\"

}, {

\"settingName\": \"hostedPaymentPaymentOptions\",

\"settingValue\": \"{\\\"cardCodeRequired\\\": false,
\\\"showCreditCard\\\": true, \\\"showBankAccount\\\": true}\"

}, {

\"settingName\": \"hostedPaymentSecurityOptions\",

\"settingValue\": \"{\\\"captcha\\\": false}\"

}, {

\"settingName\": \"hostedPaymentShippingAddressOptions\",

\"settingValue\": \"{\\\"show\\\": false, \\\"required\\\": false}\"

}, {

\"settingName\": \"hostedPaymentBillingAddressOptions\",

\"settingValue\": \"{\\\"show\\\": true, \\\"required\\\": false}\"

}, {

\"settingName\": \"hostedPaymentCustomerOptions\",

\"settingValue\": \"{\\\"showEmail\\\": false, \\\"requiredEmail\\\":
false, \\\"addPaymentProfile\\\": true}\"

}, {

\"settingName\": \"hostedPaymentOrderOptions\",

\"settingValue\": \"{\\\"show\\\": true, \\\"merchantName\\\": \\\"G and
S Questions Inc.\\\"}\"

}, {

\"settingName\": \"hostedPaymentIFrameCommunicatorUrl\",

\"settingValue\": \"{\\\"url\\\": \\\"https://mysite.com/special\\\"}\"

}\]

}

}

}

 

Bottom of Form

**Response:**

{

\"token\":
\"FCfc6VbKGFztf8g4sI0B1bG35quHGGlnJx7G8zRpqV0gha2862KkqRQ/NaGa6y2SIhueCAsP/CQKQDQ0QJr8mOfnZD2D0EfogSWP6tQvG3xlv1LS28wFKZHt2U/DSH64eA3jLIwEdU+++++++++++++shortened_for_brevity++++++++WC1mNVQNKv2Z+
1msH4oiwoXVleb2Q7ezqHYl1FgS8jDAYzA7ls+AYf05s=.89nE4Beh\",

\"messages\": {

\"resultCode\": \"Ok\",

\"message\": \[

{

\"code\": \"I00001\",

\"text\": \"Successful.\"

}

\]

}

}

**REQUEST FIELD DESCRIPTION**

*getHostedPaymentPageRequest*

  ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  **Element**                  **Description**                                                                                                                  **Format**
  ---------------------------- -------------------------------------------------------------------------------------------------------------------------------- --------------------------------------------------------------------------------------------------------------------------------------
  **merchantAuthentication**   **Required.**\                                                                                                                   
                               Contains merchant authentication information.                                                                                    

  name                         **Required.**\                                                                                                                   String, up to 25 characters.
                               Merchant's unique API Login ID.\                                                                                                 
                               \                                                                                                                                
                               The merchant API Login ID is provided in the Merchant Interface and must be stored securely.\                                    
                               \                                                                                                                                
                               The API Login ID and Transaction Key together provide the merchant authentication required for access to the payment gateway.    

  transactionKey               **Required.**\                                                                                                                   String, up to 16 characters.
                               Merchant's unique Transaction Key.\                                                                                              
                               \                                                                                                                                
                               The merchant Transaction Key is provided in the Merchant Interface and must be stored securely.\                                 
                               \                                                                                                                                
                               The API Login ID and Transaction Key together provide the merchant authentication required for access to the payment gateway.    

  refId                        Merchant-assigned reference ID for the request.\                                                                                 String, up to 20 characters.
                               \                                                                                                                                
                               If included in the request, this value is included in the response. This feature might be especially useful for multi-threaded   
                               applications.                                                                                                                    

  transactionRequest           **Required.**\                                                                                                                   
                               This element is a container for transaction specific information.                                                                

  transactionType              **Required.**\                                                                                                                   String.\
                               Type of credit card transaction.\                                                                                                \
                               \                                                                                                                                Use authCaptureTransaction to authorize and automatically capture the transaction, or use authOnlyTransaction to authorize the
                               If the value submitted does not match a supported value, the transaction is rejected.                                            transaction for capture at a later time.

  amount                       **Required.**\                                                                                                                   Decimal, up to 15 digits with a decimal point.\
                               Amount of the transaction.\                                                                                                      \
                               \                                                                                                                                Do not use currency symbols.\
                               This is the total amount and must include tax, shipping, tips, and any other charges.                                            \
                                                                                                                                                                For example, 8.95.

  profile                      The following fields enable you to charge a transaction using payment or shipping profiles.                                      

  customerProfileId            The ID of the customer profile.\                                                                                                 Numeric string.
                               \                                                                                                                                
                               If this value is included in the response, the customer will be able to choose saved payment methods in the payment form.        

  solution                     Contains information about the software that generated the transaction.                                                          

  id                           The unique Solution ID which you generate and associate with your solution through the [[Partner                                 String, up to 50 characters.
                               Interface]{.underline}](https://account.authorize.net/interfaces/reseller/frontend/login.aspx).\                                 
                               \                                                                                                                                
                               See the [[Solution ID Implementation Guide]{.underline}](https://developer.authorize.net/api/solution_id/)for details.           

  name                         The name is generated by the solution provider and provided to Authorize.net.\                                                   String, up to 255 characters.
                               \                                                                                                                                
                               See the [[Solution ID Implementation Guide]{.underline}](https://developer.authorize.net/api/solution_id/)for details.           

  order                        Contains information about the order.                                                                                            

  invoiceNumber                Merchant-defined invoice number associated with the order.\                                                                      String, up to 20 characters.
                               \                                                                                                                                
                               Worldpay RAFT 610 merchants can view the invoice number in the Worldpay Reporting Portal.                                        

  description                  Description of the item purchased.                                                                                               String, up to 255 characters.

  lineItems                    Contains one or more lineItem elements, up to a maximum of 30 line items.                                                        

  lineItem                     Contains information about one item.                                                                                             

  itemId                       Item identification.                                                                                                             String, up to 31 characters.

  name                         The human-readable name for the item.                                                                                            String, up to 31 characters.

  description                  A description of the item.                                                                                                       String, up to 255 characters.

  quantity                     The quantity of items sold.                                                                                                      Decimal, up to four decimal places.\
                                                                                                                                                                \
                                                                                                                                                                For example, 5.4321.

  unitPrice                    The cost per unit, excluding tax, freight, and duty.                                                                             Decimal, up to four decimal places.\
                                                                                                                                                                \
                                                                                                                                                                For example, 5.4321.

  taxable                      Indicates whether the item is taxable.                                                                                           Boolean.\
                                                                                                                                                                \
                                                                                                                                                                Either true or false.

  tax                          Contains information about applicable taxes.                                                                                     

  amount                       Amount of tax.\                                                                                                                  Decimal, up to four decimal places.\
                               \                                                                                                                                \
                               The total transaction amount must include this value.                                                                            For example, 5.4321.

  name                         Name of tax.                                                                                                                     String, up to 31 characters.

  description                  Description of tax.                                                                                                              String, up to 255 characters.

  duty                         Contains information about any duty applied.                                                                                     

  amount                       Amount of duty.\                                                                                                                 Decimal, up to four decimal places.\
                               \                                                                                                                                \
                               The total transaction amount must include this value.                                                                            For example, 5.4321.

  name                         Name of duty.                                                                                                                    String, up to 31 characters.

  description                  Description of duty.                                                                                                             String, up to 255 characters.

  shipping                     Items in this element describe shipping charges applied.                                                                         

  amount                       Amount of the shipping charges.\                                                                                                 Decimal, up to four decimal places.\
                               \                                                                                                                                \
                               The total transaction amount must include this value.                                                                            For example, 5.4321.

  name                         Name of the shipping charges.                                                                                                    String, up to 31 characters.

  description                  Description of the shipping charges.                                                                                             String, up to 255 characters.

  taxExempt                    Indicates whether or not order is exempt from tax.                                                                               Boolean.\
                                                                                                                                                                \
                                                                                                                                                                Either true or false.

  poNumber                     The merchant-assigned purchase order number.\                                                                                    String, up to 25 characters.\
                               \                                                                                                                                \
                               If you use purchase order numbers, your solution should generate the purchase order number and send it with your transaction     Use alphanumeric characters only, without spaces, dashes, or other symbols.
                               requests. Authorize.net does not generate purchase order numbers.                                                                

  customer                     The following fields contain customer information.                                                                               

  type                         Type of customer.                                                                                                                String.\
                                                                                                                                                                \
                                                                                                                                                                Either individual or business.

  id                           The unique customer ID used to represent the customer associated with the transaction.\                                          String, up to 20 characters.\
                               \                                                                                                                                \
                               If you use customer IDs, your solution should generate the customer ID and send it with your transaction requests. Authorize.net Use alphanumeric characters only, without spaces, dashes, or other symbols.
                               does not generate customer IDs.                                                                                                  

  email                        **Conditional.**\                                                                                                                String, up to 255 characters.\
                               \                                                                                                                                \
                               The customer's valid email address.\                                                                                             For example, janedoe@example.com.
                               \                                                                                                                                
                               Required only when using a [[European payment                                                                                    
                               processor.]{.underline}](https://developer.authorize.net/api/reference/features/payment-transactions.html#Payment_Processors)\   
                               \                                                                                                                                
                               If you enable Email Receipts in the Merchant Interface, and if the email address format is valid, the customer will receive an   
                               Authorize.net generated email receipt.                                                                                           

  billTo                       This element contains billing address information.\                                                                              
                               \                                                                                                                                
                               If EVO is your payment processor and you submit any of the following billTo fields, you must submit all of them.\                
                               \                                                                                                                                
                               firstName\                                                                                                                       
                               lastName\                                                                                                                        
                               address\                                                                                                                         
                               city\                                                                                                                            
                               state\                                                                                                                           
                               zip                                                                                                                              

  firstName                    **Conditional.**\                                                                                                                String, up to 50 characters.
                               \                                                                                                                                
                               First name associated with customer's billing address.\                                                                          
                               \                                                                                                                                
                               Required only when using a [[European payment                                                                                    
                               processor.]{.underline}](https://developer.authorize.net/api/reference/features/payment-transactions.html#Payment_Processors)    

  lastName                     **Conditional.**\                                                                                                                String, up to 50 characters.
                               \                                                                                                                                
                               Last name associated with customer's billing address.\                                                                           
                               \                                                                                                                                
                               Required only when using a [[European payment                                                                                    
                               processor.]{.underline}](https://developer.authorize.net/api/reference/features/payment-transactions.html#Payment_Processors)    

  company                      Company associated with customer's billing address.                                                                              String, up to 50 characters.

  address                      **Conditional.**\                                                                                                                String, up to 60 characters.
                               \                                                                                                                                
                               Customer's billing address.\                                                                                                     
                               \                                                                                                                                
                               Required if merchant would like to use the Address Verification Service security feature.\                                       
                               \                                                                                                                                
                               Required when using GPN Canada or Worldpay Streamline Processing Platform.                                                       

  city                         **Conditional.**\                                                                                                                String, up to 40 characters.
                               \                                                                                                                                
                               City of customer's billing address.\                                                                                             
                               \                                                                                                                                
                               Required only when using a [[European payment                                                                                    
                               processor.]{.underline}](https://developer.authorize.net/api/reference/features/payment-transactions.html#Payment_Processors)    

  state                        **Conditional.**\                                                                                                                String, up to 40 characters.\
                               \                                                                                                                                \
                               State of customer's billing address.\                                                                                            For US states, use the [[USPS two-character abbreviation]{.underline}](https://pe.usps.com/text/pub28/28apb.htm) for the state.
                               \                                                                                                                                
                               Required only when using a [[European payment                                                                                    
                               processor.]{.underline}](https://developer.authorize.net/api/reference/features/payment-transactions.html#Payment_Processors)    

  zip                          **Conditional.**\                                                                                                                String, up to 20 characters.
                               \                                                                                                                                
                               The postal code of customer's billing address.\                                                                                  
                               \                                                                                                                                
                               Required if merchant would like to use the Address Verification Service security feature.\                                       
                               \                                                                                                                                
                               Required when using GPN Canada or Worldpay Streamline Processing Platform.                                                       

  country                      Country of customer's billing address.                                                                                           String, up to 60 characters.\
                                                                                                                                                                \
                                                                                                                                                                Use the [[ISO 3166 alpha-2
                                                                                                                                                                code]{.underline}](https://developer.cybersource.com/library/documentation/dev_guides/SmallBusiness/Intershop_NT/html/appB.html) for
                                                                                                                                                                the country.

  phoneNumber                  Phone number associated with customer's billing address.                                                                         String, up to 25 characters.\
                                                                                                                                                                \
                                                                                                                                                                For example, (123) 555-1234.

  faxNumber                    Fax number associated with customer's billing address.                                                                           String, up to 25 characters.\
                                                                                                                                                                \
                                                                                                                                                                For example, (123) 555-1234.

  shipTo                       This element contains shipping information.\                                                                                     
                               \                                                                                                                                
                               If EVO is your payment processor and you submit any of the following shipTo fields, you must submit all of them.\                
                               \                                                                                                                                
                               firstName\                                                                                                                       
                               lastName\                                                                                                                        
                               address\                                                                                                                         
                               city\                                                                                                                            
                               state\                                                                                                                           
                               zip                                                                                                                              

  firstName                    First name associated with customer's shipping address.                                                                          String, up to 50 characters.

  lastName                     Last name associated with customer's shipping address.                                                                           String, up to 50 characters.

  company                      Company associated with customer's shipping address.                                                                             String, up to 50 characters.

  address                      Customer's shipping address.                                                                                                     String, up to 60 characters.

  city                         City of customer's shipping address.                                                                                             String, up to 40 characters.

  state                        State of customer's shipping address.                                                                                            String, up to 40 characters.\
                                                                                                                                                                \
                                                                                                                                                                For US states, use the [[USPS two-character abbreviation]{.underline}](https://pe.usps.com/text/pub28/28apb.htm) for the state.

  zip                          The postal code of customer's shipping address.                                                                                  String, up to 20 characters.

  country                      Country of customer's shipping address.                                                                                          String, up to 60 characters.

  hostedPaymentSettings        **Required.**\                                                                                                                   
                               This is an array of settings for the session.\                                                                                   
                               \                                                                                                                                
                               Within this element, you must also submit at least one setting. For more information on these parameters, see the \'Hosted Form  
                               Parameter Settings\' section in our [[Accept Hosted developer                                                                    
                               guide]{.underline}](https://developer.authorize.net/api/reference/features/accept-hosted.html).                                  

  setting                      Contains settingName and settingValue.                                                                                           

  settingName                  **Conditional.**\                                                                                                                String.
                               \                                                                                                                                
                               One of:\                                                                                                                         
                               hostedPaymentReturnOptions\                                                                                                      
                               hostedPaymentButtonOptions\                                                                                                      
                               hostedPaymentStyleOptions\                                                                                                       
                               hostedPaymentPaymentOptions\                                                                                                     
                               hostedPaymentSecurityOptions\                                                                                                    
                               hostedPaymentShippingAddressOptions\                                                                                             
                               hostedPaymentBillingAddressOptions\                                                                                              
                               hostedPaymentCustomerOptions\                                                                                                    
                               hostedPaymentOrderOptions\                                                                                                       
                               hostedPaymentIFrameCommunicatorUrl                                                                                               

  settingValue                 Parameters and values for the specific setting.\                                                                                 String.
                               \                                                                                                                                
                               For more information on possible parameters for settingValue, see the \'Hosted Form Parameter Settings\' section in our [[Accept 
                               Hosted developer guide]{.underline}](https://developer.authorize.net/api/reference/features/accept-hosted.html).                 
  ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

**RESPONSE FIELD DESCRIPTION**

*getHostedPaymentPageResponse*

  ---------------------------------------------------------------------------------------------------------------------------------------
  **Element**   **Description**                                                                         **Format**
  ------------- --------------------------------------------------------------------------------------- ---------------------------------
  **refId**     Merchant-assigned reference ID for the request.\                                        String, up to 20 characters.
                \                                                                                       
                If included in the request, this value will be included in the response. This feature   
                might be especially useful for multi-threaded applications.                             

  messages      This element contains a resultCode and one or more message elements.                    

  resultCode    States whether the request was handled successfully, or ended with an error.            String.\
                                                                                                        \
                                                                                                        Either Ok or Error.

  message       Contains details about the result.                                                      

  code          The code number for the result.\                                                        String, up to 6 characters.\
                \                                                                                       \
                For a comprehensive list of possible values, or to look up a returned value, see [[the  The first character is either an
                Response Code                                                                           I for informational responses, or
                Tool.]{.underline}](https://developer.authorize.net/api/reference/responseCodes.html)   E for error responses. The
                                                                                                        remaining characters are numeric
                                                                                                        and indicate the type of
                                                                                                        informational or error response.\
                                                                                                        \
                                                                                                        For example, I00001 or E00001.

  text          Text explanation of the code for the result.                                            String.

  token         An encrypted string that the merchant must include when posting to the Authorize.net    String.
                web page.\                                                                              
                If not used within 15 minutes of the original API call, this token expires.             
  ---------------------------------------------------------------------------------------------------------------------------------------

###     Get Results of a single transaction. (how to find out if authorize and capture was successful. Once it is notify my website of success and the amount and the user then my website needs to decrypt the plaid token so it is exactly the same then run a check to9 verify the users meta data is the same as the meta data that dropped the token off to be stored.)   **Get Transaction Details**

Use this function to get detailed information about a specific
transaction.

-   [**[API LIVE
    CONSOLE]{.underline}**](https://developer.authorize.net/api/reference/index.html#console-get-transaction-details)

-   [**[PHP]{.underline}**](https://developer.authorize.net/api/reference/index.html#php-get-transaction-details)

-   [**[CS]{.underline}**](https://developer.authorize.net/api/reference/index.html#cs-get-transaction-details)

-   [**[JAVA]{.underline}**](https://developer.authorize.net/api/reference/index.html#java-get-transaction-details)

-   [**[RUBY]{.underline}**](https://developer.authorize.net/api/reference/index.html#ruby-get-transaction-details)

-   [**[PYTHON]{.underline}**](https://developer.authorize.net/api/reference/index.html#python-get-transaction-details)

-   [**[NODE]{.underline}**](https://developer.authorize.net/api/reference/index.html#node-get-transaction-details)

Top of Form

**Request:**  

{

\"getTransactionDetailsRequest\": {

\"merchantAuthentication\": {

\"name\": \"3685u9pF3K3\",

\"transactionKey\": \"89AN2cMJWjv795Uz\"

},

\"transId\": \"12345\"

}

}

 

Bottom of Form

**Response:**

{

\"getTransactionDetailsResponse\": {

\"-xmlns\": \"AnetApi/xml/v1/schema/AnetApiSchema.xsd\",

\"-xmlns:xsd\": \"https://www.w3.org/2001/XMLSchema\",

\"-xmlns:xsi\": \"https://www.w3.org/2001/XMLSchema-instance\",

\"messages\": {

\"resultCode\": \"Ok\",

\"message\": {

\"code\": \"I00001\",

\"text\": \"Successful.\"

}

},

\"transaction\": {

\"transId\": \"12345\",

\"refTransId\": \"12345\",

\"splitTenderId\": \"12345\",

\"submitTimeUTC\": \"2010-08-30T17:49:20.757Z\",

\"submitTimeLocal\": \"2010-08-30T13:49:20.757\",

\"transactionType\": \"authOnlyTransaction\",

\"transactionStatus\": \"settledSuccessfully\",

\"responseCode\": \"1\",

\"responseReasonCode\": \"1\",

\"responseReasonDescription\": \"Approval\",

\"authCode\": \"000000\",

\"AVSResponse\": \"X\",

\"cardCodeResponse\": \"M\",

\"CAVVResponse\": \"2\",

\"FDSFilterAction\": \"authAndHold\",

\"FDSFilters\": {

\"FDSFilter\": \[

{

\"name\": \"Hourly Velocity Filter\",

\"action\": \"authAndHold\"

},

{

\"name\": \"Amount Filter\",

\"action\": \"report\"

}

\]

},

\"batch\": {

\"batchId\": \"12345\",

\"settlementTimeUTC\": \"2010-08-30T17:49:20.757Z\",

\"settlementTimeLocal\": \"2010-08-30T13:49:20.757\",

\"settlementState\": \"settledSuccessfully\"

},

\"order\": {

\"invoiceNumber\": \"INV00001\",

\"description\": \"some description\",

\"purchaseOrderNumber\": \"PO000001\"

},

\"requestedAmount\": \"5.00\",

\"authAmount\": \"2.00\",

\"settleAmount\": \"2.00\",

\"tax\": {

\"amount\": \"1.00\",

\"name\": \"WA state sales tax\",

\"description\": \"Washington state sales tax\"

},

\"shipping\": {

\"amount\": \"2.00\",

\"name\": \"ground based shipping\",

\"description\": \"Ground based 5 to 10 day shipping\"

},

\"duty\": { \"amount\": \"1.00\" },

\"lineItems\": {

\"lineItem\": \[

{

\"itemId\": \"ITEM00001\",

\"name\": \"name of item sold\",

\"description\": \"Description of item sold\",

\"quantity\": \"1\",

\"unitPrice\": \"6.95\",

\"taxable\": \"true\"

},

{

\"itemId\": \"ITEM00001\",

\"name\": \"name of item sold\",

\"description\": \"Description of item sold\",

\"quantity\": \"1\",

\"unitPrice\": \"6.95\",

\"taxable\": \"true\"

}

\]

},

\"prepaidBalanceRemaining\": \"30.00\",

\"taxExempt\": \"false\",

\"payment\": {

\"creditCard\": {

\"cardNumber\": \"XXXX1111\",

\"expirationDate\": \"XXXX\",

\"cardType\": \"Visa\"

}

},

\"customer\": {

\"type\": \"individual\",

\"id\": \"ABC00001\",

\"email\": \"mark@example.com\"

},

\"billTo\": {

\"firstName\": \"John\",

\"lastName\": \"Doe\",

\"address\": \"123 Main St.\",

\"city\": \"Bellevue\",

\"state\": \"WA\",

\"zip\": \"98004\",

\"country\": \"US\",

\"phoneNumber\": \"000-000-0000\"

},

\"shipTo\": {

\"firstName\": \"John\",

\"lastName\": \"Doe\",

\"address\": \"123 Main St.\",

\"city\": \"Bellevue\",

\"state\": \"WA\",

\"zip\": \"98004\",

\"country\": \"US\"

},

\"recurringBilling\": \"false\",

\"customerIP\": \"0.0.0.0\",

\"subscription\": {

\"id\": \"145521\",

\"payNum\": \"1\",

\"marketType\": \"eCommerce\",

\"product\": \"Card Not Present\",

\"returnedItems\": {

\"returnedItem\": {

\"id\": \"2148878904\",

\"dateUTC\": \"2014-05-12T21:22:44Z\",

\"dateLocal\": \"2014-05-12T14:22:44\",

\"code\": \"R02\",

\"description\": \"Account Closed\"

}

},

\"solution\": {

\"id\": \"A1000004\",

\"name\": \"Shopping Cart\",

\"vendorName\": \"WidgetCo\"

},

\"mobileDeviceId\": \"2354578983274523978\"

},

\"profile\": {

\"customerProfileId\": \"1806660050\",

\"customerPaymentProfileId\": \"1805324550\"

},

\"networkTransId\": \"123456789KLNLN9H\",

\"originalNetworkTransId\": \"123456789NNNH\",

\"originalAuthAmount\": \"12.00\",

\"authorizationIndicator\": \"pre\"

}

}

}

**REQUEST FIELD DESCRIPTION**

*getTransactionDetailsRequest*

  ----------------------------------------------------------------------------------
  **Element**                  **Description**                         **Format**
  ---------------------------- --------------------------------------- -------------
  **merchantAuthentication**   **Required.**\                          
                               Contains merchant authentication        
                               information.                            

  name                         **Required.**\                          String, up to
                               Merchant's unique API Login ID.\        25
                               \                                       characters.
                               The API Login ID is provided in the     
                               Merchant Interface and must be stored   
                               securely.\                              
                               \                                       
                               The API Login ID and Transaction Key    
                               together provide the merchant           
                               authentication required for access to   
                               the payment gateway.                    

  transactionKey               **Required.**\                          String, up to
                               Merchant's unique Transaction Key.\     16
                               \                                       characters.
                               The merchant Transaction Key is         
                               provided in the Merchant Interface and  
                               must be stored securely.\               
                               \                                       
                               The API Login ID and Transaction Key    
                               together provide the merchant           
                               authentication required for access to   
                               the payment gateway.                    

  refId                        Merchant-assigned reference ID for the  String, up to
                               request.\                               20
                               \                                       characters.
                               If included in the request, this value  
                               is included in the response. This       
                               feature might be especially useful for  
                               multi-threaded applications.            

  transId                      The Authorize.net assigned              Numeric
                               identification number for a             string.
                               transaction.\                           
                               \                                       
                               Use this value to reference at a later  
                               time the transaction generated by this  
                               API call. You may need the transaction  
                               ID for follow-on transactions such as   
                               credits, voids, and captures of         
                               unsettled transactions, as well as for  
                               reporting calls.                        
  ----------------------------------------------------------------------------------

**RESPONSE FIELD DESCRIPTION**

*getTransactionDetailsResponse*

  --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  **Element**                 **Description**                                                                                                                  **Format**
  --------------------------- -------------------------------------------------------------------------------------------------------------------------------- -------------------------------------------------------------------------------------------------------------------------------------
  **refId**                   Merchant-assigned reference ID for the request.\                                                                                 String, up to 20 characters.
                              \                                                                                                                                
                              If included in the request, this value is included in the response. This feature might be especially useful for multi-threaded   
                              applications.                                                                                                                    

  messages                    This element contains a resultCode and one or more message elements.                                                             

  resultCode                  States whether the request was handled successfully, or ended with an error.                                                     String.\
                                                                                                                                                               \
                                                                                                                                                               Either Ok or Error.

  message                     Contains details about the result.                                                                                               

  code                        The code number for the result.\                                                                                                 String, up to six characters.\
                              \                                                                                                                                \
                              For a comprehensive list of possible values, or to look up a returned value, see [[the Response Code                             The first character is either an I for informational responses, or E for error responses. The remaining characters are numeric and
                              Tool.]{.underline}](https://developer.authorize.net/api/reference/responseCodes.html)                                            indicate the type of informational or error response.

  text                        Text explanation of the code for the result.                                                                                     String.

  transaction                 Contains information about the transaction.                                                                                      

  transId                     The Authorize.net assigned identification number for a transaction.\                                                             Numeric string.
                              \                                                                                                                                
                              Use this value to reference at a later time the transaction generated by this API call. You may need the transaction ID for      
                              follow-on transactions such as credits, voids, and captures of unsettled transactions, as well as for reporting calls.           

  refTransId                  The transaction ID of the original transaction.\                                                                                 Numeric string.
                              \                                                                                                                                
                              This appears only for linked credits (transaction type refundTransaction).                                                       

  splitTenderId               Identifies the split tender order, if applicable.\                                                                               Numeric string.
                              \                                                                                                                                
                              This appears only for transactions that are part of a split tender purchase.                                                     

  submitTimeUTC               Date and time the transaction was submitted, expressed in UTC.                                                                   String.\
                                                                                                                                                               \
                                                                                                                                                               Use XML dateTime (YYYY-MM-DDThh:mm:ss) formatting.

  submitTimeLocal             Date and time the transaction was submitted, in the merchant\'s time zone.\                                                      String.\
                              \                                                                                                                                \
                              This element uses the merchant\'s time zone as configured in the Merchant Interface. If unconfigured, defaults to Mountain Time  Use XML dateTime (YYYY-MM-DDThh:mm:ss) formatting.
                              (UTC-7).                                                                                                                         

  transactionType             The type of transaction that was originally submitted.                                                                           String.\
                                                                                                                                                               \
                                                                                                                                                               Either authCaptureTransaction, authOnlyTransaction, captureOnlyTransaction, or refundTransaction.

  transactionStatus           The status of the transaction.                                                                                                   String.\
                                                                                                                                                               \
                                                                                                                                                               One of:\
                                                                                                                                                               authorizedPendingCapture\
                                                                                                                                                               capturedPendingSettlement\
                                                                                                                                                               communicationError\
                                                                                                                                                               refundSettledSuccessfully\
                                                                                                                                                               refundPendingSettlement\
                                                                                                                                                               approvedReview\
                                                                                                                                                               declined\
                                                                                                                                                               couldNotVoid\
                                                                                                                                                               expired\
                                                                                                                                                               generalError\
                                                                                                                                                               failedReview\
                                                                                                                                                               settledSuccessfully\
                                                                                                                                                               settlementError\
                                                                                                                                                               underReview\
                                                                                                                                                               voided\
                                                                                                                                                               FDSPendingReview\
                                                                                                                                                               FDSAuthorizedPendingReview\
                                                                                                                                                               returnedItem

  responseCode                The overall status of the transaction.                                                                                           String.\
                                                                                                                                                               \
                                                                                                                                                               One of the following:\
                                                                                                                                                               \
                                                                                                                                                               1 \-- Approved\
                                                                                                                                                               2 \-- Declined\
                                                                                                                                                               3 \-- Error\
                                                                                                                                                               4 \-- Held for Review

  responseReasonCode          A code that represents more details about the result of the transaction.\                                                        Numeric string.
                              \                                                                                                                                
                              For a comprehensive list of possible values, or to look up a returned value, see [[the Response Code                             
                              Tool.]{.underline}](https://developer.authorize.net/api/reference/responseCodes.html)                                            

  responseReasonDescription   A brief explanation of the responseReasonCode.                                                                                   String.

  authCode                    The authorization code granted by the card issuing bank for this transaction.                                                    String, 6 characters.

  AVSResponse                 Address Verification Service (AVS) response code.                                                                                String, 1 character.\
                                                                                                                                                               \
                                                                                                                                                               One of the following:\
                                                                                                                                                               \
                                                                                                                                                               A \-- The street address matched, but the postal code did not.\
                                                                                                                                                               B \-- No address information was provided.\
                                                                                                                                                               E \-- The AVS check returned an error.\
                                                                                                                                                               G \-- The card was issued by a bank outside the U.S. and does not support AVS.\
                                                                                                                                                               N \-- Neither the street address nor postal code matched.\
                                                                                                                                                               P \-- AVS is not applicable for this transaction.\
                                                                                                                                                               R \-- Retry --- AVS was unavailable or timed out.\
                                                                                                                                                               S \-- AVS is not supported by card issuer.\
                                                                                                                                                               U \-- Address information is unavailable.\
                                                                                                                                                               W \-- The US ZIP+4 code matches, but the street address does not.\
                                                                                                                                                               X \-- Both the street address and the US ZIP+4 code matched.\
                                                                                                                                                               Y \-- The street address and postal code matched.\
                                                                                                                                                               Z \-- The postal code matched, but the street address did not.

  cardCodeResponse            Card code verification (CCV) response code.                                                                                      String, 1 character.\
                                                                                                                                                               \
                                                                                                                                                               One of the following:\
                                                                                                                                                               \
                                                                                                                                                               M \-- CVV matched.\
                                                                                                                                                               N \-- CVV did not match.\
                                                                                                                                                               P \-- CVV was not processed.\
                                                                                                                                                               S \-- CVV should have been present but was not indicated.\
                                                                                                                                                               U \-- The issuer was unable to process the CVV check.

  CAVVResponse                Cardholder authentication verification response code.\                                                                           String, 1 character.\
                              \                                                                                                                                \
                              *Important:* Mastercard transactions always return a null result for this element. Consequently, transaction details for         One of the following:\
                              Mastercard transactions do not contain CAVV results.                                                                             \
                                                                                                                                                               Blank or not present \-- CAVV not validated.\
                                                                                                                                                               0 \-- CAVV was not validated because erroneous data was submitted.\
                                                                                                                                                               1 \-- CAVV failed validation.\
                                                                                                                                                               2 \-- CAVV passed validation.\
                                                                                                                                                               3 \-- CAVV validation could not be performed; issuer attempt incomplete.\
                                                                                                                                                               4 \-- CAVV validation could not be performed; issuer system error.\
                                                                                                                                                               5 \-- Reserved for future use.\
                                                                                                                                                               6 \-- Reserved for future use.\
                                                                                                                                                               7 \-- CAVV failed validation, but the issuer is available. Valid for U.S.-issued card submitted to non-U.S acquirer.\
                                                                                                                                                               8 \-- CAVV passed validation and the issuer is available. Valid for U.S.-issued card submitted to non-U.S. acquirer.\
                                                                                                                                                               9 \-- CAVV failed validation and the issuer is unavailable. Valid for U.S.-issued card submitted to non-U.S acquirer.\
                                                                                                                                                               A \-- CAVV passed validation but the issuer unavailable. Valid for U.S.-issued card submitted to non-U.S acquirer.\
                                                                                                                                                               B \-- CAVV passed validation, information only, no liability shift.

  FDSFilterAction             The action applied to the transaction by the merchant\'s Advanced Fraud Detection Suite settings.\                               String.\
                              \                                                                                                                                \
                              When multiple filters apply to a transaction, we will take the most restrictive action. For example, if a transaction triggers   One of:\
                              two AFDS filters, and one filter returns hold while the other filter returns reject, we will reject the transaction instead of   reject\
                              holding it.                                                                                                                      decline\
                                                                                                                                                               hold\
                                                                                                                                                               authAndHold\
                                                                                                                                                               report

  FDSFilters                  Contains information for any fraud filters that have been applied.\                                                              
                              \                                                                                                                                
                              Since one transaction may trigger more than one filter, you will receive each filter that the transaction triggered, along with  
                              the action specified by the filter.                                                                                              

  FDSFilter                   Contains information for one fraud filter.                                                                                       

  name                        Name of the fraud filter.                                                                                                        String.

  action                      The setting for the filter.                                                                                                      String.\
                                                                                                                                                               \
                                                                                                                                                               One of:\
                                                                                                                                                               reject\
                                                                                                                                                               decline\
                                                                                                                                                               hold\
                                                                                                                                                               authAndHold\
                                                                                                                                                               report

  order                       Contains information about the transaction.                                                                                      

  invoiceNumber               Merchant-defined invoice number associated with the order.\                                                                      String, up to 20 characters.
                              \                                                                                                                                
                              Worldpay RAFT 610 merchants can view the invoice number in the Worldpay Reporting Portal.                                        

  description                 Description of the item purchased.                                                                                               String, up to 255 characters.

  purchaseOrderNumber         The merchant-assigned purchase order number.                                                                                     String, up to 25 characters.

  requestedAmount             Amount requested in original authorization.\                                                                                     Decimal, up to 15 digits with a decimal point.\
                              \                                                                                                                                \
                              Present if the current transaction is for a prepaid card or if a splitTenderId value was sent.                                   Do not use currency symbols.\
                                                                                                                                                               \
                                                                                                                                                               For example, 8.95.

  authAmount                  The amount authorized or refunded by the original transaction..                                                                  Decimal, up to 15 digits with a decimal point.\
                                                                                                                                                               \
                                                                                                                                                               Do not use currency symbols.\
                                                                                                                                                               \
                                                                                                                                                               For example, 8.95.

  settleAmount                The amount that was submitted for settlement.\                                                                                   Decimal, up to 15 digits with a decimal point.\
                              \                                                                                                                                \
                              This will equal the value of authAmount in most cases. For voided transactions, we will return a value of \"0.00\". For          Do not use currency symbols.\
                              transactions captured after an intitial authOnlyTransaction request, the value may be less than authAmount if the full amount    \
                              wasn\'t captured.                                                                                                                For example, 8.95.

  batch                       Contains information about the batch if the transaction is settled. This will not be present for unsettled transactions.         

  batchId                     The identification number for the batch.                                                                                         Numeric string.

  settlementTimeUTC           Date and time when the batch was settled, expressed in UTC.                                                                      String.\
                                                                                                                                                               \
                                                                                                                                                               Use XML dateTime (YYYY-MM-DDThh:mm:ss) formatting.

  settlementTimeLocal         Date and time when the batch was settled, expressed in merchant's local time zone.\                                              String.\
                              \                                                                                                                                \
                              This element returns the time in the merchant time zone as set in the Merchant Interface.\                                       Use XML dateTime (YYYY-MM-DDThh:mm:ss) formatting.
                              \                                                                                                                                
                              To update the time zone, log in to the Merchant Interface and click **Account \> Settings \> Time Zone.**                        

  settlementState             Status of the batch.                                                                                                             String.\
                                                                                                                                                               \
                                                                                                                                                               Either settledSuccessfully, settlementError, or pendingSettlement.

  tax                         Contains information about applicable taxes.                                                                                     

  amount                      Amount of tax.\                                                                                                                  Decimal, up to four decimal places.
                              \                                                                                                                                
                              The total transaction amount must include this value.                                                                            

  name                        Name of tax.                                                                                                                     String, up to 31 characters.

  description                 Description of tax.                                                                                                              String, up to 255 characters.

  duty                        Contains information about any duty applied.                                                                                     

  amount                      Amount of duty.\                                                                                                                 Decimal, up to four decimal places.
                              \                                                                                                                                
                              The total transaction amount must include this value.                                                                            

  name                        Name of duty.                                                                                                                    String, up to 31 characters.

  description                 Description of duty.                                                                                                             String, up to 255 characters.

  shipping                    Items in this element describe shipping charges applied.                                                                         

  amount                      Amount of the shipping charges.\                                                                                                 Decimal, up to four decimal places.
                              \                                                                                                                                
                              The total transaction amount must include this value.                                                                            

  name                        Name of the shipping charges.                                                                                                    String, up to 31 characters.

  description                 Description of the shipping charges.                                                                                             String, up to 255 characters.

  lineItems                   Contains one or more lineItem elements, up to a maximum of 30 line items.                                                        

  lineItem                    Contains information about one item.                                                                                             

  itemId                      Item identification.                                                                                                             String, up to 31 characters.

  name                        The human-readable name for the item.                                                                                            String, up to 31 characters.

  description                 A description of the item.                                                                                                       String, up to 255 characters.

  quantity                    The quantity of items sold.                                                                                                      Decimal, up to four decimal places.

  unitPrice                   The cost per unit, excluding tax, freight, and duty.                                                                             Decimal, up to four decimal places.

  taxable                     Indicates whether the item is taxable.                                                                                           Boolean.\
                                                                                                                                                               \
                                                                                                                                                               Either true or false.

  prepaidBalanceRemaining     The amount remaining on the prepaid card at the time of the transaction.\                                                        Decimal, up to four decimal places.
                              \                                                                                                                                
                              This element is provided only for prepaid card transactions.                                                                     

  taxExempt                   Indicates whether the item is tax exempt.                                                                                        Boolean.\
                                                                                                                                                               \
                                                                                                                                                               Either true or false.

  payment                     This element contains payment information.                                                                                       

  creditCard                  This element is not returned if payment was by bank account.                                                                     

  cardNumber                  The masked card number used for the transaction.                                                                                 String.

  expirationDate              The masked expiration date for the card.                                                                                         String.

  cardType                    Type of credit card.                                                                                                             String.\
                                                                                                                                                               \
                                                                                                                                                               Either Visa, Mastercard, Discover, AmericanExpress, DinersClub, or JCB.

  bankAccount                 This element is not returned if payment was by credit card.                                                                      

  routingNumber               The masked ABA routing number.                                                                                                   String, 8 characters.

  accountNumber               The masked bank account number.                                                                                                  String, 8 characters.

  nameOnAccount               Name of the person who holds the bank account.                                                                                   String, up to 22 characters.

  echeckType                  The type of eCheck transaction.                                                                                                  String.\
                                                                                                                                                               \
                                                                                                                                                               Either PPD, WEB, CCD, TEL, ARC, or BOC.

  customer                    The following fields contain customer information.                                                                               

  type                        Type of customer.                                                                                                                String.\
                                                                                                                                                               \
                                                                                                                                                               Either individual or business.

  id                          The unique customer ID used to represent the customer associated with the transaction.\                                          String, up to 20 characters.\
                              \                                                                                                                                \
                              If you use customer IDs, your solution should generate the customer ID and send it with your transaction requests. Authorize.net Use alphanumeric characters only, without spaces, dashes, or other symbols.
                              does not generate customer IDs.                                                                                                  

  email                       **Conditional.**\                                                                                                                String, up to 255 characters.
                              \                                                                                                                                
                              The customer's valid email address.\                                                                                             
                              \                                                                                                                                
                              Required only when using a [[European payment                                                                                    
                              processor.]{.underline}](https://developer.authorize.net/api/reference/features/payment-transactions.html#Payment_Processors)\   
                              \                                                                                                                                
                              If you enable Email Receipts in the Merchant Interface, and if the email address format is valid, the customer will receive an   
                              Authorize.net generated email receipt.                                                                                           

  billTo                      Contains the billing address information.                                                                                        

  firstName                   The first name associated with the customer\'s billing address.                                                                  String, up to 50 characters.

  lastName                    The last name associated with the customer\'s billing address.                                                                   String, up to 50 characters.

  company                     The company name associated with the customer\'s billing address.                                                                String, up to 50 characters.

  address                     The customer\'s billing address.                                                                                                 String, up to 60 characters.

  city                        The city of the customer\'s billing address.                                                                                     String, up to 40 characters.

  state                       The state or province of the customer\'s billing address.                                                                        String, up to 40 characters.\
                                                                                                                                                               \
                                                                                                                                                               For US states, use the [[USPS two-character abbreviation]{.underline}](https://pe.usps.com/text/pub28/28apb.htm) for the state.

  zip                         The postal code for the customer\'s billing address.                                                                             String, up to 20 characters.

  country                     Country of customer's billing address.                                                                                           String, up to 60 characters.\
                                                                                                                                                               \
                                                                                                                                                               Use the [[ISO 3166 alpha-2
                                                                                                                                                               code]{.underline}](https://developer.cybersource.com/library/documentation/dev_guides/SmallBusiness/Intershop_NT/html/appB.html)for
                                                                                                                                                               the country.

  phoneNumber                 Phone number associated with customer's billing address.                                                                         String, up to 25 characters.

  faxNumber                   Fax number associated with customer's billing address.                                                                           String, up to 25 characters.

  shipTo                      Contains the shipping address information.                                                                                       

  firstName                   First name associated with customer's shipping address.                                                                          String, up to 50 characters.

  lastName                    Last name associated with customer's shipping address.                                                                           String, up to 50 characters.

  company                     Company associated with customer's shipping address.                                                                             String, up to 50 characters.

  address                     Customer's shipping address.                                                                                                     String, up to 60 characters.

  city                        City of customer's shipping address.                                                                                             String, up to 40 characters.

  state                       State of customer's shipping address.                                                                                            String, up to 40 characters.\
                                                                                                                                                               \
                                                                                                                                                               For US states, use the [[USPS two-character abbreviation]{.underline}](https://pe.usps.com/text/pub28/28apb.htm) for the state.

  zip                         Postal code of customer's shipping address.                                                                                      String, up to 20 characters.

  country                     Country of customer's shipping address.                                                                                          String, up to 60 characters.

  recurringBilling            Indicates whether or not this is a recurring transaction.                                                                        Boolean.\
                                                                                                                                                               \
                                                                                                                                                               Either true or false.

  returnedItems               This element is a container for one or more returnedItem fields. Applies only to eCheck.Net transactions.                        

  returnedItem                Contains fields that contain returned item information.                                                                          

  id                          Transaction ID.                                                                                                                  Numeric string.

  dateUTC                     Date and time the item was returned, in UTC.                                                                                     String.\
                                                                                                                                                               \
                                                                                                                                                               Use XML dateTime (YYYY-MM-DDThh:mm:ss) formatting.

  dateLocal                   Date and time the item was returned, in the merchant\'s time zone.\                                                              String.\
                              \                                                                                                                                \
                              This element uses the merchant\'s time zone as configured in the Merchant Interface. If unconfigured, defaults to Mountain Time  Use XML dateTime (YYYY-MM-DDThh:mm:ss) formatting.
                              (UTC-7).                                                                                                                         

  code                        The ACH return code.\                                                                                                            String.
                              \                                                                                                                                
                              To view a list of return codes, see our [[Testing                                                                                
                              Guide.]{.underline}](https://developer.authorize.net/hello_world/testing_guide/)                                                 

  description                 A text description of the reason for the return.                                                                                 String.

  solution                    Contains information about the software that generated the transaction.                                                          

  id                          The unique Solution ID which you generate and associate with your solution through the [[Partner                                 String, up to 50 characters.
                              Interface]{.underline}](https://account.authorize.net/interfaces/reseller/frontend/login.aspx).\                                 
                              \                                                                                                                                
                              See the [[Solution ID Implementation Guide]{.underline}](https://developer.authorize.net/api/solution_id/) for details.          

  name                        The name of the solution which submitted this transaction.\                                                                      String, up to 255 characters.
                              \                                                                                                                                
                              See the [[Solution ID Implementation Guide]{.underline}](https://developer.authorize.net/api/solution_id/) for details.          

  vendorName                  The name of the vendor which created the solution.\                                                                              String
                              \                                                                                                                                
                              See the [[Solution ID Implementation Guide]{.underline}](https://developer.authorize.net/api/solution_id/) for details.          

  customerIP                  The IPv4 address of the customer initiating the transaction. Defaults to 255.255.255.255 if not included in your request.\       String, up to 15 characters.\
                              \                                                                                                                                \
                              Required only when the merchant is using customer IP based AFDS filters.                                                         Use dot-decimal formatting.

  networkTransId              The network transaction ID generated by the card network if made available by the processor.                                     Alphanumeric string, 255 characters or fewer.

  originalNetworkTransId      The network transaction ID returned in response to the original card-on-file transaction.\                                       Alphanumeric string, 255 characters or fewer.
                              \                                                                                                                                
                              Store the networkTransId value received in the original card-on-file transaction response. Set the originalNetworkTransId to the 
                              original networkTransId value for all subsequent authorizations against the same card-on-file.                                   

  originalAuthAmount          The authorized amount for the original card-on-file transaction.\                                                                Decimal, up to 15 digits with a decimal point.\
                              \                                                                                                                                \
                              Store the amount of the original card-on-file transaction response. Set the originalAuthAmount to the original amount value for  Do not use currency symbols.
                              all subsequent authorizations against the same card-on-file.                                                                     

  authorizationIndicator      Indicates whether the authorization was a pre-authorization or final authorization.\                                             String.\
                              \                                                                                                                                \
                              Applicable to Mastercard only. Use pre for initial authorizations, for example, prior to tips. Use final for final               Either pre or final.
                              authorizations, for example, including tips.                                                                                     

  subscription                Contains subscription information.                                                                                               

  id                          The subscription ID.                                                                                                             Numeric string.

  payNum                      Identifies the number of this transaction, in terms of how many transactions have been submitted for this subscription.\         Numeric string, between 1 and 999.
                              \                                                                                                                                
                              For example, the third transaction processed for this subscription will return payNum set to 3.                                  

  marketType                  The market type of the transaction.                                                                                              String.\
                                                                                                                                                               \
                                                                                                                                                               Either eCommerce, MOTO, or Retail.

  product                     Indicates whether the card was present for the transaction.                                                                      String.\
                                                                                                                                                               \
                                                                                                                                                               Either Card Not Present or Card Present.

  mobileDeviceId              The unique identifier of the mobile device.                                                                                      String, up to 60 characters.

  profile                     Contains customer profile information used for this transaction.                                                                 

  customerProfileId           The ID number associated with the customer profile.                                                                              Numeric string.

  customerPaymentProfileId    The ID of the customer payment profile used to charge this transaction.                                                          Numeric string.

  clientId                    The name of the SDK used to generate the transaction, if using an SDK.                                                           String.

  transrefId                  Merchant-assigned reference ID for the request.\                                                                                 String, up to 20 characters.
                              \                                                                                                                                
                              If your request included refId, we will return the value in transrefId. This feature might be especially useful for              
                              multi-threaded applications.                                                                                                     
  --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
