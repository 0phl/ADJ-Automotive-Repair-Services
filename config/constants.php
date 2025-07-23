<?php
/**
 * ADJ Automotive Repair Services - Application Constants
 * Global constants and configuration values
 */

// Application Information
define('APP_NAME', 'ADJ Automotive Repair Services');
define('APP_VERSION', '1.0.0');
define('APP_DESCRIPTION', 'YOUR TRUSTED CAR REPAIR EXPERTS');

// Environment
define('ENVIRONMENT', 'development'); // Change to 'production' for live site

// Paths
define('ROOT_PATH', dirname(__DIR__));
define('BASE_URL', 'http://localhost'); // Change for production
define('ADMIN_URL', BASE_URL . '/admin');
define('ASSETS_URL', BASE_URL . '/assets');
define('UPLOADS_URL', BASE_URL . '/uploads');

// Business Information (from business profile)
define('BUSINESS_NAME', 'ADJ Automotive Repair Services');
define('BUSINESS_SLOGAN', 'YOUR TRUSTED CAR REPAIR EXPERTS');
define('BUSINESS_PHONE', '(671) 483-8335');
define('BUSINESS_EMAIL', 'adjauto1@gmail.com');
define('BUSINESS_WHATSAPP', '(671) 483-8335');
define('BUSINESS_MAILING_ADDRESS', 'P.O Box 11393 Tamuning, Guam 96931');
define('BUSINESS_PHYSICAL_ADDRESS', '125 Chalan Ayuyu Yigo, Guam 96929');
define('BUSINESS_INSTAGRAM', '@adjauto | @adjautomotive');
define('BUSINESS_UEI_ID', 'QRX8K2LWRW11');
define('BUSINESS_CAGE_CODE', '9C0Z7');
define('BUSINESS_STATUS', 'Veteran Owned Small Business (VOSB)');
define('BUSINESS_EXPERIENCE', '38+ years');

// Professional Blue & Yellow Palette
define('COLOR_PRIMARY_BLUE', '#1e40af');        // Professional Blue - Primary brand color
define('COLOR_SECONDARY_YELLOW', '#fbbf24');    // Bright Yellow - Accent color
define('COLOR_LIGHT_GRAY', '#f8fafc');         // Very Light Gray - Clean backgrounds
define('COLOR_WHITE', '#ffffff');              // Pure White - Clean backgrounds
define('COLOR_DARK_BLUE', '#1e3a8a');          // Darker Blue - Headers and emphasis
define('COLOR_TEXT_GRAY', '#64748b');          // Medium Gray - Body text
define('COLOR_BORDER_GRAY', '#e2e8f0');        // Light Gray - Borders and dividers

// Legacy color constants (mapped to new palette for compatibility)
define('COLOR_SECONDARY_ORANGE', '#fbbf24');    // Mapped to yellow
define('COLOR_ACCENT_RED', '#1e40af');          // Mapped to primary blue
define('COLOR_DARK_GRAY', '#1e3a8a');           // Mapped to dark blue
define('COLOR_SUCCESS_GREEN', '#10b981');       // Green for success states
define('COLOR_WARNING_YELLOW', '#fbbf24');      // Yellow for warnings
define('COLOR_BLACK', '#0f172a');              // Near black for high contrast text

// File Upload Settings
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_IMAGE_TYPES', ['jpg', 'jpeg', 'png', 'gif']);
define('UPLOAD_PATH', ROOT_PATH . '/uploads');
define('CAR_IMAGES_PATH', UPLOAD_PATH . '/cars');
define('SERVICE_IMAGES_PATH', UPLOAD_PATH . '/services');
define('GALLERY_IMAGES_PATH', UPLOAD_PATH . '/gallery');

// Pagination
define('CARS_PER_PAGE', 12);
define('INQUIRIES_PER_PAGE', 20);
define('QUOTES_PER_PAGE', 20);

// Session Settings
define('SESSION_TIMEOUT', 3600); // 1 hour
define('ADMIN_SESSION_TIMEOUT', 7200); // 2 hours

// Email Settings (for PHPMailer)
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', BUSINESS_EMAIL);
define('SMTP_PASSWORD', ''); // Set in production
define('SMTP_FROM_NAME', BUSINESS_NAME);

