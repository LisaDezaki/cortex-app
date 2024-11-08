<script>
	import AppNavigation from '@/Components/AppNavigation.svelte';
</script>

<div
	id="wrapper"
	class="flex h-screen max-h-screen w-screen"
>
	<AppNavigation />

	<main class="flex flex-grow overflow-hidden w-full bg-gray-50 text-slate-800 dark:bg-slate-800 dark:text-white">
		<slot />
	</main>

</div>