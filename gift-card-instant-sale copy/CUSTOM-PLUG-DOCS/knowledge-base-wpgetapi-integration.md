# WPGetAPI Integration Guide for Custom Payment Plugin

[Previous content remains unchanged...]

## Troubleshooting Guide

### Debug Mode

```php
// Example: Enable Debug Mode
function enable_api_debugging($endpoint_args) {
    // Enable debug for all endpoints
    $endpoint_args['debug'] = 'true';
    
    // Or enable conditionally
    if (defined('WP_DEBUG') && WP_DEBUG) {
        $endpoint_args['debug'] = 'true';
    }
    
    return $endpoint_args;
}
add_filter('wpgetapi_endpoint_args', 'enable_api_debugging');

// Example: Custom Debug Logger
function custom_debug_logger($log_data, $endpoint) {
    error_log(sprintf(
        "[Payment API Debug] Endpoint: %s\nRequest: %s\nResponse: %s",
        $endpoint['endpoint_id'],
        wp_json_encode($log_data['request']),
        wp_json_encode($log_data['response'])
    ));
}
add_action('wpgetapi_debug_log', 'custom_debug_logger', 10, 2);
```

### Common Issues and Solutions

```php
// Example: URL Validation Handler
function validate_api_urls($endpoint_args) {
    // Ensure no spaces in API ID or Endpoint ID
    $endpoint_args['api_id'] = sanitize_key($endpoint_args['api_id']);
    $endpoint_args['endpoint_id'] = sanitize_key($endpoint_args['endpoint_id']);
    
    // Validate full URL
    $url = $endpoint_args['url'];
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        throw new Exception(sprintf(
            'Invalid URL provided: %s',
            $url
        ));
    }
    
    return $endpoint_args;
}
add_filter('wpgetapi_endpoint_args', 'validate_api_urls');

// Example: Array Data Handler
function handle_array_responses($response, $endpoint) {
    // Handle PHP array data appropriately
    if ($endpoint['format'] === 'PHP array data') {
        // Convert to JSON for template usage
        return wp_json_encode($response);
    }
    
    return $response;
}
add_filter('wpgetapi_response', 'handle_array_responses', 10, 2);
```

### Error Handling

```php
// Example: Comprehensive Error Handler
function handle_api_errors($response, $endpoint) {
    if (is_wp_error($response)) {
        $error_code = $response->get_error_code();
        $error_message = $response->get_error_message();
        
        // Log the error
        error_log(sprintf(
            'Payment API Error: [%s] %s - Endpoint: %s',
            $error_code,
            $error_message,
            $endpoint['endpoint_id']
        ));
        
        // Handle specific error types
        switch ($error_code) {
            case 'http_request_failed':
                handle_connection_error($response, $endpoint);
                break;
            case 'authentication_failed':
                handle_auth_error($response, $endpoint);
                break;
            case 'invalid_response':
                handle_response_error($response, $endpoint);
                break;
        }
    }
    
    return $response;
}
add_filter('wpgetapi_response', 'handle_api_errors', 10, 2);

// Example: Connection Error Handler
function handle_connection_error($error, $endpoint) {
    // Check for common connection issues
    $error_data = $error->get_error_data();
    
    if (isset($error_data['curl_error'])) {
        switch ($error_data['curl_error']) {
            case CURLE_OPERATION_TIMEOUTED:
                retry_failed_request($endpoint);
                break;
            case CURLE_SSL_CONNECT_ERROR:
                verify_ssl_configuration();
                break;
        }
    }
}

// Example: Authentication Error Handler
function handle_auth_error($error, $endpoint) {
    // Clear cached credentials
    delete_transient('api_auth_token');
    
    // Notify admin
    wp_mail(
        get_option('admin_email'),
        'Payment API Authentication Failed',
        sprintf(
            'Authentication failed for endpoint: %s. Please verify credentials.',
            $endpoint['endpoint_id']
        )
    );
}
```

### Request Validation

```php
// Example: Request Validator
function validate_api_request($endpoint_args) {
    $required_fields = array(
        'api_id',
        'endpoint_id',
        'method'
    );
    
    foreach ($required_fields as $field) {
        if (!isset($endpoint_args[$field]) || empty($endpoint_args[$field])) {
            throw new Exception(sprintf(
                'Missing required field: %s',
                $field
            ));
        }
    }
    
    // Validate method
    if (!in_array($endpoint_args['method'], array('GET', 'POST', 'PUT', 'DELETE'))) {
        throw new Exception(sprintf(
            'Invalid HTTP method: %s',
            $endpoint_args['method']
        ));
    }
    
    return $endpoint_args;
}
add_filter('wpgetapi_pre_request', 'validate_api_request');
```

### Response Validation

```php
// Example: Response Validator
function validate_api_response($response, $endpoint) {
    if (!is_wp_error($response)) {
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        
        // Validate response structure
        if (json_last_error() !== JSON_ERROR_NONE) {
            return new WP_Error(
                'invalid_json',
                'Invalid JSON response received'
            );
        }
        
        // Validate required fields
        $required_fields = get_required_fields($endpoint);
        foreach ($required_fields as $field) {
            if (!isset($data[$field])) {
                return new WP_Error(
                    'missing_field',
                    sprintf('Missing required field: %s', $field)
                );
            }
        }
    }
    
    return $response;
}
add_filter('wpgetapi_response', 'validate_api_response', 10, 2);
```

### Performance Monitoring

```php
// Example: Performance Monitor
function monitor_api_performance($endpoint_args) {
    // Add timing information
    $endpoint_args['_start_time'] = microtime(true);
    
    return $endpoint_args;
}
add_filter('wpgetapi_pre_request', 'monitor_api_performance');

function log_api_performance($response, $endpoint) {
    if (isset($endpoint['_start_time'])) {
        $duration = microtime(true) - $endpoint['_start_time'];
        
        // Log if request takes too long
        if ($duration > 5) { // 5 seconds threshold
            error_log(sprintf(
                'Slow API Request - Endpoint: %s, Duration: %.2f seconds',
                $endpoint['endpoint_id'],
                $duration
            ));
        }
        
        // Store metrics
        $metrics = get_option('api_performance_metrics', array());
        $metrics[] = array(
            'endpoint' => $endpoint['endpoint_id'],
            'duration' => $duration,
            'timestamp' => current_time('mysql')
        );
        
        // Keep last 100 metrics
        $metrics = array_slice($metrics, -100);
        update_option('api_performance_metrics', $metrics);
    }
    
    return $response;
}
add_filter('wpgetapi_response', 'log_api_performance', 10, 2);
```

### Recovery Mechanisms

```php
// Example: Auto-Recovery System
function implement_recovery_system() {
    // Retry failed requests
    add_filter('wpgetapi_error', function($error, $response, $endpoint) {
        if (should_retry_request($error)) {
            return retry_request($endpoint);
        }
        return $error;
    }, 10, 3);
    
    // Handle rate limiting
    add_filter('wpgetapi_pre_request', function($endpoint_args) {
        if (is_rate_limited($endpoint_args['api_id'])) {
            sleep(get_rate_limit_delay());
        }
        return $endpoint_args;
    });
    
    // Circuit breaker
    add_filter('wpgetapi_pre_request', function($endpoint_args) {
        if (is_circuit_open($endpoint_args['api_id'])) {
            throw new Exception('Circuit breaker is open');
        }
        return $endpoint_args;
    });
}
add_action('init', 'implement_recovery_system');
```

---
Note: This document will be updated with additional implementation details as we gather more information from the documentation.
