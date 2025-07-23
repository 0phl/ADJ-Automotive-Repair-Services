<?php
/**
 * ADJ Automotive Repair Services - Transmission Rebuilding Services
 * Primary service page for transmission rebuilding and repair
 */

// Include configuration and functions
require_once '../../config/config.php';
require_once '../../includes/functions.php';
require_once '../../includes/navigation.php';

// Page variables
$pageTitle = 'Transmission Rebuilding & Repair';
$pageDescription = 'Expert transmission rebuilding services in Guam. Make your old transmission like brand new with 1-year labor warranty. FREE promotional items included. All makes and models.';

// Include header
include '../../includes/header.php';
?>

<!-- Breadcrumb -->
<?php echo renderBreadcrumb(); ?>

<!-- Hero Section -->
<section class="bg-gradient-to-br from-primary-blue to-blue-800 text-white py-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <img src="<?php echo ASSETS_URL; ?>/images/transmission-bg.jpg" alt="Transmission Repair" class="w-full h-full object-cover" onerror="this.style.display='none'">
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="mb-6">
                    <span class="bg-secondary-orange px-4 py-2 rounded-lg font-semibold text-sm">
                        <i class="fas fa-star mr-2"></i>OUR SPECIALTY SERVICE
                    </span>
                </div>
                
                <h1 class="text-4xl lg:text-5xl font-bold mb-6">
                    Transmission Rebuilding & Repair
                </h1>
                
                <p class="text-xl mb-4 text-secondary-orange font-semibold">
                    "Make Your Old Transmission Like Brand New"
                </p>
                
                <p class="text-lg mb-8 opacity-90">
                    Complete transmission rebuild service for all years, makes, and models. 
                    Professional craftsmanship with the same 1-year labor warranty as buying 
                    a brand new transmission from the dealer.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="<?php echo BASE_URL; ?>/public/quote-request.php" class="btn-secondary">
                        <i class="fas fa-file-invoice-dollar mr-2"></i>Get Free Quote
                    </a>
                    <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank" class="btn-primary">
                        <i class="fab fa-whatsapp mr-2"></i>WhatsApp Us
                    </a>
                </div>
            </div>
            
            <div class="text-center">
                <div class="bg-white text-dark-gray p-8 rounded-lg shadow-2xl">
                    <h3 class="text-2xl font-bold mb-4">Starting Price</h3>
                    <div class="text-5xl font-bold text-secondary-orange mb-2">
                        $<?php echo number_format(TRANSMISSION_REBUILD_BASE_PRICE); ?>
                    </div>
                    <p class="text-sm text-gray-600 mb-6">
                        Includes removal, installation, master kit, fluid & cleaner
                    </p>
                    
                    <div class="bg-success-green text-white p-4 rounded-lg mb-4">
                        <h4 class="font-bold mb-2">
                            <i class="fas fa-gift mr-2"></i>FREE Promotional Items!
                        </h4>
                        <p class="text-sm">
                            <?php echo implode(' • ', PROMOTIONAL_ITEMS); ?>
                        </p>
                    </div>
                    
                    <div class="bg-accent-red text-white p-3 rounded-lg">
                        <p class="font-bold">
                            <i class="fas fa-shield-alt mr-2"></i>1-Year Labor Warranty
                        </p>
                        <p class="text-sm">Same warranty as dealer!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- What's Included -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-dark-gray mb-4">
                Complete Transmission Rebuild Service
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Our comprehensive transmission rebuild process ensures your transmission 
                performs like new with professional-grade parts and expert craftsmanship.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="text-center p-6">
                <div class="bg-primary-blue text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-tools text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-gray mb-3">Complete Disassembly</h3>
                <p class="text-gray-600">
                    Full transmission teardown with detailed inspection of all components
                </p>
            </div>
            
            <div class="text-center p-6">
                <div class="bg-secondary-orange text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-search text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-gray mb-3">Professional Inspection</h3>
                <p class="text-gray-600">
                    Thorough examination of all internal parts for wear and damage
                </p>
            </div>
            
            <div class="text-center p-6">
                <div class="bg-success-green text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-cogs text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-gray mb-3">Master Rebuild Kit</h3>
                <p class="text-gray-600">
                    High-quality master kit with all necessary seals, gaskets, and filters
                </p>
            </div>
            
            <div class="text-center p-6">
                <div class="bg-accent-red text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-wrench text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-gray mb-3">Expert Assembly</h3>
                <p class="text-gray-600">
                    Precision reassembly by ASE certified transmission specialists
                </p>
            </div>
            
            <div class="text-center p-6">
                <div class="bg-warning-yellow text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-vial text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-gray mb-3">Fresh Fluids</h3>
                <p class="text-gray-600">
                    New transmission fluid and filter for optimal performance
                </p>
            </div>
            
            <div class="text-center p-6">
                <div class="bg-primary-blue text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-gray mb-3">Quality Testing</h3>
                <p class="text-gray-600">
                    Comprehensive testing to ensure proper operation and performance
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Supported Vehicles -->
<section class="py-16 bg-light-gray">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-dark-gray mb-4">
                All Makes & Models Supported
            </h2>
            <p class="text-lg text-gray-600">
                We rebuild transmissions for all vehicle types and manufacturers
            </p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-6">
            <?php foreach (SUPPORTED_BRANDS as $brand): ?>
            <?php if ($brand !== 'All makes and models for transmission work'): ?>
            <div class="bg-white p-4 rounded-lg shadow text-center">
                <div class="text-2xl font-bold text-primary-blue mb-2">
                    <?php echo strtoupper(substr($brand, 0, 2)); ?>
                </div>
                <p class="text-sm font-semibold text-dark-gray"><?php echo htmlspecialchars($brand); ?></p>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-8">
            <div class="bg-secondary-orange text-white p-6 rounded-lg inline-block">
                <h3 class="text-xl font-bold mb-2">
                    <i class="fas fa-star mr-2"></i>Plus Many More!
                </h3>
                <p class="text-lg">All years, makes, and models for transmission work</p>
            </div>
        </div>
    </div>
