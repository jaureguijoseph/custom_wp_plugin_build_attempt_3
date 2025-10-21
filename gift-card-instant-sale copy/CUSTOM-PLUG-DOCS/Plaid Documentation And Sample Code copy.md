\# \*\*Plaid Documentation And Sample Code Link Web SDK\*\*

Reference for integrating with the Link JavaScript SDK and React SDK

Prefer to learn with code examples? Check out our¬†\[\[GitHub

repo\]{.underline}\](https://github.com/plaid/tiny-quickstart)¬†with

working example Link implementations for

both¬†\[\[JavaScript\]{.underline}\](https://github.com/plaid/tiny-quickstart/tree/main/vanilla_js)¬†and¬†\[\[React\]{.underline}\](https://github.com/plaid/tiny-quickstart/tree/main/react).

\[Installation\](https://plaid.com/docs/link/web/#installation)

Select group for content switcher

JavaScriptReact

Include the Plaid Link initialize script on each page of your site. It

must always be loaded directly from¬†https://cdn.plaid.com, rather than

included in a bundle or hosted yourself. Unlike Plaid\\\'s other SDKs,
the

JavaScript web SDK is not versioned;¬†cdn.plaid.com¬†will automatically

provide the latest available SDK.

\\\<script

src=\\\"https://cdn.plaid.com/link/v2/stable/link-initialize.js\\\"\\\>\\\</script\\\>

To get started with Plaid Link for React, clone the¬†\[\[GitHub

repository\]{.underline}\](https://github.com/plaid/react-plaid-link)¬†and

review the example application and README, which provide reference

implementations.

Next, you\\\'ll need to install the react-plaid-link package.

With npm:

With yarn:

Then import the necessary components and types:

\[CSP directives\](https://plaid.com/docs/link/web/#csp-directives)

If you are using a Content Security Policy (CSP), use the following

directives to allow Link traffic:

default-src https://cdn.plaid.com/;

script-src \\\'unsafe-inline\\\'

https://cdn.plaid.com/link/v2/stable/link-initialize.js;

frame-src https://cdn.plaid.com/;

connect-src https://production.plaid.com/;

If using Sandbox instead of Production, make sure to update

the¬†connect-srcdirective to point to the appropriate server

(https://sandbox.plaid.com).

\[Creating a Link

token\](https://plaid.com/docs/link/web/#creating-a-link-token)

Before you can create an instance of Link, you need to first create

a¬†link_token. A¬†link_token¬†can be configured for different Link flows

and is used to control much of Link\\\'s behavior. To learn how to
create

a new¬†link_token, see the API Reference entry

for¬†\[\*\*\[/link/token/create\]{.underline}\*\*\](https://plaid.com/docs/api/link/#linktokencreate).

\[Create\](https://plaid.com/docs/link/web/#create)

Plaid.create¬†accepts one argument, a configuration¬†Object, and returns

an¬†Objectwith three

functions,¬†\[\*\*\[open\]{.underline}\*\*\](https://plaid.com/docs/#open),¬†\[\*\*\[exit\]{.underline}\*\*\](https://plaid.com/docs/#exit),

and¬†\[\*\*\[destroy\]{.underline}\*\*\](https://plaid.com/docs/#destroy).

Calling¬†open¬†will open Link and display the Consent Pane view,

calling¬†exit¬†will close Link, and calling¬†destroy¬†will clean up the

iframe.\\

It is recommended to call¬†Plaid.create¬†when initializing the view that

is responsible for loading Plaid, as this will allow Plaid to

pre-initialize Link, resulting in lower UI latency upon calling¬†open,

which can increase Link conversion.\\

When using the React SDK, this method is called¬†usePlaidLink¬†and
returns

an object with four

values,¬†\[\*\*\[open\]{.underline}\*\*\](https://plaid.com/docs/#open),¬†\[\*\*\[exit\]{.underline}\*\*\](https://plaid.com/docs/#exit),¬†ready,

and¬†error. The values¬†open¬†and¬†exit¬†behave as described
above.¬†ready¬†is

a passthrough for¬†onLoad¬†and will be¬†true¬†when Link is ready to be

opened.¬†error¬†is populated only if Plaid fails to load the Link

JavaScript. There is no separate method to destroy Link in the React

SDK, as unmount will automatically destroy the Link instance.\\

\*\*Note:\*\*¬†Control whether or not your Link integration uses the
Account

Select view from

the¬†\[\[Dashboard\]{.underline}\](https://dashboard.plaid.com/signin?redirect=%2Flink%2Faccount-select).

\[\*\*token\*\*\](https://plaid.com/docs/link/web/#link-web-create-token)

string

Specify a link_token to authenticate your app with Link. This is a short

lived, one-time use token that should be unique for each Link session.

In addition to the primary flow, a link_token can be configured to

launch Link in \[\[update

mode\]{.underline}\](https://plaid.com/docs/link/update-mode/). See the

/link/token/create endpoint for a full list of configurations.

\[\*\*onSuccess\*\*\](https://plaid.com/docs/link/web/#link-web-create-onSuccess)

callback

A function that is called when a user successfully links an Item. The

function should expect two arguments, the public_token and a metadata

object. See

\[\[onSuccess\]{.underline}\](https://plaid.com/docs/#onsuccess).

\[\*\*onExit\*\*\](https://plaid.com/docs/link/web/#link-web-create-onExit)

callback

A function that is called when a user exits Link without successfully

linking an Item, or when an error occurs during Link initialization. The

function should expect two arguments, a nullable error object and a

metadata object. See

\[\[onExit\]{.underline}\](https://plaid.com/docs/#onexit).

\[\*\*onEvent\*\*\](https://plaid.com/docs/link/web/#link-web-create-onEvent)

callback

A function that is called when a user reaches certain points in the Link

flow. The function should expect two arguments, an eventName string and

a metadata object. See

\[\[onEvent\]{.underline}\](https://plaid.com/docs/#onevent).

\[\*\*onLoad\*\*\](https://plaid.com/docs/link/web/#link-web-create-onLoad)

callback

A function that is called when the Link module has finished loading.

Calls to plaidLinkHandler.open() prior to the onLoad callback will be

delayed until the module is fully loaded.

\[\*\*receivedRedirectUri\*\*\](https://plaid.com/docs/link/web/#link-web-create-receivedRedirectUri)

string

A receivedRedirectUri is required to support OAuth authentication flows

when re-launching Link on a mobile device.

\[\*\*key\*\*\](https://plaid.com/docs/link/web/#link-web-create-key)

deprecatedstring

The public_key is no longer used for new implementations of Link. If

your integration is still using a public_key, see the \[\[migration

guide\]{.underline}\](https://plaid.com/docs/link/link-token-migration-guide)

to upgrade to using a link_token. See the \[\[maintenance

guide\]{.underline}\](https://plaid.com/docs/link/maintain-legacy-integration)

to troubleshoot any public_key issues.

// The usePlaidLink hook manages Plaid Link creation

// It does not return a destroy function;

// instead, on unmount it automatically destroys the Link instance

const config: PlaidLinkOptions = {

onSuccess: (public_token, metadata) =\\\> {}

onExit: (err, metadata) =\\\> {}

onEvent: (eventName, metadata) =\\\> {}

token: \\\'GENERATED_LINK_TOKEN\\\',

};

const { open, exit, ready } = usePlaidLink(config);

\[onSuccess\](https://plaid.com/docs/link/web/#onsuccess)

The¬†onSuccess¬†callback is called when a user successfully links an
Item.

It takes two arguments: the¬†public_token¬†and a¬†metadata¬†object.

Collapse all

\[\*\*public_token\*\*\](https://plaid.com/docs/link/web/#link-web-onsuccess-public-token)

string

Displayed once a user has successfully linked their Item.

\[\*\*metadata\*\*\](https://plaid.com/docs/link/web/#link-web-onsuccess-metadata)

object

Displayed once a user has successfully linked their Item.

Hide object

\[\*\*institution\*\*\](https://plaid.com/docs/link/web/#link-web-onsuccess-metadata-institution)

nullableobject

An institution object. If the Item was created via Same-Day

micro-deposit verification, will be null.

Hide object

\[\*\*name\*\*\](https://plaid.com/docs/link/web/#link-web-onsuccess-metadata-institution-name)

string

The full institution name, such as \\\'Wells Fargo\\\'

\[\*\*institution_id\*\*\](https://plaid.com/docs/link/web/#link-web-onsuccess-metadata-institution-institution-id)

string

The Plaid institution identifier

\[\*\*accounts\*\*\](https://plaid.com/docs/link/web/#link-web-onsuccess-metadata-accounts)

object

A list of accounts attached to the connected Item. If Account Select is

enabled via the developer dashboard, accounts will only include selected

accounts.

Hide object

\[\*\*id\*\*\](https://plaid.com/docs/link/web/#link-web-onsuccess-metadata-accounts-id)

string

The Plaid account_id

\[\*\*name\*\*\](https://plaid.com/docs/link/web/#link-web-onsuccess-metadata-accounts-name)

string

The official account name

\[\*\*mask\*\*\](https://plaid.com/docs/link/web/#link-web-onsuccess-metadata-accounts-mask)

nullablestring

The last 2-4 alphanumeric characters of an account\\\'s official account

number. Note that the mask may be non-unique between an Item\\\'s

accounts. It may also not match the mask that the bank displays to the

user.

\[\*\*type\*\*\](https://plaid.com/docs/link/web/#link-web-onsuccess-metadata-accounts-type)

string

The account type. See the \[\[Account

schema\]{.underline}\](https://plaid.com/docs/api/accounts#account-type-schema)

for a full list of possible values

\[\*\*subtype\*\*\](https://plaid.com/docs/link/web/#link-web-onsuccess-metadata-accounts-subtype)

string

The account subtype. See the \[\[Account

schema\]{.underline}\](https://plaid.com/docs/api/accounts#account-type-schema)

for a full list of possible values

\[\*\*verification_status\*\*\](https://plaid.com/docs/link/web/#link-web-onsuccess-metadata-accounts-verification-status)

nullablestring

Indicates an Item\\\'s micro-deposit-based verification or database

verification status. Possible values are:\\

pending_automatic_verification: The Item is pending automatic

verification\\

pending_manual_verification: The Item is pending manual micro-deposit

verification. Items remain in this state until the user successfully

verifies the deposit.\\

automatically_verified: The Item has successfully been automatically

verified\\

manually_verified: The Item has successfully been manually verified\\

verification_expired: Plaid was unable to automatically verify the

deposit within 7 calendar days and will no longer attempt to validate

the Item. Users may retry by submitting their information again through

Link.\\

verification_failed: The Item failed manual micro-deposit verification

because the user exhausted all 3 verification attempts. Users may retry

by submitting their information again through Link.\\

database_matched: The Item has successfully been verified using
Plaid\\\'s

data sources.\\

database_insights_pending: The Database Insights result is pending and

will be available upon Auth request.\\

null: Neither micro-deposit-based verification nor database verification

are being used for the Item.

\[\*\*class_type\*\*\](https://plaid.com/docs/link/web/#link-web-onsuccess-metadata-accounts-class-type)

nullablestring

If micro-deposit verification is being used, indicates whether the

account being verified is a business or personal account.

\[\*\*account\*\*\](https://plaid.com/docs/link/web/#link-web-onsuccess-metadata-account)

deprecatednullableobject

Deprecated. Use accounts instead.

\[\*\*link_session_id\*\*\](https://plaid.com/docs/link/web/#link-web-onsuccess-metadata-link-session-id)

string

A unique identifier associated with a user\\\'s actions and events
through

the Link flow. Include this identifier when opening a support ticket for

faster turnaround.

\[\*\*transfer_status\*\*\](https://plaid.com/docs/link/web/#link-web-onsuccess-metadata-transfer-status)

nullablestring

The status of a transfer. Returned only when \[\[Transfer

UI\]{.underline}\](https://plaid.com/docs/transfer/using-transfer-ui) is

implemented.

\- COMPLETE \-- The transfer was completed.

\- INCOMPLETE \-- The transfer could not be completed. For help, see

\[\[Troubleshooting

transfers\]{.underline}\](https://plaid.com/docs/transfer/using-transfer-ui#troubleshooting-transfers).

Possible values: COMPLETE, INCOMPLETE

import {

PlaidLinkOnSuccess,

PlaidLinkOnSuccessMetadata,

} from \\\'react-plaid-link\\\';

const onSuccess = useCallback\\\<PlaidLinkOnSuccess\\\>(

(public_token: string, metadata: PlaidLinkOnSuccessMetadata) =\\\> {

// log and save metadata

// exchange public token

fetch(\\\'//yourserver.com/exchange-public-token\\\', {

method: \\\'POST\\\',

headers: {

\\\'Content-Type\\\': \\\'application/json\\\',

},

body: {

public_token,

},

});

},

\\\[\\\],

);

{

institution: {

name: \\\'Wells Fargo\\\',

institution_id: \\\'ins_4\\\'

},

accounts: \\\[

{

id: \\\'ygPnJweommTWNr9doD6ZfGR6GGVQy7fyREmWy\\\',

name: \\\'Plaid Checking\\\',

mask: \\\'0000\\\',

type: \\\'depository\\\',

subtype: \\\'checking\\\',

verification_status: null

},

{

id: \\\'9ebEyJAl33FRrZNLBG8ECxD9xxpwWnuRNZ1V4\\\',

name: \\\'Plaid Saving\\\',

mask: \\\'1111\\\',

type: \\\'depository\\\',

subtype: \\\'savings\\\'

}

\\\...

\\\],

link_session_id: \\\'79e772be-547d-4c9c-8b76-4ac4ed4c441a\\\'

}

\[onExit\](https://plaid.com/docs/link/web/#onexit)

The¬†onExit¬†callback is called when a user exits Link without

successfully linking an Item, or when an error occurs during Link

initialization.¬†onExit¬†takes two arguments, a nullable¬†error¬†object
and

a¬†metadata¬†object. The¬†metadata¬†parameter is always present, though
some

values may be¬†null. Note that¬†onExit¬†will not be called when Link is

destroyed in some other way than closing Link, such as the user hitting

the browser back button or closing the browser tab on which the Link

session is present.

Collapse all

\[\*\*error\*\*\](https://plaid.com/docs/link/web/#link-web-onexit-error)

nullableobject

A nullable object that contains the error type, code, and message of the

error that was last encountered by the user. If no error was

encountered, error will be null.

Hide object

\[\*\*error_type\*\*\](https://plaid.com/docs/link/web/#link-web-onexit-error-error-type)

String

A broad categorization of the error.

\[\*\*error_code\*\*\](https://plaid.com/docs/link/web/#link-web-onexit-error-error-code)

String

The particular error code. Each error_type has a specific set of

error_codes.

\[\*\*error_message\*\*\](https://plaid.com/docs/link/web/#link-web-onexit-error-error-message)

String

A developer-friendly representation of the error code.

\[\*\*display_message\*\*\](https://plaid.com/docs/link/web/#link-web-onexit-error-display-message)

nullableString

A user-friendly representation of the error code. null if the error is

not related to user action. This may change over time and is not safe

for programmatic use.

\[\*\*metadata\*\*\](https://plaid.com/docs/link/web/#link-web-onexit-metadata)

object

Displayed if a user exits Link without successfully linking an Item.

Hide object

\[\*\*institution\*\*\](https://plaid.com/docs/link/web/#link-web-onexit-metadata-institution)

nullableobject

An institution object. If the Item was created via Same-Day

micro-deposit verification, will be null.

Hide object

\[\*\*name\*\*\](https://plaid.com/docs/link/web/#link-web-onexit-metadata-institution-name)

string

The full institution name, such as Wells Fargo

\[\*\*institution_id\*\*\](https://plaid.com/docs/link/web/#link-web-onexit-metadata-institution-institution-id)

string

The Plaid institution identifier

\[\*\*status\*\*\](https://plaid.com/docs/link/web/#link-web-onexit-metadata-status)

string

The point at which the user exited the Link flow. One of the following

values.

Hide object

\[\*\*requires_questions\*\*\](https://plaid.com/docs/link/web/#link-web-onexit-metadata-status-requires-questions)

User prompted to answer security questions

\[\*\*requires_selections\*\*\](https://plaid.com/docs/link/web/#link-web-onexit-metadata-status-requires-selections)

User prompted to answer multiple choice question(s)

\[\*\*requires_code\*\*\](https://plaid.com/docs/link/web/#link-web-onexit-metadata-status-requires-code)

User prompted to provide a one-time passcode

\[\*\*choose_device\*\*\](https://plaid.com/docs/link/web/#link-web-onexit-metadata-status-choose-device)

User prompted to select a device on which to receive a one-time passcode

\[\*\*requires_credentials\*\*\](https://plaid.com/docs/link/web/#link-web-onexit-metadata-status-requires-credentials)

User prompted to provide credentials for the selected financial

institution or has not yet selected a financial institution

\[\*\*requires_account_selection\*\*\](https://plaid.com/docs/link/web/#link-web-onexit-metadata-status-requires-account-selection)

User prompted to select one or more financial accounts to share

\[\*\*requires_oauth\*\*\](https://plaid.com/docs/link/web/#link-web-onexit-metadata-status-requires-oauth)

User prompted to enter an OAuth flow

\[\*\*institution_not_found\*\*\](https://plaid.com/docs/link/web/#link-web-onexit-metadata-status-institution-not-found)

User exited the Link flow after unsuccessfully (no results returned)

searching for a financial institution

\[\*\*institution_not_supported\*\*\](https://plaid.com/docs/link/web/#link-web-onexit-metadata-status-institution-not-supported)

User exited the Link flow after discovering their selected institution

is no longer supported by Plaid

\[\*\*link_session_id\*\*\](https://plaid.com/docs/link/web/#link-web-onexit-metadata-link-session-id)

string

A unique identifier associated with a user\\\'s actions and events
through

the Link flow. Include this identifier when opening a support ticket for

faster turnaround.

\[\*\*request_id\*\*\](https://plaid.com/docs/link/web/#link-web-onexit-metadata-request-id)

string

The request ID for the last request made by Link. This can be shared

with Plaid Support to expedite investigation.

import {

PlaidLinkOnExit,

PlaidLinkOnExitMetadata,

PlaidLinkError,

} from \\\'react-plaid-link\\\';

const onExit = useCallback\\\<PlaidLinkOnExit\\\>(

(error: PlaidLinkError, metadata: PlaidLinkOnExitMetadata) =\\\> {

// log and save error and metadata

// handle invalid link token

if (error != null && error.error_code === \\\'INVALID_LINK_TOKEN\\\') {

// generate new link token

}

// to handle other error codes, see https://plaid.com/docs/errors/

},

\\\[\\\],

);

{

error_type: \\\'ITEM_ERROR\\\',

error_code: \\\'INVALID_CREDENTIALS\\\',

error_message: \\\'the credentials were not correct\\\',

display_message: \\\'The credentials were not correct.\\\',

}

{

institution: {

name: \\\'Wells Fargo\\\',

institution_id: \\\'ins_4\\\'

},

status: \\\'requires_credentials\\\',

link_session_id: \\\'36e201e0-2280-46f0-a6ee-6d417b450438\\\',

request_id: \\\'8C7jNbDScC24THu\\\'

}

\[onEvent\](https://plaid.com/docs/link/web/#onevent)

The¬†onEvent¬†callback is called at certain points in the Link flow. It

takes two arguments, an¬†eventName¬†string and a¬†metadata¬†object.\\

The¬†metadata¬†parameter is always present, though some values may

be¬†null. Note that new¬†eventNames,¬†metadata¬†keys, or view names may
be

added without notice.\\

The¬†OPEN,¬†LAYER_READY, and¬†LAYER_NOT_AVAILABLE¬†events will fire in
real

time; subsequent events will fire at the end of the Link flow, along

with the¬†onSuccess¬†or¬†onExit¬†callback. Callback ordering is not

guaranteed;¬†onEvent¬†callbacks may fire before, after, or surrounding

the¬†onSuccess¬†or¬†onExit¬†callback, and event callbacks are not
guaranteed

to fire in the order in which they occurred. If you need to determine

the exact time when an event happened, use the¬†timestamp¬†in the

metadata.\\

The following callback events are stable, which means that they are

suitable for programmatic use in your application\\\'s

logic:¬†OPEN,¬†EXIT,¬†HANDOFF,¬†SELECT_INSTITUTION,¬†ERROR,¬†BANK_INCOME_INSIGHTS_COMPLETED,¬†IDENTITY_VERIFICATION_PASS_SESSION,¬†IDENTITY_VERIFICATION_FAIL_SESSION,¬†LAYER_READY,¬†LAYER_NOT_AVAILABLE.

The remaining callback events are informational and subject to change

and should be used for analytics and troubleshooting purposes only.

Collapse all

\[\*\*eventName\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName)

string

A string representing the event that has just occurred in the Link flow.

Hide object

\[\*\*BANK_INCOME_INSIGHTS_COMPLETED\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-BANK-INCOME-INSIGHTS-COMPLETED)

The user has completed the Assets and Bank Income Insights flow.

\[\*\*CLOSE_OAUTH\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-CLOSE-OAUTH)

The user closed the third-party website or mobile app without completing

the OAuth flow.

\[\*\*CONNECT_NEW_INSTITUTION\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-CONNECT-NEW-INSTITUTION)

The user has chosen to link a new institution instead of linking a saved

institution. This event is only emitted in the Link Returning User

Experience flow.

\[\*\*ERROR\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-ERROR)

A recoverable error occurred in the Link flow, see the error_code

metadata.

\[\*\*EXIT\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-EXIT)

The user has exited without completing the Link flow and the

\[\[onExit\]{.underline}\](https://plaid.com/docs/#onexit) callback is

fired.

\[\*\*FAIL_OAUTH\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-FAIL-OAUTH)

The user encountered an error while completing the third-party\\\'s
OAuth

login flow.

\[\*\*HANDOFF\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-HANDOFF)

The user has exited Link after successfully linking an Item.

\[\*\*IDENTITY_VERIFICATION_START_STEP\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-IDENTITY-VERIFICATION-START-STEP)

The user has started a step of the Identity Verification flow. The step

is indicated by view_name.

\[\*\*IDENTITY_VERIFICATION_PASS_STEP\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-IDENTITY-VERIFICATION-PASS-STEP)

The user has passed a step of the Identity Verification flow. The step

is indicated by view_name.

\[\*\*IDENTITY_VERIFICATION_FAIL_STEP\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-IDENTITY-VERIFICATION-FAIL-STEP)

The user has failed a step of the Identity Verification flow. The step

is indicated by view_name.

\[\*\*IDENTITY_VERIFICATION_PENDING_REVIEW_STEP\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-IDENTITY-VERIFICATION-PENDING-REVIEW-STEP)

The user has reached the pending review state.

\[\*\*IDENTITY_VERIFICATION_CREATE_SESSION\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-IDENTITY-VERIFICATION-CREATE-SESSION)

The user has started a new Identity Verification session.

\[\*\*IDENTITY_VERIFICATION_RESUME_SESSION\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-IDENTITY-VERIFICATION-RESUME-SESSION)

The user has resumed an existing Identity Verification session.

\[\*\*IDENTITY_VERIFICATION_PASS_SESSION\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-IDENTITY-VERIFICATION-PASS-SESSION)

The user has successfully completed their Identity Verification session.

\[\*\*IDENTITY_VERIFICATION_FAIL_SESSION\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-IDENTITY-VERIFICATION-FAIL-SESSION)

The user has failed their Identity Verification session.

\[\*\*IDENTITY_VERIFICATION_PENDING_REVIEW_SESSION\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-IDENTITY-VERIFICATION-PENDING-REVIEW-SESSION)

The user has completed their Identity Verification session, which is now

in a pending review state.

\[\*\*IDENTITY_VERIFICATION_OPEN_UI\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-IDENTITY-VERIFICATION-OPEN-UI)

The user has opened the UI of their Identity Verification session.

\[\*\*IDENTITY_VERIFICATION_RESUME_UI\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-IDENTITY-VERIFICATION-RESUME-UI)

The user has resumed the UI of their Identity Verification session.

\[\*\*IDENTITY_VERIFICATION_CLOSE_UI\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-IDENTITY-VERIFICATION-CLOSE-UI)

The user has closed the UI of their Identity Verification session.

\[\*\*LAYER_NOT_AVAILABLE\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-LAYER-NOT-AVAILABLE)

The user phone number passed to Link is not eligible for Layer.

\[\*\*LAYER_READY\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-LAYER-READY)

The user phone number passed to Link is eligible for Layer and open()

may now be called.

\[\*\*MATCHED_SELECT_INSTITUTION\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-MATCHED-SELECT-INSTITUTION)

deprecated

The user selected an institution that was presented as a matched

institution. This event can be emitted either during the legacy version

of the Returning User Experience flow or if the institution\\\'s

routing_number was provided when calling /link/token/create. To

distinguish between the two scenarios, see metadata.match_reason.

\[\*\*MATCHED_SELECT_VERIFY_METHOD\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-MATCHED-SELECT-VERIFY-METHOD)

The user selected a verification method for a matched institution. This

event is emitted during the Returning User Experience flow.

\[\*\*OPEN\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-OPEN)

The user has opened Link.

\[\*\*OPEN_MY_PLAID\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-OPEN-MY-PLAID)

The user has opened my.plaid.com. This event is only sent when Link is

initialized with Assets as a product

\[\*\*OPEN_OAUTH\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-OPEN-OAUTH)

The user has navigated to a third-party website or mobile app in order

to complete the OAuth login flow.

\[\*\*SEARCH_INSTITUTION\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-SEARCH-INSTITUTION)

The user has searched for an institution.

\[\*\*SELECT_AUTH_TYPE\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-SELECT-AUTH-TYPE)

The user has chosen whether to Link instantly or manually (i.e., with

micro-deposits). This event emits the selection metadata to indicate the

user\\\'s selection.

\[\*\*SELECT_BRAND\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-SELECT-BRAND)

The user selected a brand, e.g. Bank of America. The SELECT_BRAND event

is only emitted for large financial institutions with multiple online

banking portals.

\[\*\*SELECT_DEGRADED_INSTITUTION\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-SELECT-DEGRADED-INSTITUTION)

The user selected an institution with a DEGRADED health status and was

shown a corresponding message.

\[\*\*SELECT_DOWN_INSTITUTION\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-SELECT-DOWN-INSTITUTION)

The user selected an institution with a DOWN health status and was shown

a corresponding message.

\[\*\*SELECT_FILTERED_INSTITUTION\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-SELECT-FILTERED-INSTITUTION)

The user selected an institution Plaid does not support all requested

products for and was shown a corresponding message.

\[\*\*SELECT_INSTITUTION\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-SELECT-INSTITUTION)

The user selected an institution.

\[\*\*SKIP_SUBMIT_PHONE\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-SKIP-SUBMIT-PHONE)

The user has opted to not provide their phone number to Plaid. This

event is only emitted in the Link Returning User Experience flow.

\[\*\*SUBMIT_ACCOUNT_NUMBER\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-SUBMIT-ACCOUNT-NUMBER)

The user has submitted an account number. This event emits the

account_number_mask metadata to indicate the mask of the account number

the user provided.

\[\*\*SUBMIT_CREDENTIALS\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-SUBMIT-CREDENTIALS)

The user has submitted credentials.

\[\*\*SUBMIT_DOCUMENTS\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-SUBMIT-DOCUMENTS)

The user is being prompted to submit documents for an Income

verification flow.

\[\*\*SUBMIT_DOCUMENTS_ERROR\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-SUBMIT-DOCUMENTS-ERROR)

The user encountered an error when submitting documents for an Income

verification flow.

\[\*\*SUBMIT_DOCUMENTS_SUCCESS\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-SUBMIT-DOCUMENTS-SUCCESS)

The user has successfully submitted documents for an Income verification

flow.

\[\*\*SUBMIT_MFA\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-SUBMIT-MFA)

The user has submitted MFA.

\[\*\*SUBMIT_PHONE\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-SUBMIT-PHONE)

The user has submitted their phone number. This event is only emitted in

the Link Returning User Experience flow.

\[\*\*SUBMIT_ROUTING_NUMBER\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-SUBMIT-ROUTING-NUMBER)

The user has submitted a routing number. This event emits the

routing_number metadata to indicate user\\\'s routing number.

\[\*\*TRANSITION_VIEW\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-TRANSITION-VIEW)

The TRANSITION_VIEW event indicates that the user has moved from one

view to the next.

\[\*\*VERIFY_PHONE\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-VERIFY-PHONE)

The user has successfully verified their phone number. This event is

only emitted in the Link Returning User Experience flow.

\[\*\*VIEW_DATA_TYPES\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-eventName-VIEW-DATA-TYPES)

The user has viewed data types on the data transparency consent pane.

\[\*\*metadata\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata)

object

An object containing information about the event.

Hide object

\[\*\*account_number_mask\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-account-number-mask)

nullablestring

The account number mask extracted from the user-provided account number.

If the user-inputted account number is four digits long,

account_number_mask is empty. Emitted by SUBMIT_ACCOUNT_NUMBER.

\[\*\*error_type\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-error-type)

nullablestring

The error type that the user encountered. Emitted by: ERROR, EXIT.

\[\*\*error_code\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-error-code)

nullablestring

The error code that the user encountered. Emitted by ERROR, EXIT.

\[\*\*error_message\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-error-message)

nullablestring

The error message that the user encountered. Emitted by: ERROR, EXIT.

\[\*\*exit_status\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-exit-status)

nullablestring

The status key indicates the point at which the user exited the Link

flow. Emitted by: EXIT

\[\*\*institution_id\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-institution-id)

nullablestring

The ID of the selected institution. Emitted by: \*all events\*.

\[\*\*institution_name\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-institution-name)

nullablestring

The name of the selected institution. Emitted by: \*all events\*.

\[\*\*institution_search_query\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-institution-search-query)

nullablestring

The query used to search for institutions. Emitted by:

SEARCH_INSTITUTION.

\[\*\*is_update_mode\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-is-update-mode)

nullablestring

Indicates if the current Link session is an update mode session. Emitted

by: OPEN.

\[\*\*match_reason\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-match-reason)

nullablestring

The reason this institution was matched. This will be either

returning_user or routing_number if emitted by:

MATCHED_SELECT_INSTITUTION. Otherwise, this will be SAVED_INSTITUTION or

AUTO_SELECT_SAVED_INSTITUTION if emitted by: SELECT_INSTITUTION.

\[\*\*routing_number\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-routing-number)

nullablestring

The routing number submitted by user at the micro-deposits routing

number pane. Emitted by SUBMIT_ROUTING_NUMBER.

\[\*\*mfa_type\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-mfa-type)

nullablestring

If set, the user has encountered one of the following MFA types: code,

device, questions, selections. Emitted by: SUBMIT_MFA and

TRANSITION_VIEW when view_name is MFA

\[\*\*view_name\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name)

nullablestring

The name of the view that is being transitioned to. Emitted by:

TRANSITION_VIEW.

Hide object

\[\*\*ACCEPT_TOS\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-ACCEPT-TOS)

The view showing Terms of Service in the identity verification flow.

\[\*\*CONNECTED\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-CONNECTED)

The user has connected their account.

\[\*\*CONSENT\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-CONSENT)

We ask the user to consent to the privacy policy.

\[\*\*CREDENTIAL\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-CREDENTIAL)

Asking the user for their account credentials.

\[\*\*DATA_TRANSPARENCY\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-DATA-TRANSPARENCY)

deprecated

We disclose the data types being shared. This pane is present only in

the beta experience of Data Transparency Messaging; in the General

Availability release, this content is incorporated into the consent pane

instead.

\[\*\*DATA_TRANSPARENCY_CONSENT\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-DATA-TRANSPARENCY-CONSENT)

deprecated

We ask the user to consent to the privacy policy and disclose data types

being shared. This pane is present only in the beta experience of Data

Transparency Messaging; in the General Availability release, this

content is incorporated into the consent pane instead.

\[\*\*DOCUMENTARY_VERIFICATION\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-DOCUMENTARY-VERIFICATION)

The view requesting document verification in the identity verification

flow (configured via \\\"Fallback Settings\\\" in the \\\"Rulesets\\\"
section

of the template editor).

\[\*\*ERROR\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-ERROR)

An error has occurred.

\[\*\*EXIT\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-EXIT)

Confirming if the user wishes to close Link.

\[\*\*KYC_CHECK\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-KYC-CHECK)

The view representing the \\\"know your customer\\\" step in the
identity

verification flow.

\[\*\*LOADING\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-LOADING)

Link is making a request to our servers.

\[\*\*MATCHED_CONSENT\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-MATCHED-CONSENT)

deprecated

We ask the matched user to consent to the privacy policy and SMS terms.

Used only in the legacy version of the Returning User Experience flow.

\[\*\*MATCHED_CREDENTIAL\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-MATCHED-CREDENTIAL)

deprecated

We ask the matched user for their account credentials to a matched

institution. Used only in the legacy version of the Returning User

Experience flow.

\[\*\*MATCHED_MFA\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-MATCHED-MFA)

deprecated

We ask the matched user for MFA authentication to verify their identity.

Used only in the legacy version of the Returning User Experience flow.

\[\*\*MFA\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-MFA)

The user is asked by the institution for additional MFA authentication.

\[\*\*NUMBERS\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-NUMBERS)

The user is asked to insert their account and routing numbers.

\[\*\*NUMBERS_SELECT_INSTITUTION\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-NUMBERS-SELECT-INSTITUTION)

The user goes through the Same Day micro-deposits flow with Reroute to

Credentials.

\[\*\*OAUTH\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-OAUTH)

The user is informed they will authenticate with the financial

institution via OAuth.

\[\*\*RECAPTCHA\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-RECAPTCHA)

The user was presented with a Google reCAPTCHA to verify they are human.

\[\*\*RISK_CHECK\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-RISK-CHECK)

The risk check step in the identity verification flow (configured via

\\\"Risk Rules\\\" in the \\\"Rulesets\\\" section of the template
editor).

\[\*\*SCREENING\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-SCREENING)

The watchlist screening step in the identity verification flow.

\[\*\*SELECT_ACCOUNT\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-SELECT-ACCOUNT)

We ask the user to choose an account.

\[\*\*SELECT_AUTH_TYPE\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-SELECT-AUTH-TYPE)

The user is asked to choose whether to Link instantly or manually (i.e.,

with micro-deposits).

\[\*\*SELECT_BRAND\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-SELECT-BRAND)

The user is asked to select a brand, e.g. Bank of America. The brand

selection interface occurs before the institution select pane and is

only provided for large financial institutions with multiple online

banking portals.

\[\*\*SELECT_INSTITUTION\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-SELECT-INSTITUTION)

We ask the user to choose their institution.

\[\*\*SELECT_SAVED_ACCOUNT\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-SELECT-SAVED-ACCOUNT)

The user is asked to select their saved accounts and/or new accounts for

linking in the Link Returning User Experience flow.

\[\*\*SELECT_SAVED_INSTITUTION\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-SELECT-SAVED-INSTITUTION)

The user is asked to pick a saved institution or link a new one in the

Link Returning User Experience flow.

\[\*\*SELFIE_CHECK\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-SELFIE-CHECK)

The view in the identity verification flow which uses the camera to

confirm there is real user that matches their ID documents.

\[\*\*SUBMIT_PHONE\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-SUBMIT-PHONE)

The user is asked for their phone number in the Link Returning User

Experience flow.

\[\*\*UPLOAD_DOCUMENTS\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-UPLOAD-DOCUMENTS)

The user is asked to upload documents (for Income verification).

\[\*\*VERIFY_PHONE\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-VERIFY-PHONE)

The user is asked to verify their phone in the Link Returning User

Experience flow.

\[\*\*VERIFY_SMS\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-view-name-VERIFY-SMS)

The SMS verification step in the identity verification flow.

\[\*\*request_id\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-request-id)

string

The request ID for the last request made by Link. This can be shared

with Plaid Support to expedite investigation. Emitted by: \*all
events\*.

\[\*\*link_session_id\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-link-session-id)

string

The link_session_id is a unique identifier for a single session of Link.

It\\\'s always available and will stay constant throughout the flow.

Emitted by: \*all events\*.

\[\*\*timestamp\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-timestamp)

string

An ISO 8601 representation of when the event occurred. For example

2017-09-14T14:42:19.350Z. Emitted by: \*all events\*.

\[\*\*selection\*\*\](https://plaid.com/docs/link/web/#link-web-onevent-metadata-selection)

nullablestring

Either the verification method for a matched institution selected by the

user or the Auth Type Select flow type selected by the user. If

selection is used to describe selected verification method, then

possible values are phoneotp or password; if selection is used to

describe the selected Auth Type Select flow, then possible values are

flow_type_manual or flow_type_instant. Emitted by:

MATCHED_SELECT_VERIFY_METHOD and SELECT_AUTH_TYPE.

import {

PlaidLinkOnEvent,

PlaidLinkOnEventMetadata,

PlaidLinkStableEvent,

} from \\\'react-plaid-link\\\';

const onEvent = useCallback\\\<PlaidLinkOnEvent\\\>(

(

eventName: PlaidLinkStableEvent \\\| string,

metadata: PlaidLinkOnEventMetadata,

) =\\\> {

// log eventName and metadata

},

\\\[\\\],

);

{

error_type: \\\'ITEM_ERROR\\\',

error_code: \\\'INVALID_CREDENTIALS\\\',

error_message: \\\'the credentials were not correct\\\',

exit_status: null,

institution_id: \\\'ins_4\\\',

institution_name: \\\'Wells Fargo\\\',

institution_search_query: \\\'wellsf\\\',

mfa_type: null,

view_name: \\\'ERROR\\\'

request_id: \\\'m8MDnv9okwxFNBV\\\',

link_session_id: \\\'30571e9b-d6c6-42ee-a7cf-c34768a8f62d\\\',

timestamp: \\\'2017-09-14T14:42:19.350Z\\\',

selection: null,

}

\[open()\](https://plaid.com/docs/link/web/#open)

Calling¬†open¬†will display the Consent Pane view to your user, starting

the Link flow. Once¬†open¬†is called, you will begin receiving events
via

the¬†\[\[\*\*onEvent\*\*¬†callback\]{.underline}\](https://plaid.com/docs/#onevent).

const { open, exit, ready } = usePlaidLink(config);

// Open Link

if (ready) {

open();

}

\[exit()\](https://plaid.com/docs/link/web/#exit)

The¬†exit¬†function allows you to programmatically close Link.

Calling¬†exit¬†will trigger either

the¬†\[\*\*\[onExit\]{.underline}\*\*\](https://plaid.com/docs/#onexit)¬†or¬†\[\*\*\[onSuccess\]{.underline}\*\*\](https://plaid.com/docs/#onsuccess)¬†callbacks.\\

The¬†exit¬†function takes a single, optional argument, a

configuration¬†Object.

\[\*\*force\*\*\](https://plaid.com/docs/link/web/#link-web-exit-force)

boolean

If true, Link will exit immediately. If false, or the option is not

provided, an exit confirmation screen may be presented to the user.

const { open, exit, ready } = usePlaidLink(config);

// Graceful exit - Link may display a confirmation screen

// depending on how far the user is in the flow

exit();

const { open, exit, ready } = usePlaidLink(config);

// Force exit - Link exits immediately

exit({ force: true });

\[destroy()\](https://plaid.com/docs/link/web/#destroy)

The¬†destroy¬†function allows you to destroy the Link handler instance,

properly removing any DOM artifacts that were created by it.

Use¬†destroy()¬†when creating new replacement Link handler instances in

the¬†onExit¬†callback.

// On unmount usePlaidLink hook automatically destroys any

// existing link instance

\[submit\](https://plaid.com/docs/link/web/#submit)

The¬†submit¬†function is currently only used in the Layer product. It

allows the client application to submit additional user-collected data

to the Link flow (e.g. a user phone number).

\[\*\*phone_number\*\*\](https://plaid.com/docs/link/web/#link-web-submit-phone-number)

string

The user\\\'s phone number.

const { open, exit, submit } = usePlaidLink(config);

// After collecting a user phone number\\\...

submit({

\\\"phone_number\\\": \\\"+14155550123\\\"

});

\[OAuth\](https://plaid.com/docs/link/web/#oauth)

Using Plaid Link with an OAuth flow requires some additional setup

instructions. For details, see the¬†\[\[OAuth

Guide\]{.underline}\](https://plaid.com/docs/link/oauth/).

\[Supported

browsers\](https://plaid.com/docs/link/web/#supported-browsers)

Plaid officially supports Link on the latest versions of Chrome,

Firefox, Safari, and Edge. Browsers are supported on Windows, Mac,

Linux, iOS, and Android. Previous browser versions are also supported,

as long as they are actively maintained; Plaid does not support browser

versions that are no longer receiving patch updates, or that have been

assigned official end of life (EOL) or end of support (EOS) status.

Ad-blocking software is not officially supported with Link web, and some

ad-blockers have known to cause conflicts with Link.

\[Example code in Plaid

Pattern\](https://plaid.com/docs/link/web/#example-code-in-plaid-pattern)

For a real-life example of using Plaid Link for React,

see¬†\[\[LaunchLink.tsx\]{.underline}\](https://github.com/plaid/pattern/blob/master/client/src/components/LaunchLink.tsx).

This file illustrates the code for implementation of Plaid Link for

React for the Node-based¬†\[\[Plaid

Pattern\]{.underline}\](https://github.com/plaid/pattern)¬†sample app.

\[Account

Linking\](https://plaid.com/docs/transfer/creating-transfers/#account-linking)

Before initiating a transfer through Plaid, your end users need to link

a bank account to your app

using¬†\[\[Link\]{.underline}\](https://plaid.com/docs/link/),
Plaid\\\'s

client-side widget. Link will connect the user\\\'s account and obtain
and

verify the account and routing number required to initiate a transfer.

See the¬†\[\[Link

documentation\]{.underline}\](https://plaid.com/docs/link/)¬†for more

details on setting up a Plaid Link session. At a high level, the steps

are:

1\.
Call¬†\[\*\*\[/link/token/create\]{.underline}\*\*\](https://plaid.com/docs/api/link/#linktokencreate),

specifying¬†transfer¬†in the¬†products¬†parameter.

2\. Initialize a Link instance using the¬†link_token¬†created in the

previous step. For more details for your specific platform, see

the¬†\[\[Link

documentation\]{.underline}\](https://plaid.com/docs/link/). The user

will now go through the Link flow.

3\. The¬†onSuccess¬†callback will indicate the user has completed the
Link

flow.

Call¬†\[\*\*\[/item/public_token/exchange\]{.underline}\*\*\](https://plaid.com/docs/api/items/#itempublic_tokenexchange)¬†to

exchange the¬†public_token¬†returned by¬†onSuccess¬†for
an¬†access_token.

You will also need to obtain the¬†account_id¬†of the account you wish

to transfer funds to or from; this can also be obtained from

the¬†metadata.accounts¬†field in the¬†onSuccess¬†callback, or by

calling¬†\[\*\*\[/accounts/get\]{.underline}\*\*\](https://plaid.com/docs/api/accounts/#accountsget).

Once a Plaid Item is created through Link, you can then immediately

process a transfer utilizing that account or initiate the transfer at a

later time.

Several major financial institutions require OAuth connections. Make

sure to complete the OAuth security questionnaire at least three weeks

ahead of time to ensure your connections are enabled by launch. For more

information, see the¬†\[\[OAuth

Guide\]{.underline}\](https://plaid.com/docs/link/oauth/).

\[\*\*Optimizing the Link UI for

Transfer\*\*\](https://plaid.com/docs/transfer/creating-transfers/#optimizing-the-link-ui-for-transfer)

The following Link configuration options are commonly used with

Transfer:

\- \[\*\*\[Account

select\]{.underline}\*\*\](https://plaid.com/docs/link/customization/#account-select):

The \\\"Account Select: Enabled for one account\\\" setting configures

the Link UI so that the end user may only select a single account.

If you are not using this setting, you will need to build your own

UI to let your end user select which linked account they want to use

with Transfer. When using¬†\[\[Transfer

UI\]{.underline}\](https://plaid.com/docs/transfer/using-transfer-ui/),

this setting is mandatory.

\- \[\*\*\[Embedded Institution

Search\]{.underline}\*\*\](https://plaid.com/docs/link/embedded-institution-search/):

This presentation mode shows the Link institution search screen

embedded directly into your UI, before the end user has interacted

with Link. Embedded Institution Search increases end user uptake of

pay-by-bank payment methods and is strongly recommended when

implementing Transfer as part of a pay-by-bank use case where

multiple different payment methods are supported.

\[\*\*Importing account and routing

numbers\*\*\](https://plaid.com/docs/transfer/creating-transfers/#importing-account-and-routing-numbers)

If you are migrating from another payment processor and would like to

import known account and routing numbers into Plaid, planning to

implement a custom account linking UI, or intend to use wire transfers

as a payment rail, contact your account manager about using

the¬†\[\*\*\[/transfer/migrate_account\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/account-linking/#transfermigrate_account)¬†endpoint.

This endpoint will return an¬†access_token¬†and¬†account_id¬†for a given

pair of account and routing numbers. Items created in this way will

always have an authorization decision rationale

of¬†MIGRATED_ACCOUNT_ITEM, since Plaid will be unable to assess transfer

risk for these Items.

\[\*\*Expanding institution

coverage\*\*\](https://plaid.com/docs/transfer/creating-transfers/#expanding-institution-coverage)

To see if an institution supports Transfer, use the institution status

page in the Dashboard or

the¬†\[\*\*\[/institutions/get\]{.underline}\*\*\](https://plaid.com/docs/api/institutions/#institutionsget)¬†endpoint.

If an institution is listed as supporting Auth, it will support

Transfer.

Transfer supports all of the same flows as Auth, including the optional

micro-deposit and database-based flows, which allow you to increase the

number of supported institutions and provide pathways for end users who

can\\\'t or don\\\'t want to log in to their institutions. Items created

with Same Day micro-deposits, Database Insights, or Database Match will

always have an authorization decision rationale

of¬†MANUALLY_VERIFIED_ITEM, since Plaid will be unable to assess
transfer

risk for these Items. For more details about these flows and

instructions on implementing them, see¬†\[\[Full Auth

coverage\]{.underline}\](https://plaid.com/docs/auth/coverage/).

\[Authorizing a

transfer\](https://plaid.com/docs/transfer/creating-transfers/#authorizing-a-transfer)

Before creating a transfer, transfers must pass a risk check and be

authorized by Plaid\\\'s authorization engine. By default, the engine
will

run compliance checks including regulatory and program factors such as

rate limits, prohibited accounts, suspicious behavior, etc. These will

only decline a small portion (\\\<1%) of account and routing numbers.
For

debit ACH, the account balance is also checked to ensure there are

sufficient funds to complete the transfer.

To use Plaid\\\'s authorization engine,

call¬†\[\*\*\[/transfer/authorization/create\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/initiating-transfers/#transferauthorizationcreate).

You will be required to specify the¬†access_token¬†and¬†account_id¬†from
the

account linking step, as well as a¬†user.legal_name, the

transaction¬†amount, the type of the transaction (debitor¬†credit), and

the transaction¬†network¬†(ach,¬†same-day-ach,¬†rtp, or¬†wire¬†\\\-- to

request¬†wire¬†transfers, contact your Account Manager). For ACH

transfers, an¬†ach_class¬†is also required. An¬†idempotency_key¬†is also

strongly recommended to avoid creating duplicate transfers (or being

billed for multiple authorizations). If you are a Platform Payments

(beta) customer, you will also include an¬†originator_client_id. For
more

details on these parameters,

see¬†\[\*\*\[/transfer/authorization/create\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/initiating-transfers/#transferauthorizationcreate)¬†in

the API Reference.

Failure to provide an¬†idempotency_key¬†when

calling¬†\[\*\*\[/transfer/authorization/create\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/initiating-transfers/#transferauthorizationcreate)¬†may

result in duplicate transfers when retrying requests. It is only safe to

omit idempotency keys if you have already built and thoroughly tested

your own logic to avoid creating or processing duplicate authorizations.

Even if you have, idempotency keys are still strongly recommended.

Plaid will

return¬†\\\'approved\\\',¬†\\\'declined\\\'¬†or¬†\\\'user_action_required\\\'¬†as
the

authorization decision along with a¬†decision_rationale¬†and

the¬†authorization_id. If the transaction is approved, you can proceed

to¬†\[\[Initiate the

transfer\]{.underline}\](https://plaid.com/docs/transfer/creating-transfers/#initiating-a-transfer).

Approved authorizations are valid for 1 hour by default, unless

otherwise configured by Plaid support. You may cancel approved

authorizations through

the¬†\[\*\*\[/transfer/authorization/cancel\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/initiating-transfers/#transferauthorizationcancel)¬†endpoint

if you no longer intend to use the authorization. Denied authorizations

will have a¬†code¬†and¬†description¬†in the¬†decision_rationale¬†object
that

provide additional insight.

To avoid blocking

transfers,¬†\[\*\*\[/transfer/authorization/create\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/initiating-transfers/#transferauthorizationcreate)¬†may

authorize transfers as¬†approved¬†in circumstances where Plaid can\\\'t

accurately predict the risk of return. Always monitor

the¬†decision_rationale¬†to understand the full risk of a transfer
before

proceeding to the submission step.

See the table below to understand different scenarios of authorization

decisions.

\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\--

\*\*SCENARIO\*\* \*\*AUTHORIZATION \*\*DECISION RATIONALE CODE\*\*

DECISION\*\*

\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\--
\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\--
\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\--

Plaid performed a balance check approved null

and determined there are

sufficient funds for the

transaction amount

Plaid couldn\\\'t verify the account approved
\\\"MANUALLY_VERIFIED_ITEM\\\"

balance because the item is

created through same-day

micro-deposits

Plaid couldn\\\'t verify the account approved
\\\"MIGRATED_ACCOUNT_ITEM\\\"

balance because the item is

created through the migrate

account endpoint

Plaid couldn\\\'t verify the account approved \\\"ERROR\\\"

balance due to an error

Plaid couldn\\\'t verify the account user_action_required
\\\"ITEM_LOGIN_REQUIRED\\\"

balance because the item went into

a stale state

User-account doesn\\\'t have declined \\\"NSF\\\"

sufficient balance to complete the

debit transfer

Plaid determined the transfer is declined \\\"RISK\\\"

high-risk

Transfer limit(s) such as daily or declined
\\\"TRANSFER_LIMIT_REACHED\\\"

monthly transaction limits are

being exceeded with this transfer

\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\--

\[\*\*Handling¬†user_action_required\*\*\](https://plaid.com/docs/transfer/creating-transfers/#handling-user_action_required)

Sometimes Plaid needs to collect additional user input in order to

properly assess transfer risk. The most common scenario is to fix a

stale Item. In this case, Plaid returns¬†user_action_required¬†as the

authorization decision. To complete the required user action:

1\. Create a new link token

via¬†\[\*\*\[/link/token/create\]{.underline}\*\*\](https://plaid.com/docs/api/link/#linktokencreate).

Instead of providing¬†access_token, you should

set¬†\[\*\*\[transfer.authorization_id\]{.underline}\*\*\](https://plaid.com/docs/api/link/#link-token-create-request-transfer-authorization-id)¬†in

the request.

2\. Initialize Link with the¬†link_token. Link will automatically guide

the user through the necessary steps.

3\. You do not need to repeat the token exchange step in

Link\\\'s¬†onSuccess¬†callback as the Item\\\'s¬†access_token¬†remains

unchanged.

After completing the required user action, you can retry

the¬†\[\*\*\[/transfer/authorization/create\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/initiating-transfers/#transferauthorizationcreate)¬†endpoint

with the same request body. You can even reuse the

same¬†idempotency_key¬†as idempotency does not apply

to¬†user_action_required¬†authorizations.

\[\*\*ACH

Guarantee\*\*\](https://plaid.com/docs/transfer/creating-transfers/#ach-guarantee)

For customers in select industries, Plaid offers an ACH Guarantee that

shields you from bank-initiated ACH returns. If your transfers are

guaranteed with Plaid, an¬†approved¬†decision in the authorization
process

means that the transfer will have the Guarantee applied. To learn more

about Plaid\\\'s ACH Guarantee and whether you are eligible for this

service,¬†\[\[contact
sales\]{.underline}\](https://plaid.com/contact/)¬†or

your Plaid account manager.

\[Initiating a

transfer\](https://plaid.com/docs/transfer/creating-transfers/#initiating-a-transfer)

After assessing a transfer\\\'s risk using the authorization engine and

receiving an approved response, you can proceed to submit the transfer

for processing.

Pass the¬†authorization_id,¬†access_token,¬†account_id, and

a¬†description¬†(a string that will be visible to the user) to

the¬†\[\*\*\[/transfer/create\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/initiating-transfers/#transfercreate)¬†endpoint.

To make a transfer for less than the amount authorized, provide an

optional¬†amount; otherwise the transfer will be made for the full

authorized amount. The¬†authorization_id¬†will also function similarly
to

an idempotency key; attempting to re-use an¬†authorization_id¬†will not

create a new transfer, but will return details about the already created

transfer. You can also provide the optional field¬†metadata¬†to include

internal reference numbers or other information to help you reconcile

the transfer.

\[\*\*\[/transfer/create\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/initiating-transfers/#transfercreate)¬†will

return¬†transfer_id¬†as well as the¬†transfer_status. All transfers
begin

in a¬†pending¬†status. This status changes as the transfer moves through

the payment network. Whenever the status is updated, a Transfer event

will be triggered. To learn more about tracking the status of the

transfer, see¬†\[\[event

monitoring\]{.underline}\](https://plaid.com/docs/transfer/reconciling-transfers/#event-monitoring).

\[\*\*Handling errors in transfer

creation\*\*\](https://plaid.com/docs/transfer/creating-transfers/#handling-errors-in-transfer-creation)

If you receive a retryable error code such as a 500 (Internal Server

Error) or 429 (Too Many Requests) when creating a transfer, you should

retry the transfer; Plaid uses the¬†transfer_id¬†as an idempotency key,
so

you can be guaranteed that retries

to¬†\[\*\*\[/transfer/create\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/initiating-transfers/#transfercreate)¬†will

not result in duplicate transfers.

A request

to¬†\[\*\*\[/transfer/create\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/initiating-transfers/#transfercreate)¬†may

fail with a 500 error even if the transfer is successfully created. You

should not assume that a 500 error response to

a¬†\[\*\*\[/transfer/create\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/initiating-transfers/#transfercreate)¬†call

means that the transfer failed. As a source of truth for the transfer

status, use¬†\[\[Transfer

events\]{.underline}\](https://plaid.com/docs/transfer/reconciling-transfers/).

\[\*\*Initiating an Instant Payout via RTP or

FedNow\*\*\](https://plaid.com/docs/transfer/creating-transfers/#initiating-an-instant-payout-via-rtp-or-fednow)

\*\*Find out more about using Transfer for Instant Payouts in this

3-minute overview\*\*

Initiating an Instant Payout transfer via RTP or FedNow works the same

as initiating an ACH transfer. When initiating an Instant Payout

transfer, specify¬†network=rtp¬†when

calling¬†\[\*\*\[/transfer/authorization/create\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/initiating-transfers/#transferauthorizationcreate).¬†rtp¬†as

the network refers to all real time payment rails; Plaid will

automatically route between Real Time Payment rail by TCH or FedNow

rails as necessary.

Roughly \\\~70% of accounts in the United States can receive Instant

Payouts. If the account is not eligible to receive an Instant

Payout,¬†\[\*\*\[/transfer/authorization/create\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/initiating-transfers/#transferauthorizationcreate)will

return an¬†INVALID_FIELD¬†error code with an error message that the

account is ineligible for Instant Payouts. If you\\\'d like to see if
the

account is eligible for Instant Payouts before

calling¬†\[\*\*\[/transfer/authorization/create\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/initiating-transfers/#transferauthorizationcreate),

use

the¬†\[\*\*\[/transfer/capabilities/get\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/account-linking/#transfercapabilitiesget)¬†endpoint.

Only¬†credit¬†style transfers (where you are sending funds to a user)
can

be sent using Instant Payout transfers.

\[ACH processing

windows\](https://plaid.com/docs/transfer/creating-transfers/#ach-processing-windows)

Transfers that are submitted via

the¬†\[\*\*\[/transfer/create\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/initiating-transfers/#transfercreate)¬†endpoint

will be submitted in the next processing window. For a same-day

transfer, the cutoff time for the last window of the day is 3:30PM

Eastern Time. For a next-day transfer, the cutoff time is 5:30PM Eastern

Time. It is recommended to submit a transfer at least 15 minutes before

the cutoff time to guarantee that it will be processed before the

cutoff.

Note that same-day transfers submitted after 3:30PM Eastern Time and

before 5:30PM Eastern Time will be automatically updated to be next-day

and submitted to the network in that following ACH processing window.

This update applies to sweeps as well. This process minimizes the risk

of return due to insufficient funds by reducing the delay between

Plaid\\\'s balance check and the submission of the transfer to the ACH

network. The settlement time remains the same as it would have been if

the transfer had been submitted in next same-day window.

ACH processing windows are active only on banking days. ACH transfers

will not be submitted to the network on weekends or bank holidays. Keep

this in mind when creating transfers over weekends or on bank holidays.

To mitigate, wait until the next banking day and then authorize and

create the transfer.

See the¬†\[\[flow of

funds\]{.underline}\](https://plaid.com/docs/transfer/flow-of-funds/)¬†overview

for more details on how, and when, funds move.

\[Bank statement

formatting\](https://plaid.com/docs/transfer/creating-transfers/#bank-statement-formatting)

Each bank has discretion in how they format an ACH, RTP, or FedNow

transaction in their bank statements. The most common pattern used

is¬†\\\[Company Name\\\] \\\[Phone Number\\\] \\\[Transfer
Description\\\].

\- \\\[Company Name\\\]¬†is the name provided in your Transfer
application.

This must match a legally registered name for your company.

\- \\\[Phone Number\\\]¬†is the phone number that you provided in your

Transfer application.

\- \\\[Transfer Description\\\]¬†is the string that you passed into the

description field of

your¬†\[\*\*\[/transfer/create\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/initiating-transfers/#transfercreate)¬†request.

To request a change to your phone number or company name,
please¬†\[\[file

a support

ticket\]{.underline}\](https://dashboard.plaid.com/support/new/product-and-development/product-troubleshooting/product-functionality).

\[Cancelling

transfers\](https://plaid.com/docs/transfer/creating-transfers/#cancelling-transfers)

To cancel a previously created transfer, call

the¬†\[\*\*\[/transfer/cancel\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/initiating-transfers/#transfercancel)¬†endpoint

with the appropriate¬†transfer_id. Note that once Plaid has sent the

transfer to the payment network, it cannot be cancelled. Practically

speaking, this means that Instant Payouts via RTP/FedNow cannot be

cancelled, as these transfers are immediately sent to the payment

network. You can check use the¬†cancellable¬†property found

via¬†\[\*\*\[/transfer/get\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transferget)¬†to

determine if a transfer is eligible for cancellation.

\[Sweeping funds to funding

accounts\](https://plaid.com/docs/transfer/creating-transfers/#sweeping-funds-to-funding-accounts)

There are two types of bank accounts in the Plaid Transfer system.

The first is a consumer checking and savings account connected via Plaid

Link, where you are pulling money from or issuing a payout to. In the

Transfer API, this account is represented by

an¬†access_token¬†and¬†account_id¬†of a Plaid Item. A \\\"transfer\\\"
is an

intent to move money to or from this account.

The second type of account involved is your own business checking

account, which is linked to your Plaid Ledger. This account is

configured with Plaid Transfer during your onboarding by using the

details provided in your application. A \\\"sweep\\\" pushes money into,
or

pulls money from, a business checking account. For example, funding your

Plaid Ledger account by

calling¬†\[\*\*\[/transfer/ledger/deposit\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/ledger/#transferledgerdeposit)¬†will

trigger a sweep event.

Sweeps can be observed via

the¬†\[\*\*\[/transfer/sweep/list\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfersweeplist)¬†and¬†\[\*\*\[/transfer/sweep/get\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfersweepget)endpoints.

If you are using the¬†\[\[legacy funding

flows\]{.underline}\](https://plaid.com/docs/transfer/legacy-flow-of-funds/)¬†method

instead of Plaid Ledger, a transfer will automatically kick off the

appropriate sweep to complete the flow of funds. For example, if a

number of transfers are initiated to pull money from consumer accounts,

a single sweep will then be generated to push the aggregate funds. For

more details, see the¬†\[\[legacy flow of

funds\]{.underline}\](https://plaid.com/docs/transfer/legacy-flow-of-funds/).

\[Transfer

limits\](https://plaid.com/docs/transfer/creating-transfers/#transfer-limits)

When you sign up with Plaid Transfer, you will be assigned transfer

limits, which are placed on your authorization usage. These limits are

initially assigned based on the volume expectations you provide in your

transfer application. When you successfully create an authorization

using¬†\[\*\*\[/transfer/authorization/create\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/initiating-transfers/#transferauthorizationcreate),

the amount authorized will be counted against your limits. Authorized

amounts that aren\'t used will stop counting towards your limits if the

authorization expires or is canceled

(via¬†\[\*\*\[/transfer/authorization/cancel\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/initiating-transfers/#transferauthorizationcancel)).

Any authorization you attempt to create over your limits will be

automatically declined.

\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\--

\*\*LIMIT\*\* \*\*DEBIT\*\* \*\*CREDIT\*\*

\-\-\-\-\-\-\-\-\-\--
\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\--
\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\--

Single The maximum amount of a single The maximum amount of a single

Transfer debit transfer authorization credit transfer authorization

Daily The maximum amount of debit The maximum amount of credit

transfers you may authorize in transfers you may authorize in

a calendar day a calendar day

Monthly The maximum amount of debit The maximum amount of credit

transfers you may authorize in transfers you may authorize in

a calendar month a calendar month

\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\--

Daily limits refresh every day and monthly limits refresh on the first

day of the month at 12:00 AM EST.

\[\*\*Limit

monitoring\*\*\](https://plaid.com/docs/transfer/creating-transfers/#limit-monitoring)

You can view your current limits on the \"Account Details\" page in

the¬†\[\[Transfer

Dashboard\]{.underline}\](https://dashboard.plaid.com/transfer). You can

monitor your usage against your daily and monthly limits via the Account

Information widget on the Overview page. You can also monitor your

authorization limits and usage through the Transfer APIs.

The¬†\[\*\*\[/transfer/configuration/get\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/metrics/#transferconfigurationget)¬†endpoint

returns your configurations for each of the transfer limits.

The¬†\[\*\*\[/transfer/metrics/get\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/metrics/#transfermetricsget)¬†endpoint

contains information about your daily and monthly authorization usage

for credit and debit transfers.

Plaid will also send you automatic email notifications when your

utilization is approaching your limits. If your daily utilization

exceeds 85% of your daily limits or your monthly utilization exceeds 80%

of your monthly limits, you will receive automated email alerts. These

alerts will be sent to your ACH, Technical, and Billing contacts. You

can configure those contacts via the¬†\[\[Company

Profile\]{.underline}\](https://dashboard.plaid.com/settings/company/compliance?tab=companyProfile)¬†page

on the Plaid dashboard.

Any call

to¬†\[\*\*\[/transfer/authorization/create\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/initiating-transfers/#transferauthorizationcreate)¬†that

will cause you to exceed your limits will return the

decision¬†\\\"declined\\\"¬†with the decision rationale code set

to¬†TRANSFER_LIMIT_REACHED. The rationale description identifies which

specific limit has been reached.

\# \[
\](https://plaid.com/docs/transfer/creating-transfers/#requesting-limit-changes)\*\*Monitoring
transfers\*\*

Monitor for updates to transfers, sweeps, and refunds

\[Event

monitoring\](https://plaid.com/docs/transfer/reconciling-transfers/#event-monitoring)

Plaid creates a transfer event any time the¬†transfer.status¬†changes.
For

example, when a transfer is sent to the payment network,

the¬†transfer.status¬†moves to¬†postedand a¬†posted¬†event is emitted.

Likewise, when an¬†\[\[ACH

return\]{.underline}\](https://plaid.com/resources/ach/ach-return/)¬†is

received, a¬†returnedevent will be emitted as the¬†transfer.status¬†is

updated. By monitoring transfer events, you can stay informed about

their current status and notify customers in case of a canceled, failed,

or returned transfer. When¬†transfer.status¬†moves to¬†settled, you can

safely expect that the consumer can see the transaction reflected in

their personal bank account.

Events are also emitted for changes to a sweep\\\'s and

refund\\\'s¬†status¬†property. These events follow

an¬†\\\[object\\\].\\\[status\\\]¬†format, such
as¬†sweep.posted¬†and¬†refund.posted.

\[Ingesting event

updates\](https://plaid.com/docs/transfer/reconciling-transfers/#ingesting-event-updates)

Most integrations proactively monitor all events for every transfer.

This allows you to respond to transfer events with business logic

operations, such as:

\- Kicking off the fulfillment of an order once the transfer has

settled

\- Making funds available to your end consumers for use in your

application

\- Monitoring returns to know when to claw these services back, or

retry the transfer

To do this, set up Transfer webhooks to listen for updates as they

happen. You must register a URL to enable webhooks to be sent.

You can do this in the¬†\[\[webhook settings

page\]{.underline}\](https://dashboard.plaid.com/team/webhooks)¬†of the

Plaid Dashboard. Click¬†\*\*New Webhook\*\*¬†and specify a webhook URL
for a

\\\"Transfer Webhook\\\". You must be enabled for Production access to

Transfer in order to access this option. To confirm that your endpoint

has been correctly configured, you can trigger a test webhook

via¬†\[\*\*\[/sandbox/transfer/fire_webhook\]{.underline}\*\*\](https://plaid.com/docs/api/sandbox/#sandboxtransferfire_webhook).

Now, every time there are new transfer events, Plaid will fire a

notification webhook.

{

\\\"webhook_type\\\": \\\"TRANSFER\\\",

\\\"webhook_code\\\": \\\"TRANSFER_EVENTS_UPDATE\\\",

\\\"environment\\\": \\\"production\\\"

}

To receive details about the event,

call¬†\[\*\*\[/transfer/event/sync\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfereventsync).

{

\\# Return the next 20 transfer events after the transfer event with id
4

\\\"after_id\\\": \\\"4\\\",

\\\"count\\\": \\\"20\\\"

}

You can then store the highest¬†event_id¬†returned by the response and
use

that value as the¬†after_id¬†the next time you

call¬†\[\*\*\[/transfer/event/sync\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfereventsync)¬†to

get only the new events.

Note that webhooks don\\\'t contain any identifying information about
what

transfer has updated; only that an update happened. As an alternative to

listening to webhooks, your application could also

call¬†\[\*\*\[/transfer/event/sync\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfereventsync)¬†on

a regular basis to process the most recent batch of Transfer events.

For a real-life example of an app that incorporates the transfer webhook

and tests it using

the¬†\[\*\*\[/sandbox/transfer/fire_webhook\]{.underline}\*\*\](https://plaid.com/docs/api/sandbox/#sandboxtransferfire_webhook)¬†endpoint,

see the Node-based¬†\[\[Plaid Pattern

Transfer\]{.underline}\](https://github.com/plaid/pattern-transfers)¬†sample

app. Pattern Transfer is a sample subscriptions payment app that enables

ACH bank transfers. The Transfer webhook handler can be found

in¬†\[\[handleTransferWebhook.js\]{.underline}\](https://github.com/plaid/pattern-transfers/blob/master/server/webhookHandlers/handleTransferWebhook.js)¬†and

the test which fires the webhook can be found

at¬†\[\[events.js\]{.underline}\](https://github.com/plaid/pattern-transfers/blob/master/server/routes/events.js).

\[Filtering for specific

events\](https://plaid.com/docs/transfer/reconciling-transfers/#filtering-for-specific-events)

Calling¬†\[\*\*\[/transfer/event/list\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfereventlist)¬†will

get a list of transfer events based on specified filter criteria. For

example, you could search for all events for a specific¬†transfer_id. If

you do not specify any filter criteria, this endpoint will return the

latest 25 transfer events.

You can apply filters to only fetch specific event types, events for a

specific transfer type, a specific sweep, etc.

{

\\\"transfer_events\\\": \\\[

{

\\\"account_id\\\": \\\"3gE5gnRzNyfXpBK5wEEKcymJ5albGVUqg77gr\\\",

\\\"transfer_amount\\\": \\\"12.34\\\",

\\\"transfer_id\\\": \\\"460cbe92-2dcc-8eae-5ad6-b37d0ec90fd9\\\",

\\\"transfer_type\\\": \\\"credit\\\",

\\\"event_id\\\": 1,

\\\"event_type\\\": \\\"pending\\\",

\\\"failure_reason\\\": null,

\\\"origination_account_id\\\": null,

\\\"originator_client_id\\\": null,

\\\"refund_id\\\": null,

\\\"sweep_amount\\\": null,

\\\"sweep_id\\\": null,

\\\"timestamp\\\": \\\"2019-12-09T17:27:15Z\\\"

}

\\\],

\\\"request_id\\\": \\\"mdqfuVxeoza6mhu\\\"

}

\[Reconciling sweeps with your bank

account\](https://plaid.com/docs/transfer/reconciling-transfers/#reconciling-sweeps-with-your-bank-account)

As Plaid moves money in and out of your business account as you process

transfers and cashout the Plaid Ledger balance, you might want to match

the account activity in your bank account with the associated transfers.

Plaid will deposit or draw money from your business checking account in

the form of

a¬†\[\[sweep\]{.underline}\](https://plaid.com/docs/transfer/creating-transfers/#sweeping-funds-to-funding-accounts).

This means that any time you are interacting with your bank statement,

you are viewing sweeps, not specific transfers.

To match an entry in your bank account with a sweep in Plaid\\\'s
records,

Plaid ensures the first 8 characters of the sweep\\\'s¬†sweep_id¬†will
show

up on your bank statements. For example, consider the following entries

in your bank account from Plaid:

\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\--

\*\*ENTRY\*\* \*\*AMOUNT\*\* \*\*DATE\*\*

\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\--
\-\-\-\-\-\-\-\-\-\-\-\-\--
\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\--

PLAID 6c036ea0 CCD -\\\$5,264.62 November 18, 2022

PLAID ae42c210 CCD \\\$2,367.80 November 16, 2022

PLAID 550c85fc CCD \\\$6,007.49 November 10, 2022

\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\--

You can use this 8 character string from your bank statement to search

for the sweep in your Plaid Transfer dashboard. On your dashboard, you

can view the sweep details.

You can also do the same lookup via API. Once you identify and isolate

the sweep prefix (such as¬†6c036ea0), pass it

to¬†\[\*\*\[/transfer/sweep/list\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfersweeplist)¬†to

obtain the full sweep object.

curl -X POST https://production.plaid.com/transfer/sweep/list \\\\

-H \\\'Content-Type: application/json\\\' \\\\

-d \\\'{

\\\"sweep_id\\\": \\\"6c036ea0\\\"

}\\\'

{

\\\"sweeps\\\": \\\[

{

\\\"id\\\": \\\"d5394a4d-0b04-4a02-9f4a-7ca5c0f52f9d\\\",

\\\"funding_account_id\\\":
\\\"8945fedc-e703-463d-86b1-dc0607b55460\\\",

\\\"created\\\": \\\"2019-12-09T17:27:15Z\\\",

\\\"amount\\\": \\\"-12.34\\\",

\\\"iso_currency_code\\\": \\\"USD\\\",

\\\"settled\\\": \\\"2019-12-10\\\",

\\\"status\\\": \\\"settled\\\",

\\\"originator_client_id\\\": null

}

\\\],

\\\"request_id\\\": \\\"saKrIBuEB9qJZno\\\"

}

To follow the lifecycle of a sweep, and monitor funds coming into and

out of your business checking account, observe the¬†sweep.\\\*¬†events
in

the¬†\[\*\*\[/transfer/event/sync\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfereventsync)endpoint.

\[Performing financial reconciliation

audits\](https://plaid.com/docs/transfer/reconciling-transfers/#performing-financial-reconciliation-audits)

For information on performing financial reconciliation audits,

see¬†\[\[Report

extraction\]{.underline}\](https://plaid.com/docs/transfer/dashboard/#report-extraction).

\*\*API Reference\*\*

Comprehensive reference for integrating with Plaid API endpoints

\[API endpoints and

webhooks\](https://plaid.com/docs/api/#api-endpoints-and-webhooks)

For documentation on specific API endpoints and webhooks, use the

navigation menu or search.

\[API access\](https://plaid.com/docs/api/#api-access)

To gain access to the Plaid API, create an account on the¬†\[\[Plaid

Dashboard\]{.underline}\](https://dashboard.plaid.com). Once you\'ve

completed the signup process and acknowledged our terms, we\'ll provide
a

live¬†client_id¬†and¬†secret¬†via the Dashboard.

\[API protocols and

headers\](https://plaid.com/docs/api/#api-protocols-and-headers)

The Plaid API is JSON over HTTP. Requests are POST requests, and

responses are JSON, with errors indicated in response bodies

as¬†error_code¬†and¬†error_type¬†(use these in preference to HTTP status

codes for identifying application-level errors). All responses come as

standard JSON, with a small subset returning binary data where

appropriate. The Plaid API is served over HTTPS TLS v1.2+ to ensure data

privacy; HTTP and HTTPS with TLS versions below 1.2 are not supported.

Clients must use an up to date root certificate bundle as the only TLS

verification path; certificate pinning should never be used. All

requests must include a¬†Content-Type¬†of¬†application/jsonand the body

must be valid JSON.¬†

Almost all Plaid API endpoints require a¬†client_id¬†and¬†secret. These
may

be sent either in the request body or in the

headers¬†PLAID-CLIENT-ID¬†and¬†PLAID-SECRET.

Every Plaid API response includes a¬†request_id, either in the body or

(in the case of endpoints that return binary data, such

as¬†\[\*\*\[/asset_report/pdf/get\]{.underline}\*\*\](https://plaid.com/docs/api/products/assets/#asset_reportpdfget))

in the response headers. For faster support, include
the¬†request_id¬†when

contacting support regarding a specific API call.

\[API host\](https://plaid.com/docs/api/#api-host)

https://sandbox.plaid.com (Sandbox)

https://production.plaid.com (Production)

Plaid has two environments: Sandbox and Production. Items cannot be

moved between environments. The Sandbox environment supports only test

Items. You can¬†\[\[request Production API

access\]{.underline}\](https://dashboard.plaid.com/overview/production)¬†via

the Dashboard.

\[API status and

incidents\](https://plaid.com/docs/api/#api-status-and-incidents)

API status is available

at¬†\[\[status.plaid.com\]{.underline}\](https://status.plaid.com).

API status and incidents are also available programmatically via the

following endpoints:

\-
\[\[https://status.plaid.com/api/v2/status.json\]{.underline}\](https://status.plaid.com/api/v2/status.json)¬†for

current status

\-
\[\[https://status.plaid.com/api/v2/incidents.json\]{.underline}\](https://status.plaid.com/api/v2/incidents.json)¬†for

current and historical incidents

For a complete list of all API status information available

programmatically, as well as more information on using these endpoints,

see the¬†\[\[Atlassian Status API

documentation\]{.underline}\](https://status.atlassian.com/api).

For information on institution-specific status, see¬†\[\[Troubleshooting

institution

status\]{.underline}\](https://plaid.com/docs/account/activity/#troubleshooting-institution-status).

\[Storing API data\](https://plaid.com/docs/api/#storing-api-data)

Any token returned by the API is sensitive and should be stored

securely. Except for the¬†public_token¬†and¬†link_token, all Plaid
tokens

are long-lasting and should never be exposed on the client side.

Consumer data obtained from the Plaid API is sensitive information and

should be managed accordingly. For guidance and best practices on how to

store and handle sensitive data, see the¬†\[\[Open Finance Security Data

Standard\]{.underline}\](https://ofdss.org/#documents).

Identifiers used by the Plaid API that do not contain consumer data and

are not keys or tokens are designed for usage in less sensitive

contexts. The most common of these identifiers are

the¬†account_id,¬†item_id,¬†link_session_id, and¬†request_id. These

identifiers are commonly used for logging and debugging purposes.

\[API field formats\](https://plaid.com/docs/api/#api-field-formats)

\[\*\*Strings\*\*\](https://plaid.com/docs/api/#strings)

Many string fields returned by Plaid APIs are reported exactly as

returned by the financial institution. For this reason, Plaid does not

have maximum length limits or standardized formats for strings returned

by the API. In practice, field lengths of 280 characters will generally

be adequate for storing returned strings, although Plaid does not

guarantee this as a maximum string length.

\[\*\*Numbers and
money\*\*\](https://plaid.com/docs/api/#numbers-and-money)

Plaid returns all currency values as decimal values in dollars (or the

equivalent for the currency being used), rather than as integers. In

some cases, it may be possible for a money value returned by the Plaid

API to have more than two digits of precision \\\-- this is common, for

example, when reporting crypto balances.

\[OpenAPI definition

file\](https://plaid.com/docs/api/#openapi-definition-file)

OpenAPI is a standard format for describing RESTful APIs that allows

those APIs to be integrated with tools for a wide variety of

applications, including testing, client library generation, IDE

integration, and more. The Plaid API is specified in our¬†\[\[Plaid
OpenAPI

GitHub repo\]{.underline}\](https://github.com/plaid/plaid-openapi).

\[\\

\](https://plaid.com/docs/api/#postman-collection)
