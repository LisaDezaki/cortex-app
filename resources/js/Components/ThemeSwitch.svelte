<script>
	import { onMount } from "svelte";
	import { Moon, Sun, SunMoon } from "lucide-svelte";
	import Icon from "@/Components/Icon.svelte";
	let componentClass;
	export { componentClass as class }

	let isDark = localStorage.theme === 'dark' || 
		(!localStorage.theme && window.matchMedia("(prefers-color-scheme: dark)").matches);

	const setTheme = () => {
		if (isDark) {
			document.documentElement.classList.add('dark');
			localStorage.theme = 'dark';
		} else {
			document.documentElement.classList.remove('dark');
			localStorage.theme = 'light';
		}
	};

	const toggleTheme = () => {
		isDark = !isDark;
		setTheme();
	};

	onMount(() => {
		setTheme();
	});

</script>

<button
	on:click={toggleTheme}
	class="button border-0 rounded-full px-1 py-1 w-12
		bg-black/15 text-white hover:text-emerald-500 {componentClass}">
	<div class="{isDark ? "-ml-4" : "ml-4"}  transition-all ease-out duration-300">
		{#if isDark}
			<Moon size={20} strokeWidth={1.25} />
		{:else}
			<Sun size={20} strokeWidth={1.25} />
		{/if}
	</div>
</button>