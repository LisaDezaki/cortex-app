<script context="module">
	export { default as layout } from "@/Layouts/App.svelte";
</script>

<script>
		import Article from '@/Components/Article.svelte';
		import Breadcrumbs from '@/Components/Breadcrumbs.svelte';
		import Header from '@/Components/Header.svelte';
		import PanelUser from '@/Components/PanelUser.svelte';
</script>

<svelte:head>
    <title>Settings</title>
</svelte:head>

<PanelUser />

<Article breadcrumbs={[
	{ label: "User", href: null },
	{ label: "Settings", href: null }
]}>

	<Header
		eyebrow="User"
		heading="User Settings"
	/>
	
	The user settings page.
</Article>