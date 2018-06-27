<template>
	<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                	<textarea class="form-control" rows="3" v-model="content"></textarea><br>
                	<button class="btn btn-success pull-right" :disabled="not_working" @click="create_post()">Create a post</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
	export default {
		mounted() {

		},
		data() {
			return {
				content: '',
				not_working: true
			}
		},
		methods: {
			create_post() {
				this.$http.post('/create/post', { content: this.content })
					.then((reponse) => {
						this.content = ''
						new Noty({
                                type: 'success',
                                layout: 'topRight',
                                text: 'Your post has been published !'
                            }).show();
						console.log(reponse)
						return this.$store.getters.all_posts
					})
			}
		},
		watch: {
			content() {
				if(this.content.length > 0)
					this.not_working = false
				else
					this.not_working = true
			}
		},
		http: {
            headers: {
                'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
            }
        },  
	}
</script>