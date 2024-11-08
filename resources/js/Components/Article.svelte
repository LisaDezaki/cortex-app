<script>
	import Breadcrumbs from '@/Components/Breadcrumbs.svelte';
	import Container from '@/Components/Container.svelte';

	let componentClass;
	export { componentClass as class }
	export let breadcrumbs;
</script>

<article class="flex-grow relative px-12 py-2 overflow-x-hidden overflow-y-auto {componentClass}">

	{#if breadcrumbs}
		<Breadcrumbs crumbs={breadcrumbs} />
	{/if}

	<Container>
		<slot />
	</Container>
	
</article>