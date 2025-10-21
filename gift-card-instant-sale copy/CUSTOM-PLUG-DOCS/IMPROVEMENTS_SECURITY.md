# Security Improvements

## Overview
Implementation Status: PARTIAL
Priority: HIGH

Current Gaps:
- Limited API health monitoring
- Basic role state management
- Limited token lifecycle tracking
- Basic cleanup procedures

## Required Implementations

### API Health Monitoring
```php
class APIHealthMonitor {
    /** @var int Check interval in seconds */
    private const CHECK_INTERVAL = 300; // 5 minutes

    /**
     * Monitor API Health
     * 
     * Checks health of all critical APIs:
     * - Plaid APIs (Link, Identity, Payment)
     * - Authorize.NET API
     * - Payment networks
     * 
     * @return array Health status of all services
     */
    public function checkAPIHealth(): array {
        $services = [
            'plaid_link' => $this->checkPlaidLinkAPI(),
            'plaid_identity' => $this->checkPlaidIdentityAPI(),
            'plaid_payment' => $this->checkPlaidPaymentAPI(),
            'authorize_net' => $this->checkAuthorizeNetAPI()
        ];

        $this->logHealthStatus($services);
        $this->alertOnFailures($services);

        return $services;
    }

    /**
     * Log Health Status
     * 
     * Records API health status:
     * - Service status
     * - Response times
     * - Error rates
     * - Timestamp
     */
    private function logHealthStatus(array $services): void {
        foreach ($services as $service => $status) {
            $this->wp->insert('gcis_api_health_log', [
                'service' => $service,
                'status' => $status['healthy'] ? 'healthy' : 'unhealthy',
                'response_time' => $status['response_time'],
                'error_rate' => $status['error_rate'],
                'timestamp' => current_time('mysql')
            ]);
        }
    }
}
```

### Enhanced Role Management
```php
class RoleStateManager {
    /** @var int Role expiration time in seconds */
    private const ROLE_TIMEOUT = 1800; // 30 minutes

    /** @var int Grace period in seconds */
    private const GRACE_PERIOD = 300; // 5 minutes

    /**
     * Manage Role State
     * 
     * Handles complete role lifecycle:
     * - Role assignment
     * - State tracking
     * - Expiration
     * - Cleanup
     * 
     * @param int $userId User ID
     * @param string $role Role to assign
     * @return bool Success status
     */
    public function manageRoleState(int $userId, string $role): bool {
        try {
            // Set role with expiration
            $expiry = time() + self::ROLE_TIMEOUT;
            $this->setRoleWithExpiry($userId, $role, $expiry);

            // Schedule cleanup
            $this->scheduleCleanup($userId, $expiry + self::GRACE_PERIOD);

            // Log transition
            $this->logRoleTransition($userId, $role, $expiry);

            return true;
        } catch (\Exception $e) {
            $this->logError($userId, 'ROLE_STATE_ERROR', $e->getMessage());
            return false;
        }
    }

    /**
     * Set Role With Expiry
     * 
     * Assigns role with expiration:
     * - Stores role state
     * - Sets expiration timer
     * - Validates assignment
     */
    private function setRoleWithExpiry(int $userId, string $role, int $expiry): void {
        $this->wp->updateUserMeta($userId, '_gcis_current_role', $role);
        $this->wp->updateUserMeta($userId, '_gcis_role_expires', $expiry);
    }
}
```

### Token Lifecycle Management
```php
class TokenLifecycleManager {
    /**
     * Manage Token Lifecycle
     * 
     * Complete token management:
     * - Creation
     * - Validation
     * - Expiration
     * - Cleanup
     * 
     * @param int $userId User ID
     * @param string $token Token to manage
     * @return bool Success status
     */
    public function manageTokenLifecycle(int $userId, string $token): bool {
        try {
            // Store token securely
            $this->storeToken($userId, $token);

            // Set expiration
            $this->setTokenExpiry($userId);

            // Schedule cleanup
            $this->scheduleTokenCleanup($userId);

            return true;
        } catch (\Exception $e) {
            $this->logError($userId, 'TOKEN_LIFECYCLE_ERROR', $e->getMessage());
            return false;
        }
    }

    /**
     * Cleanup Expired Token
     * 
     * Secure token cleanup:
     * - Verify expiration
     * - Remove token
     * - Clear metadata
     * - Log cleanup
     */
    private function cleanupExpiredToken(int $userId): void {
        $this->wp->deleteUserMeta($userId, '_gcis_token');
        $this->wp->deleteUserMeta($userId, '_gcis_token_expiry');
        $this->logCleanup($userId, 'Token cleanup completed');
    }
}
```

