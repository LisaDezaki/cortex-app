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
	import ListLocations from "@/Components/ListLocations.svelte";

	export let locations;
	export let location;

	let form = useForm();
	function submit(e) {
		$form.delete(`/locations/${character.slug}`);
	}
	
</script>

<svelte:head>
	<title>{location.name}</title>
</svelte:head>

<ListLocations locations={locations} />

<Article breadcrumbs={[
	{ label: "Locations", href: "/locations" },
	{ label: location.name, href: null }
]}>

	<Header
		eyebrow="Location"
		heading={location.name}
	>
		<img slot="banner"
			class="rounded-lg h-64 ml-auto object-cover w-full bg-emerald-100"
			src={location.image}
			alt={location.name}
		/>
	</Header>

	{#if location.description}
		<p class="heading h6 text-emerald-400">Description:</p>
		<p>{location.description}</p>
	{/if}

	{#if location.employees.length > 0}
		<p class="heading h6 text-emerald-400">Employees:</p>
		<div class="grid grid-cols-4 gap-2">
			{#each location.employees as character}
				<Card class="flex flex-col items-center p-6 hover:shadow-md transition-shadow">
					<Avatar src={character.image} alt={character.name} class="w-24 mb-4" />
					<p class="font-medium text-center text-xl">{character.name}</p>
					<p class="font-medium italic leading-4 text-center text-black/35">{character.role}</p>
					<Link class="absolute inset-0" href={`/characters/${character.slug}`}></Link>
				</Card>
			{/each}
		</div>
	{/if}

	{#if location.residents.length > 0}
		<p class="heading h6 text-emerald-400">Residents:</p>
		<div class="grid grid-cols-4 gap-2">
			{#each location.residents as character}
				<Card class="flex flex-col items-center p-6 hover:shadow-md transition-shadow">
					<Avatar src={character.image} alt={character.name} class="w-24 mb-4" />
					<p class="font-medium text-center text-xl">{character.name}</p>
					<p class="font-medium italic leading-4 text-center text-black/35">{character.role}</p>
					<Link class="absolute inset-0" href={`/characters/${character.slug}`}></Link>
				</Card>
			{/each}
		</div>
	{/if}

	{#if $page.props.auth.user}
		<Dropdown
			class="absolute top-4 right-4"
			items={[
				{ icon: PencilRuler, label: "Edit", href: `/locations/${location.slug}/edit` },
				{ icon: Trash2, label: "Delete", click: (e) => submit(e), class: "text-rose-600" }
			]}
		>
			<div slot="trigger" class="inline-flex items-center justify-center p-2 rounded-full hover:bg-emerald-500/35">
				<Icon name={EllipsisVertical} size={20} stroke={1.25} />
			</div>
		</Dropdown>
	{/if}
</Article>