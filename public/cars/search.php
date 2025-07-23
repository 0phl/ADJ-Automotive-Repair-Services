<?php
/**
 * ADJ Automotive Repair Services - Car Search
 * Advanced search functionality for car inventory
 */

// Include configuration and functions
require_once '../../config/config.php';
require_once '../../includes/functions.php';
require_once '../../includes/navigation.php';

// Page variables
$pageTitle = 'Search Cars';
$pageDescription = 'Search our inventory of quality pre-owned vehicles for sale in Guam at ADJ Automotive Repair Services.';

// Get search parameters
$searchQuery = isset($_GET['q']) ? sanitizeInput($_GET['q']) : '';
$make = isset($_GET['make']) ? sanitizeInput($_GET['make']) : '';
$model = isset($_GET['model']) ? sanitizeInput($_GET['model']) : '';
$yearMin = isset($_GET['year_min']) ? (int)$_GET['year_min'] : '';
$yearMax = isset($_GET['year_max']) ? (int)$_GET['year_max'] : '';
$priceMin = isset($_GET['price_min']) ? (float)$_GET['price_min'] : '';
$priceMax = isset($_GET['price_max']) ? (float)$_GET['price_max'] : '';
$mileageMax = isset($_GET['mileage_max']) ? (int)$_GET['mileage_max'] : '';

// Build search filters
$filters = ['status' => 'available'];

if (!empty($make)) {
    $filters['make'] = $make;
}
if (!empty($yearMin)) {
    $filters['year_min'] = $yearMin;
}
if (!empty($yearMax)) {
    $filters['year_max'] = $yearMax;
}
if (!empty($priceMin)) {
    $filters['price_min'] = $priceMin;
}
if (!empty($priceMax)) {
    $filters['price_max'] = $priceMax;
}

// Get search results
$searchResults = [];
$hasSearch = !empty($searchQuery) || !empty($make) || !empty($yearMin) || !empty($yearMax) || !empty($priceMin) || !empty($priceMax) || !empty($mileageMax);

if ($hasSearch) {
    $searchResults = getCars($filters);
    
    // Additional filtering for text search and mileage
    if (!empty($searchQuery) || !empty($model) || !empty($mileageMax)) {
        $searchResults = array_filter($searchResults, function($car) use ($searchQuery, $model, $mileageMax) {
            $match = true;
            
            // Text search in make, model, description
            if (!empty($searchQuery)) {
                $searchText = strtolower($searchQuery);
                $carText = strtolower($car['make'] . ' ' . $car['model'] . ' ' . $car['description']);
                $match = $match && (strpos($carText, $searchText) !== false);
            }
            
            // Model filter
            if (!empty($model)) {
                $match = $match && (stripos($car['model'], $model) !== false);
            }
            
            // Mileage filter
            if (!empty($mileageMax)) {
                $match = $match && ($car['mileage'] <= $mileageMax);
            }
            
            return $match;
        });
    }
}

// Get filter options
$carMakes = getCarMakes();
$yearRange = getCarYearsRange();

// Include header
include '../../includes/header.php';
?>

<!-- Breadcrumb -->
<?php echo renderBreadcrumb(); ?>

<!-- Page Header -->
<section class="bg-primary-blue text-white py-12">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Search Cars</h1>
            <p class="text-xl opacity-90">Find your perfect vehicle with our advanced search</p>
        </div>
    </div>
</section>

