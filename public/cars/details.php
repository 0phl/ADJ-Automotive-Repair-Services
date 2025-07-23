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
<div class="bg-gray-50 py-4">
    <div class="container mx-auto px-4">
        <?php echo renderBreadcrumb([
            ['title' => 'Home', 'url' => BASE_URL],
            ['title' => 'Cars for Sale', 'url' => BASE_URL . '/public/cars/'],
            ['title' => $car['year'] . ' ' . $car['make'] . ' ' . $car['model']]
        ]); ?>
    </div>
</div>

<!-- Car Details Section -->
<section class="py-8 bg-gray-50">
    <div class="container mx-auto px-4 max-w-6xl">
        <!-- Car Header -->
        <div class="bg-white rounded-xl p-6 shadow-sm mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">
                        <?php echo htmlspecialchars($car['year'] . ' ' . $car['make'] . ' ' . $car['model']); ?>
                    </h1>
                    <?php if ($car['featured']): ?>
                    <span class="inline-flex items-center gap-1 bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                        <i class="fas fa-star text-green-600"></i>
                        Featured
                    </span>
                    <?php endif; ?>
                </div>
                <div class="text-center lg:text-right">
                    <div class="bg-gradient-to-r from-secondary-yellow to-yellow-500 text-primary-blue px-6 py-4 rounded-xl font-bold text-3xl md:text-4xl shadow-lg">
                        <?php echo formatCurrency($car['price']); ?>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-6 text-sm text-gray-600 border-t pt-4 mt-6">
                <div class="flex items-center gap-2">
                    <i class="fas fa-eye text-primary-blue"></i>
                    <span><?php echo number_format($car['views']); ?> views</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-comments text-primary-blue"></i>
                    <span><?php echo number_format($car['inquiries_count']); ?> inquiries</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-calendar text-primary-blue"></i>
                    <span>Listed <?php echo timeAgo($car['created_at']); ?></span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Image Gallery -->
            <div class="lg:col-span-2">
                <?php if (!empty($images)): ?>
                <!-- Main Image -->
                <div class="mb-6">
                    <img src="<?php echo UPLOADS_URL; ?>/cars/<?php echo $images[0]; ?>"
                         alt="<?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?>"
                         class="w-full h-64 md:h-80 object-cover rounded-xl shadow-lg transition-all duration-300"
                         id="main-image"
                         onerror="this.src='<?php echo ASSETS_URL; ?>/images/placeholder.png'">
                </div>

                <!-- Thumbnail Gallery -->
                <?php if (count($images) > 1): ?>
                <div class="grid grid-cols-4 md:grid-cols-6 gap-3">
                    <?php foreach ($images as $index => $image): ?>
                    <img src="<?php echo UPLOADS_URL; ?>/cars/<?php echo $image; ?>"
                         alt="<?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?> - Image <?php echo $index + 1; ?>"
                         class="w-full h-16 object-cover rounded-lg cursor-pointer border-2 transition-all duration-200 hover:border-primary-blue hover:-translate-y-1 hover:shadow-md <?php echo $index === 0 ? 'border-primary-blue' : 'border-transparent'; ?>"
                         data-full="<?php echo UPLOADS_URL; ?>/cars/<?php echo $image; ?>"
                         onclick="changeMainImage(this)">
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <?php else: ?>
                <!-- Placeholder Image -->
                <div class="mb-6">
                    <img src="<?php echo ASSETS_URL; ?>/images/placeholder.svg"
                         alt="<?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?>"
                         class="w-full h-64 md:h-80 object-cover rounded-xl shadow-lg">
                </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Vehicle Details -->
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-car text-primary-blue"></i>
                        Vehicle Details
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Make</span>
                            <span class="font-semibold text-gray-900"><?php echo htmlspecialchars($car['make']); ?></span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Model</span>
                            <span class="font-semibold text-gray-900"><?php echo htmlspecialchars($car['model']); ?></span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-gray-600">Year</span>
                            <span class="font-semibold text-gray-900"><?php echo $car['year']; ?></span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-600">Mileage</span>
                            <span class="font-semibold text-gray-900"><?php echo number_format($car['mileage']); ?> miles</span>
                        </div>
                    </div>
                </div>

                <!-- Quality Assurance -->
                <div class="bg-gradient-to-br from-success-green to-green-600 rounded-xl p-6 text-white shadow-lg">
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <i class="fas fa-shield-alt"></i>
                        Quality Assurance
                    </h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-green-200"></i>
                            <span>ASE Master Certified Technicians</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-green-200"></i>
                            <span>Over <?php echo BUSINESS_EXPERIENCE; ?> of expertise</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-green-200"></i>
                            <span>Veteran-owned business</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-green-200"></i>
                            <span>Located in Yigo, Guam</span>
                        </li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Contact Us</h3>

                    <div class="space-y-3">
                        <a href="<?php echo BASE_URL; ?>/public/car-inquiry.php?car_id=<?php echo $car['id']; ?>"
                           class="btn-primary w-full text-center">
                            <i class="fas fa-envelope mr-2"></i>Send Inquiry
                        </a>

                        <div class="grid grid-cols-2 gap-3">
                            <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank"
                               class="inline-flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white py-2.5 px-4 rounded-lg font-semibold text-sm transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                                <i class="fab fa-whatsapp"></i>WhatsApp
                            </a>

                            <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>"
                               class="inline-flex items-center justify-center gap-2 bg-secondary-yellow hover:bg-yellow-500 text-primary-blue py-2.5 px-4 rounded-lg font-semibold text-sm transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg">
                                <i class="fas fa-phone"></i>Call
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description Section (Full Width) -->
        <?php if (!empty($car['description'])): ?>
        <div class="bg-white rounded-xl p-6 shadow-sm mt-8">
            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fas fa-file-alt text-primary-blue"></i>
                Description
            </h3>
            <div class="prose prose-gray max-w-none">
                <p class="text-gray-700 leading-relaxed">
                    <?php echo nl2br(htmlspecialchars($car['description'])); ?>
                </p>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Related Cars -->
