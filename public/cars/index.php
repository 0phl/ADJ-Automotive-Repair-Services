<?php
/**
 * ADJ Automotive Repair Services - Car Inventory Listings
 * Public page showing all available cars for sale
 */

// Include configuration and functions
require_once '../../config/config.php';
require_once '../../includes/functions.php';
require_once '../../includes/navigation.php';

// Page variables
$pageTitle = 'Cars for Sale';
$pageDescription = 'Quality pre-owned vehicles for sale in Guam. All cars inspected by ASE certified technicians at ADJ Automotive Repair Services.';

// Get filter parameters
$filters = [];
if (isset($_GET['make']) && !empty($_GET['make'])) {
    $filters['make'] = sanitizeInput($_GET['make']);
}
if (isset($_GET['year_min']) && !empty($_GET['year_min'])) {
    $filters['year_min'] = (int)$_GET['year_min'];
}
if (isset($_GET['year_max']) && !empty($_GET['year_max'])) {
    $filters['year_max'] = (int)$_GET['year_max'];
}
if (isset($_GET['price_min']) && !empty($_GET['price_min'])) {
    $filters['price_min'] = (float)$_GET['price_min'];
}
if (isset($_GET['price_max']) && !empty($_GET['price_max'])) {
    $filters['price_max'] = (float)$_GET['price_max'];
}

// Always filter for available cars
$filters['status'] = 'available';

// Pagination
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = CARS_PER_PAGE;
$offset = ($page - 1) * $limit;

// Get cars and total count
$cars = getCars($filters, $limit, $offset);
$totalCars = count(getCars($filters)); // Get total for pagination

// Get filter options
$carMakes = getCarMakes();
$yearRange = getCarYearsRange();
$priceRange = getCarPriceRange();

// Calculate pagination
$totalPages = ceil($totalCars / $limit);

// Include header
include '../../includes/header.php';
?>

<!-- Breadcrumb -->
<?php echo renderBreadcrumb(); ?>