// Service Categories
define('SERVICE_CATEGORIES', [
    'transmission' => 'Transmission Services',
    'engine' => 'Engine Services',
    'diagnostics' => 'Diagnostics',
    'general' => 'General Repair',
    'electrical' => 'Electrical Systems',
    'brakes' => 'Brake Services',
    'suspension' => 'Suspension & Steering',
    'hvac' => 'Heating & Air Conditioning',
    'exhaust' => 'Exhaust Systems',
    'programming' => 'Key Programming'
]);

// Labor Rates (from business profile)
define('LABOR_RATE_CAR_LIGHT', 125.00);
define('LABOR_RATE_DIESEL_HEAVY', 200.00);
define('LABOR_RATE_ENGINE_DIAGNOSTICS', 150.00);
define('LABOR_RATE_TRANSMISSION', 200.00);
define('LABOR_RATE_PROGRAMMING', 150.00);
define('LABOR_RATE_DIAGNOSTICS_CAR', 150.00);
define('LABOR_RATE_DIAGNOSTICS_DIESEL', 250.00);

// Transmission Rebuild Base Price
define('TRANSMISSION_REBUILD_BASE_PRICE', 3700.00);

// Key Programming Base Price
define('KEY_PROGRAMMING_BASE_PRICE', 350.00);

// Status Options
define('CAR_STATUS_OPTIONS', [
    'available' => 'Available',
    'sold' => 'Sold',
    'pending' => 'Pending'
]);

define('INQUIRY_STATUS_OPTIONS', [
    'new' => 'New',
    'contacted' => 'Contacted',
    'in_progress' => 'In Progress',
    'completed' => 'Completed',
    'closed' => 'Closed'
]);

define('QUOTE_STATUS_OPTIONS', [
    'pending' => 'Pending',
    'quoted' => 'Quoted',
    'approved' => 'Approved',
    'declined' => 'Declined',
    'completed' => 'Completed'
]);

define('APPOINTMENT_STATUS_OPTIONS', [
    'pending' => 'Pending',
    'confirmed' => 'Confirmed',
    'completed' => 'Completed',
    'cancelled' => 'Cancelled'
]);

// ASE Certifications (from business profile)
define('ASE_CERTIFICATIONS', [
    'ASE Master Automotive Technician',
    'ASE Medium/Heavy Truck',
    'ASE Heating & Air Conditioning',
    'ASE Electrical/Electronic System',
    'ASE Engine Repair',
    'ASE Exhaust System',
    'ASE Automatic Transmission/Transaxle',
    'ASE Suspension & Steering',
    'ASE Brakes'
]);

// Manufacturer Certifications (from business profile)
define('MANUFACTURER_CERTIFICATIONS', [
    'General Motors: Powertrain & Engine Management',
    'Chrysler: Powertrain & Engine Management',
    'Mercedes Benz: Powertrain & Engine Management',
    'Ford Master Technician',
    'Toyota Master Technician',
    'Lexus Master Technician'
]);

// Promotional Items (from business profile)
define('PROMOTIONAL_ITEMS', [
    'ID Lanyard',
    'Umbrella',
    'Notebooks',
    'Ballpens',
    'Sunshield',
    'Tumbler',
    'Tote Bag',
    'Hat'
]);

// Supported Vehicle Brands (from business profile)
define('SUPPORTED_BRANDS', [
    'Ford',
    'Lexus',
    'Toyota',
    'Dodge',
    'General Motors',
    'Chrysler',
    'Mercedes Benz',
    'All makes and models for transmission work'
]);

// Meta Tags for SEO
define('META_KEYWORDS', 'automotive repair, transmission rebuild, engine repair, Guam, veteran owned, ASE certified, car repair, fleet services');
define('META_DESCRIPTION', 'ADJ Automotive Repair Services - Veteran-owned automotive repair in Guam. Specializing in transmission rebuilding, engine repair, and advanced diagnostics. ASE Master Certified with 38+ years experience.');

// Social Media
define('WHATSAPP_LINK', 'https://wa.me/16714838335');
define('INSTAGRAM_LINK', 'https://instagram.com/adjautomotive');

// Business Hours
define('BUSINESS_HOURS', [
    'Monday' => '8:00 AM - 5:00 PM',
    'Tuesday' => '8:00 AM - 5:00 PM',
    'Wednesday' => '8:00 AM - 5:00 PM',
    'Thursday' => '8:00 AM - 5:00 PM',
    'Friday' => '8:00 AM - 5:00 PM',
    'Saturday' => '8:00 AM - 2:00 PM',
    'Sunday' => 'Closed'
]);
?>
