<script context="module">
	export { default as layout } from "@/Layouts/App.svelte";
</script>

<script>
	import { page, useForm } from "@inertiajs/svelte";
	import { ImageUp } from "lucide-svelte";
	import Article from "@/Components/Article.svelte";
	import Breadcrumbs from "@/Components/Breadcrumbs.svelte";
	import Button from "@/Components/Button.svelte";
	import ErrorText from "@/Components/ErrorText.svelte";
	import FormInput from "@/Components/FormInput.svelte";
	import FormSelect from "@/Components/FormSelect.svelte";
	import Header from "@/Components/Header.svelte";
	import ListLocations from "@/Components/ListLocations.svelte";

	export let locations;

	let form = useForm({
		image: null,
		name: null,
		description: null,
	});

	function submit() {
		$form.post('/locations');
	}
</script>

<svelte:head>
	<title>{$page.props.appName} / Create</title>
</svelte:head>

<ListLocations locations={locations} />

<Article breadcrumbs={[
	{ label: "Locations", href: "/locations" },
	{ label: "Create", href: null }
]}>

	<Header
		eyebrow="Create Faction"
		heading="New Location"
	/>

	<form on:submit|preventDefault={submit} class="flex flex-col gap-6 max-w-96">

		<FormInput
			name="Image"
			type="file"
			bind:value={$form.image}
			class="row-span-3"
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
			text="Create Location"
			disabled={$form.processing}
			class="bg-brand text-white col-span-2 mt-4"
		/>

	</form>
</Article>