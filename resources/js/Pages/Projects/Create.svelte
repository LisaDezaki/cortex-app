<script context="module">
	export { default as layout } from "@/Layouts/App.svelte";
</script>

<script>
	import { useForm } from "@inertiajs/svelte";
	import Article from '../../Components/Article.svelte';
	import Breadcrumbs from '../../Components/Breadcrumbs.svelte';
	import Button from '../../Components/Button.svelte';
	import FormInput from '../../Components/FormInput.svelte';
	import PanelUser from '../../Components/PanelUser.svelte';
	// import NavList from '../../Components/NavList.svelte';
	// import NavLink from '../../Components/NavLink.svelte';
	// import Panel from '../../Components/Panel.svelte';

	let form = useForm({
			image: null,
			name: null,
			description: null
	});

	function submit() {
			$form.post('/user/projects');
	}
</script>

<svelte:head>
	<title>New Project</title>
</svelte:head>

<PanelUser />

<Article>
	<Breadcrumbs crumbs={[
		{ label: "User", href: null },
		{ label: "Projects", href: "/user/projects" },
		{ label: "Create", href: null }
	]} />

	<form on:submit|preventDefault={submit} class="max-w-80">

		<FormInput
			name="Image"
			type="file"
			bind:value={$form.image}
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
			text="Create Project"
			type="submit"
		/>

	</form>
</Article>

<!-- <div class="p-4">
	<h2 class="text-2xl mb-4">New Project</h2>

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