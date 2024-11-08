<script>
	import { Link, page } from "@inertiajs/svelte";
	import { Backpack, CalendarDays, CircleGauge, ClipboardPlus, Contact, LandPlot, MapPinned, ScrollText, Swords } from "lucide-svelte";
	import Avatar from '@/Components/Avatar.svelte';
	import Button from '@/Components/Button.svelte';
	import NavLink from '@/Components/NavLink.svelte';
	import ProjectSelect from '@/Components/ProjectSelect.svelte';
	import ThemeSwitch from '@/Components/ThemeSwitch.svelte';
</script>

<nav class="flex flex-col flex-grow-0 flex-shrink-0 w-56
		bg-emerald-800 text-slate-800 dark:bg-slate-900 dark:text-white"
>
	<div class="flex px-3 py-2">
		<Link
			class="font-bold text-emerald-500 text-3xl mt-0.5 tracking-[-2.5px] uppercase hover:text-white transition-all hover:tracking-[0]"
			href="/"
		>
			{$page.props.appName}
		</Link>
		{#if $page.props.auth.user}
			<Link
				class="ml-auto"
				href="/user/profile"
			>
				<Avatar class="border border-emerald-400 w-8" src={$page.props.auth.user.avatar} alt={$page.props.auth.user.username} />
			</Link>
		{/if}
	</div>

	{#if $page.props.projects && $page.props.projects.length > 0}
		<ProjectSelect
			active={$page.props.active_project_id}
			class="mx-2 mb-2"
			placeholder="Select Project"
			items={$page.props.projects.map((p) => {
				return {
					value: p.id,
					label: p.name
				}
			})}
		/>

	{:else if $page.props.auth.user}

		<Button
			class="button bg-white text-emerald-400 text-lg"
			href="/user/projects/create"
			icon={ClipboardPlus}
			text="Create a project!"
		/>

	{/if}

	{#if ! $page.props.auth.user}
		<div class="flex flex-col gap-2 px-3">
			<p class="mb-4">A world-building app for tracking characters, factions, items, locations, quests, and more.</p>
			<Link class="button border-emerald-600 text-white bg-emerald-600 px-3 py-1.5 rounded" href="/login">Login</Link>
			<Link class="button border-emerald-600 text-white hover:bg-emerald-600 px-3 py-1.5 rounded" href="/register">Register</Link>
		</div>
	{/if}

	{#if $page.props.active_project_id}
		<ul class="flex flex-col gap-1 text-white">

			<li>
				<NavLink
					active={[$page.url.startsWith("/dashboard")]}
					class="nav-link"
					href="/dashboard"
					icon={CircleGauge}
					label="Dashboard"
				/>
			</li>
			

			<!-- <NavLink
				label="Posts"
				href="/posts"
				active={[$page.url.startsWith("/posts")]}
				icon={ScrollText}
				count={$page.props.count.posts}
			/> -->

			<li>
				<NavLink
					active={[$page.url.startsWith("/characters")]}
					class="nav-link"
					count={$page.props.project.characters.length}
					href="/characters"
					icon={Contact}
					label="Characters"
				/>
			</li>

			<!-- <NavLink
				label="Events"
				href="/events"
				active={[$page.url.startsWith("/events")]}
				icon={CalendarDays}
				count={$page.props.count.events}
			/> -->

			<li>
				<NavLink
					active={[$page.url.startsWith("/factions")]}
					class="nav-link"
					count={$page.props.project.factions.length}
					href="/factions"
					icon={LandPlot}
					label="Factions"
				/>
			</li>

			<li>
				<NavLink
					active={[$page.url.startsWith("/items")]}
					class="nav-link"
					href="/items"
					icon={Backpack}
					label="Items"
				/>
			</li>

			<li>
				<NavLink
					active={[$page.url.startsWith("/locations")]}
					class="nav-link"
					count={$page.props.project.locations.length}
					href="/locations"
					icon={MapPinned}
					label="Locations"
				/>
			</li>

			<li>
				<NavLink
					active={[$page.url.startsWith("/quests")]}
					class="nav-link"
					href="/quests"
					icon={Swords}
					label="Quests"
				/>
			</li>

		</ul>
	{/if}

	<div class="inline-flex items-center justify-end mt-auto p-4 w-full">
		<ThemeSwitch class="ml-auto" />
	</div>

	<!-- <footer class="flex justify-end items-center px-4 py-1.5 text-xs text-emerald-400">
		<p>© Lisa Dezaki { new Date().getFullYear() }</p>
	</footer> -->

</nav>