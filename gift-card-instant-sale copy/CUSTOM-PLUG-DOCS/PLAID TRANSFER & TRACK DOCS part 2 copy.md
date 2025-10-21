As an alternative to adding Items via Link, you can also use

the \[\*\*\[/transfer/migrate_account\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/account-linking/#transfermigrate_account) endpoint

to migrate known account and routing numbers to Plaid Items. This

endpoint is also required when adding an Item for use with wire

transfers; if you intend to create wire transfers on this account, you

must provide wire_routing_number. Note that Items created in this way

are not compatible with endpoints for other products, such

as \[\*\*\[/accounts/balance/get\]{.underline}\*\*\](https://plaid.com/docs/api/products/balance/#accountsbalanceget),

and can only be used with Transfer endpoints. If you require access to

other endpoints, create the Item through Link instead. Access

to \[\*\*\[/transfer/migrate_account\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/account-linking/#transfermigrate_account) is

not enabled by default; to obtain access, contact your Plaid Account

Manager.

\*\*Request fields\*\*

\[\*\*client_id\*\*\](https://plaid.com/docs/api/products/transfer/account-linking/#transfer-migrate_account-request-client-id)

string

Your Plaid API client_id. The client_id is required and may be provided

either in the PLAID-CLIENT-ID header or as part of a request body.

\[\*\*secret\*\*\](https://plaid.com/docs/api/products/transfer/account-linking/#transfer-migrate_account-request-secret)

string

Your Plaid API secret. The secret is required and may be provided either

in the PLAID-SECRET header or as part of a request body.

\[\*\*account_number\*\*\](https://plaid.com/docs/api/products/transfer/account-linking/#transfer-migrate_account-request-account-number)

requiredstring

The user\\\'s account number.

\[\*\*routing_number\*\*\](https://plaid.com/docs/api/products/transfer/account-linking/#transfer-migrate_account-request-routing-number)

requiredstring

The user\\\'s routing number.

\[\*\*wire_routing_number\*\*\](https://plaid.com/docs/api/products/transfer/account-linking/#transfer-migrate_account-request-wire-routing-number)

string

The user\\\'s wire transfer routing number. This is the ABA number; for

some institutions, this may differ from the ACH number used in

routing_number. This field must be set for the created item to be

eligible for wire transfers.

\[\*\*account_type\*\*\](https://plaid.com/docs/api/products/transfer/account-linking/#transfer-migrate_account-request-account-type)

requiredstring

The type of the bank account (checking or savings).

const request: TransferMigrateAccountRequest = {

account_number: \\\'100000000\\\',

routing_number: \\\'121122676\\\',

account_type: \\\'checking\\\',

};

try {

const response = await plaidClient.transferMigrateAccount(request);

const access_token = response.data.access_token;

} catch (error) {

// handle error

}

\*\*Response fields\*\* and example

\[\*\*access_token\*\*\](https://plaid.com/docs/api/products/transfer/account-linking/#transfer-migrate_account-response-access-token)

string

The Plaid access_token for the newly created Item.

\[\*\*account_id\*\*\](https://plaid.com/docs/api/products/transfer/account-linking/#transfer-migrate_account-response-account-id)

string

The Plaid account_id for the newly created Item.

\[\*\*request_id\*\*\](https://plaid.com/docs/api/products/transfer/account-linking/#transfer-migrate_account-response-request-id)

string

A unique identifier for the request, which can be used for

troubleshooting. This identifier, like all Plaid identifiers, is case

sensitive.

{

\\\"access_token\\\":

\\\"access-sandbox-435beced-94e8-4df3-a181-1dde1cfa19f0\\\",

\\\"account_id\\\": \\\"zvyDgbeeDluZ43AJP6m5fAxDlgoZXDuoy5gjN\\\",

\\\"request_id\\\": \\\"mdqfuVxeoza6mhu\\\"

}

Search or Ask a Question

\![Ask Bill!\](media/image1.png){width=\"0.3527777777777778in\"

height=\"0.3527777777777778in\"}

\[\*\*\[Plaid.com\]{.underline}\*\*\](https://plaid.com/)

\[\*\*Log in\*\*\](https://dashboard.plaid.com/signin?redirect=docs)

\[\*\*Get API Keys\*\*\](https://dashboard.plaid.com/signup)

\*\*Open nav\*\*

\*\*Reading Transfers and Transfer events\*\*

API reference for Transfer read and Transfer event endpoints and

webhooks

\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\--

\*\*READING TRANSFERS\*\*

\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\--
\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\--

\[\[/transfer/get\]{.underline}\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transferget)
Retrieve information about a transfer

\[\[/transfer/list\]{.underline}\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transferlist)
Retrieve a list of transfers and their statuses

\[\[/transfer/event/list\]{.underline}\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfereventlist)
Retrieve a list of transfer events

\[\[/transfer/event/sync\]{.underline}\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfereventsync)
Sync transfer events

\[\[/transfer/sweep/get\]{.underline}\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfersweepget)
Retrieve information about a sweep

\[\[/transfer/sweep/list\]{.underline}\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfersweeplist)
Retrieve a list of sweeps

\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\--

\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\--

\*\*WEBHOOKS\*\*

\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\--
\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\--

\[\[TRANSFER_EVENTS_UPDATE\]{.underline}\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer_events_update)
New transfer events available

\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\--

\[Endpoints\](https://plaid.com/docs/api/products/transfer/reading-transfers/#endpoints)

\[\*\*/transfer/get\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transferget)

\[Retrieve a

transfer\](https://plaid.com/docs/api/products/transfer/reading-transfers/#retrieve-a-transfer)

The \[\*\*\[/transfer/get\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transferget) endpoint

fetches information about the transfer corresponding to the

given transfer_id or authorization_id. One

of transfer_id or authorization_idmust be populated but not both.

\*\*Request fields\*\*

\[\*\*client_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-request-client-id)

string

Your Plaid API client_id. The client_id is required and may be provided

either in the PLAID-CLIENT-ID header or as part of a request body.

\[\*\*secret\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-request-secret)

string

Your Plaid API secret. The secret is required and may be provided either

in the PLAID-SECRET header or as part of a request body.

\[\*\*transfer_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-request-transfer-id)

string

Plaid\'s unique identifier for a transfer.

\[\*\*authorization_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-request-authorization-id)

string

Plaid\'s unique identifier for a transfer authorization.

const request: TransferGetRequest = {

transfer_id: \\\'460cbe92-2dcc-8eae-5ad6-b37d0ec90fd9\\\',

};

try {

const response = await plaidClient.transferGet(request);

const transfer = response.data.transfer;

} catch (error) {

// handle error

}

\*\*Response fields\*\* and example

Collapse all

\[\*\*transfer\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer)

object

Represents a transfer within the Transfers API.

Hide object

\[\*\*id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-id)

string

Plaid\'s unique identifier for a transfer.

\[\*\*authorization_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-authorization-id)

string

Plaid\'s unique identifier for a transfer authorization.

\[\*\*ach_class\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-ach-class)

string

Specifies the use case of the transfer. Required for transfers on an ACH

network.\\

Codes supported for credits: ccd, ppd Codes supported for debits: ccd,

tel, web\\

\\\"ccd\\\" - Corporate Credit or Debit - fund transfer between two

corporate bank accounts\\

\\\"ppd\\\" - Prearranged Payment or Deposit - the transfer is part of a

pre-existing relationship with a consumer, e.g. bill payment\\

\\\"tel\\\" - Telephone-Initiated Entry\\

\\\"web\\\" - Internet-Initiated Entry - debits from a consumer\'s
account

where their authorization is obtained over the Internet

Possible values: ccd, ppd, tel, web

\[\*\*account_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-account-id)

string

The Plaid account_id corresponding to the end-user account that will be

debited or credited.

\[\*\*funding_account_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-funding-account-id)

nullablestring

The id of the associated funding account, available in the Plaid

Dashboard. If present, this indicates which of your business checking

accounts will be credited or debited.

\[\*\*ledger_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-ledger-id)

nullablestring

Plaid\'s unique identifier for a Plaid Ledger Balance.

\[\*\*type\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-type)

string

The type of transfer. This will be either debit or credit. A debit

indicates a transfer of money into the origination account; a credit

indicates a transfer of money out of the origination account.

Possible values: debit, credit

\[\*\*user\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-user)

object

The legal name and other information for the account holder.

Hide object

\[\*\*legal_name\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-user-legal-name)

string

The user\\\'s legal name.

\[\*\*phone_number\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-user-phone-number)

nullablestring

The user\\\'s phone number.

\[\*\*email_address\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-user-email-address)

nullablestring

The user\\\'s email address.

\[\*\*address\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-user-address)

nullableobject

The address associated with the account holder.

Hide object

\[\*\*street\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-user-address-street)

nullablestring

The street number and name (i.e., \\\"100 Market St.\\\").

\[\*\*city\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-user-address-city)

nullablestring

Ex. \\\"San Francisco\\\"

\[\*\*region\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-user-address-region)

nullablestring

The state or province (e.g., \\\"CA\\\").

\[\*\*postal_code\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-user-address-postal-code)

nullablestring

The postal code (e.g., \\\"94103\\\").

\[\*\*country\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-user-address-country)

nullablestring

A two-letter country code (e.g., \\\"US\\\").

\[\*\*amount\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-amount)

string

The amount of the transfer (decimal string with two digits of precision

e.g. \\\"10.00\\\"). When calling /transfer/authorization/create,
specify

the maximum amount to authorize. When calling /transfer/create, specify

the exact amount of the transfer, up to a maximum of the amount

authorized. If this field is left blank when calling /transfer/create,

the maximum amount authorized in the authorization_id will be sent.

\[\*\*description\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-description)

string

The description of the transfer.

\[\*\*created\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-created)

string

The datetime when this transfer was created. This will be of the form

2006-01-02T15:04:05Z

Format: date-time

\[\*\*status\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-status)

string

The status of the transfer.\\

pending: A new transfer was created; it is in the pending state. posted:

The transfer has been successfully submitted to the payment network.

settled: Credits are available to be withdrawn or debits have been

deducted from the Plaid linked account. funds_available: Funds from the

transfer have been released from hold and applied to the ledger\\\'s

available balance. (Only applicable to ACH debits.) cancelled: The

transfer was cancelled by the client. failed: The transfer failed, no

funds were moved. returned: A posted transfer was returned.

Possible values: pending, posted, settled, funds_available, cancelled,

failed, returned

\[\*\*sweep_status\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-sweep-status)

nullablestring

The status of the sweep for the transfer.\\

unswept: The transfer hasn\\\'t been swept yet. swept: The transfer was

swept to the sweep account. swept_settled: Credits are available to be

withdrawn or debits have been deducted from the customer\'s business

checking account. return_swept: The transfer was returned, funds were

pulled back or pushed back to the sweep account. null: The transfer will

never be swept (e.g. if the transfer is cancelled or returned before

being swept)

Possible values: null, unswept, swept, swept_settled, return_swept

\[\*\*network\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-network)

string

The network or rails used for the transfer.\\

For transfers submitted as ach, the next-day cutoff is 5:30 PM Eastern

Time.\\

For transfers submitted as same-day-ach, the same-day cutoff is 3:30 PM

Eastern Time. If the transfer is submitted after this cutoff but before

the next-day cutoff, it will be sent over next-day rails and will not

incur same-day charges; this will apply to both legs of the transfer if

applicable.\\

For transfers submitted as rtp, Plaid will automatically route between

Real Time Payment rail by TCH or FedNow rails as necessary. If a

transfer is submitted as rtp and the counterparty account is not

eligible for RTP, the /transfer/authorization/create request will fail

with an INVALID_FIELD error code. To pre-check to determine whether a

counterparty account can support RTP, call /transfer/capabilities/get

before calling /transfer/authorization/create.\\

Wire transfers are currently in early availability. To request access to

wire as a payment network, contact your Account Manager. For transfers

submitted as wire, the type must be credit; wire debits are not

supported.

Possible values: ach, same-day-ach, rtp, wire

\[\*\*wire_details\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-wire-details)

nullableobject

Information specific to wire transfers.

Hide object

\[\*\*message_to_beneficiary\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-wire-details-message-to-beneficiary)

nullablestring

Additional information from the wire originator to the beneficiary. Max

140 characters.

\[\*\*cancellable\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-cancellable)

boolean

When true, you can still cancel this transfer.

\[\*\*failure_reason\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-failure-reason)

nullableobject

The failure reason if the event type for a transfer is \\\"failed\\\" or

\\\"returned\\\". Null value otherwise.

Hide object

\[\*\*ach_return_code\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-failure-reason-ach-return-code)

nullablestring

The ACH return code, e.g. R01. A return code will be provided if and

only if the transfer status is returned. For a full listing of ACH

return codes, see \[\[Transfer

errors\]{.underline}\](https://plaid.com/docs/errors/transfer/#ach-return-codes).

\[\*\*description\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-failure-reason-description)

string

A human-readable description of the reason for the failure or reversal.

\[\*\*metadata\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-metadata)

nullableobject

The Metadata object is a mapping of client-provided string fields to any

string value. The following limitations apply: The JSON values must be

Strings (no nested JSON objects allowed) Only ASCII characters may be

used Maximum of 50 key/value pairs Maximum key length of 40 characters

Maximum value length of 500 characters

\[\*\*iso_currency_code\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-iso-currency-code)

string

The currency of the transfer amount, e.g. \\\"USD\\\"

\[\*\*standard_return_window\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-standard-return-window)

nullablestring

The date 3 business days from settlement date indicating the following

ACH returns can no longer happen: R01, R02, R03, R29. This will be of

the form YYYY-MM-DD.

Format: date

\[\*\*unauthorized_return_window\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-unauthorized-return-window)

nullablestring

The date 61 business days from settlement date indicating the following

ACH returns can no longer happen: R05, R07, R10, R11, R51, R33, R37,

R38, R51, R52, R53. This will be of the form YYYY-MM-DD.

Format: date

\[\*\*expected_settlement_date\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-expected-settlement-date)

nullablestring

The expected date when the full amount of the transfer settles at the

consumers\' account, if the transfer is credit; or at the customer\\\'s

business checking account, if the transfer is debit. Only set for ACH

transfers and is null for non-ACH transfers. Only set for ACH transfers.

This will be of the form YYYY-MM-DD.

Format: date

\[\*\*originator_client_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-originator-client-id)

nullablestring

The Plaid client ID that is the originator of this transfer. Only

present if created on behalf of another client as a \[\[Platform

customer\]{.underline}\](https://plaid.com/docs/transfer/application/#originators-vs-platforms).

\[\*\*refunds\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-refunds)

\\\[object\\\]

A list of refunds associated with this transfer.

Hide object

\[\*\*id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-refunds-id)

string

Plaid\'s unique identifier for a refund.

\[\*\*transfer_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-refunds-transfer-id)

string

The ID of the transfer to refund.

\[\*\*amount\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-refunds-amount)

string

The amount of the refund (decimal string with two digits of precision

e.g. \\\"10.00\\\").

\[\*\*status\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-refunds-status)

string

The status of the refund.\\

pending: A new refund was created; it is in the pending state. posted:

The refund has been successfully submitted to the payment network.

settled: Credits have been refunded to the Plaid linked account.

cancelled: The refund was cancelled by the client. failed: The refund

has failed. returned: The refund was returned.

Possible values: pending, posted, cancelled, failed, settled, returned

\[\*\*failure_reason\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-refunds-failure-reason)

nullableobject

The failure reason if the event type for a refund is \\\"failed\\\" or

\\\"returned\\\". Null value otherwise.

Hide object

\[\*\*ach_return_code\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-refunds-failure-reason-ach-return-code)

nullablestring

The ACH return code, e.g. R01. A return code will be provided if and

only if the refund status is returned. For a full listing of ACH return

codes, see \[\[Transfer

errors\]{.underline}\](https://plaid.com/docs/errors/transfer/#ach-return-codes).

\[\*\*description\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-refunds-failure-reason-description)

string

A human-readable description of the reason for the failure or reversal.

\[\*\*ledger_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-refunds-ledger-id)

nullablestring

Plaid\'s unique identifier for a Plaid Ledger Balance.

\[\*\*created\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-refunds-created)

string

The datetime when this refund was created. This will be of the form

2006-01-02T15:04:05Z

Format: date-time

\[\*\*network_trace_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-refunds-network-trace-id)

nullablestring

The trace identifier for the transfer based on its network. This will

only be set after the transfer has posted.\\

For ach or same-day-ach transfers, this is the ACH trace number. For rtp

transfers, this is the Transaction Identification number. For wire

transfers, this is the IMAD (Input Message Accountability Data) number.

\[\*\*recurring_transfer_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-recurring-transfer-id)

nullablestring

The id of the recurring transfer if this transfer belongs to a recurring

transfer.

\[\*\*expected_sweep_settlement_schedule\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-expected-sweep-settlement-schedule)

\\\[object\\\]

The expected sweep settlement schedule of this transfer, assuming this

transfer is not returned. Only applies to ACH debit transfers.

Hide object

\[\*\*sweep_settlement_date\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-expected-sweep-settlement-schedule-sweep-settlement-date)

string

The settlement date of a sweep for this transfer.

Format: date

\[\*\*swept_settled_amount\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-expected-sweep-settlement-schedule-swept-settled-amount)

string

The accumulated amount that has been swept by sweep_settlement_date.

\[\*\*credit_funds_source\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-credit-funds-source)

deprecatednullablestring

This field is now deprecated. You may ignore it for transfers created on

and after 12/01/2023.\\

Specifies the source of funds for the transfer. Only valid for credit

transfers, and defaults to sweep if not specified. This field is not

specified for debit transfers.\\

sweep - Sweep funds from your funding account prefunded_rtp_credits -

Use your prefunded RTP credit balance with Plaid prefunded_ach_credits -

Use your prefunded ACH credit balance with Plaid

Possible values: sweep, prefunded_rtp_credits, prefunded_ach_credits,

null

\[\*\*facilitator_fee\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-facilitator-fee)

string

The amount to deduct from transfer.amount and distribute to the

platform\'s Ledger balance as a facilitator fee (decimal string with two

digits of precision e.g. \\\"10.00\\\"). The remainder will go to the

end-customer\'s Ledger balance. This must be less than or equal to the

transfer.amount.

\[\*\*network_trace_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-transfer-network-trace-id)

nullablestring

The trace identifier for the transfer based on its network. This will

only be set after the transfer has posted.\\

For ach or same-day-ach transfers, this is the ACH trace number. For rtp

transfers, this is the Transaction Identification number. For wire

transfers, this is the IMAD (Input Message Accountability Data) number.

\[\*\*request_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-get-response-request-id)

string

A unique identifier for the request, which can be used for

troubleshooting. This identifier, like all Plaid identifiers, is case

sensitive.

{

\\\"transfer\\\": {

\\\"account_id\\\": \\\"3gE5gnRzNyfXpBK5wEEKcymJ5albGVUqg77gr\\\",

\\\"funding_account_id\\\":
\\\"8945fedc-e703-463d-86b1-dc0607b55460\\\",

\\\"ledger_id\\\": \\\"563db5f8-4c95-4e17-8c3e-cb988fb9cf1a\\\",

\\\"ach_class\\\": \\\"ppd\\\",

\\\"amount\\\": \\\"12.34\\\",

\\\"cancellable\\\": true,

\\\"created\\\": \\\"2020-08-06T17:27:15Z\\\",

\\\"description\\\": \\\"Desc\\\",

\\\"guarantee_decision\\\": null,

\\\"guarantee_decision_rationale\\\": null,

\\\"failure_reason\\\": {

\\\"ach_return_code\\\": \\\"R13\\\",

\\\"description\\\": \\\"Invalid ACH routing number\\\"

},

\\\"id\\\": \\\"460cbe92-2dcc-8eae-5ad6-b37d0ec90fd9\\\",

\\\"authorization_id\\\": \\\"c9f90aa1-2949-c799-e2b6-ea05c89bb586\\\",

\\\"metadata\\\": {

\\\"key1\\\": \\\"value1\\\",

\\\"key2\\\": \\\"value2\\\"

},

\\\"network\\\": \\\"ach\\\",

\\\"origination_account_id\\\": \\\"\\\",

\\\"originator_client_id\\\": null,

\\\"refunds\\\": \\\[\\\],

\\\"status\\\": \\\"pending\\\",

\\\"type\\\": \\\"credit\\\",

\\\"iso_currency_code\\\": \\\"USD\\\",

\\\"standard_return_window\\\": \\\"2020-08-07\\\",

\\\"unauthorized_return_window\\\": \\\"2020-10-07\\\",

\\\"expected_settlement_date\\\": \\\"2020-08-04\\\",

\\\"user\\\": {

\\\"email_address\\\": \\\"acharleston@email.com\\\",

\\\"legal_name\\\": \\\"Anne Charleston\\\",

\\\"phone_number\\\": \\\"510-555-0128\\\",

\\\"address\\\": {

\\\"street\\\": \\\"123 Main St.\\\",

\\\"city\\\": \\\"San Francisco\\\",

\\\"region\\\": \\\"CA\\\",

\\\"postal_code\\\": \\\"94053\\\",

\\\"country\\\": \\\"US\\\"

}

},

\\\"recurring_transfer_id\\\": null,

\\\"credit_funds_source\\\": \\\"sweep\\\",

\\\"facilitator_fee\\\": \\\"1.23\\\",

\\\"network_trace_id\\\": null

},

\\\"request_id\\\": \\\"saKrIBuEB9qJZno\\\"

}

Was this helpful?

YesNo

\[\*\*/transfer/list\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transferlist)

\[List

transfers\](https://plaid.com/docs/api/products/transfer/reading-transfers/#list-transfers)

Use

the \[\*\*\[/transfer/list\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transferlist) endpoint

to see a list of all your transfers and their statuses. Results are

paginated; use the count and offset query parameters to retrieve the

desired transfers.

\*\*Request fields\*\*

\[\*\*client_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-request-client-id)

string

Your Plaid API client_id. The client_id is required and may be provided

either in the PLAID-CLIENT-ID header or as part of a request body.

\[\*\*secret\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-request-secret)

string

Your Plaid API secret. The secret is required and may be provided either

in the PLAID-SECRET header or as part of a request body.

\[\*\*start_date\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-request-start-date)

string

The start datetime of transfers to list. This should be in RFC 3339

format (i.e. 2019-12-06T22:35:49Z)

Format: date-time

\[\*\*end_date\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-request-end-date)

string

The end datetime of transfers to list. This should be in RFC 3339 format

(i.e. 2019-12-06T22:35:49Z)

Format: date-time

\[\*\*count\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-request-count)

integer

The maximum number of transfers to return.

Minimum: 1

Maximum: 25

Default: 25

\[\*\*offset\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-request-offset)

integer

The number of transfers to skip before returning results.

Default: 0

Minimum: 0

\[\*\*originator_client_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-request-originator-client-id)

string

Filter transfers to only those with the specified originator client.

\[\*\*funding_account_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-request-funding-account-id)

string

Filter transfers to only those with the specified funding_account_id.

const request: TransferListRequest = {

start_date: \\\'2019-12-06T22:35:49Z\\\',

end_date: \\\'2019-12-12T22:35:49Z\\\',

count: 14,

offset: 2,

origination_account_id: \\\'8945fedc-e703-463d-86b1-dc0607b55460\\\',

};

try {

const response = await plaidClient.transferList(request);

const transfers = response.data.transfers;

for (const transfer of transfers) {

// iterate through transfers

}

} catch (error) {

// handle error

}

\*\*Response fields\*\* and example

Collapse all

\[\*\*transfers\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers)

\\\[object\\\]

Hide object

\[\*\*id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-id)

string

Plaid\'s unique identifier for a transfer.

\[\*\*authorization_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-authorization-id)

string

Plaid\'s unique identifier for a transfer authorization.

\[\*\*ach_class\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-ach-class)

string

Specifies the use case of the transfer. Required for transfers on an ACH

network.\\

Codes supported for credits: ccd, ppd Codes supported for debits: ccd,

tel, web\\

\\\"ccd\\\" - Corporate Credit or Debit - fund transfer between two

corporate bank accounts\\

\\\"ppd\\\" - Prearranged Payment or Deposit - the transfer is part of a

pre-existing relationship with a consumer, e.g. bill payment\\

\\\"tel\\\" - Telephone-Initiated Entry\\

\\\"web\\\" - Internet-Initiated Entry - debits from a consumer\'s
account

where their authorization is obtained over the Internet

Possible values: ccd, ppd, tel, web

\[\*\*account_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-account-id)

string

The Plaid account_id corresponding to the end-user account that will be

debited or credited.

\[\*\*funding_account_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-funding-account-id)

nullablestring

The id of the associated funding account, available in the Plaid

Dashboard. If present, this indicates which of your business checking

accounts will be credited or debited.

\[\*\*ledger_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-ledger-id)

nullablestring

Plaid\'s unique identifier for a Plaid Ledger Balance.

\[\*\*type\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-type)

string

The type of transfer. This will be either debit or credit. A debit

indicates a transfer of money into the origination account; a credit

indicates a transfer of money out of the origination account.

Possible values: debit, credit

\[\*\*user\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-user)

object

The legal name and other information for the account holder.

Hide object

\[\*\*legal_name\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-user-legal-name)

string

The user\\\'s legal name.

\[\*\*phone_number\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-user-phone-number)

nullablestring

The user\\\'s phone number.

\[\*\*email_address\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-user-email-address)

nullablestring

The user\\\'s email address.

\[\*\*address\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-user-address)

nullableobject

The address associated with the account holder.

Hide object

\[\*\*street\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-user-address-street)

nullablestring

The street number and name (i.e., \\\"100 Market St.\\\").

\[\*\*city\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-user-address-city)

nullablestring

Ex. \\\"San Francisco\\\"

\[\*\*region\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-user-address-region)

nullablestring

The state or province (e.g., \\\"CA\\\").

\[\*\*postal_code\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-user-address-postal-code)

nullablestring

The postal code (e.g., \\\"94103\\\").

\[\*\*country\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-user-address-country)

nullablestring

A two-letter country code (e.g., \\\"US\\\").

\[\*\*amount\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-amount)

string

The amount of the transfer (decimal string with two digits of precision

e.g. \\\"10.00\\\"). When calling /transfer/authorization/create,
specify

the maximum amount to authorize. When calling /transfer/create, specify

the exact amount of the transfer, up to a maximum of the amount

authorized. If this field is left blank when calling /transfer/create,

the maximum amount authorized in the authorization_id will be sent.

\[\*\*description\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-description)

string

The description of the transfer.

\[\*\*created\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-created)

string

The datetime when this transfer was created. This will be of the form

2006-01-02T15:04:05Z

Format: date-time

\[\*\*status\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-status)

string

The status of the transfer.\\

pending: A new transfer was created; it is in the pending state. posted:

The transfer has been successfully submitted to the payment network.

settled: Credits are available to be withdrawn or debits have been

deducted from the Plaid linked account. funds_available: Funds from the

transfer have been released from hold and applied to the ledger\\\'s

available balance. (Only applicable to ACH debits.) cancelled: The

transfer was cancelled by the client. failed: The transfer failed, no

funds were moved. returned: A posted transfer was returned.

Possible values: pending, posted, settled, funds_available, cancelled,

failed, returned

\[\*\*sweep_status\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-sweep-status)

nullablestring

The status of the sweep for the transfer.\\

unswept: The transfer hasn\\\'t been swept yet. swept: The transfer was

swept to the sweep account. swept_settled: Credits are available to be

withdrawn or debits have been deducted from the customer\'s business

checking account. return_swept: The transfer was returned, funds were

pulled back or pushed back to the sweep account. null: The transfer will

never be swept (e.g. if the transfer is cancelled or returned before

being swept)

Possible values: null, unswept, swept, swept_settled, return_swept

\[\*\*network\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-network)

string

The network or rails used for the transfer.\\

For transfers submitted as ach, the next-day cutoff is 5:30 PM Eastern

Time.\\

For transfers submitted as same-day-ach, the same-day cutoff is 3:30 PM

Eastern Time. If the transfer is submitted after this cutoff but before

the next-day cutoff, it will be sent over next-day rails and will not

incur same-day charges; this will apply to both legs of the transfer if

applicable.\\

For transfers submitted as rtp, Plaid will automatically route between

Real Time Payment rail by TCH or FedNow rails as necessary. If a

transfer is submitted as rtp and the counterparty account is not

eligible for RTP, the /transfer/authorization/create request will fail

with an INVALID_FIELD error code. To pre-check to determine whether a

counterparty account can support RTP, call /transfer/capabilities/get

before calling /transfer/authorization/create.\\

Wire transfers are currently in early availability. To request access to

wire as a payment network, contact your Account Manager. For transfers

submitted as wire, the type must be credit; wire debits are not

supported.

Possible values: ach, same-day-ach, rtp, wire

\[\*\*wire_details\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-wire-details)

nullableobject

Information specific to wire transfers.

Hide object

\[\*\*message_to_beneficiary\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-wire-details-message-to-beneficiary)

nullablestring

Additional information from the wire originator to the beneficiary. Max

140 characters.

\[\*\*cancellable\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-cancellable)

boolean

When true, you can still cancel this transfer.

\[\*\*failure_reason\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-failure-reason)

nullableobject

The failure reason if the event type for a transfer is \\\"failed\\\" or

\\\"returned\\\". Null value otherwise.

Hide object

\[\*\*ach_return_code\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-failure-reason-ach-return-code)

nullablestring

The ACH return code, e.g. R01. A return code will be provided if and

only if the transfer status is returned. For a full listing of ACH

return codes, see \[\[Transfer

errors\]{.underline}\](https://plaid.com/docs/errors/transfer/#ach-return-codes).

\[\*\*description\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-failure-reason-description)

string

A human-readable description of the reason for the failure or reversal.

\[\*\*metadata\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-metadata)

nullableobject

The Metadata object is a mapping of client-provided string fields to any

string value. The following limitations apply: The JSON values must be

Strings (no nested JSON objects allowed) Only ASCII characters may be

used Maximum of 50 key/value pairs Maximum key length of 40 characters

Maximum value length of 500 characters

\[\*\*iso_currency_code\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-iso-currency-code)

string

The currency of the transfer amount, e.g. \\\"USD\\\"

\[\*\*standard_return_window\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-standard-return-window)

nullablestring

The date 3 business days from settlement date indicating the following

ACH returns can no longer happen: R01, R02, R03, R29. This will be of

the form YYYY-MM-DD.

Format: date

\[\*\*unauthorized_return_window\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-unauthorized-return-window)

nullablestring

The date 61 business days from settlement date indicating the following

ACH returns can no longer happen: R05, R07, R10, R11, R51, R33, R37,

R38, R51, R52, R53. This will be of the form YYYY-MM-DD.

Format: date

\[\*\*expected_settlement_date\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-expected-settlement-date)

nullablestring

The expected date when the full amount of the transfer settles at the

consumers\' account, if the transfer is credit; or at the customer\\\'s

business checking account, if the transfer is debit. Only set for ACH

transfers and is null for non-ACH transfers. Only set for ACH transfers.

This will be of the form YYYY-MM-DD.

Format: date

\[\*\*originator_client_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-originator-client-id)

nullablestring

The Plaid client ID that is the originator of this transfer. Only

present if created on behalf of another client as a \[\[Platform

customer\]{.underline}\](https://plaid.com/docs/transfer/application/#originators-vs-platforms).

\[\*\*refunds\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-refunds)

\\\[object\\\]

A list of refunds associated with this transfer.

Hide object

\[\*\*id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-refunds-id)

string

Plaid\'s unique identifier for a refund.

\[\*\*transfer_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-refunds-transfer-id)

string

The ID of the transfer to refund.

\[\*\*amount\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-refunds-amount)

string

The amount of the refund (decimal string with two digits of precision

e.g. \\\"10.00\\\").

\[\*\*status\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-refunds-status)

string

The status of the refund.\\

pending: A new refund was created; it is in the pending state. posted:

The refund has been successfully submitted to the payment network.

settled: Credits have been refunded to the Plaid linked account.

cancelled: The refund was cancelled by the client. failed: The refund

has failed. returned: The refund was returned.

Possible values: pending, posted, cancelled, failed, settled, returned

\[\*\*failure_reason\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-refunds-failure-reason)

nullableobject

The failure reason if the event type for a refund is \\\"failed\\\" or

\\\"returned\\\". Null value otherwise.

Hide object

\[\*\*ach_return_code\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-refunds-failure-reason-ach-return-code)

nullablestring

The ACH return code, e.g. R01. A return code will be provided if and

only if the refund status is returned. For a full listing of ACH return

codes, see \[\[Transfer

errors\]{.underline}\](https://plaid.com/docs/errors/transfer/#ach-return-codes).

\[\*\*description\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-refunds-failure-reason-description)

string

A human-readable description of the reason for the failure or reversal.

\[\*\*ledger_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-refunds-ledger-id)

nullablestring

Plaid\'s unique identifier for a Plaid Ledger Balance.

\[\*\*created\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-refunds-created)

string

The datetime when this refund was created. This will be of the form

2006-01-02T15:04:05Z

Format: date-time

\[\*\*network_trace_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-refunds-network-trace-id)

nullablestring

The trace identifier for the transfer based on its network. This will

only be set after the transfer has posted.\\

For ach or same-day-ach transfers, this is the ACH trace number. For rtp

transfers, this is the Transaction Identification number. For wire

transfers, this is the IMAD (Input Message Accountability Data) number.

\[\*\*recurring_transfer_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-recurring-transfer-id)

nullablestring

The id of the recurring transfer if this transfer belongs to a recurring

transfer.

\[\*\*expected_sweep_settlement_schedule\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-expected-sweep-settlement-schedule)

\\\[object\\\]

The expected sweep settlement schedule of this transfer, assuming this

transfer is not returned. Only applies to ACH debit transfers.

Hide object

\[\*\*sweep_settlement_date\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-expected-sweep-settlement-schedule-sweep-settlement-date)

string

The settlement date of a sweep for this transfer.

Format: date

\[\*\*swept_settled_amount\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-expected-sweep-settlement-schedule-swept-settled-amount)

string

The accumulated amount that has been swept by sweep_settlement_date.

\[\*\*credit_funds_source\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-credit-funds-source)

deprecatednullablestring

This field is now deprecated. You may ignore it for transfers created on

and after 12/01/2023.\\

Specifies the source of funds for the transfer. Only valid for credit

transfers, and defaults to sweep if not specified. This field is not

specified for debit transfers.\\

sweep - Sweep funds from your funding account prefunded_rtp_credits -

Use your prefunded RTP credit balance with Plaid prefunded_ach_credits -

Use your prefunded ACH credit balance with Plaid

Possible values: sweep, prefunded_rtp_credits, prefunded_ach_credits,

null

\[\*\*facilitator_fee\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-facilitator-fee)

string

The amount to deduct from transfer.amount and distribute to the

platform\'s Ledger balance as a facilitator fee (decimal string with two

digits of precision e.g. \\\"10.00\\\"). The remainder will go to the

end-customer\'s Ledger balance. This must be less than or equal to the

transfer.amount.

\[\*\*network_trace_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-transfers-network-trace-id)

nullablestring

The trace identifier for the transfer based on its network. This will

only be set after the transfer has posted.\\

For ach or same-day-ach transfers, this is the ACH trace number. For rtp

transfers, this is the Transaction Identification number. For wire

transfers, this is the IMAD (Input Message Accountability Data) number.

\[\*\*request_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-list-response-request-id)

string

A unique identifier for the request, which can be used for

troubleshooting. This identifier, like all Plaid identifiers, is case

sensitive.

{

\\\"transfers\\\": \\\[

{

\\\"account_id\\\": \\\"3gE5gnRzNyfXpBK5wEEKcymJ5albGVUqg77gr\\\",

\\\"funding_account_id\\\":
\\\"8945fedc-e703-463d-86b1-dc0607b55460\\\",

\\\"ledger_id\\\": \\\"563db5f8-4c95-4e17-8c3e-cb988fb9cf1a\\\",

\\\"ach_class\\\": \\\"ppd\\\",

\\\"amount\\\": \\\"12.34\\\",

\\\"cancellable\\\": true,

\\\"created\\\": \\\"2019-12-09T17:27:15Z\\\",

\\\"description\\\": \\\"Desc\\\",

\\\"guarantee_decision\\\": null,

\\\"guarantee_decision_rationale\\\": null,

\\\"failure_reason\\\": {

\\\"ach_return_code\\\": \\\"R13\\\",

\\\"description\\\": \\\"Invalid ACH routing number\\\"

},

\\\"id\\\": \\\"460cbe92-2dcc-8eae-5ad6-b37d0ec90fd9\\\",

\\\"authorization_id\\\": \\\"c9f90aa1-2949-c799-e2b6-ea05c89bb586\\\",

\\\"metadata\\\": {

\\\"key1\\\": \\\"value1\\\",

\\\"key2\\\": \\\"value2\\\"

},

\\\"network\\\": \\\"ach\\\",

\\\"origination_account_id\\\": \\\"\\\",

\\\"originator_client_id\\\": null,

\\\"refunds\\\": \\\[\\\],

\\\"status\\\": \\\"pending\\\",

\\\"type\\\": \\\"credit\\\",

\\\"iso_currency_code\\\": \\\"USD\\\",

\\\"standard_return_window\\\": \\\"2020-08-07\\\",

\\\"unauthorized_return_window\\\": \\\"2020-10-07\\\",

\\\"expected_settlement_date\\\": \\\"2020-08-04\\\",

\\\"user\\\": {

\\\"email_address\\\": \\\"acharleston@email.com\\\",

\\\"legal_name\\\": \\\"Anne Charleston\\\",

\\\"phone_number\\\": \\\"510-555-0128\\\",

\\\"address\\\": {

\\\"street\\\": \\\"123 Main St.\\\",

\\\"city\\\": \\\"San Francisco\\\",

\\\"region\\\": \\\"CA\\\",

\\\"postal_code\\\": \\\"94053\\\",

\\\"country\\\": \\\"US\\\"

}

},

\\\"recurring_transfer_id\\\": null,

\\\"credit_funds_source\\\": \\\"sweep\\\",

\\\"facilitator_fee\\\": \\\"1.23\\\",

\\\"network_trace_id\\\": null

}

\\\],

\\\"request_id\\\": \\\"saKrIBuEB9qJZno\\\"

}

Was this helpful?

YesNo

\[\*\*/transfer/event/list\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfereventlist)

\[List transfer

events\](https://plaid.com/docs/api/products/transfer/reading-transfers/#list-transfer-events)

Use

the \[\*\*\[/transfer/event/list\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfereventlist) endpoint

to get a list of transfer events based on specified filter criteria.

\*\*Request fields\*\*

\[\*\*client_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-request-client-id)

string

Your Plaid API client_id. The client_id is required and may be provided

either in the PLAID-CLIENT-ID header or as part of a request body.

\[\*\*secret\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-request-secret)

string

Your Plaid API secret. The secret is required and may be provided either

in the PLAID-SECRET header or as part of a request body.

\[\*\*start_date\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-request-start-date)

string

The start datetime of transfers to list. This should be in RFC 3339

format (i.e. 2019-12-06T22:35:49Z)

Format: date-time

\[\*\*end_date\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-request-end-date)

string

The end datetime of transfers to list. This should be in RFC 3339 format

(i.e. 2019-12-06T22:35:49Z)

Format: date-time

\[\*\*transfer_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-request-transfer-id)

string

Plaid\'s unique identifier for a transfer.

\[\*\*account_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-request-account-id)

string

The account ID to get events for all transactions to/from an account.

\[\*\*transfer_type\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-request-transfer-type)

string

The type of transfer. This will be either debit or credit. A debit

indicates a transfer of money into your origination account; a credit

indicates a transfer of money out of your origination account.

Possible values: debit, credit, null

\[\*\*event_types\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-request-event-types)

\\\[string\\\]

Filter events by event type.

Possible values: pending, cancelled, failed, posted, settled,

funds_available, returned, swept, swept_settled, return_swept,

sweep.pending, sweep.posted, sweep.settled, sweep.returned,

sweep.failed, refund.pending, refund.cancelled, refund.failed,

refund.posted, refund.settled, refund.returned, refund.swept,

refund.return_swept

\[\*\*sweep_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-request-sweep-id)

string

Plaid\'s unique identifier for a sweep.

\[\*\*count\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-request-count)

integer

The maximum number of transfer events to return. If the number of events

matching the above parameters is greater than count, the most recent

events will be returned.

Default: 25

Maximum: 25

Minimum: 1

\[\*\*offset\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-request-offset)

integer

The offset into the list of transfer events. When count=25 and offset=0,

the first 25 events will be returned. When count=25 and offset=25, the

next 25 events will be returned.

Default: 0

Minimum: 0

\[\*\*originator_client_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-request-originator-client-id)

string

Filter transfer events to only those with the specified originator

client.

\[\*\*funding_account_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-request-funding-account-id)

string

Filter transfer events to only those with the specified

funding_account_id.

const request: TransferEventListRequest = {

start_date: \\\'2019-12-06T22:35:49Z\\\',

end_date: \\\'2019-12-12T22:35:49Z\\\',

transfer_id: \\\'460cbe92-2dcc-8eae-5ad6-b37d0ec90fd9\\\',

account_id: \\\'3gE5gnRzNyfXpBK5wEEKcymJ5albGVUqg77gr\\\',

transfer_type: \\\'credit\\\',

event_types: \\\[\\\'pending\\\', \\\'posted\\\'\\\],

count: 14,

offset: 2,

origination_account_id: \\\'8945fedc-e703-463d-86b1-dc0607b55460\\\',

};

try {

const response = await plaidClient.transferEventList(request);

const events = response.data.transfer_events;

for (const event of events) {

// iterate through events

}

} catch (error) {

// handle error

}

\*\*Response fields\*\* and example

Collapse all

\[\*\*transfer_events\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-response-transfer-events)

\\\[object\\\]

Hide object

\[\*\*event_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-response-transfer-events-event-id)

integer

Plaid\'s unique identifier for this event. IDs are sequential unsigned

64-bit integers.

Minimum: 0

\[\*\*timestamp\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-response-transfer-events-timestamp)

string

The datetime when this event occurred. This will be of the form

2006-01-02T15:04:05Z.

Format: date-time

\[\*\*event_type\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-response-transfer-events-event-type)

string

The type of event that this transfer represents. Event types with prefix

sweep represents events for Plaid Ledger sweeps.\\

pending: A new transfer was created; it is in the pending state.\\

cancelled: The transfer was cancelled by the client.\\

failed: The transfer failed, no funds were moved.\\

posted: The transfer has been successfully submitted to the payment

network.\\

settled: Credits are available to be withdrawn or debits have been

deducted from the Plaid linked account.\\

funds_available: Funds from the transfer have been released from hold

and applied to the ledger\\\'s available balance. (Only applicable to
ACH

debits.)\\

returned: A posted transfer was returned.\\

swept: The transfer was swept to / from the sweep account.\\

swept_settled: Credits are available to be withdrawn or debits have been

deducted from the customer\'s business checking account.\\

return_swept: Due to the transfer being returned, funds were pulled from

or pushed back to the sweep account.\\

sweep.pending: A new ledger sweep was created; it is in the pending

state.\\

sweep.posted: The ledger sweep has been successfully submitted to the

payment network.\\

sweep.settled: The transaction has settled in the funding account. This

means that funds withdrawn from Plaid Ledger balance have reached the

funding account, or funds to be deposited into the Plaid Ledger Balance

have been pulled, and the hold period has begun.\\

sweep.returned: A posted ledger sweep was returned.\\

sweep.failed: The ledger sweep failed, no funds were moved.\\

refund.pending: A new refund was created; it is in the pending state.\\

refund.cancelled: The refund was cancelled.\\

refund.failed: The refund failed, no funds were moved.\\

refund.posted: The refund has been successfully submitted to the payment

network.\\

refund.settled: The refund transaction has settled in the Plaid linked

account.\\

refund.returned: A posted refund was returned.\\

refund.swept: The refund was swept from the sweep account.\\

refund.return_swept: Due to the refund being returned, funds were pushed

back to the sweep account.

Possible values: pending, cancelled, failed, posted, settled,

funds_available, returned, swept, swept_settled, return_swept,

sweep.pending, sweep.posted, sweep.settled, sweep.returned,

sweep.failed, refund.pending, refund.cancelled, refund.failed,

refund.posted, refund.settled, refund.returned, refund.swept,

refund.return_swept

\[\*\*account_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-response-transfer-events-account-id)

string

The account ID associated with the transfer. This field is omitted for

Plaid Ledger Sweep events.

\[\*\*funding_account_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-response-transfer-events-funding-account-id)

nullablestring

The id of the associated funding account, available in the Plaid

Dashboard. If present, this indicates which of your business checking

accounts will be credited or debited.

\[\*\*ledger_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-response-transfer-events-ledger-id)

nullablestring

Plaid\'s unique identifier for a Plaid Ledger Balance.

\[\*\*transfer_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-response-transfer-events-transfer-id)

string

Plaid\'s unique identifier for a transfer. This field is null for Plaid

Ledger Sweep events.

\[\*\*transfer_type\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-response-transfer-events-transfer-type)

string

The type of transfer. Valid values are debit or credit. A debit

indicates a transfer of money into the origination account; a credit

indicates a transfer of money out of the origination account. This field

is omitted for Plaid Ledger Sweep events.

Possible values: debit, credit

\[\*\*transfer_amount\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-response-transfer-events-transfer-amount)

string

The amount of the transfer (decimal string with two digits of precision

e.g. \\\"10.00\\\"). This field is omitted for Plaid Ledger Sweep
events.

\[\*\*failure_reason\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-response-transfer-events-failure-reason)

nullableobject

The failure reason if the event type for a transfer is \\\"failed\\\" or

\\\"returned\\\". Null value otherwise.

Hide object

\[\*\*ach_return_code\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-response-transfer-events-failure-reason-ach-return-code)

nullablestring

The ACH return code, e.g. R01. A return code will be provided if and

only if the transfer status is returned. For a full listing of ACH

return codes, see \[\[Transfer

errors\]{.underline}\](https://plaid.com/docs/errors/transfer/#ach-return-codes).

\[\*\*description\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-response-transfer-events-failure-reason-description)

string

A human-readable description of the reason for the failure or reversal.

\[\*\*sweep_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-response-transfer-events-sweep-id)

nullablestring

Plaid\'s unique identifier for a sweep.

\[\*\*sweep_amount\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-response-transfer-events-sweep-amount)

nullablestring

A signed amount of how much was swept or return_swept for this transfer

(decimal string with two digits of precision e.g. \\\"-5.50\\\").

\[\*\*refund_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-response-transfer-events-refund-id)

nullablestring

Plaid\'s unique identifier for a refund. A non-null value indicates the

event is for the associated refund of the transfer.

\[\*\*originator_client_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-response-transfer-events-originator-client-id)

nullablestring

The Plaid client ID that is the originator of the transfer that this

event applies to. Only present if the transfer was created on behalf of

another client as a third-party sender (TPS).

\[\*\*has_more\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-response-has-more)

boolean

Whether there are more events to be pulled from the endpoint that have

not already been returned

\[\*\*request_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-list-response-request-id)

string

A unique identifier for the request, which can be used for

troubleshooting. This identifier, like all Plaid identifiers, is case

sensitive.

{

\\\"transfer_events\\\": \\\[

{

\\\"account_id\\\": \\\"3gE5gnRzNyfXpBK5wEEKcymJ5albGVUqg77gr\\\",

\\\"funding_account_id\\\":
\\\"8945fedc-e703-463d-86b1-dc0607b55460\\\",

\\\"ledger_id\\\": \\\"563db5f8-4c95-4e17-8c3e-cb988fb9cf1a\\\",

\\\"transfer_amount\\\": \\\"12.34\\\",

\\\"transfer_id\\\": \\\"460cbe92-2dcc-8eae-5ad6-b37d0ec90fd9\\\",

\\\"transfer_type\\\": \\\"credit\\\",

\\\"event_id\\\": 1,

\\\"event_type\\\": \\\"posted\\\",

\\\"failure_reason\\\": null,

\\\"origination_account_id\\\": \\\"\\\",

\\\"originator_client_id\\\": \\\"569ed2f36b3a3a021713abc1\\\",

\\\"refund_id\\\": null,

\\\"sweep_amount\\\": null,

\\\"sweep_id\\\": null,

\\\"timestamp\\\": \\\"2019-12-09T17:27:15Z\\\"

}

\\\],

\\\"has_more\\\": true,

\\\"request_id\\\": \\\"mdqfuVxeoza6mhu\\\"

}

Was this helpful?

YesNo

\[\*\*/transfer/event/sync\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfereventsync)

\[Sync transfer

events\](https://plaid.com/docs/api/products/transfer/reading-transfers/#sync-transfer-events)

\[\*\*\[/transfer/event/sync\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfereventsync) allows

you to request up to the next 25 transfer events that happened after a

specific event_id. Use

the \[\*\*\[/transfer/event/sync\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfereventsync) endpoint

to guarantee you have seen all transfer events.

\*\*Request fields\*\*

\[\*\*client_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-request-client-id)

string

Your Plaid API client_id. The client_id is required and may be provided

either in the PLAID-CLIENT-ID header or as part of a request body.

\[\*\*secret\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-request-secret)

string

Your Plaid API secret. The secret is required and may be provided either

in the PLAID-SECRET header or as part of a request body.

\[\*\*after_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-request-after-id)

requiredinteger

The latest (largest) event_id fetched via the sync endpoint, or 0

initially.

Minimum: 0

\[\*\*count\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-request-count)

integer

The maximum number of transfer events to return.

Default: 25

Minimum: 1

Maximum: 25

const request: TransferEventListRequest = {

after_id: 4,

count: 22,

};

try {

const response = await plaidClient.transferEventSync(request);

const events = response.data.transfer_events;

for (const event of events) {

// iterate through events

}

} catch (error) {

// handle error

}

\*\*Response fields\*\* and example

Collapse all

\[\*\*transfer_events\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-response-transfer-events)

\\\[object\\\]

Hide object

\[\*\*event_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-response-transfer-events-event-id)

integer

Plaid\'s unique identifier for this event. IDs are sequential unsigned

64-bit integers.

Minimum: 0

\[\*\*timestamp\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-response-transfer-events-timestamp)

string

The datetime when this event occurred. This will be of the form

2006-01-02T15:04:05Z.

Format: date-time

\[\*\*event_type\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-response-transfer-events-event-type)

string

The type of event that this transfer represents. Event types with prefix

sweep represents events for Plaid Ledger sweeps.\\

pending: A new transfer was created; it is in the pending state.\\

cancelled: The transfer was cancelled by the client.\\

failed: The transfer failed, no funds were moved.\\

posted: The transfer has been successfully submitted to the payment

network.\\

settled: Credits are available to be withdrawn or debits have been

deducted from the Plaid linked account.\\

funds_available: Funds from the transfer have been released from hold

and applied to the ledger\\\'s available balance. (Only applicable to
ACH

debits.)\\

returned: A posted transfer was returned.\\

swept: The transfer was swept to / from the sweep account.\\

swept_settled: Credits are available to be withdrawn or debits have been

deducted from the customer\'s business checking account.\\

return_swept: Due to the transfer being returned, funds were pulled from

or pushed back to the sweep account.\\

sweep.pending: A new ledger sweep was created; it is in the pending

state.\\

sweep.posted: The ledger sweep has been successfully submitted to the

payment network.\\

sweep.settled: The transaction has settled in the funding account. This

means that funds withdrawn from Plaid Ledger balance have reached the

funding account, or funds to be deposited into the Plaid Ledger Balance

have been pulled, and the hold period has begun.\\

sweep.returned: A posted ledger sweep was returned.\\

sweep.failed: The ledger sweep failed, no funds were moved.\\

refund.pending: A new refund was created; it is in the pending state.\\

refund.cancelled: The refund was cancelled.\\

refund.failed: The refund failed, no funds were moved.\\

refund.posted: The refund has been successfully submitted to the payment

network.\\

refund.settled: The refund transaction has settled in the Plaid linked

account.\\

refund.returned: A posted refund was returned.\\

refund.swept: The refund was swept from the sweep account.\\

refund.return_swept: Due to the refund being returned, funds were pushed

back to the sweep account.

Possible values: pending, cancelled, failed, posted, settled,

funds_available, returned, swept, swept_settled, return_swept,

sweep.pending, sweep.posted, sweep.settled, sweep.returned,

sweep.failed, refund.pending, refund.cancelled, refund.failed,

refund.posted, refund.settled, refund.returned, refund.swept,

refund.return_swept

\[\*\*account_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-response-transfer-events-account-id)

string

The account ID associated with the transfer. This field is omitted for

Plaid Ledger Sweep events.

\[\*\*funding_account_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-response-transfer-events-funding-account-id)

nullablestring

The id of the associated funding account, available in the Plaid

Dashboard. If present, this indicates which of your business checking

accounts will be credited or debited.

\[\*\*ledger_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-response-transfer-events-ledger-id)

nullablestring

Plaid\'s unique identifier for a Plaid Ledger Balance.

\[\*\*transfer_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-response-transfer-events-transfer-id)

string

Plaid\'s unique identifier for a transfer. This field is null for Plaid

Ledger Sweep events.

\[\*\*transfer_type\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-response-transfer-events-transfer-type)

string

The type of transfer. Valid values are debit or credit. A debit

indicates a transfer of money into the origination account; a credit

indicates a transfer of money out of the origination account. This field

is omitted for Plaid Ledger Sweep events.

Possible values: debit, credit

\[\*\*transfer_amount\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-response-transfer-events-transfer-amount)

string

The amount of the transfer (decimal string with two digits of precision

e.g. \\\"10.00\\\"). This field is omitted for Plaid Ledger Sweep
events.

\[\*\*failure_reason\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-response-transfer-events-failure-reason)

nullableobject

The failure reason if the event type for a transfer is \\\"failed\\\" or

\\\"returned\\\". Null value otherwise.

Hide object

\[\*\*ach_return_code\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-response-transfer-events-failure-reason-ach-return-code)

nullablestring

The ACH return code, e.g. R01. A return code will be provided if and

only if the transfer status is returned. For a full listing of ACH

return codes, see \[\[Transfer

errors\]{.underline}\](https://plaid.com/docs/errors/transfer/#ach-return-codes).

\[\*\*description\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-response-transfer-events-failure-reason-description)

string

A human-readable description of the reason for the failure or reversal.

\[\*\*sweep_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-response-transfer-events-sweep-id)

nullablestring

Plaid\'s unique identifier for a sweep.

\[\*\*sweep_amount\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-response-transfer-events-sweep-amount)

nullablestring

A signed amount of how much was swept or return_swept for this transfer

(decimal string with two digits of precision e.g. \\\"-5.50\\\").

\[\*\*refund_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-response-transfer-events-refund-id)

nullablestring

Plaid\'s unique identifier for a refund. A non-null value indicates the

event is for the associated refund of the transfer.

\[\*\*originator_client_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-response-transfer-events-originator-client-id)

nullablestring

The Plaid client ID that is the originator of the transfer that this

event applies to. Only present if the transfer was created on behalf of

another client as a third-party sender (TPS).

\[\*\*has_more\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-response-has-more)

boolean

Whether there are more events to be pulled from the endpoint that have

not already been returned

\[\*\*request_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-event-sync-response-request-id)

string

A unique identifier for the request, which can be used for

troubleshooting. This identifier, like all Plaid identifiers, is case

sensitive.

{

\\\"transfer_events\\\": \\\[

{

\\\"account_id\\\": \\\"3gE5gnRzNyfXpBK5wEEKcymJ5albGVUqg77gr\\\",

\\\"funding_account_id\\\":
\\\"8945fedc-e703-463d-86b1-dc0607b55460\\\",

\\\"ledger_id\\\": \\\"563db5f8-4c95-4e17-8c3e-cb988fb9cf1a\\\",

\\\"transfer_amount\\\": \\\"12.34\\\",

\\\"transfer_id\\\": \\\"460cbe92-2dcc-8eae-5ad6-b37d0ec90fd9\\\",

\\\"transfer_type\\\": \\\"credit\\\",

\\\"event_id\\\": 1,

\\\"event_type\\\": \\\"pending\\\",

\\\"failure_reason\\\": null,

\\\"origination_account_id\\\": \\\"\\\",

\\\"originator_client_id\\\": null,

\\\"refund_id\\\": null,

\\\"sweep_amount\\\": null,

\\\"sweep_id\\\": null,

\\\"timestamp\\\": \\\"2019-12-09T17:27:15Z\\\"

}

\\\],

\\\"has_more\\\": true,

\\\"request_id\\\": \\\"mdqfuVxeoza6mhu\\\"

}

Was this helpful?

YesNo

\[\*\*/transfer/sweep/get\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfersweepget)

\[Retrieve a

sweep\](https://plaid.com/docs/api/products/transfer/reading-transfers/#retrieve-a-sweep)

The \[\*\*\[/transfer/sweep/get\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfersweepget) endpoint

fetches a sweep corresponding to the given sweep_id.

\*\*Request fields\*\*

\[\*\*client_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-get-request-client-id)

string

Your Plaid API client_id. The client_id is required and may be provided

either in the PLAID-CLIENT-ID header or as part of a request body.

\[\*\*secret\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-get-request-secret)

string

Your Plaid API secret. The secret is required and may be provided either

in the PLAID-SECRET header or as part of a request body.

\[\*\*sweep_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-get-request-sweep-id)

requiredstring

Plaid\\\'s unique identifier for the sweep (UUID) or a shortened form

consisting of the first 8 characters of the identifier (8-digit

hexadecimal string).

const request: TransferSweepGetRequest = {

sweep_id: \\\'8c2fda9a-aa2f-4735-a00f-f4e0d2d2faee\\\',

};

try {

const response = await plaidClient.transferSweepGet(request);

const sweep = response.data.sweep;

} catch (error) {

// handle error

}

\*\*Response fields\*\* and example

Collapse all

\[\*\*sweep\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-get-response-sweep)

object

Describes a sweep of funds to / from the sweep account.\\

A sweep is associated with many sweep events (events of type swept or

return_swept) which can be retrieved by invoking the

/transfer/event/list endpoint with the corresponding sweep_id.\\

swept events occur when the transfer amount is credited or debited from

your sweep account, depending on the type of the transfer. return_swept

events occur when a transfer is returned and Plaid undoes the credit or

debit.\\

The total sum of the swept and return_swept events is equal to the

amount of the sweep Plaid creates and matches the amount of the entry on

your sweep account ledger.

Hide object

\[\*\*id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-get-response-sweep-id)

string

Identifier of the sweep.

\[\*\*funding_account_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-get-response-sweep-funding-account-id)

string

The id of the funding account to use, available in the Plaid Dashboard.

This determines which of your business checking accounts will be

credited or debited.

\[\*\*ledger_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-get-response-sweep-ledger-id)

nullablestring

Plaid\'s unique identifier for a Plaid Ledger Balance.

\[\*\*created\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-get-response-sweep-created)

string

The datetime when the sweep occurred, in RFC 3339 format.

Format: date-time

\[\*\*amount\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-get-response-sweep-amount)

string

Signed decimal amount of the sweep as it appears on your sweep account

ledger (e.g. \\\"-10.00\\\")\\

If amount is not present, the sweep was net-settled to zero and

outstanding debits and credits between the sweep account and Plaid are

balanced.

\[\*\*iso_currency_code\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-get-response-sweep-iso-currency-code)

string

The currency of the sweep, e.g. \\\"USD\\\".

\[\*\*settled\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-get-response-sweep-settled)

nullablestring

The date when the sweep settled, in the YYYY-MM-DD format.

Format: date

\[\*\*status\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-get-response-sweep-status)

nullablestring

The status of a sweep transfer\\

\\\"pending\\\" - The sweep is currently pending \\\"posted\\\" - The
sweep has

been posted \\\"settled\\\" - The sweep has settled \\\"returned\\\" -
The sweep

has been returned \\\"failed\\\" - The sweep has failed

Possible values: pending, posted, settled, returned, failed, null

\[\*\*trigger\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-get-response-sweep-trigger)

nullablestring

The trigger of the sweep\\

\\\"manual\\\" - The sweep is created manually by the customer

\\\"incoming\\\" - The sweep is created by incoming funds flow (e.g.

Incoming Wire) \\\"balance_threshold\\\" - The sweep is created by
balance

threshold setting \\\"automatic_aggregate\\\" - The sweep is created by
the

Plaid automatic aggregation process. These funds did not pass through

the Plaid Ledger balance.

Possible values: manual, incoming, balance_threshold,

automatic_aggregate

\[\*\*description\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-get-response-sweep-description)

string

The description of the deposit that will be passed to the receiving bank

(up to 10 characters). Note that banks utilize this field differently,

and may or may not show it on the bank statement.

\[\*\*network_trace_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-get-response-sweep-network-trace-id)

nullablestring

The trace identifier for the transfer based on its network. This will

only be set after the transfer has posted.\\

For ach or same-day-ach transfers, this is the ACH trace number. For rtp

transfers, this is the Transaction Identification number. For wire

transfers, this is the IMAD (Input Message Accountability Data) number.

\[\*\*request_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-get-response-request-id)

string

A unique identifier for the request, which can be used for

troubleshooting. This identifier, like all Plaid identifiers, is case

sensitive.

{

\\\"sweep\\\": {

\\\"id\\\": \\\"8c2fda9a-aa2f-4735-a00f-f4e0d2d2faee\\\",

\\\"funding_account_id\\\":
\\\"8945fedc-e703-463d-86b1-dc0607b55460\\\",

\\\"ledger_id\\\": \\\"563db5f8-4c95-4e17-8c3e-cb988fb9cf1a\\\",

\\\"created\\\": \\\"2020-08-06T17:27:15Z\\\",

\\\"amount\\\": \\\"12.34\\\",

\\\"iso_currency_code\\\": \\\"USD\\\",

\\\"settled\\\": \\\"2020-08-07\\\",

\\\"status\\\": \\\"settled\\\",

\\\"network_trace_id\\\": \\\"123456789012345\\\"

},

\\\"request_id\\\": \\\"saKrIBuEB9qJZno\\\"

}

Was this helpful?

YesNo

\[\*\*/transfer/sweep/list\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfersweeplist)

\[List

sweeps\](https://plaid.com/docs/api/products/transfer/reading-transfers/#list-sweeps)

The \[\*\*\[/transfer/sweep/list\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfersweeplist) endpoint

fetches sweeps matching the given filters.

\*\*Request fields\*\*

\[\*\*client_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-request-client-id)

string

Your Plaid API client_id. The client_id is required and may be provided

either in the PLAID-CLIENT-ID header or as part of a request body.

\[\*\*secret\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-request-secret)

string

Your Plaid API secret. The secret is required and may be provided either

in the PLAID-SECRET header or as part of a request body.

\[\*\*start_date\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-request-start-date)

string

The start datetime of sweeps to return (RFC 3339 format).

Format: date-time

\[\*\*end_date\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-request-end-date)

string

The end datetime of sweeps to return (RFC 3339 format).

Format: date-time

\[\*\*count\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-request-count)

integer

The maximum number of sweeps to return.

Minimum: 1

Maximum: 25

Default: 25

\[\*\*offset\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-request-offset)

integer

The number of sweeps to skip before returning results.

Default: 0

Minimum: 0

\[\*\*amount\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-request-amount)

string

Filter sweeps to only those with the specified amount.

\[\*\*status\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-request-status)

string

The status of a sweep transfer\\

\\\"pending\\\" - The sweep is currently pending \\\"posted\\\" - The
sweep has

been posted \\\"settled\\\" - The sweep has settled \\\"returned\\\" -
The sweep

has been returned \\\"failed\\\" - The sweep has failed

Possible values: pending, posted, settled, returned, failed, null

\[\*\*originator_client_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-request-originator-client-id)

string

Filter sweeps to only those with the specified originator client.

\[\*\*funding_account_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-request-funding-account-id)

string

Filter sweeps to only those with the specified funding_account_id.

\[\*\*transfer_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-request-transfer-id)

string

Filter sweeps to only those with the included transfer_id.

\[\*\*trigger\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-request-trigger)

string

The trigger of the sweep\\

\\\"manual\\\" - The sweep is created manually by the customer

\\\"incoming\\\" - The sweep is created by incoming funds flow (e.g.

Incoming Wire) \\\"balance_threshold\\\" - The sweep is created by
balance

threshold setting \\\"automatic_aggregate\\\" - The sweep is created by
the

Plaid automatic aggregation process. These funds did not pass through

the Plaid Ledger balance.

Possible values: manual, incoming, balance_threshold,

automatic_aggregate

const request: TransferSweepListRequest = {

start_date: \\\'2019-12-06T22:35:49Z\\\',

end_date: \\\'2019-12-12T22:35:49Z\\\',

count: 14,

offset: 2,

};

try {

const response = await plaidClient.transferSweepList(request);

const sweeps = response.data.sweeps;

for (const sweep of sweeps) {

// iterate through sweeps

}

} catch (error) {

// handle error

}

\*\*Response fields\*\* and example

Collapse all

\[\*\*sweeps\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-response-sweeps)

\\\[object\\\]

Hide object

\[\*\*id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-response-sweeps-id)

string

Identifier of the sweep.

\[\*\*funding_account_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-response-sweeps-funding-account-id)

string

The id of the funding account to use, available in the Plaid Dashboard.

This determines which of your business checking accounts will be

credited or debited.

\[\*\*ledger_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-response-sweeps-ledger-id)

nullablestring

Plaid\'s unique identifier for a Plaid Ledger Balance.

\[\*\*created\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-response-sweeps-created)

string

The datetime when the sweep occurred, in RFC 3339 format.

Format: date-time

\[\*\*amount\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-response-sweeps-amount)

string

Signed decimal amount of the sweep as it appears on your sweep account

ledger (e.g. \\\"-10.00\\\")\\

If amount is not present, the sweep was net-settled to zero and

outstanding debits and credits between the sweep account and Plaid are

balanced.

\[\*\*iso_currency_code\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-response-sweeps-iso-currency-code)

string

The currency of the sweep, e.g. \\\"USD\\\".

\[\*\*settled\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-response-sweeps-settled)

nullablestring

The date when the sweep settled, in the YYYY-MM-DD format.

Format: date

\[\*\*status\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-response-sweeps-status)

nullablestring

The status of a sweep transfer\\

\\\"pending\\\" - The sweep is currently pending \\\"posted\\\" - The
sweep has

been posted \\\"settled\\\" - The sweep has settled \\\"returned\\\" -
The sweep

has been returned \\\"failed\\\" - The sweep has failed

Possible values: pending, posted, settled, returned, failed, null

\[\*\*trigger\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-response-sweeps-trigger)

nullablestring

The trigger of the sweep\\

\\\"manual\\\" - The sweep is created manually by the customer

\\\"incoming\\\" - The sweep is created by incoming funds flow (e.g.

Incoming Wire) \\\"balance_threshold\\\" - The sweep is created by
balance

threshold setting \\\"automatic_aggregate\\\" - The sweep is created by
the

Plaid automatic aggregation process. These funds did not pass through

the Plaid Ledger balance.

Possible values: manual, incoming, balance_threshold,

automatic_aggregate

\[\*\*description\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-response-sweeps-description)

string

The description of the deposit that will be passed to the receiving bank

(up to 10 characters). Note that banks utilize this field differently,

and may or may not show it on the bank statement.

\[\*\*network_trace_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-response-sweeps-network-trace-id)

nullablestring

The trace identifier for the transfer based on its network. This will

only be set after the transfer has posted.\\

For ach or same-day-ach transfers, this is the ACH trace number. For rtp

transfers, this is the Transaction Identification number. For wire

transfers, this is the IMAD (Input Message Accountability Data) number.

\[\*\*request_id\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer-sweep-list-response-request-id)

string

A unique identifier for the request, which can be used for

troubleshooting. This identifier, like all Plaid identifiers, is case

sensitive.

{

\\\"sweeps\\\": \\\[

{

\\\"id\\\": \\\"d5394a4d-0b04-4a02-9f4a-7ca5c0f52f9d\\\",

\\\"funding_account_id\\\":
\\\"8945fedc-e703-463d-86b1-dc0607b55460\\\",

\\\"ledger_id\\\": \\\"563db5f8-4c95-4e17-8c3e-cb988fb9cf1a\\\",

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

Was this helpful?

YesNo

\[Webhooks\](https://plaid.com/docs/api/products/transfer/reading-transfers/#webhooks)

\[TRANSFER_EVENTS_UPDATE\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfer_events_update)

Fired when new transfer events are available. Receiving this webhook

indicates you should fetch the new events

from \[\*\*\[/transfer/event/sync\]{.underline}\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#transfereventsync).

\[\*\*webhook_type\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#TransferEventsUpdateWebhook-webhook-type)

string

TRANSFER

\[\*\*webhook_code\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#TransferEventsUpdateWebhook-webhook-code)

string

TRANSFER_EVENTS_UPDATE

\[\*\*environment\*\*\](https://plaid.com/docs/api/products/transfer/reading-transfers/#TransferEventsUpdateWebhook-environment)

string

The Plaid environment the webhook was sent from

Possible values: sandbox, production

{

\\\"webhook_type\\\": \\\"TRANSFER\\\",

\\\"webhook_code\\\": \\\"TRANSFER_EVENTS_UPDATE\\\",

\\\"environment\\\": \\\"production\\\"

}

\*\*\[\\

\]{.underline}\*\*
