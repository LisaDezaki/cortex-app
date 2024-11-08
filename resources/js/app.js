import { createInertiaApp } from '@inertiajs/svelte';
import '../css/app.css';
import { setThemeOnLoad } from './theme.js';

createInertiaApp({
    id: 'app',
	progress: {
		color: '#34d399'
	},
    resolve: name => {
        const pages = import.meta.glob('./**/*.svelte', { eager: true });
        let page = pages[`./Pages/${name}.svelte`];
        return { default: page.default, layout: page.layout || Layout };
    },
    setup({ el, App, props }) {
        new App({ target: el, props });
    },
});

setThemeOnLoad();