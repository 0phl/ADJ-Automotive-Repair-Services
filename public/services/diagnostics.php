<?php
/**
 * ADJ Automotive Repair Services - Advanced Diagnostics
 * Diagnostic services page featuring Autel MaxiSys Ultra and advanced diagnostics
 */

// Include configuration and functions
require_once '../../config/config.php';
require_once '../../includes/functions.php';
require_once '../../includes/navigation.php';

// Page variables
$pageTitle = 'Advanced Diagnostics';
$pageDescription = 'Advanced automotive diagnostics in Guam using the latest Autel MaxiSys Ultra scan tool. Professional vehicle control system diagnosis and computer module programming.';

// Include header
include '../../includes/header.php';
?>

<!-- Breadcrumb -->
<?php echo renderBreadcrumb(); ?>

<!-- Hero Section -->
<section class="bg-gradient-primary text-white py-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <img src="<?php echo ASSETS_URL; ?>/images/diagnostics-bg.jpg" alt="Advanced Diagnostics" class="w-full h-full object-cover" onerror="this.style.display='none'">
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="mb-6">
                    <span class="bg-primary-blue px-4 py-2 rounded-lg font-semibold text-sm">
                        <i class="fas fa-laptop mr-2"></i>LATEST TECHNOLOGY
                    </span>
                </div>
                
                <h1 class="text-4xl lg:text-5xl font-bold mb-6">
                    Advanced Diagnostics
                </h1>
                
                <p class="text-xl mb-4 text-gray-200 font-semibold">
                    Latest Autel MaxiSys Ultra Scan Tool
                </p>
                
                <p class="text-lg mb-8 opacity-90">
                    State-of-the-art diagnostic equipment for comprehensive vehicle 
                    control system diagnosis and computer module programming. 
                    Professional-grade diagnostics with ALLData Repair database access.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="<?php echo BASE_URL; ?>/public/quote-request.php" class="btn-primary">
                        <i class="fas fa-file-invoice-dollar mr-2"></i>Get Diagnostic Quote
                    </a>
                    <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank" class="bg-white text-primary-blue px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        <i class="fab fa-whatsapp mr-2"></i>WhatsApp Us
                    </a>
                </div>
            </div>
            
            <div class="text-center">
                <div class="bg-white text-dark-gray p-8 rounded-lg shadow-2xl">
                    <h3 class="text-2xl font-bold mb-4">Diagnostic Rates</h3>
                    
                    <div class="space-y-4">
                        <div class="border-b pb-4">
                            <div class="text-3xl font-bold text-primary-blue">
                                $<?php echo number_format(LABOR_RATE_DIAGNOSTICS_CAR); ?>
                            </div>
                            <p class="text-sm text-gray-600">Cars & Light Vehicles</p>
                        </div>

                        <div class="border-b pb-4">
                            <div class="text-3xl font-bold text-primary-blue">
                                $<?php echo number_format(LABOR_RATE_DIAGNOSTICS_DIESEL); ?>
                            </div>
                            <p class="text-sm text-gray-600">Diesel & Heavy Trucks</p>
                        </div>

                        <div>
                            <div class="text-3xl font-bold text-primary-blue">
                                $<?php echo number_format(LABOR_RATE_PROGRAMMING); ?>
                            </div>
                            <p class="text-sm text-gray-600">Programming (per module)</p>
                        </div>
                    </div>
                    
                    <div class="mt-6 bg-primary-blue text-white p-4 rounded-lg">
                        <p class="font-bold">
                            <i class="fas fa-laptop mr-2"></i>Autel MaxiSys Ultra
                        </p>
                        <p class="text-sm">Latest diagnostic technology</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Autel MaxiSys Ultra Features -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-dark-gray mb-4">
                Autel MaxiSys Ultra Technology
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                The most advanced diagnostic platform available, providing comprehensive 
                vehicle system analysis and programming capabilities.
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="bg-light-gray p-8 rounded-lg">
                    <img src="<?php echo ASSETS_URL; ?>/images/autel-maxisys-ultra.jpg" alt="Autel MaxiSys Ultra" class="w-full h-64 object-cover rounded-lg" onerror="this.src='<?php echo ASSETS_URL; ?>/images/diagnostic-equipment.jpg'">
                </div>
            </div>
            
            <div class="space-y-6">
                <div class="flex items-start">
                    <div class="bg-primary-blue text-white p-3 rounded-lg mr-4 flex-shrink-0">
                        <i class="fas fa-wifi text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-dark-gray mb-2">Wireless Diagnostics</h3>
                        <p class="text-gray-600">
                            Advanced wireless connectivity for seamless vehicle communication 
                            and real-time data analysis without cables.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-primary-blue text-white p-3 rounded-lg mr-4 flex-shrink-0">
                        <i class="fas fa-microchip text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-dark-gray mb-2">ECU Programming & Coding</h3>
                        <p class="text-gray-600">
                            Complete ECU programming and coding capabilities for module 
                            replacement, updates, and configuration changes.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-secondary-gray text-white p-3 rounded-lg mr-4 flex-shrink-0">
                        <i class="fas fa-database text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-dark-gray mb-2">ALLData Repair Access</h3>
                        <p class="text-gray-600">
                            Comprehensive repair database with wiring diagrams, 
                            technical service bulletins, and repair procedures.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-secondary-gray text-white p-3 rounded-lg mr-4 flex-shrink-0">
                        <i class="fas fa-chart-line text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-dark-gray mb-2">Advanced Data Analysis</h3>
                        <p class="text-gray-600">
                            Real-time data graphing, freeze frame analysis, and 
                            comprehensive system monitoring capabilities.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Diagnostic Services -->
