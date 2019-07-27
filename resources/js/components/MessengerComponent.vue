<template>
    <b-container fluid style="height: calc(100vh - 56px);">
        <b-row no-gutters class="h-100">
            <b-col cols="4">

                <b-form class="my-3 mx-2">
                    <b-form-input class="text-center" 
                        type="text"
                        v-model="querySearch"
                        placeholder="Search contact">
                    </b-form-input>                        
                </b-form>

                <!-- //$event captura la data que viene del componente -->
                <contact-list-component 
                    @conversationSelected="changeActiveConversation($event)"
                    :conversations="conversationsFiltered">                    
                </contact-list-component>
            </b-col>
            <b-col cols="8">
                <active-conversation-component
                    v-if="selectedConversation"
                    :contact-id="selectedConversation.contact_id"
                    :contact-name="selectedConversation.contact_name"
                    :contact-image="selectedConversation.contact_image"
                    :my-image="myImageUrl"
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
            user: Object
        },
        data () {
            return {
                //selectedConversation: null
                selectedConversation: [],
                messages: [],
                conversations: [],
                querySearch: ''
            };
        },
        mounted() {
            console.log('Messenger Component mounted.')

            this.getConversations();

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

                const autor = this.user.id === message.from_id ? 'Tú' : conversation.contact_name;
                
                conversation.last_message = `${autor}: ${message.content}`;
                conversation.last_time = message.created_at;

                if (this.selectedConversation.contact_id == message.from_id 
                    || this.selectedConversation.contact_id == message.to_id) {
                    //message.written_by_me = (this.user.id == message.from_id);
                    this.messages.push(message);
                }
            },
            changeStatus(user, status) {
                const index = this.conversations.findIndex((conversation) => {
                    return conversation.contact_id == user.id;
                });
                //Añade una propiedad reactiva online
                if (index >= 0)
                    this.$set(this.conversations[index], 'online', status);
            }
        },
        computed: {
            conversationsFiltered() {
                console.log('Lista de conversaciones');
                //console.log(this.conversations);
                //return this.conversations;
                return this.conversations.filter(
                    (conversation) => conversation.contact_name
                                .toLowerCase()
                                .includes(this.querySearch.toLowerCase())
                );
            },
            myImageUrl() {
                return `/users/${this.user.image}`;
            }
        }
    }
</script>
