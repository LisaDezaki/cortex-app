<script>
	import { Link, useForm } from "@inertiajs/svelte";
	import Button from "@/Components/Button.svelte";
	import FormInput from "@/Components/FormInput.svelte";

	let form = useForm({
			email: '',
			password: ''
	});

	function submit() {
			$form.post('/login', {
					onSubmit: () => $form.reset('password'),
			});
	}
</script>

<form on:submit|preventDefault={submit} class="space-y-4 w-96">

	<h4 class="heading h2 border-b border-emerald-400 mb-6 pb-4">Log In</h4>

	<FormInput
		bind:value={$form.email}
		name="Email"
		placeholder="Email"
		type="email"
		errors={$form.errors.email}
	/>

	<FormInput
		bind:value={$form.password}
		name="Password"
		placeholder="Password"
		type="password"
		errors={$form.errors.password}
	/>

	<Button
		class="button-primary button-lg w-full"
		text="Log In"
		type="submit"
		disabled={$form.processing}
	/>

	<div class="flex items-center justify-between mt-4">
		<p class="mt-2">Don't have an account yet?</p>
		<Button
			href="/register"
			text="Register"
			class="button-secondary"
		/>
	</div>


</form>