<section class="py-16 bg-light-gray">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-dark-gray mb-4">
                Comprehensive Diagnostic Services
            </h2>
            <p class="text-lg text-gray-600">
                Professional diagnostics for all vehicle systems and components
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Engine Diagnostics -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="bg-primary-blue text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-engine text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark-gray mb-3 text-center">Engine Systems</h3>
                <ul class="space-y-2 text-gray-600">
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Engine management systems</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Fuel injection diagnostics</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Ignition system analysis</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Emissions system testing</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Turbo/supercharger diagnostics</li>
                </ul>
            </div>
            
            <!-- Transmission Diagnostics -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="bg-secondary-gray text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-cogs text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark-gray mb-3 text-center">Transmission Systems</h3>
                <ul class="space-y-2 text-gray-600">
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Automatic transmission control</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>CVT system diagnostics</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Shift solenoid testing</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Pressure control analysis</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Adaptive learning reset</li>
                </ul>
            </div>
            
            <!-- Electrical Diagnostics -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="bg-primary-blue text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-bolt text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark-gray mb-3 text-center">Electrical Systems</h3>
                <ul class="space-y-2 text-gray-600">
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Charging system diagnostics</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Starting system analysis</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Wiring harness testing</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Module communication</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Battery & alternator testing</li>
                </ul>
            </div>
            
            <!-- Safety Systems -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="bg-secondary-gray text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shield-alt text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark-gray mb-3 text-center">Safety Systems</h3>
                <ul class="space-y-2 text-gray-600">
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>ABS system diagnostics</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Airbag system testing</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Stability control analysis</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Parking assist systems</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Collision avoidance systems</li>
                </ul>
            </div>

            <!-- Climate Control -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="bg-primary-blue text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-snowflake text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark-gray mb-3 text-center">Climate Control</h3>
                <ul class="space-y-2 text-gray-600">
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>A/C system diagnostics</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Heating system analysis</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Automatic climate control</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Refrigerant leak detection</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Compressor diagnostics</li>
                </ul>
            </div>

            <!-- Body Control -->
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="bg-secondary-gray text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-car text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark-gray mb-3 text-center">Body Control</h3>
                <ul class="space-y-2 text-gray-600">
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Power window/door systems</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Lighting system diagnostics</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Instrument cluster testing</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Keyless entry systems</li>
                    <li><i class="fas fa-check text-primary-blue mr-2"></i>Anti-theft system analysis</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Programming Services -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-dark-gray mb-4">
                ECU Programming & Coding Services
            </h2>
            <p class="text-lg text-gray-600">
                Professional module programming and configuration services
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <div class="bg-light-gray p-6 rounded-lg">
                    <h3 class="text-xl font-bold text-dark-gray mb-3">
                        <i class="fas fa-microchip text-primary-blue mr-2"></i>
                        Module Programming
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Complete ECU programming for new module installation, 
                        software updates, and configuration changes.
                    </p>
                    <div class="text-2xl font-bold text-secondary-orange">
                        $<?php echo number_format(LABOR_RATE_PROGRAMMING); ?> per module
                    </div>
                </div>
                
                <div class="bg-light-gray p-6 rounded-lg">
                    <h3 class="text-xl font-bold text-dark-gray mb-3">
                        <i class="fas fa-key text-primary-blue mr-2"></i>
                        Key Programming
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Key duplication with programming for all year, make, 
                        and model vehicles. Includes transponder programming.
                    </p>
                    <div class="text-2xl font-bold text-secondary-orange">
                        Starting at $<?php echo number_format(KEY_PROGRAMMING_BASE_PRICE); ?>
                    </div>
                </div>
            </div>
            
            <div class="space-y-4">
                <h3 class="text-2xl font-bold text-dark-gray mb-4">Programming Capabilities</h3>
                
                <div class="space-y-3">
                    <div class="flex items-center">
                        <i class="fas fa-check text-primary-blue mr-3"></i>
                        <span>Engine control module (ECM) programming</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check text-primary-blue mr-3"></i>
                        <span>Transmission control module (TCM) programming</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check text-primary-blue mr-3"></i>
                        <span>Body control module (BCM) programming</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check text-primary-blue mr-3"></i>
                        <span>Anti-lock brake system (ABS) programming</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check text-primary-blue mr-3"></i>
                        <span>Airbag control module programming</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check text-primary-blue mr-3"></i>
                        <span>Instrument cluster programming</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check text-primary-blue mr-3"></i>
                        <span>Immobilizer and security system programming</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-check text-primary-blue mr-3"></i>
                        <span>Key fob and remote programming</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Our Diagnostics -->
