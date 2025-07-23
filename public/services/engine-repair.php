<?php
/**
 * ADJ Automotive Repair Services - Engine Repair & Rebuilding
 * Engine services page showcasing engine repair and rebuilding services
 */

// Include configuration and functions
require_once '../../config/config.php';
require_once '../../includes/functions.php';
require_once '../../includes/navigation.php';

// Page variables
$pageTitle = 'Engine Repair & Rebuilding';
$pageDescription = 'Professional engine repair and rebuilding services in Guam. ASE Master Certified technicians with manufacturer training. Complete engine overhauls and performance modifications.';

// Include header
include '../../includes/header.php';
?>

<!-- Breadcrumb -->
<?php echo renderBreadcrumb(); ?>

<!-- Hero Section -->
<section class="bg-gradient-to-br from-secondary-orange to-orange-800 text-white py-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <img src="<?php echo ASSETS_URL; ?>/images/engine-repair-bg.jpg" alt="Engine Repair" class="w-full h-full object-cover" onerror="this.style.display='none'">
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="mb-6">
                    <span class="bg-primary-blue px-4 py-2 rounded-lg font-semibold text-sm">
                        <i class="fas fa-engine mr-2"></i>ENGINE SPECIALISTS
                    </span>
                </div>
                
                <h1 class="text-4xl lg:text-5xl font-bold mb-6">
                    Engine Repair & Rebuilding
                </h1>
                
                <p class="text-xl mb-4 text-yellow-200 font-semibold">
                    Complete Engine Overhauls & Professional Grade Service
                </p>
                
                <p class="text-lg mb-8 opacity-90">
                    From minor repairs to complete engine rebuilds, our ASE Master Certified 
                    technicians restore your engine's performance and reliability with 
                    manufacturer-trained expertise.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="<?php echo BASE_URL; ?>/public/quote-request.php" class="btn-primary">
                        <i class="fas fa-file-invoice-dollar mr-2"></i>Get Free Quote
                    </a>
                    <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank" class="bg-white text-secondary-orange px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        <i class="fab fa-whatsapp mr-2"></i>WhatsApp Us
                    </a>
                </div>
            </div>
            
            <div class="text-center">
                <div class="bg-white text-dark-gray p-8 rounded-lg shadow-2xl">
                    <h3 class="text-2xl font-bold mb-4">Labor Rates</h3>
                    
                    <div class="space-y-4">
                        <div class="border-b pb-4">
                            <div class="text-3xl font-bold text-secondary-orange">
                                $<?php echo number_format(LABOR_RATE_CAR_LIGHT); ?>
                            </div>
                            <p class="text-sm text-gray-600">Per hour - Cars & Light Vehicles</p>
                        </div>
                        
                        <div class="border-b pb-4">
                            <div class="text-3xl font-bold text-secondary-orange">
                                $<?php echo number_format(LABOR_RATE_DIESEL_HEAVY); ?>
                            </div>
                            <p class="text-sm text-gray-600">Per hour - Diesel & Heavy Duty</p>
                        </div>
                        
                        <div>
                            <div class="text-3xl font-bold text-secondary-orange">
                                $<?php echo number_format(LABOR_RATE_ENGINE_DIAGNOSTICS); ?>
                            </div>
                            <p class="text-sm text-gray-600">Per hour - Engine Diagnostics</p>
                        </div>
                    </div>
                    
                    <div class="mt-6 bg-success-green text-white p-4 rounded-lg">
                        <p class="font-bold">
                            <i class="fas fa-certificate mr-2"></i>ASE Master Certified
                        </p>
                        <p class="text-sm">Engine Repair Specialists</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Engine Services -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-dark-gray mb-4">
                Complete Engine Services
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                From routine maintenance to complete rebuilds, we handle all aspects 
                of engine repair with professional-grade equipment and expertise.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Engine Rebuilding -->
            <div class="card p-6 text-center group">
                <div class="bg-secondary-orange text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 group-hover:bg-primary-blue transition-colors">
                    <i class="fas fa-engine text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark-gray mb-3">Complete Engine Rebuilds</h3>
                <p class="text-gray-600 mb-4">
                    Full engine overhauls with precision machining, new components, 
                    and professional assembly for like-new performance.
                </p>
                <ul class="text-sm text-gray-600 text-left space-y-1">
                    <li><i class="fas fa-check text-success-green mr-2"></i>Block boring & honing</li>
                    <li><i class="fas fa-check text-success-green mr-2"></i>Crankshaft machining</li>
                    <li><i class="fas fa-check text-success-green mr-2"></i>New pistons & rings</li>
                    <li><i class="fas fa-check text-success-green mr-2"></i>Bearing replacement</li>
                </ul>
            </div>
            
            <!-- Cylinder Head Work -->
            <div class="card p-6 text-center group">
                <div class="bg-primary-blue text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 group-hover:bg-secondary-orange transition-colors">
                    <i class="fas fa-cogs text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark-gray mb-3">Cylinder Head Services</h3>
                <p class="text-gray-600 mb-4">
                    Professional cylinder head rebuilding with valve work, 
                    resurfacing, and precision assembly.
                </p>
                <ul class="text-sm text-gray-600 text-left space-y-1">
                    <li><i class="fas fa-check text-success-green mr-2"></i>Valve grinding & seating</li>
                    <li><i class="fas fa-check text-success-green mr-2"></i>Head resurfacing</li>
                    <li><i class="fas fa-check text-success-green mr-2"></i>Guide replacement</li>
                    <li><i class="fas fa-check text-success-green mr-2"></i>Pressure testing</li>
                </ul>
            </div>
            
            <!-- Timing Services -->
            <div class="card p-6 text-center group">
                <div class="bg-accent-red text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 group-hover:bg-success-green transition-colors">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark-gray mb-3">Timing Belt/Chain Service</h3>
                <p class="text-gray-600 mb-4">
                    Critical timing system maintenance and repair to prevent 
                    catastrophic engine damage.
                </p>
                <ul class="text-sm text-gray-600 text-left space-y-1">
                    <li><i class="fas fa-check text-success-green mr-2"></i>Belt/chain replacement</li>
                    <li><i class="fas fa-check text-success-green mr-2"></i>Tensioner service</li>
                    <li><i class="fas fa-check text-success-green mr-2"></i>Water pump replacement</li>
                    <li><i class="fas fa-check text-success-green mr-2"></i>Timing verification</li>
                </ul>
            </div>
            
            <!-- Performance Modifications -->
            <div class="card p-6 text-center group">
                <div class="bg-warning-yellow text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 group-hover:bg-accent-red transition-colors">
                    <i class="fas fa-tachometer-alt text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark-gray mb-3">Performance Upgrades</h3>
                <p class="text-gray-600 mb-4">
                    Engine modifications and upgrades to improve power, 
                    efficiency, and overall performance.
                </p>
                <ul class="text-sm text-gray-600 text-left space-y-1">
                    <li><i class="fas fa-check text-success-green mr-2"></i>Cold air intakes</li>
                    <li><i class="fas fa-check text-success-green mr-2"></i>Exhaust upgrades</li>
                    <li><i class="fas fa-check text-success-green mr-2"></i>ECU tuning</li>
                    <li><i class="fas fa-check text-success-green mr-2"></i>Turbo/supercharger work</li>
                </ul>
            </div>
            
            <!-- Engine Diagnostics -->
            <div class="card p-6 text-center group">
                <div class="bg-success-green text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 group-hover:bg-warning-yellow transition-colors">
                    <i class="fas fa-search text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark-gray mb-3">Engine Diagnostics</h3>
                <p class="text-gray-600 mb-4">
                    Advanced diagnostic testing to identify engine problems 
                    and performance issues accurately.
                </p>
                <ul class="text-sm text-gray-600 text-left space-y-1">
                    <li><i class="fas fa-check text-success-green mr-2"></i>Computer diagnostics</li>
                    <li><i class="fas fa-check text-success-green mr-2"></i>Compression testing</li>
                    <li><i class="fas fa-check text-success-green mr-2"></i>Leak-down testing</li>
                    <li><i class="fas fa-check text-success-green mr-2"></i>Scope analysis</li>
                </ul>
            </div>
            
            <!-- General Engine Repair -->
            <div class="card p-6 text-center group">
                <div class="bg-primary-blue text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4 group-hover:bg-secondary-orange transition-colors">
                    <i class="fas fa-wrench text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark-gray mb-3">General Engine Repair</h3>
                <p class="text-gray-600 mb-4">
                    Routine engine maintenance and repair services to keep 
                    your engine running smoothly and efficiently.
                </p>
                <ul class="text-sm text-gray-600 text-left space-y-1">
                    <li><i class="fas fa-check text-success-green mr-2"></i>Oil leak repairs</li>
                    <li><i class="fas fa-check text-success-green mr-2"></i>Gasket replacement</li>
                    <li><i class="fas fa-check text-success-green mr-2"></i>Cooling system service</li>
                    <li><i class="fas fa-check text-success-green mr-2"></i>Fuel system cleaning</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Manufacturer Certifications -->
