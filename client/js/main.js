// Cart functionality
let cart = JSON.parse(localStorage.getItem('cart')) || [];

function addToCart(productId) {
    // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
    const existingItem = cart.find(item => item.id === productId);
    
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            id: productId,
            quantity: 1
        });
    }
    
    // Lưu giỏ hàng vào localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
    
    // Cập nhật số lượng sản phẩm trong giỏ hàng
    updateCartCount();
    
    // Hiển thị thông báo
    showNotification('Sản phẩm đã được thêm vào giỏ hàng!');
}

function updateCartCount() {
    const cartCount = cart.reduce((total, item) => total + item.quantity, 0);
    const cartCountElement = document.getElementById('cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = cartCount;
    }
}

function showNotification(message) {
    // Tạo thông báo
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.textContent = message;
    
    // Thêm vào body
    document.body.appendChild(notification);
    
    // Xóa thông báo sau 3 giây
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Product image zoom
function initImageZoom() {
    const productImage = document.querySelector('.product-detail img');
    if (productImage) {
        productImage.addEventListener('mousemove', (e) => {
            const { left, top, width, height } = productImage.getBoundingClientRect();
            const x = (e.clientX - left) / width * 100;
            const y = (e.clientY - top) / height * 100;
            productImage.style.transformOrigin = `${x}% ${y}%`;
        });
        
        productImage.addEventListener('mouseenter', () => {
            productImage.style.transform = 'scale(1.5)';
        });
        
        productImage.addEventListener('mouseleave', () => {
            productImage.style.transform = 'scale(1)';
        });
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    updateCartCount();
    initImageZoom();
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// Add to cart animation
function addToCartAnimation(button) {
    button.classList.add('adding');
    setTimeout(() => {
        button.classList.remove('adding');
    }, 1000);
}

// Form validation
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return true;

    let isValid = true;
    const inputs = form.querySelectorAll('input[required], textarea[required]');
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            isValid = false;
            input.classList.add('is-invalid');
        } else {
            input.classList.remove('is-invalid');
        }
    });

    return isValid;
}

// Initialize tooltips
function initTooltips() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

// Lazy loading for images
function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                observer.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));
}

// Initialize all features
document.addEventListener('DOMContentLoaded', () => {
    updateCartCount();
    initImageZoom();
    initTooltips();
    initLazyLoading();
}); 