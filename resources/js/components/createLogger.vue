<template>
    <div class="container">
        <button class="btn btn-secondary btn-sm" @click="modalCreate()">
            Opret logger
        </button>
        <div class="modal fade" tabindex="-1" role="dialog" id="add_logger_model">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h4 class="modal-title">Opret en logger</h4>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                               aria-hidden="true">&times;</span></button>
                       </div>
                   <div class="modal-body">
                       <div class="alert alert-danger" v-if="errors.length > 0">
                           <ul>
                               <li v-for="error in errors" :key="error">{{ error }}</li>
                           </ul>
                       </div>
                       <div class="form-group">
                            <label for="type">Type:</label>
                            <select class="form-control" v-model="logger.type">
                                <option disabled value="">Vælg venligst en</option>
                                <option v-for="option in options" :key="option.text" v-bind:value="option.value">
                                    {{option.text}}
                                </option>
                            </select>
                       </div>
                       <div class="form-group">
                           <label for="question">Spørgsmål:</label>
                           <input type="text" name="question" id="question" placeholder="f.eks. > Har du taget snus?" class="form-control"
                                  v-model="logger.question">
                       </div>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-default" data-dismiss="modal">Luk</button>
                       <button type="button" @click="createLogger()" class="btn btn-primary">Opret</button>
                   </div>
               </div>
           </div>
       </div>

    </div>


    
</template>

<script>
export default {
    data(){
        return {
            logger:{
                question:'',
                type:0,
            },
            errors:[],
            options: [
                {text: 'Ja / Nej', value: '0'},
            ]
        }
    },

    methods: {
        modalCreate: function(){
            $('#add_logger_model').modal('show');
        },

        resetLogger: function(){
            this.logger.question = '',
            this.logger.type = 0
        },

        createLogger: function(){
            axios.post('/logger/public/loggers', {
                question: this.logger.question,
                type: this.logger.type
                
            }).then((response) => {
                console.log(response)
            })
            this.resetLogger();
            $('#add_logger_model').modal('hide');
            location.reload();
        }
    }


}
</script>

<style>

</style>
