CUSTOMER PATH THROUGH GIFT CARD LIQUIDATION

1Here's a more detailed step-by-step mid-level outlook on your entire
process,

incorporating both the technical and operational elements. This covers
everything from

user interactions, system processes, and security considerations to the
integration of

external services like Plaid, Authorize.NET.

\-\--

\### \*\*Phase 1: User Authentication and Initial Transaction Setup\*\*

1\. \*\*User Logs into WordPress Site\*\*:

\- \*\*Authentication\*\*: Users log into your WordPress site securely
using their

username/email and password. The login process is protected with SSL/TLS
encryption,

ensuring that data is securely transmitted to and from the server.

\- \*\*Dashboard Access\*\*: After a successful login, the user is
directed to their personal

dashboard, which is dynamically generated based on their account
information. The

dashboard contains an option to initiate the process of selling a gift
card.

2\. \*\*User Initiates Selling Gift Card\*\*:

\- \*\*Button Interaction\*\*: The user clicks a \"Sell My Gift Card\"
button on their dashboard to

start the process.   the button is actually a form disguised as a button
that has many

hidden fields that are automatically and dynamically filled in but this
meta information

needs to follow the user through their whole process the fields are,  
First Name,  Last

Name,  Date Of Birth,  user email address,  Wordpress user ID,  invoice
number,   user ip

address, at the same time \*\*Invoice Number Generation\*\*:

\- \*\*Unique Invoice Number Creation\*\*: As soon as the user clicks
the button in their

dashboard , WSForm generates a \*\*unique Invoice Number \*\* for this
specific transaction.

This transaction ID will be used to track the payment and payout process
from start to

finish.

\- \*\*Linking with User Data\*\*: The Invoice Number is associated with
the user's ID and

stored in the WordPress database. This association will allow you to
track and manage the

transaction at every step of the process.

\- as soon as the user clicks the button to start the transaction
process and all of those

hidden fields, are they nearly filled in at that same time a check is
being done to make sure

the user hasn't exceeded the limits\*\*Initial Transaction
Validation\*\*: Before allowing the

user to proceed, a check is triggered to verify the user\'s eligibility
based on predefined

transaction limits. This involves querying the WordPress custom table
database for the

user\'s past transactions.- \*\*Transaction Limit Check\*\*: (all date
and times based on website server date and time)

\- \*\*Daily\*\*: Maximum \$500 in transactions per 24 hours

\- \*\*Weekly\*\*: Maximum \$1,800 last 7 days (rolling 7 day limit)

\- \*\*Monthly\*\*: Maximum \$3,600 since 1st day of current month.

\- \*\*Yearly\*\*: Maximum \$8,800 since January 1st of current year

\- The scenario retrieves the user\'s transaction history, filtering by
relevant time periods

(daily, weekly, monthly, yearly).

\- It calculates the total transaction amount and the number of
transactions to ensure

compliance with the set limit so.

\- If the user exceeds any of these limits, they receive an error
message saying they have

exceeded transaction limits. THEN THE PLUG-IN CALCULATES WHEN THE USER
CAN

NEXT INITITAE A TERANSACTION AND FOR HOW MUCH AND BE WITHIN THE LIMITS
AND

THIS IS DISPLAYED WITH THE ERROR MESSAGE on the dashboard and are not
allowed to

proceed.

EXAMPLE: "ERROR 567 YOU HAVE EXCEEDED THE TRANSACTION LIMITS

YOU CAN NEXT INITIATE A TRANSACTION IN 37 DAYS FOR \$500 BEFORE REACHING
YOUR

NEXT LIMIT"

\- If the user is within the limits, then they "pass" the check and the
custom plugin redirects

the user to the next phase and automatically changed to a custom user
role of "PLAID" for

no more than 30 minutes and if 30 minutes passes the users role
automatically changes

back to subscriber. Only admins and users with the custom role of PLAID
can see the LINK

PLAID MODAL and the users are redirected to the PLAID MODAL.

\-\--

\### \*\*Phase 2: Bank Account Linking with Plaid\*\*

3\. \*\*Triggering the Plaid Modal\*\*:

\- \*\*Plaid Integration\*\*: After passing the transaction limit
checks, the user is presented

with a \*\*Plaid modal\*\* to securely link their bank account.

\- \*\*Plaid API Request\*\*: The system makes an API call to Plaid to
initiate the modal, which

allows the user to select and link their bank account.

Phase 2: Bank Account Linking with Plaid

1\. Triggering the Plaid Modal:

o Plaid Integration: After passing the transaction limit checks, the
user is

presented with a Plaid modal to securely link their bank account.2. o
Plaid API Request: The system makes an API call to Plaid to initiate the

modal, allowing the user to select and link their bank account.

Bank Account Verification and Token Generation:

o Plaid Verification: Plaid verifies the user's bank account
information,

