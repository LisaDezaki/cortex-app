<script>
	export let error;
</script>

{#if error}
	<div class=" absolute bottom-0 text-error text-sm font-bold mt-1">{error}</div>
{/if}