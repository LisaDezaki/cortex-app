<script>
	let componentClass;
	let componentFor;
	export { componentClass as class }
	export { componentFor as for };
	export let name;
</script>

<label
	for={componentFor}
	class="
		absolute -top-2.5 ml-3 px-1.5 py-0.5 rounded-full bg-gray-50
		font-light text-xs tracking-widest uppercase text-slate-400
		{componentClass}"
>
	{name}
</label>