including key details. However, this does not verify against your stored
data

yet. This is where the identity verification process comes in.

o Token Generation: Upon successful bank account linking, Plaid
generates

a bank account tokenrepresenting the linked bank account. This token is

stored securely and encrypted for later use in the payout process.

: Identity Verification Using Plaid API (Right after token generation)

3\. Initiating Identity Verification:

o Data Collection: Once the bank account is linked and the token is

generated, the system triggers the Plaid Identity Verification API.

▪ The following user details (retrieved from WordPress) are sent to
Plaid:

▪ First Name

▪ Last Name

▪ Date of Birth

▪ =Plaid will use this data to verify that the information provided
during

bank linking matches what is stored on the site.

4\. Identity Verification Results:

o Successful Verification: If the information matches (e.g., first name,
last

name, and date of birth are the same between the bank account and

WordPress profile), the verification is logged, and the user is
automatically

redirected to the next phase by the custom plug-in in the users role
will

change again.

o Failed Verification: If the data does not match, the user is presented
with an

error message:

▪ \"The information linked to your bank account does not match our

records. Please try linking another account.\"

▪ The system logs this failure, and gives the user the option to link

another bank account or return to the homepage.

5\. Logging and Notifications:

o The verification result is logged in the WordPress database, along
with the

user\'s transaction details and the verification outcome.

o Successful verifications trigger a notification to the user that they
are about

to be redirected to the next step.

o Failed verifications result in a detailed error notification.

6\. Security Considerations:

o Encryption: All personal data sent to or received from the Plaid API
is

encrypted using AES-256.

o Temporary Data: Any temporary user data (e.g., for identity
verification) is

securely deleted once the verification process is complete.4. \*\*Bank
Account Verification and Token Generation\*\*:

\- \*\*Plaid Verification\*\*: Plaid verifies the user's bank account
information, including the

date of birth or other identifying details stored in the user's
WordPress profile. I want to use

date of birth too match that the identity of the user that the date of
birth matches the user

account on my website and the owner o0f the bank account. the reason I
want too match

date of birth is because3 names have to many variations and phone
numbers and

addresses change the only thing that doesn't is date of birth.

\- \*\*Token Generation\*\*: Upon successful bank account linking, Plaid
generates a \*\*bank

account token\*\* (representing the linked bank account). This token is
unique to the user

and must be securely stored for use during the payout phase.

5\. \*\*Secure Storage of the Plaid Token\*\*:

before encryption before the token is stored there needs to be a "check
too see what wp

user id and date of birth and first name and last name and lastly
invoice number was that

token issued to so that when those same identifying meta data comes back
another check

can be done to ensure the correct token is going with the correct user
it was issued to.

\- \*\*Encryption of Token\*\*: The Plaid bank account token is
encrypted using strong AES-

256 encryption. The encryption key is retrieved securely from plaid and
transferred back

with user identifying data.

\- \*\*Storing the Encrypted Token\*\*: The encrypted token is stored in
the WordPress

database in a custom field associated with the user\'s ID. The token is
valid for 30 minutes,

so it is stored only temporarily until the payout process is
complete.     The plaid token

needs to be stored some how securely some where wordpress can securely
store the token

\- \*\*Security Considerations\*\*: Proper file permissions and database
security measures

are applied to ensure that the token is not accessible to unauthorized
users or processes.

Additionally, the encrypted token is deleted from the database once the
payout process is

complete.

\-\--

After token is encrypted securely stored in hidden area (not environment
variable

somthi9ng more secure created with custom plugin code). When being
redirected the

WordPress users rule is going to be changed again to another custom
role. This custom role

is going to be called "transaction" only users with this role and admin
can access the ws

form i made for the user to enter the amount they wish to be charged.

Phase 3: User Inputs Transaction Amount

• After successful identity verification, the user proceeds to the next
phase, where

they can enter the value of their gift card.### \*\*Phase 3: User Inputs
Transaction Amount\*\*

Again once the users bank account is linked

6\. \*\*User Inputs Gift Card Value\*\*:

\- \*\*Form Interaction via WSForm\*\*: The user is then prompted to
enter the value of the

gift card they want to sell (e.g., \$100). This is done through a custom
form built using

\*\*WSForm\*\*.

\- \*\*Validation of Input\*\*: WSForm validates the input to ensure it
falls within acceptable

ranges (e.g., \$20 to \$500). Additional form validation ensures that
the input is a numeric

value and meets any other business rules you have defined.

\|

7.\-\--After user entered amount to be charged my ws form pro
authorize.net extension will

call the authorize.net modal where the user will enter the gift card
information

\### \*\*Phase 4: Payment Processing with Authorize.NET\*\*

8\. \*\*Initiating Payment via Authorize.NET\*\*:

