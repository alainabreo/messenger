<template>
    <b-container fluid style="height: calc(100vh - 56px);">
        <b-row no-gutters class="h-100">
            <b-col cols="4">
                <!-- //$event captura la data que viene del componente -->
                <contact-list-component 
                    @conversationSelected="changeActiveConversation($event)"
                    :conversations="conversations">
                    
                </contact-list-component>
            </b-col>
            <b-col cols="8">
                <active-conversation-component
                    v-if="selectedConversation"
                    :contact-id="selectedConversation.contact_id"
                    :contact-name="selectedConversation.contact_name"
                    :messages="messages"
                    @messageCreated="addMessage($event)">
                    
                </active-conversation-component>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    export default {
        props: {
            userId: Number
        },
        data () {
            return {
                //selectedConversation: null
                selectedConversation: [],
                messages: [],
                conversations: []
            };
        },
        mounted() {
            console.log('Messenger Component mounted.')

            this.getConversations();

            //Echo.channel('example')
            //User se suscribe a su propio canal
            Echo.private(`users.${this.userId}`)
                .listen('MessageSent', (data) => {
                    console.log('Message received from Pusher.')
                    console.log(data.message);

                    const message = data.message;
                    message.written_by_me = false;                    
                    this.addMessage(message);
                });
        },
        methods: {
            getConversations() {
                axios.get('/api/conversations').then((response) => {
                    this.conversations = response.data;
                    console.log(response.data);
                });
            },            
            changeActiveConversation(conversation) {
                console.log('Nueva conversacion seleccionada', conversation);
                this.selectedConversation = conversation;
                this.getMessages();
            },
            getMessages() {
                axios.get(`/api/messages?contact_id=${this.selectedConversation.contact_id}`).then((response) => {
                    this.messages = response.data;
                    //console.log(response.data);
                });
            },
            addMessage(message) {
                //Si la conversacion seleccionada coincide con quien nos envia el mensaje ó
                //Si la conversación seleccionada coindice con un contacto a quien enviamos un mensaje
                //const conversation = this.conversations.find(function (conversation) {
                const conversation = this.conversations.find((conversation) => {
                    return conversation.contact_id == message.from_id 
                        || conversation.contact_id == message.to_id
                });

                const autor = this.userId === message.from_id ? 'Tú' : conversation.contact_name;
                
                conversation.last_message = `${autor}: ${message.content}`;
                conversation.last_time = message.created_at;

                if (this.selectedConversation.contact_id == message.from_id 
                    || this.selectedConversation.contact_id == message.to_id) {
                    //message.written_by_me = (this.userId == message.from_id);
                    this.messages.push(message);
                }
            }
        }
    }
</script>
