<script>

	import { Link } from "@inertiajs/svelte";
	import Icon from '@/Components/Icon.svelte';

	let componentClass;
	let iconName;

	export let click;
	export let href;
	export let text;
	export let type;
	export { componentClass as class };
	export { iconName as icon };

</script>

{#if href}

	<Link {href}
		class="button {componentClass}"
	>
		<Icon
			name={iconName}
			size={20}
			stroke={2.25}
		/>

		{text}
	</Link>

{:else}

	<button {type}
		on:click={click}
		class="button {componentClass}"
	>
		<Icon
			name={iconName}
			size={20}
			stroke={2.25}
		/>
		{#if text}
			{text}
		{/if}
		<slot />
	</button>

{/if}