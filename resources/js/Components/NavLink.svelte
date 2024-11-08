<script>
	import { inertia, Link, page } from "@inertiajs/svelte";
	import { MoveRight } from 'lucide-svelte';
	import Count from '@/Components/Count.svelte';
	import Icon from '@/Components/Icon.svelte';
	let componentClass;
	let inertiaObject;
	export { componentClass as class }
	export { inertiaObject as inertia }
	export let active = [];
	// export let activeClass = "";
	export let count;
	export let href;
	export let icon;
	export let label
	export let size;

	$: isActive = active.some(b => b);
</script>

{#if href}

	<Link
		href={href}
		class="{componentClass} {isActive ? "active" : ""}"
	>
		<Icon
			name={icon}
			size={size || 20}
			stroke={active.some(b => b) ? 2.25 : 1.25}
		/>

		{#if label}
			{label}
		{:else}
			<slot />
		{/if}

		{#if count}
			<Count {count} />
		{/if}

		<MoveRight
			class="panel-link-arrow absolute transition-all duration-500
			{ isActive ? "text-emerald-400 right-3" : "text-transparent right-9"}
			"
			size={24}
			strokeWidth={1.15}
		/>

	</Link>

{:else}

	<button
		use:inertia={inertiaObject}
		class="{componentClass} {isActive ? "active" : ""}"
	>

		<Icon
			name={icon}
			size={size || 20}
			stroke={active.some(b => b) ? 2.25 : 1.25}
		/>

		{#if label}
			{label}
		{:else}
			<slot />
		{/if}

		{#if count}
			<Count {count} />
		{/if}

		<MoveRight
			class="panel-link-arrow absolute transition-all duration-500
			{ isActive ? "text-emerald-400 right-3" : "text-transparent right-9"}
			"
			size={24}
			strokeWidth={1.15}
		/>

	</button>

{/if}