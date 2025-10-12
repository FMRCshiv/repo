/**
 * Blizzard Theme JavaScript
 * Handles theme functionality, dark mode, and interactive elements
 */

class BlizzardTheme {
    constructor() {
        this.init();
    }

    init() {
        this.initDarkMode();
        this.initNavigation();
        this.initTabs();
        this.initModals();
        this.initDropdowns();
        this.initTooltips();
        this.initAnimations();
        this.initConsole();
    }

    /**
     * Initialize dark mode functionality
     */
    initDarkMode() {
        const themeToggle = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        // Get theme from localStorage or system preference
        const savedTheme = localStorage.getItem('theme');
        const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        const currentTheme = savedTheme || systemTheme;

        this.setTheme(currentTheme);

        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                const currentTheme = document.documentElement.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                this.setTheme(newTheme);
            });
        }

        // Listen for system theme changes
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            if (!localStorage.getItem('theme')) {
                this.setTheme(e.matches ? 'dark' : 'light');
            }
        });
    }

    setTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);

        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        if (theme === 'dark') {
            darkIcon?.classList.add('hidden');
            lightIcon?.classList.remove('hidden');
        } else {
            darkIcon?.classList.remove('hidden');
            lightIcon?.classList.add('hidden');
        }
    }

    /**
     * Initialize navigation functionality
     */
    initNavigation() {
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (mobileMenu && !mobileMenu.contains(e.target) && !mobileMenuButton?.contains(e.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
    }

    /**
     * Initialize tab functionality
     */
    initTabs() {
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const tabId = button.getAttribute('data-tab');
                
                // Remove active class from all buttons and contents
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.add('hidden'));
                
                // Add active class to clicked button
                button.classList.add('active');
                
                // Show corresponding content
                const targetContent = document.getElementById(`${tabId}-tab`);
                if (targetContent) {
                    targetContent.classList.remove('hidden');
                }
            });
        });
    }

    /**
     * Initialize modal functionality
     */
    initModals() {
        const modalTriggers = document.querySelectorAll('[data-modal-target]');
        const modalCloses = document.querySelectorAll('[data-modal-close]');

        modalTriggers.forEach(trigger => {
            trigger.addEventListener('click', (e) => {
                e.preventDefault();
                const modalId = trigger.getAttribute('data-modal-target');
                const modal = document.getElementById(modalId);
                if (modal) {
                    this.openModal(modal);
                }
            });
        });

        modalCloses.forEach(close => {
            close.addEventListener('click', (e) => {
                e.preventDefault();
                const modal = close.closest('.modal-overlay');
                if (modal) {
                    this.closeModal(modal);
                }
            });
        });

        // Close modal when clicking outside
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('modal-overlay')) {
                this.closeModal(e.target);
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                const openModal = document.querySelector('.modal-overlay:not(.hidden)');
                if (openModal) {
                    this.closeModal(openModal);
                }
            }
        });
    }

    openModal(modal) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Focus first input in modal
        const firstInput = modal.querySelector('input, textarea, select');
        if (firstInput) {
            setTimeout(() => firstInput.focus(), 100);
        }
    }

    closeModal(modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    /**
     * Initialize dropdown functionality
     */
    initDropdowns() {
        const dropdownTriggers = document.querySelectorAll('[data-dropdown-toggle]');

        dropdownTriggers.forEach(trigger => {
            trigger.addEventListener('click', (e) => {
                e.stopPropagation();
                const dropdownId = trigger.getAttribute('data-dropdown-toggle');
                const dropdown = document.getElementById(dropdownId);
                
                if (dropdown) {
                    // Close all other dropdowns
                    document.querySelectorAll('.dropdown:not(.hidden)').forEach(dd => {
                        if (dd !== dropdown) {
                            dd.classList.add('hidden');
                        }
                    });
                    
                    // Toggle current dropdown
                    dropdown.classList.toggle('hidden');
                }
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', () => {
            document.querySelectorAll('.dropdown:not(.hidden)').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        });
    }

    /**
     * Initialize tooltips
     */
    initTooltips() {
        const tooltipElements = document.querySelectorAll('[data-tooltip]');

        tooltipElements.forEach(element => {
            element.addEventListener('mouseenter', (e) => {
                const tooltipText = e.target.getAttribute('data-tooltip');
                this.showTooltip(e.target, tooltipText);
            });

            element.addEventListener('mouseleave', () => {
                this.hideTooltip();
            });
        });
    }

    showTooltip(element, text) {
        const tooltip = document.createElement('div');
        tooltip.className = 'tooltip';
        tooltip.textContent = text;
        tooltip.style.cssText = `
            position: absolute;
            background: #1f2937;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 14px;
            z-index: 1000;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.2s;
        `;

        document.body.appendChild(tooltip);

        const rect = element.getBoundingClientRect();
        tooltip.style.left = rect.left + rect.width / 2 - tooltip.offsetWidth / 2 + 'px';
        tooltip.style.top = rect.top - tooltip.offsetHeight - 8 + 'px';

        setTimeout(() => {
            tooltip.style.opacity = '1';
        }, 10);
    }

    hideTooltip() {
        const tooltip = document.querySelector('.tooltip');
        if (tooltip) {
            tooltip.remove();
        }
    }

    /**
     * Initialize animations
     */
    initAnimations() {
        // Intersection Observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        }, observerOptions);

        // Observe elements with animation classes
        document.querySelectorAll('.card, .btn, .nav-link').forEach(el => {
            observer.observe(el);
        });
    }

    /**
     * Initialize console functionality
     */
    initConsole() {
        const consoleInput = document.querySelector('.console input[type="text"]');
        const consoleOutput = document.querySelector('.console');
        const sendButton = document.querySelector('.console button');

        if (consoleInput && sendButton) {
            const sendCommand = () => {
                const command = consoleInput.value.trim();
                if (command) {
                    this.addConsoleLine(`> ${command}`, 'user-input');
                    consoleInput.value = '';
                    
                    // Simulate command execution
                    setTimeout(() => {
                        this.simulateCommandResponse(command);
                    }, 100);
                }
            };

            sendButton.addEventListener('click', sendCommand);
            consoleInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    sendCommand();
                }
            });
        }
    }

    addConsoleLine(text, type = 'normal') {
        const consoleOutput = document.querySelector('.console');
        if (!consoleOutput) return;

        const line = document.createElement('div');
        line.className = `console-line ${type}`;
        line.textContent = text;
        
        consoleOutput.appendChild(line);
        consoleOutput.scrollTop = consoleOutput.scrollHeight;
    }

    simulateCommandResponse(command) {
        const responses = {
            'help': 'Available commands: help, status, players, version',
            'status': 'Server is running normally. TPS: 20.0',
            'players': 'Online players: 2/20 (Steve, Alex)',
            'version': 'Minecraft 1.20.1 (Paper)',
            'stop': 'Server is shutting down...',
            'restart': 'Server is restarting...'
        };

        const response = responses[command.toLowerCase()] || `Unknown command: ${command}`;
        this.addConsoleLine(response, 'server-response');
    }

    /**
     * Utility methods
     */
    showNotification(message, type = 'info', duration = 5000) {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.textContent = message;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${this.getNotificationColor(type)};
            color: white;
            padding: 12px 16px;
            border-radius: 8px;
            z-index: 1000;
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.3s ease;
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.opacity = '1';
            notification.style.transform = 'translateX(0)';
        }, 10);

        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }, duration);
    }

    getNotificationColor(type) {
        const colors = {
            success: '#10b981',
            error: '#ef4444',
            warning: '#f59e0b',
            info: '#3b82f6'
        };
        return colors[type] || colors.info;
    }

    /**
     * Server management methods
     */
    startServer(serverId) {
        this.showNotification('Starting server...', 'info');
        // Implement server start logic
    }

    stopServer(serverId) {
        this.showNotification('Stopping server...', 'warning');
        // Implement server stop logic
    }

    restartServer(serverId) {
        this.showNotification('Restarting server...', 'info');
        // Implement server restart logic
    }

    /**
     * File upload handling
     */
    initFileUpload() {
        const fileInputs = document.querySelectorAll('input[type="file"]');
        
        fileInputs.forEach(input => {
            input.addEventListener('change', (e) => {
                const files = Array.from(e.target.files);
                files.forEach(file => {
                    this.uploadFile(file);
                });
            });
        });
    }

    uploadFile(file) {
        const formData = new FormData();
        formData.append('file', file);
        
        // Show upload progress
        this.showNotification(`Uploading ${file.name}...`, 'info');
        
        // Implement actual upload logic
        fetch('/api/upload', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            this.showNotification('File uploaded successfully!', 'success');
        })
        .catch(error => {
            this.showNotification('Upload failed!', 'error');
        });
    }
}

// Initialize theme when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.blizzardTheme = new BlizzardTheme();
});

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = BlizzardTheme;
}
