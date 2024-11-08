<script>
	import { Avatar } from "bits-ui";
	import { page, useForm } from "@inertiajs/svelte";

	let componentClass;
	export { componentClass as class };
	export let src;
	export let alt;
	export let editable = false;

	$: fallback = alt ? alt.slice(0,2).toUpperCase() : 'AB';

	let form = useForm({
		avatar: src,
		_method: 'patch'
	});

	function submit() {
		$form.post(`/users/${$page.props.auth.user.id}`);
	}
</script>

<Avatar.Root
	class="avatar flex items-center justify-center flex-shrink-0 aspect-square overflow-clip relative
		rounded-full min-w-10 p-0.5
		{editable ? 'cursor-pointer' : ''}
		{componentClass}"
>
	{#if src}
		<Avatar.Image {src} {alt}
			class="min-h-full min-w-full rounded-full overflow-clip"
		/>
	{:else}
		<Avatar.Fallback
			class="text-emerald-400 text-xl rounded-full overflow-clip"
		>{fallback}</Avatar.Fallback>
	{/if}

	<!-- {#if editable}
		<div
			class="absolute inset-x-0 bottom-0
			inline-flex items-center justify-center
		 text-red-500">
			Update
		</div>
	{/if} -->

</Avatar.Root>