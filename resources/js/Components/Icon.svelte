<script>
	export let name;
	export let size;
	export let stroke;
</script>

<svelte:component this={name} class="flex-shrink-0" size={size} strokeWidth={stroke} />