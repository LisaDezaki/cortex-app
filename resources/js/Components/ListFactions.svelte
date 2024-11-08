<script>
	import { Link, page } from '@inertiajs/svelte';
	import { MoveRight, Plus } from 'lucide-svelte';
	import NavList from '@/Components/NavList.svelte';
	import NavLink from '@/Components/NavLink.svelte';
	import PanelSearch from '@/Components/PanelSearch.svelte';
	export let factions;

	let query = '';
	let filteredItems = [];
	$: filteredItems = factions.filter(item => item && item.slug.toLowerCase().includes(query.toLowerCase()));

</script>

<div class="flex flex-col flex-shrink-0 w-52 overflow-hidden border-r border-slate-200 dark:border-slate-700">
	
	<PanelSearch bind:query={query} placeholder="Search factions..." />

	{#if filteredItems.length != 0 }
		<NavList class="flex-shrink overflow-y-auto py-1">
			{#each filteredItems as faction}
				<NavLink
					active={[
						$page.url == `/factions/${faction.slug}`,
						$page.url == `/factions/${faction.slug}/edit`
					]}
					class="panel-link"
					href={`/factions/${faction.slug}`}
				>
					{faction.name}
				</NavLink>
			{/each}
		</NavList>
	{/if}

</div>