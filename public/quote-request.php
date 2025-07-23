<?php
/**
 * ADJ Automotive Repair Services - Quote Request Form
 * Service quote request form for customers
 */

// Include configuration and functions
require_once '../config/config.php';
require_once '../includes/functions.php';
require_once '../includes/navigation.php';

// Page variables
$pageTitle = 'Request a Quote';
$pageDescription = 'Get a free quote for automotive repair services at ADJ Automotive Repair Services in Guam. Professional estimates from ASE Master Certified technicians.';

// Handle form submission
$formSubmitted = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
        $errors[] = 'Security token mismatch. Please try again.';
    } else {
        // Validate form data
        $customerName = sanitizeInput($_POST['customer_name'] ?? '');
        $email = sanitizeInput($_POST['email'] ?? '');
        $phone = sanitizeInput($_POST['phone'] ?? '');
        $serviceType = sanitizeInput($_POST['service_type'] ?? '');
        $vehicleMake = sanitizeInput($_POST['vehicle_make'] ?? '');
        $vehicleModel = sanitizeInput($_POST['vehicle_model'] ?? '');
        $vehicleYear = (int)($_POST['vehicle_year'] ?? 0);
        $description = sanitizeInput($_POST['description'] ?? '');
        
        // Validation
        if (empty($customerName)) {
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
        
        if (empty($serviceType)) {
            $errors[] = 'Service type is required.';
        }
        
        if (empty($description)) {
            $errors[] = 'Service description is required.';
        }
        
        // If no errors, save quote request
        if (empty($errors)) {
            try {
                $quoteData = [
                    'customer_name' => $customerName,
                    'email' => $email,
                    'phone' => $phone,
                    'service_type' => $serviceType,
                    'vehicle_make' => $vehicleMake,
                    'vehicle_model' => $vehicleModel,
                    'vehicle_year' => $vehicleYear > 0 ? $vehicleYear : null,
                    'description' => $description
                ];
                
                $quoteId = createQuote($quoteData);
                
                if ($quoteId) {
                    $formSubmitted = true;
                    
                    // TODO: Send email notification to admin
                    // This would be implemented with PHPMailer in a later phase
                    
                } else {
                    $errors[] = 'Failed to submit quote request. Please try again.';
                }
            } catch (Exception $e) {
                error_log('Quote request submission error: ' . $e->getMessage());
                $errors[] = 'An error occurred. Please try again later.';
            }
        }
    }
}

// Include header
include '../includes/header.php';
?>

