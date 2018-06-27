<template>
      <div>
      	<input  type="text" class="form-control" placeholder="search for other users" v-model="query" @keyup="search()" style="position: relative; top: 6px;" size="35">
		<div class="row" v-if="results.length">	
			<div class="text-center" v-for="result in results">
				<a :href="'/profile/' + result.slug">
					<img :src="result.avatar" height="50px" width="50px" style="border-radius: 50%">
					<h4 class="text-center">{{ result.name }}</h4>
				</a>
			</div>
		</div>
	</div>
</template>

<script>
	var algoliasearch = require('algoliasearch')

	var client = algoliasearch("I7IDL12YU5", "9c1a1e89e681351cf48bab57d30517ba")

	var index = client.initIndex('users')

	export default {
		mounted() {
		
		},
		data() {
			return {
				query: '',
				results: []
			}
		},
		methods: {
			search() {
				index.search(this.query , (err, content) => {
						this.results = content.hits
						if(this.query.length === 0)
							this.results = []
				})
			}
		}
	}
</script>