<section class="py-16 bg-light-gray">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-dark-gray mb-4">
                Manufacturer Certified Technicians
            </h2>
            <p class="text-lg text-gray-600">
                Our technicians hold master certifications from major automotive manufacturers
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach (MANUFACTURER_CERTIFICATIONS as $certification): ?>
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <div class="bg-primary-blue text-white p-4 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-certificate text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-dark-gray mb-2">
                    <?php echo htmlspecialchars($certification); ?>
                </h3>
                <p class="text-sm text-gray-600">
                    Factory-trained expertise for optimal service quality
                </p>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-12">
            <div class="bg-secondary-orange text-white p-6 rounded-lg inline-block">
                <h3 class="text-xl font-bold mb-2">
                    <i class="fas fa-star mr-2"></i>ASE Master Certified
                </h3>
                <p class="text-lg">Engine Repair • Medium/Heavy Truck • Electrical Systems</p>
            </div>
        </div>
    </div>
</section>

<!-- Engine Rebuild Process -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-dark-gray mb-4">
                Our Engine Rebuild Process
            </h2>
            <p class="text-lg text-gray-600">
                Professional engine rebuilding in 6 comprehensive steps
            </p>
        </div>
        
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="flex items-start">
                    <div class="bg-secondary-orange text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg mr-4 flex-shrink-0">
                        1
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark-gray mb-2">Engine Removal & Inspection</h3>
                        <p class="text-gray-600">
                            Careful engine removal and comprehensive inspection to assess 
                            rebuild requirements and identify all necessary work.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-primary-blue text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg mr-4 flex-shrink-0">
                        2
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark-gray mb-2">Complete Disassembly</h3>
                        <p class="text-gray-600">
                            Total engine teardown with detailed component inspection 
                            and measurement to determine machining needs.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-success-green text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg mr-4 flex-shrink-0">
                        3
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark-gray mb-2">Machining & Cleaning</h3>
                        <p class="text-gray-600">
                            Precision machining of block, heads, and rotating assembly. 
                            Professional cleaning of all components.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-accent-red text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg mr-4 flex-shrink-0">
                        4
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark-gray mb-2">Assembly & Balancing</h3>
                        <p class="text-gray-600">
                            Expert assembly with new components, proper torque 
                            specifications, and rotating assembly balancing.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-warning-yellow text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg mr-4 flex-shrink-0">
                        5
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark-gray mb-2">Installation & Setup</h3>
                        <p class="text-gray-600">
                            Professional installation with new fluids, filters, 
                            and proper timing setup for optimal performance.
                        </p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="bg-primary-blue text-white rounded-full w-12 h-12 flex items-center justify-center font-bold text-lg mr-4 flex-shrink-0">
                        6
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-dark-gray mb-2">Testing & Break-in</h3>
                        <p class="text-gray-600">
                            Comprehensive testing and proper break-in procedures 
                            to ensure long-lasting performance and reliability.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="bg-secondary-orange text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl lg:text-4xl font-bold mb-4">
            Need Engine Repair or Rebuilding?
        </h2>
        <p class="text-xl mb-8 opacity-90 max-w-2xl mx-auto">
            Get expert engine service from ASE Master Certified technicians with 
            manufacturer training and <?php echo BUSINESS_EXPERIENCE; ?> of experience.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center max-w-md mx-auto mb-8">
            <a href="<?php echo BASE_URL; ?>/public/quote-request.php" class="bg-white text-secondary-orange px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors flex-1 text-center">
                <i class="fas fa-file-invoice-dollar mr-2"></i>Get Free Quote
            </a>
            <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank" class="bg-success-green text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-600 transition-colors flex-1 text-center">
                <i class="fab fa-whatsapp mr-2"></i>WhatsApp
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center pt-8 border-t border-orange-400">
            <div>
                <i class="fas fa-phone text-2xl mb-2"></i>
                <p class="font-semibold"><?php echo BUSINESS_PHONE; ?></p>
                <p class="text-sm opacity-75">Call for consultation</p>
            </div>
            <div>
                <i class="fas fa-dollar-sign text-2xl mb-2"></i>
                <p class="font-semibold">$<?php echo number_format(LABOR_RATE_CAR_LIGHT); ?>/hour</p>
                <p class="text-sm opacity-75">Cars & light vehicles</p>
            </div>
            <div>
                <i class="fas fa-certificate text-2xl mb-2"></i>
                <p class="font-semibold">ASE Master Certified</p>
                <p class="text-sm opacity-75">Engine repair specialists</p>
            </div>
        </div>
    </div>
</section>

<?php include '../../includes/footer.php'; ?>
