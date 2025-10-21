// STEP: Set the query vars from the element settings (@since 1.8)

\$this-\>query_vars = self::prepare_query_vars_from_settings(
\$this-\>settings );

// STEP: Perform the query, set the query result, count and
max_num_pages (@since 1.8)

\$this-\>run();

/\*\*

\* Filter: Force query run (to skip add_to_history() method below)

\*

\* AJAX filter plugins, etc. might want to use this.

\*

\* \@since 1.9.2: Set \$query_vars\[\'bricks_force_run\'\] = true to
force run query rerun (i.e. inside Query Editor or custom code snippet)

\*

\* \@see
https://academy.bricksbuilder.io/article/filter-bricks-query-force_run/

\*

\* \@since 1.9.1.1

\*/

\$force_run = apply_filters( \'bricks/query/force_run\', false, \$this )
\|\| ( isset( \$this-\>query_vars\[\'bricks_force_run\'\] ) &&
\$this-\>query_vars\[\'bricks_force_run\'\] );

/\*\*

\* STEP: Add query instance to query history (Query::\$query_history) to
access & reuse query instance later

\*

\* Only for WP core query types (post, term, user) as other potentially
nested query types (e.g. ACF, Meta Box, Woo cart content, etc.) don\'t
have a unique ID.

\*

\* \@since 1.9.1

\*/

if ( in_array( \$this-\>object_type, \[ \'post\', \'term\', \'user\' \]
) && ! \$force_run ) {

\$this-\>add_to_history();

}

}

}

/\*\*

\* Get query instance by element ID from the query history

\*

\* \@since 1.9.1

\*/

public static function get_query_by_element_id( \$element_id = \'\',
\$is_dynamic_data = false ) {

if ( empty( \$element_id ) ) {

return false;

}

\$query = false;

\$history_queries = self::\$query_history;

// Check if any query history element_id matches the given element_id

if ( ! empty( \$history_queries ) ) {

\$query_history_id = self::generate_query_history_id( \$element_id );

if ( isset( \$history_queries\[ \$query_history_id \] ) ) {

\$query = \$history_queries\[ \$query_history_id \];

}

// If using in dynamic data, and no query history found, maybe user
wants to get query history based on \$element_id

if ( ! \$query && \$is_dynamic_data && self::is_looping() ) {

if ( isset( \$history_queries\[ \$element_id \] ) ) {

\$query = \$history_queries\[ \$element_id \];

}

}

}

return \$query;

}

/\*\*

\* Add current query instance to query history

\*

\* \@since 1.9.1

\*/

public function add_to_history() {

\$identifier = self::generate_query_history_id( \$this-\>element_id );

if ( \$identifier ) {

self::\$query_history\[ \$identifier \] = \$this;

}

}

/\*\*

\* Generate a unique identifier for the query history

\*

\* Use combination of element_id, nested_query_object_type,
nested_query_element_id, nested_loop_object_id.

\*

\* \@since 1.9.1

\*/

public static function generate_query_history_id( \$element_id ) {

\$unique_id = \[\];

\$looping_query_id = self::is_any_looping();

if ( \$looping_query_id && \$looping_query_id !== \$element_id ) {

\$unique_id\[\] = self::get_query_element_id( \$looping_query_id );

\$unique_id\[\] = \$element_id;

\$unique_id\[\] = self::get_query_object_type( \$looping_query_id );

// Get loop ID

\$loop_id = self::get_loop_object_id( \$looping_query_id );

if ( \$loop_id ) {

\$unique_id\[\] = \$loop_id;

}

// Return: No loop ID found

else {

return;

}

} else {

\$unique_id\[\] = \$element_id;

}

return implode( \'\_\', \$unique_id );

}

/\*\*

\* Add query to global store

\*/

public function register_query() {

global \$bricks_loop_query;

\$this-\>id = Helpers::generate_random_id( false );

if ( ! is_array( \$bricks_loop_query ) ) {

\$bricks_loop_query = \[\];

}

\$bricks_loop_query\[ \$this-\>id \] = \$this;

}

/\*\*

\* Calling unset( \$query ) does not destroy query quickly enough

\*

\* Have to call the \'destroy\' method explicitly before unset.

\*/

public function \_\_destruct() {

\$this-\>destroy();

}

/\*\*

\* Use the destroy method to remove the query from the global store

\*

\* \@return void

\*/

public function destroy() {

global \$bricks_loop_query;

unset( \$bricks_loop_query\[ \$this-\>id \] );

}

/\*\*

\* Get the query cache

\*

\* \@since 1.5

\*

\* \@return mixed

\*/

public function get_query_cache() {

if ( ! isset( Database::\$global_settings\[\'cacheQueryLoops\'\] ) \|\|
! bricks_is_frontend() \|\| bricks_is_builder_call() ) {

return false;

}

// Check: Nesting query?

\$parent_query_id = self::is_any_looping();

\$parent_object_id = \$parent_query_id ? self::get_loop_object_id(
\$parent_query_id ) : 0;

// Include in the cache key a representation of the query vars to break
cache for certain scenarios like pagination or search keywords

\$query_vars = wp_json_encode( \$this-\>query_vars );

// Get & set query loop cache (@since 1.5)

\$this-\>cache_key = md5(
\"brx_query\_{\$this-\>element_id}\_{\$query_vars}\_{\$parent_object_id}\"
);

return wp_cache_get( \$this-\>cache_key, \'bricks\' );

}

/\*\*

\* Set the query cache

\*

\* \@since 1.5

\*

\* \@return void

\*/

public function set_query_cache( \$object ) {

if ( ! \$this-\>cache_key ) {

return;

}

wp_cache_set( \$this-\>cache_key, \$object, \'bricks\',
MINUTE_IN_SECONDS );

}

/\*\*

\* Prepare query_vars for the Query before running it

\* Remove unwanted keys, set defaults, populate correct query vars, etc.

\* Static method to be used by other classes. (Bricks\\Database)

\*

\* \@since 1.8

\*/

public static function prepare_query_vars_from_settings( \$settings =
\[\], \$fallback_element_id = \'\' ) {

\$query_vars = \$settings\[\'query\'\] ?? \[\];

// Some elements already built the query vars. (carousel, related-posts)
(@since 1.9.3)

if ( isset( \$query_vars\[\'bricks_skip_query_vars\'\] ) ) {

return \$query_vars;

}

// Unset infinite scroll

if ( isset( \$query_vars\[\'infinite_scroll\'\] ) ) {

unset( \$query_vars\[\'infinite_scroll\'\] );

}

// Unset isLiveSearch (@since 1.9.6)

if ( isset( \$query_vars\[\'is_live_search\'\] ) ) {

unset( \$query_vars\[\'is_live_search\'\] );

}

// Do not use meta_key if orderby is not set to meta_value or
meta_value_num (@since 1.8)

if ( isset( \$query_vars\[\'meta_key\'\] ) ) {

\$orderby = isset( \$query_vars\[\'orderby\'\] ) ?
\$query_vars\[\'orderby\'\] : \'\';

if ( ! in_array( \$orderby, \[ \'meta_value\', \'meta_value_num\' \] ) )
{

unset( \$query_vars\[\'meta_key\'\] );

}

}

\$object_type = self::get_query_object_type();

\$element_id = self::get_query_element_id();

/\*\*

\* \$object_type and \$element_id are empty when this method is called
in pre_get_post (main query)

\* Reason: We just call prepare_query_vars_from_settings() without
initializing the Query class

\* Impact: Some query_vars will be missing because not going through the
switch statement and Bricks PHP filters not fired

\*

\* \@since 1.9.1

\*/

if ( empty( \$object_type ) ) {

\$object_type = \$settings\[\'query\'\]\[\'objectType\'\] ?? \'post\';

}

if ( empty( \$element_id ) && ! empty( \$fallback_element_id ) ) {

\$element_id = \$fallback_element_id;

}

/\*\*

\* Use PHP editor

\*

\* Returns PHP array with query arguments

\*

\* Supported if \'objectType\' is \'post\', \'term\' or \'user\'.

\* No merge query.

\*

\* \@since 1.9.1

\*/

if ( isset( \$query_vars\[\'useQueryEditor\'\] ) && ! empty(
\$query_vars\[\'queryEditor\'\] ) && in_array( \$object_type, \[
\'post\',\'term\',\'user\' \] ) ) {

// Return: Code execution not enabled (Bricks setting or filter)

if ( ! Helpers::code_execution_enabled() ) {

return \[\];

}

\$post_id = Database::\$page_data\[\'preview_or_post_id\'\];

// Sanitize element code (queryEditor)

\$signature = \$query_vars\[\'signature\'\] ?? false;

\$php_query_raw = \$query_vars\[\'queryEditor\'\];

\$php_query_raw = Helpers::sanitize_element_php_code( \$post_id,
\$element_id, \$php_query_raw, \$signature );

\$php_query_raw = is_string( \$php_query_raw ) && ! isset(
\$php_query_raw\[\'error\'\] ) ? bricks_render_dynamic_data(
\$php_query_raw, \$post_id ) : \'\';

\$query_vars\[\'posts_per_page\'\] = get_option( \'posts_per_page\' );

// Define an anonymous function that simulates the scope for user code

\$execute_user_code = function () use ( \$php_query_raw ) {

// Initialize a variable to capture the result of user code

\$user_result = null;

// Capture user code output using output buffering

ob_start();

// Execute the user code

\$user_result = eval( \$php_query_raw );

// Get the captured output

ob_get_clean();

// Return the user code result

return \$user_result;

};

ob_start();

// Prepare & set error reporting

\$error_reporting = error_reporting( E_ALL );

\$display_errors = ini_get( \'display_errors\' );

ini_set( \'display_errors\', 1 );

try {

\$php_query = \$execute_user_code();

} catch ( \\Exception \$error ) {

echo \'Exception: \' . \$error-\>getMessage();

return;

} catch ( \\ParseError \$error ) {

echo \'ParseError: \' . \$error-\>getMessage();

return;

} catch ( \\Error \$error ) {

echo \'Error: \' . \$error-\>getMessage();

return;

}

// Reset error reporting

ini_set( \'display_errors\', \$display_errors );

error_reporting( \$error_reporting );

// \@see https://www.php.net/manual/en/function.eval.php

if ( version_compare( PHP_VERSION, \'7\', \'\<\' ) && \$php_query ===
false \|\| ! empty( \$error ) ) {

// \$php_query = \$error;

ob_end_clean();

} else {

ob_get_clean();

}

\$object_type = empty( \$object_type ) ? \'post\' : \$object_type;

if ( ! empty( \$php_query ) && is_array( \$php_query ) ) {

\$query_vars = array_merge( \$query_vars, \$php_query );

\$query_vars\[\'paged\'\] = self::get_paged_query_var( \$query_vars );

if ( \$object_type === \'term\' ) {

// Handle term pagination (#86bwwav1e)

\$query_vars = self::get_term_pagination_query_var( \$query_vars );

}

}

/\*\*

\* php Editor not triggering query_vars, new query filters unable to
merge query_vars (@since 1.9.6)

\*/

\$query_vars = apply_filters( \"bricks/{\$object_type}s/query_vars\",
\$query_vars, \$settings, \$element_id );

return \$query_vars;

}

// Meta Query vars

\$query_vars = self::parse_meta_query_vars( \$query_vars );

// Set different query vars depending on the object type

switch ( \$object_type ) {

case \'post\':

// Attachments

\$query_attachments = false;

\$query_only_attachments = false;

// post_type can be \'string\' or \'array\'

\$post_type = ! empty( \$query_vars\[\'post_type\'\] ) ?
\$query_vars\[\'post_type\'\] : false;

if ( \$post_type ) {

if ( is_array( \$post_type ) ) {

\$query_attachments = in_array( \'attachment\', \$post_type );

if ( \$query_attachments && count( \$post_type ) === 1 ) {

\$query_only_attachments = true;

}

} else {

\$query_attachments = \$post_type === \'attachment\';

\$query_only_attachments = \$post_type === \'attachment\';

}

}

\$query_vars\[\'post_status\'\] = \'publish\';

/\*\*

\* Post type \'attachment\' included: Add post status \'inherit\'

\*

\* \@see:
https://developer.wordpress.org/reference/classes/wp_query/#post-type-parameters

\*/

if ( \$query_attachments ) {

\$query_vars\[\'post_status\'\] = \[ \'inherit\', \'publish\' \];

}

// Query ONLY attachments: Set \'post_mime_type\' query var

if ( \$query_only_attachments ) {

\$mime_types = isset( \$query_vars\[\'post_mime_type\'\] ) ?
bricks_render_dynamic_data( \$query_vars\[\'post_mime_type\'\] ) :
\'image\';

\$mime_types = explode( \',\', \$mime_types );

\$query_vars\[\'post_mime_type\'\] = \$mime_types;

}

// Page & Pagination

// \@since 1.7.1 - Standardize use the get_paged_query_var() function to
get the paged value

\$query_vars\[\'paged\'\] = self::get_paged_query_var( \$query_vars );

// Value must be -1 or \> 1 (0 is not allowed)

\$query_vars\[\'posts_per_page\'\] = ! empty(
\$query_vars\[\'posts_per_page\'\] ) ? intval(
\$query_vars\[\'posts_per_page\'\] ) : get_option( \'posts_per_page\' );

// Exclude current post

if ( isset( \$query_vars\[\'exclude_current_post\'\] ) ) {

// \@since 1.8 - Capture exclude_current_post value inside builder call

if ( is_single() \|\| is_page() \|\| bricks_is_builder_call() ) {

// Current post not working with populate content in builder mode
(@since 1.9.5)

\$post_id = ! self::is_any_looping() && isset(
Database::\$page_data\[\'preview_or_post_id\'\] ) ?
Database::\$page_data\[\'preview_or_post_id\'\] : get_the_ID();

\$query_vars\[\'post\_\_not_in\'\]\[\] = \$post_id;

}

unset( \$query_vars\[\'exclude_current_post\'\] );

}

// \@since 1.5 - Post parent

if ( isset( \$query_vars\[\'post_parent\'\] ) ) {

\$post_parent = bricks_render_dynamic_data(
\$query_vars\[\'post_parent\'\] );

if ( strpos( \$post_parent, \',\' ) !== false ) {

\$post_parent = explode( \',\', \$post_parent );

// \@since 1.7.1

\$query_vars\[\'post_parent\_\_in\'\] = (array) \$post_parent;

unset( \$query_vars\[\'post_parent\'\] );

} else {

\$query_vars\[\'post_parent\'\] = (int) \$post_parent;

}

}

// Tax query

\$query_vars = self::set_tax_query_vars( \$query_vars );

// \@see:
https://academy.bricksbuilder.io/article/filter-bricks-posts-merge_query/

\$merge_query = apply_filters( \'bricks/posts/merge_query\', true,
\$element_id );

/\*\*

\* Merge wp_query vars and posts element query vars

\*

\* \@since 1.7: Merge query only if \'disable_query_merge\' control is
not set!

\* \@since 1.9.9: Merge query only if \'woo_disable_query_merge\'
control is not set! (Products element)

\*/

if ( \$merge_query &&

( is_archive() \|\| is_author() \|\| is_search() \|\| is_home() ) &&

empty( \$query_vars\[\'disable_query_merge\'\] ) &&

empty( \$query_vars\[\'woo_disable_query_merge\'\] )

) {

global \$wp_query;

\$query_vars = wp_parse_args( \$query_vars, \$wp_query-\>query );

}

/\*\*

\* REST API /load_query_page adds \"\_merge_vars\" to the query to make
sure the archive context is maintained on infinite scroll

\* Not in use (@since 1.9.5)

\*

\* \@since 1.5.1

\*/

if ( ! empty( \$query_vars\[\'\_merge_vars\'\] ) ) {

\$merge_query_vars = \$query_vars\[\'\_merge_vars\'\];

unset( \$query_vars\[\'\_merge_vars\'\] );

\$query_vars = wp_parse_args( \$query_vars, \$merge_query_vars );

}

// \@see:
https://academy.bricksbuilder.io/article/filter-bricks-posts-query_vars/

// \@since 1.3.6 Added \$element_id

\$query_vars = apply_filters( \'bricks/posts/query_vars\', \$query_vars,
\$settings, \$element_id );

break;

case \'term\':

// Number. Default is \"0\" (all) but as a safety procedure we limit the
number

\$query_vars\[\'number\'\] = isset( \$query_vars\[\'number\'\] ) ?
\$query_vars\[\'number\'\] : get_option( \'posts_per_page\' );

// Paged - set the paged key to the correct value (#86bwqwa31)

\$query_vars\[\'paged\'\] = self::get_paged_query_var( \$query_vars );

// Handle term pagination (#86bwwav1e)

\$query_vars = self::get_term_pagination_query_var( \$query_vars );

// Hide empty

if ( isset( \$query_vars\[\'show_empty\'\] ) ) {

\$query_vars\[\'hide_empty\'\] = false;

unset( \$query_vars\[\'show_empty\'\] );

}

// Current Post Term - (@since 1.8.4)

if ( isset( \$query_vars\[\'current_post_term\'\] ) ) {

// Current post term not working with populate content in builder mode
(@since 1.9.5)

\$post_id = ! self::is_any_looping() && isset(
Database::\$page_data\[\'preview_or_post_id\'\] ) ?
Database::\$page_data\[\'preview_or_post_id\'\] : get_the_ID();

\$query_vars\[\'object_ids\'\] = \$post_id;

unset( \$query_vars\[\'current_post_term\'\] );

}

if ( isset( \$query_vars\[\'child_of\'\] ) ) {

\$query_vars\[\'child_of\'\] = bricks_render_dynamic_data(
\$query_vars\[\'child_of\'\] );

}

if ( isset( \$query_vars\[\'parent\'\] ) ) {

\$query_vars\[\'parent\'\] = bricks_render_dynamic_data(
\$query_vars\[\'parent\'\] );

}

// Include & Exclude terms

if ( isset( \$query_vars\[\'tax_query\'\] ) ) {

\$query_vars\[\'include\'\] = self::convert_terms_to_ids(
\$query_vars\[\'tax_query\'\] );

unset( \$query_vars\[\'tax_query\'\] );

}

if ( isset( \$query_vars\[\'tax_query_not\'\] ) ) {

\$query_vars\[\'exclude\'\] = self::convert_terms_to_ids(
\$query_vars\[\'tax_query_not\'\] );

unset( \$query_vars\[\'tax_query_not\'\] );

}

// \@see:
https://academy.bricksbuilder.io/article/filter-bricks-terms-query_vars/

\$query_vars = apply_filters( \'bricks/terms/query_vars\', \$query_vars,
\$settings, \$element_id );

break;

case \'user\':

// Unset post_type

if ( isset( \$query_vars\[\'post_type\'\] ) ) {

unset( \$query_vars\[\'post_type\'\] );

}

// Current Post Author - (@since 1.9.1)

if ( isset( \$query_vars\[\'current_post_author\'\] ) ) {

\$current_post = get_post(); // Get the current post object

// Check if the current post has an author

if ( is_a( \$current_post, \'WP_Post\' ) && ! empty(
\$current_post-\>post_author ) ) {

\$query_vars\[\'include\'\] = \$current_post-\>post_author;

}

unset( \$query_vars\[\'current_post_author\'\] );

}

// Paged

\$query_vars\[\'paged\'\] = self::get_paged_query_var( \$query_vars );

// Pagination (number, offset, paged). Default is \"-1\" but as a safety
procedure we limit the number (0 is not allowed)

\$query_vars\[\'number\'\] = ! empty( \$query_vars\[\'number\'\] ) ?
\$query_vars\[\'number\'\] : get_option( \'posts_per_page\' );

// Pagination: Fix the offset value (@since 1.5)

\$offset = ! empty( \$query_vars\[\'offset\'\] ) ?
\$query_vars\[\'offset\'\] : 0;

// Store the original offset value (@since 1.9.1)

\$query_vars\[\'original_offset\'\] = \$offset;

if ( ! empty( \$offset ) && \$query_vars\[\'paged\'\] !== 1 ) {

\$query_vars\[\'offset\'\] = ( \$query_vars\[\'paged\'\] - 1 ) \*
\$query_vars\[\'number\'\] + \$offset;

}

// \@see:
https://academy.bricksbuilder.io/article/filter-bricks-users-query_vars/

\$query_vars = apply_filters( \'bricks/users/query_vars\', \$query_vars,
\$settings, \$element_id );

break;

}

return \$query_vars;

}

/\*\*

\* Perform the query (maybe cache)

\*

\* Set \$this-\>query_result, \$this-\>count, \$this-\>max_num_pages

\*

\* \@return void (@since 1.8)

\*/

public function run() {

\$count = \$this-\>count;

\$max_num_pages = \$this-\>max_num_pages;

\$query_vars = \$this-\>query_vars;

/\*\*

\* NOTE: Query for live_search should not run on page load

\*

\* However, this will cause many issues.

\* - Elements not showing on the initial page load and their JS will not
be enqueue. Subsequent AJAX search unable to initialize the JS

\* - Templates are not populated with content on initial page load,
especially popup templates. Subsequent AJAX search unable trigger the
popup

\*

\* Current solution: Run the query on initial page load, remove them in
render() method if live_search is enabled

\*

\* \@since 1.9.6

\*/

switch ( \$this-\>object_type ) {

case \'post\':

\$result = \$this-\>run_wp_query();

// STEP: Populate the total count

\$count = empty( \$query_vars\[\'no_found_rows\'\] ) ?
\$result-\>found_posts : ( is_array( \$result-\>posts ) ? count(
\$result-\>posts ) : 0 );

\$max_num_pages = empty( \$query_vars\[\'posts_per_page\'\] ) ? 1 :
ceil( \$count / \$query_vars\[\'posts_per_page\'\] );

break;

case \'term\':

\$term_result = \$this-\>run_wp_term_query();

\$result = \$term_result\[\'terms\'\];

\$count = \$term_result\[\'total\'\];

// STEP: Get the original offset value (@since 1.9.1)

\$original_offset = ! empty( \$query_vars\[\'original_offset\'\] ) ?
\$query_vars\[\'original_offset\'\] : 0;

// STEP: Populate the total count

if ( ! empty( \$query_vars\[\'number\'\] ) ) {

// Subtract the \$original_offset to fix pagination (@since 1.9.1)

\$count = \$count \> 0 ? \$count - \$original_offset : 0;

}

// STEP : Populate the max number of pages

\$max_num_pages = empty( \$query_vars\[\'number\'\] ) \|\| count(
\$result ) \< 1 ? 1 : ceil( \$count / \$query_vars\[\'number\'\] );

break;

case \'user\':

\$users_query = \$this-\>run_wp_user_query();

// STEP: The query result

\$result = \$users_query-\>get_results();

// STEP: Populate the total count of the users in this query

\$count = \$users_query-\>get_total();

// STEP: Get the original offset value (@since 1.9.1)

\$original_offset = ! empty( \$query_vars\[\'original_offset\'\] ) ?
\$query_vars\[\'original_offset\'\] : 0;

// STEP: Subtract the \$original_offset to fix pagination (@since 1.9.1)

\$count = \$count \> 0 ? \$count - \$original_offset : 0;

// STEP : Populate the max number of pages

\$max_num_pages = empty( \$query_vars\[\'number\'\] ) \|\| count(
\$result ) \< 1 ? 1 : ceil( \$count / \$query_vars\[\'number\'\] );

break;

default:

// Allow other query providers to return a query result (Woo Cart, ACF,
Metabox\...)

\$result = apply_filters( \'bricks/query/run\', \[\], \$this );

\$count = ! empty( \$result ) && is_array( \$result ) ? count( \$result
) : 0;

break;

}

/\*\*

\* Set the query result, count and max_num_pages in a centralized way

\* Previously this was done in run_wp_query(), run_wp_term_query() and
run_wp_user_query()

\* Filters provided

\*

\* \@see
https://academy.bricksbuilder.io/article/filter-bricks-query-result/

\* \@see
https://academy.bricksbuilder.io/article/filter-bricks-query-result_count/

\* \@see
https://academy.bricksbuilder.io/article/filter-bricks-query-result_max_num_pages/
(@since 1.9.1)

\*

\* \@since 1.8

\*/

\$this-\>query_result = apply_filters( \'bricks/query/result\',
\$result, \$this );

\$this-\>count = apply_filters( \'bricks/query/result_count\', \$count,
\$this );

// Pagination element relies on this value (@since 1.9.1)

\$this-\>max_num_pages = apply_filters(
\'bricks/query/result_max_num_pages\', \$max_num_pages, \$this );

}

/\*\*

\* Run WP_Term_Query

\*

\* \@see
https://developer.wordpress.org/reference/classes/wp_term_query/

\*

\* \@return array Terms (WP_Term)

\*/

public function run_wp_term_query() {

// Cache?

\$result = \$this-\>get_query_cache();

if ( \$result === false ) {

\$terms_query = new \\WP_Term_Query( \$this-\>query_vars );

// Run another query to get the total count, set number to 0 to avoid
limit

\$total_terms_query = new \\WP_Term_Query( array_merge(
\$this-\>query_vars, \[ \'number\' =\> 0 \] ) );

\$result = \[

\'terms\' =\> \$terms_query-\>get_terms(),

\'total\' =\> count( \$total_terms_query-\>get_terms() ),

\];

\$this-\>set_query_cache( \$result );

}

return \$result;

}

/\*\*

\* Run WP_User_Query

\*

\* \@see
https://developer.wordpress.org/reference/classes/wp_user_query/

\*

\* \@return WP_User_Query (@since 1.8)

\*/

public function run_wp_user_query() {

// Cache?

\$users_query = \$this-\>get_query_cache();

if ( \$users_query === false ) {

\$users_query = new \\WP_User_Query( \$this-\>query_vars );

\$this-\>set_query_cache( \$users_query );

}

return \$users_query;

}

/\*\*

\* Run WP_Query

\*

\* \@return object

\*/

public function run_wp_query() {

// Cache?

\$posts_query = \$this-\>get_query_cache();

if ( \$posts_query === false ) {

add_action( \'pre_get_posts\', \[ \$this, \'set_pagination_with_offset\'
\], 5 );

add_filter( \'found_posts\', \[ \$this, \'fix_found_posts_with_offset\'
\], 5, 2 );

\$use_random_seed = self::use_random_seed( \$this-\>query_vars );

// \@since 1.7.1 - Avoid duplicate posts when using \'rand\' orderby

if ( \$use_random_seed ) {

add_filter( \'posts_orderby\', \[ \$this,
\'set_bricks_query_loop_random_order_seed\' \], 11 );

}

/\*\*

\* Set builder preview query_vars as we are not relying on setup_query
function in includes/elements/base.php anymore

\* Shouldn\'t merge with preview query_vars if \'disable_query_merge\'
is set (#86bx7cfxp)

\* Shouldn\'t merge with preview query_vars if
\'woo_disable_query_merge\' is set for Products element (@since 1.9.9)

\*

\* \@since 1.9.1

\*/

if ( Helpers::is_bricks_preview() && ! isset(
\$this-\>query_vars\[\'disable_query_merge\'\] ) && ! isset(
\$this-\>query_vars\[\'woo_disable_query_merge\'\] ) ) {

\$post_id = Database::\$page_data\[\'preview_or_post_id\'\];

\$builder_preview_query_vars = Helpers::get_template_preview_query_vars(
\$post_id );

// Use custom deep merge function instead of wp_parse_args() as second
parameter is just a default value (@since 1.9.4)

\$this-\>query_vars = self::merge_query_vars( \$this-\>query_vars,
\$builder_preview_query_vars );

}

/\*\*

\* Use main query if:

\* - User set is_archive_main_query to true

\* - Not in builder preview

\* - Not in single post / page / attachment (@since 1.9.2)

\* - Not infinite scroll or load more request (@since 1.9.2)

\* - Not render_query_result request (@since 1.9.3)

\*

\* Otherwise, init a new query.

\*

\* \@since 1.9.1

\*/

\$is_archive_main_query = isset(
\$this-\>settings\[\'query\'\]\[\'is_archive_main_query\'\] ) ? true :
false;

if ( \$is_archive_main_query && ! Helpers::is_bricks_preview() && !
is_singular() && ! Api::is_current_endpoint( \'load_query_page\' ) && !
Api::is_current_endpoint( \'query_result\' ) && !
Api::is_current_endpoint( \'load_popup_content\' ) ) {

global \$wp_query;

\$posts_query = \$wp_query;

} else {

\$posts_query = new \\WP_Query( \$this-\>query_vars );

}

// \@since 1.7.1 - Avoid duplicate posts when using \'rand\' orderby

if ( \$use_random_seed ) {

remove_filter( \'posts_orderby\', \[ \$this,
\'set_bricks_query_loop_random_order_seed\' \], 11 );

}

remove_action( \'pre_get_posts\', \[ \$this,
\'set_pagination_with_offset\' \], 5 );

remove_filter( \'found_posts\', \[ \$this,
\'fix_found_posts_with_offset\' \], 5, 2 );

\$this-\>set_query_cache( \$posts_query );

}

return \$posts_query;

}

/\*\*

\* Get the page number for a query based on the query var \"paged\"

\*

\* \@since 1.5

\*

\* \@return integer

\*/

public static function get_paged_query_var( \$query_vars ) {

\$paged = 1;

/\*\*

\* Return paged 1 if \'disable_query_merge\' is true

\*

\* Avoid query_var param merged accidentally if \'disable_query_merge\'
is true

\*

\* Return paged 1 if \'woo_disable_query_merge\' is true for Product
elements (@since 1.9.9)

\*

\* \@since 1.7.1

\*/

if ( isset( \$query_vars\[\'disable_query_merge\'\] ) \|\| isset(
\$query_vars\[\'woo_disable_query_merge\'\] ) ) {

return \$paged;

}

if ( get_query_var( \'page\' ) ) {

// Check for \'page\' on static front page

\$paged = get_query_var( \'page\' );

} elseif ( get_query_var( \'paged\' ) ) {

\$paged = get_query_var( \'paged\' );

} else {

\$paged = ! empty( \$query_vars\[\'paged\'\] ) ? abs(
\$query_vars\[\'paged\'\] ) : 1;

}

return intval( \$paged );

}

/\*\*

\* Parse the Meta Query vars through the DD logic

\*

\* \@Since 1.5

\*

\* \@param array \$query_vars

\* \@return array

\*/

public static function parse_meta_query_vars( \$query_vars ) {

if ( empty( \$query_vars\[\'meta_query\'\] ) ) {

return \$query_vars;

}

foreach ( \$query_vars\[\'meta_query\'\] as \$key =\> \$query_item ) {

if ( isset( \$query_vars\[\'meta_query\'\]\[ \$key \]\[\'id\'\] ) ) {

unset( \$query_vars\[\'meta_query\'\]\[ \$key \]\[\'id\'\] );

}

if ( empty( \$query_vars\[\'meta_query\'\]\[ \$key \]\[\'value\'\] ) ) {

continue;

}

\$query_vars\[\'meta_query\'\]\[ \$key \]\[\'value\'\] =
bricks_render_dynamic_data( \$query_vars\[\'meta_query\'\]\[ \$key
\]\[\'value\'\] );

}

if ( ! empty( \$query_vars\[\'meta_query_relation\'\] ) ) {

\$query_vars\[\'meta_query\'\]\[\'relation\'\] =
\$query_vars\[\'meta_query_relation\'\];

}

unset( \$query_vars\[\'meta_query_relation\'\] );

return \$query_vars;

}

/\*\*

\* Set \'tax_query\' vars (e.g. Carousel, Posts, Related Posts)

\*

\* Include & exclude terms of different taxonomies

\*

\* \@since 1.3.2

\*/

public static function set_tax_query_vars( \$query_vars ) {

// Include terms

if ( isset( \$query_vars\[\'tax_query\'\] ) ) {

\$terms = \$query_vars\[\'tax_query\'\];

\$tax_query = \[\];

foreach ( \$terms as \$term ) {

if ( ! is_string( \$term ) ) {

continue;

}

\$term_parts = explode( \'::\', \$term );

\$taxonomy = isset( \$term_parts\[0\] ) ? \$term_parts\[0\] : false;

\$term = isset( \$term_parts\[1\] ) ? \$term_parts\[1\] : false;

if ( ! \$taxonomy \|\| ! \$term ) {

continue;

}

if ( isset( \$tax_query\[ \$taxonomy \] ) ) {

\$tax_query\[ \$taxonomy \]\[\'terms\'\]\[\] = \$term;

} else {

\$tax_query\[ \$taxonomy \] = \[

\'taxonomy\' =\> \$taxonomy,

\'field\' =\> \'term_id\',

\'terms\' =\> \[ \$term \],

\];

}

}

\$tax_query = array_values( \$tax_query );

if ( count( \$tax_query ) \> 1 ) {

\$tax_query\[\'relation\'\] = \'OR\';

\$query_vars\[\'tax_query\'\] = \[ \$tax_query \];

} else {

\$query_vars\[\'tax_query\'\] = \$tax_query;

}

}

// Exclude terms

if ( isset( \$query_vars\[\'tax_query_not\'\] ) ) {

\$terms = \$query_vars\[\'tax_query_not\'\];

\$tax_query_exclude = \[\];

foreach ( \$query_vars\[\'tax_query_not\'\] as \$term ) {

if ( ! is_string( \$term ) ) {

continue;

}

\$term_parts = explode( \'::\', \$term );

\$taxonomy = \$term_parts\[0\];

\$term = \$term_parts\[1\];

if ( isset( \$tax_query_exclude\[ \$taxonomy \] ) ) {

\$tax_query_exclude\[ \$taxonomy \]\[\'terms\'\]\[\] = \$term;

} else {

\$tax_query_exclude\[ \$taxonomy \] = \[

\'taxonomy\' =\> \$taxonomy,

\'field\' =\> \'term_id\',

\'terms\' =\> \[ \$term \],

\'operator\' =\> \'NOT IN\',

\];

}

}

\$tax_query_exclude = array_values( \$tax_query_exclude );

if ( count( \$tax_query_exclude ) \> 1 ) {

\$tax_query_exclude\[\'relation\'\] = \'AND\';

\$query_vars\[\'tax_query\'\]\[\] = \[ \$tax_query_exclude \];

} else {

\$query_vars\[\'tax_query\'\]\[\] = \$tax_query_exclude;

}

unset( \$query_vars\[\'tax_query_not\'\] );

}

if ( isset( \$query_vars\[\'tax_query_advanced\'\] ) ) {

foreach ( \$query_vars\[\'tax_query_advanced\'\] as \$tax_query ) {

if ( empty( \$tax_query\[\'terms\'\] ) ) {

continue;

}

\$tax_query\[\'terms\'\] = bricks_render_dynamic_data(
\$tax_query\[\'terms\'\] );

if ( strpos( \$tax_query\[\'terms\'\], \',\' ) ) {

\$tax_query\[\'terms\'\] = explode( \',\', \$tax_query\[\'terms\'\] );

\$tax_query\[\'terms\'\] = array_map( \'trim\', \$tax_query\[\'terms\'\]
);

}

unset( \$tax_query\[\'id\'\] );

if ( isset( \$tax_query\[\'include_children\'\] ) ) {

\$tax_query\[\'include_children\'\] = filter_var(
\$tax_query\[\'include_children\'\], FILTER_VALIDATE_BOOLEAN );

}

\$query_vars\[\'tax_query\'\]\[\] = \$tax_query;

}

}

if ( isset( \$query_vars\[\'tax_query\'\] ) && is_array(
\$query_vars\[\'tax_query\'\] ) && count( \$query_vars\[\'tax_query\'\]
) \> 1 ) {

\$query_vars\[\'tax_query\'\]\[\'relation\'\] = isset(
\$query_vars\[\'tax_query_relation\'\] ) ?
\$query_vars\[\'tax_query_relation\'\] : \'AND\';

}

unset( \$query_vars\[\'tax_query_relation\'\] );

unset( \$query_vars\[\'tax_query_advanced\'\] );

return \$query_vars;

}

/\*\*

\* Modifies \$query offset variable to make pagination work in
combination with offset.

\*

\* \@see
https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination

\* Note that the link recommends exiting the filter if
\$query-\>is_paged returns false,

\* but then max_num_pages on the first page is incorrect.

\*

\* \@param \\WP_Query \$query WordPress query.

\*/

public function set_pagination_with_offset( \$query ) {

if ( ! isset( \$this-\>query_vars\[\'offset\'\] ) ) {

return;

}

\$new_offset = \$this-\>query_vars\[\'offset\'\] + ( \$query-\>get(
\'paged\', 1 ) - 1 ) \* \$query-\>get( \'posts_per_page\' );

\$query-\>set( \'offset\', \$new_offset );

}

/\*\*

\* Handle term pagination

\*

\* \@since 1.9.8

\*/

public static function get_term_pagination_query_var( \$query_vars ) {

// Pagination: Fix the offset value

\$offset = ! empty( \$query_vars\[\'offset\'\] ) ?
\$query_vars\[\'offset\'\] : 0;

// Store the original offset value

\$query_vars\[\'original_offset\'\] = \$offset;

// If pagination exists, and number is limited (!= 0), use \$offset as
the pagination trigger

if ( isset( \$query_vars\[\'paged\'\] ) && \$query_vars\[\'paged\'\] !==
1 && ! empty( \$query_vars\[\'number\'\] ) ) {

\$query_vars\[\'offset\'\] = ( \$query_vars\[\'paged\'\] - 1 ) \*
\$query_vars\[\'number\'\] + \$offset;

}

return \$query_vars;

}

/\*\*

\* By default, WordPress includes offset posts into the final post
count.

\* This method excludes them.

\*

\* \@see
https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination

\* Note that the link recommends exiting the filter if
\$query-\>is_paged returns false,

\* but then max_num_pages on the first page is incorrect.

\*

\* \@param int \$found_posts Found posts.

\* \@param \\WP_Query \$query WordPress query.

\* \@return int Modified found posts.

\*/

public function fix_found_posts_with_offset( \$found_posts, \$query ) {

if ( ! isset( \$this-\>query_vars\[\'offset\'\] ) ) {

return \$found_posts;

}

return \$found_posts - \$this-\>query_vars\[\'offset\'\];

}

/\*\*

\* Set the initial loop index (needed for the infinite scroll)

\*

\* \@since 1.5

\*/

public function init_loop_index() {

\$paged = isset( \$this-\>query_vars\[\'paged\'\] ) ?
\$this-\>query_vars\[\'paged\'\] : 1;

\$offset = isset( \$this-\>query_vars\[\'offset\'\] ) ?
\$this-\>query_vars\[\'offset\'\] : 0;

// Type: post

if ( \$this-\>object_type == \'post\' ) {

// \'posts_per_page\' not set by default when using \'queryEditor\'
(@since 1.9.1)

\$posts_per_page = isset( \$this-\>query_vars\[\'posts_per_page\'\] ) ?
intval( \$this-\>query_vars\[\'posts_per_page\'\] ) : get_option(
\'posts_per_page\' );

return \$offset + ( \$posts_per_page \> 0 ? ( \$paged - 1 ) \*
\$posts_per_page : 0 );

}

// Type: term

if ( \$this-\>object_type == \'term\' ) {

return isset( \$this-\>query_vars\[\'offset\'\] ) ?
\$this-\>query_vars\[\'offset\'\] : 0;

}

// Type: user

if ( \$this-\>object_type == \'user\' ) {

return \$offset + ( \$this-\>query_vars\[\'number\'\] \> 0 ? ( \$paged -
1 ) \* \$this-\>query_vars\[\'number\'\] : 0 );

}

return 0;

}

/\*\*

\* Main render function

\*

\* \@param string \$callback to render each item.

\* \@param array \$args callback function args.

\* \@param boolean \$return_array whether returns a string or an array
of all the iterations.

\*/

public function render( \$callback, \$args, \$return_array = false ) {

// Remove array keys

\$args = array_values( \$args );

// Query results

\$query_result = \$this-\>query_result;

\$content = \[\];

\$this-\>loop_index = \$this-\>init_loop_index();

\$this-\>is_looping = true;

// \@see
https://academy.bricksbuilder.io/article/action-bricks-query-before_loop
(@since 1.7.2)

do_action( \'bricks/query/before_loop\', \$this, \$args );

// Query is empty

if ( empty( \$this-\>count ) ) {

\$this-\>is_looping = false;

\$content\[\] = \$this-\>get_no_results_content();

}

// Iterate

else {

// STEP: Loop posts

if ( \$this-\>object_type == \'post\' ) {

\$this-\>original_post_id = get_the_ID();

while ( \$query_result-\>have_posts() ) {

\$query_result-\>the_post();

\$this-\>loop_object = get_post();

\$part = call_user_func_array( \$callback, \$args );

\$content\[\] = self::parse_dynamic_data( \$part, get_the_ID() );

\$this-\>loop_index++;

}

}

// STEP: Loop terms

elseif ( \$this-\>object_type == \'term\' ) {

foreach ( \$query_result as \$term_object ) {

\$this-\>loop_object = \$term_object;

\$part = call_user_func_array( \$callback, \$args );

\$content\[\] = self::parse_dynamic_data( \$part, get_the_ID() );

\$this-\>loop_index++;

}

}

// STEP: Loop users

elseif ( \$this-\>object_type == \'user\' ) {

foreach ( \$query_result as \$user_object ) {

\$this-\>loop_object = \$user_object;

\$part = call_user_func_array( \$callback, \$args );

\$content\[\] = self::parse_dynamic_data( \$part, get_the_ID() );

\$this-\>loop_index++;

}

}

// STEP: Other render providers (wooCart, ACF repeater, Meta Box groups)

else {

\$this-\>original_post_id = get_the_ID();

foreach ( \$query_result as \$loop_key =\> \$loop_object ) {

// \@see:
https://academy.bricksbuilder.io/article/filter-bricks-query-loop_object/

\$this-\>loop_object = apply_filters( \'bricks/query/loop_object\',
\$loop_object, \$loop_key, \$this );

\$part = call_user_func_array( \$callback, \$args );

\$content\[\] = self::parse_dynamic_data( \$part, get_the_ID() );

\$this-\>loop_index++;

}

}

// STEP: Remove the HTML content if live_search is enabled as it\'s not
needed on initial page load (@since 1.9.6)

\$is_live_search = \$this-\>settings\[\'query\'\]\[\'is_live_search\'\]
?? false;

if ( \$is_live_search && ! Api::is_current_endpoint( \'query_result\' )
&& Helpers::enabled_query_filters() ) {

\$content = \[\];

}

}

// \@see
https://academy.bricksbuilder.io/article/action-bricks-query-after_loop
(@since 1.7.2)

do_action( \'bricks/query/after_loop\', \$this, \$args );

\$this-\>loop_object = null;

\$this-\>is_looping = false;

\$this-\>reset_postdata();

return \$return_array ? \$content : implode( \'\', \$content );

}

public static function parse_dynamic_data( \$content, \$post_id ) {

if ( is_array( \$content ) ) {

if ( isset(
\$content\[\'background\'\]\[\'image\'\]\[\'useDynamicData\'\] ) ) {

\$size = isset( \$content\[\'background\'\]\[\'image\'\]\[\'size\'\] ) ?
\$content\[\'background\'\]\[\'image\'\]\[\'size\'\] :
BRICKS_DEFAULT_IMAGE_SIZE;

\$images = Integrations\\Dynamic_Data\\Providers::render_tag(
\$content\[\'background\'\]\[\'image\'\]\[\'useDynamicData\'\],
\$post_id, \'image\', \[ \'size\' =\> \$size \] );

if ( isset( \$images\[0\] ) ) {

\$content\[\'background\'\]\[\'image\'\]\[\'url\'\] = is_numeric(
\$images\[0\] ) ? wp_get_attachment_image_url( \$images\[0\], \$size ) :
\$images\[0\];

unset( \$content\[\'background\'\]\[\'image\'\]\[\'useDynamicData\'\] );

}

}

return map_deep( \$content, \[
\'Bricks\\Integrations\\Dynamic_Data\\Providers\', \'render_content\' \]
);

} else {

return bricks_render_dynamic_data( \$content, \$post_id );

}

}

/\*\*

\* Reset the global \$post to the parent query or the global \$wp_query

\*

\* \@since 1.5

\*

\* \@return void

\*/

public function reset_postdata() {

// Reset is not needed

if ( empty( \$this-\>original_post_id ) ) {

return;

}

\$looping_query_id = self::is_any_looping();

// Not a nested query, reset global query

if ( ! \$looping_query_id ) {

wp_reset_postdata();

}

// Set the parent query context

global \$post;

\$post = get_post( \$this-\>original_post_id );

setup_postdata( \$post );

}

/\*\*

\* Get the current Query object

\*

\* \@return Query

\*/

public static function get_query_object( \$query_id = false ) {

global \$bricks_loop_query;

if ( ! is_array( \$bricks_loop_query ) \|\| \$query_id && !
array_key_exists( \$query_id, \$bricks_loop_query ) ) {

return false;

}

return \$query_id ? \$bricks_loop_query\[ \$query_id \] : end(
\$bricks_loop_query );

}

/\*\*

\* Get the current Query object type

\*

\* \@return string

\*/

public static function get_query_object_type( \$query_id = \'\' ) {

\$query = self::get_query_object( \$query_id );

return \$query ? \$query-\>object_type : \'\';

}

/\*\*

\* Get the object of the current loop iteration

\*

\* \@return mixed

\*/

public static function get_loop_object( \$query_id = \'\' ) {

\$query = self::get_query_object( \$query_id );

return \$query ? \$query-\>loop_object : null;

}

/\*\*

\* Get the object ID of the current loop iteration

\*

\* \@return mixed

\*/

public static function get_loop_object_id( \$query_id = \'\' ) {

\$object = self::get_loop_object( \$query_id );

\$object_id = 0;

if ( is_a( \$object, \'WP_Post\' ) ) {

\$object_id = \$object-\>ID;

}

if ( is_a( \$object, \'WP_Term\' ) ) {

\$object_id = \$object-\>term_id;

}

if ( is_a( \$object, \'WP_User\' ) ) {

\$object_id = \$object-\>ID;

}

/\*\*

\* Non-WP query loops (ACF, Meta Box, Woo Cart, etc.)

\*

\* \@since 1.9.1.1

\*/

if ( ! \$object_id ) {

\$any = self::is_any_looping( \$query_id );

\$query_object = self::get_query_object( \$any );

if ( is_a( \$query_object, \'Bricks\\Query\' ) ) {

\$object_id = \$query_object-\>loop_index;

}

}

// \@see:
https://academy.bricksbuilder.io/article/filter-bricks-query-loop_object_id/

return apply_filters( \'bricks/query/loop_object_id\', \$object_id,
\$object, \$query_id );

}

/\*\*

\* Get the object type of the current loop iteration

\*

\* \@return mixed

\*/

public static function get_loop_object_type( \$query_id = \'\' ) {

\$object = self::get_loop_object( \$query_id );

\$object_type = null;

if ( is_a( \$object, \'WP_Post\' ) ) {

\$object_type = \'post\';

}

if ( is_a( \$object, \'WP_Term\' ) ) {

\$object_type = \'term\';

}

if ( is_a( \$object, \'WP_User\' ) ) {

\$object_type = \'user\';

}

// \@see:
https://academy.bricksbuilder.io/article/filter-bricks-query-loop_object_type/

return apply_filters( \'bricks/query/loop_object_type\', \$object_type,
\$object, \$query_id );

}

/\*\*

\* Get the current loop iteration index

\*

\* \@since 1.10: Add \$query_id to get the loop index of a specific
query

\*

\* \@return mixed

\*/

public static function get_loop_index( \$query_id = \'\' ) {

// For AJAX popup to simulate is_looping if context being set (@since
1.9.4)

\$force_loop_index = apply_filters( \'bricks/query/force_loop_index\',
\'\' );

if ( \$force_loop_index !== \'\' ) {

return \$force_loop_index;

}

\$query = self::get_query_object( \$query_id );

return \$query && \$query-\>is_looping ? \$query-\>loop_index : \'\';

}

/\*\*

\* Get a unique identifier for the current looping query

\*

\* \@param string \$type \'query\', \'interaction\', \'popup\'

\* \@return string

\* \@since 1.10

\*/

public static function get_looping_unique_identifier( \$type = \'query\'
) {

\$looping_query_id = self::is_any_looping();

if ( ! \$looping_query_id ) {

return \'\';

}

/\*\*

\* Looping dynamic data CSS

\*

\* Example: background-image, color, etc.

\*

\* \@since 1.10

\*/

if ( \$type === \'query\' ) {

// Top level loop

if ( self::get_looping_level() \< 1 ) {

// Format: loop_index

// NOTE: Query element ID not needed, plus we remain backward compatible

\$unique_loop_id = \[

// self::get_query_element_id( \$looping_query_id ),

self::get_loop_index( \$looping_query_id ),

\];

}

// Nested loop

else {

// Format:
parent_element_id:parent_loop_index:query_element_id:loop_index

\$parent_loop_id = self::get_parent_loop_id();

\$unique_loop_id = \[

self::get_query_element_id( \$parent_loop_id ),

self::get_loop_index( \$parent_loop_id ),

self::get_query_element_id( \$looping_query_id ),

self::get_loop_index( \$looping_query_id ),

\];

}

}

/\*\*

\* For AJAX popup data attribute: data-popup-loop-id

\* For interactions data attribute: data-interaction-loop-id

\*

\* Avoid incorrect popup trigger in nested loops

\*

\* \@since 1.9.4

\*/

else {

// Format: query_element_id:loop_index:object_type:object_id

\$unique_loop_id = \[

self::get_query_element_id( \$looping_query_id ),

self::get_loop_index( \$looping_query_id ),

self::get_loop_object_type( \$looping_query_id ),

self::get_loop_object_id( \$looping_query_id ),

\];

}

return implode( \':\', \$unique_loop_id );

}

/\*\*

\* Check if the render function is looping (in the current query)

\*

\* \@param string \$element_id Checks if the element_id matches the
element that is set to loop (e.g. container).

\*

\* \@return boolean

\*/

public static function is_looping( \$element_id = \'\', \$query_id =
\'\' ) {

// For AJAX popup to simulate is_looping if context being set (@since
1.9.4)

\$force_is_looping = apply_filters( \'bricks/query/force_is_looping\',
false, \$query_id, \$element_id );

if ( \$force_is_looping ) {

return true;

}

\$query = self::get_query_object( \$query_id );

if ( ! \$query ) {

return false;

}

if ( empty( \$element_id ) ) {

return \$query-\>is_looping;

}

// Still here, search for the element_id query

\$query = self::get_query_for_element_id( \$element_id );

return \$query ? \$query-\>is_looping : false;

}

/\*\*

\* Get query object created for a specific element ID

\*

\* \@param string \$element_id

\* \@return mixed

\*/

public static function get_query_for_element_id( \$element_id = \'\' ) {

if ( empty( \$element_id ) ) {

return false;

}

global \$bricks_loop_query;

if ( empty( \$bricks_loop_query ) ) {

return false;

}

foreach ( \$bricks_loop_query as \$key =\> \$query ) {

if ( \$query-\>element_id == \$element_id ) {

return \$query;

}

}

return false;

}

/\*\*

\* Get element ID of query loop element

\*

\* \@param object \$query Defaults to current query.

\*

\* \@since 1.4

\*

\* \@return string\|boolean Element ID or false

\*/

public static function get_query_element_id( \$query = \'\' ) {

\$query = self::get_query_object( \$query );

return ! empty( \$query-\>element_id ) ? \$query-\>element_id : false;

}

/\*\*

\* Get the current looping level

\*

\* \@return int

\* \@since 1.10

\*/

public static function get_looping_level() {

global \$bricks_loop_query;

\$query_ids = array_reverse( array_keys( \$bricks_loop_query ) );

\$looping_queries = array_filter(

\$query_ids,

function( \$query_id ) use ( \$bricks_loop_query ) {

return \$bricks_loop_query\[ \$query_id \]-\>is_looping;

}

);

\$level = count( \$looping_queries ) \> 0 ? count( \$looping_queries ) -
1 : 0;

return \$level;

}

/\*\*

\* Get the direct parent loop ID

\*

\* \@since 1.10

\*/

public static function get_parent_loop_id() {

\$current_looping_id = self::is_any_looping();

if ( ! \$current_looping_id ) {

return false;

}

global \$bricks_loop_query;

\$query_ids = array_reverse( array_keys( \$bricks_loop_query ) );

\$looping_queries = array_filter(

\$query_ids,

function( \$query_id ) use ( \$bricks_loop_query ) {

return \$bricks_loop_query\[ \$query_id \]-\>is_looping;

}

);

\$looping_queries = array_values( \$looping_queries );

if ( count( \$looping_queries ) \< 2 ) {

return false;

}

\$parent_loop_id = false;

foreach ( \$looping_queries as \$key =\> \$query_id ) {

if ( \$query_id == \$current_looping_id ) {

\$parent_loop_id = \$looping_queries\[ \$key + 1 \];

break;

}

}

return \$parent_loop_id;

}

/\*\*

\* Check if there is any active query looping (nested queries) and if
yes, return the query ID of the most deep query

\*

\* \@return mixed

\*/

public static function is_any_looping() {

global \$bricks_loop_query;

if ( empty( \$bricks_loop_query ) ) {

return false;

}

\$query_ids = array_reverse( array_keys( \$bricks_loop_query ) );

foreach ( \$query_ids as \$query_id ) {

if ( \$bricks_loop_query\[ \$query_id \]-\>is_looping ) {

return \$query_id;

}

}

return false;

}

/\*\*

\* Convert a list of option strings taxonomy::term_id into a list of
term_ids

\*/

public static function convert_terms_to_ids( \$terms = \[\] ) {

if ( empty( \$terms ) ) {

return \[\];

}

\$options = \[\];

foreach ( \$terms as \$term ) {

if ( ! is_string( \$term ) ) {

continue;

}

\$term_parts = explode( \'::\', \$term );

// \$taxonomy = \$term_parts\[0\];

\$options\[\] = \$term_parts\[1\];

}

return \$options;

}

public function get_no_results_content() {

// Return: Avoid showing no results message when infinite scroll is
enabled (@since 1.5.6)

if ( Api::is_current_endpoint( \'load_query_page\' ) ) {

return \'\';

}

// Return: Avoid showing no results message when live search is enabled
and not on query_results API endpoint (@since 1.9.6)

if ( isset( \$this-\>settings\[\'query\'\]\[\'is_live_search\'\] ) && !
Api::is_current_endpoint( \'query_result\' ) ) {

return \'\';

}

\$template_id =
\$this-\>settings\[\'query\'\]\[\'no_results_template\'\] ?? false;

\$text = \$this-\>settings\[\'query\'\]\[\'no_results_text\'\] ?? \'\';

\$content = \'\';

if ( \$template_id \|\| \$text ) {

// Use template if set

if ( \$template_id ) {

\$content = do_shortcode( \'\[bricks_template id=\"\' . \$template_id .
\'\"\]\' );

} else {

\$content = bricks_render_dynamic_data( \$text );

\$content = do_shortcode( \$content );

}

/\*\*

\* Use custom HTML tag if set

\*

\* Must wrap content inside .bricks-posts-nothing-found to target via
JavaScript.

\*

\* \@since 1.9.8

\*/

\$html_tag = Helpers::get_html_tag_from_element_settings(
\$this-\>settings, \'div\' );

\$wrapper = \"\<\$html_tag\" . \' class=\"bricks-posts-nothing-found\"
style=\"width: inherit; max-width: 100%; grid-column: 1/-1\"\>\';

// Special case for table row

if ( \$html_tag === \'tr\' ) {

\$wrapper .= \'\<td colspan=\"100%\"\>\';

}

\$content = \$wrapper . \$content;

// Special case for table row

if ( \$html_tag === \'tr\' ) {

\$content .= \'\</td\>\';

}

\$content .= \"\</\$html_tag\>\";

// Inline styles needed if query result via AJAX is empty and using a
template

if ( Api::is_current_endpoint( \'query_result\' ) && \$template_id ) {

\$content .= \'\<style\>\';

\$content .= Assets::\$inline_css\[\'global_classes\'\];

\$content .= Assets::\$inline_css\[ \"template\_\$template_id\" \];

\$content .= \'\</style\>\';

}

}

// \@see:
https://academy.bricksbuilder.io/article/filter-bricks-query_no_results_content/

\$content = apply_filters( \'bricks/query/no_results_content\',
\$content, \$this-\>settings, \$this-\>element_id );

return \$content;

}

/\*\*

\* Check if the query is using random seed

\* Use random seed when: \'orderby\' is \'rand\' && \'randomSeedTtl\' \>
0

\* Default: 60 minutes

\*

\* \@param array \$query_vars

\* \@return boolean

\* \@since 1.9.8

\*/

public static function use_random_seed( \$query_vars = \[\] ) {

return isset( \$query_vars\[\'orderby\'\] ) &&
\$query_vars\[\'orderby\'\] === \'rand\' && ! ( isset(
\$query_vars\[\'randomSeedTtl\'\] ) && absint(
\$query_vars\[\'randomSeedTtl\'\] ) === 0 );

}

/\*\*

\* Get the random seed statement for the query

\*

\* \@param string \$element_id

\* \@param array \$query_vars

\* \@return string

\* \@since 1.9.8

\*/

public static function get_random_seed_statement( \$element_id = \'\',
\$query_vars = \[\] ) {

if ( empty( \$element_id ) \|\| ! isset( \$query_vars\[\'orderby\'\] )
\|\| \$query_vars\[\'orderby\'\] !== \'rand\' ) {

return \'\';

}

// Transient name is based on the element ID

\$transient_name = \"bricks_query_loop_random_seed\_{\$element_id}\";

\$random_seed = get_transient( \$transient_name );

if ( ! \$random_seed ) {

// Generate a random seed for this query

\$random_seed = rand( 0, 99999 );

// Default transient TTL is 60 minutes

\$random_seed_ttl = ! empty( \$query_vars\[\'randomSeedTtl\'\] ) ?
absint( \$query_vars\[\'randomSeedTtl\'\] ) : 60;

set_transient( \$transient_name, \$random_seed, \$random_seed_ttl \*
MINUTE_IN_SECONDS );

}

return \'RAND(\' . \$random_seed . \')\';

}

/\*\*

\* Use random seed to make sure the order is the same for all queries of
the same element

\*

\* The transient is also deleted when the random seed setting inside the
query loop control is changed.

\*

\* \@param string \$order_statement

\* \@return string

\* \@since 1.7.1

\*/

public function set_bricks_query_loop_random_order_seed(
\$order_statement ) {

\$random_seed_statement = self::get_random_seed_statement(
\$this-\>element_id, \$this-\>query_vars );

if ( ! empty( \$random_seed_statement ) ) {

return \$random_seed_statement;

}

return \$order_statement;

}

/\*\*

\* All query arguments that can be set for the archive query

\*
https://developer.wordpress.org/reference/classes/wp_query/#parameters

\*

\* \@return array

\*

\* \@since 1.8

\*/

public static function archive_query_arguments() {

\$arguments = \[

\'post_type\',

\'post_status\',

\'p\',

\'page_id\',

\'name\',

\'pagename\',

\'page\',

\'hour\',

\'minute\',

\'second\',

\'year\',

\'monthnum\',

\'day\',

\'w\',

\'m\',

\'cat\',

\'category_name\',

\'category\_\_and\',

\'category\_\_in\',

\'category\_\_not_in\',

\'tag\',

\'tag_id\',

\'tag\_\_and\',

\'tag\_\_in\',

\'tag\_\_not_in\',

\'tag_slug\_\_and\',

\'tag_slug\_\_in\',

\'taxonomy\',

\'term\',

\'field\',

\'operator\',

\'include_children\',

\'paged\',

\'posts_per_page\',

\'nopaging\',

\'offset\',

\'ignore_sticky_posts\',

\'post_parent\',

\'post_parent\_\_in\',

\'post_parent\_\_not_in\',

\'post\_\_in\',

\'post\_\_not_in\',

\'post_name\_\_in\',

\'author\',

\'author_name\',

\'author\_\_in\',

\'author\_\_not_in\',

\'s\',

\'exact\',

\'sentence\',

\'meta_key\',

\'meta_value\',

\'meta_value_num\',

\'meta_compare\',

\'meta_query\',

\'date_query\',

\'cache_results\',

\'update_post_term_cache\',

\'update_post_meta_cache\',

\'no_found_rows\',

\'order\',

\'orderby\',

\'perm\',

\'post_mime_type\',

\'comment_count\',

\'comment_status\',

\'post_comment_status\',

\'tax_query\', // \@since 1.9.8 (#86by08fg0)

\];

// NOTE: Undocumented

return apply_filters( \'bricks/query/archive_query_arguments\',
\$arguments );

}

/\*\*

\* All bricks query object types that can be set for the archive query.

\* If there is custom query by user and it might be used as archive
query, should be added here.

\*

\* \@return array

\*

\* \@since 1.8

\*/

public static function archive_query_supported_object_types() {

// \@since 1.9.1 - Only post query should be supported (WP_Query)

\$object_types = \[

\'post\',

// \'term\',

// \'user\',

\];

// NOTE: Undocumented

return apply_filters(
\'bricks/query/archive_query_supported_object_types\', \$object_types );

}

/\*\*

\* Merge two query vars arrays, instead of using wp_parse_args

\*

\* wp_parse_args will only set those values that are not already set in
the original array.

\*

\* \@see
https://developer.wordpress.org/reference/functions/wp_parse_args/

\*

\* \@since 1.9.4

\*/

public static function merge_query_vars( \$original_query_vars,
\$merging_query_vars ) {

foreach ( \$merging_query_vars as \$key =\> \$value ) {

// If the key already exists in the \$original_query_vars, and the value
is an array, merge the two arrays

if ( isset( \$original_query_vars\[ \$key \] ) && is_array(
\$original_query_vars\[ \$key \] ) && is_array( \$value ) ) {

/\*\*

\* Handle special case for \'tax_query\'

\* merging via key might be wrong, as the key is just index of the array

\*/

if ( \$key === \'tax_query\' ) {

\$original_query_vars\[ \$key \] = self::merge_tax_or_meta_query_vars(
\$original_query_vars\[ \$key \], \$value, \'tax\' );

}

/\*\*

\* Handle special case for \'meta_query\'

\*

\* This logic is still needed for \'meta_query\' to work correctly.

\* Otherwise will merge wrongly into wrong array when performing query
filter.

\*

\* \@since 1.9.8

\*/

elseif ( \$key === \'meta_query\' && Api::is_current_endpoint(
\'query_result\' ) ) {

\$original_query_vars\[ \$key \] = self::merge_tax_or_meta_query_vars(
\$original_query_vars\[ \$key \], \$value, \'meta\' );

}

else {

\$original_query_vars\[ \$key \] = self::merge_query_vars(
\$original_query_vars\[ \$key \], \$value ); // Recursively merge arrays
(@since 1.9.6)

}

} else {

\$original_query_vars\[ \$key \] = \$value;

}

}

return \$original_query_vars;

}

/\*\*

\* Special case for merging \'tax_query\' and \'meta_query\' vars

\*

\* Only merge if the \'taxonomy\' or \'key\' are identical.

\*

\* \@since 1.9.6

\*/

public static function merge_tax_or_meta_query_vars(
\$original_tax_query, \$merging_tax_query, \$type = \'tax\' ) {

\$original_tax_query = array_values( \$original_tax_query );

\$merging_tax_query = array_values( \$merging_tax_query );

\$target_key = \$type === \'tax\' ? \'taxonomy\' : \'key\';

// Merge tax_query or meta_query vars

foreach ( \$merging_tax_query as \$merging_tax_query_item ) {

\$found = false;

foreach ( \$original_tax_query as &\$original_tax_query_item ) { // Use
reference to modify original array

if ( \$type === \'meta\' ) {

/\*\*

\* Meta merge logic

\*

\* Only merge if the \'key\' is identical && \'compare\' is identical.

\*

\* \@since 1.9.8

\*/

if ( isset( \$original_tax_query_item\[ \$target_key \] ) &&

isset( \$merging_tax_query_item\[ \$target_key \] ) &&

\$original_tax_query_item\[ \$target_key \] ===
\$merging_tax_query_item\[ \$target_key \] &&

isset( \$original_tax_query_item\[\'compare\'\] ) &&

isset( \$merging_tax_query_item\[\'compare\'\] ) &&

\$original_tax_query_item\[\'compare\'\] ===
\$merging_tax_query_item\[\'compare\'\]

) {

\$found = true;

// Merge the rest of the properties

\$original_tax_query_item = self::merge_query_vars(
\$original_tax_query_item, \$merging_tax_query_item );

}

}

elseif ( \$type === \'tax\' ) {

// Taxonomy merge logic

if ( isset( \$original_tax_query_item\[ \$target_key \] ) &&

isset( \$merging_tax_query_item\[ \$target_key \] ) &&

\$original_tax_query_item\[ \$target_key \] ===
\$merging_tax_query_item\[ \$target_key \]

) {

\$found = true;

// Convert terms to array if it\'s not already

if ( isset( \$original_tax_query_item\[\'terms\'\] ) && ! is_array(
\$original_tax_query_item\[\'terms\'\] ) ) {

\$original_tax_query_item\[\'terms\'\] = \[
\$original_tax_query_item\[\'terms\'\] \];

}

if ( isset( \$merging_tax_query_item\[\'terms\'\] ) && ! is_array(
\$merging_tax_query_item\[\'terms\'\] ) ) {

\$merging_tax_query_item\[\'terms\'\] = \[
\$merging_tax_query_item\[\'terms\'\] \];

}

// Merge terms if they exist in both original and merging items

if ( isset( \$original_tax_query_item\[\'terms\'\] ) && isset(
\$merging_tax_query_item\[\'terms\'\] ) ) {

\$original_tax_query_item\[\'terms\'\] = array_merge(
\$original_tax_query_item\[\'terms\'\],
\$merging_tax_query_item\[\'terms\'\] );

} else {

// If one of the items doesn\'t have terms, just copy the terms from the
merging item

\$original_tax_query_item\[\'terms\'\] = isset(
\$merging_tax_query_item\[\'terms\'\] ) ?
\$merging_tax_query_item\[\'terms\'\] :
\$original_tax_query_item\[\'terms\'\];

}

// Remove the operator if it\'s already set in the original item

unset( \$merging_tax_query_item\[\'operator\'\] );

// Merge the rest of the properties

\$original_tax_query_item = self::merge_query_vars(
\$original_tax_query_item, \$merging_tax_query_item );

}

}

}

if ( ! \$found ) {

\$original_tax_query\[\] = \$merging_tax_query_item;

}

}

return \$original_tax_query;

}

}

header.php

\<!DOCTYPE html\>

\<html \<?php language_attributes(); ?\>\>

\<head\>

\<meta charset=\"\<?php bloginfo( \'charset\' ); ?\>\"\>

\<meta name=\"viewport\" content=\"width=device-width,
initial-scale=1\"\>

\<?php do_action( \'bricks_meta_tags\' ); ?\>

\<?php wp_head(); ?\>

\</head\>

\<?php

do_action( \'bricks_body\' );

do_action( \'bricks_before_site_wrapper\' );

do_action( \'bricks_before_header\' );

do_action( \'render_header\' );

do_action( \'bricks_after_header\' );

footer.php\
\
\<?php

namespace Bricks;

do_action( \'bricks_before_footer\' );

do_action( \'render_footer\' );

do_action( \'bricks_after_footer\' );

do_action( \'bricks_after_site_wrapper\' );

wp_footer();

echo \'\</body\>\';

echo \'\</html\>\';

page.php\
\
\<?php

get_header();

\$bricks_data = Bricks\\Helpers::get_bricks_data( get_the_ID(),
\'content\' );

if ( \$bricks_data ) {

Bricks\\Frontend::render_content( \$bricks_data );

} else {

if ( have_posts() ) :

while ( have_posts() ) :

the_post();

get_template_part( \'template-parts/page\' );

endwhile;

endif;

}

get_footer();

frontend.php\
\
\<?php

namespace Bricks;

if ( ! defined( \'ABSPATH\' ) ) exit; // Exit if accessed directly

class Frontend {

public static \$area = \'content\';

/\*\*

\* Elements requested for rendering

\*

\* key: ID

\* value: element data

\*/

public static \$elements = \[\];

/\*\*

\* Live search results selectors

\*

\* key: live search ID

\* value: live search results CSS selector

\*

\* \@since 1.9.6

\*/

public static \$live_search_wrapper_selectors = \[\];

public function \_\_construct() {

add_action( \'wp_head\', \[ \$this, \'add_seo_meta_tags\' \], 1 );

add_filter( \'document_title_parts\', \[ \$this,
\'set_seo_document_title\' \] );

add_filter( \'wp_get_attachment_image_attributes\', \[ \$this,
\'set_image_attributes\' \], 10, 3 );

add_action( \'wp_enqueue_scripts\', \[ \$this, \'enqueue_scripts\' \] );

add_action( \'wp_enqueue_scripts\', \[ \$this, \'enqueue_inline_css\'
\], 11 );

add_action( \'wp_footer\', \[ \$this, \'enqueue_footer_inline_css\' \]
);

add_action( \'bricks_after_site_wrapper\', \[ \$this,
\'one_page_navigation_wrapper\' \] );

// Load custom header body script (for analytics) only on the frontend

add_action( \'wp_head\', \[ \$this, \'add_header_scripts\' \] );

add_action( \'wp_head\', \[ \$this, \'add_open_graph_meta_tags\' \],
99999 );

add_action( \'bricks_body\', \[ \$this, \'add_body_header_scripts\' \]
);

// Change the priority to 21 to load the custom scripts after the
default Bricks scripts in the footer (@since 1.5)

// \@see core: add_action( \'wp_footer\', \'wp_print_footer_scripts\',
20 );

add_action( \'wp_footer\', \[ \$this, \'add_body_footer_scripts\' \], 21
);

add_action( \'template_redirect\', \[ \$this, \'template_redirect\' \]
);

add_action( \'bricks_body\', \[ \$this, \'add_skip_link\' \] );

add_action( \'bricks_body\', \[ \$this, \'remove_wp_hooks\' \] );

add_action( \'render_header\', \[ \$this, \'render_header\' \] );

add_action( \'render_footer\', \[ \$this, \'render_footer\' \] );

}

/\*\*

\* Add header scripts

\*

\* Do not add template JS (we only want to provide content)

\*

\* \@since 1.0

\*/

public function add_header_scripts() {

\$header_scripts = \'\';

// Global settings scripts

if ( ! empty( Database::\$global_settings\[\'customScriptsHeader\'\] ) )
{

\$header_scripts .= stripslashes_deep(
Database::\$global_settings\[\'customScriptsHeader\'\] ) . PHP_EOL;

}

// Page settings header scripts (@since 1.4)

\$header_scripts .= Assets::get_page_settings_scripts(
\'customScriptsHeader\' );

echo \$header_scripts;

}

/\*\*

\* Page settings: Add meta description, keywords and robots

\*/

public function add_seo_meta_tags() {

// NOTE: Undocumented

\$disable_seo = apply_filters( \'bricks/frontend/disable_seo\', ! empty(
Database::\$global_settings\[\'disableSeo\'\] ) );

if ( \$disable_seo ) {

return;

}

\$template_id = Database::\$active_templates\[\'content\'\];

\$template_settings = get_post_meta( \$template_id,
BRICKS_DB_PAGE_SETTINGS, true );

\$post_id = is_home() ? get_option( \'page_for_posts\' ) : get_the_ID();

if ( \$template_id !== \$post_id ) {

\$page_settings = get_post_meta( \$post_id, BRICKS_DB_PAGE_SETTINGS,
true );

}

\$seo_tags = \[

\'metaDescription\' =\> \'description\',

\'metaKeywords\' =\> \'keywords\',

\'metaRobots\' =\> \'robots\',

\];

foreach ( \$seo_tags as \$meta_key =\> \$name ) {

// Page settings preceeds Template settings

\$meta_value = ! empty( \$page_settings\[ \$meta_key \] ) ?
\$page_settings\[ \$meta_key \] : ( ! empty( \$template_settings\[
\$meta_key \] ) ? \$template_settings\[ \$meta_key \] : false );

if ( empty( \$meta_value ) ) {

continue;

}

if ( \$meta_key == \'metaRobots\' ) {

\$meta_value = join( \', \', \$meta_value );

} else {

\$meta_value = bricks_render_dynamic_data( \$meta_value, \$post_id );

}

echo \'\<meta name=\"\' . \$name . \'\" content=\"\' . esc_attr(
\$meta_value ) . \'\"\>\';

}

}

/\*\*

\* Page settings: Set document title

\*

\* \@param array \$title

\*

\* \@see
https://developer.wordpress.org/reference/hooks/document_title_parts/

\*

\* \@since 1.6.1

\*/

public function set_seo_document_title( \$title ) {

// NOTE: Undocumented

\$disable_seo = apply_filters( \'bricks/frontend/disable_seo\', ! empty(
Database::\$global_settings\[\'disableSeo\'\] ) );

if ( \$disable_seo ) {

return \$title;

}

\$template_id = Database::\$active_templates\[\'content\'\];

\$template_settings = get_post_meta( \$template_id,
BRICKS_DB_PAGE_SETTINGS, true );

\$post_id = is_home() ? get_option( \'page_for_posts\' ) : get_the_ID();

if ( \$template_id !== \$post_id ) {

\$page_settings = get_post_meta( \$post_id, BRICKS_DB_PAGE_SETTINGS,
true );

}

// Page settings preceeds Template settings

\$meta_value = ! empty( \$page_settings\[\'documentTitle\'\] ) ?
\$page_settings\[\'documentTitle\'\] : ( ! empty(
\$template_settings\[\'documentTitle\'\] ) ?
\$template_settings\[\'documentTitle\'\] : false );

if ( empty( \$meta_value ) ) {

return \$title;

}

\$meta_value = bricks_render_dynamic_data( \$meta_value, \$post_id );

if ( \$meta_value ) {

\$title\[\'title\'\] = \$meta_value;

}

return \$title;

}

/\*\*

\* Add Facebook Open Graph Meta Data

\*

\* https://ogp.me

\*

\* \@since 1.0

\*/

public function add_open_graph_meta_tags() {

// Return: Don\'t add Open Graph tag when maintenance mode is enabled
(@since 1.10)

if ( \\Bricks\\Maintenance::get_mode() ) {

return;

}

// NOTE: Undocumented

\$disable_og = apply_filters( \'bricks/frontend/disable_opengraph\', !
empty( Database::\$global_settings\[\'disableOpenGraph\'\] ) );

if ( \$disable_og ) {

return;

}

// STEP: Calculate OG settings

\$template_id = Database::\$active_templates\[\'content\'\];

\$template_settings = get_post_meta( \$template_id,
BRICKS_DB_PAGE_SETTINGS, true );

\$post_id = is_home() ? get_option( \'page_for_posts\' ) : get_the_ID();

\$post_id = empty( \$post_id ) ? null : \$post_id; // Fix PHP notice on
Error page

if ( \$template_id !== \$post_id && ! empty( \$post_id ) ) {

\$page_settings = get_post_meta( \$post_id, BRICKS_DB_PAGE_SETTINGS,
true );

}

\$settings = \[\];

\$og_tags = \[

\'sharingTitle\',

\'sharingDescription\',

\'sharingImage\',

\];

foreach ( \$og_tags as \$meta_key ) {

// Page settings preceeds Template settings

\$settings\[ \$meta_key \] = ! empty( \$page_settings\[ \$meta_key \] )
? \$page_settings\[ \$meta_key \] : ( ! empty( \$template_settings\[
\$meta_key \] ) ? \$template_settings\[ \$meta_key \] : false );

}

// STEP: Render tags

\$open_graph_meta_tags = \[ \'\<!\-- Facebook Open Graph (by Bricks)
\--\>\' \];

\$facebook_app_id = isset(
Database::\$global_settings\[\'facebookAppId\'\] ) && ! empty(
Database::\$global_settings\[\'facebookAppId\'\] ) ?
Database::\$global_settings\[\'facebookAppId\'\] : false;

if ( \$facebook_app_id ) {

\$open_graph_meta_tags\[\] = \'\<meta property=\"fb:app_id\"
content=\"\' . \$facebook_app_id . \'\" /\>\';

}

\$open_graph_meta_tags\[\] = \'\<meta property=\"og:url\" content=\"\' .
get_permalink() . \'\" /\>\';

// Site Name

\$open_graph_meta_tags\[\] = \'\<meta property=\"og:site_name\"
content=\"\' . get_bloginfo( \'name\' ) . \'\" /\>\';

// Title

if ( ! empty( \$settings\[\'sharingTitle\'\] ) ) {

\$sharing_title = bricks_render_dynamic_data(
\$settings\[\'sharingTitle\'\], \$post_id );

} else {

\$sharing_title = get_the_title( \$post_id );

}

\$open_graph_meta_tags\[\] = \'\<meta property=\"og:title\" content=\"\'
. esc_attr( trim( \$sharing_title ) ) . \'\" /\>\';

// Description

if ( ! empty( \$settings\[\'sharingDescription\'\] ) ) {

\$sharing_description = bricks_render_dynamic_data(
\$settings\[\'sharingDescription\'\], \$post_id );

} else {

\$sharing_description = \$post_id ? get_the_excerpt( \$post_id ) : \'\';

}

if ( \$sharing_description ) {

\$open_graph_meta_tags\[\] = \'\<meta property=\"og:description\"
content=\"\' . esc_attr( trim( \$sharing_description ) ) . \'\" /\>\';

}

// Image

\$sharing_image = ! empty( \$settings\[\'sharingImage\'\] ) ?
\$settings\[\'sharingImage\'\] : false;

\$sharing_image_url = ! empty( \$sharing_image\[\'url\'\] ) ?
\$sharing_image\[\'url\'\] : false;

if ( \$sharing_image ) {

if ( ! empty( \$sharing_image\[\'useDynamicData\'\] ) ) {

\$images = Integrations\\Dynamic_Data\\Providers::render_tag(
\$sharing_image\[\'useDynamicData\'\], \$post_id, \'image\' );

if ( ! empty( \$images\[0\] ) ) {

\$size = ! empty( \$sharing_image\[\'size\'\] ) ?
\$sharing_image\[\'size\'\] : BRICKS_DEFAULT_IMAGE_SIZE;

\$sharing_image_url = is_numeric( \$images\[0\] ) ?
wp_get_attachment_image_url( \$images\[0\], \$size ) : \$images\[0\];

}

} else {

\$sharing_image_url = \$sharing_image\[\'url\'\];

}

} elseif ( has_post_thumbnail() ) {

\$sharing_image_url = get_the_post_thumbnail_url( get_the_ID(),
\'large\' );

}

if ( \$sharing_image_url ) {

\$open_graph_meta_tags\[\] = \'\<meta property=\"og:image\" content=\"\'
. esc_url( \$sharing_image_url ) . \'\" /\>\';

}

// Type

if ( is_home() ) {

\$sharing_type = \'blog\';

} elseif ( get_post_type() === \'post\' ) {

\$sharing_type = \'article\';

} else {

\$sharing_type = \'website\';

}

\$open_graph_meta_tags\[\] = \'\<meta property=\"og:type\" content=\"\'
. \$sharing_type . \'\" /\>\';

echo \"\\n\" . join( \"\\n\", \$open_graph_meta_tags ) . \"\\n\";

}

/\*\*

\* Add body header scripts

\*

\* NOTE: Do not add template JS (we only want to provide content)

\*

\* \@since 1.0

\*/

public function add_body_header_scripts() {

\$body_header_scripts = \'\';

// Global settings scripts

if ( isset( Database::\$global_settings\[\'customScriptsBodyHeader\'\] )
&& ! empty( Database::\$global_settings\[\'customScriptsBodyHeader\'\] )
) {

\$body_header_scripts .= stripslashes_deep(
Database::\$global_settings\[\'customScriptsBodyHeader\'\] ) . PHP_EOL;

}

// Page settings scripts (@since 1.4)

\$body_header_scripts .= Assets::get_page_settings_scripts(
\'customScriptsBodyHeader\' );

echo \$body_header_scripts;

}

/\*\*

\* Add body footer scripts

\*

\* NOTE: Do not add template JS (only provide content)

\*

\* \@since 1.0

\*/

public function add_body_footer_scripts() {

\$body_footer_scripts = \'\';

// Global settings scripts

if ( isset( Database::\$global_settings\[\'customScriptsBodyFooter\'\] )
&& ! empty( Database::\$global_settings\[\'customScriptsBodyFooter\'\] )
) {

\$body_footer_scripts .= stripslashes_deep(
Database::\$global_settings\[\'customScriptsBodyFooter\'\] ) . PHP_EOL;

}

// Page settings scripts (@since 1.4)

\$body_footer_scripts .= Assets::get_page_settings_scripts(
\'customScriptsBodyFooter\' );

echo \$body_footer_scripts;

}

/\*\*

\* Enqueue styles and scripts

\*/

public function enqueue_scripts() {

if ( is_admin_bar_showing() &&
Capabilities::current_user_has_full_access() ) {

// Load admin.min.css to add styles to the quick edit links

wp_enqueue_style( \'bricks-admin\', BRICKS_URL_ASSETS .
\'css/admin.min.css\', \[\], filemtime( BRICKS_PATH_ASSETS .
\'css/admin.min.css\' ) );

}

// No Bricks content: Load default post content styles (post header &
content)

\$bricks_data = Helpers::get_bricks_data( get_the_ID(), \'content\' );

if ( ! \$bricks_data ) {

if ( is_search() \|\| get_the_content() \|\| is_singular( \'post\' ) ) {

wp_enqueue_style( \'bricks-default-content\', BRICKS_URL_ASSETS .
\'css/frontend/content-default.min.css\', \[\], filemtime(
BRICKS_PATH_ASSETS . \'css/frontend/content-default.min.css\' ) );

}

}

// Remove .mejs from attachment page

if ( is_attachment() ) {

wp_deregister_script( \'wp-mediaelement\' );

wp_deregister_style( \'wp-mediaelement\' );

}

global \$wp;

\$base_url = home_url( \$wp-\>request );

// Check if the URL contains a paging path (/page/X)

if ( preg_match( \'/\\/page\\/\\d+\\/?\$/\', \$base_url, \$matches ) ) {

\$paging_path = \$matches\[0\];

\$base_url = str_replace( \$paging_path, \'\', \$base_url );

}

\$base_url = trailingslashit( \$base_url );

\$current_language = \'\';

\$wpml_url_format = \'\';

\$multilang_plugin = \'\';

// Check if WPML is active and get the current language code (@since
1.9.9)

if ( \\Bricks\\Integrations\\Wpml\\Wpml::is_wpml_active() ) {

\$current_language =
\\Bricks\\Integrations\\Wpml\\Wpml::get_current_language();

\$wpml_url_format =
\\Bricks\\Integrations\\Wpml\\Wpml::get_url_format();

\$multilang_plugin = \'wpml\';

}

// Check if Polylang is active and get the current language code (@since
1.9.9)

elseif ( \\Bricks\\Integrations\\Polylang\\Polylang::\$is_active ) {

\$current_language =
\\Bricks\\Integrations\\Polylang\\Polylang::get_current_language();

\$multilang_plugin = \'polylang\';

}

wp_localize_script(

\'bricks-scripts\',

\'bricksData\',

\[

\'debug\' =\> isset( \$\_GET\[\'debug\'\] ),

\'locale\' =\> get_locale(),

\'ajaxUrl\' =\> admin_url( \'admin-ajax.php\' ),

\'restApiUrl\' =\> Api::get_rest_api_url(),

\'nonce\' =\> wp_create_nonce( \'bricks-nonce\' ),

\'formNonce\' =\> wp_create_nonce( \'bricks-nonce-form\' ),

\'wpRestNonce\' =\> wp_create_nonce( \'wp_rest\' ),

\'postId\' =\> Database::\$page_data\[\'preview_or_post_id\'\] ??
get_the_ID(),

\'recaptchaIds\' =\> \[\],

\'animatedTypingInstances\' =\> \[\], // To destroy and then re-init
TypedJS instances

\'videoInstances\' =\> \[\], // To destroy and then re-init Plyr
instances

\'splideInstances\' =\> \[\], // Necessary to destroy and then reinit
SplideJS instances

\'tocbotInstances\' =\> \[\], // Necessary to destroy and then reinit
Tocbot instances

\'swiperInstances\' =\> \[\], // To destroy and then re-init SwiperJS
instances

\'queryLoopInstances\' =\> \[\], // To hold the query data for infinite
scroll + load more

\'interactions\' =\> \[\], // Holds all the interactions

\'filterInstances\' =\> \[\], // Holds all the filter instances (@since
1.9.6)

\'isotopeInstances\' =\> \[\], // Holds all the isotope instances
(@since 1.9.6)

\'mapStyles\' =\> Setup::get_map_styles(),

\'facebookAppId\' =\> isset(
Database::\$global_settings\[\'facebookAppId\'\] ) ?
Database::\$global_settings\[\'facebookAppId\'\] : false,

\'headerPosition\' =\> Database::\$header_position,

\'offsetLazyLoad\' =\> ! empty(
Database::\$global_settings\[\'offsetLazyLoad\'\] ) ?
Database::\$global_settings\[\'offsetLazyLoad\'\] : 300,

\'baseUrl\' =\> \$base_url, // \@since 1.9.6

\'useQueryFilter\' =\> Helpers::enabled_query_filters(), // \@since
1.9.6

\'pageFilters\' =\> Query_Filters::\$page_filters, // \@since 1.9.6

\'facebookAppId\' =\> Database::\$global_settings\[\'facebookAppId\'\]
?? false,

\'offsetLazyLoad\' =\> Database::\$global_settings\[\'offsetLazyLoad\'\]
?? 300,

\'headerPosition\' =\> Database::\$header_position,

\'language\' =\> \$current_language,

\'wpmlUrlFormat\' =\> \$wpml_url_format ?? \'\',

\'multilangPlugin\' =\> \$multilang_plugin,

\'i18n\' =\> \[

\'openMobileMenu\' =\> esc_html\_\_( \'Open mobile menu\', \'bricks\' ),

\'closeMobileMenu\' =\> esc_html\_\_( \'Close mobile menu\', \'bricks\'
),

\],

\]

);

}

/\*\*

\* Enqueue inline CSS

\*

\* \@since 1.8.2 using wp_footer instead of wp_enqueue_scripts to get
all dynamic data styles & global classes

\*/

public function enqueue_inline_css() {

// Dummy style to load after woocommerce.min.css

wp_register_style( \'bricks-frontend-inline\', false ); // phpcs:ignore
WordPress.WP.EnqueuedResourceParameters.MissingVersion

wp_enqueue_style( \'bricks-frontend-inline\' );

// Bricks settings: AJAX Hide View Cart Button (@since 1.9)

if ( WooCommerce::is_woocommerce_active() && Database::get_setting(
\'woocommerceAjaxHideViewCart\' ) ) {

wp_add_inline_style( \'bricks-frontend-inline\',
\'.added_to_cart.wc-forward {display: none}\' );

}

\$inline_css = \'\';

// CSS loading method: External files

// TODO NEXT: Generate external CSS file for global classes (#861mcc28z)

if ( Database::get_setting( \'cssLoading\' ) === \'file\' ) {

// Global classes need to be loaded inline

\$inline_css = Assets::\$inline_css\[\'global_classes\'\];

}

// CSS loading method: Inline styles (= default)

else {

\$inline_css = Assets::generate_inline_css();

}

// Bricks settings: Smooth scroll CSS

if ( Database::get_setting( \'smoothScroll\' ) ) {

\$inline_css = \"html {scroll-behavior: smooth}\\n\" . \$inline_css;

}

if ( \$inline_css ) {

// Minify inline CSS (@since 1.9.9)

\$inline_css = Assets::minify_css( \$inline_css );

wp_add_inline_style( \'bricks-frontend-inline\', \$inline_css );

}

// Clear global classes inline CSS to avoid adding duplicate classes in
enqueue_footer_inline_css function below

Assets::\$inline_css\[\'global_classes\'\] = \'\';

}

/\*\*

\* Enqueue inline CSS in wp_footer: Global classes (Template element) &
dynamic data

\*

\* \@since 1.8.2

\*/

public function enqueue_footer_inline_css() {

/\*\*

\* Add global classes in wp_footer

\*

\* Clear in enqueue_inline_css function above to avoid adding duplicate
classes.

\*

\* Generated in Template element and therefore not available in
enqueue_inline_css function above.

\*

\* \@since 1.8.2

\*/

// Performance improvement (@since 1.9.8)

Assets::generate_global_classes();

\$global_classes = Assets::\$inline_css\[\'global_classes\'\];

if ( \$global_classes ) {

wp_register_style( \'bricks-global-classes-inline\', false ); //
phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion

wp_enqueue_style( \'bricks-global-classes-inline\' );

wp_add_inline_style( \'bricks-global-classes-inline\', \$global_classes
);

}

// Get dynamic data CSS (for AJAX pagination only \@since 1.8.2)

\$inline_css_dynamic_data = Assets::\$inline_css_dynamic_data;

if ( \$inline_css_dynamic_data ) {

// Replace for AJAX pagination (see frontend.js #bricks-dynamic-data)

wp_register_style( \'bricks-dynamic-data\', false ); // phpcs:ignore
WordPress.WP.EnqueuedResourceParameters.MissingVersion

wp_enqueue_style( \'bricks-dynamic-data\' );

wp_add_inline_style( \'bricks-dynamic-data\', \$inline_css_dynamic_data
);

}

}

/\*\*

\* Get element content wrapper

\*/

public static function get_content_wrapper( \$settings, \$fields, \$post
) {

\$output = \'\';

foreach ( \$fields as \$index =\> \$field ) {

if ( ! empty( \$field\[\'dynamicData\'\] ) ) {

\$content = bricks_render_dynamic_data( \$field\[\'dynamicData\'\],
\$post-\>ID );

\$content = do_shortcode( \$content );

if ( \$content == \'\' ) {

continue;

}

\$tag = \'div\';

if ( ! empty( \$field\[\'tag\'\] ) ) {

\$tag = Helpers::sanitize_html_tag( \$field\[\'tag\'\], \'div\' );

}

\$field_id = isset( \$field\[\'id\'\] ) ? \$field\[\'id\'\] : \$index;

\$output .= \"\<{\$tag} class=\\\"dynamic\\\"
data-field-id=\\\"{\$field_id}\\\"\>{\$content}\</{\$tag}\>\";

}

}

return \$output;

}

/\*\*

\* Render element recursively

\*

\* \@param array \$element

\*/

public static function render_element( \$element ) {

\$element_name = \$element\[\'name\'\] ?? \'\';

if ( ! \$element_name ) {

return;

}

// Check: Get global element settings (skip if AJAX call is coming from
builder via \'global_settings_checked\')

\$global_settings = ! isset( \$element\[\'global_settings_checked\'\] )
? Helpers::get_global_element( \$element, \'settings\' ) : false;

if ( is_array( \$global_settings ) ) {

\$element\[\'settings\'\] = \$global_settings;

}

// Init element class (e.g.: new Bricks\\Element_Alert( \$element ))

\$element_class_name = Elements::\$elements\[ \$element_name
\]\[\'class\'\] ?? \$element_name;

if ( class_exists( \$element_class_name ) ) {

\$element\[\'themeStyleSettings\'\] = Theme_Styles::\$active_settings;

\$element_instance = new \$element_class_name( \$element );

\$element_instance-\>load();

// Enqueue element styles/scripts & render element

ob_start();

\$element_instance-\>init();

return ob_get_clean();

}

// Element doesn\'t exist: Show message to user with builder access

if ( Capabilities::current_user_can_use_builder() ) {

return sprintf( \'\<div class=\"bricks-element-placeholder
no-php-class\"\>%s: \' . \$element_class_name . \'\</div\>\',
esc_html\_\_( \'PHP class does not exist\', \'bricks\' ) );

}

}

/\*\*

\* Render element \'children\' (= nestable element)

\*

\* \@param array \$element_instance Instance of the element.

\*

\* \@since 1.5

\*/

public static function render_children( \$element_instance ) {

\$element = \$element_instance-\>element;

/\*\*

\* BUILDER: Replace children placeholder node with Vue components (in
BricksElementPHP.vue)

\*

\* If not static builder area && not frontend && not a loop ghost node
(loop index: 1, 2, 3, etc.)

\*

\* \@since 1.7.1

\*/

if ( ! isset( \$element\[\'staticArea\'\] ) && !
\$element_instance-\>is_frontend && ! Query::get_loop_index() ) {

return \'\<div class=\"brx-nestable-children-placeholder\"\>\</div\>\';

}

// FRONTEND: Return children HTML

\$children = ! empty( \$element\[\'children\'\] ) && is_array(
\$element\[\'children\'\] ) ? \$element\[\'children\'\] : \[\];

\$output = \'\';

foreach ( \$children as \$child_id ) {

\$child = ! empty( self::\$elements\[ \$child_id \] ) ?
self::\$elements\[ \$child_id \] : false;

if ( \$child ) {

\$output .= self::render_element( \$child ); // Recursive

}

}

return \$output;

}

/\*\*

\* Return rendered elements (header/content/footer)

\*

\* \@param array \$elements Array of Bricks elements.

\* \@param string \$area header/content/footer.

\*

\* \@since 1.2

\*/

public static function render_data( \$elements = \[\], \$area =
\'content\' ) {

if ( ! is_array( \$elements ) ) {

return;

}

if ( ! count( \$elements ) ) {

return;

}

// NOTE: Undocumented. Useful to remove plugin actions/filters (@since
1.5.4)

do_action( \'bricks/frontend/before_render_data\', \$elements, \$area );

self::\$elements = \[\];

self::\$area = \$area;

// Prepare flat list of elements for recursive calls

foreach ( \$elements as \$element ) {

if ( isset( \$element\[\'id\'\] ) ) {

self::\$elements\[ \$element\[\'id\'\] \] = \$element;

/\*\*

\* Store live search results selectors

\*

\* To set element root data attribute \'data-brx-ls-wrapper\' to hide
live search wrapper on page load (@see container.php:902)

\*

\* \@since 1.9.6

\*/

if (

Helpers::enabled_query_filters() &&

! empty( \$element\[\'settings\'\]\[\'query\'\]\[\'is_live_search\'\] )
&&

! empty(
\$element\[\'settings\'\]\[\'query\'\]\[\'is_live_search_wrapper_selector\'\]
)

) {

self::\$live_search_wrapper_selectors\[ \$element\[\'id\'\] \] =
\$element\[\'settings\'\]\[\'query\'\]\[\'is_live_search_wrapper_selector\'\];

}

}

}

// Generate elements HTML

\$content = \'\';

foreach ( \$elements as \$element ) {

if ( ! empty( \$element\[\'parent\'\] ) ) {

continue;

}

\$content .= self::render_element( \$element );

}

// NOTE: Undocumented. Useful to re-add plugin actions/filters (@since
1.5.4)

do_action( \'bricks/frontend/after_render_data\', \$elements, \$area );

/\*\*

\* Check: Are we looping a template element

\*

\* \@since 1.7: Use Query::get_loop_object_type() if check for a looping
post, so user custom queries are also supported (@see #862j64bkn)

\*/

\$looping_query_id = Query::is_any_looping();

\$loop_object_type = Query::get_loop_object_type( \$looping_query_id );

\$post_id = \$loop_object_type === \'post\' ? get_the_ID() :
Database::\$page_data\[\'preview_or_post_id\'\];

\$post = get_post( \$post_id );

/\*\*

\* Filter Bricks content (incl. parsing of dynamic data)

\*

\*
https://academy.bricksbuilder.io/article/filter-bricks-frontend-render_data/

\*

\* \@since 1.5.4 (\$area argument)

\*/

\$content = apply_filters( \'bricks/frontend/render_data\', \$content,
\$post, \$area );

self::\$elements = \[\];

return \$content;

}

/\*\*

\* One Page Navigation Wrapper

\*/

public function one_page_navigation_wrapper() {

if ( isset( Database::\$page_settings\[\'onePageNavigation\'\] ) ) {

echo \'\<ul id=\"bricks-one-page-navigation\"\>\</ul\>\';

}

}

/\*\*

\* Lazy load via img data attribute

\*

\*
https://developer.wordpress.org/reference/hooks/wp_get_attachment_image_attributes/

\*

\* \@param array \$attr Image attributes.

\* \@param object \$attachment WP_POST object of image.

\* \@param string\|array \$size Requested image size.

\*

\* \@return array

\*/

public function set_image_attributes( \$attr, \$attachment, \$size ) {

// Disable lazy load for AJAX (builder & frontend) or REST API calls
(builder) to ensure assets are always rendered properly

// REST_REQUEST constant discussion:
https://github.com/WP-API/WP-API/issues/926

if ( bricks_is_ajax_call() \|\| bricks_is_rest_call() ) {

return \$attr;

}

// Disable lazy load inside TranslatePress iframe (@since 1.6)

if ( function_exists( \'trp_is_translation_editor\' ) &&
trp_is_translation_editor( \'preview\' ) ) {

return \$attr;

}

// Disable images lazy loading in the Product Gallery

if ( isset( \$attr\[\'\_brx_disable_lazy_loading\'\] ) ) {

unset( \$attr\[\'\_brx_disable_lazy_loading\'\] );

return \$attr;

}

// Check: Lazy load disabled

if ( isset( Database::\$global_settings\[\'disableLazyLoad\'\] ) \|\|
isset( Database::\$page_settings\[\'disableLazyLoad\'\] ) ) {

return \$attr;

}

// Return: To disable lazy loading for all images with attribute
loading=\"eager\" (@since 1.6)

if ( isset( \$attr\[\'loading\'\] ) && \$attr\[\'loading\'\] ===
\'eager\' ) {

return \$attr;

}

\$attr\[\'class\'\] = \$attr\[\'class\'\] . \' bricks-lazy-hidden\';

\$attr\[\'data-src\'\] = \$attr\[\'src\'\];

// Lazy load placeholder: URL-encoded SVG with image dimensions

\$attr\[\'data-type\'\] = gettype( \$size );

if ( gettype( \$size ) === \'string\' ) {

\$image_src = wp_get_attachment_image_src( \$attachment-\>ID, \$size );

\$image_width = \$image_src\[1\];

\$image_height = \$image_src\[2\];

} else {

\$image_width = \$size\[0\];

\$image_height = \$size\[1\];

}

// Set SVG placeholder to preserve image aspect ratio to prevent browser
content reflow when lazy loading the image

// Encode spaces and use singlequotes instead of double quotes to avoid
W3 \"space\" validator error (@since 1.5.1)

\$attr\[\'src\'\] =
\"data:image/svg+xml,%3Csvg%20xmlns=\'http://www.w3.org/2000/svg\'%20viewBox=\'0%200%20\$image_width%20\$image_height\'%3E%3C/svg%3E\";

// Add data-sizes attribute for lazy load to avoid \"sizes\" W3
validator error (@since 1.5.1)

if ( isset( \$attr\[\'sizes\'\] ) ) {

\$attr\[\'data-sizes\'\] = \$attr\[\'sizes\'\];

\$attr\[\'sizes\'\] = \'\';

unset( \$attr\[\'sizes\'\] );

}

if ( isset( \$attr\[\'srcset\'\] ) ) {

\$attr\[\'data-srcset\'\] = \$attr\[\'srcset\'\];

\$attr\[\'srcset\'\] = \'\';

unset( \$attr\[\'srcset\'\] );

}

return \$attr;

}

/\*\*

\* Template frontend view: Permanently redirect users without Bricks
editing permission to homepage

\*

\* Exclude template pages in search engine results.

\*

\* Overwrite via \'publicTemplates\' setting

\*

\* \@since 1.9.4: Exclude redirect if maintenance mode activated (to
prevent endless redirect)

\*/

public function template_redirect() {

if (

is_singular( BRICKS_DB_TEMPLATE_SLUG ) &&

! Capabilities::current_user_can_use_builder() &&

! isset( Database::\$global_settings\[\'publicTemplates\'\] ) &&

! Maintenance::get_mode() ) {

wp_safe_redirect( site_url(), 301 );

die;

}

}

public function add_skip_link() {

if ( Database::get_setting( \'disableSkipLinks\', false ) ) {

return;

}

\$template_footer_id = Database::\$active_templates\[\'footer\'\];

?\>

\<a class=\"skip-link\" href=\"#brx-content\" aria-label=\"\<?php
esc_html_e( \'Skip to main content\', \'bricks\' ); ?\>\"\>\<?php
esc_html_e( \'Skip to main content\', \'bricks\' ); ?\>\</a\>

\<?php if ( ! empty( \$template_footer_id ) ) { ?\>

\<a class=\"skip-link\" href=\"#brx-footer\" aria-label=\"\<?php
esc_html_e( \'Skip to footer\', \'bricks\' ); ?\>\"\>\<?php esc_html_e(
\'Skip to footer\', \'bricks\' ); ?\>\</a\>

\<?php

}

}

/\*\*

\* Remove WP hooks on frontend

\*

\* \@since 1.5.5

\*/

public function remove_wp_hooks() {

if ( is_attachment() && ! empty(
Database::\$active_templates\[\'content\'\] ) ) {

// Post type \'attachment\' template: This filter prepends/adds the
attachment to all Bricks elements that use the_content (@since 1.5.5)

remove_filter( \'the_content\', \'prepend_attachment\' );

}

}

/\*\*

\* Render header

\*

\* Bricks data exists & header is not disabled on this page.

\*

\* \@since 1.3.2

\*/

public function render_header() {

\$header_data = Database::get_template_data( \'header\' );

// Return: No header data exists

if ( ! is_array( \$header_data ) ) {

return;

}

\$settings = Helpers::get_template_settings(
Database::\$active_templates\[\'header\'\] );

\$classes = \[\];

// Sticky header (top, not left or right)

if ( ! isset( \$settings\[\'headerPosition\'\] ) && isset(
\$settings\[\'headerSticky\'\] ) ) {

\$classes\[\] = \'sticky\';

if ( isset( \$settings\[\'headerStickyOnScroll\'\] ) ) {

\$classes\[\] = \'on-scroll\';

}

}

\$attributes = \[

\'id\' =\> \'brx-header\',

\];

if ( count( \$classes ) ) {

\$attributes\[\'class\'\] = \$classes;

}

if ( ! empty( \$settings\[\'headerStickySlideUpAfter\'\] ) ) {

\$attributes\[\'data-slide-up-after\'\] = intval(
\$settings\[\'headerStickySlideUpAfter\'\] );

}

//
https://academy.bricksbuilder.io/article/filter-bricks-header-attributes/
(@since 1.5)

\$attributes = apply_filters( \'bricks/header/attributes\', \$attributes
);

\$attributes = Helpers::stringify_html_attributes( \$attributes );

\$header_html = \"\<header {\$attributes}\>\" . self::render_data(
\$header_data, \'header\' ) . \'\</header\>\';

// NOTE: Undocumented

echo apply_filters( \'bricks/render_header\', \$header_html );

}

/\*\*

\* Render Bricks content + surrounding \'main\' tag

\*

\* For pages rendered with Bricks

\*

\* To allow customizing the \'main\' tag attributes

\*

\* \@since 1.5

\*/

public static function render_content( \$bricks_data = \[\],
\$attributes = \[\], \$html_after_begin = \'\', \$html_before_end =
\'\', \$tag = \'main\' ) {

// Merge custom attributes with default attributes (\'id\')

if ( is_array( \$attributes ) ) {

\$attributes = array_merge( \[ \'id\' =\> \'brx-content\' \],
\$attributes );

}

// Return: Popup template preview

if ( Templates::get_template_type() === \'popup\' ) {

return;

}

//
https://academy.bricksbuilder.io/article/filter-bricks-content-attributes/
(@since 1.5)

\$attributes = apply_filters( \'bricks/content/attributes\',
\$attributes );

\$attributes = Helpers::stringify_html_attributes( \$attributes );

if ( \$tag ) {

echo \"\<{\$tag} {\$attributes}\>\";

}

//
https://academy.bricksbuilder.io/article/filter-bricks-content-html_after_begin/

\$html_after_begin = apply_filters( \'bricks/content/html_after_begin\',
\$html_after_begin, \$bricks_data, \$attributes, \$tag );

if ( \$html_after_begin ) {

echo \$html_after_begin;

}

if ( is_array( \$bricks_data ) && count( \$bricks_data ) ) {

echo self::render_data( \$bricks_data );

}

//
https://academy.bricksbuilder.io/article/filter-bricks-content-html_before_end/

\$html_before_end = apply_filters( \'bricks/content/html_before_end\',
\$html_before_end, \$bricks_data, \$attributes, \$tag );

if ( \$html_before_end ) {

echo \$html_before_end;

}

if ( \$tag ) {

echo \"\</{\$tag}\>\";

}

}

/\*\*

\* Render footer

\*

\* To follow already available \'render_header\' function syntax

\*

\* \@since 1.5

\*/

public function render_footer() {

\$footer_data = Database::get_template_data( \'footer\' );

if ( ! is_array( \$footer_data ) ) {

return;

}

//
https://academy.bricksbuilder.io/article/filter-bricks-footer-attributes/
(@since 1.5)

\$attributes = apply_filters(

\'bricks/footer/attributes\',

\[

\'id\' =\> \'brx-footer\',

\]

);

\$attributes = Helpers::stringify_html_attributes( \$attributes );

\$footer_html = \"\<footer {\$attributes}\>\" . self::render_data(
\$footer_data, \'footer\' ) . \'\</footer\>\';

// NOTE: Undocumented

echo apply_filters( \'bricks/render_footer\', \$footer_html );

}

}

auth-redirects.php\
\
\<?php

namespace Bricks;

if ( ! defined( \'ABSPATH\' ) ) exit; // Exit if accessed directly

/\*\*

\* Responsible for handling the custom redirection logic for
authentication-related pages.

\*

\* Login page

\* Registration page

\* Lost password page

\* Reset password page

\*

\* \@since 1.9.2

\*/

class Auth_Redirects {

public function \_\_construct() {

add_action( \'wp_loaded\', \[ \$this, \'handle_auth_redirects\' \] );

add_action( \'wp_login\', \[ \$this, \'clear_bypass_auth_cookie\' \] );

}

/\*\*

\* Main function to handle authentication redirects

\*

\* Depending on the current URL and the action parameter, decides which
page to redirect to.

\*/

public function handle_auth_redirects() {

/\*\*

\* STEP: Set the bypass cookie (expires in 5 minutes)

\*

\* If the \'use_default_wp\' URL parameter is set and the Global setting
\'brx_use_wp_login\' is not disabled.

\*

\* \@since 1.9.4

\*/

if ( isset( \$\_GET\[\'brx_use_wp_login\'\] ) && !
Database::get_setting( \'disable_brx_use_wp_login\' ) ) {

setcookie(

\'brx_use_wp_login\',

\'1\',

\[

\'expires\' =\> time() + 5 \* 60, // Expires in 5 minutes

\'path\' =\> COOKIEPATH,

\'domain\' =\> COOKIE_DOMAIN,

\'secure\' =\> is_ssl(),

\'httponly\' =\> true,

\'samesite\' =\> \'Strict\',

\]

);

}

// STEP: Check if the bypass cookie is set, and if so, bypass redirects
(@since 1.9.4)

if ( isset( \$\_COOKIE\[\'brx_use_wp_login\'\] ) &&
\$\_COOKIE\[\'brx_use_wp_login\'\] === \'1\' ) {

return;

}

\$request_uri = esc_url_raw( \$\_SERVER\[\'REQUEST_URI\'\] ?? \'\' );

\$current_url_path = wp_parse_url( home_url( \$request_uri ),
PHP_URL_PATH );

\$wp_login_url_path = wp_parse_url( wp_login_url(), PHP_URL_PATH );

\$wp_registration_url_path = wp_parse_url( wp_registration_url(),
PHP_URL_PATH );

\$wp_lost_password_url_path = wp_parse_url( wp_lostpassword_url(),
PHP_URL_PATH );

// Get the home path

\$home_path = wp_parse_url( home_url(), PHP_URL_PATH );

// Fallback to \'/\' if home path is empty to prevent preg_quote error
(e.g. URL ends with port number)

if ( ! \$home_path ) {

\$home_path = \'/\';

}

// Remove home path from request URI

\$current_url_path = preg_replace( \'/\^\' . preg_quote( \$home_path,
\'/\' ) . \'/\', \'\', \$request_uri );

// Remove query string if present

\$current_url_path = strtok( \$current_url_path, \'?\' );

// Also remove home path from WordPress URLs

\$wp_login_url_path = preg_replace( \'/\^\' . preg_quote( \$home_path,
\'/\' ) . \'/\', \'\', \$wp_login_url_path );

\$wp_registration_url_path = preg_replace( \'/\^\' . preg_quote(
\$home_path, \'/\' ) . \'/\', \'\', \$wp_registration_url_path );

\$wp_lost_password_url_path = preg_replace( \'/\^\' . preg_quote(
\$home_path, \'/\' ) . \'/\', \'\', \$wp_lost_password_url_path );

\$action = isset( \$\_GET\[\'action\'\] ) ? sanitize_key(
\$\_GET\[\'action\'\] ) : null;

// STEP: Filter to allow custom logic for redirects

\$custom_redirect_url = apply_filters(
\'bricks/auth/custom_redirect_url\', null, \$current_url_path );

if ( ! is_null( \$custom_redirect_url ) ) {

wp_safe_redirect( \$custom_redirect_url );

exit;

}

if ( \$current_url_path === \$wp_login_url_path ) { // Login page &
actions

switch ( \$action ) {

case null:

\$this-\>redirect_to_custom_login_page();

break;

case \'lostpassword\':

\$this-\>redirect_to_custom_lost_password_page();

break;

case \'register\':

\$this-\>redirect_to_custom_registration_page();

break;

case \'rp\': // Reset password

\$this-\>redirect_to_custom_reset_password_page();

break;

}

} elseif ( \$current_url_path === \$wp_registration_url_path ) { //
Registration page fallback

\$this-\>redirect_to_custom_registration_page();

} elseif ( \$current_url_path === \$wp_lost_password_url_path ) { //
Lost password page fallback

\$this-\>redirect_to_custom_lost_password_page();

}

}

/\*\*

\* Clears the bypass cookie when the user logs in.

\*/

public function clear_bypass_auth_cookie() {

if ( isset( \$\_COOKIE\[\'brx_use_wp_login\'\] ) ) {

// Ensure the path and domain match where the cookie was set

setcookie(

\'brx_use_wp_login\',

\'\',

\[

\'expires\' =\> time() - 3600,

\'path\' =\> COOKIEPATH,

\'domain\' =\> COOKIE_DOMAIN,

\'secure\' =\> is_ssl(),

\'httponly\' =\> true,

\'samesite\' =\> \'Strict\'

\]

);

unset( \$\_COOKIE\[\'brx_use_wp_login\'\] );

}

}

/\*\*

\* Redirects to the custom login page if it\'s set and valid.

\*/

private function redirect_to_custom_login_page() {

\$selected_login_page_id = Database::get_setting( \'login_page\' );

// Filter for the login page redirect

\$selected_login_page_id = apply_filters(
\'bricks/auth/custom_login_redirect\', \$selected_login_page_id );

\$this-\>redirect_if_valid_page( \$selected_login_page_id );

}

/\*\*

\* Redirects to the custom lost password page if it\'s set and valid.

\*/

private function redirect_to_custom_lost_password_page() {

\$selected_lost_password_page_id = Database::get_setting(
\'lost_password_page\' );

// Filter for the lost password page redirect

\$selected_lost_password_page_id = apply_filters(
\'bricks/auth/custom_lost_password_redirect\',
\$selected_lost_password_page_id );

\$this-\>redirect_if_valid_page( \$selected_lost_password_page_id );

}

/\*\*

\* Redirects to the custom registration page if it\'s set and valid.

\*/

private function redirect_to_custom_registration_page() {

\$selected_registration_page_id = Database::get_setting(
\'registration_page\' );

// Filter for the registration page redirect

\$selected_registration_page_id = apply_filters(
\'bricks/auth/custom_registration_redirect\',
\$selected_registration_page_id );

\$this-\>redirect_if_valid_page( \$selected_registration_page_id );

}

/\*\*

\* Redirects to the custom reset password page if it\'s set and valid.

\*/

private function redirect_to_custom_reset_password_page() {

\$selected_reset_password_page_id = Database::get_setting(
\'reset_password_page\' );

// Filter for the reset password page redirect

\$selected_reset_password_page_id = apply_filters(
\'bricks/auth/custom_reset_password_redirect\',
\$selected_reset_password_page_id );

\$this-\>redirect_if_valid_page( \$selected_reset_password_page_id );

}

/\*\*

\* Helper function to redirect to the provided page if it\'s valid.

\* If the page is not valid, redirects to a default URL if provided.

\*

\* \@param int \$selected_page_id The ID of the page to redirect to.

\*/

private function redirect_if_valid_page( \$selected_page_id ) {

if ( \$this-\>is_custom_page_valid( \$selected_page_id ) ) {

\$custom_url = get_permalink( \$selected_page_id );

// Preserve query parameters

if ( ! empty( \$\_SERVER\[\'QUERY_STRING\'\] ) ) {

\$custom_url = add_query_arg( \$\_GET, \$custom_url );

\$parameters = \$\_GET;

if ( is_array( \$parameters ) ) {

foreach ( \$parameters as \$key =\> \$value ) {

\$parameters\[ \$key \] = Helpers::sanitize_value( \$value );

}

\$custom_url = add_query_arg( \$key, \$value, \$custom_url );

}

}

if ( \$custom_url ) {

wp_safe_redirect( \$custom_url );

exit;

}

}

}

/\*\*

\* Checks if the custom page is valid.

\*

\* \@param int \$page_id

\*

\* \@return bool

\*/

private function is_custom_page_valid( \$page_id ) {

return \$page_id && get_post_status( \$page_id ) === \'publish\';

}

}

api.php\
\
\
\<?php

namespace Bricks;

if ( ! defined( \'ABSPATH\' ) ) exit; // Exit if accessed directly

class Api {

const API_NAMESPACE = \'bricks/v1\';

/\*\*

\* WordPress REST API help docs:

\*

\*
https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-custom-endpoints/

\*
https://developer.wordpress.org/rest-api/extending-the-rest-api/modifying-responses/

\*/

public function \_\_construct() {

add_action( \'rest_api_init\', \[ \$this,
\'rest_api_init_custom_endpoints\' \] );

}

/\*\*

\* Custom REST API endpoints

\*/

public function rest_api_init_custom_endpoints() {

// Server-side render (SSR) for builder elements via window.fetch API
requests

register_rest_route(

self::API_NAMESPACE,

\'render_element\',

\[

\'methods\' =\> \'POST\',

\'callback\' =\> \[ \$this, \'render_element\' \],

\'permission_callback\' =\> \[ \$this,
\'render_element_permissions_check\' \],

\]

);

// Get all templates data (templates, authors, bundles, tags etc.)

register_rest_route(

self::API_NAMESPACE,

\'/get-templates-data/\',

\[

\'methods\' =\> \'GET\',

\'callback\' =\> \[ \$this, \'get_templates_data\' \],

\'permission_callback\' =\> \'\_\_return_true\',

\]

);

register_rest_route(

self::API_NAMESPACE,

\'/get-templates/\',

\[

\'methods\' =\> \'GET\',

\'callback\' =\> \[ \$this, \'get_templates\' \],

\'permission_callback\' =\> \'\_\_return_true\',

\]

);

// Get individual template by ID

register_rest_route(

self::API_NAMESPACE,

\'/get-templates/(?P\<args\>\[a-zA-Z0-9-=&\]+)\',

\[

\'methods\' =\> \'GET\',

\'callback\' =\> \[ \$this, \'get_templates\' \],

\'permission_callback\' =\> \'\_\_return_true\',

\'args\' =\> \[

\'args\' =\> \[

\'required\' =\> true

\],

\],

\]

);

register_rest_route(

self::API_NAMESPACE,

\'/get-template-authors/\',

\[

\'methods\' =\> \'GET\',

\'callback\' =\> \[ \$this, \'get_template_authors\' \],

\'permission_callback\' =\> \'\_\_return_true\',

\]

);

register_rest_route(

self::API_NAMESPACE,

\'/get-template-bundles/\',

\[

\'methods\' =\> \'GET\',

\'callback\' =\> \[ \$this, \'get_template_bundles\' \],

\'permission_callback\' =\> \'\_\_return_true\',

\]

);

register_rest_route(

self::API_NAMESPACE,

\'/get-template-tags/\',

\[

\'methods\' =\> \'GET\',

\'callback\' =\> \[ \$this, \'get_template_tags\' \],

\'permission_callback\' =\> \'\_\_return_true\',

\]

);

/\*\*

\* Query loop: Infinite scroll

\*

\* \@since 1.5

\*/

register_rest_route(

self::API_NAMESPACE,

\'load_query_page\',

\[

\'methods\' =\> \'POST\',

\'callback\' =\> \[ \$this, \'render_query_page\' \],

\'permission_callback\' =\> \[ \$this,
\'render_query_page_permissions_check\' \],

\]

);

/\*\*

\* Ajax Popup

\*

\* \@since 1.9.4

\*/

register_rest_route(

self::API_NAMESPACE,

\'load_popup_content\',

\[

\'methods\' =\> \'POST\',

\'callback\' =\> \[ \$this, \'render_popup_content\' \],

\'permission_callback\' =\> \[ \$this,
\'render_popup_content_permissions_check\' \],

\]

);

/\*\*

\* Query loop: Query result

\*

\* For load more, AJAX pagination, sort, filter, live search.

\*

\* \@since 1.9.6

\*/

register_rest_route(

self::API_NAMESPACE,

\'query_result\',

\[

\'methods\' =\> \'POST\',

\'callback\' =\> \[ \$this, \'render_query_result\' \],

\'permission_callback\' =\> \[ \$this,
\'render_query_result_permissions_check\' \],

\]

);

}

/\*\*

\* Return element HTML retrieved via Fetch API

\*

\* \@since 1.5

\*/

public static function render_element( \$request ) {

\$data = \$request-\>get_json_params();

\$post_id = \$data\[\'postId\'\] ?? false;

\$element = \$data\[\'element\'\] ?? \[\];

\$element_name = \$element\[\'name\'\] ?? \'\';

\$element_settings = \$element\[\'settings\'\] ?? \'\';

if ( \$post_id ) {

Database::set_page_data( \$post_id );

}

// Include WooCommerce frontend classes and hooks to enable the
WooCommerce element preview inside the builder (since 1.5)

if ( Woocommerce::\$is_active ) {

WC()-\>frontend_includes();

Woocommerce_Helpers::maybe_load_cart();

}

// Get rendered element HTML

\$html = Ajax::render_element( \$data );

// Prepare response

\$response = \[ \'html\' =\> \$html \];

// Template element (send template elements to run template element
scripts on the canvas)

if ( \$element_name === \'template\' ) {

\$template_id = \$element_settings\[\'template\'\] ?? false;

if ( \$template_id ) {

\$additional_data = Element_Template::get_builder_call_additional_data(
\$template_id );

\$response = array_merge( \$response, \$additional_data );

}

}

return \[ \'data\' =\> \$response \];

}

/\*\*

\* Element render permission check

\*

\* \@since 1.5

\*/

public function render_element_permissions_check( \$request ) {

\$data = \$request-\>get_json_params();

if ( empty( \$data\[\'postId\'\] ) \|\| empty( \$data\[\'element\'\] )
\|\| empty( \$data\[\'nonce\'\] ) ) {

return new \\WP_Error( \'bricks_api_missing\', \_\_( \'Missing
parameters\' ), \[ \'status\' =\> 400 \] );

}

// Return: Current user can not access builder

if ( Capabilities::current_user_has_no_access() ) {

return new \\WP_Error( \'rest_current_user_can_not_use_builder\', \_\_(
\'Permission error\' ), \[ \'status\' =\> 403 \] );

}

return true;

}

/\*\*

\* Return all templates data in one call (templates, authors, bundles,
tags, theme style)

\*

\* \@param array \$data

\* \@return array

\*

\* \@since 1.0

\*/

public function get_templates_data( \$data ) {

\$templates_args = \$data\[\'args\'\] ?? \[\];

// STEP: Get templates metadata or all data

\$templates = \$this-\>get_templates( \$templates_args );

// STEP: Check for template error

if ( isset( \$templates\[\'error\'\] ) ) {

return \$templates;

}

\$theme_styles = get_option( BRICKS_DB_THEME_STYLES, false );

\$global_classes = get_option( BRICKS_DB_GLOBAL_CLASSES, \[\] );

\$global_variables = get_option( BRICKS_DB_GLOBAL_VARIABLES, \[\] );

// STEP: Add theme style to template data to import when inserting a
template (@since 1.3.2)

foreach ( \$templates as \$index =\> \$template ) {

\$theme_style_id = Theme_Styles::set_active_style( \$template\[\'id\'\],
true );

\$theme_style = \$theme_styles\[ \$theme_style_id \] ?? false;

if ( \$theme_style ) {

// Remove theme style conditions

if ( isset( \$theme_style\[\'settings\'\]\[\'conditions\'\] ) ) {

unset( \$theme_style\[\'settings\'\]\[\'conditions\'\] );

}

\$theme_style\[\'id\'\] = \$theme_style_id;

\$templates\[ \$index \]\[\'themeStyle\'\] = \$theme_style;

}

/\*\*

\* Loop over all template elements to add \'global_classes\' data to
remote template data

\*

\* To import global classes when importing remote template locally.

\*

\* \@since 1.5

\*/

if ( count( \$global_classes ) ) {

\$template_classes = \[\];

\$template_elements = \[\];

if ( ! empty( \$template\[\'content\'\] ) && is_array(
\$template\[\'content\'\] ) ) {

\$template_elements = \$template\[\'content\'\];

} elseif ( ! empty( \$template\[\'header\'\] ) && is_array(
\$template\[\'header\'\] ) ) {

\$template_elements = \$template\[\'header\'\];

} elseif ( ! empty( \$template\[\'footer\'\] ) && is_array(
\$template\[\'footer\'\] ) ) {

\$template_elements = \$template\[\'footer\'\];

}

foreach ( \$template_elements as \$element ) {

if ( ! empty( \$element\[\'settings\'\]\[\'\_cssGlobalClasses\'\] ) ) {

\$template_classes = array_unique( array_merge( \$template_classes,
\$element\[\'settings\'\]\[\'\_cssGlobalClasses\'\] ) );

}

}

if ( count( \$template_classes ) ) {

\$templates\[ \$index \]\[\'global_classes\'\] = \[\];

foreach ( \$template_classes as \$template_class ) {

foreach ( \$global_classes as \$global_class ) {

if ( \$global_class\[\'id\'\] === \$template_class ) {

\$templates\[ \$index \]\[\'global_classes\'\]\[\] = \$global_class;

}

}

}

}

}

}

// Return all templates data

\$templates_data = \[

\'timestamp\' =\> current_time( \'timestamp\' ),

\'date\' =\> current_time( get_option( \'date_format\' ) . \' (\' .
get_option( \'time_format\' ) . \')\' ),

\'templates\' =\> \$templates,

\'authors\' =\> Templates::get_template_authors(),

\'bundles\' =\> Templates::get_template_bundles(),

\'tags\' =\> Templates::get_template_tags(),

\'globalVariables\' =\> \$global_variables, // \@since 1.9.8

\'get\' =\> \$\_GET, // Pass URL params to perform additional checks
(e.g. \'password\' as license key, etc.)

\];

\$templates_data = apply_filters( \'bricks/api/get_templates_data\',
\$templates_data );

// Remove \'get\' data (to avoid storing it in database)

unset( \$templates_data\[\'get\'\] );

return \$templates_data;

}

/\*\*

\* Return templates array OR specific template by array index

\*

\* \@since 1.0

\*

\* \@param array \$data

\*

\* \@return array

\*/

public function get_templates( \$data ) {

\$parameters = \$\_GET;

\$templates_response = Templates::can_get_templates( \$parameters );

// Check for templates error (no site/password etc. provided)

if ( isset( \$templates_response\[\'error\'\] ) ) {

return \$templates_response;

}

\$templates_args = \$data\[\'args\'\] ?? \[\];

// Merge \$parameters with \$templates_response args

\$templates_args = array_merge( \$templates_args, \$templates_response
);

\$templates = Templates::get_templates( \$templates_args );

return \$templates;

}

/\*\*

\* Get API endpoint

\*

\* Use /api to get Bricks Community Templates

\* Default: Use /wp-json (= default WP REST API prefix)

\*

\* \@param string \$endpoint API endpoint.

\* \@param string \$base_url Base URL.

\*

\* \@since 1.0

\*

\* \@return string

\*/

public static function get_endpoint( \$endpoint = \'get-templates\',
\$base_url = BRICKS_REMOTE_URL ) {

\$api_prefix = \$base_url === BRICKS_REMOTE_URL ? \'api\' :
rest_get_url_prefix();

return trailingslashit( \$base_url ) . trailingslashit( \$api_prefix ) .
trailingslashit( self::API_NAMESPACE ) . \$endpoint;

}

/\*\*

\* Get the Bricks REST API url

\*

\* \@since 1.5

\*

\* \@return string

\*/

public static function get_rest_api_url() {

return trailingslashit( get_rest_url( null, \'/\' . self::API_NAMESPACE
) );

}

/\*\*

\* Check if current endpoint is Bricks API endpoint

\*

\* \@param string \$endpoint E.g. \'render_element\' or
\'load_query_page\' for our infinite scroll.

\*

\* \@since 1.8.1

\*

\* \@return bool

\*/

public static function is_current_endpoint( \$endpoint ) {

if ( ! \$endpoint ) {

return false;

}

global \$wp;

// REST route (example: /bricks/v1/load_query_page)

\$current_rest_route = isset( \$wp-\>query_vars\[\'rest_route\'\] ) ?
\$wp-\>query_vars\[\'rest_route\'\] : \'\';

if ( ! \$current_rest_route ) {

return false;

}

// Example: /bricks/v1/load_query_page

\$bricks_rest_route = \'/\' . self::API_NAMESPACE . \'/\' . \$endpoint;

return \$current_rest_route === \$bricks_rest_route;

}

/\*\*

\* Get template authors

\*

\* \@since 1.0

\*

\* \@return array

\*/

public static function get_template_authors() {

return Templates::get_template_authors();

}

/\*\*

\* Get template bundles

\*

\* \@since 1.0

\*

\* \@return array

\*/

public static function get_template_bundles() {

return Templates::get_template_bundles();

}

/\*\*

\* Get template tags

\*

\* \@since 1.0

\*

\* \@return array

\*/

public static function get_template_tags() {

return Templates::get_template_tags();

}

/\*\*

\* Get news feed

\*

\* NOTE: Not in use.

\*

\* \@return array

\*/

public static function get_feed() {

\$remote_base_url = BRICKS_REMOTE_URL;

\$feed_url = trailingslashit( \$remote_base_url ) . trailingslashit(
rest_get_url_prefix() ) . trailingslashit( self::API_NAMESPACE ) .
trailingslashit( \'feed\' );

\$response = Helpers::remote_get( \$feed_url );

if ( is_wp_error( \$response ) ) {

return \[\];

} else {

return json_decode( wp_remote_retrieve_body( \$response ), true );

}

}

/\*\*

\* Query loop: Infinite scroll permissions callback

\*

\* \@since 1.5

\*/

public function render_query_page_permissions_check( \$request ) {

\$data = \$request-\>get_json_params();

if ( empty( \$data\[\'queryElementId\'\] ) \|\| empty(
\$data\[\'nonce\'\] ) \|\| empty( \$data\[\'page\'\] ) ) {

return new \\WP_Error( \'bricks_api_missing\', \_\_( \'Missing
parameters\' ), \[ \'status\' =\> 400 \] );

}

\$result = wp_verify_nonce( \$data\[\'nonce\'\], \'bricks-nonce\' );

if ( \$result === false ) {

return new \\WP_Error( \'rest_cookie_invalid_nonce\', \_\_( \'Bricks
cookie check failed\' ), \[ \'status\' =\> 403 \] );

}

return true;

}

/\*\*

\* Query loop: Infinite scroll callback

\*

\* \@since 1.5

\*/

public function render_query_page( \$request ) {

\$request_data = \$request-\>get_json_params();

\$query_element_id = \$request_data\[\'queryElementId\'\];

\$post_id = \$request_data\[\'postId\'\];

\$page = \$request_data\[\'page\'\];

\$query_vars = json_decode( \$request_data\[\'queryVars\'\], true );

\$language = isset( \$request_data\[\'lang\'\] ) ? sanitize_key(
\$request_data\[\'lang\'\] ) : false;

// Set current language (@since 1.9.9)

if ( \$language ) {

Database::\$page_data\[\'language\'\] = \$language;

}

// Set post_id for use in prepare_query_vars_from_settings

Database::\$page_data\[\'preview_or_post_id\'\] = \$post_id;

\$data = Helpers::get_element_data( \$post_id, \$query_element_id );

if ( empty( \$data\[\'elements\'\] ) ) {

return rest_ensure_response(

\[

\'html\' =\> \'\',

\'styles\' =\> \'\',

\'error\' =\> \'Template data not found\',

\]

);

}

// STEP: Build the flat list index

\$indexed_elements = \[\];

foreach ( \$data\[\'elements\'\] as \$element ) {

\$indexed_elements\[ \$element\[\'id\'\] \] = \$element;

}

if ( ! array_key_exists( \$query_element_id, \$indexed_elements ) ) {

return rest_ensure_response(

\[

\'html\' =\> \'\',

\'styles\' =\> \'\',

\'error\' =\> \'Element not found\',

\]

);

}

// STEP: Set the query element pagination

\$query_element = \$indexed_elements\[ \$query_element_id \];

/\*\*

\* STEP: Use hook to merge query_vars from the request instead of
\'\_merge_vars\' (@pre 1.9.5)

\*

\* Reason: \_merge_vars not in use

\* - not reliable as it is using wp_parse_args(), only merge if the key
is not set

\* - logic only occurs in post query, term and user not supported

\*

\* \@since 1.9.5

\*/

\$object_type =
\$query_element\[\'settings\'\]\[\'query\'\]\[\'objectType\'\] ??
\'post\';

if ( in_array( \$object_type, \[ \'term\', \'user\' \] ) ) {

// Don\'t use request\'s offset, Term and User query offset should be
calculated Query::inside prepare_query_vars_from_settings()

unset( \$query_vars\[\'offset\'\] );

}

// Set the page number which comes from the request

\$query_vars\[\'paged\'\] = \$page;

// Set the page number - This is needed for term query

\$query_element\[\'settings\'\]\[\'query\'\]\[\'paged\'\] = \$page;

add_filter(

\"bricks/{\$object_type}s/query_vars\",

function( \$vars, \$settings, \$element_id ) use ( \$query_element_id,
\$query_vars ) {

if ( \$element_id !== \$query_element_id ) {

return \$vars;

}

// Merge the query vars

\$merged_query_vars = Query::merge_query_vars( \$vars, \$query_vars );

return \$merged_query_vars;

},

10,

3

);

// Remove the parent

if ( ! empty( \$query_element\[\'parent\'\] ) ) {

\$query_element\[\'parent\'\] = 0;

\$query_element\[\'\_noRootClass\'\] = 1;

}

// STEP: Get the query loop elements (main and children)

\$loop_elements = \[ \$query_element \];

\$children = \$query_element\[\'children\'\];

while ( ! empty( \$children ) ) {

\$child_id = array_shift( \$children );

if ( array_key_exists( \$child_id, \$indexed_elements ) ) {

\$loop_elements\[\] = \$indexed_elements\[ \$child_id \];

if ( ! empty( \$indexed_elements\[ \$child_id \]\[\'children\'\] ) ) {

\$children = array_merge( \$children, \$indexed_elements\[ \$child_id
\]\[\'children\'\] );

}

}

}

// Set Theme Styles (for correct preview of query loop nodes)

Theme_Styles::load_set_styles( \$post_id );

// STEP: Generate the styles again to catch dynamic data changes (eg.
background-image)

\$scroll_query_page_id = \"scroll\_{\$query_element_id}\_{\$page}\";

Assets::generate_css_from_elements( \$loop_elements,
\$scroll_query_page_id );

\$inline_css = ! empty( Assets::\$inline_css\[ \$scroll_query_page_id \]
) ? Assets::\$inline_css\[ \$scroll_query_page_id \] : \'\';

// STEP: Render the element after styles are generated as
data-query-loop-index might be inserted through hook in Assets class
(@since 1.7.2)

\$html = Frontend::render_data( \$loop_elements );

// Add popup HTML plus styles (@since 1.7.1)

\$popups = Popups::\$looping_popup_html;

// STEP: Add dynamic data styles after render_data() to catch dynamic
data changes (eg. background-image) (@since 1.8.2)

\$inline_css .= Assets::\$inline_css_dynamic_data;

\$styles = ! empty( \$inline_css ) ? \"\\n\<style\>/\* INFINITE SCROLL
CSS \*/\\n{\$inline_css}\</style\>\\n\" : \'\';

return rest_ensure_response(

\[

\'html\' =\> \$html,

\'styles\' =\> \$styles,

\'popups\' =\> \$popups,

\]

);

}

/\*\*

\* AJAX popup callback

\*

\* \@since 1.9.4

\*/

public function render_popup_content( \$request ) {

\$request_data = \$request-\>get_json_params();

\$post_id = \$request_data\[\'postId\'\] ?? false;

\$popup_id = \$request_data\[\'popupId\'\] ?? false;

\$popup_loop_id = \$request_data\[\'popupLoopId\'\] ?? false;

\$popup_context_id = \$request_data\[\'popupContextId\'\] ?? false;

\$popup_context_type = \$request_data\[\'popupContextType\'\] ?? false;

\$poup_is_looping = \$request_data\[\'isLooping\'\] ?? false;

\$query_element_id = \$request_data\[\'queryElementId\'\] ?? false;

// Get Popup template settings and add classes to the popup content
(@since 1.10.2)

\$popup_settings = Helpers::get_template_settings( \$popup_id );

\$is_woo_quick_view = isset( \$popup_settings\[\'popupIsWoo\'\] ) &&
Woocommerce::is_woocommerce_active();

// Handle WooCommerce Quick View in case no popupContextId has been
defined (@since 1.10.2)

if ( \$is_woo_quick_view && ! \$popup_context_id && \$popup_loop_id ) {

// Retrieve the context from popupLoopId

\$popup_loop_id_parts = explode( \':\', \$popup_loop_id );

if ( count( \$popup_loop_id_parts ) === 4 ) {

\$popup_context_id = \$popup_loop_id_parts\[3\];

\$popup_loop_id = false;

\$query_element_id = false;

}

}

// Set context in AJAX popup (post, term, user)

if ( \$post_id ) {

global \$wp_query;

global \$post;

\$post = get_post( \$post_id );

setup_postdata( \$post );

/\*\*

\* Set necessary global variables so we can use get_queried_object(),
get_the_ID() etc.

\*/

switch ( \$popup_context_type ) {

case \'post\':

if ( \$popup_context_id ) {

// Override the global post

\$post = get_post( \$popup_context_id );

setup_postdata( \$post );

}

\$wp_query-\>queried_object = \$post;

\$wp_query-\>queried_object_id = \$post-\>ID;

\$wp_query-\>is_singular = true;

\$wp_query-\>post_type = \$post-\>post_type;

// Set is_single / is_page, otherwise comments_template wouldn\'t work
(@since 1.10.2)

if ( is_page( \$post-\>ID ) ) {

\$wp_query-\>is_page = true;

} else {

\$wp_query-\>is_single = true;

}

break;

case \'term\':

\$term = get_term( \$popup_context_id ? \$popup_context_id : \$post_id
);

\$wp_query-\>queried_object = get_term( \$popup_context_id ?
\$popup_context_id : \$post_id );

\$wp_query-\>queried_object_id = \$term-\>term_id;

\$wp_query-\>is_tax = true;

break;

case \'user\':

\$user = get_user_by( \'id\', \$popup_context_id ? \$popup_context_id :
\$post_id );

\$wp_query-\>queried_object = \$user;

\$wp_query-\>queried_object_id = \$user-\>ID;

\$wp_query-\>is_author = true;

break;

}

}

/\*\*

\* Default: Current context (query element ID)

\* Re-run the query loop

\* Inaccurate, might be empty if inside a nested loop or repeater

\*/

if ( \$query_element_id ) {

// Set page_data via filter

add_filter(

\'bricks/builder/data_post_id\',

function( \$id ) use ( \$post_id ) {

return \$post_id;

}

);

// Preview ID or post ID is very important in popup as it\'s a template,
so we need to set separately

Database::\$page_data\[\'preview_or_post_id\'\] = \$post_id;

// This popup inside a loop

\$data = Helpers::get_element_data( \$post_id, \$query_element_id );

if ( empty( \$data\[\'elements\'\] ) ) {

return rest_ensure_response(

\[

\'html\' =\> \'\',

\'styles\' =\> \'\',

\'popups\' =\> \[\],

\'error\' =\> esc_html\_\_( \'Popup data not found\', \'bricks\' ),

\]

);

}

// STEP: Build the flat list index

\$indexed_elements = \[\];

foreach ( \$data\[\'elements\'\] as \$element ) {

\$indexed_elements\[ \$element\[\'id\'\] \] = \$element;

}

if ( ! array_key_exists( \$query_element_id, \$indexed_elements ) ) {

return rest_ensure_response(

\[

\'html\' =\> \'\',

\'styles\' =\> \'\',

\'popups\' =\> \[\],

\'error\' =\> esc_html\_\_( \'Element not found\', \'bricks\' ),

\]

);

}

// STEP: Set the query element pagination

\$query_element = \$indexed_elements\[ \$query_element_id \];

// Get the target object ID from popupId string, separated by \':\'

if ( \$popup_loop_id ) {

\$popup_id_parts = explode( \':\', \$popup_loop_id );

if ( count( \$popup_id_parts ) === 4 ) {

\$query_object_type = \$popup_id_parts\[2\];

\$query_object_id = \$popup_id_parts\[3\];

\$new_popup_loop_id = \$popup_loop_id;

switch ( \$query_object_type ) {

case \'post\':

\$query_element\[\'settings\'\]\[\'query\'\]\[\'p\'\] =
\$query_object_id;

\$new_popup_loop_id =
\"{\$query_element_id}:0:{\$query_object_type}:{\$query_object_id}\";

break;

case \'term\':

\$query_element\[\'settings\'\]\[\'query\'\]\[\'include\'\] =
\$query_object_id;

\$new_popup_loop_id =
\"{\$query_element_id}:0:{\$query_object_type}:{\$query_object_id}\";

break;

case \'user\':

\$query_element\[\'settings\'\]\[\'query\'\]\[\'include\'\] =
\$query_object_id;

\$new_popup_loop_id =
\"{\$query_element_id}:0:{\$query_object_type}:{\$query_object_id}\";

break;

default:

case \'unknown\':

// Unable to detect query object type, this is inside repeater\... query
all ?

// \$query_element\[\'settings\'\]\[\'query\'\]\[\'post_per_page\'\] =
-1;

// Return error and indicate not supported

return rest_ensure_response(

\[

\'html\' =\> \'\',

\'styles\' =\> \'\',

\'popups\' =\> \[\],

\'error\' =\> esc_html\_\_( \'Query object type not supported\',
\'bricks\' ),

\]

);

break;

}

}

}

// Remove the parent

if ( ! empty( \$query_element\[\'parent\'\] ) ) {

\$query_element\[\'parent\'\] = 0;

\$query_element\[\'\_noRootClass\'\] = 1;

}

// STEP: Get the query loop elements (main and children)

\$loop_elements = \[ \$query_element \];

\$children = \$query_element\[\'children\'\];

while ( ! empty( \$children ) ) {

\$child_id = array_shift( \$children );

if ( array_key_exists( \$child_id, \$indexed_elements ) ) {

\$loop_elements\[\] = \$indexed_elements\[ \$child_id \];

if ( ! empty( \$indexed_elements\[ \$child_id \]\[\'children\'\] ) ) {

\$children = array_merge( \$children, \$indexed_elements\[ \$child_id
\]\[\'children\'\] );

}

}

}

// Set Theme Styles (for correct preview of query loop nodes)

Theme_Styles::load_set_styles( \$post_id );

// STEP: Generate the styles again to catch dynamic data changes (eg.
background-image)

\$looping_popup_id = \"popup\_{\$query_element_id}\_{\$post_id}\";

Assets::generate_css_from_elements( \$loop_elements, \$looping_popup_id
);

\$inline_css = ! empty( Assets::\$inline_css\[ \$looping_popup_id \] ) ?
Assets::\$inline_css\[ \$looping_popup_id \] : \'\';

Frontend::render_data( \$loop_elements, \'popup\' );

\$popups = Popups::\$ajax_popup_contents;

// Use \$new_popup_loop_id to get popup content

\$popup_content = \$popups\[ \$new_popup_loop_id \]\[ \$popup_id
\]\[\'html\'\] ?? \'\';

// STEP: Add dynamic data styles after render_data() to catch dynamic
data changes (eg. background-image)

\$inline_css .= Assets::\$inline_css_dynamic_data;

\$styles = ! empty( \$inline_css ) ? \"\\n\<style\>/\*AJAX POPUP CSS
\*/\\n{\$inline_css}\</style\>\\n\" : \'\';

}

/\*\*

\* Use user defined context (popupContextId)

\* More reliable than query_element_id way

\*/

else {

// Set page_data via filter

add_filter(

\'bricks/builder/data_post_id\',

function( \$id ) use ( \$post_id, \$popup_context_id ) {

// Use popup_context_id if not false

return \$popup_context_id ? \$popup_context_id : \$post_id;

}

);

// Preview or post id is very important in popup as it\'s a template, so
we need to set separately

Database::\$page_data\[\'preview_or_post_id\'\] = \$popup_context_id ?
\$popup_context_id : \$post_id;

if ( \$poup_is_looping ) {

// Simulate Query::is_looping() as we skipped the query loop

add_filter( \'bricks/query/force_is_looping\', \'\_\_return_true\' );

// Simulate Query::get_loop_index() as we skipped the query loop

add_filter(

\'bricks/query/force_loop_index\',

function( \$index ) {

return 0;

}

);

}

// Get popup via popup ID

\$elements = Database::get_data( \$popup_id );

if ( empty( \$elements ) ) {

return rest_ensure_response(

\[

\'html\' =\> \'\',

\'styles\' =\> \'\',

\'popups\' =\> \[\],

\'error\' =\> esc_html\_\_( \'Popup data not found\', \'bricks\' ),

\]

);

}

// Set active templates

Database::set_active_templates( \$post_id );

// Set Theme Styles (for correct preview of query loop nodes)

Theme_Styles::load_set_styles( \$post_id );

// STEP: Generate the styles again to catch dynamic data changes (eg.
background-image)

\$popup_page_id = \"popup\_{\$post_id}\";

Assets::generate_css_from_elements( \$elements, \$popup_page_id );

\$inline_css = Assets::\$inline_css\[ \$popup_page_id \] ?? \'\';

\$popup_content = Frontend::render_data( \$elements, \'popup\' );

\$inline_css .= Assets::\$inline_css_dynamic_data;

\$styles = ! empty( \$inline_css ) ? \"\\n\<style\>/\* AJAX POPUP CSS
\*/\\n{\$inline_css}\</style\>\\n\" : \'\';

}

\$looping_popup_html = \[\];

if ( ! empty( Popups::\$looping_ajax_popup_ids ) ) {

/\*\*

\* In certain scenario, some popup templates inserted inside a query
loop which is inside another AJAX popup template

\* Generate each looping AJAX popup html holder, we could use this to
add into the DOM if it\'s not there yet

\*/

foreach ( Popups::\$looping_ajax_popup_ids as \$looping_popup_id ) {

\$html = Popups::generate_popup_html( \$looping_popup_id );

\$looping_popup_html\[ \$looping_popup_id \] = \$html;

}

}

\$response = \[

\'html\' =\> \$popup_content,

\'styles\' =\> \$styles,

\'popups\' =\> \$looping_popup_html,

\];

// Add Woo quick view classes so JS can insert into popup content node
(@since 1.10.2)

if ( \$is_woo_quick_view ) {

global \$product;

\$response\[\'contentClasses\'\] = (array) wc_get_product_class( \'\',
\$product );

}

return rest_ensure_response( \$response );

}

/\*\*

\* Ajax Popup permissions callback

\*

\* \@since 1.9.4

\*/

public function render_popup_content_permissions_check( \$request ) {

\$data = \$request-\>get_json_params();

if ( empty( \$data\[\'popupId\'\] ) \|\| empty( \$data\[\'nonce\'\] ) )
{

return new \\WP_Error( \'bricks_api_missing\', \_\_( \'Missing
parameters\' ), \[ \'status\' =\> 400 \] );

}

\$result = wp_verify_nonce( \$data\[\'nonce\'\], \'bricks-nonce\' );

if ( \$result === false ) {

return new \\WP_Error( \'rest_cookie_invalid_nonce\', \_\_( \'Bricks
cookie check failed\' ), \[ \'status\' =\> 403 \] );

}

return true;

}

/\*\*

\* Similar like render_query_page() but for AJAX query result

\*

\* For load more, AJAX pagination, infinite scroll, sort, filter, live
search.

\*

\* \@since 1.9.6

\*/

public function render_query_result( \$request ) {

\$request_data = \$request-\>get_json_params();

\$query_element_id = \$request_data\[\'queryElementId\'\];

\$post_id = \$request_data\[\'postId\'\];

\$filters = \$request_data\[\'filters\'\] ?? \[\];

\$query_vars = \$request_data\[\'queryArgs\'\] ?? \[\];

\$page_filters = \$request_data\[\'pageFilters\'\] ?? \[\];

\$base_url = \$request_data\[\'baseUrl\'\] ?? \'\';

\$page = isset( \$query_vars\[\'paged\'\] ) ? sanitize_text_field(
\$query_vars\[\'paged\'\] ) : 1;

\$language = isset( \$request_data\[\'lang\'\] ) ? sanitize_key(
\$request_data\[\'lang\'\] ) : false;

// Set current language (@since 1.9.9)

if ( \$language ) {

Database::\$page_data\[\'language\'\] = \$language;

}

// Set post_id for use in prepare_query_vars_from_settings

Database::\$page_data\[\'preview_or_post_id\'\] = \$post_id;

\$data = Helpers::get_element_data( \$post_id, \$query_element_id );

if ( empty( \$data\[\'elements\'\] ) ) {

return rest_ensure_response(

\[

\'html\' =\> \'\',

\'styles\' =\> \'\',

\'error\' =\> \'Template data not found\',

\]

);

}

// STEP: Build the flat list index

\$indexed_elements = \[\];

foreach ( \$data\[\'elements\'\] as \$element ) {

\$indexed_elements\[ \$element\[\'id\'\] \] = \$element;

}

if ( ! array_key_exists( \$query_element_id, \$indexed_elements ) ) {

return rest_ensure_response(

\[

\'html\' =\> \'\',

\'styles\' =\> \'\',

\'error\' =\> \'Element not found\',

\]

);

}

// STEP: Set the query element pagination

\$query_element = \$indexed_elements\[ \$query_element_id \];

// TODO: Check if the query_vars are valid, sanitize and validate

// Check if the \$query_element objectType is \'post\' or \'\' (empty)

// Beta only support post query

\$query_object_type = isset(
\$query_element\[\'settings\'\]\[\'query\'\]\[\'objectType\'\] ) ?
sanitize_text_field(
\$query_element\[\'settings\'\]\[\'query\'\]\[\'objectType\'\] ) :
\'post\';

if ( ! in_array( \$query_object_type, \[ \'post\' \] ) ) {

return rest_ensure_response(

\[

\'html\' =\> \'\',

\'styles\' =\> \'\',

\'error\' =\> \'Query object type not supported\',

\]

);

}

// STEP: set page filters

Query_Filters::\$page_filters = \$page_filters;

// STEP: set paged query var if exists

\$query_element\[\'settings\'\]\[\'query\'\]\[\'paged\'\] = \$page;

// STEP: Merge the query vars via filter, so we can override WooCommerce
query vars, queryEditor query vars, etc.

add_filter(

\"bricks/{\$query_object_type}s/query_vars\",

function( \$vars, \$settings, \$element_id ) use ( \$query_vars,
\$query_element_id, &\$query_vars_before_merge ) {

if ( \$element_id !== \$query_element_id ) {

return \$vars;

}

// STEP: save the query vars before merge

Query_Filters::\$query_vars_before_merge\[ \$query_element_id \] =
\$vars;

// STEP: merge the query vars

return Query::merge_query_vars( \$vars, \$query_vars );

},

11,

3

);

// Remove the parent

if ( ! empty( \$query_element\[\'parent\'\] ) ) {

\$query_element\[\'parent\'\] = 0;

\$query_element\[\'\_noRootClass\'\] = 1;

}

// STEP: Get the query loop elements (main and children)

\$loop_elements = \[ \$query_element \];

\$children = \$query_element\[\'children\'\];

while ( ! empty( \$children ) ) {

\$child_id = array_shift( \$children );

if ( array_key_exists( \$child_id, \$indexed_elements ) ) {

\$loop_elements\[\] = \$indexed_elements\[ \$child_id \];

if ( ! empty( \$indexed_elements\[ \$child_id \]\[\'children\'\] ) ) {

\$children = array_merge( \$children, \$indexed_elements\[ \$child_id
\]\[\'children\'\] );

}

}

}

// Set Theme Styles (for correct preview of query loop nodes)

Theme_Styles::load_set_styles( \$post_id );

// STEP: Generate the styles again to catch dynamic data changes (eg.
background-image)

\$query_identifier = \"ajax_query\_{\$query_element_id}\";

Assets::generate_css_from_elements( \$loop_elements, \$query_identifier
);

\$inline_css = ! empty( Assets::\$inline_css\[ \$query_identifier \] ) ?
Assets::\$inline_css\[ \$query_identifier \] : \'\';

// STEP: Render the element after styles are generated as
data-query-loop-index might be inserted through hook in Assets class

\$html = Frontend::render_data( \$loop_elements );

// Add popup HTML plus styles

\$popups = Popups::\$looping_popup_html;

// STEP: Add dynamic data styles after render_data() to catch dynamic
data changes (eg. background-image)

\$inline_css .= Assets::\$inline_css_dynamic_data;

\$styles = ! empty( \$inline_css ) ? \"\\n\<style\>/\* AJAX QUERY RESULT
CSS \*/\\n{\$inline_css}\</style\>\\n\" : \'\';

// STEP: Set the base URL for pagination or the pagination links will be
using API endpoint

if ( ! empty( \$base_url ) ) {

add_filter(

\'bricks/paginate_links_args\',

function( \$args ) use ( \$base_url, \$page ) {

\$args\[\'base\'\] = \$base_url . \'%\_%\';

\$args\[\'current\'\] = \$page;

return \$args;

}

);

}

// STEP: Get updated filters HTML

\$updated_filters = Query_Filters::get_updated_filters( \$filters,
\$post_id );

// STEP: Query data

\$query_data = Query::get_query_by_element_id( \$query_element_id );

// Remove unnecessary properties

unset( \$query_data-\>settings );

unset( \$query_data-\>query_result );

unset( \$query_data-\>loop_index );

unset( \$query_data-\>loop_object );

unset( \$query_data-\>is_looping );

if ( isset( \$query_data-\>query_vars\[\'queryEditor\'\] ) ) {

unset( \$query_data-\>query_vars\[\'queryEditor\'\] );

}

if ( isset( \$query_data-\>query_vars\[\'signature\'\] ) ) {

unset( \$query_data-\>query_vars\[\'signature\'\] );

}

return rest_ensure_response(

\[

\'html\' =\> \$html,

\'styles\' =\> \$styles,

\'popups\' =\> \$popups,

\'updated_filters\' =\> \$updated_filters,

\'updated_query\' =\> \$query_data,

// \'pagination\' =\> \$pagination_html, (#86bxet3c3)

// \'page_filters\' =\> Query_Filters::\$page_filters,

// \'filter_object_ids\' =\> Query_Filters::\$filter_object_ids,

// \'active_filters\' =\> Query_Filters::\$active_filters,

\]

);

}

/\*\*

\* Query loop: Query result permissions callback

\*

\* \@since 1.9.6

\*/

public function render_query_result_permissions_check( \$request ) {

\$data = \$request-\>get_json_params();

if ( empty( \$data\[\'queryElementId\'\] ) \|\| empty(
\$data\[\'nonce\'\] ) ) {

return new \\WP_Error( \'bricks_api_missing\', \_\_( \'Missing
parameters\' ), \[ \'status\' =\> 400 \] );

}

\$result = wp_verify_nonce( \$data\[\'nonce\'\], \'bricks-nonce\' );

if ( \$result === false ) {

return new \\WP_Error( \'rest_cookie_invalid_nonce\', \_\_( \'Bricks
cookie check failed\' ), \[ \'status\' =\> 403 \] );

}

return true;

}

}

database.php\
\
\
\<?php

namespace Bricks;

if ( ! defined( \'ABSPATH\' ) ) exit; // Exit if accessed directly

class Database {

public static \$posts_per_page = 0;

public static \$active_templates = \[

\'header\' =\> 0,

\'footer\' =\> 0,

\'content\' =\> 0,

\'section\' =\> 0, // Use in \"Template\" element

\'archive\' =\> 0,

\'error\' =\> 0,

\'search\' =\> 0,

\'popup\' =\> \[\], // Array with popup template ids

\];

public static \$default_template_types = \[

\'header\',

\'footer\',

\'archive\',

\'search\',

\'error\',

\'wc_archive\',

\'wc_product\',

\'wc_cart\',

\'wc_cart_empty\',

\'wc_form_checkout\',

\'wc_form_pay\',

\'wc_thankyou\',

\'wc_order_receipt\',

// Woo Phase 3

\'wc_account_dashboard\',

\'wc_account_orders\',

\'wc_account_view_order\',

\'wc_account_downloads\',

\'wc_account_addresses\',

\'wc_account_form_edit_address\',

\'wc_account_form_edit_account\',

\'wc_account_form_login\',

\'wc_account_form_lost_password\',

\'wc_account_form_lost_password_confirmation\',

\'wc_account_reset_password\',

\];

public static \$header_position = \'top\';

public static \$global_data = \[\];

public static \$page_data = \[

\'preview_or_post_id\' =\> 0,

\'language\' =\> \'\', // For WPML/Polylang (@since 1.9.9)

\];

public static \$global_settings = \[\];

public static \$page_settings = \[\];

public static \$adobe_fonts = \[\];

public function \_\_construct() {

self::get_global_data();

add_action( \'pre_get_posts\', \[ \$this, \'set_main_archive_query\' \]
);

// Set active templates

add_action( \'wp\', \[ \$this, \'set_active_templates\' \] );

// Set page data (AJAX)

add_action( \'wp_loaded\', \[ \$this, \'set_ajax_page_data\' \] );

// Set page data (no AJAX)

add_action( \'wp\', \[ \$this, \'set_page_data\' \] );

// Set page data on REST API calls

add_action( \'rest_api_init\', \[ \$this, \'set_page_data\' \] );

add_action( \'update_option\_\' . BRICKS_DB_GLOBAL_CLASSES, \[ \$this,
\'update_option_bricks_global_classes\' \], 10, 3 );

add_filter( \'wp_prepare_themes_for_js\', \[ \$this,
\'wp_prepare_themes_for_js\' \] );

}

/\*\*

\* Support autoupdate

\*

\* To always show \"Enable/disable auto-updates\" link for Bricks.

\* Otherwise, link only shows when an update is available.

\*/

public function wp_prepare_themes_for_js( \$prepared_themes ) {

// Add auto update support for Bricks theme

if ( isset(
\$prepared_themes\[\'bricks\'\]\[\'autoupdate\'\]\[\'supported\'\] ) ) {

\$prepared_themes\[\'bricks\'\]\[\'autoupdate\'\]\[\'supported\'\] =
true;

}

return \$prepared_themes;

}

/\*\*

\* Log every save of empty global classes to debug where it\'s coming
from

\*

\* Triggered in Bricks via:

\*

\* ajax.php: wp_ajax_bricks_save_post (save post in builder)

\* templates.php: wp_ajax_bricks_import_template (template import)

\* converter.php: wp_ajax_bricks_run_converter (run converter from
Bricks settings)

\*

\* \@link
https://developer.wordpress.org/reference/hooks/update_option_option/

\*

\* \@since 1.7

\*/

public function update_option_bricks_global_classes( \$old_value,
\$new_value, \$option_name ) {

if ( \$option_name === BRICKS_DB_GLOBAL_CLASSES ) {

\$old_count = is_array( \$old_value ) ? count( \$old_value ) : 0;

\$new_count = is_array( \$new_value ) ? count( \$new_value ) : 0;

// Record only global class saves where total number of global classes
changed

if ( \$old_count !== \$new_count ) {

\$current_user = wp_get_current_user();

// Possible AJAX calls: Save post in builder, import templates, run
converter

\$new_entry = \[

\'timestamp\' =\> time(),

\'referer\' =\> wp_get_referer(),

\'action\' =\> isset( \$\_POST\[\'action\'\] ) ? sanitize_text_field(
\$\_POST\[\'action\'\] ) : \'\',

\'post_id\' =\> isset( \$\_POST\[\'postId\'\] ) ? intval(
\$\_POST\[\'postId\'\] ) : \'\',

\'user_id\' =\> \$current_user ? \$current_user-\>ID : 0,

\'old_count\' =\> \$old_count,

\'new_count\' =\> \$new_count,

\];

\$saves = get_option( \'bricks_global_classes_changes\', \[\] );

if ( ! is_array( \$saves ) ) {

\$saves = \[\];

}

// Keep the first 25 changes

if ( count( \$saves ) \>= 25 ) {

array_shift( \$saves );

}

\$saves\[\] = \$new_entry;

update_option( \'bricks_global_classes_changes\', \$saves, false );

}

}

}

/\*\*

\* Customize WP Main Query: Set all query_vars by user for
archive/search/error template pages

\* So the pagination will not encounter 404 errors

\*

\* \@since 1.9.1

\*/

public function set_main_archive_query( \$query ) {

if ( bricks_is_builder() \|\| is_admin() \|\| !
\$query-\>is_main_query() ) {

return;

}

\$post_id = 0;

\$set_active_templates = \$query-\>is_archive \|\| \$query-\>is_search
\|\| \$query-\>is_error \|\| \$query-\>is_home;

// Archive, Search, Error, Home: Get the active template

if ( \$set_active_templates ) {

// Set active templates

self::set_active_templates( \$query );

// This is the template currently being used for
archive/search/error/home

\$post_id = ! empty( self::\$active_templates\[\'content\'\] ) ?
self::\$active_templates\[\'content\'\] : 0;

}

if ( \$post_id ) {

// Check if any Bricks data is set

\$bricks_data = self::get_data( \$post_id );

// Is home page (posts page): Retrieve the Bricks data too (non-standard
template setup) (@since 1.10)

if ( \$query-\>is_home && \$query-\>get_queried_object_id() ) {

\$bricks_posts_page_data = self::get_data(
\$query-\>get_queried_object_id() );

// Merge the data

if ( is_array( \$bricks_posts_page_data ) ) {

\$bricks_data = array_merge( \$bricks_data, \$bricks_posts_page_data );

}

}

// Start to scan through if any query element is set, main objective is
get the query settings for the main archive query

if ( is_array( \$bricks_data ) ) {

/\*\*

\* STEP: Get nested template data

\*

\* Now \$bricks_data contains all the data from the main template and
all nested templates.

\*

\* \@since 1.9.1

\*/

\$bricks_data = self::get_nested_template_data( \$bricks_data );

/\*\*

\* STEP: Arrange the \$bricks_data array

\*

\* \$bricks_data is not sorted by position following the builder
structure, we do not know which main query settings should be used if
more than 1 query ticked the is_archive_main_query

\*

\* \@since 1.9.1

\*/

\$structured_element_ids = self::elements_sequence_in_builder(
\$bricks_data );

// Loop through elements follow builder structure sequence, to get main
archive query settings defined by the user, only the first one will be
used (@since 1.9.1)

\$archive_query_set = false;

foreach ( \$structured_element_ids as \$element_id ) {

\$element = self::get_element_by_id( \$element_id, \$bricks_data );

if ( ! \$element ) {

continue;

}

// Certain elements \'is_archive_main_query\' is not set inside query
key

if ( isset( \$element\[\'settings\'\]\[\'is_archive_main_query\'\] ) ) {

// WooCommerce Products element

if ( \$element\[\'name\'\] === \'woocommerce-products\' ) {

\$element\[\'settings\'\]\[\'hasLoop\'\] = 1; // #86c01086t; \@since
1.10.2

\$element\[\'settings\'\]\[\'query\'\]\[\'is_archive_main_query\'\] = 1;

\$element\[\'settings\'\]\[\'query\'\]\[\'post_type\'\] = \[ \'product\'
\]; // #86byx62xu

}

}

// Posts element has no \'hasLoop\' key, but it\'s a main query

if ( \$element\[\'name\'\] === \'posts\' && isset(
\$element\[\'settings\'\]\[\'query\'\]\[\'is_archive_main_query\'\] ) )
{

\$element\[\'settings\'\]\[\'hasLoop\'\] = 1; // #86c03k1ut; \@since
1.10.2

}

// Exit: Not a query element

if ( empty( \$element\[\'settings\'\]\[\'query\'\] ) ) {

continue;

}

// Exit: foreach main query is already set once

if ( \$archive_query_set ) {

break;

}

\$object_type = \$element\[\'settings\'\]\[\'query\'\]\[\'objectType\'\]
?? \'post\';

/\*\*

\* Set main archive query

\* - If hasLoop is set (active query) (@since 1.9.9)

\* - If is_archive_main_query is set

\* - If objectType is one of the archive_query_supported_object_types

\*/

if (

isset( \$element\[\'settings\'\]\[\'hasLoop\'\] ) &&

isset(
\$element\[\'settings\'\]\[\'query\'\]\[\'is_archive_main_query\'\] ) &&

in_array( \$object_type, Query::archive_query_supported_object_types() )

) {

// Unique flag to identify main archive query (@since 1.10.2)

\$query-\>set( \'brx_main_query\', true );

// Use the prepared query vars instead of raw element settings (@since
1.8)

\$query_vars = Query::prepare_query_vars_from_settings(
\$element\[\'settings\'\], \$element_id );

// Check if user set offset (@since 1.10.2)

\$has_offset = isset( \$query_vars\[\'offset\'\] ) &&
\$query_vars\[\'offset\'\] \> 0;

foreach ( \$query_vars as \$key =\> \$value ) {

if ( in_array( \$key, Query::archive_query_arguments() ) ) {

// Merge existing tax_query with Bricks tax_query (@since 1.9.8)

if ( \$key === \'tax_query\' ) {

\$current_tax_query = \$query-\>get( \'tax_query\' );

if ( ! empty( \$current_tax_query ) ) {

\$value = Query::merge_tax_or_meta_query_vars( \$current_tax_query,
\$value, \'tax\' );

}

}

// Skip user offset, calculate later

if ( \$has_offset && \$key === \'offset\' ) {

continue;

}

\$query-\>set( \$key, \$value );

}

}

/\*\*

\* Handle offset

\*

\* - Calculate offset based on user offset and current page

\* - Fix found_posts for main query\'s pagination

\*

\* \@since 1.10.2

\*/

if ( \$has_offset ) {

\$user_offset = \$query_vars\[\'offset\'\];

\$new_offset = \$user_offset + ( \$query-\>get( \'paged\', 1 ) - 1 ) \*
\$query-\>get( \'posts_per_page\' );

\$query-\>set( \'offset\', \$new_offset );

add_filter(

\'found_posts\',

function( \$found_posts, \$query ) use ( \$user_offset ) {

if ( bricks_is_builder() \|\| is_admin() \|\| ! \$query-\>get(
\'brx_main_query\' ) ) {

return \$found_posts;

}

return \$found_posts - \$user_offset;

},

10,

2

);

}

/\*\*

\* Handle random seed

\*

\* Generate random seed statement and add to posts_orderby filter and
target the main query

\*

\* \@since 1.9.8

\*/

if ( Query::use_random_seed( \$query_vars ) ) {

\$random_seed_statement = Query::get_random_seed_statement(
\$element_id, \$query_vars );

if ( ! empty( \$random_seed_statement ) ) {

add_filter(

\'posts_orderby\',

function( \$orderby, \$query ) use ( \$random_seed_statement ) {

// Exit if it\'s not main query

if ( bricks_is_builder() \|\| is_admin() \|\| ! \$query-\>get(
\'brx_main_query\' ) ) {

return \$orderby;

}

return \$random_seed_statement;

},

10,

2

);

}

}

// Set flag to exit foreach

\$archive_query_set = true;

}

}

}

}

/\*\*

\* Reset active templates

\*

\* \@see #86bw4pmd0

\* \@since 1.9.2

\*/

if ( \$set_active_templates ) {

self::\$active_templates = \[

\'header\' =\> 0,

\'footer\' =\> 0,

\'content\' =\> 0,

\'section\' =\> 0,

\'archive\' =\> 0,

\'error\' =\> 0,

\'search\' =\> 0,

\'popup\' =\> \[\],

\];

}

}

/\*\*

\* Set active templates for use throughout the theme

\*/

public static function set_active_templates( \$post_id = 0 ) {

// Check if set_active_templates already ran

if ( isset( self::\$active_templates\[\'post_id\'\] ) ) {

return;

}

if ( ! \$post_id \|\| is_object( \$post_id ) ) {

\$post_id = get_the_ID();

}

// NOTE: Set post ID to posts page. Code will try to find templates for
the page defined as the blog page

if ( is_home() ) {

\$post_id = get_option( \'page_for_posts\' );

}

\$post_id = intval( \$post_id );

\$post_type = get_post_type( \$post_id );

\$preview_type = \'\'; // Only applicable to templates

\$content_type = \'content\'; // = default content type

// Check if post is Bricks template

if ( is_singular( BRICKS_DB_TEMPLATE_SLUG ) ) {

\$template_type = get_post_meta( \$post_id, BRICKS_DB_TEMPLATE_TYPE,
true );

if ( in_array( \$template_type, \[ \'header\', \'footer\' \] ) ) {

self::\$active_templates\[ \$template_type \] = \$post_id;

\$preview_type = Helpers::get_template_setting( \'templatePreviewType\',
\$post_id );

switch ( \$preview_type ) {

case \'single\':

\$preview_id = Helpers::get_template_setting( \'templatePreviewPostId\',
\$post_id );

\$content_type = \'content\';

self::\$active_templates\[\'content\'\] = \$preview_id;

break;

case \'search\':

\$content_type = \'search\';

break;

case \'archive-recent-posts\':

case \'archive-author\':

case \'archive-date\':

case \'archive-cpt\':

case \'archive-term\':

\$content_type = \'archive\';

break;

}

} else {

self::\$active_templates\[\'content\'\] = \$post_id;

\$content_type = \$template_type;

}

}

// All other cases (builder & frontend)

else {

// Find content type needed given the current page load query

\$tag_templates = \[

\'is_404\' =\> \'error\',

\'is_search\' =\> \'search\',

\'is_home\' =\> \'content\',

\'is_front_page\' =\> \'content\',

\'is_singular\' =\> \'content\',

\'is_product_taxonomy\' =\> \'wc_archive\',

\'is_post_type_archive\' =\> \'archive\',

\'is_tax\' =\> \'archive\',

\'is_author\' =\> \'archive\',

\'is_date\' =\> \'archive\',

\'is_archive\' =\> \'archive\',

\];

foreach ( \$tag_templates as \$tag =\> \$type ) {

if ( function_exists( \$tag ) && call_user_func( \$tag ) ) {

\$content_type = \$type;

if ( \'content\' != \$type ) {

\$post_type = \'\';

\$post_id = 0;

}

break;

}

}

}

// NOTE: Undocumented

\$content_type = apply_filters( \'bricks/database/content_type\',
\$content_type, \$post_id );

// NOTE: Undocumented

\$post_id = apply_filters( \'bricks/builder/data_post_id\', \$post_id );

self::\$active_templates\[\'post_id\'\] = \$post_id;

self::\$active_templates\[\'post_type\'\] = \$post_type;

self::\$active_templates\[\'content_type\'\] = \$content_type;

// Get all available templates

\$template_ids = self::get_all_templates_by_type();

// Preview id is only set if template is using populate content as
single (with templatePreviewPostId)

\$preview_id = isset( \$preview_id ) ? \$preview_id : \$post_id;

// For each template part, try to find the best template available

foreach ( \[ \'header\', \'footer\', \'content\' \] as \$template_part )
{

if ( ! empty( self::\$active_templates\[ \$template_part \] ) ) {

continue;

}

self::\$active_templates\[ \$template_part \] = self::find_template_id(
\$template_ids, \$template_part, \$content_type, \$preview_id,
\$preview_type );

}

/\*\*

\* Get all popups

\*

\* \@since 1.10.2: If maintenance mode is disabled OR popups are
explicitly enabled in maintenance mode OR user can bypass maintenance
mode.

\*/

if ( ! Maintenance::get_mode() \|\| self::get_setting(
\'maintenanceRenderPopups\' ) \|\|
Capabilities::current_user_can_bypass_maintenance_mode() ) {

self::\$active_templates\[\'popup\'\] = self::find_templates(
\$template_ids, \'popup\', \$preview_id, \$preview_type );

}

// Ensure popup being previewed is included

if ( Templates::get_template_type( \$post_id ) === \'popup\' && !
in_array( \$post_id, self::\$active_templates\[\'popup\'\] ) ) {

self::\$active_templates\[\'popup\'\]\[\] = \$post_id;

}

// If \$content_type != header, footer, content, section, popup; set
\$active_template = content

if ( isset( \$content_type ) && ! in_array( \$content_type, \[
\'header\', \'footer\', \'section\', \'content\', \'popup\' \] ) ) {

self::\$active_templates\[ \$content_type \] =
self::\$active_templates\[\'content\'\];

}

// No templates defined, set page/cpt content if Bricks is supported

if ( ! empty( \$post_id ) && Helpers::is_post_type_supported( \$post_id
) && empty( self::\$active_templates\[\'content\'\] ) ) {

self::\$active_templates\[\'content\'\] = \$post_id;

}

/\*\*

\* Allow to modify the active templates

\*

\* \@see
https://academy.bricksbuilder.io/article/filter-bricks-active_templates/

\*

\* \@since 1.8.4

\*/

self::\$active_templates = apply_filters( \'bricks/active_templates\',
self::\$active_templates, \$post_id,
self::\$active_templates\[\'content_type\'\] );

// Set header position (to use in bricksData.headerPosition)

if ( self::\$active_templates\[\'header\'\] \> 0 ) {

\$header_position = Helpers::get_template_setting( \'headerPosition\',
intval( self::\$active_templates\[\'header\'\] ) );

self::\$header_position = isset( \$header_position ) && ! empty(
\$header_position ) ? \$header_position : \'top\';

}

}

/\*\*

\* Finds the most suitable template id for a specific context

\*

\* \@param array \$template_ids Organized by type.

\* \@param string \$template_part header, footer or content.

\* \@param string \$content_type What type of content is expected:
content, archive, search, error.

\* \@param string \$post_id Current post_id or preview_id.

\* \@param string \$preview_type If template, and populate content is
set.

\*/

public static function find_template_id( \$template_ids,
\$template_part, \$content_type, \$post_id, \$preview_type ) {

\$found_templates = \[\]; // Hold all the found template ids for the
context, with score 0.low XX.high \[score=\>template id\]

\$disable_default_templates = self::get_setting(
\'defaultTemplatesDisabled\', false );

\$post_type = get_post_type( \$post_id );

// Loop for all the templates and template conditions and assign scores

// 0 - Default (no condition set)

// 1 - Default to a specific template type (I\'m looking for a search
template, and this is type search)

// 2 - Entire website (condition = any)

// 8 - Terms, specific archives, children of specific Post ID

// 9 - Front page

// 10 - Specific Post ID (best match)

// \'body\' list includes all template types != header, footer, section
& popup

\$template_loop_type = \$template_part === \'content\' ? \'body\' :
\$template_part;

if ( empty( \$template_ids\[ \$template_loop_type \] ) ) {

return 0;

}

// Check template conditions

foreach ( \$template_ids\[ \$template_loop_type \] as \$template_id ) {

\$template_conditions = Helpers::get_template_setting(
\'templateConditions\', \$template_id );

if ( ! \$template_conditions ) {

if ( ! \$disable_default_templates ) {

// No conditions, if defaults are possible, set it as default (but
don\'t set a Search template as fallback of a Page content)

if ( in_array( \$template_part, \[ \'header\', \'footer\' \] ) ) {

\$found_templates\[0\] = \$template_id;

}

// If template_part is content, and this template type = content_type
(search = search) then it might be a good default

if ( \'content\' === \$template_part && \'content\' !== \$content_type
&& ! empty( \$template_ids\[ \$content_type \] ) && in_array(
\$template_id, \$template_ids\[ \$content_type \] ) ) {

\$found_templates\[1\] = \$template_id;

}

}

continue;

}

\$found_templates = self::screen_conditions( \$found_templates,
\$template_id, \$template_conditions, \$post_id, \$preview_type );

}

// Return template id with highest score.

if ( ! empty( \$found_templates ) ) {

\$max = max( array_keys( \$found_templates ) );

return \$found_templates\[ \$max \];

}

// No template found

return 0;

}

/\*\*

\* Find all the templates available for a specific context based on the
template conditions

\*

\* \@param array \$template_ids List of templates per template type.

\* \@param string \$template_part header, footer or content.

\*/

public static function find_templates( \$template_ids, \$template_part,
\$post_id, \$preview_type ) {

\$found_templates = \[\];

\$template_loop_type = \$template_part === \'content\' ? \'body\' :
\$template_part;

if ( empty( \$template_ids\[ \$template_loop_type \] ) ) {

return \[\];

}

// Check template conditions

foreach ( \$template_ids\[ \$template_loop_type \] as \$template_id ) {

\$template_conditions = Helpers::get_template_setting(
\'templateConditions\', \$template_id );

\$found = self::screen_conditions( \[\], \$template_id,
\$template_conditions, \$post_id, \$preview_type );

if ( ! empty( \$found ) ) {

\$found_templates\[\] = \$template_id;

}

}

return \$found_templates;

}

/\*\*

\* Undocumented function

\*/

public static function get_all_templates_by_type() {

// Last changed timestamp is set on Templates::flush_templates_cache()

\$last_changed = wp_cache_get_last_changed( \'bricks\_\' .
BRICKS_DB_TEMPLATE_SLUG );

// \@since 1.7.1 - Prefix cache key with get_locale() to ensure correct
templates are loaded for different languages (@see #862jdhqgr)

\$cache_key = get_locale() . \'\_all_templates\_\' . \$last_changed;

\$output = wp_cache_get( \$cache_key, \'bricks\' );

if ( \$output === false ) {

\$args = \[

\'post_type\' =\> BRICKS_DB_TEMPLATE_SLUG,

\'posts_per_page\' =\> -1,

\'meta_query\' =\> \[

\[

\'key\' =\> BRICKS_DB_TEMPLATE_TYPE,

\'compare\' =\> \'EXISTS\',

\],

\],

\'post_status\' =\> \'publish\',

\'fields\' =\> \'ids\',

\];

/\*\*

\* Filter query args for get_posts()

\*

\* Currently used by WPML to get correct templates (@see #862j3xyg7)

\*

\* \@since 1.7

\*/

\$args = apply_filters(
\'bricks/database/bricks_get_all_templates_by_type_args\', \$args );

\$template_ids = get_posts( \$args );

\$output = \[\];

// Organize templates by type

foreach ( \$template_ids as \$t_id ) {

\$type = get_post_meta( \$t_id, BRICKS_DB_TEMPLATE_TYPE, true );

\$output\[ \$type \]\[\] = \$t_id;

if ( ! in_array( \$type, \[ \'header\', \'footer\', \'section\',
\'popup\' \] ) ) {

\$output\[\'body\'\]\[\] = \$t_id; // Adds to the \'body\' template type
all the other types like Content, Archive, Search Results, Error Page as
they are a kind of body content

}

}

wp_cache_set( \$cache_key, \$output, \'bricks\', DAY_IN_SECONDS );

}

return \$output;

}

/\*\*

\* Set default header/footer template

\*

\* If no template with matching templateCondition(s) has been set.

\*

\* Can be disabled via admin setting \'defaultTemplatesDisabled\'.

\*

\* \@since 1.0

\*/

public static function set_default_template( \$template_type = \'\' ) {

if ( ! \$template_type ) {

return;

}

\$disable_default_templates = self::get_setting(
\'defaultTemplatesDisabled\', false );

// Return if \'defaultTemplatesDisabled\' is set

\$current_template_type = get_post_meta( get_the_ID(),
BRICKS_DB_TEMPLATE_TYPE, true );

if ( \$disable_default_templates && \$current_template_type !==
\$template_type ) {

return;

}

\$template_ids = get_posts(

\[

\'post_type\' =\> BRICKS_DB_TEMPLATE_SLUG,

\'posts_per_page\' =\> -1,

\'meta_query\' =\> \[

\[

\'key\' =\> BRICKS_DB_TEMPLATE_TYPE,

\'value\' =\> \$template_type,

\],

\],

\'post_status\' =\> \'publish\',

\'fields\' =\> \'ids\',

\]

);

\$template_id = count( \$template_ids ) ? \$template_ids\[0\] : false;

if ( \$template_id ) {

self::\$active_templates\[ \$template_type \] = intval( \$template_id );

}

}

/\*\*

\* Helper function to screen a set of template or theme style conditions
and check if they apply given the context

\*

\* \@param array \$found Holds array of found object IDs (the key is the
score).

\* \@param string \$object_id Could be template_id or the style_id.

\* \@param array \$conditions Template or Theme Style conditions.

\* \@param int \$post_id Real or Preview).

\* \@param string \$preview_type The preview type (single, search,
archive, etc.).

\*

\* \@return array Found conditions array (\$score =\> \$object_id)

\*/

public static function screen_conditions( \$found, \$object_id,
\$conditions, \$post_id, \$preview_type ) {

if ( empty( \$conditions ) ) {

return \$found;

}

\$post_type = get_post_type( \$post_id );

\$is_valid = true; // Used to exclude this object if an excluding
condition applies

\$scores = \[\]; // Holds scores of this object_id

foreach ( \$conditions as \$condition ) {

if ( ! \$is_valid ) {

break;

}

// Check if main template condition is set

if ( ! isset( \$condition\[\'main\'\] ) ) {

continue;

}

\$exclude = isset( \$condition\[\'exclude\'\] );

if ( ! empty( \$post_id ) ) {

// 1. Check if template was set for a specific post ID or children

if ( \$condition\[\'main\'\] === \'ids\' && isset(
\$condition\[\'ids\'\] ) ) {

// Specific post ID

if ( in_array( \$post_id, \$condition\[\'ids\'\] ) ) {

\$is_valid = ! \$exclude;

\$scores\[\] = 10;

}

// Apply to child pages

elseif ( isset( \$condition\[\'idsIncludeChildren\'\] ) ) {

\$ancestors = get_post_ancestors( \$post_id );

foreach ( \$ancestors as \$ancestor_id ) {

if ( in_array( \$ancestor_id, \$condition\[\'ids\'\] ) ) {

\$is_valid = ! \$exclude;

\$scores\[\] = 8; // Less important than a template set for a specific
ID

break;

}

}

}

}

// 2. Check if template was set for a specific term assigned to the post

if ( \$condition\[\'main\'\] === \'terms\' && isset(
\$condition\[\'terms\'\] ) ) {

\$terms = \$condition\[\'terms\'\];

foreach ( \$terms as \$term ) {

\$tax_term = explode( \'::\', \$term );

\$taxonomy = \$tax_term\[0\];

\$term = \$tax_term\[1\];

\$post_terms = wp_get_post_terms( \$post_id, \$taxonomy, \[ \'fields\'
=\> \'ids\' \] );

if ( is_array( \$post_terms ) && in_array( \$term, \$post_terms ) ) {

\$is_valid = ! \$exclude;

\$scores\[\] = 8;

}

}

}

// 3. Check if template applies to a specific post type

if ( \$condition\[\'main\'\] === \'postType\' && isset(
\$condition\[\'postType\'\] ) && in_array( \$post_type,
\$condition\[\'postType\'\] ) ) {

\$is_valid = ! \$exclude;

\$scores\[\] = 7;

}

}

// Archive (any/author/data/term)

if ( is_archive() && \$condition\[\'main\'\] === \'archiveType\' ) {

if ( ! isset( \$condition\[\'archiveType\'\] ) ) {

continue;

}

// Archive pages include category, tag, author, date, custom post type,
and custom taxonomy based archives.

if ( in_array( \'any\', \$condition\[\'archiveType\'\] ) && (
is_archive() \|\| strpos( \$preview_type, \'archive\' ) !== false ) ) {

\$is_valid = ! \$exclude;

\$scores\[\] = 3;

}

// This condition allows for multiple values. Since is_archive includes
all the following conditions we need to test them as well

if ( in_array( \'postType\', \$condition\[\'archiveType\'\] ) && (
is_post_type_archive() \|\| \$preview_type === \'archive-cpt\' ) ) {

if ( empty( \$condition\[\'archivePostTypes\'\] ) ) {

\$is_valid = ! \$exclude;

\$scores\[\] = 7;

} else {

// Previewing a template with content set to a CPT archive

if ( \$preview_type === \'archive-cpt\' ) {

\$preview_cpt = Helpers::get_template_setting(
\'templatePreviewPostType\', \$post_id );

if ( \$preview_cpt && in_array( \$preview_cpt,
\$condition\[\'archivePostTypes\'\] ) ) {

\$is_valid = ! \$exclude;

\$scores\[\] = 8;

}

}

// or, check if the post type archive matches the post type condition

elseif ( is_post_type_archive( \$condition\[\'archivePostTypes\'\] ) ) {

\$is_valid = ! \$exclude;

\$scores\[\] = 8;

}

}

} elseif ( in_array( \'author\', \$condition\[\'archiveType\'\] ) && (
is_author() \|\| \$preview_type === \'archive-author\' ) ) {

\$is_valid = ! \$exclude;

\$scores\[\] = 8;

} elseif ( in_array( \'date\', \$condition\[\'archiveType\'\] ) && (
is_date() \|\| \$preview_type === \'archive-date\' ) ) {

\$is_valid = ! \$exclude;

\$scores\[\] = 8;

} elseif ( in_array( \'term\', \$condition\[\'archiveType\'\] ) && (
is_category() \|\| is_tag() \|\| is_tax() \|\| \$preview_type ===
\'archive-term\' ) ) {

// Apply template to selected archive terms

if ( isset( \$condition\[\'archiveTerms\'\] ) && is_array(
\$condition\[\'archiveTerms\'\] ) ) {

// Previewing a template, with populate content set to archive of term

if ( \$preview_type === \'archive-term\' ) {

// Note the post_id here is the template post Id (because in this
archive situation the preview_id was not set)

\$preview_term = Helpers::get_template_setting( \'templatePreviewTerm\',
\$post_id );

if ( ! empty( \$preview_term ) ) {

\$preview_term = explode( \'::\', \$preview_term );

\$queried_taxonomy = isset( \$preview_term\[0\] ) ? \$preview_term\[0\]
: \'\';

\$queried_term_id = isset( \$preview_term\[1\] ) ? intval(
\$preview_term\[1\] ) : \'\';

}

}

// All the other situations in frontend: is_category() \|\| is_tag()
\|\| is_tax()

else {

\$queried_object = get_queried_object();

if ( is_object( \$queried_object ) ) {

\$queried_term_id = intval( \$queried_object-\>term_id );

\$queried_taxonomy = \$queried_object-\>taxonomy;

}

}

// Check if queried taxonomy and term_id matches any of the selected
archive terms

if ( ! empty( \$queried_term_id ) && ! empty( \$queried_taxonomy ) ) {

foreach ( \$condition\[\'archiveTerms\'\] as \$archive_term ) {

\$term_parts = explode( \'::\', \$archive_term );

\$taxonomy = \$term_parts\[0\];

\$term_id = \$term_parts\[1\];

if ( \$queried_taxonomy === \$taxonomy ) {

if ( \$queried_term_id === intval( \$term_id ) ) {

\$is_valid = ! \$exclude;

\$scores\[\] = 8;

break;

}

// Applied for taxonomy::all (all terms of a taxonomy)

elseif ( \'all\' == \$term_id ) {

\$is_valid = ! \$exclude;

\$scores\[\] = 7;

break;

}

// The condition includes child terms, check if the queried term id is
child of the term id set in the condition

elseif ( isset( \$condition\[\'archiveTermsIncludeChildren\'\] ) &&
term_is_ancestor_of( \$term_id, \$queried_term_id, \$queried_taxonomy )
) {

\$is_valid = ! \$exclude;

\$scores\[\] = 8;

break;

}

}

}

}

}

// Apply template to all archives terms

else {

\$is_valid = ! \$exclude;

\$scores\[\] = 4;

}

}

} // End archive test

// Check for search

elseif ( \$condition\[\'main\'\] === \'search\' && ( is_search() \|\|
\$preview_type === \'search\' ) ) {

\$is_valid = ! \$exclude;

\$scores\[\] = 8;

}

// Check for error

elseif ( \$condition\[\'main\'\] === \'error\' && ( is_404() \|\|
\$preview_type === \'error\' ) ) {

\$is_valid = ! \$exclude;

\$scores\[\] = 8;

}

// Check for front page (it might compete with single post rules)

if ( \$condition\[\'main\'\] === \'frontpage\' ) {

// \@since 1.7 - Only use \'page_on_front\' option if we are in an AJAX
calls (@see #862j4ay8x)

if ( bricks_is_ajax_call() \|\| bricks_is_rest_call() ) {

// Use \'page_on_front\' option as is_front_page() is not reliable in
AJAX calls (@see #861m42jdb)

\$front_page_id = get_option( \'page_on_front\' );

\$is_front_page = absint( \$post_id ) == absint( \$front_page_id );

} else {

\$is_front_page = is_front_page();

}

if ( \$is_front_page ) {

\$is_valid = ! \$exclude;

\$scores\[\] = 9;

}

}

// Check for entire website

if ( \$condition\[\'main\'\] === \'any\' ) {

\$is_valid = ! \$exclude;

\$scores\[\] = 2;

}

/\*\*

\* For each template (and theme style) condition allow setting a score
based on custom template conditions (which are set via:
builder/settings/{\$this-\>setting_type}/controls_data)

\*

\*
https://academy.bricksbuilder.io/article/filter-bricks-screen_conditions-scores/

\*

\* \@since 1.5.5

\*/

\$scores = apply_filters( \'bricks/screen_conditions/scores\', \$scores,
\$condition, \$post_id, \$preview_type );

}

if ( \$is_valid ) {

\$scores = array_unique( \$scores );

foreach ( \$scores as \$score ) {

\$found\[ \$score \] = \$object_id;

}

}

return \$found;

}

/\*\*

\* Check if header or footer is disabled (via page settings) for the
current context

\*

\* Page setting keys: headerDisabled, footerDisabled

\*

\* \@return bool

\* \@since 1.5.4

\*/

public static function is_template_disabled( \$template_type ) {

\$setting_key = \"{\$template_type}Disabled\";

\$original_post_id = self::\$page_data\[\'original_post_id\'\] ?? 0;

// Return: Previewing header or footer template

if ( \$original_post_id && Templates::get_template_type(
\$original_post_id ) === \$template_type ) {

return false;

}

\$template_id = self::\$active_templates\[\'content\'\] ?? 0;

/\*\*

\* Post rendered through template and post has Bricks data: Get page
settings from post instead of template

\*

\* \@since 1.10.2: Exclude archive pages as they can\'t by edited
directly with Bricks

\*/

if ( \$template_id && \$template_id !== \$original_post_id && !
is_archive() ) {

\$page_settings = get_post_meta( \$original_post_id,
BRICKS_DB_PAGE_SETTINGS, true );

if ( isset( \$page_settings\[ \$setting_key \] ) ) {

return true;

}

}

return isset( self::\$page_settings\[ \$setting_key \] );

}

/\*\*

\* Get template elements

\*

\* \@since 1.0

\*/

public static function get_template_data( \$content_type ) {

switch ( \$content_type ) {

case \'header\':

if ( self::is_template_disabled( \'header\' ) ) {

return;

}

\$meta_key = BRICKS_DB_PAGE_HEADER;

break;

case \'footer\':

if ( self::is_template_disabled( \'footer\' ) ) {

return;

}

\$meta_key = BRICKS_DB_PAGE_FOOTER;

break;

default:

\$meta_key = BRICKS_DB_PAGE_CONTENT;

break;

}

\$template_id = self::\$active_templates\[ \$content_type \] ?? false;

// No template found: Return Bricks content data

if (

! is_archive() &&

! is_search() &&

! \$template_id &&

\$content_type !== \'header\' &&

\$content_type !== \'footer\'

) {

\$data = get_post_meta( get_the_ID(), BRICKS_DB_PAGE_CONTENT, true );

return \$data;

}

\$data = get_post_meta( \$template_id, \$meta_key, true );

return \$data;

}

/\*\*

\* Get Bricks data by post_id and content_area (header/content/footer)

\*

\* \@since 1.0

\*/

public static function get_data( \$post_id = 0, \$content_area = \'\' )
{

if ( ! \$post_id ) {

\$post_id = get_the_ID();

}

\$meta_key = self::get_bricks_data_key( \$content_area );

\$elements = get_post_meta( \$post_id, \$meta_key, true );

return is_array( \$elements ) ? \$elements : \[\];

}

/\*\*

\* Get the Bricks data key for a specific template type
(header/content/footer)

\*

\* \@since 1.5.1

\*

\* \@param string \$content_area

\* \@return string

\*/

public static function get_bricks_data_key( \$content_area = \'\' ) {

switch ( \$content_area ) {

case \'header\':

\$meta_key = BRICKS_DB_PAGE_HEADER;

break;

case \'footer\':

\$meta_key = BRICKS_DB_PAGE_FOOTER;

break;

default:

\$meta_key = BRICKS_DB_PAGE_CONTENT;

break;

}

return \$meta_key;

}

/\*\*

\* Get global settings from options table

\*

\* \@since 1.0

\*/

public static function get_setting( \$key, \$default = false ) {

return isset( self::\$global_settings\[ \$key \] ) ?
self::\$global_settings\[ \$key \] : \$default;

}

/\*\*

\* Get global data from options table

\*

\* \@since 1.0

\*/

public static function get_global_data() {

// Color palette

if ( is_multisite() && BRICKS_MULTISITE_USE_MAIN_SITE_COLOR_PALETTE ) {

self::\$global_data\[\'colorPalette\'\] = get_blog_option(
get_main_site_id(), BRICKS_DB_COLOR_PALETTE, \[\] );

} else {

self::\$global_data\[\'colorPalette\'\] = get_option(
BRICKS_DB_COLOR_PALETTE, \[\] );

}

// Global classes

if ( is_multisite() && BRICKS_MULTISITE_USE_MAIN_SITE_CLASSES ) {

self::\$global_data\[\'globalClasses\'\] = get_blog_option(
get_main_site_id(), BRICKS_DB_GLOBAL_CLASSES, \[\] );

} else {

self::\$global_data\[\'globalClasses\'\] = get_option(
BRICKS_DB_GLOBAL_CLASSES, \[\] );

}

// Global classes categories

if ( is_multisite() && BRICKS_MULTISITE_USE_MAIN_SITE_CLASSES_CATEGORIES
) {

self::\$global_data\[\'globalClassesCategories\'\] = get_blog_option(
get_main_site_id(), BRICKS_DB_GLOBAL_CLASSES_CATEGORIES, \[\] );

} else {

self::\$global_data\[\'globalClassesCategories\'\] = get_option(
BRICKS_DB_GLOBAL_CLASSES_CATEGORIES, \[\] );

}

// Builder: Global classes locked

if ( bricks_is_builder() ) {

if ( is_multisite() && BRICKS_MULTISITE_USE_MAIN_SITE_CLASSES ) {

self::\$global_data\[\'globalClassesLocked\'\] = get_blog_option(
get_main_site_id(), BRICKS_DB_GLOBAL_CLASSES_LOCKED, \[\] );

} else {

self::\$global_data\[\'globalClassesLocked\'\] = get_option(
BRICKS_DB_GLOBAL_CLASSES_LOCKED, \[\] );

}

}

// Builder: Global classes timestamp (@since 1.9.9)

if ( bricks_is_builder() ) {

if ( is_multisite() && BRICKS_MULTISITE_USE_MAIN_SITE_CLASSES ) {

self::\$global_data\[\'globalClassesTimestamp\'\] = get_blog_option(
get_main_site_id(), BRICKS_DB_GLOBAL_CLASSES_TIMESTAMP, \[\] );

} else {

self::\$global_data\[\'globalClassesTimestamp\'\] = get_option(
BRICKS_DB_GLOBAL_CLASSES_TIMESTAMP, \[\] );

}

}

// Builder: Global classes user_id (@since 1.9.9)

if ( bricks_is_builder() ) {

if ( is_multisite() && BRICKS_MULTISITE_USE_MAIN_SITE_CLASSES ) {

self::\$global_data\[\'globalClassesUser\'\] = get_blog_option(
get_main_site_id(), BRICKS_DB_GLOBAL_CLASSES_USER, \[\] );

} else {

self::\$global_data\[\'globalClassesUser\'\] = get_option(
BRICKS_DB_GLOBAL_CLASSES_USER, \[\] );

}

if ( ! empty( self::\$global_data\[\'globalClassesUser\'\] ) ) {

self::\$global_data\[\'globalClassesUser\'\] = get_userdata(
self::\$global_data\[\'globalClassesUser\'\] )-\>display_name ?? \'\';

}

}

\$default_pseudo_classes = \[

\':hover\',

\':active\',

\':focus\',

\];

if ( is_multisite() && BRICKS_MULTISITE_USE_MAIN_SITE_CLASSES ) {

self::\$global_data\[\'pseudoClasses\'\] = get_blog_option(
get_main_site_id(), BRICKS_DB_PSEUDO_CLASSES, \$default_pseudo_classes
);

} else {

self::\$global_data\[\'pseudoClasses\'\] = get_option(
BRICKS_DB_PSEUDO_CLASSES, \$default_pseudo_classes );

}

// Global elements

if ( is_multisite() && BRICKS_MULTISITE_USE_MAIN_SITE_GLOBAL_ELEMENTS )
{

self::\$global_data\[\'elements\'\] = get_blog_option(
get_main_site_id(), BRICKS_DB_GLOBAL_ELEMENTS, \[\] );

} else {

self::\$global_data\[\'elements\'\] = get_option(
BRICKS_DB_GLOBAL_ELEMENTS, \[\] );

}

// Global settings

self::\$global_data\[\'settings\'\] = get_option(
BRICKS_DB_GLOBAL_SETTINGS, \[\] );

// Remove slashes from custom CSS & JS

if ( is_array( self::\$global_data\[\'settings\'\] ) ) {

self::\$global_data\[\'settings\'\] = stripslashes_deep(
self::\$global_data\[\'settings\'\] );

}

// Set global gettings

self::\$global_settings = self::\$global_data\[\'settings\'\];

/\*\*

\* Disable lazy load in builder

\*

\* To generate template screenshots in builder.

\*

\* \@since 1.10

\*/

if ( bricks_is_builder_call() ) {

self::\$global_settings\[\'disableLazyLoad\'\] = true;

}

// Global variables, if not disable in Bricks settings (since 1.9.8)

if ( ! isset( self::\$global_settings\[\'disableVariablesManager\'\] ) )
{

if ( is_multisite() &&
BRICKS_MULTISITE_USE_MAIN_SITE_VARIABLES_CATEGORIES ) {

self::\$global_data\[\'globalVariables\'\] = get_blog_option(
get_main_site_id(), BRICKS_DB_GLOBAL_VARIABLES, \[\] );

} else {

self::\$global_data\[\'globalVariables\'\] = get_option(
BRICKS_DB_GLOBAL_VARIABLES, \[\] );

}

}

// Global variables categories (since 1.9.8)

if ( is_multisite() &&
BRICKS_MULTISITE_USE_MAIN_SITE_VARIABLES_CATEGORIES ) {

self::\$global_data\[\'globalVariablesCategories\'\] = get_blog_option(
get_main_site_id(), BRICKS_DB_GLOBAL_VARIABLES_CATEGORIES, \[\] );

} else {

self::\$global_data\[\'globalVariablesCategories\'\] = get_option(
BRICKS_DB_GLOBAL_VARIABLES_CATEGORIES, \[\] );

}

// Adobe fonts: If project ID set (@since 1.7.1)

if ( ! empty( self::\$global_settings\[\'adobeFontsProjectId\'\] ) ) {

self::\$adobe_fonts = get_option( BRICKS_DB_ADOBE_FONTS, \[\] );

}

}

/\*\*

\* Set page data needed for AJAX calls (builder)

\*

\* \@since 1.3

\*/

public static function set_ajax_page_data() {

if (

! bricks_is_ajax_call() \|\|

empty( \$\_POST\[\'action\'\] ) \|\|

strpos( \$\_POST\[\'action\'\], \'bricks\_\' ) !== 0

) {

return;

}

// In the \"bricks_regenerate_css_file\" ajax call, the post ID is set
in the \"data\" property

\$post_id = isset( \$\_POST\[\'postId\'\] ) ? intval(
\$\_POST\[\'postId\'\] ) : ( isset( \$\_POST\[\'data\'\] ) &&
is_numeric( \$\_POST\[\'data\'\] ) ? intval( \$\_POST\[\'data\'\] ) : 0
);

self::\$page_data\[\'original_post_id\'\] = \$post_id;

self::\$page_data\[\'post_id\'\] = \$post_id;

/\*\*

\* Set current page type

\*

\* Currently in AJAX calls set it to empty string (can be improved in
the future).

\*

\* \@since 1.8

\*/

self::\$page_data\[\'current_page_type\'\] = \'\';

// Check for template preview post ID

\$template_preview_post_id = Helpers::get_template_setting(
\'templatePreviewPostId\', \$post_id );

self::\$page_data\[\'preview_or_post_id\'\] = empty(
\$template_preview_post_id ) ? \$post_id : \$template_preview_post_id;

/\*\*

\* Set current page type if the this is bricks template

\*

\* Helpers::is_bricks_template() and Helpers::get_queried_object() rely
on this.

\*

\* \@since 1.9.5

\*/

if ( Helpers::is_bricks_preview() && get_post_type( \$post_id ) ===
BRICKS_DB_TEMPLATE_SLUG ) {

self::\$page_data\[\'current_page_type\'\] = \'post\';

}

}

/\*\*

\* Get page data from post meta

\*

\* \@since 1.0

\*/

public static function set_page_data( \$post_id = 0 ) {

if ( ! \$post_id \|\| is_object( \$post_id ) ) {

\$post_id = get_the_ID();

}

/\*\*

\* Frontend: Current page is not a single post page

\*

\* E.g.: archive, search results, author page, etc.

\*

\* To get the user_id on the author page, we need to get the queried
object ID.

\*

\* \@since 1.7.1

\*/

if ( ! is_singular() && ! bricks_is_builder_call() ) {

\$post_id = get_queried_object_id();

}

// Home: Set post ID to posts page

if ( is_home() ) {

\$post_id = get_option( \'page_for_posts\' );

}

// NOTE: Undocumented

\$post_id = apply_filters( \'bricks/builder/data_post_id\', \$post_id );

// \@since 1.8 - Set current page type

self::\$page_data\[\'current_page_type\'\] = apply_filters(
\'bricks/builder/current_page_type\', self::get_current_page_type(
get_queried_object() ) );

// Keep \$original_post_id integrity. set_page_data() also runs on
Assets::generate_inline_css() for inner templates

self::\$page_data\[\'original_post_id\'\] = ! empty(
self::\$page_data\[\'original_post_id\'\] ) ?
self::\$page_data\[\'original_post_id\'\] : \$post_id;

// \$preview_or_post_id gets populated with template preview post ID OR
original post ID

\$template_preview_post_id = get_post_type(
self::\$page_data\[\'original_post_id\'\] ) === BRICKS_DB_TEMPLATE_SLUG
? Helpers::get_template_setting( \'templatePreviewPostId\',
self::\$page_data\[\'original_post_id\'\] ) : 0;

self::\$page_data\[\'preview_or_post_id\'\] = empty(
\$template_preview_post_id ) ? self::\$page_data\[\'original_post_id\'\]
: \$template_preview_post_id;

self::\$page_data\[\'post_id\'\] = \$post_id;

// Page header

\$page_header = self::get_data( \$post_id, \'header\' );

self::\$page_data\[\'header\'\] = is_array( \$page_header ) && count(
\$page_header ) ? \$page_header : \[\];

// Page content

\$page_content = self::get_data( \$post_id, \'content\' );

self::\$page_data\[\'content\'\] = is_array( \$page_content ) && count(
\$page_content ) ? \$page_content : \[\];

// Page footer

\$page_footer = self::get_data( \$post_id, \'footer\' );

self::\$page_data\[\'footer\'\] = is_array( \$page_footer ) && count(
\$page_footer ) ? \$page_footer : \[\];

/\*\*

\* Page settings

\*

\* Builder: Use \$post_id

\* Frontend: Use active template ID

\*

\* \@see #86bx4t5v3

\*/

\$page_settings_id = \$post_id;

if ( ! bricks_is_builder() && ! empty(
self::\$active_templates\[\'content\'\] ) ) {

\$page_settings_id = self::\$active_templates\[\'content\'\];

}

\$page_settings = get_post_meta( \$page_settings_id,
BRICKS_DB_PAGE_SETTINGS, true );

self::\$page_data\[\'settings\'\] = is_array( \$page_settings ) &&
count( \$page_settings ) ? \$page_settings : \[\];

/\*\*

\* Remove slashes from custom JS

\*

\* \@since 1.9.5: Skip page settings custom CSS as its not auto-escaped
as the global settings, which are stored in the options table

\* \@since 1.10: Skip page settings custom JavaScript as well

\*/

if ( is_array( self::\$page_data\[\'settings\'\] ) ) {

foreach ( self::\$page_data\[\'settings\'\] as \$key =\> \$value ) {

if ( \$key === \'customCss\' \|\|

\$key === \'customScriptsHeader\' \|\|

\$key === \'customScriptsBodyHeader\' \|\|

\$key === \'customScriptsBodyFooter\'

) {

continue;

}

self::\$page_data\[\'settings\'\]\[ \$key \] = stripslashes_deep(
\$value );

}

}

// Set page gettings

self::\$page_settings = self::\$page_data\[\'settings\'\];

}

/\*\*

\* Return current page type, not considering AJAX calls

\*

\* \@param object \$object Queried object.

\*

\* \@since 1.8

\*/

public static function get_current_page_type( \$object ) {

if ( is_search() ) {

return \'search\';

}

if ( is_404() ) {

return \'404\';

}

if ( is_a( \$object, \'WP_Post\' ) ) {

return \'post\';

}

if ( is_a( \$object, \'WP_Term\' ) ) {

return \'term\';

}

if ( is_a( \$object, \'WP_User\' ) ) {

return \'user\';

}

if ( is_a( \$object, \'WP_Post_Type\' ) ) {

return \'archive\';

}

if ( is_object( \$object ) ) {

return strtolower( get_class( \$object ) );

}

}

/\*\*

\* Recursively retrieve nested template data

\*

\* \@return array

\*

\* \@since 1.9.1

\*/

public static function get_nested_template_data( \$bricks_data = \[\] )
{

// If the input is not an array, return it as is

if ( ! is_array( \$bricks_data ) ) {

return \$bricks_data;

}

// STEP: Find template elements in the array

\$found_template_elements = array_filter(

\$bricks_data,

function( \$element ) {

return isset( \$element\[\'name\'\] ) && in_array(
\$element\[\'name\'\], \[ \'template\' \] );

}

);

// If no template elements found, return the original array

if ( empty( \$found_template_elements ) ) {

return \$bricks_data;

}

// STEP: Retrieve nested template data from the
\$found_template_elements

\$nested_template_data = \[\];

foreach ( \$found_template_elements as \$element ) {

\$template_id = isset( \$element\[\'settings\'\]\[\'template\'\] ) ?
\$element\[\'settings\'\]\[\'template\'\] : false;

// If no template ID found, skip to the next element

if ( ! \$template_id ) {

continue;

}

// Retrieve the template data using the template ID

\$template_data = get_post_meta( \$template_id, BRICKS_DB_PAGE_CONTENT,
true );

// If template data found, merge it into the \$nested_template_data

if ( ! empty( \$template_data ) && is_array( \$template_data ) ) {

// Store the template data in \$nested_template_data

\$nested_template_data = array_replace_recursive(
\$nested_template_data, \$template_data );

// Store the template data in the page data (might be used later)

self::\$page_data\[\'template_data\'\]\[ \$template_id \] =
\$template_data;

}

}

// STEP: Maybe there are nested template element inside
\$nested_template_data (recursion)

\$recursive_nested_template_data = self::get_nested_template_data(
\$nested_template_data );

if ( ! empty( \$recursive_nested_template_data ) ) {

\$bricks_data = array_merge_recursive( \$bricks_data,
\$recursive_nested_template_data );

}

return \$bricks_data;

}

/\*\*

\* Retrieve template data from template elements

\*

\* \@since 1.9.1

\*/

public static function get_template_elements_data( \$elements = \[\] ) {

// If no elements provided, return an empty array

if ( empty( \$elements ) ) {

return \[\];

}

// Initialize the array to store nested template data

\$nested_template_data = \[\];

// Process each element to retrieve nested templates

foreach ( \$elements as \$element ) {

\$template_id = isset( \$element\[\'settings\'\]\[\'template\'\] ) ?
\$element\[\'settings\'\]\[\'template\'\] : false;

// If no template ID found, skip to the next element

if ( ! \$template_id ) {

continue;

}

// Retrieve the template data using the template ID

\$template_data = self::get_data( \$template_id );

// If template data found, merge it into the \$nested_template_data

if ( ! empty( \$template_data ) && is_array( \$template_data ) ) {

\$nested_template_data = array_replace_recursive(
\$nested_template_data, \$template_data );

// Store the template data in the page data

self::\$page_data\[\'template_data\'\]\[ \$template_id \] =
\$template_data;

}

}

return \$nested_template_data;

}

/\*\*

\* Get elements sequence in builder

\*

\* This is used to determine the order of elements in the builder.

\*

\* \@since 1.9.1

\*

\* \@return array (sequence of ids)

\*/

public static function elements_sequence_in_builder( \$elements ) {

\$top_level_elements = \[\];

// Get top level elements

foreach ( \$elements as \$element ) {

if ( ! isset( \$element\[\'parent\'\] ) \|\| empty(
\$element\[\'parent\'\] ) ) {

\$top_level_elements\[\] = \$element;

}

}

\$sequence_of_ids = \[\];

// Get sequence of ids starting from top level elements

foreach ( \$top_level_elements as \$element ) {

\$sequence_of_ids\[\] = \$element\[\'id\'\];

\$sequence_of_ids = array_merge( \$sequence_of_ids,
self::get_ids_by_children( \$elements, \$element ) );

}

return \$sequence_of_ids;

}

/\*\*

\* Get sequence of ids by children

\*

\* \@since 1.9.1

\*/

public static function get_ids_by_children( \$elements, \$parent_element
) {

\$sequence = \[\];

\$children_ids = isset( \$parent_element\[\'children\'\] ) ?
\$parent_element\[\'children\'\] : false;

// Follow the order of the children

foreach ( \$children_ids as \$child_id ) {

\$sequence\[\] = \$child_id;

\$child_element = self::get_element_by_id( \$child_id, \$elements );

if ( is_array( \$child_element ) && isset(
\$child_element\[\'children\'\] ) && ! empty(
\$child_element\[\'children\'\] ) ) {

\$sequence = array_merge( \$sequence, self::get_ids_by_children(
\$elements, \$child_element ) ); // Recursion

}

}

return \$sequence;

}

/\*\*

\* Get the element by id from elements array

\*

\* \@since 1.9.1

\*/

public static function get_element_by_id( \$element_id, \$elements ) {

\$element = array_filter(

\$elements,

function( \$element ) use ( \$element_id ) {

return \$element\[\'id\'\] === \$element_id;

}

);

if ( ! empty( \$element ) ) {

return array_shift( \$element );

}

return false;

}

}
