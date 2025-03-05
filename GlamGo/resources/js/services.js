// Services Filter Functionality
document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filter-form');
    const servicesGrid = document.getElementById('services-grid');
    let debounceTimer;

    // Handle filter changes
    const handleFilterChange = () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            const formData = new FormData(filterForm);
            const searchParams = new URLSearchParams(formData);
            
            // Update URL with filters
            const newUrl = `${window.location.pathname}?${searchParams.toString()}`;
            window.history.pushState({}, '', newUrl);

            // Show loading state
            servicesGrid.style.opacity = '0.5';
            servicesGrid.style.pointerEvents = 'none';

            // Fetch filtered results
            fetch(`/services/filter?${searchParams.toString()}`)
                .then(response => response.text())
                .then(html => {
                    servicesGrid.innerHTML = html;
                    servicesGrid.style.opacity = '1';
                    servicesGrid.style.pointerEvents = 'auto';

                    // Reinitialize AOS for new elements
                    if (typeof AOS !== 'undefined') {
                        AOS.refresh();
                    }
                })
                .catch(error => {
                    console.error('Error fetching filtered services:', error);
                    servicesGrid.style.opacity = '1';
                    servicesGrid.style.pointerEvents = 'auto';
                });
        }, 300); // Debounce delay
    };

    // Add event listeners to filter inputs
    const filterInputs = filterForm.querySelectorAll('.filter-input');
    filterInputs.forEach(input => {
        input.addEventListener('change', handleFilterChange);
        if (input.tagName === 'INPUT') {
            input.addEventListener('keyup', handleFilterChange);
        }
    });

    // Initialize AOS
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });
    }
}); 