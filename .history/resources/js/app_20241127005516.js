import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.data('modal', () => ({
        open: false,
        init() {
            this.$watch('open', value => {
                if (value) {
                    document.body.classList.add('modal-open');
                } else {
                    document.body.classList.remove('modal-open');
                }
            });
        }
    }));
});

Alpine.start();
