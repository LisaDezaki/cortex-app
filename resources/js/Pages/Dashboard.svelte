<script context="module">
	export { default as layout } from "@/Layouts/App.svelte";
</script>

<script>
	import { page } from "@inertiajs/svelte";
	import { BriefcaseBusiness, House } from "lucide-svelte";
	import Article from '@/Components/Article.svelte';
	import Avatar from '@/Components/Avatar.svelte';
	import Breadcrumbs from '@/Components/Breadcrumbs.svelte';
	import Card from '@/Components/Card.svelte';
	import Header from '@/Components/Header.svelte';
</script>

<svelte:head>
	<title>{$page.props.appName}</title>
</svelte:head>

<Article breadcrumbs={[
	{ label: "Dashboard", href: null }
]}>

	<Header
		eyebrow="Dashboard"
		heading="Recent Activity"
	/>

	{#if $page.props.project && $page.props.recent_characters}
		<section>
			<h3 class="heading h3">Recently created {$page.props.project.name} characters:</h3>
			<div class="flex items-center justify-start gap-4 py-6 overflow-x-scroll">
				{#each $page.props.recent_characters as character}
				<Card
					class="flex flex-col items-stretch justify-start p-2
								min-h-40 h-40 max-h-40
								min-w-72 w-72 max-w-72"
				>
					<div class="flex items-start justify-start gap-4 p-4 w-100">

						<Avatar
							class="w-24 mb-4"
							src={character.image}
							alt={character.name}
						/>

						<div>
							<h4 class="heading h4 -mt-2 mb-0">{character.name}</h4>
							<p class="italic opacity-50 -mt-2 mb-2">{character.alias}</p>
							<div class="flex gap-2 items-center">
								<BriefcaseBusiness class="flex-shrink-0" size={20} strokeWidth={1} />
								<p class="truncate">{character.role} @ {character.work}</p>
							</div>
							<div class="flex gap-2 items-center">
								<House class="flex-shrink-0" size={20} strokeWidth={1} />
								<p class="truncate">{character.home}</p>
							</div>
						</div>

					</div>
					<p class="absolute bottom-0 left-0 right-0 p-1 text-center text-xs opacity-25">Created {character.created_at_human}</p>
				</Card>
				{/each}
			</div>
		</section>
	{/if}

	{#if $page.props.project && $page.props.recent_locations}
		<section>
			<h3 class="heading h3">Recently created {$page.props.project.name} locations:</h3>
			<div class="flex items-center justify-start gap-4 py-2 overflow-x-scroll">
				{#each $page.props.recent_locations as location}
					<Card
						class="flex flex-col items-stretch justify-start p-2
									min-h-40 h-40 max-h-40
									min-w-72 w-72 max-w-72"
					>
						<img class="absolute inset-0 min-h-full object-cover" src={location.image} alt={location.name} />
						<div class="absolute bottom-0 heading h4 text-white">{location.name}</div>
					</Card>
				{/each}
			</div>
		</section>
	{/if}

</Article>