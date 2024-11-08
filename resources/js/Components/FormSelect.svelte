<script>
	import { Check } from "lucide-svelte";
	import { Combobox } from "bits-ui";
	import ErrorText from "@/Components/ErrorText.svelte";
	import FormLabel from "@/Components/FormLabel.svelte";
	import Icon from "@/Components/Icon.svelte";

	let componentClass = '';
	export { componentClass as class }
	export let error;
	export let multiple;
	export let name;
	export let options;
	export let placeholder;
	export let value;

	// let inputClass = [
	// 	"input rounded transition-colors w-full placeholder-slate-300 dark:placeholder-gray-500",
	// 	"bg-transparent border border-slate-300 text-lg",
	// 	"hover:border-emerald-400 focus:border-2 focus:border-emerald-400",
	// ].join(" ");

</script>

<div class="relative input_group text-left {componentClass}">

	{#if name}
		<FormLabel for={name} name={name} />
	{/if}

	<Combobox.Root
		bind:selected={value}
		items={options}
		multiple={multiple}
	>
		<Combobox.Input
			class="input"
			placeholder={placeholder}
			value={multiple ? value.map(v => v.label).join(', ') : (value ? value.label : '')}
		/>

		<Combobox.Content
			class="bg-gray-50 space-y-1 rounded-md shadow-md max-h-80 p-1 overflow-y-auto relative z-50"
		>
			{#each options as option}
				<Combobox.Item
					class="flex items-center rounded px-3 py-2 hover:bg-sky-50 cursor-pointer"
					label={option.label}
					value={option.value}
				>
					{option.label}
					<Combobox.ItemIndicator class="ml-auto">
						<Check class="text-green-400" />
					</Combobox.ItemIndicator>
				</Combobox.Item>
			{/each}

		</Combobox.Content>

	</Combobox.Root>

	<ErrorText error={error} />

</div>