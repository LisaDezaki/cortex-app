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
	import ListFactions from '@/Components/ListFactions.svelte';

	export let factions;
	export let characters;
	export let faction;

	let form = useForm({
		image: faction.image,
		name: faction.name,
		description: faction.description,
		members: faction.members.map(c => {
			return { value: c.id, label: c.name }
		}),
		_method: 'patch'
	});

	function submit() {
		$form.post(
			'/factions/' + faction.slug);
	}
</script>

<svelte:head>
	<title>Edit Faction</title>
</svelte:head>

<ListFactions factions={factions} />

<Article breadcrumbs={[
	{ label: "Factions", href: "/factions" },
	{ label: faction.name, href: `/factions/${faction.slug}` },
	{ label: "Edit", href: null }
]}>

	<Header
		eyebrow="Edit Faction"
		heading={faction.name}
	/>

	<form on:submit|preventDefault={submit} enctype="multipart/form-data" class="grid grid-cols-2 gap-6">

		<FormInput
			name="Name"
			type="text"
			bind:value={$form.name}
			placeholder="Name"
			error={$form.errors.name}
		/>

		<FormInput
			name="Avatar"
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

		<FormSelect
			name="Members"
			bind:value={$form.members}
			placeholder="Add characters"
			error={$form.errors.members}
			multiple={true}
			options={characters.map((c) => {
				return { value: c.id, label: c.name }
			})}
		/>

		<Button
			type="submit"
			text="Update Faction"
			disabled={$form.processing}
			class="bg-emerald-500 text-white col-span-1 mt-4"
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