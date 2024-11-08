<script>
	import { Link } from "@inertiajs/svelte";

	let componentClass;
	export { componentClass as class }
	export let href;
</script>

<div class="card overflow-hidden bg-white dark:bg-slate-700 dark:hover:bg-slate-600 rounded-lg shadow {componentClass}">

	{#if href}
		<Link {href} class="absolute inset-0 z-10" />
	{/if}

	<slot />
	
</div>