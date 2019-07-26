<template>
    <b-row class="h-100">
        <b-col cols="8" class="h-100">
            <b-card no-body
                footer-bg-variant="light"
                footer-border-variant="dark"
                title="Conversación activa"
                class="h-100">

                <b-card-text class="text-center">Conversación activa</b-card-text>

                <b-card-body class="card-body-scroll">
                    <message-conversation-component 
                            v-for="message in messages"
                            :key="message.id"
                            :written-by-me="message.written_by_me">
                            {{ message.content }}
                    </message-conversation-component>
                </b-card-body>

                <div slot="footer">
                    <b-form class="mb-0" @submit.prevent="postMessage" autocomplete="off">

                        <b-input-group>
                            <b-form-input class="text-center"
                                type="text"
                                v-model="newMessage"
                                placeholder="Send message ...">
                            </b-form-input>

                            <b-input-group-append>
                                <b-button type="submit" variant="primary">Enviar</b-button>
                            </b-input-group-append>
                        </b-input-group>

                    </b-form>
                </div>
            </b-card>            
        </b-col>
        <b-col cols="4" class="h-100">
            <b-img rounded="circle" blank width="60" height="60" blank-color="#777" alt="img" class="m-1"></b-img>
            <p>Usuario seleccionado</p>
            <hr>
            <p>{{ contactName }}</p>
            <hr>
            <b-form-checkbox>
                Desactivar notificaciones
            </b-form-checkbox>
        </b-col>
    </b-row>
</template>

<style>
    /*Menos el alto del Footer*/
    .card-body-scroll {
        max-height: calc(100vh - 63px);
        overflow-y: auto;
    }
</style>

<script>
    export default {
        props: {
            contactId: Number,
            contactName: String,
            messages: Array
        },
        data () {
            return {
                newMessage: ''
            };
        },
        mounted() {
            console.log('Active Conversation Component mounted.');
        },
        methods: {
            postMessage() {
                const params = {
                    to_id: this.contactId,
                    //content: 'querty'
                    content: this.newMessage
                };

                if (!this.contactId) {
                    console.log("no hay conversacion activa")
                    return;
                }

                if (!this.newMessage) {
                    console.log("no hay mensaje para grabar")
                    return;
                }

                axios.post('/api/messages', params).then((response) => {
                    if (response.data.success) {
                        //console.log(response.data);
                        this.newMessage = '';

                        const message = response.data.message;
                        message.written_by_me = true;
                        this.$emit('messageCreated', message);
                    }
                });
            },
            scrollToBottom() {
                const el = document.querySelector('.card-body-scroll');
                el.scrollTop = el.scrollHeight;
            }
        },
        updated() {
            this.scrollToBottom();
            console.log('messages ha cambiado');
        }
    }
</script>
