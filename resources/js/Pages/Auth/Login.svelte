<script context="module">
    export { default as layout } from "@/Layouts/App.svelte";
	import Article from "@/Components/Article.svelte";
	import Login from "@/Components/Login.svelte";
</script>

<svelte:head>
    <title>Log In</title>
</svelte:head>

<Article class="flex items-center justify-center">
	<Login />
</Article>
