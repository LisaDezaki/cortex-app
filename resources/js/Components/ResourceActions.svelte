<script>
	import { Link } from "@inertiajs/svelte";
	import { CirclePlus, PencilRuler, Trash2 } from "lucide-svelte";

	let deleteItem;
	export let create;
	export let edit;
	export { deleteItem as delete };
</script>

<div class="flex gap-2 absolute top-4 right-4">

	{#if create}
		<Link href={create} class="flex items-center gap-2 rounded-full p-2 w-full hover:bg-emerald-500/15">
			<CirclePlus size={24} strokeWidth={1.25} />
		</Link>
	{/if}

	{#if edit}
		<Link href={edit} class="flex items-center gap-2 rounded-full p-2 w-full hover:bg-emerald-500/15">
			<PencilRuler size={24} strokeWidth={1.25} />
		</Link>
	{/if}

	{#if deleteItem}
		<button on:click={deleteItem} class="flex items-center gap-2 rounded-full p-2 w-full hover:bg-rose-500/15 hover:text-rose-500">
			<Trash2 size={24} strokeWidth={1.25} />
		</button>
	{/if}

</div>