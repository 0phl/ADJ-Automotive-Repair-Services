<?php
/**
 * ADJ Automotive Repair Services - Admin Logout
 * Logout functionality for admin users
 */

// Include configuration and functions
require_once '../config/config.php';
require_once '../includes/functions.php';

// Check if admin is logged in
if (isAdmin()) {
    // Log logout activity
    logAdminActivity('Logout', 'Admin logged out');
    
    // Clear admin session
    unset($_SESSION['admin_id']);
    unset($_SESSION['admin_username']);
    unset($_SESSION['admin_email']);
    
    // Destroy session if no other data
    if (empty($_SESSION)) {
        session_destroy();
    }
}

// Redirect to login page
header('Location: index.php');
exit;
?>
