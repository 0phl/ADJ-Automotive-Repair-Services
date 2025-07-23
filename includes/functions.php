<?php
/**
 * ADJ Automotive Repair Services - Helper Functions
 * Common utility functions used throughout the application
 */

/**
 * Get all cars with optional filters
 */
function getCars($filters = [], $limit = null, $offset = 0) {
    $db = getDB();
    $where = ['1=1'];
    $params = [];
    
    if (!empty($filters['status'])) {
        $where[] = 'status = ?';
        $params[] = $filters['status'];
    }
    
    if (!empty($filters['make'])) {
        $where[] = 'make = ?';
        $params[] = $filters['make'];
    }
    
    if (!empty($filters['year_min'])) {
        $where[] = 'year >= ?';
        $params[] = $filters['year_min'];
    }
    
    if (!empty($filters['year_max'])) {
        $where[] = 'year <= ?';
        $params[] = $filters['year_max'];
    }
    
    if (!empty($filters['price_min'])) {
        $where[] = 'price >= ?';
        $params[] = $filters['price_min'];
    }
    
    if (!empty($filters['price_max'])) {
        $where[] = 'price <= ?';
        $params[] = $filters['price_max'];
    }
    
    if (!empty($filters['featured'])) {
        $where[] = 'featured = 1';
    }
    
    $sql = "SELECT * FROM cars WHERE " . implode(' AND ', $where) . " ORDER BY featured DESC, created_at DESC";
    
    if ($limit) {
        $sql .= " LIMIT ? OFFSET ?";
        $params[] = $limit;
        $params[] = $offset;
    }
    
    return $db->fetchAll($sql, $params);
}

/**
 * Get single car by ID
 */
function getCarById($id) {
    $db = getDB();
    return $db->fetch("SELECT * FROM cars WHERE id = ?", [$id]);
}

/**
 * Get featured cars - ensures minimum of 3 cars are shown
 */
function getFeaturedCars($limit = 3) {
    // First, get featured cars
    $featuredCars = getCars(['featured' => true, 'status' => 'available'], $limit);

    // If we don't have enough featured cars, fill with regular available cars
    if (count($featuredCars) < $limit) {
        $remainingLimit = $limit - count($featuredCars);

        // Get non-featured available cars to fill the gap
        $db = getDB();
        $featuredIds = array_column($featuredCars, 'id');
        $excludeIds = !empty($featuredIds) ? ' AND id NOT IN (' . implode(',', array_fill(0, count($featuredIds), '?')) . ')' : '';

        $sql = "SELECT * FROM cars WHERE status = 'available' AND featured = 0" . $excludeIds . " ORDER BY created_at DESC LIMIT ?";
        $params = array_merge($featuredIds, [$remainingLimit]);

        $additionalCars = $db->fetchAll($sql, $params);

        // Merge the arrays
        $featuredCars = array_merge($featuredCars, $additionalCars);
    }

    return $featuredCars;
}

/**
 * Get all services with optional category filter
 */
function getServices($category = null, $featured = null) {
    $db = getDB();
    $where = ['1=1'];
    $params = [];
    
    if ($category) {
        $where[] = 'category = ?';
        $params[] = $category;
    }
    
    if ($featured !== null) {
        $where[] = 'featured = ?';
        $params[] = $featured ? 1 : 0;
    }
    
    $sql = "SELECT * FROM services WHERE " . implode(' AND ', $where) . " ORDER BY featured DESC, name ASC";
    return $db->fetchAll($sql, $params);
}

/**
 * Get featured services
 */
function getFeaturedServices($limit = 3) {
    return getServices(null, true);
}

/**
 * Get service by ID
 */
function getServiceById($id) {
    $db = getDB();
    return $db->fetch("SELECT * FROM services WHERE id = ?", [$id]);
}

/**
 * Create new inquiry
 */
function createInquiry($data) {
    $db = getDB();
    $sql = "INSERT INTO inquiries (type, name, email, phone, message, car_id, service_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    return $db->insert($sql, [
        $data['type'],
        $data['name'],
        $data['email'],
        $data['phone'] ?? null,
        $data['message'] ?? null,
        $data['car_id'] ?? null,
        $data['service_id'] ?? null
    ]);
}

