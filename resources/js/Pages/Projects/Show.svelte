<script context="module">
	export { default as layout } from "@/Layouts/App.svelte";
</script>

<script>
	import { page, useForm } from "@inertiajs/svelte";
	import { PencilRuler, Trash2 } from "lucide-svelte";
	import Article from '@/Components/Article.svelte';
	import Breadcrumbs from '@/Components/Breadcrumbs.svelte';
	import Button from '@/Components/Button.svelte';
	import PanelUser from '@/Components/PanelUser.svelte';

	export let project;

	let form = useForm();
	function submit(e) {
		$form.delete(`/user/projects/${project.id}`);
	}
</script>

<svelte:head>
	<title>{$page.props.appName}</title>
</svelte:head>

<PanelUser />

<Article>
	<Breadcrumbs crumbs={[
		{ label: "User", href: null },
		{ label: "Projects", href: "/user/projects" },
		{ label: project.name, href: null }
	]} />

	<div
		class="flex items-center justify-center  aspect-video overflow-hidden
					max-w-96 mb-4 rounded-lg"
	>
		<img class="min-h-full min-w-full" src={project.image} alt={project.name} />
	</div>
	<h1 class="text-4xl mb-4">{project.name}</h1>
	<p>{project.description}</p>

	{#if $page.props.auth.user}
		<div class="absolute top-0 right-0 inline-flex items-center gap-1 p-3">
			<Button
				class="bg-blue-500 text-white"
				icon={PencilRuler}
				text="Edit"
				href="/user/projects/{project.id}/edit"
			/>
		
			<Button
				class="bg-red-500 text-white"
				icon={Trash2}
				text="Delete"
				click={submit}
				inertiaObject={{ method:'delete', href:`/user/projects/${project.id}` }}
			/>
		</div>
	{/if}

</Article>