<!-- Professional Quote Request Page -->
<div class="quote-page">
    <!-- Compact Header Section -->
    <section class="quote-header">
        <div class="container mx-auto px-4">
            <div class="header-content">
                <h1 class="page-title">Request a Quote</h1>
                <p class="page-subtitle">Professional estimates from ASE Master Certified technicians</p>
            </div>
        </div>
    </section>

    <?php if ($formSubmitted): ?>
    <!-- Success Message -->
    <section class="success-section">
        <div class="container mx-auto px-4">
            <div class="success-card">
                <div class="success-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h2>Quote Request Submitted Successfully!</h2>
                <p>Thank you for choosing ADJ Automotive! We'll contact you within 24 hours with your detailed estimate.</p>

                <div class="contact-options">
                    <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>" class="contact-btn">
                        <i class="fas fa-phone"></i> Call <?php echo BUSINESS_PHONE; ?>
                    </a>
                    <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank" class="contact-btn whatsapp">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                </div>

                <a href="<?php echo BASE_URL; ?>/public/services/" class="back-link">
                    <i class="fas fa-arrow-left"></i> Back to Services
                </a>
            </div>
        </div>
    </section>

    <?php else: ?>
    <!-- Quote Form Section -->
    <section class="form-section">
        <div class="container mx-auto px-4">
            <div class="form-layout">
                <!-- Main Form -->
                <div class="form-main">
                    <div class="form-card">
                        <?php if (!empty($errors)): ?>
                        <div class="error-alert">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div>
                                <strong>Please correct the following errors:</strong>
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <?php endif; ?>

                        <form method="POST" class="quote-form">
                            <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">

                            <div class="form-columns">
                                <!-- Left Column -->
                                <div class="form-column">
                                    <!-- Customer Information -->
                                    <div class="form-section">
                                        <h3><i class="fas fa-user"></i> Customer Information</h3>
                                        <div class="form-grid">
                                            <div class="form-group">
                                                <label>Full Name *</label>
                                                <input type="text" name="customer_name" required
                                                       value="<?php echo htmlspecialchars($_POST['customer_name'] ?? ''); ?>"
                                                       placeholder="Full Name">
                                            </div>
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="tel" name="phone"
                                                       value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>"
                                                       placeholder="(671) 123-4567">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Email Address *</label>
                                            <input type="email" name="email" required
                                                   value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                                                   placeholder="Enter your email address">
                                        </div>
                                    </div>

                                    <!-- Service Information -->
                                    <div class="form-section">
                                        <h3><i class="fas fa-tools"></i> Service Information</h3>
                                        <div class="form-group">
                                            <label>Service Type *</label>
                                            <select name="service_type" required>
                                                <option value="">Select service...</option>
                                                <option value="Transmission Rebuilding" <?php echo (($_POST['service_type'] ?? '') === 'Transmission Rebuilding') ? 'selected' : ''; ?>>Transmission Rebuilding</option>
                                                <option value="Engine Repair" <?php echo (($_POST['service_type'] ?? '') === 'Engine Repair') ? 'selected' : ''; ?>>Engine Repair & Rebuilding</option>
                                                <option value="Advanced Diagnostics" <?php echo (($_POST['service_type'] ?? '') === 'Advanced Diagnostics') ? 'selected' : ''; ?>>Advanced Diagnostics</option>
                                                <option value="Brake Service" <?php echo (($_POST['service_type'] ?? '') === 'Brake Service') ? 'selected' : ''; ?>>Brake Service</option>
                                                <option value="Electrical Service" <?php echo (($_POST['service_type'] ?? '') === 'Electrical Service') ? 'selected' : ''; ?>>Electrical Service</option>
                                                <option value="HVAC Service" <?php echo (($_POST['service_type'] ?? '') === 'HVAC Service') ? 'selected' : ''; ?>>Heating & Air Conditioning</option>
                                                <option value="Suspension Service" <?php echo (($_POST['service_type'] ?? '') === 'Suspension Service') ? 'selected' : ''; ?>>Suspension & Steering</option>
                                                <option value="Exhaust Service" <?php echo (($_POST['service_type'] ?? '') === 'Exhaust Service') ? 'selected' : ''; ?>>Exhaust Service</option>
                                                <option value="Key Programming" <?php echo (($_POST['service_type'] ?? '') === 'Key Programming') ? 'selected' : ''; ?>>Key Programming</option>
                                                <option value="General Repair" <?php echo (($_POST['service_type'] ?? '') === 'General Repair') ? 'selected' : ''; ?>>General Repair</option>
                                                <option value="Fleet Service" <?php echo (($_POST['service_type'] ?? '') === 'Fleet Service') ? 'selected' : ''; ?>>Fleet Service</option>
                                                <option value="Other" <?php echo (($_POST['service_type'] ?? '') === 'Other') ? 'selected' : ''; ?>>Other (specify in description)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="form-column">
                                    <!-- Vehicle Information -->
                                    <div class="form-section">
                                        <h3><i class="fas fa-car"></i> Vehicle Information</h3>
                                        <div class="form-grid three-columns">
                                            <div class="form-group">
                                                <label>Make</label>
                                                <input type="text" name="vehicle_make"
                                                       value="<?php echo htmlspecialchars($_POST['vehicle_make'] ?? ''); ?>"
                                                       placeholder="Toyota">
                                            </div>
                                            <div class="form-group">
                                                <label>Model</label>
                                                <input type="text" name="vehicle_model"
                                                       value="<?php echo htmlspecialchars($_POST['vehicle_model'] ?? ''); ?>"
                                                       placeholder="Camry">
                                            </div>
                                            <div class="form-group">
                                                <label>Year</label>
                                                <select name="vehicle_year">
                                                    <option value="">Year</option>
                                                    <?php for ($year = date('Y') + 1; $year >= 1990; $year--): ?>
                                                    <option value="<?php echo $year; ?>" <?php echo (($_POST['vehicle_year'] ?? 0) == $year) ? 'selected' : ''; ?>>
                                                        <?php echo $year; ?>
                                                    </option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Service Description -->
                                    <div class="form-section">
                                        <h3><i class="fas fa-clipboard-list"></i> Service Description</h3>
                                        <div class="form-group">
                                            <label>Describe the service needed *</label>
                                            <textarea name="description" required rows="5"
                                                      placeholder="Describe the problem or service needed..."><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-submit">
                                <button type="submit" class="submit-btn">
                                    <i class="fas fa-paper-plane"></i>
                                    Submit Quote Request
                                </button>
                                <p class="submit-note">We'll contact you within 24 hours with your estimate</p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Contact Card -->
                    <div class="sidebar-card">
                        <h3><i class="fas fa-headset"></i> Need Help?</h3>

                        <div class="contact-list">
                            <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>" class="contact-item">
                                <i class="fas fa-phone"></i>
                                <div>
                                    <strong>Call Us</strong>
                                    <span><?php echo BUSINESS_PHONE; ?></span>
                                </div>
                            </a>

                            <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank" class="contact-item">
                                <i class="fab fa-whatsapp"></i>
                                <div>
                                    <strong>WhatsApp</strong>
                                    <span>Chat Now</span>
                                </div>
                            </a>

                            <a href="mailto:<?php echo BUSINESS_EMAIL; ?>" class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <div>
                                    <strong>Email</strong>
                                    <span><?php echo BUSINESS_EMAIL; ?></span>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Business Hours -->
                    <div class="sidebar-card">
                        <h3><i class="fas fa-clock"></i> Business Hours</h3>

                        <div class="hours-list">
                            <?php foreach (BUSINESS_HOURS as $day => $hours): ?>
                            <div class="hours-item">
                                <span><?php echo $day; ?></span>
                                <span class="<?php echo $hours === 'Closed' ? 'closed' : ''; ?>">
                                    <?php echo $hours; ?>
                                </span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
