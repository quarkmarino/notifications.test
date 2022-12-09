<template>
    <form class="p-6 text-gray-900 flex flex-col">
        <div v-if="status == 201" class="rounded bg-green-600 text-lime-900 p-3">
            <div class="alert alert-success">
                {{ response_message }}
            </div>
        </div>
        <label for="content">Message</label>
        <textarea name="content" placeholder="The Notification message" v-model="message.content"/>
        <span v-if="errors.content?.length > 0" class="text-danger">
            {{ errors.content[0] }}
        </span>
        <br>
        <label for="category">Category</label>
        <select name="category" v-model="message.category">
            <option value="" disabled >Select Category</option>
            <option value="movies" selected>MOVIES</option>
            <option value="finance">FINANCE</option>
            <option value="sports">SPORTS</option>
        </select>
        <span v-if="errors.category?.length > 0" class="text-danger">
            {{ errors.category[0] }}
        </span>
        <br>
        <input type="submit" class="btn btn-lg" @click.stop.prevent="sendMessage"/>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                response_message: '',
                message: {
                    content: '',
                    category: '',
                },
                errors: {
                    content: [],
                    category: []
                },
                status: null
            }
        },
        methods: {
            async sendMessage() {
                await axios.post('/api/message', this.message)
                    .then(response => {
                        console.log('then', response)
                        this.status = response.status
                        this.response_message = response.data.message

                        if (response.status == 201) {
                            this.message.content = ''
                            this.errors = {
                                content: [],
                                category: []
                            }
                        }
                    })
                    .catch(response => {
                        console.log('catch', response.response.data.errors)
                        this.status = response.response.status
                        this.response_message = response.response.data.message
                        this.errors = response.response.data.errors
                    })
            }
        }
    }
</script>
