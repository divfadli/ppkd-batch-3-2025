// Multi-Page Portfolio Website JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all functions
    initNavigation();
    initAnimations();
    initPortfolioFilter();
    initScrollAnimations();
    adjustMainPadding();
    
     // Page-specific initializations
    const currentPage = document.body.dataset.page || "home";
    console.log(`Current Page: ${currentPage}`);
    
    switch(currentPage) {
        case 'home':
            initHomePage();
            break;
        case 'skills':
            initSkillsPage();
            break;
        case 'portofolio':
            initPortfolioPage();
            break;
        case 'contact':
            initContactPage();
            break;
    }
});

// Get current page name
function getCurrentPage() {
    const path = window.location.pathname;
    const page = path.split('/').pop().replace('.php', '') || 'home';
    return page;
}

// Navigation functionality
function initNavigation() {
    const navbar = document.getElementById('mainNav');
    
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        if (window.scrollY > 100) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
    
    // Mobile menu close on link click
    const navLinks = document.querySelectorAll('.nav-link');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (navbarCollapse.classList.contains('show')) {
                navbarCollapse.classList.remove('show');
            }
        });
    });
}

// Home page specific functions
function initHomePage() {
    animateCounters();
    typeWriter();
}

// Skills page specific functions
function initSkillsPage() {
    animateProgressBars();
}

// Portfolio page specific functions
function initPortfolioPage() {
    // Portfolio filter functionality is already initialized in initPortfolioFilter()
}

// Contact page specific functions
function initContactPage() {
    const contactForm = document.querySelector('form[method="POST"]');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            if (!validateContactForm(this)) {
                e.preventDefault();
            }
        });
    }
}

// Initialize animations
function initAnimations() {
    const animatedElements = document.querySelectorAll('.service-card, .value-card, .stat-card');
    
    animatedElements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        el.style.transitionDelay = `${index * 0.1}s`;
        
        setTimeout(() => {
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        }, 100);
    });
}

// Counter animation
function animateCounters() {
    const counters = document.querySelectorAll('.stat-number');
    const speed = 200;
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = parseInt(counter.getAttribute('data-count'));
                animateCounter(counter, target, speed);
                observer.unobserve(counter);
            }
        });
    });
    
    counters.forEach(counter => observer.observe(counter));
}

function animateCounter(counter, target, speed) {
    const increment = target / speed;
    let current = 0;
    
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            counter.textContent = target;
            clearInterval(timer);
        } else {
            counter.textContent = Math.ceil(current);
        }
    }, 1);
}

// Progress bars animation
function animateProgressBars() {
    const progressBars = document.querySelectorAll('.progress-bar');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                const progressBar = entry.target;
                const width = progressBar.getAttribute('data-width');
                
                progressBar.style.width = '0';
                progressBar.style.transition = 'width 1.2s cubic-bezier(0.4, 0, 0.2, 1)';
                
                setTimeout(() => {
                    requestAnimationFrame(() => {
                        progressBar.style.width = width + '%';
                    });
                }, 300 * index);

                observer.unobserve(progressBar);
            }
        });
    }, { threshold: 0.3 });
    
    progressBars.forEach(bar => observer.observe(bar));
}

// Typing effect
function typeWriter() {
    const subtitle = document.querySelector('.hero-subtitle');
    if (!subtitle) return;

    const texts = ["Full Stack Developer", "Web Developer", "Mobile Developer"];
    let textIndex = 0;
    let charIndex = 0;
    let isDeleting = false;

    subtitle.textContent = '';
    subtitle.style.borderRight = '2px solid white';

    function type() {
        const currentText = texts[textIndex];
        if (!isDeleting && charIndex < currentText.length) {
            subtitle.textContent = currentText.substring(0, charIndex + 1);
            charIndex++;
            setTimeout(type, 120);
        } else if (isDeleting && charIndex > 0) {
            subtitle.textContent = currentText.substring(0, charIndex - 1);
            charIndex--;
            setTimeout(type, 60);
        } else {
            if (!isDeleting && charIndex === currentText.length) {
                isDeleting = true;
                setTimeout(type, 1500);
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                textIndex = (textIndex + 1) % texts.length;
                setTimeout(type, 500);
            }
        }
    }

    type();
}

