<script context="module">
	export { default as layout } from "@/Layouts/App.svelte";
</script>

<script>
	import { page, useForm } from "@inertiajs/svelte";
	import { EllipsisVertical, Trash2 } from "lucide-svelte";
	import Article from '@/Components/Article.svelte';
	import CharacterForm from '@/Components/CharacterForm.svelte';
	import Dropdown from '@/Components/Dropdown.svelte';
	import Header from '@/Components/Header.svelte';
	import Icon from '@/Components/Icon.svelte';
	import ListCharacters from '@/Components/ListCharacters.svelte';
	import ResourceActions from '@/Components/ResourceActions.svelte';

	export let characters;
	export let character;
	export let locations;

	let form = useForm({
		image: character.image,
		name: character.name,
		alias: character.alias,
		description: character.description,
		role: character.role,
		home: character.location_id_home ? locations.map((loc) => {
			return { value: loc.id, label: loc.name }
		}).filter((loc) => loc.value === character.location_id_home)[0] : null,
		work: character.location_id_home ? locations.map((loc) => {
			return { value: loc.id, label: loc.name }
		}).filter((loc) => loc.value === character.location_id_work)[0] : null,
		_method: 'patch'
	});

	function submit() {
		$form.post(
			'/characters/' + character.slug);
	}
</script>

<svelte:head>
	<title>Edit Character</title>
</svelte:head>

<ListCharacters characters={characters} />

<Article breadcrumbs={[
	{ label: "Characters", href: "/characters" },
	{ label: character.name, href: `/characters/${character.slug}` },
	{ label: "Edit", href: null }
]}>

	<Header
		eyebrow="Edit Character"
		heading={character.name}
	/>

	<CharacterForm
		character={character}
		locations={locations}
	/>

	{#if $page.props.auth.user}
		<ResourceActions
			create="/characters/create"
			delete={() => {
				$form.delete(`/characters/${character.slug}`)
			}}
		/>
	{/if}
</Article>