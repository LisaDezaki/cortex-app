<script>
	import { page } from '@inertiajs/svelte';
	import { CircleUser, Cog, Earth, LogOut, TextCursorInput } from "lucide-svelte";
	import Avatar from '@/Components/Avatar.svelte';
	import NavList from '@/Components/NavList.svelte';
	import NavLink from '@/Components/NavLink.svelte';

</script>

<div class="flex flex-col flex-shrink-0 py-2 w-52 overflow-hidden border-r border-slate-200 dark:border-slate-700">

	<div class="flex flex-col mx-auto my-6 w-full overflow-hidden px-4">
		<Avatar editable
			class="mx-auto w-32"
			src={$page.props.auth.user.avatar}
			alt={$page.props.auth.user.name}
		/>
		<h2 class="text-center w-full">{$page.props.auth.user.name}</h2>
		<p class="text-center text-sm italic text-slate-400 truncate w-full">{$page.props.auth.user.email}</p>
	</div>

	<NavList class="flex-shrink overflow-y-auto">

		<NavLink
			active={[
				$page.url == `/user/profile`,
			]}
			class="panel-link"
			href={`/user/profile`}
			icon={CircleUser}
			label="Profile"
		/>

		<NavLink
			active={[
				$page.url.startsWith(`/user/projects`),
			]}
			class="panel-link"
			href={`/user/projects`}
			icon={Earth}
			label="Projects"
		/>

		<NavLink
			active={[
				$page.url == `/user/fields`,
			]}
			class="panel-link"
			icon={TextCursorInput}
			href={`/user/fields`}
			label="Custom Fields"
		/>

		<NavLink
			active={[
				$page.url == `/user/settings`,
			]}
			class="panel-link"
			href={`/user/settings`}
			icon={Cog}
			label="Settings"
		/>

		<NavLink
			class="panel-link text-red-500"
			inertia={{ href:'/logout', method:'post' }}
			icon={LogOut}
			label="Logout"
		/>

	</NavList>
</div>