<!-- Page Header -->
<section class="bg-primary-blue text-white py-12">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Cars for Sale</h1>
            <p class="text-xl opacity-90">Quality pre-owned vehicles inspected by our ASE certified technicians</p>
            <div class="mt-6">
                <span class="bg-secondary-orange px-4 py-2 rounded-lg font-semibold">
                    <?php echo $totalCars; ?> Cars Available
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Search and Filter Section -->
<section class="bg-light-gray py-8">
    <div class="container mx-auto px-4">
        <form method="GET" class="bg-white p-6 rounded-lg shadow-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Make Filter -->
                <div>
                    <label class="form-label">Make</label>
                    <select name="make" class="form-input">
                        <option value="">All Makes</option>
                        <?php foreach ($carMakes as $make): ?>
                        <option value="<?php echo htmlspecialchars($make['make']); ?>" 
                                <?php echo (isset($filters['make']) && $filters['make'] === $make['make']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($make['make']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <!-- Year Range -->
                <div>
                    <label class="form-label">Min Year</label>
                    <select name="year_min" class="form-input">
                        <option value="">Any Year</option>
                        <?php for ($year = $yearRange['max_year']; $year >= $yearRange['min_year']; $year--): ?>
                        <option value="<?php echo $year; ?>" 
                                <?php echo (isset($filters['year_min']) && $filters['year_min'] === $year) ? 'selected' : ''; ?>>
                            <?php echo $year; ?>
                        </option>
                        <?php endfor; ?>
                    </select>
                </div>
                
                <div>
                    <label class="form-label">Max Year</label>
                    <select name="year_max" class="form-input">
                        <option value="">Any Year</option>
                        <?php for ($year = $yearRange['max_year']; $year >= $yearRange['min_year']; $year--): ?>
                        <option value="<?php echo $year; ?>" 
                                <?php echo (isset($filters['year_max']) && $filters['year_max'] === $year) ? 'selected' : ''; ?>>
                            <?php echo $year; ?>
                        </option>
                        <?php endfor; ?>
                    </select>
                </div>
                
                <!-- Price Range -->
                <div>
                    <label class="form-label">Min Price</label>
                    <select name="price_min" class="form-input">
                        <option value="">Any Price</option>
                        <option value="5000" <?php echo (isset($filters['price_min']) && $filters['price_min'] === 5000.0) ? 'selected' : ''; ?>>$5,000</option>
                        <option value="10000" <?php echo (isset($filters['price_min']) && $filters['price_min'] === 10000.0) ? 'selected' : ''; ?>>$10,000</option>
                        <option value="15000" <?php echo (isset($filters['price_min']) && $filters['price_min'] === 15000.0) ? 'selected' : ''; ?>>$15,000</option>
                        <option value="20000" <?php echo (isset($filters['price_min']) && $filters['price_min'] === 20000.0) ? 'selected' : ''; ?>>$20,000</option>
                        <option value="25000" <?php echo (isset($filters['price_min']) && $filters['price_min'] === 25000.0) ? 'selected' : ''; ?>>$25,000</option>
                    </select>
                </div>
                
                <div>
                    <label class="form-label">Max Price</label>
                    <select name="price_max" class="form-input">
                        <option value="">Any Price</option>
                        <option value="10000" <?php echo (isset($filters['price_max']) && $filters['price_max'] === 10000.0) ? 'selected' : ''; ?>>$10,000</option>
                        <option value="15000" <?php echo (isset($filters['price_max']) && $filters['price_max'] === 15000.0) ? 'selected' : ''; ?>>$15,000</option>
                        <option value="20000" <?php echo (isset($filters['price_max']) && $filters['price_max'] === 20000.0) ? 'selected' : ''; ?>>$20,000</option>
                        <option value="25000" <?php echo (isset($filters['price_max']) && $filters['price_max'] === 25000.0) ? 'selected' : ''; ?>>$25,000</option>
                        <option value="30000" <?php echo (isset($filters['price_max']) && $filters['price_max'] === 30000.0) ? 'selected' : ''; ?>>$30,000</option>
                        <option value="50000" <?php echo (isset($filters['price_max']) && $filters['price_max'] === 50000.0) ? 'selected' : ''; ?>>$50,000+</option>
                    </select>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 mt-6">
                <button type="submit" class="btn-primary flex-1">
                    <i class="fas fa-search mr-2"></i>Search Cars
                </button>
                <a href="<?php echo BASE_URL; ?>/public/cars/" class="btn-secondary flex-1 text-center">
                    <i class="fas fa-refresh mr-2"></i>Clear Filters
                </a>
            </div>
        </form>
    </div>
</section>

<!-- Cars Grid -->
<section class="py-12">
    <div class="container mx-auto px-4">
        <?php if (empty($cars)): ?>
        <!-- No Cars Found -->
        <div class="text-center py-12">
            <div class="bg-light-gray rounded-lg p-8 max-w-md mx-auto">
                <i class="fas fa-car text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No Cars Found</h3>
                <p class="text-gray-500 mb-4">Try adjusting your search filters or check back later for new inventory.</p>
                <a href="<?php echo BASE_URL; ?>/public/cars/" class="btn-primary">
                    View All Cars
                </a>
            </div>
        </div>
        <?php else: ?>
        <!-- Cars Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($cars as $car): ?>
            <div class="card overflow-hidden">
                <div class="relative">
                    <?php
                    $images = json_decode($car['images'], true);
                    $mainImage = !empty($images) ? $images[0] : 'placeholder.svg';
                    ?>
                    <img src="<?php echo !empty($images) ? UPLOADS_URL . '/cars/' . $mainImage : ASSETS_URL . '/images/placeholder.svg'; ?>"
                         alt="<?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?>"
                         class="w-full h-48 object-cover"
                         onerror="this.src='<?php echo ASSETS_URL; ?>/images/placeholder.svg'">
                    
                    <!-- Featured Badge -->
                    <?php if ($car['featured']): ?>
                    <div class="absolute top-4 left-4">
                        <span class="badge badge-success">Featured</span>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Price Badge -->
                    <div class="absolute top-4 right-4 bg-white px-3 py-1 rounded-lg font-bold text-primary-blue shadow-lg">
                        <?php echo formatCurrency($car['price']); ?>
                    </div>
                    
                    <!-- Quick Actions Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <div class="flex gap-2">
                            <a href="details.php?id=<?php echo $car['id']; ?>" class="bg-primary-blue text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-eye mr-2"></i>View Details
                            </a>
                            <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank" class="bg-success-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
                                <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <h3 class="text-xl font-bold text-dark-gray mb-2">
                        <?php echo htmlspecialchars($car['year'] . ' ' . $car['make'] . ' ' . $car['model']); ?>
                    </h3>
                    
                    <div class="grid grid-cols-2 gap-4 text-sm text-gray-600 mb-4">
                        <div class="flex items-center">
                            <i class="fas fa-calendar mr-2 text-primary-blue"></i>
                            <span><?php echo $car['year']; ?></span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-tachometer-alt mr-2 text-primary-blue"></i>
                            <span><?php echo number_format($car['mileage']); ?> miles</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-eye mr-2 text-primary-blue"></i>
                            <span><?php echo $car['views']; ?> views</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-comments mr-2 text-primary-blue"></i>
                            <span><?php echo $car['inquiries_count']; ?> inquiries</span>
                        </div>
                    </div>
                    
                    <p class="text-gray-600 mb-6">
                        <?php echo htmlspecialchars(truncateText($car['description'], 100)); ?>
                    </p>
                    
                    <div class="flex gap-2">
                        <a href="details.php?id=<?php echo $car['id']; ?>" class="btn-primary flex-1 text-center">
                            View Details
                        </a>
                        <a href="<?php echo BASE_URL; ?>/public/car-inquiry.php?car_id=<?php echo $car['id']; ?>" class="btn-secondary flex-1 text-center">
                            Inquire
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
        <div class="mt-12 flex justify-center">
            <nav class="flex items-center space-x-2">
                <?php if ($page > 1): ?>
                <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page - 1])); ?>" 
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    <i class="fas fa-chevron-left mr-2"></i>Previous
                </a>
                <?php endif; ?>
                
                <?php for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++): ?>
                <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>" 
                   class="px-4 py-2 <?php echo $i === $page ? 'bg-primary-blue text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300'; ?> rounded-lg transition-colors">
                    <?php echo $i; ?>
                </a>
                <?php endfor; ?>
                
                <?php if ($page < $totalPages): ?>
                <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page + 1])); ?>" 
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Next<i class="fas fa-chevron-right ml-2"></i>
                </a>
                <?php endif; ?>
            </nav>
        </div>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<!-- Call to Action -->
<section class="bg-primary-blue text-white py-12">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Don't See What You're Looking For?</h2>
        <p class="text-xl mb-6 opacity-90">Contact us about upcoming inventory or special requests</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank" class="btn-secondary">
                <i class="fab fa-whatsapp mr-2"></i>WhatsApp Us
            </a>
            <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>" class="bg-white text-primary-blue px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                <i class="fas fa-phone mr-2"></i><?php echo BUSINESS_PHONE; ?>
            </a>
        </div>
    </div>
</section>

<?php include '../../includes/footer.php'; ?>
