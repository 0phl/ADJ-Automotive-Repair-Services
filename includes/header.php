<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- SEO Meta Tags -->
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' . APP_NAME : APP_NAME . ' - ' . APP_DESCRIPTION; ?></title>
    <meta name="description" content="<?php echo isset($pageDescription) ? $pageDescription : META_DESCRIPTION; ?>">
    <meta name="keywords" content="<?php echo META_KEYWORDS; ?>">
    <meta name="author" content="<?php echo BUSINESS_NAME; ?>">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo isset($pageTitle) ? $pageTitle . ' - ' . APP_NAME : APP_NAME; ?>">
    <meta property="og:description" content="<?php echo isset($pageDescription) ? $pageDescription : META_DESCRIPTION; ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo BASE_URL . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:site_name" content="<?php echo BUSINESS_NAME; ?>">
    
    <!-- Local Business Schema -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "AutoRepair",
        "name": "<?php echo BUSINESS_NAME; ?>",
        "description": "<?php echo APP_DESCRIPTION; ?>",
        "url": "<?php echo BASE_URL; ?>",
        "telephone": "<?php echo BUSINESS_PHONE; ?>",
        "email": "<?php echo BUSINESS_EMAIL; ?>",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "125 Chalan Ayuyu",
            "addressLocality": "Yigo",
            "addressRegion": "Guam",
            "postalCode": "96929",
            "addressCountry": "US"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": "13.5361",
            "longitude": "144.8861"
        },
        "openingHours": [
            "Mo-Fr 08:00-17:00",
            "Sa 08:00-14:00"
        ],
        "priceRange": "$$",
        "paymentAccepted": "Cash, Check, Credit Card",
        "currenciesAccepted": "USD"
    }
    </script>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo ASSETS_URL; ?>/images/logos/adjlogo.png">
    
    <!-- Tailwind CSS - Local Build -->
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/css/tailwind.css">
    
    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Additional head content -->
    <?php if (isset($additionalHead)) echo $additionalHead; ?>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-primary-blue text-white px-4 py-2 rounded">
        Skip to main content
    </a>

    <!-- Sticky Header Container -->
    <div class="sticky top-0 z-50">
        <!-- Top Bar with Contact Info -->
        <div class="bg-dark-blue text-white py-2 hidden md:block">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center space-x-6">
                        <span class="flex items-center">
                            <i class="fas fa-phone mr-2"></i>
                            <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>" class="hover:text-secondary-yellow">
                                <?php echo BUSINESS_PHONE; ?>
                            </a>
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-envelope mr-2"></i>
                            <a href="mailto:<?php echo BUSINESS_EMAIL; ?>" class="hover:text-secondary-yellow">
                                <?php echo BUSINESS_EMAIL; ?>
                            </a>
                        </span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-blue-200">Veteran Owned Small Business</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Header -->
        <header class="bg-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-20">
                <!-- Logo and Business Name -->
                <div class="flex items-center">
                    <a href="<?php echo BASE_URL; ?>" class="flex items-center">
                        <img src="<?php echo ASSETS_URL; ?>/images/logos/adj-text-logo.png" alt="<?php echo BUSINESS_NAME; ?>" style="height: 160px; width: auto;">
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-8">
                    <a href="<?php echo BASE_URL; ?>" class="text-gray-700 hover:text-primary-blue font-medium transition-colors">
                        Home
                    </a>
                    <div class="relative group">
                        <a href="<?php echo BASE_URL; ?>/public/services/" class="text-gray-700 hover:text-primary-blue font-medium transition-colors flex items-center">
                            Services <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </a>
                        <div class="absolute top-full left-0 bg-white shadow-lg rounded-lg py-2 w-64 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <a href="<?php echo BASE_URL; ?>/public/services/transmission.php" class="block px-4 py-2 text-gray-700 hover:bg-light-gray hover:text-primary-blue">
                                <i class="fas fa-cogs mr-2"></i>Transmission Rebuilding
                            </a>
                            <a href="<?php echo BASE_URL; ?>/public/services/engine-repair.php" class="block px-4 py-2 text-gray-700 hover:bg-light-gray hover:text-primary-blue">
                                <i class="fas fa-engine mr-2"></i>Engine Repair
                            </a>
                            <a href="<?php echo BASE_URL; ?>/public/services/diagnostics.php" class="block px-4 py-2 text-gray-700 hover:bg-light-gray hover:text-primary-blue">
                                <i class="fas fa-search mr-2"></i>Advanced Diagnostics
                            </a>
                            <a href="<?php echo BASE_URL; ?>/public/services/other-services.php" class="block px-4 py-2 text-gray-700 hover:bg-light-gray hover:text-primary-blue">
                                <i class="fas fa-wrench mr-2"></i>Other Services
                            </a>
                        </div>
                    </div>
                    <a href="<?php echo BASE_URL; ?>/public/cars/" class="text-gray-700 hover:text-primary-blue font-medium transition-colors">
                        Cars for Sale
                    </a>
                    <a href="<?php echo BASE_URL; ?>/public/about.php" class="text-gray-700 hover:text-primary-blue font-medium transition-colors">
                        About Us
                    </a>
                    <a href="<?php echo BASE_URL; ?>/public/contact.php" class="text-gray-700 hover:text-primary-blue font-medium transition-colors">
                        Contact
                    </a>
                </nav>

                <!-- CTA Buttons - Removed Book Appointment as it's already in hero section -->
                <div class="hidden lg:flex items-center space-x-4">
                    <!-- Book Appointment button removed to avoid duplication with hero section -->
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="lg:hidden text-gray-700 hover:text-primary-blue" aria-expanded="false" aria-controls="mobile-menu" aria-label="Toggle mobile menu">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="lg:hidden bg-white border-t hidden">
            <div class="container mx-auto px-4 py-4">
                <nav class="space-y-4">
                    <a href="<?php echo BASE_URL; ?>" class="block text-gray-700 hover:text-primary-blue font-medium">
                        Home
                    </a>
                    <div>
                        <button class="w-full text-left text-gray-700 hover:text-primary-blue font-medium flex items-center justify-between" onclick="toggleMobileSubmenu('services', event)" aria-expanded="false">
                            Services <i class="fas fa-chevron-down"></i>
                        </button>
                        <div id="mobile-services-submenu" class="hidden mt-2 ml-4 space-y-2">
                            <a href="<?php echo BASE_URL; ?>/public/services/transmission.php" class="block text-gray-600 hover:text-primary-blue">
                                Transmission Rebuilding
                            </a>
                            <a href="<?php echo BASE_URL; ?>/public/services/engine-repair.php" class="block text-gray-600 hover:text-primary-blue">
                                Engine Repair
                            </a>
                            <a href="<?php echo BASE_URL; ?>/public/services/diagnostics.php" class="block text-gray-600 hover:text-primary-blue">
                                Advanced Diagnostics
                            </a>
                            <a href="<?php echo BASE_URL; ?>/public/services/other-services.php" class="block text-gray-600 hover:text-primary-blue">
                                Other Services
                            </a>
                        </div>
                    </div>
                    <a href="<?php echo BASE_URL; ?>/public/cars/" class="block text-gray-700 hover:text-primary-blue font-medium">
                        Cars for Sale
                    </a>
                    <a href="<?php echo BASE_URL; ?>/public/about.php" class="block text-gray-700 hover:text-primary-blue font-medium">
                        About Us
                    </a>
                    <a href="<?php echo BASE_URL; ?>/public/contact.php" class="block text-gray-700 hover:text-primary-blue font-medium">
                        Contact
                    </a>
                    
                </nav>
            </div>
        </div>
    </header>
    </div>

    <!-- Flash Messages -->
    <?php 
    $flashMessage = getFlashMessage();
    if ($flashMessage): 
    ?>
    <div id="flash-message" class="bg-<?php echo $flashMessage['type'] === 'error' ? 'red' : ($flashMessage['type'] === 'success' ? 'green' : 'blue'); ?>-100 border border-<?php echo $flashMessage['type'] === 'error' ? 'red' : ($flashMessage['type'] === 'success' ? 'green' : 'blue'); ?>-400 text-<?php echo $flashMessage['type'] === 'error' ? 'red' : ($flashMessage['type'] === 'success' ? 'green' : 'blue'); ?>-700 px-4 py-3 rounded relative mx-4 mt-4" role="alert">
        <span class="block sm:inline"><?php echo htmlspecialchars($flashMessage['message']); ?></span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="document.getElementById('flash-message').style.display='none'">
            <i class="fas fa-times"></i>
        </span>
    </div>
    <?php endif; ?>

    <!-- Main Content -->
    <main id="main-content">
