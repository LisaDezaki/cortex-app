<script context="module">
	export { default as layout } from "@/Layouts/App.svelte";
</script>

<script>
	import { page, useForm } from "@inertiajs/svelte";
	import Article from "@/Components/Article.svelte";
	import CharacterForm from "@/Components/CharacterForm.svelte";
	import Header from "@/Components/Header.svelte";
	import ListCharacters from "@/Components/ListCharacters.svelte";

	export let characters;
	export let locations;
</script>

<svelte:head>
	<title>{$page.props.appName} / Create</title>
</svelte:head>

<ListCharacters characters={characters} />

<Article breadcrumbs={[
	{ label: "Characters", href: "/characters" },
	{ label: "Create", href: null }
]}>

	<Header
		eyebrow="Create Character"
		heading="New Character"
	/>

	<CharacterForm
		locations={locations}
	/>

</Article>