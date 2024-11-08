<script context="module">
	export { default as layout } from "@/Layouts/App.svelte";
</script>

<script>
	import { page, useForm } from "@inertiajs/svelte";
	import Article from '@/Components/Article.svelte';
	import Breadcrumbs from '@/Components/Breadcrumbs.svelte';
	import Button from '@/Components/Button.svelte';
	import FormInput from '@/Components/FormInput.svelte';
	import PanelUser from '@/Components/PanelUser.svelte';

	export let project;

	let form = useForm({
			name: project.name,
			description: project.description,
			image: null,
			_method: 'patch'
	});

	function submit() {
		$form.post(`/user/projects/${project.id}`);
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
		{ label: project.name, href: `/user/projects/${project.id}` },
		{ label: "Edit", href: null }
	]} />

	<form on:submit|preventDefault={submit} class="flex flex-col items-start gap-4">

		<FormInput
			class="aspect-video row-span-2"
			name="Image"
			type="file"
			bind:value={$form.image}
			placeholder={project.image}
			error={$form.errors.image}
		/>

		<FormInput
			name="Name"
			type="text"
			bind:value={$form.name}
			placeholder="Name"
			error={$form.errors.name}
		/>

		<FormInput
			name="Description"
			type="textarea"
			bind:value={$form.description}
			placeholder="Description"
			error={$form.errors.description}
		/>

		<Button
			class="bg-brand text-white"
			disabled={$form.processing}
			text="Update Project"
			type="submit"
		/>

		<!-- <div class="mb-3">
				<input type="text" bind:value={$form.name} placeholder="Name" class="input input-bordered w-full">
				{#if $form.errors.title}
						<div class="text-error font-bold text-sm mt-1">{$form.errors.title}</div>
				{/if}
		</div>
		<div class="mb-3">
				<textarea bind:value={$form.description} rows="10" placeholder="Description" class="textarea textarea-bordered w-full" />
		</div>
		<button type="submit" class="btn btn-primary" disabled={$form.processing}>Save</button> -->
	</form>
</Article>

<!-- <div class="p-4">
	<h2 class="text-2xl mb-4">Edit Project</h2>

	<form on:submit|preventDefault={submit}>
		<div class="mb-3">
				<input type="text" bind:value={$form.name} placeholder="Name" class="input input-bordered w-full">
				{#if $form.errors.title}
						<div class="text-error font-bold text-sm mt-1">{$form.errors.title}</div>
				{/if}
		</div>
		<div class="mb-3">
				<textarea bind:value={$form.description} rows="10" placeholder="Description" class="textarea textarea-bordered w-full" />
		</div>
		<button type="submit" class="btn btn-primary" disabled={$form.processing}>Save</button>
	</form>
</div> -->