\- \*\*Payment Modal Launch\*\*: Here, they will input their gift card
details (e.g., gift card

number and PIN) to process the payment.

\- \*\*Sensitive Data Handling\*\*: All payment information is handled
exclusively by

Authorize.NET via the modal. This ensures that sensitive card
information is never stored or

processed by your servers, keeping you out of the scope of PCI
compliance.

9\. \*\*Authorize.NET Transaction Flow\*\*: AFTER THE TRANSACTION I WILL
NEED THE

CUSTOM PLUGIN TO FIGURE OUT A WAY TO NOTIFY MY WEBSITE THAT THE USER
WITH

ALL THE META DATA THAT HAS BEEN FOLLOWING THEM HAS EITHER SUCCESFULLY

COMPLETED AUTHORIUZE AND CAPTURE PROCESS OR THEY WERE DECLINED

\- \*\*Transaction Request\*\*: The system triggers an API call to
Authorize.NET, which

processes the transaction based on the gift card details provided by the
user.

\- \*\*Authorization and Capture\*\*: The transaction is authorized and
the funds are captured

by Authorize.NET. Upon successful completion, Authorize.NET generates a
\*\*transaction

ID\*\* (separate from your internal transaction ID) and sends it to your
system via a webhook.

10\. \*\*Webhook Handling

\- \*\*Webhook Receipt\*\*: A webhook is sent from Authorize.NET,
notifying your system of

the transaction's success or failure.- \*\*Database Update THE WEB HOOK
OR PLUG IN updates the WordPress CUSTOM

TABLE database, marking the transaction as successful (or failed, if
applicable). The

transaction ID from authorize.net, wp user ID, email address, date of
birth, and amount are

logged for future reference.

\-\--AFTER SUCCESFUL AUTHORIZE AND CAPTURE THE USER IS AGAIN
AUTOMATICALLY RE

DIRECTED TO MY WEBSITE FOR ONLY A FEW SECONDS ENOUGH TIME TO

AUTOMATICALLY SWICH THE USERS ROLE TO "Pay Out". Only users with the
role "Pay Out"

in Admins, are able to access the plaid payout model. Also, in the few
seconds the user is

at my site, the token is decrypted I there's one more check all the
meta-data that's been

following. This user is verified that it's the same meta-data that
dropped off the token in the

1st Pl.,, WordPress user ID invoice number first name last name date of
birth.

\### \*\*Phase 5: Payout to User via Plaid RTP or FedNow\*\*

11\. \*\*Payout Calculation\*\*:

\- \*\*Fee Deduction\*\*: Based on the amount the user entered (e.g.,
\$100), the system

calculates the payout. For instance, if the fee is 15% + \$1.50, the
user would receive

\$83.50.

\- \*\*Linking to Plaid Token\*\*: The calculated payout is then
associated with the encrypted

Plaid bank account token previously stored in the WordPress database.

12\. \*\*Plaid RTP/FedNow API Call\*\*:

\- \*\*Decrypting the Token\*\*: Before initiating the payout, the
system decrypts the Plaid

token using the encryption key stored securely secret management area.

\- \*\*API Call to Plaid\*\*: An API call is made to \*\*Plaid's RTP or
FedNow\*\* system to

deposit the calculated payout into the user's linked bank account. The
decrypted token is

used in this request to ensure the payout goes to the correct account.

13\. \*\*Payout Confirmation via Webhook\*\*:

\- \*\*Webhook from Plaid\*\*: Once the payout is successfully
processed, Plaid sends a

webhook to your system, confirming that the funds have been deposited
into the user's

account.

\- \*\*Update Transaction Status\*\*: the custom plug-in updates the
status of the

transaction the WordPress database, marking it as fully completed and
successful. The

payout details, including the amount and invoice number and transaction
ID from

authorize.net, are stored.

\-\--

\### \*\*Phase 6: User Notification and Finalization\*\*

14\. \*\*User Notification\*\*:- \*\*Email/SMS Notification\*\*: After
the payout is confirmed, the user is notified via email

or SMS that the funds have been successfully deposited into their linked
bank account.

\- \*\*Notification Contents\*\*: The notification includes the
transaction amount, the payout

details, and any relevant information, such as the last four digits of
their gift card number

for reference.

15\. \*\*Transaction Cleanup and Token Deletion\*\*:

\- \*\*Cleanup Process\*\*: The scenario triggers a final cleanup
process where the

encrypted Plaid token is deleted from the WordPress database. This
ensures that no

sensitive data lingers in the system after the transaction is complete.

\- \*\*Audit Logging\*\*: A final audit log entry is created, recording
the entire transaction

lifecycle from initiation to payout. This log can be used for
troubleshooting or compliance

purposes.

\-\--

\### \*\*Additional Security Measures\*\*

