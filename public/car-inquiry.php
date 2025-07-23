<?php
/**
 * ADJ Automotive Repair Services - Car Inquiry Form
 * Form for customers to inquire about specific cars
 */

// Include configuration and functions
require_once '../config/config.php';
require_once '../includes/functions.php';
require_once '../includes/navigation.php';

// Get car ID if specified
$carId = isset($_GET['car_id']) ? (int)$_GET['car_id'] : 0;
$car = null;

if ($carId) {
    $car = getCarById($carId);
    if (!$car || $car['status'] !== 'available') {
        $carId = 0;
        $car = null;
    }
}

// Page variables
$pageTitle = $car ? 'Inquire About ' . $car['year'] . ' ' . $car['make'] . ' ' . $car['model'] : 'Car Inquiry';
$pageDescription = 'Send an inquiry about our vehicles for sale at ADJ Automotive Repair Services in Guam.';

// Handle form submission
$formSubmitted = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
        $errors[] = 'Security token mismatch. Please try again.';
    } else {
        // Validate form data
        $name = sanitizeInput($_POST['name'] ?? '');
        $email = sanitizeInput($_POST['email'] ?? '');
        $phone = sanitizeInput($_POST['phone'] ?? '');
        $message = sanitizeInput($_POST['message'] ?? '');
        $inquiryCarId = (int)($_POST['car_id'] ?? 0);
        
        // Validation
        if (empty($name)) {
            $errors[] = 'Name is required.';
        }
        
        if (empty($email)) {
            $errors[] = 'Email is required.';
        } elseif (!isValidEmail($email)) {
            $errors[] = 'Please enter a valid email address.';
        }
        
        if (!empty($phone) && !isValidPhone($phone)) {
            $errors[] = 'Please enter a valid phone number.';
        }
        
        if (empty($message)) {
            $errors[] = 'Message is required.';
        }
        
        // If no errors, save inquiry
        if (empty($errors)) {
            try {
                $inquiryData = [
                    'type' => 'car',
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'message' => $message,
                    'car_id' => $inquiryCarId > 0 ? $inquiryCarId : null
                ];
                
                $inquiryId = createInquiry($inquiryData);
                
                if ($inquiryId) {
                    // Increment car inquiry count
                    if ($inquiryCarId > 0) {
                        incrementCarInquiries($inquiryCarId);
                    }
                    
                    $formSubmitted = true;
                    
                    // TODO: Send email notification to admin
                    // This would be implemented with PHPMailer in a later phase
                    
                } else {
                    $errors[] = 'Failed to submit inquiry. Please try again.';
                }
            } catch (Exception $e) {
                error_log('Car inquiry submission error: ' . $e->getMessage());
                $errors[] = 'An error occurred. Please try again later.';
            }
        }
    }
}

// Include header
include '../includes/header.php';
?>

<!-- Breadcrumb -->
<?php echo renderBreadcrumb([
    ['title' => 'Home', 'url' => BASE_URL],
    ['title' => 'Cars for Sale', 'url' => BASE_URL . '/public/cars/'],
    ['title' => $car ? $car['year'] . ' ' . $car['make'] . ' ' . $car['model'] : 'Car Inquiry']
]); ?>

<?php if ($formSubmitted): ?>
<!-- Success Message -->
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto text-center">
            <div class="bg-success-green text-white p-8 rounded-lg shadow-lg">
                <i class="fas fa-check-circle text-6xl mb-4"></i>
                <h1 class="text-3xl font-bold mb-4">Inquiry Sent Successfully!</h1>
                <p class="text-lg mb-6">
                    Thank you for your interest in our vehicles. We'll get back to you within 24 hours.
                </p>
                
                <div class="space-y-4">
                    <p class="text-sm opacity-90">
                        For immediate assistance, contact us directly:
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank" 
                           class="bg-white text-success-green px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                            <i class="fab fa-whatsapp mr-2"></i>WhatsApp Us
                        </a>
                        
                        <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>" 
                           class="bg-white text-success-green px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                            <i class="fas fa-phone mr-2"></i><?php echo BUSINESS_PHONE; ?>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="mt-8">
                <a href="<?php echo BASE_URL; ?>/public/cars/" class="btn-primary">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Cars
                </a>
            </div>
        </div>
    </div>
</section>

