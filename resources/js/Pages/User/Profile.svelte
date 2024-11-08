<script context="module">
	export { default as layout } from "@/Layouts/App.svelte";
</script>

<script>
    import { page, useForm } from "@inertiajs/svelte";
		import Article from '@/Components/Article.svelte';
		import Breadcrumbs from '@/Components/Breadcrumbs.svelte';
		import Button from '@/Components/Button.svelte';
		import FormInput from '@/Components/FormInput.svelte';
		import Header from '@/Components/Header.svelte';
		import PanelUser from '@/Components/PanelUser.svelte';

    // export let user;

    let form = useForm({
			avatar: null,
			name: $page.props.auth.user.name,
			email: $page.props.auth.user.email,
			_method: 'patch'
    });

    function submit() {
			$form.post(`/users/${$page.props.auth.user.id}`);
    }

</script>

<svelte:head>
    <title>Profile</title>
</svelte:head>

<PanelUser />

<Article breadcrumbs={[
	{ label: "User", href: null },
	{ label: "Profile", href: null }
]}>

	<Header
		eyebrow="User"
		heading="User Profile"
	/>

	<form on:submit|preventDefault={submit} enctype="multipart/form-data" class="space-y-6 max-w-96">

		<FormInput
			name="Avatar"
			type="file"
			bind:value={$form.avatar}
			placeholder={$page.props.auth.user.avatar}
			error={$form.errors.avatar}
		/>

		<FormInput
			name="Name"
			type="text"
			bind:value={$form.name}
			placeholder="Name"
			error={$form.errors.name}
		/>
		
		<FormInput
			name="Email"
			type="text"
			bind:value={$form.email}
			placeholder="Email"
			error={$form.errors.email}
		/>

		<Button
			class="button-primary"
			text="Save Profile"
			type="submit"
		/>
		
	</form>
</Article>