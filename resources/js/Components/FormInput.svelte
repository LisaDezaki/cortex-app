<script>
	import { ImageUp } from "lucide-svelte";
	import ErrorText from "@/Components/ErrorText.svelte";
	import FormLabel from "@/Components/FormLabel.svelte";
	import Icon from "@/Components/Icon.svelte";

	let componentClass = '';
	export { componentClass as class }
	export let error;
	export let placeholder;
	export let name;
 	export let type;
	export let value;

	let filename;

	function handleFiles(e) {
		value = e.target.files[0];
		filename = e.target.files[0].name
		if (value) {
			const fileReader = new FileReader();
			fileReader.onload = event => {
				placeholder = event.target.result;
			}
			fileReader.readAsDataURL(e.target.files[0]);
		}
	}
</script>

<div class="relative input_group text-left {componentClass}">

	<!-- LABEL -->

	{#if name}
		<FormLabel for={name} name={name} />
	{/if}

	<!-- FILE -->

	{#if type == "file"}
		<label
			for={name}
			class="input flex flex-col justify-center items-center
			gap-0.5 min-h-56 max-h-80 min-w-40 max-w-96 p-2
			overflow-hidden cursor-pointer
		 	{componentClass}"
		>
			{#if placeholder || value}
				<div class="relative flex justify-start items-center h-full w-full overflow-clip rounded-md">
					<img src={placeholder || value} alt="" id="preview" class="absolute min-h-full min-w-full object-contain rounded" />
				</div>
				{#if filename}
					<p class="text-sm italic text-slate-400 truncate w-full text-center">{filename}</p>
				{/if}
			{:else}
				<ImageUp class="text-slate-300" size={40} strokeWidth={1} />
			{/if}

			<input {name}
				type="file"
				on:input={handleFiles}
				id={name}
				accept="image/png, image/jpeg"
				class="hidden"
			/>

		</label>
	{/if}

	<!-- TEXTAREA -->

	{#if type == "textarea"}
		<textarea {name} {placeholder}
			bind:value={value}
			class="input h-24 py-2.5 {componentClass}"
		></textarea>
	{/if}

	<!-- TEXT -->

	{#if type == "text"}
		<input {name} {placeholder}
			bind:value={value}
			type="text"
			class="input {componentClass}"
		>
	{/if}

	<!-- EMAIL -->

	{#if type == "email"}
		<input {name} {placeholder}
			bind:value={value}
			type="email"
			class="input {componentClass}"
		>
	{/if}

	<!-- PASSWORD -->

	{#if type == "password"}
		<input {name} {placeholder}
			bind:value={value}
			type="password"
			class="input {componentClass}"
		/>
	{/if}

	<ErrorText error={error} />

</div>