<script context="module">
	export { default as layout } from "@/Layouts/App.svelte";
</script>

<script>
	import { page } from "@inertiajs/svelte";
	import Article from '@/Components/Article.svelte';
	import Breadcrumbs from '@/Components/Breadcrumbs.svelte';
	import Header from '@/Components/Header.svelte';
	import ListFactions from '@/Components/ListFactions.svelte';
	export let factions;
</script>

<svelte:head>
	<title>{$page.props.appName}</title>
</svelte:head>

<ListFactions factions={factions} />

<Article breadcrumbs={[
	{ label: "Factions", href: null }
]}>

	<Header
		eyebrow="Dashboard"
		heading="Factions"
	/>

	<p class="text-lg">This page should display a dashboard specifically for factions.</p>

</Article>