<script>
(function () {
    const discount = Number(document.body.dataset.roundtripDiscount || 10);
    const bookingUrl = document.body.dataset.bookingUrl || '/dat-xe';

    function formatVnd(amount) {
        return new Intl.NumberFormat('vi-VN').format(amount) + 'đ';
    }

    function shortMoney(amount) {
        if (!amount) return '0k';
        if (amount >= 1000000 || amount % 1000 !== 0) return formatVnd(amount);
        return (amount / 1000) + 'k';
    }

    function priceMap(input) {
        try { return JSON.parse(input.dataset.prices || '{}'); } catch (e) { return {}; }
    }

    function currentService() {
        const input = document.getElementById('serviceKey');
        return input ? input.value : 'airport';
    }

    function renderPrices() {
        const display = document.getElementById('priceDisplay');
        if (!display) return;
        const service = currentService();
        const roundtrip = document.querySelector('input[name="trip_mode"]:checked')?.value === 'roundtrip';
        document.querySelectorAll('input[name="vehicle_code"]').forEach(function (input) {
            const map = priceMap(input);
            const price = Number(map[service] || input.dataset.fallback || 0);
            const label = document.querySelector('[data-price-for="' + input.value + '"]');
            if (label) label.textContent = shortMoney(price);
            if (input.checked) {
                const finalPrice = roundtrip ? Math.round(price * 2 * (100 - discount) / 100) : price;
                display.textContent = formatVnd(finalPrice);
            }
        });
    }

    document.querySelectorAll('.booking-tab').forEach(function (tab) {
        tab.addEventListener('click', function () {
            document.querySelectorAll('.booking-tab').forEach(function (item) {
                item.classList.remove('bg-surface-container-lowest', 'text-secondary', 'shadow-sm', 'active');
                item.classList.add('text-on-surface-variant');
            });
            tab.classList.add('bg-surface-container-lowest', 'text-secondary', 'shadow-sm', 'active');
            tab.classList.remove('text-on-surface-variant');
            const serviceInput = document.getElementById('serviceKey');
            if (serviceInput) serviceInput.value = tab.dataset.key || '';
            const pickup = document.getElementById('pickupLocation');
            const dropoff = document.getElementById('dropoffLocation');
            if (pickup) pickup.value = tab.dataset.pickup || '';
            if (dropoff) dropoff.value = tab.dataset.dropoff || '';
            renderPrices();
        });
    });

    document.querySelectorAll('input[name="vehicle_code"], input[name="trip_mode"]').forEach(function (input) {
        input.addEventListener('change', renderPrices);
    });

    document.querySelectorAll('.js-swap').forEach(function (button) {
        button.addEventListener('click', function () {
            const pickup = document.getElementById('pickupLocation');
            const dropoff = document.getElementById('dropoffLocation');
            if (!pickup || !dropoff) return;
            const temp = pickup.value;
            pickup.value = dropoff.value;
            dropoff.value = temp;
        });
    });

    document.querySelectorAll('.js-fill-route').forEach(function (button) {
        button.addEventListener('click', function () {
            const pickup = document.getElementById('pickupLocation');
            const dropoff = document.getElementById('dropoffLocation');
            if (!pickup || !dropoff) {
                const url = new URL(bookingUrl, window.location.origin);
                url.searchParams.set('pickup', button.dataset.pickup || '');
                url.searchParams.set('dropoff', button.dataset.dropoff || '');
                window.location = url;
                return;
            }
            pickup.value = button.dataset.pickup || '';
            dropoff.value = button.dataset.dropoff || '';
            document.getElementById('bookingForm')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    });

    document.querySelectorAll('.js-select-vehicle').forEach(function (button) {
        button.addEventListener('click', function () {
            const radio = document.querySelector('input[name="vehicle_code"][value="' + button.dataset.vehicle + '"]');
            if (!radio) {
                const url = new URL(bookingUrl, window.location.origin);
                url.searchParams.set('vehicle', button.dataset.vehicle || '');
                window.location = url;
                return;
            }
            radio.checked = true;
            radio.dispatchEvent(new Event('change'));
            document.getElementById('bookingForm')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    });

    document.querySelectorAll('.js-faq').forEach(function (button) {
        button.addEventListener('click', function () {
            const content = button.nextElementSibling;
            const icon = button.querySelector('.faq-icon');
            const willOpen = content && content.classList.contains('hidden');
            document.querySelectorAll('.faq-content').forEach(function (el) { el.classList.add('hidden'); });
            document.querySelectorAll('.faq-icon').forEach(function (el) { el.classList.remove('rotate-180'); });
            if (willOpen && content) {
                content.classList.remove('hidden');
                if (icon) icon.classList.add('rotate-180');
            }
        });
    });

    const menuToggle = document.getElementById('menuToggle');
    const mobileNav = document.getElementById('mobileNav');
    if (menuToggle && mobileNav) {
        menuToggle.addEventListener('click', function () {
            mobileNav.classList.toggle('hidden');
        });
    }

    const modal = document.getElementById('bookingSuccessModal');
    document.getElementById('closeSuccessModal')?.addEventListener('click', function () {
        modal?.classList.add('hidden');
        modal?.classList.remove('flex');
    });
    modal?.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    });

    renderPrices();
})();
</script>
