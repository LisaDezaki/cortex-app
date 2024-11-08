<script>
	import { page, useForm } from "@inertiajs/svelte";
	import { Select } from "bits-ui";
	import { Check, ChevronsUpDown, Earth } from "lucide-svelte";

	let componentClass;
	export { componentClass as class }
	export let active;
	export let items = [];
	export let placeholder;

	let form = useForm({
		active: active || null
	});

	function handleChange(selection) {
		$form.active = selection.value;
		$form.patch(`/user/projects/${selection.value}/activate`);
		active = selection;
	}

	// let selected_label = '';
	// if (active && $page.props.projects.length > 0) {
	// 	let selected = $page.props.projects.find((p) => p.id === active );
	// 	if (selected) { selected_label = selected_label.name }
	// }

	function getActive(id) {
		return id ? items.find((item) => item.value == id) : null;
	}

	function getActiveLabel(id) {
		let item = getActive(id);
		return item ? item.label : 'Loading World...';
	}

</script>

<form class="flex flex-col gap-1 p-1">

	<Select.Root
		selected={getActive()}
		items={items}
		type="single"
		onSelectedChange={handleChange}
	>
		<Select.Trigger
			aria-label={placeholder}
			class="inline-flex items-center justify-start gap-2
				h-input px-1.5 py-1.5
				border-2 rounded-lg border-emerald-500 hover:bg-emerald-700		
				text-white text-lg placeholder:text-slate-300
				focus:outline-none focus:ring-2 focus:ring-foreground focus:ring-offset-2 focus:ring-offset-background {componentClass}"
		>
			<Earth class="text-emerald-500 flex-shrink-0" size={24} strokeWidth={2} />
			{#if active}
				<p class="truncate">
					{getActiveLabel(active)}
				</p>
			{:else}
				<Select.Value class="text-gray-300 truncate" placeholder={placeholder} />
			{/if}
			<ChevronsUpDown class="ml-auto text-muted-foreground" size={20} strokeWidth={1} />
		</Select.Trigger>

		<Select.Content
			class="w-full p-1 shadow-popover outline-none
						bg-emerald-600 text-white rounded-xl"
			sideOffset={8}
		>
			{#each items as item}
				<Select.Item
					class="flex items-center justify-start select-none cursor-pointer truncate
								h-10 w-full rounded-lg
								hover:bg-emerald-700 outline-none data-[highlighted]:bg-muted
									rounded-button px-2 py-1 transition-all duration-75"
					value={item.value}
					label={item.label}
				>
					{item.label}

					<Select.ItemIndicator class="ml-auto" asChild={false}>
						<Check size={20} strokeWidth={1} />
					</Select.ItemIndicator>

				</Select.Item>
			{/each}
		</Select.Content>
	</Select.Root>

</form>