</section>

<!-- Warranty & Guarantees -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl lg:text-4xl font-bold text-dark-gray mb-6">
                    Industry-Leading Warranty
                </h2>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="bg-accent-red text-white p-3 rounded-lg mr-4 flex-shrink-0">
                            <i class="fas fa-shield-alt text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-dark-gray mb-2">1-Year Labor Warranty</h3>
                            <p class="text-gray-600">
                                Same warranty coverage as if you purchased a brand new transmission 
                                from the dealer. We stand behind our work with confidence.
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-success-green text-white p-3 rounded-lg mr-4 flex-shrink-0">
                            <i class="fas fa-certificate text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-dark-gray mb-2">ASE Certified Work</h3>
                            <p class="text-gray-600">
                                All work performed by ASE Master Certified technicians with 
                                specialized transmission training and expertise.
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-primary-blue text-white p-3 rounded-lg mr-4 flex-shrink-0">
                            <i class="fas fa-tools text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-dark-gray mb-2">Quality Parts</h3>
                            <p class="text-gray-600">
                                We use only high-quality master rebuild kits and OEM-equivalent 
                                parts for lasting performance and reliability.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-br from-success-green to-green-700 text-white p-8 rounded-lg">
                <h3 class="text-2xl font-bold mb-6 text-center">
                    <i class="fas fa-gift mr-2"></i>FREE Promotional Items
                </h3>
                
                <p class="text-center mb-6">
                    Every transmission rebuild includes these FREE promotional items:
                </p>
                
                <div class="grid grid-cols-2 gap-3 mb-6">
                    <?php foreach (PROMOTIONAL_ITEMS as $item): ?>
                    <div class="flex items-center">
                        <i class="fas fa-check mr-2"></i>
                        <span><?php echo htmlspecialchars($item); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="text-center">
                    <p class="text-lg font-semibold">
                        A $100+ value - absolutely FREE with every transmission rebuild!
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Timeline -->
<section class="py-16 bg-light-gray">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-dark-gray mb-4">
                Our Rebuild Process
            </h2>
            <p class="text-lg text-gray-600">
                Professional transmission rebuilding in 5 comprehensive steps
            </p>
        </div>
        
        <div class="max-w-4xl mx-auto">
            <div class="space-y-8">
                <div class="flex items-start">
                    <div class="bg-primary-blue text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg mr-6 flex-shrink-0">
                        1
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg flex-1">
                        <h3 class="text-xl font-bold text-dark-gray mb-2">Initial Diagnosis</h3>
                        <p class="text-gray-600">
                            Comprehensive diagnostic testing to identify transmission issues and 
                            provide accurate assessment of rebuild requirements.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-secondary-orange text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg mr-6 flex-shrink-0">
                        2
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg flex-1">
                        <h3 class="text-xl font-bold text-dark-gray mb-2">Removal & Disassembly</h3>
                        <p class="text-gray-600">
                            Careful removal of transmission from vehicle and complete disassembly 
                            with detailed inspection of all internal components.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-success-green text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg mr-6 flex-shrink-0">
                        3
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg flex-1">
                        <h3 class="text-xl font-bold text-dark-gray mb-2">Cleaning & Machining</h3>
                        <p class="text-gray-600">
                            Professional cleaning of all components and precision machining 
                            of case and internal parts as needed for proper fit.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-accent-red text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg mr-6 flex-shrink-0">
                        4
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg flex-1">
                        <h3 class="text-xl font-bold text-dark-gray mb-2">Rebuild & Assembly</h3>
                        <p class="text-gray-600">
                            Expert reassembly with master rebuild kit, new seals, gaskets, 
                            and filters. Precision torque specifications and quality control.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-warning-yellow text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg mr-6 flex-shrink-0">
                        5
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-lg flex-1">
                        <h3 class="text-xl font-bold text-dark-gray mb-2">Installation & Testing</h3>
                        <p class="text-gray-600">
                            Professional installation with fresh fluid and comprehensive 
                            road testing to ensure proper operation and performance.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="bg-primary-blue text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl lg:text-4xl font-bold mb-4">
            Ready to Rebuild Your Transmission?
        </h2>
        <p class="text-xl mb-8 opacity-90 max-w-2xl mx-auto">
            Get a free quote for your transmission rebuild. Professional service with 
            1-year warranty and FREE promotional items included.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center max-w-md mx-auto mb-8">
            <a href="<?php echo BASE_URL; ?>/public/quote-request.php" class="btn-secondary flex-1 text-center">
                <i class="fas fa-file-invoice-dollar mr-2"></i>Get Free Quote
            </a>
            <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank" class="bg-success-green text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-600 transition-colors flex-1 text-center">
                <i class="fab fa-whatsapp mr-2"></i>WhatsApp
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center pt-8 border-t border-blue-400">
            <div>
                <i class="fas fa-phone text-2xl mb-2"></i>
                <p class="font-semibold"><?php echo BUSINESS_PHONE; ?></p>
                <p class="text-sm opacity-75">Call for immediate assistance</p>
            </div>
            <div>
                <i class="fas fa-dollar-sign text-2xl mb-2"></i>
                <p class="font-semibold">Starting at $<?php echo number_format(TRANSMISSION_REBUILD_BASE_PRICE); ?></p>
                <p class="text-sm opacity-75">Includes removal & installation</p>
            </div>
            <div>
                <i class="fas fa-shield-alt text-2xl mb-2"></i>
                <p class="font-semibold">1-Year Warranty</p>
                <p class="text-sm opacity-75">Same as dealer warranty</p>
            </div>
        </div>
    </div>
</section>

<?php include '../../includes/footer.php'; ?>
