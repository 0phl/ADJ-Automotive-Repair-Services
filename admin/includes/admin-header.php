<?php
/**
 * ADJ Automotive Repair Services - Admin Header
 * Common header for admin pages
 */

// Ensure admin is logged in
if (!isAdmin()) {
    header('Location: index.php');
    exit;
}

// Get current page for navigation highlighting
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - Admin - ' . APP_NAME : 'Admin - ' . APP_NAME; ?></title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Admin CSS - Tailwind Build -->
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/css/admin-tailwind.css?v=<?php echo APP_VERSION; ?>">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <a href="<?php echo ADMIN_URL; ?>/dashboard.php" class="sidebar-logo-link">
                    <i class="fas fa-tools"></i>
                    <span class="sidebar-logo-text">ADJ Admin</span>
                </a>
                <p class="sidebar-tagline">Management Panel</p>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section">
                    <h3 class="nav-section-title">Main</h3>
                    <a href="<?php echo ADMIN_URL; ?>/dashboard.php" class="nav-item <?php echo $currentPage === 'dashboard.php' ? 'active' : ''; ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </div>

                <div class="nav-section">
                    <h3 class="nav-section-title">Inventory</h3>
                    <a href="<?php echo ADMIN_URL; ?>/cars/manage.php" class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], '/cars/') !== false ? 'active' : ''; ?>">
                        <i class="fas fa-car"></i>
                        <span>Car Inventory</span>
                    </a>
                </div>

                <div class="nav-section">
                    <h3 class="nav-section-title">Services</h3>
                    <a href="<?php echo ADMIN_URL; ?>/services/quotes.php" class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], '/services/quotes') !== false ? 'active' : ''; ?>">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span>Quote Requests</span>
                    </a>
                    <a href="<?php echo ADMIN_URL; ?>/services/appointments.php" class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], '/services/appointments') !== false ? 'active' : ''; ?>">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Appointments</span>
                    </a>
                </div>

                <div class="nav-section">
                    <h3 class="nav-section-title">Customer</h3>
                    <a href="<?php echo ADMIN_URL; ?>/inquiries/car-inquiries.php" class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], '/inquiries/car') !== false ? 'active' : ''; ?>">
                        <i class="fas fa-car"></i>
                        <span>Car Inquiries</span>
                    </a>
                    <a href="<?php echo ADMIN_URL; ?>/inquiries/service-inquiries.php" class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], '/inquiries/service') !== false ? 'active' : ''; ?>">
                        <i class="fas fa-wrench"></i>
                        <span>Service Inquiries</span>
                    </a>
                </div>

                <div class="nav-section">
                    <h3 class="nav-section-title">Content</h3>
                    <a href="<?php echo ADMIN_URL; ?>/content/homepage.php" class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], '/content/') !== false ? 'active' : ''; ?>">
                        <i class="fas fa-edit"></i>
                        <span>Website Content</span>
                    </a>
                </div>

                <div class="nav-section">
                    <h3 class="nav-section-title">Settings</h3>
                    <a href="<?php echo ADMIN_URL; ?>/settings/business-info.php" class="nav-item <?php echo strpos($_SERVER['REQUEST_URI'], '/settings/') !== false ? 'active' : ''; ?>">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </div>
            </nav>

            <div class="sidebar-footer">
                <div class="sidebar-user-info">
                    <div class="sidebar-user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="sidebar-user-details">
                        <span class="sidebar-user-name"><?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
                        <span class="sidebar-user-role">Administrator</span>
                    </div>
                </div>
                <div class="sidebar-footer-actions">
                    <a href="<?php echo BASE_URL; ?>" target="_blank" class="btn btn-secondary btn-sm">
                        <i class="fas fa-external-link-alt"></i>
                        <span>View Site</span>
                    </a>
                    <a href="<?php echo ADMIN_URL; ?>/logout.php" class="btn btn-danger btn-sm">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="admin-main-content">
            <!-- Top Header -->
            <header class="admin-header">
                <div class="admin-header-left">
                    <button class="mobile-menu-toggle md:hidden" id="mobileMenuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="page-title">
                        <?php echo isset($pageTitle) ? $pageTitle : 'Admin Panel'; ?>
                    </h1>
                </div>
                <div class="admin-header-actions">
                    <div class="notification-widget">
                        <button class="notification-button">
                            <i class="fas fa-bell"></i>
                            <?php
                            // Note: $stats might not be available on all pages.
                            $pendingCount = 0;
                            if (isset($stats)) {
                                $pendingCount = ($stats['pending_quotes'] ?? 0) + ($stats['recent_inquiries'] ?? 0);
                            }
                            if ($pendingCount > 0):
                            ?>
                            <span class="notification-badge">
                                <?php echo min($pendingCount, 99); ?><?php echo $pendingCount > 99 ? '+' : ''; ?>
                            </span>
                            <?php endif; ?>
                        </button>
                    </div>
                    <a href="<?php echo ADMIN_URL; ?>/cars/add.php" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        <span class="hidden sm:inline">Add Car</span>
                        <span class="sm:hidden">Add</span>
                    </a>
                </div>
            </header>

            <!-- Page Content -->
            <div class="page-content">
                <?php // Content starts here ?>

    <!-- Mobile Sidebar Overlay -->
    <div class="mobile-sidebar-overlay" id="mobileSidebarOverlay"></div>

    <!-- Mobile Menu JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const sidebar = document.querySelector('.admin-sidebar');
            const overlay = document.getElementById('mobileSidebarOverlay');

            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('mobile-open');
                    overlay.classList.toggle('active');
                    document.body.classList.toggle('sidebar-open');
                });
            }

            if (overlay) {
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('mobile-open');
                    overlay.classList.remove('active');
                    document.body.classList.remove('sidebar-open');
                });
            }

            // Close sidebar when clicking nav links on mobile
            const navLinks = document.querySelectorAll('.nav-item');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 768) {
                        sidebar.classList.remove('mobile-open');
                        overlay.classList.remove('active');
                        document.body.classList.remove('sidebar-open');
                    }
                });
            });
        });
    </script>
