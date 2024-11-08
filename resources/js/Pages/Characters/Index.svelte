<script context="module">
	export { default as layout } from "@/Layouts/App.svelte";
</script>

<script>
	import { page } from "@inertiajs/svelte";
	import Article from '@/Components/Article.svelte';
	import Breadcrumbs from '@/Components/Breadcrumbs.svelte';
	import Container from '@/Components/Container.svelte';
	import Header from '@/Components/Header.svelte';
	import ListCharacters from '@/Components/ListCharacters.svelte';
	import ResourceActions from '@/Components/ResourceActions.svelte';
	export let characters;
</script>

<svelte:head>
	<title>{$page.props.appName}</title>
</svelte:head>

<ListCharacters characters={characters} />

<Article breadcrumbs={[
	{ label: "Characters", href: null }
]}>

	<Header
		eyebrow="Dashboard"
		heading="Characters"
	/>

	<p class="text-lg">This page should display a dashboard specifically for characters.</p>

	{#if $page.props.auth.user}
		<ResourceActions
			create="/characters/create"
		/>
	{/if}

</Article>