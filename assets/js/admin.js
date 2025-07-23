/**
 * ADJ Automotive Repair Services - Admin JavaScript
 * JavaScript functionality for admin panel
 */

// Admin Panel Initialization
document.addEventListener('DOMContentLoaded', function() {
    initializeAdminPanel();
});

/**
 * Initialize admin panel functionality
 */
function initializeAdminPanel() {
    // Initialize sidebar toggle for mobile
    initializeSidebarToggle();
    
    // Initialize data tables
    initializeDataTables();
    
    // Initialize form enhancements
    initializeFormEnhancements();
    
    // Initialize image upload
    initializeImageUpload();
    
    // Initialize confirmation dialogs
    initializeConfirmationDialogs();
    
    // Initialize auto-save
    initializeAutoSave();
    
    console.log('Admin panel initialized');
}

/**
 * Sidebar toggle for mobile
 */
function initializeSidebarToggle() {
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('hidden');
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth < 768) {
                if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                    sidebar.classList.add('hidden');
                }
            }
        });
    }
}

/**
 * Enhanced data tables
 */
function initializeDataTables() {
    const tables = document.querySelectorAll('table.data-table');
    
    tables.forEach(table => {
        // Add search functionality
        const searchInput = document.querySelector(`[data-search="${table.id}"]`);
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                filterTable(table, this.value);
            });
        }
        
        // Add sorting functionality
        const headers = table.querySelectorAll('th[data-sort]');
        headers.forEach((header, index) => {
            header.style.cursor = 'pointer';
            header.addEventListener('click', function() {
                sortTable(table, index, this);
            });
        });
        
        // Add row selection
        const checkboxes = table.querySelectorAll('input[type="checkbox"]');
        const selectAll = table.querySelector('th input[type="checkbox"]');
        
        if (selectAll) {
            selectAll.addEventListener('change', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateBulkActions();
            });
        }
        
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateBulkActions);
        });
    });
}

/**
 * Filter table rows based on search term
 */
function filterTable(table, searchTerm) {
    const rows = table.querySelectorAll('tbody tr');
    const term = searchTerm.toLowerCase();
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(term)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

/**
 * Sort table by column
 */
function sortTable(table, columnIndex, header) {
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    const currentDirection = header.getAttribute('data-direction') || 'asc';
    const newDirection = currentDirection === 'asc' ? 'desc' : 'asc';
    
    // Clear all sort indicators
    table.querySelectorAll('th[data-sort]').forEach(th => {
        th.removeAttribute('data-direction');
        const icon = th.querySelector('.sort-icon');
        if (icon) icon.remove();
    });
    
    // Set new sort direction
    header.setAttribute('data-direction', newDirection);
    const icon = document.createElement('i');
    icon.className = `fas fa-sort-${newDirection === 'asc' ? 'up' : 'down'} ml-2 sort-icon`;
    header.appendChild(icon);
    
    // Sort rows
    rows.sort((a, b) => {
        const aVal = a.cells[columnIndex].textContent.trim();
        const bVal = b.cells[columnIndex].textContent.trim();
        
        // Try to parse as numbers
        const aNum = parseFloat(aVal.replace(/[^0-9.-]/g, ''));
        const bNum = parseFloat(bVal.replace(/[^0-9.-]/g, ''));
        
        if (!isNaN(aNum) && !isNaN(bNum)) {
            return newDirection === 'asc' ? aNum - bNum : bNum - aNum;
        }
        
        // String comparison
        return newDirection === 'asc' ? aVal.localeCompare(bVal) : bVal.localeCompare(aVal);
    });
    
    // Re-append sorted rows
    rows.forEach(row => tbody.appendChild(row));
}

/**
 * Update bulk actions based on selected rows
 */
function updateBulkActions() {
    const selectedRows = document.querySelectorAll('tbody input[type="checkbox"]:checked');
    const bulkActions = document.querySelector('.bulk-actions');
    
    if (bulkActions) {
        if (selectedRows.length > 0) {
            bulkActions.classList.remove('hidden');
            bulkActions.querySelector('.selected-count').textContent = selectedRows.length;
        } else {
            bulkActions.classList.add('hidden');
        }
    }
}

/**
 * Form enhancements
 */
function initializeFormEnhancements() {
    // Auto-resize textareas
    const textareas = document.querySelectorAll('textarea[data-autoresize]');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
        
        // Initial resize
        textarea.style.height = textarea.scrollHeight + 'px';
    });
    
    // Character counters
    const fieldsWithCounters = document.querySelectorAll('[data-maxlength]');
    fieldsWithCounters.forEach(field => {
        const maxLength = parseInt(field.getAttribute('data-maxlength'));
        const counter = document.createElement('div');
        counter.className = 'text-sm text-gray-500 mt-1';
        field.parentNode.appendChild(counter);
        
        function updateCounter() {
            const remaining = maxLength - field.value.length;
            counter.textContent = `${remaining} characters remaining`;
            counter.className = remaining < 0 ? 'text-sm text-red-500 mt-1' : 'text-sm text-gray-500 mt-1';
        }
        
        field.addEventListener('input', updateCounter);
        updateCounter();
    });
    
    // Form validation enhancement
    const forms = document.querySelectorAll('form[data-validate]');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!validateForm(form)) {
                e.preventDefault();
            }
        });
        
        // Real-time validation
        const inputs = form.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(input);
            });
        });
    });
}

