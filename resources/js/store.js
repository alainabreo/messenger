import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

//export default const store = new Vuex.Store({
//Como tenemos un unico valor puede quedar así    
export default new Vuex.Store({
	state: {
		conversations: [],
		selectedConversation: null,
        //selectedConversation: [],
		messages: [],
		querySearch: '',
		user: null
	},
	mutations: {
		setUser(state, user) {
			state.user = user;
		},
		newMessagesList(state, messages) {
			state.messages = messages;
		},
		addMessage(state, message) {
            //Si la conversacion seleccionada coincide con quien nos envia el mensaje ó
            //Si la conversación seleccionada coindice con un contacto a quien enviamos un mensaje
            //const conversation = state.conversations.find(function (conversation) {
            const conversation = state.conversations.find((conversation) => {
                return conversation.contact_id == message.from_id 
                    || conversation.contact_id == message.to_id
            });

            const autor = state.user.id === message.from_id ? 'Tú' : conversation.contact_name;
            
            conversation.last_message = `${autor}: ${message.content}`;
            conversation.last_time = message.created_at;

            if (state.selectedConversation.contact_id == message.from_id 
                || state.selectedConversation.contact_id == message.to_id) {
				state.messages.push(message);            	
            }			
		},
		selectConversation(state, conversation) {
			state.selectedConversation = conversation;
		},
		newQuerySearch(state, query) {
			state.querySearch = query;
		},
		newConversationsList(state, conversations) {
			state.conversations = conversations;
		}
	},
	actions: { //Peticiones asíncronas
        getConversations(context) {
            axios.get('/api/conversations').then((response) => {
            	context.commit('newConversationsList', response.data);
            });
        },
        getMessages(context, conversation) {
	        axios.get(`/api/messages?contact_id=${conversation.contact_id}`)
	        .then((response) => {
	            context.commit('selectConversation', conversation);
	            context.commit('newMessagesList', response.data);
	        });
        },
        postMessage(context, newMessage) {
            const params = {
                to_id: context.state.selectedConversation.contact_id,
                content: this.newMessage
            };

            if (!context.state.selectedConversation.contact_id) {
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
                    context.commit('addMessage', message);
                }
            });        	
        }
	},
	getters: {
        conversationsFiltered(state) {
            //console.log('conversationsFiltered Fired');
            return state.conversations.filter(
                (conversation) => conversation.contact_name
                            .toLowerCase()
                            .includes(state.querySearch.toLowerCase())
            );
        }		
	}
});