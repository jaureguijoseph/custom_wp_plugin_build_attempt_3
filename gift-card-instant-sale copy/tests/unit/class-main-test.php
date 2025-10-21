<?php
/**
 * Test cases for the main plugin class
 *
 * @package GICS
 */

namespace GICS\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Brain\Monkey;
use Brain\Monkey\Functions;
use GICS\Main;

/**
 * Class Main_Test
 */
class Main_Test extends TestCase {
    /**
     * Set up test environment.
     */
    protected function setUp(): void {
        parent::setUp();
        Monkey\setUp();
        // Mock WordPress functions that might be called during tests
        Functions\when('plugin_dir_path')->justReturn('/path/to/plugin/');
        Functions\when('plugin_dir_url')->justReturn('http://example.com/wp-content/plugins/gift-card-instant-sale/');
        Functions\when('plugin_basename')->justReturn('gift-card-instant-sale/gift-card-instant-sale.php');
    }

    /**
     * Tear down test environment.
     */
    protected function tearDown(): void {
        Monkey\tearDown();
        parent::tearDown();
    }

    /**
     * Test plugin initialization hooks are registered
     */
    public function test_init_hooks_are_registered() {
        // Mock WordPress functions
        Functions\expect('register_activation_hook')
            ->once()
            ->with(
                \Mockery::contains('gift-card-instant-sale.php'),
                \Mockery::type('callable')
            );

        Functions\expect('register_deactivation_hook')
            ->once()
            ->with(
                \Mockery::contains('gift-card-instant-sale.php'),
                \Mockery::type('callable')
            );

        Functions\expect('add_action')
            ->once()
            ->with('plugins_loaded', \Mockery::type('callable'));

        // Create instance of main plugin class
        $plugin = new Main();
        $plugin->init();

        // Brain Monkey will automatically verify our expectations
        $this->assertTrue(true);
    }

    /**
     * Test plugin constants are defined
     */
    public function test_constants_are_defined() {
        $plugin = new Main();
        $plugin->init();

        $this->assertTrue(defined('GICS_VERSION'));
        $this->assertTrue(defined('GICS_PLUGIN_DIR'));
        $this->assertTrue(defined('GICS_PLUGIN_URL'));
        $this->assertTrue(defined('GICS_PLUGIN_BASENAME'));
    }

    /**
     * Test activation method sets up required database tables
     */
    public function test_activation_creates_database_tables() {
        global $wpdb;

        // Mock dbDelta function
        Functions\expect('dbDelta')
            ->times(4) // We expect 4 table creations
            ->andReturn(true);

        // Create instance and call activate
        $plugin = new Main();
        $plugin->activate();

        // Verify tables were created
        $this->assertTrue(true); // If we got here, dbDelta was called as expected
    }

    /**
     * Test deactivation cleans up scheduled events
     */
    public function test_deactivation_cleans_up_events() {
        // Mock WordPress functions
        Functions\expect('wp_clear_scheduled_hook')
            ->times(3) // We expect 3 scheduled events to be cleared
            ->andReturn(true);

        // Create instance and call deactivate
        $plugin = new Main();
        $plugin->deactivate();

        // Verify scheduled events were cleared
        $this->assertTrue(true); // If we got here, wp_clear_scheduled_hook was called as expected
    }
}
