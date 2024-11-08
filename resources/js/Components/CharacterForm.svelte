<script>
	import { page, useForm } from "@inertiajs/svelte";
	import { Dialog } from "bits-ui";
	import Button from '@/Components/Button.svelte';
	import CustomField from '@/Components/CustomField.svelte';
	import CustomFieldButton from '@/Components/CustomFieldButton.svelte';
	import Dropdown from '@/Components/Dropdown.svelte';
	import FormInput from '@/Components/FormInput.svelte';
	import FormSelect from '@/Components/FormSelect.svelte';
	import Header from '@/Components/Header.svelte';
	import Icon from '@/Components/Icon.svelte';
	import ListCharacters from '@/Components/ListCharacters.svelte';

	let componentClass;
	export { componentClass as class };
	export let character;
	export let locations;

	let form = useForm({
		image: 		 character ? character.image : null,
		name:  		 character ? character.name  : null,
		alias: 		 character ? character.alias : null,
		description: character ? character.description : null,
		role: 		 character ? character.role : null,
		home: 		 character && character.location_id_home ? locations.map((loc) => {
			return { value: loc.id, label: loc.name }
		}).filter((loc) => loc.value === character.location_id_home)[0] : null,
		work: 		 character && character.location_id_home ? locations.map((loc) => {
			return { value: loc.id, label: loc.name }
		}).filter((loc) => loc.value === character.location_id_work)[0] : null,
		customFields: character && character.custom_fields ? character.custom_fields : [],
		_method: 'patch'
	});

	$: create = $page.url.includes('/create');

	function submit() {
		if ( create ) {
			$form.post('/characters');
		} else {
			$form.post('/characters/' + character.slug);
		}
	}

	console.log($page.props.project);

</script>

<form
	on:submit|preventDefault={submit}
	enctype="multipart/form-data"
	class="flex flex-col gap-6 max-w-[60ch] {componentClass}"
>
	<FormInput
		name="Avatar"
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
		name="Alias"
		type="text"
		bind:value={$form.alias}
		placeholder="Alias"
		error={$form.errors.alias}
	/>

	<FormSelect
		name="Home"
		bind:value={$form.home}
		placeholder="Home Location"
		error={$form.errors.home}
		options={locations.map((loc) => {
			return { value: loc.id, label: loc.name }
		})}
	/>

	<FormInput
		name="Role"
		type="text"
		bind:value={$form.role}
		placeholder="Role"
		error={$form.errors.role}
	/>

	<FormSelect
		name="Work"
		bind:value={$form.work}
		placeholder="Work Location"
		error={$form.errors.work}
		options={locations.map((loc) => {
			return { value: loc.id, label: loc.name }
		})}
	/>

	<FormInput
		name="Description"
		type="textarea"
		bind:value={$form.description}
		placeholder="Description"
		error={$form.errors.description}
	/>

	{#each $page.props.project.customFields as field, index}

		{#if field.type == 'select'}
			<FormSelect
				name={field.name}
				bind:value={$form.customFields[field.name]}
				type="select"
				placeholder={field.placeholder || field.name}
				options={field.options.map((opt) => {
					return { value: opt.id, label: opt.value }
				})}
			/>
		{/if}

	{/each}

	<div class="flex gap-4 mb-8">
		<CustomFieldButton
			table="characters"
		/>
	
		<Button
			type="submit"
			text={`${create ? 'Create' : 'Update'} Character`}
			disabled={$form.processing}
			class="button-primary self-center"
		/>
	</div>


</form>