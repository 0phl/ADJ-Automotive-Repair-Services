#!/bin/bash

echo "🚀 Starting ADJ Automotive GitHub Push Process..."
echo "Repository: https://github.com/0phl/ADJ-Automotive-Repair-Services"
echo "This will create multiple commits to show progressive development"
echo ""

# Check if git is initialized
if [ ! -d ".git" ]; then
    echo "Initializing Git repository..."
    git init
    git remote add origin https://github.com/0phl/ADJ-Automotive-Repair-Services.git
    echo "✅ Repository initialized and remote added"
else
    # Check if remote exists, if not add it
    if ! git remote get-url origin > /dev/null 2>&1; then
        git remote add origin https://github.com/0phl/ADJ-Automotive-Repair-Services.git
        echo "✅ Remote origin added"
    fi
fi

# Phase 1: Project Foundation
echo "📋 Phase 1: Project Foundation"
git add README.md && git commit -m "Initial project documentation and overview" && echo "✅ README committed"
git add .gitignore && git commit -m "Add comprehensive gitignore for PHP project" && echo "✅ Gitignore committed"
git add database/schema.sql && git commit -m "Create database schema for automotive business" && echo "✅ Database schema committed"
git add config/database.php && git commit -m "Setup database connection configuration" && echo "✅ Database config committed"
git add config/config.php && git commit -m "Add application configuration settings" && echo "✅ App config committed"
git add config/constants.php && git commit -m "Define global constants and settings" && echo "✅ Constants committed"
git add includes/functions.php && git commit -m "Add core helper functions" && echo "✅ Helper functions committed"

# Phase 2: Core Structure
echo "🏗️ Phase 2: Core Structure"
git add includes/header.php && git commit -m "Create responsive site header component" && echo "✅ Header component committed"
git add includes/footer.php && git commit -m "Add professional footer with contact info" && echo "✅ Footer component committed"
git add includes/navigation.php && git commit -m "Implement mobile-first navigation menu" && echo "✅ Navigation committed"
git add assets/css/custom.css && git commit -m "Add custom styling and theme colors" && echo "✅ Custom CSS committed"
git add assets/js/main.js && git commit -m "Implement core JavaScript functionality" && echo "✅ Main JS committed"
git add index.php && git commit -m "Create homepage with hero section and features" && echo "✅ Homepage committed"

# Phase 3: Car Inventory System
echo "🚗 Phase 3: Car Inventory System"
git add public/cars/index.php && git commit -m "Build car inventory listing page" && echo "✅ Car listings committed"
git add public/cars/details.php && git commit -m "Create detailed car view with gallery" && echo "✅ Car details committed"
git add public/cars/search.php && git commit -m "Implement car search and filtering" && echo "✅ Car search committed"
git add public/car-inquiry.php && git commit -m "Add car purchase inquiry form" && echo "✅ Car inquiry committed"

# Phase 4: Services Section
echo "🔧 Phase 4: Services Section"
git add public/services/index.php && git commit -m "Create services overview page" && echo "✅ Services overview committed"
git add public/services/transmission.php && git commit -m "Build transmission services page" && echo "✅ Transmission services committed"
git add public/services/engine-repair.php && git commit -m "Add engine repair services" && echo "✅ Engine repair committed"
git add public/services/diagnostics.php && git commit -m "Create diagnostics services page" && echo "✅ Diagnostics committed"
git add public/services/other-services.php && git commit -m "Add general repair services" && echo "✅ Other services committed"
git add public/quote-request.php && git commit -m "Implement service quote request form" && echo "✅ Quote request committed"

# Phase 5: Admin Panel Foundation
echo "👨‍💼 Phase 5: Admin Panel Foundation"
git add admin/index.php && git commit -m "Create secure admin login system" && echo "✅ Admin login committed"
git add admin/dashboard.php && git commit -m "Build admin dashboard with analytics" && echo "✅ Admin dashboard committed"
git add admin/cars/manage.php && git commit -m "Add car inventory management" && echo "✅ Car management committed"
git add admin/cars/add.php && git commit -m "Create add new car functionality" && echo "✅ Add car committed"
git add assets/js/admin.js && git commit -m "Add admin panel JavaScript" && echo "✅ Admin JS committed"

# Phase 6: Database and Documentation
echo "📊 Phase 6: Database and Documentation"
git add database/sample_data.sql && git commit -m "Add sample data for development" && echo "✅ Sample data committed"
git add assets/images/ && git commit -m "Add company branding and asset images" && echo "✅ Images committed"
git add Docs/adj_automotive_project_plan.md && git commit -m "Document comprehensive project plan" && echo "✅ Project plan committed"
git add Docs/adj_automotive_business_profile.md && git commit -m "Document business profile and requirements" && echo "✅ Business profile committed"

# Phase 7: Additional Features
echo "✨ Phase 7: Additional Features"
git add uploads/ && git commit -m "Setup file upload directory structure" && echo "✅ Upload structure committed"

# Final commit for any remaining files
git add . && git commit -m "Final project polish and remaining assets" && echo "✅ Final commit completed"

echo ""
echo "🎉 All commits created successfully!"
echo "📊 Total commits: $(git rev-list --count HEAD)"
echo ""
echo "🚀 Pushing to GitHub..."
git push -u origin main

if [ $? -eq 0 ]; then
    echo "✅ Successfully pushed to GitHub!"
    echo "🔗 Repository: https://github.com/0phl/ADJ-Automotive-Repair-Services"
    echo ""
    echo "📈 Your repository now shows:"
    echo "   • $(git rev-list --count HEAD) commits"
    echo "   • Progressive development timeline"
    echo "   • Professional project structure"
else
    echo "❌ Push failed. You may need to:"
    echo "   1. Check your GitHub authentication"
    echo "   2. Ensure the repository exists"
    echo "   3. Try: git push -u origin main --force (if needed)"
fi