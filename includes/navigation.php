<?php
/**
 * ADJ Automotive Repair Services - Navigation Helper
 * Functions for generating navigation menus and breadcrumbs
 */

/**
 * Get current page for navigation highlighting
 */
function getCurrentPage() {
    $currentPath = $_SERVER['REQUEST_URI'];
    $basePath = str_replace(BASE_URL, '', $currentPath);
    return $basePath;
}

/**
 * Check if current page matches given path
 */
function isCurrentPage($path) {
    $currentPath = getCurrentPage();
    return strpos($currentPath, $path) !== false;
}

/**
 * Generate main navigation menu
 */
function getMainNavigation() {
    $navigation = [
        [
            'title' => 'Home',
            'url' => BASE_URL,
            'icon' => 'fas fa-home',
            'active' => getCurrentPage() === '/' || getCurrentPage() === ''
        ],
        [
            'title' => 'Services',
            'url' => BASE_URL . '/public/services/',
            'icon' => 'fas fa-wrench',
            'active' => isCurrentPage('/services/'),
            'submenu' => [
                [
                    'title' => 'Transmission Rebuilding',
                    'url' => BASE_URL . '/public/services/transmission.php',
                    'icon' => 'fas fa-cogs',
                    'description' => 'Complete transmission rebuild with 1-year warranty'
                ],
                [
                    'title' => 'Engine Repair',
                    'url' => BASE_URL . '/public/services/engine-repair.php',
                    'icon' => 'fas fa-engine',
                    'description' => 'Professional engine repair and rebuilding'
                ],
                [
                    'title' => 'Advanced Diagnostics',
                    'url' => BASE_URL . '/public/services/diagnostics.php',
                    'icon' => 'fas fa-search',
                    'description' => 'Autel MaxiSys Ultra diagnostic services'
                ],
                [
                    'title' => 'Other Services',
                    'url' => BASE_URL . '/public/services/other-services.php',
                    'icon' => 'fas fa-tools',
                    'description' => 'Brakes, electrical, HVAC, and more'
                ]
            ]
        ],
        [
            'title' => 'Cars for Sale',
            'url' => BASE_URL . '/public/cars/',
            'icon' => 'fas fa-car',
            'active' => isCurrentPage('/cars/')
        ],
        [
            'title' => 'About Us',
            'url' => BASE_URL . '/public/about.php',
            'icon' => 'fas fa-info-circle',
            'active' => isCurrentPage('/about.php')
        ],
        [
            'title' => 'Contact',
            'url' => BASE_URL . '/public/contact.php',
            'icon' => 'fas fa-envelope',
            'active' => isCurrentPage('/contact.php')
        ]
    ];
    
    return $navigation;
}

/**
 * Generate admin navigation menu
 */
function getAdminNavigation() {
    $navigation = [
        [
            'title' => 'Dashboard',
            'url' => ADMIN_URL . '/dashboard.php',
            'icon' => 'fas fa-tachometer-alt',
            'active' => isCurrentPage('/admin/dashboard.php')
        ],
        [
            'title' => 'Car Inventory',
            'url' => ADMIN_URL . '/cars/manage.php',
            'icon' => 'fas fa-car',
            'active' => isCurrentPage('/admin/cars/'),
            'submenu' => [
                [
                    'title' => 'Manage Cars',
                    'url' => ADMIN_URL . '/cars/manage.php',
                    'icon' => 'fas fa-list'
                ],
                [
                    'title' => 'Add New Car',
                    'url' => ADMIN_URL . '/cars/add.php',
                    'icon' => 'fas fa-plus'
                ]
            ]
        ],
        [
            'title' => 'Services',
            'url' => ADMIN_URL . '/services/quotes.php',
            'icon' => 'fas fa-wrench',
            'active' => isCurrentPage('/admin/services/'),
            'submenu' => [
                [
                    'title' => 'Quote Requests',
                    'url' => ADMIN_URL . '/services/quotes.php',
                    'icon' => 'fas fa-file-invoice-dollar'
                ],
                [
                    'title' => 'Appointments',
                    'url' => ADMIN_URL . '/services/appointments.php',
                    'icon' => 'fas fa-calendar-alt'
                ],
                [
                    'title' => 'Work Orders',
                    'url' => ADMIN_URL . '/services/work-orders.php',
                    'icon' => 'fas fa-clipboard-list'
                ]
            ]
        ],
        [
            'title' => 'Inquiries',
            'url' => ADMIN_URL . '/inquiries/car-inquiries.php',
            'icon' => 'fas fa-comments',
            'active' => isCurrentPage('/admin/inquiries/'),
            'submenu' => [
                [
                    'title' => 'Car Inquiries',
                    'url' => ADMIN_URL . '/inquiries/car-inquiries.php',
                    'icon' => 'fas fa-car'
                ],
                [
                    'title' => 'Service Inquiries',
                    'url' => ADMIN_URL . '/inquiries/service-inquiries.php',
                    'icon' => 'fas fa-wrench'
                ]
            ]
        ],
        [
            'title' => 'Content',
            'url' => ADMIN_URL . '/content/homepage.php',
            'icon' => 'fas fa-edit',
            'active' => isCurrentPage('/admin/content/'),
            'submenu' => [
                [
                    'title' => 'Homepage',
                    'url' => ADMIN_URL . '/content/homepage.php',
                    'icon' => 'fas fa-home'
                ],
                [
                    'title' => 'Services',
                    'url' => ADMIN_URL . '/content/services.php',
                    'icon' => 'fas fa-wrench'
                ],
                [
                    'title' => 'Promotions',
                    'url' => ADMIN_URL . '/content/promotions.php',
                    'icon' => 'fas fa-gift'
                ]
            ]
        ],
        [
            'title' => 'Settings',
            'url' => ADMIN_URL . '/settings/business-info.php',
            'icon' => 'fas fa-cog',
            'active' => isCurrentPage('/admin/settings/'),
            'submenu' => [
                [
                    'title' => 'Business Info',
                    'url' => ADMIN_URL . '/settings/business-info.php',
                    'icon' => 'fas fa-building'
                ],
                [
                    'title' => 'Admin Profile',
                    'url' => ADMIN_URL . '/settings/profile.php',
                    'icon' => 'fas fa-user'
                ],
                [
                    'title' => 'Notifications',
                    'url' => ADMIN_URL . '/settings/notifications.php',
                    'icon' => 'fas fa-bell'
                ]
            ]
        ]
    ];
    
    return $navigation;
}

