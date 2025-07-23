<?php
/**
 * ADJ Automotive Repair Services - Services Overview
 * Main services page showcasing all automotive services
 */

// Include configuration and functions
require_once '../../config/config.php';
require_once '../../includes/functions.php';
require_once '../../includes/navigation.php';

// Page variables
$pageTitle = 'Our Services';
$pageDescription = 'Professional automotive repair services in Guam. ASE Master Certified technicians specializing in transmission rebuilding, engine repair, advanced diagnostics, and more.';

// Get all services grouped by category
$featuredServices = getServices(null, true);
$allServices = getServices();

// Group services by category
$servicesByCategory = [];
foreach ($allServices as $service) {
    $servicesByCategory[$service['category']][] = $service;
}

// Include header
include '../../includes/header.php';
?>

<!-- Breadcrumb -->
<?php echo renderBreadcrumb(); ?>

<!-- Page Header -->
<section class="bg-gradient-primary text-white py-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.1"><circle cx="30" cy="30" r="2"/></g></svg>'); background-size: 60px 60px;"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center">
            <h1 class="text-4xl lg:text-5xl font-bold mb-6">Professional Automotive Services</h1>
            <p class="text-xl lg:text-2xl mb-4 text-secondary-orange font-semibold">
                ASE Master Certified • <?php echo BUSINESS_EXPERIENCE; ?> of Experience
            </p>
            <p class="text-lg mb-8 opacity-90 max-w-3xl mx-auto">
                From transmission rebuilding to advanced diagnostics, we provide dealership-quality service 
                at affordable prices. Veteran-owned and trusted by Guam's drivers.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo BASE_URL; ?>/public/quote-request.php" class="btn-secondary">
                    <i class="fas fa-file-invoice-dollar mr-2"></i>Get Free Quote
                </a>
                <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank" class="btn-primary">
                    <i class="fab fa-whatsapp mr-2"></i>WhatsApp Us
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Services -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-dark-gray mb-4">Our Specialties</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                We specialize in complex automotive repairs that require expertise and precision
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Transmission Rebuilding -->
            <div class="card text-center p-8 group relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-primary-blue to-blue-700 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                
                <div class="service-icon mx-auto mb-6 bg-primary-blue group-hover:bg-secondary-orange transition-colors duration-300">
                    <i class="fas fa-cogs"></i>
                </div>
                
                <h3 class="text-2xl font-bold text-dark-gray mb-4">Transmission Rebuilding</h3>
                
                <p class="text-gray-600 mb-6">
                    Complete transmission rebuild service for all makes and models. 
                    Make your old transmission like brand new with our expert craftsmanship.
                </p>
                
                <div class="mb-6">
                    <span class="text-3xl font-bold text-secondary-orange">$<?php echo number_format(TRANSMISSION_REBUILD_BASE_PRICE); ?>+</span>
                    <p class="text-sm text-gray-500">Starting price, includes removal & installation</p>
                </div>
                
                <div class="bg-success-green text-white p-4 rounded-lg mb-6">
                    <h4 class="font-semibold mb-2">
                        <i class="fas fa-gift mr-2"></i>FREE Promotional Items!
                    </h4>
                    <p class="text-sm">
                        <?php echo implode(', ', array_slice(PROMOTIONAL_ITEMS, 0, 4)); ?> & more
                    </p>
                </div>
                
                <div class="bg-accent-red text-white p-3 rounded-lg mb-6">
                    <p class="font-semibold text-sm">
                        <i class="fas fa-shield-alt mr-2"></i>1-Year Labor Warranty
                    </p>
                    <p class="text-xs">Same warranty as dealer!</p>
                </div>
                
                <a href="transmission.php" class="btn-primary w-full">
                    Learn More
                </a>
            </div>
            
            <!-- Engine Repair -->
            <div class="card text-center p-8 group relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-secondary-orange to-orange-700 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                
                <div class="service-icon mx-auto mb-6 bg-secondary-orange group-hover:bg-primary-blue transition-colors duration-300">
                    <i class="fas fa-engine"></i>
                </div>
                
                <h3 class="text-2xl font-bold text-dark-gray mb-4">Engine Repair & Rebuilding</h3>
                
                <p class="text-gray-600 mb-6">
                    Professional engine overhauls and repairs. From minor tune-ups to complete rebuilds, 
                    we restore your engine's performance and reliability.
                </p>
                
                <div class="mb-6">
                    <span class="text-3xl font-bold text-secondary-orange">$<?php echo number_format(LABOR_RATE_CAR_LIGHT); ?>/hr</span>
                    <p class="text-sm text-gray-500">Labor rate for cars & light vehicles</p>
                </div>
                
                <div class="space-y-3 mb-6 text-left">
                    <div class="flex items-center text-sm">
                        <i class="fas fa-check text-success-green mr-2"></i>
                        <span>Complete engine diagnostics</span>
                    </div>
                    <div class="flex items-center text-sm">
                        <i class="fas fa-check text-success-green mr-2"></i>
                        <span>Cylinder head rebuilding</span>
                    </div>
                    <div class="flex items-center text-sm">
                        <i class="fas fa-check text-success-green mr-2"></i>
                        <span>Engine block machining</span>
                    </div>
                    <div class="flex items-center text-sm">
                        <i class="fas fa-check text-success-green mr-2"></i>
                        <span>Performance upgrades</span>
                    </div>
                </div>
                
                <a href="engine-repair.php" class="btn-primary w-full">
                    Learn More
                </a>
            </div>
            
            <!-- Advanced Diagnostics -->
            <div class="card text-center p-8 group relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-success-green to-green-700 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                
                <div class="service-icon mx-auto mb-6 bg-success-green group-hover:bg-accent-red transition-colors duration-300">
                    <i class="fas fa-search"></i>
                </div>
                
                <h3 class="text-2xl font-bold text-dark-gray mb-4">Advanced Diagnostics</h3>
                
                <p class="text-gray-600 mb-6">
                    State-of-the-art diagnostic equipment including the latest Autel MaxiSys Ultra 
                    for comprehensive vehicle system analysis.
                </p>
                
                <div class="mb-6">
                    <span class="text-3xl font-bold text-secondary-orange">$<?php echo number_format(LABOR_RATE_ENGINE_DIAGNOSTICS); ?>/hr</span>
                    <p class="text-sm text-gray-500">Diagnostic & troubleshooting rate</p>
                </div>
                
                <div class="bg-primary-blue text-white p-4 rounded-lg mb-6">
                    <h4 class="font-semibold mb-2">
                        <i class="fas fa-laptop mr-2"></i>Autel MaxiSys Ultra
                    </h4>
                    <p class="text-sm">Latest diagnostic technology with ALLData access</p>
                </div>
                
                <div class="space-y-2 mb-6 text-left text-sm">
                    <div class="flex items-center">
                        <i class="fas fa-microchip text-primary-blue mr-2"></i>
                        <span>ECU programming & coding</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-wifi text-primary-blue mr-2"></i>
                        <span>Wireless diagnostics</span>
                    </div>
                </div>
                
                <a href="diagnostics.php" class="btn-primary w-full">
                    Learn More
                </a>
            </div>
        </div>
    </div>
