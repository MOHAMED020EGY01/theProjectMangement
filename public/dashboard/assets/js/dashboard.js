// Dashboard JavaScript - Main functionality
class Dashboard {
    constructor() {
        this.charts = {};
        this.init();
    }

    init() {
        // Initialize dashboard when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            this.loadMetrics();
            this.initializeCharts();
            this.setupEventListeners();
            this.updateTimestamp();
        });
    }

    // Load and display key metrics
    loadMetrics() {
        // Simulate API call with loading state
        const metrics = {
            totalRevenue: { value: 0, target: 425000 },
            activeUsers: { value: 0, target: 12580 },
            conversionRate: { value: 0, target: 73.2 },
            pendingRequests: { value: 0, target: 18 }
        };

        // Animate counter for total revenue
        this.animateCounter('totalRevenue', metrics.totalRevenue.target, '$', ',');
        
        // Animate counter for active users
        this.animateCounter('activeUsers', metrics.activeUsers.target, '', ',');
        
        // Animate counter for conversion rate
        this.animateCounter('conversionRate', metrics.conversionRate.target, '', '', '%');
        
        // Update progress bar for conversion rate
        setTimeout(() => {
            document.getElementById('conversionProgress').style.width = metrics.conversionRate.target + '%';
        }, 500);
        
        // Animate counter for pending requests
        this.animateCounter('pendingRequests', metrics.pendingRequests.target);
    }

    // Animate counter with easing
    animateCounter(elementId, target, prefix = '', thousands = '', suffix = '') {
        const element = document.getElementById(elementId);
        const duration = 2000;
        const start = performance.now();
        const startValue = 0;

        const animate = (currentTime) => {
            const elapsed = currentTime - start;
            const progress = Math.min(elapsed / duration, 1);
            
            // Easing function for smooth animation
            const easeOut = 1 - Math.pow(1 - progress, 3);
            const current = Math.floor(startValue + (target - startValue) * easeOut);
            
            let formattedValue = current.toString();
            if (thousands === ',') {
                formattedValue = current.toLocaleString();
            }
            
            element.textContent = prefix + formattedValue + suffix;
            
            if (progress < 1) {
                requestAnimationFrame(animate);
            }
        };

        requestAnimationFrame(animate);
    }

    // Initialize Chart.js charts
    initializeCharts() {
        this.createRevenueChart();
        this.createPieChart();
    }

    // Create revenue line chart
    createRevenueChart() {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        
        // Sample data for the last 12 months
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                       'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const revenueData = [28000, 32000, 35000, 31000, 38000, 42000, 
                           45000, 41000, 47000, 52000, 49000, 55000];

        this.charts.revenue = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Revenue',
                    data: revenueData,
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0, 123, 255, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#007bff',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#858796'
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(200, 200, 200, 0.2)'
                        },
                        ticks: {
                            color: '#858796',
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                elements: {
                    point: {
                        hoverRadius: 8
                    }
                }
            }
        });
    }

    // Create pie chart for revenue sources
    createPieChart() {
        const ctx = document.getElementById('pieChart').getContext('2d');
        
        this.charts.pie = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Direct', 'Social Media', 'Referral'],
                datasets: [{
                    data: [55, 30, 15],
                    backgroundColor: ['#007bff', '#28a745', '#17a2b8'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                cutout: '70%'
            }
        });
    }

    // Format date for display
    formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', {
            month: 'short',
            day: 'numeric',
            year: 'numeric'
        });
    }

    // Get CSS class for status badge
    getStatusClass(status) {
        switch(status.toLowerCase()) {
            case 'completed':
                return 'status-success';
            case 'pending':
                return 'status-warning';
            case 'processing':
                return 'status-warning';
            default:
                return 'status-danger';
        }
    }

    // Setup event listeners
    setupEventListeners() {
        // Sidebar navigation
        document.querySelectorAll('.sidebar .nav-link').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                
                // Remove active class from all links
                document.querySelectorAll('.sidebar .nav-link').forEach(l => {
                    l.classList.remove('active');
                });
                
                // Add active class to clicked link
                link.classList.add('active');
            });
        });

        // Mobile sidebar toggle
        const sidebarToggle = document.querySelector('[data-bs-toggle="collapse"]');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                const sidebar = document.getElementById('sidebar');
                sidebar.classList.toggle('show');
            });
        }

        // Refresh data button (if needed)
        document.addEventListener('click', (e) => {
            if (e.target.closest('.btn-primary')) {
                this.refreshData();
            }
        });

        // Window resize handler for charts
        window.addEventListener('resize', () => {
            Object.values(this.charts).forEach(chart => {
                chart.resize();
            });
        });
    }



    // Refresh dashboard data
    refreshData() {
        console.log('Refreshing dashboard data...');
        
        // Show loading state
        const buttons = document.querySelectorAll('.btn-primary');
        buttons.forEach(btn => {
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Loading...';
        });
        
        // Simulate API call
        setTimeout(() => {
            this.loadMetrics();
            
            // Reset buttons
            buttons.forEach(btn => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-download me-1"></i>Export';
            });
        }, 2000);
    }

    // Update timestamp
    updateTimestamp() {
        const now = new Date();
        const timestamp = now.toLocaleString('en-US', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
        
        // Add timestamp to page if element exists
        const timestampElement = document.getElementById('lastUpdated');
        if (timestampElement) {
            timestampElement.textContent = `Last updated: ${timestamp}`;
        }
    }

    // Utility method to show notifications (for future use)
    showNotification(message, type = 'info') {
        console.log(`${type.toUpperCase()}: ${message}`);
        
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(notification);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 5000);
    }
}

// Initialize dashboard
const dashboard = new Dashboard();

// Global functions for potential external use
window.dashboardRefresh = () => dashboard.refreshData();
window.showNotification = (message, type) => dashboard.showNotification(message, type);
