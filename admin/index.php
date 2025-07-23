<?php
/**
 * ADJ Automotive Repair Services - Admin Login
 * Admin authentication page
 */

// Include configuration and functions
require_once '../config/config.php';
require_once '../includes/functions.php';

// Redirect if already logged in
if (isAdmin()) {
    header('Location: dashboard.php');
    exit;
}

// Handle login form submission
$loginError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
        $loginError = 'Security token mismatch. Please try again.';
    } else {
        $username = sanitizeInput($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        
        if (empty($username) || empty($password)) {
            $loginError = 'Please enter both username and password.';
        } else {
            try {
                $db = getDB();
                $sql = "SELECT id, username, email, password_hash FROM admin_users WHERE username = ?";
                $admin = $db->fetch($sql, [$username]);
                
                if ($admin && password_verify($password, $admin['password_hash'])) {
                    // Successful login
                    $_SESSION['admin_id'] = $admin['id'];
                    $_SESSION['admin_username'] = $admin['username'];
                    $_SESSION['admin_email'] = $admin['email'];
                    
                    // Update last login
                    $db->execute("UPDATE admin_users SET last_login = NOW() WHERE id = ?", [$admin['id']]);
                    
                    // Log login activity
                    logAdminActivity('Login', 'Admin logged in');
                    
                    // Redirect to dashboard
                    header('Location: dashboard.php');
                    exit;
                } else {
                    $loginError = 'Invalid username or password.';
                    
                    // Log failed login attempt
                    error_log("Failed admin login attempt for username: $username from IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'));
                }
            } catch (Exception $e) {
                error_log('Admin login error: ' . $e->getMessage());
                $loginError = 'Login system temporarily unavailable. Please try again later.';
            }
        }
    }
}

// Page variables
$pageTitle = 'Admin Login';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle . ' - ' . APP_NAME; ?></title>
    
    <!-- Inline styles for debugging -->
    <style>
        body {
            background-color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            padding: 1rem;
        }
        .container {
            max-width: 28rem;
            width: 100%;
        }
        .card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }
        .text-center { text-align: center; }
        .mb-8 { margin-bottom: 2rem; }
        .mb-6 { margin-bottom: 1.5rem; }
        .mb-4 { margin-bottom: 1rem; }
        .mb-2 { margin-bottom: 0.5rem; }
        .icon-container {
            background-color: <?php echo COLOR_PRIMARY_BLUE; ?>;
            color: white;
            padding: 1rem;
            border-radius: 50%;
            width: 5rem;
            height: 5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }
        .form-group { margin-bottom: 1.5rem; }
        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #1e3a8a;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            font-size: 1rem;
            box-sizing: border-box;
        }
        .form-input:focus {
            border-color: <?php echo COLOR_PRIMARY_BLUE; ?>;
            outline: none;
        }
        .btn-primary {
            width: 100%;
            background-color: <?php echo COLOR_PRIMARY_BLUE; ?>;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
        }
        .btn-primary:hover {
            background-color: #1e3a8a;
        }
        .error-message {
            background-color: #fee2e2;
            border: 1px solid #fca5a5;
            color: #dc2626;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1.5rem;
        }
        .back-link {
            color: <?php echo COLOR_PRIMARY_BLUE; ?>;
            text-decoration: none;
            font-size: 0.875rem;
        }
        .back-link:hover {
            color: #1e3a8a;
        }
    </style>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Login Card -->
        <div class="card">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="icon-container">
                    <i class="fas fa-user-shield" style="font-size: 1.5rem;"></i>
                </div>
                <h1 style="font-size: 1.5rem; font-weight: bold; color: #1e3a8a; margin-bottom: 0.5rem;">Admin Login</h1>
                <p style="color: #6b7280;"><?php echo BUSINESS_NAME; ?></p>
            </div>

            <!-- Error Message -->
            <?php if (!empty($loginError)): ?>
            <div class="error-message">
                <div style="display: flex; align-items: center;">
                    <i class="fas fa-exclamation-triangle" style="margin-right: 0.5rem;"></i>
                    <span><?php echo htmlspecialchars($loginError); ?></span>
                </div>
            </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">

                <div class="form-group">
                    <label class="form-label">Username</label>
                    <div style="position: relative;">
                        <div style="position: absolute; top: 50%; left: 0.75rem; transform: translateY(-50%); pointer-events: none;">
                            <i class="fas fa-user" style="color: #9ca3af;"></i>
                        </div>
                        <input type="text" name="username" required
                               class="form-input"
                               style="padding-left: 2.5rem;"
                               placeholder="Enter your username"
                               value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                               autocomplete="username">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div style="position: relative;">
                        <div style="position: absolute; top: 50%; left: 0.75rem; transform: translateY(-50%); pointer-events: none;">
                            <i class="fas fa-lock" style="color: #9ca3af;"></i>
                        </div>
                        <input type="password" name="password" required
                               class="form-input"
                               style="padding-left: 2.5rem;"
                               placeholder="Enter your password"
                               autocomplete="current-password">
                    </div>
                </div>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-sign-in-alt" style="margin-right: 0.5rem;"></i>
                    Login to Admin Panel
                </button>
            </form>

            <!-- Footer -->
            <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; text-align: center;">
                <p style="font-size: 0.875rem; color: #6b7280;">
                    <i class="fas fa-shield-alt" style="margin-right: 0.25rem;"></i>
                    Secure Admin Access
                </p>
                <p style="font-size: 0.75rem; color: #9ca3af; margin-top: 0.5rem;">
                    <?php echo BUSINESS_NAME; ?> - Admin Panel
                </p>
            </div>
        </div>

        <!-- Back to Website -->
        <div style="text-align: center; margin-top: 1.5rem;">
            <a href="<?php echo BASE_URL; ?>" class="back-link">
                <i class="fas fa-arrow-left" style="margin-right: 0.25rem;"></i>
                Back to Website
            </a>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Auto-focus username field
        document.addEventListener('DOMContentLoaded', function() {
            const usernameField = document.querySelector('input[name="username"]');
            if (usernameField && !usernameField.value) {
                usernameField.focus();
            }
        });
        
        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const username = document.querySelector('input[name="username"]').value.trim();
            const password = document.querySelector('input[name="password"]').value;
            
            if (!username || !password) {
                e.preventDefault();
                alert('Please enter both username and password.');
                return false;
            }
        });
    </script>
</body>
</html>