<!-- Advanced Search Form -->
<section class="py-8 bg-light-gray">
    <div class="container mx-auto px-4">
        <form method="GET" class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-dark-gray mb-6">Advanced Search</h2>
            
            <!-- Text Search -->
            <div class="mb-6">
                <label class="form-label">Search Keywords</label>
                <input type="text" name="q" value="<?php echo htmlspecialchars($searchQuery); ?>" 
                       class="form-input" placeholder="Search by make, model, or description...">
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Make -->
                <div>
                    <label class="form-label">Make</label>
                    <select name="make" class="form-input">
                        <option value="">All Makes</option>
                        <?php foreach ($carMakes as $makeOption): ?>
                        <option value="<?php echo htmlspecialchars($makeOption['make']); ?>" 
                                <?php echo ($make === $makeOption['make']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($makeOption['make']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <!-- Model -->
                <div>
                    <label class="form-label">Model</label>
                    <input type="text" name="model" value="<?php echo htmlspecialchars($model); ?>" 
                           class="form-input" placeholder="Enter model name...">
                </div>
                
                <!-- Year Range -->
                <div>
                    <label class="form-label">Year Range</label>
                    <div class="grid grid-cols-2 gap-2">
                        <select name="year_min" class="form-input">
                            <option value="">Min Year</option>
                            <?php for ($year = $yearRange['min_year']; $year <= $yearRange['max_year']; $year++): ?>
                            <option value="<?php echo $year; ?>" <?php echo ($yearMin === $year) ? 'selected' : ''; ?>>
                                <?php echo $year; ?>
                            </option>
                            <?php endfor; ?>
                        </select>
                        <select name="year_max" class="form-input">
                            <option value="">Max Year</option>
                            <?php for ($year = $yearRange['min_year']; $year <= $yearRange['max_year']; $year++): ?>
                            <option value="<?php echo $year; ?>" <?php echo ($yearMax === $year) ? 'selected' : ''; ?>>
                                <?php echo $year; ?>
                            </option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
                
                <!-- Price Range -->
                <div>
                    <label class="form-label">Price Range</label>
                    <div class="grid grid-cols-2 gap-2">
                        <select name="price_min" class="form-input">
                            <option value="">Min Price</option>
                            <option value="5000" <?php echo ($priceMin === 5000.0) ? 'selected' : ''; ?>>$5,000</option>
                            <option value="10000" <?php echo ($priceMin === 10000.0) ? 'selected' : ''; ?>>$10,000</option>
                            <option value="15000" <?php echo ($priceMin === 15000.0) ? 'selected' : ''; ?>>$15,000</option>
                            <option value="20000" <?php echo ($priceMin === 20000.0) ? 'selected' : ''; ?>>$20,000</option>
                            <option value="25000" <?php echo ($priceMin === 25000.0) ? 'selected' : ''; ?>>$25,000</option>
                        </select>
                        <select name="price_max" class="form-input">
                            <option value="">Max Price</option>
                            <option value="10000" <?php echo ($priceMax === 10000.0) ? 'selected' : ''; ?>>$10,000</option>
                            <option value="15000" <?php echo ($priceMax === 15000.0) ? 'selected' : ''; ?>>$15,000</option>
                            <option value="20000" <?php echo ($priceMax === 20000.0) ? 'selected' : ''; ?>>$20,000</option>
                            <option value="25000" <?php echo ($priceMax === 25000.0) ? 'selected' : ''; ?>>$25,000</option>
                            <option value="30000" <?php echo ($priceMax === 30000.0) ? 'selected' : ''; ?>>$30,000</option>
                            <option value="50000" <?php echo ($priceMax === 50000.0) ? 'selected' : ''; ?>>$50,000+</option>
                        </select>
                    </div>
                </div>
                
                <!-- Mileage -->
                <div>
                    <label class="form-label">Maximum Mileage</label>
                    <select name="mileage_max" class="form-input">
                        <option value="">Any Mileage</option>
                        <option value="25000" <?php echo ($mileageMax === 25000) ? 'selected' : ''; ?>>Under 25,000 miles</option>
                        <option value="50000" <?php echo ($mileageMax === 50000) ? 'selected' : ''; ?>>Under 50,000 miles</option>
                        <option value="75000" <?php echo ($mileageMax === 75000) ? 'selected' : ''; ?>>Under 75,000 miles</option>
                        <option value="100000" <?php echo ($mileageMax === 100000) ? 'selected' : ''; ?>>Under 100,000 miles</option>
                        <option value="150000" <?php echo ($mileageMax === 150000) ? 'selected' : ''; ?>>Under 150,000 miles</option>
                    </select>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 mt-8">
                <button type="submit" class="btn-primary flex-1">
                    <i class="fas fa-search mr-2"></i>Search Cars
                </button>
                <a href="search.php" class="btn-secondary flex-1 text-center">
                    <i class="fas fa-refresh mr-2"></i>Clear Search
                </a>
            </div>
        </form>
    </div>
</section>

<!-- Search Results -->
<section class="py-12">
    <div class="container mx-auto px-4">
        <?php if ($hasSearch): ?>
        <!-- Results Header -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-dark-gray mb-2">
                Search Results
                <span class="text-secondary-orange">(<?php echo count($searchResults); ?> cars found)</span>
            </h2>
            
            <?php if (!empty($searchQuery) || !empty($make) || !empty($model)): ?>
            <p class="text-gray-600">
                Showing results for: 
                <?php 
                $searchTerms = [];
                if (!empty($searchQuery)) $searchTerms[] = '"' . htmlspecialchars($searchQuery) . '"';
                if (!empty($make)) $searchTerms[] = htmlspecialchars($make);
                if (!empty($model)) $searchTerms[] = htmlspecialchars($model);
                echo implode(', ', $searchTerms);
                ?>
            </p>
            <?php endif; ?>
        </div>
        
        <?php if (empty($searchResults)): ?>
        <!-- No Results -->
        <div class="text-center py-12">
            <div class="bg-light-gray rounded-lg p-8 max-w-md mx-auto">
                <i class="fas fa-search text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No Cars Found</h3>
                <p class="text-gray-500 mb-4">Try adjusting your search criteria or browse all available cars.</p>
                <a href="<?php echo BASE_URL; ?>/public/cars/" class="btn-primary">
                    View All Cars
                </a>
            </div>
        </div>
        <?php else: ?>
        <!-- Results Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($searchResults as $car): ?>
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
                    
                    <?php if ($car['featured']): ?>
                    <div class="absolute top-4 left-4">
                        <span class="badge badge-success">Featured</span>
                    </div>
                    <?php endif; ?>
                    
                    <div class="absolute top-4 right-4 bg-white px-3 py-1 rounded-lg font-bold text-primary-blue shadow-lg">
                        <?php echo formatCurrency($car['price']); ?>
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
        <?php endif; ?>
        
        <?php else: ?>
        <!-- Search Instructions -->
        <div class="text-center py-12">
            <div class="max-w-2xl mx-auto">
                <i class="fas fa-search text-6xl text-primary-blue mb-6"></i>
                <h2 class="text-3xl font-bold text-dark-gray mb-4">Find Your Perfect Car</h2>
                <p class="text-lg text-gray-600 mb-8">
                    Use our advanced search to find exactly what you're looking for. 
                    Search by make, model, year, price range, and more.
                </p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
                    <div class="bg-light-gray p-6 rounded-lg">
                        <i class="fas fa-filter text-2xl text-primary-blue mb-3"></i>
                        <h3 class="font-semibold mb-2">Advanced Filters</h3>
                        <p class="text-sm text-gray-600">Filter by make, model, year, price, and mileage</p>
                    </div>
                    <div class="bg-light-gray p-6 rounded-lg">
                        <i class="fas fa-shield-alt text-2xl text-success-green mb-3"></i>
                        <h3 class="font-semibold mb-2">Quality Assured</h3>
                        <p class="text-sm text-gray-600">All vehicles inspected by ASE certified technicians</p>
                    </div>
                    <div class="bg-light-gray p-6 rounded-lg">
                        <i class="fab fa-whatsapp text-2xl text-success-green mb-3"></i>
                        <h3 class="font-semibold mb-2">Quick Contact</h3>
                        <p class="text-sm text-gray-600">Instant WhatsApp contact for any vehicle</p>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php include '../../includes/footer.php'; ?>
