<script context="module">
    export { default as layout } from "@/Layouts/App.svelte";
</script>

<script>
    import { useForm } from "@inertiajs/svelte";
		import NavList from '@/Components/NavList.svelte';
		import NavLink from '@/Components/NavLink.svelte';
		import Panel from '@/Components/Panel.svelte';

		export let posts;

    let form = useForm({
        title: null,
        content: null
    });

    function submit() {
        $form.post('/posts');
    }
</script>

<svelte:head>
    <title>Add New Post</title>
</svelte:head>

<div class="flex">

	<Panel heading="Posts">
		{#if posts.data && posts.data.length != 0 }
			<NavList>
				<NavLink href="/posts/create">New Post</NavLink>
				{#each posts.data as post}
					<NavLink href="/posts/{post.id}">{post.title}</NavLink>
				{/each}
			</NavList>
		{/if}
	</Panel>

	<form on:submit|preventDefault={submit}>
		<div class="mb-3">
				<input type="text" bind:value={$form.title} placeholder="Title" class="input input-bordered w-full">
				{#if $form.errors.title}
						<div class="text-error text-sm font-bold mt-1">{$form.errors.title}</div>
				{/if}
		</div>
		<div class="mb-3">
				<textarea bind:value={$form.content} rows="5" placeholder="Content" class="textarea textarea-bordered w-full" />
		</div>
		<button type="submit" class="btn btn-primary" disabled={$form.processing}>Save</button>
	</form>

</div>