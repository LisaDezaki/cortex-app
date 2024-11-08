<script>
	import { Link, page } from '@inertiajs/svelte';
	import { MoveRight, Plus } from 'lucide-svelte';
	import NavList from '@/Components/NavList.svelte';
	import NavLink from '@/Components/NavLink.svelte';
	import PanelSearch from '@/Components/PanelSearch.svelte';
	export let characters;

	let query = '';
	let filteredItems = [];
	$: filteredItems = characters.filter(item => item && item.slug.toLowerCase().includes(query.toLowerCase()));

</script>

<div class="flex flex-col flex-shrink-0 w-52 overflow-hidden border-r border-slate-200 dark:border-slate-700">

	<PanelSearch bind:query={query} placeholder="Search characters... " />

	{#if filteredItems.length != 0 }
		<NavList class="flex-shrink overflow-y-auto py-1">
			{#each filteredItems as character}
				<NavLink
					active={[
						$page.url == `/characters/${character.slug}`,
						$page.url == `/characters/${character.slug}/edit`
					]}
					class="panel-link"
					href={`/characters/${character.slug}`}
				>
					{character.name}
				</NavLink>
			{/each}
		</NavList>
	{/if}

</div>