<?php
/**
 * ADJ Automotive Repair Services - Add Car
 * Admin page for adding new cars to inventory
 */

// Include configuration and functions
require_once '../../config/config.php';
require_once '../../includes/functions.php';

// Check admin authentication
requireAdmin();

// Handle form submission
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
        $errors[] = 'Security token mismatch. Please try again.';
    } else {
        // Validate form data
        $make = sanitizeInput($_POST['make'] ?? '');
        $model = sanitizeInput($_POST['model'] ?? '');
        $year = (int)($_POST['year'] ?? 0);
        $mileage = (int)($_POST['mileage'] ?? 0);
        $price = (float)($_POST['price'] ?? 0);
        $description = sanitizeInput($_POST['description'] ?? '');
        $status = sanitizeInput($_POST['status'] ?? 'available');
        $featured = isset($_POST['featured']) ? 1 : 0;
        
        // Validation
        if (empty($make)) {
            $errors[] = 'Make is required.';
        }
        if (empty($model)) {
            $errors[] = 'Model is required.';
        }
        if ($year < 1900 || $year > date('Y') + 1) {
            $errors[] = 'Please enter a valid year.';
        }
        if ($mileage < 0) {
            $errors[] = 'Mileage must be a positive number.';
        }
        if ($price <= 0) {
            $errors[] = 'Price must be greater than zero.';
        }
        if (empty($description)) {
            $errors[] = 'Description is required.';
        }
        
        // Handle image uploads
        $uploadedImages = [];
        if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            $uploadDir = '../../uploads/cars/';

            // Create directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            foreach ($_FILES['images']['name'] as $key => $filename) {
                if (!empty($filename)) {
                    $tmpName = $_FILES['images']['tmp_name'][$key];
                    $fileSize = $_FILES['images']['size'][$key];
                    $fileError = $_FILES['images']['error'][$key];
                    
                    // Validate file
                    if ($fileError === UPLOAD_ERR_OK) {
                        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                        $fileType = mime_content_type($tmpName);
                        
                        if (in_array($fileType, $allowedTypes)) {
                            if ($fileSize <= 5 * 1024 * 1024) { // 5MB limit
                                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                                $newFilename = uniqid() . '_' . time() . '.' . $extension;
                                $uploadPath = $uploadDir . $newFilename;
                                
                                if (move_uploaded_file($tmpName, $uploadPath)) {
                                    $uploadedImages[] = $newFilename;
                                } else {
                                    $errors[] = "Failed to upload image: $filename";
                                }
                            } else {
                                $errors[] = "Image $filename is too large (max 5MB).";
                            }
                        } else {
                            $errors[] = "Invalid file type for $filename. Only JPG, PNG, and GIF allowed.";
                        }
                    } else {
                        $errors[] = "Upload error for $filename.";
                    }
                }
            }
        }
        
        // If no errors, save car
        if (empty($errors)) {
            try {
                $carData = [
                    'make' => $make,
                    'model' => $model,
                    'year' => $year,
                    'mileage' => $mileage,
                    'price' => $price,
                    'description' => $description,
                    'status' => $status,
                    'featured' => $featured,
                    'images' => json_encode($uploadedImages)
                ];
                
                $carId = createCar($carData);
                
                if ($carId) {
                    logAdminActivity('Car Added', "Added car: $year $make $model");
                    $_SESSION['flash_message'] = 'Car added successfully!';
                    $_SESSION['flash_type'] = 'success';
                    header('Location: manage.php');
                    exit;
                } else {
                    $errors[] = 'Failed to save car. Please try again.';
                }
            } catch (Exception $e) {
                error_log('Car creation error: ' . $e->getMessage());
                $errors[] = 'An error occurred. Please try again later.';
            }
        }
    }
}

// Page variables
$pageTitle = 'Add New Car';

// Include admin header
include '../includes/admin-header.php';
?>

<div class="page-header-container">
    <h1 class="page-header-title">Add New Car</h1>
    <p class="page-header-subtitle">Add a new vehicle to your inventory</p>
    <a href="manage.php" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>
        <span>Back to Cars</span>
    </a>
</div>

