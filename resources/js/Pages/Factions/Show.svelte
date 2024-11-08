<script context="module">
	export { default as layout } from "@/Layouts/App.svelte";
</script>

<script>
	import { Link, page, useForm } from "@inertiajs/svelte";
	import { BriefcaseBusiness, CircleUser, EllipsisVertical, House, PencilRuler, Trash2 } from "lucide-svelte";
	import Article from "@/Components/Article.svelte";
	import Avatar from "@/Components/Avatar.svelte";
	import Breadcrumbs from "@/Components/Breadcrumbs.svelte";
	import Card from "@/Components/Card.svelte";
	import Dropdown from "@/Components/Dropdown.svelte";
	import Header from "@/Components/Header.svelte";
	import Icon from "@/Components/Icon.svelte";
	import ListFactions from "@/Components/ListFactions.svelte";
	import ResourceActions from "@/Components/ResourceActions.svelte";

	export let factions;
	export let faction;

	let form = useForm();
	function submit(e) {
		$form.delete(`/characters/${character.slug}`);
	}
	
</script>

<svelte:head>
	<title>{faction.name}</title>
</svelte:head>

<ListFactions factions={factions} />

<Article breadcrumbs={[
	{ label: "Factions", href: "/factions" },
	{ label: faction.name, href: null }
]}>

	<Header
		eyebrow="Faction"
		heading={faction.name}
	>
		<Avatar slot="avatar"
			class="h-32 w-32 ml-auto bg-emerald-100"
			src={faction.image}
			alt={faction.name}
		/>
	</Header>

	<p class="font-medium text-emerald-500 my-4">Description:</p>
	<p>{faction.description}</p>

	{#if faction.members}
		<p class="font-medium text-emerald-500 my-4">Members:</p>
		<div class="grid grid-cols-4 gap-2">
			{#each faction.members as character}
				<Card class="flex flex-col items-center p-6 hover:shadow-md transition-shadow">
					<Avatar src={character.image} alt={character.name} class="w-24 mb-4" />
					<p class="font-medium text-center text-xl">{character.name}</p>
					<p class="font-medium italic leading-4 text-center text-black/35">{character.pivot.role}</p>
					<Link class="absolute inset-0" href={`/characters/${character.slug}`}></Link>
				</Card>
			{/each}
		</div>
	{/if}

	{#if $page.props.auth.user}
		<ResourceActions
			create="/factions/create"
			edit="/factions/{faction.slug}/edit"
			delete={() => {
				$form.delete(`/factions/${faction.slug}`)
			}}
		/>
	{/if}
</Article>