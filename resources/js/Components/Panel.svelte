<script>
	export let heading
</script>

<div class="flex flex-col py-4 min-w-56 bg-slate-200 dark:bg-slate-800 overflow-y-auto">
	{#if heading}
		<h3 class="px-3 text-2xl text-bold mb-2">{heading}</h3>
	{/if}
	<slot />
</div>