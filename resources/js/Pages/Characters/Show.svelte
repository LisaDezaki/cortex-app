<script context="module">
	export { default as layout } from "@/Layouts/App.svelte";
</script>

<script>
	import { Link, page, useForm } from "@inertiajs/svelte";
	import { BriefcaseBusiness, CirclePlus, CircleUser, EllipsisVertical, House, Trash2, PencilRuler } from "lucide-svelte";
	import Article from "@/Components/Article.svelte";
	import Avatar from "@/Components/Avatar.svelte";
	import Breadcrumbs from "@/Components/Breadcrumbs.svelte";
	import Card from "@/Components/Card.svelte";
	import CharacterForm from "@/Components/CharacterForm.svelte";
	import Container from "@/Components/Container.svelte";
	import Dropdown from "@/Components/Dropdown.svelte";
	import Header from "@/Components/Header.svelte";
	import Icon from "@/Components/Icon.svelte";
	import ListCharacters from "@/Components/ListCharacters.svelte";
	import ResourceActions from "@/Components/ResourceActions.svelte";

	export let characters;
	export let character;

	let form = useForm();

</script>

<svelte:head>
	<title>{character.name}</title>
</svelte:head>

<ListCharacters characters={characters} />

<Article breadcrumbs={[
	{ label: "Characters", href: "/characters" },
	{ label: character.name, href: null }
]}>
	<Header
		eyebrow="Character"
		heading={character.name}
		subheading={character.alias}
	>
		<Avatar
			slot="avatar"
			class="h-40 w-40 ml-auto bg-emerald-100"
			src={character.image}
			alt={character.name}
		/>

		{#if character.work}
		<div class="flex gap-2 items-center mt-4">
			<Icon name={BriefcaseBusiness} size={20} stroke={1.25} />
			<Link class="border-b font-medium text-emerald-400" href="/locations/{character.work.slug}">{character.work.name}</Link>
		</div>
		{/if}

		{#if character.home}
		<div class="flex gap-2 items-center">
			<Icon name={House} size={20} stroke={1.25} />
			<Link class="border-b font-medium text-emerald-400" href="/locations/{character.home.slug}">{character.home.name}</Link>
		</div>
		{/if}

	</Header>

	<h6 class="heading h6 text-emerald-400">Description</h6>
	<p>{character.description}</p>

	{#if character.factions}
	<h6 class="heading h6 text-emerald-400">Factions:</h6>
	<div class="grid grid-cols-4 gap-2">
		{#each character.factions as faction}
		<Card class="flex flex-col items-center p-6 hover:shadow-md transition-shadow">
			<Avatar src={faction.image} alt={faction.name} class="w-24 mb-2" />
			<p class="heading h5 leading-5 text-center">{faction.name}</p>
			<p class="font-medium italic text-slate-500/50">{faction.pivot.role}</p>
			<Link class="absolute inset-0" href="/factions/{faction.slug}"></Link>
		</Card>
		{/each}
	</div>
	{/if}

	<ResourceActions
		create="/characters/create"
		edit="/characters/{character.slug}/edit"
		delete={() => {
			$form.delete(`/characters/${character.slug}`)
		}}
	/>

</Article>