<script>
	import { useForm } from "@inertiajs/svelte";
	import { Dialog } from "bits-ui";
	import Button from '@/Components/Button.svelte';
	import FormInput from '@/Components/FormInput.svelte';
	import FormSelect from '@/Components/FormSelect.svelte';

	export let table;

	let form = useForm({
		table: table,
		type: null,
		name: '',
		placeholder: ''
	});

	function submit() {
		$form.post('/custom_fields');
	}
</script>

<Dialog.Root>
	<Dialog.Trigger class="button button-secondary self-center">
		Add Custom Field
	</Dialog.Trigger>
	<Dialog.Portal>
		<Dialog.Overlay class="fixed inset-0 z-25 bg-black/80" />
		<Dialog.Content class="card fixed left-[50%] top-[50%] z-25 translate-x-[-50%] translate-y-[-50%] bg-gray-50 w-full max-w-md shadow-popover outline-none flex flex-col items-center">
			<Dialog.Title class="heading h4">Add New Custom Field</Dialog.Title>
			<Dialog.Description>Create your own custom field. It will be specific to this entity and project.</Dialog.Description>
			
			<form
				on:submit|preventDefault={submit}
				enctype="multipart/form-data"
				class="flex flex-col items-stretch gap-6 my-4 w-full mx-auto"
			>
				<FormSelect
					name="Custom Field Type"
					placeholder="Select an option"
					bind:value={$form.type}
					options={[
						{ value: 'select', label: 'Select' },
						{ value: 'text', label: 'Text' }
					]}
					type="text"
				/>

				<FormInput
					name="Custom Field Name"
					placeholder="e.g, Species"
					bind:value={$form.name}
					type="text"
				/>

				<FormInput
					name="Custom Field Placeholder"
					placeholder="e.g, 'Select an option'"
					bind:value={$form.placeholder}
					type="text"
				/>

				<div class="flex items-center justify-center gap-4 mt-4">
					<Dialog.Close class="button button-secondary">Cancel</Dialog.Close>
					<Button class="button-primary" type="submit" text="Create Custom Field" />
				</div>
			</form>

		</Dialog.Content>
	</Dialog.Portal>
</Dialog.Root>