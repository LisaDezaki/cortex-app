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
	import ListFactions from "@/Components/ListFactions.svelte";

	export let characters;
	export let factions;

	let form = useForm({
		image: null,
		name: null,
		description: null,
		characters: [],
	});

	function submit() {
		$form.post('/factions');
	}
</script>

<svelte:head>
	<title>{$page.props.appName} / Create</title>
</svelte:head>

<ListFactions factions={factions} />

<Article breadcrumbs={[
	{ label: "Factions", href: "/factions" },
	{ label: "Create", href: null }
]}>

	<Header
		eyebrow="Create Faction"
		heading="New Faction"
	/>

	<form on:submit|preventDefault={submit} enctype="multipart/form-data" class="flex flex-col gap-6">

		<FormInput
			name="Name"
			type="text"
			bind:value={$form.name}
			placeholder="Name"
			error={$form.errors.name}
		/>

		<FormInput
			name="Image"
			type="file"
			bind:value={$form.image}
			class="row-span-3"
			error={$form.errors.image}
		/>

		<FormInput
			name="Description"
			type="textarea"
			bind:value={$form.description}
			placeholder="Description"
			error={$form.errors.description}
		/>

		<!--
		TODO:	> Button to add a Faction Member.
				> Opens a modal
				> Select the character and type their role in the faction
				> Confirm and save, then do it again for every member
		-->

		<FormSelect
			name="Members"
			bind:value={$form.characters}
			placeholder="Add characters"
			error={$form.errors.characters}
			multiple={true}
			options={characters.map((c) => {
				return { value: c.id, label: c.name }
			})}
		/>

		<Button
			type="submit"
			text="Create Faction"
			disabled={$form.processing}
			class="bg-emerald-500 text-white col-span-1 mt-4"
		/>

	</form>
</Article>