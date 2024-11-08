<script context="module">
	export { default as layout } from "@/Layouts/App.svelte";
</script>

<script>
	import { page, useForm } from "@inertiajs/svelte";
	import { EllipsisVertical, Trash2 } from "lucide-svelte";
	import Article from '@/Components/Article.svelte';
	import Breadcrumbs from '@/Components/Breadcrumbs.svelte';
	import Button from '@/Components/Button.svelte';
	import Dropdown from '@/Components/Dropdown.svelte';
	import FormInput from '@/Components/FormInput.svelte';
	import FormSelect from '@/Components/FormSelect.svelte';
	import Header from '@/Components/Header.svelte';
	import Icon from '@/Components/Icon.svelte';
	import ListLocations from '@/Components/ListLocations.svelte';

	export let locations;
	export let location;

	let form = useForm({
			image: location.image,
			name: location.name,
			description: location.description,
			_method: 'patch'
	});

	function submit() {
		$form.post(
			'/locations/' + location.slug);
	}
</script>

<svelte:head>
	<title>Edit Faction</title>
</svelte:head>

<ListLocations locations={locations} />

<Article breadcrumbs={[
	{ label: "Locations", href: "/locations" },
	{ label: location.name, href: `/locations/${location.slug}` },
	{ label: "Edit", href: null }
]}>

	<Header
		eyebrow="Edit Location"
		heading={location.name}
	/>

	<form on:submit|preventDefault={submit} enctype="multipart/form-data" class="flex flex-col gap-6 max-w-96">

		<FormInput
			name="Avatar"
			type="file"
			bind:value={$form.image}
			class="row-span-4"
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
			type="submit"
			text="Update Location"
			disabled={$form.processing}
			class="button-primary"
		/>

	</form>

	{#if $page.props.auth.user}
		<Dropdown
			class="absolute top-4 right-4"
			items={[
				{ icon: Trash2, label: "Delete", click: (e) => submit(e), class: "text-rose-600" }
			]}
		>
			<div slot="trigger" class="inline-flex items-center justify-center p-2 rounded-full hover:bg-emerald-500/35">
				<Icon name={EllipsisVertical} size={20} stroke={1.25} />
			</div>
		</Dropdown>
	{/if}
</Article>