<?php if (!empty($errors)): ?>
<div class="alert alert-danger">
    <ul class="alert-list">
        <?php foreach ($errors as $error): ?>
        <li><?php echo htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" class="form-container" data-validate data-autosave="add-car">
    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">

    <div class="form-grid">
        <div class="form-section">
            <h2 class="form-section-title">Vehicle Information</h2>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="make" class="form-label">Make *</label>
                    <input type="text" id="make" name="make" required class="form-input"
                           value="<?php echo htmlspecialchars($_POST['make'] ?? ''); ?>"
                           placeholder="e.g., Toyota, Ford, Honda">
                </div>
                <div class="form-group">
                    <label for="model" class="form-label">Model *</label>
                    <input type="text" id="model" name="model" required class="form-input"
                           value="<?php echo htmlspecialchars($_POST['model'] ?? ''); ?>"
                           placeholder="e.g., Camry, F-150, Civic">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="year" class="form-label">Year *</label>
                    <select id="year" name="year" required class="form-select">
                        <option value="">Select year...</option>
                        <?php for ($y = date('Y') + 1; $y >= 1990; $y--): ?>
                        <option value="<?php echo $y; ?>" <?php echo (($_POST['year'] ?? 0) == $y) ? 'selected' : ''; ?>>
                            <?php echo $y; ?>
                        </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="mileage" class="form-label">Mileage *</label>
                    <input type="number" id="mileage" name="mileage" required class="form-input"
                           value="<?php echo htmlspecialchars($_POST['mileage'] ?? ''); ?>"
                           placeholder="e.g., 50000" min="0">
                </div>
            </div>

            <div class="form-group">
                <label for="price" class="form-label">Price *</label>
                <div class="form-input-group">
                    <span class="form-input-adornment">$</span>
                    <input type="number" id="price" name="price" required class="form-input"
                           value="<?php echo htmlspecialchars($_POST['price'] ?? ''); ?>"
                           placeholder="e.g., 15000" min="0" step="0.01">
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description *</label>
                <textarea id="description" name="description" required class="form-textarea" rows="6"
                          placeholder="Describe the vehicle's condition, features, history, etc."
                          data-autoresize><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
            </div>
        </div>

        <div class="form-section">
            <h2 class="form-section-title">Status & Images</h2>

            <div class="form-group">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select">
                    <option value="available" <?php echo (($_POST['status'] ?? 'available') === 'available') ? 'selected' : ''; ?>>Available</option>
                    <option value="pending" <?php echo (($_POST['status'] ?? '') === 'pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="sold" <?php echo (($_POST['status'] ?? '') === 'sold') ? 'selected' : ''; ?>>Sold</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-checkbox-label">
                    <input type="checkbox" name="featured" value="1"
                           <?php echo isset($_POST['featured']) ? 'checked' : ''; ?>
                           class="form-checkbox">
                    <span>Featured Car</span>
                </label>
                <p class="form-help-text">Featured cars appear prominently on the homepage</p>
            </div>

            <div class="form-group">
                <label for="images" class="form-label">Car Images</label>
                <div class="file-upload-container">
                    <label for="images" class="file-upload-label">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>
                            <span class="file-upload-link">Upload images</span> or drag and drop
                        </span>
                        <span class="file-upload-info">PNG, JPG, GIF up to 5MB each</span>
                    </label>
                    <input id="images" name="images[]" type="file" class="file-upload-input custom-preview" multiple accept="image/*">
                </div>
                <div id="image-preview" class="image-preview-grid"></div>
            </div>
        </div>
    </div>

    <div class="form-footer">
        <a href="manage.php" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i>
            <span>Add Car</span>
        </button>
    </div>
</form>

<!-- JavaScript for image preview -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('images');
    const previewGrid = document.getElementById('image-preview');
    let fileList = [];

    imageInput.addEventListener('change', handleFileSelect);

    function handleFileSelect(event) {
        const newFiles = Array.from(event.target.files);
        
        // Add new files to our list, avoiding duplicates
        newFiles.forEach(file => {
            if (!fileList.some(existingFile => existingFile.name === file.name && existingFile.size === file.size)) {
                fileList.push(file);
            }
        });
        
        updateFileInput();
        renderPreview();
    }

    function renderPreview() {
        previewGrid.innerHTML = '';
        if (fileList.length > 0) {
            previewGrid.style.display = 'grid';
        } else {
            previewGrid.style.display = 'none';
        }

        fileList.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewItem = document.createElement('div');
                previewItem.className = 'image-preview-item';
                previewItem.innerHTML = `
                    <img src="${e.target.result}" alt="${file.name}">
                    <button type="button" class="remove-image" data-index="${index}" title="Remove image">&times;</button>
                `;
                previewGrid.appendChild(previewItem);
            };
            reader.readAsDataURL(file);
        });
    }

    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        fileList.forEach(file => {
            dataTransfer.items.add(file);
        });
        imageInput.files = dataTransfer.files;
    }

    previewGrid.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-image')) {
            const indexToRemove = parseInt(event.target.dataset.index, 10);
            fileList.splice(indexToRemove, 1);
            updateFileInput();
            renderPreview();
        }
    });
});
</script>

<?php include '../includes/admin-footer.php'; ?>
