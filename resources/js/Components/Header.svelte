<script>
	export let eyebrow;
	export let heading;
	export let subheading;
</script>

<slot name="banner" />

<div class="flex mb-6 py-6 overflow-hidden border-b border-emerald-400">

	<div class="flex flex-col gap-2 justify-start items-start truncate">
		<p class="eyebrow heading h6 text-emerald-400 -mb-2">{eyebrow}</p>
		<h1 class="heading h1 whitespace-normal w-full">{heading}</h1>
		{#if subheading}
			<p class="font-semibold italic text-slate-500/50 text-3xl -mt-8">{subheading}</p>
		{/if}
		<slot />
	</div>

	<slot name="avatar" />
</div>