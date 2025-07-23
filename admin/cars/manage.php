<?php
/**
 * ADJ Automotive Repair Services - Manage Cars
 * Admin page for managing car inventory
 */

// Include configuration and functions
require_once '../../config/config.php';
require_once '../../includes/functions.php';

// Check admin authentication
requireAdmin();

// Handle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'delete':
                if (isset($_POST['car_id']) && verifyCSRFToken($_POST['csrf_token'] ?? '')) {
                    $carId = (int)$_POST['car_id'];
                    if (deleteCar($carId)) {
                        $_SESSION['flash_message'] = 'Car deleted successfully.';
                        $_SESSION['flash_type'] = 'success';
                    } else {
                        $_SESSION['flash_message'] = 'Error deleting car.';
                        $_SESSION['flash_type'] = 'error';
                    }
                }
                break;
                
            case 'toggle_featured':
                if (isset($_POST['car_id']) && verifyCSRFToken($_POST['csrf_token'] ?? '')) {
                    $carId = (int)$_POST['car_id'];
                    $featured = (int)$_POST['featured'];
                    if (updateCarFeatured($carId, $featured)) {
                        $_SESSION['flash_message'] = 'Car featured status updated.';
                        $_SESSION['flash_type'] = 'success';
                    } else {
                        $_SESSION['flash_message'] = 'Error updating car status.';
                        $_SESSION['flash_type'] = 'error';
                    }
                }
                break;
        }
        
        header('Location: manage.php');
        exit;
    }
}

// Get filters
$filters = [];
if (isset($_GET['status']) && !empty($_GET['status'])) {
    $filters['status'] = sanitizeInput($_GET['status']);
}
if (isset($_GET['make']) && !empty($_GET['make'])) {
    $filters['make'] = sanitizeInput($_GET['make']);
}

// Get cars
$cars = getCars($filters);
$carMakes = getCarMakes();

// Page variables
$pageTitle = 'Manage Cars';

// Include admin header
include '../includes/admin-header.php';
?>

<?php
$flash = getFlashMessage();
if ($flash):
?>
<div class="alert alert-<?php echo htmlspecialchars($flash['type']); ?>">
    <i class="fas fa-<?php echo $flash['type'] === 'success' ? 'check-circle' : 'exclamation-triangle'; ?>"></i>
    <span><?php echo htmlspecialchars($flash['message']); ?></span>
</div>
<?php endif; ?>

<div class="page-header-container">
    <div>
        <h1 class="page-header-title">Car Inventory</h1>
        <p class="page-header-subtitle">Manage your vehicle inventory</p>
    </div>
    <a href="add.php" class="btn btn-primary">
        <i class="fas fa-plus"></i>
        <span>Add New Car</span>
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Filters</h2>
    </div>
    <div class="card-body">
        <form method="GET" class="filter-form">
            <div class="filter-group">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="available" <?php echo (($_GET['status'] ?? '') === 'available') ? 'selected' : ''; ?>>Available</option>
                    <option value="sold" <?php echo (($_GET['status'] ?? '') === 'sold') ? 'selected' : ''; ?>>Sold</option>
                    <option value="pending" <?php echo (($_GET['status'] ?? '') === 'pending') ? 'selected' : ''; ?>>Pending</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="make" class="form-label">Make</label>
                <select id="make" name="make" class="form-select">
                    <option value="">All Makes</option>
                    <?php foreach ($carMakes as $make): ?>
                    <option value="<?php echo htmlspecialchars($make['make']); ?>"
                            <?php echo (($_GET['make'] ?? '') === $make['make']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($make['make']); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="filter-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter"></i>
                    <span>Filter</span>
                </button>
                <a href="manage.php" class="btn btn-secondary">
                    <i class="fas fa-sync-alt"></i>
                    <span>Clear</span>
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header card-header-action">
        <h2 class="card-title">Cars (<?php echo count($cars); ?>)</h2>
        <div class="table-search">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search cars..." class="form-input" data-search-target="#cars-table">
        </div>
    </div>
    <div class="table-container">
        <?php if (empty($cars)): ?>
        <div class="empty-state">
            <i class="fas fa-car"></i>
            <h3 class="empty-state-title">No Cars Found</h3>
            <p class="empty-state-text">No cars match your current filters.</p>
            <a href="add.php" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                <span>Add First Car</span>
            </a>
        </div>
        <?php else: ?>
        <table class="table" id="cars-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th data-sort>Vehicle</th>
                    <th data-sort>Price</th>
                    <th data-sort>Mileage</th>
                    <th data-sort>Status</th>
                    <th data-sort>Views</th>
                    <th data-sort>Inquiries</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cars as $car): ?>
                <tr>
                    <td>
                        <?php
                        $images = json_decode($car['images'], true);
                        $mainImage = !empty($images) ? $images[0] : 'placeholder.svg';
                        ?>
                        <img src="<?php echo !empty($images) ? UPLOADS_URL . '/cars/' . htmlspecialchars($mainImage) : ASSETS_URL . '/images/placeholder.svg'; ?>"
                             alt="<?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?>"
                             class="table-image"
                             onerror="this.src='<?php echo ASSETS_URL; ?>/images/placeholder.svg'">
                    </td>
                    <td data-label="Vehicle">
                        <div class="table-cell-primary">
                            <?php echo htmlspecialchars($car['year'] . ' ' . $car['make'] . ' ' . $car['model']); ?>
                            <?php if ($car['featured']): ?>
                            <span class="badge badge-featured">Featured</span>
                            <?php endif; ?>
                        </div>
                        <div class="table-cell-secondary">
                            Added <?php echo date('M j, Y', strtotime($car['created_at'])); ?>
                        </div>
                    </td>
                    <td data-label="Price"><?php echo formatCurrency($car['price']); ?></td>
                    <td data-label="Mileage"><?php echo number_format($car['mileage']); ?> mi</td>
                    <td data-label="Status">
                        <span class="badge badge-<?php echo htmlspecialchars($car['status']); ?>">
                            <?php echo ucfirst(htmlspecialchars($car['status'])); ?>
                        </span>
                    </td>
                    <td data-label="Views"><?php echo $car['views']; ?></td>
                    <td data-label="Inquiries"><?php echo $car['inquiries_count']; ?></td>
                    <td data-label="Actions">
                        <div class="table-actions">
                            <a href="<?php echo BASE_URL; ?>/public/cars/details.php?id=<?php echo $car['id']; ?>" target="_blank" class="btn-icon" title="View on website">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="edit.php?id=<?php echo $car['id']; ?>" class="btn-icon" title="Edit car">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" class="inline" onsubmit="return confirm('Toggle featured status?')">
                                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                                <input type="hidden" name="action" value="toggle_featured">
                                <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">
                                <input type="hidden" name="featured" value="<?php echo $car['featured'] ? 0 : 1; ?>">
                                <button type="submit" class="btn-icon <?php echo $car['featured'] ? 'featured' : ''; ?>" title="<?php echo $car['featured'] ? 'Remove from featured' : 'Mark as featured'; ?>">
                                    <i class="fas fa-star"></i>
                                </button>
                            </form>
                            <form method="POST" class="inline delete-btn" onsubmit="return confirm('Are you sure you want to delete this car? This action cannot be undone.')">
                                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">
                                <button type="submit" class="btn-icon btn-icon-danger" title="Delete car">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>

<?php include '../includes/admin-footer.php'; ?>
