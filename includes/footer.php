    </main>

    <!-- Footer -->
    <footer class="bg-dark-gray text-white mt-16">
        <!-- Main Footer Content -->
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                
                <!-- Business Information -->
                <div class="space-y-4">
                    <div class="flex items-center mb-4">
                        <img src="<?php echo ASSETS_URL; ?>/images/logos/adjlogo.png" alt="<?php echo BUSINESS_NAME; ?>" style="height: 50px; width: auto;">
                        <div class="ml-3">
                            <p class="text-sm text-gray-300"><?php echo APP_DESCRIPTION; ?></p>
                        </div>
                    </div>
                    
                    <div class="space-y-2 text-sm">
                        <p class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-3 text-secondary-orange"></i>
                            <?php echo BUSINESS_PHYSICAL_ADDRESS; ?>
                        </p>
                        <p class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-secondary-orange"></i>
                            <?php echo BUSINESS_MAILING_ADDRESS; ?>
                        </p>
                        <p class="flex items-center">
                            <i class="fas fa-phone mr-3 text-secondary-orange"></i>
                            <a href="tel:<?php echo str_replace(['(', ')', ' ', '-'], '', BUSINESS_PHONE); ?>" class="hover:text-secondary-orange">
                                <?php echo BUSINESS_PHONE; ?>
                            </a>
                        </p>
                        <p class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-secondary-orange"></i>
                            <a href="mailto:<?php echo BUSINESS_EMAIL; ?>" class="hover:text-secondary-orange">
                                <?php echo BUSINESS_EMAIL; ?>
                            </a>
                        </p>
                    </div>
                    
                    <!-- Veteran Badge -->
                    <div class="bg-accent-red px-3 py-2 rounded inline-block">
                        <span class="text-sm font-semibold"><?php echo BUSINESS_STATUS; ?></span>
                    </div>
                </div>

                <!-- Services -->
                <div>
                    <h3 class="text-lg font-bold mb-4 text-secondary-orange">Our Services</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="<?php echo BASE_URL; ?>/public/services/transmission.php" class="hover:text-secondary-orange transition-colors">Transmission Rebuilding</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/public/services/engine-repair.php" class="hover:text-secondary-orange transition-colors">Engine Repair & Rebuilding</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/public/services/diagnostics.php" class="hover:text-secondary-orange transition-colors">Advanced Diagnostics</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/public/services/other-services.php" class="hover:text-secondary-orange transition-colors">Brake Services</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/public/services/other-services.php" class="hover:text-secondary-orange transition-colors">Electrical Systems</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/public/services/other-services.php" class="hover:text-secondary-orange transition-colors">HVAC Services</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/public/services/other-services.php" class="hover:text-secondary-orange transition-colors">Key Programming</a></li>
                        <li><a href="<?php echo BASE_URL; ?>/public/cars/" class="hover:text-secondary-orange transition-colors">Used Cars for Sale</a></li>
                    </ul>
                </div>

                <!-- Business Hours -->
                <div>
                    <h3 class="text-lg font-bold mb-4 text-secondary-orange">Business Hours</h3>
                    <ul class="space-y-2 text-sm">
                        <?php foreach (BUSINESS_HOURS as $day => $hours): ?>
                        <li class="flex justify-between">
                            <span><?php echo $day; ?>:</span>
                            <span class="<?php echo $hours === 'Closed' ? 'text-gray-400' : 'text-white'; ?>">
                                <?php echo $hours; ?>
                            </span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    
                    <!-- Emergency Contact -->
                    <div class="mt-4 p-3 bg-accent-red rounded">
                        <p class="text-sm font-semibold">Emergency Repairs</p>
                        <p class="text-xs">Call for urgent fleet services</p>
                    </div>
                </div>

                <!-- Certifications & Quick Links -->
                <div>
                    <h3 class="text-lg font-bold mb-4 text-secondary-orange">Certifications</h3>

                    <!-- Certification Logos -->
                    <div class="flex flex-wrap gap-3 mb-4">
                        <div class="bg-white p-2 rounded-lg shadow-sm logo-bg-fixed">
                            <img src="<?php echo ASSETS_URL; ?>/images/logos/ase-logo.png"
                                 alt="ASE Certified"
                                 class="h-12 w-auto object-contain">
                        </div>
                        <div class="bg-white p-2 rounded-lg shadow-sm logo-bg-fixed">
                            <img src="<?php echo ASSETS_URL; ?>/images/logos/vosb-logo.png"
                                 alt="Veteran Owned Small Business"
                                 class="h-12 w-auto object-contain">
                        </div>
                    </div>

                    <div class="space-y-2 text-sm">
                        <p class="font-semibold text-success-green">ASE Master Certified</p>
                        <ul class="text-xs space-y-1 text-gray-300">
                            <li>• Master Automotive Technician</li>
                            <li>• Medium/Heavy Truck</li>
                            <li>• Transmission/Transaxle</li>
                            <li>• Engine Repair</li>
                            <li>• Electrical Systems</li>
                        </ul>

                        <p class="font-semibold text-success-green mt-3">Manufacturer Certified</p>
                        <ul class="text-xs space-y-1 text-gray-300">
                            <li>• Ford Master Technician</li>
                            <li>• Toyota Master Technician</li>
                            <li>• Lexus Master Technician</li>
                            <li>• GM Powertrain Specialist</li>
                        </ul>
                    </div>

                    <!-- Quick Actions -->
                    <div class="mt-4 space-y-2">
                    </div>
                </div>
            </div>
        </div>

        <!-- Promotional Items Banner -->

        <!-- Bottom Footer -->
        <div class="bg-gray-900 py-6">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-sm text-gray-400 mb-4 md:mb-0">
                        <p>&copy; <?php echo date('Y'); ?> <?php echo BUSINESS_NAME; ?>. All rights reserved.</p>
                        <p class="text-xs mt-1">
                            UEI ID: <?php echo BUSINESS_UEI_ID; ?> | CAGE Code: <?php echo BUSINESS_CAGE_CODE; ?> | 
                            <?php echo BUSINESS_EXPERIENCE; ?> of Experience
                        </p>
                    </div>
                    
                    <div class="flex items-center space-x-6">
                        <!-- Social Media Links -->
                        <div class="flex space-x-4">
                            <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank" class="text-gray-400 hover:text-success-green transition-colors" title="WhatsApp">
                                <i class="fab fa-whatsapp text-xl"></i>
                            </a>
                            <a href="<?php echo INSTAGRAM_LINK; ?>" target="_blank" class="text-gray-400 hover:text-secondary-orange transition-colors" title="Instagram">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                        </div>
                        
                        <!-- Quick Links -->
                        <div class="text-xs text-gray-400 space-x-4 hidden md:flex">
                            <a href="<?php echo BASE_URL; ?>/public/contact.php" class="hover:text-white">Contact</a>
                            <a href="<?php echo BASE_URL; ?>/public/about.php" class="hover:text-white">About</a>
                            <a href="<?php echo BASE_URL; ?>/admin/" class="hover:text-white">Admin</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank" class="whatsapp-button">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    <!-- JavaScript -->
    <script src="<?php echo ASSETS_URL; ?>/js/main.js"></script>

    <!-- Additional JavaScript -->
    <?php if (isset($additionalJS)) echo $additionalJS; ?>

    <script>
        // Auto-hide flash messages
        setTimeout(function() {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                flashMessage.style.display = 'none';
            }
        }, 5000);
    </script>
</body>
</html>


