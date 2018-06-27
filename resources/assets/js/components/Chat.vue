<template>
	<div class="col-md-8 col-md-offset-2">
		<ul class="list-group">
			<h4 class="list-group-item list-group-item-info">
				Online
				<span class="badge" style="background-color: red">
					{{ number_of_users }}
				</span>
			</h4>
			<div class="pre-scrollable" v-chat-scroll>
				<li v-for="message,index in chats.message" style="padding-right: 20px; padding-left: 20px;">
					<h3><span class="label" :class="chats.color[index]">{{ message }}</span></h3>
					<h5><span class="label" :class="chats.color[index]">{{ chats.user[index] }}</span></h5>
					<label class="" :class="chats.align[index]">{{ chats.time[index] }}</label>
				</li>
			</div>
		</ul>
		<label>{{ typing }}</label>
		<input maxlength="50" type="text" class="form-control" placeholder="Type your message here..." v-model="message" @keyup.enter="send()">
	</div>
</template>

<script>
	export default {
		data() {
			return {
				message: '',
				chats: { 
					message: [],
					user: [],
					color: [],
					time: [],
					align: []
				},
				typing: '',
				number_of_users: 0
			}
	    },
	    watch: {
	    	message() {
	    		Echo.private('chat')
	    			.whisper('typing', {
	    				name: this.message
	    			})
	    	}
	    },
	    methods: {
	    	send() {
	    		if(this.message.length !=0) {
	    			this.chats.message.push(this.message)
	    			this.chats.user.push('you')
	    			this.chats.color.push('label-primary pull-right')
	    			this.chats.align.push('pull-right')
	    			this.chats.time.push(this.get_time())

	    			axios.post('/send', {
	    				message: this.message
	    			})
	    			.then(response => {
	    				console.log(response)
	    				this.message = ''
	    			})
	    			.catch(error => {
	    				console.log(error)
	    			})
	    		}
	    	},
	    	get_time() {
	    		let time = new Date()
	    		return time.getHours() + ':' + time.getMinutes()
	    	}
	    },
	    mounted() {
	    	Echo.private('chat')
			    .listen('ChatEvent', (e) => {
			        console.log(e)
			        this.chats.message.push(e.message)
			        this.chats.user.push(e.user)
			        this.chats.color.push('label-success pull-left')
			        this.chats.time.push(this.get_time())
			        this.chats.align.push('pull-left')
			    })
				.listenForWhisper('typing', (e) => {
					if(e.name != '') {
						this.typing = 'typing...'
						document.getElementById("typing_audio").play()
					} else {
						this.typing = ''
					}
				})
			Echo.join('chat')
				.here((users) => {
					this.number_of_users = users.length
					console.log(this.users)
				})
				.joining((user) => {
					this.number_of_users += 1,

					new Noty({
                        type: 'success',
                        layout: 'topRight',
                        text: user.name + ' joined the chat room'
                    }).show(),

                    document.getElementById("noty_audio").play()
				})
				.leaving((user) => {
					this.number_of_users -= 1,

					new Noty({
                        type: 'error',
                        layout: 'topRight',
                        text: user.name + ' left the chat room'
                    }).show(),	

                    document.getElementById("noty_audio").play()			
				})
	    }
	}
</script>
