<script context="module">
	export { default as layout } from "@/Layouts/App.svelte";
</script>

<script>
	import { Link, page, useForm } from "@inertiajs/svelte";
	import { Check, ClipboardPlus } from "lucide-svelte";
	import Article from '@/Components/Article.svelte';
	import Breadcrumbs from '@/Components/Breadcrumbs.svelte';
	import Button from '@/Components/Button.svelte';
	import Card from '@/Components/Card.svelte';
	import Header from '@/Components/Header.svelte';
	import Icon from '@/Components/Icon.svelte';
	import PanelUser from '@/Components/PanelUser.svelte';

	export let projects;

	let dialog;
	let project;
	let form = useForm();

	$: active = (id) => {
		return $page.props.active_project_id && $page.props.active_project_id == id;
	}

	function activate(p) {
		$form.patch(`/user/projects/${p.id}/activate`);
	}

	function destroy(p) {
		project = p;
		dialog.showModal();
	}

	function submit() {
		$form.delete(`/projects/${project.id}`);
		dialog.close();
	}
</script>

<svelte:head>
	<title>{$page.props.appName}</title>
</svelte:head>

<PanelUser />

<Article breadcrumbs={[
	{ label: "User", href: null },
	{ label: "Projects", href: null }
]}>

	<Header
		eyebrow="User"
		heading="Projects"
	/>

	{#if projects}
		<div class="grid gap-4 items-center">

			{#each projects as project}
				<Card class="h-40 flex {project.image ? "border-0" : ""}" href="/user/projects/{project.id}">

					{#if project.image}
						<img class="absolute min-h-full min-w-full" src={project.image} alt={project.name} />
					{/if}

					{#if active(project.id)}
						<div class="absolute top-0 right-0 h-8 px-2
							inline-flex items-center justify-center gap-2
							bg-emerald-500 text-white rounded-bl-lg"
						>
							<Check size={20} />Active
						</div>
					{/if}

					<div class="flex px-4 py-2 relative text-white">
						<h4 class="heading h3">{project.name}</h4>
					</div>

				</Card>
			{/each}

			<Card class="h-40 flex items-center justify-center" href="/user/projects/create">

				<Button
					class="button-primary"
					href="/user/projects/create"
					icon={ClipboardPlus}
					text="New project"
				/>
			</Card>

		</div>
	{/if}
</Article>