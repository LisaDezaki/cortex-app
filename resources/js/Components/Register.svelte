<script>
	import { Link, useForm } from "@inertiajs/svelte";
	import Button from "@/Components/Button.svelte";
	import FormInput from "@/Components/FormInput.svelte";

	let form = useForm({
		name: '',
		email: '',
		password: '',
		password_confirmation: ''
	});

	function submit() {
		$form.post('/register', {
			onSubmit: () => $form.reset('password'),
		});
	}
</script>

<form on:submit|preventDefault={submit} class="space-y-4 w-96">

	<h4 class="heading h2 border-b border-emerald-400 mb-6 pb-4">Register</h4>

	<FormInput
		bind:value={$form.name}
		name="Name"
		placeholder="Name"
		type="text"
		errors={$form.errors.name}
	/>

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

	<FormInput
		bind:value={$form.password_confirmation}
		name="Confirm Password"
		placeholder="Confirm Password"
		type="password"
		errors={$form.errors.password_confirmation}
	/>

	<Button
		class="button-primary button-lg w-full"
		text="Register Now"
		type="submit"
		disabled={$form.processing}
	/>

	<div class="flex items-center justify-between mt-4">
		<p class="mt-2">Already have an account?</p>
		<Button
			href="/login"
			text="Log In"
			class="button-secondary"
		/>
	</div>
	
</form>
