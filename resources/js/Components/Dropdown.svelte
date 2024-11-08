<script>
	import { Link } from "@inertiajs/svelte";
	import { DropdownMenu } from "bits-ui";
	import Icon from "@/Components/Icon.svelte";

	let componentClass;
	export { componentClass as class }
	export let items = [];
</script>

<DropdownMenu.Root>

	<DropdownMenu.Trigger class={componentClass}>
		<slot name="trigger" />
	</DropdownMenu.Trigger>

	<DropdownMenu.Content class="bg-white rounded min-w-32 py-2 shadow" side="bottom-end">

		{#each items as item}
			<DropdownMenu.Item>

				{#if item.href}
					<Link href={item.href} class="flex items-center gap-2 px-4 py-1.5 w-full hover:bg-emerald-100 {item.class}">
						{#if item.icon}
							<Icon name={item.icon} size={20} stroke={1.25} />
						{/if}
						{item.label}
					</Link>
				{/if}

				{#if item.click}
					<button on:click={item.click} class="flex items-center gap-2 px-4 py-1.5 w-full hover:bg-emerald-100 {item.class}">
						{#if item.icon}
							<Icon name={item.icon} size={20} stroke={1.25} />
						{/if}
						{item.label}
					</button>
				{/if}

			</DropdownMenu.Item>
		{/each}

	</DropdownMenu.Content>

</DropdownMenu.Root>