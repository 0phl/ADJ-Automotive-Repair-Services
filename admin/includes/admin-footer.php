            </div> <!-- End page content -->
        </div> <!-- End admin-main-content -->
    </div> <!-- End admin-container -->

    <!-- Admin JavaScript -->
    <script src="<?php echo ASSETS_URL; ?>/js/admin.js"></script>
    
    <!-- Additional JavaScript -->
    <?php if (isset($additionalJS)) echo $additionalJS; ?>

    <!-- Common Admin Scripts -->
    <script>
        // Auto-refresh dashboard stats every 5 minutes
        if (window.location.pathname.includes('dashboard.php')) {
            setInterval(function() {
                // Refresh page to update stats
                window.location.reload();
            }, 300000); // 5 minutes
        }
        
        // Confirm delete actions
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('delete-btn') || e.target.closest('.delete-btn')) {
                if (!confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
                    e.preventDefault();
                    return false;
                }
            }
        });
        
        // Auto-save form data to localStorage
        const forms = document.querySelectorAll('form[data-autosave]');
        forms.forEach(form => {
            const formId = form.getAttribute('data-autosave');
            
            // Load saved data
            const savedData = localStorage.getItem('form_' + formId);
            if (savedData) {
                try {
                    const data = JSON.parse(savedData);
                    Object.keys(data).forEach(key => {
                        const field = form.querySelector(`[name="${key}"]`);
                        if (field && field.type !== 'password') {
                            field.value = data[key];
                        }
                    });
                } catch (e) {
                    console.error('Error loading saved form data:', e);
                }
            }
            
            // Save data on input
            form.addEventListener('input', function() {
                const formData = new FormData(form);
                const data = {};
                for (let [key, value] of formData.entries()) {
                    if (key !== 'csrf_token' && !key.includes('password')) {
                        data[key] = value;
                    }
                }
                localStorage.setItem('form_' + formId, JSON.stringify(data));
            });
            
            // Clear saved data on successful submit
            form.addEventListener('submit', function() {
                setTimeout(() => {
                    localStorage.removeItem('form_' + formId);
                }, 1000);
            });
        });
        
        // Image preview functionality
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById(previewId);
                    if (preview) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        // Notification system
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm ${getNotificationClasses(type)}`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <span class="flex-1">${message}</span>
                    <button class="ml-4 text-white hover:text-gray-200" onclick="this.parentElement.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Auto-remove after 5 seconds
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 5000);
        }
        
        function getNotificationClasses(type) {
            const classes = {
                'success': 'bg-green-500 text-white',
                'error': 'bg-red-500 text-white',
                'warning': 'bg-yellow-500 text-white',
                'info': 'bg-blue-500 text-white'
            };
            return classes[type] || classes.info;
        }
        
        // Table sorting functionality
        function sortTable(table, column, direction = 'asc') {
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            
            rows.sort((a, b) => {
                const aVal = a.cells[column].textContent.trim();
                const bVal = b.cells[column].textContent.trim();
                
                // Try to parse as numbers
                const aNum = parseFloat(aVal.replace(/[^0-9.-]/g, ''));
                const bNum = parseFloat(bVal.replace(/[^0-9.-]/g, ''));
                
                if (!isNaN(aNum) && !isNaN(bNum)) {
                    return direction === 'asc' ? aNum - bNum : bNum - aNum;
                }
                
                // String comparison
                return direction === 'asc' ? aVal.localeCompare(bVal) : bVal.localeCompare(aVal);
            });
            
            // Re-append sorted rows
            rows.forEach(row => tbody.appendChild(row));
        }
        
        // Initialize sortable tables
        document.querySelectorAll('table.sortable').forEach(table => {
            const headers = table.querySelectorAll('th[data-sort]');
            headers.forEach((header, index) => {
                header.style.cursor = 'pointer';
                header.addEventListener('click', function() {
                    const currentDirection = this.getAttribute('data-direction') || 'asc';
                    const newDirection = currentDirection === 'asc' ? 'desc' : 'asc';
                    
                    // Reset all headers
                    headers.forEach(h => {
                        h.removeAttribute('data-direction');
                        h.querySelector('.sort-icon')?.remove();
                    });
                    
                    // Set current header
                    this.setAttribute('data-direction', newDirection);
                    const icon = document.createElement('i');
                    icon.className = `fas fa-sort-${newDirection === 'asc' ? 'up' : 'down'} ml-2 sort-icon`;
                    this.appendChild(icon);
                    
                    sortTable(table, index, newDirection);
                });
            });
        });
        
        // Form validation enhancement
        document.querySelectorAll('form[data-validate]').forEach(form => {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('border-red-500');
                        isValid = false;
                    } else {
                        field.classList.remove('border-red-500');
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    showNotification('Please fill in all required fields.', 'error');
                }
            });
        });
        
        // Auto-resize textareas
        document.querySelectorAll('textarea[data-autoresize]').forEach(textarea => {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });
            
            // Initial resize
            textarea.style.height = textarea.scrollHeight + 'px';
        });
        
        // Search functionality
        function initializeSearch(searchInput, targetTable) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = targetTable.querySelectorAll('tbody tr');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
        
        // Initialize search for tables with search inputs
        document.querySelectorAll('[data-search-target]').forEach(searchInput => {
            const targetId = searchInput.getAttribute('data-search-target');
            const targetTable = document.getElementById(targetId);
            if (targetTable) {
                initializeSearch(searchInput, targetTable);
            }
        });
    </script>
</body>
</html>
