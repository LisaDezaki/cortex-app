<script context="module">
	export { default as layout } from "@/Layouts/App.svelte";
</script>

<script>
	import Article from "@/Components/Article.svelte";
	import Register from "@/Components/Register.svelte";
</script>

<svelte:head>
	<title>Register</title>
</svelte:head>

<Article class="flex items-center justify-center">
	<Register />
</Article>