\- \*\*Role-Based Access Control (RBAC)\*\*: Access to sensitive
processes (e.g., decrypting

Plaid tokens, handling transaction data) is restricted to only the
necessary system

components and

\- \*\*Regular Security Audits\*\*: Regular security reviews and audits
are performed on both

the WordPress system and the Make.com scenarios to ensure compliance
with security

best practices.

\- \*\*Data Backup and Recovery\*\*: Regular backups of non-sensitive
transaction data are

performed, ensuring that the system can recover in the event of a
failure or breach.

\-\--

This detailed flow covers each critical step in the process, from user
initiation to final

payout, with a focus on security, data handling, and automation. Each
phase ensures that

sensitive data is securely managed, while the transactional logic is
efficiently handled

through API calls, webhooks, and automation workflows.

Steps for AI/Developer to Implement the Verification

Here's how this entire Identity Verification After Bank Linking process
would be mapped

out for an AI or developer to implement in the custom plugin:

Phase 1: Preparation and Prerequisites

1\. Understanding the Workflow:o The bank account linking must occur
first. After linking the bank account

via Plaid, the identity verification will use data retrieved from the
bank

account (such as the account holder's name and date of birth) to compare

with the user's WordPress profile.

o Ensure that both APIs are ready and properly integrated into the
workflow.

2\. Gather Necessary APIs:

o Ensure access to two APIs from Plaid:

▪ Plaid Link API: This handles the linking of the bank account (already

implemented in the existing flow).

▪ Plaid Identity Verification API: This API checks that the account

holder's details match the user's data stored in WordPress.

o Confirm that API keys are stored securely, and all calls are
encrypted.

3\. Review API Documentation:

o Obtain the Plaid Identity Verification API documentation to understand

request and response formats. Ensure best practices for secure API

communication are followed, including SSL/TLS and AES-256 encryption.

Phase 2: Data Flow and Logic Design

4\. Retrieve User Data:

o When the user logs into the system, retrieve the following data from
their

WordPress profile:

▪ First Name

▪ Last Name

▪ Date of Birth

▪ Email Address (if applicable)

▪ WordPress User ID

o Store these values temporarily in memory to be used for the identity

verification process after the bank is linked.

5\. Bank Account Linking (Existing Flow):

o The user initiates the Plaid modal to link their bank account. Once
the

account is linked, Plaid returns a bank account token, which is stored

securely in the WordPress database.

Phase 3: Identity Verification Execution

6\. Trigger Identity Verification API:

o After the bank account has been successfully linked, the system
triggers a

request to Plaid's Identity Verification API.

o Send the following data from the user's WordPress profile to Plaid:

▪ First Name

▪ Last Name

▪ Date of Birth

▪ Email Address (if applicable)

▪ WordPress User ID

7\. Receive API Response:o Plaid will return the account holder's
details, such as:

▪ First Name

▪ Last Name

▪ Date of Birth

o Compare these details with the data from the WordPress profile.

Phase 4: Handling the Results

8\. Matching the Data:

o If the bank account details (name, date of birth) match the WordPress
profile:

▪ Log the success, noting the verification reference, and proceed with

the next step of the transaction process.

o If the data does not match:

▪ Display an error message to the user indicating that the bank account

information does not match the records stored in WordPress.

▪ Allow the user to either update their profile or retry with another
bank

account.

Phase 5: Security and Data Storage

9\. Encryption of Personal Data:

o All personal information exchanged during the verification process
should be

encrypted using AES-256.

o Ensure that data transmission (API calls) is secured using SSL/TLS.

10\. Temporary Data Storage and Cleanup:

• The data needed for identity verification (such as the user's name and
date of birth)

should only be stored temporarily.

• Once the verification process is completed (successfully or
otherwise), delete any

sensitive data to prevent unnecessary data retention.

Phase 6: User Role and Access Management

11\. User Role Management:

• Assign appropriate user roles based on the success or failure of the
verification:

o For a successful verification, assign a temporary role like
\"Verified\" to allow

the user to continue to the next phase.

o For failed verification, restrict the user's access to sensitive
actions (like

initiating a payout) until they provide correct information.

Conclusion: Key Considerations for Building the Feature

• API Integration: Ensure the seamless integration of Plaid Identity
Verification

API immediately after bank account linking.

• Data Comparison: Compare the returned bank account details with the
stored

WordPress profile data for each user.

• Error Handling: Provide detailed feedback and error handling for both
successful

and failed identity verifications.• Security and Encryption: Follow best
security practices, including the use of AES-

256 encryption for sensitive data both in transit and at rest.

• Logging and Auditing: Log all verification attempts, storing only
necessary

information for compliance and audit purposes.

SUPER DETAILED PLUGIN BLUEPRINT

\-\--

\### \*\*Gift Card Instant Sale Plugin - Comprehensive Blueprint\*\*

\-\--

\### \*\*1. Plugin Overview\*\*

\#### 1.1 Plugin Name

\- \*\*Name\*\*: Gift Card Instant Sale

\#### 1.2 Plugin Description

\- \*\*Functionality\*\*: The \*\*Gift Card Instant Sale\*\* plugin
enables users to instantly sell

Visa, Mastercard, American Express, and Discover gift cards. This plugin
integrates with

\*\*Plaid\*\* for bank account verification and \*\*Authorize.Net\*\*
for payment processing. It

manages user roles, transaction limits, error logging, and dynamic
dashboards. The plugin

follows strict security protocols, including \*\*AES-256 encryption\*\*,
\*\*CSRF/XSS sql, code

injection, any code injection, sanatizes ws forms in line with best
practices espically

because ws forms accept html and other code in its fields and stops file
up loads any many

other protection\*\*, and secure API handling.

\#### 1.3 Plugin Features- \*\*User Authentication\*\*: Leverages
WordPress\' default authentication system, enhanced

with role-based access controls.

\- \*\*Dashboard\*\*: Provides a dynamic user dashboard for transaction
history and profile

management, pulling data from custom tables.

\- \*\*Transaction Limits\*\*: Automatically enforces daily, weekly,
monthly, and yearly

transaction limits, with validation checks to ensure users don't exceed
these limits. If a

limit is exceeded, users receive error messages explaining when and how
much they can

next sell.

\- \*\*API Integration\*\*:either utilizes plugin WP Get API Pro or
Securely handles API requests

to \*\*Plaid\*\* for bank account verification and \*\*Authorize.Net\*\*
for payment processing.

\- \*\*Error Logging\*\*: Comprehensive error logs are accessible via
the admin settings page

and contain detailed information for troubleshooting.

\- \*\*Notifications\*\*: Sends email for important transaction events
(e.g., initiated

transactions, payout completions, critical errors).

\- \*\*Security\*\*: Implements AES-256 encryption for sensitive tokens,
nonce verification for

forms, and secure API key management, ensuring protection from
vulnerabilities like CSRF

and XSS.

\#### 1.4 Plugin Dependencies

\- \*\*WS Form Pro\*\*: Used for form handling and submission, including
hidden fields for user

data.

\- \*\*WPGetAPI Pro\*\*: Facilitates API integration with Plaid and
Authorize.Net.

\- \*\*JetEngine\*\*: Manages dynamic user profiles and stores meta data
related to users.

\- \*\*Bricks Page Builder\*\*: Used for front-end design, creating
custom user interfaces.

\- \*\*SiteGround Backups\*\*: Handles automated data backups to ensure
the security of data

in case of issues.

\-\--

\### \*\*2. Plugin Architecture\*\*

\#### 2.1 Directory Structure

\- \*\*Main Plugin Directory\*\*: Contains the core plugin file
(\`gift-card-instant-sale.php\`)

responsible for initializing the plugin and loading necessary resources.

\- \*\*Includes Directory\*\*: Houses all core classes and utility
functions. Key files include:

\- \*\*Activator Class\*\*: Manages tasks executed during plugin
activation (e.g., database

setup).

\- \*\*Deactivator Class\*\*: Manages cleanup tasks during deactivation
(e.g., removing WP-

Cron jobs).

\- \*\*Frontend Class\*\*: Handles front-end scripts and styles.

\- \*\*Backend Class\*\*: Manages backend operations, including admin
settings and logs.

\- \*\*API Handler Class\*\*: Handles API requests to \*\*Plaid\*\* and
\*\*Authorize.Net\*\* and

manages token encryption/decryption.- \*\*Encryption Class\*\*:
Responsible for AES-256 encryption/decryption of sensitive data

(e.g., Plaid tokens).

\- \*\*Error Logger Class\*\*: Logs errors and exceptions, including
user-specific data for error

tracking.

\- \*\*Email Class\*\*: Sends transactional and error notifications via
email.

\- \*\*Helper Functions\*\*: Contains reusable utility functions.

\- \*\*Assets Directory\*\*: Holds CSS, JavaScript, and other front-end
assets, including:

\- \*\*CSS Directory\*\*: Houses \`gciss-styles.css\`, containing
front-end styling for user-

facing components.

\- \*\*JavaScript Directory\*\*: Contains \`gciss-scripts.js\` to handle
front-end interactions.

\- \*\*Images Directory\*\*: Includes any images or icons required by
the plugin.

\-\--

\### \*\*3. Plugin Initialization\*\*

\#### 3.1 Plugin Metadata

\- The plugin header includes necessary metadata such as the plugin
name, version,

description, author, and text domain for translations. These are defined
in the main plugin

file to ensure proper registration within WordPress.

\#### 3.2 Main Plugin Class (\`GCISS_Main\`)

\- \*\*Initialization\*\*: This class initializes the plugin,
registering hooks and filters for handling

both front-end and back-end operations. It also registers activation and
deactivation hooks

for proper lifecycle management.

\- \*\*Dependency Loading\*\*: The class is responsible for loading all
other required classes

and helper functions.

\- \*\*Hooks\*\*:

\- \*\*Admin Hooks\*\*: Registers admin menus, settings pages, and
handles the logic for

saving admin configurations.

\- \*\*Public Hooks\*\*: Enqueues front-end styles and scripts necessary
for the user-facing

components.

\-\--

\### \*\*4. Activation and Deactivation\*\*

\#### 4.1 Activation Tasks

\- \*\*Database Setup\*\*:

\- \*\*wp_gciss_transactions\*\*: Stores details of each transaction,
including gift card

amount, transaction status, and user ID. Ensure \*\*indexing\*\* on the
\`user_id\` and

\`transaction_id\` columns for faster retrieval.

\- \*\*wp_gciss_users\*\*: Stores user metadata, such as encrypted Plaid
tokens, date of

birth, and linked bank account details.- \*\*wp_gciss_error_logs\*\*:
Stores all critical errors for later review, along with details

about the user, error code, and timestamp.

\- \*\*Roles and Capabilities\*\*: Create specific user roles with
permissions to ensure that

only authorized users can initiate gift card transactions.

\- \*\*Scheduled Events\*\*: Register WP-Cron tasks to manage recurring
processes, such as

cleaning up expired logs and tokens.

\#### 4.2 Deactivation Tasks

\- \*\*Cleanup\*\*: Optionally remove database tables and user roles, or
leave them intact for

future plugin reactivation.

\- \*\*Unregister Hooks and Events\*\*: Ensure all registered hooks and
WP-Cron jobs are

properly deactivated to avoid unwanted load on the site.

\-\--

\### \*\*5. Frontend Functionality\*\*

\#### 5.1 User Dashboard. (website owner will create a "User Dashboard
Page" and the WS

FORM that is disguised as a button that starts the whole process custom
plugin will pick up

all the user meta data from that form that looks like a button in the
dashboard that starts

the entire process and from then on its the custom plugins
responsibility to ensure that

user meta data follows them through the process. The custom plugin will
also be

responsible displaying the past transactions in the users dynamically
generated

dashboard)

\- \*\*Dashboard Components\*\*: The custom dashboard allows users to
view their past

transactions (limit of 50, with 10 transactions displayed per page). It
also includes the

\*\*\"Sell My Gift Card\"\*\* button to initiate a new transaction.

\- \*\*WS Form Pro Integration\*\*:

\- The WS Form is embedded in the dashboard to collect user data, such
as name, email,

and date of birth, which is pulled from JetEngine and pre-populated into
hidden fields.

\*\*\[PLACEHOLDER: WS Form ID for Transaction Initiation\]\*\*

\- The form submission triggers the \*\*Plaid modal\*\*, allowing users
to securely link their

bank account.

\#### 5.2 Transaction Limits and Validation

\- \*\*Form Submission\*\*: Upon submitting the WS Form, a series of
validation checks are

performed:

\- \*\*Daily Limit\*\*: \$500 per day past 24 hours

\- \*\*Weekly Limit\*\*: \$1,300 lastr rolling 7 days

\- \*\*Monthly Limit\*\*: \$3,600 since 1st day of current month.

\- \*\*Yearly Limit\*\*: \$8,800 since Jan 1st of current year.

\- If any of these limits are exceeded, the user will receive an error
message, explaining

when and how much they can next sell.- \*\*Unique Invoice Number\*\*: A
unique ID is generated for each transaction, and it's used

for tracking purposes throughout the process.

\#### 5.3 Plaid API Integration

\- \*\*Plaid Modal Trigger\*\*: After the form is submitted, the
\*\*Plaid modal\*\* opens, allowing

users to securely link their bank accounts for payout.

\- \*\*Token Encryption\*\*: Upon successful bank linking, the generated
Plaid token is

encrypted using \*\*AES-256\*\* and stored in the database.

\- \*\*Session Timeout\*\*: A session timer starts once the user
initiates the transaction. The

session expires after \*\*26 minutes\*\*, and users receive a warning at
the \*\*20-minute

mark\*\*. If the session expires, the Plaid token is invalidated and
removed from the

database. \*\*\[PLACEHOLDER: Timeout Error Message Text\]\*\*

5\. Frontend Functionality

5.3 Plaid API Integration (Updated to include Identity Verification)

• Plaid Modal Trigger: After the form is submitted, the Plaid modal
opens, allowing

users to securely link their bank accounts for payout.

• Token Encryption: Upon successful bank linking, the generated Plaid
token is

encrypted using AES-256 and stored in the database.

• Session Timeout: A session timer starts once the user initiates the
transaction. The

session expires after 26 minutes, and users receive a warning at the
20-minute

mark. If the session expires, the Plaid token is invalidated and removed
from the

database. \[PLACEHOLDER: Timeout Error Message Text\].

5.4 Identity Verification Using Plaid API (New Step)

1\. Initiating Identity Verification After Bank Account Linking:

o Once the bank account is successfully linked and the token is
generated, the

system triggers the Plaid Identity Verification API to confirm that the
bank

account owner matches the user's information in WordPress.

2\. Data Submission:

o The system submits the following data (from the WordPress profile) to
Plaid

for verification:

▪ First Name

▪ Last Name

▪ Date of Birth

▪ Email Address (if applicable)

▪ WordPress User ID

3\. Receiving and Processing the Verification Results:

o Successful Verification: If the data matches (first name, last name,
date of

birth), the user is allowed to proceed to the next phase.

o Failed Verification: If the data does not match, the user is shown an
error

message:

▪ \"Your identity could not be verified. Please update your profile or
try

linking another bank account.\"o The system logs both success and
failure outcomes for auditing purposes.

4\. Logging and Security:

o All verification attempts are logged in the WordPress database,
including the

user ID, transaction ID, and the outcome (success or failure).

o Security: All personal data submitted to or received from the Plaid
API must

be encrypted using AES-256.

o Data Cleanup: Any temporary data used for identity verification (such
as

names or birth dates) must be securely deleted once the process is

complete.

\-\--

\### \*\*6. Backend Functionality\*\*

\#### 6.1 Admin Settings Page

\- \*\*Settings Access\*\*: The settings page is accessible through the
plugins menu on the

WordPress dashboard.

\- \*\*API Key Configuration\*\*: Admins can securely enter and update
their API keys for

\*\*Plaid\*\* and \*\*Authorize.Net\*\*. These keys are encrypted using
\*\*AES-256\*\* and stored in

the database.

\- \*\*Transaction Limits Configuration\*\*: Admins can adjust the
daily, weekly, monthly, and

yearly transaction limits via editable fields in the settings page.

\- \*\*Error Log Viewer\*\*: Displays the last 20 errors encountered by
the system, with detailed

information about which user was affected, error messages, and the point
of failure.

\- \*\*Notifications Settings\*\*: Admins can configure email
notifications for various

transaction and error events.

\#### 6.2 API Management and Webhook Handling

\- \*\*Webhook Management\*\*: Webhooks from Plaid and Authorize.Net are
processed and

logged to ensure accurate status updates for transactions. If a webhook
fails, the system

automatically retries the request until it succeeds. \*\*\[PLACEHOLDER:
Webhook Retry

Logic\]\*\*

\-\--

\### \*\*7. API Integration\*\*

\#### 7.1 Plaid API Integration

\- \*\*Bank Account Linking\*\*: After the transaction limits are
checked, the user is directed to

the \*\*Plaid modal\*\* to link their bank account. The user's \*\*Date
of Birth\*\* is validated

against their WordPress profile for identity verification.

\- \*\*Token Encryption\*\*: The generated Plaid token is encrypted
using \*\*AES-256\*\* and

storedin the WordPress database. \*\*\[PLACEHOLDER: Plaid Token
Encryption Method\]\*\*

\#### 7.2 Authorize.Net Integration

\- \*\*Payment Modal\*\*: The payment is processed via
\*\*Authorize.Net's Accept.js\*\*,

ensuring PCI compliance by not handling sensitive payment data directly
on the site.

\- \*\*Webhook Handling\*\*: Webhooks from Authorize.Net are used to
track the success or

failure of transactions. Any errors are logged in the system for admin
review.

\*\*\[PLACEHOLDER: Authorize.Net Webhook Logic\]\*\*

\-\--

\### \*\*8. Error Handling\*\*

\- \*\*User-Friendly Error Messages\*\*: Users receive simple,
understandable error messages

with codes for technical support. Example: \"Transaction failed. Please
try again later. Error

code: 123.\" \*\*\[PLACEHOLDER: Example Error Messages\]\*\*

\- \*\*Admin Error Notifications\*\*: Admins receive email notifications
when critical errors

occur, including detailed logs for troubleshooting.

\-\--

\### \*\*9. Payout Process\*\*

\#### 9.1 Fee Calculation and Deduction

\- \*\*Fee Structure\*\*: The system deducts a \*\*15%\*\* fee plus a
\*\*\$1.50\*\* flat fee for every

transaction. This is calculated and displayed to the user before
finalizing the transaction.

\#### 9.2 Payout via Plaid RTP/FedNow

\- \*\*Token Decryption\*\*: Before initiating the payout, the system
securely decrypts the Plaid

token using AES-256.

\- \*\*Real-Time Payout\*\*: Funds are transferred to the user's linked
bank account using

\*\*Plaid RTP\*\* or \*\*FedNow\*\*.

\- \*\*Payout Confirmation\*\*: Once the payout is complete, a webhook
from Plaid confirms

the successful transaction, updating the system accordingly.

\- \*\*Token Cleanup\*\*: After successful payout, the token is securely
deleted from the

system to ensure it is not reused.

\-\--

\### \*\*10. Security Implementation\*\*

\#### 10.1 Nonce Verification- \*\*Form Protection\*\*: All forms
submitted through the plugin are secured with nonces to

prevent \*\*CSRF and all other attacks the security document recommended
hardening the

website against\*\*

\- \*\*AJAX Requests\*\*: All AJAX requests made by the plugin include
nonce verification.

\#### 10.2 Encryption and Key Management

\- \*\*Token Encryption\*\*: Plaid tokens and other sensitive data are
encrypted using \*\*AES-

256\*\* before being stored in the WordPress database.

\- \*\*Decryption\*\*: Tokens are decrypted only when necessary, such as
during the payout

process.

\- \*\*Key Management\*\*: Securely manage encryption keys, either
through environment

variables or a secure key management service. \*\*\[PLACEHOLDER: API Key
Encryption

Method\]\*\*

\#### 10.3 Error Logging and Reporting

\- \*\*Detailed Error Logs\*\*: All critical errors are logged in the
admin settings area, providing

details such as the user ID, error type, timestamp, and transaction
status.

\- \*\*Admin Notifications\*\*: Critical system errors trigger email
notifications to

administrators for rapid response.

\-\--

\### \*\*11. Testing and Quality Assurance\*\*

\#### 11.1 Unit Testing

\- \*\*Scope\*\*: Unit tests are written for all critical functions,
including API interactions, token

encryption/decryption, role management, and error logging.

\#### 11.2 Integration Testing

\- \*\*Front-End and Back-End\*\*: Test plugin interactions with other
plugins (e.g., WS Form

Pro, JetEngine) and ensure all front-end forms and back-end settings
work as intended.

\- \*\*Cross-Browser and Device Testing\*\*: Ensure the plugin functions
correctly on different

browsers and devices for a consistent user experience.

\#### 11.3 Security Testing

\- \*\*Vulnerability Scanning\*\*: Perform scans for \*\*SQL
injection\*\*, \*\*XSS\*\*, and other

vulnerabilities.

\- \*\*Manual Security Review\*\*: Ensure all sensitive data handling,
API requests, and role-

based access control are implemented according to best security
practices.

\-\--

\### \*\*12. Deployment and Maintenance\*\*#### 12.1 Deployment

\- \*\*Versioning\*\*: Establish a version control system to manage
plugin updates and ensure

backward compatibility with future WordPress versions.

\#### 12.2 Ongoing Maintenance

\- \*\*Security Updates\*\*: Regularly update the plugin to address
security vulnerabilities and

new feature requests.

\- \*\*Feedback System\*\*: Implement a feedback mechanism in the plugin
settings page for

reporting bugs or feature suggestions.

\-\--

\### \*\*13. Documentation\*\*

\#### 13.1 User Documentation

\- \*\*Installation Guide\*\*: Instructions for installing and
configuring the plugin, including API

key setup and form integration.

\- \*\*Configuration Guide\*\*: Detailed guide on adjusting transaction
limits, setting up

Plaid/Authorize.Net, and managing the error log.

\#### 13.2 Developer Documentation

\- \*\*Code Documentation\*\*: Thoroughly comment all functions and
methods in the

codebase.

\- \*\*API Reference\*\*: Detailed reference for all API integrations
with Plaid and Authorize.Net,

including example requests and responses.

\- \*\*Extensibility\*\*: Guide for extending the plugin's functionality
or integrating it with other

WordPress plugins or external APIs.

\-\--

\### \*\*14. Final Checklist\*\*

1\. \*\*Plugin Initialization\*\*: Ensure all activation hooks, role
management, and encryption

methods are properly implemented.

2\. \*\*Frontend Functionality\*\*: User dashboard, transaction limits,
WS Form integration,

and Plaid API functionality are tested and secure.

3\. \*\*Backend Functionality\*\*: Admin settings page, error logs,
notifications, and webhook

management are accessible and functioning correctly.

4\. \*\*Security\*\*: Nonce verification, AES-256 encryption, and
CSRF/XSS protection are in

place.

5\. \*\*Testing and Quality Assurance\*\*: Comprehensive unit,
integration, and security testing

is performed.

6\. \*\*Documentation\*\*: Complete and detailed user and developer
documentation is

available.\-\--

This updated blueprint includes everything from the customer path and
previous blueprint

combined with additional details, ensuring that \*\*every detail\*\* is
covered, from the

transaction flow to security to admin settings.
