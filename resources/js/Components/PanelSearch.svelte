<script>
	export let placeholder;
	export let query = '';
</script>

<div class="flex flex-shrink-0 w-full gap-1 p-1 pr-2 items-center justify-start border-b border-slate-200 dark:border-slate-700">
	<input
		class="input h-12 w-full border border-slate-200 dark:border-slate-700 flex-shrink-1 rounded-lg px-2 flex-shrink-1 shadow-inner"
		bind:value={query}
		placeholder={placeholder || "Search..."}
		type="search"
	/>
</div>