</section>

<!-- All Services by Category -->
<section class="py-16 bg-light-gray">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-dark-gray mb-4">Complete Automotive Services</h2>
            <p class="text-lg text-gray-600">
                From routine maintenance to complex repairs, we handle it all
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Transmission Services -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="bg-primary-blue text-white p-3 rounded-lg mr-4">
                        <i class="fas fa-cogs text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark-gray">Transmission Services</h3>
                </div>
                
                <ul class="space-y-2 text-gray-600">
                    <li><i class="fas fa-wrench text-primary-blue mr-2"></i>Complete transmission rebuilds</li>
                    <li><i class="fas fa-wrench text-primary-blue mr-2"></i>Transmission repairs</li>
                    <li><i class="fas fa-wrench text-primary-blue mr-2"></i>Fluid changes & maintenance</li>
                    <li><i class="fas fa-wrench text-primary-blue mr-2"></i>All makes and models</li>
                </ul>
                
                <div class="mt-4 pt-4 border-t">
                    <span class="text-lg font-bold text-secondary-orange">$<?php echo number_format(LABOR_RATE_TRANSMISSION); ?>/hour</span>
                    <span class="text-sm text-gray-500 ml-2">Labor rate</span>
                </div>
            </div>
            
            <!-- Engine Services -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="bg-secondary-orange text-white p-3 rounded-lg mr-4">
                        <i class="fas fa-engine text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark-gray">Engine Services</h3>
                </div>
                
                <ul class="space-y-2 text-gray-600">
                    <li><i class="fas fa-wrench text-secondary-orange mr-2"></i>Engine rebuilding & overhauls</li>
                    <li><i class="fas fa-wrench text-secondary-orange mr-2"></i>Cylinder head work</li>
                    <li><i class="fas fa-wrench text-secondary-orange mr-2"></i>Timing belt/chain service</li>
                    <li><i class="fas fa-wrench text-secondary-orange mr-2"></i>Performance modifications</li>
                </ul>
                
                <div class="mt-4 pt-4 border-t">
                    <span class="text-lg font-bold text-secondary-orange">$<?php echo number_format(LABOR_RATE_CAR_LIGHT); ?>/hour</span>
                    <span class="text-sm text-gray-500 ml-2">Cars & light vehicles</span>
                </div>
            </div>
            
            <!-- Brake Services -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="bg-accent-red text-white p-3 rounded-lg mr-4">
                        <i class="fas fa-stop-circle text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark-gray">Brake Services</h3>
                </div>
                
                <ul class="space-y-2 text-gray-600">
                    <li><i class="fas fa-wrench text-accent-red mr-2"></i>Brake pad & rotor replacement</li>
                    <li><i class="fas fa-wrench text-accent-red mr-2"></i>Brake system diagnostics</li>
                    <li><i class="fas fa-wrench text-accent-red mr-2"></i>Brake fluid service</li>
                    <li><i class="fas fa-wrench text-accent-red mr-2"></i>ABS system repair</li>
                </ul>
                
                <div class="mt-4 pt-4 border-t">
                    <span class="text-lg font-bold text-secondary-orange">$<?php echo number_format(LABOR_RATE_CAR_LIGHT); ?>/hour</span>
                    <span class="text-sm text-gray-500 ml-2">Labor rate</span>
                </div>
            </div>
            
            <!-- Electrical Services -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="bg-warning-yellow text-white p-3 rounded-lg mr-4">
                        <i class="fas fa-bolt text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-dark-gray">Electrical Services</h3>
                </div>
                
                <ul class="space-y-2 text-gray-600">
                    <li><i class="fas fa-wrench text-warning-yellow mr-2"></i>Electrical system diagnostics</li>
                    <li><i class="fas fa-wrench text-warning-yellow mr-2"></i>Alternator & starter repair</li>
                    <li><i class="fas fa-wrench text-warning-yellow mr-2"></i>Wiring harness repair</li>
                    <li><i class="fas fa-wrench text-warning-yellow mr-2"></i>Key programming</li>
                </ul>
                
                <div class="mt-4 pt-4 border-t">
                    <span class="text-lg font-bold text-secondary-orange">$<?php echo number_format(KEY_PROGRAMMING_BASE_PRICE); ?>+</span>
                    <span class="text-sm text-gray-500 ml-2">Key programming starting price</span>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-12">
            <a href="other-services.php" class="btn-secondary">
                View All Services & Pricing
            </a>
        </div>
    </div>
