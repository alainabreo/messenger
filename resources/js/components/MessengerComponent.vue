<template>
    <b-container fluid style="height: calc(100vh - 56px);">
        <b-row no-gutters class="h-100">
            <b-col cols="4">
                <contact-form-component />

                <contact-list-component />
            </b-col>
            <b-col cols="8">
                <active-conversation-component
                    v-if="selectedConversation">
                    
                </active-conversation-component>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    export default {
        props: {
            user: Object
        },
        data () {
            return {
            };
        },
        mounted() {
            console.log('Messenger Component mounted.');

            this.$store.commit('setUser', this.user)
            this.$store.dispatch('getConversations');

            //Echo.channel('example')
            //User se suscribe a su propio canal
            Echo.private(`users.${this.user.id}`)
                .listen('MessageSent', (data) => {
                    console.log('Message received from Pusher.')
                    console.log(data.message);

                    const message = data.message;
                    message.written_by_me = false;                    
                    this.addMessage(message);
                });

            //User se suscribe al Canal general
            Echo.join('messenger')
                .here((users) => {
                    console.log('online: ', users);
                    users.forEach((user) => this.changeStatus(user, true));
                })
                .joining((user) => {                    
                    console.log('User joining: ', user.name);
                    this.changeStatus(user, true);
                })
                .leaving((user) => {
                    console.log('User leaving: ', user.name);
                    this.changeStatus(user, false);
                });                
        },
        methods: {
            changeStatus(user, status) {
                const index = this.$store.state.conversations.findIndex((conversation) => {
                    return conversation.contact_id == user.id;
                });
                //Añade una propiedad reactiva online
                if (index >= 0)
                    this.$set(this.$store.state.conversations[index], 'online', status);
            }
        },
        computed: {
            selectedConversation() {
                return this.$store.state.selectedConversation;
            }
        }
    }
</script>
