<?php
/**
 * ADJ Automotive Repair Services - Car Details Page
 * Individual car details with image gallery and inquiry form
 */

// Include configuration and functions
require_once '../../config/config.php';
require_once '../../includes/functions.php';
require_once '../../includes/navigation.php';

// Get car ID
$carId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$carId) {
    header('Location: ' . BASE_URL . '/public/cars/');
    exit;
}

// Get car details
$car = getCarById($carId);

if (!$car || $car['status'] !== 'available') {
    header('Location: ' . BASE_URL . '/public/cars/');
    exit;
}

// Increment view count
incrementCarViews($carId);

// Parse images
$images = json_decode($car['images'], true) ?: [];

// Page variables
$pageTitle = $car['year'] . ' ' . $car['make'] . ' ' . $car['model'];
$pageDescription = 'View details for this ' . $car['year'] . ' ' . $car['make'] . ' ' . $car['model'] . ' for sale at ADJ Automotive Repair Services in Guam. Price: ' . formatCurrency($car['price']);

// Get related cars (same make or similar price range)
$relatedCars = getCars([
    'status' => 'available',
    'make' => $car['make']
], 3);

// If not enough related cars by make, get by price range
if (count($relatedCars) < 3) {
    $priceMin = $car['price'] * 0.8;
    $priceMax = $car['price'] * 1.2;
    $relatedCars = getCars([
        'status' => 'available',
        'price_min' => $priceMin,
        'price_max' => $priceMax
    ], 3);
}

// Remove current car from related cars
$relatedCars = array_filter($relatedCars, function($relatedCar) use ($carId) {
    return $relatedCar['id'] != $carId;
});

// Include header
include '../../includes/header.php';
?>

<!-- Breadcrumb -->
<?php echo renderBreadcrumb([
    ['title' => 'Home', 'url' => BASE_URL],
    ['title' => 'Cars for Sale', 'url' => BASE_URL . '/public/cars/'],
    ['title' => $car['year'] . ' ' . $car['make'] . ' ' . $car['model']]
]); ?>

<!-- Car Details Section -->
<section class="py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Image Gallery -->
            <div class="car-gallery">
                <?php if (!empty($images)): ?>
                <!-- Main Image -->
                <div class="mb-4">
                    <img src="<?php echo UPLOADS_URL; ?>/cars/<?php echo $images[0]; ?>" 
                         alt="<?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?>" 
                         class="main-image w-full h-96 object-cover rounded-lg shadow-lg"
                         onerror="this.src='<?php echo ASSETS_URL; ?>/images/placeholder.png'">
                </div>
                
                <!-- Thumbnail Gallery -->
                <?php if (count($images) > 1): ?>
                <div class="grid grid-cols-4 gap-2">
                    <?php foreach ($images as $index => $image): ?>
                    <img src="<?php echo UPLOADS_URL; ?>/cars/<?php echo $image; ?>" 
                         alt="<?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?> - Image <?php echo $index + 1; ?>" 
                         class="thumbnail w-full h-20 object-cover rounded cursor-pointer hover:opacity-75 transition-opacity <?php echo $index === 0 ? 'active ring-2 ring-primary-blue' : ''; ?>"
                         data-full="<?php echo UPLOADS_URL; ?>/cars/<?php echo $image; ?>"
                         onclick="changeMainImage(this)">
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <?php else: ?>
                <!-- Placeholder Image -->
                <div class="mb-4">
                    <img src="<?php echo ASSETS_URL; ?>/images/placeholder.svg"
                         alt="<?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?>" 
                         class="w-full h-96 object-cover rounded-lg shadow-lg">
                </div>
                <?php endif; ?>
            </div>
            
            <!-- Car Information -->
            <div>
                <!-- Header -->
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <h1 class="text-3xl font-bold text-dark-gray">
                            <?php echo htmlspecialchars($car['year'] . ' ' . $car['make'] . ' ' . $car['model']); ?>
                        </h1>
                        <?php if ($car['featured']): ?>
                        <span class="badge badge-success">Featured</span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="text-4xl font-bold text-secondary-orange mb-4">
                        <?php echo formatCurrency($car['price']); ?>
                    </div>
                    
                    <div class="flex items-center text-sm text-gray-600 space-x-4">
                        <span><i class="fas fa-eye mr-1"></i><?php echo $car['views']; ?> views</span>
                        <span><i class="fas fa-comments mr-1"></i><?php echo $car['inquiries_count']; ?> inquiries</span>
                        <span><i class="fas fa-calendar mr-1"></i>Listed <?php echo timeAgo($car['created_at']); ?></span>
                    </div>
                </div>
                
                <!-- Key Details -->
                <div class="bg-light-gray p-6 rounded-lg mb-6">
                    <h3 class="text-lg font-semibold text-dark-gray mb-4">Vehicle Details</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-center">
                            <i class="fas fa-car text-primary-blue mr-3"></i>
                            <div>
                                <span class="text-sm text-gray-600">Make</span>
                                <p class="font-semibold"><?php echo htmlspecialchars($car['make']); ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <i class="fas fa-tag text-primary-blue mr-3"></i>
                            <div>
                                <span class="text-sm text-gray-600">Model</span>
                                <p class="font-semibold"><?php echo htmlspecialchars($car['model']); ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <i class="fas fa-calendar text-primary-blue mr-3"></i>
                            <div>
                                <span class="text-sm text-gray-600">Year</span>
                                <p class="font-semibold"><?php echo $car['year']; ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <i class="fas fa-tachometer-alt text-primary-blue mr-3"></i>
                            <div>
                                <span class="text-sm text-gray-600">Mileage</span>
                                <p class="font-semibold"><?php echo number_format($car['mileage']); ?> miles</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Description -->
                <?php if (!empty($car['description'])): ?>
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-dark-gray mb-3">Description</h3>
                    <p class="text-gray-600 leading-relaxed">
                        <?php echo nl2br(htmlspecialchars($car['description'])); ?>
                    </p>
                </div>
                <?php endif; ?>
                
                <!-- Quality Assurance -->
                <div class="bg-success-green text-white p-6 rounded-lg mb-6">
                    <h3 class="text-lg font-semibold mb-3">
                        <i class="fas fa-shield-alt mr-2"></i>Quality Assurance
                    </h3>
                    <ul class="space-y-2 text-sm">
                        <li><i class="fas fa-check mr-2"></i>Inspected by ASE Master Certified Technicians</li>
                        <li><i class="fas fa-check mr-2"></i>Over <?php echo BUSINESS_EXPERIENCE; ?> of automotive expertise</li>
                        <li><i class="fas fa-check mr-2"></i>Veteran-owned business you can trust</li>
                        <li><i class="fas fa-check mr-2"></i>Located in Yigo, Guam</li>
                    </ul>
                </div>
                
                <!-- Action Buttons -->
                <div class="space-y-4">
                    <a href="<?php echo BASE_URL; ?>/public/car-inquiry.php?car_id=<?php echo $car['id']; ?>" 
                       class="btn-primary w-full text-center block">
                        <i class="fas fa-envelope mr-2"></i>Send Inquiry
                    </a>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank" 
                           class="bg-success-green text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-600 transition-colors text-center">
                            <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                        </a>
                        
                        <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>" 
                           class="bg-secondary-orange text-white px-6 py-3 rounded-lg font-semibold hover:bg-orange-600 transition-colors text-center">
                            <i class="fas fa-phone mr-2"></i>Call Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Cars -->
