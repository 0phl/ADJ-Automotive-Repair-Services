/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.php",
    "./public/**/*.php",
    "./includes/**/*.php",
    "./admin/**/*.php",
    "./src/**/*.{html,js,php}"
  ],
  theme: {
    extend: {
      colors: {
        // Primary brand colors
        'primary-blue': '#1e40af',
        'secondary-yellow': '#fbbf24',
        'light-gray': '#f8fafc',
        'dark-blue': '#1e3a8a',
        'text-gray': '#64748b',
        'border-gray': '#e2e8f0',
        
        // Additional colors
        'success-green': '#10b981',
        'warning-yellow': '#fbbf24',
        'error-red': '#ef4444',
        'black': '#0f172a',
        
        // Legacy color mappings for compatibility
        'secondary-orange': '#fbbf24',
        'accent-red': '#1e40af',
        'dark-gray': '#1e3a8a'
      },
      fontFamily: {
        'sans': ['Inter', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'sans-serif'],
      },
      animation: {
        'float': 'float 3s ease-in-out infinite',
        'pulse-slow': 'pulse 3s infinite',
        'slideInUp': 'slideInUp 0.6s ease-out',
        'spin': 'spin 1s linear infinite'
      },
      keyframes: {
        float: {
          '0%, 100%': { transform: 'translateY(0px)' },
          '50%': { transform: 'translateY(-10px)' }
        },
        slideInUp: {
          'from': {
            opacity: '0',
            transform: 'translateY(20px)'
          },
          'to': {
            opacity: '1',
            transform: 'translateY(0)'
          }
        }
      },
      boxShadow: {
        'custom': '0 4px 12px rgba(30, 58, 138, 0.3)',
        'yellow': '0 4px 12px rgba(251, 191, 36, 0.4)',
        'lg-hover': '0 10px 25px rgba(0, 0, 0, 0.15)'
      },
      backdropBlur: {
        'xs': '2px'
      },
      screens: {
        'xs': '475px'
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}
