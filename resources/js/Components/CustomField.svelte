<script>
	import { useForm } from "@inertiajs/svelte";
	import { Combobox } from "bits-ui";
	import { Check } from "lucide-svelte";
	import Button from '@/Components/Button.svelte';
	import CustomFieldOptionButton from '@/Components/CustomFieldOptionButton.svelte';
	import FormInput from '@/Components/FormInput.svelte';
	import FormLabel from '@/Components/FormLabel.svelte';

	let componentClass = '';
	export { componentClass as class }
	export let field;
	export let name;
	export let options;
	export let placeholder;
	export let value;

	let form = useForm({
		name: name || '',
		options: options || [],
		value: value || ''
	});

	function submit() {
		$form.post('/custom_fields');
		// $form.post('/custom_fields/' + field.id);
	}

</script>

<div class="relative input_group text-left {componentClass}">

	{#if name}
		<FormLabel for={name} name={name} />
	{/if}

	<Combobox.Root
		bind:selected={value}
		items={$form.options}
	>
		<Combobox.Input
			class="input"
			placeholder={placeholder || name}
			value={value ? value.label : ''}
		/>

		<Combobox.Label />

		<Combobox.Content
			class="bg-gray-50 space-y-1 rounded-md shadow-md max-h-80 p-1 overflow-y-auto relative z-25"
		>
			{#each $form.options as option}
				<Combobox.Item
					class="flex items-center rounded px-3 py-2 hover:bg-emerald-100 cursor-pointer"
					label={option.label}
					value={option.value}
				>
					{option.label}
					<Combobox.ItemIndicator class="ml-auto">
						<Check class="text-green-400" />
					</Combobox.ItemIndicator>
				</Combobox.Item>
			{/each}
			<CustomFieldOptionButton
				class="button-secondary"
				field={field}
				text="Add a {name}"
			/>
		</Combobox.Content>
	</Combobox.Root>

</div>