/**
 * Create new quote request
 */
function createQuote($data) {
    $db = getDB();
    $sql = "INSERT INTO quotes (customer_name, email, phone, service_type, vehicle_make, 
            vehicle_model, vehicle_year, description) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    return $db->insert($sql, [
        $data['customer_name'],
        $data['email'],
        $data['phone'] ?? null,
        $data['service_type'],
        $data['vehicle_make'] ?? null,
        $data['vehicle_model'] ?? null,
        $data['vehicle_year'] ?? null,
        $data['description'] ?? null
    ]);
}

/**
 * Create new appointment
 */
function createAppointment($data) {
    $db = getDB();
    $sql = "INSERT INTO appointments (customer_name, email, phone, service_type, 
            vehicle_info, preferred_date, preferred_time, description) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    return $db->insert($sql, [
        $data['customer_name'],
        $data['email'],
        $data['phone'] ?? null,
        $data['service_type'],
        $data['vehicle_info'] ?? null,
        $data['preferred_date'],
        $data['preferred_time'],
        $data['description'] ?? null
    ]);
}

/**
 * Get content block
 */
function getContentBlock($page, $section) {
    $db = getDB();
    return $db->fetch("SELECT * FROM content_blocks WHERE page = ? AND section = ? AND active = 1", 
                     [$page, $section]);
}

/**
 * Update content block
 */
function updateContentBlock($page, $section, $title, $content, $image = null) {
    $db = getDB();
    $sql = "INSERT INTO content_blocks (page, section, title, content, image) 
            VALUES (?, ?, ?, ?, ?) 
            ON DUPLICATE KEY UPDATE title = VALUES(title), content = VALUES(content), 
            image = VALUES(image), updated_at = CURRENT_TIMESTAMP";
    
    return $db->execute($sql, [$page, $section, $title, $content, $image]);
}

/**
 * Get car makes for filter dropdown
 */
function getCarMakes() {
    $db = getDB();
    return $db->fetchAll("SELECT DISTINCT make FROM cars WHERE status = 'available' ORDER BY make");
}

/**
 * Get years range for filter
 */
function getCarYearsRange() {
    $db = getDB();
    $result = $db->fetch("SELECT MIN(year) as min_year, MAX(year) as max_year FROM cars WHERE status = 'available'");
    return $result ?: ['min_year' => date('Y') - 20, 'max_year' => date('Y')];
}

/**
 * Get price range for filter
 */
function getCarPriceRange() {
    $db = getDB();
    $result = $db->fetch("SELECT MIN(price) as min_price, MAX(price) as max_price FROM cars WHERE status = 'available'");
    return $result ?: ['min_price' => 0, 'max_price' => 100000];
}

/**
 * Increment car views
 */
function incrementCarViews($carId) {
    $db = getDB();
    return $db->execute("UPDATE cars SET views = views + 1 WHERE id = ?", [$carId]);
}

/**
 * Increment car inquiries count
 */
function incrementCarInquiries($carId) {
    $db = getDB();
    return $db->execute("UPDATE cars SET inquiries_count = inquiries_count + 1 WHERE id = ?", [$carId]);
}

/**
 * Create new car
 */
function createCar($data) {
    $db = getDB();
    $sql = "INSERT INTO cars (make, model, year, mileage, price, description, status, featured, images)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    return $db->insert($sql, [
        $data['make'],
        $data['model'],
        $data['year'],
        $data['mileage'],
        $data['price'],
        $data['description'],
        $data['status'] ?? 'available',
        $data['featured'] ?? 0,
        $data['images'] ?? null
    ]);
}

/**
 * Update car
 */
function updateCar($id, $data) {
    $db = getDB();
    $sql = "UPDATE cars SET make = ?, model = ?, year = ?, mileage = ?, price = ?,
            description = ?, status = ?, featured = ?, images = ?, updated_at = CURRENT_TIMESTAMP
            WHERE id = ?";

    return $db->execute($sql, [
        $data['make'],
        $data['model'],
        $data['year'],
        $data['mileage'],
        $data['price'],
        $data['description'],
        $data['status'] ?? 'available',
        $data['featured'] ?? 0,
        $data['images'] ?? null,
        $id
    ]);
}

