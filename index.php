<?php
/**
 * ADJ Automotive Repair Services - Homepage
 * Main landing page with hero section, featured services, and cars
 */

// Include configuration and functions
require_once 'config/config.php';
require_once 'includes/functions.php';
require_once 'includes/navigation.php';

// Page variables
$pageTitle = 'Home';
$pageDescription = 'ADJ Automotive Repair Services - Veteran-owned automotive repair in Guam. Specializing in transmission rebuilding, engine repair, and advanced diagnostics. ASE Master Certified with 38+ years experience.';

// Get featured content
try {
    $featuredServices = getFeaturedServices(3);
    $featuredCars = getFeaturedCars(3); // Show 3 cars as requested
} catch (Exception $e) {
    error_log("Error getting featured content: " . $e->getMessage());
    $featuredServices = [];
    $featuredCars = [];
}

// Get homepage content blocks
$heroContent = getContentBlock('homepage', 'hero_title');
$aboutContent = getContentBlock('homepage', 'about_content');
$certificationsContent = getContentBlock('homepage', 'certifications_content');
$warrantyContent = getContentBlock('homepage', 'warranty_content');

// Include header
include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="relative min-h-screen flex items-center text-white overflow-hidden">
    <div class="absolute inset-0 z-0 bg-cover bg-center bg-no-repeat" style="background-image: url('assets/images/background.jpg');">
        <div class="absolute inset-0 hero-gradient"></div>
    </div>

    <div class="relative z-10 container mx-auto px-4 text-center max-w-4xl">
        <div class="mb-8">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm text-white py-2 px-4 rounded-full text-sm font-medium mb-8 border border-white/20">
                <span><?php echo BUSINESS_STATUS; ?></span>
            </div>

            <h1 class="mb-8">
                <span class="block text-base font-semibold tracking-widest uppercase text-white/90 mb-4">YOUR TRUSTED CAR REPAIR EXPERTS</span>
                <span class="block text-4xl md:text-5xl font-bold leading-tight text-white">
                    Dealership Quality Repair at an <span class="text-secondary-yellow">Affordable Price</span>
                </span>
            </h1>

            <p class="text-lg text-white/95 leading-relaxed mb-12 max-w-2xl mx-auto">
                Specializing in transmission rebuilding and repair with over <?php echo BUSINESS_EXPERIENCE; ?>
                of experience. ASE Master Certified technicians serving Guam with attention to detail.
            </p>

            <!-- Trust Indicators -->
            <div class="flex justify-center flex-wrap gap-8 mb-12">
                <div class="flex items-center gap-2 text-base">
                    <div class="flex items-center justify-center w-7 h-7 bg-secondary-yellow/20 border border-secondary-yellow rounded-full">
                        <i class="fas fa-shield-alt text-secondary-yellow text-xs"></i>
                    </div>
                    <span class="font-semibold text-white">1-Year Warranty</span>
                </div>
                <div class="flex items-center gap-2 text-base">
                    <div class="flex items-center justify-center w-7 h-7 bg-secondary-yellow/20 border border-secondary-yellow rounded-full">
                        <i class="fas fa-award text-secondary-yellow text-xs"></i>
                    </div>
                    <span class="font-semibold text-white">ASE Certified</span>
                </div>
                <div class="flex items-center gap-2 text-base">
                    <div class="flex items-center justify-center w-7 h-7 bg-secondary-yellow/20 border border-secondary-yellow rounded-full">
                        <i class="fas fa-clock text-secondary-yellow text-xs"></i>
                    </div>
                    <span class="font-semibold text-white">Quick Turnaround</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-center flex-wrap gap-6">
                <a href="<?php echo BASE_URL; ?>/public/quote-request.php" class="btn-yellow">
                    <i class="fas fa-calendar-plus"></i>
                    Book Appointment
                </a>
                <a href="<?php echo BASE_URL; ?>/public/services/" class="btn-secondary">
                    View Services
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Services Section -->
<section class="py-12 bg-light-gray">
    <div class="container mx-auto px-4">
        <div class="section-header">
            <h2 class="section-title">
                <i class="fas fa-tools"></i>
                Our Specialized Services
            </h2>
            <p class="section-description">
                Professional automotive repair services with ASE Master certification
            </p>
        </div>

        <div class="services-grid">
            <?php if (!empty($featuredServices)): ?>
                <?php foreach ($featuredServices as $service): ?>
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-<?php echo $service['category'] === 'transmission' ? 'cogs' : ($service['category'] === 'engine' ? 'engine' : 'search'); ?>"></i>
                </div>

                <h3 class="service-title">
                    <?php echo htmlspecialchars($service['name']); ?>
                </h3>

                <p class="service-description">
                    <?php echo htmlspecialchars(truncateText($service['description'], 100)); ?>
                </p>

                <div class="mb-4">
                    <span class="block text-base font-semibold text-primary-blue">
                        <?php echo htmlspecialchars($service['price_range']); ?>
                    </span>
                    <?php if ($service['labor_rate']): ?>
                    <span class="block text-sm text-text-gray mt-1">
                        Labor: $<?php echo number_format($service['labor_rate'], 0); ?>/hour
                    </span>
                    <?php endif; ?>
                </div>

                <?php if ($service['category'] === 'transmission'): ?>
                <div class="flex items-center justify-center gap-2 bg-yellow-100 text-yellow-800 py-2 px-4 rounded-md text-sm font-semibold mb-4">
                    <i class="fas fa-gift"></i>
                    <span>FREE items + 1-year warranty!</span>
                </div>
                <?php endif; ?>

                <a href="<?php echo BASE_URL; ?>/public/services/<?php echo $service['category'] === 'transmission' ? 'transmission.php' : ($service['category'] === 'engine' ? 'engine-repair.php' : 'diagnostics.php'); ?>"
                   class="service-btn">
                    Learn More
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-12 text-text-gray">
                    <i class="fas fa-tools text-5xl mb-4 text-gray-300"></i>
                    <p>Featured services will be displayed here once they are configured.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-center">
            <a href="<?php echo BASE_URL; ?>/public/services/" class="btn-view-all">
                View All Services
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Featured Cars Section -->
<?php if (!empty($featuredCars)): ?>
<section class="cars-section">
    <div class="container mx-auto px-4">
        <div class="section-header">
            <h2 class="section-title">
                <i class="fas fa-car"></i>
                Featured Cars for Sale
            </h2>
            <p class="section-description">
                Quality pre-owned vehicles inspected by our certified technicians
            </p>
        </div>

        <div class="cars-grid">
            <?php foreach ($featuredCars as $car): ?>
            <div class="car-card">
                <div class="car-image-container">
                    <?php
                    $images = !empty($car['images']) ? json_decode($car['images'], true) : [];
                    $mainImage = !empty($images) ? $images[0] : 'placeholder.svg';
                    ?>
                    <img src="<?php echo !empty($images) ? UPLOADS_URL . '/cars/' . $mainImage : ASSETS_URL . '/images/placeholder.svg'; ?>"
                         alt="<?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?>"
                         class="car-image"
                         onerror="this.src='<?php echo ASSETS_URL; ?>/images/placeholder.svg'">

                    <div class="car-price-badge"><?php echo formatCurrency($car['price']); ?></div>
                </div>

                <div class="car-content">
                    <h3 class="car-title">
                        <?php echo htmlspecialchars($car['year'] . ' ' . $car['make'] . ' ' . $car['model']); ?>
                    </h3>

                    <div class="car-specs">
                        <span class="car-spec">
                            <i class="fas fa-calendar"></i>
                            <?php echo $car['year']; ?>
                        </span>
                        <span class="car-spec">
                            <i class="fas fa-tachometer-alt"></i>
                            <?php echo number_format($car['mileage']); ?> miles
                        </span>
                    </div>

                    <p class="car-description">
                        <?php echo htmlspecialchars(truncateText($car['description'], 80)); ?>
                    </p>

                    <div class="car-actions">
                        <a href="<?php echo BASE_URL; ?>/public/cars/details.php?id=<?php echo $car['id']; ?>"
                           class="car-btn-primary car-btn-full-width">
                            View Details
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="section-action text-center">
            <a href="<?php echo BASE_URL; ?>/public/cars/" class="btn-view-all">
                View All Cars
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- About ADJ Automotive Section -->
<section class="about-section py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">About ADJ Automotive</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                A federally registered, veteran-owned small business with over 38 years of
                combined experience in the automotive repair industry.
            </p>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <!-- Our Story -->
            <div>
                <div class="flex items-center mb-4">
                    <i class="fas fa-book-open text-primary-blue text-lg mr-3"></i>
                    <h3 class="text-lg font-bold text-gray-800">Our Story</h3>
                </div>
                <div class="space-y-3 text-gray-600 text-sm">
                    <p>
                        ADJ Automotive Repair Services is a trusted name in Guam's automotive
                        industry. As a veteran-owned small business, we bring military precision and
                        attention to detail to every repair job.
                    </p>
                    <p>
                        Our specialization in higher echelon vehicle repairs, particularly transmission
                        rebuilding and major engine work, sets us apart from the competition. We serve all years,
                        makes, and models with the same level of expertise.
                    </p>
                </div>

                <!-- Statistics -->
                <div class="grid grid-cols-2 gap-6 mt-6">
                    <div class="bg-gray-100 border border-gray-200 rounded-lg p-4 text-center">
                        <div class="text-3xl font-bold text-primary-blue mb-1">38+</div>
                        <div class="text-gray-600 text-sm">Years Experience</div>
                    </div>
                    <div class="bg-gray-100 border border-gray-200 rounded-lg p-4 text-center">
                        <div class="text-3xl font-bold text-primary-blue mb-1">100%</div>
                        <div class="text-gray-600 text-sm">Veteran Owned</div>
                    </div>
                </div>
            </div>

            <!-- Business Information -->
            <div class="bg-white rounded-lg shadow-md p-4">
                <div class="flex items-center mb-4">
                    <i class="fas fa-info-circle text-primary-blue text-lg mr-3"></i>
                    <h3 class="text-lg font-bold text-gray-800">Business Information</h3>
                </div>

                <div class="space-y-4">
                    <!-- Registration & Status -->
                    <div>
                        <h4 class="font-semibold text-gray-800 mb-2">Registration & Status</h4>
                        <div class="space-y-1 text-sm">
                            <div>
                                <span class="text-gray-600">UEI ID: </span>
                                <span class="font-medium">QRXHK3ULRWN1</span>
                            </div>
                            <div>
                                <span class="text-gray-600">CAGE Code: </span>
                                <span class="font-medium">9CQZ7</span>
                            </div>
                            <div class="flex gap-2 mt-2">
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Federally Registered</span>
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">VOSB Certified</span>
                            </div>
                        </div>
                    </div>

                    <!-- Location -->
                    <div>
                        <h4 class="font-semibold text-gray-800 mb-2">Location</h4>
                        <div class="space-y-1 text-sm">
                            <div>
                                <span class="text-gray-600">Physical: </span>
                                <span class="text-gray-800">125 Chalan Auyuy Yap, Guam 96929</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Mailing: </span>
                                <span class="text-gray-800">P.O Box 11393 Tamuning, Guam 96931</span>
                            </div>
                        </div>
                    </div>

                    <!-- Philosophy -->
                    <div>
                        <h4 class="font-semibold text-gray-800 mb-2">Philosophy</h4>
                        <p class="text-sm text-gray-600 italic">
                            "Generating Quality Repair at an Affordable Price" with emphasis on "Attention to Detail"
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Certifications Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- ASE Certifications -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center mb-6">
                    <i class="fas fa-certificate text-primary-blue text-xl mr-3"></i>
                    <h3 class="text-xl font-bold text-gray-800">ASE Certifications</h3>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-700">ASE Master Automotive Technician</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-700">ASE Medium/Heavy Truck</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-700">ASE Heating & Air Conditioning</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-700">ASE Electrical/Electronic System</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-700">ASE Engine Repair</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-700">ASE Exhaust System</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-700">ASE Automatic Transmission/Transaxle</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-700">ASE Suspension & Steering</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-700">ASE Brakes</span>
                    </div>
                </div>
            </div>

            <!-- Manufacturer Certifications -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center mb-6">
                    <i class="fas fa-award text-primary-blue text-xl mr-3"></i>
                    <h3 class="text-xl font-bold text-gray-800">Manufacturer Certifications</h3>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-700">General Motors: Powertrain & Engine Management</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-700">Chrysler: Powertrain & Engine Management</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-700">Mercedes Benz: Powertrain & Engine Management</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-700">Ford Master Technician</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-700">Toyota Master Technician</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <span class="text-gray-700">Lexus Master Technician</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

<!-- Enhanced Scripts -->
<?php include 'includes/scripts.html'; ?>
