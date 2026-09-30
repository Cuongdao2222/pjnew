document.addEventListener('DOMContentLoaded', function() {
    // Existing Carousel Logic (More Deals / Exclusive Products)
    const dealsPrevBtn = document.querySelector('.moreDealsContainer .carouselArrow.prevBtn');
    const dealsNextBtn = document.querySelector('.moreDealsContainer .carouselArrow.nextBtn');
    const dealsGrid = document.querySelector('.dealsGrid');

    if (dealsGrid) {
        if (dealsPrevBtn) {
            dealsPrevBtn.addEventListener('click', function() {
                dealsGrid.scrollBy({ left: -300, behavior: 'smooth' });
            });
        }
        if (dealsNextBtn) {
            dealsNextBtn.addEventListener('click', function() {
                dealsGrid.scrollBy({ left: 300, behavior: 'smooth' });
            });
        }
    }

    // Search Suggestion Logic
    const searchInput = document.querySelector('.searchBar input');
    
    if (searchInput) {
        const suggestionBox = document.createElement('div');
        suggestionBox.className = 'suggestion-box';
        suggestionBox.style.position = 'absolute';
        suggestionBox.style.background = '#fff';
        suggestionBox.style.border = '0';
        suggestionBox.style.width = searchInput.parentElement.offsetWidth + 'px';
        suggestionBox.style.zIndex = '1000';
        // searchInput.parentElement.style.position = 'relative';
        searchInput.parentElement.appendChild(suggestionBox);

        searchInput.addEventListener('input', function() {
            const query = this.value;
            if (query.length < 2) {
                suggestionBox.innerHTML = '';
                return;
            }

            fetch(`/suggest?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    suggestionBox.innerHTML = '';
                    data.forEach(item => {
                        const div = document.createElement('div');
                        div.className = 'suggestion-item';
                        
                        // We need the image from the products list. Assuming the controller sends enough data or we fetch it.
                        // Let's assume the suggest route is updated to return image or we handle it here.
                        // For now, let's just add the name.
                        div.innerHTML = `
                            <img src="${item.image}" alt="${item.name}">
                            <span>${item.name}</span>
                        `;
                        div.addEventListener('click', () => {
                            window.location.href = `/detail/${item.slug}`;
                        });
                        suggestionBox.appendChild(div);
                    });
                });
        });
    }

    // Add to Cart Logic
    const addToCartButtons = document.querySelectorAll('.btnAddToCart, .btnAddToCartLarge');
    const cartCountElement = document.querySelector('.cartCount');

    // Fetch initial cart count
    fetch('/get-cart-count')
        .then(response => response.json())
        .then(data => {
            if (cartCountElement) {
                cartCountElement.textContent = data.count;
            }
        });

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            
            if(!productId) {
                alert('Product ID not found.');
                return;
            }

            fetch('/add-to-cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ id: productId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    cartCountElement.textContent = data.cart_count;
                    // Improved notification
                    const notification = document.createElement('div');
                    notification.textContent = 'Product added to cart!';
                    notification.style.position = 'fixed';
                    notification.style.bottom = '20px';
                    notification.style.right = '20px';
                    notification.style.background = '#0046be';
                    notification.style.color = '#fff';
                    notification.style.padding = '10px 20px';
                    notification.style.borderRadius = '5px';
                    notification.style.zIndex = '9999';
                    document.body.appendChild(notification);
                    setTimeout(() => notification.remove(), 2000);
                }
            });
        });
    });

    // Product Gallery Slide Logic
    const gallery = document.getElementById('productGallery');
    if (gallery) {
        const mainImage = document.getElementById('mainProductImage');
        const thumbnails = gallery.querySelectorAll('.thumbItem');
        const images = JSON.parse(mainImage.getAttribute('data-images'));
        const prevBtn = gallery.querySelector('.navArrow.prev');
        const nextBtn = gallery.querySelector('.navArrow.next');
        let currentIndex = 0;

        function updateImage(index) {
            currentIndex = index;
            mainImage.src = images[currentIndex];
            thumbnails.forEach((thumb, i) => {
                thumb.classList.toggle('active', i === currentIndex);
            });
        }

        thumbnails.forEach((thumb, index) => {
            thumb.addEventListener('click', () => updateImage(index));
        });

        prevBtn.addEventListener('click', () => {
            let index = currentIndex - 1;
            if (index < 0) index = images.length - 1;
            updateImage(index);
        });

        nextBtn.addEventListener('click', () => {
            let index = currentIndex + 1;
            if (index >= images.length) index = 0;
            updateImage(index);
        });
    }

    // Banner Carousel Sliding Logic
    document.querySelectorAll('.featureBannerCard').forEach(banner => {
        const prevBtn = banner.querySelector('.bannerNavBtn.prevBtn');
        const nextBtn = banner.querySelector('.bannerNavBtn.nextBtn');
        const grid = banner.querySelector('.bannerProductsGrid');

        if (prevBtn && nextBtn && grid) {
            prevBtn.addEventListener('click', () => {
                grid.scrollBy({ left: -200, behavior: 'smooth' });
            });
            nextBtn.addEventListener('click', () => {
                grid.scrollBy({ left: 200, behavior: 'smooth' });
            });
        }
    });

    // Category Page Sorting & Filtering Logic (In Stock, Best Buy Only, Sort Options)
    const productGrid = document.querySelector('.productGrid');
    if (productGrid) {
        const cards = Array.from(productGrid.querySelectorAll('.productCard'));
        const toggleLabels = document.querySelectorAll('.listingToolbar .toggleLabel');
        
        let inStockCheckbox = null;
        let bestBuyCheckbox = null;

        toggleLabels.forEach(label => {
            const spanText = label.querySelector('span').textContent.trim();
            const input = label.querySelector('.toggleInput');
            if (spanText === 'In Stock') {
                inStockCheckbox = input;
            } else if (spanText === 'Best Buy Only') {
                bestBuyCheckbox = input;
            }
        });

        const sortSelect = document.querySelector('.sortControl select');

        function applyFilterAndSort() {
            let sortedCards = [...cards];

            const inStockChecked = inStockCheckbox ? inStockCheckbox.checked : false;
            const bestBuyChecked = bestBuyCheckbox ? bestBuyCheckbox.checked : false;
            const sortVal = sortSelect ? sortSelect.value : 'Best Match';

            sortedCards.sort((a, b) => {
                const qtyA = parseFloat(a.dataset.quantity) || 0;
                const qtyB = parseFloat(b.dataset.quantity) || 0;
                const rateA = parseFloat(a.dataset.rating) || 0;
                const rateB = parseFloat(b.dataset.rating) || 0;
                const priceA = parseFloat(a.dataset.price) || 0;
                const priceB = parseFloat(b.dataset.price) || 0;

                // 1. In Stock: Sắp xếp sản phẩm có số lượng lớn lên đầu
                if (inStockChecked) {
                    if (qtyB !== qtyA) return qtyB - qtyA;
                }

                // 2. Best Buy Only: Sắp xếp sản phẩm có số sao cao lên đầu
                if (bestBuyChecked) {
                    if (rateB !== rateA) return rateB - rateA;
                }

                // 3. Sort Option
                if (sortVal === 'Price Low to High') {
                    return priceA - priceB;
                } else if (sortVal === 'Price High to Low') {
                    return priceB - priceA;
                } else if (sortVal === 'Highest Rated') {
                    return rateB - rateA;
                }

                return 0; // Best Match (Default)
            });

            productGrid.innerHTML = '';
            sortedCards.forEach(card => productGrid.appendChild(card));
        }

        if (inStockCheckbox) inStockCheckbox.addEventListener('change', applyFilterAndSort);
        if (bestBuyCheckbox) bestBuyCheckbox.addEventListener('change', applyFilterAndSort);
        if (sortSelect) sortSelect.addEventListener('change', applyFilterAndSort);
    }
});