<?php else: ?>
<!-- Inquiry Form -->
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-dark-gray mb-4">
                    <?php echo $car ? 'Inquire About This Vehicle' : 'Car Inquiry'; ?>
                </h1>
                <p class="text-lg text-gray-600">
                    Get more information about our vehicles or schedule a viewing
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Vehicle Information (if specific car) -->
                <?php if ($car): ?>
                <div class="bg-light-gray p-6 rounded-lg">
                    <h2 class="text-2xl font-bold text-dark-gray mb-4">Vehicle Details</h2>
                    
                    <div class="mb-6">
                        <?php
                        $images = json_decode($car['images'], true);
                        $mainImage = !empty($images) ? $images[0] : 'placeholder.svg';
                        ?>
                        <img src="<?php echo !empty($images) ? UPLOADS_URL . '/cars/' . $mainImage : ASSETS_URL . '/images/placeholder.svg'; ?>"
                             alt="<?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?>"
                             class="w-full h-48 object-cover rounded-lg"
                             onerror="this.src='<?php echo ASSETS_URL; ?>/images/placeholder.svg'">
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-xl font-bold text-dark-gray">
                                <?php echo htmlspecialchars($car['year'] . ' ' . $car['make'] . ' ' . $car['model']); ?>
                            </h3>
                            <p class="text-2xl font-bold text-secondary-orange">
                                <?php echo formatCurrency($car['price']); ?>
                            </p>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-600">Year:</span>
                                <span class="font-semibold ml-2"><?php echo $car['year']; ?></span>
                            </div>
                            <div>
                                <span class="text-gray-600">Mileage:</span>
                                <span class="font-semibold ml-2"><?php echo number_format($car['mileage']); ?> miles</span>
                            </div>
                        </div>
                        
                        <?php if (!empty($car['description'])): ?>
                        <div>
                            <h4 class="font-semibold text-gray-700 mb-2">Description:</h4>
                            <p class="text-gray-600 text-sm">
                                <?php echo htmlspecialchars(truncateText($car['description'], 200)); ?>
                            </p>
                        </div>
                        <?php endif; ?>
                        
                        <div class="pt-4 border-t">
                            <a href="<?php echo BASE_URL; ?>/public/cars/details.php?id=<?php echo $car['id']; ?>" 
                               class="text-primary-blue hover:text-blue-700 font-semibold">
                                <i class="fas fa-eye mr-2"></i>View Full Details
                            </a>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <!-- General Information -->
                <div class="bg-light-gray p-6 rounded-lg">
                    <h2 class="text-2xl font-bold text-dark-gray mb-4">Why Choose ADJ Automotive?</h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <i class="fas fa-shield-alt text-success-green text-xl mr-3 mt-1"></i>
                            <div>
                                <h3 class="font-semibold">Quality Assurance</h3>
                                <p class="text-sm text-gray-600">All vehicles inspected by ASE Master Certified technicians</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <i class="fas fa-medal text-secondary-orange text-xl mr-3 mt-1"></i>
                            <div>
                                <h3 class="font-semibold">Veteran-Owned Business</h3>
                                <p class="text-sm text-gray-600">Over <?php echo BUSINESS_EXPERIENCE; ?> of trusted service in Guam</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <i class="fas fa-tools text-primary-blue text-xl mr-3 mt-1"></i>
                            <div>
                                <h3 class="font-semibold">Full Service Shop</h3>
                                <p class="text-sm text-gray-600">Complete automotive repair and maintenance services</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <i class="fas fa-handshake text-accent-red text-xl mr-3 mt-1"></i>
                            <div>
                                <h3 class="font-semibold">Honest Pricing</h3>
                                <p class="text-sm text-gray-600">Dealership quality at affordable prices</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Inquiry Form -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold text-dark-gray mb-6">Send Your Inquiry</h2>
                    
                    <?php if (!empty($errors)): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <ul class="list-disc list-inside">
                            <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    
                    <form method="POST" data-validate>
                        <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                        <?php if ($car): ?>
                        <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">
                        <?php endif; ?>
                        
                        <div class="space-y-6">
                            <div>
                                <label class="form-label">Full Name *</label>
                                <input type="text" name="name" required class="form-input" 
                                       value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"
                                       placeholder="Enter your full name">
                            </div>
                            
                            <div>
                                <label class="form-label">Email Address *</label>
                                <input type="email" name="email" required class="form-input" 
                                       value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                                       placeholder="Enter your email address">
                            </div>
                            
                            <div>
                                <label class="form-label">Phone Number</label>
                                <input type="tel" name="phone" class="form-input" 
                                       value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>"
                                       placeholder="Enter your phone number (optional)">
                            </div>
                            
                            <div>
                                <label class="form-label">Message *</label>
                                <textarea name="message" required class="form-input" rows="6" 
                                          placeholder="<?php echo $car ? 'Tell us about your interest in this vehicle, any questions you have, or to schedule a viewing...' : 'Tell us what type of vehicle you\'re looking for, your budget, or any specific requirements...'; ?>"><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                            </div>
                            
                            <div class="bg-light-gray p-4 rounded-lg">
                                <h3 class="font-semibold text-dark-gray mb-2">What happens next?</h3>
                                <ul class="text-sm text-gray-600 space-y-1">
                                    <li><i class="fas fa-check text-success-green mr-2"></i>We'll review your inquiry within 24 hours</li>
                                    <li><i class="fas fa-check text-success-green mr-2"></i>Our team will contact you with more information</li>
                                    <li><i class="fas fa-check text-success-green mr-2"></i>Schedule a viewing or test drive if interested</li>
                                </ul>
                            </div>
                            
                            <button type="submit" class="btn-primary w-full">
                                <i class="fas fa-paper-plane mr-2"></i>Send Inquiry
                            </button>
                        </div>
                    </form>
                    
                    <div class="mt-6 pt-6 border-t text-center">
                        <p class="text-sm text-gray-600 mb-4">Need immediate assistance?</p>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank" 
                               class="bg-success-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors text-center">
                                <i class="fab fa-whatsapp mr-2"></i>WhatsApp Chat
                            </a>
                            <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>" 
                               class="bg-primary-blue text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-center">
                                <i class="fas fa-phone mr-2"></i>Call Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php include '../includes/footer.php'; ?>
