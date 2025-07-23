<?php
/**
 * ADJ Automotive Repair Services - Admin Dashboard
 * Main admin dashboard with overview statistics
 */

// Include configuration and functions
require_once '../config/config.php';
require_once '../includes/functions.php';

// Check admin authentication
requireAdmin();

// Get dashboard statistics
$stats = getDashboardStats();

// Get recent activities
$db = getDB();

// Recent car inquiries
$recentCarInquiries = $db->fetchAll(
    "SELECT i.*, c.make, c.model, c.year 
     FROM inquiries i 
     LEFT JOIN cars c ON i.car_id = c.id 
     WHERE i.type = 'car' 
     ORDER BY i.created_at DESC 
     LIMIT 5"
);

// Recent quote requests
$recentQuotes = $db->fetchAll(
    "SELECT * FROM quotes 
     ORDER BY created_at DESC 
     LIMIT 5"
);

// Recent appointments
$recentAppointments = $db->fetchAll(
    "SELECT * FROM appointments 
     ORDER BY created_at DESC 
     LIMIT 5"
);

// Page variables
$pageTitle = 'Dashboard';

// Include admin header
include 'includes/admin-header.php';
?>

<!-- Dashboard Content -->
<div class="page-header">
    <div class="page-header-content">
        <h1 class="page-header-title">Dashboard</h1>
        <p class="page-header-subtitle">Welcome back, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</p>
    </div>
</div>

<!-- Statistics Cards -->
<div class="stats-grid">
    <!-- Recent Inquiries -->
    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="fas fa-envelope"></i>
        </div>
        <div class="stat-content">
            <h3><?php echo $stats['recent_inquiries']; ?></h3>
            <p>Recent Inquiries</p>
            <small>Last 7 days</small>
        </div>
    </div>

    <!-- Pending Quotes -->
    <div class="stat-card">
        <div class="stat-icon yellow">
            <i class="fas fa-file-invoice-dollar"></i>
        </div>
        <div class="stat-content">
            <h3><?php echo $stats['pending_quotes']; ?></h3>
            <p>Pending Quotes</p>
            <small>Awaiting response</small>
        </div>
    </div>

    <!-- Available Cars -->
    <div class="stat-card">
        <div class="stat-icon green">
            <i class="fas fa-car"></i>
        </div>
        <div class="stat-content">
            <h3><?php echo $stats['available_cars']; ?></h3>
            <p>Available Cars</p>
            <small>In inventory</small>
        </div>
    </div>

    <!-- Pending Appointments -->
    <div class="stat-card">
        <div class="stat-icon red">
            <i class="fas fa-calendar-alt"></i>
        </div>
        <div class="stat-content">
            <h3><?php echo $stats['pending_appointments']; ?></h3>
            <p>Pending Appointments</p>
            <small>Need confirmation</small>
        </div>
    </div>
</div>

<!-- Recent Activities -->
<div class="dashboard-grid">
    <!-- Recent Car Inquiries -->
    <div class="card">
        <div class="card-header card-header-action">
            <h2 class="card-title">Recent Car Inquiries</h2>
            <a href="inquiries/car-inquiries.php" class="view-all-link">
                View All <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <div class="card-body">
            <?php if (empty($recentCarInquiries)): ?>
            <p class="no-activity">No recent car inquiries</p>
            <?php else: ?>
            <div class="activity-list">
                <?php foreach ($recentCarInquiries as $inquiry): ?>
                <div class="activity-item">
                    <div class="activity-header">
                        <div>
                            <h4 class="activity-title"><?php echo htmlspecialchars($inquiry['name']); ?></h4>
                            <p class="activity-meta"><?php echo htmlspecialchars($inquiry['email']); ?></p>
                            <?php if ($inquiry['make']): ?>
                            <p class="activity-car">
                                <?php echo htmlspecialchars($inquiry['year'] . ' ' . $inquiry['make'] . ' ' . $inquiry['model']); ?>
                            </p>
                            <?php endif; ?>
                        </div>
                        <span class="activity-time"><?php echo timeAgo($inquiry['created_at']); ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Recent Quote Requests -->
    <div class="card">
        <div class="card-header card-header-action">
            <h2 class="card-title">Recent Quote Requests</h2>
            <a href="services/quotes.php" class="view-all-link">
                View All <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <div class="card-body">
            <?php if (empty($recentQuotes)): ?>
            <p class="no-activity">No recent quote requests</p>
            <?php else: ?>
            <div class="activity-list">
                <?php foreach ($recentQuotes as $quote): ?>
                <div class="activity-item activity-item-quote">
                    <div class="activity-header">
                        <div>
                            <h4 class="activity-title"><?php echo htmlspecialchars($quote['customer_name']); ?></h4>
                            <p class="activity-meta"><?php echo htmlspecialchars($quote['email']); ?></p>
                            <p class="activity-service"><?php echo htmlspecialchars($quote['service_type']); ?></p>
                            <?php if ($quote['vehicle_make']): ?>
                            <p class="activity-vehicle">
                                <?php echo htmlspecialchars($quote['vehicle_year'] . ' ' . $quote['vehicle_make'] . ' ' . $quote['vehicle_model']); ?>
                            </p>
                            <?php endif; ?>
                        </div>
                        <span class="activity-time"><?php echo timeAgo($quote['created_at']); ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Quick Actions</h2>
    </div>
    <div class="quick-actions-grid">
        <a href="cars/add.php" class="quick-action-card">
            <div class="quick-action-icon add">
                <i class="fas fa-plus"></i>
            </div>
            <h3 class="quick-action-title">Add New Car</h3>
            <p class="quick-action-description">Add vehicle to inventory</p>
        </a>

        <a href="services/quotes.php" class="quick-action-card">
            <div class="quick-action-icon quotes">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <h3 class="quick-action-title">Manage Quotes</h3>
            <p class="quick-action-description">Review quote requests</p>
        </a>

        <a href="inquiries/car-inquiries.php" class="quick-action-card">
            <div class="quick-action-icon inquiries">
                <i class="fas fa-envelope"></i>
            </div>
            <h3 class="quick-action-title">View Inquiries</h3>
            <p class="quick-action-description">Customer inquiries</p>
        </a>

        <a href="content/homepage.php" class="quick-action-card">
            <div class="quick-action-icon content">
                <i class="fas fa-edit"></i>
            </div>
            <h3 class="quick-action-title">Edit Content</h3>
            <p class="quick-action-description">Update website content</p>
        </a>
    </div>
</div>

<!-- System Information -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">System Information</h2>
    </div>
    <div class="system-info-grid">
        <div class="system-info-section">
            <h4>Business Information</h4>
            <p><?php echo BUSINESS_NAME; ?></p>
            <p><?php echo BUSINESS_PHONE; ?></p>
            <p><?php echo BUSINESS_EMAIL; ?></p>
        </div>
        <div class="system-info-section">
            <h4>System Status</h4>
            <p>Environment: <?php echo ENVIRONMENT; ?></p>
            <p>Version: <?php echo APP_VERSION; ?></p>
            <p>Last Login: <?php echo date('M j, Y g:i A'); ?></p>
        </div>
        <div class="system-info-section">
            <h4>Quick Stats</h4>
            <p>Total Cars: <?php echo $stats['total_cars']; ?></p>
            <p>Available: <?php echo $stats['available_cars']; ?></p>
            <p>Sold: <?php echo $stats['total_cars'] - $stats['available_cars']; ?></p>
        </div>
    </div>
</div>

<?php include 'includes/admin-footer.php'; ?>
