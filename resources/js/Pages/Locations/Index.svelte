<script context="module">
	export { default as layout } from "@/Layouts/App.svelte";
</script>

<script>
	import { page } from "@inertiajs/svelte";
	import Article from '@/Components/Article.svelte';
	import Breadcrumbs from '@/Components/Breadcrumbs.svelte';
	import Header from '@/Components/Header.svelte';
	import ListLocations from '@/Components/ListLocations.svelte';
	export let locations;
</script>

<svelte:head>
	<title>{$page.props.appName}</title>
</svelte:head>

<ListLocations locations={locations} />

<Article breadcrumbs={[
	{ label: "Locations", href: null }
]}>

	<Header
		eyebrow="Dashboard"
		heading="Locations"
	/>

	<p>This page should display a dashboard specifically for locations.</p>

</Article>