/**
 * Validate form
 */
function validateForm(form) {
    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!validateField(field)) {
            isValid = false;
        }
    });
    
    return isValid;
}

/**
 * Validate individual field
 */
function validateField(field) {
    const value = field.value.trim();
    const type = field.type;
    const required = field.hasAttribute('required');
    let isValid = true;
    let errorMessage = '';
    
    // Clear previous errors
    clearFieldError(field);
    
    // Required field validation
    if (required && !value) {
        isValid = false;
        errorMessage = 'This field is required';
    }
    
    // Email validation
    else if (type === 'email' && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid email address';
        }
    }
    
    // Number validation
    else if (type === 'number' && value) {
        const min = field.getAttribute('min');
        const max = field.getAttribute('max');
        const numValue = parseFloat(value);
        
        if (isNaN(numValue)) {
            isValid = false;
            errorMessage = 'Please enter a valid number';
        } else if (min !== null && numValue < parseFloat(min)) {
            isValid = false;
            errorMessage = `Value must be at least ${min}`;
        } else if (max !== null && numValue > parseFloat(max)) {
            isValid = false;
            errorMessage = `Value must be no more than ${max}`;
        }
    }
    
    // Show error if validation failed
    if (!isValid) {
        showFieldError(field, errorMessage);
    }
    
    return isValid;
}

/**
 * Show field error
 */
function showFieldError(field, message) {
    field.classList.add('border-red-500');
    
    let errorElement = field.parentNode.querySelector('.field-error');
    if (!errorElement) {
        errorElement = document.createElement('div');
        errorElement.className = 'field-error text-red-500 text-sm mt-1';
        field.parentNode.appendChild(errorElement);
    }
    
    errorElement.textContent = message;
}

/**
 * Clear field error
 */
function clearFieldError(field) {
    field.classList.remove('border-red-500');
    
    const errorElement = field.parentNode.querySelector('.field-error');
    if (errorElement) {
        errorElement.remove();
    }
}

/**
 * Image upload functionality
 */
function initializeImageUpload() {
    const imageInputs = document.querySelectorAll('input[type="file"][accept*="image"]:not(.custom-preview)');

    imageInputs.forEach(input => {
        input.addEventListener('change', function() {
            previewImages(this);
        });
        
        // Drag and drop
        const dropZone = input.closest('.drop-zone');
        if (dropZone) {
            dropZone.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('drag-over');
            });
            
            dropZone.addEventListener('dragleave', function(e) {
                e.preventDefault();
                this.classList.remove('drag-over');
            });
            
            dropZone.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('drag-over');
                
                const files = e.dataTransfer.files;
                input.files = files;
                previewImages(input);
            });
        }
    });
}

/**
 * Preview uploaded images
 */
