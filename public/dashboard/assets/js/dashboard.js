// Dashboard JavaScript - Main functionality
class Dashboard {
    constructor() {
        this.charts = {};
        this.init();
    }

    init() {
        // Initialize dashboard when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            this.initializeCharts();
            this.updateTimestamp();
        });
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
