<?php
/**
 * ADJ Automotive Repair Services - Other Services
 * Additional automotive services page
 */

// Include configuration and functions
require_once '../../config/config.php';
require_once '../../includes/functions.php';
require_once '../../includes/navigation.php';

// Page variables
$pageTitle = 'Other Automotive Services';
$pageDescription = 'Complete automotive repair services in Guam including brakes, electrical, HVAC, suspension, exhaust systems, and more. ASE Master Certified technicians.';

// Get all non-featured services
$otherServices = getServices(null, false);

// Include header
include '../../includes/header.php';
?>

<!-- Breadcrumb -->
<?php echo renderBreadcrumb(); ?>

<!-- Page Header -->
<section class="bg-primary-blue text-white py-12">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Complete Automotive Services</h1>
            <p class="text-xl opacity-90">Professional repair and maintenance for all vehicle systems</p>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Brake Services -->
            <div class="card p-6">
                <div class="bg-accent-red text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-stop-circle text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark-gray mb-3 text-center">Brake Services</h3>
                <p class="text-gray-600 mb-4 text-center">
                    Complete brake system service and repair for safe, reliable stopping power.
                </p>
                <ul class="space-y-2 text-gray-600 mb-6">
                    <li><i class="fas fa-wrench text-accent-red mr-2"></i>Brake pad & rotor replacement</li>
                    <li><i class="fas fa-wrench text-accent-red mr-2"></i>Brake system diagnostics</li>
                    <li><i class="fas fa-wrench text-accent-red mr-2"></i>Brake fluid service</li>
                    <li><i class="fas fa-wrench text-accent-red mr-2"></i>ABS system repair</li>
                    <li><i class="fas fa-wrench text-accent-red mr-2"></i>Brake line repair</li>
                </ul>
                <div class="text-center">
                    <span class="text-lg font-bold text-secondary-orange">$<?php echo number_format(LABOR_RATE_CAR_LIGHT); ?>/hour</span>
                </div>
            </div>
            
            <!-- Electrical Services -->
            <div class="card p-6">
                <div class="bg-warning-yellow text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-bolt text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark-gray mb-3 text-center">Electrical Systems</h3>
                <p class="text-gray-600 mb-4 text-center">
                    ASE certified electrical system diagnosis and repair services.
                </p>
                <ul class="space-y-2 text-gray-600 mb-6">
                    <li><i class="fas fa-wrench text-warning-yellow mr-2"></i>Electrical diagnostics</li>
                    <li><i class="fas fa-wrench text-warning-yellow mr-2"></i>Alternator & starter repair</li>
                    <li><i class="fas fa-wrench text-warning-yellow mr-2"></i>Wiring harness repair</li>
                    <li><i class="fas fa-wrench text-warning-yellow mr-2"></i>Battery testing & replacement</li>
                    <li><i class="fas fa-wrench text-warning-yellow mr-2"></i>Lighting system repair</li>
                </ul>
                <div class="text-center">
                    <span class="text-lg font-bold text-secondary-orange">$<?php echo number_format(LABOR_RATE_CAR_LIGHT); ?>/hour</span>
                </div>
            </div>
            
            <!-- HVAC Services -->
            <div class="card p-6">
                <div class="bg-success-green text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-snowflake text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark-gray mb-3 text-center">Heating & Air Conditioning</h3>
                <p class="text-gray-600 mb-4 text-center">
                    Complete HVAC service including medium/heavy truck air conditioning.
                </p>
                <ul class="space-y-2 text-gray-600 mb-6">
                    <li><i class="fas fa-wrench text-success-green mr-2"></i>A/C system repair</li>
                    <li><i class="fas fa-wrench text-success-green mr-2"></i>Heating system service</li>
                    <li><i class="fas fa-wrench text-success-green mr-2"></i>Refrigerant service</li>
                    <li><i class="fas fa-wrench text-success-green mr-2"></i>Compressor replacement</li>
                    <li><i class="fas fa-wrench text-success-green mr-2"></i>Climate control diagnostics</li>
                </ul>
                <div class="text-center">
                    <span class="text-lg font-bold text-secondary-orange">$<?php echo number_format(LABOR_RATE_CAR_LIGHT); ?>/hour</span>
                </div>
            </div>
            
            <!-- Suspension Services -->
            <div class="card p-6">
                <div class="bg-primary-blue text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-car text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark-gray mb-3 text-center">Suspension & Steering</h3>
                <p class="text-gray-600 mb-4 text-center">
                    Suspension system and steering repairs for smooth, safe handling.
                </p>
                <ul class="space-y-2 text-gray-600 mb-6">
                    <li><i class="fas fa-wrench text-primary-blue mr-2"></i>Shock & strut replacement</li>
                    <li><i class="fas fa-wrench text-primary-blue mr-2"></i>Steering system repair</li>
                    <li><i class="fas fa-wrench text-primary-blue mr-2"></i>Wheel alignment</li>
                    <li><i class="fas fa-wrench text-primary-blue mr-2"></i>Ball joint replacement</li>
                    <li><i class="fas fa-wrench text-primary-blue mr-2"></i>Tie rod replacement</li>
                </ul>
                <div class="text-center">
                    <span class="text-lg font-bold text-secondary-orange">$<?php echo number_format(LABOR_RATE_CAR_LIGHT); ?>/hour</span>
                </div>
            </div>
            
            <!-- Exhaust Services -->
            <div class="card p-6">
                <div class="bg-secondary-orange text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-wind text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark-gray mb-3 text-center">Exhaust Systems</h3>
                <p class="text-gray-600 mb-4 text-center">
                    Complete exhaust system repair and replacement services.
                </p>
                <ul class="space-y-2 text-gray-600 mb-6">
                    <li><i class="fas fa-wrench text-secondary-orange mr-2"></i>Muffler replacement</li>
                    <li><i class="fas fa-wrench text-secondary-orange mr-2"></i>Catalytic converter service</li>
                    <li><i class="fas fa-wrench text-secondary-orange mr-2"></i>Exhaust pipe repair</li>
                    <li><i class="fas fa-wrench text-secondary-orange mr-2"></i>Emissions testing</li>
                    <li><i class="fas fa-wrench text-secondary-orange mr-2"></i>Performance exhaust</li>
                </ul>
                <div class="text-center">
                    <span class="text-lg font-bold text-secondary-orange">$<?php echo number_format(LABOR_RATE_CAR_LIGHT); ?>/hour</span>
                </div>
            </div>
            
            <!-- Key Programming -->
            <div class="card p-6">
                <div class="bg-accent-red text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-key text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark-gray mb-3 text-center">Key Programming</h3>
                <p class="text-gray-600 mb-4 text-center">
                    Key duplication with programming for all year, make, model vehicles.
                </p>
                <ul class="space-y-2 text-gray-600 mb-6">
                    <li><i class="fas fa-wrench text-accent-red mr-2"></i>Transponder key programming</li>
                    <li><i class="fas fa-wrench text-accent-red mr-2"></i>Remote key fob programming</li>
                    <li><i class="fas fa-wrench text-accent-red mr-2"></i>Smart key programming</li>
                    <li><i class="fas fa-wrench text-accent-red mr-2"></i>Immobilizer programming</li>
                    <li><i class="fas fa-wrench text-accent-red mr-2"></i>All makes & models</li>
                </ul>
                <div class="text-center">
                    <span class="text-lg font-bold text-secondary-orange">Starting at $<?php echo number_format(KEY_PROGRAMMING_BASE_PRICE); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Fleet Services -->
