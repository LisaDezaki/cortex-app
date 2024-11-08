<script context="module">
	export { default as layout } from "@/Layouts/App.svelte";
</script>

<script>
	import { page } from "@inertiajs/svelte";
	import Article from "@/Components/Article.svelte";
	import Header from "@/Components/Header.svelte";
</script>

<svelte:head>
	<title>{$page.props.appName}</title>
</svelte:head>

<Article>
	<Header
		eyebrow="&nbsp;"
		heading="Welcome."
	/>

	<p class="font-medium text-lg">Welcome to Author. A world-building platform that puts you in control of your own stories.</p>
	
</Article>