</section>

<!-- Certifications & Trust -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-dark-gray mb-4">Why Choose ADJ Automotive?</h2>
            <p class="text-lg text-gray-600">
                Professional certifications and decades of experience you can trust
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="bg-primary-blue text-white p-6 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-certificate text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-gray mb-2">ASE Master Certified</h3>
                <p class="text-sm text-gray-600">Highest level automotive certification</p>
            </div>
            
            <div class="text-center">
                <div class="bg-secondary-orange text-white p-6 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-medal text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-gray mb-2">Veteran Owned</h3>
                <p class="text-sm text-gray-600">Military precision and dedication</p>
            </div>
            
            <div class="text-center">
                <div class="bg-success-green text-white p-6 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-gray mb-2"><?php echo BUSINESS_EXPERIENCE; ?></h3>
                <p class="text-sm text-gray-600">Combined experience in automotive repair</p>
            </div>
            
            <div class="text-center">
                <div class="bg-accent-red text-white p-6 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-tools text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-gray mb-2">Latest Equipment</h3>
                <p class="text-sm text-gray-600">Autel MaxiSys Ultra diagnostic tools</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="bg-primary-blue text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl lg:text-4xl font-bold mb-4">Ready to Get Started?</h2>
        <p class="text-xl mb-8 opacity-90">
            Contact us today for a free quote or to schedule your service appointment
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center max-w-md mx-auto">
            <a href="<?php echo BASE_URL; ?>/public/quote-request.php" class="btn-secondary flex-1 text-center">
                <i class="fas fa-file-invoice-dollar mr-2"></i>Get Quote
            </a>
            <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank" class="bg-success-green text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-600 transition-colors flex-1 text-center">
                <i class="fab fa-whatsapp mr-2"></i>WhatsApp
            </a>
        </div>
        
        <div class="mt-8 pt-8 border-t border-blue-400">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                <div>
                    <i class="fas fa-phone text-2xl mb-2"></i>
                    <p class="font-semibold"><?php echo BUSINESS_PHONE; ?></p>
                    <p class="text-sm opacity-75">Call us directly</p>
                </div>
                <div>
                    <i class="fas fa-map-marker-alt text-2xl mb-2"></i>
                    <p class="font-semibold">Yigo, Guam</p>
                    <p class="text-sm opacity-75"><?php echo BUSINESS_PHYSICAL_ADDRESS; ?></p>
                </div>
                <div>
                    <i class="fas fa-clock text-2xl mb-2"></i>
                    <p class="font-semibold">Mon-Fri: 8AM-5PM</p>
                    <p class="text-sm opacity-75">Sat: 8AM-2PM</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../../includes/footer.php'; ?>