<section class="py-16 bg-light-gray">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-dark-gray mb-4">
                Why Choose ADJ Automotive Diagnostics?
            </h2>
            <p class="text-lg text-gray-600">
                Professional expertise combined with the latest diagnostic technology
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="bg-primary-blue text-white p-6 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-laptop text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-gray mb-2">Latest Equipment</h3>
                <p class="text-sm text-gray-600">Autel MaxiSys Ultra - most advanced diagnostic platform</p>
            </div>
            
            <div class="text-center">
                <div class="bg-secondary-gray text-white p-6 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-certificate text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-gray mb-2">ASE Certified</h3>
                <p class="text-sm text-gray-600">Electrical/Electronic System specialists</p>
            </div>

            <div class="text-center">
                <div class="bg-primary-blue text-white p-6 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-database text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-gray mb-2">ALLData Access</h3>
                <p class="text-sm text-gray-600">Complete repair database and technical information</p>
            </div>

            <div class="text-center">
                <div class="bg-secondary-gray text-white p-6 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-gray mb-2"><?php echo BUSINESS_EXPERIENCE; ?></h3>
                <p class="text-sm text-gray-600">Combined diagnostic experience</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="bg-primary-blue text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl lg:text-4xl font-bold mb-4">
            Need Professional Diagnostics?
        </h2>
        <p class="text-xl mb-8 opacity-90 max-w-2xl mx-auto">
            Get accurate diagnostics with the latest Autel MaxiSys Ultra technology. 
            Professional analysis and programming services available.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center max-w-md mx-auto mb-8">
            <a href="<?php echo BASE_URL; ?>/public/quote-request.php" class="bg-white text-primary-blue px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors flex-1 text-center">
                <i class="fas fa-file-invoice-dollar mr-2"></i>Get Quote
            </a>
            <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank" class="bg-secondary-gray text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-700 transition-colors flex-1 text-center">
                <i class="fab fa-whatsapp mr-2"></i>WhatsApp
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center pt-8 border-t border-blue-400">
            <div>
                <i class="fas fa-phone text-2xl mb-2"></i>
                <p class="font-semibold"><?php echo BUSINESS_PHONE; ?></p>
                <p class="text-sm opacity-75">Call for diagnostic appointment</p>
            </div>
            <div>
                <i class="fas fa-dollar-sign text-2xl mb-2"></i>
                <p class="font-semibold">$<?php echo number_format(LABOR_RATE_DIAGNOSTICS_CAR); ?>/hour</p>
                <p class="text-sm opacity-75">Cars & light vehicles</p>
            </div>
            <div>
                <i class="fas fa-laptop text-2xl mb-2"></i>
                <p class="font-semibold">Autel MaxiSys Ultra</p>
                <p class="text-sm opacity-75">Latest diagnostic technology</p>
            </div>
        </div>
    </div>
</section>

<?php include '../../includes/footer.php'; ?>