<section class="py-16 bg-light-gray">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-dark-gray mb-4">Fleet Services</h2>
            <p class="text-lg text-gray-600">Quick turnaround time for fleet vehicles with emphasis on getting you back on the road fast</p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h3 class="text-2xl font-bold text-dark-gray mb-6">Why Choose Us for Fleet Service?</h3>
                
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="bg-primary-blue text-white p-2 rounded-lg mr-4 flex-shrink-0">
                            <i class="fas fa-clock text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-dark-gray">Quick Turnaround</h4>
                            <p class="text-gray-600 text-sm">Priority scheduling to minimize downtime</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-secondary-orange text-white p-2 rounded-lg mr-4 flex-shrink-0">
                            <i class="fas fa-tools text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-dark-gray">All Vehicle Types</h4>
                            <p class="text-gray-600 text-sm">Cars, trucks, vans, and heavy-duty vehicles</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-success-green text-white p-2 rounded-lg mr-4 flex-shrink-0">
                            <i class="fas fa-certificate text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-dark-gray">ASE Certified</h4>
                            <p class="text-gray-600 text-sm">Master certified technicians</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-accent-red text-white p-2 rounded-lg mr-4 flex-shrink-0">
                            <i class="fas fa-handshake text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-dark-gray">Competitive Pricing</h4>
                            <p class="text-gray-600 text-sm">Fleet discounts available</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <h3 class="text-xl font-bold text-dark-gray mb-4 text-center">Fleet Service Rates</h3>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center border-b pb-2">
                        <span class="text-gray-600">Cars & Light Vehicles</span>
                        <span class="font-bold text-secondary-orange">$<?php echo number_format(LABOR_RATE_CAR_LIGHT); ?>/hour</span>
                    </div>
                    
                    <div class="flex justify-between items-center border-b pb-2">
                        <span class="text-gray-600">Diesel & Heavy Duty</span>
                        <span class="font-bold text-secondary-orange">$<?php echo number_format(LABOR_RATE_DIESEL_HEAVY); ?>/hour</span>
                    </div>
                    
                    <div class="flex justify-between items-center border-b pb-2">
                        <span class="text-gray-600">Diagnostics</span>
                        <span class="font-bold text-secondary-orange">$<?php echo number_format(LABOR_RATE_ENGINE_DIAGNOSTICS); ?>/hour</span>
                    </div>
                </div>
                
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600 mb-4">Contact us for fleet pricing and service agreements</p>
                    <a href="<?php echo BASE_URL; ?>/public/quote-request.php" class="btn-primary">
                        Get Fleet Quote
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ASE Certifications -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-dark-gray mb-4">ASE Certifications</h2>
            <p class="text-lg text-gray-600">Our technicians hold the highest certifications in the automotive industry</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach (ASE_CERTIFICATIONS as $certification): ?>
            <div class="bg-light-gray p-4 rounded-lg text-center">
                <div class="bg-primary-blue text-white p-3 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-certificate"></i>
                </div>
                <h4 class="font-semibold text-dark-gray text-sm">
                    <?php echo htmlspecialchars($certification); ?>
                </h4>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-8">
            <div class="bg-secondary-orange text-white p-6 rounded-lg inline-block">
                <h3 class="text-xl font-bold mb-2">
                    <i class="fas fa-star mr-2"></i>ASE Master Certified
                </h3>
                <p class="text-lg">The highest level of automotive certification</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="bg-primary-blue text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl lg:text-4xl font-bold mb-4">Need Automotive Service?</h2>
        <p class="text-xl mb-8 opacity-90 max-w-2xl mx-auto">
            Contact us for professional automotive repair and maintenance services. 
            ASE Master Certified technicians with <?php echo BUSINESS_EXPERIENCE; ?> of experience.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center max-w-md mx-auto mb-8">
            <a href="<?php echo BASE_URL; ?>/public/quote-request.php" class="btn-secondary flex-1 text-center">
                <i class="fas fa-file-invoice-dollar mr-2"></i>Get Quote
            </a>
            <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank" class="bg-success-green text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-600 transition-colors flex-1 text-center">
                <i class="fab fa-whatsapp mr-2"></i>WhatsApp
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center pt-8 border-t border-blue-400">
            <div>
                <i class="fas fa-phone text-2xl mb-2"></i>
                <p class="font-semibold"><?php echo BUSINESS_PHONE; ?></p>
                <p class="text-sm opacity-75">Call for service appointment</p>
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
</section>

<?php include '../../includes/footer.php'; ?>
