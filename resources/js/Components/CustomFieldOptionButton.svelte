<script>
	import { useForm } from "@inertiajs/svelte";
	import { Dialog } from "bits-ui";
	import Button from '@/Components/Button.svelte';
	import FormInput from '@/Components/FormInput.svelte';
	import FormSelect from '@/Components/FormSelect.svelte';

	let componentClass;
	export { componentClass as class };
	export let field;
	export let text;

	let form = useForm({
		field: field || null,
		values: [''],
	});

	function addOption() {
		$form.values = [...$form.values, '']
	}

	function submit() {
		$form.post(`/custom_fields/${$form.field.id}`);
	}
</script>

<Dialog.Root>
	<Dialog.Trigger class="button button-secondary self-center {componentClass}">
		{text}
	</Dialog.Trigger>
	<Dialog.Portal>
		<Dialog.Overlay class="fixed inset-0 z-50 bg-black/80" />
		<Dialog.Content class="fixed left-[50%] top-[50%] z-50 translate-x-[-50%] translate-y-[-50%] rounded-lg border bg-gray-50 px-4 py-4 w-full max-w-md shadow-popover outline-none flex flex-col items-center">
			<Dialog.Title class="heading h4">Add a {field.name} option</Dialog.Title>
			<Dialog.Description>Add new options to this Field</Dialog.Description>
			
			<form
				on:submit|preventDefault={submit}
				enctype="multipart/form-data"
				class="flex flex-col items-stretch gap-4 my-4 w-full mx-auto"
			>
				{#each $form.values as value, index}
					<FormInput
						name="Value {index+1}"
						placeholder="Option {index+1} value"
						bind:value={$form.values[index]}
						type="text"
					/>
				{/each}

				<Button
					class="button-secondary self-center"
					click={addOption}
					text="Add another"
					type="button"
				/>

				<div class="flex items-center justify-center gap-4">
					<Dialog.Close class="button button-secondary">Cancel</Dialog.Close>
					<Button class="button-primary" type="submit" text="Create {$form.values.length} option{$form.values.length > 1 ? 's' : ''}" />
				</div>
			</form>

		</Dialog.Content>
	</Dialog.Portal>
</Dialog.Root>