<?php if (!empty($relatedCars)): ?>
<section class="py-12 bg-light-gray">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-dark-gray text-center mb-8">Similar Cars</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach (array_slice($relatedCars, 0, 3) as $relatedCar): ?>
            <div class="card overflow-hidden">
                <div class="relative">
                    <?php
                    $relatedImages = json_decode($relatedCar['images'], true);
                    $relatedMainImage = !empty($relatedImages) ? $relatedImages[0] : 'placeholder.svg';
                    ?>
                    <img src="<?php echo !empty($relatedImages) ? UPLOADS_URL . '/cars/' . $relatedMainImage : ASSETS_URL . '/images/placeholder.svg'; ?>"
                         alt="<?php echo htmlspecialchars($relatedCar['make'] . ' ' . $relatedCar['model']); ?>"
                         class="w-full h-48 object-cover"
                         onerror="this.src='<?php echo ASSETS_URL; ?>/images/placeholder.svg'">
                    
                    <div class="absolute top-4 right-4 bg-white px-3 py-1 rounded-lg font-bold text-primary-blue">
                        <?php echo formatCurrency($relatedCar['price']); ?>
                    </div>
                </div>
                
                <div class="p-6">
                    <h3 class="text-xl font-bold text-dark-gray mb-2">
                        <?php echo htmlspecialchars($relatedCar['year'] . ' ' . $relatedCar['make'] . ' ' . $relatedCar['model']); ?>
                    </h3>
                    
                    <div class="flex justify-between text-sm text-gray-600 mb-4">
                        <span><i class="fas fa-calendar mr-1"></i><?php echo $relatedCar['year']; ?></span>
                        <span><i class="fas fa-tachometer-alt mr-1"></i><?php echo number_format($relatedCar['mileage']); ?> miles</span>
                    </div>
                    
                    <a href="details.php?id=<?php echo $relatedCar['id']; ?>" class="btn-primary w-full text-center">
                        View Details
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-8">
            <a href="<?php echo BASE_URL; ?>/public/cars/" class="btn-secondary">
                View All Cars
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- JavaScript for Image Gallery -->
<script>
function changeMainImage(thumbnail) {
    const mainImage = document.querySelector('.main-image');
    const fullImageUrl = thumbnail.getAttribute('data-full');
    
    if (mainImage && fullImageUrl) {
        mainImage.src = fullImageUrl;
        
        // Update active thumbnail
        document.querySelectorAll('.thumbnail').forEach(thumb => {
            thumb.classList.remove('active', 'ring-2', 'ring-primary-blue');
        });
        thumbnail.classList.add('active', 'ring-2', 'ring-primary-blue');
    }
}

// Initialize gallery
document.addEventListener('DOMContentLoaded', function() {
    const thumbnails = document.querySelectorAll('.thumbnail');
    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            changeMainImage(this);
        });
    });
});
</script>

<?php include '../../includes/footer.php'; ?>