function previewImages(input) {
    const previewContainer = document.getElementById('image-preview') || 
                           input.parentNode.querySelector('.image-preview');
    
    if (!previewContainer) return;
    
    previewContainer.innerHTML = '';
    
    if (input.files && input.files.length > 0) {
        previewContainer.classList.remove('hidden');
        
        Array.from(input.files).forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative group';
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg">
                        <div class="absolute top-2 right-2 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                            ${index + 1}
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                            <button type="button" onclick="removeImage(this, ${index})" class="text-white hover:text-red-300">
                                <i class="fas fa-trash text-lg"></i>
                            </button>
                        </div>
                    `;
                    previewContainer.appendChild(div);
                };
                reader.readAsDataURL(file);
            }
        });
    } else {
        previewContainer.classList.add('hidden');
    }
}

/**
 * Remove image from preview
 */
function removeImage(button, index) {
    const input = document.querySelector('input[type="file"][accept*="image"]');
    const dt = new DataTransfer();
    
    Array.from(input.files).forEach((file, i) => {
        if (i !== index) {
            dt.items.add(file);
        }
    });
    
    input.files = dt.files;
    previewImages(input);
}

/**
 * Confirmation dialogs
 */
function initializeConfirmationDialogs() {
    // Delete confirmations
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-btn') || e.target.closest('.delete-btn')) {
            if (!confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
                e.preventDefault();
                return false;
            }
        }
    });
    
    // Bulk action confirmations
    document.addEventListener('submit', function(e) {
        if (e.target.classList.contains('bulk-action-form')) {
            const selectedCount = document.querySelectorAll('tbody input[type="checkbox"]:checked').length;
            const action = e.target.querySelector('select[name="action"]').value;
            
            if (selectedCount === 0) {
                e.preventDefault();
                alert('Please select at least one item.');
                return false;
            }
            
            if (action === 'delete') {
                if (!confirm(`Are you sure you want to delete ${selectedCount} item(s)? This action cannot be undone.`)) {
                    e.preventDefault();
                    return false;
                }
            }
        }
    });
}

/**
 * Auto-save functionality
 */
function initializeAutoSave() {
    const forms = document.querySelectorAll('form[data-autosave]');
    
    forms.forEach(form => {
        const formId = form.getAttribute('data-autosave');
        
        // Load saved data
        loadFormData(form, formId);
        
        // Save data on input
        form.addEventListener('input', debounce(function() {
            saveFormData(form, formId);
        }, 1000));
        
        // Clear saved data on successful submit
        form.addEventListener('submit', function() {
            setTimeout(() => {
                clearFormData(formId);
            }, 1000);
        });
    });
}

/**
 * Save form data to localStorage
 */
function saveFormData(form, formId) {
    const formData = new FormData(form);
    const data = {};
    
    for (let [key, value] of formData.entries()) {
        if (key !== 'csrf_token' && !key.includes('password')) {
            data[key] = value;
        }
    }
    
    localStorage.setItem('admin_form_' + formId, JSON.stringify(data));
    
    // Show auto-save indicator
    showAutoSaveIndicator();
}

/**
 * Load form data from localStorage
 */
function loadFormData(form, formId) {
    const savedData = localStorage.getItem('admin_form_' + formId);
    
    if (savedData) {
        try {
            const data = JSON.parse(savedData);
            Object.keys(data).forEach(key => {
                const field = form.querySelector(`[name="${key}"]`);
                if (field && field.type !== 'password' && field.type !== 'file') {
                    if (field.type === 'checkbox') {
                        field.checked = data[key] === 'on' || data[key] === '1';
                    } else {
                        field.value = data[key];
                    }
                }
            });
        } catch (e) {
            console.error('Error loading saved form data:', e);
        }
    }
}

/**
 * Clear form data from localStorage
 */
function clearFormData(formId) {
    localStorage.removeItem('admin_form_' + formId);
}

/**
 * Show auto-save indicator
 */
function showAutoSaveIndicator() {
    let indicator = document.getElementById('autosave-indicator');
    
    if (!indicator) {
        indicator = document.createElement('div');
        indicator.id = 'autosave-indicator';
        indicator.className = 'fixed bottom-4 left-4 bg-green-500 text-white px-3 py-2 rounded-lg text-sm z-50';
        indicator.innerHTML = '<i class="fas fa-save mr-2"></i>Auto-saved';
        document.body.appendChild(indicator);
    }
    
    indicator.style.display = 'block';
    
    setTimeout(() => {
        indicator.style.display = 'none';
    }, 2000);
}

/**
 * Debounce function
 */
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

/**
 * Utility functions
 */

// Format currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD'
    }).format(amount);
}

// Format number
function formatNumber(number) {
    return new Intl.NumberFormat('en-US').format(number);
}

// Show loading spinner
function showLoading(element) {
    const spinner = document.createElement('div');
    spinner.className = 'spinner mx-auto';
    element.innerHTML = '';
    element.appendChild(spinner);
}

// Hide loading spinner
function hideLoading(element, content) {
    element.innerHTML = content;
}
