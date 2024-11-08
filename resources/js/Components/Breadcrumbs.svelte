<script>
	import { Link } from "@inertiajs/svelte";
	export let crumbs = [];
	export let separator = '/';
</script>

<div class="breadcrumbs flex items-baseline gap-3 mb-4">
	{#each crumbs as crumb, index}

		{#if crumb.href}
			<Link
				href={crumb.href}
				class="text-emerald-400 rounded border-emerald-400 hover:bg-emerald-100 hover:text-emerald-500 px-3 py-1 transition-colors"
			>
				{crumb.label}
			</Link>
		{:else}
			<span class="px-3 py-1">{crumb.label}</span>
		{/if}

		{#if index < crumbs.length-1}
			<span class="text-slate-200">{separator}</span>
		{/if}
		
	{/each}
</div>