## Implementation Timeline

### Week 1: API Health Monitoring
1. Day 1-2: Health Check System
   - Implement API health checks
   - Add response time tracking
   - Set up alerting system

2. Day 3-4: Logging System
   - Implement health logging
   - Add error rate tracking
   - Create monitoring dashboard

3. Day 5: Integration
   - Connect with existing systems
   - Test monitoring flow
   - Document health checks

### Week 2: Role Management
1. Day 1-2: Role State System
   - Implement role state tracking
   - Add expiration handling
   - Set up cleanup procedures

2. Day 3-4: Validation System
   - Add state validation
   - Implement transition logging
   - Create audit system

3. Day 5: Testing
   - Test role transitions
   - Verify cleanup
   - Document procedures

## Testing Requirements

### API Health Tests
```php
class APIHealthTest extends TestCase {
    public function testAPIHealthMonitoring(): void {
        $monitor = new APIHealthMonitor($this->wp);
        $status = $monitor->checkAPIHealth();
        
        $this->assertArrayHasKey('plaid_link', $status);
        $this->assertArrayHasKey('authorize_net', $status);
        $this->assertTrue($status['plaid_link']['healthy']);
    }
}
```

### Role Management Tests
```php
class RoleManagementTest extends TestCase {
    public function testRoleStateManagement(): void {
        $manager = new RoleStateManager($this->wp);
        $userId = 1;
        $role = 'plaid_user';
        
        $result = $manager->manageRoleState($userId, $role);
        $this->assertTrue($result);
        
        // Test expiration
        $this->travel(31)->minutes();
        $this->assertNull($this->wp->getUserMeta($userId, '_gcis_current_role'));
    }
}
```

## Best Practices

1. API Health Monitoring
   - Regular health checks
   - Response time tracking
   - Error rate monitoring
   - Alert system
   - Dashboard updates

2. Role Management
   - State validation
   - Expiration handling
   - Cleanup procedures
   - Audit logging
   - Recovery methods

3. Token Lifecycle
   - Secure storage
   - Expiration tracking
   - Automated cleanup
   - Access logging
   - Validation checks

4. Security Measures
   - Encryption
   - Access control
   - Rate limiting
   - Audit trails
   - Incident response

## Documentation

### Security Configuration
```php
const SECURITY_CONFIG = [
    'api_health' => [
        'check_interval' => 300,
        'alert_threshold' => 3,
        'response_timeout' => 30,
    ],
    'role_management' => [
        'timeout' => 1800,
        'grace_period' => 300,
        'cleanup_enabled' => true,
    ],
    'token_lifecycle' => [
        'expiry' => 1800,
        'cleanup_delay' => 300,
        'encryption' => 'aes-256-gcm',
    ],
];
```

### Integration Guide
1. API Health Setup
   ```php
   $monitor = new APIHealthMonitor($wp);
   $monitor->startMonitoring();
   ```

2. Role Management
   ```php
   $manager = new RoleStateManager($wp);
   $manager->manageRoleState($userId, 'plaid_user');
   ```

3. Token Lifecycle
   ```php
   $tokenManager = new TokenLifecycleManager($wp);
   $tokenManager->manageTokenLifecycle($userId, $token);
   ```

### Best Practices
1. Always validate API health before operations
2. Implement proper role state management
3. Handle token lifecycle securely
4. Monitor and log all security events
5. Maintain audit trails
6. Regular security reviews
7. Update security configurations
8. Monitor system resources
