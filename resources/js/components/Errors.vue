<template>
	<div v-if="errors != '' && errors != '{}'">
	<div class="alert alert-danger">
		<ul >
			<li v-for="error in errors">
				<strong class="text-danger">{{ error[0] }}</strong>
			</li>
		</ul>
	</div>
</div>
</template>
<script>
	export default{
		props: [
			'errors'
		],
		data(){
			return {

			}
		}
	}
</script>
<style>
	
</style>