/**
 * Delete car
 */
function deleteCar($id) {
    $db = getDB();

    // First get the car to delete associated images
    $car = getCarById($id);
    if ($car) {
        $images = json_decode($car['images'], true);
        if (!empty($images)) {
            foreach ($images as $image) {
                $imagePath = __DIR__ . '/../uploads/cars/' . $image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }
    }

    return $db->execute("DELETE FROM cars WHERE id = ?", [$id]);
}

/**
 * Update car featured status
 */
function updateCarFeatured($id, $featured) {
    $db = getDB();
    return $db->execute("UPDATE cars SET featured = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?", [$featured, $id]);
}

/**
 * Get dashboard statistics
 */
function getDashboardStats() {
    $db = getDB();
    
    $stats = [];
    
    // Recent inquiries count
    $stats['recent_inquiries'] = $db->fetch("SELECT COUNT(*) as count FROM inquiries WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)")['count'];
    
    // Pending quotes count
    $stats['pending_quotes'] = $db->fetch("SELECT COUNT(*) as count FROM quotes WHERE status = 'pending'")['count'];
    
    // Available cars count
    $stats['available_cars'] = $db->fetch("SELECT COUNT(*) as count FROM cars WHERE status = 'available'")['count'];
    
    // Total cars count
    $stats['total_cars'] = $db->fetch("SELECT COUNT(*) as count FROM cars")['count'];
    
    // Pending appointments
    $stats['pending_appointments'] = $db->fetch("SELECT COUNT(*) as count FROM appointments WHERE status = 'pending'")['count'];
    
    return $stats;
}

/**
 * Format date for display
 */
function formatDate($date, $format = 'M j, Y') {
    return date($format, strtotime($date));
}

/**
 * Format datetime for display
 */
function formatDateTime($datetime, $format = 'M j, Y g:i A') {
    return date($format, strtotime($datetime));
}

/**
 * Get time ago string
 */
function timeAgo($datetime) {
    $time = time() - strtotime($datetime);
    
    if ($time < 60) return 'just now';
    if ($time < 3600) return floor($time/60) . ' minutes ago';
    if ($time < 86400) return floor($time/3600) . ' hours ago';
    if ($time < 2592000) return floor($time/86400) . ' days ago';
    if ($time < 31536000) return floor($time/2592000) . ' months ago';
    
    return floor($time/31536000) . ' years ago';
}

/**
 * Generate breadcrumb navigation
 */
function generateBreadcrumb($items) {
    $breadcrumb = '<nav class="text-sm breadcrumbs">';
    $breadcrumb .= '<ol class="list-none p-0 inline-flex">';
    
    foreach ($items as $index => $item) {
        $breadcrumb .= '<li class="flex items-center">';
        
        if ($index > 0) {
            $breadcrumb .= '<svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="m285.476 272.971c4.686 4.686 4.686 12.284 0 16.971l-112 112c-4.686 4.686-12.284 4.686-16.971 0s-4.686-12.284 0-16.971l103.029-103.029-103.029-103.029c-4.686-4.686-4.686-12.284 0-16.971s12.284-4.686 16.971 0l112 112z"/></svg>';
        }
        
        if (isset($item['url']) && $index < count($items) - 1) {
            $breadcrumb .= '<a href="' . $item['url'] . '" class="text-blue-600 hover:text-blue-800">' . $item['title'] . '</a>';
        } else {
            $breadcrumb .= '<span class="text-gray-500">' . $item['title'] . '</span>';
        }
        
        $breadcrumb .= '</li>';
    }
    
    $breadcrumb .= '</ol>';
    $breadcrumb .= '</nav>';
    
    return $breadcrumb;
}

/**
 * Truncate text
 */
function truncateText($text, $length = 100, $suffix = '...') {
    if (strlen($text) <= $length) {
        return $text;
    }
    return substr($text, 0, $length) . $suffix;
}
?>