// Portfolio filter
function initPortfolioFilter() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');
    
    if (filterBtns.length === 0) return;
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const filterValue = this.getAttribute('data-filter');
            
            portfolioItems.forEach(item => {
                if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                    item.style.display = 'block';
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'scale(1)';
                    }, 100);
                } else {
                    item.style.opacity = '0';
                    item.style.transform = 'scale(0.8)';
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 300);
                }
            });
        });
    });
}

// Scroll animations
function initScrollAnimations() {
    const animatedElements = document.querySelectorAll('.portfolio-card, .skill-item, .timeline-item, .testimonial-card, .education-item, .certification-item');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    animatedElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
}

// Contact form validation
function validateContactForm(form) {
    const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        input.classList.remove('is-invalid');
        
        if (!input.value.trim()) {
            input.classList.add('is-invalid');
            isValid = false;
        }
        
        if (input.type === 'email' && input.value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(input.value)) {
                input.classList.add('is-invalid');
                isValid = false;
            }
        }
    });
    
    if (!isValid) {
        showMessage('Mohon lengkapi semua field yang diperlukan dengan benar.', 'danger');
        
        const firstInvalid = form.querySelector('.is-invalid');
        if (firstInvalid) {
            firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstInvalid.focus();
        }
    }
    
    return isValid;
}

// Show message function
function showMessage(message, type) {
    const existingAlerts = document.querySelectorAll('.alert');
    existingAlerts.forEach(alert => alert.remove());
    
    const alert = document.createElement('div');
    alert.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show`;
    alert.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    const container = document.querySelector('.container');
    if (container) {
        container.insertBefore(alert, container.firstChild);
    }
    
    setTimeout(() => {
        if (alert.parentNode) {
            alert.remove();
        }
    }, 5000);
    
    alert.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

// Smooth scroll to top
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Add scroll to top button functionality
window.addEventListener('scroll', debounce(function() {
    const scrollTopBtn = document.getElementById('scrollTopBtn');
    if (scrollTopBtn) {
        if (window.scrollY > 500) {
            scrollTopBtn.style.display = 'block';
        } else {
            scrollTopBtn.style.display = 'none';
        }
    }
}, 100));

// Utility functions
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

// Handle page transitions
function handlePageTransition() {
    const links = document.querySelectorAll('a[href$=".php"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            if (this.hostname !== window.location.hostname || this.target === '_blank') {
                return;
            }
            
            e.preventDefault();
            const href = this.href;
            
            document.body.style.opacity = '0.7';
            document.body.style.transition = 'opacity 0.3s ease';
            
            setTimeout(() => {
                window.location.href = href;
            }, 300);
        });
    });
}

handlePageTransition();

// Preloader (if exists)
window.addEventListener('load', function() {
    const preloader = document.getElementById('preloader');
    if (preloader) {
        preloader.style.opacity = '0';
        setTimeout(() => {
            preloader.style.display = 'none';
        }, 500);
    }
    
    document.body.style.opacity = '1';
    document.body.style.transition = 'opacity 0.5s ease';
});

// Handle browser back/forward buttons
window.addEventListener('popstate', function() {
    window.location.reload();
});

// Performance optimization - lazy load images
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });
    
    images.forEach(img => imageObserver.observe(img));
}

initLazyLoading();

// Export functions for global use
window.portfolioApp = {
    scrollToTop,
    showMessage,
    validateContactForm,
    getCurrentPage
};

function adjustMainPadding() {
    const navbar = document.getElementById("mainNav");
    const main = document.querySelector("main");
    if (navbar && main) {
        const navHeight = navbar.offsetHeight;
        main.style.paddingTop = navHeight + "px";
    }
    window.addEventListener("resize", adjustMainPadding);
}