<?php if (!empty($relatedCars)): ?>
<section class="py-12 bg-white">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Similar Cars</h2>
            <p class="text-gray-600">Discover other vehicles that might interest you</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php foreach (array_slice($relatedCars, 0, 3) as $relatedCar): ?>
            <div class="card group">
                <div class="relative overflow-hidden">
                    <?php
                    $relatedImages = json_decode($relatedCar['images'], true);
                    $relatedMainImage = !empty($relatedImages) ? $relatedImages[0] : 'placeholder.svg';
                    ?>
                    <img src="<?php echo !empty($relatedImages) ? UPLOADS_URL . '/cars/' . $relatedMainImage : ASSETS_URL . '/images/placeholder.svg'; ?>"
                         alt="<?php echo htmlspecialchars($relatedCar['make'] . ' ' . $relatedCar['model']); ?>"
                         class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                         onerror="this.src='<?php echo ASSETS_URL; ?>/images/placeholder.svg'">

                    <div class="absolute top-3 right-3 bg-secondary-yellow text-primary-blue px-2 py-1 rounded-lg font-bold text-sm shadow-lg">
                        <?php echo formatCurrency($relatedCar['price']); ?>
                    </div>
                </div>

                <div class="p-4">
                    <h3 class="text-lg font-bold text-gray-900 mb-3 leading-tight">
                        <?php echo htmlspecialchars($relatedCar['year'] . ' ' . $relatedCar['make'] . ' ' . $relatedCar['model']); ?>
                    </h3>

                    <div class="flex justify-between items-center text-sm text-gray-600 mb-4">
                        <div class="flex items-center gap-1">
                            <i class="fas fa-calendar text-primary-blue"></i>
                            <span><?php echo $relatedCar['year']; ?></span>
                        </div>
                        <div class="flex items-center gap-1">
                            <i class="fas fa-tachometer-alt text-primary-blue"></i>
                            <span><?php echo number_format($relatedCar['mileage']); ?> mi</span>
                        </div>
                    </div>

                    <a href="details.php?id=<?php echo $relatedCar['id']; ?>"
                       class="btn-primary w-full text-center text-sm py-2">
                        View Details
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-8">
            <a href="<?php echo BASE_URL; ?>/public/cars/"
               class="inline-flex items-center gap-2 bg-white text-primary-blue border-2 border-primary-blue py-3 px-6 rounded-lg font-semibold transition-all duration-300 hover:bg-primary-blue hover:text-white hover:-translate-y-0.5 hover:shadow-lg">
                <i class="fas fa-car"></i>
                View All Cars
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- JavaScript for Image Gallery -->
<script>
function changeMainImage(thumbnail) {
    const mainImage = document.getElementById('main-image');
    const fullImageUrl = thumbnail.getAttribute('data-full');

    if (mainImage && fullImageUrl) {
        mainImage.src = fullImageUrl;

        // Update active thumbnail - remove border from all thumbnails
        document.querySelectorAll('[data-full]').forEach(thumb => {
            thumb.classList.remove('border-primary-blue');
            thumb.classList.add('border-transparent');
        });

        // Add border to clicked thumbnail
        thumbnail.classList.remove('border-transparent');
        thumbnail.classList.add('border-primary-blue');
    }
}

// Initialize gallery
document.addEventListener('DOMContentLoaded', function() {
    const thumbnails = document.querySelectorAll('[data-full]');
    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            changeMainImage(this);
        });
    });

    // Add smooth loading for images
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        img.style.opacity = '0';
        img.addEventListener('load', function() {
            this.style.transition = 'opacity 0.3s ease';
            this.style.opacity = '1';
        });

        // If image is already loaded (cached)
        if (img.complete) {
            img.style.opacity = '1';
        }
    });
});
</script>

<?php include '../../includes/footer.php'; ?>