/**
 * Generate breadcrumb for current page
 */
function generatePageBreadcrumb() {
    $currentPath = getCurrentPage();
    $breadcrumb = [
        ['title' => 'Home', 'url' => BASE_URL]
    ];
    
    // Parse the current path to generate breadcrumb
    $pathParts = explode('/', trim($currentPath, '/'));
    $pathParts = array_filter($pathParts); // Remove empty elements
    
    $currentUrl = BASE_URL;
    
    foreach ($pathParts as $index => $part) {
        $currentUrl .= '/' . $part;
        
        // Skip file extensions and convert to readable titles
        $title = str_replace(['.php', '-', '_'], [' ', ' ', ' '], $part);
        $title = ucwords($title);
        
        // Custom titles for specific pages
        $customTitles = [
            'public' => '',
            'cars' => 'Cars for Sale',
            'services' => 'Services',
            'transmission' => 'Transmission Rebuilding',
            'engine-repair' => 'Engine Repair',
            'diagnostics' => 'Advanced Diagnostics',
            'other-services' => 'Other Services',
            'about' => 'About Us',
            'contact' => 'Contact',
            'quote-request' => 'Request Quote',
            'car-inquiry' => 'Car Inquiry'
        ];
        
        if (isset($customTitles[$part])) {
            $title = $customTitles[$part];
        }
        
        // Skip empty titles (like 'public')
        if (!empty($title)) {
            // Don't add URL for the last item (current page)
            if ($index === count($pathParts) - 1) {
                $breadcrumb[] = ['title' => $title];
            } else {
                $breadcrumb[] = ['title' => $title, 'url' => $currentUrl];
            }
        }
    }
    
    return $breadcrumb;
}

/**
 * Render breadcrumb HTML
 */
function renderBreadcrumb($items = null) {
    if ($items === null) {
        $items = generatePageBreadcrumb();
    }
    
    if (count($items) <= 1) {
        return ''; // Don't show breadcrumb for homepage
    }
    
    $html = '<nav class="bg-light-gray py-3" aria-label="Breadcrumb">';
    $html .= '<div class="container mx-auto px-4">';
    $html .= '<ol class="flex items-center space-x-2 text-sm">';
    
    foreach ($items as $index => $item) {
        $html .= '<li class="flex items-center">';
        
        if ($index > 0) {
            $html .= '<i class="fas fa-chevron-right text-gray-400 mx-2"></i>';
        }
        
        if (isset($item['url']) && $index < count($items) - 1) {
            $html .= '<a href="' . htmlspecialchars($item['url']) . '" class="text-primary-blue hover:text-blue-800 transition-colors">';
            $html .= htmlspecialchars($item['title']);
            $html .= '</a>';
        } else {
            $html .= '<span class="text-gray-600">' . htmlspecialchars($item['title']) . '</span>';
        }
        
        $html .= '</li>';
    }
    
    $html .= '</ol>';
    $html .= '</div>';
    $html .= '</nav>';
    
    return $html;
}

/**
 * Get page title based on current path
 */
function getPageTitle() {
    $currentPath = getCurrentPage();
    
    $pageTitles = [
        '/' => 'Home',
        '/public/services/' => 'Our Services',
        '/public/services/transmission.php' => 'Transmission Rebuilding',
        '/public/services/engine-repair.php' => 'Engine Repair & Rebuilding',
        '/public/services/diagnostics.php' => 'Advanced Diagnostics',
        '/public/services/other-services.php' => 'Other Automotive Services',
        '/public/cars/' => 'Cars for Sale',
        '/public/about.php' => 'About Us',
        '/public/contact.php' => 'Contact Us',
        '/public/quote-request.php' => 'Request a Quote',
        '/public/car-inquiry.php' => 'Car Inquiry'
    ];
    
    return $pageTitles[$currentPath] ?? 'ADJ Automotive';
}
?>
