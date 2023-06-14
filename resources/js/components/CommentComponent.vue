<template>
    <div class="row my-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Commentaires
                </div>
                <div class="card-body">
                    <div v-if="user_id && verified_user">
                        <div class="form-group mb-3">
                        <textarea v-model="body" class="form-control"
                                  cols="30" rows="2"
                                  placeholder="Tapez ici..."></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <button class="btn btn-sm btn-dark"
                                    v-show="body.length"
                                    @click="addComments">Envoyer</button>
                        </div>
                    </div>
                    <div v-else>
                        <a href="/login" :href="to" class="btn btn-link">
                            Connectez-vous pour commenter./ Vérifier votre compte.
                        </a>
                    </div>
                    <ul class="list-group" v-if="comments.length">
                        <li class="list-group-item d-flex flex-column"
                            v-for="(comment,index) in comments" :key="index">
                            <span><b>{{comment.user.name}}: </b><i>{{comment.body}}</i></span>
                            <span>{{comment.created_at}}</span>
                            <div v-if="valide" id="app">
                                <span>
                                    <button @click="valider" v-on:click="showAlert()" class="btn btn-sm btn-success">Valider</button>
                                </span>
                            </div>
                        </li>
                    </ul>
                    <div class="alert alert-dark" v-else>
                        Aucun commentaire pour l'instant!
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name:'App',
    props:['question_id','user_id','verified_user','valide','validation'],
    data(){
        return {
            body: '',
            comments: [],
            nbValidation: 0,
            to : !this.user_id && !this.verified_user ? '/login' : '/email/verify'
        }
    },
    mounted() {
        this.getComments();
        this.nbValidation = this.validation;
        this.valide = 1;
    },
    methods:{
        showAlert(){
            alert("Vous avez validé ce commentaire!");
        },
        valider(){
            axios.get(`/api/questions/${this.user_id}/valider`)
                .then(res => {
                    this.nbValidation++;
                }).catch(err => console.log(err));
        },
        addComments(){
            const comment = {body:this.body, question_id:this.question_id,user_id:this.user_id};
            axios.post(`/api/comments/add`, comment)
                .then(res => {
                    if (res.data.succès){
                        this.body ='';
                        this.getComments();
                    }
                }).catch(err =>console.log(err));
        },
        getComments(){
            axios.get(`/api/question/${this.question_id}/comments`)
                .then(res =>{
                    this.comments = res.data;
                }).catch(err => console.log(err));
        }
    }
}
</script>
