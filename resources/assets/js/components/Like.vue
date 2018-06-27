<template>
	<div>
		<hr>
		<p v-for="like in post.likes">
			<img :src="like.user.avatar" width="30px" height="30px" class="avatar-feed">
		</p>
		<hr>
		<button class="btn btn-primary btn-xs" v-if="!auth_user_like_post" @click="like()">
			Like this post
		</button>
		<button class="btn btn-danger btn-xs" v-else @click="unlike()">
			Unlike this post
		</button>
	</div>
</template>

<script>
	export default {
		mounted() {

		},
		props: ['id'],
		computed: {
			likers() {
				var likers = []

				this.post.likes.forEach((like) => {
					likers.push(like.user.id)
				})

				return likers
			},
			auth_user_like_post() {
				var check_index = this.likers.indexOf(
					this.$store.state.auth_user.id
				)

				if(check_index === -1)
					return false
				else
					return true
			},
			post() {
				return this.$store.state.posts.find((post) => {
					return post.id === this.id
				})
			}
		},
		methods: {
			like() {
				this.$http.get('/like/' + this.id)
					.then((response) => {
						this.$store.commit('update_post_likes', {
							id: this.id,
							like: response.body
						})
					})
			},
			unlike() {
				this.$http.get('/unlike/' + this.id)
					.then((response) => {
						this.$store.commit('unlike_post', {
							post_id: this.id,
							like_id: response.body
						})
					})
			}
		}
	}
</script>

<style>
	.avatar-feed {
		border-radius: 50%
	}
</style>